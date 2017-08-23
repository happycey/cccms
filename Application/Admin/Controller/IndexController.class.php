<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if (!check_login()) {
            $this->redirect('login');
        }
        $this->display();
    }

    /**
     * 后台登录
     */
    public function login() {
        if (!empty($_POST)) {
            $code = I('code', false);
            $check = $this->check_verify($code);
            if ($check == false) {
                $this->error('验证码输入错误');
            }
            $user_name = I('name', false);
            $user_password = md5(I('password', false));
            $where = array(
                'username' => $user_name,
                'password' => $user_password
            );
            $data = M('Users')->where($where)->find();
            if (empty($data)) {
                $this->error('账号或密码错误');
            }else{
                //更新登录时间和登录ip
                $ip = get_client_ip();
                $update_data = array(
                    'last_login_ip' => $ip,
                    'last_login_time' => time()
                );
                D('Users')->editData($where,$update_data);

                $_SESSION['user'] = array(
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'avatar' => $data['avatar'],
                    'last_login_ip' => $ip,
                    'last_login_time' => date('Y-m-d H:i:s',time())
                );
                $this->redirect('index');
            }
        } else {
            $this->display('login');
        }
    }
    
    /**
     * 后台退出
     */
    public function logout(){
        session('user',null);
        $this->redirect('index');
    }
    
    /**
     * 欢迎页面
     */
    public function welcome()
    {
        $nowTime = date('Y-m-d H:i:s', time());
        $data = array(
            'nowTime'=>$nowTime,
            'last_login_ip' => $_SESSION['user']['last_login_ip'],
            'last_login_time' => $_SESSION['user']['last_login_time']
        );
        $this->assign(array('data'=>$data));
        $this->display();
    }

    /**
     * 生成验证码
     */
    public function verify()
    {
        // 实例化Verify对象
        $verify = new \Think\Verify();

        // 配置验证码参数
        $verify->fontSize = 14; // 验证码字体大小
        $verify->length = 4; // 验证码位数
        $verify->imageH = 34; // 验证码高度
        $verify->useNoise = false; // 关闭验证码干扰杂点
        $verify->entry();
    }

    /**
     * 检测输入的验证码是否正确
     */
    function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
}