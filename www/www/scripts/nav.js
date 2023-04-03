// import {Sidebar} from '/scripts/module/sidebar.js';
// import {Basket} from '/scripts/module/basket.js';
// import {Bluemark} from '/scripts/module/bluemark.js';
// import {Language} from '/scripts/module/language.js';
// import {Search} from '/scripts/module/search-popular.js';
// import {User} from '/scripts/module/user.js';
var headerSwiperArr = new Array();
	
let clickPosition = 0; 
let prevPosition = 0; 
let lrgInterval = 0; 

var midClassPosition = 0;
var topClassPosition = 0;
var ulInterval = 0;



const getMenuListApi = () => {
	let country = getLanguage();
	
	$.ajax({
		type: "post",
		data: {
			"country": getLanguage()
		},
		dataType: "json",
		url: "http://116.124.128.246:80/_api/menu/get",
		error: function() {
			alert("메뉴 리스트를 불러오는데 실패 하였습니다.");
		},
		success: function(d) {
			webWriteNavHtml(d);
			mobileWriteNavHtml(d);
			disableUrlBtn();

			const sidebar = new Sidebar();
		}
	});
}

const webWriteNavHtml = (d) => {
	let menu_info = d.data.menu_info;
	let posting_story = d.data.posting_story;
	
	let member_info = d.member_info
	
	let whishCnt = member_info?.whish_cnt;
	let basketCnt = member_info?.basket_cnt;
	
	let menuList = document.createElement("ul")
	menuList.classList.add("header__grid");
	
	let menuHtml="";
	menuHtml = '<li class="first__space"></li>';
	
	let domfrag = document.createDocumentFragment(menuList);
	domfrag.appendChild(menuList)
	
	let colaboImg = ["/sample/colabo1.png","/sample/colabo2.png","/sample/colabo3.png","/sample/colabo4.png","/sample/colabo5.png"];
	
	let userName = member_info != null ? member_info.member_name : "MY";
	
	menuHtml += `
		<li class="header__logo" onClick="location.href='/'">
			<img class="logo"src="/images/landing/logo.png" alt="">
		</li>
		<li class="header__menu">
			<ul class="hover_bg_act menu__wrap left">
	`;
	
	menu_info.forEach((el, idx) => {
		let lrgDiv = document.createElement("div");
		let mdl = el.menu_mdl;
		if( el.menu_type !="PO") {
			menuHtml += `
				<li class="drop web" data-type="${el.menu_type}" data-lrg="${idx}">
					<a class="menu-ul lrg" href="${el.menu_link}">${el.menu_title}</a>
					<div class="drop__menu">
						<ul class="cont pr__menu">
							<li class="swiper-li">
								<div class="swiper swiper__box" data-id="${idx}" id="menuSwiper${idx}">
									<div class="swiper-wrapper">
										${
											el.menu_slide.map((el, idx) => {
												return`<div class="swiper-slide" data-title="${el.slide_name}">
														<div>
															<img src="${img_root}${el.slide_img}" alt="" style="margin-left: auto;margin-right: auto;">
														</div>
													</div>`
											}).join("")
										}
									</div>
									<div class="swiper__title"></div>
									<div class="swiper-pagination swiper-pagination-${idx}"></div>
								</div>  
							</li>
							${
								mdl.map((el , idx)=> {
								return`<li data-mdl="${idx}">
											<a class="mid-a menu-ul" href="${el.menu_link}">${el.menu_title}</a>
											<ul class="sma__wrap">
											${
												el.menu_sml.map((el, idx)=> {
													return`<li><a class="menu-ul sml" href="${el.menu_link}">${el.menu_title}</a></li>`
												}).join("")
											}
											</ul>
										</li>`
								}).join("")
							}
						</ul>
					</div>
				</li>
			`;
		}
		
		if( el.menu_type =="PO") {
			menuHtml += `
				<li class="drop web" data-type="${el.menu_type}" data-lrg="${idx}">
					<a class="menu-ul lrg" href="${el.menu_link}">${el.menu_title}</a>
					<div class="drop__menu">
						<ul class="cont po__menu">
							<li></li>
							<li>
								<ul class="po__cont">
									${
										mdl.map((el , idx)=> {
										return`<li class="pobox"  data-mdl="${idx}">
											<div class="colaboBox">
												<a class="mid-a menu-ul" href="${el.menu_link}">${el.menu_title}</a>
												<a href="${el.menu_link}">
													<img src='http://116.124.128.246:80/images/${colaboImg[idx]}'>
												</a>
											</div>
										</li>`
									}).join("")
									}
									<li class="pobox all-view" onclick="location.href="/posting/collaboration">
										<a href="/posting/collaboration" class="menu-ul" data-i18n="lm_view_collaborations_01">
											콜라보레이션
										</a>
										<a href="/posting/collaboration" class="menu-ul" data-i18n="lm_view_collaborations_02">
											전체보기
										</a>
									</li>
								</ul>
							</li>
							<li></li>
						</ul>
					</div>
				</li>
			`;
		}
	});
	
	menuHtml +=`
			</ul>
			<ul class="hover_bg_act menu__wrap right">`
	
	let storyHtml = webPostingStoryHtml(posting_story);
	menuHtml += storyHtml;
	let ln = localStorage.getItem('lang') || getLanguage();
	menuHtml += `
					<li class="drop web search_shop" >
						<a class="menu-ul lrg" href="/search/shop" data-i18n="m_stockist" >매장찾기</a>
					</li>
					<li class="web bluemark__btn side-bar" data-type="M">
						<div class="bluemark__icon lrg">
							<div class="bluebox"></div>
							<div class="text">Bluemark</div>
						</div>
					</li>
					<li class="web alg__c side-bar" data-type="E"><span class="language-text">${ln}</span></li>
					<li class="web search__li side-bar" data-type="S">					
						<img class="search-svg" style="height: 14px;" src="/images/svg/search.svg" alt="">
					</li>
					<li class="flex wishlist__btn" data-cnt="${whishCnt === undefined?"":whishCnt}"  data-type="W"><img class="wishlist-svg" style="height:14px" src="/images/svg/wishlist.svg" alt=""><span class="wish count"></span></li>
					<li class="flex basket__btn side-bar" data-cnt="${basketCnt === undefined?"":basketCnt}" data-type="B"><img class="basket-svg" style="height:14px" src="/images/svg/basket.svg" alt=""><span class="basket count"></span></li>
					${member_info != null ? 
						`<li class="web alg__r login__wrap mypage__icon side-bar" data-type="L">
							<img class="user-svg" style="height:14px" src="/images/svg/user-bk.svg" alt="">
							<span>` + userName + `</span>
						</li>` : 
						`<li class="web alg__r login__wrap mypage__icon side-bar" data-type="L">
							<img class="user-svg" style="height:14px" src="/images/svg/user-bk.svg" alt="">
							<span>MY</span>
						</li>`}
					
					<li class="flex pr-3 lg:hidden mobileMenu">
						<div class="hamburger" id="hamburger">
							<div class="line"></div>
							<div class="line"></div>
							<div class="line"></div>
							<div class="line"></div>
						</div>
					</li>
	`;
			
	menuHtml +=`
			</ul>
		</li>
	`;
	
	menuList.innerHTML = menuHtml;
	document.querySelector(".header__wrap").appendChild(domfrag);
	
	
	if(!checkMobileDevice()){
		console.log($(".hover_bg_act").attr("class"));
		$(".hover_bg_act").hover(function() {
			headerHover(true);
			if($('body').hasClass('sidebar_open')){
				$('#sidebar .sidebar-close-btn').click();
			}

		},function(){
			headerHover(false);
		});
	}
	
	mobileMenu();
	
	let $$webMenu = document.querySelectorAll(".web");
	let $webMenu = document.querySelector(".web");
	let $lrgMenu = document.querySelectorAll(".lrg");
	/*
	$$webMenu.forEach(el => {
		el.addEventListener("mouseover", function(e) {
			var swiper = new Swiper(".swiper__box", {
				observer:true,
				observeParents:true,
				pagination: {
					el: ".swiper-pagination",
					dynamicBullets: true
				},
				autoplay: {
					delay: 2000,
					disableOnInteraction: false,
				}
			}); 
		},{ once : true });
	});
	*/
	
	$(".drop.web").hover(function() {
		var showRate = 200;
		var idx = $(this).attr("data-lrg");
		$(".drop__menu").each(function(index, item){
			if($(item).css("display") == "block"){
				showRate = 0;
			}
		});
		$(this).find(".drop__menu").fadeIn(showRate);
		if(headerSwiperArr[idx]){
			headerSwiperArr[idx].destroy();
			headerSwiperArr[idx] = null;
		}
		headerSwiperArr[idx] = new Swiper("#menuSwiper"+idx, {
			observer:true,
			observeParents:true,
			pagination: {
				el: ".swiper-pagination-"+idx,
				dynamicBullets: true
			},
			autoplay: {
				delay: 2000,
				disableOnInteraction: false,
			}
		});
		var swiper__box = $(this).find(".swiper__box");
		var swiper_title_obj = $(swiper__box).find(".swiper__title")
		var titleArr = new Array();
		$(swiper__box).find(".swiper-slide").each(function(idx,el){
			titleArr.push($(el).attr("data-title"));
		});
		if(titleArr.length > 0){
			$(swiper_title_obj).html(titleArr[0]);
		}
		if(titleArr.length == 1){
			$(".swiper-pagination-"+idx).hide();
		}
		headerSwiperArr[idx].on('slideChange', function () {
			$(swiper_title_obj).html(titleArr[headerSwiperArr[idx].activeIndex]);
		});
	},function(){
		$(this).find(".drop__menu").fadeOut(100);
	});
	
	/*
	$$webMenu.forEach(el => {
		if(el.dataset.type=="PR" || el.dataset.type=="PO" || el.dataset.type=="FM"){
			el.addEventListener("mouseover", function(e) {
				headerHover(true);
			});
		}
	});
	$$webMenu.forEach(el => {
		el.addEventListener("mouseout", function(e) {
			if(this.dataset.type=="PR" || this.dataset.type=="PO" || el.dataset.type=="FM" ){
				headerHover(false);
			}
		});
	});
	*/
	
	// let lrgLang = ["m_trending", "m_men", "m_women", "m_life_style", "m_collaboration", "m_story", "m_stockist"];
	// let menu_lrg = document.querySelectorAll(".drop.web .menu-ul.lrg");
	// for(let i = 0; i < menu_lrg.length; i++) {
	// 	menu_lrg[i].dataset.i18n = lrgLang[i];
	// 	menu_lrg[i].textContent = i18next.t(lrgLang[i]);
	// }
	// changeLanguageR();
}

