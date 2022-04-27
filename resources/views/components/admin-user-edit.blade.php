<div>
    <x-layouts.base>
        @slot('content')
        <form method="POST" action="{{route('admin.userUpdate', ['id' => $user->id])}}" enctype="multipart/form-data">
            @method('POST')
            @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput">Име</label>
                    <input value="{{$user->name}}" name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Имейл</label>
                    <input value="{{$user->email}}" name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Роля</label>
                    <select name="role_id" class="form-control form-control-lg">
                        @foreach($roles as $role)
                            @if($role->slug == $user->role->slug)
                                <option selected="selected" value="{{$role->id}}">{{$role->name}}</option>
                            @else
                                <option  value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <button class="btn btn-success btn-lg" role="button">Запази</button>
        </form>
        <form method="POST" action="{{route('admin.user.password.pdate', ['id' => $user->id])}}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="formGroupExampleInput">Нова парола</label>
                <input value="" name="password" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
            </div>

            <button class="btn btn-info btn-lg" role="button">Смени</button>
        </form>
        @endslot
    </x-layouts.base>
</div>