let productListSwipe;
let windowWidth = $(window).width();
let order_param = null;


function clickShowMore() {
    $('#more_flg').val("false");
    $('.show_more_btn').remove();
}

//상품 불러오는 api
const getProductList = () => {
    let { country, menu_idx, menu_sort, page_idx } = document.querySelector(".product__list__wrap").dataset;

    let last_idx = $('#last_idx').val();

    $.ajax({
        type: "post",
        url: "http://116.124.128.246:80/_api/product/list/get",
        data: {
            "country": country,
            "menu_idx": menu_idx,
            "menu_sort": menu_sort,
            "page_idx": page_idx,
            "last_idx": last_idx,
            "order_param": order_param
        },
        dataType: "json",
        error: function () {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function (d) {
			if (d.code == 200) {
				let pageIdx = "?page_idx=" + page_idx;

				let data = d.data;

				let productListHtml = "";
				let imgDiv = "";
				const domFrag = document.createDocumentFragment();

				const menuList = document.querySelector(".prd__meun__grid");

				const prdListBox = document.createElement("div");
				const prdListBody = document.querySelector(".product__list__body");
				prdListBox.classList.add("product-wrap");
				prdListBox.dataset.grid = "4";
				prdListBox.dataset.webpre = "4";
				prdListBox.dataset.mobilepre = "3";

				let menu_info = data.menu_info;
				let menuHtml = `
					<div class="prd__meun__swiper">
						<div class="swiper-wrapper">`
				menu_info.upper_filter.forEach(el => {
					menuHtml += `
							<div class="swiper-slide" data-url="${el.menu_link}" onClick="location.href='${el.menu_link}'">
								<div class="prd__meun__box">
									<div class="prd__img__wrap">
										<img class="prd__img" src="${img_root}${el.img_location}" alt="">
									</div>
									<p class="prd__title">${el.filter_title}</p>
								</div>
							</div>`;
				});

				menuHtml += `
						<div>
							<div class="swiper-scrollbar"></div>
							<div class="navigation">
								<div class=".product-img .swiper-button-prev"></div>
								<div class=".product-img .swiper-button-next"></div>
							</div>   
						</div>`;
				menuList.innerHTML = menuHtml;

				makeLowerFilterHtml(menu_info.lower_filter)

				let grid_info = data.grid_info;
				let productwriteData = productWriteHtml(grid_info);
				prdListBox.innerHTML = productwriteData;
				domFrag.appendChild(prdListBox);
				prdListBody.appendChild(domFrag);

				productListSelectGrid();
				productCategorySwiper();
				productSml();
				swiperStateCheck();
				upperFilterSelectEvent();

			} else {
				alert(d.msg);
				location.href="/main";
			}
        }
    });
}

//상품 그리는 함수  
function productWriteHtml(grid_info) {
    let productListHtml = "";
    grid_info.forEach(el => {
        if (el.grid_type == "PRD") {
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

            let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
            let colorCnt = el.product_color.length;

            let slide_product = "";
            let slide_outfit = "";

            let img_param = $('#img_param').val();
            if (img_param == "O") {
                slide_product = "display:block";
                slide_outfit = "display:none;";
            } else if (img_param == "P") {
                slide_product = "display:none;";
                slide_outfit = "display:block";
            }
            productListHtml +=
            `<div class="product">
                <div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="${whish_function}">
                    ${whish_img}
                </div>
                <a href="http://116.124.128.246:80/${el.link_url}">
                    <div class="product-img swiper" onClick="location.href='/product/detail?product_idx=${el.product_idx}'">
                        <div class="swiper-wrapper">
                        
                        ${el.product_img.product_p_img.map((img) => {
                imgDiv = `<div class="swiper-slide" data-imgtype="item" style="${slide_product}">
                                    <img class="prd-img" cnt="${el.product_idx}" src="${img_root}${img.img_location}" alt="">
                                </div>`
                return imgDiv;
            }).join("")
            }
                        ${el.product_img.product_o_img.map((img) => {
                imgDiv = `<div class="swiper-slide" data-imgtype="outfit" style="${slide_outfit}">
                                    <img class="prd-img" cnt="${el.product_idx}" src="${img_root}${img.img_location}" alt="">
                                </div>`
                return imgDiv;
            }).join("")
            }
                        </div>
                    </div>
                </a>
                <div class="product-info">
                    <div class="info-row">
                        <div class="name"data-soldout=${el.stock_status == "STCL" ? "STCL" : ""}><span>${el.product_name}</span></div>
                        ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>` : `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${saleprice}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
                    </div>
                    <div class="color-title"><span>${el.color}</span></div>
                    <div class="info-row">
                        <div class="color__box" data-maxcount="${colorCnt < 6 ? "" : "over"}" data-colorcount="${colorCnt < 6 ? colorCnt : colorCnt - 5}">
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
        `;
        } else if(el.grid_type == "IMG"){
            let g2 = el.clip_info[0];
            let g4 = el.clip_info[1];
            productListHtml += `<div class="product product-inside-banner" data-g2x="${g2.location_start}" data-g2y="${g2.location_end}" data-g4x="${g4.location_start}" data-g4y="${g4.location_end}" style="width: 50%; background-image:url('http://116.124.128.246:81${el.banner_location}')"></div>`;
        } else if(el.grid_type == 'VID'){
            productListHtml += 
            `<div class="product product-inside-banner" style="width: 50%;">
                <video autoplay muted loop>
                    <source src="http://116.124.128.246:81${el.banner_location}" type="video/mp4">
                </video>
            </div>`;
        }
        
    });

    return productListHtml;
}

/* 모바일 & 웹 상품 카테고리 스와이프 */
const productCategorySwiper = () => {
    let productListSwiper = new Swiper(".prd__meun__swiper", {
        navigation: {
            nextEl: ".prd__meun__swiper .swiper-button-next",
            prevEl: ".prd__meun__swiper .swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        scrollbar: {
            el: '.prd__meun__swiper .swiper-scrollbar',
            draggable: true,
            dragSize: 45
        },
        grabCursor: true,
        breakpoints: {
            320: {
                slidesPerView: 5.5
            },
            500: {
                slidesPerView: 7.5,
            },
            1024: {
                slidesPerView: 7.5,
                spaceBetween: 10
            },
            1280: {
                slidesPerView: 8.5,
                spaceBetween: 10
            },
            1440: {
                slidesPerView: 9.5,
                spaceBetween: 10
            },
            1920: {
                slidesPerView: 10.5,
                spaceBetween: 10
            }
        }
    });
}

const productSml = () => {
    let productListSwiper = new Swiper(".prd__meun__category", {
        grabCursor: true,
        slidesPerView: "auto",
        pagination: {
            el: ".prd__meun__category .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: {
                spaceBetween: 10,
                slidesPerView: "auto"
            },
            1024: {
                spaceBetween: 20,
                slidesPerView: "auto"
            }
        }
    });
}