const webPostingStoryHtml = (d) => {
	let column_NEW = d.column_NEW;
	let column_COLC = d.column_COLC;
	let column_RNWY = d.column_RNWY;
	let column_EDTL = d.column_EDTL;
	
	let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
	
	let size_type = "W";
	if (isMobile == true) {
		size_type = "M";
	}
	
	let storyHtml = "";
	storyHtml += `
				<li class="drop web story" data-type="ST" data-large="6">
					<a class="menu-ul lrg" href="#">스토리</a>
					<div class="drop__menu">
						<ul class="cont st__menu">
							<li></li>
							<li>
								<ul class="st__cont">
									<li>
										<a href="#" class="menu-ul" data-i18n="lm_latest_news">새로운 소식</a>
										<ul class="list__grid">
	`;
	
	column_NEW.forEach(function(row_NEW) {
		storyHtml += `
											<li class="st__box" onClick="location.href='${row_NEW.page_url}'">
												<div class="newsBox">
													<img src ='${img_root}${row_NEW.img_location}'>
													<div class="news-title kr" href="">${xssDecode(row_NEW.story_title)}</div>
													<div class="news-m-title en" href="">${xssDecode(row_NEW.story_sub_title)}</div>
												</div>
											</li>
		`;
	});
	
	storyHtml += `
										</ul>
									</li>
									<li>
										<a href="/story/main" class="menu-ul" data-i18n="lm_archive">아카이브</a>
										<ul class="list__grid">
											<li class="st__box">
												<div class="mid-a archiveTitle"><a href="/posting/collection" class="menu-ul">컬렉션</a></div>
												<div class="archiveBox">
													<ul>
	`;
	
	column_COLC.forEach(function(row_COLC) {
		storyHtml += `
														<li class="archiveList link" onClick="location.href='${row_COLC.page_url}'">${row_COLC.story_title}</li>
		`;
	});
	
	storyHtml += `
													</ul>
													<ul>
														<li class="archiveList dot"></li>
														<li class="archiveList allBtn"><a href="/posting/collection" class="menu-ul" data-i18n="lm_view_all">+  전체보기</a></li>
													</ul>
												</div>
											</li>
											<li class="st__box"  data-mdl="">
												<div class="mid-a archiveTitle"><a href="/posting/runway" class="menu-ul">런웨이</a></div>
												<div class="archiveBox">
													<ul>
	`;
	
	column_RNWY.forEach(function(row_RNWY) {
		storyHtml += `
														<li class="archiveList link" onClick="location.href='${row_RNWY.page_url}&size_type=${size_type}'">${row_RNWY.story_title}</li>
		`;
	});
	
	storyHtml += `
													</ul>
													<ul>
														<li class="archiveList dot"></li>
														<li class="archiveList allBtn"><a href="/posting/runway" class="menu-ul" data-i18n="lm_view_all">+  전체보기</a></li>
													</ul>
												</div>
											</li>
											<li class="st__box"  data-mdl="">
												<div class="mid-a archiveTitle"><a href="/posting/editorial" class="menu-ul" data-i18n="lm_editorial">에디토리얼</a></div>
												<div class="archiveBox">
													<ul>
	`;
	
	column_EDTL.forEach(function(row_EDTL) {
		storyHtml += `
														<li class="archiveList link" onClick="location.href='${row_EDTL.page_url}&size_type=${size_type}'">${row_EDTL.story_title}</li>
		`;
	});
	

	storyHtml += `
														</ul>
														<ul>
															<li class="archiveList dot"></li>
															<li class="archiveList allBtn"><a href="/posting/editorial" class="menu-ul" data-i18n="lm_view_all">+  전체보기</a></li>
														</ul>
													</div>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li></li>
							</ul>
						</div>
					</li>
		`;
	
	return storyHtml;
}

