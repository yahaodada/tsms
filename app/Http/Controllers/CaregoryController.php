<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CaregoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Category::get();
        
        $data=getcategory($res);
        return view('caregory/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data=Db::table('Category')->get();
        // dd($data);
        $res=getcategory($data);
        // dd($res);
        return view('caregory/create',['res'=>$res]);
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
            $request->validate([ 
                'cate_name'=>'required|unique:category|max:12|min:2',
            ],[
                    'cate_name.required'=>'名字不能为空',
                    'cate_name.unique'=>'名字已存在',
                    'cate_name.max'=>'名字长度不超过12位',
                    'cate_name.min'=>'名字长度不小于2位',
            ]);
        $res=Category::insert($data);
       // echo 11;
       // dump($res);
       if($res){
            return redirect('caregory/index');
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
        $row=Category::where('cate_id',$id)->first();
        $data=Db::table('Category')->get();
        // dd($data);
        $res=getcategory($data);
        return view('caregory/edit',['res'=>$res,'row'=>$row]);
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
        // dd($data);
            $request->validate([ 
                'cate_name'=>'required|unique:category|max:12|min:2',
            ],[
                    'cate_name.required'=>'名字不能为空',
                    'cate_name.unique'=>'名字已存在',
                    'cate_name.max'=>'名字长度不超过12位',
                    'cate_name.min'=>'名字长度不小于2位',
            ]);
        $res=Category::where('cate_id',$id)->update($data);
       // echo 11;
       // dump($res);
       if($res){
            return redirect('caregory/index');
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
        $res=Category::where('cate_id',$id)->delete();
        // return view('people/edit');
        if($res){
            return redirect('caregory/index');
        }
    }
}
