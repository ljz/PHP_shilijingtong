<?php 
session_start();
include 'global.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>���Ϲ���</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css	href="templates/css/style.css">
<script>
	//Javascript������
	function checkSubmit($o){
		var i_at=-1;
	    var i_dot=-1;
		var password = $o.password.value;
		var email = $o.email.value;
		var passrole = /^([a-zA-Z0-9]|[-_]){6,16}$/;
		var fail = "";
	   	i_at  = email.indexOf('@');
	   	i_dot = email.indexOf('.',i_at);
	   	if (i_at<0||i_dot<0||i_dot-i_at<4){
			fail += '��������ȷ�������ַ\n\r';
		}
		if (!passrole.exec(password)){
			fail += '��������ȷ������\n\r';
		}
		if(fail == ""){
			return true;
		}else{
			alert(fail);
			return false;
		}
	}

</script>
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		���Ϲ���
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank" name="search" id="search">
				<div class="input">
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
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title>�û���¼</DIV>
				<DIV class=user>
<?php
//�û�ע�����
if(isset($_POST["action"]) and $_POST["action"]=="login"){
	$g->setSql("select id,nickname,truename,admin from #_members where email = '".trim($_POST["email"])."' and password = '".md5(trim($_POST["password"]))."'");
	$g->query();
	if($g->getLines()>0){
		$user = $g->loadRow();
		$_SESSION["i"]["id"] = $user[0];
		$_SESSION["i"]["nickname"] = $user[1];
		$_SESSION["i"]["truename"] = $user[2];
		$_SESSION["i"]["admin"]    = $user[3];
		$_SESSION["i"]["email"] = trim($_POST["email"]);
		$_SESSION["i"]["password"] = md5(trim($_POST["password"]));
		$g->alert('�û���¼�ɹ������Ժ�...','user.php');	
	}else{
		echo '<font color="red">��Ч�ĵ�¼��Ϣ�������ԣ�</font>';
	}
}
?>
<!---------����ʼ--------->
                <form id="reg" name="reg" action="login.php" method="POST" onSubmit="return checkSubmit(this);">
                    <div class="info" id="form_el_list">
                        <ul>
                            <li>
                            <div class="sp">���䣺</div>
                            <input class="input1" id="email" name="email" type="text" value="" tabindex="12" />
                            </li>
                            <li>
                            <div class="sp">���룺</div>
                            <input class="input1" name="password" type="password" value="" id="password"  tabindex="14" />                            
                            </li>
                            <li>
                          </ul>
        			</div>
        <div class="center">
			<input class="but1" name="" type="submit" value="��¼ϵͳ" />
			<input type="hidden" name="action" value="login">
		</div>
</form>


<!---------������--------->
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>��¼˵��</DIV>
					<UL class=cool>
						<div><strong>���䣺</strong>�������Աע��ʱ��д�����䡣</div><br>
						<div><strong>���룺</strong>������λ�����16λ��Ӣ�ġ����Ż������֡�</div><br>
					</UL>
		  </DIV>
			</DIV>
		</DIV>

		<DIV class=right>
			<DIV class=play>
				<DIV class=title>�Ƽ���Ʒ</DIV>
					<DIV class=playwrap>
						<UL id=scrollPlay>
						<?php $g->commendProduct();?>							
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