<div id='mileage_tab_UNU'>
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
                <option value="PIN">주문시 구매한 상품에 대한 적립금 부여</option>
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
    </div>
    
	<table id="excel_table_UNU">
		<colgroup>
			<col width="150px;">
			<col width="150px;">
			<col width="200px;">
			
			<col width="200px;">
			<col width="200px;">
			
			<col width="200px;">
			<col width="200px;">
			
			<col width="300px;">
			<col width="300px;">
		</colgroup>
        <thead>
            <tr>
                <th rowspan="2">적립일</th>
                <th rowspan="2">회원ID</th>
				<th rowspan="2">미가용적립금</th>
                
				<th colspan="2">가용적립금</th>
                
				<th rowspan="2">주문번호</th>
                <th rowspan="2">주문상품번호</th>
                
				<th rowspan="2">적립금유형</th>
                <th rowspan="2">적립내용</th>
            </tr>
            <tr>
                <th>사용가능예정일</th>
                <th>날짜</th>
            </tr>
        </thead>
        <tbody id="result_table_UNU">
        </tbody>
    </table>
    <div class="padding__wrap">
        <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this)" >
        <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
        <div class="paging_UNU"></div>
    </div>
</div>
