<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Item;
use App\Models\Stores;
use App\Models\SubCategory;
use App\Models\Barcode;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::with('sub_category', 'stores', 'barcodes', 'serialNumbers')->get();
        $totalItemsCount = Item::count();
        $sub_category = SubCategory::all();
        $stores = Stores::all();

        return view('admin.item.index', compact('item', 'totalItemsCount', 'sub_category', 'stores'));
    }

    public function create()
    {
        $sub_category = SubCategory::all();
        $stores = Stores::all();

        return view('admin.item.create', compact('sub_category', 'stores'));
    }

    public function store(Request $request)
    {
        Log::info('Store Request Data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'unit_price' => 'required|numeric',
            'stock_quantity' => 'required|integer|min:1',
            'threshold' => 'required|integer',
            'subCategory_id' => 'required|exists:sub_category,subCategory_id',
            'store_id' => 'required|exists:stores,store_id',
            'make_model' => 'nullable|string|max:255',
            'barcodes' => 'nullable|array',
            'barcodes.*' => 'string|distinct|unique:barcodes,barcode',
            'serial_numbers' => 'nullable|array',
            'serial_numbers.*' => 'string|distinct|unique:serial_numbers,serial_number',
        ]);

        $item = Item::create([
            'name' => $request->name,
            'unit_price' => $request->unit_price,
            'stock_quantity' => $request->stock_quantity,
            'threshold' => $request->threshold,
            'subCategory_id' => $request->subCategory_id,
            'store_id' => $request->store_id,
            'make_model' => $request->make_model ?? '',
            'is_active' => true,
        ]);

        Log::info('Item Created:', $item->toArray());

        if ($request->has('barcodes') && !empty($request->barcodes)) {
            $generator = new BarcodeGeneratorPNG();
            foreach ($request->barcodes as $barcodeValue) {
                if (!empty($barcodeValue)) {
                    $barcode = Barcode::create([
                        'item_id' => $item->item_id,
                        'barcode' => $barcodeValue,
                    ]);

                    $barcodeImage = $generator->getBarcode($barcodeValue, $generator::TYPE_CODE_128);
                    Storage::disk('public')->put('barcodes/' . $barcode->id . '.png', $barcodeImage);
                    Log::info('Barcode Created:', $barcode->toArray());
                }
            }
        }

        if ($request->has('serial_numbers') && !empty($request->serial_numbers)) {
            foreach ($request->serial_numbers as $serialValue) {
                if (!empty($serialValue)) {
                    $serial = SerialNumber::create([
                        'item_id' => $item->item_id,
                        'serial_number' => $serialValue,
                    ]);
    
                    $filePath = 'barcodes/serial_' . $serial->id . '.png';
                    // Generate QR code (might be SVG by default)
                    $qrCode = QrCode::format('png')->size(100)->generate($serialValue);
                    
                    // If it's still SVG, convert to PNG using Intervention Image
                    if (strpos($qrCode, '<?xml') !== false) {
                        $svg = $qrCode;
                        $image = Image::make($svg)->encode('png');
                        Storage::disk('public')->put($filePath, $image->get(), 'public');
                    } else {
                        // If it's already PNG, save directly
                        Storage::disk('public')->put($filePath, $qrCode, 'public');
                    }
    
                    // Verify and log
                    if (Storage::disk('public')->exists($filePath)) {
                        $fileSize = Storage::disk('public')->size($filePath);
                        $fileContent = Storage::disk('public')->get($filePath);
                        $isPng = strpos($fileContent, '<?xml') === false;
                        Log::info('Serial QR Code Generated and Saved:', [
                            'path' => $filePath,
                            'size' => $fileSize . ' bytes',
                            'isPng' => $isPng ? 'Yes' : 'No (SVG detected)'
                        ]);
                        if ($fileSize < 100 || !$isPng) {
                            Log::warning('Serial QR file issue:', ['path' => $filePath, 'isPng' => $isPng]);
                        }
                    } else {
                        Log::error('Failed to Save Serial QR Code:', ['path' => $filePath]);
                    }
                }
            }
        }
        
        return redirect('admin/item')->with('status', 'Item Created Successfully');
    }

    public function edit(int $item_id)
    {
        $item = Item::with('barcodes', 'serialNumbers')->find($item_id);

        if (!$item) {
            return redirect()->back()->with('error', 'Item not found!');
        }

        $sub_category = SubCategory::all();
        $stores = Stores::all();

        Log::info('Edit Item Loaded:', $item->toArray());
        Log::info('Barcodes:', $item->barcodes->toArray());
        Log::info('Serial Numbers:', $item->serialNumbers->toArray());

        return view('admin.item.edit', compact('item', 'sub_category', 'stores'));
    }

    public function update(Request $request, int $item_id)
    {
        Log::info('Update Method Called', [
            'item_id' => $item_id,
            'method' => $request->method(),
            'input' => $request->all()
        ]);

        $item = Item::findOrFail($item_id);
        Log::info('Item Before Update:', $item->toArray());

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit_price' => 'required|numeric',
            'stock_quantity' => 'required|integer|min:1',
            'threshold' => 'required|integer',
            'subCategory_id' => 'required|exists:sub_category,subCategory_id',
            'store_id' => 'required|exists:stores,store_id',
            'make_model' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'barcodes' => 'nullable|array',
            'barcodes.*' => 'nullable|string|distinct|unique:barcodes,barcode,' . $item->item_id . ',item_id',
            'serial_numbers' => 'nullable|array',
            'serial_numbers.*' => 'nullable|string|distinct|unique:serial_numbers,serial_number,' . $item->item_id . ',item_id',
        ]);

        Log::info('Validated Data:', $validated);

        // Update all fields
        $item->update([
            'name' => $validated['name'],
            'unit_price' => $validated['unit_price'],
            'stock_quantity' => $validated['stock_quantity'],
            'threshold' => $validated['threshold'],
            'subCategory_id' => $validated['subCategory_id'],
            'store_id' => $validated['store_id'],
            'make_model' => $validated['make_model'] ?? '',
            'is_active' => $validated['is_active'],
        ]);

        Log::info('Item After Update:', $item->toArray());

        // Handle barcodes
        if ($request->has('barcodes')) {
            $existingBarcodes = $item->barcodes->pluck('barcode')->toArray();
            Log::info('Existing Barcodes Before Update:', $existingBarcodes);

            // Delete existing barcodes and their files
            foreach ($item->barcodes as $barcode) {
                Storage::disk('public')->delete('barcodes/' . $barcode->id . '.png');
                $barcode->delete();
            }
            Log::info('Deleted All Existing Barcodes');

            $newBarcodes = array_filter($request->input('barcodes', []), fn($value) => !empty($value));
            if (!empty($newBarcodes)) {
                $generator = new BarcodeGeneratorPNG();
                foreach ($newBarcodes as $barcodeValue) {
                    $barcode = Barcode::create([
                        'item_id' => $item->item_id,
                        'barcode' => $barcodeValue,
                    ]);

                    $barcodeImage = $generator->getBarcode($barcodeValue, $generator::TYPE_CODE_128);
                    Storage::disk('public')->put('barcodes/' . $barcode->id . '.png', $barcodeImage);
                    Log::info('New Barcode Created:', $barcode->toArray());
                }
            }
        }

        // Handle serial numbers
        if ($request->has('serial_numbers')) {
            foreach ($item->serialNumbers as $serial) {
                Storage::disk('public')->delete('barcodes/serial_' . $serial->id . '.png');
                $serial->delete();
            }

            $newSerials = array_filter($request->input('serial_numbers', []), fn($value) => !empty($value));
            if (!empty($newSerials)) {
                foreach ($newSerials as $serialValue) {
                    $serial = SerialNumber::create([
                        'item_id' => $item->item_id,
                        'serial_number' => $serialValue,
                    ]);

                    $filePath = 'barcodes/serial_' . $serial->id . '.png';
                    // Generate QR code as PNG
                    $qrCode = QrCode::format('png')->size(100)->generate($serialValue);
                    // Convert the QR code to a string and save as binary PNG
                    Storage::disk('public')->put($filePath, $qrCode, 'public');

                    // Verify and log
                    if (Storage::disk('public')->exists($filePath)) {
                        $fileSize = Storage::disk('public')->size($filePath);
                        $fileContent = Storage::disk('public')->get($filePath);
                        $isPng = strpos($fileContent, '<?xml') === false; // Check if it's not SVG
                        Log::info('Serial QR Code Generated and Saved:', [
                            'path' => $filePath,
                            'size' => $fileSize . ' bytes',
                            'isPng' => $isPng ? 'Yes' : 'No (SVG detected)'
                        ]);
                        if ($fileSize < 100 || !$isPng) {
                            Log::warning('Serial QR file issue:', ['path' => $filePath, 'isPng' => $isPng]);
                        }
                    } else {
                        Log::error('Failed to Save Serial QR Code:', ['path' => $filePath]);
                    }
                }
            }
        }

        return redirect('admin/item')->with('status', 'Item Updated Successfully');
    }

    public function destroy(int $item_id)
    {
        try {
            $item = Item::findOrFail($item_id);

            foreach ($item->barcodes as $barcode) {
                Storage::disk('public')->delete('barcodes/' . $barcode->id . '.png');
                $barcode->delete();
            }

            foreach ($item->serialNumbers as $serial) {
                Storage::disk('public')->delete('barcodes/serial_' . $serial->id . '.png');
                $serial->delete();
            }

            $item->delete();
            return redirect()->back()->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete item!');
        }
    }
}
