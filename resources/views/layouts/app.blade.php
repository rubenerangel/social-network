<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>SocialApp</title>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light navbar-socialapp">
      <a class="navbar-brand" href="/">SocialApp</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          {{-- <li class="nav-item active">
            <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> --}}
        </ul>

        <ul class="navbar-nav ml-auto">
          @guest
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">Login</a>
          </li>
          
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a onclick="document.getElementById('logout').submit()" class="dropdown-item" href="#">LogOut</a>
            </div>
          </li>
          <form id="logout" action="{{ route('logout') }}" method="POST">@csrf</form>
          @endguest
        </ul>
      </div>
    </nav>
  
    <main class="py-4">
      @yield('content')
    </main>
  
  </div>
  

  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>