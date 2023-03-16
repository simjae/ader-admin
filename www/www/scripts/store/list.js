const getStoreList = () => {
    let country = getLanguage();
    $.ajax({
        type: "post",
        url: "http://116.124.128.246/_api/store/list/get",
        data: {
            'country': country,
            'store_keyword':''
        },
        async: false,
        dataType: "json",
        error: function() {
            alert('컬렉션 프로젝트 조회처리중 오류가 발생했습니다.');
        },
        success: function(d) {
            result = d.data;
        }
    });
    return result;
}
const getStoreLocationList = () => {
    let country = getLanguage();
    $.ajax({
        type: "post",
        url: "http://116.124.128.246/_api/store/location/get",
        data: {
            'country': country
        },
        async: false,
        dataType: "json",
        error: function() {
            alert('컬렉션 프로젝트 조회처리중 오류가 발생했습니다.');
        },
        success: function(d) {
            result = d.data;
        }
    });
    return result;
}
// 검색결과 반환
const getSearchStoreList = async (search) => {
    
    let search_data = search === undefined ? '': search;
    let country = getLanguage();

    try {
        const response = await $.ajax({
            type: "post",
            url: "http://116.124.128.246/_api/store/list/get",
            data: {
                'country': country,
                'store_keyword':search_data
            },
            dataType: "json"
        });
        return response.data;
    } catch (error) {
        console.error('컬렉션 프로젝트 조회처리중 오류가 발생했습니다.', error);
        throw error;
    }
}
async function searchResult(e) {
    let data = e.target.value;
    let result;

    try {
        result = await getSearchStoreList(data);
        
        document.querySelector('#web-detail-wrap').innerHTML = '';
        document.querySelector('#store-mobile-modal').innerHTML = '';
        initStore(result)
    } catch (error) {
        console.error(error);
    }
}

class MainResult {
    constructor(info) {
        this.info = info;
    }
    getContent() {
        return this.info
    }
    loadContent(){
        document.querySelector('#result-article .store-section.main .store-body').innerHTML = '';
        if(this.info.store_type == "SPC"){
            document.querySelector('#result-article .store-section.main .store-body').appendChild(makeMainResultHtml(this.info));
        }else if(this.info.store_type == "PLG"){
            document.querySelector('#result-article .store-section.main .store-body').appendChild(makeMainResultHtml(this.info));
        }
        let lookbookDetailSwiper = new Swiper(".storeResult-swiper", {
            slidesPerView: 'auto',
            slidesPerView: 1,
            navigation: {
                nextEl: ".storeResult-swiper .swiper-button-next",
                prevEl: ".storeResult-swiper .swiper-button-prev",
            }
        })
    }
    display() {
        
    }
}
class SideResult {
    constructor(space_info, plugshop_info, stockist_info, clicked_idx, clicked_type) {
        this.space_info = space_info.filter(item => item.store_idx !== clicked_idx || item.store_type !== clicked_type);
        this.plugshop_info = plugshop_info.filter(item => item.store_idx !== clicked_idx || item.store_type !== clicked_type);
        this.stockist_info = stockist_info;
    }
    getSpaceInfo() {
        return this.space_info;
    }
    getPlugshopInfo() {
        return this.plugshop_info;
    }
    loadSpaceInfo(){
        let spaceInfo = this.space_info
        document.querySelector('#result-article .store-section.brand-store .store-body').innerHTML = '';
        spaceInfo.forEach(space => {
            document.querySelector('#result-article .store-section.brand-store .store-body').appendChild(makeSpaceHtml(space));
        });
    }
    loadPlugshopInfo(){
        let plugshopInfo = this.plugshop_info
        document.querySelector('#result-article .store-section.plug-store .store-body').innerHTML = '';
        plugshopInfo.forEach(plug => {
            document.querySelector('#result-article .store-section.plug-store .store-body').appendChild(makePlugHtml(plug));
        });
    }
    
    display() {
        
        
        
    }
}
let map;
let centerCoordinates = { lat: 37.5400456, lng: 126.9921017 };
let storeShopData;
let mapMarkers;
let markers = []; // 마커 객체들을 저장하는 전역 배열 변수

