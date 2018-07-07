<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use app\admin\controller\Allow;
class Index extends Allow
{
    public function getIndex()
    {
        return $this->fetch('Admin/index');
    }
}