function makeLowerFilterHtml(data) {
    let swiperWrapper = document.createElement("div");
    swiperWrapper.className = "swiper-wrapper"
    data.forEach(el => {
        let slide = document.createElement("div");
        slide.className = "swiper-slide";
        slide.innerHTML = `<a href="http://116.124.128.246:80${el.menu_link}"><div class="title"><span>${el.filter_title}</span></div></a>`
        swiperWrapper.appendChild(slide);
    })
    document.querySelector(".prd__meun__category").appendChild(swiperWrapper);

}

//상품 스와이프
function swiperStateCheck() {
    let rp = window.matchMedia('screen and (min-width:1025px)').matches;
    let { grid, webpre, mobilepre } = document.querySelector(".product-wrap").dataset;

    if (rp == true && webpre === "2") {
        imgSwiper(true);
        return
    } else if (rp == false && mobilepre === "1") {
        imgSwiper(true);
        return
    } else {
        imgSwiper(false);
    }
}

const imgSwiper = (move) => {
    let productImg = document.querySelectorAll('.product-img');
    if (typeof (productListSwipe) == 'objec') [...productListSwipe].map(el => el.destroy());

    return productListSwipe = new Swiper('.product-img', {
        // autoHeight: true,
        grabCursor: true,
        slidesPerView: 1,
        observer: true,
        observeParents: true,
        allowTouchMove: move,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}

//그리드 설정
const productListSelectGrid = () => {
    let $body = document.querySelector("body");
    let $prdListBox = document.querySelector(".product-wrap");
    let mql = window.matchMedia("screen and (max-width: 1024px)");

    let $webSortGrid = document.querySelector(".rW.sort__grid");
    let $websortSpan = document.querySelector(".rW.sort__grid").querySelector('span');
    let $websortImg = document.querySelector(".rW.sort__grid").querySelector('img');

    let $mobileSortGrid = document.querySelector(".rM.sort__grid");
    let $mobileSortSpan = document.querySelector(".rM.sort__grid").querySelector('span');
    let $mobileSortImg = document.querySelector(".rM.sort__grid").querySelector('img');
    let resizeTimer = null;

    //그리드 초기화 
    if (mql.matches) {
        mobileGridEvent();
    } else {
        webGridEvent();
    }

    //웹 sort 버튼 클릭
    $webSortGrid.addEventListener("click", () => {
        webGridEvent();
        swiperStateCheck();
        bannerHeightBySiblingElements();
    });

    //모바일 sort 버튼 클릭
    $mobileSortGrid.addEventListener("click", () => {
        mobileGridEvent();
        swiperStateCheck();
        bannerHeightBySiblingElements();
    });

    window.addEventListener('resize', function () {
        if (windowWidth != $(window).width()) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(gridResize);
            swiperStateCheck();

            windowWidth = $(window).width();
        }
    }, false);

    function webGridEvent() {
        const $productWrapEl = document.querySelector(".product-wrap");

        let currentWebGrid = document.querySelector(".rW.sort__grid").dataset.grid;
        switch (currentWebGrid) {
            case "2":
                $prdListBox.dataset.grid = 2;
                $prdListBox.dataset.webpre = 2;

                //그리드 박스 변경
                $webSortGrid.dataset.grid = 4;
                $websortSpan.innerText = '4칸 보기';
                $websortImg.src = '/images/svg/grid-cols-4.svg';
                break;

            case "4":
                //그리드 버튼 변경
                $prdListBox.dataset.grid = 4;
                $prdListBox.dataset.webpre = 4;

                $webSortGrid.dataset.grid = 2;
                $websortSpan.innerText = '2칸 보기';
                $websortImg.src = '/images/svg/grid-cols-2.svg';
                break;
        }
    }

    function mobileGridEvent() {
        currentGrid = document.querySelector(".rM.sort__grid").dataset.grid;
        switch (currentGrid) {
            case "1":
                $prdListBox.dataset.mobilepre = 1;
                $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                $prdListBox.dataset.grid = 1;

                $mobileSortGrid.dataset.grid = 2;
                $mobileSortSpan.innerText = '2칸';
                $mobileSortImg.src = '/images/svg/grid-cols-2.svg';
                break;

            case "2":
                $prdListBox.dataset.mobilepre = 2;
                $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                $prdListBox.dataset.grid = 2;

                $mobileSortGrid.dataset.grid = 3;
                $mobileSortSpan.innerText = '3칸';
                $mobileSortImg.src = '/images/svg/grid-cols-3.svg';
                break;

            case "3":
                $prdListBox.dataset.mobilepre = 3;
                $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                $prdListBox.dataset.grid = 3;

                $mobileSortGrid.dataset.grid = 1;
                $mobileSortSpan.innerText = '1칸';
                $mobileSortImg.src = '/images/svg/grid-cols-1.svg';
                break;
        }

        return currentGrid;
    }

    //사이즈 변경시 그리드 대응
    function gridResize() {
        let webBeforeGrid = $prdListBox.dataset.webpre;
        let mobileBeforeGrid = $prdListBox.dataset.mobilepre;
        let screenWidth = document.querySelector("body").offsetWidth;
        if (1024 <= screenWidth) {
            $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
            $prdListBox.dataset.grid = webBeforeGrid;
        } else {
            if (mobileBeforeGrid === 1) {
                $mobileSortSpan.innerText = '2칸';
                $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;
            } else if (mobileBeforeGrid === 2) {
                $mobileSortSpan.innerText = '2칸';
                $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;
            } else {
                $mobileSortSpan.innerText = '2칸';
                $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;
            }
            $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
            $prdListBox.dataset.grid = mobileBeforeGrid;
        }
    }
}
//버튼 핸들러 
function setWhishListBtn(obj) {
    let product_idx = $(obj).attr('product_idx');

    if (product_idx != null) {
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/order/whish/add",
            data: {
                "product_idx": product_idx
            },
            dataType: "json",
            error: function () {
                alert("위시리스트 등록/해제 처리에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                let msg = d.msg;

                if (code == "200") {
                    let whish_img = $(obj).find('.whish_img');
                    whish_img.attr('src', '/images/svg/wishlist-bk.svg');
                    whish_img.attr('style', 'width:19px');
                    $(obj).attr('onClick', 'deleteWhishListBtn(this)');
                }
            }
        });
    }
}

