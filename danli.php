<?php
class Danli
{


//保存类实例的静态成员变量

    private static $_instance;


//private标记的构造方法

    private function __construct()
    {
        header("Content-type: text/html; charset=utf-8");
        echo 'This is a Constructed method;';

    }


//创建__clone方法防止对象被复制克隆

    public function __clone()
    {

        trigger_error('Clone is not allow!', E_USER_ERROR);

    }


//单例方法,用于访问实例的公共的静态方法

    public static function getInstance($alias)
    {

        if (!(self::$_instance instanceof self)) {

            self::$_instance = new self;
            echo '新创建一个实例<br>';
        }else {
            echo '沿用了原来的一个实例<br>';
        }

        return self::$_instance;

    }


    public function test()
    {

        echo '调用方法成功';

    }

}



$dl = Danli::getInstance();
$dl->test();
$dl = Danli::getInstance();
$dl->test();