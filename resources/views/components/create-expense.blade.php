<div>
    <x-layouts.base>
        @slot('content')
            <h2>Създай заявка<h2>

            <form method="post", action="{{route('expense.store')}}">
                @METHOD('POST')
                @CSRF
                <div class="form-group">
                    <label for="formGroupExampleInput">Бележка</label>
                    <textarea id="expense" value="{{ old('size') }}" name="note" type="text" class="form-control" id="formGroupExampleInput" placeholder=""></textarea>
                </div>

                <button type="submit" class="btn btn-success">Създай</button>
            </form>

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
                    $("#expense").summernote();
                    $('.dropdown-toggle').dropdown();
                });
            </script>
        @endslot
    </x-layouts.base>
</div>