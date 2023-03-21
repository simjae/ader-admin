<!DOCTYPE html>
<html>
<head>
	<title>ADER WCC</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
	<link rel="stylesheet" href="/css/fonts/centurygothic.css" />
	<link rel="stylesheet" href="/scripts/jstree/style.css" />
	<link rel="stylesheet" href="/css/jquery-ui.min.css" />
	<link rel="stylesheet" href="/css/simple-line-icons.min.css" />
	<link rel="stylesheet" href="/css/layout.css" />
	<link rel="stylesheet" href="/css/contents.css" />
	<link rel="stylesheet" href="/css/responsive.css" />
	<link rel="stylesheet" href="/css/common.css" />

	<!-- BEGIN JAVASCRIPT -->
	<!-- jquery framework Scripts -->
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="/scripts/download.js"></script>
	<script src="/scripts/jszip.min.js"></script>
	<script src="/scripts/jszip-utils.min.js"></script>
	<script src="/scripts/jszip-utils-ie.min.js"></script>
	<script src="/scripts/jstree.min.js"></script>
	<script src="/scripts/modules/common.js"></script>
	<script src="/scripts/jquery.mask.min.js"></script>
	<script src="/scripts/jquery.timepicker.min.js"></script>
	<script src="/scripts/jquery.colorpicker.js"></script>
	<link rel="stylesheet" href="/scripts/jquery.timepicker.css" />
	<link rel="stylesheet" href="/scripts/jquery.colorpicker.css" />
	<script src="https://cdn.jsdelivr.net/npm/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web-animations-js@2.3.2/web-animations.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<!-- jquery add-on Scripts -->
	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="https://www.amcharts.com/lib/3/serial.js"></script>
	<script src="https://www.amcharts.com/lib/3/pie.js"></script>
	<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
	<script src="https://www.amcharts.com/lib/3/gauge.js"></script>
	<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
	<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" media="all" />
	<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
	<script src="//cdn.tiny.cloud/1/8hqw5yh8xbtwt4pm8v4989rj0osoy7jyes9s0kwkncucraz4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	<!-- DAUM Postcode Scripts -->
	<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

	<!-- Helix base scripts -->
	<script src="/scripts/static/functions.js"></script>
	<script src="/scripts/functions.js"></script>
	<script src="/scripts/helix.js"></script>
	
	<script src="/scripts/smarteditor2/js/HuskyEZCreator.js"></script>

	<!-- Excel Download -->
	<script src="/scripts/excel/xlsx.core.min.js"></script>
	<script src="/scripts/excel/FileSaver.min.js"></script>
	<script src="/scripts/excel/tableexport.js"></script>
	
	<!-- END JAVASCRIPT -->
</head>
<script>
	$(document).ready(function() {
		$('#btn_backend').click(function() {
			$('.header').css('background-color','#000000');
			$('#backend').show();
			$('#product_management').hide();
		})
		
		$('#btn_product_management').click(function() {
			$('.header').css('background-color','#0000c5');
			$('#backend').hide();
			$('#product_management').show();
		})
		
		var url = window.location.pathname;
		var path = url.substr(1,3);
		if (path == "pcs") {
			$('title').text('ADER PCS');
			$('.header .ader__logo .sub__logo img').attr('src', '/images/pcs-logo.svg');
			$('.header .ader__logo .sub__logo img').css('height', '15px');
			$('.header .ader__logo .sub__logo img').css('width', '40px');
			$('.header').css('background-color','#0000c5');
			$('#backend').hide();
			$('#product_management').show();
		}
		else{
			$('.header').css('background-color','#000000');
			$('#backend').show();
			$('#product_management').hide();
		}
	});
</script>

<?php include_once("check.php"); ?>

<body>
<div class="logo__benner">
	<div></div>
</div>
<div class="header">
	<div class="ader__logo" onclick="location.href='/analysis/dashboard'" style="cursor:pointer">
		<span class="main__logo"><img src="/images/header-logo.svg" alt=""></span>
		<span class="sub__logo"><img src="/images/webcontrolcenter-logo.svg" alt="" style="height: 15px;"></span>
	</div>
