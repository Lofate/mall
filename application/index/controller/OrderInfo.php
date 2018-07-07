<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class OrderInfo extends Controller
{
    public function postIndex()
    {
    	
        $request=request();
        $data1['order_num']=date('Ymd').str_pad(mt_rand(1, 99999),5,'0',STR_PAD_LEFT);
        $data1['user_id']=Session::get('uid');
        $data1['address_id']=$request->param('id');
        $data['total']=$data1['total']=$request->param('total');
        $data1['status']=0;//订单状态 0:待支付 1:已取消 2:已支付 3:已发货 4:已完成 5:已评价 6:退款中 7:已退款 8:已删除
        $data1['order_time']=time();
        //将订单信息存储在订单表中
        $order_id=Db::table("orders")->insertGetId($data1);    


        //将订单详情信息存储在订单详情表中
        $data2['order_id']=$order_id;
        $ids=$request->param('ids');
        $ids=explode(',',$ids);
        foreach($ids as $value){
            $data2['good_id']=Db::table("carts")->where('id',$value)->value('good_id');
            $data2['num']=Db::table("carts")->where('id',$value)->value('num');
            Db::table("order_info")->insert($data2);

            //删除购物车中已下单的商品
            Db::table("carts")->where('id',$value)->delete();
        }
        // var_dump($data);
        // exit;
        
        //模板中显示
        $data['order_num']=Db::table("orders")->where('id',$order_id)->value('order_num');
        $address_id=Db::table("orders")->where('id',$order_id)->value('address_id');
        $info=Db::table("address")->where('id',$address_id)->find();
        $data['name']=$info['name'];
        $data['phone']=substr_replace($info['phone'],'****',3,4);
        $data['province']=$info['province'];
        $data['street']=$info['street'];

        
        return $this->fetch("/OrderInfo/index",['data'=>$data,'order_id'=>$order_id]);
    }

}
