<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Users as UsersModel;

class Index extends controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function check()
    {
        $data = input('post.');
        $user = new UsersModel();
        $result = $user->where('username',$data['username'])->find();
        if($result){
             if ($result['password'] === $data['password'])
             {
               session('username',$data['username']);
               $this->success('登录成功',url('Person/person'));
             }else{
                $this->error('密码错误');
            }
        }else{
            $this->error('用户名不存在');

        }   
    }
    public function add()
    {
        $data = input('post.');
        $i =new UsersModel();
        $user = new UsersModel();
        $result = $i->where('username',$data['username'])->find();
        if($data['username']===$result['username'])
        {
            $this->error("该用户名已注册");
            exit;
        }else{        
        $inset = $user->insert($data);
        if($inset){
            $this->success("注册成功");
        }
        }
    }
}
