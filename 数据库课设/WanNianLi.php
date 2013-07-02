

<!------------------------------------------------------------------------------------------------------------------ 数据库操作-->
<?
header("Content-Type:text/html;charset=utf8");
//包含adodb文件
include_once("/var/www/PHP-shilijingtong/adodb5/adodb.inc.php");
//设置链接MYSQL数据的变量
$host = "localhost";
$user = "root";
$pass = "1qaz2wsx";
$db = "WanNianLi";

//建立链接对象，并设置链接数据库的类型
$conn = &ADONewConnection('mysql');
//链接数据库
$conn->Connect($host,$user,$pass,$db);
//显示调试信息
//$conn->debug();
//设置字符
$conn->Execute("SET NAMES utf8");

function AddHtml(){

	echo "add调用成功";

	$host = "localhost";
	$user = "root";
	$pass = "1qaz2wsx";
	$db = "WanNianLi";

	//建立链接对象，并设置链接数据库的类型
	$conn = &ADONewConnection('mysql');
	//链接数据库
	$conn->Connect($host,$user,$pass,$db);
	//显示调试信息
	//$conn->debug();
	//设置字符
	$conn->Execute("SET NAMES utf8");

	$sql = " INSERT INTO  `WanNianLi`.`event` (
		`ID` ,
		`time` ,
		`event` ,
		`address` ,
		`grade` ,
		`remark`
	)
	VALUES (
		NULL ,  '".$_POST["time"]."',  '".$_POST["event"]."',  '".$_POST["address"]."',  '".$_POST["grade"]."',  '".$_POST["remark"]."'
	);";
	$insert_result =	$conn -> Execute($sql);
	if($insert_result) //如果执行成功，则输出执行成功的信息 
	{ 
		echo "添加事件执行成功"; 
	} 
	else //如果执行失败，则输出错误信息 
	{ 
		echo $conn->ErrorMsg(); 
	} 
	$conn->close();
}



function DeleteHtml()
{
	$host = "localhost";
	$user = "root";
	$pass = "1qaz2wsx";
	$db = "WanNianLi";

	//建立链接对象，并设置链接数据库的类型
	$conn = &ADONewConnection('mysql');
	//链接数据库
	$conn->Connect($host,$user,$pass,$db);
	//显示调试信息
	//$conn->debug();
	//设置字符
	$conn->Execute("SET NAMES utf8");

	$sql = "	DELETE FROM event WHERE event =".$_POST['event']."";
	$insert_result =	$conn -> Execute($sql);
	if($insert_result) //如果执行成功，则输出执行成功的信息 
	{ 
		echo "删除事件执行成功"; 
	} 
	else //如果执行失败，则输出错误信息 
	{ 
		echo $conn->ErrorMsg(); 
	} 
	$conn->close();

}

function SelectHtml()
{


	//设置链接MYSQL数据的变量
	$host = "localhost";
	$user = "root";
	$pass = "1qaz2wsx";
	$db = "WanNianLi";

	//建立链接对象，并设置链接数据库的类型
	$conn = &ADONewConnection('mysql');
	//链接数据库
	$conn->Connect($host,$user,$pass,$db);
	//显示调试信息
	//$conn->debug();
	//设置字符
	$conn->Execute("SET NAMES utf8");
	//设置SQL语句
	$sql = "select * from event WHERE event = ".$_POST["event"]." limit 0,15";
	//执行SQL语句
	$result = $conn->Execute($sql);
	if($result == false)
	{
		echo "<pre>".$conn->ErrorMsg()."</pre>";
	}else{
	  $table = "<table border='1'> <tr> <th>ID</th><th>名称</th><th>time</th><th>address</th><th>grade</th><th>remark </th></tr>";
	  while($row = $result->FetchRow())
	  {
	      $table .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
	    }
	  $table .= "</table>";
	  echo $table;
	}
	$conn->close();



}

