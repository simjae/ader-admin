
<link rel=stylesheet href='/css/product/list.css' type='text/css'>

<?php
    function getUrlParamter($url, $sch_tag)
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return $query[$sch_tag];
    }

    $page_url = $_SERVER['REQUEST_URI'];
    $menu_sort = getUrlParamter($page_url, 'menu_sort');
    $menu_idx = getUrlParamter($page_url, 'menu_idx');
    $page_idx = getUrlParamter($page_url, 'page_idx');
?>
<main>
    <input id="menu_sort" type="hidden" value="<?= $menu_sort ?>">
    <input id="menu_idx" type="hidden" value="<?= $menu_idx ?>">
    <input id="page_idx" type="hidden" value="<?= $page_idx ?>">
    
	<input id="country" type="hidden" value="KR">
    
	<input id="last_idx" type="hidden" value="0">
	<input id="more_flg" type="hidden" value="false">
	<input id="product_total" type="hidden" value="">

    <section class="product__list__wrap" data-session="<?=$session?>" data-country="KR" data-last-idx="0" data-menu-idx ="<?= $menu_idx ?>" data-page-idx="<?= $page_idx ?>"  data-menu-sort ="<?= $menu_sort ?>"   >
        <div class="top__banner"></div>
        <div class="prd__meun">
            <div class="prd__meun__grid"></div>
            <div class="prd__meun__sort">
                <div class="sort-title">22FW 전체보기</div>
                <div class="sort-wrap ">
                    <li class="sort-btn order-btn">
                        <img src="/images/svg/sort-bottom.svg" alt="">
                        <span>정렬</span>
                    </li>
                    <li class="sort-btn filter-btn">
                        <img src="/images/svg/filter.svg" alt="">
                        <span>필터</span>
                    </li>
                    <li class="sort-btn type-btn" onClick="changeImgTypeBtn();">
                        <img src="/images/svg/cloth.svg" alt="">
                        <input type="hidden" id="img_param" value="O">
                        <span id="img_type_text">착용보기</span>
                    </li>
                    <div class="sort-btn web rW sort__grid" data-grid="4">
                            <img src="/images/svg/grid-cols-2.svg" alt="">
                            <span>2칸보기</span>
                    </div>
                    <div class="sort-btn mobile rM sort__grid" data-grid="3">
                            <img src="/images/svg/grid-cols-2.svg" alt="">
                            <span>2칸보기</span>
                        </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="prd__category__wrap">
                <div class="prd__meun__category">
                </div>
            </div>
            <div class="line"></div>
        </div>

        <div class="product__list__body">
            <div class="sort-containner">
                <ul class="sort-wrap">
                    <li class="sort-box">
                        <label class="cb__custom self" for="">
                            <input class="prd__cb self__cb" type="radio" name="sort">
                            <div class="cb__mark"></div>
                            <span>인기순</span>
                        </label>
                    </li>
                    <li class="sort-box">
                        <label class="cb__custom self" for="">
                            <input class="prd__cb self__cb" type="radio"name="sort">
                            <div class="cb__mark"></div>
                            <span>신상품순</span>
                        </label>
                    </li>
                    <li class="sort-box">
                        <label class="cb__custom self" for="">
                            <input class="prd__cb self__cb" type="radio" name="sort">
                            <div class="cb__mark"></div>
                            <span>낮은 가격순</span>
                        </label>
                    </li>
                    <li class="sort-box">
                        <label class="cb__custom self" for="">
                            <input class="prd__cb self__cb" type="radio" name="sort">
                            <div class="cb__mark"></div>
                            <span>높은 가격순</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="filter-containner">
                <div class="filter-header">
                    <!-- 모바일 탑 들어갈자리 -->
                </div> 
                <div class="filter-body">
                    <div class="filter-wrapper filter-lrg">
                        <div class="filter-content color">
                            <div class="mobile-btn--header">
                                <summary class="filter-lrg-title">색상</summary>
                                <div class="mobile-filter-btn">[ + ]</div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-wrapper filter-lrg">
                        <div class="filter-content fit">
                            <div class="mobile-btn--header">
                                <summary class="filter-lrg-title">핏</summary>
                                <div class="mobile-filter-btn">[ + ]</div>
                            </div>
                        </div>
                        <div class="filter-content graphic">
                            <div class="mobile-btn--header">
                                <summary class="filter-lrg-title">그래픽</summary>
                                <div class="mobile-filter-btn">[ + ]</div>
                            </div>
                        </div>
                        <div class="filter-content line">
                            <div class="mobile-btn--header">
                                <summary class="filter-lrg-title">라인</summary>
                                <div class="mobile-filter-btn">[ + ]</div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-wrapper filter-lrg">
                        <div class="filter-content size">
                            <div class="mobile-btn--header">
                                <summary class="filter-lrg-title">사이즈</summary>
                                <div class="mobile-filter-btn">[ + ]</div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-wrapper filter-lrg">
                        
                    </div>
                </div>
                <div class="filter-footer">
                    <div class="filter-btn-wraaper">
                        <div class="reset-btn">초기화</div>
                        <div class="select-btn"><span class="select-result">0</span>개의 제품 선택</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="show_more_btn" style="display:none;" onClick="getMoreProduct();">
            <span class="add-btn">더보기 +</span>
            <img src="" alt="">
        </div>
    </section>
</main>
<script src="/scripts/product/list_tmp.js"></script>