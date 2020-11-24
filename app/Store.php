<?php

namespace App;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use App\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    //Laravel sempre procura o nome da classe no plural no BD, caso queria apontar
    //diretamente para a tabela, use a linha abaixo;
    //protected $table = "lojas";

    use HasSlug;
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    //Gera o slug automático
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        //uma loja pertece a um usuário
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    public function notifyStoreOwners($storeId)
    {

        $stores = $this->whereIn('id', $storeId)->get();

        return $stores->map(function ($store) {

            return $store->user;
        })->each->notify(new StoreReceiveNewOrder);
    }
}
