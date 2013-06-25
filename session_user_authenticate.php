<?//用session实现用户认证的功能
session_start();

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
	global $users;
	$u = $_SESSION["username"];
	$p = $_SESSION["password"];
	foreach($users as $key => $value)
	{
		if($value["username"] == $u and $value["password"] == $p)
		{
			return true;
		}
	}
	return false;
}


function login()
{
	global $users ;
	$u = $_POST["username"];
	$p = $_POST["password"];
	foreach($users as $key => $value)
	{	
		if($value["username"] == $u and $value["password"] == $p)
		{
			
		//	setcookie("username",$value["username"]);
		//	setcookie("password",$value["password"]);
		//	setcookie("style",$value["style"]);
			$_SESSION["username"] = $value["username"];
			$_SESSION["password"] = $value["password"];
			$_SESSION["style"] = $value["style"];
			echo "<script> alert('登录成功！');</script>";
			echo "<script> window.location.href='session_user_authenticate.php';</script>";//利用javascript语言跳转到指定页面
			return true;
		}
	}
	echo "<script> alert('用户名或者密码错误！'); </script>";
	echo "<script>window.location.href='session_user_authenticate.php';</script>";
	return false;
}


function logout()
{
//	setcookie("username","");
//	setcookie("password","");
//	setcookie("style","");
	/*session_unregister("username");
	session_unregister("password");
	session_unregister("style");*/
	session_destroy();
	echo "<script>alert('注销成功！'); </script>";
	echo "<script>window.location.href='session_user_authenticate.php'; </script>";
}


function loginTable()
{
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
if(is_login())
{
?>
		  <div class = "css" > 你好！:<?= $_SESSION["username"];?>&nbsp;&nbsp;<a href = '?action=logout'>注销</a> </div>
		  <div class ='<?   $_SESSION["style"]?>'>用户登录后，显示的内容</div>
<? }else{
	echo "执行loginTable()";
	loginTable();
}
?>
</body>
</html>

