<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Config;
use think\Session;

class Weather extends Controller
{
	

    public function getIndex()
    {
        $data=$this->getWeatherByCity();
        return $this->fetch('IndexPublic/public',['data'=>$data]);
    }


  public function getWeatherByCity()
    {
        
        $url = "http://v.juhe.cn/weather/ip";
        // $appkey = config('appkey');
        
        $params = [
                "ip" => '183.129.134.137',//要查询的城市，如：温州、上海、北京
                "key" => '484ff4acbeadbad7be6cdf2747c59e3b',//应用APPKEY(应用详细页查询)
                "dtype" => "json",//返回数据的格式,xml或json，默认json
                'format'=>'2'
        ];
        $paramstring = http_build_query($params);
        
        $content = juhecurl($url, $paramstring);
        $result = json_decode($content, true);
        echo'<pre>';
       
        
        $data['today']=$result['result']['today'];
         // var_dump($data);exit;
        return $data;
    }
}    
    
