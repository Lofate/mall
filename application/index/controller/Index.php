<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Page;
use think\Paginator;
class Index extends Controller
{
    public function getJwd()
    {
    	$data=$this->getCatesBypid(0);//分类遍历
        $pics=Db::table('pics')->where('status',0)->select();//轮播图遍历
        $ads=Db::table('ads')->where('status',0)->limit(2)->select();
        $notice=Db::table('notice')->limit(4)->select();
        // var_dump($notice);exit;
        //友情链接
        $link = Db::table('link')->where('status',0)->select();
        //限时抢购
        $arr=$this->getShopping();
        //抢购商品
        $shop=Db::table('shopping')->where('status',1)->paginate(8);
        $request=request();
        $a=$request->param('a');//经度
        $b=$request->param('b');//纬度
    
        //天气模块
        $weather=$this->getWeatherByCity($a,$b);
        return $this->fetch('Index/index',['data'=>$data,'pics'=>$pics,'ads'=>$ads,'link'=>$link,'notice'=>$notice,'arr'=>$arr,'shop'=>$shop,'weather'=>$weather]);

        
        

    }
    public function getIndex(){
        return $this->fetch('Index/a');
    }

    public function getCatesBypid($pid){
    	$data=Db::table('cates')->where('pid',"{$pid}")->select();
    	$info=[];
        // var_dump($data);
    	foreach($data as $k=>$v){
    		$v['shop']=$this->getCatesBypid($v['id']);
    		$info[]=$v;
    	}
    	return $info;
    }
    //友情链接
    public function getLink(){
    	$data = Db::table('link')->select();

    }

    //限时抢购
    public function getShopping(){
        $shop=Db::table('shopping')->where('status',1)->paginate(8);
        // var_dump($shop);
        $arr=Array();
        //遍历得到商品的内容
        foreach($shop as $v){
            //通过name查找商品详情
            $data1=Db::table("admin_goods")->where("id",$v['goods_id'])->find();
            $arr[]=$data1;
        }
        return $arr;
    }


    //天气模块
    public function getWeatherByCity($a,$b)
    {
        
        $url = "http://v.juhe.cn/weather/geo";
        // $appkey = config('appkey');
        
        $params = [
                // "ip" => '183.129.134.137',//要查询的城市，如：温州、上海、北京
                // lon=116.39277&lat=39.933748
                'lon'=>$a,
                'lat'=>$b,
                "key" => '484ff4acbeadbad7be6cdf2747c59e3b',//应用APPKEY(应用详细页查询)
                "dtype" => "json",//返回数据的格式,xml或json，默认json
                'format'=>'2'
        ];
        $paramstring = http_build_query($params);
        
        $content = juhecurl($url, $paramstring);
        $result = json_decode($content, true);
        // echo'<pre>';
       
        
        $data['today']=$result['result']['today'];
         // var_dump($data);exit;
        return $data;
    }
}
