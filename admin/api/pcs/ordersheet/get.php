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
$sel_idx	 = $_POST['sel_idx'];

if($sel_idx != null){
	$select_ordersheet_sql = "
		SELECT
			OM.IDX											AS ORDERSHEET_IDX,
			IFNULL(OM.YEAR,'')								AS YEAR,
			OM.STYLE_CODE									AS STYLE_CODE,
			OM.COLOR_CODE									AS COLOR_CODE,
			OM.PRODUCT_CODE									AS PRODUCT_CODE,
			OM.PREORDER_FLG									AS PREORDER_FLG,
			OM.REFUND_FLG									AS REFUND_FLG,
			
			OM.LINE_IDX										AS LINE_IDX,
			IFNULL(LI.LINE_NAME,'')							AS LINE_NAME,
			(
				SELECT
					TYPE_NAME
				FROM
					LINE_TYPE LT
					LEFT JOIN LINE_INFO LI ON
					LT.IDX = LI.LINE_TYPE_IDX
				WHERE
					LI.IDX = OM.LINE_IDX
			)												AS LINE_TYPE,
			IFNULL(LI.MEMO,'')								AS LINE_MEMO,
			
			IFNULL(
				(
					SELECT
						TITLE
					FROM
						ORDERSHEET_CATEGORY
					WHERE
						IDX = OM.CATEGORY_LRG
				),''
			)												AS CATEGORY_LRG_TITLE,
			IFNULL(
				(
					SELECT
						TITLE
					FROM
						ORDERSHEET_CATEGORY
					WHERE
						IDX = OM.CATEGORY_MDL
				),''
			)												AS CATEGORY_MDL_TITLE,
			IFNULL(
				(
					SELECT
						TITLE
					FROM
						ORDERSHEET_CATEGORY
					WHERE
						IDX = OM.CATEGORY_SML
				),''
			)												AS CATEGORY_SML_TITLE,
			IFNULL(
				(
					SELECT
						TITLE
					FROM
						ORDERSHEET_CATEGORY
					WHERE
						IDX = OM.CATEGORY_DTL
				),''
			)												AS CATEGORY_DTL_TITLE,
			
			OM.CATEGORY_LRG									AS CATEGORY_LRG,
			OM.CATEGORY_MDL									AS CATEGORY_MDL,
			OM.CATEGORY_SML									AS CATEGORY_SML,
			OM.CATEGORY_DTL									AS CATEGORY_DTL,
			OM.CATEGORY_IDX									AS CATEGORY_IDX,
			
			IFNULL(OM.MATERIAL,'')							AS MATERIAL,
			IFNULL(OM.GRAPHIC,'')							AS GRAPHIC,
			IFNULL(OM.FIT,'')								AS FIT,
			IFNULL(OM.PRODUCT_NAME,'')						AS PRODUCT_NAME,
			IFNULL(OM.PRODUCT_SIZE,'')						AS PRODUCT_SIZE,
			IFNULL(OM.COLOR,'')								AS COLOR,
			IFNULL(OM.MD_CATEGORY_GUIDE,'')					AS MD_CATEGORY_GUIDE,
			IFNULL(OM.LIMIT_MEMBER,'')						AS LIMIT_MEMBER,
			IFNULL(OM.LIMIT_ID_FLG,FALSE)					AS LIMIT_ID_FLG,
			IFNULL(OM.LIMIT_PRODUCT_QTY_FLG,FALSE)			AS LIMIT_PRODUCT_QTY_FLG,
			IFNULL(OM.LIMIT_PRODUCT_QTY,0)					AS LIMIT_PRODUCT_QTY,
			IFNULL(OM.PRICE_COST,0)							AS PRICE_COST,
			IFNULL(OM.PRICE_KR,0)							AS PRICE_KR,
			IFNULL(OM.PRICE_KR_GB,0)						AS PRICE_KR_GB,
			IFNULL(OM.PRICE_EN,0)							AS PRICE_EN,
			IFNULL(OM.PRICE_CN,0)							AS PRICE_CN,
			IFNULL(OM.PRODUCT_QTY,0)						AS PRODUCT_QTY,
			IFNULL(OM.SAFE_QTY, 0)							AS SAFE_QTY,
			IFNULL(
				DATE_FORMAT(
					OM.LAUNCHING_DATE,
					'%Y-%m-%d'
				),'-')										AS LAUNCHING_DATE,
			IFNULL(
				DATE_FORMAT(
					OM.RECEIVE_REQUEST_DATE,
					'%Y-%m-%d'
				),'-')										AS RECEIVE_REQUEST_DATE,
			IFNULL(
				DATE_FORMAT(
					OM.TP_COMPLETION_DATE,
					'%Y-%m-%d'
				),'-')										AS TP_COMPLETION_DATE,
			
			OM.WKLA_IDX										AS WKLA_IDX,
			IFNULL(WI.WKLA_NAME,'W/K/L/A 미선택')				AS WKLA_NAME,
			IFNULL(WI.MEMO,'-')								AS WKLA_MEMO,

			IFNULL(OM.MODEL,'')					 			AS MODEL,
			IFNULL(OM.MODEL_WEAR,'')						AS MODEL_WEAR,
			
			OM.SIZE_GUIDE_CATEGORY							AS SIZE_GUIDE_CATEGORY,
			
			OM.MATERIAL_DSN_KR								AS MATERIAL_DSN_KR,
			OM.MATERIAL_DSN_EN								AS MATERIAL_DSN_EN,
			OM.MATERIAL_DSN_CN								AS MATERIAL_DSN_CN,
			
			OM.DETAIL_KR									AS DETAIL_KR,
			OM.DETAIL_EN									AS DETAIL_EN,
			OM.DETAIL_CN									AS DETAIL_CN,
			
			OM.CARE_DSN_KR									AS CARE_DSN_KR,
			OM.CARE_DSN_EN									AS CARE_DSN_EN,
			OM.CARE_DSN_CN									AS CARE_DSN_CN,
			
			OM.MATERIAL_TD_KR								AS MATERIAL_TD_KR,
			OM.MATERIAL_TD_EN								AS MATERIAL_TD_EN,
			OM.MATERIAL_TD_CN								AS MATERIAL_TD_CN,
			
			OM.CARE_TD_KR									AS CARE_TD_KR,
			OM.CARE_TD_EN									AS CARE_TD_EN,
			OM.CARE_TD_CN									AS CARE_TD_CN,
			
			IFNULL(OM.MANUFACTURER,'')						AS MANUFACTURER,
			IFNULL(OM.SUPPLIER,'')							AS SUPPLIER,
			IFNULL(OM.ORIGIN_COUNTRY,'')					AS ORIGIN_COUNTRY,
			OM.BRAND										AS BRAND,

			OM.LOAD_BOX_IDX									AS LOAD_BOX_IDX,
			BI.BOX_NAME										AS LOAD_BOX_NAME,
			BI.BOX_WIDTH									AS LOAD_BOX_WIDTH,
			BI.BOX_LENGTH									AS LOAD_BOX_LENGTH,
			BI.BOX_HEIGHT									AS LOAD_BOX_HEIGHT,
			BI.BOX_VOLUME									AS LOAD_BOX_VOLUME,				
			
			OM.LOAD_WEIGHT									AS LOAD_WEIGHT,
			OM.LOAD_QTY										AS LOAD_QTY,
			OM.CREATE_DATE									AS CREATE_DATE,
			OM.CREATER										AS CREATER,
			OM.UPDATE_DATE									AS UPDATE_DATE,
			OM.UPDATER										AS UPDATER
		FROM 
			ORDERSHEET_MST OM
			LEFT JOIN BOX_INFO BI ON
			OM.LOAD_BOX_IDX = BI.IDX
			LEFT JOIN LINE_INFO LI ON
			OM.LINE_IDX = LI.IDX
			LEFT JOIN WKLA_INFO WI ON
			OM.WKLA_IDX = WI.IDX
		WHERE 
			OM.IDX = ".$sel_idx."
	";

	$db->query($select_ordersheet_sql);
	
	foreach($db->fetch() as $data) {
		$select_ordersheet_option_sql = "
			SELECT
				OO.IDX							AS OPTION_IDX,
				OO.BARCODE						AS BARCODE,
				OO.OPTION_NAME					AS OPTION_NAME,
				
				IFNULL(OO.OPTION_SIZE_1,'')		AS OPTION_SIZE_1,
				IFNULL(OO.OPTION_SIZE_2,'')		AS OPTION_SIZE_2,
				IFNULL(OO.OPTION_SIZE_3,'')		AS OPTION_SIZE_3,
				IFNULL(OO.OPTION_SIZE_4,'')		AS OPTION_SIZE_4,
				IFNULL(OO.OPTION_SIZE_5,'')		AS OPTION_SIZE_5,
				IFNULL(OO.OPTION_SIZE_6,'')		AS OPTION_SIZE_6,
				
				OO.OPTION_WEIGHT				AS OPTION_WEIGHT,
				OO.LIMIT_OPTION_QTY				AS LIMIT_OPTION_QTY
			FROM
				ORDERSHEET_OPTION OO
			WHERE
				OO.ORDERSHEET_IDX = ".$sel_idx."
			ORDER BY
				OO.IDX
		";
		
		$db->query($select_ordersheet_option_sql);
		
		$option_info = array();
		foreach($db->fetch() as $option_data){
			$option_info[] = array(
				'option_idx'			=>$option_data['OPTION_IDX'],
				'barcode'				=>$option_data['BARCODE'],
				'option_name'			=>$option_data['OPTION_NAME'],

				'option_size_1'			=>$option_data['OPTION_SIZE_1'],
				'option_size_2'			=>$option_data['OPTION_SIZE_2'],
				'option_size_3'			=>$option_data['OPTION_SIZE_3'],
				'option_size_4'			=>$option_data['OPTION_SIZE_4'],
				'option_size_5'			=>$option_data['OPTION_SIZE_5'],
				'option_size_6'			=>$option_data['OPTION_SIZE_6'],

				'option_weight'			=>$option_data['OPTION_WEIGHT'],
				'limit_option_qty'		=>$option_data['LIMIT_OPTION_QTY']
			);
		}

		$select_sub_material_sql = "
			SELECT
				MI.IDX						AS SUB_MATERIAL_IDX,
				MI.SUB_MATERIAL_NAME		AS SUB_MATERIAL_NAME,
				MI.SUB_MATERIAL_TYPE		AS SUB_MATERIAL_TYPE,
				MI.MEMO						AS SUB_MATERIAL_MEMO
			FROM
				SUB_MATERIAL_MAPPING MM
				LEFT JOIN SUB_MATERIAL_INFO MI ON
				MM.SUB_MATERIAL_IDX = MI.IDX
			WHERE
				MM.ORDERSHEET_IDX = ".$sel_idx."
		";
		
		$db->query($select_sub_material_sql);
		
		$sub_material_info = array();
		foreach($db->fetch() as $sub_material_data){
			$sub_material_info[] = array(
				'sub_material_idx'			=>$sub_material_data['SUB_MATERIAL_IDX'],
				'sub_material_name'			=>$sub_material_data['SUB_MATERIAL_NAME'],
				'sub_material_type'			=>$sub_material_data['SUB_MATERIAL_TYPE'],
				'sub_material_memo'			=>$sub_material_data['SUB_MATERIAL_MEMO']
			);
		}
		
		$json_result['data'] = array(
			'year'						=>$data['YEAR'],
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
			
			'material'					=>$data['MATERIAL'],
			'graphic'					=>$data['GRAPHIC'],
			'fit'						=>$data['FIT'],
			'product_name'				=>$data['PRODUCT_NAME'],
			'product_size'				=>$data['PRODUCT_SIZE'],
			'color'						=>$data['COLOR'],
			'md_category_guide'			=>$data['MD_CATEGORY_GUIDE'],
			'limit_member'				=>$data['LIMIT_MEMBER'],
			'limit_id_flg'				=>$data['LIMIT_ID_FLG'],
			'limit_product_qty_flg'		=>$data['LIMIT_PRODUCT_QTY_FLG'],
			'limit_product_qty'			=>$data['LIMIT_PRODUCT_QTY'],
			'price_cost'				=>$data['PRICE_COST'],
			'price_kr'					=>$data['PRICE_KR'],
			'price_kr_gb'				=>$data['PRICE_KR_GB'],
			'price_en'					=>$data['PRICE_EN'],
			'price_cn'					=>$data['PRICE_CN'],
			'price_cost_format'			=>number_format($data['PRICE_COST']),
			'price_kr_format'			=>number_format($data['PRICE_KR']),
			'price_kr_gb_format'		=>number_format($data['PRICE_KR_GB']),
			'price_en_format'			=>number_format($data['PRICE_EN']),
			'price_cn_format'			=>number_format($data['PRICE_CN']),
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
			'size_guide_category'		=>$data['SIZE_GUIDE_CATEGORY'],
			
			'material_dsn_kr'			=>$data['MATERIAL_DSN_KR'],
			'material_dsn_en'			=>$data['MATERIAL_DSN_EN'],
			'material_dsn_cn'			=>$data['MATERIAL_DSN_CN'],
			
			'detail_kr'					=>$data['DETAIL_KR'],
			'detail_en'					=>$data['DETAIL_EN'],
			'detail_cn'					=>$data['DETAIL_CN'],
			
			'care_dsn_kr'				=>$data['CARE_DSN_KR'],
			'care_dsn_en'				=>$data['CARE_DSN_EN'],
			'care_dsn_cn'				=>$data['CARE_DSN_CN'],
			
			'material_td_kr'			=>$data['MATERIAL_TD_KR'],
			'material_td_en'			=>$data['MATERIAL_TD_EN'],
			'material_td_cn'			=>$data['MATERIAL_TD_CN'],
			
			'care_td_kr'				=>$data['CARE_TD_KR'],
			'care_td_en'				=>$data['CARE_TD_EN'],
			'care_td_cn'				=>$data['CARE_TD_CN'],
			
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
			'create_date'				=>$data['CREATE_DATE'],
			'creater'					=>$data['CREATER'],
			'update_date'				=>$data['UPDATE_DATE'],
			'updater'					=>$data['UPDATER'],
			
			'option_info'				=>$option_info,
			'sub_material_info'			=>$sub_material_info,
		);
	}
}

?>