<?php
//框架引导类、初始化类
class Frame{
    //挨个调用下面的方法
    public static function run(){
        self::initConfig();
        self::initRoutes();
        self::initConst();
        self::initAutoload();
        self::initDispatch();
    }

    //读取配置文件，并将配置项放到全局数组中，以便在任何位置使用
    private static function initConfig(){
        $GLOBALS['config'] = require_once './App/Config/config.php';
        //echo '<pre>';
        //print_r($GLOBALS['config']);
    }

    //获取路由参数，获取地址栏里的平台参数、控制器参数、方法参数
    private static function initRoutes(){
        $p = isset($_GET['p']) ? $_GET['p'] : $GLOBALS['config']['default_plat'];
        $c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller'];
        $a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];
        define('PLAT', $p);       //定义平台常量  Home
        define('CONTROLLER', $c); //定义控制器常量  Student  News  Index
        define('ACTION', $a);     //定义操作/方法常量 index 类中的方法名
    }

    //定义目录常量，全都加 DS
    private static function initConst(){
        define('DS', DIRECTORY_SEPARATOR); //根据不同的系统，定义不同的路径分割符
        define('ROOT_PATH', getcwd() . DS);     //定义项目根目录,E:\wamp\www\blog
        define('FRAMES_PATH', ROOT_PATH . 'Frame' . DS); //定义框架目录
        define('APP_PATH', ROOT_PATH . 'App' . DS); //定义应用/项目目录
        //定义 自定义的控制器、模型、视图的路径
        define('CONTROLLER_PATH', APP_PATH . PLAT . DS . 'Controller' . DS);
        define('MODEL_PATH', APP_PATH . PLAT . DS . 'Model' . DS);
        define('VIEW_PATH', APP_PATH . PLAT . DS . 'View' . DS . CONTROLLER . DS);
    }

    //自动加载
    private static function initAutoload(){
        spl_autoload_register(function($className){
            //自动加载框架目录中的类
            $frameFileName = FRAMES_PATH . $className . '.class.php'; // E:\wamp\www\blog\Frame\BaseModel.class.php
            if(file_exists($frameFileName)) require_once $frameFileName;
            //自动加载自定义控制器中的类
            $controllerFileName = CONTROLLER_PATH . $className . '.class.php';
            if(file_exists($controllerFileName)) require_once $controllerFileName;
            //自动加载自定义模型中的类
            $modelFileName = MODEL_PATH . $className . '.class.php';
            if(file_exists($modelFileName)) require_once $modelFileName;
        });
    }

    //请求分发：根据p、c、a参数来断定访问哪个平台下面的哪个控制器中的哪个方法
    private static function initDispatch(){
        //实例化一个自定义控制器类的对象
        $controllerName = CONTROLLER . 'Controller';
        //echo $controllerName; //StudentController;
        $controllerObj = new $controllerName();
        $a = ACTION; //getAllStudent
        $controllerObj->$a();
    }
}
?>