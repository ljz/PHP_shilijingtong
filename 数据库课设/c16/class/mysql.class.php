<?php
/**
* �Զ���MySQL��
* ʵ�������ݿ����ӡ�������ǰ׺��������Ϣ����SQL��䴦������ֵ�����
*/
//����mysql��
class mysql{
	var $_sql='';//����һ�����ڴ洢SQL���ı���
	var $_prefix='';//����һ�����ڴ洢������ǰ׺�ı���
	var $_errno=0;//����洢�������ı���
	var $_error='';//����洢������Ϣ�ı���
	var $_conn = '';//�������ڴ洢���ӵı���
	var $_result='';//�������ڴ洢������ı���
	/**
	* ʵ���������ӵķ���.
	* �����������ݿ�������ĵ�ַ���û��������롢ʹ�õ��ַ�����Ҫ���������ݿ����ơ�������ǰ׺��
	* ����Ĭ��ֵΪ��
	*/
	function mysql($host='',$user='',$pass='',$db='',$setchar='',$prefix=''){
		//��鵱ǰϵͳ�Ƿ���mysql���У����û�п���mysql���У������ű����У�����ʾ��ʾ��Ϣ
		if(!function_exists('mysql_connect')){
			echo "��ǰϵͳû�п���MYSQL���У������������!";
			//�����ű�
			exit();
		}
		//�������ݿ�,ʧ��ʱ�����ű�,����ʾ������Ϣ
		$this->_conn = mysql_connect($host,$user,$pass) or die("���ӷ�������ʧ��,����������Ӳ���");
		//ѡ�����ݿ�,ʧ��ʱ�����ű�,����ʾ������Ϣ
		if (!mysql_select_db($db)){
			echo "���û���ݿ�ʧ��,�������������Ƿ���ȷ";
			//�����ű�
			exit();
		}
		//�����ַ���
		if($setchar != ""){
			//����SQL���
			$this->setSql("SET NAMES ".$setchar);
			//����SQL���
			$this->query();
		}
		//���ñ�����ǰ׺
		$this->_prefix = $prefix;
		
	}	
	/**
	* �滻SQL����еı�ǰ׺,�����ش���õ�SQL���
	* $sql Ҫ�����SQL���
	* $prefix Ĭ�ϵı�����ǰ׺�滻����
	*/
	function setSql($sql,$prefix='#' ){
		//ȥ�����ߵĿո�
	    $sql = trim( $sql );
	    //��SQL����еķ���,�滻��ָ���ı�����ǰ׺
	    $sql = str_replace($prefix,$this->_prefix,$sql);
	    //����������$_sql��ֵ
		$this->_sql = $sql;
	}
	/**
	* �������úõ�SQL���
	*/
	function getSql(){
		return "<pre>".htmlspecialchars($this->_sql). "</pre>";
	}
	/**
	* ����SQL���
	*/
	function query() {
		//��ʼ��������Ϣ����		
		$this->_errno = 0;
		$this->_error = '';
		//�������úõ�SQL���,���ѷ���ֵ����������$_result
		$this->_result = mysql_query($this->_sql,$this->_conn);
		//������е�SQL������,��ʾ������Ϣ
		if (!$this->_result){
			//ʹ��mysql_errno()����ȡ��ָ�����Ӵ������
			$this->_errno = mysql_errno($this->_conn);
			//ʹ��mysql_error()����ȡ��ָ�����Ӵ�����Ϣ
			$this->_error = mysql_error($this->_conn);
			return false;
		}
		//���ؽ��
		return $this->_result;
	}

