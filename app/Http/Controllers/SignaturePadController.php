<?php

  

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;
use App\Models\Order;
  

class SignaturePadController extends Controller

{

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index($id)
    {

        return view('components.signature',compact('id'));

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function uploadSignature(Request $request)

    {

        $order = Order::find($request->id);



        $folderPath = public_path('upload/signatures/');

        

        $image_parts = explode(";base64,", $request->signed);

              

        $image_type_aux = explode("image/", $image_parts[0]);

           

        $image_type = $image_type_aux[1];

           

        $image_base64 = base64_decode($image_parts[1]);

           $name = uniqid() . '.'.$image_type;

        $file = $folderPath . $name;

        file_put_contents($file, $image_base64);

        $order->signature = '/upload/signatures/' . $name;

        $order->save();

        return redirect(route('order.show', ['order' => $request->id]))->with('message', 'Подписът е запаметен успешно!');

    }


}