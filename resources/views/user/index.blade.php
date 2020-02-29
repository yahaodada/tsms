<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员展示</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>管理员列表</h1></center>
  <table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>管理员名字</th>
			<th>管理员手机号</th>
			<th>管理员邮箱</th>
			<th>管理员头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->user_id}}</td>
			<td>{{$v->user_name}}</td>
			<td>{{$v->user_tel}}</td>
			<td>{{$v->user_email}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->user_img}}" width="50px" height="50px"></td>
			<td><a href="{{url('user/edit/'.$v->user_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('user/destroy/'.$v->user_id)}}" class="btn btn-danger">删除</a></td>			
		</tr>
		@endforeach
		<tr><td colspan="7">{{$res->links()}}</td></tr>
	</tbody>
</table>

</body>
<ml>
