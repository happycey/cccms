<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class FunsController extends Controller {
    public function index() {
        $this->display();
    }
    
    public function to_ajax() {
        $fun_name = I('fun_name',false);
        $this->$fun_name();
    }
    
    public function func_get_args() {
        $data = $this->foo(1,'d',3,4,5);
        exit($data);
    }
    
    function foo() {
        $html = '<div style="width:200px;height:100px;margin:20px 20px;"><p>';
        $numargs = func_num_args(); //参数数量
        $html .= '<span>参数的个数是：' . $numargs . '</span><br/>';
        if ($numargs >= 2) {
            $html .= '<span>第二个参数是：' . func_get_arg(1) . '</span><br/>';
        }
        $arg_list = func_get_args();
        for ($i = 0; $i < $numargs; $i++) {
            $html .= "<span>第{$i}个参数值：" . $arg_list[$i] . '</span><br />';
        }
        $html .= '</p></div>';
        return $html;
    }
}