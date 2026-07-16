<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Port;
use App\Services\NewsService;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    // ==========================
    // DASHBOARD
    // ==========================
    public function index(NewsService $newsService)
    {
        $users = User::latest()->get();
        $totalUsers = User::count();

        $ports = Port::latest()->take(10)->get();
        $totalPorts = Port::count();

        $news = $newsService->getNews("Indonesia");
        $totalNews = count($news);

        return view('admin.index', compact(
            'users',
            'ports',
            'news',
            'totalUsers',
            'totalPorts',
            'totalNews'
        ));
    }

    // ==========================
    // USERS
    // ==========================
    public function users()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users', compact('users'));
    }

    // ==========================
    // PORTS
    // ==========================
    public function ports(Request $request)
    {
        $query = Port::query();

        if ($request->filled('search')) {
            $query->where('port_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('country')) {
            $query->where('country_code', $request->country);
        }

        if ($request->filled('harbor')) {
            $query->where('harbor_type', $request->harbor);
        }

        $ports = $query
            ->orderBy('country_code')
            ->paginate(20)
            ->withQueryString();

        $countries = Port::select('country_code')
            ->distinct()
            ->orderBy('country_code')
            ->pluck('country_code');

        $harbors = Port::select('harbor_type')
            ->distinct()
            ->pluck('harbor_type');

        return view('admin.ports',[
    'ports' => $ports,
    'countries' => $countries,
    'harbors' => $harbors,

    'countryList' => Country::all()->keyBy('iso2'),

    'totalPorts' => Port::count(),
    'totalCountries' => Country::count(),
    'totalHarbors' => 4
]);

    }
    
    // NEWS
    // ==========================
    public function news(Request $request, NewsService $newsService)
{
    $country = $request->get('country', 'Indonesia');

    $news = $newsService->getNews($country);

    $countries = Country::orderBy('name')->pluck('name');

    return view('admin.news', compact(
        'news',
        'countries',
        'country'
    ));
}
    public function destroyUser(User $user)
{
    // jangan sampai admin menghapus dirinya sendiri
    if(auth()->id() == $user->id){
        return back()->with('error','Tidak dapat menghapus akun sendiri.');
    }

    $user->delete();

    return back()->with('success','User berhasil dihapus.');
}
public function editUser(User $user)
{
    return view('admin.edit-user', compact('user'));
}

public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required'
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()
        ->route('admin.users')
        ->with('success','User berhasil diperbarui.');
}
}