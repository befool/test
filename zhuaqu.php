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

$szUrl = "http://product.360che.com/m6/20766_para.html";
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



/*$reg1 = "#<td class=\"p_c_a\"><div>(.*?)<\/div><\/td>#";
preg_match_all($reg1 , $data , $matches1);
$keys = $matches1[0];*/

/*$reg2 = "/<td class=\"p_c_b\"[^>]*>(.*?)<\/td>/si";
preg_match_all($reg2 , $data , $matches2);*/


$reg3 = "/<div class=\"conttan_a_l\">[\s]*<a[^>]*>(.*?)<\/a>/si";
preg_match_all($reg3 , $data , $matches3);
var_dump($matches3);exit;



exit();



?>