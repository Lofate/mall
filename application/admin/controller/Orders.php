<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Orders extends Allow
{
	 //订单列表
	public function getIndex(){
		//查询数据
		$data=Db::table('orders')->select();
		//分配数据
		
		foreach($data as $key=>$value){
			$data[$key]['uname']=Db::table("users")->where('id',$value['user_id'])->value('username');
			$province=Db::table("address")->where('id',$value['address_id'])->value('province');
			$street=Db::table("address")->where('id',$value['address_id'])->value('street');
			$data[$key]['address']=$province.' '.$street;
		}
		// var_dump($data);
		// exit;
		return $this->fetch('Adminorders/index',['data'=>$data]);
	}


	//发货
	public function getDeliver(){
		$request=request();
		$id=$request->param('id');
		// var_dump($id);
		// exit;
		$res=Db::table("orders")->where('id',$id)->update(['status'=>3]);
		if($res){
			$this->success("发货成功","/orders/index");
		}else{
			$this->error("发货失败","/orders/index");
		}
	}
	
}