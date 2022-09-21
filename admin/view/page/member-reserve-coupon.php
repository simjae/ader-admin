<div id='mileage_tab_03'>
    <div class="info__wrap " style="justify-content:space-between; align-items: center;">
        <div class="body__info--count">
            <div class="drive--left"></div>
            총 건수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
        </div>
        <div class="flex justify-end content__row">
            <select class="mileage_type" style="width:250px;float:right;margin-right:10px;" onChange="mileageChange(this);">
                <option value="">적립금 타입</option>
                <option value="N">신규가입시 적립금 부여</option>
                <option value="P">주문시 구매한 상품에 대한 적립금 부여</option>
                <option value="M">주문시 사용한 적립금 차감</option>
                <option value="9">주문 상품 교환에 대한 상품 적립금 부여</option>
                <option value="7">주문 상품 추가에 대한 상품 적립금 부여</option>
                <option value="S">주문취소시 구매에 사용한 적립금 부여</option>
                <option value="F">주문취소로 인해 상품에 대한 적립금 차감</option>
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
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width:8%;">일자</th>
                <th rowspan="2" style="width:10%;">아이디</th>
                <th rowspan="2" style="width:8%;">미가용 적립금</th>
                <th rowspan="2" style="width:8%;">관련주문</th>
                <th colspan="2" style="width:20%;">가용 적립금</th>
                <th rowspan="2" style="width:30%;">내용</th>
            </tr>
            <tr>
                <th>사용가능 예정일</th>
                <th>날짜</th>
            </tr>
        </thead>
        <tbody id="result_table_03">
        </tbody>
    </table>
    <div class="padding__wrap">
        <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this)" >
        <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
        <div class="paging_03"></div>
    </div>
</div>
