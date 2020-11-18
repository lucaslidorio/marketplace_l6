<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\Console\Descriptor\Descriptor;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'description', 'slug'];

    //Gera o slug automático
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
