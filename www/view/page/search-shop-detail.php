<style>
    main{ padding-top: 50px; overflow-x: hidden; display: grid; grid-template-columns: repeat(16,1fr); }


    .store-section.map { margin-top: 100px;}
    .store-section .search-header{    display: flex; gap: 10px; border-bottom: 1px solid #dcdcdc; max-width: 710px; margin-bottom: 15px;}
    .store-section .search-body{ display: flex; gap: 130px; justify-content: space-between; margin-bottom: 100px; margin-top: 50px;}
    #map { width: 950px; height: 534.4px; border: 1px solid #dcdcdc; display: flex;    align-items: center; justify-content: center;}
    .store-section { grid-column: 2/15; }

    .store-section.brand-store { margin-bottom: 40px;}
    .store-section.map { grid-column: 2/16; }


    .web-detail-wrap .banner{height: 100%; border: 0px; padding: 0;}


    .store-section .store-title{  font-size: 13px; font-weight: 500; font-stretch: normal; font-style: normal; line-height: 1.46; letter-spacing: normal; text-align: left; color: #343434; margin-bottom: 40px;}
    .store-section .store-subtitle {  font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 1.45; letter-spacing: normal; text-align: left; color: #343434;margin-bottom: 10px;}
    .store-section.plug-store .store-subtitle {  margin-top: 40px;}
    .store-section .store-body{ display: flex; flex-wrap: wrap; gap: 10px; }
    .store-section .banner{ padding: 10px; border: 1px solid #dcdcdc; max-width: 470px;}
    .store-section .banner .banner-img{ max-width: 450px; height: 250px; }
    .store-section .banner figcaption{ margin: 30px 0; }
    .store-section .banner .detail-view-btn{ height: 40px; display: flex; width: 230px; border: 1px solid #808080; border-radius: 1px; align-items: center; justify-content: center; }
    .store-section .banner .store_addr-box{ display: flex; align-items: center; gap: 0px; flex-wrap: wrap;}
    .store-section .banner .store_addr-box .addr-svg{ display: flex; align-items: center; gap: 3px; }
    .store-section .banner .store_addr-box .addr-svg img{ width: 12px; height: 14px;}
    .store-section .banner .store_addr-box .addr-svg span{ font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 1.55; letter-spacing: normal; text-align: left; color: #808080;    border-bottom: solid 1px #808080;}
    .store-section .banner .store-name-box{ display: flex; align-items: center; gap: 10px;}
    .store-section .banner .store-name-box img{ margin-bottom: 2px; }
    .store-section .banner .store_name{ font-size: 13px; font-weight: 500; font-stretch: normal; font-style: normal; line-height: 2.08; letter-spacing: normal; text-align: left; color: #343434; }
    .store-section .banner .store_addr{ font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 2.45; letter-spacing: normal; text-align: left; color: #343434; margin-right: 15px;}
    .store-section .banner .store_link{  font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 2.45; letter-spacing: 0.28px; text-align: left; color: #343434; text-decoration: underline;}
    .store-section .banner .store_tel{ font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 2.45; letter-spacing: 0.28px; text-align: left; color: #343434; }
    .store-section .banner .store_open_date{ font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 2.45; letter-spacing: 0.28px; text-align: left; color: #343434; }


    /* 스톡키스트 */
    .store-section.stockist-store { margin-top: 100px; margin-bottom: 200px; display: flex; flex-direction: column; gap: 40px;}
    .store-section.stockist-store .stockist-country-wrap { display: flex;flex-direction: column; gap: 10px;}
    .store-section.stockist-store .stockist-country-wrap .stockist-country-header{font-size: 11px; font-weight: normal; font-stretch: normal; font-style: normal; line-height: 1.45; letter-spacing: normal; text-align: left; color: #343434;}
    .store-section.stockist-store .stockist-country-wrap .stockist-country-body{ display: flex;gap: 10px;flex-wrap: wrap;}
    .store-section.stockist-store .stockist-country-wrap .stockist-country-body .banner{ padding: 10px; border: 1px solid #dcdcdc; width: 100%;}
 
    @media (max-width: 1025px) {
        
        main{
            display: flex;
            flex-direction: column;
            margin: 10px;
        }
        .store-section .banner{
            padding: 0;
            border: 0px;
            max-width: 100%;
        }

        .store-section .banner .banner-img{
            max-width: 100%;
            height: 200px;
        }
        .store-section .store-body{
            gap: 60px;
        }
        .store-section .banner .store_addr-box{
            gap: 0px;
            flex-wrap: wrap;
        }
        .store-section .banner .store_addr-box .store_addr{
            margin-right: 15px;
        }
        .store-section.stockist-store{
            gap: 30px;
        }
    }





</style>

<main>
    <section class="store-section map">
        <div class="seacrh-header-wrap">
            <div class="search-header">
                <img class="search-svg" src="/images/svg/search.svg" alt="">
                <input id="search-input" type="search" placeholder="위치 검색">
            </div>
            <div>현재 위치로 검색하기</div>
        </div>
        <div class="search-body">
            <div id="map">지도</div>
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
</main>



<script>
    const getStoreList =  () => {
        let country = getLanguage();
        $.ajax({
            type: "post",
            url: "http://116.124.128.246/_api/store/list/get",
            data: {
                'country': country
            },
            async: false,
            dataType: "json",
            error: function () {
                alert('컬렉션 프로젝트 조회처리중 오류가 발생했습니다.');
            },
            success: function (d) {
                result = d.data;
            }
        });
        return result;
    }

    function makeSpaceHtml(data){
        let {contents_info, country, instagram_id, store_addr, store_idx, store_link, store_name, store_sale_date, store_tel, store_type} = data;
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
        spaceArticle.innerHTML = innerHtml;
        return spaceArticle;
    }
    function makePlugHtml(data){
        let {contents_info, country, instagram_id, store_addr, store_idx, store_link, store_name, store_sale_date, store_tel, store_type} = data;
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
        return spaceArticle;
    }

    function makeStockistFlag(data){
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
                if(el.dataset.country == cn.dataset.country){
                    cn.appendChild(el);
                }
            })
        });
        document.querySelector('.store-section.stockist-store').innerHTML = '';
        document.querySelector('.store-section.stockist-store').appendChild(stockistFlag);
    }
    function makeStockistHtml(data){
        let {country, instagram_id,store_addr, store_idx, store_link, store_name, store_sale_date, store_tel, store_type} = data;
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
        if(country === '온라인'){
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
        return stockistArticle;
    }

    document.addEventListener("DOMContentLoaded", function(){
        let data = getStoreList();
        let {space_info,plugshop_info,stockist_info} = data;
        document.querySelector('.store-section.brand-store .store-body').innerHTML ='';
        document.querySelector('.store-section.plug-store .store-body').innerHTML ='';

        space_info.forEach(space => {
            document.querySelector('.store-section.brand-store .store-body').appendChild(makeSpaceHtml(space));
        });
        plugshop_info.forEach(plug => {
            document.querySelector('.store-section.plug-store .store-body').appendChild(makePlugHtml(plug));
        });
        makeStockistFlag(stockist_info);
    });



</script>