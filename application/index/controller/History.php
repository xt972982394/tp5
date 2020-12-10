<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Test as TestModel;
use app\index\model\Score as ScoreModel;


class History extends controller
{
    public function history()
    {
      $sc=new ScoreModel();
      $per=$sc->where('username',session('username'))->find();
      if($per==false)
      {
          $fs='答题得';
      }else{
        $fs=$per->score;
      }
      $this->assign('fs', $fs);
      return $this->fetch();
    }
}