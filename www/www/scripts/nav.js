import {Sidebar} from '/scripts/module/sidebar.js';
import {Basket} from '/scripts/module/basket.js';
import {Bluemark} from '/scripts/module/bluemark.js';
import {Language} from '/scripts/module/language.js';
import {Search} from '/scripts/module/search-popular.js';
import {User} from '/scripts/module/user.js';
	
	window.addEventListener('DOMContentLoaded', function() {
		getMenuListApi();
		windowResponsive();
	});
	window.addEventListener('resize', () => {
		windowResponsive()
	});

	const getMenuListApi = () => {
		let country = "KR";
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
		let data = d.data
		let member_info = d.member_info
		let menuList = document.createElement("ul")
		menuList.classList.add("header__grid");
		let menuHtml="";
		menuHtml = '<li class="first__space"></li>';
		let domfrag = document.createDocumentFragment(menuList);
		domfrag.appendChild(menuList)
		let colaboImg = ["/sample/colabo1.png","/sample/colabo2.png","/sample/colabo3.png","/sample/colabo4.png","/sample/colabo5.png"];
		
		let userName = member_info != null ? member_info.member_name : "MY";
		menuHtml +=
			`<li class="header__logo" onClick="location.href='/'">
				<img class="logo"src="/images/landing/logo.png" alt="">
			</li>
			<li class="header__menu">
				<ul class="menu__wrap left">`;
		data.forEach((el, idx) => {
			let lrgDiv = document.createElement("div");
			let lrg = el.menu_lrg;
			let mdl = lrg.menu_mdl;
			if( el.menu_lrg.menu_type =="PR") {
				menuHtml +=
				`
				<li class="drop web" data-type="${lrg.menu_type}" data-lrg="${idx}">
					<a class="menu-ul lrg" href="${lrg.menu_link}">${lrg.menu_title}</a>
					<div class="drop__menu">
						<ul class="cont pr__menu">
									<li class="swiper-li">
										<div class="swiper swiper__box" data-id="${idx}" id="menuSwiper${idx}">
											<div class="swiper-wrapper">
												${
													lrg.menu_slide.map((el, idx) => {
													return`<div class="swiper-slide">
																<div>
																	<img src="${img_root}${el.slide_img}" alt="" style="margin-left: auto;margin-right: auto;">
																	<span class="swiper__title">${el.slide_name}</span>
																</div>
															</div>`
													}).join("")
												}
											</div>
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
				</li>`
			}
			if( el.menu_lrg.menu_type =="PO") {
				menuHtml +=
				`<li class="drop web" data-type="${lrg.menu_type}" data-lrg="${idx}">
					<a class="menu-ul lrg" href="${lrg.menu_link}">${lrg.menu_title}</a>
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
										<a class="menu-ul">
											콜라보레이션
										</a>
										<a class="menu-ul">
											전체보기
										</a>
									</li>
								</ul>
							</li>
							<li></li>
						</ul>
					</div>
				</li>`
			}
		});
		menuHtml +=`
				</ul>
				<ul class="menu__wrap right">`
		menuHtml +=`
				<li class="drop web story" data-type="ST" data-large="6">
					<a class="menu-ul lrg" href="">스토리</a>
					<div class="drop__menu">
						<ul class="cont st__menu">
							<li></li>
							<li>
								<ul class="st__cont">
									<li>
										<a href="">새로운 소식</a>
										<ul class="list__grid">
											<li class="st__box">
												<div class="newsBox">
													<img src ='http://116.124.128.246:80/images/sample/news01.jpg'>
													<div class="news-title kr" href="">시그니처 쇼퍼백 구매 신청하기</div>
													<div class="news-m-title en" href="">Shopper bag Stand by</div>
												</div>
											</li>
											<li class="st__box">
												<div class="newsBox">
													<img src ='http://116.124.128.246:80/images/sample/news02.jpg'>
													<div class="news-title kr" href="">로고 리바이벌 오리진의 뉴 컬렉션</div>
													<div class="news-m-title en" href="">22SS Origin Line<br>Og: Diagonal</div>
												</div>
											</li>
											<li class="st__box">
												<div class="newsBox">
													<img src ='http://116.124.128.246:80/images/sample/news03.jpg'>
													<div class="news-title kr" href="">아더에러X버켄스탁의<br>첫 번째 협업 프로젝트</div>
													<div class="news-m-title en" href="">Adererror x Birkenstock<br>Too pasionate to stop</div>
												</div>
											</li>
										</ul>
									</li>
									<li>
										<a href="">아카이브</a>
										<ul class="list__grid">
											<li class="st__box">
												<div class="mid-a archiveTitle">프로젝트</div>
												<div class="archiveBox">
													<ul>
														<li class="archiveList">2022 SS  'After blue'</li>
														<li class="archiveList">2022 Origin 'Cinder'</li>
														<li class="archiveList">2021 AW 'Un nouveau système'</li>
														<li class="archiveList">2021 SS 'Layering time'</li>
													</ul>
													<ul>
														<li class="archiveList dot"></li>
														<li class="archiveList allBtn">+  전체보기</li>
													</ul>
												</div>
											</li>
											<li class="st__box"  data-mdl="">
												<div class="mid-a archiveTitle">룩북</div>
												<div class="archiveBox">
													<ul>
														<li class="archiveList">2022 F/W 'Phenomenon comm...</li>
														<li class="archiveList">2022 S/S 'After blue'</li>
														<li class="archiveList">2022 Origin 'Cinder'</li>
														<li class="archiveList">2021 SS 'Layering time'</li>
													</ul>
													<ul>
														<li class="archiveList dot"></li>
														<li class="archiveList allBtn">+  전체보기</li>
													</ul>
												</div>
											</li>
											<li class="st__box"  data-mdl="">
												<div class="mid-a archiveTitle">에디토리얼</div>
												<div class="archiveBox">
													<ul>
														<li class="archiveList">Mule series 'Curve'</li>
														<li class="archiveList">‘Self Expression'</li>
														<li class="archiveList">Adererror x Puma 'Vaderon'</li>
														<li class="archiveList">2022ss campaign ‘After blue'</li>
													</ul>
													<ul>
														<li class="archiveList dot"></li>
														<li class="archiveList allBtn">+  전체보기</li>
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
				<li class="drop web search_shop" >
					<a class="menu-ul lrg" href="/search/shop">매장찾기</a>
				</li>
				<li class="web bluemark__btn side-bar" data-type="M"><img class="bluemark-svg" src="/images/svg/bluemark.svg" alt=""></li>
				<li class="web alg__c side-bar" data-type="E"><span class="language-text">KR</span></li>
				<li class="web search__li side-bar" data-type="S">					
					<img class="search-svg" style="height: 14px;" src="/images/svg/search.svg" alt="">
				</li>
				<li class="flex wishlist__btn" onclick="navWhishlistBtn()" data-type="W"><img class="wishlist-svg" style="height:14px" src="/images/svg/wishlist.svg" alt=""><span class="wish count"></span></li>
				<li class="flex basket__btn side-bar" data-type="B"><img class="basket-svg" style="height:14px" src="/images/svg/basket.svg" alt=""><span class="basket count"></span></li>
				<li class="web alg__r login__wrap mypage__icon side-bar" data-type="L">
					<img class="user-svg" style="height:14px" src="/images/svg/user-bk.svg" alt="">
					<span>` + userName + `</span>
				</li>
				<li class="web"></li>
				<li class="flex pr-3 lg:hidden mobileMenu">
					<div class="hamburger" id="hamburger">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</div>
				</li>`;
		menuHtml +=`</ul>
				</li>`;
		menuList.innerHTML = menuHtml;
		document.querySelector(".header__wrap").appendChild(domfrag);
		mobileMenu();
		
		
		
		let $$webMenu = document.querySelectorAll(".web");
		let $webMenu = document.querySelector(".web");
		let $lrgMenu = document.querySelectorAll(".lrg");
				
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
		
		$(".drop.web").hover(function() {
			var showRate = 200;
			$(".drop__menu").each(function(index, item){
				if($(item).css("display") == "block"){
					showRate = 0;
				}
			});
			$(this).find(".drop__menu").fadeIn(showRate);
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
	
	const mobileWriteNavHtml = (d) => {
		let data = d.data
		let member_info = d.member_info
		let userName = member_info != null ? member_info.member_name : "로그인";
		
		let mobileMenu = document.createElement("div");
		mobileMenu.classList.add("mobile__menu");
		let domfrag = document.createDocumentFragment(mobileMenu);
		domfrag.appendChild(mobileMenu);
		let colaboImg = ["/sample/colabo1.png","/sample/colabo2.png","/sample/colabo3.png","/sample/colabo4.png","/sample/colabo5.png"];
		let menuHtml = 
		`<ul class="top">`
		
		data.forEach((el, idx) => {
			let lrg = el.menu_lrg;
			let mdl = lrg.menu_mdl;
			
			if( el.menu_lrg.menu_type =="PR") {
				menuHtml += 
				`<li class="lrg" data-lrg="${idx}">
					<div class="lrg__back__btn"></div>
					<div class="lrg__title">${lrg.menu_title}</div>
					<div class="mdlBox">
						<ul class="mdl">
							<a class="mdl__title" href="${lrg.menu_link}">전체보기</a>
							${
							mdl.map((el,idx) => {
									return `<a class="mdl__title"  href="${el.menu_link}">${el.menu_title}</a>`
							}).join("")
							}
							<li class="swiper-li">
								<div class="swiper m__swiper__box" data-id="${idx}" id="mobileMenuSwiper${idx}">
									<div class="swiper-wrapper">
										${
											lrg.menu_slide.map((el, idx) => {
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
				</li>`
			}
			if( el.menu_lrg.menu_type =="PO") {
				menuHtml += 
				`<li class="lrg" data-lrg="${idx}">
					<div class="lrg__back__btn"></div>
					<div class="lrg__title">${lrg.menu_title}</div>
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
				</li>`
			}
		});
		menuHtml +=
		`
		</ul>
		<ul class="mid">
			<li class="lrg" data-lrg="6">
				<div class="lrg__back__btn"></div>
				<div class="lrg__title non_underline"><span>스토리</span></div>
				<div class="mdlBox">
					<ul class="mdl">
						<li>
							<div class="sub__title">새로운 소식</div>
							<ul class="list__grid">
								<li class="st__box">
									<div class="newsBox">
										<img src ='http://116.124.128.246:80/images/sample/news01.jpg'>
										<div class="news-title-wrap">
											<div class="news-title" href="">시그니처 쇼퍼백 구매 신청하기</div>
											<div class="news-m-title" href="">Shopper bag Stand by</div>
										</div>
									</div>
								</li>
								<li class="st__box">
									<div class="newsBox">
										<img src ='http://116.124.128.246:80/images/sample/news02.jpg'>
										<div class="news-title-wrap">
											<div class="news-title" href="">로고 리바이벌 오리진의 뉴 컬렉션</div>
											<div class="news-m-title" href="">22SS Origin Line<br>Og: Diagonal</div>
									</div>
									</div>
								</li>
								<li class="st__box">
									<div class="newsBox">
										<img src ='http://116.124.128.246:80/images/sample/news03.jpg'>
										<div class="news-title-wrap">
											<div class="news-title" href="">아더에러X버켄스탁의<br>첫 번째 협업 프로젝트</div>
											<div class="news-m-title" href="">Adererror x Birkenstock<br>Too pasionate to stop</div>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<li class="div__line">
						</li>
						<li>
							<div class="sub__title">아카이브</div>
							<ul class="list__grid">
								<li class="st__box">
									<div class="mid-a archiveTitle">프로젝트</div>
									<div class="archiveBox">
										<ul>
											<li class="archiveList">2022 SS  'After blue'</li>
											<li class="archiveList">2022 Origin 'Cinder'</li>
											<li class="archiveList">2021 AW 'Un nouveau système'</li>
											<li class="archiveList">2021 SS 'Layering time'</li>
											<li class="archiveList allBtn">+  전체보기</li>
										</ul>
									</div>
								</li>
								<li class="div__line">
								</li>
								<li class="st__box">
									<div class="mid-a archiveTitle">룩북</div>
									<div class="archiveBox">
										<ul>
											<li class="archiveList">2022 F/W 'Phenomenon comm...</li>
											<li class="archiveList">2022 S/S 'After blue'</li>
											<li class="archiveList">2022 Origin 'Cinder'</li>
											<li class="archiveList">2021 SS 'Layering time'</li>
											<li class="archiveList allBtn">+  전체보기</li>
										</ul>
									</div>
								</li>
								<li class="div__line">
								</li>
								<li class="st__box">
									<div class="mid-a archiveTitle">에디토리얼</div>
									<div class="archiveBox">
										<ul>
											<li class="archiveList">Mule series 'Curve'</li>
											<li class="archiveList">‘Self Expression'</li>
											<li class="archiveList">Adererror x Puma 'Vaderon'</li>
											<li class="archiveList">2022ss campaign ‘After blue'</li>
											<li class="archiveList allBtn">+  전체보기</li>
										</ul>
									</div>
								</li>
							</ul>
						</li>
						<li class="div__line last">
						</li>
					</ul>
				</div>
			</li>
			<li><span>매장찾기</span></li>
		</ul>
		<ul class="bottom">
			<li class="flex" onclick="location.href='/mypage'"><img src="/images/svg/user-bk.svg" style="width:18px" alt=""><span>` + userName + `</span></li>
			<li class="mobile-search-wrap">
				<div class="mobile__search__btn lrg__title non_underline"><img src="/images/svg/search-bk.svg" style="width:18px" alt=""><span>검색</span></div>
				<div class="mdlBox"></div>
			</li>
			<li class="flex"><img src="/images/svg/customer-bk.svg" style="width:18px" alt=""><span>고객서비스</span></li>
			<li class="flex bluemark"><div class="bluemark-icon"></div><span>Bluemark</span></li>
			<li class="flex language"><span>KR</span><span>Language</span></li>
			
		</ul>
		<div class="mobile__search">
			<div class="seach__input">
				<img src="/images/svg/mobile-search.svg" alt="">
				<input type="text" placeholder="검색어를 입력하세요">
			</div>
			<div class="recommend__search">
				<ul>
					<li class="recommend__search__title">추천 검색어</li>
					<li class="search__result">쇼퍼백</li>
					<li class="search__result">트윈하트로고 티셔츠</li>
					<li class="search__result">키링</li>
					<li class="search__result">The new is not new</li>
					<li class="search__result">버켄스탁 콜라보레이션</li>
				</ul>
			</div>
			<div class="recommend__prd">
				<div class="prd__title">추천 상품</div>
				<div class="prd__content">
					<div class="prd__card">
						<div class="prd__img__wrap">
							<div class="prd__img" style="background-image: url('/images/product/prd2.png');"></div>
						</div>
						<p class="prd__img__title">shopper bag</p>
					</div>
					<div class="prd__card">
						<div class="prd__img__wrap">
							<div class="prd__img" style="background-image: url('/images/product/prd4.png');"></div>
						</div>
						<p class="prd__img__title">shopper bag</p>
					</div>
					<div class="prd__card">
						<div class="prd__img__wrap">
							<div class="prd__img" style="background-image: url('/images/product/prd1.png');"></div>
						</div>
						<p class="prd__img__title">shopper bag</p>
					</div>
					<div class="prd__card">
						<div class="prd__img__wrap">
							<div class="prd__img" style="background-image: url('/images/product/prd3.png');"></div>
						</div>
						<p class="prd__img__title">shopper bag</p>
					</div>
				</div>
			</div>
		</div>`
		mobileMenu.innerHTML = menuHtml;
		document.querySelector(".side__menu").appendChild(domfrag);
		menuLrgClick();
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
				$(this).addClass("open");
				$(lrg__back__btn_obj).addClass("open");
				$(".mdlBox").slideUp(150);
				$(mdlBox_obj).slideDown(300);
				mobileMdlSwipe();
			}
		});
		$(".mobile__menu .lrg__back__btn").click(function(){
			$(".mdlBox").slideUp(150);
			$(".mobile__menu .lrg__title").removeClass("open");
			$(".mobile__menu .lrg__back__btn").removeClass("open");
			$(this).closest(".side__menu").removeClass("lrg__on");
			$(".mobile__menu .lrg").slideDown(200);
		});
		
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
		const mobileMenuBtn = document.querySelector('.mobileMenu');
		const mobileSide = document.querySelector('#mobile');
		const hamburgerBtn = document.querySelector(".hamburger");
		let header = document.querySelector("header");
		mobileMenuBtn.addEventListener('click', (ev) => {
			mobileSide.classList.toggle('menu__on');
			hamburgerBtn.classList.toggle("is-active");
			header.classList.toggle("scroll");
			let mobileSearch = new Search();
			mobileSearch.mobileWriteHtml();
			mobileSearch.addSearchEvent();
		});
	};
	$(document).ready(function(){
		$(".header__wrap").hover(function() {
			headerHover(true);
			// headerHoberCheck();

		},function(){
			headerHover(false);
			// headerHoberCheck();

		});
		
	})
	
	
	/*디바이스 체크*/
	function checkMobileDevice() {
		var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
		for (var info in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
				//mobile
				return true;
			}
		}
		//web
		return false;
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
					console.log("🏂 ~ file: nav.js:656 ~ el.addEventListener ~ 현재 언어:", text)
					
					function getLanguage() {
						return navigator.language || navigator.userLanguage;
					}
				}else if(typeTarget === "B"){
						const basket = new Basket("basket",true);
						basket.writeHtml();
					if(path.includes("basket")){
						e.stopImmediatePropagation();
					}
					console.log("베스킷");
				}else if(typeTarget === "M"){
					console.log("블루마켓");
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
					console.log("마이페이지");
				}else if(typeTarget === "W"){
					if(path.includes("whish")){
						e.stopImmediatePropagation();
					}
					
					console.log("위시리스트");
				}
				sideBarToggleEvent(target);
			});
		})
		function sideBarToggleEvent(target){
			layoutClick(target);
			let sideContainer = document.querySelector("#sidebar");
			let sideBg = document.querySelector(".side__background");
			let sideWrap = document.querySelector(".side__wrap");
			if(sideContainer.classList.contains("open")){

				sidebarClose();				

			} else {
				target.classList.add("open");
				$("header").addClass("scroll");
				$("body").css("overflow","hidden");
				sideContainer.classList.add("open");
				sideBg.classList.add("open");
				sideWrap.classList.add("open");
				headerHover(true);
			}


		}
		function sidebarClose () {
			sideBarBtn.forEach(el => el.classList.remove("open"));
			let sideContainer = document.querySelector("#sidebar");
			let sideBg = document.querySelector(".side__background");
			let sideWrap = document.querySelector(".side__wrap");
			sideBarBtn.forEach(el => el.classList.remove("open"));
			$("header").removeClass("scroll");
			$("body").css("overflow","inherit")
			sideContainer.classList.remove("open");
			sideBg.classList.remove("open");
			sideWrap.classList.remove("open");
			document.querySelector(".side__box").innerHTML = "";
			headerHover(false);
		}
		function layoutClick () {
			let sideWrap = document.querySelector(".side__wrap");
			let sideBg = document.querySelector(".side__background");
			sideBg.addEventListener("click" ,(e) =>{
				if(e.target == sideBg){
					sidebarClose();
				}
			} )

		}
	}
	// function headerHoberCheck() {
	// 	let header = document.querySelector("header");
	// 	let sidebarBg = document.querySelector(".side__background");
	// 	if(header.classList.contains("hover")){
	// 		sidebarBg.style.background ="#00000000"; 
	// 		console.log("open")
	// 	} else{
	// 		sidebarBg.style.background ="#000000cc";
	// 		console.log("close")
	// 	}
	// }


	