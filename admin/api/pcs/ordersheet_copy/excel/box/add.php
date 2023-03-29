<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-박스 등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$sheet_str			= $_POST['sheet_data'];
$sheet_data			= json_decode($sheet_str, true);
$box_sheet			= $sheet_data['box_sheet'];

$insert_column_arr = array();
$box_true = array();     //상품옵션 등록 성공
$box_false = array();    //상품옵션 등록 실패

date_default_timezone_set('Asia/Seoul');

if ($box_sheet != NULL && count($box_sheet) != 0) {
    $excel_start_row = 2;

    $db->begin_transaction();
    try {
        foreach ($box_sheet as $key => $val) {
            /*
            0~5 : box coloum
            $val[0] :     BOX_TYPE
            $val[1] :     BOX_NAME
            $val[3] :     BOX_WIDTH
            $val[2] :     BOX_LENGTH
            $val[4] :     BOX_HEIGHT
            $val[5] :     BOX_VOLUME
            */

            $box_type = NULL;
            $box_type = $val[0];

            $box_name = NULL;
            $box_name = $val[1];

            $exist_box_cnt = -1;
            if($box_type != NULL && $box_name != NULL){
                $exist_box_cnt = $db->count('BOX_INFO', 'BOX_TYPE = "'.$box_type.'" AND BOX_NAME = "'.$box_name.'" ');
            }
        
            //insert
            if($exist_box_cnt == 0){
                $box_width = NULL;
                $box_width_arr = array();
                $box_width = $val[2];
                if($box_width != NULL){
                    $box_width_arr[0] = ' BOX_WIDTH, ';
                    $box_width_arr[1] = ' '.$box_width.', ';
                }

                $box_length = NULL;
                $box_length_arr = array();
                $box_length = $val[3];
                if($box_length != NULL){
                    $box_length_arr[0] = ' BOX_LENGTH, ';
                    $box_length_arr[1] = ' '.$box_length.', ';
                }

                $box_height = NULL;
                $box_height_arr = array();
                $box_height = $val[4];
                if($box_height != NULL){
                    $box_height_arr[0] = ' BOX_HEIGHT, ';
                    $box_height_arr[1] = ' '.$box_height.', ';
                }

                $box_volume = NULL;
                $box_volume_arr = array();
                $box_volume = $val[5];
                if($box_volume != NULL){
                    $box_volume_arr[0] = ' BOX_VOLUME, ';
                    $box_volume_arr[1] = ' '.$box_volume.', ';
                }


                $regist_box_sql = "
                    INSERT INTO
						BOX_INFO
                    (
                        ".$box_width_arr[0]."
                        ".$box_length_arr[0]."
                        ".$box_height_arr[0]."
                        ".$box_volume_arr[0]."
                        BOX_TYPE,
                        BOX_NAME
                    ) VALUES (
                        ".$box_width_arr[1]."
                        ".$box_length_arr[1]."
                        ".$box_height_arr[1]."
                        ".$box_volume_arr[1]."
                        '".$box_type."',
                        '".$box_name."'
                    )
                ";
                $db->query($regist_box_sql);

                $box_idx = NULL;
                $box_idx = $db->last_id();

                //오더시트 등록 실패시 롤백
                if(empty($box_idx) || $box_idx == NULL){
                    $json_result['code']    = 301;
                    $json_result['msg']     = '박스 등록에 실패 했습니다. 박스 정보를 다시한번 확인해주세요';
                    $db->rollback();
                    return $json_result;
                }
            }
        }

        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '박스 등록작업이 실패했습니다.';
        return $json_result;
    }
}
else{
    $json_result['code']    = 301;
    $json_result['msg']     = '빈 시트입니다. 파일을 다시 확인해주세요';
    return $json_result;
}

?>