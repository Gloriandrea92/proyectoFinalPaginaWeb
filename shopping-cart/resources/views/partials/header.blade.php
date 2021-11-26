
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">RenzoWear</a>
      <button class="navbar-toggle" type="button" data-bs-toggle="collapse"
      data-bs-target="#bs-example-navbar-collapse-1"  aria-expanded="false" >
        <span class="sr-only"toggle nav></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item dropdown">

            <a class="nav-link"  href="{{route('product.shoppingCart')}}"><i class="fas fa-shopping-cart"></i> Carrito de compras
                <span class="badge">
                {{session()->has('cart')?session()->get('cart')->totalQty:''}}</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i> Cuenta de Usuario
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @if(Auth::check())
                <li><a class="dropdown-item" href="{{route('user.profile')}}">Perfil de usuario</a></li>
                <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{route('user.logout')}}">Cerrar sesión</a></li>

                @else
                <li><a class="dropdown-item" href="{{route('user.signup')}}">Crear cuenta</a></li>
                <li><a class="dropdown-item" href="{{route('user.signin')}}">Ingresar</a></li>
                @endif



            </ul>
          </li>
          {{--<li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>--}}
      </div>
    </div>
  </nav>
