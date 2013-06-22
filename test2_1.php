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

class test
{
	$var = "12";
	function test()
	{
		$var $_title = "this is a big test";
		echo $this->_title;
	}
}
//总结：上面有几个需要注意的地方
//1,定义数组的时候array()里面的元素值和索引都要用“”括起来，而且元素之间是用‘，’分开，最后一个没有符号，定义完了要用‘；’。
//2,在数组最后加一个元素是直接在名字["shuzi"]="";shuzi代表的是新加的元素的索引。
//3,定义类之后实例化的时候要用new 名字（），别忘记这个括号。。。。
//4,删除元素的函数unset();还有删除数组某一个元素的用法；





$newTest = new test();//注意，这里不要忘记了new的时候的()

$fp = fopen("test.txt","w");//这是取得一个资源类型的变量
$varNull = Null;
unset($varNull);
unset($vararray["3"]);//删除元素某一个元素//4,删除元素的函数unset();还有删除数组某一个元素的用法；

?>
