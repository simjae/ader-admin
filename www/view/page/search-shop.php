<link rel=stylesheet href='/css/store/main.css' type='text/css'>
<style>
    #map .gmnoprint{
        display: none;
    }
    #store-mobile-modal{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffffff;
        width: 100%;
        padding: 10px;
        z-index: 20;
    }
    #result-article.hidden {
        display: none;
    }
    @media (max-width: 1025px) {
        #web-detail-wrap{
            display: none;
        }
        #store-mobile-modal{
            display: flex;
        }
        #store-mobile-modal.hidden{
            display: none;
        }
    }
    #result-article {
        position: fixed;
        top: 50px;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow-y: auto;
        background-color: #ffffff;
        
    }
    #result-article .result-article-wrap{
        display: grid;
        grid-template-columns: repeat(16, 1fr);
    }
    #result-article .find-store-btn{
        grid-column: 2/15;
        margin-bottom: 100px;
    }
    #result-article::-webkit-scrollbar {
        width: 4px;
    }

    #result-article::-webkit-scrollbar-thumb {
        background-color: #dcdcdc;
        border-radius: 10px;
    }

    #result-article::-webkit-scrollbar-track {
        background-color: rgb(255 255 255 / 0%);
    }
    #result-article .store-section.main{
        padding: 100px 0;
    }
    #result-article .store-section.main .banner{
        display: flex;
        max-width: 100%;
        border: 0;
        padding: 0;
        gap: 60px;
    }
    #result-article .store-section.main .banner figure{
        display: flex;
        align-items: flex-end;
    }
    #result-article .store-section.main .banner figure figcaption{
        margin-bottom: 15px;
    }
    #result-article .store-section.main .banner .storeResult-swiper{
        max-width: 1310px;
        margin: 0;
    }
    #result-article .swiper-button-prev::after {
        content: url('/images/svg/shop-l-wh.svg');
        left: 5px;
        height: 70px;
    }
    #result-article .swiper-button-next::after {
        content: url('/images/svg/shop-r-wh.svg');
        left: 5px;
        height: 60px;
        transform: rotate(180deg);
    }
    
    
</style>
<main>
    <section class="store-section map">
        <div class="seacrh-header-wrap">
            <div class="search-header">
                <img class="search-svg" src="/images/svg/search.svg" alt="">
                <input id="store-search-input" type="search" placeholder="위치 검색">
            </div>
            <div>현재 위치로 검색하기</div>
        </div>
        <div class="search-body">
            <div id="map"></div>
            <div id="web-detail-wrap"></div>
        </div>
    </section>
    <section class="store-section brand-store"> 
        <div class="store-header">
            <div class="store-title">브랜드 스토어</div>
            <div class="store-subtitle">스페이스</div>
        </div>
        <div class="store-body"></div>
    </section>
    <section class="store-section plug-store">
        <div class="store-header">
            <div class="store-subtitle">플러그샵</div>
        </div>
        <div class="store-body"></div>
    </section>
    <section class="store-section stockist-store"></section>
    <section id="store-mobile-modal" class="store-section hidden"></section>
    <article id="result-article" class="hidden">
        <div class="result-article-wrap">
            <section class="store-section main">
                <div class="store-body"></div>
            </section>
            <section class="store-section brand-store">
                <div class="store-header">
                    <div class="store-title">브랜드 스토어</div>
                    <div class="store-subtitle">스페이스</div>
                </div>
                <div class="store-body"></div>
            </section>
            <section class="store-section plug-store">
                    <div class="store-header">
                        <div class="store-subtitle">플러그샵</div>
                    </div>
                    <div class="store-body"></div>
            </section>
        </div>
        <div class="find-store-btn">매장 찾기로 이동 </div>
    </article>
</main>
<script>
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
        console.log("🏂 ~ file: search-shop.php:190 ~ getSearchStoreList ~ search:", search)
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
            console.log("🏂 ~ file: search-shop.php:201 ~ searchResult ~ result:", result);
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
            console.log(`클릭한 요소의 정보: ${JSON.stringify(this.info)}`);
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
            console.log(`space_info: ${JSON.stringify(this.space_info)}`);
            console.log(`plugshop_info: ${JSON.stringify(this.plugshop_info)}`);
            console.log(`stockist_info: ${JSON.stringify(this.stockist_info)}`);
        }
    }
    let map;
    let centerCoordinates = { lat: 37.5400456, lng: 126.9921017 };
    let storeShopData;
    let mapMarkers;
    let markers = []; // 마커 객체들을 저장하는 전역 배열 변수
    console.log("🏂 ~ file: search-shop.php:287 ~ markers:", markers)
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
            styles: grayStyle,
            panControl: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            overviewMapControl: false,
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
        console.log(newData)
        
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
            marker.addListener("click", function(e) {
                console.log("🏂 ~ file: search-shop.php:490 ~ marker.addListener ~ marker:", marker)
                map.panTo(marker.position);
                const banners = document.querySelectorAll('.banner');
                banners.forEach(el => {
                    if (this.idx == el.dataset.store_idx && this.store_type == el.dataset.store_type) {
                        let cloneNode = el.cloneNode(true);
                        if (window.matchMedia('screen and (min-width:1025px)').matches === true) {
                            document.querySelector('#web-detail-wrap').innerHTML = '';
                            document.querySelector('#web-detail-wrap').appendChild(cloneNode);
                        } else if (window.matchMedia('screen and (min-width:1025px)').matches === false) {
                            document.querySelector('#store-mobile-modal').innerHTML = '';
                            document.querySelector('#store-mobile-modal').appendChild(cloneNode);
                        };
                    }
                })
                detailBtnEvent(storeShopData);
            });
            markers.push(marker);
        });
        
    }
    window.initMap = initMap;


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
            store_type
        } = data;
        let spaceArticle = document.createElement("article");
        let innerHtml =
        `
            <figure>
                <img class="banner-img" data-src="${contents_info[0].contents_location}" src="http://116.124.128.246:81${contents_info[0].contents_location}">
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
            <div class="detail-view-btn"><a href="">자세히 보기</a></div>
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
            store_type
        } = data;
        let spaceArticle = document.createElement("article");
        let innerHtml =
            `
                <figure>
                    <img class="banner-img" data-src="${contents_info[0].contents_location}" src="http://116.124.128.246:81${contents_info[0].contents_location}" >
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
            store_type
        } = data;
        let stockistArticle = document.createElement("article");
        let innerHtml;

        innerHtml =
        `
            <div class="store-name-box">
                <div class="store_name">${store_name}</div>
                <a href=""><img src="/images/svg/store-instagram.svg" alt=""></a>
            </div>
            <div class="store_addr-box">
                <div class="store_addr">${store_addr}</div>
                <div class="addr-svg" data-link=""><img src="/images/svg/store-addr.svg" alt=""><span>위치보기</span></div>
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

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

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
    async function initStore(data) {
        const searchInput = document.querySelector('#store-search-input');
        searchInput.addEventListener('input', debounce(searchResult, 500));
        try {
            if(data === undefined){
                
                storeShopData = await getSearchStoreList();
                deleteMarker();
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


</script>