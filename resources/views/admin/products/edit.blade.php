
@extends('layouts.app')

@section('content')


<h1>Atualizar Produto</h1>

<form action="{{route('admin.products.update', ['product'=>$product->id])}}" method="post">
@csrf
@method("PUT")

    <div class="form-group">
        <label for="">Nome Produto</label>
        <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

        @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" name="description" class=" form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

        @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
    </div>

    <div class="form-group">
        <label for="">Conteúdo</label>
        <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" >{{$product->body}}</textarea>

        @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Preço</label>
        <input type="text" name="prince" class="form-control @error('prince') is-invalid @enderror" value="{{$product->price}}">
        
        @error('prince')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Slug</label>
    <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
    </div>

    
    <div>
        <button type="submit" class="btn btn-lg btn-success ">Cadatrar Produto</button>
    </div>
</form>
    
@endsection