function initMap() {
    //아이콘
    //말품선객체
    const infoWindow = new google.maps.InfoWindow();
    //검색 디바운스
    // const searchInput = document.querySelector('#store-search-input');
    // searchInput.addEventListener('input', debounce(searchInputEvent, 500));
    // 지도 테마 객체
    const grayStyle = [{
            "elementType": "geometry",
            "stylers": [{
                "color": "#f5f5f5"
            }]
        },
        {
            "elementType": "labels.icon",
            "stylers": [{
                "visibility": "off"
            }]
        },
        {
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#616161"
            }]
        },
        {
            "elementType": "labels.text.stroke",
            "stylers": [{
                "color": "#f5f5f5"
            }]
        },
        {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#bdbdbd"
            }]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [{
                "color": "#eeeeee"
            }]
        },
        {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#757575"
            }]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [{
                "color": "#e5e5e5"
            }]
        },
        {
            "featureType": "poi.park",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#9e9e9e"
            }]
        },
        {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [{
                "color": "#ffffff"
            }]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#757575"
            }]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [{
                "color": "#dadada"
            }]
        },
        {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#616161"
            }]
        },
        {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#9e9e9e"
            }]
        },
        {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [{
                "color": "#e5e5e5"
            }]
        },
        {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [{
                "color": "#eeeeee"
            }]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [{
                "color": "#c9c9c9"
            }]
        },
        {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#9e9e9e"
            }]
        }
    ];
    var request = {
        location: centerCoordinates,
        radius: '5000',
        query: ''
    };
    //지도 초기화 
    map = new google.maps.Map(document.getElementById("map"), {
        center: centerCoordinates,
        zoom: 12,
        styles: grayStyle
        // panControl: false,
        // // zoomControl: true,
        // mapTypeControl: false,
        // scaleControl: true,
        // streetViewControl: false,
        // overviewMapControl: false,
    });
    const service = new google.maps.places.PlacesService(map);
    
    // map.fitBounds(bounds);
}
async function initmarker(data){
    const bounds = new google.maps.LatLngBounds();
    const newData = [];
    const beachFlagImg = "http://116.124.128.246:80/images/svg/map-marker.svg";
    
    if (Array.isArray(data.space_info) && data.space_info.length) {
        data.space_info.forEach(({ store_idx, lat, lng, store_type }) => {
            newData.push({
                store_idx:store_idx,
                lat:lat,
                lng :lng,
                store_type:store_type
            });
        });
        
    }
    if (Array.isArray(data.plugshop_info) && data.plugshop_info.length) {
        data.plugshop_info.forEach(({ store_idx, lat, lng, store_type }) => {
            newData.push({
                store_idx:store_idx,
                lat:lat,
                lng :lng,
                store_type:store_type
            });
        });
    }
    if (Array.isArray(data.stockist_info) && data.stockist_info.length) {
        data.stockist_info.forEach(({ store_idx, lat, lng, store_type }) => {
            newData.push({
                store_idx:store_idx,
                lat:lat,
                lng :lng,
                store_type:store_type
            });
        });
    }
    
    
    newData.forEach(({ store_idx, lat, lng, store_type }, idx) => {
        lng = parseFloat(lng)
        lat = parseFloat(lat)
        const marker = new google.maps.Marker({
            position: { lat, lng },
            map,
            icon: beachFlagImg,
            idx: store_idx,
            scaledSize:{
                width:  100,
                height: 100
            },
            store_type: store_type

        });
        bounds.extend(marker.position);
        const closeBtn = document.createElement('div');
        
        closeBtn.className = 'map-open__close-btn';
        closeBtn.innerHTML = 
        `
            <svg xmlns="http://www.w3.org/2000/svg" width="12.707" height="12.707" viewBox="0 0 12.707 12.707">
                <path data-name="선 1772" transform="rotate(135 6.103 2.736)" style="fill:none;stroke:#343434" d="M16.969 0 0 .001"></path>
                <path data-name="선 1787" transform="rotate(45 -.25 .606)" style="fill:none;stroke:#343434" d="M16.969.001 0 0"></path>
            </svg>
        `;
        
        marker.addListener("click", function(e) {
            
            mobileOpenResult();
            map.panTo(marker.position);
            const banners = document.querySelectorAll('.banner');
            banners.forEach(el => {
                if (this.idx == el.dataset.store_idx && this.store_type == el.dataset.store_type) {
                    let cloneNode = el.cloneNode(true);
                    if (window.matchMedia('screen and (min-width:1025px)').matches === true) {
                        document.querySelector('#web-detail-wrap').innerHTML = '';
                        document.querySelector('#web-detail-wrap').appendChild(cloneNode);
                        document.querySelector('#web-detail-wrap').appendChild(closeBtn);
                        closeBtn.addEventListener('click', function(){
                            document.querySelector('#web-detail-wrap').innerHTML = '';
                        })
                    } else if (window.matchMedia('screen and (min-width:1025px)').matches === false) {
                        document.querySelector('#store-mobile-modal').innerHTML = '';
                        document.querySelector('#store-mobile-modal').appendChild(cloneNode);
                        document.querySelector('#store-mobile-modal .banner').appendChild(closeBtn);
                        closeBtn.addEventListener('click', function(){
                            document.querySelector('#dimmer').classList.remove('show');
                            document.querySelector('#store-mobile-modal').innerHTML = '';
                            document.querySelector('#store-mobile-modal').classList.remove('open');
                        })
                    };
                    
                }
            })

            detailBtnEvent(storeShopData);
        });
        markers.push(marker);
    });
    
}
function mobileModalCloseBtn(){
    let closeBtn = document.querySelector('.map-open__close-btn');
    closeBtn.addEventListener('click',modalClose);
    
    function modalClose(){
        document.querySelector("#store-mobile-modal").classList.remove('open');
    }

}

