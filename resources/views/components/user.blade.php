<div>
<x-layouts.base>
    @slot('content')

    <p></p>
    <h2>Настройки на протребителя</h2>

    <h5>Текуща роля: {{Auth::user()->role->name}}</h5>

    <form method="POST" action="{{route('user.update', auth()->user()->id)}}">

    @method('PATCH')
    @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Промяна на имейл адрес</label>
            <input name="email" value="{{$user->email}}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            
        </div>
        <div class="form-group">
        <button type="button" class="btn btn-info">Промяна на парола</button>
        </div>
            <h4>Автоманично презареждане на страниците през 1 минута</h4>
        <div class="form-check">
            <input value="1" class="form-check-input" type="radio" name="autorefresh" id="flexRadioDefault1" @if(Auth::user()->auto_refresh == 1) checked @endif>
            <label class="form-check-label" for="flexRadioDefault1"  >
                Позволи
            </label>
        </div>
        <div class="form-check">
            <input value="0" class="form-check-input" type="radio" name="autorefresh" id="flexRadioDefault2" @if(Auth::user()->auto_refresh == 0) checked @endif>
            <label class="form-check-label" for="flexRadioDefault2">
                Забрани
            </label>
        </div>
        <p></p>
        <button type="submit" class="btn btn-primary">Запази</button>
        
    </form>


    @endslot

    @slot('name')
        {{$user->name}}
    @endslot
</x-layouts.base>
</div>