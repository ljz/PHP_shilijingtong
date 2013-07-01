<?php
class upLoad {
	private $_thumb_width = 100;
	private $_thumb_height = 100;
	function uploadFile($fileField,$userid,$oldPath="") {
		//����ͼ���
		$RESIZEWIDTH = $this->_thumb_width;
		//����ͼ�߶� 
		$RESIZEHEIGHT = $this->_thumb_height;
		$upfile = "";
		//��ȡ$_FILES�����е�����
		$files = $_FILES [$fileField];
		//��ȡ�ļ���
		$fileName = $files ['name'];
		//��ȡ�ļ�����
		$fileType = $files ['type'];
		//��ȡ��ʱ�ļ����ļ���
		$fileTemp = $files ['tmp_name'];
		if($fileName != "" and $fileTemp != "" and $fileType != ""){
			if($this->allowType($fileType)){
				//��ȡ�ļ���С
				$upfile["filesize"] = filesize($fileTemp);
				//�����ļ��У����ϴ����ļ����浽�´������ļ�����
				if($oldPath==""){
					$filePath = $this->createDir($userid);
				}else{
					$filePath = $oldPath;	
				}				
				//��ȡ�ļ���չ��
				$fileExtendedName = $this->getExtendedName ( $fileName ); 
				//�����µ��ļ����ƣ��Ա�֤�ϴ����ļ�������
				$newFileName = time (). "." . $fileExtendedName;
				//ʹ��move_uploaded_file()�������ϴ�����ʱ�ļ������浽������ָ����·���У�������״̬
				$upfile["filename"]= $newFileName;
				$upfile["filetype"]= $fileType;
				$upfile["filestat"] = @move_uploaded_file ( $fileTemp, $filePath . $newFileName ) ? "true":"false";
				switch($fileType){
					case "image/pjpeg":
						$im = imagecreatefromjpeg ( $filePath.$newFileName );
					break;
					case "image/x-png":
						$im = imagecreatefrompng ( $filePath.$newFileName );
					break;
					case "image/gif":
						$im = imagecreatefromgif ( $filePath.$newFileName );
					break;
				}
				$this->thumbnail( $im, $RESIZEWIDTH, $RESIZEHEIGHT,  $filePath."/thumbnail/".$newFileName );
				ImageDestroy ( $im );
			}else{
				$upfile["filename"]= "�Ƿ����ļ����͡�";
				$upfile["filestat"] = "false";
			}
		}else{
			$upfile["filename"]= "��Ч���ļ����ݡ�";
			$upfile["filestat"] = "false";
		}
		return $upfile;
	}
	//�ϴ�����ļ�
	function multiUpload($fileField,$userid,$oldPath="") {
		//����ͼ���
		$RESIZEWIDTH = $this->_thumb_width;
		//����ͼ�߶� 
		$RESIZEHEIGHT = $this->_thumb_height;
		$upfiles = "";
		//��ȡ$_FILES�����е�����
		$files = $_FILES [$fileField];
		//��ȡ�ϴ��ļ����ļ���
		$fileName = $files ['name'];
		//��ȡ��ʱ�ļ����ļ���
		$fileTemp = $files ['tmp_name'];
		//��ȡ�ļ�����
		$fileType = $files ['type'];
		//�������ڱ����ļ����ļ���
		if($oldPath==""){
			$filePath = $this->createDir($userid);
		}else{
			$filePath = $oldPath;	
		}	
		//�����ϴ����ļ�����
		for($i = 0; $i < count ( $fileName ); $i ++) {
			//����ļ�������ʱ�ļ�����Ϊ�գ����ϴ��ļ�
			if ($fileName [$i] != "" and $fileTemp [$i] != "" and $fileType[$i]!="" ) {
				if($this->allowType($fileType[$i])){
					//�������ļ�����
					$newFileName = time () . $i;
					$fileExtendedName = $this->getExtendedName ( $fileName [$i] ); //�����ļ����
					$newFilePathAndName = $newFileName . "." . $fileExtendedName;
					$upfiles["filesize"][$i] = filesize($fileTemp[$i]);
					$upfiles["filename"][$i] = $newFilePathAndName;
					$upfiles["filetype"][$i] = $fileType[$i];
					$upfiles["filestat"][$i] = @move_uploaded_file ( $fileTemp [$i], $filePath.$newFilePathAndName ) ? "true" : "false";
					switch($fileType[$i]){
						case "image/pjpeg":
							$im = imagecreatefromjpeg ( $filePath.$newFilePathAndName );
						break;
						case "image/x-png":
							$im = imagecreatefrompng ( $filePath.$newFilePathAndName );
						break;
						case "image/gif":
							$im = imagecreatefromgif ( $filePath.$newFilePathAndName );
						break;
					}
					$this->thumbnail( $im, $RESIZEWIDTH, $RESIZEHEIGHT,  $filePath."/thumbnail/".$newFilePathAndName);
					ImageDestroy ( $im );
				}else{
					$upfiles["filename"][$i] = "�Ƿ����ļ����͡�";
					$upfiles["filestat"][$i] = "false";
				}
			}else{
				$upfiles["filename"][$i] = "��Ч���ļ����ݡ�";
				$upfiles["filestat"][$i] = "false";	
			}
		}
		return $upfiles;
	}
	/**
	 * ȡ���ļ�����׺
	 */
	function getExtendedName($fileName) {
		return end ( explode ( '.', $fileName ) );
	}
	/**
	 * ����Ƿ�Ϊ�����ϴ����ļ�����
	 */
	function allowType($type) {
		//���ò������ϴ��ļ���������
		$types = array ('application/x-js', 'application/octet-stream','application/x-php','text/html' );
		if (in_array ( $type, $types )) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/**
	 * ����Ŀ¼ Ŀ¼��ʽ  �û�ID/��/��/��/
	 */
	function createDir($userid) {
		$root = 'folder';
		$pathSign = DIRECTORY_SEPARATOR;
		$u = $userid . $pathSign;
		$y = date ( 'Y' ) . $pathSign;
		$m = date ( 'm' ) . $pathSign;
		$d = date ( 'd' ) ;
		$realpath = $root . $pathSign . $u . $y . $m . $d;
		$path = $root . $pathSign . $u . $y . $m . $d .$pathSign."thumbnail";
		$dirArray = explode ( $pathSign, $path );
		$tempDir = '';
		foreach ( $dirArray as $dir ) {
			$tempDir .= $dir . $pathSign;
			$isFile = file_exists ( $tempDir );
			clearstatcache ();
			if (! $isFile && ! is_dir ( $tempDir )) {
				@mkdir ( $tempDir, 0777 );
			}
		}
		return $realpath . $pathSign;
	}
	//����JPG��ʽ������ͼ
	function thumbnail($im, $maxwidth, $maxheight, $name) {
		$width = imagesx ( $im );
		$height = imagesy ( $im );
		if (($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)) {
			if ($maxwidth && $width > $maxwidth) {
				$widthratio = $maxwidth / $width;
				$RESIZEWIDTH = true;
			}
			if ($maxheight && $height > $maxheight) {
				$heightratio = $maxheight / $height;
				$RESIZEHEIGHT = true;
			}
			if ($RESIZEWIDTH && $RESIZEHEIGHT) {
				if ($widthratio < $heightratio) {
					$ratio = $widthratio;
				} else {
					$ratio = $heightratio;
				}
			} elseif ($RESIZEWIDTH) {
				$ratio = $widthratio;
			} elseif ($RESIZEHEIGHT) {
				$ratio = $heightratio;
			}
			$newwidth = $width * $ratio;
			$newheight = $height * $ratio;
			if (function_exists ( "imagecopyresampled" )) {
				$newim = imagecreatetruecolor ( $newwidth, $newheight );
				imagecopyresampled ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
			} else {
				$newim = imagecreate ( $newwidth, $newheight );
				imagecopyresized ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
			}
			ImageJpeg ( $newim, $name . ".jpg" );
			ImageDestroy ( $newim );
		} else {
			ImageJpeg ( $im, $name . ".jpg" );
		}
	}
}
?>
