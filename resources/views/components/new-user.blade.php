<div>
    <x-layouts.base>
        @slot('content')
        <form method="POST" action="{{route('admin.store.user')}}" enctype="multipart/form-data">
            @method('POST')
            @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput">Име</label>
                    <input value="{{old('name')}}" name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Имейл</label>
                    <input value="{{old('email')}}" name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Парола</label>
                    <input value="" name="password" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Роля</label>
                    <select name="role_id" class="form-control form-control-lg">
                        @foreach($roles as $role)
                            <option  value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            <button class="btn btn-success btn-lg" role="button">Запази</button>
        </form>
        @endslot
</x-layouts.base>
</div>