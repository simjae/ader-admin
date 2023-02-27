
/**
 * @author SIMJAE
 * @param {String} elem 해당레이아웃 클래스나 , id
 */
function layoutOutSideClick(elem) {
    elem.addEventListener("click", (e) => {
        if (e.target !== elem) {
            elem.classList.remove("open")
        }
    })
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
    if (add_type == "product") {
        dataResult = {
            "add_type": add_type,
            "product_idx": idx,
            "option_idx": optionIdx,
            "country": country,
        }
    } else if (add_type == "whish") {
        dataResult = {
            "add_type": add_type,
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
            if (d.code == 200) {
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
    window.addEventListener("scroll", function () {
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
function exceptionHandling(page, message) {
    if (document.querySelector('#exception-modal') !== null) {
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

    this.openModal = (() => {
        exceptionContainner.classList.add("open");
        modalClose();
    })();

    function modalClose() {
        let closeBtn = document.querySelector(`#exception-modal .close-btn`);
        closeBtn.addEventListener("click", () => { exceptionContainner.classList.remove("open"); document.querySelector('#exception-modal').remove(); });
    }

}

//위시리스트 함수 
function setWhishListBtn(obj) {
    let product_idx = $(obj).attr('product_idx');
    let basket_wrap = $(obj).parent().parent();
    if (product_idx != null) {
        $.ajax({
            type: "post",
            data: {
                "product_idx": product_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/add",
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
                    $(obj).attr('onClick', 'deleteWhishListBtn(this);');
                    if (basket_wrap.hasClass("nav")) {
                        basket_wrap.find(".whish-btn").append("<div class='whislist-tilte'>whislist</div>")
                    }
                }
            }
        });
    }
}

function deleteWhishListBtn(obj) {
    let product_idx = $(obj).attr('product_idx');
    let basket_wrap = $(obj).parent().parent();
    if (product_idx != null) {
        $.ajax({
            type: "post",
            data: {
                "product_idx": product_idx
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/order/whish/delete",
            error: function () {
                alert("위시리스트 등록/해제 처리에 실패했습니다.");
            },
            success: function (d) {
                let code = d.code;
                let msg = d.msg;

                if (code == "200") {
                    let whish_img = $(obj).find('.whish_img');
                    whish_img.attr('src', '/images/svg/wishlist.svg');
                    $(obj).attr('onClick', 'setWhishListBtn(this);');
                    if (basket_wrap.hasClass("nav")) {
                        basket_wrap.find(".whislist-tilte").remove();
                    }
                }
            }
        });
    }
}

function createFooterObserver() {
    let observer;
    let options = {
        root: null,
        rootMargin: '0px',
        threshold: 0
    }
    let target = document.querySelector("footer")
    observer = new IntersectionObserver((entries) => {
        const $body = document.querySelector("body");
        entries.forEach(entry => {
            if (entry.isIntersecting && !$body.classList.contains("m_menu_open")) {
                let footerHeight = entry.boundingClientRect.height;
                document.querySelector("#quickview .quickview__box").classList.add("on");
                //                document.querySelector("#quickview .quickview__box").style.bottom = `${footerHeight}px`;
            } else {
                document.querySelector("#quickview .quickview__box").classList.remove("on");
                //                document.querySelector("#quickview .quickview__box").style.bottom = `0px`;
            }
        });
    }, options);
    observer.observe(target);

    /*    
    var $w = $(window),
    footerHei = $('footer').outerHeight(),
    $quickview = $("#quickview .quickview__box");

    $w.on('scroll', function() {
        var sT = $w.scrollTop();
        var val = $(document).height() - $w.height() - footerHei;

        if (sT >= val){
            $quickview.addClass('on');
            $quickview.css("bottom",footerHei+"px");
        }
        else{
            $quickview.removeClass('on');
        }
    });
*/
}



/**
 * @author 김성식
 * @description 세로 스크롤바 사이즈 반환
 */
function getScrollBarWidth() {
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";

    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);

    document.body.appendChild(outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) w2 = outer.clientWidth;

    document.body.removeChild(outer);

    return (w1 - w2);
};



/**
 * @author 김성식
 * @description 스크롤바 유무 판단
 */
$.fn.hasScrollBar = function () {
    return (this.prop("scrollHeight") == 0 && this.prop("clientHeight") == 0) || (this.prop("scrollHeight") > this.prop("clientHeight"));
};

/**
 * @author 김성식
 * @description 디바이스 체크
 */
function checkMobileDevice() {
    var mobileKeyWords = new Array('Android', 'iPhone', 'iPod', 'BlackBerry', 'Windows CE', 'SAMSUNG', 'LG', 'MOT', 'SonyEricsson');
    for (var info in mobileKeyWords) {
        if (navigator.userAgent.match(mobileKeyWords[info]) != null) {
            //mobile
            return true;
        }
    }
    //web
    return false;
}
/**
 * @author SIMJAE
 * @param {String} key 
 * @description location.href 주소값의 파라미터 키값
 */
function getUrlParamValue(key) {
    const urlParams = new URL(location.href).searchParams;
    const param_value = urlParams.get(`${key}`);
    return param_value;
}

// /**
//  * @author SIMJAE
//  * @param {String} key 
//  * @description 사이드바 오픈시에 전체체크박스
//  */
// function sidebarAllCheck() {
//     //전체
//     document.querySelector('#sidebar .prd_cb.all__cb').checked = true
//     //개별 전체
//     document.querySelectorAll('#sidebar .prd__cb.self__cb').forEach(el => el.checked = true)
// }

/**
 * @author SIMJAE
 * @param {String} product_idx 상품 인덱스
 * @description 최근 본 상품 기록 10개로 갯수제한 
 */
function saveRecentlyViewed(product_idx) {
    product_idx = parseInt(product_idx)
    const keyName = "recentlyViewed";
    let recentlyViewed = localStorage.getItem('recentlyViewed');
    recentlyViewed = recentlyViewed ? new Set(JSON.parse(recentlyViewed)) : new Set();
    
    const prevValue = JSON.parse(localStorage.getItem(keyName));
    if (recentlyViewed.has(JSON.stringify(product_idx))) {
        // 이미 존재하는 상품이면 삭제 후 다시 추가하여 가장 최신 상품으로 보이도록 함
        recentlyViewed.delete(JSON.stringify(product_idx));
    }
    recentlyViewed.add(JSON.stringify(product_idx));

    if (recentlyViewed.size > 10) {
        // 최근 본 상품이 10개를 초과하면 가장 오래된 상품 삭제
        const iterator = recentlyViewed.values();
        recentlyViewed.delete(iterator.next().value);
    }

    localStorage.setItem(keyName, JSON.stringify(Array.from(recentlyViewed)));
    let recentlyresultReverse;
    if (JSON.stringify(Array.from(recentlyViewed)) !== JSON.stringify(prevValue)) {
        recentlyresultReverse = Array.from(recentlyViewed).reverse();
        console.log("최신 본 상품 스와이프 초기화 필요 ");
        console.log(recentlyresultReverse);
    }
    recentlyresultReverse = Array.from(recentlyViewed).reverse();
    return  recentlyresultReverse;
}

window.addEventListener("DOMContentLoaded", function () {
    createFooterObserver();
})

function getLanguage() {
	let lng = navigator.language || navigator.userLanguage;
	
	let country = null;
	switch (lng) {
		case "ko-KR":
			country = "KR";
			break;
		
		case "en-US":
			country = "EN";
			break;
		
		case "zh-CN":
			country = "CN";
			break;
		
		default :
			country = "EN";
			break;
	}
	
	return country;
}