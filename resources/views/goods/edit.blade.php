<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8"> 
	<title>商品编辑</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>编辑商品</h1></center>
<form  action="{{url('/goods/update/'.$ros->goods_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_cargo" id="optionsRadios1" 
				   placeholder="请输入商品名称"value="{{$ros->goods_cargo}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_name" id="optionsRadios1" 
				   placeholder="请输入商品名称"value="{{$ros->goods_name}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_price" id="optionsRadios1" 
				   placeholder="请输入商品价格"value="{{$ros->goods_price}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_num" id="optionsRadios1" 
				   placeholder="请输入商品库存"value="{{$ros->goods_num}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="goods_img" id="optionsRadios1" >
			<img src="{{env('UPLOAD_URL')}}{{$ros->goods_img}}" width="50px" height="50px">   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="goods_imgs[]" id="optionsRadios1"multiple="multiple">   
			@if($ros->goods_imgs)
			@php $imgs=explode('|',$ros->goods_imgs);@endphp
				@foreach($imgs as $kk=>$vv)
				<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50px" height="50px">
				@endforeach
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="radio">
	    <label>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_best" id="optionsRadios1" value="1" {{$ros->is_best==1?'checked':''}}>是 
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_best" id="optionsRadios1" value="2" {{$ros->is_best==2?'checked':''}}>否
	    </label>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="radio">
	    <label>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_new" id="optionsRadios1" value="1" {{$ros->is_new==1?'checked':''}}>是 
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_new" id="optionsRadios1" value="2" {{$ros->is_new==2?'checked':''}}>否
	    </label>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热卖</label>
		<div class="radio">
	    <label>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_hot" id="optionsRadios1" value="1" {{$ros->is_hot==1?'checked':''}}>是 
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_hot" id="optionsRadios1" value="2" {{$ros->is_hot==2?'checked':''}}>否
	    </label>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="radio">
	    <label>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_up" id="optionsRadios1" value="1" {{$ros->is_up==1?'checked':''}}>是 
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="is_up" id="optionsRadios1" value="2" {{$ros->is_up==2?'checked':''}}>否
	    </label>
		</div>
	</div>
	<br>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-8">
			<select class="form-control"id="optionsRadios1" name="cate_id">
				@foreach($res as $k=>$v)
				<!-- {volist name="info" id="v"} -->
					<option value="{{$v->cate_id}}"{{$ros->cate_id==$v->cate_id?'selected':''}}>{{str_repeat("--",($v->level*2))}}

						|{{$v->cate_name}}</option>
				<!-- {/volist} -->
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属品牌</label>
		<div class="col-sm-8">
			<select class="form-control"id="optionsRadios1" name="brand_id">
				@foreach($brand as $k=>$v)
				<!-- {volist name="info" id="v"} -->
					<option value="{{$v->brand_id}}"{{$ros->brand_id==$v->brand_id?'selected':''}}>{{$v->brand_name}}</option>
				<!-- {/volist} -->
				@endforeach
			</select>
		</div>
	</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">编辑<tton>
		</div>
	</div>
</form>
</body>
</html>
<script type="text/javascript">
$.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(this).next().html('');
$(document).on('blur','input[name="goods_name"]',function(){
	var _this=$(this);
	var goodsname=_this.val();
	var reg=/^[\u4e00-\u9fa5A-Za-z0-9--]{2,}$/
	// alert(goodsname);
	if (!reg.test(goodsname)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('商品名称由数字字母中文下划线组成最少2位');
	}else{
		$(this).next().html('');
	}
})
$(document).on('blur','input[name="goods_price"]',function(){
 	var _this=$(this);
	var goodsscrice=_this.val();
	var reg=/[0-9]+\.[0-9]{2,2}$/;
	if (!reg.test(goodsscrice)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('商品价格必须为数字格式为0.00');
	}else{
		$(this).next().html('');
	}
})
$(document).on('blur','input[name="goods_num"]',function(){
	var _this=$(this);
	var goodsnum=_this.val();
	var reg=/^[123456789]{1,1}[0-9]{0,}$/;
	if (!reg.test(goodsnum)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('商品库存必须为数字且第一位不能为0');
	}else{
		$(this).next().html('');
	}
})
$(document).on('blur','input[name="goods_cargo"]',function(){
	var _this=$(this);
	var goodscargo=_this.val();
	var reg=/^[0-9a-zA-Z]{15,15}$/;
	if (!reg.test(goodscargo)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('商品货号必须为数字字母组成且为15位');
	}else{
		$(this).next().html('');
	}
	$.post(
		"{{url('goods/weiyi')}}",
		{goodscargo:goodscargo},
		function(index){
			if(index=='OK'){
				_this.next('b').html('商品货号已存在');
			}
		}
		)
})
$(document).on('click','.btn',function(){
	var goodsnum=$('input[name="goods_num"]').val();
	var reg=/^[123456789]{1,1}[0-9]{0,}$/;
	if (!reg.test(goodsnum)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="goods_num"]').next('b').html('商品库存必须为数字且第一位不能为0');
		return;
	}
	var goodsname=$('input[name="goods_name"]').val();
	var reg=/^[\u4e00-\u9fa5A-Za-z0-9--]{2,}$/
	// alert(goodsname);
	if (!reg.test(goodsname)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="goods_name"]').next('b').html('商品名称由数字字母中文下划线组成最少2位');
		return;
	}
	var goodsscrice=$('input[name="goods_price"]').val();
	var reg=/[0-9]+\.[0-9]{2,2}$/;
	if (!reg.test(goodsscrice)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="goods_price"]').next('b').html('商品价格必须为数字格式为0.00');
		return;
	}
	var goodscargo=$('input[name="goods_cargo"]').val();
	var reg=/^[0-9a-zA-Z]{15,15}$/;
	if (!reg.test(goodscargo)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="goods_cargo"]').next('b').html('商品货号必须为数字字母组成且为15位');
		return;
	}
	var titleflag=true;
	$.ajax({
			type:'post',
			url:"/goods/weiyi",
			data:{goodscargo:goodscargo},
			async:false,
			dataType:'json',
			success:function(index){
				if(index=='OK'){
				$('input[name="goods_cargo"]').next('b').html('商品货号已存在');
				titleflag=false;
				}
			}
		});
	if (!titleflag) {
		return;
	}
	$('form').submit();
})
</script>
