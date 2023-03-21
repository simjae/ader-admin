<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 응모정보 조회
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

$country			= $_POST['country'];

$draw_idx		    = $_POST['draw_idx'];
$option_idx	        = $_POST['option_idx'];

$member_name		= $_POST['member_name'];
$purchase_flg		= $_POST['purchase_flg'];
$prize_flg			= $_POST['prize_flg'];
$apply_start_date	= $_POST['apply_start_date'];
$apply_end_date		= $_POST['apply_end_date'];

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];

$where = "ED.DRAW_IDX = ".$draw_idx." AND ED.COUNTRY='".$country."' ";
$where_cnt = $where;

if($option_idx != null){
    $where .= " AND ED.OPTION_IDX = ".$option_idx." ";
}
if($member_name != null){
    $where .= " AND ED.MEMBER_NAME LIKE '%".$member_name."%' ";
}

if($purchase_flg != null){
    $where .= " AND ED.PURCHASE_FLG = ".$purchase_flg." ";
}


if($prize_flg != null){
    $where .= " AND ED.PRIZE_FLG = ".$prize_flg." ";
}

if ($apply_start_date != null && $apply_end_date != null) {
    $where .= " AND (ED.CREATE_DATE BETWEEN '".$apply_start_date."' AND '".$apply_end_date."') ";
}

$total = $db->count("      ENTRY_DRAW    ED	LEFT JOIN
                            ORDER_INFO	  OI 
                            ON
                            ED.ORDER_IDX = OI.IDX", $where);
$total_cnt = $db->count("  ENTRY_DRAW    ED	LEFT JOIN
                            ORDER_INFO	  OI 
                            ON
                            ED.ORDER_IDX = OI.IDX", $entry_where_cnt);

$json_result = array(
    'total' => $total,
    'total_cnt' => $total_cnt,
    'page' => $page
);
   

if ($country != null && $draw_idx != null) {
	$select_draw_sql = "
		SELECT 
			ED.MEMBER_NAME,
			ED.CREATE_DATE,
            ED.PRIZE_FLG,
            ED.PURCHASE_FLG,
			OI.ORDER_CODE,
			(SELECT PRODUCT_CODE FROM SHOP_PRODUCT WHERE ED.PRODUCT_IDX = PRODUCT_IDX LIMIT 1) AS PRODUCT_CODE,
			OI.ORDER_STATUS,
			(SELECT COUNT(0) FROM ORDER_PRODUCT WHERE ORDER_IDX = OI.IDX) AS PRODUCT_QTY,
			OI.MEMBER_MOBILE,
			OI.MEMBER_EMAIL,
			OI.PRICE_PRODUCT,
			OI.PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT,
			OI.PRICE_DISCOUNT,
			OI.PRICE_DELIVERY,
			OI.PRICE_TOTAL,
			OI.TO_LOT_ADDR,
			OI.TO_ROAD_ADDR,
			OI.TO_DETAIL_ADDR,
			OI.TO_NAME,
			OI.TO_MOBILE,
			OI.TO_ZIPCODE,
			OI.ORDER_MEMO
		FROM 
			ENTRY_DRAW    ED	LEFT JOIN
			ORDER_INFO	  OI 
		ON
			ED.ORDER_IDX = OI.IDX
		WHERE
			".$where."
        ORDER BY ORDER_IDX ASC
	";
    $db->query($select_draw_sql);

    foreach($db->fetch() as $data){
        $json_result['data'][] = array(
            'member_name' => $data['MEMBER_NAME'],
            'create_date' => $data['CREATE_DATE'],
            'prize_flg' => $data['PRIZE_FLG'],
            'purchase_flg' => $data['PURCHASE_FLG'],
            'order_code' => $data['ORDER_CODE'],
            'product_code' => $data['PRODUCT_CODE'],
            'order_status' => setTxtParam($data['ORDER_STATUS']),
            'product_qty' => $data['PRODUCT_QTY'],
            'member_mobile' => $data['MEMBER_MOBILE'],
            'member_email' => $data['MEMBER_EMAIL'],
            'price_product' => $data['PRICE_PRODUCT'],
            'price_mileage_point' => $data['PRICE_MILEAGE_POINT'],
            'price_charge_point' => $data['PRICE_CHARGE_POINT'],
            'price_discount' => $data['PRICE_DISCOUNT'],
            'price_delivery' => $data['PRICE_DELIVERY'],
            'price_total' => $data['PRICE_TOTAL'],
            'to_lot_addr' => $data['TO_LOT_ADDR'],
            'to_road_addr' => $data['TO_ROAD_ADDR'],
            'to_detail_addr' => $data['TO_DETAIL_ADDR'],
            'to_name' => $data['TO_NAME'],
            'to_mobile' => $data['TO_MOBILE'],
            'to_zipcode' => $data['TO_ZIPCODE'],
            'order_memo' => $data['ORDER_MEMO']
        );
    }
}

function setTxtParam($param) {
	$txt_param = "";
	
	switch ($param) {
		//상품 타입
		case "B" :
			$txt_param = "일반상품";
			break;
		
		case "S" :
			$txt_param = "세트상품";
			break;
		
		//주문상태
		case "PCP" :
			$txt_param = "결제완료";
			break;
		
		case "PPR" :
			$txt_param = "상품준비";
			break;
		
		case "POP" :
			$txt_param = "프리오더 준비";
			break;
		
		case "POD" :
			$txt_param = "프리오더 상품 생산";
			break;
		
		case "DPR" :
			$txt_param = "배송준비";
			break;
		
		case "DPG" :
			$txt_param = "배송중";
			break;
			
		case "DCP" :
			$txt_param = "배송완료";
			break;
		
		case "OCC" :
			$txt_param = "주문취소";
			break;
		
		case "OEX" :
			$txt_param = "주문교환";
			break;
		
		case "OEP" :
			$txt_param = "교환완료";
			break;
		
		case "ORF" :
			$txt_param = "주문환불";
			break;
		
		case "ORP" :
			$txt_param = "환불완료";
			break;
		
		//배송유형
		case "KR" :
			$txt_param = "국내배송";
			break;
		
		case "FR" :
			$txt_param = "해외배송";
			break;
		
		//배송상태
		case "MRD" :
			$txt_param = "멤버 재배송";
			break;
		
		case "ARD" :
			$txt_param = "아더 재배송";
			break;
	}
	
	return $txt_param;
}
?>