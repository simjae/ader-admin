<link rel=stylesheet href='/css/old/product/detail.css' type='text/css'>
<style>
	.size__box .size.select {
        border-bottom: 2px solid #343434;
    }
	.basket-btn {
        cursor: pointer;
        border-top: 1px solid #dcdcdc;
        display: flex;
        justify-content: center;
        height: 30px;
        align-items: center;
    }

    .basket-btn[data-status='0'] {
        background-color: #dcdcdc;
		opacity: 0.6;
        pointer-events: none;
    }

    .basket-btn[data-status='1'] {
        background-color: #ffffff;
    }

    .basket-btn[data-status='1'].select {
        background-color: #000000;
        color: #fff;
    }

    
    .basket-btn[data-status='1'] span::before {
        content: url('/images/svg/reflesh-wh.svg');
        filter: invert(1);
        position: relative;
        bottom: -3px;
        padding-right:5px;
    }
    .basket-btn.option span::before {
        background-color: #dcdcdc;
        content: none;
    }
    .basket-btn[data-status='1'].select span::before {
        filter: none;
    }
    .basket-btn[data-status='1'].reorder {
        background-color: #000000;
        color: #ffffff;
    }
    .basket-btn[data-status='1'].reorder span::before {
        content: url('/images/svg/reflesh-wh.svg');
        filter: none;
    }
	.basket-btn[data-status='2'] span::before {
		content: url('/images/svg/basket-bk.svg');
        position: relative;
        bottom: -3px;
        padding-right:5px;
	}

    .basket-btn.select {
        background-color: #000000;
        color: #ffffff;
    }
	.size__box li[data-soldout="STCL"]:hover::before {
        content: "Only a few left";
        position: absolute;
        width: 200px;
        bottom: -15px;
        left: -90px;
        color: red;
    }
	.size__box li[data-soldout="STSC"]:hover::after {
        content: url(/images/svg/sold-line.svg);
        position: absolute;
        right: 1px;
        top: -2px;
    }
	.size__box li[data-soldout="STSC"]:hover::before {
        content: "Re-order";
        position: absolute;
        width: 50px;
        bottom: -15px;
        left: -15px;
    }
</style>
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
				<div class="detail--box--btn">
					<div class="top"></div>
					<div class="middle">
						<div class="detail__btn__wrap">
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/sizeguide.svg" alt="">
								</div>
								<div class="detail__content__box">
									<div class="content-header"><span>사이즈 가이드</span></div>
									<div class="content-body">
										<div class="sizeguide-box">
											<div class="sizeguide-btn ">A1</div>
											<div class="sizeguide-btn">A2</div>
											<div class="sizeguide-btn select">A3</div>
											<div class="sizeguide-btn">A4</div>
											<div class="sizeguide-btn">A5</div>
										</div>
										<div class="sizeguide-noti">모델신장 179cm,착용사이즈는 A3입니다.</div>
										<div class="sizeguide-img" style="background-image: url('/images/svg/guide-top.svg');"></div>
										<div class="sizeguide-dct">
											<div class="dct-row">
												<span>A.총장</span>
												<span>옆목점에서 끝단까지의 수직길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>B. 목너비</span>
												<span>옆목점 양끝의 수평길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>C. 어깨너비</span>
												<span>옆어깨점 양끝의 수평길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>D. 가슴단면</span>
												<span>암홀점에서 1cm아래 양끝의 수평길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>E. 소매통</span>
												<span>암홀점에서 반대 소매면까지의 수직길이옆목점에서 끝단까지의 수직길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>F. 소매장</span>
												<span>어깨점부터 소매끝단까지의 길이</span>
												<span class="dct-value">103.5</span>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box select">
									<img src="/images/svg/material.svg" alt="">
								</div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/information.svg" alt="">
								</div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/precaution.svg" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="bottom"></div>
				</div>
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
				</div>
			</div>
		</div>
		<div class="info__wrap product"></div>
		<div class="basket__wrap--btn nav">
			<div class="basket__box--btn">
				<div class="basket-btn" >
					<!-- <img src="/images/svg/basket.svg" alt=""> -->
					<span class="basket-title">쇼핑백에 담기</span>
				</div>
				<div class="whish-btn">
					<img src="/images/svg/wishlist-bk.svg" alt="" style="">
				</div>
			</div>
		</div>
	</section>
	<aside class="style__wrapper">
		<div class="left__title"><span>Styling with ></span></div>
		<div class="style-wrap">
			<div class="style-swiper swiper">

			</div>
		</div>
	</aside>
	<section class="recommend-wrap"></section>