const mobileWriteNavHtml = (d) => {
	let menu_info = d.data.menu_info;
	let posting_story = d.data.posting_story;
	
	let member_info = d.member_info
	let userName = member_info != null ? member_info.member_name : "로그인";
	
	let mobileMenu = document.createElement("div");
	mobileMenu.classList.add("mobile__menu");
	let domfrag = document.createDocumentFragment(mobileMenu);
	domfrag.appendChild(mobileMenu);
	let colaboImg = ["/sample/colabo1.png","/sample/colabo2.png","/sample/colabo3.png","/sample/colabo4.png","/sample/colabo5.png"];
	let menuHtml = 
	`<ul class="top">`
	
	menu_info.forEach((el, idx) => {
		let mdl = el.menu_mdl;
		
		if( el.menu_type =="PR") {
			menuHtml += `
				<li class="lrg" data-lrg="${idx}">
					<div class="lrg__back__btn"></div>
					<div class="lrg__title">${el.menu_title}</div>
					<div class="mdlBox">
						<ul class="mdl">
							<a class="mdl__title" data-i18n="lm_view_all" href="${el.menu_link}">전체보기</a>
							${
							mdl.map((el,idx) => {
									return `<a class="mdl__title"  href="${el.menu_link}">${el.menu_title}</a>`
							}).join("")
							}
							<li class="swiper-li">
								<div class="swiper m__swiper__box" data-id="${idx}" id="mobileMenuSwiper${idx}">
										<div class="swiper-wrapper">
											${
												el.menu_slide.map((el, idx) => {
													return`<div class="swiper-slide" data-title="${el.slide_name}">
															<div>
																<img src="${img_root}${el.slide_img}" alt="" style="max-height:110px;max-width:110px;">
															</div>
														</div>`
												}).join("")
											}
										</div>
									<div class="swiper-pagination swiper-pagination-${idx}"></div>
									</div>  
								<div class="swiper__title"></div>
							</li>
						</ul>
					</div>
				</li>
			`;
		}
		if( el.menu_type =="PO") {
			menuHtml += `
				<li class="lrg" data-lrg="${idx}">
					<div class="lrg__back__btn"></div>
					<div class="lrg__title">${el.menu_title}</div>
					<div class="mdlBox">
						<ul class="mdl collaboration">
							${
							mdl.map((el,idx) => {
									return `<a class="mdl__title po__wrap" href="${el.menu_link}">
												<img src='http://116.124.128.246:80/images/${colaboImg[idx]}' class="po__image">
												<div class="po__title">${el.menu_title}</div>
											</a>`
							}).join("")
							}
							<a class="mdl__title po__wrap view__total" href="/posting/collaboration">
								<div style="width:50px">
									<img src="/images/svg/plus-bk.svg" style="width:12px;margin:4px auto;" alt="">
								</div>
								<div class="po__title__all" data-i18n="lm_view_collaborations">콜라보레이션 전체보기</div>
							</a>
						</ul>
					</div>
				</li>
			</ul>
			`;
		}
	});
	
	let storyHtml = mobilePostingStoryHtml(posting_story);
	menuHtml += storyHtml;
	
	menuHtml += `
			<ul class="bottom">
				<li class="flex" onclick="location.href='/mypage'">
					${member_info != null ? `<img src="/images/svg/user-bk.svg" style="width:14px" alt=""><span>${userName}</span>` : `<img src="/images/svg/user-bk.svg" style="width:14px" alt=""><span data-i18n="m_login">로그인</span>`}
				</li>
				<li class="mobile-search-wrap">
					<div class="mobile__search__btn lrg__title non_underline"><img src="/images/svg/search-bk.svg" style="width:14px" alt=""><span>검색</span></div>
				</li>
				<li class="flex customer">
					<div class="mobile__customer__btn lrg__title non_underline"><img src="/images/svg/customer-bk.svg" style="width:14px" alt=""><span data-i18n="lm_customer_care_service">고객서비스</span></div>
				</li>
				<li class="flex bluemark">
					<div class="mobile__bluemark__btn"><div class="bluemark-icon"></div><span>Bluemark</span></div>
				</li>
				<li class="flex language">
					<div class="mobile__language__btn"><div>KR</div><span>Language</span></div>
				</li>
				<li class="flex logout"><span>로그아웃[임시]</span></li>
			</ul>
			<div class="mobile__search">
				<div class="search__back__btn"></div>
				<div class="search__cont"></div>
			</div>
			<div class="mobile__bluemark">
				<div class="bluemark__back__btn"></div>
				<div class="mobile__bluemrk__wrap">
					<div class="mobile__bluemark__title">
						<div class="bluemark-icon"></div><span>Bluemark</span>
					</div>
					<div class="mobile__bluemark__description">
						<p>Bluemark는 본 브랜드의 모조품으로부터 소비자의 혼란을 최소화하기 위해 제공되는 정품 인증 서비스입니다.</p>
						<p>ADER는 모조품 판매를 인지하고 소비자와 브랜드의 이미지를 보호하기 위하여 적극적으로 대응중입니다.</p>
					</div>
					<div class="mobile__bluemark__btn__wrap">
						<div class="bluemark__btn__certify" data-i18n="lm_verify_blue_mark" onclick="location.href='http://116.124.128.246/login?r_url=/mypage?mypage_type=bluemark_verify'">블루마크 인증하기</div>
						<div class="bluemark__btn__list" data-i18n="lm_verification_history" onclick="location.href='http://116.124.128.246/login?r_url=/mypage?mypage_type=bluemark_list'">블루마크 인증 내역</div>
					</div>
				</div>
			</div>
			<div class="mobile__language">
				<div class="language__back__btn"></div>
				<div class="mobile__language__wrap">
					<div class="mobile__language__title" data-i18n="lm_choose_language">언어 선택</div>
					<div class="mobile__language__description">
						<p data-i18n="lm_menu_lang_msg_01">아래 옵션에서 선택해 주세요.</p>
						<p data-i18n="lm_menu_lang_msg_02">선택한 언어에 해당되는 홈이지로 리디렉션됩니다.</p>
					</div>
					<div class="mobile__language__btn__wrap">
						<div class="language__btn__kr" data-ln='KR'>한국어</div>
						<div class="language__btn__en" data-ln='EN'>English</div>
						<div class="language__btn__cn" data-ln='CN'>中文</div>
					</div>
				</div>
			</div>
			<div class="mobile__customer">
				<div class="customer__back__btn"></div>
				<div class="mobile__customer__wrap">
					<div class="mobile__customer__title">고객서비스</div>
					<div class="mobile__customer__btn__wrap">
						<div class="customer__btn__service" onclick="location.href='/login/service'">공지사항</div>
						<div class="customer__btn__faq" onclick="location.href='/login/faq'">자주 묻는 질문</div>
						<div class="customer__btn__inquiry" onclick="location.href='http://116.124.128.246/login?r_url=/mypage?mypage_type=inquiry'">문의하기</div>
					</div>
				</div>
			</div>
	`;
	mobileMenu.innerHTML = menuHtml;
	document.querySelector(".side__menu").appendChild(domfrag);

	
	midClassPos = $('.mid').eq(0).position();
	topClassPos = $('.top').eq(0).position();
	clickPos= $('.top .lrg').eq(1).position();
	prevPos = $('.top .lrg').eq(0).position();

	midClassPosTop = 0;
	topClassPosTop = 0;
	clickPosTop = 0;
	prevPosTop = 0;

	if(typeof(midClassPos) == 'object'){
		midClassPosTop = midClassPos.top;
	}
	if(typeof(topClassPos) == 'object'){
		topClassPosTop = topClassPos.top;
	}
	if(typeof(clickPos) == 'object'){
		clickPosTop = clickPos.top;
	}
	if(typeof(prevPos) == 'object'){
		prevPosTop = prevPos.top;
	}

	ulInterval = midClassPosTop - topClassPosTop;
	lrgInterval = clickPosTop - prevPosTop;

	// let lrgLang = ["m_trending", "m_men", "m_women", "m_life_style", "m_collaboration", "m_story"];
	// let menu_lrg = document.querySelectorAll(".lrg .lrg__title");
	// for(let i = 0; i < menu_lrg.length; i++) {
	// 	menu_lrg[i].dataset.i18n = lrgLang[i];
	// 	menu_lrg[i].textContent = i18next.t(lrgLang[i]);
	// }
	// changeLanguageR();
	
	menuLrgClick();
	logoutClick();
}

