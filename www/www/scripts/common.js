function layoutOutSideClick(elem) {
    elem.addEventListener("click" ,(e) =>{
        console.log(e.target)
        console.log(e.currentTarget)
        if(e.target !== elem){
            elem.classList.remove("open")
        }
    } )
}

/**
 * 
 * @param {String} add_type product, whish 택 1
 * @param {String} idx add_type에 따라서 넘기는 값이 다름( product: product_idx ,whish:whish_idx)
 * @param {Array} optionIdx 상품 옵션 idx 리스트
 * @description 스크롤시 footer위로 올려야하는 엘리먼트
 */
function addBasketApi(add_type, idx, optionIdx) {
    const main = document.querySelector("main");
    let country = main.dataset.country;
    let dataResult = {};
    if (add_type == "product"){
        dataResult = {
            "add_type":add_type,
            "product_idx": idx,
            "option_idx": optionIdx,
            "country": country,
        }
    } else if(add_type == "whish") {
        dataResult = {
            "add_type":add_type,
            "whish_idx": idx,
            "option_idx": optionIdx,
            "country": "KR",
        }
    }
    $.ajax({
        type: "post",
        data: dataResult,
        dataType: "json",
        url: "http://116.124.128.246:80/_api/order/basket/add",
        error: function () {
            alert("쇼핑백 담기에 실패하였습니다.");
        },
        success: function (d) {
            if(d.code == 200){
                // location.href='http://116.124.128.246/order/basket/list';
            }
        }
    });
}

/**
 * @param {String} elem 해당 클래스,Id 
 * @description 스크롤시 footer위로 올려야하는 엘리먼트
 */
const elemScrollFooterUpEvent = (elem) => {
    window.addEventListener("scroll", function() {
        const scrollHeight = window.scrollY;
        const windowHeight = window.innerHeight;
        const docTotalHeight = document.body.offsetHeight;
        const isBottom = windowHeight + scrollHeight === docTotalHeight;
        const $elem = document.querySelector(elem);
        const footer = document.querySelector("footer").offsetHeight;
        if (isBottom) {
            $elem.style.bottom = `${footer}px`;
        } else {
            $elem.style.bottom = "0px";
        }
    });
};

