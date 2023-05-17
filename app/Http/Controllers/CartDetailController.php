<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carts = CartDetail::all();
        return $carts;
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
        if(!$request->id_user || !$request->id_prod || !$request->quantity) return ['status'=>0,'message'=>'thiếu 1 trong 3 trường id_user, id_prod, quantity'];
        // 
        $id_prod = $request->id_prod;
        $cartDt = DB::table('cartdetail')->where('id_prod', $id_prod)->first();
        
        if($cartDt) {
            $temp = (int) $cartDt->quantity + (int) $request->quantity;
            DB::table('cartdetail')->where('id_prod', $id_prod)->update(["quantity" => $temp]);

            return ['status'=>1,'message'=>'cartDetail updated', 'data'=> $cartDt];
        }
        else {
            $cartDetail = new CartDetail();
            $cartDetail->id_user = $request->id_user;
            $cartDetail->id_prod = $request->id_prod;
            $cartDetail->quantity = $request->quantity;
    
            $cartDetail->save();
            return ['status'=>1,'message'=>'cartDetail created', 'data'=> $cartDetail];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_user)
    {
        //
        $totalMoney =  DB::table("cartdetail")->where("id_user",$id_user)->join("product", "cartdetail.id_prod", "=","product.id_prod")->sum(DB::raw('product.price * cartdetail.quantity'));
        $totalQuantity = DB::table("cartdetail")->where("id_user",$id_user)->sum(DB::raw('cartdetail.quantity'));
        // 
        $userCart = DB::table("cartdetail")->where("id_user",$id_user)->join("product", "cartdetail.id_prod", "=","product.id_prod")->select("cartdetail.*", "product.name as name", "product.price as price", "product.quantity as stock", "product.image as image")->get();
        return ["totalMoney"=> (int)$totalMoney,"totalQuantity" => (int)$totalQuantity, "data" => $userCart];
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
        $cart = CartDetail::find($id);
        $cart->update($request->all());
        $cart->save();

        return ['status'=>1,'message'=> 'cartdetail edited', 'catalogue' => $cart];
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
        $cart = CartDetail::find($id);
        $cart->delete();
        // $image->update(["del_flag"=>1]);
        // $image->save();
        return ['status'=>1,'message'=> 'delete successfully!', 'cart' => $cart];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteCarts(Request $request)
    {
        $data = json_decode($request->data, true);
        // return ['data'=>$data];
        foreach($data as $item) {
            $cart = CartDetail::find((Int)$item);
            if($cart) $cart->delete();
        }
        return [];
    }
}