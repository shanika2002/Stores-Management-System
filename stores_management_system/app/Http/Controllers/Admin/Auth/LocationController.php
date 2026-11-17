<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::get();
       // return $location;
        return view('admin.location.index',compact('location'));
    }

    public function create()
    {
        return view('admin.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //'location_id' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'airport_code' => 'required|max:255|string',
            'address' => 'required|max:255|string',
            'contact_info' => 'required|max:255|string',
        ]);

        Location::create([
            //'location_id' => $request -> location_id,
            'name' => $request -> name,
            'airport_code' => $request -> airport_code,
            'address' => $request -> address,
            'contact_info' => $request -> contact_info,
        ]);

        return redirect('admin/location/create')->with('status','Location Created');
    }

    public function edit(int $location_id)
    {
         $location = Location::findOrFail($location_id);
         //return $location;
         return view('admin.location.edit', compact('location'));
    }

    public function update(Request $request, int $location_id)
    {
        $request->validate([
            //'location_id' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'airport_code' => 'required|max:255|string',
            'address' => 'required|max:255|string',
            'contact_info' => 'required|max:255|string',
        ]);

        Location::findOrFail($location_id)->update([
            //'location_id' => $request -> location_id,
            'name' => $request -> name,
            'airport_code' => $request -> airport_code,
            'address' => $request -> address,
            'contact_info' => $request -> contact_info,
        ]);

        return redirect('admin/location')->with('status','Location Updated');
  
    }

    public function destroy(int $location_id)
    {
        $location = Location::findOrFail($location_id);
        $location->delete();

        return redirect()->back()->with('status','Location Deleted');

    }

}