function detailBtnEvent(data) {
    let $$detailViewBtn = document.querySelectorAll('.detail-view-btn');
    const result = document.querySelector('#result-article');
    
    $$detailViewBtn.forEach(el => el.addEventListener('click', function(e) {
        let storeIdx = parseInt(e.target.parentElement.dataset.store_idx);
        let storeType = e.target.parentElement.dataset.store_type;
        
        renderDetailWrap(storeIdx,storeType);

    }));
}
function makeSpaceHtml(data) {
    let {
        contents_info,
        country,
        instagram_id,
        store_addr,
        store_idx,
        store_link,
        store_name,
        store_sale_date,
        store_tel,
        store_type,
        lat,
        lng
    } = data;
    let spaceArticle = document.createElement("article");
    let innerHtml =
    `
        <figure>
            <img class="banner-img" data-src="${contents_info[0].contents_location}" src="http://116.124.128.246:81${contents_info[0].contents_location}">
            <figcaption>
                <div class="store-name-box">
                    <div class="store_name">${store_name}</div>
                    <a class="instagram-logo" href="https://www.instagram.com/${instagram_id}/" target='_blank'><img src="/images/svg/store-instagram.svg" alt=""></a>
                </div>
                <div class="store_addr-box">
                    <div class="store_addr">${store_addr}</div>
                    <a href="https://google.com/maps/?q=${lat},${lng}" target='_blank'><div class="addr-svg" data-link=""><img src="/images/svg/store-addr.svg" alt=""><span>위치보기</span></div></a>
                </div>
                <div class="store_tel">051-802-2203</div>
                <div class="store_open_date">${store_sale_date}</div>
            </figcaption>
        </figure>
        <div class="detail-view-btn">자세히 보기</div>
    `;
    spaceArticle.className = "banner";
    spaceArticle.dataset.store_idx = store_idx;
    spaceArticle.dataset.store_type = store_type;
    spaceArticle.innerHTML = innerHtml;
    return spaceArticle;
}
function makePlugHtml(data) {
    let {
        contents_info,
        country,
        instagram_id,
        store_addr,
        store_idx,
        store_link,
        store_name,
        store_sale_date,
        store_tel,
        store_type,
        lat,
        lng
    } = data;
    let spaceArticle = document.createElement("article");
    let innerHtml =
        `
            <figure>
                <img class="banner-img" data-src="${contents_info[0].contents_location}" src="http://116.124.128.246:81${contents_info[0].contents_location}" >
                <figcaption>
                    <div class="store-name-box">
                        <div class="store_name">${store_name}</div>
                        <a class="instagram-logo" href="https://www.instagram.com/${instagram_id}/"><img src="/images/svg/store-instagram.svg" alt=""></a>
                    </div>
                    <div class="store_addr-box">
                        <div class="store_addr">${store_addr}</div>
                        <a href="https://google.com/maps/?q=${lat},${lng}" target='_blank'><div class="addr-svg" data-link=""><img src="/images/svg/store-addr.svg" alt=""><span>위치보기</span></div></a>
                    </div>
                    <div class="store_tel">051-802-2203</div>
                    <div class="store_open_date">${store_sale_date}</div>
                </figcaption>
            </figure>
            <div class="detail-view-btn"><a href="">자세히 보기</a></div>
        `;
    spaceArticle.className = "banner";
    spaceArticle.innerHTML = innerHtml;
    spaceArticle.dataset.store_idx = store_idx;
    spaceArticle.dataset.store_type = store_type;
    return spaceArticle;
}
function makeStockistHtml(data) {
    let {
        country,
        instagram_id,
        store_addr,
        store_idx,
        store_link,
        store_name,
        store_sale_date,
        store_tel,
        store_type,
        lat,
        lng
    } = data;
    let stockistArticle = document.createElement("article");
    let innerHtml;

    innerHtml =
    `
        <div class="store-name-box">
            <div class="store_name">${store_name}</div>
            <a class="instagram-logo" href="https://www.instagram.com/${instagram_id}/"><img src="/images/svg/store-instagram.svg" alt=""></a>
        </div>
        <div class="store_addr-box">
            <div class="store_addr">${store_addr}</div>
            <a href="https://google.com/maps/?q=${lat},${lng}" target='_blank'><div class="addr-svg" data-link=""><img src="/images/svg/store-addr.svg" alt=""><span>위치보기</span></div></a>
        </div>
        <div class="store_tel">${store_tel === null ? '' : store_tel}</div>
    `;
    if (country === '온라인') {
        innerHtml =
        `
            <div class="store-name-box">
                <div class="store_name">${store_name}</div>
            </div>
            <div class="store_addr-box">
                <div class="store_link">${store_link}</div>
            </div>
        `;
    }
    stockistArticle.className = "banner";
    stockistArticle.innerHTML = innerHtml;
    stockistArticle.dataset.country = country;
    stockistArticle.dataset.store_idx = store_idx;
    stockistArticle.dataset.store_type = store_type;
    return stockistArticle;
}
function stockistCountry(data) {
    let countrySet = new Set();
    let stockistArr = [];
    data.forEach((el) => {
        countrySet.add(el.country)
        stockistArr.push(makeStockistHtml(el));
    })
    let countryArr = Array.from(countrySet);


    let stockistFlag = document.createDocumentFragment("div");


    countryArr.forEach(el => {
        let stockistWrap = document.createElement("div");
        stockistWrap.className = 'stockist-country-wrap';
        let stockistCountry = document.createElement("div");
        let stockistBody = document.createElement("div");
        stockistCountry.className = 'stockist-country-header';
        stockistBody.className = 'stockist-country-body';
        stockistCountry.innerHTML = el;
        stockistBody.dataset.country = el;

        stockistWrap.appendChild(stockistCountry);
        stockistWrap.appendChild(stockistBody);
        stockistFlag.appendChild(stockistWrap);
    });

    stockistArr.forEach(el => {
        let $$flagCountry = stockistFlag.querySelectorAll('.stockist-country-body');
        $$flagCountry.forEach(cn => {
            if (el.dataset.country == cn.dataset.country) {
                cn.appendChild(el);
            }
        })
    });
    document.querySelector('.store-section.stockist-store').innerHTML = '';
    document.querySelector('.store-section.stockist-store').appendChild(stockistFlag);
}
function makeMainResultHtml(data) {
    let { contents_info, country, instagram_id, store_addr, store_idx, store_link, store_name, store_sale_date, store_tel, store_type } = data;
    let backgroundHtml = '';
    let spaceArticle = document.createElement("article");
    spaceArticle.className = "banner";
    spaceArticle.dataset.store_idx = store_idx;
    spaceArticle.dataset.store_type = store_type;
    let imgdata = contents_info;
    imgdata.forEach((el,idx) => {
        let backgroundType = el.contents_location.split('.', 2)[1];
        if (backgroundType === "mp4") {
            backgroundHtml += 
            `
                <div class="swiper-slide vplayer">
                    <video id="video-coustom-${idx}" autoplay muted loop playsinline src="http://116.124.128.246:81${el.contents_location}" "></video>
                </div>
            `
        } else {
            backgroundHtml +=
            `
                <div class="swiper-slide">
                    <img class="object-fit" src="http://116.124.128.246:81${el.contents_location}" ">
                </div>
            `
        }
    })
    let innerHtml =
        `
        <div class="storeResult-swiper swiper">
            <div class="swiper-wrapper">
                ${backgroundHtml}
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
            <figure>
                <figcaption>
                    <div class="store-name-box">
                        <div class="store_name">${store_name}</div>
                        <a href=""><img src="/images/svg/store-instagram.svg" alt=""></a>
                    </div>
                    <div class="store_addr-box">
                        <div class="store_addr">${store_addr}</div>
                        <div class="addr-svg" data-link=""><img src="/images/svg/store-addr.svg" alt=""><span>위치보기</span></div>
                    </div>
                    <div class="store_tel">051-802-2203</div>
                    <div class="store_open_date">${store_sale_date}</div>
                </figcaption>
            </figure>
        `;
    
    spaceArticle.innerHTML = innerHtml;
    
    return spaceArticle;
}
function renderDetailWrap(storeIdx,storeType){
    const result = document.querySelector('#result-article');
    const findStoreBtn = document.querySelector('.find-store-btn');
    findStoreBtn.addEventListener('click', function() {
        result.classList.add('hidden'); 
        document.querySelector('body').style.overflow = 'inherit';
    });
    let clicked_item;
    if(storeType == 'SPC'){
        clicked_item = storeShopData.space_info.find(item => item.store_idx === storeIdx && item.store_type === storeType);
    }else if(storeType == 'PLG' ) {
        clicked_item = storeShopData.plugshop_info.find(item => item.store_idx === storeIdx && item.store_type === storeType);
    }
    let main = new MainResult(clicked_item);
    let side = new SideResult(storeShopData.space_info, storeShopData.plugshop_info, storeShopData.stockist_info, storeIdx,storeType);

    let main_info = main.getContent();
    let space_info = side.getSpaceInfo();
    let plugshop_info = side.getPlugshopInfo();
    main.loadContent();
    side.loadSpaceInfo();
    side.loadPlugshopInfo();
    let video = new Vctrbox('.vplayer')


    detailBtnEvent(storeShopData);
    result.classList.remove('hidden');
    document.querySelector('body').style.overflow = 'hidden';
}
function deleteMarker(){
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
} 

