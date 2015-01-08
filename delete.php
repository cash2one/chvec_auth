<html>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<input type="hidden" name="time" value="<?php echo date('Y-m-d');?>"/> </td>

</html>
<?php
include "./lib/connect.php";
$now=date('Y-m-d');
//echo $now;
//exit;
$file="";
$file1="";
$sql="SELECT * FROM `authen` WHERE `valid_dt`<'$now'";
$query=mysql_query($sql);
if($query){
	echo "<div id='delete' style='margin:150px auto;font-size:20px;' align='center';><img src='img/loading.gif' width='20' style='margin-right:5px;' />正在删除过期视频，请稍候....</div>";
	echo $_POST['out'];

	while($result=mysql_fetch_array($query)){
	//$result=mysql_fetch_array($query);
	//print_r($result['code']);
	$code="./video_auth/".$result['code'];

	$file.="$code.mpg";
	$file1.= "$code.avi";
	
	//echo $file."<br />";
	//echo"</br>";
	//echo $file;
	//if(file_exists($file)){
	//echo "you";
	//}
	//else{
	//echo "meiyou";
	//}
	}
	
	$arr_file=explode("./video_auth/",$file);
	$arr_file1=explode("./video_auth/",$file1);
	
	$array_file=array();
	$array_file1=array();

	foreach($arr_file as $key=>$value){
		$array_file[$key]="./video_auth/".$value;
		//echo $array_file[$key];
	};
	foreach($arr_file1 as $key=>$value){
		$array_file1[$key]="./video_auth/".$value;
		//echo $array_file1[$key];
	};




	$count_file=count($array_file);
	$count_file1=count($array_file1);
	//echo $count;exit;
	//print_r($array_file);
	//exit;
	for($i=1;$i<=$count_file;$i++){
		
		if(isset($array_file[$i])){
			//echo $array_file[$i];
			
			if(file_exists($array_file[$i])) {
				
				unlink($array_file[$i]);
			}
		}
	};
	
	for($i=1;$i<=$count_file1;$i++){
		if(isset($array_file1[$i])){
			//echo $array_file1[$i];
			if(file_exists($array_file1[$i])) {
				unlink($array_file1[$i]);
			}
		}
	};
	
	echo "<script>setTimeout(\"$('#delete').html('过期视频已删除')\",6000)</script>";
}else{
	$_POST['out']="过期视频已删除";
	echo $_POST['out'];
}
//exit;

//print_r($arr);
//exit;
/*
if(file_exists($file)||file_exists($file1)){
	$_POST['out']="<div id='delete' style='margin:100px auto;font-size:40px;'><img src='img/loading.gif' width='30' style='margin-right:5px;' />正在删除....</div>";
	echo $_POST['out'];
	
	///echo "<div id='delete'><img src='img/loading.gif' width='12' style='margin-right:5px;' />正在删除....</div>";  //文件存在
	if(file_exists($file)) {
			unlink($file);
			};
	if(file_exists($file1)){
			unlink($file1);
			};
	//sleep(5);
	//echo "<script>document.getElementById('delete').value='完成'</script>";
	echo "<script>setTimeout(\"$('#delete').html('完成')\",8000)</script>";
	//echo "<script>setTimeout('document.write('完成');', 5000);</script>";
}else{
	$_POST['out']="过期视频已删除";
	echo $_POST['out'];
//echo "过期视频已删除";
}
*/
/*if (!(unlink($file)&&unlink($file1)))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }
//print_r($result['id']);
//echo "</br>";
//}*/
//exit;

?>
