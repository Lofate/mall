<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\admin\controller\Allow;
class Login extends Controller
{
	//加载登录页
	public function getIndex(){
		return $this->fetch('login');
	}
	//登录验证
	public function postLogin(){
		//获取数据
		$request=request();
		$name=$request->param('name');
		//输入的密码
		$password=$request->param('password');
		//输入的验证码
		$captcha=$request->param('captcha');
		//数据库查询
		$res=Db::table('admin_users')->where('name',$name)->select();
		//判断验证码
		if(!captcha_check($captcha)){
		 $this->error('验证码有误');
		};
		//判断用户是否存在
		if($res){
			//查询用户是否被禁用
			$role=$res[0]['role'];
			$ress=Db::table('role')->where('id',$role)->select();
			if($ress[0]['status']==0){
				$this->error('您已被禁止登录');
			}
			//判断密码
			if($res[0]['password']==$password){
				Session::set('name',$name);
				$role=$res[0]['role'];
				//将用户所有权限存入session
				$ress=Db::table('role')->where('id',$role)->select();
				$node=$ress[0]['node'];
				Session::set('node',$node);
				// var_dump(Session::get('node'));
				$this->success('登录成功','/admin/index');
			}else{
				$this->error('密码错误');
			}
		}else{
			$this->error('用户名不存在');
		}
	}
	//注销
	public function getLoginout(){
		//删除session中的用户
		Session::delete('name');
		//删除session中的用户对应权限
		Session::delete('node');
		if(Session::get('name')==''&&Session::get('node')==''){
			$this->success('退出成功','/adminlogin/index');
		}else{
			$this->error('退出失败');
		}
	}
}