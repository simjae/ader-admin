<?php
/*
 +=============================================================================
 | 
 | 부자재 추가
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sub_material_type			= $_POST['sub_material_type'];
$sub_material_sort			= $_POST['sub_material_sort'];
$sub_material_name			= $_POST['sub_material_name'];
$sub_material_code			= $_POST['sub_material_code'];
$company_name				= $_POST['company_name'];
$company_charge				= $_POST['company_charge'];
$company_tel				= $_POST['company_tel'];
$company_addr				= $_POST['company_addr'];
$sub_material_memo			= $_POST['sub_material_memo'];


if($sub_material_type != null && $sub_material_name != null && $sub_material_code != null){
	$db->begin_transaction();
	try {
		$insert_sub_material_sql = "
			INSERT INTO
				SUB_MATERIAL_INFO
			(
				SUB_MATERIAL_TYPE,
				SUB_MATERIAL_SORT,
				SUB_MATERIAL_NAME,
				SUB_MATERIAL_CODE,
				COMPANY_NAME,
				COMPANY_CHARGE,
				COMPANY_TEL,
				COMPANY_ADDR,
				MEMO
			) VALUE (
				'".$sub_material_type."',
				'".$sub_material_sort."',
				'".$sub_material_name."',
				'".$sub_material_code."',
				'".$company_name."',
				'".$company_charge."',
				'".$company_tel."',
				'".$company_addr."',
				'".$sub_material_memo."'
			)
		";
		$db->query($insert_sub_material_sql);
		$sub_material_idx = $db->last_id();
		
		if(!empty($sub_material_idx)){
			$path = "/var/www/admin/www/images/sub_material/";
			$sm_img_location_str = "NULL";
			$sub_material_file = $_FILES['sub_material_image'];
			if($sub_material_file['size'] > 0){
				if(move_uploaded_file($sub_material_file['tmp_name'], $path.'sub_material_img_'.time().'_'.$sub_material_file['name']) === true){
					$sm_img_location_str = "'".$path.'sub_material_img_'.time().'_'.$sub_material_file['name']."'";
				}
			}

			$wo_img_location_str = "NULL";
			$work_order_file = $_FILES['work_order_image'];
			if($sub_material_file['size'] > 0){
				if(move_uploaded_file($work_order_file['tmp_name'], $path.'sub_material_img_'.time().'_'.$work_order_file['name']) === true ){
					$wo_img_location_str = "'".$path.'sub_material_img_'.time().'_'.$work_order_file['name']."'";
				}
			}

			$insert_image_info_sql = "
				INSERT INTO SUB_MATERIAL_IMAGE
				(
					SUB_MATERIAL_IDX,
					SM_IMG_LOCATION,
					WO_IMG_LOCATION
				)
				VALUES
				(
					".$sub_material_idx.",
					".$sm_img_location_str.",
					".$wo_img_location_str."
				)
			";

			$db->query($insert_image_info_sql);

			$image_info_idx = $db->last_id();
			if(empty($image_info_idx)){
				$json_result['code'] = 301;
				$json_result['msg'] = '이미지 저장에 실패했습니다.';
				return $json_result;
			}
			$db->commit();
		}
	}
	catch(mysqli_sql_exception $exception){
		$json_result['code'] = 300;
		$json_result['exception_msg'] = $exception;
		$db->rollback();
	}
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = '필수항목 값이 유실됬습니다. 다시 시도해주세요';
	return $json_result;
}
?>