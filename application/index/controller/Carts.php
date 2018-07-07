<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class Carts extends Allow
{

    public function getIndex()
    {
    	// var_dump($username);
    	// exit();
    	$uid=Session::get('uid');
    	// if(empty($username)){
    	// 	$this->error("请先登录","/login/index");
    	// }

    	$data=Db::table("carts")->where('user_id',$uid)->select();
    	if(empty($data)){
    		return $this->fetch('Cart/empty');
    	}
    	
    	foreach($data as $key=>$val){
    		$info=Db::table("admin_goods")->where('id',$val['good_id'])->find();
    		// var_dump($info);
    		$data[$key]['name']=$info['name'];
    		$data[$key]['price']=$info['price'];
    		
    		$path="/uploads/".$info['pic'];
    		$data[$key]['pic']=str_replace('\\', '/', $path);
    	}

    	// var_dump($data);
        return $this->fetch('Cart/index',['data'=>$data]);
    }

    
    //修改购物车 Ajax数据处理函数
    public function getAddnum(){
    	$request=request();
    	$num=$request->param('num');
    	$id=$request->param('id');

    	// echo $num;
    	// echo 1;
    	$res=Db::table("carts")->where('id',$id)->update(['num'=>$num]);
    	echo $res;
    }

    //Ajax删除选中的商品
    public function getDel(){
    	$arr=isset($_GET['arr'])?$_GET['arr']:'';

    	if(!empty($arr)){
    		Db::startTrans();
	    	foreach($arr as $val){
	    		try{
				    Db::table("carts")->where("id",$val)->delete();
				    // 提交事务
				    Db::commit();    
				} catch (\Exception $e) {
				    // 回滚事务
				    echo 0;
				    Db::rollback();
				    exit;
				}
	    	}
    	}
    	echo 1;
    }

    //清空购物车
    public function getAlldel(){
    	$uid=Session::get('uid');
    	// echo 111;
    	if(Db::table("carts")->where("user_id",$uid)->delete()){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }

    //删除商品
    public function getDelete(){
    	$request=request();
    	$id=$request->param('id');
    	if(Db::table("carts")->where("id",$id)->delete()){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
}
