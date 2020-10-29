
@extends('layouts.app')

@section('content')

<h1>Criar loja</h1>

<form action="{{route('admin.stores.update', ['store'=>$store->id])}}" method="post">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="">Nome Loja</label>
    <input type="text"  class="form-control" name="name" value="{{$store->name}}">
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" class="form-control" name="description"  value="{{$store->description}}"> 
    </div>

    <div class="form-group">
        <label for="">Telefone</label>
        <input type="text" class="form-control" name="phone" value="{{$store->phone}}">
    </div>

    <div class="form-group">
        <label for="">Celular</label>
        <input type="text" class="form-control" name="mobile_phone" value="{{$store->mobile_phone}}">
    </div>

    <div class="form-group">
        <label for="">Slug</label>
        <input type="text" class="form-control" name="slug" value="{{$store->slug}}">
    </div>

    
    <div>
        <button type="submit" class="btn btn-lg btn-success ">Atualizar Loja</button>
    </div>
</form>
    
@endsection