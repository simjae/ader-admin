<!DOCTYPE html>
<html lang="ko">
	<head>
		<title></title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<meta name="facebook-domain-verification" content="" />
		<meta name ="google-signin-client_id" content="">
		<meta property="og:image" content="/images/og-image.png" />
		<meta property="og:title" content="">
		<meta property="og:description" content="">
		<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
		<!-- <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png"> -->

		<!-- <link rel="stylesheet" href="/scripts/static/swiper.min.css"> -->
		<link rel="stylesheet" href="/scripts/static/jquery-ui.min.css" />
		<link rel="stylesheet" href="/scripts/static/jquery.minicolors.css">
		<link rel="stylesheet" href="/scripts/static/farbtastic/farbtastic.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&family=Pathway+Gothic+One&family=Questrial&display=swap" rel="stylesheet"> -->
		<link href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css" rel="stylesheet">
		<link href="//cdn.jsdelivr.net/xeicon/1.0.4/xeicon.min.css" rel="stylesheet">
		<link href="/scripts/static/jquery.scrollbar.css" rel="stylesheet">
		<link rel="stylesheet" href="https://d13fzx7h5ezopb.cloudfront.net/fonts/font.css" />
		<link rel="stylesheet" href="/scripts/static/taggingJS/example/tag-basic-style.css" />
		<link rel="stylesheet" href="/scripts/static/toast-selectbox/toastui-select-box.min.css"/>
		<link rel=stylesheet href='/css/common/common.css' type='text/css'>
		<link rel=stylesheet href='/css/common/sidebar.css' type='text/css'>
		<link rel=stylesheet href='/css/common/footer.css' type='text/css'>
		<link rel=stylesheet href='/css/common/nav.css' type='text/css'>

		<script src="https://cdn.tailwindcss.com"></script>
		<script src="//code.jquery.com/jquery-latest.min.js"></script>
		<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
		<!-- <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=4462b31e026bb8cd62b6483c63163cb2&&libraries=services,clusterer,drawing"></script> -->
		<!-- <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script> -->

		<script src="//cdn.tiny.cloud/1/8hqw5yh8xbtwt4pm8v4989rj0osoy7jyes9s0kwkncucraz4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script src="//code.jquery.com/jquery-latest.min.js"></script>
		<script src="/scripts/static/jquery-ui.min.js"></script>
		<script src="/scripts/static/jquery.minicolors.min.js"></script>
		<script src="/scripts/static/jquery.scrollbar.min.js"></script>
		<script src="/scripts/static/jquery.animateNumber.min.js"></script>
		<script src="/scripts/static/jquery.mask.min.js"></script>
		<script src="/scripts/static/jquery.caret.js"></script>
		<script src="/scripts/static/jquery.detectmobilebrowser.js"></script>
		<!-- <script src="/scripts/static/swiper.min.js"></script> -->
		<script src="/scripts/static/farbtastic/farbtastic.js"></script>
		<script src="/scripts/static/functions.js"></script>
		<script src="/scripts/common.js" type="module"></script>
		<script src="/scripts/static/taggingJS/tagging.min.js"></script>
		<script src="/scripts/static/toast-selectbox/toastui-select-box.min.js"></script>
		<script src="/scripts/static/postcodify-master/api/search.js"></script>
		<script src="/scripts/functions.js?v=<?=time()?>"></script>
		<script src="/scripts/helix.js?v=<?=time()?>"></script>
		<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
		<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
		<meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">

		<!-- Apple id -->
		<meta name="appleid-signin-client-id" content="[CLIENT_ID]">
		<meta name="appleid-signin-scope" content="[SCOPES]">
		<meta name="appleid-signin-redirect-uri" content="[REDIRECT_URI]">
		<meta name="appleid-signin-state" content="[STATE]">
		<meta name="appleid-signin-nonce" content="[NONCE]">
		<meta name="appleid-signin-use-popup" content="true">
	</head>
	<body>
		<header>
			<?php include $_CONFIG['PATH']['PAGE'] . '/components/nav.php';?>
		</header>
		<div id="dimmer"></div>
		<div id="sidebar"></div>