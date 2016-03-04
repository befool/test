<?php
if(isset($_GET['url']))
{
    $image_URL = $_GET['url'];

    $image=imagecreatefromgif($image_URL);

    $bg=imagecolorallocate($image,255,255,255);

    $font_color=imagecolorallocate($image,41,50,255);

    imagefilledrectangle($image,50,50,106,106,$bg);

    imagestring($image,5,40,65,"GooGle",$font_color);

    imagegif($image);

}else
{
    echo "noimage.jpg";
}