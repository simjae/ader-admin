<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 리스트 조회
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

$announce_start_date	= $_POST['announce_start_date'];
$announce_end_date		= $_POST['announce_end_date'];

$rows					= $_POST['rows'];
$page					= $_POST['page'];

$sort_value				= $_POST['sort_value'];	
$sort_type				= $_POST['sort_type'];

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

if ($announce_start_date != null) {
	if (isset($_POST['announce_start_time'])) {
		$announce_start_date = "'".$announce_start_date." ".$_POST['announce_start_time'].":00'";
	} else {
		$announce_start_date = "'".$announce_start_date." 00:00'";
	}
}

if ($announce_end_date != null) {
	if (isset($_POST['announce_end_time'])) {
		$announce_end_date = "'".$announce_end_date." ".$_POST['announce_end_time'].":00'";
	} else {
		$announce_end_date = "'".$announce_end_date." 00:00'";
	}
}

if ($purchase_start_date != null) {
	if (isset($_POST['purchase_start_time'])) {
		$purchase_start_date = "'".$purchase_start_date." ".$_POST['purchase_start_time'].":00'";
	} else {
		$purchase_start_date = "'" . $purchase_start_date . " 00:00'";
	}
}

if ($purchase_end_date != null) {
	if (isset($_POST['purchase_end_time'])) {
		$purchase_end_date = "'".$purchase_end_date." ".$_POST['purchase_end_time'].":00'";
	} else {
		$purchase_end_date = "'".$purchase_end_date." 00:00'";
	}
}

//검색 유형 - 디폴트
$where = '1=1';
$where .= " AND (PD.COUNTRY = '".$country."') ";
$where .= ' AND (PD.DEL_FLG = FALSE) ';
$where_cnt = $where;

if ($member_level != null) {
	$where .= " AND PD.MEMBER_LEVEL REGEXP '".$member_level."' ";
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
						SUM(S_QD.PRODUCT_QTY)
					FROM
						QTY_DRAW S_QD
					WHERE
						S_QD.DRAW_IDX = PD.IDX
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
		$where .= " AND (PD.SALES_PRICE >= ".$price_min.") ";
	} else if ($price_min == null && $price_max != null) {
		$where .= " AND (PD.SALES_PRICE <= ".$price_max.") ";
	} else if ($price_min != null && $price_max != null) {
		$where .= " AND (PD.SALES_PRICE BETWEEN ".$price_min." AND ".$price_max.") ";
	}
}

if ($display_flg != null) {
	$where .= " AND (PD.DISPLAY_FLG = ".$display_flg.") ";
}

if ($entry_start_date != null || $entry_end_date != null) {
	if ($entry_start_date != null && $entry_end_date == null) {
		$where .= " AND (PD.ENTRY_START_DATE >= ".$entry_start_date.") ";
	} else if ($entry_start_date == null && $entry_end_date != null) {
		$where .= " AND (PD.ENTRY_END_DATE <= ".$entry_end_date.") ";
	} else if ($entry_start_date != null && $entry_end_date != null) {
		$where .= " AND (PD.ENTRY_START_DATE >= ".$entry_start_date." AND PD.ENTRY_END_DATE <= ".$entry_end_date.") ";
	}
}

if ($announce_start_date != null || $announce_end_date != null) {
	if ($announce_start_date != null && $announce_end_date == null) {
		$where .= " AND (PD.ANNOUNCE_DATE >= ".$announce_start_date.") ";
	} else if ($announce_start_date == null && $announce_end_date != null) {
		$where .= " AND (PD.ANNOUNCE_DATE <= ".$announce_end_date.") ";
	} else if ($announce_start_date != null && $announce_end_date != null) {
		$where .= " AND (PD.ANNOUNCE_DATE BETWEEN ".$announce_start_date." AND ".$announce_end_date.") ";
	}
}

if ($purchase_start_date != null || $purchase_end_date != null) {
	if ($purchase_start_date != null && $purchase_end_date == null) {
		$where .= " AND (PD.PURCHASE_START_DATE >= ".$purchase_start_date.") ";
	} else if ($purchase_start_date == null && $purchase_end_date != null) {
		$where .= " AND (PD.PURCHASE_END_DATE <= ".$purchase_end_date.") ";
	} else if ($purchase_start_date != null && $purchase_end_date != null) {
		$where .= " AND (PD.PURCHASE_START_DATE >= ".$purchase_start_date." AND PD.PURCHASE_END_DATE <= ".$purchase_end_date.") ";
	}
}

