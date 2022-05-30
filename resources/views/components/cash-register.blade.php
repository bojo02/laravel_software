<div>
    <x-layouts.base>
       

        @slot('content')
        <p style="display:none;">{{$fullsum = 0}}</p>

        <p style="display:none;">{{$allsums = 0}}</p>

        <p style="display:none;">{{$fullsumwithout = 0}}</p>
       
        @foreach($invoices as $invoice)
            @if($invoice->payment_id != 3)
                <p style="display:none;">{{$fullsum += $invoice->price}}</p>
                @else
                <p style="display:none;">{{$fullsumwithout += $invoice->price}}</p>
            @endif
            <p style="display:none;">{{$allsums += $invoice->price}}</p>
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
                <th scope="col">Всички</th>
                    <th scope="col">Общ оборот без ДДС</th>
                    <th scope="col">Общ оборот с ДДС</th>
                    <th scope="col">Разход</th>
                    <th scope="col">Каса с разход</th>
                    <th scope="col">Каса без разход</th>
                    <th scope="col">Всички фактури</th>
                    <th scope="col">Всички разходи</th>
                </tr>
            </thead>
            <tbody>
            <th scope="col"><h3>{{$allsums}}лв.</h3></th>
                <th scope="col"><h3>{{$fullsum}}лв.</h3></th>
                <th scope="col"><h3>{{round($fullsum * 1.2,2)}}лв.</h3></th>
                <th scope="col"><h3>{{$fullexpense}}лв.</h3></th>
                <th scope="col"><h3>{{$fullsumwithout - $fullexpense}}лв.</h3></th>
                <th scope="col"><h3>{{$fullsumwithout}}лв.</h3></th>
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