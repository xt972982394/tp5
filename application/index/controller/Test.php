<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Test as TestModel;

class Test extends controller
{
    /*public function test()
    {
        $test = new TestModel();
        $data = $test->field(true)->select();
        $this->assign('tk',$data);
        return $this->fetch();
    }
    */
    public function test(){
        $num = 5;    
        $test = new TestModel();
        $countcus = $test->count();    //count() 返回数组中元素的数目。
        $min = $test->min('id');
        if($countcus < $num){$num = $countcus;}
        $i = 1;
        $flag = 0;
        $ary = array();
        while($i<=$num){ 
            $randnum = rand($min, $countcus);       //rand(min,max) 介于min(或0)与max的随机整数
            if($flag != $randnum){
                //过滤重复 
                if(!in_array($randnum,$ary)){      //in_array(search,array)  search	规定要在数组搜索的值,array 规定要搜索的数组
                    $ary[] = $randnum;
                    $flag = $randnum;
                }else{
                    $i--;
                }
                $i++;
            }
        }
        $list = $test->where('id','in',$ary,'or')->select();
        $this->assign('tk',$list);
        return $this->fetch();
    }
}