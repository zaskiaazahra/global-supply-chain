<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\NewsService;

class NewsController extends Controller
{
    public function index(NewsService $newsService)
    {
        // Ambil daftar negara dari database
        $countries = Country::orderBy('name')->get();

        // Negara yang dipilih
        $selected = request('country', 'Indonesia');

        // Ambil berita berdasarkan negara
        $category = request('category', 'all');

        $articles = $newsService->getNews(
        $selected,
        $category
      );

        // Kirim ke view
        return view('news.index', compact(
            'countries',
            'selected',
            'articles',
            'category',
        ));
    }
}