const mobilePostingStoryHtml = (d) => {
	let column_NEW = d.column_NEW;
	let column_COLC = d.column_COLC;
	let column_RNWY = d.column_RNWY;
	let column_EDTL = d.column_EDTL;
	
	let storyHtml = "";
	
	storyHtml += `
			<ul class="mid">
				<li class="lrg" data-lrg="6" data-type="ST">
					<div class="lrg__back__btn"></div>
					<div class="lrg__title non_underline"><span data-i18n="m_story">스토리</span></div>
					<div class="mdlBox">
						<ul class="mdl">
							<li>
								<div class="sub__title" data-i18n="lm_latest_news">새로운 소식</div>
								<ul class="list__grid">
	`;
	
	column_NEW.forEach(function(row_NEW) {
		console.log(xssDecode(row_NEW.story_title));
		storyHtml += `
									<li class="st__box" onClick="location.href='${row_NEW.page_url}'">
										<div class="newsBox">
											<img src ='${img_root}${row_NEW.img_location}'>
											<div class="news-title-wrap">
												<div class="news-title" href="">${xssDecode(row_NEW.story_title)}</div>
												<div class="news-m-title" href="">${xssDecode(row_NEW.story_sub_title)}</div>
											</div>
										</div>
									</li>
		`;
	});
		
	storyHtml += `
								</ul>
							</li>
							<li class="div__line">
							</li>
							<li>
								<div class="sub__title"><a href="http://116.124.128.246/story/main" data-i18n="lm_archive">아카이브</a></div>
								<ul class="list__grid">
									<li class="st__box">
										<div class="mid-a archiveTitle" onclick="location.href='/posting/collection'">컬렉션</div>
										<div class="archiveBox">
											<ul>
	`;
	
	column_COLC.forEach(function(row_COLC) {
		storyHtml += `
												<li class="archiveList" onclick="location.href='${row_COLC.page_url}'">${row_COLC.story_title}</li>
		`;
	});
	
	storyHtml += `
											</ul>
										</div>
									</li>
									<li class="div__line">
									</li>
									<li class="st__box">
										<div class="mid-a archiveTitle" onclick="location.href='/posting/runway'">런웨이</div>
										<div class="archiveBox">
											<ul>
	`;
	
	column_RNWY.forEach(function(row_RNWY) {
		storyHtml += `
												<li class="archiveList" onClick="location.href='${row_RNWY.page_url}'">${row_RNWY.story_title}</li>
		`;
	});
	
	storyHtml += `
											</ul>
										</div>
									</li>
									<li class="div__line">
									</li>
									<li class="st__box">
										<div class="mid-a archiveTitle" data-i18n="lm_editorial" onclick="location.href='/posting/editorial'" data-i18n="lm_editorial">에디토리얼</div>
										<div class="archiveBox">
											<ul>
	`;
	
	column_EDTL.forEach(function(row_EDTL) {
		storyHtml += `
												<li class="archiveList" onclick="location.href='${row_EDTL.page_url}&size_type=M'">${row_EDTL.story_title}</li>
		`;
	});
	
	storyHtml += `
											</ul>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</li>
				<li class="mobile-store-search-wrap"><span data-i18n="m_stockist" onclick="location.href='/search/shop'">매장찾기</span></li>
			</ul>
	`;
	
	return storyHtml;
}

