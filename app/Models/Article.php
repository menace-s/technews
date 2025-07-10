<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory, HasSlug; // Correction : On utilise le trait 'HasSlug'

    /**
     * Les attributs qui peuvent être assignés en masse.
     * J'ai corrigé 'isSharale' en 'is_shareable' et mis les autres en snake_case pour la cohérence.
     * N'oubliez pas de mettre à jour votre fichier de migration si vous appliquez ces changements.
     *
     * @var array<int, string>
     */
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

    /**
     * Retourne les options pour le slug.
     * Cette fonction est nécessaire pour le trait HasSlug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // Génère le slug à partir du champ 'title'
            ->saveSlugsTo('slug');      // Sauvegarde le slug dans le champ 'slug'
    }

    /**
     * Définit la clé de route pour le modèle.
     * Permet d'utiliser le slug dans les URLs au lieu de l'ID.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; // Correction pour utiliser le slug dans les URLs
    }
}