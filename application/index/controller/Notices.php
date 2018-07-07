<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class Notices extends Controller
{
	

    public function getIndex()
    {
        $request=request();
    	// var_dump($request->param('id'));exit;
        $id=$request->param('id');
        $datas=Db::table('notice')->where('id',$id)->select();
        $datass=Db::table('notice')->select();
        $data=$this->getCatesBypid(0);
        // dump($datas);exit; 
        return $this->fetch('Notices/index',['data'=>$data,'datas'=>$datas,'datass'=>$datass]);
    }


     public function getCatesBypid($pid){
        $data=Db::table('cates')->where('pid',"{$pid}")->select();
        $info=[];
        // var_dump($data);
        foreach($data as $k=>$v){
            $v['shop']=$this->getCatesBypid($v['id']);
            $info[]=$v;
        }
        return $info;
    }
    
    
}
