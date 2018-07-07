<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Link extends Allow
{
	//友情链接列表
	public function getIndex(){
		$data = Db::table('link')->paginate(5);
		return $this->fetch('/Adminlink/index',['data'=>$data]);
	}
	//加载添加模板
	public function getAdd(){
		return $this->fetch('/Adminlink/add');
	}
	//执行添加
	public function postInsert(){
		$request = request();
		$data = $request->except('action');
		// var_dump($data);
		if(Db::table('link')->insert($data)){
			$this->success('友情链接添加成功','/link/index');
		}else{
			$this->error('友情链接添加失败','/link/add');
		}
	}
	//执行删除
	public function getDelete(){
		$request = request();
		$id = $request->param('id');
		// echo $id;
		if(Db::table('link')->where('id',$id)->delete()){
			$this->success('友情链接删除成功','/link/index');
		}else{
			$this->error('友情链接删除失败','/link/index');
		}
	}
	//加载修改模板
	public function getEdit(){
		$request = request();
		$id = $request->param('id');
		$data = Db::table('link')->where('id',$id)->find();
		return $this->fetch('/Adminlink/edit',['data'=>$data]);
	}
	//执行添加
	public function postUpdate(){
		$request = request();
		$id = $request->param('id');
		$data = $request->only(['name','address','status']);
		if(Db::table('link')->where('id',$id)->update($data)){
			$this->success('友情链接修改成功','/link/index');
		}else{
			$this->error('友情链接修改失败','/link/edit/id/'.$id);
		}
	}
}