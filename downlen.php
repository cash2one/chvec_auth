<!DOCTYPE html>  
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>jquery-ui-进度条效果</title>
<!--引入jquery类库文件-->  
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<!--css--> 
<link type="text/css" rel="stylesheet" href="./css/redmond/jquery-ui-1.10.3.custom.css" />

<style>  
  #progressbar .ui-progressbar-value {
    background-color: #ccc;
  }
  </style>  
</head> 
<body>
        <h2>实现</h2>   
        <div id="progressbar" style="height:20px;width:200px"></div>

<script type="text/javascript">  
    function setDownloaded (downlen,filesize) {
        if(filesize>0) {
            var x=parseInt(200*downlen/filesize);
            $("#progressbar").progressbar({  
                    value:x
            }); 
        }
 }
</script>  
<?php
    ob_start();
    @set_time_limit(0);//设置该页面最久执行时间为300秒
    $url="/var/www/ui_auth/videoauth/C1309F00006.mpg";//要下载的文件
    $newfname="1.mpg";//本地存放位置，也可以是E:\Temp\QQ2010Beta3.exe，这样做在Win7下要设置相应权限
    $file = fopen ($url, "rb");
       
    $filesize=filesize($url);

    //不是所有的文件都会先返回大小的，有些动态页面不先返回总大小，这样就无法计算进度了
    if ($filesize != -1) {
        //在前台显示文件大小
    }
    $newf = fopen ($newfname, "wb");
    $downlen=0;
    if ($newf) {
        while(!feof($file)) {
            $data=fread($file, 1024 * 8 );//默认获取8K
            $downlen+=strlen($data);//累计已经下载的字节数
            fwrite($newf, $data, 1024 * 8 );
            echo "<script>setDownloaded($downlen,$filesize);</script>";//在前台显示已经下载文件大小
            ob_flush();
            flush();
        }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
    }
?> 


</body>
</html>