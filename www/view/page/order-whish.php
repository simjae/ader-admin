<style>
    	:root {
		--order-header--height: 150px;
		--header--content--gap: 50px;

		--solid-bk: #808080;
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
		height: 80px;
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
					<div class="header-box hidden">
						<span class="hd-title">모두 선택해제</span>
					</div>
				</div>
				<div class="body-wrap"></div>
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
                                    <div class="info-row" style="position:relative;">
                                        <div class="count__btn__box">
                                            <div>Qty</div>
                                            <div class="minus__btn">-</div>
                                            <input class="count__val" type="text" value="1">
                                            <div class="plus__btn">+</div>
                                        </div>
                                        <div class="option-noti hidden"><div class="noti-text">옵션을 선택해주세요</div></div>
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
                productAddHandler();
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

    //상품 선택 버튼
    function productAddHandler() {
        let $$prdAddBtn = document.querySelectorAll(".product-select-btn");
        let addBoxs = document.querySelectorAll(".add-list-wrap .add-box");
        let addList = [];
        let addProduct = {
            productIdx : "",
            productQty : 0,
            optionIdx : ""
        }
        $$prdAddBtn.forEach(el => {
            el.addEventListener("click",function(e){
                
                if(e.currentTarget.dataset.optionidx === undefined){
                    e.target.offsetParent.querySelector(".option-noti").classList.remove("hidden");
                    return false;
                }
                let getSrc = e.target.offsetParent.querySelector(".prd-img").getAttribute("src");
                let getName = e.target.offsetParent.querySelector(".name span").innerHTML;
                let getCount = e.target.offsetParent.querySelector(".count__val").value;
                let getSize = e.currentTarget.dataset.optionidx;
                let getProduct = e.currentTarget.dataset.idx;
                
                addProduct.idx = getProduct;
                addProduct.qty = getCount;
                addProduct.size = getSize;
                addProduct.img = getSrc;
                addProduct.name = getName;
                
                //해당 상품이 이미 추가 되어있을때 
                if(!addList.includes(getProduct)){
                    e.currentTarget.classList.add("select");
                    addListAppend(getSrc,getName,getSize,getCount,getProduct,addProduct);
                    addList.push(getProduct); 
                    document.querySelector(".add-list-wrap .header-box").classList.remove("hidden");
                    document.querySelector(".add-list-wrap .basket-link-btn").classList.remove("hidden");

                    el.childNodes[1].innerHTML = "선택해제";
                }else {
                    console.log("해당 상품이 이미 추가 되어있습니다.");
                }
                

            });
        })
    }
    // 상품 사이즈 선택 
    function sizeSelectHandler() {
        let sizes = document.querySelectorAll(".size__box .size");
        let sizeBox = document.querySelectorAll(".size__box");
        
        sizes.forEach(el => {
            el.addEventListener("click", function(e){
                e.target.offsetParent.querySelector(".option-noti").classList.add("hidden");
                let sizeEl = e.target.offsetParent.querySelectorAll(".size__box .size");
                let szieTarget  = e.target;
                szieTarget.parentNode.querySelectorAll(".size__box .size").forEach(el => {
                    el.classList.remove("select");
                });
                szieTarget.classList.add("select");
                let getSize = [...sizeEl].filter(el => el.classList.contains("select"));
                console.log(e.target.offsetParent.querySelector(".product-select-btn").dataset.optionidx = getSize[0].dataset.optionidx)
            });
        });
    }
     //찜리스트에 추가 
    function addListAppend(url,name,size,count,product,add) {
        console.log(add);
        let addBoxEl = document.createElement("div");
        let bodyWrap = document.querySelector(".add-list-wrap .body-wrap")
        addBoxEl.classList.add("add-box");
        addBoxEl.dataset.count = count;
        addBoxEl.dataset.size = size;
        addBoxEl.dataset.product = product;
        addboxHtml = `
            <img src="${url}" alt="">
            <div class="product-title">
                <span>${name}</span>
            </div>
        `;
        addBoxEl.innerHTML = addboxHtml;
        bodyWrap.appendChild(addBoxEl);

    }
</script>