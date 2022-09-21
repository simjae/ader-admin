<div id='mileage_tab_01'>
    <div class="info__wrap " style="justify-content:space-between; align-items: center;">
        <div class="body__info--count">
            <div class="drive--left"></div>
            총 건수 <font class="cnt_total info__count" >0</font>개 
            <div class="drive--left"></div>
            검색결과 <font class="cnt_result info__count" >0</font>개
        </div>
        <div class="flex justify-end content__row">
            <select class="mileage_type" style="width:250px;float:right;margin-right:10px;" onChange="mileageChange(this);">
                <option value="">적립금 타입</option>
                <option value="R">상품구매 후 후기작성 시 가용 적립금 부여</option>
                <option value="N">신규가입시 적립금 부여</option>
                <option value="AM">API를 통한 적립금</option>

            </select>	
            <select class="rows" style="width:163px;float:right;" onChange="rowsChange(this);">
                <option value="10" selected>10개씩보기</option>
                <option value="20">20개씩보기</option>
                <option value="30">30개씩보기</option>
                <option value="50">50개씩보기</option>
                <option value="100">100개씩보기</option>
                <option value="200">200개씩보기</option>
                <option value="300">300개씩보기</option>
                <option value="500">500개씩보기</option>
            </select>
        </div>
    </div>
    <div class="table__filter">
        <div class="filrer__wrap">
            <div class="filter__btn" onclick="excelDownload();">엑셀 다운로드</div>
        </div> 	
        <div>
            <div class="table__setting__btn">설정</div>
        </div> 
    </div>
    <table id="excel_table_01">
        <thead>
            <tr>
                <th rowspan="2" style="width:8%;">일자</th>
                <th rowspan="2" style="width:10%;">아이디</th>
                <th colspan="2" style="width:20%;">가용 적립금</th>
                <th rowspan="2" style="width:10%;">관련주문/추천인</th>
                <th rowspan="2" style="width:10%;">처리자</th>
                <th rowspan="2">적립금 유형</th>
                <th rowspan="2" style="width:30%;">내용</th>
            </tr>
            <tr>
                <th>증가</th>
                <th>잔액</th>
            </tr>
        </thead>
        <tbody id="result_table_01">
        </tbody>
    </table>
    <div class="padding__wrap">
        <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
        <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
        <div class="paging_01"></div>
    </div>
</div>