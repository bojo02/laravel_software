<div>
    <x-layouts.base>
       

        @slot('content')
        <p style="display:none;">{{$fullsum = 0}}</p>
        @foreach($invoices as $invoice)
            <p style="display:none;">{{$fullsum += $invoice->price}}</p>
        @endforeach
        <p style="display:none;">{{$fullexpense = 0}}</p>
        @foreach($expenses as $expense)
            <p style="display:none;">{{$fullexpense += $expense->price}}</p>
        @endforeach
        <div class="d-inline p-2" style ='float: left; padding: 5px;'">
        <span>
            <form method="GET" action="{{route('admin.cash-register')}}">
            <input name="start_date" type="date" data-provide="datepicker">
            <input name="end_date" type="date" data-provide="datepicker">
       
            <button type="submit" class="btn btn-success">Търси</button>
            </form>
        </span>
        </div>
        <div class="d-inline p-2" style ='float: left; padding: 5px;'">
        <form method="GET" action="{{route('admin.cash-register')}}">
            <input type="hidden" id="date_1" name="start_date" type="date" data-provide="datepicker" value="{{ date('Y-m-d') }}">
            <input type="hidden" id="date_2" name="end_date" type="date" data-provide="datepicker" value="{{ date('Y-m-d', strtotime( '+1 days' ) )}}">
               
            <button type="submit" class="btn btn-success">днес</button>
        </form>
        </div>
        <div class="d-inline p-2" style ='float: left; padding: 5px;'">
        <form method="GET" action="{{route('admin.cash-register')}}">
            <input type="hidden" id="date_1" name="start_date" type="date" data-provide="datepicker" value="{{ date('Y-m-d', strtotime( '-1 days' )) }}">
            <input type="hidden" id="date_2" name="end_date" type="date" data-provide="datepicker" value="{{ date('Y-m-d')}}">
               
            <button type="submit" class="btn btn-success">Вчера</button>
        </form>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Общ оборот</th>
                    <th scope="col">Общ разход</th>
                    <th scope="col">Каса</th>
                    <th scope="col">Всички фактури</th>
                    <th scope="col">Всички разходи</th>
                </tr>
            </thead>
            <tbody>
                <th scope="col"><h3>{{$fullsum}}</h3></th>
                <th scope="col"><h3>{{$fullexpense}}</h3></th>
                <th scope="col"><h3>{{$fullsum - $fullexpense}}</h3></th>
                <form method="GET" action="{{route('admin.invoices.dates')}}">
                    <input name="start_date" type="hidden" value="{{$startDate ?? ''}}">
                    <input name="end_date" type="hidden" value="{{$endDate ?? ''}}">
                    <td><button type="submit" class="btn btn-primary">Преглед</button></td>
                </form>
                <form method="GET" action="{{route('admin.expenses.dates')}}">
                    <input name="start_date" type="hidden" value="{{$startDate ?? ''}}">
                    <input name="end_date" type="hidden" value="{{$endDate ?? ''}}">
                    <td><button type="submit" class="btn btn-primary">Преглед</button></td>
                </form>
            </tbody>
        </table>
        @endslot
    </x-layouts.base>
</div>