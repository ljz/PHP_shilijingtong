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
		var pass1 = $o.pass1.value;
		var pass2 = $o.pass2.value;
		var email = $o.email.value;
		var passrole = /^([a-zA-Z0-9]|[-_]){6,16}$/;
		var fail = "";
		if(pass1!=pass2){
			fail += '������������벻��ͬ\n\r';
		}
		if (!passrole.exec(pass1)){
			fail += '��������ȷ������\n\r';
		}
	   	i_at  = email.indexOf('@');
	   	i_dot = email.indexOf('.',i_at);
	   	if (i_at<0||i_dot<0||i_dot-i_at<4){
			fail += '��������ȷ�������ַ\n\r';
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
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title>�û�ע��</DIV>
				<DIV class=user>
<?php
//�û�ע�����
if(isset($_POST["action"]) and $_POST["action"]=="register"){
	$user = "";
	$user["password"] = md5(trim($_POST["pass1"]));
	$user["email"] = trim($_POST["email"]);
	$user["nickname"] = trim($_POST["nickname"]);
	$user["truename"] = trim($_POST["truename"]);
	$user["telphone"] = trim($_POST["telphone"]);
	$user["mobile"] = trim($_POST["mobile"]);
	$user["address"] = trim($_POST["address"]);
	$user["sex"] = intval(trim($_POST["gender"]));
	$g->setSql("select id from #_members");
	$g->query();
	$lines = $g->getLines();
	if($lines>0){
		$user["admin"] = 0;
	}else{
		$user["admin"] = 1;
	}
	$g->setSql("select id from #_members where email = '".$user["email"]."'");
	$g->query();
	if($g->getLines()>0){
		$g->alert('���ݿ������ͬ�ĵ����ʼ���ַ���볢�������������䡣','register.php');	
	}else{
		$g->insertObject("#_members",$user);
		$g->alert('��Աע��ɹ������Ժ�...','index.php');	
	}

}
?>
<!---------����ʼ--------->
                <form id="reg" name="reg" action="register.php" method="POST" onSubmit="return checkSubmit(this);">
                    <div class="info" id="form_el_list">
                        <ul>
                            <li>
                            <div class="sp">���䣺</div>
                            <input class="input1" id="email" name="email" type="text" value="" tabindex="1" />
                            </li>
                            <li>
                            <div class="sp">���룺</div>
                            <input class="input1" name="pass1" type="password" value="" id="password"  tabindex="2" />                            
                            </li>
                            <li>
                            <div class="sp">ȷ�ϣ�</div>
                            <input class="input1" name="pass2" id="pwd2" type="password" value="" tabindex="3" />                            
                            </li> 
							<li>
                            <div class="sp">�ǳƣ�</div>
                            <input class="input1" id="nickname" name="nickname" type="text" value="" tabindex="4" />                            
                            </li>  
                            <li>
                            <div class="sp">������</div>
                            <input class="input1" id="truename" name="truename" type="text" value="" tabindex="5" />                            
                            </li>       
                            <li>
                            <div class="sp">�Ա�
							<input type="radio" name="gender" id="gender_male" value="1"  tabindex="6" checked="checked" /><label for="gender_male">��</label>&nbsp;&nbsp;
							<input type="radio" name="gender" id="gender_female" value="0" tabindex="7" /><label for="gender_female">Ů</label>&nbsp;&nbsp;</div>
                            </li>
                            <li>
                            <div class="sp">�绰��</div>
                            <input class="input1" id="telphone" name="telphone" type="text" value="" tabindex="8" />                            
                            </li> 
                            <li>
                            <div class="sp">�ֻ���</div>
                            <input class="input1" id="mobile" name="mobile" type="text" value="" tabindex="9" />                            
                            </li> 
                            <li>
                            <div class="sp">��ַ��</div>
                            <textarea id="address" name="address" rows="4" cols="22" sborient="vertical" orient="vertical"></textarea>                            
                            </li> 
							<li>
								<div>���<br><br><br><br></div>
							</li>

						</ul>
        			</div>
        <div class="center">
			<input class="but1" name="" type="submit" value="ͬ���������ύע����Ϣ" />
			<input type="hidden" name="action" value="register">
		</div>
</form>


<!---------������--------->
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>ע��˵��</DIV>
					<UL class=cool>
						<div><strong>���䣺</strong>��Ϊϵͳ��¼��ʶ��һ��ȷ�ϣ����ɸ��ġ�</div><br>
						<div><strong>���룺</strong>������λ�����16λ��Ӣ�ġ����Ż������֡�</div><br>
						<div><strong>ȷ�ϣ�</strong>���ظ���������롣</div><br>
						<div><strong>�Ա�</strong>һ��ѡ�񣬲��ɸ��ġ�</div><br>
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