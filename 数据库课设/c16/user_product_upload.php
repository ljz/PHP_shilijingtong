<?php
session_start();
include 'global.php';
$g->auth();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>���Ϲ���</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css	href="templates/css/style.css">
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		���Ϲ���
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank" name="search" id="search">
				<div class="input">
					<input type="hidden" name="type" value="file" />
					<input class="input" name="keyword" type="text" onFocus="this.className='input2'"	value="�Ѳ�Ʒ" onClick="this.value='';"	onblur="this.value = this.value =='' ? '��Դ����' : this.value;this.className='input'" />
				</div>
				<input class="but"	type="submit" value=" " /></form>
			</div>
			<div class="other" style="left:200px">
			<?php $g->loginStats();?>
			</div>

	  </div>
	</div>
</DIV>
<?php
if(isset($_POST["do"]) && $_POST["do"]=="upload"){
	$upid = end($_POST["cid"]);
	$_SESSION["temp"]["upid"] = $upid;
}elseif(isset($_SESSION["temp"]["upid"])){
	$upid = $_SESSION["temp"]["upid"];
}
$g->setSql("select id,title,intro,images,fileid from #_product where id = '".$upid."'");
$f = NULL;
$g->loadObject($f);
//���������
if(isset($_POST["do"])){
	$error = "";
	switch($_POST["do"]){
		case "addFiles":
			include_once("class/upload.class.php");
			$u = new upload();
			$path = $f->images."/";
			$p = $_POST;
			$up = $u->uploadFile("file",1,$path);
			if($up["filestat"]=="false"){
				$error .= $up["filename"];
			}
			if($error==""){
				$file["fileid"] = $f->fileid;
				$file["filetitle"] = $p["title"];
				$file["filename"] = $up["filename"];
				$file["filetype"] = $up["filetype"];
				$g->insertObject("#_files",$file);
			}else{
				$g->alert($error,'user_product_upload.php');
			}
		break;
		case "delete":
			if(count($_POST["cid"])>0){
				foreach($_POST["cid"] as $k=>$v){
					$g->setSql("delete from #_files where id = '".$v."'");
					$g->query();
				}
			}else{
				echo '��ѡ��Ҫɾ���ļ�¼';
			}
		break;
	}
}
?>
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title><?=$f->title;?></DIV>
				<DIV><?=$f->intro;?></DIV>
				<DIV class=user>
<!---------��Ʒ�б�ʼ--------->
<?php
$header = array("ID","����");
$g->setSql("select id,filetitle from #_files where fileid = '".$f->fileid."'");
$g->query();
$data = $g->loadRowList(1);
$toolbar = array(
	"delete"   =>array("value"=>"ɾ��","action"=>"")
);
echo $table->normal($header,$data,true,$toolbar);
?>
<!---------����--------->
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>���ͼƬ</DIV>
					<form name="newFolder" id="newFolder" method="post" action="user_product_upload.php" enctype="multipart/form-data">
					<UL class=cool><br>
						<div><strong>���ƣ�<input type="text" name="title" id="title"></strong></div>
						<div><strong>ѡ��<input type="file" name="file" size="6"></strong></div>
						<div>
							<input name="submit" type="submit" id="submit" value="���">
							<input name="do" type="hidden" id="do" value="addFiles">
						</div>
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