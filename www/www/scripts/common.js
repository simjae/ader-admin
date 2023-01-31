


/**
 * @author SIMJAE
 * @param {String} elem 해당레이아웃 클래스나 , id
 */
function layoutOutSideClick(elem) {
    elem.addEventListener("click" ,(e) =>{
        if(e.target !== elem){
            elem.classList.remove("open")
        }
    } )
}

/**
 * @author SIMJAE
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
 * @author SIMJAE
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


/**
 * @author SIMJAE
 * @description 로그인 세션값 
 * @returns true,false
 */
function getLoginStatus() {
    return sessionStorage.getItem("login_session");
}


/**
 * @author SIMJAE
 * @param {String} page 예외처리 모달 페이지
 * @param {String} message 예외처리 모달 메시지
 * @description 에러띄울 모달
 */
function exceptionHandling(page,message){
    if(document.querySelector('#exception-modal') !== null){
        document.querySelector('#exception-modal').remove();
    }
    const body = document.body;
    const exceptionContainner = document.createElement("div");
    exceptionContainner.id = "exception-modal";
    exceptionContainner.className = "exception-containner";
    exceptionContainner.innerHTML = `
    <div class="exception__background">
        <div class="exception__wrap">
            <div class="exception__box">
                <div class="close-btn">[X]</div>
                <h1 class="title">-${page}-</h1>
                <p>${message}</p>
            </div>
        </div>
    </div>
    `
    body.appendChild(exceptionContainner)
    
    this.openModal = (()=>{
        exceptionContainner.classList.add("open");
        modalClose();
    })();

    function modalClose(){
        let closeBtn = document.querySelector(`#exception-modal .close-btn`);
        closeBtn.addEventListener("click",()=> {exceptionContainner.classList.remove("open");document.querySelector('#exception-modal').remove();});
    }

}

//위시리스트 함수 
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
                    $(obj).attr('onClick', 'deleteWhishListBtn(this);');
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
                    $(obj).attr('onClick', 'setWhishListBtn(this);');
                }
            }
        });
    }
}