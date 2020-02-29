  <meta name="csrf-token" content="{{ csrf_token() }}">
  @extends('layouts.shop')
  @section('title','注册')
  @section('content')

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/admins/store')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码"name="user_tel" /><b style="color:red"></b></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="yanz"/><b style="color:red"></b> <button type="button" class="button">获取验证码</button><b style="color:red"></b></div>
       <div class="lrList"><input type="text" placeholder="设置新密码（6-18位数字或字母）" name="user_pwd"/>
        <b style="color:red"></b></div>
       <div class="lrList"><input type="text" placeholder="再次输入密码"  namee="user_pwds"/><b style="color:red"></b></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" class="btn"/>
      </div>
     </form><!--reg-login/-->
@endsection 
<script src="/static/js/jquery.min.js"></script>
<script type="text/javascript">  
$.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(this).next().html('');
$(document).on('blur','input[name="user_pwd"]',function(){
  var _this=$(this);
  var goodsscrice=_this.val();
  var r_pwd=/^\w{6,}$/;
  if (!r_pwd.test(goodsscrice)) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    _this.next('b').html('密码长度数字、字母、下划线组成不能少于六位');
  }else{
    $(this).next().html('');
  }
})
$(document).on('blur','input[namee="user_pwds"]',function(){
  var _this=$(this);
  var user_pwds=_this.val();
  var user_pwd=$('input[name="user_pwd"]').val();
  var r_pwd=/^\w{6,}$/
  if (!r_pwd.test(user_pwds)) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    _this.next('b').html('密码长度数字、字母、下划线组成不能少于六位');
  }
  if (user_pwds!=user_pwd) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    _this.next('b').html('俩次输入的密码不一致');
  }else{
    $(this).next().html('');
  }
})
$(document).on('blur','input[name="user_tel"]',function(){
  var _this=$(this);
  var user_tel=_this.val();
  var r_tel=/^1[3,5,8]\d{9}$/;
  if (!r_tel.test(user_tel)) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    _this.next('b').html('手机格式不正确');
    return;
  }else{
    $(this).next().html('');
  }
  // alert(user_tel);
  $.get(
    "{{url('admins/weiyi')}}",
    {user_tel:user_tel},
    function(index){
      // alert(index);
      if(index=='OK'){
        _this.next('b').html('该用户已存在');
        return;
      }
    }
    )
})
$(document).on('click','.button',function(){
    var _this=$(this);
    var user_tel=$('input[name="user_tel"]').val();
    var r_tel=/^1[3,5,8]\d{9}$/;
    if (!r_tel.test(user_tel)) {
      // alert('商品名称由数字字母中文下划线组成最少2位');
      _this.next('b').html('请输入手机号');
      return;
    }else{
      $(this).next().html('');
    }
    // alert(user_tel);
    $.ajax({
      type:'get',
      url:"/index/ajaxsend",
      data:{user_tel:user_tel},
      dataType:"json",
      async:false,
      success:function(index){
        if(index.code=='00000'){
          alert(index.msg);
        }
      }
    })
    // alert(1);
})
$(document).on('click','.btn',function(){
  var goodsscrice=$('input[name="user_pwd"]').val();
  var r_pwd=/^\w{6,}$/;
  if (!r_pwd.test(goodsscrice)) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    $('input[name="user_pwd"]').next('b').html('密码长度数字、字母、下划线组成不能少于六位');
    return;
  }
  var user_pwds=$('input[namee="user_pwds"]').val();
  var user_pwd=$('input[name="user_pwd"]').val();
  var r_pwd=/^\w{6,}$/
  if (!r_pwd.test(user_pwds)) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    $('input[namee="user_pwds"]').next('b').html('密码长度数字、字母、下划线组成不能少于六位');
  }
  if (user_pwds!=user_pwd) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
   $('input[namee="user_pwds"]').next('b').html('俩次输入的密码不一致');
  }
  var user_tel=$('input[name="user_tel"]').val();
  var r_tel=/^1[3,5,8]\d{9}$/;
  if (!r_tel.test(user_tel)) {
    // alert('商品名称由数字字母中文下划线组成最少2位');
    $('input[name="user_tel"]').next('b').html('手机格式不正确');
    return;
  }else{
    $('input[name="user_tel"]').next().html('');
  }
  // alert(user_tel);
  var titleflag=true;
  $.ajax({
      type:'get',
      url:"/admins/weiyi",
      data:{user_tel:user_tel},
      async:false,
      success:function(index){
        if(index=='OK'){
        $('input[name="user_tel"]').next('b').html('该用户已存在');
        titleflag=false;
        }
      }
  })
    if (!titleflag) {
      return;
    }
  // var yanz=$('input[nname="yanz"]').val();
  // var sess=session('code');
  //   if(yanz!=sess){
  //       $('input[nname="yanz"]').next('b').html('验证码错误');
  //       return;
  //   }
  $('form').submit();
})
</script> 