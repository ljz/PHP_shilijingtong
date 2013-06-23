<?
echo "<strong>use melu function read melu </strong>";
$dir = "html";
$handler= opendir("$dir");
if($handler == false)
{
	echo "open dir failer";
}
else
{
	echo "melu handler is :".$handler."<br>";
	echo "melu name is :".$dir."<br>";
	while($file == readdir($handler))
	{
		if($file != false)
		{
			echo $file."<br>";
		}
	}

}
closedir($handler);
echo "<strong>use directory class read dir </strong>";

$dh = dir($dir);
echo "dir handler:".$dh->handler."<br>";
echo "dir name:".$dh->path."<br>";
while($file = $dh->read())
{
	if($file != false)
	{
		echo $file."<br>";
	}
}
$dh->close();

?>

 about file function :
fread();fwrite();fopen();fclose();file_get_contents();file_put_contents()
fopen()->fwrite()->fclose()

fopen()->fread()->fclose()

file_put_content();file_get_content()

move_uploaded_file()
is_dir()
mkdir()

setcookie(1,2,3,4,5,6,7);
<?
session_start()
session_register();
$_SESSION["^"];
?>








<?

//translate  session among pages
session_start();
session_register("svalue");
$sid = session_id();
echo "<a href='get_session_id.php?sid=".$sid."'>goto next page</a>";
$fp = fopen("sid.txt","w");
fwrite($fp,$sid);
fclose($fp);
……………………
next page:
$sid = $_GET["sid"];
$fp = fopen("sid.txt","r");
$sid = fread($fp,8192);
fclose($fp);

session_start($sid);
echo $_SESSION["svalue"];
?>

//cut substring


<?
substr($str,0,$length).ch4(0)."………………";

echo getSubStr($str,10);

?>

//encrpty and uncrpty

convert_uuencode() and convert_uudecode()   
md5()
md5_file()


//zhengzhebiaodashi

ereg()  preg_match()   


//date


time()   mktime()   date('Y-m-d')  












