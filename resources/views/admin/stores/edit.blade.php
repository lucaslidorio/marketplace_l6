
@extends('layouts.app')

@section('content')

<h1>Criar loja</h1>

<form action="{{route('admin.stores.update', ['store'=>$store->id])}}" method="post"  enctype="multipart/form-data">
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
        <p>
        <img src="{{asset('storage/'.$store->logo)}}" alt="">
        </p>
        <label> Logo</label>
        <input type="file" name="logo[]" class="form-control @error('photos') is-invalid @enderror">
         @error('logo')
         <div class="invalid-feedback">
          {{$message}}
          </div>
             
         @enderror
    </div>
    
    
    <div>
        <button type="submit" class="btn btn-lg btn-success ">Atualizar Loja</button>
    </div>
</form>
    
@endsection