function deleteWhishListBtn(obj) {
    let product_idx = $(obj).attr('product_idx');

    if (product_idx != null) {
        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/order/whish/delete",
            data: {
                "product_idx": product_idx
            },
            dataType: "json",
            error: function () {
                alert("위시리스트 등록/해제 처리에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                let msg = d.msg;

                if (code == "200") {
                    let whish_img = $(obj).find('.whish_img');
                    whish_img.attr('src', '/images/svg/wishlist.svg');
                    $(obj).attr('onClick', 'setWhishListBtn(this)');
                }
            }
        });
    }
}

function clickImgTypeBtn() {
    let img_param = $('#img_param');

    let img_type_text = "";
    let items = document.querySelectorAll(".product-img .swiper-slide[data-imgtype='item']");
    let outfits = document.querySelectorAll(".product-img .swiper-slide[data-imgtype='outfit']");

    if (img_param.val() == "O") {
        img_param.val('P');
        img_type_text = "아이템";
        $(".type-btn img").attr("src", "/images/svg/item.svg").css({ "width": "16px", "height": "12px" });
        items.forEach(el => el.style.display = "none");
        outfits.forEach(el => el.style.display = "block");
    } else if (img_param.val() == "P") {
        img_param.val('O');
        img_type_text = "착용컷";
        $(".type-btn img").attr("src", "/images/svg/cloth.svg").css({ "width": "8px", "height": "17px" });
        items.forEach(el => el.style.display = "block");
        outfits.forEach(el => el.style.display = "none");
    }

    $('#img_type_text').text(img_type_text);
}

