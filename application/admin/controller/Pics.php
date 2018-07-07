<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use app\admin\controller\Allow;
class Pics extends Allow
{
    //轮播图列表
    public function getIndex(){
        $data=Db::table('pics')->paginate(2);
        return $this->fetch('Adminpics/index',['data'=>$data]);
    }
    //轮播图添加页面
    public function getAdd(){
       return $this->fetch('Adminpics/add');
    }
    //轮播图执行添加
    public function postInsert(){
        $request=request();

        $name=$request->param('name');     
        $file=$request->file('pic');
        //做验证
        $result=$this->validate(['file1'=>$file],['file1'=>'require|image'],['file1.require'=>'文件不能为空','file1.image'=>'非法图像文件']);
        if(true!==$result){
            $this->error($result,'/pics/add');
        }
        if($file){
            $info=$file->move(ROOT_PATH.'public'.DS.'lunbotu');
        }
        $a=$info->getSaveName();//获取文件信息
       	$message=str_replace('\\','/',$a);//更改路径
        // echo $message;exit;
        $data['name']=$name;
        $data['pic']=$message;
        $data['status']=0;

        if(Db::table('pics')->insert($data)){           
          $this->success('添加成功','/pics/index');
        }else{
            $this->error('添加失败','/pics/add');
        }
    }
    //轮播图操作ajax,返回结果值处理前台
    public function getAjax(){
        $request=request();
        $id=$request->param('id');
        // var_dump($id);
        $list=Db::table('pics')->where('id',$id)->find();
        if($list['status']==0){
           Db::query("update pics set status=1 where id=$id");
        }else{
            Db::query("update pics set status=0 where id=$id");
        }
        return 1;
    }
    //删除轮播图操作
    public function getDelete(){
    	// echo '1';
    	$request=request();
    	$id=$request->param('id');
    	$data=Db::table('pics')->where('id',$id)->find();
    	$path='./lunbotu/'.$data['pic'];//图片路径
    	
    	// var_dump($path);exit;
    	if(Db::table('pics')->where('id',$id)->delete()){
    		unlink($path);//删除图片
    		$this->success('删除成功','/pics/index');
    	}else{
    		$this->error('删除失败','/pics/index');
    	}
    }
    //轮播图修改页面
    public function getEdit(){
    	$request=request();
    	$id=$request->param('id');
    	//获取要修改的这条数据
    	$info=Db::table('pics')->where('id',$id)->find();
    	return $this->fetch('Adminpics/edit',['info'=>$info]);
    }
    //轮播图执行修改
    public function postUpdate(){
    	$request=request();
    	$id=$request->param('id');
    	$name=$request->param('name');   	
    	$file=$request->file('pic');
    	$a=Db::table('pics')->where('id',$id)->find();
    	$path='./lunbotu/'.$a['pic'];//原先图片的路径
    	 $data['name']=$name;
    	if(!$file){ 
              // $data['pic']=$a['pic'];       		
        }else{
	        $info=$file->move(ROOT_PATH.'public'.DS.'lunbotu');//移动到/public/lunbotu
	        $a=$info->getSaveName();
	        $message=str_replace('\\','/',$a);//更改路径
	        $data['pic']=$message;
	        unlink($path);
        }
        // var_dump($data);exit;
    	if(Db::table('pics')->where('id',$id)->update($data)){    		
    		$this->success('更新成功','/pics/index');
    	}else{
    		$this->error('更新失败','/pics/index');
    	}
    }




}
