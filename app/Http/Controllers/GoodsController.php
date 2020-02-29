<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use App\Brand;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pagesize=config('app.pagesize');
        $res=Goods::leftjoin('brand','brand.brand_id','=','goods.brand_id')->leftjoin('category','category.cate_id','=','goods.cate_id')->paginate($pagesize);

        return view('goods/index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $brand=Brand::get();
        $Category=Category::get();
        $res=getcategory($Category);
        return view('goods/create',['brand'=>$brand,'res'=>$res]);
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
        // dump($data);
        if ($request->hasFile('goods_img')) {
            $data['goods_img']=upload('goods_img');
        }
        if ($data['goods_imgs']) {
            $photo=uploads('goods_imgs');
            $data['goods_imgs']=implode('|', $photo);
        }
        // dd($data);
        $res=Goods::insert($data);
        if ($res) {
            return redirect('goods/index');
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
        $brand=Brand::get();
        $Category=Category::get();
        $res=getcategory($Category);
        $ros=Goods::where('goods_id',$id)->first();
        return view('goods/edit',['res'=>$res,'ros'=>$ros,'brand'=>$brand]);
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
        // dump($data);
        if ($request->hasFile('goods_img')) {
            $data['goods_img']=upload('goods_img');
        }
        if ($request->hasFile('goods_imgs')) {
            if ($data['goods_imgs']) {
                $photo=uploads('goods_imgs');
                $data['goods_imgs']=implode('|', $photo);
            }
        }
        // dd($data);
        $res=Goods::where('goods_id',$id)->update($data);
        if ($res) {
            return redirect('goods/index');
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
        $res=Goods::where('goods_id',$id)->delete();
        if ($res) {
            return redirect('goods/index');
        }
    }
    public function weiyi(Request $request){
        $data=$request->goodscargo;
        $where=[];
        if($data){
            $where[]=['goods_cargo','=',$data];
        }
        $ass=Goods::where($where)->first();
        if($ass){
            echo 'OK';
        }else{
            echo 'No';
        }
    }
}
