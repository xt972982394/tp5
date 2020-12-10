<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Users as UsersModel;

class Person extends controller
{
    public function person()
    {
        if(!session('username')){
            $this->error('请先登陆','Index/index');
        }else{ 
            session('username');
        return $this->fetch();
    }
    }
    public function loginout()
    {
      session(null);
      $this->success('退出成功','Index/index');
    }

}