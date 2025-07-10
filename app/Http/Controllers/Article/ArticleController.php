<?php

namespace App\Http\Controllers\Article;

use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // 1. Exécute la requête pour récupérer les catégories actives
    $categories = Category::where('isActive', 1)->get();

    // 2. N’oublie pas de renvoyer la vue juste après
    return view('back.article.create', compact('categories'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
