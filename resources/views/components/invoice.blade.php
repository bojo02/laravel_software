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
                    <p>{{$invoice->order->title}}</p>
                    <hr>
                    <p>Описание на поръчката: </p>
                    <p>{{$invoice->order->description}}</p>
                    <hr>
                    <p>Първоначалта оферта: {{$invoice->order->price}}</p>
                    <hr>
                    <p>Крайна цена: {{$invoice->price}}</p>
                    <footer class="blockquote-footer">
                        <form method="GET" action="{{route('order.show', ['order' => $invoice->order->id])}}">
                            <button type="submit" class="btn btn-primary">Преглед на поръчката</button>
                        </form>
                    </footer>
                </blockquote>
            </div>
        </div>
        @endslot
    </x-layouts.base>
</div>