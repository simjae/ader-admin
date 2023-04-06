let cdn_img = "https://cdn-ader-orig.fastedge.net";
let cdn_vid = "https://media-ader.fastedge.net/adervod/_definst_";
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
            "country": getLanguage()
        }
    } else if (add_type == "whish") {
        dataResult = {
            "add_type": add_type,
            "whish_idx": idx,
            "option_idx": optionIdx,
            "country": getLanguage()
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
function notiModal(main,sub) {
    if (document.querySelector('#notimodal-modal') !== null) {
        document.querySelector('#notimodal-modal').remove();
    }
    const body = document.body;
    const notimodalContainner = document.createElement("div");
    notimodalContainner.id = "notimodal-modal";
    notimodalContainner.className = "notimodal-containner";
    notimodalContainner.innerHTML = `
    <div class="notimodal__background">
        <div class="notimodal__wrap">
            <div class="notimodal__box">
                <div class="close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.707" height="12.707" viewBox="0 0 12.707 12.707">
                        <path data-name="선 1772" transform="rotate(135 6.103 2.736)" style="fill:none;stroke:#343434" d="M16.969 0 0 .001"></path>
                        <path data-name="선 1787" transform="rotate(45 -.25 .606)" style="fill:none;stroke:#343434" d="M16.969.001 0 0"></path>
                    </svg>
                </div>
                <h1 class="title">${main === undefined ? "":main}</h1>
                <p>${sub === undefined ? "":sub}</p>
            </div>
        </div>
    </div>
    `
    body.appendChild(notimodalContainner)

    this.openModal = (() => {
        notimodalContainner.classList.add("open");
        modalClose();
    })();

    function modalClose() {
        let closeBtn = document.querySelector(`#notimodal-modal .close-btn`);
        closeBtn.addEventListener("click", () => { notimodalContainner.classList.remove("open"); document.querySelector('#notimodal-modal').remove(); });
    }

}
let mobileProductDetailWhishSwiperOption = {
    // observer: true,
    // observeParents: true,
    navigation: {
        nextEl: ".mobile-whishlist-wrap .quickview-whish-swiper .swiper-button-next",
        prevEl: ".mobile-whishlist-wrap .quickview-whish-swiper .swiper-button-prev",
    },
    autoHeight: true,
    // slidesPerView: 'auto',
    spaceBetween: 5,
    slidesPerView: 5.6
}




/*------------------------------------------- 위시리스트 ------------------------------------------- */
/**
 * @author SIMJAE
 * @description 모든 상황별 위시리스트 반영 
 */
async function updateWishlist(clickEl, data) {
    let loginStatus = getLoginStatus();
    let clickTarget = clickEl;
    let targetLocation = data.location;
    let targetStatus = data.wishStatus;
    let targetProductIdx = data.productIdx;
    let targetUrl = data.url;

    if( loginStatus === 'true' ){
        changeStatusWishBtn();
    } else {
        notiModal('로그인 후 이용가능한 서비스 입니다.')
        let beforUrl = location.href;
        sessionStorage.setItem('before_url',beforUrl)
        setTimeout(()=>{
            location.href = '/login';
        },1500)
    }
    function updateCurrentPageUi(){

        let urlParts = targetUrl.split('?')[0].split('/');
        let path = '/' + urlParts.slice(3).join('/');
        if(path === '/product/list'){
                getWhishlistProductList();
                if(!document.querySelector('.btn__box.list__btn').classList.contains('select')){
                    document.querySelector('.btn__box.list__btn').click();
                }
        } else if(path === '/product/detail'){
            changeModuleWishBtn(targetProductIdx)
            if(!document.querySelector('.btn__box.list__btn').classList.contains('select')){
                document.querySelector('.btn__box.list__btn').click();
            }
        } else if(path === '/mypage') {
            wish.update();

        } else if(targetUrl.includes('/order/whish')) {
            getWhishProductList();
        }
    }
    function changeModuleWishBtn(param) {
        let $$wishBtn = document.querySelectorAll('.wish__btn');
        $$wishBtn.forEach((el) => {
            if(el.getAttribute('product_idx') == param){
                if(clickTarget.querySelector('img').dataset.status == 'true'){
                    el.querySelector('img').dataset.status = true;
                    el.querySelector('img').setAttribute('src', '/images/svg/wishlist-bk.svg');
                }else {
                    el.querySelector('img').dataset.status = false;
                    el.querySelector('img').setAttribute('src', '/images/svg/wishlist.svg');
                }
            }
        })
        getWhishlistProductList();
    }
    //선택한 하트의 색상, 상태 반영 
    function changeStatusWishBtn() {
        clickTarget.querySelector('img').style.width = '19px';
        if(clickTarget.querySelector('img').dataset.status == 'true'){
            clickTarget.querySelector('img').dataset.status = false;
            clickTarget.querySelector('img').setAttribute('src', '/images/svg/wishlist.svg');
            heartDeleteWishApi(targetProductIdx);

        }else {
            clickTarget.querySelector('img').dataset.status = true;
            clickTarget.querySelector('img').setAttribute('src', '/images/svg/wishlist-bk.svg');
            addWishApi(targetProductIdx,clickTarget);
        }
    }
    function addWishApi(productIdx,target){
        if (productIdx != null) {
            $.ajax({
                type: "post",
                data: {
                    "product_idx": productIdx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/whish/add",
                error: function () {
                    alert("위시리스트 등록/해제 처리에 실패했습니다.");
                },
                success: function (d) {
                    let code = d.code;
                    let msg = d.msg;
                    let data =  d.data;
                    if (code == "200") {
                        document.querySelector('.header__wrap .wishlist__btn').dataset.cnt = data;
                        updateCurrentPageUi();
                    }
                    
                }
            });
        }
    }
    function heartDeleteWishApi(productIdx){
        console.log('heartDeleteWishApi')
        if (productIdx != null) {
            $.ajax({
                type: "post",
                data: {
                    "product_idx": productIdx
                },
                dataType: "json",
                url: "http://116.124.128.246:80/_api/order/whish/delete",
                error: function () {
                    alert("위시리스트 등록/해제 처리에 실패했습니다.");
                },
                success: function (d) {
                    let code = d.code;
                    let msg = d.msg;
                    let data =  d.data;
                    if (code == "200") {
                        document.querySelector('.header__wrap .wishlist__btn').dataset.cnt = data;
                        updateCurrentPageUi();
                        
                    }
                }
            });
        }
    }   
}
/**
 * 
 * @param {*} obj 
 * @description 상품의 x표일시 사용되는 delete함수
 */
const deleteWhish = (obj) => {
    console.log("🏂 ~ file: common.js:393 ~ deleteWhish ~ deleteWhish:")
    let product_idx = $(obj).attr('product_idx');
    let basket_wrap = $(obj).parent().parent();
    let whish_list_cnt = document.querySelectorAll('.whish_list_mp').length;
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

                if (code == "200") {
                    basket_wrap.remove();
                    changeWishBtnStatus(product_idx);
                    if(whish_list_cnt == 1) {
                        let swiperContainer = document.querySelector(".swiper-grid");
                        let swiperMsgWrap = document.createElement("div");
                        swiperMsgWrap.className = "no_whishlist_msg";
                        swiperMsgWrap.textContent = "위시리스트가 비어있습니다."
                        swiperContainer.appendChild(swiperMsgWrap);
                    }
                    document.querySelector('.header__wrap .wishlist__btn').dataset.cnt = d.data;
                }
                function changeWishBtnStatus(params) {
                    let $$wishBtn = document.querySelectorAll('.wish__btn');
                    $$wishBtn.forEach((el) => {
                        if(el.getAttribute('product_idx') == product_idx){
                            el.querySelector('img').dataset.status = false;
                            el.querySelector('img').setAttribute('src', '/images/svg/wishlist.svg');
                        }
                })
                }
            }
        });
    }
}
/*------------------------------------------- 위시리스트 ------------------------------------------- */



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

