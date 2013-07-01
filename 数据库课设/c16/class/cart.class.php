<?php
//������������
class cart{
	//����������Ӹ���¼��Ʒ��Ϣ������
	function addItem($id,$title,$number,$price){
		//��ȡSESSION�еĲ�Ʒ����
		$temp = (array)$this->restore();
		//����Ʒ�Ѿ�����ʱ��ֻ�޸Ĳ�Ʒ����
		if(array_key_exists($id,$temp)){
			$temp[$id]["number"] = $temp[$id]["number"]+$number;
		}else{
			//��Ʒ������ʱ���½�һ����¼
			$temp[$id]["id"] = $id;
			$temp[$id]["title"] = $title;
			$temp[$id]["number"] = $number;
			$temp[$id]["price"] = $price;
		}
		//�����ݱ��浽SESSION��
		$this->store($temp);
	}
	//����ID����������ɾ��һ����¼
	function removeItem($id){
		$temp = $this->restore();
		if(is_array($temp[$id])){
			unset($temp[$id]);
		}
		$this->store($temp);
	}
	//ͳ���ܵļ۸�
	function _total(){
		$total = "";
		$temp = $this->restore();
		if(is_array($temp) and count($temp)>0){
			foreach($temp as $v){
				$total += $v["number"]*$v["price"];
			}
		}
		return $total;
	}
	//��������ʽ���ع�����������
	function listArray(){
		$temp = $this->restore();
		return $temp;
	}
	//�ָ�����
	function restore(){
		//��SESSION�����У���ȡ����������
		$cart_items = $_SESSION["cart_items"];
		//��SESSION�е����ݷ����л�
		$items = unserialize(stripslashes($cart_items));
		//��������
		return $items;
	}
	//��������
	function store($items){
		//���������������л�
		$items = serialize($items);
		//���浽SESSION��
		$_SESSION["cart_items"] = $items;
	}
	//�������
	function clear(){
		unset($_SESSION["cart_items"]);
	}
}
?>
