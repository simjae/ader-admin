<?php

if(AUTH == NULL) {
	$code = 753;
	$result = false;
}
else {
	// 인증정보 업데이트
	if(!$db->update(
		$_TABLE['OAUTH'],
		array(
			'ACCESS_TOKEN' => '',
			'EXPIRE_DATE' => date('Y-m-d H:i:s'),
			'REFRESH_TOKEN' => '',
			'REFRESH_DATE' => date('Y-m-d H:i:s')
		),
		'IDX=?',
		array(AUTH['IDX'])
	)) {
		$code = 500;
	}
}

?>