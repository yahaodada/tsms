<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\validation\Rule;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $name=request()->name??'';
        $class=request()->class??'';
        // dd($name);
        $where=[];
        if ($name) {
           $where[]=['name','like',"%$name%"];
        }
         if ($class) {
           $where[]=['class','like',"%$class%"];
        }
        $pagesize=config('app.pagesize');
        // dd($pagesize);
        $data=DB::table('student')->where($where)->orderby('id','desc')->paginate($pagesize);
        // dd($data);
        return view('admin/index',['data'=>$data,'name'=>$name,'class'=>$class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo 1;
        return view('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
         $request->validate([
            'name'=>'unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'num'=>'required|between:1,100|numeric',
            ],[
                    'name.regex'=>'名字需由中文数字字母——组成长度位2——12位',
                    'name.unique'=>'名字已存在',
                    'num.required'=>'成绩不能为空',
                    'num.between'=>'成绩必须在0-100间',
                    'num.numeric'=>'成绩格式不正确',
        ]);
        // echo 1;
        $data=$request->except('_token');
        // dd($data);
        if ($request->hasFile('img')) {
            $data['img']=$this->upload('img');
        }
        $res=DB::table('student')->insert($data);
        if($res){
            return redirect('student/index');
        }
    }
    /**
     * 文件上传
     */
    
    public function upload($filename){
        //判断是上传过程是否有问题
        if (request()->file($filename)->isValid()) {
            $photo=request()->file($filename);
            $ass=$photo->store('uploads');
            return $ass;
        }
        exit('为获取到上传文件或上传出错');
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
        $res=DB::table('student')->where('id',$id)->first();
        return view('admin/edit',['res'=>$res]);
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
        $request->validate([
            'name'=>['regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('student')->ignore($id),
        ],
            'num'=>'required|between:1,100|numeric',
            ],[
                    'name.regex'=>'名字需由中文数字字母——组成长度位2——12位',
                    'name.unique'=>'名字已存在',
                    'num.required'=>'成绩不能为空',
                    'num.between'=>'成绩必须在0-100间',
                    'num.numeric'=>'成绩格式不正确',
        ]);
        $data=$request->except('_token');
        if ($request->hasFile('img')) {
            $data['img']=$this->upload('img');
        }
        $res=DB::table('student')->where('id',$id)->update($data);
        if($res!==false){
            return redirect('student/index');
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
        $res=DB::table('student')->where('id',$id)->delete();
        if($res){
            return redirect('student/index');
        }
    }
}
