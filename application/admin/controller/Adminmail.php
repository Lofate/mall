<?php 
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Session;
use app\admin\controller\Allow;
class Adminmail extends Allow
{
	//站内信页面
	public function getIndex(){
		$list=DB::table('admin_mails')->select();
		return $this->fetch('index',['list'=>$list]);
	}
	//站内信发送页面
	public function getAdd(){
		$list=DB::table('users')->select();
		return $this->fetch('add',['list'=>$list]);
	}
	//站内信发送执行
	public function postInsert(){
		//获取数据
		$request=request();
		$val=$request->only('receiver,content');
		//对数据进行补充
		$val['time']=time();
		$val['sender']=Session::get('name');
		$val['status']=0;
		//对发送对象进行拆分成数组
		$arr=explode(',',$val['receiver']);
		//遍历发送对象的数组
		foreach ($arr as $value) {
			//逐个发送
			$val['receiver']=$value;
			$res=Db::table('admin_mails')->insert($val);
		}
		// var_dump($val);
		// $res=Db::table('admin_mails')->insert($val);
		// 判断发送结果
		if($res){
			$this->success('发送成功','/adminmail/index');
		}else{
			$this->error('发送失败');
		}
	}
}