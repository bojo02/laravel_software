<div>
    <x-layouts.base>
       

        @slot('content')
        <p style="display:none;">{{$fullsum = 0}}</p>
        @foreach($invoices as $invoice)
            <p style="display:none;">{{$fullsum += $invoice->price}}</p>
        @endforeach
        <form method="GET" action="{{route('admin.cash-register')}}">
            <input name="start_date" type="date" data-provide="datepicker">
            <input name="end_date" type="date" data-provide="datepicker">
       
            <button type="submit" class="btn btn-success">Търси</button>
        </form>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Общ оборот</th>
                    <th scope="col">Всички фактури</th>
                </tr>
            </thead>
            <tbody>
                <th scope="col"><h3>{{$fullsum}}</h3></th>
                <form method="GET" action="{{route('admin.invoices.dates')}}">
                    <input name="start_date" type="hidden" value="{{$startDate ?? ''}}">
                    <input name="end_date" type="hidden" value="{{$endDate ?? ''}}">
                    <td><button type="submit" class="btn btn-primary">Преглед</button></td>
                </form>
            </tbody>
        </table>
        @endslot
    </x-layouts.base>
</div>