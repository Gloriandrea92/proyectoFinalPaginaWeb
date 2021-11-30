@extends ('layouts.auxiliar')

@section ('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    <strong>Formulario para {{isset($product)? 'Editar ':'Crear '}}producto</strong>
        <br>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error )
            <p>{{$error}}</p>
            @endforeach

        </div>
        @endif

       
        @if(isset($product))
        <form action="{{route('product.update',$product)}}"method="post" >
        @method('PATCH')

        @else
        <!-- <form action="{{route('product.form')}}"method="post" >-->
        <form action="{{route('product.store')}}"method="post" >
        @endif
       
        
            <div class="form-group">
                <label for="title">Producto</label>
                <input type="text"id="title" name="title" class="form-control" value="{{$product->title ?? ''}}">
            </div >
            <div class="form-group">
                <label for="description">Descripcion</label>
                <input type="text"id="description" name="description" class="form-control" value="{{$product->description ?? ''}}">
            </div >
            <div class="form-group">
                <label for="imagePath">Url de imgen</label>
                <input type="url"id="imagePath" name="imagePath" class="form-control" value="{{$product->imagePath ?? ''}}">
            </div >
            <div class="form-group">
                <label for="price">Precio</label>
                <input type="integer"id="price" name="price" class="form-control" value="{{$product->price ?? ''}}">
            </div >

            
            <button type="submit" class="btn btn-warning">Guardar producto</button>
            {{csrf_field()}}

        </form>
    </div>
</div>
@endsection