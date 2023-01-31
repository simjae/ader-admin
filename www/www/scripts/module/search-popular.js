export function Search() {
    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "search";
        const searchContent = document.createElement("section");
        searchContent.className = "search-wrap";
        searchContent.innerHTML = 
            `
                <div class="search-header">
                    <img class="search-svg" style="height: 14px;" src="/images/svg/search.svg" alt="">
                    <input id="search-input" type="search" placeholder="검색 해주세요!">
                </div>
                <div class="search-body">
                    <div class="search-content current" >
                        <ul class="search-recommend">
                            <div class="search-recommend-title">추천검색어</div>
                            <li>쇼퍼백</li>
                            <li>트윈하트로고티셔츠</li>
                            <li>키링</li>
                            <li>The new is not new</li>
                            <li>버켄스탁 콜라보레이션</li>
                        </ul>
                        <div class="popular-wrap">
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="popular-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt="">
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                        </div>
                    </div>
                    <div class="search-content result hidden" >
                        <div class="search-result-title">검색 결과</div>
                        <div class="search-result-wrap">
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWKV01BL_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWTB09GN_04_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCA01BK_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWBZ01BG_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWCT06BL_06_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWGD05GR_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLASSHD04KK_06_P_M_202211181428.png" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                            <div class="search-result-box">
                                <img src="http://116.124.128.246:81//images/product/img_BLAFWJP05NV_05_P_M_202210210000.jpg" alt=""/>
                                <span class="product-name">Twin heart hoodie</span>
                            </div>
                        </div>
                        <div class="search-all-btn"><span>검색 결과 전체보기</span></div>
                    </div>
                </div>
        `
        sideBox.appendChild(searchContent);
    };
    this.addSearchEvent = () => {
            let input = document.getElementById("search-input");
            let searchResult = document.querySelector(".search-content.result")
            let searchCurrent = document.querySelector(".search-content.current")
            input.addEventListener("keyup", function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    searchCurrent.classList.add("hidden");
                    searchResult.classList.remove("hidden");
                }
            });
    }
}
