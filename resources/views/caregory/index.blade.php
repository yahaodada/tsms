<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>分类列表</h1></center>
  <table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>分类名称</th>
			<th>是否显示</th>
			<th>是否导航栏显示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat("--",($v->level*2))}}|{{$v->cate_name}}</td>
			<td>{{$v->cate_show==1?'√':'×'}}</td>
			<td>{{$v->cate_nav_show==1?'√':'×'}}</td>
			<td><a href="{{url('caregory/edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('caregory/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a></td>			
		</tr>
		@endforeach
	</tbody>
</table>

</body>
<ml>
