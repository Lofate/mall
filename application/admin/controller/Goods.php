<?php 
	namespace app\admin\controller;
	//导入基类
	use think\Controller;
	use think\Db;
	use think\Session;
	use think\Config;
	use app\admin\controller\Allow;
	class Goods extends Allow{
		//商品添加模块
		public function getAdd(){
			$list=Db::table("cates")->select();
			$data=$this->getcates();			
			return $this->fetch("Admingoods/add",["list"=>$list,"data"=>$data]);
		}
		//执行添加
		public function postInsert(){
			$request=request();
        	$data=$request->only(['name','price','size','gid']);
        	// var_dump($data);exit;   	
   			// 获取文件
   			$file=$request->file('pic');
   			//移动到指定的目录下
        	if($file){
             	//  /public/uploads
            	$info=$file->move(ROOT_PATH.'public'.DS.'uploads');
            	//获取文件后缀
            	$ext=$info->getExtension();
            //获取文件信息
            	$message=$info->getSaveName();
            	// echo $message;
            	// echo $ext;

            	// exit;
        	}
        	//图片名
        	$data['pic']=$message;
        	// echo "<pre>";
        	// var_dump($data);exit;
        	if(Db::table("admin_goods")->insert($data)){
        		//上传成功
        		$this->success("商品添加成功","/goods/index");
        	}else{
        		unlink($info);
        		//上传失败
        		$this->error("商品添加失败","/goods/add");
        	}
		}
		//分隔符,排序  concat  创建一个字段,拼接
    	public function getCates(){
        	$data=Db::query("select *,concat(path,',',id) as paths from `cates` order by paths;");
        	foreach($data as $k=>$v){
            	// echo $v['path'].'<br>';
            	// 获取逗号有几个,转换为数组   str_repeat()   重复一个字符串 参数一是字符串,参数二是次数
            	$info=explode(',',$v['path']);
            	$len=count($info)-1;
            	$data[$k]['name']=str_repeat('--|',$len).$v['name'];
        	}
        	return $data;
    	}
		//商品列表模块
		public function getIndex(){
			$request=request();
			$id=$request->param("gid");
			$data=Db::table("admin_goods")->select();
			// var_dump($data);exit;
			$arr=Array();
			foreach($data as $row){
				$id=$row['gid'];
				$data1=Db::table("cates")->where("id",$id)->select();
				foreach($data1 as $r){
					$name=$r['name'];
				}
				$arr[$id]=$name;
			}

			// $row['type']=$data1[0]['name'];
			return $this->fetch("Admingoods/index",["data"=>$data,"arr"=>$arr]);
		}
		public function getDelete(){
			$request=request();
			$data=$request->param('id');
			// echo $data;
			$data1=Db::table("admin_goods")->where('id',$data)->find();
			$data2=Db::table("admin_goodsinfo")->where("id",$data)->find();
			if($data2){
				$this->error("请先删除该商品内容","/goodsinfo/index/id/".$data);
			}else{
				$path='./uploads/'.$data1['pic'];
				if(Db::table("admin_goods")->where("id",$data)->delete()){
					unlink($path);
					$this->success("删除成功","/goods/index");
				}else{
					$this->error("删除失败","/goods/index");
				}
			}
			
		}
		//修改模块
		public function getEdit(){
			$request=request();
			//获取id
			$id=$request->param('id');
			$data = Db::table('admin_goods')->where('id',$id)->find();
			//获取商品类型id
			$gid=$data['gid'];
			//通过商品id得到商品数据
			$list=Db::table("cates")->select();
			return $this->fetch('Admingoods/edit',['data'=>$data,'list'=>$list]);
		}
		//执行修改
		public function postUpdate(){
			$request=request();
			$data=$request->only(['id','name','price','size','gid','pic']);
			
			$file=$request->file('pic');
			//移动到指定的目录下
        	if($file){
             	//  /public/uploads
            	$info=$file->move(ROOT_PATH.'public'.DS.'uploads');
            	//获取文件后缀
            	// $ext=$info->getExtension();
            	//获取文件信息
            	$message=$info->getSaveName();
            	//新的
        		$data['pic']=$message;
        		// var_dump($data['pic']);
        		$id=$request->param('id');	
        		$data1=Db::table("admin_goods")->where("id",$id)->find();
        		// var_dump($data1);exit;
        		//上传图片
        		$p=$data1['pic'];
        		$path="./uploads/".$p;
        		// var_dump($path);
        		unlink($path);
        	}else{		
        		$id=$request->param('id');
        		$data1=Db::table("admin_goods")->where("id",$id)->find();
        		$data['pic']=$data1['pic'];
        	}
        	// var_dump($data);exit;
			if(Db::table('admin_goods')->where('id',$id)->update($data)){
				$this->success('用户修改成功','/goods/index');
			}else{
				$this->error('用户修改失败','/goods/edit/id/'.$id);
			}
		}
	}
 ?>