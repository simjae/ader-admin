<?php


$json_result = array(
	'pay' => array(
		// 결제대기
		'ready' => array(
			'count' => $db->count($_TABLE['SHOP_ORDER'],'STATUS IN ("주문완료","결제대기")'),
			'title' => '결제대기'
		),

		// 결제완료
		'paid' => array(
			'count' => $db->count($_TABLE['SHOP_ORDER'],'STATUS IN ("결제확인")'),
			'title' => '결제완료'
		)
	),

	'delivery' => array(
		// 배송준비중
		'ready' => array(
			'count' => $db->count($_TABLE['SHOP_ORDER'],'STATUS IN ("배송준비")'),
			'title' => '배송준비중'
		),

		// 배송중
		'ing' => array(
			'count' => $db->count($_TABLE['SHOP_ORDER'],'STATUS IN ("배송중")'),
			'title' => '배송중'
		)
	)
);

?>