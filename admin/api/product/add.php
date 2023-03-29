<?php

/*
 +=============================================================================
 | 
 | 독립몰 상품 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$ordersheet_idx_list        = $_POST['ordersheet_idx_list'];
$indp_flg                   = $_POST['indp_flg'];
$product_name               = $_POST['product_name'];

if($ordersheet_idx_list == null && $indp_flg == '1'){
    if($product_name != null){
        $db->begin_transaction();
        try {
            $sql = "
                INSERT INTO ORDERSHEET_MST ( 
                    STYLE_CODE,
                    COLOR_CODE,
                    PRODUCT_CODE,
                    PRODUCT_NAME,
					INDP_FLG,
                    CREATER,
                    UPDATER
                )
                VALUES (
                    'XXXXXXXXX',
                    'XX',
                    'XXXXXXXXXXX',
                    '".$product_name."',
					TRUE,
                    'Admin',
                    'Admin'
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
                        'Admin'
                    )
                ";
                $db->query($history_sql);
                
                $sql = "
                    INSERT INTO SHOP_PRODUCT (
                        ORDERSHEET_IDX 
                        STYLE_CODE,
                        COLOR_CODE,
                        PRODUCT_CODE,
                        PRODUCT_NAME,
                        INDP_FLG,
                        CREATER,
                        UPDATER
                    )
                    VALUES (
                        ".$ordersheet_idx.",
                        'XXXXXXXXX',
                        'XX',
                        'XXXXXXXXXXX',
                        '".$product_name."',
                        TRUE,
                        'Admin',
                        'Admin'
                    )
                ";
                $db->query($sql);
            }
        } 
        catch(mysqli_sql_exception $exception){
            $json_result['code'] = 301;
            $db->rollback();
            $json_result['msg'] = '개인결제용 오더시트&상품등록에 실패했습니다.';
            return $json_result;
        }
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = '개인결제용 오더시트&상품등록에 실패했습니다.';
        return $json_result;
    }
} else if($ordersheet_idx_list != null){
	$db->begin_transaction();

	try {
		$err_msg = null;
	
		for ($i=0; $i<count($ordersheet_idx_list); $i++){
			$ordersheet_idx = $ordersheet_idx_list[$i];
			$option_cnt = $db->count("ORDERSHEET_OPTION","ORDERSHEET_IDX = ".$ordersheet_idx);
			
			if ($option_cnt < 1) {
				$json_result['code'] = 402;
				$json_result['msg'] = "옵션이 등록되지 않은 오더시트는 진행완료 상태로 변경할 수 없습니다.";
				return $json_result;
			}

			$ordersheet_required_sql = "
				SELECT
					IDX,
					IF(LENGTH(STYLE_CODE) > 0,STYLE_CODE,NULL) AS STYLE_CODE,
					IF(LENGTH(COLOR_CODE) > 0,STYLE_CODE,NULL) AS COLOR_CODE,
					IF(LENGTH(PRODUCT_CODE) > 0,STYLE_CODE,NULL) AS PRODUCT_CODE,
					IF(LENGTH(PRODUCT_NAME) > 0,STYLE_CODE,NULL) AS PRODUCT_NAME,
					IF(LENGTH(COLOR) > 0,COLOR,NULL) AS COLOR,
					IF(LENGTH(COLOR_RGB) > 0,COLOR_RGB,NULL) AS COLOR_RGB,

					IF(PRICE_KR IS NULL OR PRICE_KR = 0, NULL, PRICE_KR) AS PRICE_KR,
					IF(PRICE_EN IS NULL OR PRICE_EN = 0, NULL, PRICE_EN) AS PRICE_EN,
					IF(PRICE_CN IS NULL OR PRICE_CN = 0, NULL, PRICE_CN) AS PRICE_CN,

					IF(LENGTH(DETAIL_KR) > 0,DETAIL_KR,NULL) AS DETAIL_KR,
					IF(LENGTH(CARE_DSN_KR) > 0,CARE_DSN_KR,NULL) AS CARE_DSN_KR,
					IF(LENGTH(CARE_TD_KR) > 0,CARE_TD_KR,NULL) AS CARE_TD_KR,
					IF(LENGTH(MATERIAL_DSN_KR) > 0,MATERIAL_DSN_KR,NULL) AS MATERIAL_DSN_KR,
					IF(LENGTH(MATERIAL_TD_KR) > 0,MATERIAL_TD_KR,NULL) AS MATERIAL_TD_KR
				FROM
						ORDERSHEET_MST
				WHERE
						IDX = ".$ordersheet_idx."
			";
			$db->query($ordersheet_required_sql);
			$product_code = null;
			$empty_column = array();
			foreach($db->fetch() as $data){
				$product_code = $data['PRODUCT_CODE'];
				
				if($data['STYLE_CODE'] == null){
					$empty_column[] = '스타일 코드';
				}
				if($data['COLOR_CODE'] == null){
					$empty_column[] = '컬러코드';
				}
				if($data['PRODUCT_CODE'] == null){
					$empty_column[] = '상품 이름';
				}
				if($data['PRODUCT_NAME'] == null){
					$empty_column[] = '상품명';
				}
				if($data['COLOR'] == null){
					$empty_column[] = '색상명';
				}
				if($data['COLOR_RGB'] == null){
					$empty_column[] = '색상 RGB 코드';
				}
				if($data['PRICE_KR'] == null){
					$empty_column[] = '한국몰 가격';
				}
				if($data['PRICE_EN'] == null){
					$empty_column[] = '영문몰 가격';
				}
				if($data['PRICE_CN'] == null){
					$empty_column[] = '중국몰 가격';
				}
				
				if($data['MATERIAL_DSN_KR'] == null){
					$empty_column[] = '소재(한국몰)';
				}
				if($data['MATERIAL_TD_KR'] == null){
					$empty_column[] = '소재(한국몰)';
				}
				
				if($data['DETAIL_KR'] == null){
					$empty_column[] = '상세정보(한국몰)';
				}
				
				if($data['CARE_DSN_KR'] == null){
					$empty_column[] = '취급 유의사항(한국몰)';
				}
				if($data['CARE_TD_KR'] == null){
					$empty_column[] = '취급 유의사항(한국몰)';
				}
			}
			$option_required_sql = "
				SELECT
						IDX,
						IF(LENGTH(OPTION_NAME) > 0,OPTION_NAME,NULL) AS OPTION_NAME,
						BARCODE,
						OPTION_SIZE_1,
						OPTION_SIZE_2,
						OPTION_SIZE_3,
						OPTION_SIZE_4,
						OPTION_SIZE_5,
						OPTION_SIZE_6
				FROM
						ORDERSHEET_OPTION
				WHERE
						ORDERSHEET_IDX = ".$ordersheet_idx."
			";
			$db->query($option_required_sql);
			
			foreach($db->fetch() as $option_data){
				if($option_data['OPTION_NAME'] == null){
					$empty_column[] = '옵션이름';
					break;
				}
				$option_size_sum = null;
				$option_size_sum += $option_data['OPTION_SIZE_1'];
				$option_size_sum += $option_data['OPTION_SIZE_2'];
				$option_size_sum += $option_data['OPTION_SIZE_3'];
				$option_size_sum += $option_data['OPTION_SIZE_4'];
				$option_size_sum += $option_data['OPTION_SIZE_5'];
				$option_size_sum += $option_data['OPTION_SIZE_6'];

				if($option_size_sum == null || $option_size_sum == 0){
					$empty_column[] = '옵션 사이즈';
					break;
				}
			}
			
			if(count($empty_column) > 0){
				$err_msg .= '<br>상품코드 ['.$product_code.']<br>미입력 항목 : ';
				$err_msg .= implode(',',$empty_column).'<br>';
			}
		}
		
		if ($err_msg > 0) {
			$json_result['code'] = 402;
			$json_result['msg'] = $err_msg;
			return $json_result;
		}

		$ordersheet_cnt = $db->count("SHOP_PRODUCT", "ORDERSHEET_IDX IN (".implode(",", $ordersheet_idx_list).")");
		if($ordersheet_cnt == 0){
			$ordersheet_sql = "
				INSERT INTO SHOP_PRODUCT
					(   
						ORDERSHEET_IDX,
						STYLE_CODE,
						COLOR_CODE,
						PRODUCT_CODE,
						PRODUCT_NAME,
						LIMIT_ID_FLG,
						LIMIT_PURCHASE_QTY_FLG,
						LIMIT_PRODUCT_QTY,
						INDP_FLG,
						PRICE_KR,
						PRICE_EN,
						PRICE_CN,
						DISCOUNT_KR,
						DISCOUNT_EN,
						DISCOUNT_CN,
						SALES_PRICE_KR,
						SALES_PRICE_EN,
						SALES_PRICE_CN,

						DETAIL_KR,
						DETAIL_EN,
						DETAIL_CN,
						CARE_KR,
						CARE_EN,
						CARE_CN,
						MATERIAL_KR,
						MATERIAL_EN,
						MATERIAL_CN,
						
						CREATER,
						UPDATER
					)
				SELECT
						IDX,
						STYLE_CODE,
						COLOR_CODE,
						PRODUCT_CODE,
						PRODUCT_NAME,
						LIMIT_ID_FLG,
						LIMIT_PRODUCT_QTY_FLG,
						LIMIT_PRODUCT_QTY,
						FALSE,
						PRICE_KR,
						PRICE_EN,
						PRICE_CN,
						0,
						0,
						0,
						PRICE_KR,
						PRICE_EN,
						PRICE_CN,

						DETAIL_KR,
						DETAIL_EN,
						DETAIL_CN,
						CARE_TD_KR,
						CARE_TD_EN,
						CARE_TD_CN,
						MATERIAL_TD_KR,
						MATERIAL_TD_EN,
						MATERIAL_TD_CN,

						'Admin',
						'Admin'
				FROM
						ORDERSHEET_MST
				WHERE
						IDX IN (".implode(",", $ordersheet_idx_list).")
			";
			$db->query($ordersheet_sql);

			$product_sql = "   
				SELECT
					IDX				AS PRODUCT_IDX,
					PRODUCT_CODE	AS PRODUCT_CODE,
					ORDERSHEET_IDX	AS ORDERSHEET_IDX
				FROM
					SHOP_PRODUCT
				WHERE
					ORDERSHEET_IDX IN (".implode(',', $ordersheet_idx_list).")";
			$db->query($product_sql);
			$product_info_arr = array();
			foreach($db->fetch() as $data) {
				$new_product_idx = $data['PRODUCT_IDX'];
				$new_product_code = $data['PRODUCT_CODE'];
				$new_ordersheet_idx = $data['ORDERSHEET_IDX'];
				
				if($new_product_idx != null){
					$limit_option_sql = "
						INSERT INTO PRODUCT_OPTION
							(
								PRODUCT_IDX,
								OPTION_IDX,
								QTY
							)
						SELECT
								".$new_product_idx.",
								IDX,
								LIMIT_OPTION_QTY
						FROM
								ORDERSHEET_OPTION
						WHERE
								ORDERSHEET_IDX = ".$new_ordersheet_idx."
					";
					$db->query($limit_option_sql);


					$ftp_dir = "/ader_prod_img";
					$server_img_path = "/var/www/admin/www/images/product/";

					$img_type_seq = array();
					$img_type_arr = $_POST['img_type'];
					if(isset($img_type_arr) && is_array($img_type_arr)){
						$img_type_seq = $img_type_arr;
					}
					else{
						array_push($img_type_seq, 'thumbnail_O');
						array_push($img_type_seq, 'thumbnail_P');
						array_push($img_type_seq, 'outfit');
						array_push($img_type_seq, 'product');
						array_push($img_type_seq, 'detail');
					}

					$upload_file = url_to_file_up($ftp_dir, $server_img_path, $new_product_code, $img_type_seq);
					
					if ($upload_file != null) {
						for ($i=0; $i<count($upload_file); $i++) {
							$img_type = $upload_file[$i]['img_type'];
							$img_url = $img_location = $upload_file[$i]['url'];
							$img_location = "";
							if($upload_file[$i]['img_size'] == 'L'){
								$img_location = $upload_file[$i]['url'];
							} else{
								$img_location = $server_img_path.$upload_file[$i]['filename'];
							}
							$img_size = $upload_file[$i]['img_size'];
							
							$img_sql = "
										INSERT INTO
											PRODUCT_IMG
										(
											PRODUCT_IDX,
											PRODUCT_CODE,
											IMG_TYPE,
											IMG_SIZE,
											IMG_URL,
											IMG_LOCATION,
											CREATE_DATE,
											CREATER,
											UPDATE_DATE,
											UPDATER
										)
										VALUES
										(
											".$new_product_idx.",
											'".$new_product_code."',
											'".$img_type."',
											'".$img_size."',
											'".$img_url."',
											'".$img_location."',
											NOW(),
											'Admin',
											NOW(),
											'Admin'
										)";
							$db->query($img_sql);
						}
					}
				}
			}
			$db->commit();
			$json_result['code'] = 200;
			return $json_result;
		} else{
			$json_result['code'] = 300;
			$json_result['msg'] = "이미 동일한 제품이 독립몰에 등록되었습니다.";
			return $json_result;
		}
	} catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "등록작업에 실패했습니다.";
	}
}

function xssEncode($value){
    $value = str_replace("&","&amp;",$value);
    $value = str_replace("\"","&quot;",$value);
    $value = str_replace("'","&apos;",$value);
    $value = str_replace("<","&lt;",$value);
    $value = str_replace(">","&gt;",$value);
    $value = str_replace("\r","<br>",$value);
    $value = str_replace("\n","<p>",$value);

    return $value;
}

?>