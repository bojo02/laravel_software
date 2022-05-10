<div>
<x-layouts.base>
    @slot('content')
    <h2>Създаване на поръчка</h2>

    <div id="shiroko" >
    <form method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Обект</label>
            <textarea id="object" value="{{ old('object') }}" name="object" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('object') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Продукт</label>
            <textarea id="product" value="{{ old('product') }}" name="product" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('product') }}</textarea>
        </div>
       
        <div class="form-group">
            <label for="formGroupExampleInput">Визия</label>
            <textarea id="vision" value="{{ old('vision') }}" name="vision" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('vision') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Медия</label>
            <textarea id="media" value="{{ old('media') }}" name="media" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('media') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Размери</label>
            <textarea id="size" value="{{ old('size') }}" name="size" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('size') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Брой</label>
            <textarea id="number" value="{{ old('number') }}" name="number" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('number') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Джобове</label>
            <textarea id="pockets" value="{{ old('pockets') }}" name="pockets" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('pockets') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Капси</label>
            <textarea id="eyelets" value="{{ old('eyelets') }}" name="eyelets" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('eyelets') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Ламинат</label>
            <textarea id="laminat" value="{{ old('laminat') }}" name="laminat" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('laminat') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="customFile">Файлове</label>
            <input value="{{ old('main_files') }}" name="main_files[]" multiple type="file" class="form-control" id="customFile" />
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Довършителни и дейности</label>
            <textarea id="term" value="{{ old('term') }}" name="term" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('term') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Описание за монтаж</label>
            <textarea id="install" value="{{ old('install') }}" name="install" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('install') }}</textarea>
        </div>
        <div id="area" class="form-group">
            <label for="formGroupExampleInput">Площ</label>
            <textarea id="area" value="{{ old('area') }}" name="area" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('area') }}</textarea>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Дизайн</label>
            <select name="design" id="designChoose" class="form-control form-control-lg">
                <option selected value="1">Да</option>
                <option value="2">Не</option>
            </select>
        </div>
        <div id="design_show">
        <div class="form-group">
            <label class="form-label" for="customFile">Файлове за дизайн</label>
            <input value="{{ old('design_files') }}" name="design_files[]" multiple type="file" class="form-control" id="customFile" />

            <div class="form-group">
            <label for="formGroupExampleInput">Бележка</label>
            <textarea id="design_description" value="{{ old('design_description') }}" name="design_description" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('design_description') }}</textarea>
        </div>
        </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Предпечат</label>
            <textarea id="preprint" value="{{ old('preprint') }}" name="preprint" type="text" class="form-control" id="formGroupExampleInput" placeholder="">{{ old('preprint') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="formGroupExampleInput">Имейл</label>
            <input value="{{ old('email') }}" name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Адрес</label>
            <input value="{{ old('address') }}" name="address" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Телефон</label>
            <input value="{{ old('phone') }}" name="phone" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Име /  Фирма</label>
            <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>
        <input type="hidden"name="format" value="1">
        <div class="form-group">
            <label for="formGroupExampleInput">Сума</label>
            <input value="{{ old('price') }}" name="price" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Изпрати към</label>
            <select name="format" class="form-control form-control-lg">
                <option value="2">Печатар</option>
                <option value="1">Дизайнер</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Създай</button>


        
        <br>
        <br>
    </form>
    </div>
    <script>  
$(document).ready(function(){

        $("#design_show").show();


    $('#designChoose').on('change', function() {
      if ( this.value == '1')
      {
        $("#design_show").show();
      }
      else
      {
        $("#design_show").hide();
      }
    });
});
</script>


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
                    $("#design_description").summernote();
                    $('.dropdown-toggle').dropdown();
                });
            </script>

    @endslot

</x-layouts.base>
</div>