<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>品牌展示</h3>
<table border="1px">
	<tr>
		<td>品牌编号</td>
		<td>品牌名称</td>
		<td>品牌LOGO</td>
		<td>品牌网站</td>
		<td>品牌描述</td>
		<td>品牌操作</td>
	</tr>
	@foreach($res as $k=>$v)
	<tr>
		<td>{{$v->brand_id}}</td>
		<td>{{$v->brand_name}}</td>
		<td>@if($v->brand_logo)<img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50px" height="50px">@endif</td>
		<td>{{$v->brand_url}}</td>
		<td>{{$v->brand_desc}}</td>
		<td><a href="{{url('/brand/edit/'.$v->brand_id)}}">编辑</a>||
			<a href="{{url('/brand/destroy/'.$v->brand_id)}}">删除</a></td>
	</tr>
	@endforeach
</table>
</body>
</html>