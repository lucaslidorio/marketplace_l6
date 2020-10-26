<?php


Route::get('/', function () {

    $helloWorld = 'Hello Word';
    


    return view('welcome', compact('helloWorld'));

    
});

Route::get('/model', function(){
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

  //Mas Update
  $user= \App\User::find(42);
  $user->update([
      'name' => 'Atualizando com mas Upadate'
  ]); //true

  
  
    return \App\User::all();
});
