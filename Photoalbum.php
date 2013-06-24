<?
$album ="data/album";
if(!is_dir($album))//指向的文件夹是否存在
{
	mkdir($album);//创建这个文件夹
}
if(isset($_POST["action"]) and $_POST["action"] == "upload")//是否存在约定变量，并且值正确
{	
	if(isset($_FILES["file"]["tmp_name"]))//检测$_FILES变量中是否存在数据
	{
		$filename = $_FILES["file"]["name"];//定义新的文件名
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$album."/".$filename))//把上传的临时文件移动到新目录
		{
			echo "上传成功！";
		}
		else
		{
			echo "上传文件失败！";
		}
	}
}
?>

<!-- 头和样式设计-->
<html>
<head>
<meta http-equiv = "Content-Type" content = "text/html;charset = utf8"/>
<title>相册</title>
<style>
body{ margin:0px;padding:0px;background-color:#EFEFEF;font-size:12px;}
ul{margin:0px;padding:0px;list-style:none;}
a{color:#333333;text-decoration:none;}
a:hover{color:#999999;}
.ablum_out{width:98% px;margin-left:10px;margin-top:10px}
.ablum_out img{margin:4px;border:#CCC 1px solid; }
.ablum_out li{float:left;width:180px;text-align:center;margin:5px;}
</style>
</head>



<!--供上传文件的HTML表单 -->
<body>
<form action = "" method ="POST" enctype= "multipart/form-data" name="forml" id = "forml"> <!--submit 跳转到该页面从头执行 -->
<label>上传图片
<input type="file" name = "file"/>
</label>
<label>
<input type="submit" name="submit" value = "submit"/>
<input Type="hidden" name="action" value= "upload"/>
</label>
</form>
<!--       -->

<hr size= "1"/><!--水平线-->
<div class = "ablum_out"><!--定义文档中的分区或节-->
<ul> <!--标签定义无序列表-->
<?
$dh = dir($album);//打开一个目录句柄，并返回一个对象。这个对象包含三个方法：read() , rewind() 以及 close()。若成功，则该函数返回一个目录流，否则返回 false 以及一个 error。可以通过在函数名前加上 "@" 来隐藏 error 的输出。
echo "相册目录：".$dh->path."<br>";

while(false !==($file = $dh->read()))
{
	if( $file != "." and $file != "..")
	{
		echo '<li> <a href="'.$album."/".$file.'" target ="_blank"> <img src = "'.$album."/".$file.'"  width = "160" height = "120" border = "0"/>	<br/>'.$file.'</a></li>';
	}
} 
$dh->close();
?>
</ul>
</div>

<br/><!--只是简单地开始新的一行-->
</body>
</html>