/**
 * @author SIMJAE
 * @param {Object} product
 * @description 최근 본 상품 기록 10개로 갯수제한 
 */
function saveRecentlyViewed(product) {
    product.product_idx = parseInt(product.product_idx)
    const keyName = "recentlyViewed";
    let recentlyViewed = localStorage.getItem('recentlyViewed');
    recentlyViewed = recentlyViewed ? new Set(JSON.parse(recentlyViewed)) : new Set();

    const prevValue = JSON.parse(localStorage.getItem(keyName));
    if (recentlyViewed.has(JSON.stringify(product.product_idx))) {
        // 이미 존재하는 상품이면 삭제 후 다시 추가하여 가장 최신 상품으로 보이도록 함
        recentlyViewed.delete(JSON.stringify(product.product_idx));
    }
    recentlyViewed.add(JSON.stringify(product));

    if (recentlyViewed.size > 10) {
        // 최근 본 상품이 10개를 초과하면 가장 오래된 상품 삭제
        const iterator = recentlyViewed.values();
        recentlyViewed.delete(iterator.next().value);
    }

    localStorage.setItem(keyName, JSON.stringify(Array.from(recentlyViewed)));
    let recentlyresultReverse;
    if (JSON.stringify(Array.from(recentlyViewed)) !== JSON.stringify(prevValue)) {
        recentlyresultReverse = Array.from(recentlyViewed).reverse();
    }
    recentlyresultReverse = Array.from(recentlyViewed).reverse();
    return recentlyresultReverse;
}
/**
 * @author SIMJAE
 * @description 번역할 json데이터 불러오는 fetch
 */
