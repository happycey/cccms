<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>

<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="http://www.cc.com/static/ui/lib/html5shiv.js"></script>
<script type="text/javascript" src="http://www.cc.com/static/ui/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="http://www.cc.com/static/ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="http://www.cc.com/static/ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="http://www.cc.com/static/ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="http://www.cc.com/static/ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="http://www.cc.com/static/ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://www.cc.com/static/ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<title><?php echo ((isset($header["title"]) && ($header["title"] !== ""))?($header["title"]):"后台管理"); ?></title>
</head>
<body>


<div class="page-container">
	<p class="f-20 text-success">欢迎使用后台管理系统！</p>
	<p>当前时间：<?php echo ($data["nowTime"]); ?></p>
	<p>上次登录IP：<?php echo ($data["last_login_ip"]); ?>  上次登录时间：<?php echo ($data["last_login_time"]); ?></p>
</div>



<script type="text/javascript" src="http://www.cc.com/static/ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://www.cc.com/static/ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="http://www.cc.com/static/ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="http://www.cc.com/static/ui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
/**
 * 工具栏操作方法
 * obj 传this
 * checkbox_dom传列表复选框dom，默认复选框class=ids
 * -------------------------------------------
 * 默认AJAX操作
 * -------------------------------------------
 * 示例(title用于提示，url用于跳转)：
 * <a title="删除" url="<?php echo U('del');?>" onclick="toolbar_handle(this)"></a>
 * <input type="checkbox" name="ids[]" value="<?php echo ($v["cat_id"]); ?>" class="ids" />
 * -------------------------------------------
 */
function toolbar_handle(obj,is_ajax,checkbox_dom){
	var is_ajax = is_ajax || true;
	var url = $(obj).attr('url');
	var msg = $(obj).attr('title') || '操作';
	msg = '确定'+msg+"？";
	var checkbox_dom = checkbox_dom || ".ids";
	var ids = $(checkbox_dom+':checked');
	var param = '';
	if(url == undefined && url == ''){
		layer.alert('链接异常！');
		return false;
	}
	if(ids.length > 0){
		layer.confirm(msg,function(){
			var str = new Array();
			ids.each(function(){
				str.push($(this).val());
			});
			param = str.join(',');
			if(is_ajax){
				$.ajax({
					type: 'POST',
					url: url,
					data:{"ids":param},
					dataType: 'json',
					success: function(data){
						layer.msg('操作成功!',{icon: 6,time:1000},function(){
							document.location.reload();
						});
					},
					error:function(data) {
						console.log(data.msg);
					},
				});
			}else{
				window.location.href = url + '/ids/' + param;
			}
		});
	}else{
		layer.alert('请至少选项一项！');
	}
}

function toolbar_rec(obj,is_ajax,checkbox_dom){
	var is_ajax = is_ajax || true;
	var url = $(obj).attr('url');
	var msg = $(obj).attr('title') || '操作';
	msg = '确定'+msg+"？";
	var checkbox_dom = checkbox_dom || ".ids";
	var ids = $(checkbox_dom+':checked');
	var param = '';
	if(url == undefined && url == ''){
		layer.alert('链接异常！');
		return false;
	}
	if(ids.length > 0){
		var str = new Array();
		ids.each(function(){
			str.push($(this).val());
		});
		param = str.join(',');
		layer_show('推荐','/vod/rec?id='+param,'600','510');
	}else{
		layer.alert('请至少选项一项！');
	}
}
 
 /*添加/修改*/
 function _add(title,url,w,h){
 	layer_show(title,url,w,h);
 }
 /*下线*/
 function _offline(obj,id){
 	layer.confirm('确认要下线吗？',function(index){
 		$.ajax({
 			type: 'POST',
 			url: '<?php echo U("offline");?>',
 			data:{"ids":id},
 			dataType: 'json',
 			success: function(data){
 				layer.msg('已下线!',{icon: 6,time:1000},function(){
 					document.location.reload();
 				});
 			},
 			error:function(data) {
 				console.log(data.msg);
 			},
 		});		
 	});
 }

/*发布*/
function _publish(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '<?php echo U("publish");?>',
			data:{"ids":id},
			dataType: 'json',
			success: function(data){
				layer.msg('已发布!',{icon: 6,time:1000},function(){
					document.location.reload();
				});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
</script>

	<script type="text/javascript" src="http://www.cc.com/static/ui/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>

</body>
</html>