<?php
//处理数据，分别从category表和brand表查询数据，组装插入到ShipmentCategoryBrand表
require '../mysql/mysql.php';
header("Content-type:text/html;charset=utf-8");

//获取所有的子类
$sql = "select * from ShipmentCategory where cid>0";
$list = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if(empty($list)) {
    return false;
}
$brandNum = 0;
set_time_limit(0);
$f = fopen('categorybrand.txt','a');
foreach($list as $val) {
    //获取子类下所有的品牌
    $sql = "select * from ShipmentBrand where sid=".$val['id']." and cid=".$val['cid'];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    foreach($res as $v) {
        $sql = "insert into ShipmentCategory2Brand(categoryId,brandId,createUid,createTime) values(".$v['sid'].",".$v['bid'].",0,'".date('Y-m-d H:i:s')."')";
        fwrite($f,$sql.';'.PHP_EOL);
        $brandNum++;
    }
}
fclose($f);
echo "brandNum：".$brandNum."<br>";
exit;


?>