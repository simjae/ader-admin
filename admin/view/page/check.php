<?php

$request_uri = explode("?",$_SERVER['REQUEST_URI']);
$permition_url = $request_uri[0];

$admin_idx = $_SESSION['ADMIN_IDX'];

$history_flg = false;

if ($admin_idx > 0) {
	$select_permition_sql = "
		SELECT
			AP.IDX				AS PERMITION_IDX,
			AP.PERMITION_TAB	AS PERMITION_TAB
		FROM
			ADMIN_PERMITION AP
		WHERE
			AP.PERMITION_URL = '".$permition_url."'
	";

	$db->query($select_permition_sql);

	$permition_tab = array();

	$permition_cnt = 0;
	foreach($db->fetch() as $permition_data) {
		$tmp_permition_idx = $permition_data['PERMITION_IDX'];
		$tmp_permition_tab = $permition_data['PERMITION_TAB'];
		
		$tmp_cnt = $db->count("PERMITION_MAPPING","ADMIN_IDX = ".$admin_idx." AND PERMITION_IDX = ".$tmp_permition_idx);
		if ($tmp_cnt > 0) {
			$permition_cnt++;
			
			if ($tmp_permition_tab != null) {
				array_push($permition_tab,$tmp_permition_tab);
			}
		}
	}
	
	$history_permition_cnt = $db->count("PERMITION_MAPPING","ADMIN_IDX = ".$admin_idx." AND PERMITION_IDX = (SELECT S_AP.IDX FROM ADMIN_PERMITION S_AP WHERE S_AP.PERMITION_URL = '/pcs/ordersheet/history')");
	if ($history_permition_cnt > 0) {
		$history_flg = true;
	}
	
	if ($permition_cnt == 0) {
		echo "
			<script>
				alert(
					'현재 관리권한으로 접근할 수 없는 페이지입니다. 관리자에게 권한을 요청해주세요.',
					function() {
						location.href='/analysis/dashboard'
					}
				);
				
			</script>
		";
	}
} else {
	echo "
		<script>
			alert(
				'로그인 후 다시 시도해주세요.',
				function() {
					location.href='/login?r_url=".$permition_url."'
				}
			);
			
		</script>
	";
}

?>