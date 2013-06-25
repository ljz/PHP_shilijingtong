<?//用cookie实现用户认证的功能
$users = array(
	array("username"=>"tom","password"=>"1","style"=>"css1"),
	array("username"=>"jake","password"=>"2","style"=>"css2"),
	array("username"=>"seven","password"=>"3","style"=>"css3"),
	array("username"=>"andy","password"=>"4","style"=>"css4"),
	array("username"=>"king","password"=>"5","style"=>"css5"),
	array("username"=>"robert","password"=>"6","style"=>"css6")
);


function is_login()
{
	echo "3";
	global $users;
	$u = $_COOKIE["username"];	
	$p = $_COOKIE["password"];
	foreach($users as $key => $value)
	{
	//	echo $_COOKIE["username"]."and".$_COOKIE["password"]."and". $value["username"]."and".$value["password"];
		if($value["username"] == $u and $value["password"] == $p)
		{
			echo "is_login";
			return true;
		}
	}
	echo "isnot_login";
	return false;
}


function login()
{
	echo "7";
	global $users ;
	$u = $_POST["username"];
	$p = $_POST["password"];
	foreach($users as $key => $value)
	{	
		if($value["username"] == $u and $value["password"] == $p)
		{
			setcookie("username",$value["username"]);
			setcookie("password",$value["password"]);
			setcookie("style",$value["style"]);
			echo "<script> alert('登录成功！');</script>";
			echo "<script>window.location.href = 'cookie_user_authenticate.php';</script>";//利用javascript语言跳转到指定页面,注意浏览器兼容问题
				return true;
		}
	}	
	echo "<script> alert('用户名或者密码错误！'); </script>";
	echo "<script>window.location.href='cookie_user_authenticate.php';</script>";
	return false;
}

function logout()
{
	setcookie("username","");
	setcookie("password","");
	setcookie("style","");
    echo "<script>alert('注销成功！'); </script>";
	echo "<script> window.location.href='cookie_user_authenticate.php';</script>";
}

function loginTable()
{
	echo "6";
	//EOT :定界符相当于双引号
	print<<<EOT
<table  width = "300" border ="0" cellspacing = "0" cellpadding = "0" >
<tr>
<td> 
<form name = "forml" method = "post" action = "?action=login" >
<table width = "100%" border = "0" cellspacing = "0" cellpadding = "0">
<tr>
<td> 用户名：</td>
<td> 
<label> 
<input name = "username" type = "text" id = "username">
</label>
</td>
</tr>

<tr>
<td>密码:</td>
<td>
<label>
<input name = "password" type = "password" id = "password">
</label>
</td>
</tr>

<tr>
<td colspan = "2" >
<label>
<input type = "submit" name = "submit" value = "submit">
</label>
</td>
</tr>

</table>

</form>
</tr>
	</table>
EOT;
}
echo "1";
switch($_GET["action"])
{
case "login":
	login();
	break;
case "logout":
	logout();
	break;
}
?>

<html>
<head>
<meta http-equiv = "Content-Type" content = "text/html ;charset = utf8">
<title> 用户登录</title>
</head>
<body>
<?
echo "2";
if(is_login())
{
?>
		  <div class = "css" > 你好！:<?$_COOKIE["username"];?>&nbsp;&nbsp;<a href = '?action=logout'>注销</a> </div>
		  <div class ='<?   $_COOKIE["style"]?>'>用户登录后，显示的内容</div>
<? }else{
	echo "5";
	echo "执行loginTable()";
	loginTable();
}
?>
</body>
</html>
