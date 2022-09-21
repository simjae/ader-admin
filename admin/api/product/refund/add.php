<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$refund_category	= $_POST['refund_category'];
$refund_title		= $_POST['refund_title'];
$refund_content_kr	= $_POST['refund_content_kr'];
$refund_content_en	= $_POST['refund_content_en'];
$refund_content_cn	= $_POST['refund_content_cn'];

$sql = "INSERT INTO
			dev.PRODUCT_REFUND
		(
			REFUND_CATEGORY,
			REFUND_TITLE,
			REFUND_CONTENT_KR,
			REFUND_CONTENT_EN,
			REFUND_CONTENT_CN,
			CREATE_DATE,
			CREATER,
			UPDATE_DATE,
			UPDATER
		) VALUES (
			'".$refund_category."',
			'".$refund_title."',
			'".$refund_content_kr."',
			'".$refund_content_en."',
			'".$refund_content_cn."',
			NOW(),
			'Admin',
			NOW(),
			'Admin'
		)";

$db->query($sql);
?>