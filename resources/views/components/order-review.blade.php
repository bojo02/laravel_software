<div>
    <x-layouts.base>
        @slot('content')
        <!-- Modal -->



        @if(!empty($photo_gallery))
        @foreach($photo_gallery as $image)
        <div class="modal fade " id="a{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <img src="{{$image->path}}" id="image_review" class="rounded mx-auto d-block" alt="Responsive image">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif

        @if(!empty($photo_main))
        @foreach($photo_main as $image)
        <div class="modal fade " id="a{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <img src="{{$image->path}}" id="image_review" class="rounded mx-auto d-block" alt="Responsive image">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif




        <div class="jumbotron">
          <h1 class="display-4 d-flex justify-content-center">{{$order->title}}</h1>
          <p class="d-flex justify-content-center"> 
            @if($order->status_id == 1 || $order->status_id == 2)
          <span style="color:white;" class="badge bg-success">{{$order->viewstatus->name}}</span>
        @endif
        @if($order->status_id == 3)
          <span style="color:white;" class="badge bg-warning">{{$order->viewstatus->name}}</span>
        @endif
        @if($order->status_id == 4)
          <span style="color:white;" class="badge bg-dark">{{$order->viewstatus->name}}</span>
        @endif
        @if($order->status_id == 5 || $order->status_id == 6)
          <span style="color:white;" class="badge bg-info">{{$order->viewstatus->name}}</span>
        @endif
        @if($order->status_id == 7 || $order->status_id == 8 || $order->status_id == 9)
          <span style="color:white;" class="badge bg-warning">{{$order->viewstatus->name}}</span>
        @endif
        @if($order->status_id == 10)
          <span style="color:white;" class="badge bg-danger">{{$order->viewstatus->name}}</span>
        @endif
        </p>
          <hr class="my-4">
          <h3>Описание:<h3><br><p class="lead">{{$order->description}}</p>
          @if((Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'office' || Auth::user()->role->slug == 'admin'))
          <hr class="my-4">
          <h4>Име / Фирма: {{$order->name}}</h4>
          <hr class="my-4">
          <h4>Имейл: {{$order->email}}</h4>
          <hr class="my-4">
          <h4>Телефон: {{$order->phone}}</h4>
          <hr class="my-4">
          <h4>Договорена сума: {{$order->price}}</h4>
          @endif
          <hr class="my-4">
          <h4>Формат: {{$order->format->name}}</h4>
          <hr class="my-4">
          <h4>Ориентировъчен дизайн:</h4>
          <!-- <img src="{{$order->photo}}" class="rounded mx-auto d-block" alt="Responsive image"> -->
          @if(!empty($photo_main))
          @foreach($photo_main as $image)
          <div ng-repeat="post in posts | orderBy:'+':true">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body line-break">
                  <div class="row small-gap-row-below">
                    <div class="col-md-1">
                      <img id="{{$image->path}}" src='{{$image->path}}'
                          alt="Очакване на дизайн" class="img-responsive img-rounded"
                          style="max-height: 300px; max-width: 300px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a{{$image->id}}">
          Голям екран
        </button> 
        <a href="{{$image->path}}" download="{{$image->path}}">Изгегли</a>
        <br>
        @endforeach
        @endif

        <hr class="my-4">
          <h4>Краен резултат:</h4>
          @if(!empty($photo_gallery))
          @foreach($photo_gallery as $image)
          <div ng-repeat="post in posts | orderBy:'+':true">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body line-break">
                  <div class="row small-gap-row-below">
                    <div class="col-md-1">
                      <img id="image_review" src='{{$image->path}}'
                          alt="Очакване на дизайн" class="img-responsive img-rounded"
                          style="max-height: 300px; max-width: 300px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a{{$image->id}}">
          Голям екран
        </button>
        <a href="{{$image->path}}" download="{{$image->path}}">Изгегли</a>
        <br>
        <br>
        @endforeach
        @endif
        @if(Auth::user()->role->slug == 'designer')
          <form method="POST" action="{{route('order.storeResultImage', ['id' => $order->id])}}" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <label class="form-label" for="customFile">Качване на снимка</label>
            <input name="image" type="file" class="form-control" id="customFile" />
            <br>
            <button type="submit" class="btn btn-success">Качи</button>
        </form>
        @endif
        <hr class="my-4">

        <h4>Бележки: </h4>
        @foreach($order->notes as $note)
        <div class="card" style="width: 100%;">
          <div class="card-header">
          {{ $note->user->name }} - {{$note->created_at}}
          </div>
        
          <ul class="list-group list-group-flush">
        
            <li class="list-group-item">{!! $note->content !!}<span>
              @if(Auth::user()->id == $note->user_id)
            <form action="{{route('note.destroy', ['note' => $note->id])}}" method="POST">
            @method('DELETE')
            @csrf
            <!-- <button class="btn btn-danger btn-lg" role="button">Изтриване</button> -->
          </form>
          @endif</span></li>
            
          </ul>
          
        </div>
        @endforeach
        <hr class="my-4">

            <!-- Summernote CSS - CDN Link -->
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
            <!-- //Summernote CSS - CDN Link -->
           
            <form action="{{route('note.store')}}" method="POST">
              @csrf
              @method('POST')
              <input name="order_id" type="hidden" value="{{$order->id}}">
              <textarea name="content" id="your_summernote" class="form-control" rows="4"></textarea>
              <br>
              <button type="submit" class="btn btn-primary">Добави бележка</button>
            </form>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js""></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Summernote JS - CDN Link -->
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#your_summernote").summernote();
                    $('.dropdown-toggle').dropdown();
                });
            </script>


        <hr class="my-4">
          <hr class="my-4">
          <h3>Създадено от: {{$order->user->name}} - {{$order->created_at }}</h3>
          <hr class="my-4">
          <p class="lead">
          @if(Auth::user()->role->slug == 'admin')
          <form action="{{route('admin.change.status', ['id' => $order->id])}}" method="POST">
            @method('POST')
              @csrf
            <div class="form-group">
              <select name="status_id" class="form-control form-control-lg">
              @foreach($statuses as $status)
                @if($status->id == $order->viewstatus->id)
                  <option selected="selected" value="{{$status->id}}">{{$status->name}}</option>
                @else
                  <option value="{{$status->id}}">{{$status->name}}</option>
                @endif       
              @endforeach
              </select>
            </div>
              <button class="btn btn-info btn-lg" role="button">Смени статус</button>
            </form>
            <form action="{{route('order.destroy', ['order' => $order->id])}}" method="POST">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger btn-lg" role="button">Изтриване</button>
            </form>
          @endif
          @if(Auth::user()->role->slug == 'designer' && $order->status_id == 1)
          <form action="{{route('order.review', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-info btn-lg" role="button">Изпрати за одобрение</button>
          </form>
          @endif
          @if(Auth::user()->role->slug == 'designer' && $order->status_id == 4)
          <form action="{{route('order.lastDesign', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Изпрати към довършителни дигитални</button>
          </form>
          @endif
          @if(Auth::user()->role->slug == 'lastdesign' && $order->status_id == 5)
          <form action="{{route('order.sendToStorage', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Изпрати към склад</button>
          </form>
          @endif
          @if(Auth::user()->role->slug == 'lastprint' && $order->status_id == 6)
          <form action="{{route('order.sendToStorage', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Изпрати към склад</button>
          </form>
          @endif
          @if(Auth::user()->role->slug == 'installation_team' && $order->status_id == 8)
          <form action="{{route('order.installReview', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Готово</button>
          </form>
          @endif
          
          @if(Auth::user()->role->slug == 'printer' && $order->status_id == 2)
          <form action="{{route('order.lastPrint', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Изпрати към довършителни Широкоформатни</button>
          </form>
          @endif
          @if((Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'office') && $order->status_id == 3)
          <form action="{{route('order.sendNewReview', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-info btn-lg" role="button">Изпрати за нов дизайн</button>
          </form>
          @endif
          @if((Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'office') && $order->status_id == 3)
          <form action="{{route('order.designConfirm', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Одобряване на дизайн</button>
          </form>
          @endif
          @if((Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'office') && $order->status_id == 9)
          <form action="{{route('order.sendToStorage', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-danger btn-lg" role="button">Върни назад</button>
          </form>
          @endif
          @if((Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'office') && ($order->status_id == 9 ||$order->status_id == 10))
          <form action="{{route('order.done', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <div class="form-group">
            <label for="formGroupExampleInput">Начин на плащане</label>
            <select onchange="yesnoCheck(this);" name="payment" class="form-control form-control-lg">
                <option value="1">Банка в брой</option>
                <option value="2">Банков път</option>
                <option value="3">В брой</option>
            </select>
            <div class="form-group">
              <div id="invoicing">
                <label for="formGroupExampleInput">Номер на фактура</label>
              <input value="{{ old('invoice') }}" name="invoice" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
              </div>
              <label for="formGroupExampleInput">Крайна цена</label>
              <input value="{{ old('finalprice') }}" name="finalprice" type="text" class="form-control" id="formGroupExampleInput" placeholder="">
          </div>
        </div>
              <button class="btn btn-success btn-lg" role="button">Завърши</button>
          </form>
          @endif
          @if((Auth::user()->role->slug == 'account' || Auth::user()->role->slug == 'sales' || Auth::user()->role->slug == 'office') && $order->status_id == 7 )
          <form action="{{route('order.sendToClient', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-success btn-lg" role="button">Предаване на клиента</button>
          </form>
          <form action="{{route('order.sendToInstall', ['id' => $order->id])}}" method="get">
              @method('get')
              @csrf
              <button class="btn btn-info btn-lg" role="button">Предай за монтаж</button>
          </form>
          @endif
          </p>
        </div>

        <script>
          function yesnoCheck(that) {
            if (that.value == "2") {
              document.getElementById("invoicing").style.display = "block";
            } else if (that.value == "2") {
              document.getElementById("invoicing").style.display = "block";
            }
            else{
              document.getElementById("invoicing").style.display = "none";
            }
          }
        </script>

        @endslot 
    </x-layouts.base>
</div>