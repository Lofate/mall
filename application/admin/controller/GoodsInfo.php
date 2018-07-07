<?php 
	namespace app\admin\controller;
	//导入基类
	use think\Controller;
	use think\Db;
	use think\Session;
	use think\Config;
	use app\admin\controller\Allow;
	class GoodsInfo extends Allow{
		//显示商品详情
		public function getIndex(){
			$request=request();
			$id=$request->param('id');
			// var_dump($gid);
			$list=Db::table("admin_goodsinfo")->where('id',$id)->select();
			if(empty($list)){
				$list['id']=$id;
				return $this->fetch("Admingoods/info/add",['list'=>$list]);

			// var_dump($list);exit;
			}else{
				// $list['gid']=$gid;
			return $this->fetch("/Admingoods/info/index",['list'=>$list]);
			}
			
		}
		//添加商品详情
		public function getAdd(){
			$request=request();
			$list=$request->only(['id']);
			// var_dump($list);exit;
			return $this->fetch("/Admingoods/info/add",['list'=>$list]);
		}
		//执行商品详情添加
		public function postInsert(){
			$request=request();

			$data=$request->only(['id','num','ship_address','price','address','descr']);

			// 获取文件
   			$file=$request->file('pic');
   			//移动到指定的目录下
        	if($file){
             	//  /public/uploads
            	$info=$file->move(ROOT_PATH.'public'.DS.'goods');
            	//获取文件后缀
            	$ext=$info->getExtension();
            	//获取文件信息
            	$message=$info->getSaveName();
            	// echo $message;
            	// echo $ext;
        		$data['pic']=$message;
        	}
        	// var_dump($data);exit;
        	if(Db::table("admin_goodsinfo")->insert($data)){
        		$this->success("添加成功","/goodsinfo/index/id/".$data['id']);
        	}else{
        		$this->success("添加失败","/goodsinfo/add");
        	}

		}
		//删除商品详情
		public function getDelete(){
			$request=request();
			$id=$request->param('id');
			
			$data=Db::table("admin_goodsinfo")->where('id',$id)->find();
			$path='./goods/'.$data['pic'];
			if(Db::table("admin_goodsinfo")->where('id',$id)->delete($data)){
				unlink($path);
				$this->success("删除成功","/goodsinfo/index");
			}else{
				$this->error("删除失败","./goodsinfo/index");
			}
		}
		//修改商品详情信息
		public function getEdit(){
			$request=request();
			$id=$request->param('id');
			$data=Db::table("admin_goodsinfo")->where("id",$id)->find();
			$data1=Db::table("admin_goods")->where("id",$id)->find();
			// var_dump($data1);
			return $this->fetch("Admingoods/info/edit",['data'=>$data,"data1"=>$data1]);
		}
		//执行修改
		public function postUpdate(){
			$request=request();
			$data=$request->only(['id','num','ship_address','price','address','descr']);
			// var_dump($data);exit;
			$file=$request->file('pic');
			//移动到指定的目录下
        	if($file){
             	//  /public/uploads
            	$info=$file->move(ROOT_PATH.'public'.DS.'goods');
            	//获取文件后缀
            	// $ext=$info->getExtension();
            	//获取文件信息
            	$message=$info->getSaveName();
            	//新的
        		$data['pic']=$message;
        		// var_dump($data['pic']);
        		$id=$request->param('id');
        		$data1=Db::table("admin_goodsinfo")->where("id",$id)->find();
        		// var_dump($data1);exit;
        		//上传图片
        		$p=$data1['pic'];
        		//删除旧图片
        		$path="./goods/".$p;
        		unlink($path);
        	}else{		
        		$id=$request->param('id');
        		$data1=Db::table("admin_goodsinfo")->where("id",$id)->find();
        		//新图片路径
        		$path="./goods/".$data1['pic'];
        		// var_dump($data1);exit;
        		//判断图片是否有变化
        		$data['pic']=$data1['pic'];
        	}

			if(Db::table('admin_goodsinfo')->where('id',$id)->update($data)){

				$this->success('用户修改成功','/goodsinfo/index/id/'.$id);
			}else{
				// unlink($path1);
				$this->error('用户修改失败','/goodsinfo/edit/id/'.$id);
			}
		}
	}
 ?>