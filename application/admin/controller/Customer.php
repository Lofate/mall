<?php 
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Customer extends Allow
{
	//客服页面
	public function getIndex(){
		//查询出所有存在聊天的用户
		$list=Db::table('customer')->group('uname')->select();
		// foreach ($list as $key => $value) {
		// 	$lis=DB::table('users')->where('username',$value['uname'])->select();
		// 	$uname[]=$lis[0]['username'];
		// 	$id[]=$lis[0]['id'];
		// }
		// 	// var_dump($id);
		// 	// var_dump($uname);
		// $i=0;
		// foreach ($id as $key => $value) {
		// 	$res=DB::table('user_info')->where('uid',$value)->select();
		// 		// var_dump($res);
		// 	if($res){
		// 		if($res[0]['photo']){
		// 			$photo[$uname[$i]]=$res[0]['photo'];
		// 		}else{
		// 			$photo[$uname[$i]]='/static/admins/adminindex/images/avatar-mini.jpg';
		// 		}
		// 	}else{
		// 		$photo[$uname[$i]]='/static/admins/adminindex/images/avatar-mini.jpg';
		// 	}
		// 	$i++;
		// }
		// var_dump($photo);exit;
		return $this->fetch('index',['uname'=>$list]);
	}
	//查询出所有客服未读消息
	public function getAjax(){
		$request=request();
		$uname=$request->param('uname');
		$list=Db::table('customer')->where('status',0)->where('uname',$uname)->order('time asc')->select();
		return $list;
	}
	//将客服未读消息改为已读
	public function getAjaxx(){
		$request=request();
		$id=$request->param('id');
		Db::table('customer')->where('id',$id)->update(['status'=>1]);
	}
	//发送客服内容
	public function getAjaxxx(){
		$request=request();
		$admincon=$request->param('val');
		$uname=$request->param('uname');
		$data['uname']=$uname;
		$data['admincon']=$admincon;
		$data['time']=time();
		$data['status']=1;
		$data['ustatus']=0;
		Db::table('customer')->insert($data);
	}
	//查询指定用户聊天记录
	public function getAjaxxxx(){
		$request=request();
		$uname=$request->param('uname');
		//将显示的记录状态改变为已读
		Db::table('customer')->where('uname',$uname)->update(['status'=>1]);
		$list=Db::table('customer')->where('uname',$uname)->order('time asc')->select();
		return $list;
	}
	//检测指定用户的未读记录
	public function getAjaxxxxx(){
		$request=request();
		$data=DB::table('customer')->where('status',0)->select();
		return $data;
	}

}