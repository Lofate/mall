<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Config;
use app\admin\controller\Allow;
class Ads extends Allow
{
    //广告列表
    public function getIndex(){
        $data=Db::table('ads')->paginate(2);
        return $this->fetch('Adminads/index',['data'=>$data]);
    }
    //广告ajax操作,按钮操作后台数据status
    public function getAjax(){
        $request=request();
        $id=$request->param('id');
        // var_dump($id);
        $list=Db::table('ads')->where('id',$id)->find();
        if($list['status']==0){
           Db::query("update ads set status=1 where id=$id");
        }else{
            Db::query("update ads set status=0 where id=$id");
        }
        return 1;
    }
    //添加页面
    public function getAdd(){
        $data=Db::table('cates')->field(['id','name','pid','path','concat(path,",",id)'=>'paths'])->order('paths asc')->select();
        foreach($data as $k=>$v){
            $info=explode(',',$v['path']);
            $len=count($info)-1;
            $data[$k]['name']=str_repeat('--|',$len).$v['name'];
        }       
        return $this->fetch('Adminads/add',['data'=>$data]);
    }
    //执行添加
    public function postInsert(){
        $request=request();
        $pid=$request->param('pid');
        // var_dump($pid);
        // exit;
        $name=$request->param('name');
        $miaoshu=$request->param('miaoshu');
        $file=$request->file('pic');
        $result=$this->validate(['file1'=>$file],['file1'=>'require|image'],['file1.require'=>'文件不能为空','file1.image'=>'非法图像文件']);
        if(true!==$result){
            $this->error($result,'/pics/add');
        }
        if($file){
            $info=$file->move(ROOT_PATH.'public'.DS.'guanggao');
        }
        $a=$info->getSaveName();//获取文件信息
        $message=str_replace('\\','/',$a);//修改路径
        //打开原图片路径
        $img=\think\Image::open("./guanggao/".$message);
        $ext=$info->getExtension();
        $suofangname=time()+rand(1,10000);
        $img->thumb(290,290)->save("./guanggao/thumb/".$suofangname.'.'.$ext);
        $data['name']=$name;
        $data['miaoshu']=$miaoshu;
        $data['pic']=$suofangname.'.'.$ext;
        $data['opic']=$message;
        $data['status']=0;
        $data['pid']=$pid;
        // $data就是要添加的字段
        if(Db::table('ads')->insert($data)){
            $this->success('添加成功','/ads/index');
        }else{
            $this->error('添加失败','/ads/add');
        }
    }
    //删除操作
    public function getDelete(){
        $request=request();
        $id=$request->param('id');
        $data=Db::table('ads')->where('id',$id)->find();
        $opath='./guanggao/'.$data['opic'];   
        $path='./guanggao/thumb/'.$data['pic'];   

        // var_dump($path);exit;
        if(Db::table('ads')->where('id',$id)->delete()){
            unlink($path);
            unlink($opath);
            $this->success('删除成功','/ads/index');
        }else{
            $this->error('删除失败','/ads/index');
        }
    }
    //修改页面
    public function getEdit(){
        $request=request();
        $id=$request->param('id');
        //获取要修改的这条数据
        $datas=Db::table('ads')->where('id',$id)->find();

        $data=Db::table('cates')->field(['id','name','pid','path','concat(path,",",id)'=>'paths'])->order('paths asc')->select();
        foreach($data as $k=>$v){
            $info=explode(',',$v['path']);
            $len=count($info)-1;
            $data[$k]['name']=str_repeat('--|',$len).$v['name'];
        }       
        // var_dump($data);exit;
        return $this->fetch('Adminads/edit',['datas'=>$datas,'data'=>$data]);
    }
    //执行修改
    public function postUpdate(){
        $request=request();
        $id=$request->param('id');
        $pid=$request->param('pid');
        $name=$request->param('name');      
        $miaoshu=$request->param('miaoshu');      
        $file=$request->file('pic');
        $a=Db::table('ads')->where('id',$id)->find();
        $opath='./guanggao/'.$a['opic'];//原先的图片路径
        $path='./guanggao/thumb/'.$a['pic'];//缩放后的图片路径
         $data['name']=$name;
         $data['miaoshu']=$miaoshu;
         if(!$pid){
            $data['pid']=$a['pid'];

         }else{
            $data['pid']=$pid;
         }
        if(!$file){                     
        }else{
            $info=$file->move(ROOT_PATH.'public'.DS.'guanggao');
            // $message=$info->getSaveName();
            $a=$info->getSaveName();//获取文件信息
            $message=str_replace('\\','/',$a);
            $data['opic']=$message;
            $img=\think\Image::open("./guanggao/".$message);
            $ext=$info->getExtension();
            $suofangname=time()+rand(1,10000);
            $img->thumb(290,290)->save("./guanggao/thumb/".$suofangname.'.'.$ext);
            $data['pic']=$suofangname.'.'.$ext;
            unlink($opath);//删除原先图片路径
            unlink($path);//删除缩放图,图片路径
        }
        if(Db::table('ads')->where('id',$id)->update($data)){          
            $this->success('更新成功','/ads/Index');
        }else{
            $this->error('更新失败','/ads/Index');
        }
    }
    




}
