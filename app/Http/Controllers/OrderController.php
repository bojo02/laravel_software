<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Photo;
use App\Models\Invoice;
use App\Models\Statuses;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\access_sales;
use App\Http\Middleware\designer;

class OrderController extends Controller
{
    public $paginate = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
            $this->middleware('access_sales', ['only' => ['store', 'create', 'edit']]);
            $this->middleware('admin', ['only' => ['destroy']]);
    }
        

        

    public function index()
    {
        if(Auth::user()->role->slug == 'designer'){
            $orders = Order::select('*')->where('status_id', '=', 1)->orWhere('status_id', '=', 4)->latest()->where('format_id', '=', 1)->simplePaginate(10);

            return view('components.orders', compact('orders'));
        }
        else if(Auth::user()->role->slug == 'installation_team'){
            $orders = Order::select('*')->where('status_id', '=', 8)->latest()->simplePaginate(10);

            return view('components.orders', compact('orders'));
        }
        else if(Auth::user()->role->slug == 'lastdesign'){

            $orders = Order::select('*')->where('status_id', '=', 5)->where('format_id', '=', 1)->latest()->simplePaginate(10);

            return view('components.orders', compact('orders'));
        }
        else if(Auth::user()->role->slug == 'printer'){
            $orders = Order::select('*')->where('status_id', '=', 2)->latest()->simplePaginate(10);

            return view('components.orders', compact('orders'));
        }
        else if(Auth::user()->role->slug == 'lastprint'){

            $orders = Order::select('*')->where('status_id', '=', 6)->where('format_id', '=', 2)->latest()->simplePaginate(10);

            return view('components.orders', compact('orders'));

        }
        $orders = Order::select('*')->where('status_id', '<=', '6')->where('status_id', '!=', '10')->where('role_id', '=', Auth::user()->role_id)->latest()->simplePaginate(10);

            return view('components.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.create-order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'email'=>'required|email|string|max:255',
        'main_files' => 'required',
        'price'=>'required',
        'product'=>'required',
        'vision'=>'required',
        'media'=>'required',
        'size'=>'required',
        'number'=>'required',
        'laminat'=>'required',
        'term'=>'required',
        'install'=>'required',
        'name'=>'required',
        'format'=>'required',
       
        ]);

        $order = Order::create([
            'role_id' => Auth::user()->role_id,
            'address' => $request->address,
            'object' => $request->object,
            'product' => $request->product,
            'vision' => $request->vision,
            'media' => $request->media,
            'design' => $request->design,
            'size' => $request->size,
            'number' => $request->number,
            'pockets' => $request->pockets,
            'eyelets' => $request->eyelets,
            'area' => $request->area,
            'laminat' => $request->laminat,
            'term' => $request->term,
            'design_description' => $request->design_description . '',
            'install_description' => $request->install,
            'preprint_description' => $request->preprint,
            'price' => $request->price,
            'name' => $request->name,
            'format_id' => $request->format,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->file('main_files')){
            foreach($request->file('main_files') as $key => $file)
            {
                $fileName = $file->getClientOriginalName() . date('d-m-Y-H-i'); 

                $file_path = $file->store('/public/files');

                $path = $file->move($file_path, $fileName);

                $pathfile =  '/' . $file_path . '/'. $fileName;

                $photo = Photo::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'type' => 'main',
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathfile
                ]);
            }
        }

        if ($request->file('design_files')){
            foreach($request->file('design_files') as $key => $file)
            {
                $fileName = $file->getClientOriginalName() . date('d-m-Y-H-i'); 

                $file_path = $file->store('/public/files');

                $path = $file->move($file_path, $fileName);

                $pathfile =  '/' . $file_path . '/'. $fileName;

                $photo = Photo::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'type' => 'design_file',
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathfile
                ]);
            }
        }
        

        if($request->format == 1){
            $this->updateStatus($order->id, '1');
        }
        else{
            $this->updateStatus($order->id, '2');
        }
        return redirect(route('order.show', ['order' => $order->id]))->with('message', 'Продуктът е добавен успешно!');
    
    }

    public function sendToPrinter($id){
        $order = Order::find($id);

        $this->updateStatus($order->id, '2');

        return redirect()->back()->with('message', 'Изпратено към печатар');
    }
    public function saveFile(Request $request, $id){
        $file_name = $request->file('file')->getClientOriginalName() . date('d-m-Y-H-i');
 
        $file_path = $request->file('file')->store('/public/files');

        $request->file('file')->move($file_path, $file_name);

        $pathfile =  '/' . $file_path . '/'. $file_name;

        $photo = Photo::create([
            'user_id' => Auth::user()->id,
            'order_id' => $id,
            'type' => 'main',
            'path' => $pathfile,
            'name' => $file_name
        ]);

        return redirect()->back()->with('message', 'Файлът е качен успешно!');
    }
    public function saveDesign(Request $request, $id){
        if ($request->file('designer_files')){
            foreach($request->file('designer_files') as $key => $file)
            {
                $fileName = $file->getClientOriginalName() . date('d-m-Y-H-i'); 

                $file_path = $file->store('/public/files');

                $path = $file->move($file_path, $fileName);

                $pathfile =  '/' . $file_path . '/'. $fileName;

                $photo = Photo::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $id,
                    'type' => 'gallery',
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathfile
                ]);
            }
        }

        return redirect()->back()->with('message', 'Файлът е качен успешно!');
    }

    private function updateStatus($id, $value){
        $order = Order::find($id);

        $order->status_id = $value;

        $order->save();
    }

    public function show($id)
    {
        $order = Order::find($id);

        $statuses = Statuses::all();

        $photo_gallery = Photo::all()->where('order_id', $id)->where('type', 'gallery');

        $photo_install = Photo::all()->where('order_id', $id)->where('type', 'install');

        $photo_main = Photo::all()->where('order_id', $id)->where('type', 'main');

        $photo_design = Photo::all()->where('order_id', $id)->where('type', 'design_file');

        return view('components.order-review', compact('order','photo_main','photo_gallery','photo_design','photo_install','statuses'));
    }

    public function edit($id)
    {
        $order = Order::find($id);

        if($order->status_id > 2 && Auth::user()->role->slug != 'admin'){
            return redirect()->back()->with('warning', 'Нямаш достъп до тази страница!');
        }

        $photo_gallery = Photo::all()->where('order_id', $id)->where('type', 'gallery');

        $photo_install = Photo::all()->where('order_id', $id)->where('type', 'install');

        $photo_main = Photo::all()->where('order_id', $id)->where('type', 'main');

        $photo_design = Photo::all()->where('order_id', $id)->where('type', 'design_file');

        return view('components.order-edit',compact('order','photo_main','photo_gallery','photo_design','photo_install'));
    }
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        
        $order->name = $request->name;

        $order->email = $request->email;

        $order->address = $request->address;

        $order->phone = $request->phone;

        $order->object = $request->object;

        $order->product = $request->product;

        $order->vision = $request->vision;

        $order->media = $request->media;

        $order->size = $request->size;

        $order->number = $request->number;

        $order->pockets = $request->pockets;

        $order->eyelets = $request->eyelets;

        $order->area = $request->area;

        $order->laminat = $request->laminat;

        $order->term = $request->term;

        $order->design = $request->design;

        $order->design_description = $request->design_description . '';

        $order->install_description = $request->install;

        $order->preprint_description = $request->preprint;

        $order->price = $request->price;

        $order->format_id = $request->format;

        $order->save();

        if ($request->file('main_files')){
            foreach($request->file('main_files') as $key => $file)
            {
                $fileName = $file->getClientOriginalName() . date('d-m-Y-H-i'); 

                $file_path = $file->store('/public/files');

                $path = $file->move($file_path, $fileName);

                $pathfile =  '/' . $file_path . '/'. $fileName;

                $photo = Photo::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'type' => 'main',
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathfile
                ]);
            }
        }

        if ($request->file('design_files')){
            foreach($request->file('design_files') as $key => $file)
            {
                $fileName = $file->getClientOriginalName() . date('d-m-Y-H-i'); 

                $file_path = $file->store('/public/files');

                $path = $file->move($file_path, $fileName);

                $pathfile =  '/' . $file_path . '/'. $fileName;

                $photo = Photo::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'type' => 'design_file',
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathfile
                ]);
            }
        }
        

        if($request->format == 1){
            $this->updateStatus($order->id, '1');
        }
        else{
            $this->updateStatus($order->id, '2');
        }

        return redirect()->back()->with('message', 'Поръчката е редактирана успешно!');
    }

    public function destroy($id)
    {
        $invoice = Invoice::all()->where('order_id', $id)->first();

        if($invoice != null){
            Invoice::destroy($invoice->id);
        }

         Order::destroy($id);

        if(Auth::user()->role->slug != 'admin'){
            return redirect(route('order.index'))->with('message', 'Поръчката е изтрита!');
        }
        else{
            return redirect(route('admin.orders'))->with('message', 'Поръчката е изтрита!');
        }
        
    }
    public function search(Request $request){
        //TODO
    }

    public function storeResultImage(Request $request, $id){

        $photo_name = $request->file('image')->getClientOriginalName() . date('d-m-Y-H-i');
 
        $photo_path = $request->file('image')->store('/images');

        $request->file('image')->move($photo_path, $photo_name);

        $pathimage =  '/' . $photo_path . '/'. $photo_name;

        $photo = Photo::create([
            'user_id' => Auth::user()->id,
            'order_id' => $id,
            'type' => 'gallery',
            'path' => $pathimage,
            'name' => $request->file('image')->getClientOriginalName(),
        ]);

        return redirect()->back()->with('message', 'Резултатът беше качен успешно!');
    }

    public function storeInstallImage(Request $request, $id){

        if ($request->file('install_files')){
            foreach($request->file('install_files') as $key => $file)
            {
                $fileName = $file->getClientOriginalName() . date('d-m-Y-H-i'); 

                $file_path = $file->store('/public/files');

                $path = $file->move($file_path, $fileName);

                $pathfile =  '/' . $file_path . '/'. $fileName;

                $photo = Photo::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $id,
                    'type' => 'install',
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathfile
                ]);
            }
        }

        return redirect()->back()->with('message', 'Резултатът беше качен успешно!');
    }
    public function review($id)
    {
        $this->updateStatus($id, '3');

        return redirect()->back()->with('message', 'Изпратено за одобрение!');
    }
    public function sendNewReview($id)
    {
        $this->updateStatus($id, '1');

        return redirect()->back()->with('message', 'Изпратено за повторен дизайн!');
    }
    public function designConfirm($id)
    {
        $this->updateStatus($id, '4');

        return redirect()->back()->with('message', 'Дизайнът е изпратен за последни доработки!');
    }
    public function lastDesign($id)
    {
        $this->updateStatus($id, '5');

        return redirect()->back()->with('message', 'Изпратено към довършителни!');
    }
    public function lastPrint($id)
    {
        $this->updateStatus($id, '6');

        return redirect()->back()->with('message', 'Изпратено към довършителни!');
    }
    public function sendToStorage($id){
        $order = Order::find($id);

        $order->status_id = 7;

        $order->in_stock = 1;

        $order->save();

        return redirect()->back()->with('message', 'Изпратено към склад!');
    }
    public function sendToInstall($id)
    {
        $order = Order::find($id);
        
        $order->delivery_id = 1;

        $order-> save();

        $this->updateStatus($id, '8');

        return redirect()->back()->with('message', 'Очакване на монтажна група!');
    }
    public function sendToClient($id)
    {
        $order = Order::find($id);

        $order->delivery_id = 2;

        $this->updateStatus($id, '9');

        return redirect()->back()->with('message', 'Изпратено за фактуриране!');
    }
    public function installReview($id)
    {
        $this->updateStatus($id, '9');

        return redirect()->back()->with('message', 'Изпратено за фактуриране!');
    }
    public function done(Request $request, $id){
        $invoice = 0;
        $request->validate([
            'finalprice' => 'required',
            ]);

        if(!$request->has('invoice')){
            $invoice = 0;
        }
        else{
            $request->invoice;
        }
        
        $order = Order::find($id);

        $order->status_id = 10;

        $order->in_stock = 0;

        $order->save();

        $invoice = Invoice::create([
            'number' => $invoice,
            'price' => $request->finalprice,
            'order_id' => $id,
            'payment_id' => $request->payment,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('message', 'Поръчката е приключена!');
    }
    public function searchOrders(Request $request){
        if($request->order_status == 1){

            $orders = Order::select('*')->where('status_id', '<=', '6')->where('status_id', '!=', '10')->where('role_id', '=', Auth::user()->role_id)->latest()->where('product', 'LIKE', "%{$request->search}%")->simplePaginate(10);
        }
        else if($request->order_status == 2){
            $orders = Order::select('*')->where('status_id', '=', '9')->where('role_id', '=', Auth::user()->role_id)->latest()->where('product', 'LIKE', "%{$request->search}%")->simplePaginate(10);
        }
        else if($request->order_status == 3){
            $orders = Order::select('*')->where('in_stock', '=', '1')->where('status_id', '!=', '10')->where('role_id', '=', Auth::user()->role_id)->latest()->where('product', 'LIKE', "%{$request->search}%")->simplePaginate(10);
        }
        else if($request->order_status == 4){
            $orders = Order::select('*')->where('status_id', '=', '10')->where('role_id', '=', Auth::user()->role_id)->latest()->where('product', 'LIKE', "%{$request->search}%")->simplePaginate(10);
        }

        return view('components.orders', compact('orders'));
    }
}