$("#filter-btn-toggle").click(function(){
    $(this).toggleClass("on off");
});

function clickFilterMotion() {
    if ($(this).attr("src", "/images/svg/filter2.svg") == false) {
        $(this).attr("src", "/images/svg/filter2.svg")
    } else {$(this).attr("src", "/images/svg/filter.svg") }
}
//상품 더 불러오기
function getProductListByScroll(last_idx, more_flg) {
    let { country, menu_idx, menu_sort, page_idx } = document.querySelector(".product__list__wrap").dataset;

    $.ajax({
        type: "post",
        url: "http://116.124.128.246:80/_api/product/list/get",
        data: {
            "country": country,
            "menu_sort": menu_sort,
            "menu_idx": menu_idx,
            "page_idx": page_idx,
            "last_idx": last_idx,
            "order_param": order_param
        },
        dataType: "json",
        error: function () {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function (d) {
            let data = d.data;

            let grid_info = data.grid_info;
            if (grid_info != null) {
                if (grid_info.length > 0) {
                    let productwriteData = productWriteHtml(grid_info);
                    $(".product-wrap").append(productwriteData);

                    if (more_flg == "true") {
                        let strDiv = "";
                        strDiv += '<div class="show_more_btn" onClick="clickShowMore();">';
                        strDiv += '    <span class="add-btn">더보기 +</span>';
                        strDiv += '    <img src="" alt="">';
                        strDiv += '</div>';

                        $('.product__list__wrap').append(strDiv);

                        $('#more_flg').val(more_flg);
                    }
                } else {
                    $('.show_more_btn').remove();
                    let product_body = document.querySelector(".product__list__body");
                    product_body.classList.add("no_more");
                }
                bannerHeightBySiblingElements();
            } else {
                alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
            }
        }
    });
}

//페이지 상품 별 필터 정보 취득
function getFilterInfo() {
    let { country, menu_idx, menu_sort, page_idx } = document.querySelector(".product__list__wrap").dataset;

    $.ajax({
        type: "POST",
        url: "http://116.124.128.246:80/_api/product/list/get",
        data: {
            "country": country,
            "menu_idx": menu_idx,
            "menu_sort": menu_sort,
            "page_idx": page_idx
        },
        dataType: "json",
        error: function () {
            alert('페이지별 필터정보 취득중 오류가 발생했습니다.');
        },
        success: function (d) {
            let filter_info = d.data.filter_info;
            filterBtn(filter_info);
        }
    });
}

function filterBtn(data) {
    let filter = document.querySelector(".filter-btn");
    let filterContainner = document.querySelector(".filter-containner");
    let filterBody = document.querySelector(".filter-body");

    let {
        filter_cl,
        filter_ft,
        filter_gp,
        filter_ln,
        filter_sz
    } = data;

    appendColorHtml();
    appendFitHtml();
    appendGraphicHtml();
    appendLineHtml();
    appendSizeHtml();
    mobileFilterEvent();

    function appendColorHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className = "filter-box color filter-toggle";

        filter_cl.forEach(el => {
            let { filter_idx, filter_name, rgb_color } = el;

            let filterColor = document.createElement("li");
            filterColor.className = "filter-color";

            filterColor.innerHTML = `
				<span class="filter-title">${filter_name}</span>
				<div class="color__box">
					<div class="color-line" style="--background-color:${rgb_color}">
						<div class="color" data-title="${rgb_color}"></div>
					</div>
				</div>
            `;

            filterBox.appendChild(filterColor);
        });

        document.querySelector(".filter-content.color").appendChild(filterBox);
    }

    //2번째
    function appendFitHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className = "filter-box fit filter-toggle";

        filter_ft.forEach(el => {
            let { fit } = el

            let filterColor = document.createElement("li");
            filterColor.className = "filter-fit";

            filterColor.innerHTML = `
				<span class="filter-title">${fit}</span>
            `;

            filterBox.appendChild(filterColor);
        });

        document.querySelector(".filter-content.fit").appendChild(filterBox);
    }

    //그래픽
    function appendGraphicHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className = "filter-box graphic filter-toggle";

        filter_gp.forEach((el, idx) => {
            let { graphic } = el;

            let filterColor = document.createElement("li");
            filterColor.className = "filter-graphic";

            filterColor.innerHTML = `
				<span class="filter-title">${graphic}</span>
            `;

            filterBox.appendChild(filterColor);
        });

        document.querySelector(".filter-content.graphic").appendChild(filterBox);
    }

    function appendLineHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className = "filter-box line filter-toggle";

        filter_ln.forEach(el => {
            let { line_idx, line_name } = el;
            let filterLine = document.createElement("li");

            filterLine.className = "filter-line";

            filterLine.innerHTML = `
				<span class="filter-title">${line_name}</span>
            `

            filterBox.appendChild(filterLine);
        });

        document.querySelector(".filter-content.line").appendChild(filterBox);
    }

    function appendSizeHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className = "filter-box size";

        filter_sz.forEach((el) => {
            let { filter_sz_ac, filter_sz_ht, filter_sz_jw, filter_sz_lw, filter_sz_sh, filter_sz_ta, filter_sz_up } = el;

            let filterMdl = document.createElement("div");
            filterMdl.className = "filter-mdl filter-toggle";

            Object.entries(el).forEach(([key, value]) => {
                if (value.length !== 0) {
                    let size = sizeBox(value);
                    filterMdl.appendChild(size);
                }
            });

            document.querySelector(".filter-content.size").appendChild(filterMdl);

            function sizeBox(data) {
                let filter_title = "";
                switch (data) {
                    case filter_sz_ac:
                        filter_title = "악세서리";
                        break;

                    case filter_sz_ht:
                        filter_title = "모자";
                        break;

                    case filter_sz_jw:
                        filter_title = "주얼리";
                        break;

                    case filter_sz_lw:
                        filter_title = "하의";
                        break;

                    case filter_sz_sh:
                        filter_title = "신발";
                        break;

                    case filter_sz_ta:
                        filter_title = "테크 악세서리";
                        break;

                    case filter_sz_up:
                        filter_title = "상의";
                        break;
                }

                let filterBox = document.createElement("ul");
                filterBox.className = "fiter-box";

                let li_box = document.createElement("div");
                li_box.className = "size-li-wrap";

                filterBox.innerHTML = `<summary class="filter-mdl-title">${filter_title}</summary>`;
                data.forEach(el => {
                    let { filter_idx, filter_name, size_sort } = el;

                    let filterSize = document.createElement("li");
                    filterSize.dataset.sizetype = size_sort;
                    filterSize.dataset.idx = filter_idx;
                    filterSize.innerHTML = `<span class="filter-title">${filter_name}</span>`

                    if (size_sort == "O") {
                        li_box.insertBefore(filterSize, li_box.firstChild);
                    }

                    li_box.appendChild(filterSize);
                });

                filterBox.appendChild(li_box);

                return filterBox;
            }
        })
    }

    filter.addEventListener("click", function (e) {
        filterContainner.classList.toggle("open");
        filterBody.classList.toggle("open");

        document.querySelector(".sort-containner").classList.remove("open");
    });

    function mobileFilterEvent() {
        let filterContent = document.querySelectorAll(".filter-content");
        let toggleTarget = document.querySelectorAll(".filter-toggle");

        filterContent.forEach(el => {
            el.addEventListener("click", function () {
                if (this.children[1].classList.contains("open")) {
                    this.children[0].children[1].innerHTML = "[ + ]";
                    this.children[1].classList.remove("open");
                } else {
                    toggleTarget.forEach(el => {
                        el.classList.remove("open");
                        el.parentNode.querySelector(".mobile-filter-btn").innerHTML = "[ + ]";
                    });

                    this.children[0].children[1].innerHTML = "[ - ]"
                    this.children[1].classList.add("open")
                }
            })
        })
    }
}

