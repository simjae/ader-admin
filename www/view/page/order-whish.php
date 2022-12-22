<style>
    :root {
        --order-header--height: 150px;
        --header--content--gap: 50px;

        --solid-bk: #808080;
	}
    html {
    scroll-behavior: smooth;
    }
	input {
		padding: 0;
		box-sizing: border-box;
	}

	ul,
	li {
		padding: 0;
		margin: 0;
	}

	input:focus {
		border: 0;
	}
	.content input:focus{
		caret-color: var(--bk);
		outline: 0;
	}
	body {
		font-family: var(--ft-no-fu);
		/* background-color: #222; */
		/* color: #ffffff; */
		color: var(--bk);
	}

	.hidden {
		display: none !important;
	}

	.banner-wrap {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        position: fixed;
        width: 100%;
        height: var(--order-header--height);
        z-index: 10;
        background-color: #ffffff;
        border-bottom:1px solid #dcdcdc ;
	}

	.banner-wrap .banner-box {
		display: flex;
		align-items: center;
		grid-column: 2/17;
		font-size: 13px;
		font-family: var(--ft-no-fu);
		font-size: 13px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: var(--bk);
	}
    .banner-title{
		font-family: NotoSansCJKKR;
		font-size: 12px;
		font-weight: normal;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		text-align: left;
		color: var(--bk);
		margin-left: 5px;
	}
	.wishlist-section{
		display: grid;
		grid-template-columns: repeat(16, 1fr);
        margin-bottom: 200px;
	}
	/* 상품 내용 */
	.content.left {
		top: var(--order-header--height);
		margin-top: 150px;
		align-self: start;
		grid-column: 2/13;
	}
    .content.left .body-wrap.list{
		min-height: 100vh;
        border-left: 1px solid #dcdcdc;
	}
	.content.right {
		position: sticky;
		height: 100vh;
		top: 200px;
		grid-column: 13/17;
		display: grid;
	}
	.content.right .header-wrap{
		margin-bottom: 80px;
	}
	.content.right .body-wrap{
	}
	.product-wrap {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		width: 100%;
	}
	.product .product-info {
		padding: 0px;
	}
	.product-info .prd-img {
        background-color: #f8f8f8;
	}
	.info-box{
		padding: 10px;
	}
	.info-box > .info-row:nth-child(1){
		padding-bottom: 10px;
		
	}
	.info-box > .info-row:nth-child(2){
		padding-bottom: 14px;
        justify-content: left;
        gap: 5px;
	}
	.info-box .option-wrap {
		border: 1px solid #dcdcdc;
	}
	.info-box .option-box{
		display: flex;
        padding: 0 10px;
		flex-direction: column;
		justify-content: space-between;
	}
	.info-box .option-box .size__box{
		min-height: 40px;
		align-items: center;
	}
    .info-box .option-box .size__box .size.select{
        border-bottom: 2px solid #343434;
	}
	.info-box .option-box .count__btn__box{
		min-height: 40px;
	}
	.count__btn__box{
		display: flex;
		gap: 20px;
		align-items: center;
		font-family: var(--ft-no-fu);
		font-size: 11px;
		text-align: left;
		color: var(--bk);
	}

	.count__val{
		width: 10px;
		text-align: center;
	}
	.count__val:focus{
		outline: none;
	}
	.disableBtn {
		pointer-events: none;
		opacity: 0.4;
	}
    /* 상품 삭제 버튼 */
    .remove-btn {
        display: flex;
        position: absolute;
        right: 0;
        margin: 10px;
    }

    .remove-btn svg:nth-of-type(2){
        position: absolute;
        transform: rotate(90deg);
    }
    
    .product {
        border-right:1px solid #dcdcdc;
        border-bottom:1px solid #dcdcdc;
    }
    
	.product-select-btn{
        cursor: pointer;
		border-top: 1px solid #dcdcdc;
		display: flex;
		justify-content: center;
		height: 30px;
		align-items: center;
	}
    .product-select-btn.select {
        background-color: #000000;
        color: #ffffff;
    }
    .plus__btn{
        cursor: pointer;
    }
    .minus__btn {
        cursor: pointer;
    }
    .product .product-info .info-row .name{
        width: auto;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: 0.28px;
        text-align: left;
        color: var(--bk);
    }
    .product .product-info .info-row .price{
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: 0.28px;
        text-align: right;
        color: var(--bk);
    }
    .product .color-title {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: 0.28px;
        text-align: left;
        color: var(--bk);
    }
    .size__box li {
        cursor: pointer;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: center;
        color: var(--bk);
    }
    .size__box li[data-soldout="STSO"]::after{
        top: -2px;
    }
    .size__box li[data-soldout="STCL"]:hover::before{
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
    .size__box .size.select[data-soldout="STSC"]::after {
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
    .size__box li[data-soldout="STSC"]:hover {
        color: #808080;
        opacity: 1;
    }
    .add-list-wrap .header-wrap .header-box{
        text-align: right;
    }
    .add-list-wrap .header-wrap .header-box .hd-title{
        text-decoration: underline;
    }

	.add-list-wrap .body-wrap{
		width: 100%;
		display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        padding: 0 40px;
		column-gap: 20px;
		flex-wrap: wrap;
		row-gap: 40px;
		margin-bottom: 35rem;
	}
	.add-list-wrap .body-wrap .add-box{
        width: 100%;
        text-align: center;
	}	

	.add-list-wrap .body-wrap .add-box img{
        background-color: #fbfbfb;
	}
    .add-list-wrap .body-wrap .add-box .size-list{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        column-gap: 5px;
	}	
	.add-list-wrap .basket-link-btn{
		background-color: #000000;
		color: #ffffff;
		display: flex;
		justify-content: center;
		height: 40px;
		align-items: center;
		font-family: NotoSansCJKKR;
		font-size: 11px;
		font-weight: 300;
		font-stretch: normal;
		font-style: normal;
		line-height: normal;
		letter-spacing: normal;
		color: #fff;
	}
    .color__box{
        display: flex;
        gap: 3.5rem;
        flex-wrap: wrap;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        text-align: left;
        color: var(--bk);
        height: 15px;
        align-items: center;
    }
    .color-line.select .color::before{
        content: attr(data-title);
        position: absolute;
        top: -20px;
        left: 0px;
    }

    .color__box .color {
        position: relative;
        width: 14px;
        height: 14px;
    }
    .color__box .color::after{
        content: '';
        display: block;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        position: absolute;
        height: 0.8rem;
        width: 0.8rem;
        border-radius: 50%;
        background-color: var(--background-color);
    }
    .color__box .color.multi::after{
        background: var(--background);
    }
    .option-noti {
        position: absolute;
        display: flex;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: flex-end;  
    }
    .option-noti .noti-text {
        /* background-color: #ffffff; */
        width: 80%;
        text-align: right;
        text-decoration: underline;
    }
    .quick-menu-wrap{
        display: none;
    }
    @media (max-width:1025px) {
        .banner-wrap{
            top: 42px;
            height: 37px;
        }
        .content.left {
            grid-column: 1/17;
            margin-top: 0px;
        }
        .content.right{
            background-color: #ffffff;
            position: fixed;
            bottom: 0;
            top: auto;
            height: 160px;
            grid-column: 1/17;
            width: 100%;
        }
        .content.right .header-wrap {
            margin-bottom: 10px;
        }
        .add-list-wrap{
            overflow-x: hidden;
            padding: 10px 0 10px 10px;
            position: relative;
            z-index: 20;
        }
        .add-list-wrap .body-wrap {
            display: none;
        }
        .add-list-wrap .quick-menu-wrap {
            width: calc(100% - 45px);
        }
        .product {
            width: 50%;
        }
        .product .product-info {
            height: auto;
        }
        .quick-menu-wrap{
            display: block;
        }
        .add-list-wrap .basket-link-btn {
            height: 30px;
            position: absolute;
            width: calc(100% - 20px);
            margin-bottom: 10px;
            bottom: 0;
        }
        .swiper {
            height: 100%;
        }
       
        .quick-menu-wrap .swiper-button-next::after {
            position: relative;
            content: url('/images/svg/sort-bottom.svg');
            transform: rotate(270deg);
        }
        .quick-menu-wrap .swiper-button-prev::after {
            content: url('/images/svg/sort-bottom.svg');
            transform: rotate(90deg); 
        }
        .quick-swiper .quick-img {
            max-width: 60px;
        }
        .quick-menu-wrap .swiper-button-next {
            right: 20px;
            height: 100%;
            top: -5px;
            margin: 0;
        }
        .quick-menu-wrap .swiper-button-prev {
            display: none;
        }
    }
   
</style>
<main data-basketStr="<?=$basket_idx?>" data-country="<?=$country?>">
	<div class="banner-wrap">
		<div class="banner-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12.499" viewBox="0 0 15 12.499">
                <path data-name="패스 6645" d="M72.632 66.861a4.25 4.25 0 0 0-4.154-4.34 4.111 4.111 0 0 0-3.338 1.717 4.113 4.113 0 0 0-3.327-1.738 4.249 4.249 0 0 0-4.181 4.313 4.389 4.389 0 0 0 1.446 3.287l4.856 4.9 1.81-1.61.8.856 4.7-4.168a4.386 4.386 0 0 0 1.388-3.217z" transform="translate(-57.632 -62.5)" style="fill:var(--bk)"/>
            </svg>
            <span class="banner-title">위시리스트</span>
		</div>
	</div>
	<section class="wishlist-section">
		<div class="content left">
			<div class="body-wrap list"></div>
		</div>
		<div class="content right">
			<div class="add-list-wrap">
				<div class="header-wrap">
					<div class="header-box ">
						<span class="hd-title hidden">모두 선택해제</span>
					</div>
				</div>
				<div class="body-wrap"></div>
                <div class="quick-menu-wrap">
                    <div class="swiper mySwiper quick-swiper">
                        <div class="swiper-wrapper"></div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
				<div class="basket-link-btn hidden">
					<span>선택 제품 쇼핑백으로 이동하기</span>
				</div>
			</div>

		</div>
	</section>
</main>
<script>
	window.addEventListener('DOMContentLoaded', function() {
		getWhishProductList();
	});
    let addListBox = [];
    const quickSwiper = new Swiper(".quick-swiper",{
        observeParents:true,
        observeSlideChildren:true,
        slidesPerView: "auto",
        breakpoints: {
            320: {
                spaceBetween: 10,
                slidesPerView: 4.6
            },
            420: {
                spaceBetween: 10,
                slidesPerView: 6
            },
            520: {
                spaceBetween: 10,
                slidesPerView: 7
            },
            620: {
                spaceBetween: 10,
                slidesPerView: 8
            },
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
            
        }
        
    });
    quickSwiper.on('click', function() {
        let idx = quickSwiper.clickedIndex;
        let wishIdx = quickSwiper.wrapperEl.children[idx].children[0].dataset.no;
        elementScroll("body-list",wishIdx);
    });
    function wishListWrite(wishlist) {
        const bodyWrap = document.querySelector(".content .body-wrap.list");
        let productWrap = document.createElement("div");
        productWrap.classList.add("product-wrap");
        let productHtml ="";    
        let url ="http://116.124.128.246:81";
      
        wishlist.forEach(el => {

                let productColorHtml = "";
                let colorData = el.color_rgb;
                let multi = colorData.split(";");
                if(multi.length === 2){
                    productColorHtml += `
                        <div class="color-line" style="--background:linear-gradient(90deg, ${multi[0]} 50%, ${multi[1]} 50%);">
                            <div class="color multi" data-title="${multi}"></div>
                        </div>
                    `;
                } else {
                    productColorHtml += `
                        <div class="color-line" style="--background-color:${multi[0]}" >
                            <div class="color" data-title="${multi}"></div>
                        </div>
                    `;
                }


            let product_size = el.product_size;
            let productSizeHtml = "";
            product_size.forEach(size => {
                productSizeHtml += `
                    <li class="size" data-sizetype="${size.size_type}" data-productidx="${size.product_idx}" data-optionidx="${size.option_idx}" data-soldout="${size.stock_status}">${size.option_name}</li>
                `;
            });




            productHtml +=`
                <div class="body-list product">
                    <div class="product-info">
                        <div class="remove-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15.414" height="15.414" viewBox="0 0 15.414 15.414">
                                <g id="Line" transform="translate(0.207 0.207)">
                                    <path id="Line-2" data-name="Line" d="M0,14,14,0" transform="translate(0.5 0.5)" fill="none" stroke="#000" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1"/>
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15.414" height="15.414" viewBox="0 0 15.414 15.414">
                                <g id="Line" transform="translate(0.207 0.207)">
                                    <path id="Line-2" data-name="Line" d="M0,14,14,0" transform="translate(0.5 0.5)" fill="none" stroke="#000" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1"/>
                                </g>
                            </svg>
                        </div>
                        <a href="" class="docs-creator"><img class="prd-img" cnt="1" src="${url}${el.product_img}" alt=""></a>
                        <div class="info-box">
                            <div class="info-row">
                                <div class="name" data-soldout=""><span>${el.product_name}</span></div>
                                ${el.discount == 0 ? `<div class="price" data-soldout="${el.stock_status}" data-saleprice="${el.sales_price}" data-discount="${el.discount}" data-dis="false">${el.price.toLocaleString('ko-KR')}</div>`:`<div class="price" data-soldout="${el.stock_status}" data-saleprice="${el.sales_price}" data-discount="${el.discount}" data-dis="true"><span>${el.price.toLocaleString('ko-KR')}</span></div>`} 
                            </div>
                            <div class="info-row">
                                <div class="color-title"><span>${el.color}</span></div>
                                <div class="color__box" data-maxcount="" data-colorcount="1">
                                    ${productColorHtml}
                                </div>
                            </div>
                            <div class="option-wrap">
                                <div class="option-box">
                                    <div class="info-row">
                                        <div class="size__box">
                                            ${productSizeHtml}
                                        </div>
                                    </div>
                                </div>
                                <div data-idx="${el.product_idx}" class="product-select-btn">
                                    <span>선택하기</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            `;
        });
        productWrap.innerHTML = productHtml;
        bodyWrap.appendChild(productWrap);


    }
    const getWhishProductList = () => {
        let country = "KR"
        $.ajax({
            type: "post",
            data: {
                "country": country,
                "MEMBER_IDX":1
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/list/get",
            error: function() {
                alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
            },
            success: function(d) {
                let data = d.data;
                wishListWrite(data);
                productAddBtnClickHandler();
                countHandler();
                sizeSelectHandler();
            }
        });
    }

    function countHandler() {
        let $$minusBtn = document.querySelectorAll(".count__btn__box .minus__btn");
        let $$plusBtn = document.querySelectorAll(".count__btn__box .plus__btn");
        let $$countBox = document.querySelectorAll(".count__btn__box");
        $$countBox.forEach( el => {
            let cnt = el.querySelector(".count__val").value;
            if(cnt == "1"){
                el.querySelector(".minus__btn").classList.add('disableBtn');
            }
            if(cnt == "9"){
                el.querySelector(".plus__btn").classList.add('disableBtn');
        }
        })
        $$minusBtn.forEach(el => {
            el.addEventListener("click", minusBtnEvent);
        })
        $$plusBtn.forEach(el => {
            el.addEventListener("click", plusBtnEvent);
        })

    };
    function minusBtnEvent() {
        let countVal = this.parentNode.querySelector(".count__val").value
        countVal = parseInt(countVal) - 1;
        // countUpdateInput(countVal);
        this.parentNode.querySelector(".count__val").value = countVal;
        this.parentNode.querySelector(".count__val").setAttribute("value",countVal);
        if(countVal == "1"){
            this.classList.add('disableBtn');
        }else{
            this.parentNode.querySelector(".plus__btn").classList.remove('disableBtn');
        }
    }
    function plusBtnEvent() {
        let countVal = this.parentNode.querySelector(".count__val").value
        countVal = parseInt(countVal) + 1;
        this.parentNode.querySelector(".count__val").value = countVal;
        this.parentNode.querySelector(".count__val").setAttribute("value",countVal)
        if(countVal == "9"){
            this.classList.add('disableBtn');
        }else{
            this.parentNode.querySelector(".minus__btn").classList.remove('disableBtn');
        }
    }

    
    // 상품 사이즈 선택 
    function sizeSelectHandler() {
        let sizes = document.querySelectorAll(".size__box .size");
        let sizeBox = document.querySelectorAll(".size__box");
        
        sizes.forEach(el => {
            el.addEventListener("click", function(e){
                let sizeLen = sizeIsSelectEl(e).length;
                let sizeEl = e.target.offsetParent.querySelectorAll(".size__box .size");
                let szieTarget = e.target;

                //상품 재고 상태 반영
                if(szieTarget.dataset.soldout == "STIN" || szieTarget.dataset.soldout == "STSH" || szieTarget.dataset.soldout == "STCL" ){
                    szieTarget.classList.toggle("select");
                } 

                e.currentTarget.offsetParent.querySelector(".product-select-btn").classList.remove("select");
                e.currentTarget.offsetParent.querySelector(".product-select-btn span").innerHTML="선택하기";

            });
        });
    }

    //사이즈 선택 체크 
    const sizeIsSelectEl  = (e) => {
        let sizeEl = e.target.offsetParent.querySelectorAll(".size__box .size");
        let result = [...sizeEl].filter(el => el.classList.contains("select"));
        
        return result
    }
    //
    const addIsProductEl  = (wishIdx) => {
        let addboxEl = document.querySelectorAll(".add-list-wrap .add-box");
        let result = [...addboxEl].filter(el => el.dataset.wish == wishIdx);
        return result
    }
    const showAddWrapBtns = () => {
        let addListWrap = document.querySelector(".add-list-wrap");
        let allRemoveBtn  = addListWrap.querySelector(".hd-title");
        let basketLinkBtn  = addListWrap.querySelector(".basket-link-btn");
        addListWrap.classList.remove("hidden");
        allRemoveBtn.classList.remove("hidden");
    }
        
    //상품 선택 버튼
    function productAddBtnClickHandler() {
        let $$prdAddBtn = document.querySelectorAll(".product-select-btn");
        let addBoxs = document.querySelectorAll(".add-list-wrap .add-box");
        let addList = [];
        let addProduct = {}
        $$prdAddBtn.forEach((el , index)=> {
            el.addEventListener("click",function(e){
                let sizeEl = sizeIsSelectEl(e);
                let szieTextArr = sizeEl.map(el => el.innerHTML);
                let szieIdxArr = sizeEl.map(el => el.dataset.optionidx);

                let getSrc = e.target.offsetParent.querySelector(".prd-img").getAttribute("src");
                let getName = e.target.offsetParent.querySelector(".name span").innerHTML;
                let getSizeText = szieTextArr;
                let getSizeIdx = szieIdxArr;
                let getProduct = e.currentTarget.dataset.idx;
                let getWish = index;

                //사이즈가 선택이 아무것도 안되어있을때 ~~~~
                //1. 예외처리 
                if(!sizeEl.length){
                    e.currentTarget.classList.remove("select");
                    e.currentTarget.children[0].innerHTML = "옵션을 선택해주세요";
                    return false;
                }  

                addProduct.idx = getProduct;
                addProduct.sizeidx = getSizeIdx;
                addProduct.sizeText = getSizeText;
                addProduct.img = getSrc;
                addProduct.name = getName;
                addProduct.wish = getWish;
                
            
                e.currentTarget.classList.add("select");
                
                addListAppend(addProduct);


                document.querySelector(".add-list-wrap .header-box").classList.remove("hidden");
                document.querySelector(".add-list-wrap .basket-link-btn").classList.remove("hidden");

                el.childNodes[1].innerHTML = "선택해제";
                

            });
        })
    }
    function addListAppend(add) {
        let bodyWrap = document.querySelector(".add-list-wrap .body-wrap");
        let swiperWrap = document.querySelector(".add-list-wrap .quick-swiper .swiper-wrapper");
        let addBoxs = bodyWrap.querySelectorAll(".add-box");
        
        let addBoxEl = document.createElement("div");
        let slideEl = document.createElement("div");
        let sizeIdxArr = add.sizeidx.toString();
        let sizeHtml = "";
        addBoxEl.dataset.wish = add.wish;
        addBoxEl.dataset.size =  sizeIdxArr;
        //사이즈 선택이 1개이상일떄 
        if(sizeIdxArr.length > 0){
            let sizeResult =  add.sizeText.map(el => {
                let sizeSpan = `<span>${el}</span>`
                return sizeSpan;
            }).join("");
            sizeHtml = sizeResult;
        }

        //동일한 위시리스트 idx가 찜리시트에 있을경우 
        let wishStatus = addIsProductEl(add.wish);
        if(wishStatus.length){
            let thisSizeList = wishStatus[0].querySelector(".size-list");
            wishStatus[0].dataset.size = sizeIdxArr;

            while(thisSizeList.hasChildNodes()){ //자식 요소가 있는지 확인-false가 될때까지 반복
                thisSizeList.removeChild(thisSizeList.firstChild); // 첫번째 자식 요소를 삭제
            }
            add.sizeText.forEach(el => {
                let sizeSpan = document.createElement("span");
                sizeSpan.innerHTML = el;
                thisSizeList.appendChild(sizeSpan);
            });
            return
        } 

        addboxHtml = `
            <img src="${add.img}" alt="">
            <div class="product-title">
                <span>${add.name}</span>
                <div class="size-list">
                ${sizeHtml}
                </div>
            </div>
        `;

        quickHtml =`<img class="quick-img" data-no="${add.wish}" src="${add.img}" alt="">`;

        

        addBoxEl.innerHTML = addboxHtml;
        slideEl.innerHTML = quickHtml;
        addBoxEl.classList.add("add-box");
        slideEl.classList.add("swiper-slide");
        
        bodyWrap.appendChild(addBoxEl);
        swiperWrap.appendChild(slideEl);
        quickSwiper.update();
        console.log("🏂 ~ file: order-whish.php:846 ~ addListAppend ~ addBoxs.length", bodyWrap.querySelectorAll(".add-box").length)
        if(bodyWrap.querySelectorAll(".add-box").length !== 0){
            showAddWrapBtns();
        }
    }
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:853 ~ addListAppend ~ add.sizeidx", add.sizeidx)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)
        console.log("🏂 ~ file: order-whish.php:852 ~ addListAppend ~ sizeIsSelectEl.length", sizeIsSelectEl.length)

    //퀵슬라이드 클릭시 스크롤 이동
    function elementScroll(el, idx) {
        const headerHeight = document.querySelector("header").offsetHeight;
        const bannerHeight = document.querySelector(".banner-wrap").offsetHeight;
        let elemTop = document.querySelectorAll(`.${el}`)[idx].offsetTop;
        let result = elemTop - (headerHeight + bannerHeight);
        window.scrollTo(0, result);
    }
</script>