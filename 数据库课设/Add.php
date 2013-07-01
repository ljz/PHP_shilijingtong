<?
header("Content-Type:text/html;charset=utf8");
//包含adodb文件
include_once("/var/www/PHP-shilijingtong/adodb5/adodb.inc.php");
//设置链接MYSQL数据的变量
$host = "localhost";
$user = "root";
$pass = "1qaz2wsx";
$db = "adodbtest";

//建立链接对象，并设置链接数据库的类型
$conn = &ADONewConnection('mysql');
//链接数据库
$conn->Connect($host,$user,$pass,$db);
//显示调试信息
//$conn->debug();
//设置字符
$conn->Execute("SET NAMES utf8");
//设置SQL语句
$sql = "select * from test1 limit 0,15";
//执行SQL语句
$result = $conn->Execute($sql);
if($result == false)
{
	echo "<pre>".$conn->ErrorMsg()."</pre>";
}else{
  $table = "<table border='1'> <tr> <th>ID</th><th>名称</th><th>分类ID</th><th>链接</th></tr>";
  while($row = $result->FetchRow())
  {
      $table .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[5]."</td></tr>";
    }
  $table .= "</table>";
  echo $table;
}
$conn->close();


?>
