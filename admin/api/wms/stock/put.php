<?php

header("Content-Type: application/javascript");

function getUrlParamter($url, $sch_tag) {
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];

$callback = getUrlParamter($page_url, 'callback');

$order_product_code		= $_POST['order_product_code'];
$param_status			= $_POST['param_status'];

$result_success = array();
$result_fail = array();
if ($order_product_code != null && $param_status != null) {
	for ($i=0; $i<count($order_product_code); $i++) {
		$order_product_code[$i] = "'".$order_product_code[$i]."'";
	}

	$prev_status = "";
	switch ($param_status) {	
		//프리오더 - 준비
		case "POP" :
			$prev_status = "PCP";
			break;
		
		//프리오더 - 상품 생산
		case "POD" :
			$prev_status = "POP";
			break;
		
		//공통 - 배송중
		case "DPG" :
			$prev_status = "DPR";
			break;
		
		//공통 - 배송완료
		case "DCP" :
			$prev_status = "DPG";
			break;
	}

	$order_product_cnt = $db->count("dev.ORDER_PRODUCT OP","OP.ORDER_PRODUCT_CODE IN (".implode(",",$order_product_code).")");
	if (count($order_product_code) == $order_product_cnt) {
		$sql = "SELECT
					OP.IDX					AS OP_IDX,
					OP.ORDER_IDX			AS ORDER_IDX,
					OP.ORDER_PRODUCT_CODE	AS ORDER_PRODUCT_CODE,
					OP.ORDER_STATUS			AS ORDER_STATUS,
					OP.EXCHANGE_DATE			AS EXCHANGE_DATE,
					OP.PRODUCT_TYPE			AS PRODUCT_TYPE,
					OP.PREORDER_FLG			AS PREORDER_FLG
				FROM
					dev.ORDER_PRODUCT OP
				WHERE
					OP.ORDER_PRODUCT_CODE IN (".implode(",",$order_product_code).")";

		$db->query($sql);
		
		foreach($db->fetch() as $data) {
			$op_idx = $data['OP_IDX'];
			$order_idx = $data['ORDER_IDX'];
			$order_product_code = $data['ORDER_PRODUCT_CODE'];
			$order_status = $data['ORDER_STATUS'];
			$exchange_date = $data['EXCHANGE_DATE'];
			$product_type = $data['PRODUCT_TYPE'];
			$preorder_flg = $data['PREORDER_FLG'];
			
			if ($param_status == "PPR") {
				if ($exchange_date != null) {
					$prev_status = "OEX";
				} else {
					$prev_status = "PCP";
				}
			} else {
				if ($param_status == "DPR") {
					if ($preorder_flg == TRUE) {
						$prev_status == "POD";
					} else {
						$prev_status == "PPR";
					}
				}
			}
			
			if ($prev_status == $order_status) {
				$update_sql="UPDATE
								dev.ORDER_PRODUCT
							SET
								ORDER_STATUS = '".$param_status."',
								UPDATE_DATE = NOW(),
								UPDATER = 'WMS'
							WHERE
								IDX = ".$op_idx." AND
								ORDER_STATUS = '".$prev_status."'";
				
				$db->query($update_sql);
				
				if ($product_type == "S") {
					checkSetProduct($db,$order_idx,$param_status);
				}
				
				checkOrderInfo($db,$order_idx,$param_status);
				
				array_push($result_success,$order_product_code);
			} else {
				array_push($result_fail,$order_product_code);
			}
		}
	}
}

$info = array(
	'result_success'	=>$result_success,
	'result_fail'		=>$result_fail
);

if (count($result_success) > 0) {
	$json_result['result'] = "Y";
	$json_result['info'] = $info;
} else {
	$json_result['result'] = "N";
	$json_result['info'] = $info;
	$json_result['reason'] = "err001:stock data update fail";
}

echo $callback.'('.$json_result['data'].');';

function checkSetProduct($db,$order_idx,$param_status) {
	$set_order_cnt = $db->count("dev.ORDER_PRODUCT OP","OP.ORDER_IDX = '".$order_idx."' AND PRODUCT_CODE NOT REGEXP 'SET|COU'");
	$order_product_cnt = $db->count("dev.ORDER_PRODUCT OP","OP.ORDER_IDX = '".$order_idx."' AND OP.ORDER_STATUS = '".$param_status."'");
	
	if ($set_order_cnt == $order_product_cnt) {
		$sql = "UPDATE
					dev.ORDER_PRODUCT
				SET
					ORDER_STATUS = '".$param_status."',
					UPDATE_DATE = NOW(),
					UPDATER = 'WMS'
				WHERE
					ORDER_IDX = '".$order_idx."' AND
					PRODUCT_CODE LIKE 'SET%'";
		
		$db->query($sql);
	}
}

function checkOrderInfo($db,$order_idx,$param_status) {
	$order_cnt = $db->count("dev.ORDER_PRODUCT OP","OP.ORDER_IDX = ".$order_idx." AND PRODUCT_CODE NOT REGEXP 'SET|COU'");
	$order_product_cnt = $db->count("dev.ORDER_PRODUCT OP","OP.ORDER_IDX = ".$order_idx." AND OP.ORDER_STATUS = '".$param_status."' AND PRODUCT_CODE NOT REGEXP 'SET|COU'");
	
	if ($order_cnt == $order_product_cnt) {
		$sql = "UPDATE
					dev.ORDER_INFO
				SET
					ORDER_STATUS = '".$param_status."',
					UPDATE_DATE = NOW(),
					UPDATER = 'WMS'
				WHERE
					IDX = '".$order_idx."'";
		
		$db->query($sql);
	}
}
?>