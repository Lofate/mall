<?php 
	namespace app\index\controller;
	//导入基类
	use think\Controller;
	use think\Db;
	use think\Session;
	use think\Config;
	class Goods extends Controller{
		//显示商品
		public function getIndex(){
			$request=request();
			// $a=$request->param();
			// var_dump($a);exit;
			$gid=$request->param('id');
			// var_dump($gid);
			// 查询分类的数据
			$data=Db::table("cates")->select();
			//通过分类id查询分类商品的信息
			$data1=Db::table("cates")->where("id",$gid)->find();
			// var_dump($data1);
			$data=$this->getCatesBypid(0);
			if($data1['pid']==0){
				// 通过id得到该商品的pid
				$pid=$data1['id'];
				// var_dump($pid);
				// 相同pid的分类信息
				$data2=Db::table("cates")->where("pid",$pid)->select();
				// var_dump($data2);
				$arr=Array();
				foreach($data2 as $k=>$v){
					$goods=Db::table("admin_goods")->where("gid",$v['id'])->select();
					// var_dump($goods);
					$arr[]=$goods;
				}	
				$data3=$data2;
				// var_dump($data3);exit;
				return $this->fetch("Goods/index",["data"=>$data,"data2"=>$data2,"arr"=>$arr,"data3"=>$data3]);
			}else{
				$data3=Db::table("cates")->where("pid",$data1['pid'])->select();
				// var_dump($data3);
				//通过pid得到商品id
				$gid=$data1['id'];
				$data2=Db::table("admin_goods")->where("gid",$gid)->select();
				// var_dump($data2);
				$arr=Array();
				$arr[]=$data2;
				
				return $this->fetch("Goods/index",["data"=>$data,"data2"=>$data2,"arr"=>$arr,"data3"=>$data3]);
			}
			
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
	    	$data['user_id']=Session::get('uid');
	    	// echo $data['user_id'];
	    	//如果是购物车中已存在的商品 数量加1
	    	$info=Db::table("carts")->where(['good_id'=>$data['good_id'],'user_id'=>$data['user_id']])->find();
	    	
	    	if(!empty($info)){
	    		$data['num']=$info['num']+1;
	    		if(Db::table("carts")->where('good_id',$data['good_id'])->update(['num'=>$data['num']])){
	    			echo 1;
	    		}else{
	    			echo 0;
	    		}
	    	}else{
	    		$data['num']=1;
	    		if(Db::table("carts")->insert($data)){
	    			echo 1;
	    		}else{
	    			echo 0;
	    		}
	    	}   	
		}
		public function getShop(){
			$data1=Db::table("shopping")->select();
			$data=$this->getCatesBypid(0);
			$arr=Array();
        	//遍历得到商品的内容
        	foreach($data1 as $v){
            	//通过name查找商品详情
            	$data2=Db::table("admin_goods")->where("id",$v['goods_id'])->find();
            	$arr[]=$data2;
        	}
			// var_dump($arr);exit;
			return $this->fetch("/Goods/shop",['data'=>$data,'arr'=>$arr]);
		}
	}

 ?>