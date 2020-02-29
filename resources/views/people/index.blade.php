<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>外来人口列表</h1></center>
<form class="form-horizontal" role="form">
	<div class="form-group">
		<div class="col-sm-8">
			<input type="text" class="form-control" name="username"value="{{$username}}" id="firstname" 
				   placeholder="请输入用户名字">  
		</div>
		<button type="submit" class="btn btn-default">搜索<tton>
	</div>
</form>
  <table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>姓名</th>
			<th>年龄</th>
			<th>头像</th>
			<th>身份证</th>
			<th>是否是湖北人</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->p_id}}</td>
			<td>{{$v->username}}</td>
			<td>{{$v->age}}</td>
			<td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}"width="50px"height="50px">@endif</td>
			<td>{{$v->card}}</td>
			<td>{{$v->is_hubei==1?'√':'×'}}</td>
			<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
			<td><a href="{{url('people/edit/'.$v->p_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('people/destroy/'.$v->p_id)}}" class="btn btn-danger">删除</a></td>			
		</tr>
		@endforeach
		<tr><td colspan="7">{{$data->appends(['username'=>$username])->links()}}</td></tr>
	</tbody>
</table>

</body>
<ml>
