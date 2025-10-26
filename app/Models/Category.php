<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'isActive'
    ];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') // génère le slug à partir du champ `name`
            ->saveSlugsTo('slug');      // stocke le résultat dans le champ `slug`
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
