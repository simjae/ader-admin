// import {Sidebar} from '/scripts/module/sidebar.js';
// import {Basket} from '/scripts/module/basket.js';
// import {Bluemark} from '/scripts/module/bluemark.js';
// import {Language} from '/scripts/module/language.js';
// import {Search} from '/scripts/module/search-popular.js';
// import {User} from '/scripts/module/user.js';
	var headerSwiperArr = new Array();
	
	window.addEventListener('DOMContentLoaded', function() {
		getMenuListApi();
//		windowResponsive();
	});
/*
	window.addEventListener('resize', () => {
		windowResponsive()
	});
*/

	const getMenuListApi = () => {
		let country = getLanguage();
		
		$.ajax({
			type: "post",
			data: {
				"country": country
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
			if( el.menu_type =="PR") {
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
													<img src ='http://116.124.128.246:80/images/${colaboImg[idx]}'>
												</div>
											</li>`
										}).join("")
										}
										<li class="pobox all-view" onclick="location.href="/posting/collaboration">
											<a href="/posting/collaboration" class="menu-ul">
												콜라보레이션
											</a>
											<a href="/posting/collaboration" class="menu-ul">
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
							<a class="menu-ul lrg" href="/search/shop">매장찾기</a>
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
						<li class="web alg__r login__wrap mypage__icon side-bar" data-type="L">
							<img class="user-svg" style="height:14px" src="/images/svg/user-bk.svg" alt="">
							<span>` + userName + `</span>
						</li>
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
											<a href="#" class="menu-ul">새로운 소식</a>
											<ul class="list__grid">
		`;
		
		column_NEW.forEach(function(row_NEW) {
			storyHtml += `
												<li class="st__box" onClick="location.href='${row_NEW.page_url}'">
													<div class="newsBox">
														<img src ='${img_root}${row_NEW.img_location}'>
														<div class="news-title kr" href="">${row_NEW.story_title}</div>
														<div class="news-m-title en" href="">${row_NEW.story_sub_title}</div>
													</div>
												</li>
			`;
		});
		
		storyHtml += `
											</ul>
										</li>
										<li>
											<a href="/story/main" class="menu-ul">아카이브</a>
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
															<li class="archiveList allBtn"><a href="/posting/collection" class="menu-ul">+  전체보기</a></li>
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
															<li class="archiveList allBtn"><a href="/posting/runway" class="menu-ul">+  전체보기</a></li>
														</ul>
													</div>
												</li>
												<li class="st__box"  data-mdl="">
													<div class="mid-a archiveTitle"><a href="/posting/editorial" class="menu-ul">에디토리얼</a></div>
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
																<li class="archiveList allBtn"><a href="/posting/editorial" class="menu-ul">+  전체보기</a></li>
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
								<a class="mdl__title" href="${el.menu_link}">전체보기</a>
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
												return`<div class="swiper-slide">
															<div class="slide__wrap" style="display:flex">
																<img src="${img_root}${el.slide_img}" alt="" style="width:110px">
																<div class="swiper__title" style="margin-left:10px;margin-top:auto;margin-bottom:auto;margin-left:10px;font-size:13px;color:#343434">${el.slide_name}</div>
															</div>
														</div>`
												}).join("")
											}
										</div>
									</div>  
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
							<ul class="mdl">
								${
								mdl.map((el,idx) => {
										return `<a class="mdl__title po__wrap"  href="${el.menu_link}">
													<img src ='http://116.124.128.246:80/images/${colaboImg[idx]}' class="po__image">
													<div class="po__title">${el.menu_title}</div>
												</a>`
								}).join("")
								}
								<a class="mdl__title po__wrap" href="/posting/collaboration">
									<div style="width:50px">
										<img src="/images/svg/plus-bk.svg" style="width:12px;margin:4px auto;" alt="">
									</div>
									<div class="po__title__all">콜라보레이션 전체보기</div>
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
						<img src="/images/svg/user-bk.svg" style="width:14px" alt=""><span>` + userName + `</span>
					</li>
					<li class="mobile-search-wrap">
						<div class="mobile__search__btn lrg__title non_underline"><img src="/images/svg/search-bk.svg" style="width:14px" alt=""><span>검색</span></div>
					</li>
					<li class="mobile-customer-wrap">
						<div class="mobile__customer__btn lrg__title non_underline"><img src="/images/svg/customer-bk.svg" style="width:14px" alt=""><span>고객서비스</span></div>
					</li>
					<li class="flex bluemark" onclick="location.href='/mypage?mypage_type=bluemark_verify'">
						<div class="bluemark-icon"></div><span>Bluemark</span>
					</li>
					<li class="flex language"><div style="width:14px;text-align:center;">KR</div><span>Language</span></li>
					<li class="flex logout"><span>로그아웃[임시]</span></li>
				</ul>
				<div class="mobile__search">
					<div class="search__back__btn"></div>
					<div class="search__cont"></div>
				</div>
		`;
		mobileMenu.innerHTML = menuHtml;
		document.querySelector(".side__menu").appendChild(domfrag);
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
						<div class="lrg__title non_underline"><span>스토리</span></div>
						<div class="mdlBox">
							<ul class="mdl">
								<li>
									<div class="sub__title">새로운 소식</div>
									<ul class="list__grid">
		`;
		
		column_NEW.forEach(function(row_NEW) {
			storyHtml += `
										<li class="st__box" onClick="location.href='${row_NEW.page_url}'">
											<div class="newsBox">
												<img src ='${img_root}${row_NEW.img_location}'>
												<div class="news-title-wrap">
													<div class="news-title" href="">${row_NEW.story_title}</div>
													<div class="news-m-title" href="">${row_NEW.story_sub_title}</div>
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
									<div class="sub__title"><a href="http://116.124.128.246/story/main">아카이브</a></div>
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
											<div class="mid-a archiveTitle" onclick="location.href='/posting/editorial'">에디토리얼</div>
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
					<li class="mobile-store-search-wrap"><span>매장찾기</span></li>
				</ul>
		`;
		
		return storyHtml;
	}
	
	function mobileMdlSwipe() {
		const $$swiperBox = document.querySelectorAll(".m__swiper__box");
		$$swiperBox.forEach((el, idx)=> {
			let mobileMenuSwiper = new Swiper(`#mobileMenuSwiper${idx}`,{
				observer:true,
				observeParents:true,
				autoplay: {
					delay: 2000,
					disableOnInteraction: true
				}
			});
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
				$(".mobile__menu .lrg").each(function(idx,el){
					if($(el).attr("data-lrg") < lrg_idx){
						$(el).hide();
					}
					else{
						$(el).show();
					}
				});
				$(".mobile__menu .lrg__title").removeClass("open");
				$(".mobile__menu .lrg__back__btn").removeClass("open");
				if(lrg_type == "ST"){
					$(".mobile-store-search-wrap").hide();
					$(".bottom").hide();
				}
				$(this).addClass("open");
				$(lrg__back__btn_obj).addClass("open");
				$(".mdlBox").slideUp(500);
				$(mdlBox_obj).slideDown(500);
				mobileMdlSwipe();
			}
		});
		$(".mobile__menu .lrg__back__btn").click(function(){
			$(".mdlBox").slideUp(500);
			$(".mobile__menu .lrg__title").removeClass("open");
			$(".mobile__menu .lrg__back__btn").removeClass("open");
			$(this).closest(".side__menu").removeClass("lrg__on");
			$(".mobile-store-search-wrap").show();
			$(".bottom").show();
			$(".mobile__menu .lrg").slideDown(500);
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

	function windowResponsive() {
		const $body = document.querySelector("body");
		const bodyWidth = document.querySelector("body").offsetWidth;
		if ( 1024 <= bodyWidth) {
			$body.dataset.view = "rW"
		} else if(1024 >= bodyWidth) {
			$body.dataset.view = "rM"
		}
	}


	// const webMenu = () => {
	//	 const navBtn = document.querySelectorAll('.webMenu');
	//	 const web = document.querySelector('#web');
	//	 navBtn.forEach((el) => {
	//		 el.addEventListener('click', (ev) => {
	//			 let slected = event.target.classList.contains('slected');
	//			 console.log(contain);
	//			 if (slected) {
	//				 ev.target.classList.remove('slected');
	//				 web.style.display = 'none';
	//			 } else {
	//				 ev.target.classList.add('slected');
	//				 web.style.display = 'block';
	//			 }
	//		 });
	//	 });
	// }
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
					let text = getLanguage();
					let btn = document.querySelectorAll('.side__box .language-btn');
					btn.forEach(el => el.addEventListener("click",function(){
						if(this.classList.contains('korea')){
							i18next.changeLanguage("KR");
						} else if(this.classList.contains('english')){
							i18next.changeLanguage("EN");
						} else if(this.classList.contains('china')){
							i18next.changeLanguage("CN");
						}
						$('.header__menu .side-bar .language-text').html(localStorage.getItem('lang'))
					}))
					function getLanguage() {
						return navigator.language || navigator.userLanguage;
					}
				}else if(typeTarget === "B"){
					if(getLoginStatus() == 'false'){
						location.href='/login';
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
		function sidebarClose() {
			const $body = document.querySelector("body");
			sideBarBtn.forEach(el => el.classList.remove("open"));
			let sideContainer = document.querySelector("#sidebar");
			let sideBg = document.querySelector(".side__background");
			let sideWrap = document.querySelector(".side__wrap");
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
	
	


	