<div>
    <x-layouts.base>
        @slot('content')
        <div class="card">
            <div class="card-header">
                {{$expense->created_at}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$expense->user->name}}</h5>
                <p class="card-text">{!!$expense->note!!}</p>
                <form method="post", action="{{route('expense.update', ['expense' => $expense->id])}}">
                 @METHOD('PATCH')
                    @CSRF

                    @if($expense->status == 1)
                    <p class="card-text">Разход: {{$expense->price}}</p>
                    @else
                    <div class="form-group">
                        <label for="formGroupExampleInput">Разход по заявката(сума)</label>
                        <input name="price" type="text" class="form-control" id="note" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-success">Завърши</button>
                    @endif
                </form>

                @if(Auth::user()->role->slug == 'admin')
                        <form method="post", action="{{route('expense.destroy', ['expense' => $expense->id])}}">
                            @METHOD('DELETE')
                            @CSRF

                            <button type="submit" class="btn btn-danger">Изтрий</button>
                        </form>
                    @endif
            </div>
        </div>
        @endslot
    </x-layouts.base>
</div>