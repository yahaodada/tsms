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
<center><h1>添加外来人口</h1></center>
<form  action="{{url('/people/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="username" id="firstname" 
				   placeholder="请输入名字">
			<b style="color:red">{{$errors->first('username')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="age" id="firstname" 
				   placeholder="请输入年龄">
			<b style="color:red">{{$errors->first('age')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">身份证号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="card" id="firstname" 
				   placeholder="请输入身份证">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否来自湖北</label>
		<div class="radio">
    <label>
        <input type="radio" name="is_hubei" id="optionsRadios1" value="1" >是<br><br>
        <input type="radio" name="is_hubei" id="optionsRadios1" value="2" checked>否
        
    </label>
</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-8">
			<input type="file" name="head" class="form-control"  
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加<tton>
		</div>
	</div>
</form>

</body>
</html>
