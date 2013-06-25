<?
session_start();//开启会话
$value="session数据";
$_SESSION["svalue"]=$value;//添加一个session变量
$sid = session_id();//获取session的id
echo "<a href='session_translate2.php?sid=".$sid."'>转到下一页</a> ";//将id传到下一页
$fp = fopen("./data/sid.txt","w");
fwrite($fp,$sid);//将id写入文件
fclose($fp);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<!--metal charset=utf8-->
</head>
</html>




