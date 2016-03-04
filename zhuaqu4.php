<?php
/*$url = "http://product.360che.com/1.html";
// 创建一个新cURL资源
$ch = curl_init();
// 设置URL和相应的选项
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
// 抓取URL并把它传递给浏览器
$data = curl_exec($ch);
echo $data;
//关闭cURL资源，并且释放系统资源
curl_close($ch);*/


if(stristr("徐工汽车 50吨以下","1徐工汽车")==false){
    die('aa');
}else{
    die('bb');
}


header("Content-type:text/html;charset=utf-8");

$szUrl = "http://product.360che.com/s0/64_66_param.html";
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$curl = curl_init();                                        // 创建一个新cURL资源
curl_setopt($curl, CURLOPT_URL, $szUrl);                   //表示你要抓取的网页内容
curl_setopt($curl, CURLOPT_HEADER, 0);                     //0表示不输出Header，1表示输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);            //设定是否显示头信息
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');                  //header中“Accept-Encoding: ”部分的内容，支持的编码格式为："identity"，"deflate"，"gzip"。如果设置为空字符串，则表示支持所有的编码格式
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);          //在HTTP请求中包含一个”user-agent”头的字符串。
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);              //设置这个选项为一个非零值(象 “Location: “)的头，服务器会把它当做HTTP头的一部分发送(注意这是递归的，PHP将发送形如 “Location: “的头)
$data = curl_exec($curl);                                      // 抓取URL并把它传递给浏览器
//echo curl_errno($curl); //返回0时表示程序执行成功 如何从curl_errno返回值获取错误信息
curl_close($curl);                //关闭cURL资源，并且释放系统资源

//获取页面表格表头信息
$reg = "/<div class=\"parameter-detail\">[\s.*]*<table>[\s.*](.*?)<\/thead>/si";
preg_match_all($reg, $data , $matches);
$content = $matches[1][0];

//获取所有的名称
$reg2 = "/<h5>[\s.*]*<a[^>]*>(.*?)<\/a>/si";
preg_match_all($reg2, $content , $matches2);
$names = $matches2[1];

//获取所有的价格
$reg3 = "/<tr>[\s.*]*<td>[^>]*>(.*?)<\/tr>/si";
preg_match_all($reg3, $content , $matches3);
$price = $matches3[1][0];
$price = str_replace(array('<td>','</td>'),'',$price);




//获取页面主体内容信息
$reg4 = "/<div class=\"parameter-detail\">[\s.*]*<table>[\s.*](.*?)<\/table>/si";
preg_match_all($reg4, $data , $matches4);
preg_match_all("/<tbody >(.*?)<\/tbody>/si", $matches4[1][0] , $matches5);
$content2 = $matches5[1][0];

//获取所有的property
preg_match_all("/<tr class=\"param-row\" data-option=\"\">(.*?)<\/tr>/si", $content2 , $property);
foreach($property[1] as &$val) {
    $val = str_replace(array('<td>','<td >','</td>','<!-- 拼接数据的开始 start -->','<!-- <i class="edit" style="display:none;" ></i> -->','<!-- 以下是拼接的数据  end -->'),'',$val);
}







//-----------------------------------华丽的分割线----------------------------------------
//抓取图片
$szUrl = "http://product.360che.com/img/c1_s66_b5_s64_m19359_t0.html";
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
$data = curl_exec($curl);
curl_close($curl);





?>