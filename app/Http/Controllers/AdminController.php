<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Statuses;
use App\Models\Expense;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AdminAccess;


class AdminController extends Controller
{
    public function __construct()
    {
            $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function users(){

        $users = User::select('*')->latest()->simplePaginate(10);

        return view('components.all-users', compact('users'));
    }
    public function changeStatus(Request $request, $id){

        $order = Order::find($id);

        $order->status_id = $request->status_id;

        $order->save();

        return redirect()->back()->with('message', 'Статусът е променен успешно!');
    }
    public function user($id){

        $user = User::find($id);

        $roles = Role::all();

        return view('components.admin-user-edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, $id){
        $user = User::find($id);

        $user->name = $request->name;

        $user->email = $request->email;

        $user->role_id = $request->role_id;

        $user->save();

        $roles = Role::all();

        return redirect()->back()->with('message', 'Потребителят е презаписан успешно!');
    }

    public function userPasswordUpdate(Request $request, $id){
        $user = User::find($id);

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('message', 'Паролата е променена!');
    }
    public function newUser()
    {
        $roles = Role::all();

        return view('components.new-user', compact('roles'));
    }
    public function storeUser(Request $request){
        $request->validate([
            'name'=>'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:8',
           
            ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        $roles = Role::all();

        return view('components.admin-user-edit', compact('user', 'roles'))->with('message', 'Потребителят беше създаден успешно!');
    }
    public function allOrders(){
        $orders = Order::select('*')->latest()->simplePaginate(10);

        $statuses = Statuses::all();

        return view('components.admin-all-orders', compact('orders', 'statuses'))->with('message', 'Потребителят беше създаден успешно!');
    }
    public function allInvoices(){

        $invoices = Invoice::select('*')->latest()->simplePaginate(10);

        return view('components.admin-invoices', compact('invoices'));
    }
    public function searchInvoices(Request $request){

            if($request->old == 1){

                $invoices = Invoice::select('*')->where('payment_id', $request->payment)->latest()->where('number', 'LIKE', "%{$request->search}%")->simplePaginate(10);
            }
            else{

                $invoices = Invoice::select('*')->where('payment_id', $request->payment)->where('number', 'LIKE', "%{$request->search}%")->simplePaginate(10);
            }
            return view('components.admin-invoices', compact('invoices'));
    }
    public function searchOrders(Request $request){

        if($request->old == 1){

            $orders = Order::select('*')->where('status_id', $request->status)->latest()->where('title', 'LIKE', "%{$request->search}%")->simplePaginate(10);
        }
        else{

            $orders = Order::select('*')->where('status_id', $request->status)->where('title', 'LIKE', "%{$request->search}%")->simplePaginate(10);
        }
        $statuses = Statuses::all();

        return view('components.admin-all-orders', compact('orders', 'statuses'));
    }

    public function cashRegister(Request $request){
        if($request->has('start_date')){
            $startDate = $request->start_date;
            $endDate = $request->end_date;
    
            $invoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->get();

            $expenses = Expense::whereBetween('created_at', [$startDate, $endDate])->where('status', '=', '1')->get();

            return view('components.cash-register', compact('invoices','expenses', 'startDate', 'endDate'));
        }
        else{
            $invoices = Invoice::all();

            $expenses = Expense::select('*')->where('status', '=', '1')->get();

            return view('components.cash-register', compact('invoices', 'expenses'));
        }
    }

    public function invoicesDates(Request $request){
        if($request->start_date != ''){
            $startDate = $request->start_date;
            $endDate = $request->end_date;
    
            $invoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->simplePaginate(10);

            return view('components.admin-invoices', compact('invoices'));
        }
        else{
            $invoices = Invoice::select('*')->simplePaginate(10);

            return view('components.admin-invoices', compact('invoices'));
        }
    }
    public function expensesDates(Request $request){

        if($request->start_date != ''){
            $startDate = $request->start_date;
            $endDate = $request->end_date;
    
            $expenses = Expense::whereBetween('created_at', [$startDate, $endDate])->simplePaginate(10);

            return view('components.expense-index', compact('expenses'));
        }
        else{
            $expenses = Expense::select('*')->simplePaginate(10);

            return view('components.expense-index', compact('expenses'));
        }
    }

    public function invoiceShow($id){

        $invoice = Invoice::find($id);

        return view('components.invoice', compact('invoice'));
    }
}