//设置SQL语句
if(isset($_POST["submit"]))
{   	
	if($_POST["submit"] == "添加事件")
	{
		print <<<EOT
<table width = "300" border = "0" cellspacing = "0" cellpadding = "0">
<tr> 
<td>
 <form name = "formadd" method = "post" action="?action=add">
<tr>
<td>时间：</td>
<td>
<label>
<input name= "time" type ="text"  id = "time">
</label>
</td>
</tr>
<tr>
<td> 事件：</td>
<td>
<label>
<input name = "event" Type = "text" id="event">
</label>
</td>
</tr>
<tr>
<td>地址：</td>
<td>
<label>
<input name = "address" Type ="text" id="address">
</label>
 </td>
</tr>
<tr>
<td> 等级</td>
<td>
<label>
<input name = "grade" Type ="text" id = "grade">
</label>
</td>
</tr>
<tr>
<td>备注： </td>
<td>
<label>
<input name = "remark" type = "text" id = "remark">
</label>
</td>
</tr>
<tr>
<td>
<label>
<input type = "submit" name = "submit" value= "提交">
</label>
</td>
</tr>
</form>
</tr>
</table>
EOT;
	}
	elseif($_POST["submit"]=="删除事件")
	{
		print <<<EOT

<table width = "300" border = "0" cellspacing = "0" cellpadding = "0">
<tr> 
<td>
 <form name = "formadd" method = "post" action="?action=delete">
<tr>
<td> 事件：</td>
<td>
<label>
<input name = "event" Type = "text" id="event">
</label>
</td>
</tr>
<tr>
<label>
<input type = "submit" name = "submit" >
</label>
</tr>
</form>
</tr>
</table>
EOT;

	}
	elseif($_POST["submit"]=="查找事件")
	{
	print <<<EOT
<table width = "300" border = "0" cellspacing = "0" cellpadding = "0">
<tr> 
<td>
 <form name = "formadd" method = "post" action="?action=select">
<tr>
<td> 事件：</td>
<td>
<label>
<input name = "event" Type = "text" id="event">
</label>
</td>
</tr>
<tr>
<td>
<label>
<input type = "submit" name = "submit" value= "提交">
</label>
</td>
</tr>
</form>
</tr>
</table>
EOT;

	}

}
switch($_GET["action"])
{
case "add":
	AddHtml();
	break;
case "delete":
	DeleteHtml();
	break;
case "select":
	SelectHtml();
	break;
}

  /*  elseif($_POST["submit"] == "删除事件")
	{
		$sql ="	DELETE FROM `WanNianLi`.`event` WHERE `event`.`ID` = 1";
		$delete_result =$conn -> Execute($sql);
		if($delete_result) //如果执行成功，则输出执行成功的信息 
		{ 
			echo "删除事件成功"; 
		} 
		else //如果执行失败，则输出错误信息 
		{
			echo $conn->ErrorMsg(); 
		} 

   */

/*	elseif($_POST["submit"] == "查找事件")
	{
		$sql = "SELECT * 
			FROM  `event`  
		LIMIT 0 , 30	";
		$result = $conn->Execute($sql);
		if($result == false)
		{
			echo "<pre>".$conn->ErrorMsg()."</pre>";
		}else{
			$table = "<table border='1'> <tr> <th>ID</th><th>时间</th><th>事件</th><th>地址</th><th>等级</th><th >备注 </th> </tr>";
			while($row = $result->FetchRow())
		{
				$table .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td> <td>".$row[4]." </td><td>".$row[5]."</td></tr>";
			}
			$table .= "</table>";
			echo $table;
		}

	}
//	else{}
}

function AddHtml()
{/*
	echo "123";
	print <<<EOT

<table width = "300" border = "0" cellspacing = "0" cellpadding = "0">
<tr> 
<td>
 <form name = "formadd" method = "post" action="">
<tr>
<td>时间：</td>
<td>
<label>
<input name= "time" type =""  id = "time">
</label>
</td>
</tr>
<tr>
<td> 事件：</td>
<td>
<label>
<input name = "event" Type = "text" id="event">
</label>
</td>
</tr>
<tr>
<td>地址：</td>
<td>
<label>
<input name = "address" Type ="text" id="address">
</label>
 </td>
</tr>
<tr>
<td> 等级</td>
<td>
<label>
<input name = "grade" Type ="text" id = "grade">
</label>
</td>
</tr>
</form>
</tr>
</table>
EOT;
 */
/*	$sql = " INSERT INTO  `WanNianLi`.`event` (
		`ID` ,
		`time` ,
		`event` ,
		`address` ,
		`grade` ,
		`remark`
	)
	VALUES (
		NULL ,  '2013-07-19 00:00:00',  '游泳',  '哈工大（威海）',  'I',  '洗澡还是游泳？？'
	);";
	$insert_result =	$conn -> Execute($sql);
	if($insert_result) //如果执行成功，则输出执行成功的信息 
	{ 
		echo "添加事件执行成功"; 
	} 
	else //如果执行失败，则输出错误信息 
	{ 
		echo $conn->ErrorMsg(); 
	} 
}*/

//执行SQL语句

/*$result = $conn->Execute($sql);
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
$conn->close();*/
?>
<!------------------------------------------------------------------------------------------------------------>



<html>
<head>
<title>万年历</title>
<meta http-equiv="Content-Type" Content = "text/html;charset = utf8">

<style Type=text/css>
table{
background-color:#B0C4DE;
}
tr{
  background-color:white;
}
td{
  font-size:20pt;
font-family:宋体;
color:#708090;
line-height:140%;
}
</style>

</head>

<body>


<?
if(isset($_POST["year"])) //如果我们要查看的话就要输入year 和month 这样就传过来
{
	$year =$_POST["year"];
}
else
{
	$year = date("Y");
}

