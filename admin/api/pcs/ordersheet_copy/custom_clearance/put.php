<?php
/*
 +=============================================================================
 | 
 | 해외통관정보 수정
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$clearance_idx_list = $_POST['clearance_idx_list'];
$category_code_list = $_POST['category_code_list'];
$category_name_list = $_POST['category_name_list'];
$hs_code_list       = $_POST['hs_code_list'];

$sel_idx            = $_POST['sel_idx'];
$category_id        = $_POST['category_id'];
$category_code      = $_POST['category_code'];
$category_name      = $_POST['category_name'];
$hs_code            = $_POST['hs_code'];

if($sel_idx != null){
    if($category_code != null && $category_name != null && $hs_code != null){
        $update_sql = "
            UPDATE CUSTOM_CLEARANCE
            SET
                CATEGORY_CODE = '".$category_code."',
                CATEGORY_NAME = '".$category_name."',
                HS_CODE = '".$hs_code."'
            WHERE
                IDX = ".$sel_idx."
        ";

        $db->query($update_sql);
    }
    else if($category_id != null){
        $update_sql = "
            UPDATE CUSTOM_CLEARANCE
            SET
                CATEGORY_IDX = (SELECT IDX FROM MD_CATEGORY WHERE NODE = '".$category_id."')
            WHERE
                IDX = ".$sel_idx."
        ";

        $db->query($update_sql);
    }
    else{
        $code = 301;
        $msg = '필수항목은 반드시 기재해야 합니다.';
    }
}
else if(is_array($clearance_idx_list)){
    $db->begin_transaction();
	try {
        if(count($clearance_idx_list) > 0){
            foreach($clearance_idx_list as $key => $value){
                $sql = 	"
                    UPDATE
                        CUSTOM_CLEARANCE
                    SET
                        CATEGORY_CODE = '".$category_code_list[$key]."',
                        CATEGORY_NAME = '".$category_name_list[$key]."',
                        HS_CODE = '".$hs_code_list[$key]."'
                    WHERE 
                        IDX = ".$value."
                ";
                $db->query($sql);
            }
            $db->commit();
        }
        else{
            $json_result['code'] = 300;
            $json_result['msg'] = '수정가능한 해외통관 정보가 존재하지 않습니다.';
            return $json_result;
        }
    }
    catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "해외통관 일괄수정작업이 실패했습니다.";
	}
}

?>