function mobileOpenResult() {
    if (window.matchMedia('screen and (min-width:1025px)').matches === true) {
        document.querySelector('#dimmer').classList.remove('show');
        document.querySelector('#store-mobile-modal').classList.remove('open');
    } else if (window.matchMedia('screen and (min-width:1025px)').matches === false) {
        document.querySelector('#dimmer').classList.add('show');
        document.querySelector('#store-mobile-modal').classList.add('open');
    };
}
async function initStore(data) {
    const searchInput = document.querySelector('#store-search-input');
    const clear = document.querySelector('.clear-btn');
    searchInput.addEventListener('input', debounce(searchResult, 500));


    clear.addEventListener('click', function(){
        searchInput.value = "";
        initStore();
    });
    try {
        if(data === undefined){
            
            storeShopData = await getSearchStoreList();
            await initmarker(storeShopData);
        }else{
            storeShopData = data;
            deleteMarker();
            await initmarker(storeShopData);
        }
        
        let { space_info, plugshop_info, stockist_info } = storeShopData;
        
        document.querySelector('.store-section.brand-store .store-body').innerHTML = '';
        document.querySelector('.store-section.plug-store .store-body').innerHTML = '';
        if(space_info.length > 0){
            space_info.forEach(space => {
                document.querySelector('.store-section.brand-store .store-body').appendChild(makeSpaceHtml(space));
                document.querySelector('.store-section.brand-store .store-title').style.display='block';
                document.querySelector('.store-section.brand-store .store-subtitle').style.display='block';
            });
        }else {
            document.querySelector('.store-section.brand-store .store-title').style.display='none';
            document.querySelector('.store-section.brand-store .store-subtitle').style.display='none';
            
        }
        
        if(plugshop_info.length > 0){
            plugshop_info.forEach(plug => {
                document.querySelector('.store-section.plug-store .store-body').appendChild(makePlugHtml(plug));
                document.querySelector('.store-section.plug-store .store-subtitle').style.display='block';
            });
        }else {
            document.querySelector('.store-section.plug-store .store-subtitle').style.display='none';
        }
        stockistCountry(stockist_info);
        detailBtnEvent(storeShopData);
    } catch (error) {
        console.error(error);
    }
    
}
initStore();
window.initMap = initMap;