<?php 
	$request_uri = explode("?",$_SERVER['REQUEST_URI']);
	$permition_url = $request_uri[0];

	$admin_idx = $_SESSION['ADMIN_IDX'];


	if (!isset($admin_idx)) {
?>
	<div class="profile__wrap" onclick="location.href='/login'" style="cursor:pointer">
		<div class="profile__name">로그인</div>
	</div>
<?php	
	}
?>
	<!-- <div class="navigator__wrap">
		<div class="navigator__title">고객관리</div>
		<div class="navigator__bar">
			<span class="bar__1">Home</span><span class="bar__arrow">&#62;</span>
			<span class="bar__2"></span><span class="bar__arrow">&#62;</span>
			<span class="bar__3"></span>
		</div>	
	</div> -->
</div>
<div class="app">
	<div class="left-side">
		<div class="nav__wrap" id="backend">
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap" onclick="location.href='/analysis/dashboard'">
						<span class="nav__title" data-url="/dashboard">1. 대시보드</span>
					</div>
				</div>
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">2. 상점</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/store/policy">2-1. 이용약관 관리</div>
						<div class="nav__child" data-url="/store/admin">2-2. 운영자 관리</div>
						<!--<div class="nav__child" data-url="/store/notice">2-3. 알림메시지 설정</div>-->
						<div class="nav__child" data-url="/store/add_on">부가서비스 이용내역 조회</div>
						<div class="nav__child" data-url="/store/seo">검색엔진 최적화 설정</div>
						<div class="nav__child" data-url="/store/channel">채널관리(마케팅)</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">3. 회원</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/member/info">3-1. 회원 조회</div>
						<div class="nav__child" data-url="/member/mileage">3-2. 적립금 관리</div>
						<div class="nav__child" data-url="/member/voucher">3-3. 바우처 관리</div>
						<div class="nav__child" data-url="/member/visit" >3-4. 회원 접속 관리</div>
						<div class="nav__child" data-url="/display/board" >3-5. 게시판 관리</div>
						<div class="nav__child" data-url="/member/reorder/sms" >3-6. 재입고 SMS 발송</div>
						<div class="nav__child" data-url="/member/mail" >3-7. 자동 메일 발송</div>
						<div class="nav__child" data-url="/member/sms">3-8. SMS 설정</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">4. 상품</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/product/classify">4-1. 상품 분류</div>
						<div class="nav__child" data-url="/product/list">4-2. 상품 목록</div>
						<div class="nav__child" data-url="/product/regist">4-3. 상품 적용</div>
						<div class="nav__child" data-url="/display/product">4-4. 상품 진열</div>
						<div class="nav__child" data-url="/product/update">4-5. 상품 일괄 변경</div>
						<div class="nav__child" data-url="/product/indp/regist">4-6. 개별 상품 등록</div>
						<div class="nav__child" data-url="/product/set">4-7. 상품 세트 등록</div>
						<div class="nav__child" data-url="/product/excel">4-8. 엑셀 등록</div>
						<div class="nav__child" data-url="/product/delete">4-9. 삭제 상품 관리</div>
						<div class="nav__child" data-url="/product/stock">4-10. 상품 재고 현황</div>
						<div class="nav__child" data-url="/product/bluemark">4-11. 블루마크 관리</div>
						<div class="nav__child" data-url="/product/recommend">4-12. 추천 상품 관리</div>
						<div class="nav__child" data-url="/product/filter">4-13. 상품 필터 관리</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">5. 전시</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/display/landing">5-1. 랜딩 페이지 관리</div>
						<div class="nav__child" data-url="/display/posting/story" >5-2. 스토리 관리</div>
						<div class="nav__child" data-url="/display/posting" >5-3. 게시물 관리</div>
						<div class="nav__child" data-url="/display/menu">5-4. 카테고리 관리</div>
						<div class="nav__child" data-url="/display/popup/list" >5-5. 팝업 관리</div>
						<div class="nav__child" data-url="/display/search">5-6. 검색 관리</div>
						<div class="nav__child" data-url="/display/store" >5-7. 매장보기 관리</div>


						<div class="nav__child" data-url="/display/whats/regist" style="display:none;">What's New 등록</div>
						<div class="nav__child" data-url="/display/popup/regist" style="display:none;">팝업 등록</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">6. 프로모션</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
					<!--<div class="nav__child" data-url="/display/event" >6-1. 이벤트 관리</div>-->
					<div class="nav__child" data-url="/display/standby" >6-1. 스탠바이 관리</div>
						<div class="nav__child" data-url="/display/preorder" >6-2. 프리오더 관리</div>
						<div class="nav__child" data-url="/display/draw" >6-3. 드로우 관리</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">7. 주문</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/order/list" >7-1. 전체 주문 조회</div>
						<div class="nav__child" data-url="/order/management" >7-2. 취소/교환/반품/환불</div>
						<div class="nav__child" data-url="/order/deposit">7-3. 자동입금 확인 관리</div>
						<div class="nav__child" data-url="/order/deliver" >7-4. 배송 설정</div>
						<div class="nav__child" data-url="/order/receipt">7-5. 현금영수증 관리</div>
						<div class="nav__child" data-url="/order/admin">7-6. 관리자 메모 조회</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">8. 분석</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">  
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/analysis/exel">8-1. 통합 엑셀 다운로드</div>
						<div class="nav__child" data-url="/analysis/dashboard" style="display:none;">대시보드</div>
					</div>	
				</div>	
			</div>
			<!--
			<div class="nav__parent__wrap" id="btn_product_management">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">PCS</span> 
					</div>
				</div>	
			</div>
			-->
		</div>
		
		<div class="nav__wrap" id="product_management" style="display:none;">
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">1. 항목 관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/ordersheet/line">1-1. 항목::LINE</div>
						<div class="nav__child" data-url="/pcs/ordersheet/line_type">1-2. 항목::LINE 타입</div>
						<div class="nav__child" data-url="/pcs/ordersheet/wkla">1-3. 항목::WKLA</div>
						<div class="nav__child" data-url="/pcs/ordersheet/custom_clearance">1-4. 항목::해외통관</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">2. 부자재 관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/ordersheet/box">2-1. 부자재::배송박스</div>
						<div class="nav__child" data-url="/pcs/ordersheet/package_sub_material">2-2. 부자재::포장 부자재</div>
						<div class="nav__child" data-url="/pcs/ordersheet/delivery_sub_material">2-3. 부자재::배송 부자재</div>
						<div class="nav__child" data-url="/pcs/ordersheet/sub_material/excel">2-4. 부자재::엑셀 등록</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">3. 상품 관리 (오더시트)</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/ordersheet/classify">3-1. 상품::카테고리</div>
						<div class="nav__child" data-url="/pcs/ordersheet/list">3-2. 상품::제품 리스트</div>
						<div class="nav__child" data-url="/pcs/ordersheet/excel">3-3. 상품::엑셀 등록</div>
						<?php
							if ($history_flg == true) {
						?>
						<div class="nav__child" data-url="/pcs/ordersheet/history">3-4. 상품::LOG</div>
						<?php
							}
						?>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">5. 홀세일 관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/wholesale/list">홀세일 리스트 조회</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">6. 샘플 관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/sample/list" >샘플 리스트 조회</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">7. 생산업체 관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/factory/list">공장별 수주 정보 조회</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">8. 블루마크</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pcs/bluemark">8-1 블루마크::관리</div>
					</div>	
				</div>	
			</div>

			<!--
			<div class="nav__parent__wrap" id="btn_backend">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">컨트롤 센터</span> 
					</div>
				</div>	
			</div>
			-->
		</div>
	</div>

	<div id="container">
<!-- BEGIN : CONTAINER -->
