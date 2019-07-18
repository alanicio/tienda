  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:  #598ada;">
    <div class="container">
      <a class="navbar-brand" href="/">NONEXTORE</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <form class="form-inline ml-auto" method="GET" action="{{URL('search')}}">
          <!-- {{ csrf_field() }} -->
          <div class="md-form my-0">
            <input class="form-control" type="text" placeholder="Buscar producto..." aria-label="Search" name="search">
          </div>
          <button class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit"><i class="fas fa-search" style="color: white;"></i></button>
        </form>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('tienda.index')}}">Tienda</i></a>
          </li>
         

          @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{Route('ventas.create')}}"><i class="fas fa-shopping-cart"></i></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::User()->name}}</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{Route('ventas.show',['id'=>Auth::User()->id])}}">Mi cuenta</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          {{ __('Salir') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sesion</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{Route('login')}}">Iniciar sesión</a>
                <a class="dropdown-item" href="{{Route('register')}}">Registrarse</a>       
              </div>
            </li>

          @endif

            

         <!--  <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
  