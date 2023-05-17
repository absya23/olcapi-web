<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return OrderDetail::all();
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
        // id_user, id_prod, quantity
         //

        //
        // $orderDe = new OrderDetail;
        // if(!$request->id_order || !$request->id_prod || !$request->quantity) return ['status'=>0,'message'=>'thiếu 1 trong 3 trường id_order, id_prod, quantity'];
        // $orderDe->id_order = $request->id_order;
        // $orderDe->id_prod = $request->id_prod;
        // $orderDe->quantity = $request->quantity;

        // $orderDe->save();
        // return ['status'=>1,'message'=>'orderdetail created', 'data'=> $orderDe];
        $id_order = $request->id_order;
        $data = json_decode($request->data, true);
        foreach($data as $item) {
            // return ['data'=>$item["id_prod"]];
            $orderDe = new OrderDetail;
            $orderDe->id_order = (Int)$id_order;
            $orderDe->id_prod = (Int)$item["id_prod"];
            $orderDe->quantity = (Int)$item["quantity"];
            $orderDe->save();
        }
        // return ['data'=>$data];
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
        $order = Order::find($id);
        $status = Status::find($order->id_status);
        $products = DB::table('orderdetail')->where('id_order',$id)->join('product', 'orderdetail.id_prod','=','product.id_prod')->select('product.id_prod as id_prod', 'product.name as name', 'product.price as price','product.image as image', 'orderdetail.quantity as quantity')->get();
        // 
        $sum =  DB::table('orderdetail')->where('id_order',$id)->join('product', 'orderdetail.id_prod','=','product.id_prod')->sum(DB::raw('product.price * orderdetail.quantity'));


        $result = (object) [
            "id_order" => (int)$id,
            "id_user" => $order->id_user,
            "id_status" => $order->id_status,
            "status" => $status->description,
            "total" => (int)$sum,
            "data" => $products,
            "created_at" => $order->created_at
        ];
        return $result;
    }

                /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOrderUser($id_user)
    {
        //
        // $order = Order::find($id_user);
        // $status = Status::find($order->id_status);

        $orders = DB::table('order')->where('id_user',$id_user)->join('status','order.id_status','=','status.id_status')->select('order.*', 'status.description as statusName')->orderBy('created_at', 'desc')->get();
        $results = [];
        foreach($orders as $order) {
            $data = OrderDetailController::show($order->id_order);
            $temp = (object) [
                "id_order" => $order->id_order,
                "id_user" => $order->id_user,
                "id_status" => $order->id_status,
                "status" => $order->statusName,
                "created_at" => $order->created_at,
                "total" => $data->total,
                "data_prods" => $data->data,
            ];
            
            array_push($results, $temp);
        }

        // return $result;
        return $results;
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
}