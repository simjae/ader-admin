<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-개인결제 상품 등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");
$session_id		= sessionCheck();
/** 변수 정리 **/
$sheet_str = $_POST['sheet_data'];
$sheet_data = json_decode($sheet_str, true);
$independent_sheet   = $sheet_data['independent_sheet'];

$independent_true = array();
$independent_false = array();

date_default_timezone_set('Asia/Seoul');

if($independent_sheet != null && count($independent_sheet) != 0){
    $excel_start_row = 2;
    $success_cnt = 0;
    $db->begin_transaction();
    try {
        foreach($independent_sheet as $key=>$val){
            //$val[0] : 개인결제 상품명
            //$val[1] : 한국몰 판매가격
            //$val[2] : 영문몰 판매가격
            //$val[3] : 중국몰 판매가격
            
            if($val[0] != null){
                
                $sql = "
                        INSERT INTO ORDERSHEET_MST ( 
                            STYLE_CODE,
                            COLOR_CODE,
                            PRODUCT_CODE,
                            PRODUCT_NAME,
                            CREATER,
                            UPDATER
                        )
                        VALUES (
                            'XXXXXXXXX',
                            'XX',
                            'XXXXXXXXXXX',
                            '".$val[0]."',
                            '".$session_id."',
                            '".$session_id."'
                        )
                ";
                $db->query($sql);
                $ordersheet_idx = $db->last_id();
    
                if (!empty($ordersheet_idx)) {
                    $action_type = 'W';
                    $action_name = "등록";
                    
                    $history_sql = "
                        INSERT INTO ORDERSHEET_HISTORY
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
                            '',
                            '".$action_type."',
                            'XXXXXXXXXXX',
                            '".$product_name."',
                            '[개인결제용] ".$product_name."의 오더시트 ".$action_name."이 완료되었습니다.',
                            NOW(),
                            '".$session_id."'
                        )
                    ";
                    $db->query($history_sql);
                    
                    $sql = "
                        INSERT INTO SHOP_PRODUCT (
                            ORDERSHEET_IDX,
                            STYLE_CODE,
                            COLOR_CODE,
                            PRODUCT_CODE,
                            PRODUCT_NAME,
                            SALES_PRICE_KR,
                            SALES_PRICE_EN,
                            SALES_PRICE_CN,
                            INDP_FLG,
                            CREATER,
                            UPDATER
                        )
                        SELECT
                            IDX,
                            STYLE_CODE,
                            COLOR_CODE,
                            PRODUCT_CODE,
                            PRODUCT_NAME,
                            ".((!isset($val[1])||strlen($val[1])==0)?0:$val[1]).",
                            ".((!isset($val[2])||strlen($val[2])==0)?0:$val[2]).",
                            ".((!isset($val[3])||strlen($val[3])==0)?0:$val[3]).",
                            TRUE,
                            '".$session_id."',
                            '".$session_id."'
                        FROM
                            ORDERSHEET_MST
                        WHERE
                            IDX = ".$ordersheet_idx."
                    ";
                    $db->query($sql);
                    $product_idx = $db->last_id();

                    if (!empty($product_idx)) {
                        $success_cnt++;
                        //array_push($independent_true, array('product_name' => $val[0], 'row_num' => $key + $excel_start_row));
                    }
                    else{
                        $json_result['code'] = 301;
                        $db->rollback();
                        $json_result['msg'] = "등록작업에 실패했습니다.";
                        return $json_result;
                        //array_push($independent_false, array('product_name' => $val[0], 'row_num' => $key + $excel_start_row, "reason" => "개인결제 상품등록에 실패했습니다."));
                    }
                }
            }
            $db->commit();
            $json_result['data']['success']      = $success_cnt;
            //$json_result['result']['independent']['false']     = $relevant_false; 
        }
    }
    catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 303;
		$db->rollback();
		$json_result['msg'] = "등록작업에 실패했습니다.";
        return $json_result;
	}
}
else{
    $json_result['code'] = 301;
    $db->rollback();
    $json_result['msg'] = "빈 시트입니다. 파일을 다시 확인해주세요";
    return $json_result;
}

?>