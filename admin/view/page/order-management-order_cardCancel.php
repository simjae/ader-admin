<div class="content__card">
	<div class="card__header">
		<div class="card__header">
			<h3>카드 취소 조회</h3>
			<div class="drive--x"></div>
		</div>
	</div>
	<div class="card__body">
		<div class="content__wrap">
			<div class="content__title">쇼핑몰</div>
			<div class="content__row" >
				<select name="shop_no_order" id="shop_no_order" class="fSelect" style="width:163px">
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
					<option value="choice">-검색항목선택-</option>
					<option value="order_id" selected="">주문번호</option>
					<option value="ord_item_code">품목별 주문번호</option>
					<option value="delivery_code">배송번호</option>
					<option value="invoice_no">운송장번호</option>
					<option value="s_order_info">마켓주문번호</option>
					<option value="line1">-----------------</option>
					<option value="o_name">주문자명</option>
					<option value="member_id">주문자 아이디</option>
					<option value="member_email">회원 이메일</option>
					<option value="o_email">주문서 이메일</option>
					<option value="o_phone2">주문자 휴대전화</option>
					<option value="o_phone1">주문자 일반전화</option>
					<option value="client_ip">주문자 IP</option>
					<option value="line2">-----------------</option>
					<option value="c_p_name">입금자명</option>
					<option value="r_name">수령자명</option>
					<option value="r_phone2">수령자 휴대전화</option>
					<option value="r_phone1">수령자 일반전화</option>
					<option value="r_addr">배송지 주소</option>
					<option value="ord_add_item">주문서 추가항목</option>
					<option value="all_name">주문자명, 입금자명, 수령자명</option>
					<option value="r_safe_phone">0504 안심번호</option>
					<option value="line3">-----------------</option>
					<option value="msg_writer_name">메모 작성자명</option>
					<option value="msg_writer_id">메모 작성자 아이디</option>
					<option value="msg">메모 내용</option>
				</select>
				<input type="text" value="" style="width:60%;">
				<button style="width:30px;height:30px;border:1px solid;background-color:#ffff;margin-left:15px;">+</button>
			</div>
		</div>
		<div class="content__wrap">
			<div class="content__title">기간</div>
			<div class="content__row">
				<select name="date_type" style="width:163px;" class="fSelect disabled">
					<option value="order_date" selected="selected">주문일</option>
					<option value="memo_date">메모작성일</option>
					<option value="pay_date">결제일</option>
					<option value="shipready_date">송장번호입력일</option>
					<option value="shipbegin_date">배송시작일</option>
					<option value="shipend_date">배송완료일</option>
				</select>
				<div class="content__date__wrap">
					<div class="content__date__btn">
						<input id="search_date_card" type="hidden" name="search_date" value="" style="width:150px;">

						<div class="search_date_card date__picker" date_type="card" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
						<div class="search_date_card date__picker" date_type="card" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
						<div class="search_date_card date__picker" date_type="card" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
						<div class="search_date_card date__picker" date_type="card" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
						<div class="search_date_card date__picker" date_type="card" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
						<div class="search_date_card date__picker" date_type="card" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
						<div class="search_date_card date__picker" date_type="card" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
					</div>
					<div class="content__date__picker">
						<input id="card_from" class="date_param" type="date" name="login_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="card" onChange="dateParamChange(this);">
						<font>~</font>
						<input id="card_to" class="date_param" type="date" name="login_to" placeholder="To" readonly style="width:150px;" date_type="card" onChange="dateParamChange(this);">
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
		<div class="content__wrap">
			<div class="content__title">희망 배송업체/방식</div>
			<div class="content__row">
				<select name="HopeShipCompanyId" class="fSelect" style="width:163px;">
					<option value="all">- 희망배송업체 -</option>
					<option value="3">CJ대한통운</option>
					<option value="5">KGB택배</option>
					<option value="15">롯데택배</option>
					<option value="21">택배연동 EMS</option>
					<option value="22">우체국택배</option>
					<option value="24">CJ대한통운(연동)</option>
				</select>
			</div>
		</div>
		<div class="content__wrap">
			<div class="content__title">주문 상태</div>
			<div class="content__row">
				<div class="cb__color">
					<label>
						<input type="checkbox" name="orderStatus" value="" checked>
						<span>전체</span>
					</label>
					<label>
						<input type="checkbox" name="orderStatus" value="" checked>
						<span>전체 취소</span>
					</label>
					
					<label>
						<input type="checkbox" name="orderStatus" value="" checked>
						<span>부분 취소</span>
					</label>
				</div>
			</div>
		</div>
		<div class="card__body--hide detail_hidden" style="display: none;">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원 구분</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="memberType6_1" class="radio__input" value="" name="memberType" />
							<label for="memberType6_1">전체</label>
							<input type="radio" id="memberType6_2" class="radio__input" value="" name="memberType" />
							<label for="memberType6_2">회원</label>
	
							<select class="fSelect" name="group_no" id="groupNo" style="width:163px;">
								<option value="all">전체등급</option>
								<option value="1">일반회원</option>
								<option value="5">ADER family</option>
							</select>
							<input type="radio" id="memberType6_3" class="radio__input" value="" name="memberType" />
							<label for="memberType6_3">비회원</label>
	
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">회원 정보</div>
					<div class="content__row">
						<div class="cb__color">
							<label>
								<input type="checkbox" name="memberInfo" value="">
								<span>특별 관리 회원</span>
							</label>
	
							<label>
								<input type="checkbox" name="memberInfo" value="">
								<span>불량 회원</span>
							</label>
	
							<label>
								<input type="checkbox" name="memberInfo" value="">
								<span>첫 주문</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">배송 구분</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="deliverType6_1" class="radio__input" value="" name="deliverType" />
							<label for="deliverType6_1">전체</label>
							<input type="radio" id="deliverType6_2" class="radio__input" value="" name="deliverType" />
							<label for="deliverType6_2">국내 배송</label>
							<input type="radio" id="deliverType6_3" class="radio__input" value="" name="deliverType" />
							<label for="deliverType6_3">해외 배송</label>
						</div>
					</div>
				</div>
				<div class="half__box__wrap" style="align-items:start;">
					<div class="content__title">배송 정보</div>
					<div class="content__row">
						<div class="rd__block" style="flex-wrap: wrap;">
							<input type="radio" id="deliverInfo6_1" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6_1">묶음 배송</label>
							<input type="radio" id="deliverInfo6_2" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6_2">재 배송</label>
							<input type="radio" id="deliverInfo6_3" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6_3">배송 메시지 입력</label>
							<input type="radio" id="deliverInfo6_4" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6_4">부분 배송</label>
							<input type="radio" id="deliverInfo6_5" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6_5">예약 주문</label>
							<input type="radio" id="deliverInfo6_6" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6_6">정기 배송(결제)</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">금액 조건</div>
					<div class="content__row">
						<select class="fSelect" name="paystandard" id="ePayStandard" style="width:163px;">
							<option value="choice" selected="selected">- 금액기준 -</option>
							<option value="total">총상품구매금액</option>
							<option value="sales_amount">판매액</option>
							<option value="realpay">총실결제금액</option>
						</select>

						<input type="text" value="" style="width:100px;">
						~
						<input type="text" value="" style="width:100px;">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">주문 품목 수</div>
					<div class="content__row">
						<input type="text" value="" style="width:100px;">
						~
						<input type="text" value="" style="width:100px;">
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">결제 수단</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="paymentType6_1" class="radio__input" value="" name="paymentType" />
							<label for="paymentType6_1">전체</label>
							<input type="radio" id="paymentType6_2" class="radio__input" value="" name="paymentType" />
							<label for="paymentType6_2">수단 선택</label>
							<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">할인 수단</div>
					<div class="content__row">
						<div class="cb__color">
							<label>
								<input type="checkbox" name="discountType" value="">
								<span>적립금</span>
							</label>

							<label>
								<input type="checkbox" name="discountType" value="">
								<span>예치금</span>
							</label>

							<label>
								<input type="checkbox" name="discountType" value="">
								<span>쿠폰</span>
							</label>

							<label>
								<input type="checkbox" name="discountType" value="">
								<span>마켓 할인</span>
							</label>

							<label>
								<input type="checkbox" name="discountType" value="">
								<span>할인 코드</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">결제 업체</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="paymentCompany6_1" class="radio__input" value="" name="paymentCompany" />
							<label for="paymentCompany6_1">전체</label>
							<input type="radio" id="paymentCompany6_2" class="radio__input" value="" name="paymentCompany" />
							<label for="paymentCompany6_2">업체 선택</label>
							<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">결제 정보</div>
					<div class="content__row">
						<div class="cb__color">
							<label>
								<input type="checkbox" name="paymentInfo" value="">
								<span>에스크로</span>
							</label>

							<label>
								<input type="checkbox" name="paymentInfo" value="">
								<span>전자 보증 보험</span>
							</label>

							<label>
								<input type="checkbox" name="paymentInfo" value="">
								<span>추가 결제</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">주문 경로</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="orderRoute6_1" class="radio__input" value="" name="orderRoute" />
							<label for="orderRoute6_1">전체</label>
							<input type="radio" id="orderRoute6_2" class="radio__input" value="" name="orderRoute" />
							<label for="orderRoute6_2">경로 선택</label>
							<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">유입 경로</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="inflowRoute6_1" class="radio__input" value="" name="inflowRoute" />
							<label for="inflowRoute6_1">전체</label>
							<input type="radio" id="inflowRoute6_2" class="radio__input" value="" name="inflowRoute" />
							<label for="inflowRoute6_2">경로 선택</label>
							<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div id="detail_toggle" toggle="hide" onclick="detailToggleClick(this)">상세 검색 열기 +</div>
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick=""><span>검색</span></div>
				<div class="defult__color__btn" onClick=""><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>

