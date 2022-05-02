<div>
<x-layouts.base>
    @slot('content')
    <h2>Редактиране на поръчка</h2>

    <div id="shiroko" >
    <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Обект</label>
            <textarea id="object" value="{{ old('object') }}" name="object" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->object }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Продукт</label>
            <textarea id="product" value="{{ old('product') }}" name="product" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->product }}</textarea>
        </div>
       
        <div class="form-group">
            <label for="formGroupExampleInput">Визия</label>
            <textarea id="vision" value="{{ old('vision') }}" name="vision" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->vision }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Медия</label>
            <textarea id="media" value="{{ old('media') }}" name="media" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->media }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Размери</label>
            <textarea id="size" value="{{ old('size') }}" name="size" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->size }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Брой</label>
            <textarea id="number" value="{{ old('number') }}" name="number" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->number }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Джобове</label>
            <textarea id="pockets" value="{{ old('pockets') }}" name="pockets" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->pockets }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Капси</label>
            <textarea id="eyelets" value="{{ old('eyelets') }}" name="eyelets" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->eyelets }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Ламинат</label>
            <textarea id="laminat" value="{{ old('laminat') }}" name="laminat" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->laminat }}</textarea>
        </div>
        @foreach($photo_main as $file)
           <a href="{{$file->path}}" download>{{$file->name}}</a><br>
          @endforeach
          </h4>
          @if(Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'office')
          <form method="POST" action="{{route('order.store.file', ['id' => $order->id])}}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <label class="form-label" for="customFile">Качване на файл</label>
            <input name="file" type="file" class="form-control" id="customFile" />
            <br>
            <button type="submit" class="btn btn-success">Качи</button>
        </form>
        @endif
        <div class="form-group">
            <label for="formGroupExampleInput">Довършителни и дейности</label>
            <textarea id="term" value="{{ old('term') }}" name="term" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->term }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Описание за монтаж</label>
            <textarea id="install" value="{{ old('install') }}" name="install" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->install_description }}</textarea>
        </div>
        <div id="area" class="form-group">
            <label for="formGroupExampleInput">Площ</label>
            <textarea id="area" value="{{ old('area') }}" name="area" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->area }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Дизайн</label>
            <select name="design" class="form-control form-control-lg">
            @if($order->design == 1) 
                <option  selected value="1">Да</option>
                <option value="2">Не</option>
                @else
                <option  value="1">Да</option>
                <option selected value="2">Не</option>
            @endif
                
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Предпечат</label>
            <textarea id="preprint" name="preprint" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ $order->preprint_description }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="formGroupExampleInput">Имейл</label>
            <input name="email" type="text" class="form-control" value="{{ $order->email }}" id="formGroupExampleInput" placeholder="">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Адрес</label>
            <input name="address" type="text" class="form-control" value="{{ $order->address }}" id="formGroupExampleInput" placeholder="">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Телефон</label>
            <input name="phone" type="text" class="form-control" value="{{ $order->phone }}" id="formGroupExampleInput" placeholder="">
        
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Име /  Фирма</label>
            <input name="name" type="text" class="form-control" value="{{ $order->name }}" id="formGroupExampleInput" placeholder="">
        </div>
        <input type="hidden"name="format" value="1">
        <div class="form-group">
            <label for="formGroupExampleInput">Сума</label>
            <input name="price" type="text" value="{{ $order->price }}" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Изпрати към</label>
            <select name="format" class="form-control form-control-lg">
                <option value="2">Печатар</option>
                <option value="1">Дизайнер</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Запази</button>
        <br>
        <br>
    </form>
    </div>

     <!-- Summernote CSS - CDN Link -->
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
            <!-- //Summernote CSS - CDN Link -->

              
              
            <script src="https://code.jquery.com/jquery-3.6.0.min.js""></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Summernote JS - CDN Link -->
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#object").summernote();
                    $("#vision").summernote();
                    $("#product").summernote();
                    $("#media").summernote();
                    $("#size").summernote();
                    $("#number").summernote();
                    $("#pockets").summernote();
                    $("#eyelets").summernote();
                    $("#area").summernote();
                    $("#laminat").summernote();
                    $("#term").summernote();
                    $("#install").summernote();
                    $('.dropdown-toggle').dropdown();
                });
            </script>

    @endslot

</x-layouts.base>
</div>