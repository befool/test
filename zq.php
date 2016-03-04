<?php
require 'vendor/autoload.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");

$szUrl = "http://product.360che.com/#pvareaid=1010101";
$rules = array(
    'id' => array('.filter-list>dl:eq(0)>dd>em>a','data'),    //分类id
    'name' => array('.filter-list>dl:eq(0)>dd>em>a','text'),    //分类名称
    'url' => array('.filter-list>dl:eq(0)>dd>em>a','href'),    //分类名称
);
$data = QueryList::Query($szUrl,$rules)->data;
foreach($data as &$val) {
    $val['url'] = str_replace('c','',substr($val['url'],7,-(strlen($val['url'])-strpos($val['url'],'_s'))));

}

exit;


?>