<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $catalogues = Catalogue::all();
        return $catalogues;
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
            'name' => 'required|unique:catalogue',
        ]);

        $catalogue = Catalogue::create($request->all());
        return ['status'=>1,'message'=> 'catalogue created', 
        'catalogue' => $catalogue];
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
        $catalogue = Catalogue::find($id);
        $catalogue->update($request->all());
        $catalogue->save();

        return ['status'=>1,'message'=> 'catalogue edited', 'catalogue' => $catalogue];
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
        $catalogue = Catalogue::find($id);
        $catalogue->update(["del_flag"=>1]);
        $catalogue->save();
        // update id_catalog của typeprod nằm trong catalog đã xóa thành id_catalog có name ="Khác"
        $cataOther = DB::table('catalogue')->where('name', 'Khác')->first();
        $cataOtherId = $cataOther->id_catalog;
        // return ['cata'=>$cataOther];
        $typeproductsOfCataDel = DB::table('typeproduct')->where('id_catalog',$id)->get();
        foreach ($typeproductsOfCataDel as $typeprod) {
            # code...
            DB::table('typeproduct')->where('id_catalog', $id)->update(['id_catalog'=>$cataOtherId]);
        }
        // 
        return ['status'=>1,'message'=> 'del_flag = true', 'catalogue' => $catalogue];

    }
}