	/**
	* ���ؽ�����еļ�¼��
	*/
	function getLines( $result=null ){
		//���ָ���Ĳ�����Ϊ��,�������¼��,���Ϊ��,����������ָ���Ľ�����еļ�¼��
		return mysql_num_rows( $result ? $result : $this->_result);
	}
	/**
	* ��������Ϊ����,����һ������
	*/
	function loadRow(){
		//�������SQL���,������ؽ����ʧ��,����һ��NULLֵ.
		if (!($result = $this->query())) {
			return null;
		}
		$reResult = null;
		if($row = mysql_fetch_row($result)){
			$reResult = $row;
		}
		//�ͷ���Դ
		mysql_free_result($result);
		//���ؽ����
		return $reResult;
	}
	/**
	* ���������ֺ��ֶ�����Ϊ����������
	* 
	* ������$key=1ʱ,���ص�����ʹ��������Ϊ����
	* ������$key=2ʱ,���ص�����ʹ���ֶ�����Ϊ����
	* ������$key=3ʱ,���ص�����ʹ�����ֺ��ֶ�����Ϊ����
	* */
	function loadRowList($key=3) {
		//�������SQL���,������ؽ����ʧ��,����һ��NULLֵ.
		if(!($result = $this->query())) {
			return null;
		}
		$array = array();
		//�Ѵӽ������ȡ��������,����$array����
		switch($key){
			case 1:
				$keyName = MYSQL_NUM;
			break;
			case 2:
				$keyName = MYSQL_ASSOC;
			break;
			case 3:
				$keyName = MYSQL_BOTH;
			break;
		}
		while($row = mysql_fetch_array($result,$keyName)){
			$array[] = $row;
		}
		//�ͷ���Դ
		mysql_free_result($result);
		//��������
		return $array;
	}
	
	/**
	* ���ض���
	*/
	function loadObject( &$object ) {
		if ($object != null) {
			if (!($cur = $this->query())) {
				return false;
			}
			if ($array = mysql_fetch_assoc( $cur )) {
				mysql_free_result( $cur );
				mosBindArrayToObject( $array, $object );
				return true;
			} else {
				return false;
			}
		} else {
			if ($cur = $this->query()) {
				if ($object = mysql_fetch_object( $cur )) {
					mysql_free_result( $cur );
					return true;
				} else {
					$object = null;
					return false;
				}
			} else {
				return false;
			}
		}
	}
	/**
	* ������ת���ɼ�¼�����뵽���ݿ���
	*/
	function insertObject( $table, &$object, $keyName = NULL, $verbose=false ) {
		$object = (object)$object;
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$fields[] = "`$k`";
			$values[] = "'" . $this->getEscaped( $v ) . "'";
		}
		$this->setSql( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		($verbose) && print "$sql<br />\n";
		if (!$this->query()) {
			return false;
		}
		$id = mysql_insert_id();
		($verbose) && print "id=[$id]<br />\n";
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

	/**
	* ���ݶ���������ݼ�¼
	*/
	function updateObject( $table, &$object, $keyName, $updateNulls=true ) {
		$object = (object)$object;
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		foreach (get_object_vars( $object ) as $k => $v) {
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = "$keyName='" . $this->getEscaped( $v ) . "'";
				continue;
			}
			if ($v === NULL && !$updateNulls) {
				continue;
			}
			if( $v == '' ) {
				$val = "''";
			} else {
				$val = "'" . $this->getEscaped( $v ) . "'";
			}
			$tmp[] = "`$k`=$val";
		}
		$this->setSql( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}
	
	/**
	* ���ض�������
	*/
	function loadObjectList( $key='' ) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_object( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysql_free_result( $cur );
		return $array;
	}
	/**
	* ��ʾ������Ϣ,���ݲ����ж��Ƿ��ڴ�����Ϣ����ʾ�����SQL���
	*/
	function getError($showSQL = false) {
		return "�������:{$this->_errno}<br /><font color=\"red\">������Ϣ:{$this->_error}</font>".($showSQL?"<br />�����SQL���:<pre>$this->_sql</pre>":'');
	}
	/**
	 * �������һ��ʹ��INSERT��������IDֵ
	 */
	function lastid()
	{
		return mysql_insert_id();
	}
	/**
	 * ȡ��mysql�İ汾��Ϣ
	 *
	 * @return string
	 */
	function getVersion()
	{
		return mysql_get_server_info();
	}

	/**
	* ȡ�ô������SQL���
	*/
	function getTableCreateSQL( $table ) {
		$this->setSql('SHOW CREATE table '.$table);
		$this->query();
		$result = $this->loadRowList(2);
		return $result;
	}
	/**
	* ȡ�ñ���ֶ��б�
	*/
	function getTableFields($table) {
		$this->setSql( 'SHOW FIELDS FROM ' . $table );
		$this->query();
		$fields = $this->loadRowList(2);
		return $fields;
	}
	/**
	* ת���ַ�������SQL���
	*/	
	function getEscaped( $text ) {
		return mysql_escape_string( $text );
	}
}
?>
