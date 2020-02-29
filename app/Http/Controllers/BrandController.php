<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Brand::get();
        return view('brand/index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand/create');
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
        if($request->hasFile('brand_logo')){
            $data['brand_logo']=upload('brand_logo');
        }
        $res=Brand::insert($data);
        if ($res) {
            return redirect('/brand/index');
        }
    }
    // public function upload($filename){
    //     if (request()->file($filename)->isValid()) {
    //         $res=request()->file($filename);
    //         $ass=$res->store('uploads');
    //         return $ass;
    //     }
    //     exit('为获取上传文件或文件上传出错');
    // }
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
        $res=Brand::where('brand_id',$id)->first();
        return view('brand/edit',['v'=>$res]);
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
        if($request->hasFile('brand_logo')){
            $data['brand_logo']=upload('brand_logo');
        }
        $res=Brand::where('brand_id',$id)->update($data);
        if ($res!==false) {
            return redirect('/brand/index');
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
        $res=Brand::where('brand_id',$id)->delete();
        if ($res) {
            return redirect('/brand/index');
        }
    }
}
