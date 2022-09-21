<div class="content__card">
	<form id="" action="">
		<div class="card__header">
			<h3 id="tabTitle">관리자 메모 조회</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
            <div class="content__wrap">
                <div class="content__title">쇼핑몰</div>
                <div class="content__row">
					<select name="shop_no_order" id="shop_no_order" class="fSelect" style="width:163px;">
						<option value="1" selected="selected">[기본]한국어 쇼핑몰(한국어)</option>
						<option value="2">영문몰(영어)</option>
						<option value="4">중어몰(중국어(간체))</option>
					</select>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">검색어</div>
                <div class="content__row">
					<select class="fSelect" name="MSK[]" style="width:163px;">
						<option value="choice" selected="">-검색항목선택-</option>
						<option value="order_id" selected="">주문번호</option>
						<option value="ord_item_code" selected="">품목별 주문번호</option>
						<option value="delivery_code" selected="">배송번호</option>
						<option value="invoice_no" selected="">운송장번호</option>
						<option value="s_order_info" selected="">마켓주문번호</option>
						<option value="line1" selected="">-----------------</option>
						<option value="o_name" selected="">주문자명</option>
						<option value="member_id" selected="">주문자 아이디</option>
						<option value="member_email" selected="">회원 이메일</option>
						<option value="o_email" selected="">주문서 이메일</option>
						<option value="o_phone2" selected="">주문자 휴대전화</option>
						<option value="o_phone1" selected="">주문자 일반전화</option>
						<option value="client_ip" selected="">주문자 IP</option>
						<option value="line2" selected="">-----------------</option>
						<option value="c_p_name" selected="">입금자명</option>
						<option value="r_name" selected="">수령자명</option>
						<option value="r_phone2" selected="">수령자 휴대전화</option>
						<option value="r_phone1" selected="">수령자 일반전화</option>
						<option value="r_addr" selected="">배송지 주소</option>
						<option value="ord_add_item" selected="">주문서 추가항목</option>
						<option value="r_safe_phone" selected="">0504 안심번호</option>
						<option value="line3" selected="">-----------------</option>
						<option value="msg_writer_name" selected="">메모 작성자명</option>
						<option value="msg_writer_id" selected="">메모 작성자 아이디</option>
						<option value="msg" selected="">메모 내용</option>
					</select>
					
					<input type="text" value="" style="width:60%;">
					<button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;">+</button>
                </div>
            </div>
			<div class="content__wrap">
                <div class="content__title">기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_memo" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_memo date__picker" date_type="memo" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_memo date__picker" date_type="memo" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_memo date__picker" date_type="memo" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_memo date__picker" date_type="memo" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_memo date__picker" date_type="memo" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_memo date__picker" date_type="memo" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_memo date__picker" date_type="memo" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="memo_from" class="date_param" type="date" name="memo_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="memo" onChange="dateParamChange(this);">
								<font>~</font>
							<input id="memo_to" class="date_param" type="date" name="memo_to" placeholder="To" readonly style="width:150px;" date_type="memo" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
            </div>
			<div class="content__wrap">
                <div class="content__title">상품</div>
                <div class="content__row">
					<select class="fSelect" id="eProductSearchType" name="product_search_type" style="width:163px;">
						<option value="product_name" selected="selected">상품명</option>
						<option value="product_code">상품코드</option>
						<option value="item_code">품목코드</option>
						<option value="product_tag">상품태그</option>
						<option value="manufacturer_name">제조사</option>
						<option value="supplier_name">공급사</option>
					</select>
					
					<input type="text" value="" style="width:60%;">
					
					<button style="width:100px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">상품 찾기</button>
                </div>
            </div>
        </div>
        <div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick=""><span>검색</span></div>
					<div class="defult__color__btn" onClick=""><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
	<div class="card__header">
		<h3 id="tabTitle">검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				검색결과 <font class="cnt_01_result info__count" >21,999</font>명
			</div>
			
			<div class="content__row">
				<select name="searchSorting" class="fSelect" style="float:right;width:163px;margin-right:10px;">
					<option value="updatedate_asc">작성일순</option>
					<option value="updatedate_desc" selected="">작성일역순</option>
					<option value="memberid_asc">작성자ID순</option>
					<option value="memberid_desc">작성자ID역순</option>
				</select>
				
				<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
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
		<div class="table__wrap table">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
				</div> 	
			</div>
			<TABLE>
				<THEAD>
					<TR>
						<TH>쇼핑몰</TH>
						<TH>주문번호</TH>
						<TH>작성일</TH>
						<TH>작성자 ID<br>(작성자)</TH>
						<TH>중요</TH>
						<TH>상품명</TH>
						<TH>내용</TH>
						<TH>전체메모</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>한국어 쇼핑몰(한국어)</TD>
						<TD>20220531-0000776</TD>
						<TD>2022-06-07 10:44:21</TD>
						<TD>adercs<br>(ADER error)</TD>
						<TD>-</TD>
						<TD>-</TD>
						<TD>
							<font style="color:#E26A6A;">[교환접수]</font><br>
							동일상품교환
						</TD>
						<TD></TD>
					</TR>
					
					<TR>
						<TD>한국어 쇼핑몰(한국어)</TD>
						<TD>20220531-0000776</TD>
						<TD>2022-06-07 10:44:21</TD>
						<TD>adercs<br>(ADER error)</TD>
						<TD>-</TD>
						<TD>-</TD>
						<TD>
							<font style="color:#E26A6A;">[교환접수]</font><br>
							동일상품교환
						</TD>
						<TD></TD>
					</TR>
					
					<TR>
						<TD>한국어 쇼핑몰(한국어)</TD>
						<TD>20220531-0000776</TD>
						<TD>2022-06-07 10:44:21</TD>
						<TD>adercs<br>(ADER error)</TD>
						<TD>-</TD>
						<TD>-</TD>
						<TD>
							<font style="color:#E26A6A;">[교환접수]</font><br>
							동일상품교환
						</TD>
						<TD></TD>
					</TR>
					
					<TR>
						<TD>한국어 쇼핑몰(한국어)</TD>
						<TD>20220531-0000776</TD>
						<TD>2022-06-07 10:44:21</TD>
						<TD>adercs<br>(ADER error)</TD>
						<TD>-</TD>
						<TD>-</TD>
						<TD>
							<font style="color:#E26A6A;">[교환접수]</font><br>
							동일상품교환
						</TD>
						<TD></TD>
					</TR>
					
					<TR>
						<TD>한국어 쇼핑몰(한국어)</TD>
						<TD>20220531-0000776</TD>
						<TD>2022-06-07 10:44:21</TD>
						<TD>adercs<br>(ADER error)</TD>
						<TD>-</TD>
						<TD>-</TD>
						<TD>
							<font style="color:#E26A6A;">[교환접수]</font><br>
							동일상품교환
						</TD>
						<TD></TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" onChange="setResultCount(this);">
			<input type="hidden" class="result_cnt" value="0" onChange="setResultCount(this);">
			<div class="paging_01"></div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		
	});
function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');
	
	var date_type = $(obj).attr('date_type');
	if (date_type == "memo") {
		$('.search_date_memo').not($(obj)).css('background-color','#ffffff');
		$('#search_date_memo').val(date);
		$('#memo_from').val('');
		$('#memo_to').val('');
	}
}
function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	
	if (date_type == "memo") {
		$('.search_date_memo').css('background-color','#ffffff');
		$('.search_date_memo').css('color','#000');
		
		$('#search_date_memo').val('');
	}
}
function selectAllClick(obj) {
	var tab_num = $('#tab_num').val();
	
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table_" + tab_num).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table_" + tab_num).find('.select').prop('checked',false);
	}
}
</script>
