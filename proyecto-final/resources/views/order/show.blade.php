@extends ('layouts.auxiliar')

@section ('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
    <strong>Compras</strong>
        <br>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error )
            <p>{{$error}}</p>
            @endforeach

        </div>
        @endif

       
        
        
       
       
        
            

            
    </div>
</div>
@endsection