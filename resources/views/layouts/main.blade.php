<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas de Vendas</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
    <div class="container-fluid container">
      <a class="navbar-brand" href="{{ route('vendas-index') }}">Sistemas de Vendas</a>
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="/create">Adicionar Produto</a>
        </li>
        @auth
            <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
            </li>
        @endauth

        @guest
            <li class="nav-item"><a class="nav-link" href="/register">Cadastrar</a></li>
            <li class="nav-item"><a class="nav-link" href="/login">Logar</a></li>
        @endguest
      </ul>
    </div>
  </nav>

<div class="container">
    <div class="bg-secondary text-light p-3 mt-4 rounded">
        <h2 class="display-4">
            @if(isset(Auth::user()->id) && Auth::user()->id == true)
                Olá {{Auth::user()->name}}!
            @else
                Sistemas de vendas
            @endif
        </h2>

    </div>
</div>
    @yield('content')

<!-- Script -->
<script src="/js/app.js"></script>

 <!-- Script do Bootstrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>