<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>

    @yield('stylesheets')

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

        <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>

                @foreach ($categories as $category)
                <li class="nav-item @if(request()->is('category/'.$category->slug)) active @endif">
                    <a class="nav-link"
                        href="{{route('category.single', ['slug'=> $category->slug])}}">{{$category->name}}</a>
                </li>
                @endforeach
            </ul>

            @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                </li>
            </ul>
            @endauth
            <div class="my-2 my-lg-0">

                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item @if(request()->is('my-orders')) active @endif">
                            <a href="{{route('user.orders')}}" class="nav-link">Meus Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault();
                                     document.querySelector('form.logout').submit();"> Sair </a>
                
                            <form action="{{route('logout')}}" class="logout" method="POST" style="display: none;">
                              @csrf
                
                            </form>
                          </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{route('cart.index')}}" class="nav-link">
                            @if (session()->has('cart'))
                            <span class="badge badge-danger"> {{count(session()->get('cart'))}} </span>

                            @endif
                            <i class="fa fa-shopping-cart fa-2x"></i>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    
    @yield('scripts')
</body>

</html>