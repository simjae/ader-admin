<?php
@set_time_limit(60000);
@ini_set('memory_limit',-1);

$season_code = trim($season_code);
$barcode = trim($barcode);

if($result) {
	for($i=0;$i<$count;$i++) {
		$serial_code = $season_code.get_serial_mix($strlength-strlen($season_code),$strlength-strlen($season_code));
		$serial_code = strtoupper($serial_code);
		if($db->count($_TABLE['SERIAL'],'SERIAL_CODE=?',array($serial_code)) == 0) {
			if($db->insert(
				$_TABLE['SERIAL'],
				array(
					'BARCODE'=>$barcode,
					'SEASON'=>$season_code,
					'SERIAL_CODE'=>$serial_code
				)
			) {
				$json_result['data'][] = array(
					'no'=>$db->last_id(),
					'serial_code'=>$serial_code,
					'create_date'=>date('Y-m-d H:i:s')
				);
			}
			else {
				$code = 500;
				break;
			}
		}
		else {
			$count++;
		}
	}
}

?>