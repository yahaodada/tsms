<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>学生的编辑</h1>
<form method="post" action="{{url('student/update/'.$res->id)}}" enctype="multipart/form-data">
	@csrf
	<table border="1px">
		<tr>
			<td>学生姓名</td>
			<td><input type="text" name="name"value="{{$res->name}}"><b style="color:red">{{$errors->first('name')}}</b></td>
		</tr>
		<tr>
			<td>性别</td>
			<td><input type="radio" name="sex" value="1"{{$res->sex=='1'?'checked':''}}>男
				<input type="radio" name="sex" value="2"{{$res->sex=='2'?'checked':''}}>女</td>
		</tr>
		<tr>
			<td>班级</td>
			<td><input type="text" name="class"value="{{$res->class}}"></td>
		</tr>
		<tr>
			<td>成绩</td>
			<td><input type="text" name="num"value="{{$res->num}}"><b style="color:red">{{$errors->first('num')}}</b></td>
		</tr>
		<tr>
			<td>头像</td>
			<td>@if($res->img)<img src="{{env('UPLOAD_URL')}}{{$res->img}}" width="50px" heighr="50px">@endif<input type="file" name="img"></td>
		</tr>
		<tr>
			<td></td>
			<td><button>编辑</button></td>
		</tr>
	</table>
</form>
</body>
</html>