<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Allow;
class Cates extends Allow
{
    //分类列表
    public function getIndex()
    {
        //分隔符,排序  concat  创建一个字段,拼接
        $list=Db::table('cates')->field(['id','name','pid','path','concat(path,",",id)'=>'paths'])->order('paths asc')->paginate(10);
        $page=$list->render();
        $data=$list->all();
            // 获取逗号有几个,转换为数组   str_repeat()   重复一个字符串 参数一是字符串,参数二是次数
        foreach($data as $k=>$v){
            $info=explode(',',$v['path']);
            $len=count($info)-1;
            $data[$k]['name']=str_repeat('--|',$len).$v['name'];
        }       
        return $this->fetch('Admincate/index',['data'=>$data,'page'=>$page]);
    }
    //添加
    public function getAdd(){
       $data=Db::table('cates')->field(['id','name','pid','path','concat(path,",",id)'=>'paths'])->order('paths asc')->select();

        foreach($data as $k=>$v){
            $info=explode(',',$v['path']);
            $len=count($info)-1;
            $data[$k]['name']=str_repeat('--|',$len).$v['name'];
        }       
        return $this->fetch('Admincate/add',['data'=>$data]);
    }
    //执行添加
    public function postInsert(){
        $request=request();
        $data=$request->only(['name','pid']);
        $pid=$request->param('pid');
        // 判断如果是顶级分类,pid=0
        if($pid==0){
            $data['path']='0';
        }else{
            $list=Db::table('cates')->where('id',$pid)->find();
            $data['path']=$list['path'].','.$list['id'];//拼接不是顶级分类的path
        }
        $info=Db::table('cates')->insert($data);
        if($info){
            $this->success('添加成功','/cates/index');
        }else{
            $this->error('添加失败','/cates/index');
        }

    }
    //删除分类
    public function getDelete(){
        $request=request();
        $id=$request->param('id');
        // var_dump($id);
        $s=Db::table('cates')->where('pid',"{$id}")->Count();//获取这条数据底下有没有子类pid=id
        // echo $s;exit;
        if($s>0){
            $this->error('请先删除子类','/cates/index');
        }else{
            if(Db::table('cates')->where('id',$id)->delete()){
                $this->success('删除成功','/cates/index');
            }else{
                $this->error('删除失败','/cates/index');
            }
        }


    }
    //修改分类
    public function getEdit(){
        $request=request();
        $id=$request->param('id');
        $info=Db::table('cates')->where('id',$id)->find();//获取要修改的这条数据
        $data=Db::table('cates')->field(['id','name','pid','path','concat(path,",",id)'=>'paths'])->order('paths asc')->select();
        // $page=$list->render();
        // $data=$list->all();
        // $data=$this->getcates();
        foreach($data as $k=>$v){
            $infos=explode(',',$v['path']);
            $len=count($infos)-1;
            $data[$k]['name']=str_repeat('--|',$len).$v['name'];
        }       //全数据
        // var_dump($info);exit;
        return $this->fetch('Admincate/edit',['data'=>$data,'info'=>$info]);
    }
    //执行修改
    public function postUpdate(){
        $request=request();        
        $id=$request->param('id');//加载隐藏域id
        $data=$request->only(['name','pid']);//获取要更新的值
        $pid=Db::table('cates')->where('id',$data['pid'])->find();
        $path=$pid['path'].','.$pid['id'];
        $data['path']=$path;
        // var_dump($path);exit;
        // var_dump($id);exit;
        if(Db::table('cates')->where('id',"{$id}")->update($data)){
            $this->success('修改成功','/Cates/index');
        }else{
            $this->error('修改失败','/Cates/edit');
        }
    }




}
