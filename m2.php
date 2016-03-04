<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>根据地址获取经度纬度</title>
    <style type="text/css">
        html{height:100%}
        body{height:100%;margin:0px;padding:0px}
        #container{
            position: absolute;
            margin-top:30px;
            width: 730px;
            height: 590px;
            top: 50;
            border: 1px solid gray;
            overflow:hidden;
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=UPs0Hpph3GWGXhgkTrIwi7p6">
        //v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
        //v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
    </script>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
</head>
<body>

<div style="width:730px;margin:auto;">
    要查询的地址：<input id="text_" type="text" value="宁波天一广场" style="margin-right:100px;"/>
    查询结果(经纬度)：<input id="result_" type="text" />
    <input type="button" value="查询" onclick="searchByStationName();"/>
    <div id="container"></div>
</div>

<div id="results"></div>
<script type="text/javascript">
    var map = new BMap.Map("container");          // 创建地图实例
    var point = new BMap.Point(116.404, 39.915);  // 创建点坐标
    map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别

    map.enableScrollWheelZoom(true);                //可以缩小或者放大地图（通过鼠标滚轮）
    map.enableContinuousZoom();                     //启用地图惯性拖拽，默认禁用
    map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
    map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
    map.addControl(new BMap.OverviewMapControl({ isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT }));   //右下角，打开


    var localSearch = new BMap.LocalSearch(map);
    localSearch.enableAutoViewport(); //允许自动调节窗体大小

    function searchByStationName() {
        var keyword = document.getElementById("text_").value;
        localSearch.setSearchCompleteCallback(function (searchResult) {
            var poi = searchResult.getPoi(0);
            document.getElementById("result_").value = poi.point.lng + "," + poi.point.lat; //获取经度和纬度，将结果显示在文本框中
            map.centerAndZoom(poi.point, 13);
        });
        localSearch.search(keyword);
    }
</script>
</body>
</html>