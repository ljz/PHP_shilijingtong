<?php
session_start();
include 'global.php';
$g->auth();
$uid = $_SESSION["i"]["id"];
if($_SESSION["i"]["admin"]==0){
	$g->alert("��Ȩ���ʸ�ҳ!","index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>���Ϲ���</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css href="templates/css/style.css">
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
<div class="nav">
<div class="navinner"><br>
���Ϲ���
<div class="navsearch" style="left: 735px">
<form action="search.php" method="post" target="_blank" name="search"
	id="search">
<div class="input"><input type="hidden" name="type" value="file" /> <input
	class="input" name="keyword" type="text"
	onFocus="this.className='input2'" value="�Ѳ�Ʒ" onClick="this.value='';"
	onblur="this.value = this.value =='' ? '��Դ����' : this.value;this.className='input'" />
</div>
<input class="but" type="submit" value=" " /></form>
</div>
<div class="other" style="left: 200px">
			<?php $g->loginStats();?>
			</div>

</div>
</div>
</DIV>
<DIV class=wrap>
<DIV class=left>
<DIV class=commend>
<DIV class=group>
<DIV class=title>��Ʒ�б�</DIV>
<DIV class=user>
<?php
//���������
if(isset($_POST["do"])){
	$action = strval($_POST["do"]);
	$error = "";
	switch($action){
		case "addProduct":
			$f = $_POST;
			if($f["title"]==""){
				$error .= "��Ʒ���Ʋ���Ϊ��<br>";
			}
			$g->setSql("select id from #_product where title = '".$f["title"]."'");
			$g->query();
			if($g->getLines()>0){
				$error .= "��Ʒ�Ѿ�����<br>";
			}
			if($error==""){
				/*****�����ļ��д��뿪ʼ****/
				$path =
				$pathSign = "/";
				$path = "folder/".$uid."/".date("Y")."/".date("m")."/".date("d");
				$dirArray = explode ( $pathSign, $path."/thumbnail" );
				$tempDir = '';
				foreach ( $dirArray as $dir ) {
					$tempDir .= $dir . $pathSign;
					$isFile = file_exists ( $tempDir );
					clearstatcache ();
					if (! $isFile && ! is_dir ( $tempDir )) {
						@mkdir ( $tempDir, 0777 );
					}
				}
				/******�����ļ��д������***/
				$p["title"] = $f["title"];
				$p["intro"] = $f["intro"];
				$p["price"] = $f["price"];
				$p["mprice"] = $f["mprice"];
				$p["fileid"] = md5(time().$uid);
				$p["commend"] = $f["commend"];
				$p["images"] = $path;
				$g->insertObject("#_product",$p);
				$g->alert('��Ӳ�Ʒ�ɹ�','user_product.php',1);
			}else{
				$g->alert($error,'user_product.php');
			}
		break;
		case "delete":
			if(count($_POST["cid"])>0){
				foreach($_POST["cid"] as $k=>$v){
					$g->setSql("delete from #_product where id = '".$v."'");
					$g->query();
				}
				echo 'ɾ���ɹ�';
			}else{
				echo '��ѡ��Ҫɾ���ļ�¼';
			}
		break;
		case "commend":
				if(count($_POST["cid"])>0){
				foreach($_POST["cid"] as $k=>$v){
					$g->setSql("update #_product set commend = 'YES' where id = '".$v."'");
					$g->query();
				}
				echo '�Ƽ��ɹ�';
			}else{
				echo '��ѡ��Ҫ�ϴ�ͼƬ�ļ�¼';
			}
		break;
		case "upload":
			if(count($_POST["cid"])>0){
				$upid = end($_POST["cid"]);
				$g->setSql("select fileid from #_product where id = '".$upid."'");
				$g->query();
				$up = $g->loadRow();
				echo '<script>window.location.href="user_product_upload.php?upid='.$up[0].'";</script>';
			}else{
				echo '��ѡ��Ҫ�Ƽ��ļ�¼';
			}
		break;
	}
}
?>
<!---------��Ʒ�б�ʼ--------->
<?php
$header = array("ID","��Ʒ����","�г���","�̳Ǽ�","�Ƽ�");
$g->setSql("select id,title,price,mprice,commend from #_product");
$g->query();
$data = $g->loadRowList(1);
$toolbar = array(
	"delete"   =>array("value"=>"ɾ��","action"=>""),
	"commend" =>array("value"=>"�Ƽ�","action"=>""),
	"upload" =>array("value"=>"�ϴ�ͼƬ","action"=>"user_product_upload.php")
);
echo $table->normal($header,$data,true,$toolbar);
?>
<!---------����--------->
</DIV>
</DIV>
<DIV class=space>
<DIV class=title>��Ӳ�Ʒ</DIV>
<form name="newFolder" id="newFolder" method="post"
	action="user_product.php" onSubmit="return checkSubmit(this);">
<UL class=cool>
	<br>
	<div><strong>���ƣ�</strong><input type="text" name="title" id="title"></div>
	<div><strong>��飺</strong> <textarea name="intro" rows="3" id="intro"
		sborient="vertical" orient="vertical"></textarea></div>
	<div><strong>�г��ۣ�</strong><input type="text" name="price" id="title"></div>
	<div><strong>�̳Ǽۣ�</strong><input type="text" name="mprice" id="title"></div>
	<div><strong>�Ƽ���</strong><select name="commend" sborient="vertical"
		orient="vertical">
		<option value="NO" selected="selected">���Ƽ�</option>
		<option value="YES">�Ƽ�</option>
	</select></div>
	<div><input name="submit" type="submit" id="submit" value="���"> <input
		name="do" type="hidden" id="do" value="addProduct"></div>
</UL>
</form>
</DIV>
</DIV>
</DIV>

<DIV class=right>
<DIV class=play>
<DIV class=title>��¼�û���Ϣ</DIV>
<DIV class=playwrap>
<UL id=scrollPlay>
<?php $g->UserInfo();?>
</UL>
</DIV>
</DIV>
</DIV>
</DIV>

<DIV class=clear></DIV>
</DIV>
</DIV>
<DIV class=footer>��Ȩ����</DIV>

</BODY>
</HTML>