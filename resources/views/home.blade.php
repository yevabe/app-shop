@extends('layouts.app')

@section('title', 'Catalogo')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Dasboard</h2>

            @if(session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif 

            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                <li class="active">
                    <a href="#dashboard" role="tab" data-toggle="tab">
                        <i class="material-icons">shopping_cart</i>
                        Carrito de compras
                    </a>
                </li>                
                <li>
                    <a href="#tasks" role="tab" data-toggle="tab">
                        <i class="material-icons">list</i>
                        Pedidos realizados
                    </a>
                </li>
            </ul>
            
            <br>
            <p>Tu carrito de compras presenta <b>{{ auth()->user()->cart->details->count() }}</b> producto(s).</p>
            <hr>

            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Descripción</th>                        
                        <th class="text-right">Precio</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-right">Subtotal</th>
                        <th class="text-right">Obciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (auth()->user()->cart->details as $detail)                         
                    <tr> 
                        <td class="text-center">
                            <img src="{{ $detail->product->featured_image_url }}" height="50">
                        </td>                        
                        <td class="text-center">
                            <a href="{{ url('/products/'.$detail->product->id) }}" target="_blank">{{ $detail->product->name }}</a>
                        </td>
                        <td class="text-center">
                            <a>{{ $detail->product->description }}</a>
                        </td>                        
                        <td class="text-right">&#36; {{ number_format($detail->product->price,2) }}</td>
                        <td class="text-center">{{ $detail->quantity }}</td>
                        <td class="text-right">&#36; {{ number_format($detail->quantity * $detail->product->price,2) }}</td>
                        <td class="td-actions text-right">
                            <form method="post" action="{{ url('/cart') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">

                                <a href="{{ url('/products/'.$detail->product->id) }}" target="_blank" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-info"></i>
                                </a>                               
                                <button type="submit" rel="tooltip" title="Eliminar del carrito" class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>                                                                     
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <form method="post" action="{{ url('/order') }}">
                    {{ csrf_field() }}

                    <button class="btn btn-primary btn-round">
                        <i class="material-icons">done</i>Realizar pedido
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection
