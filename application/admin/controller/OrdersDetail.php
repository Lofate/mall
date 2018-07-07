<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class OrdersDetail extends Allow
{
	 //订单列表
	public function getIndex(){
		//查询数据
		$data=Db::table('order_details')->select();
		//分配数据
		return $this->fetch('Adminorders/Detail/index',['data'=>$data]);
	}
	
}