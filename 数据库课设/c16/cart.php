<?php
session_start ();
include 'global.php';
//��ȡ��GET�������ݵ���ҳ������
if (isset ( $_GET ["id"] )) {
	$g->setSql ( "select id,title,mprice from #_product where fileid = '" . strval ( $_GET ["id"] ) . "'" );
	$p = NULL;
	$g->loadObject ( $p );
	$cart->addItem ( $p->id, $p->title, 1, $p->mprice );
}
//��ȡ��POST�������ݵ���ҳ������
if (isset ( $_POST ["do"] )) {
	switch ($_POST ["do"]) {
		case "cart" :
			if (count ( $_POST ["cid"] ) > 0) {
				foreach ( $_POST ["cid"] as $v ) {
					$g->setSql ( "select id,title,mprice from #_product where id = '" . $v . "'" );
					$p = NULL;
					$g->loadObject ( $p );
					$cart->addItem ( $p->id, $p->title, 1, $p->mprice );
				}
			}
			break;
		case "delete":
			if(count($_POST["cid"])>0){
				foreach($_POST["cid"] as $v){
					$cart->removeItem($v);
				}
			}
		break;
		case "order" :
			if(isset($_SESSION["i"])){
				$cartArray = $cart->listArray();
				if(count($_POST["cid"])>0){
					$total = 0;
					foreach($_POST["cid"] as $id){
						$order = "";
						$order["pid"] = $cartArray[$id]["id"];
						$order["mid"] = $_SESSION["i"]["id"];
						$order["price"] = $cartArray[$id]["price"];
						$order["number"] = $cartArray[$id]["number"];
						$sprice = $cartArray[$id]["price"]*$cartArray[$id]["number"];
						$order["total"] = $sprice;
						$g->insertObject("#_order",$order);
						$total += $sprice;
					}
					//��չ��ﳵ����
					$cart->clear();
					//��ʾ�������ݣ���������ҳ
					$g->alert("����ɹ������Ʒ��ã�".$total."Ԫ","index.php",5);
				}else{
					$g->alert("��ѡ��ȷ������Ĳ�Ʒ","cart.php",1);
				}
			}else{
				$g->alert("ע���û��� <a href='login.php'>��¼</a> ���ٽ��н��㣬��ע���û��� <a href='register.php'>ע��</a> ���ٵ�¼��","login.php",5);
			}
		break;
	}
}
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
				<form action="search.php" method="post" target="_blank">
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
				<DIV class=title>���ﳵ��Ʒ�б�</DIV>
				<DIV class=user>
		<?php
		$data = $cart->listArray();
		if(count($data)>0){
			$header = array("���","����","����","�۸�");
			$toolbar = array(
				"delete" =>array("value"=>"ɾ��ѡ�����Ʒ","action"=>""),
				"order" =>array("value"=>"����","action"=>"")
			);
			echo $table->normal($header,$data,true,$toolbar);
			echo "���ƣ�".$cart->_total()."Ԫ";
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