function mobileMdlSwipe(obj) {
	const $$swiperBox = document.querySelectorAll(".m__swiper__box");
	$$swiperBox.forEach((el, idx)=> {
		let mobileMenuSwiper = new Swiper(`#mobileMenuSwiper${idx}`,{
			observer:true,
			observeParents:true,
			slidesPerView: 1,
			pagination: {
				el: ".swiper-li .swiper-pagination-"+idx,
				dynamicBullets: true
			},
			autoplay: {
				delay: 5000,
				disableOnInteraction: true
			}
		});
		var swiper__box = $(obj).next().find(".m__swiper__box");
		var swiper_title_obj = $(swiper__box).parent().find(".swiper__title");
		var titleArr = new Array();
		$(swiper__box).find(".swiper-slide").each(function(idx,el){
			titleArr.push($(el).attr("data-title"));
		});
		if(titleArr.length > 0){
			$(swiper_title_obj).html(titleArr[0]);
		}
		if(titleArr.length == 1){
			$(".swiper-pagination-"+idx).hide();
		}
		mobileMenuSwiper.on('slideChange',function (){
			$(swiper_title_obj).html(titleArr[mobileMenuSwiper.activeIndex]);
		})
	});
}
/*모바일 관련*/
const menuLrgClick = () => {
	$(".mobile__menu .lrg__title").click(function(){
		let mdlBox_obj = $(this).siblings(".mdlBox");
		let lrg__back__btn_obj = $(this).siblings(".lrg__back__btn");
		
		if($(mdlBox_obj).css("display") != "block"){
			$(this).closest(".side__menu").addClass("lrg__on");
			let lrg_idx = $(this).parent().attr("data-lrg") - 1;
			let lrg_type = $(this).parent().attr("data-type");
			/*
			$(".mobile__menu .lrg").each(function(idx,el){
				if($(el).attr("data-lrg") < lrg_idx){
					$(el).hide();
				}
				else{
					$(el).show();
				}
			});
			*/
			$(".mobile__menu .lrg__title").removeClass("open");
			$(".mobile__menu .lrg__back__btn").removeClass("open");
			if(lrg_type == "ST"){
				$(".mobile-store-search-wrap").hide();
				$(".bottom").hide();

				$(".top").hide();
			}
			$(this).addClass("open");
			$(lrg__back__btn_obj).addClass("open");
			//상세화면 모두 닫고, 해당하는 상세화면만 열기
			$(".mdlBox").slideUp(750);
			$(mdlBox_obj).slideDown(750);
			mobileMdlSwipe(this);
			
			if(lrg_type == "ST"){
				$("#mobile .side__menu").animate({scrollTop : ulInterval}, 0);
			}
			else{
				let clickIdx = $(this).parent().index();
				
				if(clickIdx <= 1){
					$("#mobile .side__menu").animate({scrollTop : 0}, 400);
				}
				else{
					$("#mobile .side__menu").animate({scrollTop : lrgInterval * (clickIdx - 1)}, 400);
				}
			}
			
		}
	});
	$(".mobile__menu .lrg__back__btn").click(function(){
		$(".mdlBox").slideUp(500);
		$(".mobile__menu .lrg__title").removeClass("open");
		$(".mobile__menu .lrg__back__btn").removeClass("open");
		$(this).closest(".side__menu").removeClass("lrg__on");
		$(".mobile-store-search-wrap").show();
		$(".top").show();
		$(".bottom").show();
		$(".mobile__menu .lrg").slideDown(500);
		$("#mobile .side__menu").animate({scrollTop : 0}, 500);
	});
	
	$(".mobile__search__btn").click(function(){
		$(".top, .mid, .bottom").slideUp(500);
		$(".mobile__search").slideDown(500);
		$(this).closest(".side__menu").addClass("lrg__on");
		$(".mobile__search .search__back__btn").addClass("open");
	});
	$(".mobile__search .search__back__btn").click(function(){
		$(".mobile__search").slideUp(500);
		$(".top, .mid, .bottom").slideDown(500);
		$(this).closest(".side__menu").removeClass("lrg__on");
		$(".mobile__search .search__back__btn").removeClass("open");
	});

	$(".mobile__bluemark__btn").click(function() {
		$(".top, .mid, .bottom").slideUp(500);
		$(".mobile__bluemark").slideDown(500);
		$(this).closest(".side__menu").addClass("lrg__on");
		$(".mobile__bluemark .bluemark__back__btn").addClass("open");
	})
	$(".mobile__bluemark .bluemark__back__btn").click(function(){
		$(".mobile__bluemark").slideUp(500);
		$(".top, .mid, .bottom").slideDown(500);
		$(this).closest(".side__menu").removeClass("lrg__on");
		$(".mobile__bluemark .bluemark__back__btn").removeClass("open");
	});
	
	$(".mobile__language__btn").click(function() {
		$(".top, .mid, .bottom").slideUp(500);
		$(".mobile__language").slideDown(500);
		$(this).closest(".side__menu").addClass("lrg__on");
		$(".mobile__language .language__back__btn").addClass("open");
		changeLangEvent('.mobile__language__btn__wrap');
	})
	$(".mobile__language .language__back__btn").click(function(){
		$(".mobile__language").slideUp(500);
		$(".top, .mid, .bottom").slideDown(500);
		$(this).closest(".side__menu").removeClass("lrg__on");
		$(".mobile__language .language__back__btn").removeClass("open");
	});

	$(".mobile__customer__btn").click(function() {
		$(".top, .mid, .bottom").slideUp(500);
		$(".mobile__customer").slideDown(500);
		$(this).closest(".side__menu").addClass("lrg__on");
		$(".mobile__customer .customer__back__btn").addClass("open");
	})
	$(".mobile__customer .customer__back__btn").click(function(){
		$(".mobile__customer").slideUp(500);
		$(".top, .mid, .bottom").slideDown(500);
		$(this).closest(".side__menu").removeClass("lrg__on");
		$(".mobile__customer .customer__back__btn").removeClass("open");
	});
}
const logoutClick = () => {
	$('.flex.logout').on('click', function(){
		$.ajax({
			type: "post",
			dataType: "json",
			url: "http://116.124.128.246:80/_api/account/logout",
			success: function (d) {
				exceptionHandling("",'로그아웃');
				$('#exception-modal .close-btn').attr('onclick', 'location.href="/main"');
			}
		});
	})
}
const mobileSearch = () => {
	let mobile = document.querySelector("#mobile");
	let mobileSearchBtn = document.querySelector(".mobile__search__btn");
	let mobileMenuWrap = document.querySelector(".mobile__menu");
	let mobileSearchWrap = document.querySelector(".mobile__search");
	mobileSearchBtn.addEventListener("click", () => {
		mobileMenuWrap.style.display = "none";
		mobileSearchWrap.style.display = "block";
		mobile.classList.add('search');
	});
}

