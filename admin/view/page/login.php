<html>
<head>
	<title>CONTROL CENTER</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/2/xeicon.min.css" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/xeicon/1.0.4/xeicon.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" />
	<link rel="stylesheet" type="text/css" href="/css/login.css" />
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/scripts/functions.js"></script>
	<script type="text/javascript" src="/scripts/login.js"></script>
</head>
<body>

<div id="login-intro">
	<div class="container">
		<h1>CONTROL<i class="xi-cog xi-spin"></i>CENTER</h1>
		<div class="con" id="pwbox">
			<h3>임시 비밀번호 발급</h3>
			<div>등록된 이메일 주소를 입력하시면 임시 비밀번호를 발급하여 알려드립니다.</div>
			<div id="alert-box2" class="alert alert-danger margin-top-10 display-hide">
				<button class="close"></button>
				<span></span>
			</div>
			<form name="frm2" id="frm2" method="post" onSubmit="forgetpassword();return false;">
			<div class="form-group margin-top-20">
				<div class="input-icon">
					<i class="xi-mail-o"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="이메일주소" name="email"  required>
					<span class="-describe"></span>
				</div>
			</div>
			<div class="form-actions">
				<a class="btn gray" onclick="$('#loginbox').show();$('#pwbox').hide();">
					<i class="xi-arrow-left"></i> 돌아가기
				</a>
				<button type="submit" class="btn blue pull-right">
					확인 <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
			</form>
			<div class="bg"></div>
		</div>
		<div class="con" id="loginbox">
			<h3>관리자 로그인</h3>
			<div id="alert-box" class="alert alert-danger display-hide">
				<button class="close"></button>
				<span></span>
			</div>
			<form name="frm" id="frm" method="post" onSubmit="login();return false;">
			<div class="form-group">
				<div class="input-icon">
					<i class="xi-user"></i>
					<input class="form-control placeholder-no-fix" type="text" minlength="4" maxlength="15" autocomplete="off" placeholder="아이디" name="id" value="<?=$id?>" required>
					<span class="-describe"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="input-icon">
					<i class="xi-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" minlength="4" maxlength="20" autocomplete="off" placeholder="비밀번호" name="pw" value="<?=$pwd?>" required>
					<span class="-describe"></span>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
					<input type="checkbox" name="remember" value="1" <?php if($remember) echo "checked"; ?>>
					<i class="xi-check"></i>
					<span>비밀번호 기억</span>
				</label>
				<button type="submit" class="btn blue pull-right">
					로그인 <i class="m-icon-swapright m-icon-white"></i>
				</button>
			</div>
			</form>
			<div class="forget-password">
				<h4>비밀번호를 잊으셨나요?</h4>
				<input type="hidden" value="bvdev">
				<p><a id="forget-password" onclick="$('#loginbox').hide();$('#pwbox').show();">여기</a>에서 임시 비밀번호를 새로 발급받으세요</p>
			</div>
			<div class="bg"></div>
		</div>
		<div class="foot">2021 ©</div>
	</div>

	<div id="login-background"></div>
</div>

</body>
</html>