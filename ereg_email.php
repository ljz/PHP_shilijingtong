<?
function checkMail($mail )
{
	echo "2";
	if(ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+",$mail) )
	{
		echo "<b>检查的邮件地址是合法的</b>";
		return true;
	}
	else
	{
		echo "<b><font color=red>检查的邮件地址是不合法的</font></b>";
		return false;
	}
}

?>
<html>
	<head>
	<meta http-equiv="Content-Type" content = "text/html ;charset=utf8"/>
	<title>使用正则表达式检验邮件地址 </title>
	</head>

	<body>
<?
if(isset($_POST["email"]) and $_POST["email"] != "")
{
	echo "1";
	checkMail($_POST["email"]);

}
?>
<form id ="form" name = "form" method = "post" action="">
<label>请输入邮件地址 
<input name="email" type="text" id="email"/>
</label>
<label>
<input type = submit name = submit vuale = submit/>
</label>
</form>
	</body>

	</html>

