<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Test as TestModel;
use app\index\model\Score as ScoreModel;


class Finish extends controller
{
    public function finish()
    {
        $data=input('post.');
        $test=new TestModel;
        $score=0;
        for ($a=1;$a<=30;$a++)
        {
            $cc=array_key_exists($a,$data);
            if($cc){
            $answer=$test->where('id',$a)->find();
            if($data[$a]==$answer->answer)
            {
              $score=$score+10;           
        }   
    }
        }
        $sc=new ScoreModel();
        $per=$sc->where('username',session('username'))->find();
        if($per==false){
            $user = ['username'=>session('username'),'score'=>$score];
            $sc->insert($user);
        }
        $fs=$per->score;
        if($fs<$score){
            $del=$sc->where('username',session('username'))->delete();
            $user = ['username'=>session('username'),'score'=>$score];
            $sc->insert($user);
        }
        if($fs<60){
            $dj='不及格';
        }
        if(60<=$fs && $fs>90)
         {
          $dj='良好';
        }
        if ($fs>90) {
          $dj='优秀';
        }
        $this->assign('dj', $dj);
        $this->assign('fs', $score);
        return $this->fetch();
    }
}