$total_cnt = $db->count("PAGE_DRAW PD
						LEFT JOIN SHOP_PRODUCT PR ON
						PD.PRODUCT_IDX = PR.IDX",$where_cnt);

$json_result = array(
	'total' => $db->count("PAGE_DRAW PD
							LEFT JOIN SHOP_PRODUCT PR ON
							PD.PRODUCT_IDX = PR.IDX",$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$order = '';
if ($sort_value != null && $sort_type != null) {
	$alias = "";
	if(strpos($sort_value, 'PRODUCT_NAME') !== false){
		$alias = 'PR';
	} else {
		$alias = 'PD';
	}
	$order = ' '.$alias.'.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PD.IDX DESC';
}

$select_draw_sql = "
	SELECT
		PD.IDX					AS DRAW_IDX,
		PD.COUNTRY				AS COUNTRY,
		PD.PRODUCT_IDX			AS PRODUCT_IDX,
		PD.DISPLAY_NUM			AS DISPLAY_NUM,
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
		PD.SALES_PRICE			AS SALES_PRICE,
		PD.DISPLAY_FLG			AS DISPLAY_FLG,
		PD.ENTRY_START_DATE		AS ENTRY_START_DATE,
		PD.ENTRY_END_DATE		AS ENTRY_END_DATE,
		PD.ANNOUNCE_DATE		AS ANNOUNCE_DATE,
		PD.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
		PD.PURCHASE_END_DATE	AS PURCHASE_END_DATE,
		OM.COLOR				AS COLOR,
		PD.CREATE_DATE			AS CREATE_DATE,
		PD.CREATER				AS CREATER,
		PD.UPDATE_DATE			AS UPDATE_DATE,
		PD.UPDATER				AS UPDATER
	FROM
		PAGE_DRAW PD
		LEFT JOIN SHOP_PRODUCT PR ON
		PD.PRODUCT_IDX = PR.IDX
		LEFT JOIN ORDERSHEET_MST OM ON
		PR.ORDERSHEET_IDX = OM.IDX
	WHERE
		".$where."
	ORDER BY
		PD.DISPLAY_NUM ASC
";

$limit_start = (intval($page)-1)*$rows;
if ($rows != null) {
	$select_draw_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_draw_sql);

foreach($db->fetch() as $draw_data) {
	$draw_idx = $draw_data['DRAW_IDX'];
	
	$qty_info = array();
	if (!empty($draw_idx)) {
		$select_qty_draw_sql = "
			SELECT
				QD.IDX					AS QTY_IDX,
				QD.PRODUCT_IDX			AS PRODUCT_IDX,
				QD.OPTION_IDX			AS OPTION_IDX,
				QD.OPTION_NAME			AS OPTION_NAME,
				QD.BARCODE				AS BARCODE,
				QD.PRODUCT_QTY			AS PRODUCT_QTY
			FROM
				QTY_DRAW QD
			WHERE
				QD.DRAW_IDX = ".$draw_idx."
		";
		
		$db->query($select_qty_draw_sql);
		
		foreach($db->fetch() as $qty_data) {
			$qty_info[] = array(
				'qty_idx'			=>$qty_data['QTY_IDX'],
				'option_idx'		=>$qty_data['OPTION_IDX'],
				'option_name'		=>$qty_data['OPTION_NAME'],
				'barcode'			=>$qty_data['BARCODE'],
				'product_qty'		=>$qty_data['PRODUCT_QTY'],
				'order_cnt'			=>$db->count("ENTRY_DRAW","DRAW_IDX=".$draw_idx." AND PRODUCT_IDX = ".$qty_data['PRODUCT_IDX']." AND OPTION_IDX = ".$qty_data['OPTION_IDX']." AND PURCHASE_FLG = TRUE AND DEL_FLG = FALSE"),
				'entry_cnt'			=>$db->count("ENTRY_DRAW","DRAW_IDX=".$draw_idx." AND PRODUCT_IDX = ".$qty_data['PRODUCT_IDX']." AND OPTION_IDX = ".$qty_data['OPTION_IDX']." AND DEL_FLG = FALSE")
			);
		}
	}
	
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'draw_idx'				=>$draw_data['DRAW_IDX'],
		'country'				=>$draw_data['COUNTRY'],
		'product_idx'			=>$draw_data['PRODUCT_IDX'],
		'display_num'			=>$draw_data['DISPLAY_NUM'],
		'color'					=>$draw_data['COLOR'],
		'img_location'			=>$draw_data['IMG_LOCATION'],
		'product_code'			=>$draw_data['PRODUCT_CODE'],
		'product_name'			=>$draw_data['PRODUCT_NAME'],
		'sales_price'			=>number_format($draw_data['SALES_PRICE']),
		'display_flg'			=>$draw_data['DISPLAY_FLG'],
		'entry_start_date'		=>$draw_data['ENTRY_START_DATE'],
		'entry_end_date'		=>$draw_data['ENTRY_END_DATE'],
		'announce_date'			=>$draw_data['ANNOUNCE_DATE'],
		'purchase_start_date'	=>$draw_data['PURCHASE_START_DATE'],
		'purchase_end_date'		=>$draw_data['PURCHASE_END_DATE'],
		'create_date'			=>$draw_data['CREATE_DATE'],
		'creater'				=>$draw_data['CREATER'],
		'update_date'			=>$draw_data['UPDATE_DATE'],
		'updater'				=>$draw_data['UPDATER'],
		
		'qty_info'				=>$qty_info
	);
}
?>