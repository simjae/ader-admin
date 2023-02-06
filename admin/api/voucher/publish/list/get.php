<?php
/*
 +=============================================================================
 | 
 | 회원 목록
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
$country        = $_POST['country'];            //검색 바우처 타입
$on_off_type    = $_POST['on_off_type'];        //검색 바우처 타입
$voucher_name   = $_POST['voucher_name'];       //검색 바우처 명
$voucher_type   = $_POST['voucher_type'];     //검색 바우처 상태
$voucher_status = $_POST['voucher_status'];     //검색 바우처 상태
$member_level   = $_POST['member_level'];       //검색 바우처 발행 멤버
$voucher_from   = $_POST['voucher_from'];       //검색 바우처 기간 검색 (시작일)
$voucher_to     = $_POST['voucher_to'];         //검색 바우처 기간 검색 (종료일)
$birth_voucher_month   = $_POST['birth_voucher_month'];      
$search_date    = $_POST['search_date'];        //검색 기간 검색 옵션

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_value = $_POST['sort_value'];				//정렬 기준값
$sort_type = $_POST['sort_type'];				//정렬타입

$tables = "dev.VOUCHER_MST";
/** 검색 조건 **/
$where = '  DEL_FLG = FALSE';
//$cnt_where = $where;

//바우처 타입
if ($voucher_type != null){
    if($voucher_type == 'BR'){
        $where .= ' AND VOUCHER_TYPE = "BR" ';
    }
    else {
        if($voucher_type == 'ALL'){
            $where .= ' AND VOUCHER_TYPE != "BR" ';
        }
        else{
            $where .= ' AND VOUCHER_TYPE = "'.$voucher_type.'" ';
        }
    }
}
$cnt_where = $where;

//바우처 타입
if ($country != null) {
	$where .= ' AND COUNTRY = "'.$country.'" ';
}

//바우처 타입
if ($on_off_type != null && $on_off_type != 'ALL') {
	$where .= ' AND ON_OFF_TYPE = "'.$on_off_type.'" ';
}



//바우처 명
if ($voucher_name != null) {
	$where .= ' AND VOUCHER_NAME LIKE "%'.$voucher_name.'%" ';
}

//바우처 상태 - 발급예정, 발급가능, 발급종료
if ($voucher_status != null) {
	switch($voucher_status){
        case 'PTI':
            $where .= ' AND (DATE(ISSUE_START_DATE)   > CURDATE()) ';
            break;
        case 'IVP':
            $where .= ' AND (DATE(ISSUE_START_DATE)   <= CURDATE() AND
                        DATE(ISSUE_END_DATE)      >= CURDATE()) ';
            break;
        case 'EIV':
            $where .= ' AND (DATE(ISSUE_END_DATE)     < CURDATE()) ';
            break;
	}
}

//바우처 발행가능 멤버
if ($member_level != null && $member_level != 'ALL') {
	$where .= ' AND MEMBER_LEVEL = '.$member_level.' ';
}

if ($voucher_from != null || $voucher_to != null) {
    $where .= ' AND (ISSUE_START_DATE <= "'.$voucher_from.'" AND
                    ISSUE_END_DATE >= "'.$voucher_to.'") ';
}

if ($birth_voucher_month != null) {
    $where .= ' AND ( ISSUE_START_DATE = "'.$birth_voucher_month.'-01") ';
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' IDX DESC ';
}

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

	//검색항목
$sql = "SELECT
            IDX,
            COUNTRY,
            ON_OFF_TYPE,
            VOUCHER_TYPE,
            VOUCHER_CODE,
            VOUCHER_NAME,
            IFNULL(ISSUE_START_DATE,'') AS ISSUE_START_DATE,
            IFNULL(ISSUE_END_DATE,'') AS ISSUE_END_DATE,
            (CASE   
                WHEN DATE(ISSUE_START_DATE) > CURDATE()
                THEN '발급 예정'
                WHEN DATE(ISSUE_START_DATE) <= CURDATE() AND
                     DATE(ISSUE_END_DATE) >= CURDATE()
                THEN '발급 가능'
                WHEN DATE(ISSUE_END_DATE) < CURDATE()
                THEN '발급 종료'
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
            ".$tables."
		WHERE
			".$where."
		ORDER BY
			".$order."
		LIMIT
			".$limit_start.",".$rows;

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
        'num'					=>$total_cnt--,
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