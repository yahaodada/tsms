<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        $where=[];
        if($data['user_tel']){
            $where[]=['user_tel','=',$data['user_tel']];
        }
        // dd($where);
        $res=Admin::where($where)->first();
        if ($data['user_pwd']!=decrypt($res->user_pwd)) {
            // return view('index/login',['error'=>'m没有此用户账号与密码']);
            return redirect('/login')->with('errors','没有此用户');
        }else{
            session(['user_id'=>$res['user_id']]);
            request()->session()->save();
            return redirect('/');
        }
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
        $data=$request->except('_token');
        // dd($data);
        $sess=session('code');
        // dump($sess);
        // echo $sess;die;
        if($data['yanz']!=$sess){
            // echo 1;
            return redirect('/rlbg')->with('errors','验证码不对');
        }
        // $data['yanz']=[];
        $data['user_pwd']=encrypt($data['user_pwd']);
        $res=Admin::insert($data);
        if($res){
            return view('index/login');
        }
        // dd($data);
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
    public function weiyi(Request $request){
        $user_tel=$request->user_tel;
        // dump($user_tel);
        $user_id=$request->user_id;
        $where=[];
        if($user_tel){
            $where[]=['user_tel','=',$user_tel];
        }
        if ($user_id) {
            $where[]=['user_id','!=',$user_id];
        }
        $ass=Admin::where($where)->first();
        if($ass){
            echo 'OK';
        }else{
            echo 'No';
        }
    }
}
