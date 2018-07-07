<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Config;
use think\Session;
Vendor('org.lib.Ucpaas');

class Person extends Allow
{
	//个人中心首页
	public function getIndex(){
		$data = Db::table('users')->where('username',Session::get('username'))->find();
		return $this->fetch('index',['data'=>$data]);
	}
	//电话改绑
	public function postPhonechange(){
		// var_dump($_POST);
		$request = request();
		$phone = $request->param('phone');
		// echo $phone;
		if(Db::table('users')->where('id',Session::get('uid'))->update(['phone'=>$phone])){
			echo 1;
		}else{
			echo 0;
		}
	}
	//邮箱改绑
	public function postMailchange(){
		// var_dump($_POST);
		$request = request();
		$email = $request->param('email');
		// echo $email;
		if(Db::table('users')->where('id',Session::get('uid'))->update(['email'=>$email])){
			echo 1;
		}else{
			echo 0;
		}
	}
	//个人中心信息页
	public function getProfile(){
		$data = Db::table('user_info')->where('uid',Session::get('uid'))->find();
		// $data['realname'] = htmlspecialchars($data['realname']);
		return $this->fetch('person',['data'=>$data]);
	}
	//个人中心详细信息修改
	public function postProfilechange(){
		// var_dump($_POST);exit;
		$request = request();
		$uid = $request->param('uid');
		$uidlist = Db::table('user_info')->column('uid');
		$data = $request->only(['realname','sex','age','introduction']);
		$opic = Db::table('user_info')->where('uid',$uid)->value('photo');
		//获取上传文件信息
		$file = $request->file('pic');
		$savename = '';
		if($file!=''){
			//设置上传验证规则
			$result = $this->validate(['file1'=>$file],['file1'=>'image'],['file1.image'=>'头像上传类型必须为图片类型']);
			if(true!==$result){
				$this->error($result,'/person/profile');
			}
			//移动图片
			$info = $file->move(ROOT_PATH.'public'.DS.'userinfo');
			//获取图片信息
			$savename = $info->getSaveName();
			//判断上传图片是否为空
			$data['photo'] = '/userinfo/'.$savename;
		}else{
			//获取旧图片
			$data['photo'] = $opic;
		}
		if(in_array($uid, $uidlist)){
			//已添加过用户详情
			if(Db::table('user_info')->where('uid',$uid)->update($data)){
				//删除旧图
				if($savename!=''&&$opic!=''){
					unlink('.'.$opic);
				}
				$this->success('用户详情修改成功','/person/profile');
			}else{
				$this->error('用户详情修改失败','/person/profile');
				// var_dump($data);
			}
		}else{
			//未添加过用户详情
			$data['uid'] = $uid;
			if(Db::table('user_info')->insert($data)){
				$this->success('用户详情修改成功','/person/profile');
			}else{
				$this->success('用户详情修改失败','/person/profile');
			}
		}
	}
	//帐号安全
	public function getSecurity(){
		$data = Db::table('users')->where('id',Session::get('uid'))->find();
		$protect = Db::table('protect')->where('uid',Session::get('uid'))->find();
		return $this->fetch('security',['data'=>$data,'protect'=>$protect]);
	}
	//获取验证码
	public function postYzm(){
		//获取手机号
		$request = request();
		$p = $request->param('p');
		if($p=='') exit;
		// echo $p;exit;
		//调用短信接口
		//请求云之讯平台
		//初始化必填
		//填写在开发者控制台首页上的Account Sid
		$options['accountsid']=Config::get('phoneyzm.accountsid');
		//填写在开发者控制台首页上的Auth Token
		$options['token']=Config::get('phoneyzm.token');
		//初始化 $options必填
		$ucpass = new \Ucpaas($options);
		//应用id
		$appid = Config::get('phoneyzm.appid');	//应用的ID，可在开发者控制台内的短信产品下查看
		//模板id
		$templateid = Config::get('phoneyzm.templateid');    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
		//短信验证码
		$param = rand(1,10000); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
		//接受短信验证码手机号
		$mobile = $p;
		$uid = "";

		//将验证码存储到session中
		Session::set('param',$param);
		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
		//向终端手机号发送短信验证码
		echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
	}
	//检测验证码
	public function getCheckcode(){
		$request = request();
		$checkcode = $request->param('checkcode');
		if($checkcode==Session::get('param')){
			echo 0;
		}else{
			echo 1;
		}
	}
	//检测密码
	public function getCheckpass(){
		$request = request();
		$password = $request->param('password');
		// var_dump($userlist);exit;
		if(strlen($password)<6 || strlen($password)>16){
			echo 1;
		}else{
			echo 0;
		}
	}
	//检测重复密码
	public function getCheckrepass(){
		$request = request();
		$password = $request->param('password');
		$repassword = $request->param('repassword');
		// echo $password.'----'.$repassword;exit;
		if($password==$repassword){
			echo 0;
		}else{
			echo 1;
		}
	}
	//修改密码
	public function getPasschange(){
		$request = request();
		$data = array();
		$data['password'] = $request->param('password');
		$data['token'] = rand(1,10000);
		$id = Session::get('uid');
		if(Db::table('users')->where('id',$id)->update($data)){
			Session::delete('uid');
			Session::delete('username');
			Session::delete('param');
			echo 1;
		}else{
			echo 0;
		}
	}
	//邮箱找回
	public function getSend(){
		$request = request();
		$email = $request->param('email');
		$token = Db::table('users')->where('id',Session::get('uid'))->value('token');
		// echo $email;
		$s = sendmail($email,'易果生鲜','<a href="http://www.tp5.com/person/mailpass/id/'.Session::get('uid').'/token/'.$token.'">点击修改密码</a>');
		// echo $s;exit;
		if($s){
			echo 1;
		}else{
			echo 0;
		}
	}
	//邮箱找回密码模板
	public function getMailpass(){
		$request = request();
		$id = $request->param('id');
		$token = $request->param('token');
		$token1 = Db::table('users')->where('id',$id)->value('token');
		if($token==$token1){
			return $this->fetch('passchange');
		}else{
			$this->error('非法权限操作','/index/index');
		}
	}
	//密保找回密码模板
	public function getProtectPass(){
		return $this->fetch('passchange');
	}
	//添加密保
	public function getProtectadd(){
		$request = request();
		$data['uid'] = Session::get('uid');
		$data['q1'] = $request->param('q1');
		$data['q2'] = $request->param('q2');
		$data['a1'] = $request->param('a1');
		$data['a2'] = $request->param('a2');
		// var_dump($data);
		if(Db::table('protect')->insert($data)){
			echo 1;
		}else{
			echo 0;
		}
	}
	//密保验证
	public function getProtectcheck(){
		$request = request();
		$a1 = $request->param('a1');
		$a2 = $request->param('a2');
		// echo $a1.$a2;
		$data = Db::table('protect')->where('uid',Session::get('uid'))->find();
		$token = Db::table('users')->where('id',Session::get('uid'))->value('token');
		if($a1==$data['a1']&&$a2 == $data['a2']){
			echo 1;
		}else{
			echo 0;
		}
	}
	//解除密保
	public function getProtectdel(){
		if(Db::table('protect')->where('uid',Session::get('uid'))->delete()){
			$this->success('密保解除成功','/person/security');
		}else{
			$this->success('密保解除失败','/person/security');
		}
	}
	//站内信
	public function getMail(){
		$list=DB::table('admin_mails')->where('receiver',Session::get('username'))->order('id desc')->select();
		return $this->fetch('mail',['list'=>$list]);
	}
	public function getMailajax(){
		$request=request();
		$id=$request->param('id');
		$res=Db::table('admin_mails')->where('id',$id)->update(['status'=>1]);
		// echo 1;
	}
	public function getMaildel(){
		$request=request();
		$id=$request->param('id');
		$res=DB::table('admin_mails')->where('id',$id)->delete();
		if($res){
			$this->success('删除成功','/person/mail');
		}else{
			$this->error('删除失败');
		}
	}
	public function postMailsend(){
		$request=request();
		$val=$request->only('receiver,content');
		$val['time']=time();
		$val['sender']=Session::get('username');
		$val['status']=0;
		// var_dump($val);
		$res=Db::table('admin_mails')->insert($val);
		if($res){
			$this->success('发送成功','/person/mail');
		}else{
			$this->error('发送失败');
		}
	}
	//添加收藏
	public function getCollectionadd(){
		
		//商品id
		$arr=isset($_GET['arr'])?$_GET['arr']:'';
		// $arr['id']=$gid;
		// $arr=isset($_GET['arr'])?$_GET['arr']:$arr['id']=$gid;
		if(!empty($arr)){
			foreach($arr as $k=>$v){
				$cid=$v;
				$b=Db::table('carts')->where('id',$cid)->find();
				$gid=$b['good_id'];
				$uid=Session::get('uid');
				$info=Db::table('admin_goods')->where('id',$gid)->find();
				$c=Db::table('carts')->where('good_id',$gid)->find();
				$pd=Db::table('collection')->where("gid={$gid} and uid={$uid}")->find();
				$goodsinfo=Db::table('admin_goodsinfo')->where('id',$gid)->find();
				//库存数量
				$goodsinfonum=$goodsinfo['num'];
					if(!empty($pd)){
					//不能超过库存数量
					$list['size']=$pd['size']+$c['num'];
					if($list['size']>$goodsinfonum){
						$list['size']=$goodsinfonum;
					}else{
						$list['size']=$pd['size']+$c['num'];
					}
					// var_dump($list);exit;
					//更新收藏表中的size字段
					Db::table('collection')->where("gid={$gid} and uid={$uid}")->update($list);
						
				}else{
					$data['gid']=$gid;
					$data['uid']=$uid;
					$data['gname']=$info['name'];
					$data['price']=$info['price'];
					$data['pic']=$info['pic'];
					$data['size']=$c['num'];
					Db::table('collection')->insert($data);
					
				}
			}
			echo '1';
			exit;
			
		}else{
			$request=request();
			$gid=$request->param('gid');
		}
		// var_dump($arr);exit;
		// $arrs=json_decode($arr);
		
		

		//用户id
		$uid=Session::get('uid');
		$info=Db::table('admin_goods')->where('id',$gid)->find();
		// var_dump($info);exit;
		// var_dump($uid);
		
		// 收藏数量
		$c=Db::table('carts')->where('good_id',$gid)->find();
		$pd=Db::table('collection')->where("gid={$gid} and uid={$uid}")->find();
		//拿库存
		$goodsinfo=Db::table('admin_goodsinfo')->where('id',$gid)->find();
		//库存数量
		$goodsinfonum=$goodsinfo['num'];
		// var_dump($goodsinfonum);exit;
		
		if(!empty($pd)){
			//不能超过库存数量
			$list['size']=$pd['size']+$c['num'];
			if($list['size']>$goodsinfonum){
				$list['size']=$goodsinfonum;
			}else{
				$list['size']=$pd['size']+$c['num'];
			}
			// var_dump($list);exit;
			//更新收藏表中的size字段
			if(Db::table('collection')->where("gid={$gid} and uid={$uid}")->update($list)){
				$this->success('收藏成功','/person/Collection');
			}else{
				$this->error('收藏失败','/person/Collection');
			}
		}else{
			$data['gid']=$gid;
			$data['uid']=$uid;
			$data['gname']=$info['name'];
			$data['price']=$info['price'];
			$data['pic']=$info['pic'];
			$data['size']=$c['num'];

			if(!Db::table('collection')->insert($data)){
				$this->error('收藏失败','/homecarts/index');
			}else{
				$this->success('收藏成功','/person/Collection');
			}
		}
		// 
		
	}
	//收藏列表
	public function getCollection(){
		$uid=Session::get('uid');
		$datas=Db::table('collection')->where('uid',$uid)->paginate(2);		
		$page = $datas->render();
		$data= $datas->all();
		$i=1;
		return $this->fetch('collection',['data'=>$data,'page'=>$page,'i'=>$i]);
	}
	//收藏删除
	public function getCollectiondel(){
		$request=request();
		$id=$request->param('id');
		if(Db::table('collection')->where('id',$id)->delete()){
			$this->success('删除成功','/person/Collection');
		}else{
			$this->error('删除失败','/person/Collection');
		}
	}
	//ajax加
	public function getjia(){
		$request=request();
		$id=$request->param('id');
		$info=Db::table('collection')->where('id',$id)->find();
		$gid=$info['gid'];
		// echo $id;exit;
		$goodsinfo=Db::table('admin_goodsinfo')->where('id',$gid)->find();
		//库存数量
		$goodsinfonum=$goodsinfo['num'];
		
		$size=$info['size']+1;
		if($size>$goodsinfonum){
			$list['size']=$goodsinfonum;
		}else{
			$list['size']=$info['size']+1;
		}
		Db::table('collection')->where('id',$id)->update($list);
		$a=Db::table('collection')->where('id',$id)->find();
		$data['size']=$a['size'];
		$data['tot']=$a['size']*$info['price'];
		// var_dump($data);exit;
		echo json_encode($data);
		
	}
	//ajax减
	public function getjian(){
		$request=request();
		$id=$request->param('id');
		// $id=10;
		$info=Db::table('collection')->where('id',$id)->find();
		$gid=$info['gid'];
		$size=$info['size']-1;
		if($size<1){
			$list['size']=1;
		}else{
			$list['size']=$size;
		}
		Db::table('collection')->where('id',$id)->update($list);
		$a=Db::table('collection')->where('id',$id)->find();
		$data['size']=$a['size'];
		$data['tot']=$a['size']*$info['price'];
		// var_dump($data);exit;
		echo json_encode($data);
	}



