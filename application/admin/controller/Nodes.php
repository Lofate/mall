<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Nodes extends Allow
{
	//权限内容列表
	public function getIndex(){
		$request=request();
		$id=$request->param('id');
		//查询出所有权限内容
		$list=Db::table('node')->order('id asc')->select();
		//查询出当前角色所拥有的权限内容
		$data=Db::table('role')->where('id',$id)->order('id asc')->select();
		$node=$data[0]['node'];
		//将字符串的权限内容转换为数组
		$arr=explode(',',$node);
		// var_dump($arr);
		return $this->fetch('node',['list'=>$list,'arr'=>$arr,'data'=>$data]);
	}
	//更改角色所有的权限内容
	public function getEdit(){
		$request=request();
		$node=$request->only('node');
		$id=$request->param('id');
		$str=implode(',',$node['node']);
		$res=Db::table('role')->where('id',$id)->update(['node'=>$str]);
		if($res){
			$this->success('修改成功','/roles/index');
		}else{
			$this->error('修改失败');
		}
		// var_dump($str);
	}
}