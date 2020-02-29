<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>学生信息展示</h3>
<form>
	<input type="text" name="name" value="{{$name}}"><input type="text" name="class" value="{{$class}}"><input type="submit"value="搜索">
</form>
<table border="1px">
	<tr>
		<td>编号</td>
		<td>名字</td>
		<td>性别</td>
		<td>班级</td>
		<td>成绩</td>
		<td>相册</td>
		<td>操作</td>
	</tr>
	@foreach($data as $k=>$v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->sex==1?'男':'女'}}</td>
		<td>{{$v->class}}</td>
		<td>{{$v->num}}</td>
		<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50px" heighr="50px">@endif</td>
		<td><a href="{{url('student/edit/'.$v->id)}}">编辑</a>
			<a href="{{url('student/destort/'.$v->id)}}">删除</a></td>
	</tr>
	@endforeach
</table>
{{$data->appends(['name'=>$name,'class'=>$class])->links()}}
</body>
</html>