	//我的订单模块
	public function getOrders(){
		$user_id=Session::get('uid');
		$data=Db::table("orders")->where(['user_id'=>$user_id,'status'=>['neq',8]])->select();
		foreach($data as $k=>$v){
			//格式化时间
			$data[$k]['order_time']=date("Y-m-d H:i:s",$v['order_time']);
			
			$data1=Db::table("order_info")->where('order_id',$v['id'])->select();
			// var_dump($data1);exit;
			foreach($data1 as $key=>$val){
				$data[$k]['shop'][$key]=Db::table("admin_goods")->where('id',$val['good_id'])->find();
				$data[$k]['shop'][$key]['price']=Db::table("admin_goods")->where('id',$val['good_id'])->value('price');
				$path=Db::table("admin_goods")->where('id',$val['good_id'])->value('pic');
				$data[$k]['shop'][$key]['pic']='/uploads/'.str_replace('\\', '/', $path);
			}
		}
		//编号
		$i=1;
		
		// echo '<pre>';
		// print_r($data);
		// exit;
		return $this->fetch("order",['data'=>$data,'i'=>$i]);
	}	

	//确认收货
	public function getConfirmreceipt(){
		$request=request();
		$id=$request->param('id');
		$res=Db::table("orders")->where('id',$id)->update(['status'=>4]);
    	if($res){
    		$this->redirect("/person/orders");
    	}else{
    		$this->redirect("/person/orders");
    	}
	}

