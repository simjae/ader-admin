<style>
.container_PRJ_KR{display:flex;}
    .container_PRJ_KR .project__select__wrap{
        width:40vh;
        height:200px;
        overflow-y:auto;
    }
        .container_PRJ_KR .project__select__wrap .btn{margin-left:0px;height:30px;}
        .container_PRJ_KR .project__item{display:grid;grid-template-columns: 40px 1fr 30px 30px;align-items:center;margin-right:10px;}
        .container_PRJ_KR .project__item img{max-width:30px}
        .container_PRJ_KR .project__item .project__icon{width:40px;height:40px;display:flex;justify-content:center;align-items:center;}
        .container_PRJ_KR .project__title span{line-height:40px}

    .container_PRJ_KR .project__data__wrap{width:100%;height:200px;padding-left:15px;}
    
    .container_PRJ_KR .btn__area{margin-top:20px;padding-right:10px;}
    .container_PRJ_KR .btn__area input[type='text']{
        margin: 0px;
        width: 270px;
        border-radius: 2px;
        border: solid 1px #bfbfbf;
        border-radius: 2px;
        height: 28px;
        font-size: 12px;
        padding-left: 14px
    }
    .container_PRJ_KR .btn{margin-left:10px}
    .container_PRD_KR img{max-width:50px}
</style>

<h3 style="margin-bottom:20px;">룩북 관리</h3>
<div class="content__card">
    <div class="card__header">
        <h5>프로젝트 선택</h5>
        <div class="drive--x"></div>
    </div>
    <div class="card__body" style="display:flg">
        <div class="container_PRJ_KR">
            <div>
                <div class="project__select__wrap">
                
                </div>
                <div class="btn__area">
                    <button class="btn" style="float:right;" onclick="addCollection('KR')">새프로젝트 추가</button>
                </div>
            </div>
            <div class="project__data__wrap">
                <input type="hidden" class="collection_idx">
                <div class="table__wrap">
                    <table>
                        <tbody>
                            <tr>
                                <td>프로젝트 명</td>
                                <td>
                                    <input type="text" class="project_name">
                                </td>
                            </tr>
                            <tr>
                                <td>프로젝트 설명</td>
                                <td>
                                    <input type="text" class="project_desc">
                                </td>
                            </tr>
                            <tr>
                                <td>프로젝트 제목</td>
                                <td>
                                    <input type="text" class="project_title">
                                </td>
                            </tr>
                            <tr>
                                <td>프로젝트 썸네일</td>
                                <td>
                                    <input type="text" class="thumb_location" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <div class="btn__area">
                        <span>썸네일 폴더 경로</span>
                        <input type="text" name="server_img_path" style="width:500px;"></input>
                        <button class="btn image_check_btn thumbnail" chk-flg="false" onclick="checkThumbImage('KR')">체크</button>
                        <button class="btn" onclick="addThumbImage('KR')">등록</button>
                    </div>
                    <div class="btn__area">
                        <button class="btn" style="float:right;" onclick="putCollection('KR')">적용하기</button>
                        <button class="btn" style="float:right;" onclick="deleteCollection('KR')">삭제하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content__card">
    <div class="card__header">
        <h5>룩북 이미지 등록</h5>
        <div class="drive--x"></div>
    </div>
    <div class="container_PRD_KR">
        <div class="table__wrap">
            <form id="frm-product-list-KR">
                <table>
                    <thead></thead>
                    <tbody class="result_table_KR">
                        <tr>
                            <td class="default_td" style="text-align:left" colspan="4">
                            프로젝트를 선택해주세요
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div style="display:flex; justify-content: space-between;margin-top:20px;">
                <div class="content__row">
                    <div class="btn" onclick="prdDisplayNumCheck('KR', 'up')">            
                        <i class="xi-angle-up"></i>            
                        <span class="tooltip top">위로</span>       
                    </div>
                    <div class="btn" onclick="prdDisplayNumCheck('KR', 'down')">            
                        <i class="xi-angle-down"></i>            
                        <span class="tooltip down">아래로</span>       
                    </div>
                </div>
                <div class="content__row">
                    <span style="width:50px" id="collection_prod_cnt_KR"> </span>
                    <input type="text" name="ftp_dir" style="width:300px;"></input>
                    <button class="btn image_check_btn collection_prod" chk-flg="false" onclick="checkCollectionProduct('KR')">체크</button>
                    <button class="btn" onclick="addCollectionProduct('KR')" style="margin-right:50px;">이미지 등록</button>
                    <button class="btn" style="float:right;" onclick="putCollectionProductFlg('KR')">수정하기</button>
                    <button class="btn" onclick="deleteCollectionProduct('KR')">삭제</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    getCollectionList('KR');
})    
</script>