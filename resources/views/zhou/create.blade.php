<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<h3>文章添加</h3>
	<form method="post" action="{{url('zhou/store')}}" enctype="multipart/form-data">
		@csrf
		<table border="1px">
			<tr>
				<td>文章标题</td>
				<td><input type="text" name="title" class="title"><b style="color:red">{{$errors->first('title')}}</b></td>
			</tr>
			<tr>
				<td>文章分类</td>
				<td><select name="f_id">
						<option value="1">小说</option>
						<option value="2">散文</option>
						<option value="3">名著</option>
						<option value="4">童话</option>
				</select></td>
			</tr>
			<tr>
				<td>文章重要性</td>
				<td><input type="radio" name="zyx"value="1"checked>普通<input type="radio" name="zyx"value="2">置顶</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td><input type="radio" name="xs"value="1"checked>显示<input type="radio" name="xs"value="2">不现实</td>
			</tr>
			<tr>
				<td>文章作者</td>
				<td><input type="text" name="zz" class="zz"><b style="color:red"></b></td>
			</tr>
			<tr>
				<td>作者email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td>关键字</td>
				<td><input type="text" name="gjz"></td>
			</tr>
			<tr>
				<td>网页描述</td>
				<td><textarea name="ms"></textarea></td>
			</tr>
			<tr>
				<td>文件上传</td>
				<td><input type="file" name="img"></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="button" class="button">添加</button></td>
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
		// alert(title);
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if (!reg.test(title)) {
			$(this).next().html('文章标题是由中文字符数字下划线组成且不能为空');
		}
		$.ajax({
			type:'post',
			url:"/zhou/weiyi",
			data:{title:title},
			dataType:'json',
			success:function(index){
				if(index.count>0){
					$('.title').next().html('文章标题已存在');
				}
			}
		})
	});
	$(document).on('blur',".zz",function(){
		$(this).next().html('');
		var zz=$(this).val();
		// alert(zz);
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if (!reg.test(zz)) {
			$(this).next().html('文章作者是由中文字符数字下划线组成且长度2到8位');
		}
	});
	$(document).on('click','.button',function(){
		// alert(1);
		var titleflag=true;
		var title=$('.title').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if (!reg.test(title)) {
			$('.title').next().html('文章标题是由中文字符数字下划线组成且不能为空');
			return;
		}
		$.ajax({
			type:'post',
			url:"/zhou/weiyi",
			data:{title:title},
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