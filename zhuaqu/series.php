<?php
//抓取每个分类下的品牌
require '../vendor/autoload.php';
require '../mysql/mysql.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");

//获取所有的品牌
$sql = "select * from shipmentbrand group by bid";
$list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if(empty($list)) {
    return false;
}
$errorUrl = array();    //错误的插入数据
$errorArr = array();    //错误的插入数据
$seriesNum = 0;          //系列数目
$szUrlArr = array();
$brandNameArr = array();
set_time_limit(0);
$f = fopen('series.txt','a');
//循环获取每个品牌下的系列
foreach($list as $val) {
    $brandNameArr[] = $val['name'];
    //获取每个品牌下的系列的分页数
    $pageNum = 0;
    $szUrl = "http://product.360che.com/p0_b".$val['bid']."/1.html";
    $rules = array(
        'name' => array('.page>a','html'),    //系列名称
    );
    $data = QueryList::Query($szUrl,$rules)->data;
    if(empty($data)) {//说明就一页
        $pageNum = 1;
    }else {
        $pageNum = $data[count($data)-2]['name'];
    }

    //循环页数，获取每页的数据
    for($i=1;$i<=$pageNum;$i++) {
        $szUrl = "http://product.360che.com/p0_b".$val['bid']."/".$i.".html";
        $szUrlArr[] =$szUrl;
        $UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $szUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $content = curl_exec($curl);
        curl_close($curl);
        if(empty($content)) {
            $errorUrl[] = $szUrl;
            continue;
        }
        $rules = array(
            'name' => array('.caption>h5>a','html'),    //系列名称
        );
        $data = QueryList::Query($content,$rules)->data;
        if(empty($data)) {
            $errorUrl[] = $szUrl;
            continue;
        }
        foreach($data as $v) {
            $name = $v['name'];
            $name = preg_split('/(?<!^)(?!$)/u', $name);
            $names = '';
            for($i=0;$i<count($name);$i++) {
                if(json_encode($name[$i])=="\"\u00a0\"") {
                    $names .= ',';
                }else {
                    $names .= $name[$i];
                }
            }
            $names = explode(',',$names);
            $series = $names[1];
            $sql = "insert into shipmentseries(name,brandId,createrUid,isDeleted,createdTime) values('".$series."',".$val['bid'].",0,0,'".date('Y-m-d H:i:s')."')";
            fwrite($f,$sql.';'.PHP_EOL);
            $seriesNum++;
        }
    }
}
fclose($f);
print_r($errorUrl);
echo "<br>";
if(empty($errorArr)) {
    echo "series：".$seriesNum."<br>";
    print_r($szUrlArr);
    die('all success');
}else {
    print_r($errorArr);
}
exit;


?>