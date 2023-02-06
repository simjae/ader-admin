<?php
/*
 +=============================================================================
 | 
 | 오더시트 단일정보 
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sel_idx     = $_POST['sel_idx'];

if($sel_idx != null){
    $sql = "	SELECT
					OM.IDX											AS ORDERSHEET_IDX,
					OM.STYLE_CODE									AS STYLE_CODE,
					OM.COLOR_CODE									AS COLOR_CODE,
					OM.PRODUCT_CODE									AS PRODUCT_CODE,
					OM.PREORDER_FLG									AS PREORDER_FLG,
					OM.REFUND_FLG									AS REFUND_FLG,

					LINE_IDX										AS LINE_IDX,
					IFNULL(LI.LINE_NAME,'')							AS LINE_NAME,
					LI.LINE_TYPE									AS LINE_TYPE,
					IFNULL(LI.MEMO,'')								AS LINE_MEMO,

					IFNULL((SELECT TITLE FROM dev.ORDERSHEET_CATEGORY WHERE IDX = OM.CATEGORY_LRG),'')
																	AS CATEGORY_LRG_TITLE,
					IFNULL((SELECT TITLE FROM dev.ORDERSHEET_CATEGORY WHERE IDX = OM.CATEGORY_MDL),'')
																	AS CATEGORY_MDL_TITLE,
					IFNULL((SELECT TITLE FROM dev.ORDERSHEET_CATEGORY WHERE IDX = OM.CATEGORY_SML),'')
																	AS CATEGORY_SML_TITLE,
					IFNULL((SELECT TITLE FROM dev.ORDERSHEET_CATEGORY WHERE IDX = OM.CATEGORY_DTL),'')
																	AS CATEGORY_DTL_TITLE,
					OM.CATEGORY_LRG									AS CATEGORY_LRG,
					OM.CATEGORY_MDL									AS CATEGORY_MDL,
					OM.CATEGORY_SML									AS CATEGORY_SML,
					OM.CATEGORY_DTL									AS CATEGORY_DTL,
					OM.CATEGORY_IDX									AS CATEGORY_IDX,

					IFNULL(OM.MATERIAL, '')							AS MATERIAL,
					IFNULL(OM.GRAPHIC, '')							AS GRAPHIC,
					IFNULL(OM.FIT, '')								AS FIT,
					IFNULL(OM.PRODUCT_NAME, '')						AS PRODUCT_NAME,
					IFNULL(OM.PRODUCT_SIZE, '')						AS PRODUCT_SIZE,
					IFNULL(OM.COLOR, '')							AS COLOR,
					IFNULL(OM.COLOR_RGB, '')						AS COLOR_RGB,
					IFNULL(OM.PANTONE_CODE, '')						AS PANTONE_CODE,
					IFNULL(OM.MD_CATEGORY_GUIDE, '')						AS MD_CATEGORY_GUIDE,
					IFNULL(OM.LIMIT_MEMBER, '')						AS LIMIT_MEMBER,
					IFNULL(OM.LIMIT_QTY, '')						AS LIMIT_QTY,
					IFNULL(OM.PRICE_COST, 0)						AS PRICE_COST,
					IFNULL(OM.PRICE_KR, 0)							AS PRICE_KR,
					IFNULL(OM.PRICE_KR_GB, 0)					    AS PRICE_KR_GB,
					IFNULL(OM.PRICE_EN, 0)							AS PRICE_EN,
					IFNULL(OM.PRICE_CN, 0)							AS PRICE_CN,
					IFNULL(OM.PRODUCT_QTY, 0)						AS PRODUCT_QTY,
					IFNULL(OM.SAFE_QTY, 0)							AS SAFE_QTY,
					IFNULL(DATE_FORMAT(OM.LAUNCHING_DATE, '%Y-%m-%d'),'')		AS LAUNCHING_DATE,
					IFNULL(DATE_FORMAT(OM.RECEIVE_REQUEST_DATE, '%Y-%m-%d'),'') AS RECEIVE_REQUEST_DATE,
					IFNULL(DATE_FORMAT(OM.TP_COMPLETION_DATE, '%Y-%m-%d'),'')	AS TP_COMPLETION_DATE,
					
					WKLA_IDX										AS WKLA_IDX,
					IFNULL(WI.WKLA_NAME,'')							AS WKLA_NAME,
					IFNULL(WI.MEMO,'')								AS WKLA_MEMO,

					IFNULL(OM.MODEL, '')                            AS MODEL,
					IFNULL(OM.MODEL_WEAR, '')                       AS MODEL_WEAR,
					OM.SIZE_A1_KR                                   AS SIZE_A1_KR,
					OM.SIZE_A2_KR                                   AS SIZE_A2_KR,
					OM.SIZE_A3_KR                                   AS SIZE_A3_KR,
					OM.SIZE_A4_KR                                   AS SIZE_A4_KR,
					OM.SIZE_A5_KR                                   AS SIZE_A5_KR,
					OM.SIZE_ONESIZE_KR                              AS SIZE_ONESIZE_KR,
					OM.SIZE_A1_EN                                   AS SIZE_A1_EN,
					OM.SIZE_A2_EN                                   AS SIZE_A2_EN,
					OM.SIZE_A3_EN                                   AS SIZE_A3_EN,
					OM.SIZE_A4_EN                                   AS SIZE_A4_EN,
					OM.SIZE_A5_EN                                   AS SIZE_A5_EN,
					OM.SIZE_ONESIZE_EN                              AS SIZE_ONESIZE_EN,
					OM.SIZE_A1_CN                                   AS SIZE_A1_CN,
					OM.SIZE_A2_CN                                   AS SIZE_A2_CN,
					OM.SIZE_A3_CN                                   AS SIZE_A3_CN,
					OM.SIZE_A4_CN                                   AS SIZE_A4_CN,
					OM.SIZE_A5_CN                                   AS SIZE_A5_CN,
					OM.SIZE_ONESIZE_CN                              AS SIZE_ONESIZE_CN,
					OM.CARE_DSN_KR                                  AS CARE_DSN_KR,
					OM.CARE_DSN_EN                                  AS CARE_DSN_EN,
					OM.CARE_DSN_CN                                  AS CARE_DSN_CN,
					OM.CARE_TD_KR                                   AS CARE_TD_KR,
					OM.CARE_TD_EN                                   AS CARE_TD_EN,
					OM.CARE_TD_CN                                   AS CARE_TD_CN,
					OM.DETAIL_KR                                    AS DETAIL_KR,
					OM.DETAIL_EN                                    AS DETAIL_EN,
					OM.DETAIL_CN                                    AS DETAIL_CN,
					OM.MATERIAL_KR									AS MATERIAL_KR,
					OM.MATERIAL_EN									AS MATERIAL_EN,
					OM.MATERIAL_CN									AS MATERIAL_CN,
					IFNULL(OM.MANUFACTURER, '')                     AS MANUFACTURER,
					IFNULL(OM.SUPPLIER, '')                         AS SUPPLIER,
					IFNULL(OM.ORIGIN_COUNTRY, '')                   AS ORIGIN_COUNTRY,
					IFNULL(OM.BRAND, '')                            AS BRAND,

					OM.LOAD_BOX_IDX									AS LOAD_BOX_IDX,
					LBI.BOX_NAME									AS LOAD_BOX_NAME,
					LBI.BOX_WIDTH									AS LOAD_BOX_WIDTH,
					LBI.BOX_LENGTH									AS LOAD_BOX_LENGTH,
					LBI.BOX_HEIGHT									AS LOAD_BOX_HEIGHT,
					LBI.BOX_VOLUME									AS LOAD_BOX_VOLUME,

					OM.DELIVER_BOX_IDX								AS DELIVER_BOX_IDX,
					DBI.BOX_NAME									AS DELIVER_BOX_NAME,
					DBI.BOX_WIDTH									AS DELIVER_BOX_WIDTH,
					DBI.BOX_LENGTH									AS DELIVER_BOX_LENGTH,
					DBI.BOX_HEIGHT									AS DELIVER_BOX_HEIGHT,
					DBI.BOX_VOLUME									AS DELIVER_BOX_VOLUME,
					
					OM.LOAD_WEIGHT                   				AS LOAD_WEIGHT,
					OM.LOAD_QTY                   					AS LOAD_QTY,
					IFNULL(OM.TD_SUB_MATERIAL_IDX, '')              AS TD_SUB_MATERIAL_IDX,
					IFNULL(OM.DELIVERY_SUB_MATERIAL_IDX, '')        AS DELIVERY_SUB_MATERIAL_IDX,
					OM.CREATE_DATE									AS CREATE_DATE,
					OM.CREATER										AS CREATER,
					OM.UPDATE_DATE									AS UPDATE_DATE,
					OM.UPDATER										AS UPDATER
				FROM 
					dev.ORDERSHEET_MST OM
				LEFT JOIN dev.LOAD_BOX_INFO LBI ON
					OM.LOAD_BOX_IDX = LBI.IDX
				LEFT JOIN dev.DELIVER_BOX_INFO DBI ON
					OM.DELIVER_BOX_IDX = DBI.IDX
				LEFT JOIN dev.LINE_INFO LI ON
					OM.LINE_IDX = LI.IDX
				LEFT JOIN dev.WKLA_INFO WI ON
					OM.WKLA_IDX = WI.IDX
				WHERE 
					OM.DEL_FLG = FALSE
				AND 
					OM.IDX = ".$sel_idx;

    $db->query($sql,$where_values);
    foreach($db->fetch() as $data) {
		$option_query = "
			SELECT
				OO.BARCODE						AS BARCODE,
				OO.OPTION_NAME					AS OPTION_NAME,
				IFNULL(OO.SIZE_CATEGORY,'')		AS SIZE_CATEGORY,
				
				SD.SIZE_TITLE_1					AS SIZE_TITLE_1,
				SD.SIZE_TITLE_2					AS SIZE_TITLE_2,
				SD.SIZE_TITLE_3					AS SIZE_TITLE_3,
				SD.SIZE_TITLE_4					AS SIZE_TITLE_4,
				SD.SIZE_TITLE_5					AS SIZE_TITLE_5,
				SD.SIZE_TITLE_6					AS SIZE_TITLE_6,
				
				SD.SIZE_DESC_1					AS SIZE_DESC_1,
				SD.SIZE_DESC_2					AS SIZE_DESC_2,
				SD.SIZE_DESC_3					AS SIZE_DESC_3,
				SD.SIZE_DESC_4					AS SIZE_DESC_4,
				SD.SIZE_DESC_5					AS SIZE_DESC_5,
				SD.SIZE_DESC_6					AS SIZE_DESC_6,
				
				IFNULL(OO.OPTION_SIZE_1,'-')	AS OPTION_SIZE_1,
				IFNULL(OO.OPTION_SIZE_2,'-')	AS OPTION_SIZE_2,
				IFNULL(OO.OPTION_SIZE_3,'-')	AS OPTION_SIZE_3,
				IFNULL(OO.OPTION_SIZE_4,'-')	AS OPTION_SIZE_4,
				IFNULL(OO.OPTION_SIZE_5,'-')	AS OPTION_SIZE_5,
				IFNULL(OO.OPTION_SIZE_6,'-')	AS OPTION_SIZE_6
			FROM
				dev.ORDERSHEET_OPTION OO	LEFT JOIN 
				dev.SIZE_DESCRIPTION SD 
			ON
				OO.SIZE_CATEGORY = SD.CATEGORY_NAME
			WHERE
				OO.ORDERSHEET_IDX = ".$sel_idx."
			ORDER BY
				OO.IDX
		";
		$db->query($option_query);
		
		$option_info = array();
		foreach($db->fetch() as $option_data){
			$option_info[] = array(
				'barcode'				=>$option_data['BARCODE'],
				'option_name'			=>$option_data['OPTION_NAME'],
				'size_category'    		=>$option_data['SIZE_CATEGORY'],
				
				'size_title_1'			=>$option_data['SIZE_TITLE_1'],
				'size_title_2'			=>$option_data['SIZE_TITLE_2'],
				'size_title_3'			=>$option_data['SIZE_TITLE_3'],
				'size_title_4'			=>$option_data['SIZE_TITLE_4'],
				'size_title_5'			=>$option_data['SIZE_TITLE_5'],
				'size_title_6'			=>$option_data['SIZE_TITLE_6'],
				
				'size_desc_1'			=>$option_data['SIZE_DESC_1'],
				'size_desc_2'			=>$option_data['SIZE_DESC_2'],
				'size_desc_3'			=>$option_data['SIZE_DESC_3'],
				'size_desc_4'			=>$option_data['SIZE_DESC_4'],
				'size_desc_5'			=>$option_data['SIZE_DESC_5'],
				'size_desc_6'			=>$option_data['SIZE_DESC_6'],

				'option_size_1'			=>$option_data['OPTION_SIZE_1'],
				'option_size_2'			=>$option_data['OPTION_SIZE_2'],
				'option_size_3'			=>$option_data['OPTION_SIZE_3'],
				'option_size_4'			=>$option_data['OPTION_SIZE_4'],
				'option_size_5'			=>$option_data['OPTION_SIZE_5'],
				'option_size_6'			=>$option_data['OPTION_SIZE_6']
			);
		}


		$td_sub_idx_str 		= $data['TD_SUB_MATERIAL_IDX'];
		$delivery_sub_idx_str 	= $data['DELIVERY_SUB_MATERIAL_IDX'];
		$sub_material_str		= '';

		if((strlen($td_sub_idx_str) > 0)){
			$sub_material_str .= $td_sub_idx_str;
		}
		if((strlen($delivery_sub_idx_str) > 0)){
			if(strlen($sub_material_str) > 0){
				$sub_material_str .= ',';
			}
			$sub_material_str .= $delivery_sub_idx_str;
		}
		if(strlen($sub_material_str) < 1){
			$sub_material_str .= '-1';
		}

		$sub_material_query = "
			SELECT
				IDX						AS SUB_MATERIAL_IDX,
				SUB_MATERIAL_NAME		AS SUB_MATERIAL_NAME,
				SUB_MATERIAL_TYPE		AS SUB_MATERIAL_TYPE,
				MEMO					AS SUB_MATERIAL_MEMO
			FROM
				dev.SUB_MATERIAL_INFO
			WHERE
				IDX IN (".$sub_material_str.")
			ORDER BY
				IDX ASC
		";
		$db->query($sub_material_query);
		
		$sub_material_info = array();
		foreach($db->fetch() as $sub_material_data){
			$sub_material_info[] = array(
				'sub_material_idx'			=>$sub_material_data['SUB_MATERIAL_IDX'],
				'sub_material_name'			=>$sub_material_data['SUB_MATERIAL_NAME'],
				'sub_material_type'    		=>$sub_material_data['SUB_MATERIAL_TYPE'],
				'sub_material_memo'			=>$sub_material_data['SUB_MATERIAL_MEMO']
			);
		}
		
		$json_result['data'] = array(
			'style_code'				=>$data['STYLE_CODE'],
			'color_code'				=>$data['COLOR_CODE'],
			'product_code'				=>$data['PRODUCT_CODE'],
			'preorder_flg'				=>$data['PREORDER_FLG'],
			'refund_flg'				=>$data['REFUND_FLG'],

			'line_idx'					=>$data['LINE_IDX'],
			'line_name'					=>$data['LINE_NAME'],
			'line_type'					=>$data['LINE_TYPE'],
			'line_memo'					=>$data['LINE_MEMO'],

			'category_lrg_title'		=>$data['CATEGORY_LRG_TITLE'],
			'category_mdl_title'		=>$data['CATEGORY_MDL_TITLE'],
			'category_sml_title'		=>$data['CATEGORY_SML_TITLE'],
			'category_dtl_title'		=>$data['CATEGORY_DTL_TITLE'],
			'category_idx'				=>$data['CATEGORY_IDX'],
			'category_lrg'				=>$data['CATEGORY_LRG'],
			'category_mdl'				=>$data['CATEGORY_MDL'],
			'category_sml'				=>$data['CATEGORY_SML'],
			'category_dtl'				=>$data['CATEGORY_DTL'],
			'category_idx'				=>$data['CATEGORY_IDX'],
			'material'					=>$data['MATERIAL'],
			'graphic'					=>$data['GRAPHIC'],
			'fit'						=>$data['FIT'],
			'product_name'				=>$data['PRODUCT_NAME'],
			'product_size'				=>$data['PRODUCT_SIZE'],
			'color'						=>$data['COLOR'],
			'color_rgb'					=>$data['COLOR_RGB'],
			'pantone_code'				=>$data['PANTONE_CODE'],
			'md_category_guide'			=>$data['MD_CATEGORY_GUIDE'],
			'limit_member'				=>$data['LIMIT_MEMBER'],
			'limit_qty'					=>$data['LIMIT_QTY'],
			'price_cost'				=>$data['PRICE_COST'],
			'price_kr'					=>$data['PRICE_KR'],
			'price_kr_gb'				=>$data['PRICE_KR_GB'],
			'price_en'					=>$data['PRICE_EN'],
			'price_cn'					=>$data['PRICE_CN'],
			'product_qty'				=>$data['PRODUCT_QTY'],
			'safe_qty'					=>$data['SAFE_QTY'],
			'launching_date'			=>$data['LAUNCHING_DATE'],
			'receive_request_date'		=>$data['RECEIVE_REQUEST_DATE'],
			'tp_completion_date'		=>$data['TP_COMPLETION_DATE'],
			'wkla_idx'					=>$data['WKLA_IDX'],
			'wkla_name'					=>$data['WKLA_NAME'],
			'wkla_memo'					=>$data['WKLA_MEMO'],
			'model'						=>$data['MODEL'],
			'model_wear'				=>$data['MODEL_WEAR'],
			'size_a1_kr'				=>$data['SIZE_A1_KR'],
			'size_a2_kr'				=>$data['SIZE_A2_KR'],
			'size_a3_kr'				=>$data['SIZE_A3_KR'],
			'size_a4_kr'				=>$data['SIZE_A4_KR'],
			'size_a5_kr'				=>$data['SIZE_A5_KR'],
			'size_onesize_kr'			=>$data['SIZE_ONESIZE_KR'],
			'size_a1_en'				=>$data['SIZE_A1_EN'],
			'size_a2_en'				=>$data['SIZE_A2_EN'],
			'size_a3_en'				=>$data['SIZE_A3_EN'],
			'size_a4_en'				=>$data['SIZE_A4_EN'],
			'size_a5_en'				=>$data['SIZE_A5_EN'],
			'size_onesize_en'			=>$data['SIZE_ONESIZE_EN'],
			'size_a1_cn'				=>$data['SIZE_A1_CN'],
			'size_a2_cn'				=>$data['SIZE_A2_CN'],
			'size_a3_cn'				=>$data['SIZE_A3_CN'],
			'size_a4_cn'				=>$data['SIZE_A4_CN'],
			'size_a5_cn'				=>$data['SIZE_A5_CN'],
			'size_onesize_cn'			=>$data['SIZE_ONESIZE_CN'],
			'care_dsn_kr'				=>$data['CARE_DSN_KR'],
			'care_dsn_en'				=>$data['CARE_DSN_EN'],
			'care_dsn_cn'				=>$data['CARE_DSN_CN'],
			'care_td_kr'				=>$data['CARE_TD_KR'],
			'care_td_en'				=>$data['CARE_TD_EN'],
			'care_td_cn'				=>$data['CARE_TD_CN'],
			'detail_kr'					=>$data['DETAIL_KR'],
			'detail_en'					=>$data['DETAIL_EN'],
			'detail_cn'					=>$data['DETAIL_CN'],
			'material_kr'				=>$data['MATERIAL_KR'],
			'material_en'				=>$data['MATERIAL_EN'],
			'material_cn'				=>$data['MATERIAL_CN'],
			'manufacturer'				=>$data['MANUFACTURER'],
			'supplier'					=>$data['SUPPLIER'],
			'origin_country'			=>$data['ORIGIN_COUNTRY'],
			'brand'						=>$data['BRAND'],

			'load_box_idx'				=>$data['LOAD_BOX_IDX'],
			'load_box_name'				=>$data['LOAD_BOX_NAME'],
			'load_box_width'			=>$data['LOAD_BOX_WIDTH'],
			'load_box_length'			=>$data['LOAD_BOX_LENGTH'],
			'load_box_height'			=>$data['LOAD_BOX_HEIGHT'],
			'load_box_volume'			=>$data['LOAD_BOX_VOLUME'],
			
			'deliver_box_idx'			=>$data['DELIVER_BOX_IDX'],
			'deliver_box_name'			=>$data['DELIVER_BOX_NAME'],
			'deliver_box_width'			=>$data['DELIVER_BOX_WIDTH'],
			'deliver_box_length'		=>$data['DELIVER_BOX_LENGTH'],
			'deliver_box_height'		=>$data['DELIVER_BOX_HEIGHT'],
			'deliver_box_volume'		=>$data['DELIVER_BOX_VOLUME'],
			
			'load_weight'				=>$data['LOAD_WEIGHT'],
			'load_qty'					=>$data['LOAD_QTY'],
			'sub_material_info'			=>$sub_material_info,
			'option_info'				=>$option_info,
			'size_category'				=>count($option_info) > 0?$option_info[0]['size_category']:'',
			'create_date'				=>$data['CREATE_DATE'],
			'creater'					=>$data['CREATER'],
			'update_date'				=>$data['UPDATE_DATE'],
			'updater'					=>$data['UPDATER'], 
		);
	}
}

?>