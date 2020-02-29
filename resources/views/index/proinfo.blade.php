<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>商品详情</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @if($v->goods_imgs)
      @php $imgs=explode('|',$v->goods_imgs);@endphp
      <!-- <img src="/static/index/images/image1.jpg" />
      <img src="/static/index/images/image2.jpg" />
      <img src="/static/index/images/image3.jpg" />
      <img src="/static/index/images/image4.jpg" />
      <img src="/static/index/images/image5.jpg" /> -->
      @foreach($imgs as $kk=>$vv)
        <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="630px" height="467px">
        @endforeach
      @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$v->goods_price}}<input type="hidden"value="{{$v->goods_id}}"id="goods_id">{{$v->goods_id}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" id="num"/>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$v->goods_name}}</strong>
        <p class="hui">库存{{$v->goods_num}}<input type="hidden"value="{{$v->goods_num}}"id="goods_num"></p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/static/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id="addcart">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<!-- <script src="/static/js/jquery.min.js"></script> -->
<script type="text/javascript">
  $('.spinnerExample').val(1);
   //获取最大库存
  var goods_num=parseInt($('#goods_num').val());
$(document).on('blur','.spinnerExample',function(){
  var _this=$(this);
  var num=_this.val();
  if(num<1){
    _this.val(1);
  }
  if(num>goods_num){
    _this.val(goods_num);
  }
  zz=/^[0-9]{1,}$/;
  if(!zz.test(num)){
    _this.val(1);
  }else{
    var num=parseInt(num);
    _this.val(num);
  }
})
//加入购物车
 $(document).on('click','#addcart',function(){
            //alert(11);
            //获取商品id
            var goods_id=$('#goods_id').val();
            // alert(goods_id);
            //alert($goods_id);
            //获取文本框中要付款的数量
            var buy_num=$('#num').val();
            //alert($buy_num);
            // alert(11);
            $.get(
                "{{url('index/cart')}}",
                {goods_id:goods_id,buy_num:buy_num},
                function(index){
                    // if(index['code']==1){
                    //     $('#fadel').show();
                    //     $('#MyDiv1').show();
                    // }else{
                    //     alert(index['canshu']);
                    // }
                    // alert(index);
                    if (index=='login') {
                      location.href="/login";
                    }else if (index=='OK') {
                        alert('加入购物车成功');
                    }else{
                        alert('加入购物车失败');
                    }
                },
                // "json",
                )
        })
</script>