<?php
class table {
	//���ô洢Javascript�ļ���Ŀ¼ 
	public $_jspath = "templates/js/";
	public $_name   = "";
	public $_action   = "";
	function  table($name="tableForm"){
		$this->_name = $name;
	}
	function normal($header,$data=NULL,$control=false,$toolbar=NULL,$width='100%'){
		$html = $this->js($toolbar);
		$html .= '<form name="'.$this->_name.'" id="'.$this->_name.'" method="post" action="'.$this->_action.'">';
		if($toolbar!=NULL){
			foreach($toolbar as $k=>$v){
				$html .= '<input type="button" name="'.$k.'" id="'.$k.'" value="'.$v["value"].'">';
			}
		}
		$html .= '<table class="tableList" style="width:'.$width.'">';
		$html .= '<tr>';
		if($control==true){
			$html .= '<th><input type="checkbox" name="toggle" id="toggle" value="" onClick="'.$this->_name.'_checkAll('.(count($data)).');" /></th>';			
		}
		foreach($header as $v){
			$html .= "<th>".$v."</th>";
		}
		$html .= "</tr>";
		$rs = 0;
		$cb = 0;
		if($data != NULL){
			//ת������Ϊ����
			if(is_object($data)){
				$data = (array)$data;
			}
			foreach($data as $k=>$v){
				//�����Դ���ʼ
				if(is_object($v)){
					//�������������Ƕ��󣬽���ת��Ϊ����
					$v = (array)$v;
				}
				//���Ҫ��������ݲ������飬�����˴�ѭ��
				if(gettype($v)!="array"){
					continue;
				}
				//ʹ��array_values����������ת��Ϊ����Ϊ����������
				$v = array_values($v);
				//�����Դ������
				if($rs == 2){
					$rs = 0;
				}
				$html .= '<tr class="row'.$rs.'" id="'.$k.'">';
				if($control==true){
					$html .= '<td><input type="checkbox" id="cb'.$cb.'" name="cid[]" value="'.$v[0].'" onclick="'.$this->_name.'_isChecked(this.checked);" /></td>';
				}
				for($i=0;$i<count($v);$i++){
					$html .= "<td>".$v[$i]."</td>";
				}
				$html .= "</tr>";
				$rs++;
				$cb++;
			}
		}
		$html .= '</table>';
		$html .= '<input type="hidden" name="boxchecked" id="'.$this->_name.'_boxchecked" value="0"><input type="hidden" name="do" id="'.$this->_name.'_do" value=""></form>';
		return $html;
	}
	function js($toolbar=NULL){
		$js = "<script type='text/javascript' src='".$this->_jspath."jquery-1.2.6.js'></script>";
		$js .= '<script type="text/javascript">';
		if($toolbar!=""){
			$js .= '$(document).ready(function(){';
			foreach($toolbar as $k=>$v){
		  		$js .= '$("#'.$k.'").click(function(){
		  			$("#'.$this->_name.'").attr("action","'.$v["action"].'");
		  			$("#'.$this->_name.'_do").val("'.$k.'");
		  			if($("#'.$this->_name.'_boxchecked").val()==0){
						alert("��ѡ��Ҫ����ļ�¼!");
					}else{
						$("#'.$this->_name.'").submit();
					}
				});';
			}
			$js .= "});";
		}
		$js .= "
		function ".$this->_name."_checkAll( n, fldName ) {
			if (!fldName) {
			   fldName = 'cb';
			}
			var f = document.".$this->_name.";
			var c = f.toggle.checked;
			var n2 = 0;
			for (i=0; i < n; i++) {
				cb = eval( 'f.' + fldName + '' + i );
				if (cb) {
					cb.checked = c;
					n2++;
				}
			}
			if (c) {
				document.".$this->_name.".boxchecked.value = n2;
			} else {
				document.".$this->_name.".boxchecked.value = 0;
			}
		}
		function ".$this->_name."_isChecked(isitchecked){
			if (isitchecked == true){
				document.".$this->_name.".boxchecked.value++;
			}
			else {
				document.".$this->_name.".boxchecked.value--;
			}
			if(document.".$this->_name.".boxchecked.value == 0){
				document.".$this->_name.".toggle.checked = false;	
			}
		}
		</script>";	
		return $js;
	}
}
?>