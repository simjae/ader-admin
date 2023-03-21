<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country				= $_POST['country'];

$member_level			= $_POST['member_level'];
$search_type			= $_POST['search_type'];
$search_keyword			= $_POST['search_keyword'];
$qty_min				= $_POST['qty_min'];
$qty_max				= $_POST['qty_max'];
$price_min				= $_POST['price_min'];
$price_max				= $_POST['price_max'];
$display_flg			= $_POST['display_flg'];

$entry_start_date		= $_POST['entry_start_date'];
$entry_start_time		= $_POST['entry_start_time'];
$entry_end_date			= $_POST['entry_end_date'];
$entry_end_time			= $_POST['entry_end_time'];

$purchase_start_date	= $_POST['purchase_start_date'];
$purchase_start_time	= $_POST['purchase_start_time'];
$purchase_end_date		= $_POST['purchase_end_date'];
$purchase_end_time		= $_POST['purchase_end_time'];

$sort_type 				= $_POST['sort_type'];				//정렬 타입
$sort_value 			= $_POST['sort_value'];				//정렬 값

$rows					= $_POST['rows'];
$page					= $_POST['page'];

if ($entry_start_date != null) {
	if (isset($_POST['entry_start_time'])) {
		$entry_start_date = "'".$entry_start_date." ".$_POST['entry_start_time'].":00'";
	} else {
		$entry_start_date = "'".$entry_start_date." 00:00'";
	}
}

if ($entry_end_date != null){
	if (isset($_POST['entry_end_time'])) {
		$entry_end_date = "'".$entry_end_date." ".$_POST['entry_end_time'].":00'";
	} else {
		$entry_end_date = "'".$entry_end_date." 00:00'";
	}
}

if ($purchase_start_date != null) {
	if (isset($_POST['purchase_start_time'])) {
		$purchase_start_date = "'".$purchase_start_date." ".$_POST['purchase_start_time'].":00'";
	} else {
		$purchase_start_date = "'".$purchase_start_date." 00:00'";
	}
}

if ($purchase_end_date != null) {
	if (isset($_POST['purchase_end_time'])) {
		$purchase_end_date = "'".$purchase_end_date." ".$_POST['purchase_end_time'].":00'";
	} else {
		$purchase_end_date = "'" . $purchase_end_date . " 00:00'";
	}
}

//검색 유형 - 디폴트
$where = '1=1';
$where .= " AND (PS.COUNTRY = '".$country."') ";
$where .= ' AND (PS.DEL_FLG = FALSE) ';
$where_cnt = $where;

if ($member_level != null && $member_level != 'ALL') {
	$where .= " AND PS.MEMBER_LEVEL REGEXP '".$member_level."' ";
}

if ($search_type != null && $search_keyword != null) {
	$type_arr = array();
	for ($i=0; $i<count($search_type); $i++) {
		if (strlen($search_type[$i]) != 0) {
			array_push($type_arr,$search_type[$i]);
		}
	}
	
	$keyword_arr = array();
	for ($i=0; $i<count($search_keyword); $i++) {
		if (strlen($search_keyword[$i]) != 0) {
			array_push($keyword_arr,$search_keyword[$i]);
		}
	}
	
	if (count($type_arr) > 0 && count($keyword_arr) > 0) {
		$where .= " AND (";
		
		$tmp_where .= "";
		for ($i=0; $i<count($search_type); $i++) {
			$keyword_where = "";
			if ($search_type[$i] != null && $search_keyword[$i] != null) {
				if (strlen($tmp_where) > 0) {
					$tmp_where .= " AND ";
				}
				switch ($search_type[$i]) {
					case "name" :
						$keyword_where .= ' (PR.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "code" :
						$keyword_where .= ' (PR.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;
				}
				
				$tmp_where .= $keyword_where;
			}
		}
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}
}

