<div>
    <x-layouts.base>
        @slot('content')
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Заглавие</th>
                    <th scope="col">Потребител</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Преглед</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr>
                    <th scope="row">{{$expense->id}}</th>
                    <td>{!! $expense->note !!}</td>
                    <td>{{$expense->user->name}}</td>
                    @if($expense->status == 0)
                        <td><span style="color:white;" class="badge bg-success">Нова</span></td>
                    @else
                    <td><span style="color:white;" class="badge bg-danger">Завършена</span></td>
                    @endif
                    <form method="GET" action="{{route('expense.show', ['expense' => $expense->id])}}">
                        <td><button type="submit" class="btn btn-primary">Преглед</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        <ul class="pagination">

            <li class="page-item"><a class="page-link" href="{{ $expenses->nextPageUrl() }}">Напред</a></li>

            <li class="page-item"><a class="page-link" href="{{ $expenses->previousPageUrl() }}">Назад</a></li>  

        </ul>
        @endslot
    </x-layouts.base>
</div>