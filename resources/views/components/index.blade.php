<div>
<x-layouts.base>
    @slot('content')
        Working...
    @endslot

    @slot('name')
        {{$user->name}}
    @endslot
</x-layouts.base>
</div>