if ($qty_min != null || $qty_max != null) {
	$where .= "
		AND (
				(
					SELECT
						SUM(S_QS.PRODUCT_QTY)
					FROM
						QTY_STANDBY S_QS
					WHERE
						S_QS.STANDBY_IDX = PS.IDX
				)
	";
	
	if ($qty_min != null && $qty_max == null) {
		$where .= " >= ".$qty_min;
	
	} else if ($qty_min == null && $qty_max != null) {
		$where .= " <= ".$qty_min;
		
	} else if ($qty_min != null && $qty_max != null) {
		$where .= " BETWEEN ".$qty_min." AND ".$qty_max;
	}
	
	$where .= "
		)
	";
}

if ($price_min != null || $price_max != null) {
	if ($price_min != null && $price_max == null) {
		$where .= " AND (PS.SALES_PRICE >= ".$price_min.") ";
	} else if ($price_min == null && $price_max != null) {
		$where .= " AND (PS.SALES_PRICE <= ".$price_max.") ";
	} else if ($price_min != null && $price_max != null) {
		$where .= " AND (PS.SALES_PRICE BETWEEN ".$price_min." AND ".$price_max.") ";
	}
}

if ($display_flg != null) {
	$where .= " AND (PS.DISPLAY_FLG = ".$display_flg.") ";
}

if ($entry_start_date != null || $entry_end_date != null) {
	if ($entry_start_date != null && $entry_end_date == null) {
		$where .= " AND (PS.ENTRY_START_DATE >= ".$entry_start_date.") ";
	} else if ($entry_start_date == null && $entry_end_date != null) {
		$where .= " AND (PS.ENTRY_END_DATE <= ".$entry_end_date.") ";
	} else if ($entry_start_date != null && $entry_end_date != null) {
		$where .= " AND (PS.ENTRY_START_DATE >= ".$entry_start_date." AND PS.ENTRY_END_DATE <= ".$entry_end_date.") ";
	}
}

if ($purchase_start_date != null || $purchase_end_date != null) {
	if ($purchase_start_date != null && $purchase_end_date == null) {
		$where .= " AND (PS.PURCHASE_START_DATE >= ".$purchase_start_date.") ";
	} else if ($purchase_start_date == null && $purchase_end_date != null) {
		$where .= " AND (PS.PURCHASE_END_DATE <= ".$purchase_end_date.") ";
	} else if ($purchase_start_date != null && $purchase_end_date != null) {
		$where .= " AND (PS.PURCHASE_START_DATE >= ".$purchase_start_date." AND PS.PURCHASE_END_DATE <= ".$purchase_end_date.") ";
	}
}