function toggleSortBtn() {
    let sort_btn = document.querySelector(".sort-btn");

    sort_btn.addEventListener("click", function (e) {
        let sort_container = document.querySelector(".sort-containner");
        sort_container.classList.toggle("open");
        if ($('.oder-btn-motion').hasClass('rotate') == false) {
            $('.oder-btn-motion').addClass('rotate');
        } else { $('.oder-btn-motion').removeClass('rotate'); }

        document.querySelector(".filter-containner").classList.remove("open");
        document.querySelector(".filter-body").classList.remove("open");

    });
}


$('.prd__meun__grid .prd__meun__box').click(function (e) {
    $('.prd__meun__grid .swiper-slide .prd__meun__box .prd__img__wrap').css('border', '1px solid #808080');
    $('.prd__meun__grid .prd__meun__box .prd__title').css('opacity', '1');
})

function sortProductList(obj) {
    $('#last_idx').val(0);
    $('#more_flg').val("false");
    $('#show_more_btn').remove();

    if ($(obj).prop('checked') == true) {
        order_param = $(obj).val();
        $('.sort__cb').not($(obj)).prop('checked', false);
    } else {
        order_param = null;
    }

    let { country, menu_idx, menu_sort, page_idx } = document.querySelector(".product__list__wrap").dataset;

    let last_idx = $('#last_idx').val();

    $.ajax({
        type: "POST",
        url: "http://116.124.128.246:80/_api/product/list/get",
        data: {
            "country": country,
            "menu_idx": menu_idx,
            "menu_sort": menu_sort,
            "page_idx": page_idx,
            "order_param": order_param,
            "last_idx": last_idx,
            "order_param": order_param
        },
        dataType: "json",
        error: function () {
            alert('페이지별 필터정보 취득중 오류가 발생했습니다.');
        },
        success: function (d) {
            if (d.code == 200) {
                //let sort_container = document.querySelector(".sort-containner");
                //sort_container.classList.toggle("open");

                let data = d.data;
                let grid_info = data.grid_info;

                $(".product-wrap").html('');

                if (grid_info != null) {
                    let productwriteData = productWriteHtml(grid_info);
                    $(".product-wrap").append(productwriteData);
                }
            } else {
                exceptionHandler("디자인 필요", d.msg);
            }
        }
    });
}

