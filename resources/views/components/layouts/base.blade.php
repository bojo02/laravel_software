<html>
    <head>
        <title>{{ $title ?? 'Admin panel' }}</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@if(Auth::user()->auto_refresh == 1)  
  <meta http-equiv="refresh" content="60;"> AutoRefresher
@endif
<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      @if(Auth::user()->role->slug == 'admin')
        <a class="navbar-brand" href="{{route('admin.orders')}}">Panel</a>
      @else
        <a class="navbar-brand" href="{{route('home')}}">Panel</a>
      @endif
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
      @if(Auth::user()->role->slug == 'admin')
        <a class="nav-link" href="{{route('admin.orders')}}">Начало</a>
      @else
        <a class="nav-link" href="{{route('home')}}">Начало</a>
      @endif
        
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.index')}}">Настройки</a>
        <!--{{route('user.edit', auth()->user()->id)}} -->
      </li>
      
    </ul>
    <h6 style="color:white;" class="nav-link mr-sm-2">Роля: {{ Auth::user()->role->name ?? 'Admin' }}</h6>
    
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Здравейте, {{ Auth::user()->name ?? 'Admin' }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('user.index')}}">Настройки</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('logout')}}">Излез</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

</div> 
     <!-- The sidebar -->
<div class="sidebar">
<br>
<br>
  @if(Auth::user()->role->slug == 'office')
  <a class="" href="{{route('expense.index')}}">Заявки</a>
  @endif
  @if(Auth::user()->role->slug != 'admin')
  <a class="" href="{{route('order.index')}}">Поръчки</a>
  @endif
  @if(Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'office')
  <a class="" href="{{route('order.create')}}">Създаване на поръчка</a>
  @endif
  @if(Auth::user()->role->slug == 'admin')
  <a class="" href="{{route('order.create')}}">Създаване на поръчка</a>
  <a class="" href="{{route('admin.orders')}}">Поръчки</a>
  <a class="" href="{{route('admin.users')}}">Потребители</a>
  <a class="" href="{{route('admin.new.user')}}">Нов потребител</a>
  <a class="" href="{{route('admin.invoices')}}">Фактури</a>
  <a class="" href="{{route('admin.cash-register')}}">Каса</a>
  <a class="" href="{{route('expense.index')}}">Заявки</a>
  @endif
  @if(Auth::user()->role->slug == 'designer' || Auth::user()->role->slug == 'printer' || Auth::user()->role->slug == 'lastprint' || Auth::user()->role->slug == 'lastdesign')
  <a class="" href="{{route('expense.create')}}">Създай заявка</a>
  @endif
  

</div>

<!-- Page content -->
<br>
<br>
<br>
<div class="content">
@foreach ($errors->all() as $error)
  <div class="alert alert-danger alert-dismissible fade show">
    {{ $error }}<br/>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </div>
@endforeach
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </div>
@endif
@if(session()->has('warning'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session()->get('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </div>
@endif

{!! $content !!}
</div> 
        

       
    </body>
</html>