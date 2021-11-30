@extends ('layouts.auxiliar')

@section ('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <strong>Detalles de producto</strong>
        <br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Producto</th>
      <th scope="col">Descripción</th>
      <th scope="col">Precio</th>
      <th scope="col">Url Imagen</th>
      
    </tr>
  </thead>
    
  <tbody>
      
      <tr>
      <th scope="row">
         {{$product->id}}
        </th>
      <td>{{$product->title}}</td>
      <td>{{$product->description}}</td>
      <td>$ {{$product->price}}</td>
      <td>{{$product->imagePath}}</td>
      
    </tr>
    
            {{csrf_field()}}
  </tbody>
</table>
<form action="{{route('product.destroy',$product)}}" method="post">
 @csrf
@method('DELETE')

<button type="submit" class="btn btn-warning">Eliminar producto</button>
</form>

@endsection