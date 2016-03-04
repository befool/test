<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>test百度</title>
    <style type="text/css">
        html{height:100%}
        body{height:100%;margin:0px;padding:0px}
        #container{height:100%}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=UPs0Hpph3GWGXhgkTrIwi7p6">
        //v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
        //v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
    </script>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
</head>

<body>
<div id="container"></div>
<!--<input type="button" onclick="driving.search('中关村', '天安门')" value="查看路线">-->
<div id="results"></div>
<script type="text/javascript">
    var map = new BMap.Map("container");          // 创建地图实例
    var point = new BMap.Point(116.404, 39.915);  // 创建点坐标
    map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别

    map.enableScrollWheelZoom(true);                //可以缩小或者放大地图（通过鼠标滚轮）

    var driving = new BMap.DrivingRoute(map, {
        renderOptions: {
            map   : map,
            panel : "results",
            autoViewport: true,
            enableDragging: true,		//允许拖拽终点
            highlightMode: BMAP_HIGHLIGHT_ROUTE		//控制点击panel中的方案描述时展示点位置还是展示一段路线,它支持如下两个值：BMAP_HIGHLIGHT_STEP：展现关键点; BMAP_HIGHLIGHT_ROUTE：展现路段
        }
    });

    driving.search("北京天安门", "西北工业大学");


    $('.navtrans-res').hide();


</script>
</body>
</html>