</main>
<script>
	

	window.addEventListener('DOMContentLoaded', function() {
		let product_idx = document.querySelector("main").dataset.productidx;
		getProduct(product_idx);
	});
	window.addEventListener("resize", function() {
		responsiveSwiper();
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
						thumbnailBox.dataset.type = thumbnail.display_num;
						thumbnailBox.innerHTML = imgThumbnailHtml;
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
						mainInfo.dataset.imgtype = main.img_type;
						mainInfo.dataset.imgsize = main.img_size;
						mainInfo.innerHTML = imgMainHtml;
						domFrag.appendChild(mainInfo);

					});
					mainPageHtml = `
					
					
					`
					mainImgWrap.appendChild(domFrag);

					let product_color = el.product_color;
					let productColorHtml = "";
					product_color.forEach(color => {
						let colorData = color.color_rgb;
						let multi = colorData.split(";");
						console.log(multi)
						console.log(colorData)
						if (multi.length === 2) {
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
							<li class="size" data-sizetype="${size.size_type}" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>
						`;
					});

					infoBoxHtml = `
						<div class="product__title">${el.product_name}</div>
						<div class="product__price">${el.sales_price.toLocaleString('ko-KR')}</div>
						<div class="color__box">
							${productColorHtml}
						</div>
						<div class="product__size">
							<div>Size</div>
							<div class="size__box">
								${productSizeHtml}
							</div>
						</div>
						
						<div class="basket__wrap--btn">
							<div class="basket__box--btn">
								<div class="basket-btn" >
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
								<div class="btn-title">사이즈가이드</div>
								<div class="detail__content__box"></div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/material.svg" alt=""></div>
								<div class="btn-title">소재</div>
								<div class="detail__content__box"></div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/information.svg" alt="">
								</div>
								<div class="btn-title">상세정보</div>
								<div class="detail__content__box"></div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/precaution.svg" alt="">
								</div>
								<div class="btn-title">취급 유의사항</div>
								<div class="detail__content__box"></div>
							</div>
						</div>
						
					`;
				});


				let relevant_idx = data[0].relevant_idx;
				if (relevant_idx != null) {
					getRelevantProductList(relevant_idx, country);
				}
				// getProductRecommendList();


				const prdInfo = document.createElement("div");
				prdInfo.classList.add("info__box");
				prdInfo.innerHTML = infoBoxHtml;
				domFrag.appendChild(prdInfo);
				infoWrap.appendChild(domFrag);

				// sizeNodeCheck();
				colorNodeCheck();
				sizeBtnHandler();
				basketStatusBtn();
				// 컬러 표기
				followScrollBtn();
				viewportImg();
				//디테일 설명
			}

		});

	}
		
	
	//메인 스와이프 관련 함수 
	let mainSwiper = initMainSwiper();

	const responsiveSwiper = () => {
		let breakpoint = window.matchMedia('screen and (min-width:1025px)');
		if (breakpoint.matches === true) {
			detailBtnHandler(breakpoint.matches)

			return mainSwiper.destroy();
		} else if (breakpoint.matches === false) {
			detailBtnHandler(breakpoint.matches)

			if (typeof(mainSwiper) == 'object') mainSwiper.destroy();
			return mainSwiper = initMainSwiper();
		}
	};
	function initMainSwiper() {
		return new Swiper('.main__swiper', {
			observer: true,
			observeParents: true,
			pagination: {
				el: '.swiper-pagination pagination_fraction',
				type: 'fraction',
			},
			slidesPerView: 1
		});
	}
 	//스타일링 스와이프	
	const getRelevantProductList = (relevant_idx, country) => {
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
				let imgDiv = "";
				const domFrag = document.createDocumentFragment();

				const styleWrap = document.querySelector(".style-swiper");
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
	//스크롤 버튼 
	function followScrollBtn() {
		const detailProduct = document.querySelectorAll(".main__swiper .swiper-slide");
		const thumbBtns = document.querySelectorAll(".thumb__box");
		thumbBtns.forEach(el => el.addEventListener("click", function() {
			let thumbIdx = (this.dataset.type) - 1;
			let result = [...detailProduct].find((el, idx) => idx === thumbIdx)
			let scrollTo = result.offsetTop
			toScroll(scrollTo)
			if (mainSwiper.__swiper__ == true) {
				mainSwiper.slideTo(thumbIdx)
			}
		}));

		// let typeO = [...detailProduct].filter(el => el.dataset.imgtype==="O")
		// let typeP = [...detailProduct].filter(el => el.dataset.imgtype==="P")
		// let typeD = [...detailProduct].filter(el => el.dataset.imgtype==="D")
		function toScroll(targetValue) {
			window.scrollTo({
				top: targetValue,
				left: 0,
				behavior: 'smooth'
			});
		};
	}
	//이미지 확대 함수
	function viewportImg() {
		let img = new Image();
		let slide = document.querySelectorAll(".detail__img__wrap .swiper-slide img");
		let closebtn = document.createElement("div");
		closebtn.append("[X]")
		closebtn.className = "viewport__closebtn"
		let imageWrap = document.createElement("div");
		imageWrap.className = "viewport__wrap--img";
		slide.forEach(el => el.addEventListener("click", function(e) {

			let src = e.target.getAttribute("src");
			img.className = "viewport-img";
			img.setAttribute("src", src)
			imageWrap.appendChild(img);
			imageWrap.appendChild(closebtn);
			document.body.appendChild(imageWrap);
		}))
		closebtn.addEventListener("click", function() {
			document.querySelector(".viewport__wrap--img").remove();
		})
	}
	
	//쇼핑백 관련 함수들
	function basketStatusBtn() {
		const sizeResult = sizeStatusCheck();
		const $$productBtn = document.querySelectorAll(".basket-btn");
		const $$size = document.querySelectorAll(".detail__wrapper .size");
		$$productBtn.forEach(el => el.addEventListener("click", (e)=> {
			let {status} = e.currentTarget.dataset;
			if(status == 2){
				let selectResult = [...$$size].filter(size => size.classList.contains("select"));
				console.log("🏂 ~ file: product-detail.php:736 ~ $$productBtn.forEach ~ selectResult", selectResult)
				
			}
		}))
		basketBtnStatusChange($$productBtn, sizeResult);
	}
	function basketBtnStatusChange(el, idx) {
		el.forEach(btn => {
			switch (parseInt(idx)) {
			case 0:
				btn.querySelector("span").innerHTML = "품절";
				btn.dataset.status = 0;
				btn.classList.add()
				break;
			case 1:
				btn.querySelector("span").innerHTML = "재입고 알림 신청하기";
				btn.dataset.status = 1;
				break;
			case 2:
				btn.querySelector("span").innerHTML = "쇼핑백에 담기";
				btn.dataset.status = 2;
				break;
			case 3:
				btn.querySelector("span").innerHTML = "comming soon";
				btn.dataset.status = 3;
				break;
		}
		})
		
	}
	//사이즈 상태 체크 함수
	function sizeBtnHandler() {
		const $$productBtn = document.querySelectorAll(".basket-btn");
		const sizes = document.querySelectorAll(".detail__wrapper .size__box .size");
		
		sizes.forEach(el => {
			el.addEventListener("click", function(e) {
				let {productidx, optionidx, status} = e.currentTarget.dataset;
				if(status == 2){
					e.currentTarget.classList.toggle("select");
					basketBtnStatusChange($$productBtn,status);
				} else if(status == 1){
					sizes.forEach(el => el.classList.remove("select"))
					basketBtnStatusChange($$productBtn,status);
				} else if(status == 0){
					basketBtnStatusChange($$productBtn,status);
				}


			});
		});
	}
	function sizeStatusCheck(){
		let stockStatus = 0;
		const sizes = document.querySelectorAll(".detail__wrapper .size__box .size");
		let result = [...sizes].map(el => {
			let tmp_soldout_str = el.dataset.soldout;
			if (tmp_soldout_str == 'STSO') {
				el.dataset.status = 0;
				return stockStatus = 0;
			} else if (tmp_soldout_str == 'STSC') {
				el.dataset.status = 1;
				return stockStatus = 1;
			} else if (tmp_soldout_str == 'STCL' || tmp_soldout_str == 'STIN') {
				el.dataset.status = 2;
				return stockStatus = 2;
			}
		})	
		return statusArrCheck(result);
	}
	const statusArrCheck = (list) => {
        console.log("🏂 ~ file: product-detail.php:770 ~ statusArrCheck ~ list", list)
        // 0 : 완전품절 || 1: 리오더가능 || 2: 재고 선택가능 || 3: commin-soon
        let result = Math.max(...list);
        console.log("🏂 ~ file: product-detail.php:772 ~ statusArrCheck ~ result", result)
        return result;
    }
	//현재 상품 컬러 체크 && 패아자 이동
	function colorNodeCheck() {
		const colorBox = document.querySelector(".color__box");
		const colors = document.querySelectorAll(".color-line");
		let product_idx = document.querySelector("main").dataset.productidx;
		colors.forEach(el => {
			if (el.dataset.idx === product_idx) {
				el.classList.add("select");
				el.remove();
				let cloneNode = el.cloneNode(true);
				colorBox.prepend(cloneNode);
			}

			el.addEventListener("mouseover", function(e) {
				document.querySelector(".color-line.select").classList.remove("select");
			});
			el.addEventListener("mouseout", function(e) {
				document.querySelector(".color-line").classList.add("select");
			});
			el.addEventListener("click", function(e) {
				let targetIdx = e.currentTarget.dataset.idx;
				window.location.href=`http://116.124.128.246/product/detail?product_idx=${targetIdx}`
			});
		});
	}
	//디테일 내용 함수
	function detailBtnHandler(media) {
		let $$detailBtn = document.querySelectorAll(".detail__btn__row");
		if(media) {
			//web
			$$detailBtn.forEach(el => el.addEventListener("click",detailSidebar));
		} else {
			//mobile
			$$detailBtn.forEach(el => el.addEventListener("click",addSelectbtn));
		}
		function addSelectbtn() {
			let sizeguideHtml = "";
			let detailContentBox = document.createElement("div");
			detailContentBox.className ="detail__content__box"
			detailContentBox.innerHTML = sizeguideHtml
			console.log("🏂 ~ file: product-detail.php:745 ~ addSelectbtn ~ detailContentBox", detailContentBox)
			sizeguideHtml = `
					<div class="content-header"><span>사이즈 가이드</span></div>
					<div class="content-body">
						<div class="sizeguide-box">
							<div class="sizeguide-btn ">A1</div>
							<div class="sizeguide-btn">A2</div>
							<div class="sizeguide-btn select">A3</div>
							<div class="sizeguide-btn">A4</div>
							<div class="sizeguide-btn">A5</div>
						</div>
						<div class="sizeguide-noti">모델신장 179cm,착용사이즈는 A3입니다.</div>
						<div class="sizeguide-img" style="background-image: url('/images/svg/guide-top.svg');"></div>
						<div class="sizeguide-dct">
							<div class="dct-row">
								<span>A.총장</span>
								<span>옆목점에서 끝단까지의 수직길이</span>
								<span class="dct-value">103.5</span>
							</div>
							<div class="dct-row">
								<span>B. 목너비</span>
								<span>옆목점 양끝의 수평길이</span>
								<span class="dct-value">103.5</span>
							</div>
							<div class="dct-row">
								<span>C. 어깨너비</span>
								<span>옆어깨점 양끝의 수평길이</span>
								<span class="dct-value">103.5</span>
							</div>
							<div class="dct-row">
								<span>D. 가슴단면</span>
								<span>암홀점에서 1cm아래 양끝의 수평길이</span>
								<span class="dct-value">103.5</span>
							</div>
							<div class="dct-row">
								<span>E. 소매통</span>
								<span>암홀점에서 반대 소매면까지의 수직길이옆목점에서 끝단까지의 수직길이</span>
								<span class="dct-value">103.5</span>
							</div>
							<div class="dct-row">
								<span>F. 소매장</span>
								<span>어깨점부터 소매끝단까지의 길이</span>
								<span class="dct-value">103.5</span>
							</div>
						</div>
					</div>
				</div>
			`
			if(this.classList.contains("select")){
				this.parentNode.classList.remove("open");
				this.classList.remove("select");
			} else {
				this.parentNode.classList.add("open");
				$$detailBtn.forEach(el => el.classList.remove("select"))
				this.classList.add("select");
				this.appendChild(detailContentBox);
			}
			
		}
		function detailSidebar(){
			const $detailSidebarWrap = document.querySelector(".detail__sidebar__wrap");
			const $sidebarBg = document.querySelector(".detail__sidebar__wrap .sidebar__background");
			const $sidebarWrap = document.querySelector(".detail__sidebar__wrap .sidebar__wrap");
			const $detailInfoWrap = document.querySelector(".detail__btn__wrap");
			const $detailInfobtn = document.querySelectorAll(".detail__wrapper .detail__btn__row");
			const $sidebarCloseBtn = document.querySelector(".sidebar__close__btn");
			let $$contentBtn = document.querySelectorAll(".sidebar__body .content__btn__wrap .tap__btn");
			$detailInfobtn.forEach(el => el.addEventListener("click", sideBarClose))
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
				$detailSidebarWrap.classList.add("open")
				$sidebarBg.classList.add("open");
				$sidebarWrap.classList.add("open");
				$detailInfoWrap.classList.add("select")
			}

			function sideBarOpen() {
				$detailSidebarWrap.classList.remove("open")
				$sidebarBg.classList.remove("open");
				$sidebarWrap.classList.remove("open");
				$detailInfoWrap.classList.remove("select");
			}

			function removeTapSelect() {
				$$contentBtn.forEach((el) => {
					el.querySelector("span").classList.remove("select");
				});
			}
		}
		
	}

	function dumy() {
		
	}

</script>
<script type="module">
	import ForyouRender from '/scripts/module/foryou.js';
	const foryou = new ForyouRender();
</script>