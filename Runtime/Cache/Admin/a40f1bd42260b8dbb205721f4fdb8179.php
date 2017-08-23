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


<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="javascript:;">后台管理系统</a>
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				<li>欢迎光临，</li>
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A"><?php echo ($_SESSION['user']['user_name']); ?><i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="<?php echo U('Admin/Index/logout');?>">退出</a></li>
				</ul>
			</li>
				<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
						<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
						<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
						<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
						<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
						<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<?php if(is_array($nav_data)): foreach($nav_data as $key=>$vo): ?><dl>
				<dt><i class="Hui-iconfont"><?php echo ($vo["nav_ico"]); ?> </i><?php echo ($vo["_name"]); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
				<dd>
						<ul>
							<?php if(is_array($vo["list"])): foreach($vo["list"] as $key=>$li): ?><li><a data-href="<?php echo U($li['nav_mca']);?>" data-title="<?php echo ($li["nav_name"]); ?>" href="javascript:void(0)"><?php echo ($li["nav_name"]); ?></a></li><?php endforeach; endif; ?>
						</ul>
				</dd>
			</dl><?php endforeach; endif; ?>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="后台管理" data-href="<?php echo U('nav/index');?>">后台管理</span>
					<em></em></li>
		</ul>
	</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo U('Admin/Index/welcome');?>"></iframe>
	</div>
</div>
</section>



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