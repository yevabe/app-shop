@extends('layouts.app')

@section('title', 'Listado de productos')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-left">
            <div class="text-center">
                <h2 class="title">Listado de productos</h2>    
            </div>            

            <div class="team">
                <div class="row">
                    <div class="text-center">
                        <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-round">Nuevo producto</a>                     
                    </div>                    

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2">Nombre</th>
                                <th class="col-md-4">Descripción</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-right">Precio</th>
                                <th class="text-center">Obciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)                           
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td class="text-center">{{ $product->category ? $product->category->name : 'General' }}</td>
                                <td class="text-right">&#36; {{ number_format($product->price,2) }}</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/products/'.$product->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <a href="#" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-info"></i>
                                        </a>
                                        <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" rel="tooltip" title="Editar producto" class="btn btn-success btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ url('/admin/products/'.$product->id.'/images') }}" rel="tooltip" title="Imágenes del producto" class="btn btn-warning btn-simple btn-xs">
                                            <i class="fa fa-image"></i>
                                        </a>

                                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                            <i class="fa fa-times" onclick="'¿Seguro que deseas elimar este producto'"></i>
                                        </button>                                        
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                                        
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>                    
                </div>
            </div>
        </div>
    </div>

</div>

@include('includes.footer')
@endsection
