<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script src="js/html5media.min.js"></script>
<!--<script type="text/javascript" src="js/html5media.min.js"></script>--> 
<title>微视频电影</title>
<link type="text/css" href="css/weishipin.css" rel="stylesheet"/>
</head>

<body>
	<div id="header">
    <p style="margin-left:0px;margin-top:9px">微视频库</p>
	</div>


 

 <div id="menu">
 <form  action="search.php" method="post">
    <div id="form-search">
       <input type="text" name="searchvideo" class="input-medium search-query">
        <button type="submit-search" class="btn btn-info">搜索</button>
    </div>
  </form>
  
  <form id="videofile" action="ind.php" method="post">
 
     <!--button id="queding" name="submit" type="submit" class="btn btn-info" >确定</button-->
     <a name="back" type="button" class="btn btn-info" href="index.php">返回首页</a>
   </div>

    <div id="container">
    	  <div id="main" align="center">
<?php
  include "lib/connect.php";
  $page_num =12;//每页记录数为12
        if (!isset($_GET['page_no']))//page_no 空
          {
              $page_no = 1;
          }
        else {
            $page_no = $_GET['page_no'];
        }
          $start_num = $page_num * ($page_no - 1);//起始行号
          $sql = "SELECT * from `video` limit $start_num, $page_num";
  //$sql = "SELECT * FROM `video`";
          $result = mysql_query($sql);
          $nums = mysql_num_rows($result); 
  //$nm = mysql_num_rows($result);
  while ($result_row = mysql_fetch_assoc($result)) {
//print_r($result_row);
    echo <<<VIDEO
        <div class="video">
          <video width="352" height="264" controls="controls" poster="../chinavec/data-storage/video/poster/h/{$result_row['id']}.jpg" preload="none" loop="loop">
            <source src="video/{$result_row['id']}.mp4" type="video/mp4" />
            <source src="video/{$result_row['id']}.mov" type="video/mov" />
		<object id="fp_23397117_api" width="100%" height="100%" type="application/x-shockwave-flash" data="js/flowplayer.commercial-3.2.6-dev.swf">
		<param value="true" name="allowfullscreen">
		<param value="always" name="allowscriptaccess">
		<param value="high" name="quality">
		<param value="false" name="cachebusting">
		<param value="#000000" name="bgcolor">
		<param name="flashvars" value='config={"clip":{"url":"http://222.31.64.201/chvec_auth/video/{$result_row['id']}.mp4","autoPlay":false,"autoBuffering":true}}' />
		</object>
          </video>
          <input style="margin-left:16px;margin-top:0px" type="radio" name="svideo" value="{$result_row['id']}" />{$result_row['title_cn']}
          <button id="queding" name="submit" type="submit" class="btn btn-info" >申请授权</button>
        </div>
VIDEO;
        }
      ?>

        </div>
  </div>

	<div id="menu1">
	   <!--button id="queding" name="submit" type="submit" class="btn btn-info" >确定</button-->
	   <a name="back" type="button" class="btn btn-info" href="index.php">返回首页</a>
	</div>
</form> 

<div id="footer">
  <span id="jilu1">显示<?php echo $nums; ?>条记录</span>
    <span id="jilu2">
        <?php
		$sql1 = "SELECT * from `video`";
		$result1 = mysql_query($sql1);
		$numss = mysql_num_rows($result1);
		$page = ceil($numss/$page_num);
            if ($page_no > 1) {
                    echo "<a href ='play.php?page_no=".($page_no-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
                }else{
                    echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
                }
                echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
                if ($nums == $page_num) {
                    echo "&nbsp;&nbsp;&nbsp;<a href ='play.php?page_no=".($page_no+1)."'>下一页</a>";
                }else{
                    echo '&nbsp;&nbsp;&nbsp;<span>下一页</span>';
                }
        ?>
    </span>          
</div>


<script type="text/javascript">
$(function() {
  $("#videofile").submit(function() {
   if($('input:radio[name="svideo"]:checked').val()==null)
   {
    alert("请选择视频！");
    return false;
   }
  });
})
</script>

</body>
</html>
