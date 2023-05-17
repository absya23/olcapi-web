<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\TypeProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = DB::table('typeproduct')->join('catalogue','typeproduct.id_catalog','=','catalogue.id_catalog')->select('typeproduct.*','catalogue.name as nameCatalogue')->get();
        return $types;
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
        $request->validate([
            'name' => 'required|unique:typeproduct',
            'id_catalog' => 'required'
        ]);
        // nếu có catalog đó mới đc gửi
        if(Catalogue::find($request->id_catalog)) {
            $type = TypeProduct::create($request->all());
            return ['status'=>1,'message'=> 'typeproduct created', 'typeproduct' => $type];
        }
        else return ['status'=>0,'message'=> 'typeproduct failed'];
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByCata($id_cata)
    {
        //
        $types = DB::table('typeproduct')->where('id_catalog',$id_cata)->get();
        return $types;
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
        $type = TypeProduct::find($id);
        $type->update($request->all());
        $type->save();
        
        return ['status'=>1,'message'=> 'typeprod edited', 'typeprod' => $type];
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
        $type = TypeProduct::find($id);
        $type->update(["del_flag"=>1]);
        $type->save();
        return ['status'=>1,'message'=> 'del_flag = true', 'typeprod' => $type];

    }
}