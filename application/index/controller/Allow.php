<?php 
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
class Allow extends Controller
{
	public function _initialize(){
		if(!Session::get('username')){
    		$this->error("请先登录","/login/index");
    	}



	}

	
}