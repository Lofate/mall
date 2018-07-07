<?php 
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\validate\User;
use app\admin\controller\Allow;
class Users extends Allow
{
	//用户列表
	public function getIndex(){
		$data=Db::table('users')->paginate(5);
		return $this->fetch('index',['data'=>$data]);
	}
	//加载添加模板
	public function getAdd(){
		return $this->fetch('add');
	}
	//执行添加
	public function postInsert(){
		$request = request();
		$data = $request->except(['action','repassword']);
		$data['password'] = md5($data['password']);
		$data['token'] = rand(1,10000);
		// var_dump($data);
		//验证
		$result = $this->validate($request->param(),'User');
		if(true!==$result){
			$this->error($result,'/users/add');
		}
		if(Db::table('users')->insert($data)){
			$this->success('用户添加成功','/users/index');
		}else{
			$this->error('用户添加失败','/users/add');
		}
	}
	//执行删除
	public function getDelete(){
		$request = request();
		$data = $request->param('id');
		// echo $data;
		if(Db::table('users')->where('id',$data)->delete()){
			$this->success('用户删除成功','/users/index');
		}else{
			$this->error('用户删除失败','/user/index');
		}
	}
	//加载修改模板
	public function getEdit(){
		$request = request();
		$id = $request->param('id');
		$data = Db::table('users')->where('id',$id)->find();
		// var_dump($data);exit;
		return $this->fetch('edit',['data'=>$data]);
	}
	//执行修改
	public function postUpdate(){
		$request = request();
		$id = $request->param('id');
		$data = $request->only(['username','password','email','phone']);
		$data['password'] = md5($data['password']);
		// var_dump($data);exit;
		//验证
		$result = $this->validate($request->param(),'User');
		if(true!==$result){
			$this->error($result,'/users/edit/id/'.$id);
		}
		if(Db::table('users')->where('id',$id)->update($data)){
			$this->success('用户修改成功','/users/index');
		}else{
			$this->error('用户修改失败','/users/edit/id/'.$id);
		}
	}
	//用户详情
	public function getInfo(){
		$request = request();
		$uid = $request->param('uid');
		$data = Db::table('user_info')->where('uid',$uid)->find();
		return $this->fetch('info',['data'=>$data,'uid'=>$uid]);
	}
	//详情添加或修改
	public function postInfochange(){
		// var_dump($_POST);
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
				$this->error($result,'/users/info/uid/'.$uid);
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
		// echo $opic;exit;
		// dump($uid);
		if(in_array($uid, $uidlist)){
			//已添加过用户详情
			if(Db::table('user_info')->where('uid',$uid)->update($data)){
				//删除旧图
				if($savename!=''&&$opic!=''){
					unlink('.'.$opic);
				}
				$this->success('用户详情修改成功','/users/index');
			}else{
				$this->error('用户详情修改失败','/users/info/uid/'.$uid);
			}
		}else{
			//未添加过用户详情
			$data['uid'] = $uid;
			if(Db::table('user_info')->insert($data)){
				$this->success('用户详情修改成功','/users/index');
			}else{
				$this->success('用户详情修改失败','/users/info/uid/'.$uid);
			}
		}
	}

}