<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Port;

class PortLocationController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::orderBy('name')->get();

        $selected = $request->country ?? 'Indonesia';

        $ports = Port::where('country_code', $selected)
                    ->orderBy('port_name')
                    ->get();
        
        $recommendedPort = $ports
    ->sortByDesc(function($port){

        return match($port->harbor_size){

            'Large' => 3,

            'Medium' => 2,

            default => 1

        };

    })
    ->first();

        return view('port-location.index', compact(

            'countries',

            'selected',

            'ports',

            'recommendedPort',

        ));
    }
}