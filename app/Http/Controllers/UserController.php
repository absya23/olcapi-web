<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return $users;
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
        $userOther = DB::table('user')->where('username', $request->username)->first();
        if($userOther) {
            return ['status'=>0,'message'=>'username already exists'];
        } else {
            $user = new User;
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->save();
            return ['status'=>1,'message'=>'user created', 'data'=> $user];
        }
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
        $user = User::find($id);
        if(!$user)
            return ['status'=>0, 'data'=>[]];
        else return ['status'=>1, 'data'=>$user];
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
        // $request->validate([
        //     'username' => 'required',
        //     // 'password' => 'required',
        //     'name' => 'required',
        //     'email' => 'required',
        //     'address' => 'required',
        //     'phone' => 'required'
        // ]);

        $user = User::find($id);
        $user->update($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        
        return ['status'=>1,'message'=> 'user edited', 'prod' => $user];
    }

        /**
     * LOGIN
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', '=',  $request->username)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                return ["status"=>1, "data"=>$user, "mess"=>"Đăng nhập thành công!"];
            }
        } 
        return ["status"=>0, "data"=>$request, "mess"=>"Đăng nhập thất bại!"];
    }

            /**
     * LOGIN
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkPass(Request $request, $id)
    {
        $user = User::find($id);
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                return ["status"=>1, "mess"=>"Mật khẩu đúng"];
            } else return ["status"=>0,"mess"=>"Mật khẩu sai"];
        } 
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