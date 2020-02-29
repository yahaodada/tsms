<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use  App\Admin;
use  App\Category;
use  App\Goods;
use  App\Cart;
use  Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
	//前台首页
    public function index(Request $request){
    	//获取登陆用户
    	$res=$request->session()->get('user_id');
    	//查找登陆用户的所有信息
    	$row=Admin::where('user_id','=',$res)->first();
    	//dd($row);
    	//查找所有等级分类
        //清除缓存
        // Cache::flush();
        $Category=Cache::get('Category');
        // dump($Category);
        if(!$Category){
            // echo "走DB";
    	   $Category=Category::where([['p_id','=','0'],['cate_nav_show','=','1']])->get();
           Cache::put('Category',$Category,60*30);
        }
    	//展示所有的商品
        $goods=Cache::get('goods');
        // dump($goods);
        if(!$goods){
            // echo "123";
    	   $goods=Goods::get();
           Cache::put('goods',$goods,60*30);
        }
    	return view('index.index',['row'=>$row['user_tel'],'Category'=>$Category,'Goods'=>$goods]);
    }
    //加入给购物车
    public function cart(Request $request){
        $data=request()->except('_token');
        // dd($data);
        $res=$request->session()->get('user_id');
        // dd($res);
        if (!$res) {
            return "login";
            // return redirect('/login');
        }
        // die;
        //查找登陆用户的所有信息
        $row=Admin::where('user_id','=',$res)->first();
        $ass=Cart::where([['user_id','=',$res['user_id']],['goods_id','=',$data['goods_id']],['cart_del','=','1']])->first();
        dd($ass);
        if(!$ass){
            $data['user_id']=$row['user_id'];
            $data['add_time']=time();
            $data['cart_del']=1;
            $res=Cart::insert($data);
            if($res){
                return 'OK';
            }else{
                return 'NO';
            }
        }
        else{
            $data[]
            $cart=Cart::where(['cart_id','=',$ass['cart_id']])->updata($data);
            if($cart){
                return 'OK';
            }else{
                return 'NO';
            }
        }
        
    }
    //商品详情
   	public function edit($id)
    {   
        $ros=Goods::where('goods_id',$id)->first();
        return view('index/proinfo',['v'=>$ros]);
    }
    public function ajaxsend(){
    	//接受注册页面的手机号
    	$moblie = request()->user_tel;
    	// dump($moblie);
    	// $moblie = request()->mobile;
    	$code = rand(100000,999999);
    	$res = $this->sendSms($moblie,$code);
    	//dd($res);
    	if( $res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();
    		// echo "发送成功";
            // $sess=session('code');
            // echo $sess;die;
            echo json_encode(['code'=>'00000','msg'=>'短信发送成功']);die;
    	}
            echo json_encode(['code'=>'00001','msg'=>'短信发送失败']);die;
    }

    public function sendSms($moblie,$code){			
			AlibabaCloud::accessKeyClient('LTAI4Figib79zoPgx8s7gBj3', 'BSGKl8dkwpCnJFZo3xTwhSK9DvltyA')
			                        ->regionId('cn-hangzhou')
			                        ->asDefaultClient();

			try {
			    $result = AlibabaCloud::rpc()
			                          ->product('Dysmsapi')
			                          // ->scheme('https') // https | http
			                          ->version('2017-05-25')
			                          ->action('SendSms')
			                          ->method('POST')
			                          ->host('dysmsapi.aliyuncs.com')
			                          ->options([
			                                        'query' => [
			                                          'RegionId' => "cn-hangzhou",
			                                          'PhoneNumbers' => $moblie,
			                                          'SignName' => "雅豪",
			                                          'TemplateCode' => "SMS_180952210",
			                                          'TemplateParam' => "{code:$code}",
			                                        ],
			                                    ])
			                          ->request();
			    return $result->toArray() ;
			} catch (ClientException $e) {
                
			    return $e->getErrorMessage();
			} catch (ServerException $e) {
                
			    return $e->getErrorMessage();
			}
	}		
}
