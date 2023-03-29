<?php
/*
 +=============================================================================
 | 
 | 오더시트 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$box_idx_list = $_POST['box_idx_list'];
$box_type_list = $_POST['box_type_list'];
$box_name_list = $_POST['box_name_list'];
$box_width_list = $_POST['box_width_list'];
$box_length_list = $_POST['box_length_list'];
$box_height_list = $_POST['box_height_list'];
$box_volume_list = $_POST['box_volume_list'];

$box_idx        = $_POST['box_idx'];

$box_type       = $_POST['box_type'];
$box_name       = $_POST['box_name'];
$box_width      = $_POST['box_width'];
$box_length     = $_POST['box_length'];
$box_height     = $_POST['box_height'];
$box_volume     = $_POST['box_volume'];

if ($box_idx != null) {
	$update_box_info_sql = "
		UPDATE
			BOX_INFO
		SET
			BOX_TYPE = '".$box_type."',
			BOX_NAME = '".$box_name."',
			BOX_WIDTH = ".$box_width.",
			BOX_LENGTH = ".$box_length.",
			BOX_HEIGHT = ".$box_height.",
			BOX_VOLUME = ".$box_volume."
		WHERE 
			IDX = ".$box_idx."
	";
	
	$db->query($update_box_info_sql);
}
else if(is_array($box_idx_list)){
    $db->begin_transaction();
	try {
        if(count($box_idx_list) > 0){
            foreach($box_idx_list as $key => $value){
                $sql = 	"
                    UPDATE
                        BOX_INFO
                    SET
						BOX_TYPE = '".$box_type_list[$key]."',
						BOX_NAME = '".$box_name_list[$key]."',
						BOX_WIDTH = ".$box_width_list[$key].",
						BOX_LENGTH = ".$box_length_list[$key].",
						BOX_HEIGHT = ".$box_height_list[$key].",
						BOX_VOLUME = ".$box_volume_list[$key]."
                    WHERE 
                        IDX = ".$value."
                ";
                $db->query($sql);
            }
            $db->commit();
        }
        else{
            $json_result['code'] = 300;
            $json_result['msg'] = '수정가능한 박스 정보가 존재하지 않습니다.';
            return $json_result;
        }
    }
    catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "박스 일괄수정작업이 실패했습니다.";
	}
}
?>