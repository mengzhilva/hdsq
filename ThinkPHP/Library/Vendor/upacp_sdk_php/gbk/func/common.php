<?php
header ( 'Content-type:text/html;charset=gbk' );
include_once 'log.class.php';
include_once 'SDKConfig.php';
// ��ʼ����־
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
/**
 * ���� �����ת��Ϊ���崮
 *
 * @param array $params        	
 * @return string
 */
function coverParamsToString($params) {
	$sign_str = '';
	// ����
	ksort ( $params );
	foreach ( $params as $key => $val ) {
		if ($key == 'signature') {
			continue;
		}
		$sign_str .= sprintf ( "%s=%s&", $key, $val );
		// $sign_str .= $key . '=' . $val . '&';
	}
	return substr ( $sign_str, 0, strlen ( $sign_str ) - 1 );
}
/**
 * �ַ�ת��Ϊ ����
 *
 * @param unknown_type $str        	
 * @return multitype:unknown
 */
function coverStringToArray($str) {
	$result = array ();

	if (! empty ( $str )) {
		$temp = preg_split ( '/&/', $str );
		if (! empty ( $temp )) {
			foreach ( $temp as $key => $val ) {
				$arr = preg_split ( '/=/', $val, 2 );
				if (! empty ( $arr )) {
					$k = $arr ['0'];
					$v = $arr ['1'];
					$result [$k] = $v;
				}
			}
		}
	}
	return $result;
}
/**
 * ���?�ر��� ����ͻ���Ϣ , ������ΪGBK ��תΪutf-8
 *
 * @param unknown_type $params        	
 */
function deal_params(&$params) {
	/**
	 * ���� customerInfo
	 */
	if (! empty ( $params ['customerInfo'] )) {
		$params ['customerInfo'] = base64_decode ( $params ['customerInfo'] );
	}
	
	if (! empty ( $params ['encoding'] ) && strtoupper ( $params ['encoding'] ) == 'GBK') {
		foreach ( $params as $key => $val ) {
			$params [$key] = iconv ( 'GBK', 'UTF-8', $val );
		}
	}
}

/**
 * ѹ���ļ� ��Ӧjava deflate
 *
 * @param unknown_type $params        	
 */
function deflate_file(&$params) {
	global $log;
	foreach ( $_FILES as $file ) {
		$log->LogInfo ( "---------�����ļ�---------" );
		if (file_exists ( $file ['tmp_name'] )) {
			$params ['fileName'] = $file ['name'];
			
			$file_content = file_get_contents ( $file ['tmp_name'] );
			$file_content_deflate = gzcompress ( $file_content );
			
			$params ['fileContent'] = base64_encode ( $file_content_deflate );
			$log->LogInfo ( "ѹ�����ļ�����Ϊ>" . base64_encode ( $file_content_deflate ) );
		} else {
			$log->LogInfo ( ">>>>�ļ��ϴ�ʧ��<<<<<" );
		}
	}
}

/**
 * ���?���е��ļ�
 *
 * @param unknown_type $params        	
 */
function deal_file($params) {
	global $log;
	if (isset ( $params ['fileContent'] )) {
		$log->LogInfo ( "---------�����̨���ķ��ص��ļ�---------" );
		$fileContent = $params ['fileContent'];
		
		if (empty ( $fileContent )) {
			$log->LogInfo ( '�ļ�����Ϊ��' );
		} else {
			// �ļ����� ��ѹ��
			$content = gzuncompress ( base64_decode ( $fileContent ) );
			$root = SDK_FILE_DOWN_PATH;
			$filePath = null;
			if (empty ( $params ['fileName'] )) {
				$log->LogInfo ( "�ļ���Ϊ��" );
				$filePath = $root . $params ['merId'] . '_' . $params ['batchNo'] . '_' . $params ['txnTime'] . 'txt';
			} else {
				$filePath = $root . $params ['fileName'];
			}
			$handle = fopen ( $filePath, "w+" );
			if (! is_writable ( $filePath )) {
				$log->LogInfo ( "�ļ�:" . $filePath . "����д�����飡" );
			} else {
				file_put_contents ( $filePath, $content );
				$log->LogInfo ( "�ļ�λ�� >:" . $filePath );
			}
			fclose ( $handle );
		}
	}
}

/**
 * �����Զ��ύ�?
 *
 * @param unknown_type $params        	
 * @param unknown_type $action        	
 * @return string
 */
function create_html($params, $action) {
	$encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
	$html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body  onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$action}" method="post">
	
eot;
	foreach ( $params as $key => $value ) {
		$html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
	}
	$html .= <<<eot
    <input type="submit" type="hidden">
    </form>
</body>
</html>
eot;
	return $html;
}

?>