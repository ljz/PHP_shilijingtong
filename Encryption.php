<?
$code = "this is a test";
echo "没有经过加密的字符串为:".$code."<br>";
$encode = convert_uuencode($code);
echo "经过convert_uuencode()加密的字符串为:".$encode." <br>";//该处的换行符号怎么不能实现？？
$decode = convert_uudecode($encode);
echo "经过convert_uudecode()解密的字符串为：".$decode."<br>";

$hadmd5 = "54b0c58c7ce9f2a8b551351102ee0938";
$md5code = md5($code);
if($hadmd5 == $md5code)
{
	echo "字符串中的md5值相等，继续演示代码"."<br>";
}else
{
	echo "字符串中的md5值不相等，结束演示代码"."<br>";
	exit();
}

$md5file = md5(Encryption.php);
echo "当前文件的md5值是:".$md5file."<br>";

//自定义加密函数
function encode($str)
{
	$encode = "";
	$key =12;
	//依次转换ascii码，与密钥相加后，再转化为字符
	for($i = 0;$i < strlen($str) ;$i++)
	{
	  $encode .= chr(ord($str[$i]+$key));
	}
	return convert_uuencode($encode);
}

//自定义解密函数
function decode($str)
{
  $decode = "";
  $key = 12;
  $destr = convert_uudecode($str);
  for($i = 0;$i < strlen($str);$i ++)
  {
    $decode .= chr(ord($str[$i]-$key));
  }
  return $decode;
}
$userEncode = encode($decode);
echo "使用自定义函数encode()加密的字符串:".$userEncode."<br>";
$userDecode = decode($userEncode);
echo "使用自定义函数 decode()解密的字符串:".$userDecode;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<!--metal charset=utf8-->
</head>
</html>

