@extends ('layouts.master')

@section ('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Perfil de usuario</h1>
        <h2>Mis compras</h2>
        @foreach ($orders as $order)
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($order->cart->items as $item)
                    <li class="list-group-item">
                        <span class="badge">${{$item->['price']}}</span>
                        {{$item['item']['title']}}|{{$item['item']['qty']}}Units
                    </li>
                    @endforeach
                  </ul>
            </div>
            <div class="panel-footer">
                <strong>Precio Total ${{$order->cart->totalPrice}}</strong>
            </div>
          </div>
          @endforeach
    </div>
</div>
@endsection
