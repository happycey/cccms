<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class GoodsController extends Controller {
    public function index(){
        $_cond = array(
            'id' => array('gt', 0)
        );
        $goodsList = D('Goods')->getList($_cond);
        $totalRows = D("Goods")->getCount($_cond);
        $page = new Page($totalRows,$listRows);

        $this->assign(array('data'=>$goodsList));
        $this->assign("totalRows",$totalRows);
        $this->assign("page",$page);
        $this->display();
    }
    
    /*
     * csv导入功能
     * -----------------------------
     * 1.弹窗引入layer插件
     * 2.导入的表格是另存为csv的格式
     */
    public function import() {
        $csv_array = explode('.',$_FILES['csv']['name']);
        $file_type = end($csv_array);
        if (!empty($_FILES['csv']) && !empty($_FILES['csv']['name']) && $file_type == 'csv'){
            $fp = @fopen($_FILES['csv']['tmp_name'],'rb');

            $i = 0;
            while (!feof($fp)) {
                $i++;
                $data = trim(fgets($fp, 4096));
                switch (strtoupper($_POST['charset'])){
                    case 'UTF-8':
                        if (strtoupper(CHARSET) !== 'UTF-8')
                            $data = iconv('UTF-8',strtoupper(CHARSET),$data);
                        break;
                    case 'GBK':
                        if (strtoupper(CHARSET) !== 'GBK')
                            $data = iconv('GBK',strtoupper(CHARSET),$data);
                        break;
                }
                
                if ($i == 1) {
                    continue;
                }
                
                if (!empty($data)) {
                    $data = str_replace('"','',$data);
                    $tmp_array = explode(',',$data);
                    $insert_array = array(
                        'goods_name' => trim($tmp_array[0]),
                        'goods_price' => trim($tmp_array[1]),
                        'goods_state' => trim($tmp_array[2]),
                        'goods_addtime' => time()
                    );
                    $result=D('Goods')->addData($insert_array);
                }
            }
        }

        $this->redirect('index');
    }
    
    /*
     * csv导出功能
     * ------------------------------
     * 1.不要js异步请求,否则header无效
     * 2.直接跳转到页面,浏览器才会识别header
     */
    public function export() {
        $_cond = array(
            'id' => array('gt', 0)
        );
        $goodsList = D('Goods')->getList($_cond);
        
        //设置内存占用
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        
        //为fputcsv()函数打开文件句柄
        $output = fopen('php://output', 'w') or die("can't open php://output");
        //告诉浏览器这个是一个csv文件
        $filename = "商品表" . date('Y-m-d', time());
        header("Content-Type:text/html;charset=utf-8");
        header("Content-type:application/force-download");
        header("Content-Type:application/octet-stream");
        header("Content-Type: application/csv");
        header("Accept-Ranges:bytes");
        header("Content-Length:".filesize($filename));//指定下载文件的大小
        header("Content-Disposition: attachment; filename=$filename.csv");
        
        //输出表头
        $table_head = array('商品id','商品名','价格','状态','添加时间');
        fputcsv($output, $table_head);
        //输出每一行数据到文件中
        foreach ($goodsList as $val) {
            //输出内容
            fputcsv($output, array_values($val));
        }

        //关闭文件句柄
        fclose($output) or die("can't close php://output");
        exit;
    }
}