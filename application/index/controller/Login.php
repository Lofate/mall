<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class Login extends Controller
{
	//加载登录模板
	public function getIndex(){
		return $this->fetch('index');
	}
	//执行登录
	public function postLogin(){
		$request = request();
		$captcha = $request->param('captcha');
		$username = $request->param('username');
		$password = md5($request->param('password'));
		$namelist = Db::table('users')->column('username');
		$passlist = Db::table('users')->column('password');
		// var_dump($data);exit;
		//验证用户名
		if(!in_array($username, $namelist)){
			$this->error('用户名错误','/login/index');
		}else{
			//验证密码
			if(!in_array($password, $passlist)){
				$this->error('密码错误','/login/index');
			}else{
				if(!captcha_check($captcha)){
					//验证失败
					$this->error('验证码错误','/login/index');
				}
				$uid = Db::table('users')->where('username',$username)->value('id');
				Session::set('uid',$uid);
				Session::set('username',$username);
				$this->success('登录成功','index/index');
			}
		}
		
		// var_dump($data);
	}
	//执行退出
	public function getLoginout(){
		Session::delete('uid');
		Session::delete('username');
		$this->success('退出成功','index/index');
	}
}