<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>品牌添加</h3>
<form method="post" action="{{url('/brand/store')}}" enctype="multipart/form-data">
	@csrf
	<table border="1px">
		<tr>
			<td>品牌名称</td>
			<td><input type="text" name="brand_name"></td>
		</tr>
		<tr>
			<td>品牌LOGO</td>
			<td><input type="file" name="brand_logo"></td>
		</tr>
		<tr>
			<td>品牌网站</td>
			<td><input type="text" name="brand_url"></td>
		</tr>
		<tr>
			<td>品牌描述</td>
			<td><input type="text" name="brand_desc"></td>
		</tr>
		<tr>
			<td></td>
			<td><button>添加</button></td>
		</tr>
	</table>
</form>
</body>
</html>