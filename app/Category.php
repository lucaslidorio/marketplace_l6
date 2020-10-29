<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\Console\Descriptor\Descriptor;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
