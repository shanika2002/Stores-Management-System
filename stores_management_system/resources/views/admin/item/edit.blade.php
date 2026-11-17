@extends('layouts.admin')

@section('title', 'Edit Item Page')

@section('content')

<div class="container my-5">
    <h1 class="mt-4 animate__animated animate__fadeIn">Items</h1>
    <ol class="breadcrumb mb-4 animate__animated animate__fadeIn animate__delay-1s">
        <li class="breadcrumb-item active">Item</li>
    </ol>

    @if(session('status'))
        <div class="alert alert-success shadow-sm rounded-3 animate__animated animate__bounceIn">{{ session('status') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-3 animate__animated animate__bounceIn">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-3 animate__animated animate__zoomIn">
        <div class="card-header d-flex justify-content-between align-items-center rounded-top-3">
            <h4 class="mb-0">Update Item</h4>
            <a href="{{ url('admin/item') }}" class="btn btn-primary btn-sm rounded-pill">Back</a>
        </div>
        <div class="card-body p-4">
            <form id="itemForm" action="{{ url('admin/item/'.$item->item_id.'/edit') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control rounded-3 shadow-sm" value="{{ old('name', $item->name) }}" required />
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Unit Price</label>
                        <input type="number" name="unit_price" class="form-control rounded-3 shadow-sm" step="0.01" value="{{ old('unit_price', $item->unit_price) }}" required />
                        @error('unit_price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Stock Quantity</label>
                        <input type="number" name="stock_quantity" class="form-control rounded-3 shadow-sm" value="{{ old('stock_quantity', $item->stock_quantity) }}" required />
                        @error('stock_quantity') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Threshold</label>
                        <input type="number" name="threshold" class="form-control rounded-3 shadow-sm" value="{{ old('threshold', $item->threshold) }}" required />
                        @error('threshold') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Choose an Identifier (Optional)</label>
                    <select id="identifierType" name="identifier_type" class="form-select rounded-3 shadow-sm">
                        <option value="">None</option>
                        <option value="barcode" {{ $item->barcodes->isNotEmpty() ? 'selected' : '' }}>Barcodes</option>
                        <option value="serial" {{ $item->serialNumbers->isNotEmpty() ? 'selected' : '' }}>Serial Numbers</option>
                    </select>
                    <small class="text-muted">Select to add identifiers in a popup.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Added Identifiers</label>
                    <div id="identifierList" class="border rounded-3 p-3 bg-light">
                        <p class="text-muted mb-0" id="noIdentifiers">No identifiers added yet.</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Make Model</label>
                    <input type="text" name="make_model" class="form-control rounded-3 shadow-sm" value="{{ old('make_model', $item->make_model) }}" />
                    @error('make_model') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Sub Category</label>
                        <select name="subCategory_id" class="form-control select2 rounded-3 shadow-sm" required>
                            <option value="" disabled>Select Sub Category</option>
                            @foreach($sub_category as $sub)
                                <option value="{{ $sub->subCategory_id }}" {{ old('subCategory_id', $item->subCategory_id) == $sub->subCategory_id ? 'selected' : '' }}>
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subCategory_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Stores</label>
                        <select name="store_id" class="form-control select2 rounded-3 shadow-sm" required>
                            <option value="" disabled>Select Store</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->store_id }}" {{ old('store_id', $item->store_id) == $store->store_id ? 'selected' : '' }}>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('store_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Active Status</label>
                    <select name="is_active" class="form-control rounded-3 shadow-sm" required>
                        <option value="1" {{ old('is_active', $item->is_active) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !old('is_active', $item->is_active) ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Barcode Modal -->
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="barcodeModalLabel">Add Barcodes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="barcodeContainer"></div>
                <button type="button" id="addBarcode" class="btn btn-success btn-sm rounded-pill mt-2">
                    <i class="fas fa-plus"></i> Add Another
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBarcodes" class="btn btn-primary rounded-pill">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Serial Number Modal -->
<div class="modal fade" id="serialModal" tabindex="-1" aria-labelledby="serialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="serialModalLabel">Add Serial Numbers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="serialContainer"></div>
                <button type="button" id="addSerial" class="btn btn-success btn-sm rounded-pill mt-2">
                    <i class="fas fa-plus"></i> Add Another
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveSerials" class="btn btn-primary rounded-pill">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (for modals), Font Awesome, and Animate.css -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select Option",
        allowClear: true,
    });

    // Initialize with existing identifiers from the item's relationships
    let barcodes = {!! json_encode($item->barcodes->pluck('barcode')->toArray()) !!};
    let serials = {!! json_encode($item->serialNumbers->pluck('serial_number')->toArray()) !!};

    console.log('Initial Barcodes:', barcodes);
    console.log('Initial Serials:', serials);

    // Populate identifier list on page load
    updateIdentifierList();

    // Open modal and populate existing identifiers
    $('#identifierType').on('change', function() {
        const value = $(this).val();
        console.log('Identifier Type Changed:', value);
        if (value === 'barcode') {
            populateBarcodeModal();
            $('#barcodeModal').modal('show');
        } else if (value === 'serial') {
            populateSerialModal();
            $('#serialModal').modal('show');
        }
    });

    // Barcode handling
    $('#addBarcode').on('click', function() {
        addBarcodeField();
    });

    $(document).on('click', '.remove-barcode', function() {
        $(this).parent('.barcode-group').remove();
        updateBarcodeRemoveButtons();
    });

    function addBarcodeField(value = '') {
        const container = $('#barcodeContainer');
        const newGroup = $('<div class="input-group mb-2 barcode-group animate__animated animate__fadeIn">' +
            '<input type="text" class="form-control rounded-3" placeholder="Enter barcode" value="' + value + '" />' +
            '<button type="button" class="btn btn-danger remove-barcode">Remove</button></div>');
        container.append(newGroup);
        updateBarcodeRemoveButtons();
    }

    function populateBarcodeModal() {
        $('#barcodeContainer').empty();
        if (barcodes.length > 0) {
            barcodes.forEach(b => addBarcodeField(b));
        } else {
            addBarcodeField();
        }
    }

    function updateBarcodeRemoveButtons() {
        const groups = $('.barcode-group');
        groups.each(function() {
            $(this).find('.remove-barcode').toggle(groups.length > 1);
        });
    }

    $('#saveBarcodes').on('click', function() {
        barcodes = [];
        $('#barcodeContainer input').each(function() {
            const value = $(this).val().trim();
            if (value) barcodes.push(value);
        });
        console.log('Updated Barcodes:', barcodes);
        updateIdentifierList();
        addBarcodesToForm();
        $('#barcodeModal').modal('hide');
    });

    // Serial Number handling
    $('#addSerial').on('click', function() {
        addSerialField();
    });

    $(document).on('click', '.remove-serial', function() {
        $(this).parent('.serial-group').remove();
        updateSerialRemoveButtons();
    });

    function addSerialField(value = '') {
        const container = $('#serialContainer');
        const newGroup = $('<div class="input-group mb-2 serial-group animate__animated animate__fadeIn">' +
            '<input type="text" class="form-control rounded-3" placeholder="Enter serial number" value="' + value + '" />' +
            '<button type="button" class="btn btn-danger remove-serial">Remove</button></div>');
        container.append(newGroup);
        updateSerialRemoveButtons();
    }

    function populateSerialModal() {
        $('#serialContainer').empty();
        if (serials.length > 0) {
            serials.forEach(s => addSerialField(s));
        } else {
            addSerialField();
        }
    }

    function updateSerialRemoveButtons() {
        const groups = $('.serial-group');
        groups.each(function() {
            $(this).find('.remove-serial').toggle(groups.length > 1);
        });
    }

    $('#saveSerials').on('click', function() {
        serials = [];
        $('#serialContainer input').each(function() {
            const value = $(this).val().trim();
            if (value) serials.push(value);
        });
        console.log('Updated Serials:', serials);
        updateIdentifierList();
        addSerialsToForm();
        $('#serialModal').modal('hide');
    });

    // Update identifier list display
    function updateIdentifierList() {
        const list = $('#identifierList');
        list.empty();
        console.log('Updating Identifier List - Barcodes:', barcodes, 'Serials:', serials);
        if (barcodes.length === 0 && serials.length === 0) {
            list.append('<p class="text-muted mb-0" id="noIdentifiers">No identifiers added yet.</p>');
        } else {
            if (barcodes.length > 0) {
                list.append('<strong>Barcodes:</strong><ul class="mb-2"></ul>');
                barcodes.forEach(b => list.find('ul').first().append(`<li>${b}</li>`));
            }
            if (serials.length > 0) {
                list.append('<strong>Serial Numbers:</strong><ul class="mb-0"></ul>');
                serials.forEach(s => list.find('ul').last().append(`<li>${s}</li>`));
            }
        }
    }

    // Add hidden inputs to form for submission
    function addBarcodesToForm() {
        $('#itemForm').find('input[name="barcodes[]"]').remove();
        barcodes.forEach(b => {
            $('#itemForm').append(`<input type="hidden" name="barcodes[]" value="${b}">`);
        });
        console.log('Barcodes added to form:', barcodes);
    }

    function addSerialsToForm() {
        $('#itemForm').find('input[name="serial_numbers[]"]').remove();
        serials.forEach(s => {
            $('#itemForm').append(`<input type="hidden" name="serial_numbers[]" value="${s}">`);
        });
        console.log('Serials added to form:', serials);
    }
});
</script>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }
    .form-control, .form-select {
        border: 1px solid #ced4da;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.25);
    }
    .btn-danger {
        padding: 6px 12px;
    }
    .modal-content {
        border: none;
    }
    .modal-header {
        border-bottom: 1px solid #e9ecef;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
    }
    .select2-container .select2-selection--single {
        height: 38px !important;
        padding: 5px;
        border: 1px solid #ced4da;
    }
    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-results__option {
        padding: 10px 15px;
        font-size: 14px;
    }
    body, h1, h4, label, .breadcrumb-item, .alert, .text-danger {
        color: black !important;
    }
    .text-danger {
        font-size: 0.85rem;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #identifierList ul {
        list-style-type: disc;
        margin-left: 20px;
    }
</style>

@endsection