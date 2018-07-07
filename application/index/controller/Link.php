<?php

namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Config;
use think\Page;

class Link extends Controller
{
	//加载友情链接前台模板
	public function getIndex(){
		return $this->fetch('index');
	}
	//执行友情链接申请
	public function postApply(){
		$request = request();
		$data['name'] = $request->param('name');
		$data['address'] = $request->param('address');
		$data['status'] = 1;
		// var_dump($data);
		if(Db::table('link')->insert($data)){
			$this->success('申请成功，请等待审核','index/index');
		}else{
			$this->error('申请失败');
		}
	}
}