if(isset($_POST["month"]))
{
	$month = $_POST["month"];
}
else
{
	$month = date("m");
}
$date= 01;//初始化月数据 ，这里是指一个月的天数一共有多少天，比如说每个月有大小，29，30，31，后面根据一个函数就给他++到这些数了。
$day = 01;//初始化日数据
$off = 0;

//异常判断
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($year <0 or $year > 9999)//
{
	echo "<script> alert('年份应该在1至9999之间');history.go(-1); </script>";
	exit();
}


if($month<0 or $month >12)
{
	echo "<script> alert('月份应该在1至12之间');history.go(-1);</script>";
	exit();
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
while( checkdate($month,$date,$year))//该函数检查日期的合法性，也就是指定的year，month ，对date++,查看是否合法，直到不合法，date 就是最大的那个天数
{
	$date++;
}
?>

<!-- 表的生成 -->
<form method =post action ="" name =calendar action="ADODB.php" method="post">
<table width = 100% border = 1 cellspacing = 0 cellpadding = 3 bordercolorlight=#333333 bordercolordark=$FFFFFF bgcolor = #CCCCFF>
<!--这个tr是最上面输入的一排-->
<tr align = center valign = middle>
<td colspan=7 bgcolor =$efefef >   
<input Type = "submit" name = "submit" value = "添加事件">
<input Type ="submit" name = "submit"   value ="删除事件"  >
<input Type = "submit" name="submit"  value = "查找事件"  >
<input Type = "submit" name="submit"   value = "下个月"  >
<input Type = "submit" name = "submit" value ="上个月"  >
<input Type ='text' name = 'year' size = '4' maxlength = '4' value =<?= $year ?>>
<input Type = 'text' name = 'month' size = '2' maxlength = '2' value = <?= $month?>>
<input Type = 'submit' name = 'submit' align = absmiddle border = 0 value = '跳转'>
</td>
</tr>
<!--这个tr表示星期几的那一行 -->
<tr align = center valign = middle >
 <td bgcolor = #EFEFEF>日</td>
<td bgcolor = red >一</td>
<td bgcolor =yellow >二</td>
<td bgcolor = #00ff00>三</td>
<td bgcolor =rgb(255,0,255)> 四</td>
<td bgcolor = #00FFFF >五</td>
<td bgcolor = #efefef >六</td>
</tr>
<!--这个是用while循环每次显示下面的一行数字 -->
<tr>
<?
//构建万年历内容
while( $day<$date)
{
	if( $day == date("d")&& $year == date("Y") && $month == date("m"))//如果$day是今天，字体为红色否则为黑色
	{
		$day_color = "red";
	}
	else
	{
		$day_color = "black";
	}

	//判断第一天是周几
	if($day == '01' and date('l',mktime(0,0,0,$month,$day,$year)) == 'Sunday')
	{
		echo "<td><font color = $day_color>$day</font></td>";
		$off = '01';
	}
	else if(  $day == '01' and date('l',mktime(0,0,0,$month,$day,$year)) == 'Monday'  )
	{
		echo "<td>&nbsp</td><td> <font color = $day_color>$day</font></td>";
		$off = '02';
	}
	else if ( $day == '01' and date('l',mktime(0,0,0,$month,$day,$year))  == 'Tuesday')
	{
		echo "<td>&nbsp</td><td> &nbsp</td> <td><font color = $day_color>$day</font></td> ";
		$off = '03';
	}
	else if ($day == '01' and date('l',mktime(0,0,0,$month,$day,$year)) =='Wednesday')
	{
		echo "<td>&nbsp</td><td> &nbsp</td> <td> &nbsp</td> <td><font color = $day_color>$day</font></td>";
		$off = '04';
	}
	else if($day =='01'  and date('l',mktime(0,0,0,$month,$day,$year)) == 'Thursday')
	{
		echo "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td> <td>&nbsp</td><td> <font color = $day_color>$day</font></td>";
		$off = '05';
	}
	else if($day =='01'  and date('l',mktime(0,0,0,$month,$day,$year)) == 'Friday')
	{
		echo "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td> <td>&nbsp</td><td> &nbsp</td><td> <font color = $day_color>$day</font></td>";
		$off = '06';
	}
	else if($day =='01'  and date('l',mktime(0,0,0,$month,$day,$year)) == 'Saturday')
	{
		echo "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td> <td>&nbsp</td> <td>&nbsp</td><td>&nbsp</td> <td><font color = $day_color>$day</font></td>";
		$off = '07';
	}
	else
	{
		echo "<td> <font color = $day_color>$day</font></td> \n";
	}
	$day++;//
	$off++;
	if($off > 7) //chong qi yi hang 
	{
		echo "</tr><tr>";
		$off ='01';
	}
	else
	{
		echo "";
	}
} 

//  jisuanshengxiadeshuju yong kong ge tian   k kj
for( $i =$off;$i<=7;$i++)
{
	echo "<td>&nbsp</td>"; 
}
?>
</tr>
</table>
</form>
</body>
</html>

