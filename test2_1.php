<?
$varint = 1;
$varinteger = "test";
$varstring = "tes";
$varbool = true;
$varfloat = 4.3;
$vardelete = "safj";

$vararray = array(
		"1"=>"23",
		"2"=>"234jj"
		);

$vararray["3"] = "q3j";

$vardarray = array(
		"1"=>array(
			"1"=>"wer",
			"2"=>"34j";
			),
		"2"=>array(
			"1"=>"4353",
			"2"=>"34"
			)
		);
foreach($vararry as $a)
{
  echo $a."<br>";
}
$a  = "he is ";//a的内容是he is
$b = $$a;
$$a = "xiaomingg";//“$he is”的内容是xiaomingg
echo $a.${$a}."<br>";
echo gettype($varinteger)."<br>";
echo gettype($vararray)."<br>";
echo gettype($vardarray)."<br>";
echo gettype($$show)."<br>";

echo gettype($a);
settype($varinterger,"float");
$vardelete = (int)$vardelete;

class test
{
	$var = "12";
	function test()
	{
		$var $_title = "this is a big test";
		echo $this->_title;
}
}

$newTest = new test();//注意，这里不要忘记了new的时候的()

$fp = fopen("test.txt","w");//这是取得一个资源类型的变量
$varNull = Null;
unset($varNull);
unset($vararray["3"]);//删除元素某一个元素//4,删除元素的函数unset();还有删除数组某一个元素的用法；
echo gettype($fp);
echo gettype();
?>


标题：变量的定义和删除

//总结：上面有几个需要注意的地方
//1,定义数组的时候array()里面的元素值和索引都要用“”括起来，而且元素之间是用‘，’>分开，最后一个没有符号，定义完了要用‘；’。
//2,在数组最后加一个元素是直接在名字["shuzi"]="";shuzi代表的是新加的元素的索引。
//3,定义类之后实例化的时候要用new 名字（），别忘记这个括号。。。。
//4,删除元素的函数unset();还有删除数组某一个元素的用法；



<?
echo $_SERVER["PHP_SELF"];
echo $_SERVER["GATEWAY_INTERFACE"];
ECHO $_SERVER["SERVER_ADDR"];
echo $_SERVER["SERVER_NAME"];
echo $_SERVER["SERVER_SOFTEWARE"];
echo $_SERVER["SERVER_PROTOCOL"];
echo $_SERVER["REQUEST_METHOD"];
echo $_SERVER["REQUEST_TIME"].$_SERVER["QUERY_STRING"].$_SERVER["DOCUMENT_ROOT"].$_SERVER["HTTP_ACCEPT"];


ECHO $_ENV[""];
while(list($k,$v) = each($_ENV))
{
echo  $K ."=>".$V."<br>";
}
?>


<?
setcookie("c1");
setcookie("c2","this is a cookie",time()+3000,"/html/",".hitwh.edu.cn",0,1);
$_COOKIE["test_cookie"]="this is a array add cookie";
setcookie($test_cookie,NULL);
$_COOKIE["test_cookie"] = NULL;
unset($_COOKIE["test_cookie"]);
foreach($_COOKIE as $key=>$valye)
{
echo "$key=>$value<br>";
}
?>

<form id = "testid" name = "testname" method="POST" action="www.baidu.com">
<label> 姓名
<input name="name" type="text" id="name"/>
</label>
<input type="submit" name = "submit" value="提交"/>
</form>
<?
if(isset($_POST["name"]))
echo $_REQUEST["name"]."<br>";
?>
<?
$session_start();
session_register("school");
echo "$_SESSION["school"]".<br>;

echo $GLOBALS["ENV"]["OS"];
echo $GLOBALS["_SESSION"]["school"];
echo "<preg>";
print_r($GLOBALS);
echo "</preg>";



define("_INTERGER",12);
//错误控制符
@include("inc.php");
$fp =@fopen("user.html","w");
$num = @test();
//执行运算符
$output = 'dir';//运行dos命令dir，并且返回结果给$output
class boy{};
$Boy = new boy();
if($Boy instanceof boy)
{
……………………；
}





?>





























