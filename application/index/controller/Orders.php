<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class Orders extends Controller
{
    public function getIndex()
    {
    	// echo '1';exit;
        //订单id 
    	$str_id=isset($_GET['arr'])?$_GET['arr']:'';
    	$ids=explode(',', $str_id);
    	// var_dump($ids);
    	// exit;
    	foreach($ids as $key=>$val){
    		$data1[$key]=Db::table("carts")->where('id',$val)->value('good_id');
    		$data2[$key]['num']=Db::table("carts")->where('id',$val)->value('num');
    		
    	}

    	foreach($data1 as $k=>$v){
    		$info=Db::table("admin_goods")->where('id',$v)->find();
    		$data2[$k]['name']=$info['name'];
    		$data2[$k]['price']=$info['price'];
    		$path="/uploads/".$info['pic'];
    		$data2[$k]['pic']=str_replace('\\', '/', $path);
    	}

    	$total=0;
    	foreach($data2 as $val){
    		$total+=$val['price']*$val['num'];
    	}
    	// var_dump($data2);
    	// exit();
    	// $ids=Session::get('ids');
        $user_id=Session::get('uid');
       
        $data=Db::table("address")->where('user_id',$user_id)->select();

        if(!empty($data)){
        	return $this->fetch('Order/index',['data'=>$data,'data2'=>$data2,'total'=>$total,'ids'=>$str_id]);
        }else{
            return $this->fetch('Order/index',['data'=>$data,'data2'=>$data2,'total'=>$total,'ids'=>$str_id]);
        }
        
    }

    //添加新地址到地址表
    public function postInsert(){
    	$request=request();
    	$data['name']=$request->param('name');
    	$data['phone']=$request->param('phone');

    	$pro=$request->param('pro');//省
    	$city=$request->param('city');//市
    	$county=$request->param('county');//区

    	$data['province']=$pro.' '.$city.' '.$county;
    	$data['street']=$request->param('street');
    	$data['label']=$request->param('label');
    	$data['post']=$request->param('post');
    	$data['user_id']=Session::get('uid');

       
        if(!preg_match("/^\S{2,7}$/u",$data['name'])){
            echo 0;
        }elseif(!preg_match("/^1\d{10}$/",$data['phone'])){
            echo 0;
            exit;
        }elseif(empty($data['province'])){
            echo 0;
            exit;
        }elseif(!preg_match("/^\S{5,32}$/",$data['street'])){
            echo 0;
            exit;
        }elseif(!preg_match("/^[1-9]\d{5}(?!\d)$/",$data['post'])){
            echo 0;
            exit;
        }elseif(empty($data['label'])){
            echo 0;
            exit;
        }else{
           $res=Db::table("address")->insertGetId($data);
            if($res){
                echo 1;
            }else{
                echo 0;
            }  
        }
    	
        
        
        
       
        // $res=Db::table("address")->insertGetId($data);
        // if($res){
        //     echo 1;
        // }else{
        //     echo 0;
        // } 
    }

    // public function getCheck(){
    // 	$request=request();
    // 	$id=$request->param('id');
    // 	$info=Db::table("address")->where('id',$id)->select();
    // 	if(empty($info)){
    // 		echo 0;
    // 	}else{
    // 		echo 1;
    // 	}
    // }
    // //修改已有地址
    // public function postupdate(){
    // 	$request=request();
    // 	$id=$request->param('id');
    // 	$data['name']=$request->param('name');
    // 	$data['phone']=$request->param('phone');

    // 	$pro=$request->param('pro');//省
    // 	$city=$request->param('city');//市
    // 	$county=$request->param('county');//区

    // 	$data['province']=$pro.' '.$city.' '.$county;
    // 	$data['street']=$request->param('street');
    // 	$data['label']=$request->param('label');
    // 	$data['post']=$request->param('post');
    // 	$data['user_id']=Session::get('uid');

    // 	$res=Db::table("address")->where('id',$id)->insertGetId($data);
    // 	if($res){
    // 		echo 1;
    // 	}else{
    // 		echo 0;
    // 	}
    // }
    // 
    

    //存储选中商品id
    // public function getAddid(){
    	
    // 	$ids=isset($_GET['arr'])?$_GET['arr']:'';
    // 	// // var_dump($ids);
    // 	// // exit;
    // 	$res=Session::set('ids',$ids);
    // 	if($res){
    // 		echo 1;
    // 	}else{
    // 		echo 0;
    // 	}
    // 	// echo $res;
    // }



    public function getDeladds(){
    	$request=request();
    	$id=$request->param('id');
    	// echo $id;
    	// exit();
    	$res=Db::table("address")->where('id',$id)->delete();
    	if($res){
    		$this->redirect("/homeorders/index");
    	}else{
    		$this->redirect("/homeorders/index");
    	}
    }

   
}
