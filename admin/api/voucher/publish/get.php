<?php
/*
 +=============================================================================
 | 
 | 단일 발행 바우처 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$voucher_idx    = $_POST['voucher_idx'];        //선택 바우처 IDX

// 단일 바우처 정보
$sql = "SELECT
            IDX,
            COUNTRY,
            ON_OFF_TYPE,
            VOUCHER_TYPE,
            VOUCHER_CODE,
            VOUCHER_NAME,
            ISSUE_START_DATE,
            ISSUE_END_DATE,
            (CASE   
                WHEN DATE(ISSUE_START_DATE) > CURDATE()
                THEN '발행예정'
                WHEN DATE(ISSUE_START_DATE) <= CURDATE() AND
                     DATE(ISSUE_END_DATE) >= CURDATE()
                THEN '발행가능'
                WHEN DATE(ISSUE_END_DATE) < CURDATE()
                THEN '발행종료'
             END) AS VOUCHER_STATUS,
            VOUCHER_DATE_TYPE,
            VOUCHER_DATE_PARAM,
            VOUCHER_START_DATE,
            VOUCHER_END_DATE,
            MIN_PRICE,
            SALE_TYPE,
            SALE_PRICE,
            DESCRIPTION,
            MILEAGE_FLG,
            MEMBER_LEVEL,
            TOT_ISSUE_NUM,
            CREATE_DATE,
            CREATER,
            UPDATE_DATE,
            UPDATER
		FROM
            dev.VOUCHER_MST
		WHERE
            IDX = ".$voucher_idx." ";

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'                    =>intval($data['IDX']),
        'country'               =>$data['COUNTRY'],
        'on_off_type'           =>$data['ON_OFF_TYPE'],
		'voucher_type'          =>$data['VOUCHER_TYPE'],
        'voucher_code'          =>$data['VOUCHER_CODE'],
        'voucher_name'          =>$data['VOUCHER_NAME'],
        'issue_start_date'      =>$data['ISSUE_START_DATE'],
        'issue_end_date'        =>$data['ISSUE_END_DATE'],
        'voucher_status'        =>$data['VOUCHER_STATUS'],
        'voucher_date_type'     =>$data['VOUCHER_DATE_TYPE'],
        'voucher_date_param'    =>$data['VOUCHER_DATE_PARAM'],
        'voucher_start_date'    =>$data['VOUCHER_START_DATE'],
        'voucher_end_date'      =>$data['VOUCHER_END_DATE'],
        'min_price'             =>$data['MIN_PRICE'],
        'sale_type'             =>$data['SALE_TYPE'],
        'sale_price'            =>$data['SALE_PRICE'],
        'description'           =>$data['DESCRIPTION'],
        'mileage_flg'           =>$data['MILEAGE_FLG'],
        'member_level'          =>$data['MEMBER_LEVEL'],
        'tot_issue_num'         =>$data['TOT_ISSUE_NUM'],
        'create_date'           =>$data['CREATE_DATE'],
        'creater'               =>$data['CREATER'],
        'update_date'           =>$data['UPDATE_DATE'],
        'updater'               =>$data['UPDATER']
	);
}
?>