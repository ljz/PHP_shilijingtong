<?php
header("Content-Type:text/html;charset=utf8");
//session_start();
//include 'global.php';
?>
<HTML >
<HEAD>
<TITLE>���Ϲ���</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=gbk">
<!--LINK rel=stylesheet type=text/css	href="templates/css/style.css"-->
<!--META name=GENERATOR content="MSHTML 6.00.6001.17184"-->
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		���Ϲ���
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank">
				<div class="input">
					<input type="hidden" name="type" value="file" />
				<!--	<input class="input" name="keyword" type="text" onFocus="this.className='input2'"	value="�Ѳ�Ʒ" onClick="this.value='';"	onblur="this.value = this.value =='' ? '��Դ����' : this.value;this.className='input'" /> -->
				</div>
				<input class="but"	type="submit" value=" " /></form> 
			</div> 
			<div class="other" style="left:200px">  
			<?php// $g->loginStats();?>  
			</div>

	  </div>
	</div>
</DIV>
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title>���²�Ʒ</DIV>
				<?php// $g->newProduct();?>
			</DIV>
			<DIV class=space>
				<DIV class=title>���ﳵ</DIV>
					<UL class=cool>
				<?php// $g->getCart();?>
					</UL>
				</DIV>
			</DIV>
		</DIV>

		<DIV class=right>
			<DIV class=play>
				<DIV class=title>�Ƽ���Ʒ</DIV>
					<DIV class=playwrap>
						<UL id=scrollPlay>
						<?php// $g->commendProduct();?>
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
