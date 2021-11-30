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
      <th scope="col">ID compra</th>
      <th scope="col">Fecha</th>
      <th scope="col">ID usuario</th>
      
    </tr>
  </thead>
    
  <tbody>
      @foreach($orders as $order)
      <tr>
      
      <td>{{$order->id}}</td>
      <td>{{$order->created_at}}</td>
      <td>{{$order->user_id}}</td>
      

    </tr>
      @endforeach
    
  </tbody>
</table>
@endsection
    