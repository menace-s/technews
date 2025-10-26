<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class FrontCategoryController extends Controller
{
    public function index($slug){
        $category = Category::where('slug', $slug)
        ->where('isActive', 1)
        ->firstOrFail();
    
    // Articles avec pagination (12 par page)
    $articles = $category->articles()
        ->orderBy('created_at', 'desc')
        ->paginate(12);
    
    // Autres catégories actives (5 maximum)
    $otherCategories = Category::where('isActive', 1)
        ->where('id', '!=', $category->id)
        ->withCount('articles')
        ->having('articles_count', '>', 0)
        ->take(5)
        ->get();
    
    return view('front.category', compact('category', 'articles', 'otherCategories'));
    }
}
