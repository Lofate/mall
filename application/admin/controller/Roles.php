<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Roles extends Allow
{
	 //角色列表页
	public function getIndex(){
		//页面自增变量
		$i=1;
		//获取数据
		$list=Db::table('role')->order('id asc')->paginate(5);
		//加载页面
		return $this->fetch('index',['list'=>$list,'i'=>$i]);
	}
	//角色添加页
	public function getAdd(){
		return $this->fetch('add');
	}
	//角色添加操作
	public function postInsert(){
		//获取数据
		$request=request();
		$name=$request->param('name');
		//创建一个新书组存放要添加的内容
		$data=array();
		$data['name']=$name;
		$data['status']=1;
		// $data['node']='1';
		// var_dump($data);
		$res=Db::table('role')->insert($data);
		//判断添加是否成功，并跳转
		if($res){
			$this->success('添加成功','/roles/index');
		}else{
			$this->error('添加失败');
		}
	}
	//角色类的ajax
	public function getAjax(){
		//获取请求数据
		$request=request();
		$val = $request->param('val');
		$id = $request->param('id');
		$status = $request->param('status');
		//判断是否有传递status，如果有传递，说明是进行角色状态转换
		if($status!=''){
			$res=Db::table('role')->where('id',$id)->update(['status'=>$status]);
			if($res==''){
				echo 0;
				exit;
			}else{
				echo 1;
				exit;
			}
		}
		//在没有传递stasua的前提下，说明是进行添加和修改的用户名验证
		//根据id判断是进行添加验证还是修改验证，没有id说明是添加验证
		if($id==''){
			$res=Db::table('role')->where('name',$val)->find();
		}else{
			$res=Db::table('role')->where('name',$val)->where('id','<>',$id)->find();
		}
		//输出结果
		if($res==''){
			echo 0;
		}else{
			echo 1;
		}
	}
	//角色删除操作
	public function getDelete(){
		//获取要删除的id
		$request=request();
		$id=$request->param('id');
		// var_dump($id);
		$ress=Db::table('admin_users')->where('role',$id)->find();
		if($ress){
			$this->error('角色正在被使用，无法删除');
		}
		$res=Db::table('role')->where('id',$id)->delete();
		//判断删除是否成功
		if($res){
			$this->success('删除成功','/roles/index');
		}else{
			$this->error('删除失败');
		}
	}
	//角色修改页面
	public function getEdit(){
		//获取要修改的数据
		$request=request();
		$id=$request->param('id');
		$list=Db::table('role')->where('id',$id)->select();
		// var_dump($list);
		return $this->fetch('edit',['list'=>$list]);
	}
	//角色修改操作
	public function postUpdate(){
		//获取要修改的数据id
		$request=request();
		$id=$request->param('id');
		$name=$request->param('name');
		$res=Db::table('role')->where('id',$id)->update(['name'=>$name]);
		//判断修改是否成功
		if($res){
			$this->success('修改成功','/roles/index');
		}else{
			$this->error('修改失败');
		}
		// var_dump($id);
	}
}