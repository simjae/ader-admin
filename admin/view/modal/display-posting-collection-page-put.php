<div class="content__card" style="height:90vh;width:1024px;overflow-y:auto;">
    <input type="hidden" value="<?=$c_product_idx?>" id="REP_c_product_idx">
    <div class="container_REP_KR" >
        <div class="card__header">
            <h5>
                관련상품 수정하기
                <a onclick="modal_close();" class="btn-close" style="float: right;">
                    <i class="xi-close"></i>
                </a>
            </h5>
            <div class="drive--x"></div>
        </div>
        
        <div class="card__body" style="display:flex;">
            <div style="width:100%;">
                <div class="table table__wrap" style="width:100%;margin-top:0px;">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">관련 상품</th>
                            </tr>
                        </thead>
                        <tbody style="height:30vh;">
                            <tr>
                                <td style="width:35%;">
                                    <div style="display:flex;justify-content: space-between;">
                                        <h3>관련상품 분류 설정</h3>
                                        <div style="display:flex;">
                                            <i class="xi-search"></i>
                                            <input type="text" id="tree_search" placeholder="카테고리 검색">
                                        </div>
                                    </div>
                                    <div id="tree__area" style="height:28vh;overflow-y:auto;">
                                        <div class="js--tree_KR"></div>
                                    </div>
                                </td>
                                <td colspan="3" style="width:39vw;vertical-align:top;">
                                    <div class="card__header">
                                        <h5>상품 목록</h5>
                                        <div class="drive--x"></div>
                                    </div>
                                    <div style="height:28vh;overflow-y:auto;">
                                        <div class="table table__wrap" style="width:100%;margin-top:5px;">
                                            <table>
                                                <colgroup>
                                                    <col width="5%;">
                                                    <col width="20%;">
                                                    <col width="75%;">
                                                </colgroup>
                                                <thead>
                                                    <th>선택유무</th>
                                                    <th>상품 코드</th>
                                                    <th>상품 명</th>
                                                </thead>
                                                <tbody class="result_table_KR" style="">
                                                    <tr>
                                                        <td colspan="4">조회 결과가 없습니다.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form id="frm-relevant-list-KR">
            <div class="relevant__wrap" >
            
            </div>
        </form>
        <div class="card__footer">
            <div class="footer__btn__wrap" style="grid:none;">
                <div class="btn__wrap--lg">
                    <button class="btn" style="width:110px;" onclick="putRelevantProductInfo('KR')">적용</button>
                    <button class="btn" style="width:110px;">취소</button>
                </div>
            </div>
        </div>
    </div>
    	
</div>

<script>
$(document).ready(function(){
    getRelevantInfo($('#country').val(),$('#REP_c_product_idx').val());
})
</script>