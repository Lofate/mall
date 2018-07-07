<?php 
	namespace app\index\controller;
	//导入基类
	use think\Controller;
	use think\Db;
	use think\Session;
	use think\Config;
	class GoodsInfo extends Controller{
		public function getIndex(){
			$data=$this->getCatesBypid(0);
			$request=request();
			//接收参数
			$id=$request->param('id');
			//通过id查找到商品信息
			$data1=Db::table("admin_goods")->where("id",$id)->find();
			//拿到商品的id也就是分类表中的gid
			$gid=$data1['gid'];
			
			$data2=Db::table("admin_goodsinfo")->where("id",$id)->find();
			$data3=Db::table("admin_goods")->select();
			//取前五个数组放在data4中
			$data4=array_slice($data3,0,5);
			//通过分类id拿到该商品的前两级名称
			$data5=Db::table("cates")->where("id",$gid)->find();
			$pid=$data5['pid'];
			$data6=Db::table("cates")->where("id",$pid)->find();
			// var_dump($data2);
			return $this->fetch("Goods/info/index",["data"=>$data,"data1"=>$data1,"data2"=>$data2,"data4"=>$data4,"data5"=>$data5,"data6"=>$data6]);
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

    	//添加商品到购物车
    	public function getAddcart(){
			$request=request();
	    	$data['good_id']=$request->param('id');
	    	$data['num']=$request->param('num');
	    	$data['user_id']=Session::get('uid');
	    	// echo $data['user_id'];
	    	//如果是购物车中已存在的商品 数量加
	    	$info=Db::table("carts")->where(['good_id'=>$data['good_id'],'user_id'=>$data['user_id']])->find();
	    	
	    	if(!empty($info)){
	    		$data['num']=$info['num']+$data['num'];
	    		if(Db::table("carts")->where('good_id',$data['good_id'])->update(['num'=>$data['num']])){
	    			echo 1;
	    		}else{
	    			echo 0;
	    		}
	    	}else{
	    		if(Db::table("carts")->insert($data)){
	    			echo 1;
	    		}else{
	    			echo 0;
	    		}
	    	}   	
		}
	}
 ?>