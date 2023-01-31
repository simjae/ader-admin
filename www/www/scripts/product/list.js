let productListSwipe;
window.addEventListener('DOMContentLoaded', function() {
    getProductList();
    getfilterApi();
    orderBtn();

});
window.addEventListener("scroll", function () {
    const scrollHeight = window.scrollY;
    const windowHeight = window.innerHeight;
    const docTotalHeight = document.body.offsetHeight;
    const isBottom = windowHeight + scrollHeight === docTotalHeight;
    
    if (isBottom) { 
        //getMoreProduct();
    }
});
//상품 불러오는 api
const getProductList = (imgType) => {
    let menu_sort = $('#menu_sort').val();
    let menu_idx = $('#menu_idx').val();
    let page_idx = $('#page_idx').val();
    let country = $('#country').val();
    let img_param = $('#img_param').val();
    let last_idx = $('#last_idx').val();

    $.ajax({
        type: "post",
        data: {
            "menu_sort": menu_sort,
            "menu_idx": menu_idx,
            "page_idx": page_idx,
            "country": country,
            "img_param": img_param,
            "last_idx": last_idx,
        },
        dataType: "json",
        url: "http://116.124.128.246:80/_api/product/list/get",
        error: function() {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function(d) {
            
            let pageIdx = "?page_idx=" + page_idx;

            let data = d.data;
            console.log("🏂 ~ file: list.js:46 ~ getProductList ~ data", data)

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
                    </div>
                <div class="swiper-scrollbar"></div>
                <div class="navigation">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                    
            </div>`;
            menuList.innerHTML = menuHtml;

            makeLowerFilterHtml(menu_info.lower_filter)





            let grid_info = data.grid_info;
            grid_info_length = grid_info.length;

            let productwriteData = productWriteHtml(grid_info);
            prdListBox.innerHTML = productwriteData;
            domFrag.appendChild(prdListBox);
            prdListBody.appendChild(domFrag);
            productListSelectGrid(imgType);
            productCategorySwiper();
            productSml();
            swiperStateCheck();
            changeHandler();
            upperFilterSelectEvent();

            // document.getElementById("quick-menu").classList.remove("hidden");

        }
    });
}
//상품 그리는 함수  
function productWriteHtml(grid_info){
    let productListHtml ="";
    grid_info.forEach(el => {
        if (el.grid_type == "PRD") {
            let whish_img = "";
            let whish_function = "";

        let memmber_idx = "<?=$_SESSION['MEMBER_IDX']?>";
        console.log("🏂 ~ file: list.js:123 ~ productWriteHtml ~ memmber_idx", memmber_idx)

            let whish_flg = `${el.whish_flg}`;
            if (whish_flg == 'true') {
                whish_img = '<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="">';
                whish_function = "deleteWhishListBtn(this)";
            } else if (whish_flg == 'false') {
                whish_img = '<img class="whish_img" src="/images/svg/wishlist.svg" alt="">';
                whish_function = "setWhishListBtn(this)";
            }
            let saleprice = parseInt(el.sales_price).toLocaleString('ko-KR');
            let colorCtn = el.product_color.length;
            
            productListHtml +=
            `<div class="product">
                <div class="wish__btn" whish_idx="" product_idx="${el.product_idx}" onClick="${whish_function}">
                    ${whish_img}
                </div>
                <a href="http://116.124.128.246:80/${el.link_url}">
                    <div class="product-img swiper" onClick="location.href='/product/detail?product_idx=${el.product_idx}'">
                        <div class="swiper-wrapper">
                        ${
                            el.product_img.product_p_img.map((img) => {
                                imgDiv = `<div class="swiper-slide" data-imgtype="item">
                                    <img class="prd-img" cnt="${el.product_idx}" src="${img_root}${img.img_location}" alt="">
                                </div>`
                                return imgDiv;
                            }).join("")
                        }
                        ${
                            el.product_img.product_o_img.map((img) => {
                                imgDiv = `<div class="swiper-slide" data-imgtype="outfit" style="display:none;">
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
            `;
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
            dragSize:45
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
        spaceBetween: 10,
        pagination: {
            el: ".prd__meun__category .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: {
            slidesPerView: 5,
            spaceBetween: 10
            },
            1024: {
                slidesPerView: 15,
                spaceBetween: 10
            }
        }
    });
}
function makeLowerFilterHtml(data) {
    let swiperWrapper = document.createElement("div");
    swiperWrapper.className ="swiper-wrapper"
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
    let rp = window.matchMedia( 'screen and (min-width:1025px)' ).matches;
    let {grid, webpre, mobilepre}  = document.querySelector(".product-wrap").dataset;

    if(rp == true && webpre === "2"){
        imgSwiper(true);
        return
    } else if(rp == false && mobilepre === "1") {
        imgSwiper(true);
        return
    } else {
        imgSwiper(false);
    }
}
const imgSwiper = (move) => {
    let productImg = document.querySelectorAll('.product-img');
    if (typeof(productListSwipe) == 'object') [...productListSwipe].map(el=> el.destroy());
    return productListSwipe = new Swiper('.product-img', {
        // autoHeight: true,
        grabCursor: true,
        slidesPerView: 1,
        observer:true,
        observeParents: true,
        allowTouchMove:move
    });
}
//그리드 설정
const productListSelectGrid = (imgType) => {
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
    let imgParam = document.getElementById("img_param").value;
    
    //그리드 초기화 
    if (mql.matches) {
        mobileGridEvent();
    } else {
        webGridEvent();
    }
    
    //웹 sort 버튼 클릭
    $webSortGrid.addEventListener("click", () => {
        webGridEvent();
        swiperStateCheck()
    });
    //모바일 sort 버튼 클릭
    $mobileSortGrid.addEventListener("click", () => {
        mobileGridEvent();
        swiperStateCheck()
    });
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(gridResize);
        swiperStateCheck()
    }, false);


    function webGridEvent() {
        const $productWrapEl = document.querySelector(".product-wrap");
        let currentWebGrid = document.querySelector(".rW.sort__grid").dataset.grid;
        switch (currentWebGrid) {
            case "2":
                $prdListBox.dataset.grid = 2;
                $prdListBox.dataset.webpre = 2;
                
                //그리드 버튼 변경
                //그리드 박스 변경
                if(imgType === "imgType"){
                    $prdListBox.dataset.grid = 2;
                }
                else{
                    $webSortGrid.dataset.grid = 4;
                    $websortSpan.innerText = '4칸보기';
                    $websortImg.src = '/images/svg/grid-cols-4.svg';
                }
            break;

            case "4":

                //그리드 버튼 변경
                $prdListBox.dataset.grid = 4;
                $prdListBox.dataset.webpre = 4;

                //그리드 박스 변경
                if(imgType ==="imgType"){
                    $prdListBox.dataset.grid = 4;
                }else {
                    $webSortGrid.dataset.grid = 2;
                    $websortSpan.innerText = '2칸보기';
                    $websortImg.src = '/images/svg/grid-cols-2.svg';
                }
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


                if(imgType ==="imgType"){
                    $mobileSortGrid.dataset.grid = 1;
                }else {
                    $mobileSortGrid.dataset.grid = 3;
                    $mobileSortSpan.innerText = '3칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-3.svg';
                }

                //let swiper = productSwiperUpdate();
                break;

            case "2":
                $prdListBox.dataset.mobilepre = 2;
                $prdListBox.style.gridTemplateColumns = "repeat(8, 1fr)"
                $prdListBox.dataset.grid = 2;

                if(imgType ==="imgType"){
                    $mobileSortGrid.dataset.grid = 2;
                }else {
                    $mobileSortGrid.dataset.grid = 1;
                    $mobileSortSpan.innerText = '1칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-1.svg';
                }
                break;
            case "3":
                $prdListBox.dataset.mobilepre = 3;
                $prdListBox.style.gridTemplateColumns = "repeat(9, 1fr)"
                $prdListBox.dataset.grid = 3;

                if(imgType ==="imgType"){
                    $mobileSortGrid.dataset.grid = 3;
                }else {
                    $mobileSortGrid.dataset.grid = 2;
                    $mobileSortSpan.innerText = '2칸보기';
                    $mobileSortImg.src = '/images/svg/grid-cols-2.svg';
                }
                break;
        }
        return currentGrid;
    }
    //사이즈 변경시 그리드 대응
    function gridResize() {
        let webBeforeGrid = $prdListBox.dataset.webpre;
        let mobileBeforeGrid = $prdListBox.dataset.mobilepre; 
        let screenWidth = document.querySelector("body").offsetWidth;
        if (1024 <= screenWidth ) {
            $prdListBox.style.gridTemplateColumns = "repeat(16, 1fr)"
            $prdListBox.dataset.grid = webBeforeGrid;
        } else {
            if(mobileBeforeGrid === 1){
                $mobileSortSpan.innerText = '2칸보기';
                $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;    
            }else if(mobileBeforeGrid === 2){
                $mobileSortSpan.innerText = '2칸보기';
                $mobileSortImg.src = `/images/svg/grid-cols-2.svg`;    
            } else{
                $mobileSortSpan.innerText = '2칸보기';
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
            data: {
                "product_idx": product_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/add",
            error: function() {
                alert("위시리스트 등록/해제 처리에 실패했습니다.");
            },
            success: function(d) {
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
            data: {
                "product_idx": product_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/delete",
            error: function() {
                alert("위시리스트 등록/해제 처리에 실패했습니다.");
            },
            success: function(d) {
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
function changeImgTypeBtn() {
    console.log("asd")
    $('#last_idx').val(0);
    let imgType = "imgType"
    let img_param = $('#img_param');
    let img_type_text = "";
    let items = document.querySelectorAll(".product-img .swiper-slide[data-imgtype='item']");
    let outfits = document.querySelectorAll(".product-img .swiper-slide[data-imgtype='outfit']");

    if (img_param.val() == "P") {
        document.querySelector(".product-wrap").dataset.item ="O";
        img_param.val('O');
        img_type_text = "아이템보기";
        items.forEach(el => el.style.display = "block"); 
        outfits.forEach(el => el.style.display = "none");
    } else if (img_param.val() == "O") {
        document.querySelector(".product-wrap").dataset.item ="P";
        img_param.val('P');
        img_type_text = "착용보기";
        items.forEach(el => el.style.display = "none");
        outfits.forEach(el => el.style.display = "block");
    $('#img_type_text').text(img_type_text);
    }
}
//상품 더 불러오기
function getMoreProduct() {
    let last_idx = parseInt($('#last_idx').val());
    last_idx++;

    $('#last_idx').val(last_idx);

    let menu_sort = $('#menu_sort').val();
    let menu_idx = $('#menu_idx').val();
    let page_idx = $('#page_idx').val();
    let country = $('#country').val();
    let img_param = $('#img_param').val();

    $.ajax({
        type: "post",
        data: {
            "menu_sort": menu_sort,
            "menu_idx": menu_idx,
            "page_idx": page_idx,
            "country": country,
            "img_param": img_param,
            "last_idx": last_idx
        },
        dataType: "json",
        url: "http://116.124.128.246:80/_api/product/list/get",
        error: function() {
            alert("상품 진열 페이지 불러오기 처리에 실패했습니다.");
        },
        success: function(d) {
            let pageIdx = "?page_idx=" + page_idx;
            let data = d.data;
            let imgDiv = "";
            let product_info = data.product_info;
            let productwriteData = productWriteHtml(product_info);
            $(".product-wrap").append(productwriteData);
            productListSelectGrid(imgType);
        }
    });
}
function changeHandler() {
    let productWrap =  document.querySelector(".product-wrap");
    let productWrapData =  productWrap.dataset.item;
    let items = document.querySelectorAll(".product-img .swiper-slide[data-imgtype='item']");
    let outfits = document.querySelectorAll(".product-img .swiper-slide[data-imgtype='outfit']");
    if(productWrapData == "P"){
        items.forEach(el => el.style.display = "block"); 
        outfits.forEach(el => el.style.display = "none");
    } else if(productWrapData == "O") {
        items.forEach(el => el.style.display = "none");
        outfits.forEach(el => el.style.display = "block");

    }
}
//필터버튼  //
function getfilterApi() {
    let img_param = $('#img_param').val();
    let {menuSort, menuIdx, pageIdx, country, lastIdx} = document.querySelector(".product__list__wrap").dataset;
    $.ajax({
        url: "http://116.124.128.246:80/_api/product/list/get",
        type: "POST",
        dataType: "json",
        data: {
            "menu_sort": menuSort,
            "menu_idx": menuIdx,
            "page_idx": pageIdx,
            "country": country,
            "last_idx": lastIdx,
            "img_param": img_param,
        },
        success: (res) => {
            let data = res.data.filter_info
            console.log("🏂 ~ file: list.js:588 ~ getfilterApi ~ data", data)
            filterBtn(data);
        },

    });
}
function filterBtn(data) {
    let filter = document.querySelector(".filter-btn");
    let filterContainner = document.querySelector(".filter-containner");
    let filterBody = document.querySelector(".filter-body");
    let {filter_cl, filter_ft, filter_gp, filter_ln, filter_sz} = data
    
    appendColorHtml();
    appendFitHtml();
    appendGraphicHtml();
    appendLineHtml();
    appendSizeHtml();
    mobileFilterEvent();
    function appendColorHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className="filter-box color filter-toggle";
        filter_cl.forEach(el => {
            let {filter_idx, filter_name, rgb_color} = el
            let filterColor = document.createElement("li");
            filterColor.className = "filter-color";
            filterColor.innerHTML = `
            <span class="filter-title">${filter_name}</span>
            <div class="color__box">
                <div class="color-line" style="--background-color:${rgb_color}">
                    <div class="color" data-title="${rgb_color}"></div>
                </div>
            </div>
            `
            filterBox.appendChild(filterColor);
        })
        document.querySelector(".filter-content.color").appendChild(filterBox);
    }
    //2번째
    function appendFitHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className="filter-box fit filter-toggle";
        filter_ft.forEach(el => {
            let {fit} = el
            let filterColor = document.createElement("li");
            filterColor.className = "filter-fit";
            filterColor.innerHTML = `
            <span class="filter-title">${fit}</span>
            `
            filterBox.appendChild(filterColor);
        })
        document.querySelector(".filter-content.fit").appendChild(filterBox);
    }
    //그래픽
    function appendGraphicHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className="filter-box graphic filter-toggle";
        filter_gp.forEach((el, idx) => {
            console.log(idx)
            let {graphic} = el
            let filterColor = document.createElement("li");
            filterColor.className = "filter-graphic";
            filterColor.innerHTML = `
            <span class="filter-title">${graphic}</span>
            `
            filterBox.appendChild(filterColor);
        })
        document.querySelector(".filter-content.graphic").appendChild(filterBox);
    }
    function appendLineHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className="filter-box line filter-toggle";
        filter_ln.forEach(el => {
            let {line_idx,line_name} = el
            let filterLine = document.createElement("li");
            filterLine.className = "filter-line";
            filterLine.innerHTML = `
            <span class="filter-title">${line_name}</span>
            `
            filterBox.appendChild(filterLine);
        })
        document.querySelector(".filter-content.line").appendChild(filterBox);
    }
    function appendSizeHtml() {
        let filterBox = document.createElement("ul");
        filterBox.className= "filter-box size";
        filter_sz.forEach((el) => {
            let {filter_sz_ac,filter_sz_ht,filter_sz_jw,filter_sz_lw,filter_sz_sh,filter_sz_ta,filter_sz_up} = el;
            let filterMdl = document.createElement("div");
            filterMdl.className = "filter-mdl filter-toggle"
            Object.entries(el).forEach(([key, value]) => {
                if(value.length !== 0 ){
                    let size = sizeBox(value);
                    filterMdl.appendChild(size);
                }
            });
            document.querySelector(".filter-content.size").appendChild(filterMdl);
            function sizeBox(data){
                let title;
                switch (data) {
                    case filter_sz_ac:
                        title = "악세서리"
                        break;
                    case filter_sz_ht:
                        title = "모자"
                        break;
                    case filter_sz_jw:
                        title = "주얼리"
                        break;
                    case filter_sz_lw:
                        title = "하의"
                        break;
                    case filter_sz_sh:
                        title = "신발"
                        break;
                    case filter_sz_ta:
                        title = "테크 악세서리"
                        break;
                    case filter_sz_up:
                        title = "상의"
                        break;
                }
                let filterBox = document.createElement("ul");
                filterBox.className = "fiter-box";
                let liBox = document.createElement("div");
                liBox.className = "size-li-wrap";
                filterBox.innerHTML = `<summary class="filter-mdl-title">${title}</summary>`;
                data.forEach(el => {
                    let {filter_idx, filter_name, size_sort} = el;
                    let filterSize = document.createElement("li");
                    filterSize.dataset.sizetype = size_sort;
                    filterSize.dataset.idx = filter_idx;
                    filterSize.innerHTML = `<span class="filter-title">${filter_name}</span>`
                    if(size_sort == "O"){
                        console.log("asd")
                        liBox.insertBefore(filterSize ,liBox.firstChild);    
                    }
                    liBox.appendChild(filterSize);
                })
                filterBox.appendChild(liBox);
                return filterBox;
            } 
        })
    }
    filter.addEventListener("click", function(e){
        filterContainner.classList.toggle("open")
        filterBody.classList.toggle("open")
        document.querySelector(".order-containner").classList.remove("open")
    });
    function mobileFilterEvent(){
        let filterContent = document.querySelectorAll(".filter-content");
        let toggleTarget = document.querySelectorAll(".filter-toggle");
        filterContent.forEach(el => {
            el.addEventListener("click", function() {
                if(this.children[1].classList.contains("open")){
                    this.children[0].children[1].innerHTML = "[ + ]";
                    this.children[1].classList.remove("open") ;
                }else {
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

function orderBtn() {
    let orderBtn = document.querySelector(".order-btn")
    let orderContainner = document.querySelector(".order-containner");
    orderBtn.addEventListener("click", function(e){
        orderContainner.classList.toggle("open");
        document.querySelector(".filter-containner").classList.remove("open");
        document.querySelector(".filter-body").classList.remove("open");
    });
}
function upperFilterSelectEvent() {
    let {pathname,search} = getCurrentUrl();
    let slide  = document.querySelectorAll(".prd__meun__grid .swiper-slide");
    slide.forEach(el => {
        if(el.dataset.url == `${pathname}${search}`){
            el.classList.add("select");
        }
    })
}
function getCurrentUrl() {
    let url = new URL(location.href);
    return url
}
