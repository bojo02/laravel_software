<div>
    <x-layouts.base>
        @slot('content')

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <form method='get' action="{{route('admin.orders.search')}}" class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                    <div class="form-group">
                        <select name="old" class="form-control form-control-lg">
                            <option value="1">Най-нови</option>
                            <option value="2">Най-стари</option>
                        </select>
                    </div>
                    </li>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <div class="form-group">
                        <select name="status" class="form-control form-control-lg">
                          <option value="all">Всички</option>
                          @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    </li>
                   
                </ul>
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Заглавие" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Търси</button>
                </form>
            </div>
        </nav>
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Продукт</th>
      <th scope="col">Име / фирма</th>
      <th scope="col">Имейл</th>
      <th scope="col">В наличност</th>
      <th scope="col">Статус</th>
      <th scope="col">Преглед</th>
    </tr>
  </thead>
  <tbody>
      @forelse($orders as $order)
      <tr>
        <th scope="row">{{$order->id}}</th>
        <td><p>{!! $order->product !!}</p></td>
        <td>{{$order->name}}</td>
        <td>{{$order->email}}</td>
        @if($order->in_stock)
        <td>

        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
          <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
        </svg>

        </td>
        @else
        <td>

        <svg style="color:red;" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        <</svg>

        </td>
        @endif

        
        @if($order->status_id == 1 || $order->status_id == 2)
          <td><span style="color:white;" class="badge bg-success">{{$order->viewstatus->name}}</span></td>
        @endif
        @if($order->status_id == 3)
          <td><span style="color:white;" class="badge bg-warning">{{$order->viewstatus->name}}</span></td>
        @endif
        @if($order->status_id == 4)
          <td><span style="color:white;" class="badge bg-dark">{{$order->viewstatus->name}}</span></td>
        @endif
        @if($order->status_id == 5 || $order->status_id == 6)
          <td><span style="color:white;" class="badge bg-info">{{$order->viewstatus->name}}</span></td>
        @endif
        @if($order->status_id == 7 || $order->status_id == 8 || $order->status_id == 9)
          <td><span style="color:white;" class="badge bg-warning">{{$order->viewstatus->name}}</span></td>
        @endif
        @if($order->status_id == 10)
          <td><span style="color:white;" class="badge bg-danger">{{$order->viewstatus->name}}</span></td>
        @endif

        <form method="GET" action="{{route('order.show', ['order' => $order->id])}}">
          <td><button type="submit" class="btn btn-primary">Преглед</button></td>
      </form>
      
    </tr>
      @empty
       
        
      @endforelse
  </tbody>
</table>

        <ul class="pagination">

            <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">Напред</a></li>

            <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}">Назад</a></li>  

        </ul>
        @endslot
    </x-layouts.base>  
</div>