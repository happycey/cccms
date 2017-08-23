<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/html5shiv.js"></script>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/respond.min.js"></script>
<![endif]-->
<link href="http://www.one.com/static/ui/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="http://www.one.com/static/ui/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="http://www.one.com/static/ui/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="http://www.one.com/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理后台登录</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="<?php echo U(login);?>" method="post" id="form-login">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="name" name="name" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" name="code" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
          <img class="verify" src="<?php echo U(verify);?>" alt="验证码" onClick="this.src=this.src+'?'+Math.random()" />
      </div>
      <div class="row cl">
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer"></div>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://www.one.com/static/ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="http://www.one.com/static/ui/lib/jquery.validation/1.14.0/messages_zh.js"></script>

<script>
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	$("#form-login").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:16
			},
			password:{
				required:true,
				minlength:6,
				maxlength:16
			},
			code:{
				required:true,
				minlength:4,
				maxlength:4
			}
		},
		submitHandler:function(form){
			var data = $(form).serialize();
			var url = '<?php echo U(login);?>';
			$.ajax({
				url: url,
				type: 'post',
				data:data,
				success: function(data) {
					window.location.href= "<?php echo U('index');?>";
				}
			});
		}
	});
});

</script>