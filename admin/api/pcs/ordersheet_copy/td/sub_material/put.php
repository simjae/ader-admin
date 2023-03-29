<?php
/*
 +=============================================================================
 | 
 | 부자재 put
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
$sub_material_idx_list 		= $_POST['sub_material_idx_list'];
$sub_material_sort_list 	= $_POST['sub_material_sort_list'];
$sub_material_name_list 	= $_POST['sub_material_name_list'];
$sub_material_code_list 	= $_POST['sub_material_code_list'];
$company_name_list 			= $_POST['company_name_list'];
$company_charge_list 		= $_POST['company_charge_list'];
$company_tel_list 			= $_POST['company_tel_list'];
$company_addr_list 			= $_POST['company_addr_list'];
$sub_material_memo_list 	= $_POST['sub_material_memo_list'];

$sub_material_idx			= $_POST['sub_material_idx'];

$sub_material_sort			= $_POST['sub_material_sort'];
$sub_material_name			= $_POST['sub_material_name'];
$sub_material_code			= $_POST['sub_material_code'];
$company_name				= $_POST['company_name'];
$company_charge				= $_POST['company_charge'];
$company_tel				= $_POST['company_tel'];
$company_addr				= $_POST['company_addr'];
$sub_material_memo			= $_POST['sub_material_memo'];

$image_type					= $_POST['image_type'];

if($image_type != null){
	$set_str = "";
	if($image_type == 'SMT'){
		$image_file = $_FILES['sub_material_image'];
		$set_str = "SM_IMG_LOCATION = ";
	}
	else if($image_type == 'WOD'){
		$image_file = $_FILES['work_order_image'];
		$set_str = "WO_IMG_LOCATION = ";
	}

	$path = "/var/www/admin/www/images/sub_material/";
	$img_location_str = "NULL";
	if($image_file['size'] > 0){
		if(move_uploaded_file($image_file['tmp_name'], $path.'sub_material_img_'.time().'_'.$image_file['name']) === true){
			$img_location_str = "'".$path.'sub_material_img_'.time().'_'.$image_file['name']."'";
		}
	}
	
	$insert_image_info_sql = "
		UPDATE SUB_MATERIAL_IMAGE
		SET
			".$set_str." ".$img_location_str."
		WHERE
			SUB_MATERIAL_IDX = ".$sub_material_idx."
		";
	$db->query($insert_image_info_sql);	
}
else if($sub_material_idx != null){
	$update_sub_material_sql = "
		UPDATE
			SUB_MATERIAL_INFO
		SET
			SUB_MATERIAL_SORT 	= '".$sub_material_sort."',
			SUB_MATERIAL_NAME 	= '".$sub_material_name."',
			SUB_MATERIAL_CODE 	= '".$sub_material_code."',
			COMPANY_NAME		= '".$company_name."',
			COMPANY_CHARGE		= '".$company_charge."',
			COMPANY_TEL			= '".$company_tel."',
			COMPANY_ADDR		= '".$company_addr."',
			MEMO  = '".$sub_material_memo."'
		WHERE 
			IDX = ".$sub_material_idx."
	";
	$db->query($update_sub_material_sql);
}
else if(is_array($sub_material_idx_list)){
    $db->begin_transaction();
	try {
        if(count($sub_material_idx_list) > 0){
            foreach($sub_material_idx_list as $key => $value){
                $sql = 	"
                    UPDATE
                        SUB_MATERIAL_INFO
                    SET
						SUB_MATERIAL_SORT 	= '".$sub_material_sort_list[$key]."',
						SUB_MATERIAL_NAME 	= '".$sub_material_name_list[$key]."',
						SUB_MATERIAL_CODE 	= '".$sub_material_code_list[$key]."',
						COMPANY_NAME		= '".$company_name_list[$key]."',
						COMPANY_CHARGE		= '".$company_charge_list[$key]."',
						COMPANY_TEL			= '".$company_tel_list[$key]."',
						COMPANY_ADDR		= '".$company_addr_list[$key]."',
						MEMO  = '".$sub_material_memo_list[$key]."'
                    WHERE 
                        IDX = ".$value."
                ";
                $db->query($sql);
            }
            $db->commit();
        }
        else{
            $json_result['code'] = 300;
            $json_result['msg'] = '수정가능한 라인이 존재하지 않습니다.';
            return $json_result;
        }
    }
    catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "라인 일괄수정작업이 실패했습니다.";
	}
}
?>