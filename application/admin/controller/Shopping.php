<?php 
	namespace app\admin\controller;
	//导入基类
	use think\Controller;
	use think\Db;
	use think\Session;
	use think\Config;
    use app\admin\controller\Allow;
	class Shopping extends Allow{
        //添加限时商品
		public function getAdd(){
			$list=Db::table("admin_goods")->select();
			// var_dump($list);exit;
			return $this->fetch("Shopping/add",["list"=>$list]);
		}
        //执行添加
		public function postInsert(){
			$request=request();
			$data=$request->only(['goods_id','hour','min','status']);
			if(Db::table("shopping")->insert($data)){
				$this->success("添加成功","/shopping/index/name");
			}else{
				$this->error("添加失败","/shopping/add");
			}
		}
        //显示商品列表
		public function getIndex(){
			$request=request();
			$data=Db::table("shopping")->select();
			// var_dump($data);
			//遍历出该商品的内容
			$arr=Array();
			foreach($data as $v){
				//通过name查找商品详情
				$data1=Db::table("admin_goods")->where("id",$v['goods_id'])->find();
				$arr[]=$data1;
			}

				// var_dump($arr);exit;
			return $this->fetch("Shopping/index",["data"=>$data,"arr"=>$arr]);
		}
		//商品ajax操作,按钮操作后台数据status
    	public function getAjax(){
        	$request=request();
        	$id=$request->param('id');
        	// var_dump($id);exit;
        	$list=Db::table('shopping')->where('goods_id',$id)->find();
        	if($list['status']==0){
           		Db::query("update shopping set status=1 where goods_id=$id");
        	}else{
            	Db::query("update shopping set status=0 where goods_id=$id");
        	}
        	return 1;
    	}
        //删除限时商品
    	public function getDelete(){
    		$request=request();
    		$goods_id=$request->param("goods_id");
    		// var_dump($goods_id);
    		if(Db::table("shopping")->where("goods_id",$goods_id)->delete()){
    			$this->success("删除成功","/shopping/index");
    		}else{
    			$this->error("删除失败","/shopping/index");
    		}
    	}
        //修改限时商品
    	public function getEdit(){
    		$request=request();
    		$goods_id=$request->param("goods_id");
    		// var_dump($goods_id);
    		$data=Db::table("shopping")->where("goods_id",$goods_id)->find();
    		//查找商品内容
    		$data1=Db::table("admin_goods")->where("id",$goods_id)->find();
    		$list=Db::table("admin_goods")->select();
    		return $this->fetch("Shopping/edit",['data'=>$data,'data1'=>$data1,'list'=>$list]);
    	}
        //执行修改
    	public function postUpdate(){
    		$request=request();
    		$id=$request->param("id");
    		$data=$request->only(['id','goods_id','hour','min','status']);
    		// var_dump($data);
    		if(Db::table("shopping")->update($data)){
    			$this->success("修改成功","/shopping/index");
    		}else{
    			$this->error("修改失败","/shopping/edit/id".$id);
    		}
    	}
	}
 ?>