@extends ('layouts.auxiliar')

@section ('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    <strong>Formulario para Compras</strong>
        <br>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error )
            <p>{{$error}}</p>
            @endforeach

        </div>
        @endif

       
        
        <form action="{{route('order.store')}}"method="post" >
       
       
        
            

            
            <button type="submit" class="btn btn-warning">Comprar</button>
            {{csrf_field()}}

        </form>
    </div>
</div>
@endsection