	//取消订单
	public function getCancelorder(){
		$request=request();
		$id=$request->param('id');
		$res=Db::table("orders")->where('id',$id)->update(['status'=>1]);
    	if($res){
    		$this->redirect("/person/orders");
    	}else{
    		$this->redirect("/person/orders");
    	}
	}
	//删除订单
	public function getDelorder(){
		$request=request();
		$id=$request->param('id');
		$res=Db::table("orders")->where('id',$id)->update(['status'=>8]);
    	if($res){
    		$this->redirect("/person/orders");
    	}else{
    		$this->redirect("/person/orders");
    	}
	}


	
	//我购买过的商品模块
	public function getMybuy(){
		$user_id=Session::get('uid');
		$data=Db::table("orders")->where(['user_id'=>$user_id,'status'=>['in','4,5,8,9']])->select();
		
		static $j=0;
		$data2=array();
		foreach($data as $k=>$v){

			$data1=Db::table("order_info")->where('order_id',$v['id'])->select();
			foreach($data1 as $key=>$val){
				$data2[$j]=Db::table("admin_goods")->where('id',$val['good_id'])->find();
				
				$path=Db::table("admin_goods")->where('id',$val['good_id'])->value('pic');
				$data2[$j]['pic']='/uploads/'.str_replace('\\', '/', $path);
				$j++;
			}
		}

		//去掉重复字段
		$data2=array_unique($data2,SORT_REGULAR);
		//编号
		$i=1;
		// echo '<pre>';
		// print_r($data2);
		// exit;
		return $this->fetch("mybuy",['data2'=>$data2,'i'=>$i]);	
	}

	
	//收货地址模块
	public function getAddress(){
		$user_id=Session::get('uid');
		$data=Db::table("address")->where('user_id',$user_id)->select();

		$i=1;
		return $this->fetch("address",['data'=>$data,'i'=>$i]);
	}

