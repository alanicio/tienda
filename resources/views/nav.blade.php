  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Distribuidora Nonex</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <form class="form-inline ml-auto" method="POST" action="{{URL('search')}}">
          {{ csrf_field() }}
          <div class="md-form my-0">
            <input class="form-control" type="text" placeholder="Buscar producto..." aria-label="Search" name="search">
          </div>
          <button class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit"><i class="fas fa-search" style="color: red;"></i></button>
        </form>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('tienda.index')}}">Tienda</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('ventas.index')}}"><i class="fas fa-shopping-cart"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  