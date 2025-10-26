<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class DetailController extends Controller
{
    public function show($slug) {
    // $article = Article::with(['category', 'user', 'tags'])->where('slug', $slug)->firstOrFail();
    $article = Article::with(['category'])->where('slug', $slug)->firstOrFail();
    return view('front.detail', compact('article'));
    }


    
}
