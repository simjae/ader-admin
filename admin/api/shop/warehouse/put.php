<?php
/*
 +=============================================================================
 | 
 | 상품 입력
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.08.23
 | 최종 수정일	: 2020.04.17
 | 버전		: 1.0
 | 설명		: (2015.8.23) 최초작성
 | 
 +=============================================================================
*/

/** 01. 변수 정리 **/
$barcode = strip_tags(strtoupper($barcode));
$name = strip_tags(addslashes(trim($name)));
$color = strip_tags(addslashes(trim($color)));
$color_code = strip_tags(addslashes(trim($color_code)));
$refund_yn = (strtoupper($refund_yn)=='Y')?'Y':'N';
$display_yn = (strtoupper($display_yn)=='Y')?'Y':'N';
$option_yn = (strtoupper($option_yn)=='Y')?'Y':'N';
$soldout_yn = (strtoupper($soldout_yn)=='Y')?'Y':'N';
$sell_date_yn = (strtoupper($sell_date_yn)=='Y')?'Y':'N';
$delivery_free_yn = (strtoupper($delivery_free_yn)=='Y')?'Y':'N';
$paymethod_yn = (strtoupper($paymethod_yn)=='Y')?'Y':'N';
$feature1_yn = (strtoupper($feature1_yn)=='Y')?'Y':'N';
$feature2_yn = (strtoupper($feature2_yn)=='Y')?'Y':'N';
$feature3_yn = (strtoupper($feature3_yn)=='Y')?'Y':'N';
$feature4_yn = (strtoupper($feature4_yn)=='Y')?'Y':'N';
$feature3_yn = $refund_yn;
$stock_unlimit_yn = (strtoupper($stock_unlimit_yn)=='Y')?'Y':'N';
$stock = intval($stock);
$weight = intval($weight);
if(is_array($display_language)) $display_language = strtoupper(implode(',',$display_language));
for($i=0;$i<sizeof($detail);$i++) {
	foreach($detail[$i] as $key => $val) {
		$detail[$i][$key] = del_html(addslashes(trim($val)));
	}
}


/** 02. DB 작업 **/
if(is_numeric($no)) {
	$result = db_update(
		$_TABLE['SHOP_WARE'],
		'
			BARCODE = "'.$barcode.'", 
			NAME = "'.$name.'", 
			WEIGHT = "'.$weight.'", 
			COLOR = "'.$color.'", 
			COLOR_CODE = "'.$color_code.'", 
			STOCK = "'.$stock.'", 
			STOCK_UNLIMIT_YN = "'.$stock_unlimit_yn.'", 
			FEATURE1 = "'.$feature1.'", 
			FEATURE1_YN = "'.$feature1_yn.'", 
			FEATURE2 = "'.$feature2.'", 
			FEATURE2_YN = "'.$feature2_yn.'", 
			FEATURE3 = "'.$feature3.'", 
			FEATURE3_YN = "'.$feature3_yn.'", 
			FEATURE4 = "'.$feature4.'", 
			FEATURE4_YN = "'.$feature4_yn.'", 
			FEATURE5 = "'.$feature5.'", 
			FEATURE5_YN = "'.$feature5_yn.'", 
			SOLDOUT_YN = "'.$soldout_yn.'", 
			REFUND_YN = "'.$refund_yn.'", 
			SELL_DATE_YN = "'.$sell_date_yn.'", 
			SELL_SDATE = "'.$sell_sdate.'", 
			SELL_EDATE = "'.$sell_edate.'", 
			DISPLAY_YN = "'.$display_yn.'", 
			DISPLAY_DATE_YN = "'.$display_date_yn.'", 
			DISPLAY_SDATE = "'.$display_sdate.'", 
			DISPLAY_EDATE = "'.$display_edate.'", 
			DISPLAY_LANGUAGE = "'.$display_language.'", 
			DELIVERY_FREE_YN = "'.$delivery_free_yn.'", 
			PAYMETHOD_YN = "'.$paymethod_yn.'", 
			REMARK = "'.$remark.'" 
		',
		'IDX='.$no
	);
}
else {
	$result	= db_insert(
		$_TABLE['SHOP_WARE'],
		'
			"'.$category_no.'","'.$barcode.'","'.$name.'","'.$weight.'","'.$color.'","'.$color_code.'","'.$stock.'","'.$stock_unlimit_yn.'",
			"'.$feature1.'","'.$feature1_yn.'","'.$feature2.'","'.$feature2_yn.'","'.$feature3.'","'.$feature3_yn.'",
			"'.$feature4.'","'.$feature4_yn.'","'.$feature5.'","'.$feature5_yn.'",
			"'.$soldout_yn.'","'.$refund_yn.'","'.$sell_date_yn.'","'.$sell_sdate.'","'.$sell_edate.'",
			"'.$display_yn.'","'.$display_date_yn.'","'.$display_sdate.'","'.$display_edate.'","'.$display_language.'",
			"'.$delivery_free_yn.'","'.$paymethod_yn.'","'.$remark.'"
		',
		'
			CATEGORY_NO,BARCODE,NAME,WEIGHT,COLOR,COLOR_CODE,STOCK,STOCK_UNLIMIT_YN,
			FEATURE1,FEATURE1_YN,FEATURE2,FEATURE2_YN,FEATURE3,FEATURE3_YN,
			FEATURE4,FEATURE4_YN,FEATURE5,FEATURE5_YN,
			SOLDOUT_YN,REFUND_YN,SELL_DATE_YN,SELL_SDATE,SELL_EDATE,
			DISPLAY_YN,DISPLAY_DATE_YN,DISPLAY_SDATE,DISPLAY_EDATE,DISPLAY_LANGUAGE,
			DELIVERY_FREE_YN,PAYMETHOD_YN,REMARK
		'
	);
	$no = db_lastidx();
}


