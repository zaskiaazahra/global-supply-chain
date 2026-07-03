<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index(Request $request)
{
    $search = $request->search;

    $query = Country::query();

    if ($search) {

        $query->where('name', 'like', '%' . $search . '%');

    }

    $data = $query->paginate(20)->withQueryString();

    return view('countries.index', compact('data', 'search'));
}
}