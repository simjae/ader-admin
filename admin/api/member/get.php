<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 2021.6.30
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$tab_num = $_POST['tab_num'];

$search_type = $_POST['search_type'];			//검색유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호, 휴면일자
$search_keyword = $_POST['search_keyword'];		//검색 키워드
$search_date = $_POST['search_date'];			//검색 일자

$sleep_from = $_POST['sleep_from'];				//휴면 처리일 - 시작일
$sleep_to = $_POST['sleep_to'];					//휴면 처리일 - 종료일

$member_level = $_POST['member_level'];			//멤버 그룹 - 일반회원, ADER family

$member_grade = $_POST['member_grade'];			//멤버 등급 - 불량회원, 특별관리회원

$day_type = $_POST['day_type'];					//가입일/생일
$day_from = $_POST['day_from'];					//가입일/생일 시작일
$day_to = $_POST['day_to'];						//가입일/생일 종료일

$min_age = $_POST['min_age'];					//나이 - 최소값
$max_age = $_POST['max_age'];					//나이 - 최대값

$gender = $_POST['gender'];						//성별

$login_from = $_POST['login_from'];				//접속일 - 시작일
$login_to = $_POST['login_to'];					//접속일 - 종료일

$login_ip = $_POST['login_ip'];					//접속IP

$min_login_cnt = $_POST['min_login_cnt'];		//로그인 횟수 - 최소값
$max_login_cnt = $_POST['max_login_cnt'];		//로그인 횟수 - 최대값

$min_check_cnt = $_POST['min_check_cnt'];		//출석 횟수 - 최소값
$max_check_cnt = $_POST['max_check_cnt'];		//출석 횟수 - 최대값

$receive_sms = $_POST['receive_sms'];			//SMS 수신 확인
$receive_email = $_POST['receive_email'];		//메일 수신 확인

$region = $_POST['region'];						//지역

$mileage_type = $_POST['mileage_type'];			//마일리지 타입
$min_mileage = $_POST['min_mileage'];			//마일리지 - 최소값
$max_mileage = $_POST['max_mileage'];			//마일리지 - 최대값

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_type = $_POST['sort_type'];				//정렬타입
$sort_value = $_POST['sort_value'];				//정렬 기준값

$tables = '
	'.$_TABLE['MEMBER'].' AS A
';

/** 검색 조건 **/
$where = '1=1';
$where_values = [];
	//멤버 상태 - 정상, 휴면, 정지, 퇴출, 탈퇴, 탈퇴신청
$status = "";
if ($tab_num != null) {
	if ($tab_num == 02) {
		$status = "휴면";
	} else {
		$status = "정상";
	}
}
$where .= " AND (A.STATUS LIKE '%".$status."%') ";

	//검색 유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호
if ($search_type != null) {
	if ($search_keyword != null) {
		switch ($search_type) {
			case 'name':
				$where .= ' AND (A.NAME LIKE "%'.$search_keyword.'%") ';
			break;
			
			case 'member_id':
				$where .= ' AND (A.ID LIKE "%'.$search_keyword.'%") ';
			break;
			
			case 'email':
				$where .= ' AND (A.EMAIL LIKE "%'.$search_keyword.'%") ';
			break;
			
			case 'tel':
				$where .= ' AND (A.TEL LIKE "%'.$search_keyword.'%") ';
			break;
			
			case 'mobile':
				$where .= ' AND (A.TEL_MOBILE LIKE "%'.$search_keyword.'%") ';
			break;
		}
	} else {
		if ($search_date != null) {
			switch ($search_date) {
				case "today" :
					$where .= ' AND (A.SLEEP_DATE = CURDATE()) ';
					break;
				
				case "01d" :
					$where .= ' AND (A.SLEEP_DATE = (CURDATE() - INTERVAL 1 DAY)) ';
					break;
				
				case "03d" :
					$where .= ' AND (A.SLEEP_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
					break;
				
				case "07d" :
					$where .= ' AND (A.SLEEP_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
					break;
				
				case "15d" :
					$where .= ' AND (A.SLEEP_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
					break;
				
				case "01m" :
					$where .= ' AND (A.SLEEP_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
					break;
				
				case "03m" :
					$where .= ' AND (A.SLEEP_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
					break;
			}
		} else if ($sleep_from != null && $sleep_to != null) {
			$where .= " AND (A.SLEEP_DATE BETWEEN '".$sleep_from."' AND '".$sleep_to."') ";
		}
	}
}

	//멤버 그룹 - 일반회원, ADER family
