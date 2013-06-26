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
<form method =post action ="" name =calendar>
<table width = 100% border = 1 cellspacing = 0 cellpadding = 3 bordercolorlight=#333333 bordercolordark=$FFFFFF bgcolor = #CCCCFF>
<!--这个tr是最上面输入的一排-->
<tr align = center valign = middle>
<td colspan = 7 bgcolor = $efefef>
<input Type ='text' name = 'year' size = '4' maxlength = '4' value =<?= $year ?>>
<input Type = 'text' name = 'month' size = '2' maxlength = '2' value = <?= $month?>>
<input Type = 'submit' name = 'submit' align = absmiddle border = 0 value = '跳转' >
</td>
</tr>
<!--这个tr表示星期几的那一行 -->
<tr align = center valign = middle>
 <td bgcolor = #EFEFEF>日</td>
<td>一</td>
<td>二</td>
<td>三</td>
<td> 四</td>
<td>五</td>
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

