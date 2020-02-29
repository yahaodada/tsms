<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>学生的添加</h1>
<form method="post" action="{{url('student/store')}}" enctype="multipart/form-data">
	@csrf
	<table border="1px">
		<tr>
			<td>学生姓名</td>
			<td><input type="text" name="name"><b style="color:red">{{$errors->first('name')}}</b>	 </td>
		</tr>
		<tr>
			<td>性别</td>
			<td><input type="radio" name="sex" value="1">男<input type="radio" name="sex" value="2" checked>女</td>
		</tr>
		<tr>
			<td>班级</td>
			<td><input type="text" name="class"></td>
		</tr>
		<tr>
			<td>成绩</td>
			<td><input type="text" name="num"><b style="color:red">{{$errors->first('num')}}</b>	 </td>
		</tr>
		<tr>
			<td>头像</td>
			<td><input type="file" name="img"></td>
		</tr>
		<tr>
			<td></td>
			<td><button>添加</button></td>
		</tr>
	</table>
</form>
</body>
</html>
<script type="text/javascript"></script>
<script type="text/javascript"></script>