const mobileMenu = () => {
	const $body = document.querySelector("body");
	const mobileMenuBtn = document.querySelector('.mobileMenu');
	const mobileSide = document.querySelector('#mobile');
	const hamburgerBtn = document.querySelector(".hamburger");
	let header = document.querySelector("header");
	mobileMenuBtn.addEventListener('click', (ev) => {
		hamburgerBtn.classList.toggle("is-active");
		if(hamburgerBtn.classList.contains("is-active")){
			mobileSide.classList.add('menu__on');
			$("#dimmer").addClass("show");
			header.classList.add("hover");
			$body.classList.add("m_menu_open");	
		}
		else{
			mobileSide.classList.remove('menu__on');
			$("#dimmer").removeClass("show");
			header.classList.remove("hover");
			$body.classList.remove("m_menu_open");			
		}
		let mobileSearch = new Search();
		mobileSearch.mobileWriteHtml();
		mobileSearch.addSearchEvent();
	});
};
function changeLangEvent(btnParrentClass){
	const languageBtnWrap = document.querySelector(btnParrentClass);
	const languageBtns = Array.from(languageBtnWrap.querySelectorAll('div'));
	
	let currentLang = localStorage.getItem('lang') || 'KR';
	
	setSelectedLanguage(languageBtns, currentLang);
	languageBtnWrap.addEventListener('click', e => {
		const clickedBtn = e.target.closest('div');
		if (!clickedBtn || !languageBtns.includes(clickedBtn)) { return; }
		let nowLang = currentLang;
		currentLang = clickedBtn.dataset.ln;
		
		setSelectedLanguage(languageBtns, currentLang);
	
		localStorage.setItem('lang', currentLang);
		$('.header__menu .side-bar .language-text').html(currentLang);
		i18next.changeLanguage(currentLang);
		// if(btnParrentClass === '.language-btn-box'){ sidebarClose();}
		//window.location.reload();
		if(getLoginStatus() == 'false'){
			window.location.reload();
		}
		else{
			logout(nowLang);
		}
	});
	
	function setSelectedLanguage(btns, lang) {
		btns.forEach(btn => {
			btn.classList.toggle('select', btn.dataset.ln === lang);
		});
	}
	function logout(lang){
        $.ajax(
            {
                url: "http://116.124.128.246:80/_api/account/logout",
                type: 'POST',
                success:function(){
					if(btnParrentClass == '.mobile__language__btn__wrap'){
						window.location.reload();
					}
					else {
						if(lang == 'KR') {
							notiModal('언어변경','로그아웃되었습니다.');
						}
						if(lang == 'EN') {
							notiModal('Language has changed','It has been changed to a different language. We have logged you out of your account.');
						}
						if(lang == 'CN') {
							notiModal('언어변경','로그아웃되었습니다.');
						}
						$('#notimodal-modal .close-btn').attr('onclick', 'window.location.reload();');
					}
                }
            }
        )
    }
}


