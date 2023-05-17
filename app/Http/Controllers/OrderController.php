<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $totalMoney =  DB::table('orderdetail')->join('product', 'orderdetail.id_prod','=','product.id_prod')->select('orderdetail.id_order as id_order', DB::raw('sum(product.price * orderdetail.quantity) as totalMoney'))->groupBy('id_order');

        $orders = DB::table('order')->select('order.*','user.name as name', 'status.description as statusName', 'totalMoney.totalMoney')
        ->join('user','order.id_user','=','user.id_user')->join('status','order.id_status','=','status.id_status')
        ->joinSub($totalMoney,'totalMoney', function($join) {$join->on('totalMoney.id_order','=','order.id_order');
        })->orderBy('order.id_order', 'ASC')->get();

        return $orders;
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
        $order = new Order;
        if(!$request->id_user) return ['status'=>0,'message'=>'dont have id_user'];
        $order->id_user = $request->id_user;
        $order->id_status = 1;
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $order->save();
        return ['status'=>1,'message'=>'order created', 'data'=> $order];
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
        $request->validate([
            'id_status' => 'required'
        ]);
        $order = Order::find($id);
        $order->update($request->all());
        $order->save();
        
        return ['status'=>1,'message'=> 'order edited', 'prod' => $order];
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
}