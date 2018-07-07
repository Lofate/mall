<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Config;
use think\Session;
//导入Ucpaas类
// use org\lib\Ucpaas;
Vendor('org.lib.Ucpaas');

class Register extends Controller
{
	//加载注册模板
	public function getIndex(){
		return $this->fetch('index');
	}
	//执行注册
	public function postRegister(){
		$request = request();
		$data = $request->only(['username','phone','email','password']);
		$data['token'] = rand(1,10000);
		$data['password'] = md5($data['password']);
		if(Db::table('users')->insert($data)){
			Session::delete('param');
			$this->success('注册成功，正在前往登录','/login/index');
		}else{
			$this->error('注册失败，请重新注册','/register/index');
		}
		// var_dump($data);
	}
	//验证码
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
	//检测用户名
	public function getCheckname(){
		$request = request();
		$username = $request->param('username');
		$userlist = Db::table('users')->column('username');
		// var_dump($userlist);exit;
		if(in_array($username, $userlist)){
			echo 1;
		}else{
			echo 0;
		}
	}
	//检测邮箱
	public function getCheckmail(){
		$request = request();
		$email = $request->param('email');
		$maillist = Db::table('users')->column('email');
		// var_dump($userlist);exit;
		if(in_array($email, $maillist)){
			echo 1;
		}elseif(!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/',$email)){
			echo 2;
		}else{
			echo 0;
		}
	}
	//检测手机号
	public function getCheckphone(){
		$request = request();
		$phone = $request->param('phone');
		$phonelist = Db::table('users')->column('phone');
		// var_dump($userlist);exit;
		if(in_array($phone, $phonelist)){
			echo 1;
		}else{
			echo 0;
		}
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
		// var_dump($userlist);exit;
		if($password!=$repassword){
			echo 1;
		}else{
			echo 0;
		}
	}
}