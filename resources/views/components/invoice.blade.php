<div>
    <x-layouts.base>
        @slot('content')
        <div class="card">
            <div style="text-align:center;" class="card-header">
                <p>Фактура: {{$invoice->id}}</p>
                Номер на фактура: {{$invoice->number}}
            </div>
            <div style="text-align:center;" class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Заглавие на поръчката:</p>
                    <p>{!! $invoice->order->product !!}</p>
                    <hr>
                    <p>Име / Фирма: </p>
                    <p>{{$invoice->order->name}}</p>
                    <hr>
                    <p>Първоначална оферта: {{$invoice->order->price}}лв.</p>
                    <hr>
                    <p>Крайна цена: {{$invoice->price}}лв.</p>
                    <hr>
                    @if($invoice->payment_id != 3)
                    <p>Крайна цена с ДДС: {{round($invoice->price * 1.2,2)}}лв.</p>
                    @endif
                    <footer class="blockquote-footer">
                        <form method="GET" action="{{route('order.show', ['order' => $invoice->order->id])}}">
                            <button type="submit" class="btn btn-primary">Преглед на поръчката</button>
                        </form>
                    </footer>
                </blockquote>
            </div>
            @if(Auth::user()->role->slug == 'admin')
            <form action="{{route('admin.destroy.invoice', ['id' => $invoice->id])}}" method="POST">
            @method('POST')
            @csrf
            <button class="btn btn-danger btn-lg" role="button">Изтриване</button> 
          </form>
          @endif
        </div>
       
        @endslot
    </x-layouts.base>
</div>