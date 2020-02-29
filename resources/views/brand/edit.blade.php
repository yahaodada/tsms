<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>品牌编辑</h3>
<form method="post" action="{{url('/brand/update/'.$v->brand_id)}}" enctype="multipart/form-data">
	@csrf
	<table border="1px">
		<tr>
			<td>品牌名称</td>
			<td><input type="text" name="brand_name" value="{{$v->brand_name}}"></td>
		</tr>
		<tr>
			<td>品牌LOGO</td>
			<td><input type="file" name="brand_logo">@if($v->brand_logo)<img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50px" height="50px">@endif</td>
		</tr>
		<tr>
			<td>品牌网站</td>
			<td><input type="text" name="brand_url"value="{{$v->brand_url}}"></td>
		</tr>
		<tr>
			<td>品牌描述</td>
			<td><input type="text" name="brand_desc"value="{{$v->brand_desc}}"></td>
		</tr>
		<tr>
			<td></td>
			<td><button>编辑</button></td>
		</tr>
	</table>
</form>
</body>
</html>