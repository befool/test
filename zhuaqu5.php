<?php
require 'vendor/autoload.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");

$szUrl = "http://product.360che.com/s0/64_66_param.html";
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $szUrl);                   //表示你要抓取的网页内容
curl_setopt($curl, CURLOPT_HEADER, 0);                     //0表示不输出Header，1表示输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);            //设定是否显示头信息
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');                  //header中“Accept-Encoding: ”部分的内容，支持的编码格式为："identity"，"deflate"，"gzip"。如果设置为空字符串，则表示支持所有的编码格式
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);          //在HTTP请求中包含一个”user-agent”头的字符串。
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);              //设置这个选项为一个非零值(象 “Location: “)的头，服务器会把它当做HTTP头的一部分发送(注意这是递归的，PHP将发送形如 “Location: “的头)
$data = curl_exec($curl);                                      // 抓取URL并把它传递给浏览器
curl_close($curl);                //关闭cURL资源，并且释放系统资源

/*
$rules = array(
    'name' => array('.title-bar>h5','text'),    //车系名称
    'price' => array('.parameter-detail>table>thead>tr:eq(1)','text'),  //车系价格
    'ggxh' => array('.parameter-detail>table>tbody>tr:eq(1)','text'),   //车系各个参数
    'qdxs' => array('.parameter-detail>table>tbody>tr:eq(2)','text'),
    'zj' => array('.parameter-detail>table>tbody>tr:eq(3)','text'),
    'cscd' => array('.parameter-detail>table>tbody>tr:eq(4)','text'),
    'cskd' => array('.parameter-detail>table>tbody>tr:eq(5)','text'),
    'csgd' => array('.parameter-detail>table>tbody>tr:eq(6)','text'),
    'lj' => array('.parameter-detail>table>tbody>tr:eq(7)','text'),
    'zczl' => array('.parameter-detail>table>tbody>tr:eq(8)','text'),
    'zzl' => array('.parameter-detail>table>tbody>tr:eq(9)','text'),
    'qyzzl' => array('.parameter-detail>table>tbody>tr:eq(10)','text'),
    'zgcs' => array('.parameter-detail>table>tbody>tr:eq(11)','text'),
    'zxzwzj' => array('.parameter-detail>table>tbody>tr:eq(12)','text'),
    'fdj' => array('.parameter-detail>table>tbody>tr:eq(14)','text'),
    'qgs' => array('.parameter-detail>table>tbody>tr:eq(15)','text'),
    'rlzl' => array('.parameter-detail>table>tbody>tr:eq(16)','text'),
    'qgplxs' => array('.parameter-detail>table>tbody>tr:eq(17)','text'),
    'pl' => array('.parameter-detail>table>tbody>tr:eq(18)','text'),
    'pfbz' => array('.parameter-detail>table>tbody>tr:eq(19)','text'),
    'zdml' => array('.parameter-detail>table>tbody>tr:eq(20)','text'),
    'zdscgl' => array('.parameter-detail>table>tbody>tr:eq(21)','text'),
    'jj' => array('.parameter-detail>table>tbody>tr:eq(22)','text'),
    'zdjjzs' => array('.parameter-detail>table>tbody>tr:eq(23)','text'),
    'edzs' => array('.parameter-detail>table>tbody>tr:eq(24)','text'),
    'jslx' => array('.parameter-detail>table>tbody>tr:eq(25)','text'),
    'jss' => array('.parameter-detail>table>tbody>tr:eq(27)','text'),
    'wpcc' => array('.parameter-detail>table>tbody>tr:eq(28)','text'),
    'zcrs' => array('.parameter-detail>table>tbody>tr:eq(29)','text'),
    'zwps' => array('.parameter-detail>table>tbody>tr:eq(30)','text'),
    'bsx' => array('.parameter-detail>table>tbody>tr:eq(32)','text'),
    'hdfs' => array('.parameter-detail>table>tbody>tr:eq(33)','text'),
    'qjdw' => array('.parameter-detail>table>tbody>tr:eq(34)','text'),
    'dds' => array('.parameter-detail>table>tbody>tr:eq(35)','text'),
    'lts' => array('.parameter-detail>table>tbody>tr:eq(37)','text'),
    'ltgg' => array('.parameter-detail>table>tbody>tr:eq(38)','text'),
    'yxqgcz' => array('.parameter-detail>table>tbody>tr:eq(40)','text'),
    'yxqgrl' => array('.parameter-detail>table>tbody>tr:eq(41)','text'),
    'hqms' => array('.parameter-detail>table>tbody>tr:eq(43)','text'),
    'hqyxzh' => array('.parameter-detail>table>tbody>tr:eq(44)','text'),
    'hqsb' => array('.parameter-detail>table>tbody>tr:eq(45)','text'),
    'xgxs' => array('.parameter-detail>table>tbody>tr:eq(46)','text'),
    'thps' => array('.parameter-detail>table>tbody>tr:eq(47)','text')
);
$data = QueryList::Query($data,$rules)->data;*/



//抓取图片
//外观图片
/*$imgUrl1 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t31_c1.html";
$imgUrl2 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t31_c2.html";
$rules = array(
    'image' => array('.imgname_b_cent>dl>dt>a>img','src'),    //车系名称
);
$data1 = QueryList::Query($imgUrl1,$rules)->data;
$data2 = QueryList::Query($imgUrl2,$rules)->data;*/

//驾驶室图片
/*$imgUrl1 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t32_c1.html";
$imgUrl2 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t32_c2.html";
$rules = array(
    'image' => array('.imgname_b_cent>dl>dt>a>img','src'),    //车系名称
);
$data1 = QueryList::Query($imgUrl1,$rules)->data;
$data2 = QueryList::Query($imgUrl2,$rules)->data;*/



//底盘图片
$imgUrl1 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t33_c1.html";
$imgUrl2 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t33_c2.html";
$imgUrl3 = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t33_c3.html";
$rules = array(
    'image' => array('.imgname_b_cent>dl>dt>a>img','src'),    //车系名称
);
$data1 = QueryList::Query($imgUrl1,$rules)->data;
$data2 = QueryList::Query($imgUrl2,$rules)->data;
$data3 = QueryList::Query($imgUrl3,$rules)->data;
print_r($data3);exit;


/**
 * 批量抓取规则
 * 分类+品牌下的产品URL：http://product.360che.com/s0/106_65_index.html
 *      详细参数下的URL：http://product.360che.com/s0/106_65_param.html
 *      实拍图片下的URL：http://product.360che.com/s0/106_65_pic.html  抓取改地址下的所有图片地址，打开。。。
 *                       得到：http://product.360che.com/img/c1_s65_b28_s106_m20322_t0.html
 *                       外观：http://product.360che.com/img/c1_s65_b28_s106_m20322_t26.html
 *                     驾驶室；http://product.360che.com/img/c1_s65_b28_s106_m20322_t27.html
 *                      底盘L；http://product.360che.com/img/c1_s65_b28_s106_m20322_t28.html
 *                       上装；http://product.360che.com/img/c1_s65_b28_s106_m20322_t29.html
 *
 * 分类+品牌下的产品URL：http://product.360che.com/s0/99_66_index.html
 *      详细参数下的URL：http://product.360che.com/s0/99_66_param.html
 *        实拍图片的URL：http://product.360che.com/s0/99_66_pic.html
 *
 */


?>