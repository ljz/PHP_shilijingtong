<?
$sid = $_GET["sid"];//得到传过来的id
$fp = fopen("./data/sid.txt","r");//打开文件
$sid = fread($fp,8192);//读取id值
//echo $sid;//输出id值
fclose($fp);
session_start($sid);//定义这个id的session
echo $_SESSION["svalue"];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<!--metal charset=utf8-->
</head>
</html>

