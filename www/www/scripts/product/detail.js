var delay = 300;
var timer = null;
const urlParams = new URL(location.href).searchParams;
const productIdx = urlParams.get('product_idx');


window.addEventListener('DOMContentLoaded', function () {
    let product_idx = document.querySelector("main").dataset.productidx;
    getProduct(product_idx);
    responsiveSwiper();
});

window.addEventListener('resize', function () {
    clearTimeout(timer);
    timer = setTimeout(function () {
        detailBtnHandler();
        responsiveSwiper();
    }, delay);
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
        error: function () {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function (d) {
            let data = d.data;
            const domFrag = document.createDocumentFragment();
            const infoWrap = document.querySelector(".info__wrap");
            const thumbnailImgWrap = document.querySelector(".thumbnail_img_wrapper");
            const navigationWrap = document.querySelector(".navigation__wrap");
            const mainImgWrap = document.querySelector(".main_img_wrapper");
            let infoBoxHtml = "";
            data.forEach((el) => {
                let img_thumbnail = el.img_thumbnail;
                let imgThumbnailHtml = "";

                img_thumbnail.forEach((thumbnail) => {
                    
                    imgThumbnailHtml = `<img src="${img_root}${thumbnail.img_location}"/><span>${thumbnail.display_num ==1 ? "착용이미지":"디테일"}</span>`;
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
                        <img class="detail__img" data-imgtype="${main.img_type}" data-size="${main.img_size}" src="${img_root}${main.img_url}"/>
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
                    // console.log(multi)
                    // console.log(colorData)
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

                let whish_img = "";
                let whish_function = "";

                let whish_flg = `${el.whish_flg}`;
				let login_status = getLoginStatus();
				
				if (login_status == "true") {
					if (whish_flg == 'true') {
						whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="">';
						whish_function = "deleteWhishListBtn(this);";
					} else if (whish_flg == 'false') {
						whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
						whish_function = "setWhishListBtn(this);";
					}
				} else {
					whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
					whish_function = "return false;";
				}
                


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
                                <div class="whish-btn" product_idx="${el.product_idx}" onClick="${whish_function}">
                                    ${whish_img}
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
            detailBtnHandler();
            //디테일 설명
        }

    });

}
//메인 스와이프 관련 함수 
let mainSwiper = initMainSwiper();
let pagingSwiper = initPagingSwiper();
function responsiveSwiper() {
    let breakpoint = window.matchMedia('screen and (min-width:1025px)');
    if (breakpoint.matches === true) {
        mainSwiper.destroy();
        pagingSwiper.destroy();
    } else if (breakpoint.matches === false) {
        if (typeof (mainSwiper) == 'object') {
            mainSwiper.destroy();
        }
        if (typeof (pagingSwiper) == 'object') {
            pagingSwiper.destroy();
        }
        mainSwiper = initMainSwiper();
        pagingSwiper = initPagingSwiper();
        mainSwiper.controller.control = pagingSwiper;
    } 

};
function initMainSwiper() {
    return new Swiper('.main__swiper', {
        pagination: {
            el: ".detail__wrapper .swiper-pagination",
            type: "bullets",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}
function initPagingSwiper() {
    return new Swiper(".main__swiper", {
        pagination: {
            el: ".main__swiper .swiper-pagination2",
            type: "fraction",
        },
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
        error: function () {
            alert("관련상품정보 불러오기 처리에 실패했습니다.");
        },
        success: function (d) {
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
                    whish_function = "deleteWhishListBtn(this);";
                } else if (whish_flg == 'false') {
                    whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
                    whish_function = "setWhishListBtn(this);";
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
							<div class="wish__btn" product_idx="${el.product_idx}" onClick="${whish_function}">
								${whish_img}
							</div>
							<a href="http://116.124.128.246:80/product/detail?product_idx=${el.product_idx}">
								<div class="product-img swiper">
									<img class="prd-img" cnt="${el.product_idx}" src="${img_root}${el.product_img}" alt="">
								</div>
							</a>
							<div class="product-info">
								<div class="info-row">
									<div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}><span>${el.product_name}</span></div>
									${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>` : `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
								</div>
								<div class="color-title"><span>${el.color}</span></div>
								<div class="info-row">
									<div class="color__box" data-maxcount="${colorCtn < 6 ? "" : "over"}" data-colorcount="${colorCtn < 6 ? colorCtn : colorCtn - 5}">
										${el.product_color.map((color, idx) => {
                        let maxCnt = 5;
                        if (idx < maxCnt) {
                            return `<div class="color" data-color="${color.color_rgb}" data-productidx="${color.product_idx}" data-soldout="${color.stock_status}" style="background-color:${color.color_rgb}"></div>`;
                        }
                    }).join("")
                    }
									</div>
									<div class="size__box">
										${el.product_size.map((size) => {
                        return `<li class="size" data-sizetype="" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>`;
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
    thumbBtns.forEach(el => el.addEventListener("click", function () {
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
    slide.forEach(el => el.addEventListener("click", function (e) {

        let src = e.target.getAttribute("src");
        img.className = "viewport-img";
        img.setAttribute("src", src)
        imageWrap.appendChild(img);
        imageWrap.appendChild(closebtn);
        document.body.appendChild(imageWrap);
    }))
    closebtn.addEventListener("click", function () {
        document.querySelector(".viewport__wrap--img").remove();
    })
}

//쇼핑백 관련 함수들
function basketStatusBtn() {
    const sizeResult = sizeStatusCheck();
    const $$productBtn = document.querySelectorAll(".basket-btn");
    const $$size = document.querySelectorAll(".detail__wrapper .size");
    
    $$productBtn.forEach(el => el.addEventListener("click", (e) => {
        let { status } = e.currentTarget.dataset;
        if (status == 2) {
			let option_idx = [];
            let selectResult = [...$$size].map(size => {
                if(size.classList.contains("select") == true){
                    option_idx.push(size.dataset.optionidx);
                }
            });
            
			if (option_idx.length > 0) {
				$.ajax({
					type: "post",
					url: "http://116.124.128.246:80/_api/order/basket/add",
					data: {
						'add_type' : 'product',
						'product_idx' : productIdx,
						'option_idx' : option_idx
					},
					dataType: "json",
					error: function () {
						alert("쇼핑백 추가처리에 실패했습니다.");
					},
					success: function (d) {
						if (d.code == 200){
							location.href='/order/basket/list';
						} else {
							exceptionHandling("[ 디자인 필요 ]",d.msg);
						}
					}
				});
			}
        }
    }));
	
    basketBtnStatusChange($$productBtn, sizeResult);
}
function basketBtnStatusChange(el, idx) {
    el.forEach(btn => {
        switch (parseInt(idx)) {
            case 0:
                btn.querySelector("span").innerHTML = "품절";
                btn.dataset.status = 0;
                btn.parentNode.dataset.status = 0;
                btn.classList.add()
                break;
            case 1:
                btn.querySelector("span").innerHTML = "재입고 알림 신청하기";
                btn.parentNode.dataset.status = 1;
                btn.dataset.status = 1;
                break;
            case 2:
                btn.querySelector("span").innerHTML = "쇼핑백에 담기";
                btn.parentNode.dataset.status = 2;
                btn.dataset.status = 2;
                break;
            case 3:
                btn.querySelector("span").innerHTML = "comming soon";
                btn.parentNode.dataset.status = 3;
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
        el.addEventListener("click", function (e) {
            let { productidx, optionidx, status } = e.currentTarget.dataset;
            if (status == 2) {
                e.currentTarget.classList.toggle("select");
                basketBtnStatusChange($$productBtn, status);
            } else if (status == 1) {
                sizes.forEach(el => el.classList.remove("select"))
                basketBtnStatusChange($$productBtn, status);
            } else if (status == 0) {
                basketBtnStatusChange($$productBtn, status);
            }


        });
    });
}
function sizeStatusCheck() {
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

        el.addEventListener("mouseover", function (e) {
            document.querySelector(".color-line.select").classList.remove("select");
        });
        el.addEventListener("mouseout", function (e) {
            document.querySelector(".color-line").classList.add("select");
        });
        el.addEventListener("click", function (e) {
            let targetIdx = e.currentTarget.dataset.idx;
            window.location.href = `http://116.124.128.246/product/detail?product_idx=${targetIdx}`
        });
    });
}
//디테일 내용 함수
function detailBtnHandler() {
    let breakpoint = window.matchMedia('screen and (min-width:1025px)');
    let $$detailBtn = document.querySelectorAll(".detail__wrapper .detail__btn__row");
    const $sidebarBody = document.querySelector(".detail__sidebar__wrap .sidebar__body")
    
    if (breakpoint.matches === true) {
        //사이드바 탭버튼 기존 위치와 맞춤 &리사이징시에도
        let btnHeight = document.querySelector(".detail__wrapper .detail__btn__wrap").offsetTop;
        document.getElementById('detail-top').style.height = `${btnHeight}px`;

        $$detailBtn.forEach((el,idx) => {
            el.classList.add("web");
            el.classList.remove("mobile");
            el.querySelector(".detail__content__box").innerHTML = "";
            el.addEventListener("click", function(ev) {
                if(el.classList.contains("web")){
                    detailSidebar(ev,idx);
                }
            })
        })

    } else if (breakpoint.matches === false) {
         //-------------------------동적으로 추가될 정보들 -------------------------//
        let sizeguideContent = () => {
            let $mobileContentBox = document.querySelectorAll(".detail__btn__row.mobile .detail__content__box");
            let header = document.createElement("div");
            let body = document.createElement("div");
            header.className = "sidebar__header";
            header.innerHTML = `<img class="sidebar__close__btn" src="/images/svg/close.svg" alt="">`;

            body.className = "sidebar__body";


            let content = document.createElement("div");
            content.className = "detail-content sizeguide";
            content.innerHTML =`
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
                </div>`
            $mobileContentBox[0].appendChild(content)
        }
        let materialContent = () => {
            let $mobileContentBox = document.querySelectorAll(".detail__btn__row.mobile .detail__content__box");
            let content = document.createElement("div");
            content.className = "detail-content material";
            content.innerHTML = `
                <div class="content-header"><span>소재</span></div>
                <div class="content-body">
                    <div class="content-list">
                        <div class="content-list-title">Main</div>
                        <ul>
                            <li>아크릴 70</li>
                            <li>폴리에스터 30</li>
                        </ul>
                    </div>
                    <div class="content-list">
                        <div class="content-list-title">Lining</div>
                        <ul>
                            <li>폴리에스터 55</li>
                            <li>비스코스 45</li>
                        </ul>
                    </div>
                    <div class="content-list">
                        <div class="content-list-title">Filling</div>
                        <ul>
                            <li>폴리에스터 100</li>
                            <li>(심지, 보강재, 상표, 자수, 장식, 단추, 밴드 제외)</li>
                        </ul>
                    </div>
                </div>`
                $mobileContentBox[1].appendChild(content)
        }
        let productinfoContent = () => {
            let $mobileContentBox = document.querySelectorAll(".detail__btn__row.mobile .detail__content__box");
            let content = document.createElement("div");
            content.className = "detail-content productinfo";
            content.innerHTML = `
                <div class="content-header"><span>제품 상세 정보</span></div>
                <div class="content-body">
                    <div class="content-list">
                        <ul>
                            <li>오버사이즈 핏</li>
                            <li>앞 중심이 미세하게 돌아간 후드</li>
                            <li>후드 안감 배색</li>
                            <li>매듭 스트링 디테일</li>
                            <li>전면 하트 자수패치</li>
                            <li>후면 밑단 3단 레이어드 라벨</li>
                            <li>오버사이즈 핏 앞 중심이 미세하게 돌아간후드 안감 배색<br>매듭 스트링 디테일 전면 하트 자수패치 후면 밑단 3단 레이어드 라벨</li>
                        </ul>
                    </div>
                </div>`
                $mobileContentBox[2].appendChild(content)
        }
        let precautionContent = () => {
            let $mobileContentBox = document.querySelectorAll(".detail__btn__row.mobile .detail__content__box");
            let content = document.createElement("div");
            content.className = "detail-content precaution";
            content.innerHTML =`
                <div class="content-header"><span>제품 취급 유의사항</span></div>
                <div class="content-body">
                    <div class="content-list">
                        <ul>
                            <li>이 제품은 반드시 손세탁 하십시오.</li>
                            <li>드라이클리닝을 하지 마십시오.</li>
                            <li>이 제품은 회전식 건조기를 사용하지 마십시오.</li>
                            <li>중온의 아이론을 권장합니다.</li>
                        </ul>
                    </div>
                </div>`
                $mobileContentBox[3].appendChild(content)
        }
       
        $$detailBtn.forEach((el,idx) => {
            el.classList.add("mobile");
            el.classList.remove("web");
            el.querySelector(".detail__content__box").innerHTML = "";
            el.addEventListener("click", function(ev) {
                if(el.classList.contains("mobile")){
                    addSelectbtn(ev,idx);
                }
            })
        })
        sizeguideContent();
        materialContent();
        productinfoContent();
        precautionContent();
    }
    //-------------------------동적으로 추가될 정보들 -------------------------//
    let sizeguideContent = () => {
        let header = document.createElement("div");
        let body = document.createElement("div");
        header.className = "sidebar__header";
        header.innerHTML = `<img class="sidebar__close__btn" src="/images/svg/close.svg" alt="">`;

        body.className = "sidebar__body";


        let content = document.createElement("div");
        content.className = "detail-content sizeguide";
        content.innerHTML =`
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
            </div>`
        $sidebarBody.appendChild(content);
    }
    let materialContent = () => {
        let content = document.createElement("div");
        content.className = "detail-content material";
        content.innerHTML = `
            <div class="content-header"><span>소재</span></div>
            <div class="content-body">
                <div class="content-list">
                    <div class="content-list-title">Main</div>
                    <ul>
                        <li>아크릴 70</li>
                        <li>폴리에스터 30</li>
                    </ul>
                </div>
                <div class="content-list">
                    <div class="content-list-title">Lining</div>
                    <ul>
                        <li>폴리에스터 55</li>
                        <li>비스코스 45</li>
                    </ul>
                </div>
                <div class="content-list">
                    <div class="content-list-title">Filling</div>
                    <ul>
                        <li>폴리에스터 100</li>
                        <li>(심지, 보강재, 상표, 자수, 장식, 단추, 밴드 제외)</li>
                    </ul>
                </div>
            </div>`
        $sidebarBody.appendChild(content);  
    }
    let productinfoContent = () => {
        let content = document.createElement("div");
        content.className = "detail-content productinfo";
        content.innerHTML = `
            <div class="content-header"><span>제품 상세 정보</span></div>
            <div class="content-body">
                <div class="content-list">
                    <ul>
                        <li>오버사이즈 핏</li>
                        <li>앞 중심이 미세하게 돌아간 후드</li>
                        <li>후드 안감 배색</li>
                        <li>매듭 스트링 디테일</li>
                        <li>전면 하트 자수패치</li>
                        <li>후면 밑단 3단 레이어드 라벨</li>
                        <li>오버사이즈 핏 앞 중심이 미세하게 돌아간후드 안감 배색<br>매듭 스트링 디테일 전면 하트 자수패치 후면 밑단 3단 레이어드 라벨</li>
                    </ul>
                </div>
            </div>`
        $sidebarBody.appendChild(content);  
    }
    let precautionContent = () => {
        let content = document.createElement("div");
        content.className = "detail-content precaution";
        content.innerHTML =`
            <div class="content-header"><span>제품 취급 유의사항</span></div>
            <div class="content-body">
                <div class="content-list">
                    <ul>
                        <li>이 제품은 반드시 손세탁 하십시오.</li>
                        <li>드라이클리닝을 하지 마십시오.</li>
                        <li>이 제품은 회전식 건조기를 사용하지 마십시오.</li>
                        <li>중온의 아이론을 권장합니다.</li>
                    </ul>
                </div>
            </div>`
        $sidebarBody.appendChild(content);  
    }
    //-------------------------동적으로 추가될 정보들 -------------------------//
    
    function openContent(idx) {
        $sidebarBody.innerHTML = "";
        switch (idx) {
            case 0:
                sizeguideContent()
            break;
            case 1:
                materialContent()
            break;
            case 2:
                productinfoContent()
            break;
            case 3:
                precautionContent()
            break;
        }
    }
    function detailSidebar(ev,index) {
        let currentEv = ev;
        let currentIdx = index;
        const $detailSidebarWrap = document.querySelector(".detail__sidebar__wrap");
        const $sidebarBg = document.querySelector(".detail__sidebar__wrap .sidebar__background");
        const $sidebarWrap = document.querySelector(".detail__sidebar__wrap .sidebar__wrap");
        const $detailInfoWrap = document.querySelector(".detail__btn__wrap");
        const $detailInfobtn = document.querySelectorAll(".sidebar__wrap .detail__btn__row");
        const $sidebarCloseBtn = document.querySelector(".sidebar__close__btn");
        $sidebarCloseBtn.addEventListener("click",sideBarClose);
        sideBarOpen();
        // 스와이프 탭버튼 기능
        $detailInfobtn.forEach((el, idx) => {
        //초기 클릭한 값 select 표기
            if(idx === currentIdx ){
                el.classList.add("select");
            }
            el.addEventListener("click", function() {
                $detailInfobtn.forEach((el,idx) => el.classList.remove("select"));
                this.classList.add("select");
                openContent(idx)
            });
        });
        openContent(currentIdx);
        
        
        function sideBarOpen() {
            $detailSidebarWrap.classList.add("open")
            $sidebarBg.classList.add("open");
            $sidebarWrap.classList.add("open");
            $detailInfoWrap.classList.add("select")
        }
        function sideBarClose() {
            $detailSidebarWrap.classList.remove("open")
            $sidebarBg.classList.remove("open");
            $sidebarWrap.classList.remove("open");
            // $detailInfoWrap.classList.remove("select");
            $detailInfobtn.forEach((el,idx) => el.classList.remove("select"));
        }
         //sidebar__wrap 외부 클릭 종료
        $sidebarBg.addEventListener("mouseup", function (e) {
            if (!$sidebarWrap.contains(e.target)) {
                sideBarClose();
            }
        });
    }
    function addSelectbtn(ev,index) {
        let currentEv = ev.currentTarget;
        console.log("🏂 ~ file: detail.js:745 ~ addSelectbtn ~ currentEv", currentEv.currentTarget)
        let currentIdx = index;
        if (currentEv.classList.contains("select")) {
            currentEv.parentNode.classList.remove("open");
            currentEv.classList.remove("select");
        } else {
            currentEv.parentNode.classList.add("open");
            $$detailBtn.forEach(el => el.classList.remove("select"))
            currentEv.classList.add("select");
        }
        
    }
}
