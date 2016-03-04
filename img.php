<?php
function resizeImage($im,$maxwidth,$maxheight,$name,$filetype) {
    $pic_width = imagesx($im);  //获取图像宽度
    $pic_height = imagesy($im); //获取图像高度
    if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
        if($maxwidth && $pic_width>$maxwidth) {
            $widthratio = $maxwidth/$pic_width;     //图片宽度比例
            $resizewidth_tag = true;
        }
        if($maxheight && $pic_height>$maxheight) {
            $heightratio = $maxheight/$pic_height;  //图片高度比例
            $resizeheight_tag = true;
        }
        if($resizewidth_tag && $resizeheight_tag) {
            if($widthratio<$heightratio) {         //如果图片宽度比例小于高度比例，取最小的比例
                $ratio = $widthratio;
            }else {
                $ratio = $heightratio;
            }
        }

        if($resizewidth_tag && !$resizeheight_tag) {
            $ratio = $widthratio;
        }
        if($resizeheight_tag && !$resizewidth_tag) {
            $ratio = $heightratio;
        }

        $newwidth = $pic_width * $ratio;
        $newheight = $pic_height * $ratio;

        if(function_exists("imagecopyresampled")) {
            $newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数， 返回一个图像标识符，代表了一幅大小为 x_size 和 y_size 的黑色图像
            //imagecopyresampled函数是GD 2.x后新增加的函数，字面上的意思是会对图片进行重新采样(resampling)，GD是采用插值算法生成更平滑的图像，但是速度相对imagecopyresize()函数来说要慢一些
            imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }else {
            $newim = imagecreate($newwidth,$newheight);
            imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }

        $name = $name.$filetype;
        imagejpeg($newim,$name);    //以 JPEG 格式将图像输出到浏览器或文件
        imagedestroy($newim);       //销毁一图像
    }else {
        $name = $name.$filetype;
        imagejpeg($im,$name);
    }
}

//使用方法：  4:3的比例，如1000*750，图片最大显示尺寸是820*615
$im=imagecreatefromjpeg("./img/21.jpg");//参数是图片的存方路径

$maxwidth="820";//设置图片的最大宽度
$maxheight="615";//设置图片的最大高度
$name="123";//图片的名称，随便取吧
$filetype=".jpg";//图片类型
resizeImage($im,$maxwidth,$maxheight,$name,$filetype);//调用上面的函数



//


















