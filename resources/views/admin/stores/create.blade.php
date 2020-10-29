
@extends('layouts.app')

@section('content')

<h1>Criar loja</h1>

<form action="{{route('admin.stores.store')}}" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="form-group">
        <label for="">Nome Loja</label>
        <input type="text"  class="form-control" name="name">
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" class="form-control" name="description">
    </div>

    <div class="form-group">
        <label for="">Telefone</label>
        <input type="text" class="form-control" name="phone">
    </div>

    <div class="form-group">
        <label for="">Celular</label>
        <input type="text" class="form-control" name="mobile_phone">
    </div>

    <div class="form-group">
        <label for="">Slug</label>
        <input type="text" class="form-control" name="slug">
    </div>

    <div class="form-group">
        <label for="">Usário</label>
             <select name="user" class="form-control" id="">
             @foreach ($users as $user)       
                <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
            </select>
    </div>
    <div>
        <button type="submit" class="btn btn-lg btn-success ">Criar Loja</button>
    </div>
</form>
    
@endsection