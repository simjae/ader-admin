<?php
/*
 +=============================================================================
 | 
 | 마일리지 등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");
$session_id		= sessionCheck();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$sheet_str          = $_POST['sheet_data'];
$country            = $_POST['country'];
$mileage_action     = $_POST['mileage_action'];
$mileage_value      = $_POST['mileage_value'];


$sheet_data = json_decode($sheet_str, true);
$mileage_sheet = $sheet_data['mileage_sheet'];

date_default_timezone_set('Asia/Seoul');

$db->begin_transaction();
try {
    if($mileage_sheet != NULL && count($mileage_sheet) != 0) {
        $success_cnt = 0;
        foreach ($mileage_sheet as $key => $val) {
            
            /*
            $val[0] :     MEMBER_ID
            */
            if($val[0] != null && strlen($val[0]) > 0){
                $member_exist_cnt = $db->count('MEMBER_'.$country, 'MEMBER_ID = "'.$val[0].'" ');

                if($member_exist_cnt > 0){
                    $get_recent_balance_sql = "
                        SELECT
                            MILEAGE_BALANCE
                        FROM
                            MILEAGE_INFO
                        WHERE
                            COUNTRY = '".$country."'
                        AND
                            ID = '".$val[0]."'
                        ORDER BY 
                            IDX DESC
                        LIMIT 1
                    ";

                    $recent_mileage_balance = 0;
                    $db->query($get_recent_balance_sql);
                    foreach($db->fetch() as $data){
                        $recent_mileage_balance = $data['MILEAGE_BALANCE'];
                    }
                    $recent_mileage_balance = intval($recent_mileage_balance);

                    $mileage_usable_arr = array();
                    if($mileage_action == 'ADD'){
                        $mileage_usable_arr[0] = 'MILEAGE_USABLE_INC';
                        $mileage_usable_arr[1] = $mileage_value;

                        $recent_mileage_balance += intval($mileage_value);
                    }
                    else if($mileage_action == 'SUBTRACT'){
                        $mileage_usable_arr[0] = 'MILEAGE_USABLE_DEC';
                        $mileage_usable_arr[1] = $mileage_value;

                        $recent_mileage_balance -= intval($mileage_value);
                    }

                    $regist_query = " 
                        INSERT INTO MILEAGE_INFO
                        (   
                            COUNTRY,
                            MEMBER_IDX,
                            ID,
                            MILEAGE_CODE,
                            ".$mileage_usable_arr[0].",
                            MILEAGE_BALANCE,
                            CREATER,
                            UPDATER
                        )
                        SELECT
                            '".$country."',
                            IDX,
                            MEMBER_ID,
                            'AM',
                            ".$mileage_usable_arr[1].",
                            ".$recent_mileage_balance.",
                            '".$session_id."',
                            '".$session_id."'
                        FROM
                            MEMBER_".$country."
                        WHERE
                            MEMBER_ID = '".$val[0]."'
                    ";
                    $db->query($regist_query);

                    $mileage_idx = $db->last_id();
                    if(!empty($mileage_idx)){
                        $success_cnt++;
                    }
                    else{
                        $json_result['code'] = 301;
                        $json_result['msg'] = '마일리지 등록에 실패했습니다.';
                        $db->rollback();
                        return $json_result;
                    }
                }
                else{
                    $json_result['code'] = 301;
                    $json_result['msg'] = '존재하지 않는 회원입니다. 시트를 수정해주세요';
                    $db->rollback();
                    return $json_result;
                }
            }
        }
        $json_result['data']['success'] = $success_cnt;
        $db->commit();
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = '시트가 비어있습니다. 파일을 다시 확인해주세요';
        $db->rollback();
        return $json_result;  
    }
}
catch(mysqli_sql_exception $exception){
    print_r($exception);
    $json_result['code'] = 301;
    $db->rollback();
    $json_result['msg'] = '마일리지 등록작업이 실패했습니다.';
    return $json_result;
}



?>