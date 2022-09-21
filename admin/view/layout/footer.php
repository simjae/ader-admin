	</div>
	<!-- END : CONTAINER -->
	
	
</div>
<!-- BEGIN : FOOTER -->
<footer>
	2022 ⓒ ADERERROR
	<div id="scroll-to-top">
		<i class="xi-up-circle"></i>
	</div>
</footer>
<!-- END : FOOTER -->
<!-- BEGIN : HEADER --> 
	<!-- <header>
		<div class="bi">
			<span class="t">CONTROL<strong>CENTER</strong></span>
			<a href="javascript:;" id="btn-menu-shortly"></a>
		</div>
		<div class="top">
			<form id="form-search">
				<input type="hidden" name="m" value="search">
				<input type="text" name="query" class="anim-ease-02" placeholder="검색...">
				<button><i class="xi-search"></i></button>
			</form>
			<ul class="top-menu">
				<li class="dropdown">
					<i class="xi-bell-o"></i>
					<span class="num" id="num-notice"></span>
					<div class="dropdown-menu">
						<div class="header">총 0개의 알림이 있습니다.</div>
						<ul></ul>
						<span class="arrow"></span>
					</div>
				</li>
				<li class="dropdown profile">
					<img src="/<?=$_SESSION[SESSION['HEAD'].'ADMIN_AVATAR']?>" id="icon-profile">
					<span>관리자</span>
					<i class="xi-angle-down-thin"></i>
					<div class="dropdown-menu">
						<ul class="menu">
							<li><a href="/mypage"><i class="xi-user-o"></i>내 프로필</a></li>
							<li class="divide"></li>
							<li><a class="logout"><i class="xi-unlock-o"></i>로그아웃</a></li>
						</ul>
						<span class="arrow"></span>
					</div>
				</li>
			</ul>
		</div>
	</header> -->
	<!-- END : HEADER --> 
</body>
</html>

<script>
let getUrl = window.location.pathname;
const pulsClass = "xi-plus-thin";
const minusClass = "xi-minus-thin";

const pulsSrc = "/images/plus.svg";
const minusSrc = "/images/minus.svg";
if(getUrl=='/display/popup/regist'){
	$('.nav__child__wrap').find("[data-url='"+getUrl+"']").show();
}
if(getUrl=='/display/whats/regist'){
	$('.nav__child__wrap').find("[data-url='"+getUrl+"']").show();
}

$('.nav__child__wrap').find("[data-url='"+getUrl+"']").addClass('visited');
$('.nav__child__wrap').find("[data-url='"+getUrl+"']").parent().addClass('visited');
$('.nav__child__wrap').find("[data-url='"+getUrl+"']").parent().parent().addClass('visited');
$('.nav__child__wrap').find("[data-url='"+getUrl+"']").parent().prev().find('.nav__tilte__icon').attr('src',minusSrc);
$(function(){
	$('.nav__title__wrap').on('click' , function() {
		$(this).next('.nav__child__wrap').toggleClass('visited');
		let displayStatus = $(this).next('.nav__child__wrap').css('display');
		if(displayStatus == 'none'){
			// $(this).find('.nav__tilte__icon').removeClass(minusClass);
			// $(this).find('.nav__tilte__icon').addClass(pulsClass);
			$(this).find('.nav__tilte__icon').attr('src',pulsSrc);
		}else{
			// $(this).find('.nav__tilte__icon').removeClass(pulsClass);
			// $(this).find('.nav__tilte__icon').addClass(minusClass);
			$(this).find('.nav__tilte__icon').attr('src',minusSrc);
		}
	});

	$('.nav__child').on('click', function(){
		$(this).toggleClass('visited');
		$(this).parent().css('display','block');
		let url = $(this).data('url');
		location.href  = url;
	});
});

</script>