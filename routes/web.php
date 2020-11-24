<?php

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index') -> name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){

  Route::get('/', 'CartController@index')->name('index');
  Route::post('add', 'CartController@add')->name('add');
  Route::get('remove/{slug}','CartController@remove')->name('remove');
  Route::get('cancel' ,'CartController@cancel')->name('cancel');

});

Route::prefix('checkout')->name('checkout.')->group(function(){

  Route::get('/', 'CheckoutController@index')->name('index');
  Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
  Route::get('\thanks', 'CheckoutController@thanks')->name('thanks');
});



Route::group(['middleware' => ['auth']], function(){
  Route::get('my-orders', 'UserOrderController@index')->name('user.orders');

  Route::prefix('admin')->name('admin.')->namespace('admin')->group(function () {
    Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
    Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
    Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

    //   Route::prefix('stores')->name('stores.')->group(function () {
    
    //     Route::get('/', 'StoreController@index')->name('index');
    //     Route::get('/create', 'StoreController@create')->name('create');
    //     Route::post('/store', 'StoreController@store')->name('store');
    //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
    //     Route::post('/update/{store}', 'StoreController@update')->name('update');
    //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
    
    //   });
    //   //produtos
    
       Route::resource('stores', 'StoreController');
       Route::resource('products','ProductController');
       Route::resource('categories','CategoryController');
       
       Route::post('photos/remove','ProductPhotoController@removePhoto')->name('photo.remove');

       Route::get('orders/my','OrdersController@index')->name('orders.my');
       

    
    
     });

});


Auth::routes();
Route::get('/model', function () {
  //$products = \App\Product::all();// select * from Products

  //$user = new \App\User();
  //$user = \App\User::find(1);
  //$user->name = 'Usuário Teste editado';
  // $user->email = 'email@teste.com';
  // $user->password = bcrypt('12345678');

  //$user ->save();

  //return \App\User::find(3); //Retorna o usuário com base no id

  //return  \App\User::where ('name', 'Prof. Lauren VonRueden PhD')->get();  // Tras os dados confore a condição

  // return \App\User::paginate(10); //paginar dado com laravel

  //Mas Assignment - Atribuição em massa

  // $user = \App\User::create([
  //    'name' => 'Lucas Lidório',
  //     'email'=> 'lucasli@hotmail.com',
  //     'password' => bcrypt('12345678')

  // ]);
  //Como faria para pegar a loja de um usuário

  //Mas Update
  //$user= \App\User::find(42);
  //$user->update([
  //    'name' => 'Atualizando com mas Upadate'
  //]); //true

  //Como faria para pegar a loja de um usuário
  // $user =  \App\User::find(4);

  //dd($user->store()->count()); //Objeto único (Store) se for Collection de Dados (Objetos);

  //Pegar produto de loja
  // $loja = \App\Store::find(1);

  //  return $loja->products()->where('id',1)->get();

  //Pegar as lojas de uma categorias
  //$categoria = \App\Category::find(1);
  //$categoria->products;

  //Criar uma loja para um usuário
  // $user = \App\User::find(10);
  // $store = $user->store()->create([
  //     'name' => 'Loja Teste',
  //     'description'=> 'loja teste produtos de informatica',
  //     'mobile_phone' => 'xxx-xxxx-xxxx',
  //     'phone' => 'xx-xxxx-xxxx',
  //     'slug' => 'loja-teste'
  // ]);

  // dd($store);


  //Criar um produto para uma loja

  //     $store= \App\Store::find(11);
  //     $product =  $store->products()->create([
  //         'name' => 'Notebook Dell',
  //         'description' => 'core i 5',
  //         'body' => 'Qualquer coisa',
  //         'prince' => 2999.90,
  //         'slug' => 'notebool-dell',
  //   ]);

  //   dd($product);

  //Criar uma categoria
  // $category = \App\Category::create([
  //     'name'=> 'Games',
  //     'description' => null,
  //     'slug' => 'games'
  // ]);
  // $category = \App\Category::create([
  //     'name '=> 'Notebooks',
  //     'description' => null,
  //     'slug' => 'notebooks'
  // ]);

  // return \App\Category::all();

  //Adicionar um produto para um categoria ou vice e versa
  // $product =\App\Product::find(49);

  // dd($product->category()->attach([1]));


  return \App\User::all();
});

Route::get('not', function(){

  //$user = App\User::find(1);

  //$user->notify(new App\Notifications\StoreReceiveNewOrder());

 // $notification = $user->notifications->first();
  //$notification->markAsRead();
  //$notification = $user->notifications->first();
  
 

  //return $user->unreadNotifications->count();
  


});

//Route::get('/home', 'HomeController@index')->name('home');
