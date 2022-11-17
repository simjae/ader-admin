<!DOCTYPE html>
<html>
<head>
	<title>CONTROL CENTER</title>
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
		var path = url.substr(1,2);
		
		if (path == "pm") {
			$('.header').css('background-color','#0000c5');
			$('#backend').hide();
			$('#product_management').show();
		}
	});
</script>
<body>
<div class="logo__benner">
	<div></div>
</div>
<div class="header">
	<div class="ader__logo">
		<span class="main__logo"><img src="/images/header-logo.svg" alt=""></span>
		<span class="sub__logo"><img src="/images/center-logo.svg" alt="" style="width: 66px;"></span>
	</div>
	<div class="profile__wrap">
		<div class="profile__logo"></div>
		<div class="profile__name">관리자</div>
		<img src="/images/arrow-down.svg" alt="">
	</div>
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
						<span class="nav__title" data-url="/dashboard">대시보드</span>
					</div>
				</div>
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">상점관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/store/info">기본정보관리</div>
						<div class="nav__child" data-url="/store/admin">운영자 관리</div>
						<div class="nav__child" data-url="/store/notice">홈페이지 내 알림메시지 설정</div>
						<div class="nav__child" data-url="/store/add_on">부가서비스 이용내역 조회</div>
						<div class="nav__child" data-url="/store/seo">검색엔진 최적화 설정</div>
						<div class="nav__child" data-url="/store/channel">채널관리(마케팅)</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">고객관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/member/info" >회원 조회</div>
						<div class="nav__child" data-url="/member/visit" >회원 방문관리</div>
						<div class="nav__child" data-url="/member/reserve">적립금 관리</div>
						<div class="nav__child" data-url="/member/coupon">쿠폰관리</div>
						<div class="nav__child" data-url="/member/sms" >재입고 SMS 발송 관리</div>
						<div class="nav__child" data-url="/member/mail" >자동 메일 발송 설정</div>
						<div class="nav__child" data-url="/member/kakao">SMS(카카오톡) 사용 설정</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">상품관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/product/classify">상품 분류 관리</div>
						<div class="nav__child" data-url="/product/register">개별 상품 등록</div>
						<div class="nav__child" data-url="/product/regist">독립몰 상품 등록</div>
						<div class="nav__child" data-url="/product/set">세트 상품 등록</div>
						<div class="nav__child" data-url="/product/excel">엑셀 등록</div>
						<div class="nav__child" data-url="/product/list">상품 목록</div>
						<div class="nav__child" data-url="/product/update">상품 정보 일괄 변경</div>
						<div class="nav__child" data-url="/product/delete">삭제 상품 목록</div>
						<div class="nav__child" data-url="/product/stock">상품 재고 관리</div>
						<div class="nav__child" data-url="/product/bluemark">블루마크</div>
						<div class="nav__child" data-url="/product/recommend">추천 상품</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">전시관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/display/product">상품 진열</div>
						<div class="nav__child" data-url="/display/board" >게시판 관리</div>
						<div class="nav__child" data-url="/display/posting" >게시물 관리</div>
						<div class="nav__child" data-url="/display/whats/list" >What's New 관리</div>
						<div class="nav__child" data-url="/display/whats/regist"style="display:none;">What's New 등록</div>
						<div class="nav__child" data-url="/display/popup/list" >팝업 관리</div>
						<div class="nav__child" data-url="/display/popup/regist" style="display:none;">팝업 등록</div>
						<div class="nav__child" data-url="/display/event" >이벤트 관리</div>
						<div class="nav__child" data-url="/display/draw" >드로우 관리</div>
						<div class="nav__child" data-url="/display/menu">메뉴 편집</div>
						<div class="nav__child" data-url="/display/store" >매장보기 관리</div>
						<div class="nav__child" data-url="/display/landing">랜딩페이지 관리</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">주문관리</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/order/list" >전체 주문 조회</div>
						<div class="nav__child" data-url="/order/management" >취소/교환/반품/환불 관리</div>
						<div class="nav__child" data-url="/order/deposit">자동입금 내역확인</div>
						<div class="nav__child" data-url="/order/deliver" >배송 설정</div>
						<div class="nav__child" data-url="/order/receipt">현금영수증 관리</div>
						<div class="nav__child" data-url="/order/admin">관리자 메모 조회</div>
					</div>	
				</div>	
			</div>
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">분석/대시보드</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">  
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/analysis/exel">통합엑셀 다운로드</div>
						<div class="nav__child" data-url="/analysis/dashboard">대시보드</div>
					</div>	
				</div>	
			</div>
			
			<div class="nav__parent__wrap" id="btn_product_management">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">독립몰 상품관리</span> 
					</div>
				</div>	
			</div>
		</div>
		
		<div class="nav__wrap" id="product_management" style="display:none;">
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">오더시트</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pm/ordersheet/classify">오더시트 분류 관리</div>
						<div class="nav__child" data-url="/pm/ordersheet/list">오더시트 리스트</div>
						<div class="nav__child" data-url="/pm/ordersheet/history">오더시트 히스토리</div>
						<div class="nav__child" data-url="/pm/ordersheet/line">라인 관리</div>
						<div class="nav__child" data-url="/pm/ordersheet/wkla">W/K/L/A 관리</div>
						<div class="nav__child" data-url="/pm/ordersheet/load_box">적재박스 관리</div>
						<div class="nav__child" data-url="/pm/ordersheet/td_sub_material">생산 부자재 관리</div>
						<div class="nav__child" data-url="/pm/ordersheet/delivery_sub_material">배송 부자재 관리</div>
					</div>	
				</div>	
			</div>
			
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">샘플 정보</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pm/sample/list" >샘플 리스트 조회</div>
					</div>	
				</div>	
			</div>
			
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">홀세일 정보</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">	    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pm/wholesale/list">홀세일 리스트 조회</div>
					</div>	
				</div>	
			</div>
			
			<div class="nav__parent__wrap">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">공장별 수주정보</span><img class="nav__tilte__icon" src="/images/plus.svg" alt="">		    
					</div>
					<div class="nav__child__wrap">
						<div class="nav__child" data-url="/pm/factory/list">공장별 수주 정보 조회</div>
					</div>	
				</div>	
			</div>
			
			<div class="nav__parent__wrap" id="btn_backend">
				<div class="nav__parent">
					<div class="nav__title__wrap">
						<span class="nav__title">ADER 독립몰 백엔드 메뉴</span> 
					</div>
				</div>	
			</div>
		</div>
	</div>

	<div id="container">
<!-- BEGIN : CONTAINER -->
