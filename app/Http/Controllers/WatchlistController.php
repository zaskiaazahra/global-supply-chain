<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use App\Models\Country;

class WatchlistController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();

        $watchlists = Watchlist::latest()->get();

        return view('watchlist.index', compact(
            'countries',
            'watchlists'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required'
        ]);

        Watchlist::firstOrCreate([
            'country' => $request->country
        ]);

        return back()->with(
            'success',
            'Country added to Watchlist.'
        );
    }

    public function destroy($id)
    {
        Watchlist::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Country removed from Watchlist.'
        );
    }
}