<div>
    <x-layouts.base>
        @slot('content')
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Име</th>
                    <th scope="col">Имейл</th>
                    <th scope="col">Роля</th>
                    <th scope="col">Преглед</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <form method="GET" action="{{route('admin.user', ['id' => $user->id])}}">
                        <td><button type="submit" class="btn btn-primary">Преглед</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        <ul class="pagination">

            <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}">Напред</a></li>

            <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}">Назад</a></li>  

        </ul>

        @endslot
    </x-layouts.base>
</div>