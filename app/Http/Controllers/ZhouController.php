<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Zhou;

// use Illuminate\Validation\Rule;
use Illuminate\validation\Rule;
use  Illuminate\Support\Facades\Cache;
use  Illuminate\Support\Facades\Redis;
class ZhouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Redis::set('num',0);
        // Redis::incr('num');
        // echo Redis::get('num');
        $title=request()->title??'';
        $f_id=request()->f_id??'';
        $where=[];
        if ($title) {
            $where[]=['title','like',"%$title%"];
        }
        if ($f_id) {
            $where[]=['f_id','=',$f_id];
        }
        $page=request()->page??1;
        // $res=Cache('res_'.$page.'_'.$title.'_'.$f_id);
      //  Redis::flushall();//清除所有
        $res=Redis::get('res_'.$page.'_'.$title.'_'.$f_id);
        // echo $res;
        dump($res);
        if (!$res) {
           echo "走db";
           $pagesize=config('app.pagesize');
            $res=Zhou::where($where)->paginate($pagesize);
            // Cache::put('res',$res,60*5);
            // Cache(['res_'.$page.'_'.$title.'_'.$f_id=>$res],60*5);
            $res=serialize($res);
            Redis::setex('res_'.$page.'_'.$title.'_'.$f_id,20,$res);
        }
        $res=unserialize($res);
        return view('zhou/index',['res'=>$res,'title'=>$title,'f_id'=>$f_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zhou/create');
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
        // $request->validate([
        //     'title'=>'required|unique:zhou|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
        // ],[
        //     'title.required'=>'标题不能为空',
        //     'title.unique'=>'标题已存在',
        //     'title.regex'=>'标题必须是中文字母数字下划线',
        // ]);
        // dd($data);
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');
        }
        $res=Zhou::insert($data);
        // dd($res);
        if($res){
            return redirect('zhou/index');
        }
    }
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $res=request()->file($filename);
            $ras=$res->store('uploads');
            return $ras;
        }
        exit('文件上传出错或为获取到上传文件');
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
        $res=Zhou::where('id',$id)->first();
        return view('zhou/edit',['v'=>$res]);
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
        // $request->validate([
        //     'title'=>['required',
        //               'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
        //                Rule::unique('zhou')->ignore($id),
        //            ],
        // ],[
        //     'title.required'=>'标题不能为空',
        //     'title.unique'=>'标题已存在',
        //     'title.regex'=>'标题必须是中文字母数字下划线',
        // ]);
        // dd($data);
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');
        }
        $res=Zhou::where('id',$id)->update($data);
        // dd($res);
        if($res!==false){
            return redirect('zhou/index');
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
        $res=Zhou::where('id',$id)->delete();
        // dd($res);
        if($res){
            return redirect('zhou/index');
        }
    }
    public function shanchu(Request $request){
        $data=$request->except('_token');
        // dd($data);
        $res=Zhou::where('id',$data)->delete();
        // dd($res);
        if($res){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
    public function weiyi(){
        $title=request()->title;
        $count=Zhou::where(['title'=>$title])->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
    //修改唯一性
    public function xweiyi(){
        $title=request()->title;
        $id=request()->id;
        $where=[
               [ 'title','=',$title],
               ['id','!=',$id]
                ];
        $count=Zhou::where($where)->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
    //打印sql
        //  \DB::connection()->enableQueryLog();
        // $count = News::where($where)->count();
        // $logs = \DB::getQueryLog();
        // dd($logs);

}
