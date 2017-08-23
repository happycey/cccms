<?php
/**
 * suggest.php 
 * Demo 提取搜索建议(输出JSON)
 * 
 * 该文件由 xunsearch PHP-SDK 工具自动生成，请根据实际需求进行修改
 * 创建时间：2017-08-20 15:55:48
 */
// 加载 XS 入口文件
require_once 'F:\www\one\Application\Common\Org\xs\lib\XS.php';
// Prefix Query is: term (by jQuery-ui)
$q = isset($_GET['term']) ? trim($_GET['term']) : '';
$q = get_magic_quotes_gpc() ? stripslashes($q) : $q;
$terms = array();
if (!empty($q) && strpos($q, ':') === false) {
	try {
		$xs = new XS('demo');
		$terms = $xs->search->setCharset('UTF-8')->getExpandedQuery($q);
	} catch (XSException $e) {
		
	}
}

// output json
header("Content-Type: application/json; charset=utf-8");
echo json_encode($terms);
exit(0);
