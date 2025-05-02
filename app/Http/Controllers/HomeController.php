<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Display the home page with featured books.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            // Kalau ada keyword pencarian
            $featuredBooks = Book::where('title', 'like', '%' . $query . '%')
                ->orWhere('author', 'like', '%' . $query . '%')
                ->latest()
                ->paginate(8);

            $search = true;
        } else {
            // Kalau tidak ada keyword pencarian
            $featuredBooks = Book::latest()->take(4)->get();
            $search = false;
        }

        return view('home', compact('featuredBooks', 'query', 'search'));
    }
}
