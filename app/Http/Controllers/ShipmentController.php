<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Country;

class ShipmentController extends Controller
{
    // =========================
    // List Shipment
    // =========================
    public function index()
    {
        $shipments = Shipment::latest()->get();

        return view('shipment.index', compact('shipments'));
    }

    // =========================
    // Form Create
    // =========================
    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('shipment.create', compact('countries'));
    }

    // =========================
    // Save Shipment
    // =========================
    public function store(Request $request)
    {
        Shipment::create([

            'shipment_code' => 'SHP'.rand(100000,999999),

            'cargo_name' => $request->cargo_name,

            'origin_country' => $request->origin_country,

            'destination_country' => $request->destination_country,

            'transport_type' => $request->transport_type,

            'weight' => $request->weight,

            'status' => $request->status,

            'departure_date' => $request->departure_date,

            'estimated_arrival' => $request->estimated_arrival,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

        ]);

        return redirect('/shipment')
                ->with('success','Shipment added successfully.');
    }

    // =========================
    // Detail Shipment
    // =========================
    public function show($id)
    {
        $shipment = Shipment::findOrFail($id);

        return view('shipment.show', compact('shipment'));
    }

    // =========================
    // Form Edit
    // =========================
    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id);

        $countries = Country::orderBy('name')->get();

        return view('shipment.edit', compact('shipment','countries'));
    }

    // =========================
    // Update Shipment
    // =========================
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);

        $shipment->update([

            'cargo_name' => $request->cargo_name,

            'origin_country' => $request->origin_country,

            'destination_country' => $request->destination_country,

            'transport_type' => $request->transport_type,

            'weight' => $request->weight,

            'status' => $request->status,

            'departure_date' => $request->departure_date,

            'estimated_arrival' => $request->estimated_arrival,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

        ]);

        return redirect('/shipment')
                ->with('success','Shipment updated successfully.');
    }

    // =========================
    // Delete Shipment
    // =========================
    public function destroy($id)
    {
        Shipment::findOrFail($id)->delete();

        return redirect('/shipment')
                ->with('success','Shipment deleted successfully.');
    }
}