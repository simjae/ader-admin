<link rel=stylesheet href='/css/old/product/detail.css' type='text/css'>
<?php
function getUrlParamter($url, $sch_tag)
{
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$product_idx = getUrlParamter($page_url, 'product_idx');
?>
<main data-productidx="<?= $product_idx ?>" data-country="KR">
	<div class="detail__sidebar__wrap">
		<div class="sidebar__background" data-modal="detail">
			<div class="sidebar__wrap" data-modal="detail">
				<div class="sidebar__box" data-modal="detail">
					<div class="sidebar__header">
						<img class="sidebar__close__btn" src="/images/svg/close.svg" alt="">
					</div>
					<div class="sidebar__body">
						<div class="content__btn__wrap">
							<div class="tap__btn material__btn"><span>소재</span></div>
							<div class="tap__btn product__info__btn"><span>제품 상세정보</span></div>
							<div class="tap__btn precaution__btn"><span>제품 취급 유의사항</span></div>
						</div>
						<div class="content__box">
							<div class="material"></div>
							<div class=""></div>
							<div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="detail__wrapper">
		<div class="detail__box">
			<div class="navigation__wrap"></div>
			<div class="detail__img__wrap">
				<div class="main__swiper swiper">
					<div class="swiper-wrapper main_img_wrapper"></div>

					<div class="swiper-pagination pagination_fraction"></div>

					<div class="mobile-bullet">
						<div class="swiper-pagination pagination_bullet"></div>
					</div>
				</div>
			</div>
				
		</div>
		<div class="info__wrap"></div>
		<div class="basket__wrap nav">
			<div class="basket__box">
				<div class="basket-btn" onClick="location.href='/order/basket/list'">
					<img src="/images/svg/basket.svg" alt="">
					<span class="basket-title">쇼핑백에 담기</span>
				</div>
				<div class="whish-btn">
					<img src="/images/svg/wishlist-bk.svg" alt="" style="">
				</div>
			</div>
		</div>
	</section>
	<aside class="style__wrapper">
		<div class="left__title"><span>Styling with   ></span></div>
		<div class="style-wrap">
			<div class="style-swiper swiper">

			</div>
		</div>
	</aside>
	<aside class="foryou__wrapper">
		<div class="left__title"><span>For you   ></span></div>
		<div class="foryoy-wrap">
			<div class="foryou-swiper swiper">

			</div>
		</div>
	</aside>
</main>
<script>
	window.addEventListener('DOMContentLoaded', function() {
		let product_idx = document.querySelector("main").dataset.productidx;
		getProduct(product_idx);
		
	});
	let timer = null;
	window.addEventListener("resize" , function() {
		mainSwiperDirectionCheck();
		// clearTimeout( timer );  

		// timer = setTimeout( changeDirection(dir), 150 );  
	});

	const getProduct = (product_idx) => {
		const main = document.querySelector("main");
		// let product_idx = main.dataset.productidx;
		let country = main.dataset.country;


		$.ajax({
			type: "post",
			data: {
				"product_idx": product_idx,
				"country": country,
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/product/get",
			error: function() {
				alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				let data = d.data;

				const domFrag = document.createDocumentFragment();
				const infoWrap = document.querySelector(".info__wrap");
				const thumbnailImgWrap = document.querySelector(".thumbnail_img_wrapper");
				const navigationWrap = document.querySelector(".navigation__wrap");
				const mainImgWrap = document.querySelector(".main_img_wrapper");

				let imgUrl = "http://116.124.128.246:81";

				let infoBoxHtml = "";
				data.forEach((el) => {
					let img_thumbnail = el.img_thumbnail;
					let imgThumbnailHtml = "";

					img_thumbnail.forEach((thumbnail) => {
						imgThumbnailHtml = `<img src="${imgUrl}${thumbnail.img_location}"/><span>착용 이미지</span>`;
						const thumbnailBox = document.createElement("div");
						thumbnailBox.classList.add("thumb__box");
						thumbnailBox.innerHTML= imgThumbnailHtml;
						domFrag.appendChild(thumbnailBox);
					});
					navigationWrap.appendChild(domFrag);

					let img_main = el.img_main;
					let imgMainHtml = "";
					img_main.forEach((main) => {
						imgMainHtml = `
							<img class="detail__img" data-imgtype="${main.img_type}" data-size="${main.img_size}" src="${imgUrl}${main.img_url}"/>
						`;

						const mainInfo = document.createElement("div");
						mainInfo.classList.add("swiper-slide");
						mainInfo.dataset.imgtype= main.img_type;
						mainInfo.dataset.imgsize= main.img_size;
						mainInfo.innerHTML = imgMainHtml;
						domFrag.appendChild(mainInfo);

					});
					mainPageHtml  =`
					
					
					` 
					mainImgWrap.appendChild(domFrag);

					let product_color = el.product_color;
					let productColorHtml = "";
					product_color.forEach(color => {
						let colorData = color.color_rgb;
						let multi= colorData.split(";");
						console.log(multi)
						console.log(colorData)
						if(multi.length === 2){
							productColorHtml += `
							<div class="color-line" data-idx="${color.product_idx}"  style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
								<div class="color multi" data-title="${color.color}"></div>
							</div>
						`;
						} else {
							productColorHtml += `
								<div class="color-line" data-idx="${color.product_idx}" data-title="${color.color}" style="--background-color:${multi[0]}" >
									<div class="color" data-title="${color.color}"></div>
								</div>
							`;
						}
					});

					let product_size = el.product_size;
					let productSizeHtml = "";
					product_size.forEach(size => {
						productSizeHtml += `
							<li>${size.option_name}</li>
						`;
					});

					infoBoxHtml = `
						<div class="product__title">${el.product_name}</div>
						<div class="product__price">${el.sales_price.toLocaleString('ko-KR')}</div>
						<div class="product__color">${el.color}</div>
						<div class="color__box">
							${productColorHtml}
						</div>
						<div class="product__size">
							<div>Size</div>
							<div class="size__box">
								${productSizeHtml}
							</div>
						</div>
						<div class="basket__wrap">
							<div class="basket__box">
								<div class="basket-btn" onClick="location.href='/order/basket/list'">
									<img src="/images/svg/basket.svg" alt="">
									<span class="basket-title">쇼핑백에 담기</span>
								</div>
								<div class="whish-btn">
									<img src="/images/svg/wishlist-bk.svg" alt="" style="">
								</div>
							</div>
						</div>
						<div class="detail__btn__wrap">
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/sizeguide.svg" alt="">
								</div>
								<span class="btn-title">사이즈가이드</span>
							</div>
							<div class="detail__btn__row">
								<div class="img-box select">
									<img src="/images/svg/material.svg" alt=""></div>
								<span class="btn-title">소재</span>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/information.svg" alt="">
								</div>
								<span class="btn-title">상세정보</span>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/precaution.svg" alt="">
								</div>
								<span class="btn-title">취급 유의사항</span>
							</div>
						</div>
						
					`;
				});
				mainSwiperDirectionCheck();


				let relevant_idx = data[0].relevant_idx;
				if (relevant_idx != null) {
					getRelevantProductList(relevant_idx,country);
				}
				getProductRecommendList();


				const prdInfo = document.createElement("div");
				prdInfo.classList.add("info__box");
				prdInfo.innerHTML = infoBoxHtml;

				domFrag.appendChild(prdInfo);
				
				infoWrap.appendChild(domFrag);
				colorNodeCheck();
				const $detailSidebarWrap = document.querySelector(".detail__sidebar__wrap");
				const $sidebarBg = document.querySelector(".detail__sidebar__wrap .sidebar__background");
				const $sidebarWrap = document.querySelector(".detail__sidebar__wrap .sidebar__wrap");
				const $detailInfoWrap = document.querySelector(".detail__btn__wrap");
				const $sidebarCloseBtn = document.querySelector(".sidebar__close__btn");
				let $$contentBtn = document.querySelectorAll(".sidebar__body .content__btn__wrap .tap__btn");

				$detailInfoWrap.addEventListener("click", () => {
					$detailSidebarWrap.classList.toggle("open")
					$sidebarBg.classList.toggle("open");
					$sidebarWrap.classList.toggle("open");
					$detailInfoWrap.classList.toggle("open")
				});
				$sidebarCloseBtn.addEventListener("click", sideBarClose);
				//sidebar__wrap 외부 클릭 종료
				$sidebarBg.addEventListener("mouseup", function(e) {
					if (!$sidebarWrap.contains(e.target)) {
						sideBarClose();
					}
				});
				$$contentBtn.forEach((el) => {
					el.addEventListener("click", function() {
						removeTapSelect();
						this.querySelector("span").classList.add("select");
					});
				});

				function sideBarClose() {
					$detailSidebarWrap.classList.remove("open")
					$sidebarBg.classList.remove("open");
					$sidebarWrap.classList.remove("open");
					$detailInfoWrap.classList.remove("open");
				}

				function removeTapSelect() {
					$$contentBtn.forEach((el) => {
						el.querySelector("span").classList.remove("select");
					});
				}
				// 컬러 표기
				
				
				
			}
			
		});
		
	}
	//현재 상품 컬러 체크 
	function colorNodeCheck() {
		const colorBox =  document.querySelector(".color__box");
		const colors =  document.querySelectorAll(".color-line");
		let product_idx = document.querySelector("main").dataset.productidx;
		colors.forEach(el => {
			if(el.dataset.idx === product_idx){
				el.classList.add("select");
				el.remove();
				let cloneNode = el.cloneNode(true);
				colorBox.prepend(cloneNode);
			}
			el.addEventListener("mouseover",function(e) {
				let target = e.currentTarget;
				let colorArr = Array.from(colors);
				let notTarget = colorArr.filter(el => el != target);
			},{once:true});
			el.addEventListener("click",function(e) {
				let targetIdx = e.currentTarget.dataset.idx;
			});
		});
	}
	// 메인스와이퍼 ////
	

	let isVertical = undefined;
	let direction = 'vertical';
	let mainControll = mainControllSwiper();
	let mainDetailSwiper = initMainSwiper();

	function mainSwiperDirectionCheck() {
		const body = document.querySelector("body");
		let view = body.dataset.view;
		let dir = "";

		if(view === "rW") {
			mainDetailSwiper.destroy(true,true);
		} else if(view === "rM") {
			changeDirection();
		}
	}
	function initMainSwiper() {
		return new Swiper('.main__swiper', {
			observer:true,
			observeParents:true,
			pagination: {
				el: ".pagination_fraction",	
				dynamicBullets: true,
				dynamicMainBullets: 5,
				type: "fraction"
			},
			
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev"
			},
			slidesPerView: 1			
		});
	}
	function mainControllSwiper() {
		return new Swiper(".main__swiper", {
			pagination: {
				el: ".pagination_bullet",
				dynamicBullets: true,
				dynamicMainBullets: 5,
				type: "bullets"
			},
		});
	}
	function changeDirection() {
		let slideIndex = mainDetailSwiper.activeIndex;
		mainDetailSwiper.destroy(true, true);
		mainDetailSwiper = initMainSwiper();
		
		mainDetailSwiper.slideTo(slideIndex,0);

		mainControll.destroy(true, true);
		mainControll = mainControllSwiper();
		mainDetailSwiper.controller.control = mainControll;
	}
	const getRelevantProductList = (relevant_idx,country) => {
		$.ajax({
			type: "post",
			data: {
				"relevant_idx": relevant_idx,
				"country": country
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/common/relevant/get",
			error: function() {
				alert("관련상품정보 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
                let imgUrl = "http://116.124.128.246:81";
				let data = d.data;
				
				let productRelevantListHtml = "";
                let imgDiv="";
                const domFrag = document.createDocumentFragment();
                
                const styleWrap= document.querySelector(".style-swiper");
				const prdListSlide = document.createElement("div");
				prdListSlide.classList.add("swiper-wrapper");
                data.forEach(el => {
					let product_link = "/product/detail?product_idx=" + `${el.product_idx}`;
					
					let whish_img = "";
					let whish_function = "";
					
					let whish_flg = `${el.whish_flg}`;
					if (whish_flg == 'true') {
						whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="" style="width:19px;">';
						whish_function = "deleteWhishList(this);";
					} else if (whish_flg == 'false') {
						whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
						whish_function = "setWhishList(this);";
					}
					
					let product_size = el.product_size;
					
					let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
					let colorCtn = el.product_color.length;


					let productSizeHtml = "";
					product_size.forEach(size => {
						productSizeHtml += `
							<div class="product__size">${size.option_name}</div>
						`;
					});
					
					productRelevantListHtml += 
					`<div class="swiper-slide">
						<div class="product">
							<div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="">
								${whish_img}
							</div>
							<a href="http://116.124.128.246:80/">
								<div class="product-img swiper" onClick="location.href=''">
									<img class="prd-img" cnt="${el.product_idx}" src="${imgUrl}${el.product_img}" alt="">
								</div>
							</a>
							<div class="product-info">
								<div class="info-row">
									<div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}><span>${el.product_name}</span></div>
									${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
								</div>
								<div class="color-title"><span>${el.color}</span></div>
								<div class="info-row">
									<div class="color__box" data-maxcount="${colorCtn < 6 ?"":"over"}" data-colorcount="${colorCtn < 6 ? colorCtn: colorCtn - 5}">
										${
											el.product_color.map((color, idx) => {
												let maxCnt = 5;
												if(idx < maxCnt){
													return `<div class="color" data-color="${color.color_rgb}" data-productidx="${color.product_idx}" data-soldout="${color.stock_status}" style="background-color:${color.color_rgb}"></div>`;
												}
											}).join("")
										}
									</div>
									<div class="size__box">
										${
										el.product_size.map((size) => {
											return`<li class="size" data-sizetype="" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>`;
											}).join("")
										}  
									</div>
								</div>
							</div>
						</div>
					</div>
					`;
					
					prdListSlide.innerHTML = productRelevantListHtml;
                });
				domFrag.appendChild(prdListSlide);
				console.log(domFrag);
				styleWrap.appendChild(domFrag);
				styleSwiper();
			}
		});
	}
	const getProductRecommendList = () => {		
        $.ajax({ 
            type: "post",
            dataType: "json",
            url: "http://116.124.128.246:80/_api/common/recommend/get",
            error: function() {
                alert("추천상품정보 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let imgUrl ="http://116.124.128.246:81";
                
				let data = d.data;
				
				let productRecommendListHtml = "";
                let imgDiv="";
                const domFrag = document.createDocumentFragment();
					
				const foryouWrap = document.querySelector(".foryou-swiper");
                
				const prdRecommendListSlide = document.createElement("div");
				prdRecommendListSlide.classList.add("swiper-wrapper");
				
                data.forEach(el => {
					
					let product_link = "/product/detail?product_idx=" + `${el.product_idx}`;
					
					let whish_img = "";
					let whish_function = "";
					
					let whish_flg = `${el.whish_flg}`;
					if (whish_flg == 'true') {
						whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="" style="width:19px;">';
						whish_function = "deleteWhishList(this);";
					} else if (whish_flg == 'false') {
						whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
						whish_function = "setWhishList(this);";
					}
					
					let product_size = el.product_size;
					
					let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
					let colorCtn = el.product_color.length;

					productRecommendListHtml +=
					`<div class="swiper-slide">
						<div class="product">
							<div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="">
								${whish_img}
							</div>
							<a href="http://116.124.128.246:80/">
								<div class="product-img swiper" onClick="location.href=''">
									<img class="prd-img" cnt="${el.product_idx}" src="${imgUrl}${el.product_img}" alt="">
								</div>
							</a>
							<div class="product-info">
								<div class="info-row">
									<div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}><span>${el.product_name}</span></div>
									${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
								</div>
								<div class="color-title"><span>${el.color}</span></div>
								<div class="info-row">
									<div class="color__box" data-maxcount="${colorCtn < 6 ?"":"over"}" data-colorcount="${colorCtn < 6 ? colorCtn: colorCtn - 5}">
										${
											el.product_color.map((color, idx) => {
												let maxCnt = 5;
												if(idx < maxCnt){
													return `<div class="color" data-color="${color.color_rgb}" data-productidx="${color.product_idx}" data-soldout="${color.stock_status}" style="background-color:${color.color_rgb}"></div>`;
												}
											}).join("")
										}
									</div>
									<div class="size__box">
										${
										el.product_size.map((size) => {
											return`<li class="size" data-sizetype="" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>`;
											}).join("")
										}  
									</div>
								</div>
							</div>
						</div>
					</div>
					`;
					
					prdRecommendListSlide.innerHTML = productRecommendListHtml;
                });
				domFrag.appendChild(prdRecommendListSlide);
				console.log(domFrag);
				foryouWrap.appendChild(domFrag);
				foryouSwiper();
            }
        });
    }
	function foryouSwiper() {
		return new Swiper(".foryou-swiper", {
		navigation: {
			nextEl: ".foryou-swiper .swiper-button-next",
			prevEl: ".foryou-swiper .swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		grabCursor: true,
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 2.647
			},
			920: {
				slidesPerView: 5
			},
			1400: {
				slidesPerView: 5
			}
		}
		});
	} 
	function styleSwiper() {
		return new Swiper(".style-swiper", {
		navigation: {
			nextEl: ".style-swiper .swiper-button-next",
			prevEl: ".style-swiper .swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		grabCursor: true,
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 2.647
			},
			920: {
				slidesPerView: 5
			},
			1400: {
				slidesPerView: 5
			}
		}
		});
	} 
</script>