if ($member_level != null && $member_level != 'all') {
	$where .= ' AND (A.LEVEL LIKE "%'.$member_level.'%") ';
}

	//멤버 등급 - 불량회원, 특별관리회원
if ($member_grade != null && $member_grade != 'all') {
	$where .= ' AND (A.GRADE LIKE "%'.$member_grade.'%") ';
}

	//가입일/생일
if ($day_type != null) {
	if ($day_type == '1') {
		$where .= " AND (A.JOIN_DATE BETWEEN '".$day_from."' AND '".$day_to."') ";
	} else if ($day_type == '2') {
		$where .= " AND (A.BIRTHDAY BETWEEN '".$day_from."' AND '".$day_to."') ";
	}
}

	//나이
if ($min_age != null || $max_age != null) {
	if ($min_age != null && $max_age == null) {
		$where .= ' AND (ROUND((TO_DAYS(NOW()) - (TO_DAYS(A.BIRTHDAY))) / 365) >= '.$min_age.') ';
	} else if ($min_age == null && $max_age != null) {
		$where .= ' AND (ROUND((TO_DAYS(NOW()) - (TO_DAYS(A.BIRTHDAY))) / 365) <= '.$max_age.') ';
	} else if ($min_age != null && $max_age != null) {
		$where .= ' AND (ROUND((TO_DAYS(NOW()) - (TO_DAYS(A.BIRTHDAY))) / 365) BETWEEN '.$min_age.' AND '.$max_age.') ';
	}
}

	//성별
if ($gender != null && $gender != 'all') {
	$where .= " AND (A.GENDER = '".$gender."') ";
}

	//접속일
if ($login_from != null && $login_to != null) {
	$where .= " AND (A.LOGIN_DATE BETWEEN '".$login_from."' AND '".$login_to."') ";
}

	//접속IP
if ($login_ip != null) {
	$where .= " AND (A.IP LIKE '%".$login_ip."%') ";
}

	//로그인 횟수
if ($min_login_cnt != null || $max_login_cnt != null) {
	if ($min_login_cnt != null && $max_login_cnt == null) {
		$where .= " AND (A.LOGIN_CNT >= ".$min_login_cnt.") ";
	} else if ($min_login_cnt == null && $max_login_cnt != null) {
		$where .= " AND (A.LOGIN_CNT <= ".$max_login_cnt.") ";
	} else if ($min_login_cnt != null && $max_login_cnt != null) {
		$where .= " AND (A.LOGIN_CNT BETWEEN ".$min_login_cnt." AND ".$max_login_cnt.") ";
	}
}

	//출석 횟수
if ($min_check_cnt != null || $max_check_cnt != null) {
	if ($min_check_cnt != null && $max_check_cnt == null) {
		$where .= " AND (A.CHECK_CNT >= ".$min_check_cnt.") ";
	} else if ($min_check_cnt == null && $max_check_cnt != null) {
		$where .= " AND (A.CHECK_CNT <= ".$max_check_cnt.") ";
	} else if ($min_check_cnt != null && $max_check_cnt != null) {
		$where .= " AND (A.CHECK_CNT BETWEEN ".$min_check_cnt." AND ".$max_check_cnt.") ";
	}
}

	//SMS 수신 확인
if ($receive_sms != null && $receive_sms != 'all') {
	$where .= " AND(A.RECEIVE_SMS = '".$receive_sms."') ";
}

	//메일 수신 확인
