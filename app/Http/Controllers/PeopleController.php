<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePeoplePost;
use App\People;
use Validator;
use DB;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $username=request()->username??'';
        $where=[];
        if ($username) {
            $where[]=['username','like',"%$username%"];
        }
        $pagesize=config('app.pagesize');
        // dd($pagesize);
        // echo 1;
        // $res = DB::table('people')->select('*')->get();
        // dd($res);
        $res=People::where($where)->orderby('p_id','desc')->paginate($pagesize);
        return view('people/index',['data'=>$res,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // public function store(StorePeoplePost $request)
    {   $data=$request->except('_token');
        $Validator = Validator::make($data,
            [ 
                'username'=>'required|unique:people|max:12|min:2',
                'age'=>'required|integer|between:1,130',
            ],[
                    'username.required'=>'名字不能为空',
                    'username.unique'=>'名字已存在',
                    'username.max'=>'名字长度不超过12位',
                    'username.min'=>'名字长度不小于2位',
                    'age.required'=>'年龄不能为空',
                    'age.integer'=>'年龄必须位数字',
                    'age.between'=>'年龄数据不合法',
            ]);
        if ($Validator->fails()) { 
            return redirect('people/create') ->withErrors($Validator) ->withInput(); 
        }
        //表单验证
        // $request->validate([
        //     'username'=>'required|unique:people|max:12|min:2',
        //     'age'=>'required|integer|min:1|max:3',
        // ],[
        //     'username.required'=>'名字不能为空',
        //     'username.unique'=>'名字已存在',
        //     'username.max'=>'名字长度不超过12位',
        //     'username.min'=>'名字长度不小于2位',
        //     'age.required'=>'年龄不能为空',
        //     'age.integer'=>'年龄必须位数字',
        //     'age.min'=>'年龄数据不合法',
        //     'age.max'=>'年龄数据不合法',
        // ]);
       
       if ($request->hasFile('head')) {
           $data['head']=$this->upload('head');
       }
       $data['add_time']=time();
       // dd($data);
       // $res=DB::table('people')->insert($data);
       // $res = DB::table('people')->insert($data);
       $res=People::insert($data);
       // echo 11;
       // dump($res);
       if($res){
            return redirect('people/index');
       }
    }
    /**
     * 分装文件上传
     */
    public function upload($filename){
        // 判断上传过程有无错误
        if(request()->file($filename)->isValid()){
            // 接受值
            $photo=request()->file($filename);
            // 上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('为获取到上传文件或上传过程出错');
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
        // echo "$id";
        // $res = DB::table('people')->where('p_id',$id)->first();
        $res=People::where('p_id',$id)->first();
        return view('people/edit',['v'=>$res]);
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
         if ($request->hasFile('head')) {
           $data['head']=$this->upload('head');
       }
        // $data['add_time']=time();
        // $res = DB::table('people')->where('p_id',$id)->update($data);
        $res=People::where('p_id',$id)->update($data);
        if($res!==false){
            return redirect('people/index');
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
        // $res = DB::table('people')->where('p_id',$id)->delete();
        $res=People::where('p_id',$id)->delete();
        // return view('people/edit');
        if($res){
            return redirect('people/index');
        }
    }
}
