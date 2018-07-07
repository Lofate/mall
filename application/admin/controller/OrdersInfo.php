<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class OrdersInfo extends Allow
{
	 //订单列表
	public function getIndex(){
		$request=request();
		$id=$request->param('id');
		// var_dump($id);
		// exit();
		//查询数据
		$data=Db::table('order_info')->where('order_id',$id)->select();
		//分配数据
		return $this->fetch('Adminorders/Info/index',['data'=>$data]);
	}
	
}