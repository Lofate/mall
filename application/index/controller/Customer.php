<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Config;
use think\Session;
//导入Ucpaas类
// use org\lib\Ucpaas;
Vendor('org.lib.Ucpaas');

class Customer extends Allow
{
	//加载页面
	public function getIndex(){
		$uid=Session::get('uid');
		$res=DB::table('user_info')->where('uid',$uid)->select();
		// var_dump($res);
		if($res){
			if($res[0]['photo']){
				$photo=$res[0]['photo'];
			}else{
				$photo='/static/admins/adminindex/images/avatar-mini.jpg';
			}
		}else{
			$photo='/static/admins/adminindex/images/avatar-mini.jpg';
		}
		return $this->fetch('index',['photo'=>$photo]);
	}
	//将用户发送内容加入数据库
	public function getAjax(){
		$request=request();
		$val=$request->param('val');
		$data['uname']=Session::get('username');
		$data['usercon']=$val;
		$data['time']=time();
		$data['status']=0;
		$data['ustatus']=1;
		DB::table('customer')->insert($data);
	}
	//查询本用户聊天记录
	public function getAjaxx(){
		$request=request();
		$uname=$request->param('uname');
		Db::table('customer')->where('uname',$uname)->update(['ustatus'=>1]);
		$list=Db::table('customer')->where('uname',$uname)->order('time asc')->select();
		return $list;
	}
	//不断检测未读信息
	public function getAjaxxx(){
		$request=request();
		$uname=$request->param('uname');
		$list=Db::table('customer')->where('ustatus',0)->where('uname',$uname)->order('time asc')->select();
		return $list;
	}
	//将未读信心改为已读
	public function getAjaxxxx(){
		$request=request();
		$id=$request->param('id');
		Db::table('customer')->where('id',$id)->update(['ustatus'=>1]);
	}
	
}