<?php
//抓取每个分类下,每个品牌下的商品
require '../vendor/autoload.php';
require '../mysql/mysql.php';
use QL\QueryList;
header("Content-type:text/html;charset=utf-8");

$sid = $_GET['sid'];
if(empty($sid)) {
    return false;
}

//判断是否有改子类
$sql = "select * from shipmentcategory where id=".$sid;
$res = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
if(empty($res)) {
    return false;
}

//根据分类获取所有的品牌
//判断是否有改子类
$sql = "select * from shipmentbrand where sid=".$sid;
$list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if(empty($list)) {
    return false;
}





$errorUrl = array();    //错误的插入数据
$errorArr = array();    //错误的插入数据
$brandNum = 0;          //品牌数目
$szUrlArr = array();
set_time_limit(0);
$f = fopen('brand.txt','a');
foreach($list as $val) {
    $szUrl = "http://product.360che.com/price/c".$val['cid']."_s".$val['sid']."_b0_s0.html";
    $szUrlArr[] = $szUrl;
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
        'name' => array('.filter-brands-detail>ul>li>a','text'),    //品牌名称
        'url' => array('.filter-brands-detail>ul>li>a','href'),    //品牌url
    );
    $data = QueryList::Query($content,$rules)->data;
    if(empty($data)) {
        $errorUrl[] = $szUrl;
        continue;
    }
    foreach($data as $v) {
        $start = strpos($v['url'],'_b')+2;
        $bid =  substr($v['url'],$start,-(strlen($v['url'])-strpos($v['url'],'_s0')));
        $name = str_replace(' ','',$v['name']);
        $sql = "insert into brand(bid,cid,sid,name) values(".$bid.",".$val['cid'].",".$val['sid'].",'".$name."')";
        /*$res = $db->exec($sql);
        if($res===false) {
            $errorArr[] = array('cid'=>$val['cid'],'sid'=>$val['sid'],'bid'=>$bid,'name'=>$v['name']);
        }*/
        fwrite($f,$sql.';'.PHP_EOL);
        $brandNum++;
    }
}
fclose($f);
print_r($errorUrl);
echo "<br>";
if(empty($errorArr)) {
    echo "brandNum：".$brandNum."<br>";
    print_r($szUrlArr);
    die('all success');
}else {
    print_r($errorArr);
}
exit;


?>