if ($receive_email != null && $receive_email != 'all') {
	$where .= " AND (A.RECEIVE_EMAIL = '".$receive_email."') ";
}

	//지역
if ($region != null && $region != 'all') {
	$where .= " AND (A.REGION LIKE '%".$region."%') ";
}

	//마일리지 타입
if ($mileage_type != null) {
	if ($min_mileage != null || $max_mileage != null) {
		if ($min_mileage != null && $max_mileage == null) {
			$where .= " AND (A.MILEAGE >= ".$min_mileage.") ";
		} else if ($min_mileage == null && $max_mileage != null) {
			$where .= " AND (A.MILEAGE >= ".$max_mileage.") ";
		} else if ($min_mileage != null && $max_mileage != null) {
			$where .= " AND (A.MILEAGE BETWEEN ".$min_mileage." AND ".$max_mileage.") ";
		}
	}
}

/** 정렬 조건 **/
$order = '';

switch ($sort_type) {
	case 'JOIN_DATE' :
		$sort_type = ' A.JOIN_DATE ';
	break;
	case 'ID' :
		$sort_type = ' A.ID ';
	break;
	case 'LEVEL' :
		$sort_type = ' A.LEVEL ';
	break;
	case 'GENDER' :
		$sort_type = ' A.GENDER ';
	break;
	case 'AGE' :
		$sort_type = ' A.AGE ';
	break;
	case 'REGION' :
		$sort_type = ' A.REGION ';
	break;
}

if ($sort_type != '') {
	$order .= $sort_type.$sort_value;
} else {
	$order = 'A.IDX DESC';
}

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

	//검색항목
$sql = "SELECT
			A.IDX,
			A.JOIN_DATE,
			A.SLEEP_DATE,
			A.NAME,
			A.ID,
			A.LEVEL,
			A.TEL,
			A.TEL_MOBILE,
			A.EMAIL,
			A.GENDER,
			ROUND((TO_DAYS(NOW()) - (TO_DAYS(A.BIRTHDAY))) / 365) AS AGE,
			A.REGION,
			'' AS ADDR,
			A.STATUS,
			A.RECEIVE_TEL,
			A.RECEIVE_SMS,
			A.RECEIVE_EMAIL,
			A.RECEIVE_PUSH,
			A.REMARK,
			'YYYY-MM-DD' AS ORDER_DATE,
			'00000000-0000000' AS ORDER_NUM,
			10 AS ORDER_CNT,
			'999999' AS ORDER_PRICE,
			99999999 AS ORDER_PRICE_TOTAL
		FROM
			".$tables."
		WHERE
			".$where."
		LIMIT
			".$limit_start.",".$rows;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'search_type'=>$search_type,
		'search_date'=>$search_date,
		'no'=>intval($data['IDX']),
		'num'=>$vno--,
		'join_date'=>$data['JOIN_DATE'],
		'sleep_date'=>$data['SLEEP_DATE'],
		'drop_date'=>$data['DROP_DATE'],
		'name'=>$data['NAME'],
		'id'=>$data['ID'],
		'level'=>$data['LEVEL'],
		'tel'=>$data['TEL'],
		'tel_mobile'=>$data['TEL_MOBILE'],
		'email'=>$data['EMAIL'],
		'gender'=>$data['GENDER'],
		'age'=>$data['AGE'],
		'region'=>$data['REGION'],
		'addr'=>$data['ADDR'],
		'status'=>$data['STATUS'],
		'receive'=>array(
			'email'=>($data['RECEIVE_EMAIL']=='Y') ? true:false,
			'sms'=>($data['RECEIVE_SMS']=='Y') ? true:false
		),
		'remark'=>$data['remark'],
		'order_date'=>$data['order_date'],
		'order_num'=>$data['order_num'],
		'order_cnt'=>$data['order_cnt'],
		'order_price'=>$data['order_price'],
		'order_price_total'=>$data['order_price_total']
	);
}
?>