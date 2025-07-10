<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'is_active',
        'is_commentable',
        'is_shareable',
        'category_id',
        'author_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_shareable' => 'boolean',
        'is_commentable' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime', // C'est bien de caster celle-ci aussi
    ];
    
    // ... tes fonctions getSlugOptions(), getRouteKeyName(), imageUrl() ...

    /**
     * Définit la relation "un article appartient à un auteur".
     * C'est la méthode qu'il te manquait !
     */
    public function author()
    {
        // On suppose que tes auteurs sont dans le modèle User.
        return $this->belongsTo(\App\Models\User::class, 'author_id');
    }

    /**
     * Définit la relation "un article appartient à une catégorie".
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function imageUrl(): string
    {
        return $this->image ? Storage::url($this->image) : '/images/default-article.jpg';
    }
}