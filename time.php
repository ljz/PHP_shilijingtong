<?
$nextweek = time() + (7*24*60*60);
echo "当前时间是：".date('Y-m-d')."<br>";
echo "下周日期:".date('Y-m-d',$nextweek)."<br>";

$time1 = mktime(0,0,0,2,2,1995);
$time2 = mktime();

$oldtime = date("Y-m-d H:i:s",$time1);
$nowtime = date("Y-m-d H;i;s",$time2);

echo "出生日期:".$oldtime."<br>"."当前时间是：".$nowtime."<br>";
echo "年龄是:";
echo $nowtime - $oldtime;
?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<!--metal charset=utf8-->
</head>
</html>

