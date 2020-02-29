<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>展示</h3>
<form>
<select name="f_id">
		<option value="">全部分类</option>
		<option value="1"@if($f_id==1) selected  @endif>小说</option>
		<option value="2"@if($f_id==2) selected  @endif>散文</option>
		<option value="3"@if($f_id==3) selected  @endif>名著</option>
		<option value="4"@if($f_id==4) selected  @endif>童话</option>
</select>
文章标题<input type="text" name="title" value="{{$title}}">
<button>搜索</button>
</form>
<table border="1px">
	<tr>
		<td>文章id</td>
		<td>文章标题</td>
		<td>文章分类</td>
		<td>文章重要性</td>
		<td>是否显示</td>
		<td>文章作者</td>
		<td>作者email</td>
		<td>关键字</td>
		<td>网页描述</td>
		<td>图片</td>
		<td>编辑</td>
	</tr>
	@foreach($res as $k=>$v)
	<tr c_id="{{$v->id}}">
		<td>{{$v->id}}</td>
		<td>{{$v->title}}</td>
		<td>@if($v->f_id==1)小说@elseif($v->f_id==2)散文@elseif($v->f_id==3)名著@else($v->f_id==4)童话@endif</td>
		<td>@if($v->zyx==1) √ @else × @endif</td>
		<td>@if($v->xs==1) √ @else × @endif</td>
		<td>{{$v->zz}}</td>
		<td>{{$v->email}}</td>
		<td>{{$v->gjz}}</td>
		<td>{{$v->ms}}</td>
		<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50px" height="50">@endif</td>
		<td><a href="{{url('zhou/edit/'.$v->id)}}">编辑</a>||<a href="javascript:;" class="sc">删除</a>
			<!-- <a href="{{url('zhou/destroy/'.$v->id)}}">删除</a> -->
		</td>
	</tr>
	@endforeach
</table>
{{$res->appends(['title'=>$title,'f_id'=>$f_id])->links()}}
</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on("click",".sc",function(){
		if(confirm("是否确定删除？")){
			var _this=$(this);
			var id=_this.parents('tr').attr('c_id');
			$.get(
				"{{url('zhou/shanchu')}}",
				{id:id},
				function(index){
					if(index=='ok'){
						_this.parents('tr').hide();
						location.href="{{url('zhou/index')}}";
					}
				}
				)
		}
	})
	$(document).on('click','.pagination a',function(){
		var url=$(this).attr('href');
		alert(url);
	})
</script>