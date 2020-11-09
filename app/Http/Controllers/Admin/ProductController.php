<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\ProductPhoto;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //lista dados
        $userStore = auth()->user()->store;

        $products = $userStore->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Formlário de criação
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {      
        
        $data = $request->all();

        $store = auth()->user()->store;
        $product = $store->products()->create($data);


        $product->categories()->sync($data['categories']);
        
        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image' );
            //inserção na base =  referencias
            $product->photos()->createMany($images) ;
        }


        //Menssagem de sucesso
        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Visualização rápida de dados


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        //Formulário de edição
        $product = $this->product->findOrFail($product);
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        //Processamento da atualização
        $data = $request->all();

        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image' );
            //inserção na base =  referencias
            $product->photos()->createMany($images) ;
        }

        flash('Produto alterado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {

        $product = $this->product->find($product);
        $product->delete();

        flash('Produto removido com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    
}