function upperFilterSelectEvent() {
    let { pathname, search } = getCurrentUrl();

    let slide = document.querySelectorAll(".prd__meun__grid .swiper-slide");
    slide.forEach((el, idx) => {
        if (el.dataset.url == `${pathname}${search}`) {
            if (idx == 0) {
                el.classList.add("select");
            }
        }
    })
}
    
function getCurrentUrl() {
    let url = new URL(location.href);
    return url;
}
function bannerHeightBySiblingElements() {
    const elements = document.querySelectorAll(".product");
    const targets = document.querySelectorAll(".product-inside-banner");
    console.log("🏂 ~ file: list.js:928 ~ bannerHeightBySiblingElements ~ targets:", targets)
    const heights = [];

    elements.forEach((element) => {
        heights.push(element.offsetHeight);
    });

    const maxHeight = Math.max(...heights);

    targets.forEach((t) => {
        t.style.height = `${maxHeight}px`;
    });
    console.log('targets',targets)
}


window.addEventListener('DOMContentLoaded', function () {
    getProductList();
    getFilterInfo();
    toggleSortBtn();
    $("#quickview").removeClass("hidden");
});

window.addEventListener("scroll", function () {
    const scrollHeight = window.scrollY;
    const windowHeight = window.innerHeight;
    const docTotalHeight = document.body.offsetHeight;
    const isBottom = windowHeight + scrollHeight >= (docTotalHeight - 1);

    let more_flg = $('#more_flg').val();

    if (more_flg == "false") {
        if (scrollHeight > (windowHeight - 350) && isBottom == true) {
            let last_idx = parseInt($('#last_idx').val());
            if (last_idx > 0) {
                last_idx += 12;
            } else {
                last_idx = 12;
            }


            if (last_idx / 60 > 0 && last_idx % 60 == 0) {
                more_flg = "true";
            } else {
                more_flg = "false";
            }

            $('#more_flg').val(more_flg);
            $('#last_idx').val(last_idx);

            getProductListByScroll(last_idx, more_flg);
        }
    }
});
window.addEventListener('resize', function () {
    bannerHeightBySiblingElements();
});