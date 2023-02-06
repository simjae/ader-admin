<?php
/*
 +=============================================================================
 | 
 | 스탠바이, 드로우, 프리오더 등록 상품정보 취득 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$regist_type    = $_POST['regist_type'];            //등록 주체(스탠바이, 드로우, 프리오더)
$product_idx    = $_POST['product_idx'];            //상품 IDX

$regist_table = '';
$qty_table = "";
$qty_date_sql = "";

if($regist_type != null && $product_idx != null){
    switch($regist_type){
        case 'STANDBY':
            $regist_table = 'dev.PAGE_STANDBY';
			$qty_table = "dev.QTY_STANDBY";
            break;
        case 'DRAW':
            $regist_table = 'dev.PAGE_DRAW';
			$qty_table = "dev.QTY_DRAW";
            break;
        case 'PREORDER':
            $regist_table = 'dev.PAGE_PREORDER';
			$qty_table = "dev.QTY_PREORDER";
            break;
    }

	$sql = "SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.STYLE_CODE		AS STYLE_CODE,
			PR.COLOR_CODE		AS COLOR_CODE,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			CASE
				WHEN
					(SELECT COUNT(*) FROM dev.PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								dev.PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.IMG_TYPE = 'P' AND
								S_PI.IMG_SIZE = 'S'
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
			END					AS IMG_LOCATION,
			PR.PRICE_KR			AS PRICE_KR,
			PR.DISCOUNT_KR		AS DISCOUNT_KR,
			PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
			PR.PRICE_EN			AS PRICE_EN,
			PR.DISCOUNT_EN		AS DISCOUNT_EN,
			PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
			PR.PRICE_CN			AS PRICE_CN,
			PR.DISCOUNT_CN		AS DISCOUNT_CN,
			PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
			(SELECT COLOR FROM ORDERSHEET_MST WHERE IDX = PR.ORDERSHEET_IDX) AS COLOR,
			PR.UPDATE_DATE		AS UPDATE_DATE
		FROM
			dev.SHOP_PRODUCT PR
		WHERE
			PR.IDX = ".$product_idx." ";
   
	$db->query($sql);

	$option_info = array();
	foreach($db->fetch() as $data) {
		$select_option_sql = "
			SELECT
				OO.IDX				AS OPTION_IDX,
				OO.BARCODE			AS BARCODE,
				OO.OPTION_NAME		AS OPTION_NAME,
				(
					SELECT
						IFNULL(SUM(STOCK_QTY),0)
					FROM
						dev.PRODUCT_STOCK S_PS
					WHERE
						S_PS.PRODUCT_IDX = ".$product_idx." AND
						S_PS.OPTION_IDX = OO.IDX AND
						S_PS.STOCK_DATE <= NOW()
				)					AS STOCK_QTY,
				(
					SELECT
						IFNULL(SUM(S_OP.PRODUCT_QTY),0)
					FROM
						dev.ORDER_PRODUCT S_OP
					WHERE
						S_OP.PRODUCT_IDX = ".$product_idx." AND
						S_OP.OPTION_IDX = OO.IDX AND
						S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
				)					AS ORDER_QTY
			FROM
				dev.ORDERSHEET_OPTION OO
			WHERE
				OO.ORDERSHEET_IDX = (
					SELECT
						S_PR.ORDERSHEET_IDX
					FROM
						dev.SHOP_PRODUCT S_PR
					WHERE
						IDX = ".$product_idx."
				)
		";
		$db->query($select_option_sql);
		foreach ($db->fetch() as $option_data) {
			$option_idx = $option_data['OPTION_IDX'];
			$stock_qty = intval($option_data['STOCK_QTY']);
			$order_qty = intval($option_data['ORDER_QTY']);
			$product_qty = ($stock_qty - $order_qty);
			
			$select_qty_sql = "
				SELECT
					QI.COUNTRY			AS COUNTRY,
					QI.PRODUCT_QTY		AS PRODUCT_QTY
				FROM
					".$qty_table." QI
					LEFT JOIN ".$regist_table." PI ON
					QI.".$regist_type."_IDX = PI.IDX
				WHERE
					QI.PRODUCT_IDX = ".$product_idx." AND
					QI.OPTION_IDX = ".$option_idx." AND
					PI.ENTRY_END_DATE > NOW()
				ORDER BY
					COUNTRY DESC
			";
			
			$db->query($select_qty_sql);
			
			foreach($db->fetch() as $qty_data) {
				$qty_info[] = array(
					'country' => $qty_data['COUNTRY'],
					'product_qty' => $qty_data['PRODUCT_QTY']
				);
			}
			
			$option_info[] = array(
				'option_idx'    =>$option_data['OPTION_IDX'],
				'barcode'       =>$option_data['BARCODE'],
				'option_name'   =>$option_data['OPTION_NAME'],
				'product_qty'	=>$product_qty,
				
				'qty_info'		=>$qty_info
			);
		}

		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'style_code'		=>$data['STYLE_CODE'],
			'color_code'		=>$data['COLOR_CODE'],
			'product_code'		=>$data['PRODUCT_CODE'],
			'product_type'		=>$data['PRODUCT_TYPE'],
			'product_name'		=>$data['PRODUCT_NAME'],
			'img_location'		=>$data['IMG_LOCATION'],
			'price_kr'			=>$data['PRICE_KR'],
			'discount_kr'		=>$data['DISCOUNT_KR'],
			'sales_price_kr'	=>$data['SALES_PRICE_KR'],
			'price_en'			=>$data['PRICE_EN'],
			'discount_en'		=>$data['DISCOUNT_EN'],
			'sales_price_en'	=>$data['SALES_PRICE_EN'],
			'price_cn'			=>$data['PRICE_CN'],
			'discount_cn'		=>$data['DISCOUNT_CN'],
			'sales_price_cn'	=>$data['SALES_PRICE_CN'],
			'color'             =>$data['COLOR'],
			'update_date'		=>$data['UPDATE_DATE'],
			'option_info'       =>$option_info
		);
	}
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = '상품목록을 불러오는데 실패했습니다.';
}
?>