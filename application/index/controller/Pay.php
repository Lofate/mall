<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class Pay extends Controller
{
    public function postIndex()
    {
    	$request=request();
    	$order_id=$request->param('order_id');
    	// var_dump($order_id);
    	// exit;
    	return $this->fetch("/Pay/index",['order_id'=>$order_id]);
        
    }

    public function getPay(){
    	$request=request();
    	$id=$request->param('id');
    	// var_dump($id);
    	$res=Db::table("orders")->where('id',$id)->update(['status'=>2]);
    	if($res){
    		$this->success("付款成功","/person/orders");
    	}else{
    		$this->error("付款失败,请重新付款","/homepay/index/order_id/$id");
    	}
    }

    public function getAssess(){
        $request=request();
        $order_id=$request->param('id');
        // var_dump($order_id);
        $data=Db::table("order_info")->where("order_id",$order_id)->select();
        // var_dump($data);
        $arr=Array();
        foreach($data as $row){
            $good_id=$row['good_id'];
            $goods=Db::table("admin_goods")->where("id",$good_id)->find();
            $goods['good_id']=$good_id;
            $arr[]=$goods;
        }
        // var_dump($arr);
        // var_dump($name);exit;
        return $this->fetch("/pay/assess",['order_id'=>$order_id,'arr'=>$arr]);
    }
    public function postAdd(){
        $request=request();
        $order_id=$request->param("order_id");
        $data=$request->only(['order_id','good_id','good_score','service_score','time_score','content',]);
        $data['status']=1;
        $data['create_time']=time('H:i:s');
        $data['user_id']=Session::get('uid');
        // var_dump($data['user_id']);exit;
        if(Db::table("assess")->insert($data)){
            $data1=Db::table('orders')->where('id',$order_id)->find();
            $data1['status']=9;
            $data2=Db::table("orders")->update($data1);
            // var_dump($data1);exit;
            $this->success("评价成功","/person/assess/user_id/{$data['user_id']}");

        }else{
            $this->error("意外失败了，请重新评价","/homepay/assess/order_id/{$order_id}");
        }
    }

    //自个人中心跳转
    public function getPays(){
        $request=request();
        $order_id=$request->param('id');
        // var_dump($order_id);
        // exit;
        return $this->fetch("/Pay/index",['order_id'=>$order_id]);
    }
}
