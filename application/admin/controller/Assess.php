<?php 
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\validate\User;
use app\admin\controller\Allow;
class Assess extends Allow
{
	//评价列表
	public function getIndex(){
		$data=Db::table("assess")->select();
		return $this->fetch('Adminassess/index',['data'=>$data]);
	}
	//商品ajax操作,按钮操作后台数据status
    public function getAjax(){
        $request=request();
        $id=$request->param('id');
        // var_dump($id);exit;
        $list=Db::table('assess')->where('id',$id)->find();
        if($list['status']==0){
           	Db::query("update assess set status=1 where id=$id");
        }else{
            Db::query("update assess set status=0 where id=$id");
        }
        return 1;
    }
	public function getDelete(){
		$request=request();
		$id=$request->param('id');
		if(Db::table("assess")->where("id",$id)->delete()){
			$this->success("删除成功",'/assess/index');
		}else{
			$this->error("删除失败",'/assess/index');
		}
	}
}