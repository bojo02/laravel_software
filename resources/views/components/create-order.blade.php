<div>
<x-layouts.base>
    @slot('content')
    <h2>Създаване на поръчка</h2>
    <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
        <label class="form-label" for="customFile">Качване на снимка</label>
        <input value="{{ old('image') }}" name="image" type="file" class="form-control" id="customFile" />

        <div class="form-group">
            <label for="formGroupExampleInput">Заглавие</label>
            <input value="{{ old('title') }}" name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Описание</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Имейл</label>
            <input value="{{ old('email') }}" name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        <div class="form-group">
            <label for="formGroupExampleInput">Телефон</label>
            <input value="{{ old('phone') }}" name="phone" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Име /  Фирма</label>
            <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Формат</label>
            <select name="format" class="form-control form-control-lg">
                <option value="2">Широко форматен</option>
                <option value="1">Дигитален формат</option>
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Сума</label>
            <input value="{{ old('price') }}" name="price" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        <button type="submit" class="btn btn-success">Изпрати</button>
    </form>
    @endslot

</x-layouts.base>
</div>