let krdata,endata,cndata;
const lang = getLanguage(); 
const krLnData = (() => {
    return fetch('http://116.124.128.246/scripts/i18n/KR.json')
    .then(response => response.json())
    .then(data => {
        krdata = data; 
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
})();
const enLnData = (() => {
    return fetch('http://116.124.128.246/scripts/i18n/EN.json')
    .then(response => response.json())
    .then(data => {
        endata = data; 
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
})();
const cnLnData = (() => {
    return fetch('http://116.124.128.246/scripts/i18n/CN.json')
    .then(response => response.json())
    .then(data => {
        cndata = data; 
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
})();
/**
 * @author SIMJAE
 * @description i18next라이브러리로 불러온 json기반으로 다국어 변경
 */
function changeLanguage(){
    const ln = localStorage.getItem('lang') || getLanguage();
    
    i18next.init({
        lng: ln,
        resources: {
            KR: {
                translation: krdata
            },
            EN: {
                translation: endata
            },
            CN: {
                translation: cndata
            },
        },
    },
    
	function(){
        changeText();
        changePlaceholder();
    });
    
    i18next.on('languageChanged', function(lng) {
        localStorage.setItem('lang', lng);
        changeText();
        changePlaceholder();
    });
	
    function changeText(){
        const elements = document.querySelectorAll('[data-i18n]');
        elements.forEach(el => {
            const key = el.dataset.i18n;
            el.textContent = i18next.t(key);
        });
    }
	
    function changePlaceholder(){
        const elements = document.querySelectorAll('[data-i18n-placeholder]');
        elements.forEach(el => {
            const key = el.dataset.i18nPlaceholder;
            el.placeholder = i18next.t(key);
        });
    }
	
    return ln;
}
/**
 * @author YOON
 * @description 새로고침시 재번역
 */
function changeLanguageR() {
    // const ln = localStorage.getItem('lang') || getLanguage();
    const elements = document.querySelectorAll('[data-i18n]');
    elements.forEach(el => {
        const key = el.dataset.i18n;
        el.textContent = i18next.t(key);
    });
}
/**
 * @author SIMJAE
 * @description 디바운스 구현
 */
function debounce(func, delay) {
    let timerId;
    return function(...args) {
        if (timerId) {
        clearTimeout(timerId);
        }
        timerId = setTimeout(() => {
        func(...args);
        timerId = null;
        }, delay);
    };
}
/**
 * @author SIMJAE
 * @description 스로틀링 구현
 */
function throttle(func, interval) {
    let lastTime = 0;
    return function(...args) {
        const now = new Date().getTime();
        if (now - lastTime >= interval) {
        func(...args);
        lastTime = now;
        }
    };
}

function getLanguage() {
    let local_lng = localStorage.getItem('lang');
	if (!local_lng) {
		let country = navigator.language || navigator.userLanguage;
		switch (country) {
			case "ko-KR" :
				local_lng = "KR";
				break;
			
			case "zh-CN" :
				local_lng = "CN";
				break;
			
			default :
				local_lng = "EU";
				break
		}
	}
    
	return local_lng;
}
function xssDecode(data){
    var decode_str = null;
    if(data != null){
        decode_str = data.replace(/&amp;/g, '&');
        decode_str = decode_str.replace(/&quot;/g, '\"');
        decode_str = decode_str.replace(/&apos;/g, "'");
        decode_str = decode_str.replace(/&lt;/g, '<');
        decode_str = decode_str.replace(/&gt;/g, '>');
        decode_str = decode_str.replace(/<br>/g, '\r');
        decode_str = decode_str.replace(/<p>/g, '\n');
    }
    
    return decode_str;
}

window.addEventListener("DOMContentLoaded", function () {
    createFooterObserver();
    
})
window.addEventListener("load", function(){
    changeLanguage(); 
})