$total_cnt = $db->count(" 	PAGE_STANDBY PS
						LEFT JOIN 
							SHOP_PRODUCT PR 
						ON
							PS.PRODUCT_IDX = PR.IDX",$where_cnt);

$json_result = array(
	'total' => $db->count("	PAGE_STANDBY PS
						LEFT JOIN 
							SHOP_PRODUCT PR 
						ON
							PS.PRODUCT_IDX = PR.IDX ",$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$order = '';
if ($sort_value != null && $sort_type != null) {
	$alias = "";
	if(strpos($sort_value, 'PRODUCT_NAME') !== false || strpos($sort_value, 'SALES_PRICE') !== false){
		$alias = 'PR';
	} else {
		$alias = 'PS';
	}
	$order = ' '.$alias.'.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PS.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
if ($rows != null) {
	$limit .= " LIMIT ".$limit_start.",".$rows;
}

$select_standby_sql = "
	SELECT
		PS.IDX					AS STANDBY_IDX,
		PS.COUNTRY				AS COUNTRY,
		PS.PRODUCT_IDX			AS PRODUCT_IDX,
		CASE
			WHEN
				(
					SELECT
						COUNT(S_PI.IDX)
					FROM
						PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'S'
				) > 0
				THEN
					(
						SELECT
							REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
						FROM
							PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.DEL_FLG = FALSE AND
							S_PI.IMG_SIZE = 'S' AND
							S_PI.IMG_TYPE = 'P'
						ORDER BY
							S_PI.IDX ASC
						LIMIT
							0,1
					)
			ELSE
				'/images/default_product_img.jpg'
		END						AS IMG_LOCATION,
		PR.PRODUCT_CODE			AS PRODUCT_CODE,
		PR.PRODUCT_NAME			AS PRODUCT_NAME,
		PS.SALES_PRICE			AS SALES_PRICE,
		PS.DISPLAY_FLG			AS DISPLAY_FLG,
		PS.ENTRY_START_DATE		AS ENTRY_START_DATE,
		PS.ENTRY_END_DATE		AS ENTRY_END_DATE,
		PS.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
		PS.PURCHASE_END_DATE	AS PURCHASE_END_DATE,
		(SELECT COLOR FROM ORDERSHEET_MST WHERE IDX = PR.ORDERSHEET_IDX) AS COLOR,
		PS.DISPLAY_NUM			AS DISPLAY_NUM,
		PS.CREATE_DATE			AS CREATE_DATE,
		PS.CREATER				AS CREATER,
		PS.UPDATE_DATE			AS UPDATE_DATE,
		PS.UPDATER				AS UPDATER
	FROM
		PAGE_STANDBY PS
		LEFT JOIN SHOP_PRODUCT PR ON
		PS.PRODUCT_IDX = PR.IDX
	WHERE
		".$where."
	ORDER BY
		PS.DISPLAY_NUM ASC
	".$limit."
";

$db->query($select_standby_sql);

foreach($db->fetch() as $standby_data) {
	$standby_idx = $standby_data['STANDBY_IDX'];
	
	$qty_info = array();
	if (!empty($standby_idx)) {
		$select_qty_sql = "
			SELECT
				QS.IDX					AS QTY_IDX,
				QS.OPTION_IDX			AS OPTION_IDX,
				QS.OPTION_NAME			AS OPTION_NAME,
				QS.BARCODE				AS BARCODE,
				QS.PRODUCT_QTY			AS PRODUCT_QTY
			FROM
				QTY_STANDBY QS
			WHERE
				QS.STANDBY_IDX = ".$standby_idx."
		";
		
		$db->query($select_qty_sql);
		
		foreach($db->fetch() as $qty_data) {
			$qty_info[] = array(
				'qty_idx'			=>$qty_data['QTY_IDX'],
				'option_idx'		=>$qty_data['OPTION_IDX'],
				'option_name'		=>$qty_data['OPTION_NAME'],
				'barcode'			=>$qty_data['BARCODE'],
				'product_qty'		=>$qty_data['PRODUCT_QTY']
			);
		}
	}
	
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'standby_idx'			=>$standby_data['STANDBY_IDX'],
		'country'				=>$standby_data['COUNTRY'],
		'product_idx'			=>$standby_data['PRODUCT_IDX'],
		'img_location'			=>$standby_data['IMG_LOCATION'],
		'product_code'			=>$standby_data['PRODUCT_CODE'],
		'product_name'			=>$standby_data['PRODUCT_NAME'],
		'sales_price'			=>$standby_data['SALES_PRICE'],
		'display_flg'			=>$standby_data['DISPLAY_FLG'],
		'entry_start_date'		=>$standby_data['ENTRY_START_DATE'],
		'entry_end_date'		=>$standby_data['ENTRY_END_DATE'],
		'purchase_start_date'	=>$standby_data['PURCHASE_START_DATE'],
		'purchase_end_date'		=>$standby_data['PURCHASE_END_DATE'],
		'color'					=>$standby_data['COLOR'],
		'display_num'			=>$standby_data['DISPLAY_NUM'],
		'create_date'			=>$standby_data['CREATE_DATE'],
		'creater'				=>$standby_data['CREATER'],
		'update_date'			=>$standby_data['UPDATE_DATE'],
		'updater'				=>$standby_data['UPDATER'],
		
		'qty_info'				=>$qty_info
	);
}
?>