/**
 * @author SIMJAE
 * @description 검색 생성자 함수
 */
function Search() {
    let search_keyword = "";
    let popular_product = "";

    function getSearchInfoList() {
        let country = getLanguage();

        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/search/list/get",
            async: false,
            data: {
                'country': country
            },
            dataType: "json",
            error: function () {
                alert("추천검색어/실시간 인기 제품 조회중 오류가 발생했습니다.");
            },
            success: function (d) {
                if (d.code == 200) {
                    let data = d.data;
                    if (data != null) {
                        let keyword_info = data.keyword_info;
                        writeKeywordInfo(keyword_info);

                        let popular_info = data.popular_info;
                        writePopularInfo(popular_info);
                    }
                }
            }
        });
    }

    function writeKeywordInfo(keyword_info) {
        keyword_info.forEach(function (row) {
            search_keyword += `<li><a href="${row.menu_link}">${row.keyword_txt}</a></li>`;
        });
    }

    function writePopularInfo(popular_info) {
        popular_info.forEach(function (row) {
            popular_product += `
				<div class="popular-box" onClick="location.href='/product/detail?product_idx=${row.product_idx}'">
					<img src="${img_root}${row.img_location}" alt="">
					<span class="product-name">${row.product_name}</span>
				</div>
			`;
        });
    }

    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);

        sideWrap.dataset.module = "search";

        const searchContent = document.createElement("section");
        searchContent.className = "search-wrap";

        getSearchInfoList();

        searchContent.innerHTML =
            `
                <div class="search-header">
                    <img class="search-svg" src="/images/svg/search.svg" alt="">
                    <input id="search-input" type="search" placeholder="검색 해주세요!">
                </div>
                <div class="search-body">
                    <div class="search-content current" >
                        <ul class="search-recommend">
                            <div class="search-recommend-title">추천검색어</div>
                            ${search_keyword}
                        </ul>
                        <div class="search-recommend-title">실시간 인기 제품</div>
                        <div class="popular-wrap">
                            ${popular_product}
                        </div>
                    </div>
                    <div class="search-content result hidden" >
                        <div class="search-result-title">검색 결과</div>
                        <div class="search-result-wrap">
							
                        </div>
                        <div class="search-all-btn"><span>검색 결과 전체보기</span></div>
                    </div>
                </div>
        `
        sideBox.appendChild(searchContent);
    };

    this.mobileWriteHtml = () => {
        let mobileSearchWrap = document.querySelector(`.search__cont`);
        mobileSearchWrap.innerHTML = "";

        getSearchInfoList();

        const mdlBox = document.createElement("div");
        mdlBox.className = "mdlSearchBox";
        mdlBox.innerHTML =
            `
                    <div class="search-header">
                        <img class="search-svg" src="/images/svg/search.svg" alt="">
                        <input id="search-input" type="search" placeholder="검색 해주세요!">
                    </div>
                    <div class="search-body">
                        <div class="search-content current" >
                            <ul class="search-recommend">
                                <div class="search-recommend-title">추천검색어</div>
                                ${search_keyword}
                            </ul>
                            <div class="search-popular-title">실시간 인기 제품</div>
                            <div class="popular-wrap">
                                ${popular_product}
                            </div>
                        </div>
                        <div class="search-content result hidden" >
                            <div class="search-result-title">검색 결과</div>
                            <div class="search-result-wrap">
                                
                            </div>
                            <div class="search-all-btn"><span>검색 결과 전체보기</span></div>
                        </div>
                    </div>
            `
        mobileSearchWrap.append(mdlBox);
    };

    function getSearchResult() {
        let searchResult = document.querySelector(".search-content.result");
        let searchCurrent = document.querySelector(".search-content.current");

        let search_keyword = $('#search-input').val();

        $.ajax({
            type: "post",
            url: "http://116.124.128.246:80/_api/search/get",
            async: false,
            data: {
                'search_keyword': search_keyword
            },
            dataType: "json",
            error: function () {
                alert("상품 검색처리중 오류가 발생했습니다.");
            },
            success: function (d) {
                if (d.code == 200) {
                    let data = d.data;

                    let search_result_wrap = $('.search-result-wrap');
                    search_result_wrap.html('');

                    if (data != null) {
                        let search_result = "";
                        data.forEach(function (row) {
                            search_result += `
								<div class="search-result-box" onClick="location.href='/product/detail?product_idx=${row.product_idx}'">
									<img src="${img_root}${row.img_location}" alt=""/>
									<span class="product-name">${row.product_name}</span>
								</div>
							`;
                        });

                        search_result_wrap.append(search_result);

                        searchCurrent.classList.add("hidden");
                        searchResult.classList.remove("hidden");
                    }
                }
            }
        });
    }
    this.addSearchEvent = () => {
        let input = document.getElementById("search-input");
        input.addEventListener('input', debounce(getSearchResult, 500));
    }
}