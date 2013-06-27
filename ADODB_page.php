<?
header("Content-Type:text/html;charset=utf8");
include_once('adodb5/adodb.inc.php');//包含adodb文件
include_once('adodb5/adodb-pager.inc.php');//包含分页功能文件

session_start();
$host = "localhost";
$user = "root";
$pass = "1qaz2wsx";
$db = "adodbtest";
$conn = &ADONewConnection('mysql');
$conn->Connect($host,$user,$pass,$db);
$conn ->Execute("SET NAMES utf8");

$sql = "select * from test1";
$pager = new ADODB_Pager($conn,$sql);

//初始化
$pager->first = "第一页";
$pager->prev = "上一页";
$pager->next = "下一页";
$pager ->last = "最后一页";

$pager -> gridAttributes = 'border ="1"   cellpadding = "3" cellspacing = "0"';
$pager ->Render($row_per_page = 10);







?>
