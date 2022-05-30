<div>
    <x-layouts.base>
        @slot('content')
     
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://keith-wood.name/js/jquery.signature.js"></script>

  



  

    <style>
html, body {margin: 0; height: 100%; overflow: hidden}
        .kbw-signature { width: 100%; height: 200px;}

        #sig canvas{

            width: 100% !important;

            height: auto;

        }
      /* Styles for signature plugin v1.2.0. */
.kbw-signature {
	display: inline-block;
	border: 1px solid #a0a0a0;
	-ms-touch-action: none;
}
.kbw-signature-disabled {
	opacity: 0.35;
}


    </style>
        <div class="container">

<div class="row">

    <div class="col-md-6 offset-md-3 mt-5">

        <div class="card">

            <div class="card-header">

                <h2>Подпис</h2>

            </div>

            <div class="card-body">

                 @if ($message = Session::get('success'))

                     <div class="alert alert-success  alert-dismissible">

                         <button type="button" class="close" data-dismiss="alert">×</button>  

                         <strong>{{ $message }}</strong>

                     </div>

                 @endif

                 <form method="POST" action="{{ route('store.signature') }}">

                     @csrf

                     <div class="col-md-12">

                         <label class="" for=""></label>

                         <br/>

                         <div id="sig" ></div>

                         <br/>
                         <br>

                         <input type="hidden" name="id" value="{{$id}}">

                         <button id="clear" class="btn btn-danger btn-sm">Изчисти</button>

                         <textarea id="signature64" name="signed" style="display: none"></textarea>

                     </div>

                     <br/>

                     <button class="btn btn-success">Запази</button>

                 </form>

            </div>

        </div>

    </div>

</div>

</div>

<script type="text/javascript">

 var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});

 $('#clear').click(function(e) {

     e.preventDefault();

     sig.signature('clear');

     $("#signature64").val('');

 });

 

</script>

        @endslot
    </x-layouts.base>
</div>