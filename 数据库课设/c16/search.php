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
<META name=GENERATOR content="MSHTML 6.00.6001.17184">
</HEAD>
<BODY>

<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		���Ϲ���
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" name="search" target="_blank">
				<div class="input">
					<input type="hidden" name="type" value="file" />
					<input class="input" name="keyword" type="text" onFocus="this.className='input2'"	value="�Ѳ�Ʒ" onClick="this.value='';"	onblur="this.value = this.value =='' ? '��Դ����' : this.value;this.className='input'" />
				</div>
				<input class="but" name="searchButton"	type="submit" value=" " /></form>
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
				<DIV class=title>���²�Ʒ</DIV>
				<DIV class=user style="text-decoration: underline;">
		<?php
		$where = "";
		if(isset($_POST["keyword"])){
			$keyword = strval($_POST["keyword"]);
			$where .= " and (title like '%".$keyword."%' and intro like '%".$keyword."%')";
		}
		$g->setSql("select id,title,price,mprice,commend from #_product where 1 ".$where." order by id desc");
		$g->query();
		if($g->getLines()>0){
			//���ñ����ʹ�õĲ���
			$header = array("���","����","�г���","�̳Ǽ�","�Ƽ�",);
			$data = $g->loadRowList(1);
			$toolbar = array(
				"cart"   =>array("value"=>"���빺�ﳵ","action"=>"cart.php"),
				"detail" =>array("value"=>"�鿴����","action"=>"store.php")
			);
			$table->_name ="productTable";
			echo $table->normal($header,$data,true,$toolbar);
		}else{
			echo '<LI>���޲�Ʒ</LI>';
		}
		?>
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>���ﳵ</DIV>
					<UL class=cool>
					<?php $g->getCart();?>
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