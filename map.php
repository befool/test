<?php?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hello, World</title>
    <style type="text/css">
        html{height:100%}
        body{height:100%;margin:0px;padding:0px}
        #container{height:100%}
    </style>
    <script src="http://api.map.baidu.com/api?v=2.0&ak=UPs0Hpph3GWGXhgkTrIwi7p6" type="text/javascript"></script>
</head>

<body>
<div id="container"></div>
<div id="results"></div>
<div id="log" style="width:99%;height:500px;border:solid 1px #ccc;"></div>
<script type="text/javascript">
    var map = new BMap.Map("container");
    map.centerAndZoom(new BMap.Point(116.404, 39.915), 14);
    var local = new BMap.LocalSearch(map,
        { renderOptions:{map: map}});
    local.searchNearby("卡车", '北京,西安');

</script>
</body>
</html>




