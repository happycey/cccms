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

<link rel="stylesheet" type="text/css" href="http://www.cc.com/static/css/page.css" />

<title><?php echo ((isset($header["title"]) && ($header["title"] !== ""))?($header["title"]):"后台管理"); ?></title>
</head>
<body>


<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 自定义功能 <span class="c-gray en">&gt;</span> 商品管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="<?php echo U('index');?>" method="get">
	<div class="text-c">
		商品名称：<input type="text" class="input-text" style="width:200px" placeholder="商品名称" name="title" value="<?php echo ($_GET['title']); ?>">
		状态：
		<span class="select-box inline">
		<select name="status" class="select">
			<option value="0">全部</option>
			<option value="1" <?php if(($_GET['status']) == "1"): ?>selected="selected"<?php endif; ?>>发布</option>
			<option value="2" <?php if(($_GET['status']) == "2"): ?>selected="selected"<?php endif; ?>>下线</option>
		</select>
		</span>
		<button type="submit" class="btn btn-success radius"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		<input type="hidden" name="pos_id" value="<?php echo ($pos_id); ?>" />
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:;" onclick="toolbar_handle(this)" url="<?php echo U('publish');?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe603;</i> 批量导入</a>
			<a href="javascript:;" onclick="toolbar_handle(this)" url="<?php echo U('offline');?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe631;</i> 批量导出</a>
		</span>
		<span class="r">共有数据：<strong><?php echo ($totalRows); ?></strong> 条</span>
	</div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="ids[]" /></th>
				<th width="50">ID</th>
				<th width="100">标题</th>
				<th width="50">状态</th>
				<th width="100">推荐位</th>
				<th width="50">SID</th>
				<th width="100">更新时间</th>
				<th width="100">描述</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($vo["rec_id"]); ?>" name="ids[]" class="ids" /></td>
				<td><?php echo ($vo["rec_id"]); ?></td>
                <td><?php echo ($vo["rec_title"]); ?></td>
                <td class="td-status"><span class="label <?php if(($vo["rec_status"]) == "1"): ?>label-success<?php else: ?>label-danger<?php endif; ?> radius"><?php echo ($vo['rec_status'] == 1?"发布":($vo['rec_status'] == 0?"未发布":"下线")); ?></span></td>
                <td><?php echo ($pos_row["recp_name"]); ?></td>
                <td><?php echo ($vo["rec_sid"]); ?></td>
                <td><?php echo (date("Y-m-d H:i:s",$vo["rec_utime"])); ?></td>
                <td class="text-l"><?php echo ($vo["rec_desc"]); ?></td>
                <td class="td-manage">
                    <a href="javascript:;" onclick="_add('修改推荐内容','<?php echo U("edit",array("id"=>$vo["rec_id"]));?>','600','510')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
                    <a href="javascript:;" onclick="_publish(this,'<?php echo ($vo["rec_id"]); ?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe603;</i></a> 
                    <a href="javascript:;" onclick="_offline(this,'<?php echo ($vo["rec_id"]); ?>')" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>
                </td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	</div>
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

<script type="text/javascript" src="http://www.cc.com/static/ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<!-- <script type="text/javascript" src="http://www.cc.com/static/ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>  -->
<script type="text/javascript">
$(function(){
});
</script> 

</body>
</html>