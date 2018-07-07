<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use app\admin\controller\Allow;
class Notice extends Allow
{
    //公告列表
    public function getIndex(){
        $data=Db::table('notice')->paginate(2);
        return $this->fetch('Adminnotice/index',['data'=>$data]);
    }

    //添加页面
    public function getAdd(){
        return $this->fetch('Adminnotice/add');
    }
    //执行添加
    public function postInsert(){
        $request=request();
        $name=$request->param('name');
        $title=$request->param('title');
        $file=$request->file('pic');
        //通过validate内置方法做验证
        $result=$this->validate(['file1'=>$file],['file1'=>'require|image'],['file1.require'=>'文件不能为空','file1.image'=>'非法图像文件']);
        if(true!==$result){
            $this->error($result,'/notice/add');
        }
        if($file){
            $info=$file->move(ROOT_PATH.'public'.DS.'gonggao');//移动到/public/gonggao
        }
        $a=$info->getSaveName();//获取图片信息
        $message=str_replace('\\','/',$a);//修改图片路径
        //缩放
        $img=\think\Image::open("./gonggao/".$message);
        $ext=$info->getExtension();//后缀名
        $suofangname=time()+rand(1,10000);//缩放后的名字
        $img->thumb(290,290)->save("./gonggao/thumb/".$suofangname.'.'.$ext);

        $data['name']=$name;
        $data['title']=$title;
        $data['pic']=$suofangname.'.'.$ext;
        $data['opic']=$message;
        // $data就是要添加的字段
        if(Db::table('notice')->insert($data)){
            $this->success('添加成功','/notice/index');
        }else{
            $this->error('添加失败','/notice/add');
        }
    }
    //删除操作
    public function getDelete(){
        $request=request();
        $id=$request->param('id');
        $data=Db::table('notice')->where('id',$id)->find();
        $path='./gonggao/'.$data['opic'];   
        $suofangtu='./gonggao/thumb/'.$data['pic'];  
        // var_dump($path);exit;
        $title=$data['title'];
        preg_match_all('/<img.*?src="(.*?)".*?>/is',$title,$arr);//找到百度编辑器里的图片
        // var_dump($arr);exit;
        if(Db::table('notice')->where('id',$id)->delete()){
            unlink($path);//删除原图
            unlink($suofangtu);//删除缩放图
            //删除百度编辑器的图片
            if(isset($arr[1])){
            	foreach($arr[1] as $key=>$val){
            	unlink(".".$val);
          	 	 }
            }         
            $this->success('删除成功','/notice/index');
        }else{
            $this->error('删除失败','/notice/index');
        }
    }
    //修改页面
    public function getEdit(){
        $request=request();
        $id=$request->param('id');
        //获取要修改的这条数据
        $data=Db::table('notice')->where('id',$id)->find();
        return $this->fetch('Adminnotice/edit',['data'=>$data]);
    }
    //执行修改
    public function postUpdate(){
        $request=request();
        $id=$request->param('id');
        $result=Db::table('notice')->where('id',$id)->find();
        $name=$request->param('name');      
        $title=$result['title'];
        $newtitle=$request->param('title');  

        $file=$request->file('pic');
        $a=Db::table('notice')->where('id',$id)->find();
        $path='./gonggao/thumb/'.$a['pic'];//原先的缩放图片路径
        $paths="./gonggao/".$a['opic'];//原先的没缩放图片路径
         $data['name']=$name;
         $data['title']=$newtitle;
         $result=$this->validate(['file1'=>$file],['file1'=>'image'],['file1.image'=>'非法图像文件']);
        if(true!==$result){
            $this->error($result,'/notice/index/');
        }
        if(!$file){                     
        }else{
            $info=$file->move(ROOT_PATH.'public'.DS.'gonggao');
            // $message=$info->getSaveName();
            $b=$info->getSaveName();//获取原图信息
            $message=str_replace('\\','/',$b);//获取原图信息(转义过)

            $img=\think\Image::open("./gonggao/".$message);//缩放
	        $ext=$info->getExtension();//后缀名
	        $suofangname=time()+rand(1,10000);//起名字
	        $img->thumb(290,290)->save("./gonggao/thumb/".$suofangname.'.'.$ext);

            $data['pic']=$suofangname.'.'.$ext;
            unlink($path);//删除原先缩放图片路径
            unlink($paths);//删除原先图片路径
        }
        if(Db::table('notice')->where('id',$id)->update($data)){          
            $this->success('更新成功','/notice/Index');
        }else{
            $this->error('更新失败','/notice/Index');
        }
    }
    




}
