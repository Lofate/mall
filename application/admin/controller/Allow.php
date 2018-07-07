<?php 
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
class Allow extends Controller
{
	public function _initialize(){
        //判断是否登录
		if(!Session::get('name')){
    		$this->error("请先登录","/adminlogin/index");
    	}
		$request=request();
    	//获取用户访问的模块的控制器和方法
    	$controller=strtolower($request->controller());
    	$action=strtolower($request->action());
        //拼接控制器与方法
    	$str=$controller.":".$action;
        // var_dump($str);
        // 获取登录用户所有权限
        $node=Session::get('node');
        // var_dump($node);
        // 将权限从字符串转换为数组
        $arr=explode(',',$node);
        // var_dump($arr);
        // 遍历权限数组
        foreach ($arr as $key => $value) {
            //将数组中的数字转换为数据库中的数据
            $res=Db::table('node')->where('id',$value)->select();
            $arr1[]=strtolower($res[0]['mname']).":".strtolower($res[0]['aname']);
            //如果有添加权限，则自带insert权限
            if(strtolower($res[0]['aname'])=='getadd'){
                $arr1[]=strtolower($res[0]['mname']).":postinsert";
            }
            //如果有修改权限，则自带update权限
            if(strtolower($res[0]['aname'])=='getedit'){
                $arr1[]=strtolower($res[0]['mname']).":postupdate";
            }
        }
        // var_dump($arr1);
        // 忽略ajax方法
        if(!strpos($action,'ajax')){
            if(!in_array($str,$arr1)){
               $this->error('您没有此操作权限');
        	   exit;
            }
        }
	}
}