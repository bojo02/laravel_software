<div>
    <x-layouts.base>
        @slot('content')
            <h2>Създай заявка<h2>

            <form method="post", action="{{route('expense.store')}}">
                @METHOD('POST')
                @CSRF
                <div class="form-group">
                    <label for="formGroupExampleInput">Бележка</label>
                    <input name="note" type="text" class="form-control" id="note" placeholder="">
                </div>

                <button type="submit" class="btn btn-success">Създай</button>
            </form>
        @endslot
    </x-layouts.base>
</div>