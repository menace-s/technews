<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        // dd($user->roles);
        if($user && $user->hasRole('author')){
            $author_articles = Article::where('author_id', $user->id)->count();
            
        }
        $articles =Article::all();
        $recent_articles = Article::orderBy('created_at', 'desc')->take(10)->get();
        $categories = Category::count();
        return view('back.dashboard',[
            'author_articles' => $author_articles ?? null,
            'articles' => $articles,
            'recent_articles' => $recent_articles,
            'categories' => $categories,
        ]);
    }
}
