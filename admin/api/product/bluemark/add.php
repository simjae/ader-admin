<?php
/*
 +=============================================================================
 | 
 | 블루마크 엑셀 업로드 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

//블루마크시트 json string 디코딩
$bluemark_sheet = $_POST['bluemark_sheet'];
$sheet_data = json_decode($bluemark_sheet, true);

$msg = "";

$bluemark_regist_fail_cnt = array();

if($sheet_data != null){
	$success_cnt = 0;
	
	$row = 1;
	foreach($sheet_data as $val){
		/*
			$val[0]:상품코드,
			$val[1]:옵션코드,
			$val[2]:시리얼넘버,
			$val[3]:시즌
		*/
		$row++;
		if ($db->count('dev.BLUEMARK_INFO'," SERIAL_CODE = '".$val[2]."' ") == 0) {
			if(strlen($val[0]) != 0 ){
				$sql = "INSERT INTO dev.BLUEMARK_INFO(	
							PRODUCT_CODE,
							OPTION_CODE,
							SERIAL_CODE,
							SEASON,
							CREATE_DATE,
							CREATER,
							UPDATE_DATE,
							UPDATER
						) VALUES(
							'".$val[0]."',
							'".$val[1]."',
							'".$val[2]."',
							'".$val[3]."',
							NOW(),
							'Admin',
							NOW(),
							'Admin'
						)";
				$db->query($sql);
				$success_cnt++;
			}
		} else {
			array_push($bluemark_regist_fail_cnt,$row.'행');
		}
	}
	if(count($sheet_data) != $success_cnt){
		$code = 500;
		$msg = "중복된 인증키로는 등록할 수 없습니다.";
		$json_result['bluemark_fail'] = $bluemark_regist_fail_cnt;
	} else {
		$json_result['success_cnt'] = $success_cnt;
	}
}
?>