	//修改地址
	// public function geteditaddress(){
	// 	return $this->fetch("editaddress");
	// }


	//删除地址
	public function getDeladdress(){
		$request=request();
		$id=$request->param('id');
		Db::table("address")->where('id',$id)->delete();
		// var_dump($id);
		// exit;
		$this->redirect("/person/address");
	}
	//我的评论
	public function getAssess(){
		//获取评论的数据
		$request=request();
		$user_id=Session::get('uid');
		$data=Db::table("assess")->where('user_id',$user_id)->select();
		// var_dump($data);exit;
		$arr=Array();
		$arr1=Array();
		$arr2=Array();
		foreach($data as $row){
			$order_id=$row['order_id'];
			// var_dump($order_id);
			$list=Db::table("orders")->where("id",$order_id)->select();
			// var_dump($list);
			foreach($list as $v){
				$order=Db::table("order_info")->where("order_id",$v['id'])->select();
				// var_dump($order);exit;
				foreach($order as $key=>$r){
					// $good_id=$r['good_id'];
					$good=Db::table('admin_goods')->where("id",$r['good_id'])->find();
					$arr2[$r['order_id']][]=$good;
				}
				//商品的信息
					$arr[$r['order_id']]=$order;
			}
			$arr1[$r['order_id']]=$row;
		}
		// var_dump($arr);
		// var_dump($arr2);
		// var_dump($arr1);exit;
		
		return $this->fetch("/Person/assess",['arr'=>$arr,'arr1'=>$arr1,'arr2'=>$arr2,'data'=>$data]);

	}

	public function getAssessdel(){
		$request=request();
		$order_id=$request->param('order_id');
		// var_dump($id);
		if(Db::table("assess")->where("order_id",$order_id)->delete()){
			$this->success("删除成功","/person/assess");
		}else{
			$this->success("删除成功","/person/assess");

		}
	}

}