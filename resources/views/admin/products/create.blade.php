
@extends('layouts.app')

@section('content')

<h1>Cadastrar Produto</h1>

<form action="{{route('admin.products.store')}}" method="post">
    @csrf

    <div class="form-group">
        <label for="">Nome Produto</label>
        <input type="text"  class="form-control" name="name">
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" class="form-control" name="description">
    </div>

    <div class="form-group">
        <label for="">Conteúdo</label>
        <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="">Preço</label>
        <input type="text" class="form-control" name="prince">
    </div>

    <div class="form-group">
        <label for="">Slug</label>
        <input type="text" class="form-control" name="slug">
    </div>

    <div class="form-group">
        <label for="">Lojas</label>
             <select name="store" class="form-control" id="">
             @foreach ($stores as $store)       
                <option value="{{$store->id}}">{{$store->name}}</option>
              @endforeach
            </select>
    </div>
    <div>
        <button type="submit" class="btn btn-lg btn-success ">Cadatrar Produto</button>
    </div>
</form>
    
@endsection