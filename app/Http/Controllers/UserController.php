<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pagesize=config('app.pagesize');
        $res=Users::paginate($pagesize);
        return view('user/index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
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
        $data['user_pwd']=encrypt($data['user_pwd']);
        if($request->hasFile('user_img')){
            $data['user_img']=upload('user_img');
        }
        // dd($data);
        $res=Users::create($data);
        if($res){
            return redirect('user/index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ros=Users::where('user_id',$id)->first();
        return view('user/edit',['ros'=>$ros]);
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
        $data=$request->except('_token');
        // $data['user_pwd']=encrypt($data['user_pwd']);
        if($request->hasFile('user_img')){
            $data['user_img']=upload('user_img');
        }
        // dd($data);
        $res=Users::where('user_id',$id)->update($data);
        // dd($res);
        if($res!==false){
            return redirect('user/index');
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
        $res=Users::where('user_id',$id)->delete();
        if ($res) {
            return redirect('user/index');
        }
    }
    public function weiyi(Request $request){
        $data=$request->user_name;
        $user_id=$request->user_id;
        $where=[];
        if($data){
            $where[]=['user_name','=',$data];
        }
        if ($user_id) {
            $where[]=['user_id','!=',$user_id];
        }
        $ass=Users::where($where)->first();
        if($ass){
            echo 'OK';
        }else{
            echo 'No';
        }
    }
}
