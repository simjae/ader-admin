<style>
    .product__list__wrap{
    }
    .product__body{
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }
    .product__header{
        border-bottom:1px solid #fbfbfb;
        padding: 20px;
    }
    .product__header .prd__btn__wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .product__header .basket__btn__box{
        display: flex;
        gap: 10px;
    }
    .product__list__box {
        grid-column: 3/14;
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }
    .product__list__box .prd__list{
        border-right-width: 0px;
        border-left-width: 1px;
        position: relative;
    }
    .product__list__box[data-grid="4"] .prd__list{
        grid-column: span 4;
    }
    .product__list__box[data-grid="2"] .prd__list:nth-child(odd){
        grid-column: 2 / span 7;
    }
    .product__list__box[data-grid="2"] .prd__list:nth-child(even){
        grid-column : span 7;
    }
    .product__list__box .prd__list:first-child{
        border-left-width: 0px;
    }
    .product__list__box .prd__img{
        width: 100%;
        height: 250px;
        background-color: #fbfbfb;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }
    .product__list__box.grid-cols-2 .prd__list .prd__img{
        background-size: contain;
    }
    .product__list__box .prd__checkBox {
        position: absolute;
        left: 0;
        padding: 10px;
    }
    .product__info__wrap {
        padding: 10px;
    }
    .product__info__1{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .product__info__2{
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .product__title {
    font-family: FuturaLTPro;
    font-size: 13px;
    text-align: left;
    color: #343434;
}
.product__price {
    font-family: FuturaLTPro;
    font-size: 12px;
    text-align: left;
    color: #343434;
}
/* 컬러칩 */
.product__color {
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
}
.color__chip{
    display: flex;
    gap: 30px;
    align-items: center;
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
    padding-right: 30px;
}
.color__chip .color__outline.select {
    padding: 3px;
    outline-style: auto;
    outline-width: 1px;
    outline-color: #7a7a7a;
    border-radius:50%;

}
.color__chip .color {
    width: 0.8rem;
    height: 0.8rem;
    border-radius: 50%;
}

/* 사이즈 */

.product__size {
    display: flex;
    font-family: FuturaLTPro;
    font-size: 11px;
    justify-content: space-between;
    color: #343434;
}
.product__size .size__box {
    display: flex;
    gap: 30px;
    align-items: flex-end;
}
.product__size li {
    list-style: none;
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
}
/* 옵션없을떄 */
.option__defult__wrap{
    display: none;
    animation: fadeOut 0.5s ease-out;
}
.minus__btn{
    cursor: pointer;
}
.plus__btn{
    cursor: pointer;
}
.option__defult__wrap.select{
    border-top: 1px solid #dcdcdc;
    border-right: 1px solid #dcdcdc;
    border-left: 1px solid #dcdcdc;
    background-color: #fff;
    display: block;
    width: 100%;
    padding: 10px;
    position: absolute;
    transform: translateY(-100px);
    height: 100px;
    animation: fadeIn 0.5s ease-out;
}
.option__defult__wrap.select > div{
    padding-bottom: 10px;
}
@keyframes fadeIn {
    0%{
        display: none; 
        opacity: 0;
    }
    1% {
        display: block; 
        opacity: 0;
    }
    100% {
        display: block; 
        opacity: 1;
    }
}
@keyframes fadeOut {
    0%{
        display: block; 
        opacity: 1;
    }
    1% {
        display: none; 
        opacity: 1;
    }
    100% {
        display: none; 
        opacity: 0;
    }
}
.option__btn {
    margin-top: 10px;
    border: solid 1px #dcdcdc;
    padding: 5px;
    text-align: center;
}
.count__btn__box{
    display: flex;
    gap: 30px;
    font-family: FuturaLTPro;
    font-size: 11px;
    text-align: left;
    color: #343434;
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
</style>
<main>
	<input id="country" type="hidden" value="KR">
	
    <section class="product__list__wrap">
        <div class="product__header">
            <h1>
                위시리스트
            </h1>
            <div class="prd__btn__wrap">
                <label class="flex">
                    <input type="checkbox">
                    <u>전체선택</u>
                </label>    
                <div class="basket__btn__box">
                    <u>쇼핑백으로 이동</u>
                    <u>선택삭제</u>
                    <u>모두삭제</u>
                </div>
            </div>
            <div></div>
        </div>
        <div class="product__body">
            <div class="product__list__box" data-grid="4"></div>
        </div>
    </section>
</main>

<script>
	window.addEventListener('DOMContentLoaded', function() {
		getWhishProductList();
		getRecommendProductList();
	});
	
	const getWhishProductList = () => {
		let country = $('#country').val();
		
		$.ajax({
			type: "post",
			data: {
				"country": country,
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/order/whish/list/get",
			error: function() {
				alert("위시 리스트 등록 상품 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				let data = d.data;
				console.log(data);
			}
		});
	}
	
	const getRecommendProductList = () => {
		let country = $('#country').val();
		
		$.ajax({
			type: "post",
			data: {
				"country": country
			},
			dataType: "json",
			url: "http://116.124.128.246:80/_api/common/recommend/get",
			error: function() {
				alert("관련 상품 정보불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				let data = d.data;
				console.log(data);
			}
		});
	}
//옵션확인해서 옵션 박스 선택해주는 함수
(function() {
    let option = 0;
    let option1 = 1;
    let wishList =[];
    let wishHtml = "";
    const $productListBox = document.querySelector(".product__list__box");
    if (option == 0 ){
        wishHtml += `
            <div class="prd__list" idx="">
                <div class="">
                    <label class="prd__checkBox" for=""><input type="checkbox" name="" id=""></label>
                    <div class="prd__close__btn">
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01YG_mdl_1661843858.png') ;"></div>
                <div class="product__info__wrap">
                    <div class="product__info__1">
                        <div>Twin heart hoodie</div>
                        <div>529.000</div>
                    </div>
                    <div style="position: relative;">
                        <div class="option__defult__wrap">
                            <div class="flex justify-between">
                                <div>Size</div>
                                <div class="close__btn">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div>
                            <div class="product__size">
                                <div class="size__box">
                                    <li data-soldout="stcl">A1</li>
                                    <li data-soldout="stin">A2</li>
                                    <li data-soldout="STSC">A3</li>
                                    <li data-soldout="STSO">A4</li>
                                </div>
                            </div>
                            <div class="count__btn__box">
                                <div>Qty</div>
                                <div class="minus__btn">-</div>
                                <input class="count__val" type="text" value="1" onchange="countChange()">
                                <div class="plus__btn">+</div>
                            </div>
                        </div>
                        <div class="option__btn">
                            <img src="" alt="">
                            <span>필수 옵션을 선택해주세요</span>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        `   
        wishList.push(wishHtml);
    } 
    if( option1 == 1 ) {
        wishHtml += `
            <div class="prd__list">
                <div class="">
                    <label class="prd__checkBox" for=""><input type="checkbox" name="" id=""></label>
                    <div class="prd__close__btn">
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="prd__img" style="background-image:url('/images/product/img_product_product_BLASSHD01YG_mdl_1661843858.png') ;"></div>
                <div class="product__info__wrap">
                    <div class="product__info__1">
                        <div>Twin heart hoodie</div>
                        <div>529.000</div>
                    </div>
                    <div class="product__info__2">
                        <div class="product__color">gray</div>
                        <div class="color__chip">
                            <div class="color__outline">
                                <div class="color" style="background-color:slateblue"></div>
                            </div>
                        </div>
                        <div class="product__size">
                            <div class="size__box">
                                <li>A1</li>
                                <li>A2</li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
        wishList.push(wishHtml);
    }
    $productListBox.innerHTML = wishHtml;
})();

(() => {
    const $optionBtn = document.querySelector(".option__btn");
    const $defultWrap = document.querySelector(".option__defult__wrap");
    let $closeBtn = document.querySelector(".close__btn");
    $optionBtn.addEventListener("click", () => {
        $defultWrap.classList.toggle("select");
    });
    $closeBtn.addEventListener("click", () => {
        $defultWrap.classList.remove("select");
    });
})();

(function() {
    const $minusBtn = document.querySelector(".count__btn__box .minus__btn");
    const $plusBtn = document.querySelector(".count__btn__box .plus__btn");
    const $countInput = document.querySelector(".count__btn__box .count__val");
    let countVal = document.querySelector(".count__btn__box .count__val").value;
    
    countUpdateInput(countVal);

    $minusBtn.addEventListener("click",() => {
        countVal = parseInt(countVal) - 1;
        countUpdateInput(countVal);
    });
    $plusBtn.addEventListener("click",() => {
        countVal = parseInt(countVal) + 1;
        countUpdateInput(countVal);
    });

})();

function countUpdateInput(value){
    document.querySelector(".count__val").value = value;
    document.querySelector(".count__val").setAttribute("value",value);
    const $minusBtn = document.querySelector(".count__btn__box .minus__btn");
    const $plusBtn = document.querySelector(".count__btn__box .plus__btn");
    let countVal = document.querySelector(".count__btn__box .count__val").value;

    if(countVal == "1"){
        $minusBtn.classList.add('disableBtn');
    }else{
        $minusBtn.classList.remove('disableBtn');
    }

    if(countVal == "9"){
        $plusBtn.classList.add('disableBtn');
    }else{
        $plusBtn.classList.remove('disableBtn');
    }
}

function selectOption(size,qty) {
    let divWrap = document.createElement("div");
    let defultOption = document.querySelector(".option__btn");
    let optionDefultWrap = document.querySelector(".option__defult__wrap");
    let addOptionHtml = `                   
        <div class="product__info__2">
            <div class="product__color">gray</div>
            <div class="color__chip">
                <div class="color__outline">
                    <div class="color" style="background-color:slateblue"></div>
                </div>
            </div>
            <div class="product__size">
                <div class="size__box">
                    <li>${size}</li>
                    <li>Qty:${qty}</li>
                </div>
            </div>
        </div>`
    divWrap.innerHTML = addOptionHtml;
    document.querySelector(".product__info__wrap").appendChild(divWrap);
    defultOption.style.display = "none"
    optionDefultWrap.classList.remove("select");
}

(function() {
    let $sizeBoxLi = document.querySelectorAll(".size__box > li");
    $sizeBoxLi.forEach((el) => {
        el.addEventListener("click", function(ev) {
            let qty = this.parentNode.parentNode.parentNode.querySelector(".count__val").value;
            let size = el.innerHTML;
            selectOption(size,qty);
        });
    }); 
})();
</script>