<?php
namespace fastphp;

// 框架根目录
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

/**
 * fastphp框架核心
 */
class Fastphp
{
    // 配置内容
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    // 运行程序
    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->setDbConfig();
        $this->route();
    }
    //路由处理
    public function route()
    {
    	$controllerName = $this->config['defaultController'];
    	$actionName = $this->['defaultAction'];
    	$param = array();

    	$url = $SERVER['REQUES_URI'];

    	//清除？之后的部分
    	$position = strpos($url, ?);
    	$url = $position ===false ? $url : substr($url,0,$position);

    	//删除前后的 ‘/’
    	$url = trim($url,'/');

    	if ($url){
    		//使用‘/’分割字符串，并保存到数组
    		$urlArray = explode('/',$url);
    		//删除空数组元素
    		$urlArray = array_filter($urlArray);
    		//获取控制器名
    		$controllerName = ucfirst($urlArray[0]);
    		//获取动作名
    		array_shift($urlArray);
    		$param = $urlArray ? $urlArray : array();
    	}
    }