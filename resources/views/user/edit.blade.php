<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8"> 
	<title>管理员添加</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>编辑管理员</h1></center>
<form  action="{{url('/user/update/'.$ros->user_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员账号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="user_name" id="optionsRadios1" 
				   placeholder="请输入管理员账号"value="{{$ros->user_name}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员手机号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="user_tel" id="optionsRadios1" 
				   placeholder="请输入管理员手机号"value="{{$ros->user_tel}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="user_email" id="optionsRadios1" 
				   placeholder="请输入管理员邮箱"value="{{$ros->user_email}}">
			<b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-8">
			<img src="{{env('UPLOAD_URL')}}{{$ros->user_img}}" width="50px" height="50px">
			<input type="file" class="form-control" name="user_img" id="optionsRadios1" >   
		</div>
	</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">编辑<tton>
				<input type="hidden" name="user_id" value="{{$ros->user_id}}">
		</div>
	</div>
</form>
</body>
</html>
<script type="text/javascript">
$.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(this).next().html('');
var user_id=$('input[name="user_id"]').val();
$(document).on('blur','input[name="user_name"]',function(){
	var _this=$(this);
	var user_name=_this.val();
	var reg=/^[a-z]\w{5,17}$/i;
	// alert(goodsname);
	if (!reg.test(user_name)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('用户名由6-18位的字母数字下划线组成，不能由数字开头');
	}else{
		$(this).next().html('');
	}
	$.post(
		"{{url('user/weiyi')}}",
		{user_name:user_name,user_id:user_id},
		function(index){
			if(index=='OK'){
				_this.next('b').html('该用户已存在');
			}
		}
		)
})
$(document).on('blur','input[name="user_pwd"]',function(){
 	var _this=$(this);
	var goodsscrice=_this.val();
	var r_pwd=/^\w{6,}$/;
	if (!r_pwd.test(goodsscrice)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('密码长度数字、字母、下划线组成不能少于六位');
	}else{
		$(this).next().html('');
	}
})
$(document).on('blur','input[namee="user_pwds"]',function(){
 	var _this=$(this);
	var user_pwds=_this.val();
	var user_pwd=$('input[name="user_pwd"]').val();
	var r_pwd=/^\w{6,}$/
	if (!r_pwd.test(user_pwds)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('密码长度数字、字母、下划线组成不能少于六位');
	}
	if (user_pwds!=user_pwd) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('俩次输入的密码不一致');
	}else{
		$(this).next().html('');
	}
})
$(document).on('blur','input[name="user_tel"]',function(){
	var _this=$(this);
	var goodsnum=_this.val();
	var r_tel=/^1[3,5,8]\d{9}$/;
	if (!r_tel.test(goodsnum)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('验证手机号:11位  13 15 18开头');
	}else{
		$(this).next().html('');
	}
})
$(document).on('blur','input[name="user_email"]',function(){
	var _this=$(this);
	var goodscargo=_this.val();
	var r_qq_email=/^\d{5,}@qq(\.)com$/;
	if (!r_qq_email.test(goodscargo)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		_this.next('b').html('一个QQ邮箱地址');
	}else{
		$(this).next().html('');
	}
})
$(document).on('click','.btn',function(){
	var user_name=$('input[name="user_name"]').val();
	var reg=/^[a-z]\w{5,17}$/i;
	if (!reg.test(user_name)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="user_name"]').next('b').html('用户名由6-18位的字母数字下划线组成，不能由数字开头');
		return;
	}
	var user_pwd=$('input[name="user_pwd"]').val();
	var r_pwd=/^\w{6,}$/;
	// alert(goodsname);
	if (!r_pwd.test(user_pwd)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="user_pwd"]').next('b').html('密码长度数字、字母、下划线组成不能少于六位');
		return;
	}
	var user_tel=$('input[name="user_tel"]').val();
	var r_tel=/^1[3,5,8]\d{9}$/
	if (!r_tel.test(user_tel)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="user_tel"]').next('b').html('验证手机号:11位  13 15 18开头');
		return;
	}
	var user_email=$('input[name="user_email"]').val();
	var r_qq_email=/^\d{5,}@qq(\.)com$/;
	if (!r_qq_email.test(user_email)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[name="user_email"]').next('b').html('一个QQ邮箱地址');
		return;
	}
	var user_pwds=$('input[namee="user_pwds"]').val();
	var user_pwd=$('input[name="user_pwd"]').val();
	var r_pwd=/^\w{6,}$/
	if (!r_pwd.test(user_pwds)) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[namee="user_pwds"]').next('b').html('密码长度数字、字母、下划线组成不能少于六位');
		return;
	}
	if (user_pwds!=user_pwd) {
		// alert('商品名称由数字字母中文下划线组成最少2位');
		$('input[namee="user_pwds"]').next('b').html('俩次输入的密码不一致');
		return;
	}
	var titleflag=true;
	$.ajax({
			type:'post',
			url:"/user/weiyi",
			data:{user_name:user_name,user_id:user_id},
			async:false,
			success:function(index){
				if(index=='OK'){
				$('input[name="user_name"]').next('b').html('该用户已存在');
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
