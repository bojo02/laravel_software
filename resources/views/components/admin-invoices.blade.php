<div>
    <x-layouts.base>
        @slot('content')

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <form method='get' action="{{route('admin.invoices.search')}}" class="form-inline my-2 my-lg-0">
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
                        <select name="payment" class="form-control form-control-lg">
                            <option value="1">Банка в брой</option>
                            <option value="2">Банков път</option>
                            <option value="3">В брой</option>
                        </select>
                    </div>
                    </li>
                   
                </ul>
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Номер на фактура" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Търси</button>
                </form>
            </div>
        </nav>


        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Номер</th>
                    <th scope="col">Крайна цена</th>
                    <th scope="col">Заглавие на поръчката</th>
                    <th scope="col">Начин на плащане</th>
                    <th scope="col">Създадено от</th>
                    <th scope="col">Преглед</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <th scope="row">{{$invoice->id}}</th>
                    <td>{{$invoice->number}}</td>
                    <td>{{$invoice->price}}лв.</td>
                    <td>{!!$invoice->order->product!!}</td>
                    <td>{{$invoice->payment->name}}</td>
                    <td>{{$invoice->user->name}}</td>
                    <form method="GET" action="{{route('admin.show.invoice', ['id' => $invoice->id])}}">
                        <td><button type="submit" class="btn btn-primary">Преглед</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        <ul class="pagination">

            <li class="page-item"><a class="page-link" href="{{ $invoices->nextPageUrl() }}">Напред</a></li>

            <li class="page-item"><a class="page-link" href="{{ $invoices->previousPageUrl() }}">Назад</a></li>  

        </ul>

        @endslot
    </x-layouts.base>
</div>