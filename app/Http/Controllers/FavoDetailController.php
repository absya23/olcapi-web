<?php

namespace App\Http\Controllers;

use App\Models\FavoDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carts = FavoDetail::all();
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
        if(!$request->id_user || !$request->id_prod) return ['status'=>0,'message'=>'thiếu 1 trong 2 trường id_user, id_prod'];

        $id_prod = $request->id_prod;
        $id_user = $request->id_user;

        $favoDt = DB::table("favodetail")->where("id_prod", $id_prod)->where("id_user", $id_user)->first();

        if($favoDt) return ['status'=>1];
        else {
            $favoDetail = new FavoDetail();
            $favoDetail->id_prod = $id_prod;
            $favoDetail->id_user = $id_user;

            $favoDetail->save();

            return ['status'=> 1, "data" => $favoDetail];
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
        $favoProds = DB::table("favodetail")->where("id_user",$id_user)->join("product", "favodetail.id_prod", "=","product.id_prod")->select("favodetail.*", "product.image as image", "product.name as name", "product.price as price")->get();
        return $favoProds;
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
        $favoDt = FavoDetail::find($id);
        $favoDt->delete();
        // $image->update(["del_flag"=>1]);
        // $image->save();
        return ['status'=>1,'message'=> 'delete successfully!', 'favodt' => $favoDt];
    }
}