<div class="content__card">
	<div class="card__header">
		<h3>검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap justify-between">
			<div class="body__info--count">
				<div class="drive--left"></div>
				검색결과 <font class="cnt_03_result info__count" >0</font>명
			</div>
			<div class="content__row flex justify-end">
				<div class="cb__color">
					<label for="">
						<input type="checkbox" value="" name="receiverInfo">
						<span>수령자 정보 표시</span>
					</label>
				</div>
				<select name="searchSorting" class="fSelect" style="width:163px;float:right;margin-right:10px;">
					<option value="order_asc">주문일순</option>
					<option value="order_desc" selected="">주문일역순</option>
					<option value="settle_price_asc">총 실결제금액순</option>
					<option value="settle_price_desc">총 실결제금액역순</option>
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

		<div class="table__wrap table tabNum tabNum_01">
			<div class="table__filter">
				<div class="filrer__wrap">
					<input type="hidden" class="action_type" name="action_type">
					<input type="hidden" class="action_name" name="action_name">

					<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
				</div>
			</div>
			<TABLE>
				<THEAD>
					<TR>
						<TH style="width:3%;">
							<div class="cb__color">
								<label class="width-150">
									<input type="checkbox" name="selectAll1" value="">
									<span>전체</span>
								</label>
							</div>
						</TH>
						<TH style="width:8%;">쇼핑몰</TH>
						<TH style="width:8%;">주문일 (취소일)</TH>
						<TH style="width:8%;">주문번호</TH>
						<TH style="width:5%;">주문자</TH>
						<TH style="width:8%;">상품명/옵션</TH>
						<TH style="width:8%;">상품명/옵션 (기본)</TH>
						<TH style="width:3%;">수량</TH>
						<TH>상품 구매 금액</TH>
						<TH>결제 예정 금액</TH>
						<TH>결제 수단</TH>
						<TH>취소 구분</TH>
						<TH>메모</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>
							<div class="cb__color">
								<label class="width-150">
									<input type="checkbox" name="select" value="">
									<span>선택</span>
								</label>
							</div>
						</TD>
						<TD>
							한국어 쇼핑몰(한국어)
						</TD>
						<TD>
							2022-06-07 13:32:13<br>(2022-06-07 13:32:13)
						</TD>
						<TD>
							<font style="text-decoration:underline;">20220607-0000362-01</font>
						</TD>
						<TD>
							<font style="text-decoration:underline;">한초롱</font><br>
							gksrldhs<br>
							[일반회원]
						</TD>
						<TD>
							<div class="row">
								<div style="width:30px;height:30px;border:1px solid #000000;margin-right:10px;"></div>
								<font style="text-decoration:underline;">Tron angle bag<br>(P0000LLK)</font>
							</div>
						</TD>
						<TD>
							<font style="text-decoration:underline;">Tron angle bag<br>(P0000LLK)</font>
						</TD>
						<TD>
							1
						</TD>
						<TD>
							KRW 359,000
						</TD>
						<TD>
							<font style="text-decoration:underline;">KRW 359,000</font>
						</TD>
						<TD>
							<div style="width:50px;height:20px;color:white;background-color:#26B509;color:#ffffff;line-height:2;border-radius:5px;text-align:center;">신용카드</div>
						</TD>
						<TD>
							취소완료
						</TD>
						<TD></TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
		
	</div>
</div>




<script>
$(function(){

});

function detailToggleClick(obj) {
	if ($(obj).attr('toggle') == 'hide') {
		$(obj).attr('toggle','show');
		$('#detail_toggle').text('상세검색 닫기 -');
	} else {
		$(obj).attr('toggle','hide');
		$('#detail_toggle').text('상세검색 열기 +');
	}
	$('.detail_hidden').toggle();
}




</script>