function windowResponsive() {
	const $body = document.querySelector("body");
	const bodyWidth = document.querySelector("body").offsetWidth;
	if ( 1024 <= bodyWidth) {
		$body.dataset.view = "rW"
	} else if(1024 >= bodyWidth) {
		$body.dataset.view = "rM"
	}
}
function headerHover(bl){
	let header = document.querySelector("header");
	let sidebar = document.querySelector("#sidebar");
	
	if(bl){
		header.classList.add("hover");
		header.querySelectorAll(".under-line").forEach(els => {
			els.classList.remove("wh");
			els.classList.add("bk");
		});
		$("#dimmer").addClass("show");
		// if(sidebar.classList.contains("open")){
		// 	$("#dimmer").fadeOut(100);
		// }else {
		// 	$("#dimmer").fadeIn(100);
		// }
	}
	else{
		if(!sidebar.classList.contains("open")){
			header.classList.remove("hover");
			header.querySelectorAll(".under-line").forEach(els => {
				els.classList.remove("bk");
				els.classList.add("wh");
			});
		$("#dimmer").removeClass("show");
		}
	}
}
function searchInit(){
	headerHover(true);
	$(".login__wrap").addClass("-search-on");
	$(".search__motion__wrap").addClass("search-init",500,function(){
		$(".search__close,.search__input").fadeIn(300);
		$(".search__drop").show();
	});
	$(".search-hide,.search__text").fadeOut(1,function(){
		$(".right__nav").addClass("search__style");
	});
	$(".mid__space").addClass("--hidden");
}
function searchClose(){
	$(".search__drop").hide();
	$(".search__close,.search__input").hide()
	$(".right__nav").removeClass("search__style");
	$(".login__wrap").removeClass("-search-on");
	$(".search__motion__wrap").removeClass("search-init",500);
	$(".search-hide").fadeIn(500,function(){
		$(".search__text").fadeIn(300);
		$(".search-hide").attr("style","");
	});	
	headerHover(false);
	$(".mid__space").removeClass("--hidden");
}

