@extends('layouts.app')

@section('title', 'Bienvenido a Mi Tienda Hoy')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Registrar nuevo producto</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>                    
                </div>
            @endif

            <form method="post" action="{{ url('/admin/products') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del producto</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="col-sm-6">                
                        <div class="form-group label-floating">
                            <label class="control-label">Precio del producto</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group label-floating">
                    <label class="control-label">Descripción corta</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                </div>                

                <textarea class="form-control" placeholder="Descripción larga del producto" rows="5" name="long_description">{{ old('long_description') }}</textarea>
                
                <div class="text-center">
                    <button class="btn btn-primary">Registrar producto</button> 
                    <a href="{{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>                     
                </div>
                             
            </form>                
        </div>

    </div>

</div>

@include('includes.footer')
@endsection
