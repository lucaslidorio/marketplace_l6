<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use App\User;
class Store extends Model
{
    //Laravel sempre procura o nome da classe no plural no BD, caso queria apontar
    //diretamente para a tabela, use a linha abaixo;
    //protected $table = "lojas";

    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug'];


    public function user()
    {
        //uma loja pertece a um usuário
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