function disableUrlBtn() {
	const pageUrl = new URL(document.location);
	let path = pageUrl.pathname; 
	let sideBarBtn = document.querySelectorAll('.side-bar');

	//위시
	let $quickview = document.querySelector("#quickview");
	let $contentWrap = document.querySelector(".quickview__content__wrap");
	let $listBtn = document.querySelector(".btn__box.list__btn");
	let $whishlistBtn = document.querySelector(".wishlist__btn");
	let $titleBoxSpan = document.querySelector(".title__box span");
	let $titleBoxImg = document.querySelector(".title__box img");



	navWhishlistBtn();
	sideBarBtn.forEach(el => {
		el.addEventListener("click", function() {
			sideBarBtn.forEach(el => el.classList.remove("open"));
			let target = this;
			let sideBarCloseBtn = document.querySelector('.sidebar-close-btn');
			sideBarCloseBtn.addEventListener("click",sidebarClose);
			let sideBox = document.querySelector(".side__box");
			let typeTarget  = this.dataset.type;
			sideBox.innerHTML ="";
			if(typeTarget === "S"){
				console.log("서치");
				let search = new Search();
				search.writeHtml();
				search.addSearchEvent();
			}else if(typeTarget === "E"){
				console.log("언어변경");
				let language = new Language();
				language.writeHtml();
				language.addSelectEvent();
				changeLangEvent('.language-btn-box');
				// let text = getLanguage();
				// let btn = document.querySelectorAll('.side__box .language-btn');
				// btn.forEach(el => el.addEventListener("click",function(){
				// 	if(this.classList.contains('korea')){
				// 		i18next.changeLanguage("KR");
				// 		text ='KR'
				// 	} else if(this.classList.contains('english')){
				// 		i18next.changeLanguage("EN");
				// 		text ='EN'
				// 	} else if(this.classList.contains('china')){
				// 		i18next.changeLanguage("CN");
				// 		text ='CN'
				// 	}

				// 	localStorage.setItem('lang', text);
				// 	$('.header__menu .side-bar .language-text').html(localStorage.getItem('lang'))
				// }))
				// function getLanguage() {
				// 	return navigator.language || navigator.userLanguage;
				// }
			}else if(typeTarget === "B"){
				if(getLoginStatus() == 'false'){
					location.href='/login?r_url=/order/basket/list';
					return 
				} else {
					const basket = new Basket("basket",true);
					basket.writeHtml();
					if(path.includes("basket")){
						e.stopImmediatePropagation();
					}
				}
			}else if(typeTarget === "M"){
				let bluemark = new Bluemark();
				bluemark.writeHtml();
				if(path.includes("mypage")){
					e.stopImmediatePropagation();
				}
			}else if(typeTarget === "L"){
				let user = new User();
				user.userLoad();
				if(path.includes("mypage")){
					e.stopImmediatePropagation();
				}
			}else if(typeTarget === "W"){
				if(path.includes("whish")){
					e.stopImmediatePropagation();
				}
				
			}
			sideBarToggleEvent(target);
		});
	})
	if(path ==='/product/list'){

	}
	if(path ==='/product/detail'){
		$('.whish-btn').on("click", function(){
			$('#quickview_observer').val('open');
			$quickview.classList.remove("hidden");
			$titleBoxSpan.innerText = "위시리스트";
			$titleBoxImg.src = "/images/svg/wish-list-bk.svg";
			$contentWrap.classList.add("open");
			$listBtn.classList.add("select");
			$whishlistBtn.classList.add("open");
			setTimeout(() => {
				getWhishlistProductList();
			}, 100);
		})
	}
	
	function sideBarToggleEvent(target){
		// layoutClick(target);
		const $body = document.querySelector("body");
		
		let sideContainer = document.querySelector("#sidebar");
		let sideBg = document.querySelector(".side__background");
		let sideWrap = document.querySelector(".side__wrap");
		if(sideContainer.classList.contains("open")){
			sidebarClose();	
		} else {
			if($(".wishlist__btn.open").length !== 0){
				whishlistClose();
			}
			target.classList.add("open");
			$("header").addClass("hover");
			$body.classList.add("sidebar_open");
			$body.dataset.sbType = target.dataset.type;
			sideContainer.classList.add("open");
			sideContainer.classList.add(target.dataset.type);
			sideBg.classList.add("open");
			sideWrap.classList.add("open");
			headerHover(true);
		}
	}
	
	function navWhishlistBtn(){
		let $wishlistBtn  = document.querySelector(".wishlist__btn");
		if($("body").hasScrollBar()){
			$("#quickview .quickview__box").css("padding-right",getScrollBarWidth());
		}
		else{
			$("#quickview .quickview__box").css("padding-right","");
		}
		$wishlistBtn.addEventListener("click", function(){
			if(this.classList.contains("open")){
				//					whishlistClose();
				location.href="/order/whish";
			}else {
				location.href="/order/whish";
				// if($(".side-bar.open").length !== 0){
				// 	sidebarClose();
				// }
				// $quickview.classList.remove("hidden");
				// $titleBoxSpan.innerText = "위시리스트";
				// $titleBoxImg.src = "/images/svg/wish-list-bk.svg";
				// $contentWrap.classList.add("open");
				// $listBtn.classList.add("select");
				// getWhishlistProductList();
				// $whishlistBtn.classList.add("open");
			}
		})
	}
	function whishlistClose(){
		$quickview.classList.add("hidden");
		$contentWrap.classList.remove("open");
		$listBtn.classList.remove("select");
		$whishlistBtn.classList.remove("open");
	}
	function layoutClick() {
		let sideWrap = document.querySelector(".side__wrap");
		let sideBg = document.querySelector(".side__background");
		sideBg.addEventListener("click" ,(e) =>{
			if(e.target == sideBg){
				sidebarClose();
			}
		} )

	}
	return {
		sidebarClose:sidebarClose
	}
}
function sidebarClose() {
	const $body = document.querySelector("body");
	let sideBarBtn = document.querySelectorAll('.side-bar');
	let sideContainer = document.querySelector("#sidebar");
	let sideBg = document.querySelector(".side__background");
	let sideWrap = document.querySelector(".side__wrap");
	sideBarBtn.forEach(el => el.classList.remove("open"));
	sideBarBtn.forEach(el => el.classList.remove("open"));
	$("header").removeClass("hover");
	$body.classList.remove("sidebar_open");
	$body.dataset.sbType = "";
	//class all remove
	sideContainer.className = "";
	sideBg.classList.remove("open");
	sideWrap.classList.remove("open");
	document.querySelector(".side__box").innerHTML = "";
	headerHover(false);
}


window.addEventListener('DOMContentLoaded', function() {
	getMenuListApi();
	changeLanguageR();
//		windowResponsive();
});
