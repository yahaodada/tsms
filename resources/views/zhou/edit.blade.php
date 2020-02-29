<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<h3>文章编辑</h3>
	<form method="post" action="{{url('zhou/update/'.$v->id)}}" enctype="multipart/form-data">
		@csrf
		<table border="1px">
			<tr>
				<td>文章标题</td>
				<td><input type="text" name="title" value="{{$v->title}}" class="title"><b style="color:red">{{$errors->first('title')}}</b></td>
			</tr>
			<tr>
				<td>文章分类</td>
				<td><select name="f_id">
						<option value="1"@if($v->f_id==1) selected  @endif>小说</option>
						<option value="2"@if($v->f_id==2) selected  @endif>散文</option>
						<option value="3"@if($v->f_id==3) selected  @endif>名著</option>
						<option value="4"@if($v->f_id==4) selected  @endif>童话</option>
				</select></td>
			</tr>
			<tr>
				<td>文章重要性</td>
				<td><input type="radio" name="zyx"value="1"@if($v->zyx==1) checked @endif>普通<input type="radio" name="zyx"value="2"@if($v->zyx==2) checked @endif>置顶</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td><input type="radio" name="xs"value="1"@if($v->xs==1)checked @endif>显示<input type="radio" name="xs"value="2"@if($v->xs==2)checked @endif>不现实</td>
			</tr>
			<tr>
				<td>文章作者</td>
				<td><input type="text" name="zz"value="{{$v->zz}}" class="zz"><b style="color:red"></b></td>
			</tr>
			<tr>
				<td>作者email</td>
				<td><input type="text" name="email"value="{{$v->email}}"></td>
			</tr>
			<tr>
				<td>关键字</td>
				<td><input type="text" name="gjz"value="{{$v->gjz}}"></td>
			</tr>
			<tr>
				<td>网页描述</td>
				<td><textarea name="ms">{{$v->ms}}</textarea></td>
			</tr>
			<tr>
				<td>文件上传</td>
				<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50px" height="50">@endif<input type="file" name="img"></td>
			</tr>
			<tr>
				<td><input type="hidden" class="cid" value="{{$v->id}}"></td>
				<td><button type="button" class="button">编辑</button></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
	//表单令牌
	$.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$(this).next().html('');
	$(document).on('blur','.title',function(){
		$(this).next().html('');
		var title=$(this).val();
		var cid=$('.cid').val();
		// alert(title);
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if (!reg.test(title)) {
			$(this).next().html('文章标题是由中文字符数字下划线组成且不能为空');
		}
		$.ajax({
			type:'post',
			url:"/zhou/xweiyi",
			data:{title:title,id:cid},
			dataType:'json',
			success:function(index){
				if(index.count>0){
					$('.title').next().html('文章标题已存在');
				}
			}
		})
	});
	$(document).on('blur',".zz",function(){
		// $(this).next().html('');
		var zz=$(this).val();
		// alert(zz);
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if (!reg.test(zz)) {
			$(this).next().html('文章作者是由中文字符数字下划线组成且长度2到8位');
		}
	});
	$(document).on('click','.button',function(){
		// alert(1);
		$(this).next().html('');
		var titleflag=true;
		var title=$('.title').val();
		var cid=$('.cid').val();
		// alert(cid);
		// return;
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if (!reg.test(title)) {
			$('.title').next().html('文章标题是由中文字符数字下划线组成且不能为空');
			return;
		}
		$.ajax({
			type:'post',
			url:"/zhou/xweiyi",
			data:{title:title,id:cid},
			async:false,
			dataType:'json',
			success:function(index){
				if(index.count>0){
					$('.title').next().html('文章标题已存在');
					titleflag=false;
				}
			}
		});
//alert(titleflag);return;
		if (!titleflag) {
			return;
		}
		var zz=$('.zz').val();
		// alert(zz);
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if (!reg.test(zz)) {
			$('.zz').next().html('文章作者是由中文字符数字下划线组成且长度2到8位');
			return;
		}
		$('form').submit();
	});
</script>