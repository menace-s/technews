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
        $articles = Article::all();
        return view('back.article.index',compact('articles'));
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
    // 1. Récupère toutes les données validées dans un tableau.
    $data = $request->validated();

    // 2. Gère le téléversement de l'image si elle est présente et valide.
    if ($request->hasFile('image')) {
        // 'articles' est le nom du dossier de destination dans `storage/app/public`
        $path = $request->file('image')->store('articles', 'public');
        
        // 3. Ajoute le chemin de l'image au tableau de données.
        $data['image'] = $path;
    }

    // 4. Ajoute l'ID de l'auteur authentifié.
    $data['author_id'] = auth()->id();

    // 5. Crée l'article en utilisant le tableau de données propre et complet.
    //    Assurez-vous que tous les noms de clés dans $data correspondent
    //    aux noms de colonnes dans votre table et dans le $fillable de votre modèle Article.
    Article::create($data);

    // 6. Redirige vers la page de liste avec un message de succès.
    return redirect()->route('articles.index')->with('success', 'Article créé avec succès !');
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
