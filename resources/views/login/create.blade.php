<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员登陆</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>管理员登陆</h1></center>
<form  action="{{url('/login/logindo')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<center><b style="color:red">{{session('errors')}}</b></center>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员账号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="user_name" id="firstname" 
				   placeholder="请输入名字">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name="password" id="firstname" 
				   placeholder="请输入年龄">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登陆<tton>
		</div>
	</div>
</form>

</body>
</html>
