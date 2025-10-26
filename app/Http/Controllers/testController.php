<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class testController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->where('is_active',1)->orderBy('created_at','ASC')->take(6)->get();
        return view('front.test', compact('articles'));
    }
}
