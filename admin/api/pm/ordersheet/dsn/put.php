
<?php
/*
 +=============================================================================
 | 
 | 오더시트 수정 - 디자인
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
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$ordersheet_idx     = $_POST['ordersheet_idx'];
$product_code       = $_POST['product_code'];
$product_name       = $_POST['product_name'];
$update_date 		= $_POST['update_date'];
$overwrite_flg		= $_POST['overwrite_flg'];

$update_date_sql = "
    SELECT
        UPDATE_DATE
    FROM 
        dev.ORDERSHEET_MST
    WHERE 
        IDX = ".$ordersheet_idx."
";

$db->query($update_date_sql);

$last_update_date = "";
foreach($db->fetch() as $verify_data){
    $last_update_date = $verify_data['UPDATE_DATE'];
}

if ($update_date != $last_update_date) {
    if($overwrite_flg == "false"){
        $json_result['code'] = 300;
	    $json_result['msg'] = "작성 도중에 오더시트가 수정되었습니다.<br>이대로 수정하시겠습니까?";
        return $json_result;
    }
}

if($ordersheet_idx != null){
    $column_cnt     = $_POST['column_cnt'];
    $size_category  = $_POST['size_category'];
    $option_name    = $_POST['option_name'];
    $size_code      = $_POST['size_code'];
    $option_size_1  = $_POST['option_size_1'];
    $option_size_2  = $_POST['option_size_2'];
    $option_size_3  = $_POST['option_size_3'];
    $option_size_4  = $_POST['option_size_4'];
    $option_size_5  = $_POST['option_size_5'];
    $option_size_6  = $_POST['option_size_6'];

    $wkla_idx = $_POST['wkla_idx'];
    $wkla_idx_str = " WKLA_IDX = '".$wkla_idx."',";

    $model = $_POST['model'];
    $model_str = " MODEL = '".$model."',";

    $model_wear = $_POST['model_wear'];
    $model_wear_str = " MODEL_WEAR = '".$model_wear."',";

    $size_a1_kr = $_POST['size_a1_kr'];
    $size_a1_kr = xssEncode($size_a1_kr);
    $size_a1_kr_str = " SIZE_A1_KR = '".$size_a1_kr."',";

    $size_a2_kr = $_POST['size_a2_kr'];
    $size_a2_kr = xssEncode($size_a2_kr);
    $size_a2_kr_str = " SIZE_A2_KR = '".$size_a2_kr."',";

    $size_a3_kr = $_POST['size_a3_kr'];
    $size_a3_kr = xssEncode($size_a3_kr);
    $size_a3_kr_str = " SIZE_A3_KR = '".$size_a3_kr."',";

    $size_a4_kr = $_POST['size_a4_kr'];
    $size_a4_kr = xssEncode($size_a4_kr);
    $size_a4_kr_str = " SIZE_A4_KR = '".$size_a4_kr."',";

    $size_a5_kr = $_POST['size_a5_kr'];
    $size_a5_kr = xssEncode($size_a5_kr);
    $size_a5_kr_str = " SIZE_A5_KR = '".$size_a5_kr."',";

    $size_onesize_kr = $_POST['size_onesize_kr'];
    $size_onesize_kr = xssEncode($size_onesize_kr);
    $size_onesize_kr_str = " SIZE_ONESIZE_KR = '".$size_onesize_kr."',";

    $size_a1_en = $_POST['size_a1_en'];
    $size_a1_en = xssEncode($size_a1_en);
    $size_a1_en_str = " SIZE_A1_EN = '".$size_a1_en."',";

    $size_a2_en = $_POST['size_a2_en'];
    $size_a2_en = xssEncode($size_a2_en);
    $size_a2_en_str = " SIZE_A2_EN = '".$size_a2_en."',";

    $size_a3_en = $_POST['size_a3_en'];
    $size_a3_en = xssEncode($size_a3_en);
    $size_a3_en_str = " SIZE_A3_EN = '".$size_a3_en."',";

    $size_a4_en = $_POST['size_a4_en'];
    $size_a4_en = xssEncode($size_a4_en);
    $size_a4_en_str = " SIZE_A4_EN = '".$size_a4_en."',";

    $size_a5_en = $_POST['size_a5_en'];
    $size_a5_en = xssEncode($size_a5_en);
    $size_a5_en_str = " SIZE_A5_EN = '".$size_a5_en."',";

    $size_onesize_en = $_POST['size_onesize_en'];
    $size_onesize_en = xssEncode($size_onesize_en);
    $size_onesize_en_str = " SIZE_ONESIZE_EN = '".$size_onesize_en."',";

    $size_a1_cn = $_POST['size_a1_cn'];
    $size_a1_cn = xssEncode($size_a1_cn);
    $size_a1_cn_str = " SIZE_A1_CN = '".$size_a1_cn."',";

    $size_a2_cn = $_POST['size_a2_cn'];
    $size_a2_cn = xssEncode($size_a2_cn);
    $size_a2_cn_str = " SIZE_A2_CN = '".$size_a2_cn."',";

    $size_a3_cn = $_POST['size_a3_cn'];
    $size_a3_cn = xssEncode($size_a3_cn);
    $size_a3_cn_str = " SIZE_A3_CN = '".$size_a3_cn."',";


    $size_a4_cn = $_POST['size_a4_cn'];
    $size_a4_cn = xssEncode($size_a4_cn);
    $size_a4_cn_str = " SIZE_A4_CN = '".$size_a4_cn."',";

    $size_a5_cn = $_POST['size_a5_cn'];
    $size_a5_cn = xssEncode($size_a5_cn);
    $size_a5_cn_str = " SIZE_A5_CN = '".$size_a5_cn."',";

    $size_onesize_cn = $_POST['size_onesize_cn'];
    $size_onesize_cn = xssEncode($size_onesize_cn);
    $size_onesize_cn_str = " SIZE_ONESIZE_CN = '".$size_onesize_cn."',";
    
    $care_dsn_kr = $_POST['care_dsn_kr'];
    $care_dsn_kr = str_replace("<p>&nbsp;</p>","",$care_dsn_kr);
    $care_dsn_kr_str = '';
    if ($care_dsn_kr != null) {
        $care_dsn_kr_str = " CARE_DSN_KR = '".$care_dsn_kr."',";
    }
    else{
        $care_dsn_kr_str = " CARE_DSN_KR = NULL,";
    }

    $care_dsn_en = $_POST['care_dsn_en'];
    $care_dsn_en = str_replace("<p>&nbsp;</p>","",$care_dsn_en);
    $care_dsn_en_str = '';
    if ($care_dsn_en != null) {
        $care_dsn_en_str = " CARE_DSN_EN = '".$care_dsn_en."',";
        
    }
    else{
        $care_dsn_en_str = " CARE_DSN_EN = NULL,";
    }

    $care_dsn_cn = $_POST['care_dsn_cn'];
    $care_dsn_cn = str_replace("<p>&nbsp;</p>","",$care_dsn_cn);
    $care_dsn_cn_str = '';
    if ($care_dsn_cn != null) {
        $care_dsn_cn_str = " CARE_DSN_CN = '".$care_dsn_cn."',";
    }
    else{
        $care_dsn_cn_str = " CARE_DSN_CN = NULL,";
    }

    $detail_kr = $_POST['detail_kr'];
    $detail_kr = str_replace("<p>&nbsp;</p>","",$detail_kr);
    $detail_kr_str = '';
    if ($detail_kr != null) {
        $detail_kr_str = " DETAIL_KR = '".$detail_kr."',";
    }
    else{
        $detail_kr_str = " DETAIL_KR = NULL,";
    }

    $detail_en = $_POST['detail_en'];
    $detail_en = str_replace("<p>&nbsp;</p>","",$detail_en);
    $detail_en_str = '';
    if ($detail_en != null) {
        $detail_en_str = " DETAIL_EN = '".$detail_en."',";
    }
    else{
        $detail_en_str = " DETAIL_EN = NULL,";
    }

    $detail_cn = $_POST['detail_cn'];
    $detail_cn = str_replace("<p>&nbsp;</p>","",$detail_cn);
    $detail_cn_str = '';
    if ($detail_cn != null) {
        $detail_cn_str = " DETAIL_CN = '".$detail_cn."',";
    }
    else{
        $detail_cn_str = " DETAIL_CN = NULL,";
    }

    $db->begin_transaction();

    try{
        //검색 유형 - 디폴트
        $sql = 	"UPDATE
                    dev.ORDERSHEET_MST
                SET
                    ".$wkla_idx_str."
                    ".$model_str."
                    ".$model_wear_str."
                    ".$size_a1_kr_str."
                    ".$size_a2_kr_str."
                    ".$size_a3_kr_str."
                    ".$size_a4_kr_str."
                    ".$size_a5_kr_str."
                    ".$size_onesize_kr_str."
                    ".$size_a1_en_str."
                    ".$size_a2_en_str."
                    ".$size_a3_en_str."
                    ".$size_a4_en_str."
                    ".$size_a5_en_str."
                    ".$size_onesize_en_str."
                    ".$size_a1_cn_str."
                    ".$size_a2_cn_str."
                    ".$size_a3_cn_str."
                    ".$size_a4_cn_str."
                    ".$size_a5_cn_str."
                    ".$size_onesize_cn_str."
                    ".$care_dsn_kr_str."
                    ".$care_dsn_en_str."
                    ".$care_dsn_cn_str."
                    ".$detail_kr_str."
                    ".$detail_en_str."
                    ".$detail_cn_str."
                    
                    UPDATE_DATE = NOW(),
                    UPDATER = 'Admin'
                WHERE
                    IDX = ".$ordersheet_idx."
        ";
       
        $db->query($sql);
        $update_row_cnt = $db->mysqli_affected_rows();

        if($update_row_cnt > 0){
            //ORDERSHEET_OPTION 수정 처리
            $column_sql = '';
            $value_sql  = '';
            
            $db->query('DELETE FROM dev.ORDERSHEET_OPTION WHERE ORDERSHEET_IDX = '.$ordersheet_idx);
			
			if($size_category != null){
                for($i=0; $i<count($option_name); $i++){
                    $option_size_1_val = strlen($option_size_1[$i]) > 0 ? $option_size_1[$i] : 'NULL';
                    $option_size_2_val = strlen($option_size_2[$i]) > 0 ? $option_size_2[$i] : 'NULL';
                    $option_size_3_val = strlen($option_size_3[$i]) > 0 ? $option_size_3[$i] : 'NULL';
                    $option_size_4_val = strlen($option_size_4[$i]) > 0 ? $option_size_4[$i] : 'NULL';
                    $option_size_5_val = strlen($option_size_5[$i]) > 0 ? $option_size_5[$i] : 'NULL';
                    $option_size_6_val = strlen($option_size_6[$i]) > 0 ? $option_size_6[$i] : 'NULL';
                    $sql = "
                        INSERT INTO dev.ORDERSHEET_OPTION (
                            ORDERSHEET_IDX,
                            PRODUCT_CODE,
                            BARCODE,
                            OPTION_NAME,
                            OPTION_SIZE_1,
                            OPTION_SIZE_2,
                            OPTION_SIZE_3,
                            OPTION_SIZE_4,
                            OPTION_SIZE_5,
                            OPTION_SIZE_6,
                            SIZE_CATEGORY,
                            CREATE_DATE,
                            CREATER,
                            UPDATE_DATE,
                            UPDATER
                        )
                        VALUE
                        (
                            ".$ordersheet_idx.",
                            '".$product_code."',
                            '".$product_code.$size_code[$i]."',
                            '".$option_name[$i]."',
                            ".$option_size_1_val.",
                            ".$option_size_2_val.",
                            ".$option_size_3_val.",
                            ".$option_size_4_val.",
                            ".$option_size_5_val.",
                            ".$option_size_6_val.",
                            '".$size_category."',
                            NOW(),
                            'Admin',
                            NOW(),
                            'Admin'
                        )
                    ";
                    $db->query($sql);
                }
            
                //ORDERSHEET_HISTORY 등록처리
                $action_type = '';
                $action_name = '';
                if($db->count("dev.ORDERSHEET_HISTORY","ORDERSHEET_IDX = ".$ordersheet_idx." AND ORDERSHEET_AUTH = 'DSN'") > 0){
                    $action_type = 'U';
                    $action_name = "수정";
                }
                else{
                    $action_type = 'W';
                    $action_name = "등록";
                }
                
                $history_sql = "
                    INSERT INTO dev.ORDERSHEET_HISTORY
                    (	
                        ORDERSHEET_IDX,
                        ORDERSHEET_AUTH,
                        ACTION_TYPE,
                        PRODUCT_CODE,
                        PRODUCT_NAME,
                        HISTORY_MSG,
                        CREATE_DATE,
                        CREATER
                    )
                    VALUES
                    (
                        ".$ordersheet_idx.",
                        'DSN',
                        '".$action_type."',
                        '".$product_code."',
                        '".$product_name."',
                        '[".$product_code."] ".$product_name."의 오더시트 디자인 ".$action_name."이 완료되었습니다.',
                        NOW(),
                        'Admin'
                    )
                ";
                $db->query($history_sql);
            }
            $db->commit();
        }
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $msg = "수정작업에 실패했습니다.";
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '오더시트 정보를 얻는데 실패했습니다.';
}

function xssEncode($value){
    $value = str_replace("&","&amp;",$value);
    $value = str_replace("\"","&quot;",$value);
    $value = str_replace("'","&apos;",$value);
    $value = str_replace("<","&lt;",$value);
    $value = str_replace(">","&gt;",$value);
    $value = str_replace("\r","<br>",$value);
    $value = str_replace("\n","<p>",$value);

    return $value;
}
?>