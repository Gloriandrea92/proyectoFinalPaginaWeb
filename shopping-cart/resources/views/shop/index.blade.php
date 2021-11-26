@extends('layouts.master')
@section('title')
RenzoWear Shopping Cart
@endsection
@section('content')
@if(session()->has('success'))
<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4"></div>
    <div id="charge-message" class="alert alert-success">
        {{Session::get('success')}}
    </div>
</div>
@endif
@foreach ($products->chunk(3) as $productChunk)
<div class="row">
@foreach ( $productChunk as $product )

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
        <img src={{$product->imagePath}} alt="..." class="img-responsive">
        <div class="caption">
            <h3>{{$product->title}}</h3>
            <p class="description">{{$product->description}}</p>
            <div class="clearfix">
                <div class="price">${{$product->price}}</div>
                <a href="{{route('product.addToCart', ['id'=>$product->id])}}" class="btn btn-warning pull-right" role="button">Añadir al carrito</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

@endforeach


    <pre></pre>
    <pre></pre>
    <pre></pre>

@endsection

