<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>用户管理</h3>
	<table border="1px">
		<tr>
			<td>编号</td>
			<td>管理员名字</td>
			<td>管理员身份</td>
			<td>编辑</td>
		</tr>
		@foreach($res as $v)
		<tr>
			<td>{{$v->guan_id}}</td>
			<td>{{$v->guan_name}}</td>
			<td>{{$v->guan_yh==1?'普通':'主管'}}</td>
			<td><a href="">编辑</a><a href="{{url('cangku/destroy/'.$v->guan_id)}}">删除</a></td>
		</tr>
		@endforeach
	</table>
</body>
</html>