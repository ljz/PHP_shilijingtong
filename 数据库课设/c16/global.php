<?php
header("Content-Type:text/html;charset=utf8");
//���س�����
include 'class/mysql.class.php';
include 'class/table.class.php';
include 'class/cart.class.php';
$cart = new cart();
$table = new table();
class globalClass extends mysql{
	function globalClass($host,$user,$pass,$db,$charset,$pre){
		//�������ݿ�
		$this->mysql($host,$user,$pass,$db,$charset,$pre);
	}
	//�û���֤����
	function auth(){
		$email = $_SESSION["i"]["email"];
		$pass = $_SESSION["i"]["password"];
		$this->setSql("select id from #_members where email = '".$email."' and password = '".$pass."'");
		$this->query();
		if($this->getLines()<1){
			$this->alert('�Ƿ���¼!','index.php');
		}
	}
	//��¼�û���Ϣ
	function UserInfo(){
		$email = $_SESSION["i"]["email"];
		$pass = $_SESSION["i"]["password"];
		$this->setSql("select id,email,nickname,truename,sex,telphone,mobile,address from #_members where email = '".$email."' and password = '".$pass."'");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo '<li>��¼���䣺'.$user[1].'</li>';
			echo '<li>�û��ǳƣ�'.$user[2].'</li>';
			echo '<li>�û�������'.$user[3].'</li>';
			if($user[4]==1){
				echo '<li>�Ա���</li>';
			}else{
				echo '<li>�Ա�Ů</li>';
			}
			echo '<li>�绰��'.$user[5].'</li>';
			echo '<li>�ֻ���'.$user[6].'</li>';
			echo '<li>��ַ��'.$user[7].'</li>';
		}else{
			$this->alert('�Ƿ���¼!','index.php');
		}
	}
	//��Ϣ��ʾ����
	function alert($info,$url,$time=3){
		echo $info;
		echo '<meta http-equiv="Refresh" content="'.$time.';url='.$url.'"/>';
		exit();
	}
	//��¼��Ϣ��ʾ
	function loginStats(){
		if(isset($_SESSION["i"])){
			switch ($_SESSION["i"]["admin"]){
				case "0":
					echo '
						��ӭ��'.$_SESSION["i"]["truename"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="navlogin" href="index.php">��ҳ</a>
						<a class="navlogin" href="product.php">��Ʒ�б�</a>
						<a class="navlogin" href="cart.php">���ﳵ</a>
						<a class="navlogin" href="logout.php">�˳�</a>
					';
				break;
				case "1":
					echo '
						��ӭ��'.$_SESSION["i"]["truename"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="navlogin" href="index.php">��ҳ</a>
						<a class="navlogin" href="product.php">��Ʒ�б�</a>
						<a class="navlogin" href="cart.php">���ﳵ</a>
						<a class="navlogin" href="user_order.php">��������</a>
						<a class="navlogin" href="user_product.php">��Ʒ����</a>
						<a class="navlogin" href="user.php">����</a>
						<a class="navlogin" href="logout.php">�˳�</a>
					';
				break;
			}
		}else{
			echo '
			<a class="navlogin" href="index.php">��ҳ</a>
			<a class="navlogin" href="product.php">��Ʒ�б�</a>
			<a class="navlogin" href="cart.php">���ﳵ</a>
			<a class="navlogin" href="login.php">��¼</a>
			<a class="navreg" href="register.php">���û�ע��</a>
			';
		}
	}
	//����ֵת��
	function getTitle($key){
		$keys = array('true'=>'��','false'=>'��','1'=>'��','0'=>'��');
		return $keys[$key];
	}
	//�Ƽ���Ʒ
	function commendProduct(){
		$this->setSql("select id,title,fileid from #_product where commend = 'YES' order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<LI id="'.$k.'"><a href="store.php?fileid='.$v[2].'">'.$v[1].'</a></LI>';
			}
		}else{
			echo '<LI>�����Ƽ���Ʒ</LI>';
		}
	}
	//���²�Ʒ
	function newProduct(){
		$this->setSql("select id,title,fileid from #_product order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<DIV class=user id="'.$k.'"><a href="store.php?fileid='.$v[2].'">'.$v[1].'</a></DIV>';
			}
		}else{
			echo '<LI>���޲�Ʒ</LI>';
		}
	}
	//��ȡ��Ʒ���ͼƬ
	function aboutFiles($folder,$fileid){
		include 'class/images.class.php';
		$img = new images();
		$this->setSql("select id,fileid,filename,filetype,filetitle from #_files where fileid = '".$fileid."'");
		$this->query();
		$st = $this->loadRowList(1);
		$img->singleShow($folder,$st);
	}
	//���ﳵ
	function getCart(){
		global $cart,$table;
		$table->_name = 'cartlist';
		$data = $cart->listArray();
		if(count($data)>0){
			$header = array("���","����","����","�۸�");
			echo $table->normal($header,$data);
		}else{
			echo '<LI>���޲�Ʒ</LI>';
		}
	}

}
$g = new globalClass("localhost","root","password","onlinestore","latin1","o");
?>
