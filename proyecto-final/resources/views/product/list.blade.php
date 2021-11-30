@extends ('layouts.auxiliar')
@section('title')
RenzoWear Listado de productos
@endsection
@section('content')
<h1>Listado de Productos</h1>
@if(session()->has('message'))
        <div class="alert alert-success">
        {{ session()->get('message') }}
        </div>
@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Producto</th>
      <th scope="col">Descripción</th>
      <th scope="col">Precio</th>
      <th scope="col">Url Imagen</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
    
  <tbody>
      @foreach($products as $product)
      <tr>
      <th scope="row">
         <a href="{{route('product.show',$product)}}">{{$product->id}}</a>
        </th>
      <td>{{$product->title}}</td>
      <td>{{$product->description}}</td>
      <td>$ {{$product->price}}</td>
      <td>{{$product->imagePath}}</td>
      <td><a href="{{route('product.edit',$product)}}">Editar</a></td>

    </tr>
      @endforeach
    
  </tbody>
</table>
@endsection
    