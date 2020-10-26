<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //Laravel sempre procura o nome da classe no plural no BD, caso queria apontar
    //diretamente para a tabela, use a linha abaixo;
    //protected $table = "lojas";
}

//