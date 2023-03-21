<link rel=stylesheet href='/css/store/main.css' type='text/css'>
<main>
    
    <section class="store-section map">
        <div class="seacrh-header-wrap">
            <div class="search-header">
                <img class="search-svg" src="/images/svg/search.svg" alt="">
                <input id="store-search-input" type="search" placeholder="위치 검색">
                <div class="clear-btn">
                    <img src="/images/svg/reset.svg" alt="">
                    <span>clear</span>
                </div>
            </div>
            <div class="my-place">현재 위치로 검색하기</div>
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
        <div class="find-store-btn"><div>매장 찾기로 이동</div></div>
    </article>
</main>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu8oQmePk_LBTpfICgZ2xUbUt31RkqX4o&libraries=places&callback=initMap"></script>
<script src="/scripts/store/list.js"></script>