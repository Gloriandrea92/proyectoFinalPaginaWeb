@extends('layouts.master')
@section('title')
RenzoWear Shopping Cart
@endsection
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
        <h1>Checkout</h1>
        <h4>Total $ {{$total}}</h4>
        <div id="charge-error" class="alert alert-danger{{!session()->has('error')?
        'hidden':''}}">
        {{session()->get('error')}}
        </div>
        <form action="{{route('checkout')}}" method ="post" id="checkout-form">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" class="form-control" required name="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" id="address" class="form-control" required name="address">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-name">Propietario de la Tarjeta</label>
                        <input type="text" id="card-name" class="form-control" required name="card-name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-number">Número de la tarjeta</label>
                        <input type="text" id="card-number" class="form-control" required name="card-number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-expiry-month">Mes de expiración</label>
                        <input type="text" id="card-expiry-month" class="form-control" required name="card-expiry-month">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-expiry-year">Año de expiración</label>
                        <input type="text" id="card-expiry-year" class="form-control" required name="card-expiry-year">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="card-cvc">CVC</label>
                        <input type="text" id="card-cvc" class="form-control" required name="card-cvc">
                    </div>
                </div>
            </div>
            {{csrf_field()}}
            <button type="submit" class ="btn btn-success">Comprar</button>
        </form>
    </div>
</div>
@endsection
