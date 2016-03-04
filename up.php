<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/12
 * Time: 15:39
 */

function imagecropper($source_path, $max_width, $max_height, $bili) {
    $source_info   = getimagesize($source_path);    //获取原始图片信息
    $source_width  = $source_info[0];               //获取原始图片的宽度
    $source_height = $source_info[1];               //获取原始图片的高度
    $source_mime   = $source_info['mime'];          //获取原始图片的文件类型

    //先计算出要裁剪后的图片尺寸是多大
    if($source_width<=$max_width) {     //1、如果原始图片的宽，小于最大允许的宽
        $newwidth = $source_width;
        $newheight = $source_width*$bili;
    }elseif($source_height<=$max_height) {//2、如果原始图片的高，小于最大允许的高
        $newheight = $source_height;
        $newwidth = $newheight/$bili;
    }else {
        $b1 = $max_width/$source_width;
        $b2 = $max_height/$source_height;
        $b3 = $b1<$b2 ? $b1 : $b2;
        $newwidth = ceil($source_width*$b3);
        $newheight = ceil($source_height*$b3);
    }

    $target_width = $newwidth>$newheight ? $newwidth : $newheight;
    $target_height = $newwidth<$newheight ? $newwidth : $newheight;

    if($target_width*$bili>$target_height) {
        $target_width = $target_height/$bili;
    }
    if($target_height*$bili>$target_width) {
        $target_height = $target_width/$bili;
    }

    $source_ratio  = $source_height / $source_width;
    $target_ratio  = $target_height / $target_width;

    if ($source_ratio > $target_ratio) {
        $cropped_width  = $source_width;
        $cropped_height = $source_width * $target_ratio;
        $source_x = 0;
        $source_y = ($source_height - $cropped_height) / 2;
    }elseif ($source_ratio < $target_ratio) {
        $cropped_width  = $source_height / $target_ratio;
        $cropped_height = $source_height;
        $source_x = ($source_width - $cropped_width) / 2;
        $source_y = 0;
    }else {
        $cropped_width  = $source_width;
        $cropped_height = $source_height;
        $source_x = 0;
        $source_y = 0;
    }

    switch ($source_mime) {
        case 'image/gif':
            $source_image = imagecreatefromgif($source_path);
            break;
        case 'image/jpeg':
            $source_image = imagecreatefromjpeg($source_path);
            break;
        case 'image/png':
            $source_image = imagecreatefrompng($source_path);
            break;
        default:
            return false;
            break;
    }

    $target_image  = imagecreatetruecolor($target_width, $target_height);
    $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);

    // 裁剪
    imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
    // 缩放
    imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);

    imagejpeg($target_image,$source_path);
    imagedestroy($source_image);
    imagedestroy($target_image);
    imagedestroy($cropped_image);
}

if($_POST) {
    $newFile = "./upload/" . $_FILES["file"]["name"];
    move_uploaded_file($_FILES["file"]["tmp_name"],$newFile);
    if($_POST['compress']=='1') {
        imagecropper($newFile,820,615,0.75);
    }
}



?>

<html>
<body>
<form action="up.php" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <p><input type="file" name="file" id="file" /></p>
    <p>
        yasuo<input type="radio" name="compress" value="1" checked/>
        buyasuo<input type="radio" name="compress" value="0" />
    </p>
    <br />
    <input type="submit" name="submit" value="Submit" />
</form>
</body>
</html>
