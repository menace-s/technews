<?php

namespace App\Http\Controllers\Article;

use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
    $data = $request->validated();

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('articles', 'public');
        $data['image'] = $path;
    }

    $data['author_id'] = auth()->id();

    // 1. On crée l'article SANS les tags pour l'instant.
    $article = Article::create($data);

    // 2. Maintenant que l'article existe, on lui attache les tags.
    // On vérifie que le champ 'tags' n'est pas vide avant de continuer.
    if ($request->filled('tags')) {
        $tags = explode(',', $request->tags);
        $article->tag($tags); // On utilise la méthode du package sur l'objet $article
    }

    return redirect()->route('articles.index')->with('success', 'Article créé avec succès !');
}

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        return view('back.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // 1. Exécute la requête pour récupérer les catégories actives
        $categories = Category::where('isActive', 1)->get();

        // 2. N’oublie pas de renvoyer la vue juste après
        return view('back.article.create', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
   {
        // 1. On récupère les données validées par la requête.
        $data = $request->validated();

        // 2. On gère la mise à jour de l'image si une nouvelle a été envoyée.
        if ($request->hasFile('image')) {
            // On supprime l'ancienne image pour ne pas laisser de fichiers orphelins.
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // On enregistre la nouvelle et on met à jour le chemin dans $data.
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;
        }

        // 3. On met à jour l'article existant avec les nouvelles données.
        // La méthode update() fait une assignation de masse et sauvegarde en une seule étape !
        $article->update($data);

        // 4. On met à jour les tags.
        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            // On utilise retag() qui supprime les anciens tags et applique les nouveaux.
            // C'est exactement ce qu'on veut pour une mise à jour.
            $article->retag($tags);
        } else {
            // Si le champ des tags est vide, on supprime tous les tags associés.
            $article->untag();
        }

        // 5. On redirige avec un message de succès.
        return redirect()->route('articles.index')->with('success', 'Article modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Article supprimé avec succès !');
    }
}
