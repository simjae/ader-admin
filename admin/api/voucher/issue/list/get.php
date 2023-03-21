<?php
/*
 +=============================================================================
 | 
 | 바우처 발급회원 목록
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
$voucher_idx            = $_POST['voucher_idx'];        //선택 바우처 IDX
$country                = $_POST['country'];

$member_id              = $_POST['member_id'];
$member_name            = $_POST['member_name'];
$issue_member_level     = $_POST['issue_member_level'];
$used_flg               = $_POST['used_flg'];
$regist_flg             = $_POST['regist_flg'];

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_value = $_POST['sort_value'];				//정렬 기준값
$sort_type = $_POST['sort_type'];				//정렬타입

$tables = ' VOUCHER_ISSUE   AS VI   LEFT JOIN
            MEMBER_'.$country.' AS MEMBER
        ON  VI.MEMBER_IDX = MEMBER.IDX ';
/** 검색 조건 **/
$where = '  VI.DEL_FLG = FALSE   AND
            VI.VOUCHER_IDX = '.$voucher_idx.' ';
$cnt_where = $where;

if($member_id != null){
    $where .= ' AND (VI.MEMBER_ID LIKE "%'.$member_id.'%") ';
}

if($member_name != null){
    $where .= ' AND (MEMBER.MEMBER_NAME LIKE "%'.$member_name.'%") ';
}

if($issue_member_level != null && $issue_member_level != 'ALL'){
    $where .= ' AND (MEMBER.LEVEL_IDX = '.$issue_member_level.') ';
}

if($used_flg != null && $used_flg != 'ALL'){
    $where .= ' AND (VI.USED_FLG = '.$used_flg.') ';
}

if($regist_flg != null && $regist_flg != 'ALL'){
    if($regist_flg == 'TRUE'){
        $where .= ' AND (VI.VOUCHER_ADD_DATE IS NOT NULL) ';
    }
    else if($regist_flg == 'FALSE'){
        $where .= ' AND (VI.VOUCHER_ADD_DATE IS NULL) ';
    }
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' VI.IDX DESC ';
}

/** DB 처리 **/
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;


// 바우처 발급정보
$select_voucher_issue_sql = "
	SELECT
		VI.IDX,
		VI.COUNTRY,
		VI.VOUCHER_IDX,
		VI.VOUCHER_ISSUE_CODE,
		IFNULL(VI.VOUCHER_ADD_DATE,'-') AS VOUCHER_ADD_DATE,
		VI.USED_FLG,
		IFNULL(VI.USABLE_START_DATE,'') AS USABLE_START_DATE,
		IFNULL(VI.USABLE_END_DATE,'') AS USABLE_END_DATE,
		VI.MEMBER_IDX,
		MEMBER.TEL_MOBILE,
		IFNULL(VI.MEMBER_ID,'-') AS MEMBER_ID,
		IFNULL(MEMBER.MEMBER_NAME,'-') AS MEMBER_NAME,
		IFNULL((SELECT TITLE FROM MEMBER_LEVEL WHERE IDX = MEMBER.LEVEL_IDX),'-') AS MEMBER_LEVEL,
		VI.DEL_FLG,
		VI.CREATE_DATE,
		VI.CREATER,
		VI.UPDATE_DATE,
		VI.UPDATER
	FROM
		".$tables."
	WHERE
		".$where."
	ORDER BY
		".$order."
	LIMIT
		".$limit_start.",".$rows."
";

$db->query($select_voucher_issue_sql);

foreach($db->fetch() as $data){
    $json_result['data'][] = array(
        'num'                   =>$total_cnt--,
        'no'                    =>$data['IDX'],
        'country'               =>$data['COUNTRY'],
        'voucher_idx'           =>$data['VOUCHER_IDX'],
        'voucher_issue_code'    =>$data['VOUCHER_ISSUE_CODE'],
        'voucher_add_date'      =>$data['VOUCHER_ADD_DATE'], 
        'used_flg'              =>$data['USED_FLG'],
        'usable_start_date'    =>$data['USABLE_START_DATE'],
        'usable_end_date'      =>$data['USABLE_END_DATE'],
        'member_idx'            =>$data['MEMBER_IDX'],
        'tel_mobile'            =>$data['TEL_MOBILE'],
        'member_id'             =>$data['MEMBER_ID'],
        'member_name'           =>$data['MEMBER_NAME'],
        'member_level'          =>$data['MEMBER_LEVEL'],
        'del_flg'               =>$data['DEL_FLG'],
        'create_date'           =>$data['CREATE_DATE'],
        'creater'               =>$data['CREATER'],
        'update_date'           =>$data['UPDATE_DATE'],
        'updater'               =>$data['UPDATER'],
    );
}

?>