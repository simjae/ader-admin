<?php
/*
 +=============================================================================
 | 
 | 바우처 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.01.10
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/


$member_idx = NULL;
if(!isset($_SESSION['MEMBER_IDX'])){
    $json_result['code'] = 304;
    $json_result['msg'] = '비로그인 상태입니다.';
} 
else {
    $member_idx = $_SESSION['MEMBER_IDX'];
    
    $member_id = null;
    if (isset($_SESSION['MEMBER_ID'])) {
        $member_id = $_SESSION['MEMBER_ID'];
    }

    $country = null;
    if (isset($_POST['country'])) {
        $country = $_POST['country'];
    }

    $voucher_issue_code = null;
    if (isset($_POST['voucher_issue_code'])) {
        $voucher_issue_code = $_POST['voucher_issue_code'];
    }

    if ($country != null && $member_idx != null && $voucher_issue_code != null) {
        $verify_sql = "
            SELECT 
                VI.IDX,
                VI.VOUCHER_ADD_DATE,
                VM.VOUCHER_TYPE,
                VM.MEMBER_LEVEL,
                (CASE WHEN 
                    VM.VOUCHER_END_DATE < NOW()
                THEN 
                    FALSE
                ELSE
                    TRUE
                END) ISSUE_DATE_FLG,
                MEMBER.MEMBER_ID,
                MEMBER.LEVEL_IDX,
                ML.TITLE
            FROM
                dev.VOUCHER_ISSUE   VI
            LEFT JOIN
                dev.VOUCHER_MST     VM
            ON
                VI.VOUCHER_IDX = VM.IDX
            LEFT JOIN
                dev.MEMBER_".$country." MEMBER
            ON
                VI.MEMBER_IDX = MEMBER.IDX
            LEFT JOIN
                dev.MEMBER_LEVEL ML
            ON
                MEMBER.LEVEL_IDX = ML.IDX
            WHERE
                VOUCHER_ISSUE_CODE = '".$voucher_issue_code."'
        ";
        $db->query($verify_sql);
        $exist_flg = 0;
        $error_msg = null;
        
        foreach($db->fetch() as $verify_data){
            $exist_flg = 1;

            if($verify_data['VOUCHER_ADD_DATE'] != NULL){
                $error_msg = '이미 등록된 바우처입니다.';
                break;
            }
            if($verify_data['ISSUE_DATE_FLG'] == FALSE){
                $error_msg = "바우처 기한이 만료 되었습니다.";
                break;
            }
            if($verify_data['MEMBER_LEVEL'] != 'ALL'){
                if(!strpos($verify_data['MEMBER_LEVEL'], strval($verify_data['LEVEL_IDX']))){
                    $error_msg = "바우처 대상 회원등급이 아닙니다.";
                    break;
                }
            }
            if($verify_data['VOUCHER_TYPE'] != 'OFF'){
                if($verify_data['MEMBER_ID'] != $member_id){
                    $error_msg = "바우처 대상 대상회원이 아닙니다.";
                    break;
                }
            }
        }
        if($exist_flg == 1 && $error_msg == null){
            $sql = "
                UPDATE 
                    dev.VOUCHER_ISSUE VI, 
                    dev.VOUCHER_MST VM
                SET       
                    VI.MEMBER_IDX = ".$member_idx.",
                    VI.MEMBER_ID = '".$member_id."',
                    VI.COUNTRY = '".$country."',
                    VI.VOUCHER_ADD_DATE = NOW(),
                    VI.USABLE_START_DATE = 
                        CASE WHEN 
                            VM.VOUCHER_DATE_TYPE = 'FXD' 
                        THEN 
                            VM.VOUCHER_START_DATE 
                        WHEN 
                            VM.VOUCHER_DATE_TYPE = 'PRD' 
                        THEN 
                            NOW() 
                        END, 
                    VI.USABLE_END_DATE = 
                        CASE WHEN 
                            VM.VOUCHER_DATE_TYPE = 'FXD' 
                        THEN 
                            VM.VOUCHER_END_DATE 
                        WHEN 
                            VM.VOUCHER_DATE_TYPE = 'PRD' 
                        THEN 
                            NOW() + INTERVAL VM.VOUCHER_DATE_PARAM DAY  
                        END,
                    VI.UPDATE_DATE = NOW(),
                    VI.UPDATER = '".$member_id."'
                WHERE  
                    VI.VOUCHER_IDX = VM.IDX
                AND
                    VI.VOUCHER_ISSUE_CODE = '".$voucher_issue_code."';
            ";
            $db->query($sql);
            $json_result['data'] = array('update_cnt' => $db->mysqli_affected_rows());
        }
        else{
            $json_result['code'] = 301;
            if($exist_flg == 0){
                $json_result['msg'] = '존재하지 않는 바우처 코드입니다'; 
            }
            else{
                $json_result['msg'] = $error_msg;
            }
        }
    }
    else{
        $json_result['code'] = 300;
        $json_result['msg'] = '바우처 등록 API를 실행하지 못했습니다.';
    }
}


?>