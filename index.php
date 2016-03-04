<?php
phpinfo();exit;
?>

<html>
<head>

</head>
<body>

    <script type="text/javascript">
        var name = "The Window";
        var object = {
                name : 'MyObject',
                getNameFunc:function(){
                    return function(){
                        return this.name;
                    }
                }
        };
        alert(object.getNameFunc());
    </script>

</body>
</html>





