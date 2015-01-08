<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
 
<title>授权微视频库</title>
<link type="text/css" href="css/weishipin.css" rel="stylesheet"/>
</head>

<body>
	<div id="header">
    <p style="margin-left:0px;margin-top:9px">授权微视频库</p>
	</div>
<table class="table table-bordered" style="width:1000px;margin:auto">
<thead style="border:solid 1px #bfcfda;background:-webkit-gradient(linear, left top, left bottom, from(#f4f5f8), to(#dce3eb));">
  <tr style="border-right:solid 1px #bfcfda;color:#000;">
    <th style="width:60px">ID</th> 
    <th style="width:60px">授权类型</th> 
    <th style="width:120px">授权码</th> 
    <th>有效期</th>
    <th>中文片名</th>
    <th>授权目的</th>
    <th></th>  
  </tr> 
</thead>
    <?php
      require_once("lib/connect.php");
      $page_num =15;//每页记录数为12
      if (!isset($_GET['page_no']))//page_no 空
      {
          $page_no = 1;
      }
      else {
          $page_no = $_GET['page_no'];
      }
      $start_num = $page_num * ($page_no - 1);//起始行号
      $sql = "SELECT * FROM  `authen` LIMIT $start_num , $page_num";
//$sql = "SELECT * FROM `video`";
      $result = mysql_query($sql);
      $nums = mysql_num_rows($result); 
      //$nm = mysql_num_rows($result);
      while ($result_row = mysql_fetch_assoc($result)) {
        echo <<<TR
  <tr style="border-right:solid 1px #bfcfda;color:#000;">
    <td>{$result_row['id']}</td> 
    <td>{$result_row['type']}</td> 
    <td>{$result_row['code']}</td> 
    <td>{$result_row['valid_dt']}</td>
    <td>{$result_row['title_cn']}</td>
    <td>{$result_row['purpose']}</td>
    <td><a href="jm.php?code={$result_row['code']}">查看密码</a></td> 
  </tr> 
TR;
      }
    ?>

</table>

<div id="footer">
  <span id="jilu1">显示<?php echo $nums; ?>条记录</span>
    <span id="jilu2">
        <?php
		$sql1 = "SELECT * from `authen`";
		$result1 = mysql_query($sql1);
		$numss = mysql_num_rows($result1);
		$page = ceil($numss/$page_num);
            if ($page_no > 1) {
                    echo "<a href ='list.php?page_no=".($page_no-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
                }else{
                    echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
                }
                echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
                if ($nums == $page_num) {
                    echo "&nbsp;&nbsp;&nbsp;<a href ='list.php?page_no=".($page_no+1)."'>下一页</a>";
                }else{
                    echo '&nbsp;&nbsp;&nbsp;<span>下一页</span>';
                }
        include "lib/footer.php";
        ?>
    </span>          
</div>

</body>
</html>