/** 02. DB 작업 : 가격 정보 입력 **/
if($result) {
	$fields = 'GOODS_NO,COUNTRY,PRICE,PRICE_ORG,PRICE_TXT';
	foreach($price as $key=>$val) {
		$language = strtoupper($key);

		if(db_count($_TABLE['SHOP_WARE_PRICE'],'WARE_NO='.$no.' AND OPTIONVAL_NO=0') > 0) {
			$result = db_update(
				$_TABLE['SHOP_WARE_PRICE'],
				'
					CURRENCY = "'.$_CONFIG['CURRENCY'][$language]['CODE'].'",
					PRICE = "'.$val.'"
				',
				'WARE_NO='.$no.' AND OPTIONVAL_NO=0 AND LANGUAGE="'.$language.'"'
			);
		}
		else {
			$result = db_insert(
				$_TABLE['SHOP_WARE_PRICE'],
				'WARE_NO,OPTIONVAL_NO,LANGUAGE,CURRENCY,PRICE',
				$no.',0,"'.$_CONFIG['CURRENCY'][$language]['CODE'].'","'.$val.'"'
			);
		}
	}
}


/** 02. DB 작업 : 상세 정보 입력 **/
if($result && is_array($detail)) {
	for($i=0;$i<sizeof($detail);$i++) {
		foreach($detail[$i] as $key=>$val) {
			$language = strtoupper(str_replace(array(','),'',$key));
			$title = $detail_title[$i][$language];
			$where = 'WARE_NO='.$no.' AND OPTIONVAL_NO=0 AND TITLE="'.$title.'" AND LANGUAGE="'.str_replace("'",'',$language).'"';

			if(db_count($_TABLE['SHOP_WARE_DETAIL'],$where) > 0) {
				$result = db_update(
					$_TABLE['SHOP_WARE_DETAIL'],
					'CONTENTS = "'.$detail[$i][$language].'"',
					$where
				);
			}
			else {
				$result = db_insert(
					$_TABLE['SHOP_WARE_DETAIL'],
					'WARE_NO,LANGUAGE,TITLE,CONTENTS',
					$no.',"'.str_replace("'",'',$language).'","'.$detail_title[$i][$language].'","'.$detail[$i][$language].'"'
				);
			}
		}
	}
}


/** 02. DB 작업 : 옵션 정보 입력 **/


/** 03. 이미지 업로드 : 커버 이미지 업로드 **/
if($_FILES['img_list']['size']>0) {
	$upload_path = 'images/'.date('Ymd').'/'; // 업로드 위치
	$img_list = file_up('img_list',$_CONFIG['PATH_UPLOAD_PRODUCT'].$upload_path); // 이미지 업로드

	// 썸네일 생성
	@make_thumbnail($_CONFIG['PATH_UPLOAD_PRODUCT'].$upload_path.$img_list, 150, 200, $_CONFIG['PATH_UPLOAD_PRODUCT'].$upload_path.'thumbnail/'.$img_list); 

	$img_list = $_CONFIG['URL_UPLOAD_PRODUCT'].$upload_path.$img_list;

	$where = 'WARE_NO='.$no.' AND DEVICE="PC" AND CATEGORY="목록"';
	if(db_count($_TABLE['SHOP_WARE_IMAGE'],$where) > 0) {
		$result = db_update(
			$_TABLE['SHOP_WARE_IMAGE'],
			'IMG="'.$img_list.'"',
			$where
		);
	}
	else {
		$result = db_insert(
			$_TABLE['SHOP_WARE_IMAGE'],
			'WARE_NO,DEVICE,CATEGORY,IMG,STATUS',
			$no.',"PC","목록","'.$img_list.'","Y"'
		);
	}
}


/** 03. 이미지 업로드 : 상세 이미지 업로드 **/
if(is_array($img_detail_no)) {
	@db_delete($_TABLE['SHOP_WARE_IMAGE'],'CATEGORY="상세" AND DEVICE="PC" AND WARE_NO='.$no.' AND IDX NOT IN('.implode(',',$img_detail_no).')');
}
if(is_array($_FILES['img_detail'])) {
	$img_file = null;
	$upload_path = 'images/'.date('Ymd').'/detail/'; // 업로드 위치
	$seq = 0;
	for($i=0;$i<count($_FILES['img_detail']['name']);$i++) {
		$_temp_file['name'] = $_FILES['img_detail']['name'][$i];
		$_temp_file['type'] = $_FILES['img_detail']['type'][$i];
		$_temp_file['tmp_name'] = $_FILES['img_detail']['tmp_name'][$i];
		$_temp_file['error'] = $_FILES['img_detail']['error'][$i];
		$_temp_file['size'] = $_FILES['img_detail']['size'][$i];

		$img = file_up($_temp_file,$_CONFIG['PATH_UPLOAD_PRODUCT'].$upload_path,'','',true); // 이미지 업로드
		if($img != '') {
			@make_thumbnail($_CONFIG['PATH_UPLOAD_PRODUCT'].$upload_path.$img, 120, 150, $_CONFIG['PATH_UPLOAD_PRODUCT'].$upload_path.'thumbnail/'.$img);
			$img = $_CONFIG['URL_UPLOAD_PRODUCT'].$upload_path.$img;
			$result = db_insert(
				$_TABLE['SHOP_WARE_IMAGE'],
				'WARE_NO,SEQ,DEVICE,CATEGORY,IMG',
				$no.','.$seq++.',"PC","상세","'.$img.'"'
			);
		}
	}
}
?>