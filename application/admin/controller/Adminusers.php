<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Adminusers extends Allow
{
	 //管理员列表页
	public function getIndex(){
		//查询出数据库中管理员列表
		$role=array();
		$data=Db::table('admin_users')->order('id asc')->paginate(5);
		$res=Db::table('role')->select();
		$i=1;
		// var_dump($res);
		// 组装一个权限数组方便页面进行权限显示
		foreach ($res as  $value) {
			$role[$value['id']]=$value['name'];
		}
		// var_dump($role);
		// 加载管理员列表页
		return $this->fetch('index',['data'=>$data,'role'=>$role,'i'=>$i]);
	}
	//管理员添加页
	public function getAdd(){
		$data=Db::table('role')->select();
		// var_dump($data);
		//加载管理员添加页
		return $this->fetch('add',['data'=>$data]);
	}
	//管理员添加操作
	public function postInsert(){
		//获取请求数据
		$request=request();
		$data=$request->only('name,password,role');
		//添加数据库
		$res=Db::table('admin_users')->insert($data);
		//判断是否添加成功
		if($res){
			$this->success('添加成功','/adminusers/index');
		}else{
			$this->error('添加失败');
		}
		// var_dump($name);
	}
	//添加用户名重复ajax判断
	public function getAjax(){
		//获取请求数据
		$request=request();
		$val = $request->param('val');
		$id = $request->param('id');
		//在数据库中查询是否存在
		if($id==''){
			$res=Db::table('admin_users')->where('name',$val)->find();
		}else{
			$res=Db::table('admin_users')->where('name',$val)->where('id','<>',$id)->find();
		}
		//输出结果
		if($res==''){
			echo 0;
		}else{
			echo 1;
		}
	}
	//管理员删除
	public function getDelete(){
		//获取请求数据
		$request=request();
		$id=$request->param('id');
		//删除数据库
		$res=Db::table('admin_users')->where('id',$id)->delete();
		//判断是否删除成功
		if($res){
			$this->success('删除成功','/adminusers/index');
		}else{
			$this->error('删除失败');
		}
	}
	//管理员修改
	public function getEdit(){
		$request=request();
		$id=$request->param('id');
		$list=Db::table('admin_users')->where('id',$id)->select();
		$data=Db::table('role')->select();
		return $this->fetch('edit',['list'=>$list,'data'=>$data]);
		// var_dump($list);
	}
	public function postUpdate(){
		$request=request();
		$data=$request->only('name,password,role');
		$id=$request->param('id');
		$res=Db::table('admin_users')->where('id',$id)->update($data);
		if($res){
			$this->success('修改成功','/adminusers/index');
		}else{
			$this->error('修改失败');
		}
	}
}