<div class="content__card">
	<div class="card__header">
		<div class="card__header">
			<h3>전체 주문 검색</h3>
			<div class="drive--x"></div>
		</div>
	</div>
	<div class="card__body">
		<div class="content__wrap">
			<div class="content__title">쇼핑몰</div>
			<div class="content__row" >
				<select name="shop_no_order" id="shop_no_order" class="fSelect" style="width:163px">
					<option value="1" selected="selected">한국몰</option>
					<option value="2">영문몰</option>
					<option value="4">중문몰</option>
				</select>
			</div>
		</div>
		<div class="content__wrap" style="align-items: start;">
			<div class="content__title">검색방식</div>
			<div class="content__row" style="display:block;">
				<div class="rd__block" style="margin-bottom:10px;">
					<input type="radio" id="searchType1" class="radio__input" value="searchCondition" name="searchType" onclick="searchTypeClick(this)" />
					<label for="searchType1">조건별 검색</label>
					<input type="radio" id="searchType2" class="radio__input" value="searchStatus" name="searchType" onclick="searchTypeClick(this)"/>
					<label for="searchType2">상태별 검색</label>
				</div>
				<div class="search__condition" style="display: none;">
					<div>
						<select id="orderSearchShipStatus" name="orderSearchShipStatus" class="fSelect" style="width:15%;">
							<option value="all">- 배송 선택 -</option>
							<option value="N10">상품준비중</option>
							<option value="N20">배송준비중</option>
							<option value="W">배송보류</option>
							<option value="F">배송대기</option>
							<option value="M">배송중</option>
							<option value="T">배송완료</option>
						</select>
						
						<select id="orderSearchCancelStatus" name="orderSearchCancelStatus" class="fSelect" style="width:15%;">
							<option value="all">- 취소 선택 -</option>
							<option value="C47">입금전취소-구매자</option>
							<option value="C48">입금전취소-판매자</option>
							<option value="C49">입금전취소-시스템</option>
							<option value="F">취소안함</option>
							<option value="M">부분취소</option>
							<option value="T">전체취소</option>
						</select>
						
						<select id="orderSearchExchangeStatus" name="orderSearchExchangeStatus" class="fSelect" style="width:15%;">
								<option value="all">- 교환 선택 -</option>
							<option value="F">교환안함</option>
							<option value="M">부분교환</option>
							<option value="T">전체교환</option>
						</select>
						
						<select id="orderSearchRefundStatus" name="orderSearchRefundStatus" class="fSelect" style="width:15%;">
							<option value="all">- 환불 선택 -</option>
							<option value="F">환불전</option>
							<option value="T">환불완료</option>
						</select>
					</div>
				</div>
				<div class="search__status" style="display: none;">
					<div class="cb__color" style="margin-bottom:10px;">
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>전체</span>
						</label>
						
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>상품 준비중</span>
						</label>
						
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>배송 준비중</span>
						</label>
						
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>배송 보류</span>
						</label>
						
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>배송 대기</span>
						</label>
						
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>배송 중</span>
						</label>
						
						<label>
							<input type="checkbox" name="orderStatus" value="">
							<span>배송 완료</span>
						</label>
					</div>
					<div>
						<select id="" name="orderSearchShipStatus" class="fSelect" style="width:15%;">
							<option value="all">- 입금전 취소 -</option>
							<option value="N10">상품준비중</option>
							<option value="N20">배송준비중</option>
							<option value="W">배송보류</option>
							<option value="F">배송대기</option>
							<option value="M">배송중</option>
							<option value="T">배송완료</option>
						</select>
						
						<select id="" name="orderSearchCancelStatus" class="fSelect" style="width:15%;">
							<option value="all">- 취소 -</option>
							<option value="C47">입금전취소-구매자</option>
							<option value="C48">입금전취소-판매자</option>
							<option value="C49">입금전취소-시스템</option>
							<option value="F">취소안함</option>
							<option value="M">부분취소</option>
							<option value="T">전체취소</option>
						</select>
						
						<select id="" name="orderSearchExchangeStatus" class="fSelect" style="width:15%;">
							<option value="all">- 교환 선택 -</option>
							<option value="F">교환안함</option>
							<option value="M">부분교환</option>
							<option value="T">전체교환</option>
						</select>
						
						<select id="" name="orderSearchRefundStatus" class="fSelect" style="width:15%;">
							<option value="all">- 반품 -</option>
							<option value="F">반품전</option>
							<option value="T">반품완료</option>
						</select>
						<select id="" name="orderSearchRefundStatus" class="fSelect" style="width:15%;">
							<option value="all">- 환불 -</option>
							<option value="F">환불전</option>
							<option value="T">환불완료</option>
						</select>
					</div>
				</div>
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
						<input id="search_date_order" type="hidden" name="search_date" value="" style="width:150px;">

						<div class="search_date_order date__picker" date_type="order" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
						<div class="search_date_order date__picker" date_type="order" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
						<div class="search_date_order date__picker" date_type="order" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
						<div class="search_date_order date__picker" date_type="order" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
						<div class="search_date_order date__picker" date_type="order" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
						<div class="search_date_order date__picker" date_type="order" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
						<div class="search_date_order date__picker" date_type="order" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
					</div>
					<div class="content__date__picker">
						<input id="order_from" class="date_param" type="date" name="order_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="order" onChange="dateParamChange(this);">
							<font>~</font>
						<input id="order_to" class="date_param" type="date" name="order_to" placeholder="To" readonly style="width:150px;" date_type="order" onChange="dateParamChange(this);">
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
			<div class="content__title">입금/결제 상태</div>
			<div class="content__row">
				<div class="rd__block">
					<input type="radio" id="paymentStatus1" class="radio__input" value="" name="paymentStatus" />
					<label for="paymentStatus1">전체</label>
					<input type="radio" id="paymentStatus2" class="radio__input" value="" name="paymentStatus" />
					<label for="paymentStatus2">입금 전</label>
					<input type="radio" id="paymentStatus3" class="radio__input" value="" name="paymentStatus" />
					<label for="paymentStatus3">추가 입금 대기</label>
					<input type="radio" id="paymentStatus4" class="radio__input" value="" name="paymentStatus" />
					<label for="paymentStatus4">입금 완료(수동)</label>
					<input type="radio" id="paymentStatus5" class="radio__input" value="" name="paymentStatus" />
					<label for="paymentStatus5">입금 완료(자동)</label>
					<input type="radio" id="paymentStatus6" class="radio__input" value="" name="paymentStatus" />
					<label for="paymentStatus6">결제 완료</label>
				</div>
			</div>
		</div>
		<div class="card__body--hide detail_hidden" style="display: none;">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원 구분</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="memberType1" class="radio__input" value="" name="memberType" />
							<label for="memberType1">전체</label>
							<input type="radio" id="memberType2" class="radio__input" value="" name="memberType" />
							<label for="memberType2">회원</label>
							
							<select class="fSelect" name="group_no" id="groupNo" style="width:163px;">
								<option value="all">전체등급</option>
								<option value="1">일반회원</option>
								<option value="5">ADER family</option>
							</select>
							<input type="radio" id="memberType3" class="radio__input" value="" name="memberType" />
							<label for="memberType3">비회원</label>
							
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
							<input type="radio" id="deliverType1" class="radio__input" value="" name="deliverType" />
							<label for="deliverType1">전체</label>
							<input type="radio" id="deliverType2" class="radio__input" value="" name="deliverType" />
							<label for="deliverType2">국내 배송</label>
							<input type="radio" id="deliverType3" class="radio__input" value="" name="deliverType" />
							<label for="deliverType3">해외 배송</label>
						</div>
					</div>
				</div>
				<div class="half__box__wrap" style="align-items:start;">
					<div class="content__title">배송 정보</div>
					<div class="content__row">
						<div class="rd__block" style="flex-wrap: wrap;">
							<input type="radio" id="deliverInfo1" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo1">묶음 배송</label>
							<input type="radio" id="deliverInfo2" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo2">재 배송</label>
							<input type="radio" id="deliverInfo3" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo3">배송 메시지 입력</label>
							<input type="radio" id="deliverInfo4" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo4">부분 배송</label>
							<input type="radio" id="deliverInfo5" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo5">예약 주문</label>
							<input type="radio" id="deliverInfo6" class="radio__input" value="" name="deliverInfo" />
							<label for="deliverInfo6">정기 배송(결제)</label>
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
							<input type="radio" id="paymentType1" class="radio__input" value="" name="paymentType" />
							<label for="paymentType1">전체</label>
							<input type="radio" id="paymentType2" class="radio__input" value="" name="paymentType" />
							<label for="paymentType2">수단 선택</label>
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
							<input type="radio" id="paymentCompany1" class="radio__input" value="" name="paymentCompany" />
							<label for="paymentCompany1">전체</label>
							<input type="radio" id="paymentCompany2" class="radio__input" value="" name="paymentCompany" />
							<label for="paymentCompany2">업체 선택</label>
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
							<input type="radio" id="orderRoute1" class="radio__input" value="" name="orderRoute" />
							<label for="orderRoute1">전체</label>
							<input type="radio" id="orderRoute2" class="radio__input" value="" name="orderRoute" />
							<label for="orderRoute2">경로 선택</label>
							<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">유입 경로</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="inflowRoute1" class="radio__input" value="" name="inflowRoute" />
							<label for="inflowRoute1">전체</label>
							<input type="radio" id="inflowRoute2" class="radio__input" value="" name="inflowRoute" />
							<label for="inflowRoute2">경로 선택</label>
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
		<h3>전체 주문 검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="justify-between info__wrap" >
			<div class="flex"style="gap:50px;">
				<div class="category__tab" tabNum="01" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">주문 번호별</div>
				<div class="category__tab" tabNum="02" style="height:30px;color:#707070;text-align:center;cursor:pointer;">품목 주문별</div>
			</div>
			<div class="flex justify-end content__row">
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

		<div class="table table__wrap tabNum tabNum_01">	
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
								<label>
									<input type="checkbox" name="selectAll1" value="">
									<span></span>
								</label>
							</div>
						</TH>
						<TH style="width:8%;">쇼핑몰</TH>
						<TH style="width:8%;">주문일 (결제일)</TH>
						<TH style="width:8%;">주문번호</TH>
						<TH style="width:5%;">주문자</TH>
						<TH style="width:8%;">상품명</TH>
						<TH style="width:8%;">상품명 (기본)</TH>
						<TH>총 상품 구매 금액</TH>
						<TH>총 실결제 금액</TH>
						<TH>결제 수단</TH>
						<TH>결제 싱테</TH>
						<TH style="width:3%;">미배송</TH>
						<TH style="width:3%;">배송중</TH>
						<TH style="width:3%;">배송<br>완료</TH>
						<TH style="width:3%;">취소</TH>
						<TH style="width:3%;">교환</TH>
						<TH style="width:3%;">반품</TH>
						<TH>목록 삭제</TH>
						<TH>메모</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>
							<div class="cb__color">
								<label>
									<input type="checkbox" name="select" value="">
									<span></span>
								</label>
							</div>
						</TD>
						<TD>
							한국어 쇼핑몰(한국어)
						</TD>
						<TD>
							2022-06-07 13:32:13<br>
							(2022-06-07 13:32:13))
						</TD>
						<TD>
							<font style="text-decoration:underline;">20220607-0000362</font>
							<div style="width:40px;height:20px;color:white;background-color:#3971FF;color:#ffffff;line-height:2;border-radius:5px;text-align:center;margin-top:5px;">첫 주문</div>
						</TD>
						<TD>
							<font style="text-decoration:underline;">한초롱</font><br>
							gksrldhs<br>
							[일반회원]<br>
							(총 1건)
						</TD>
						<TD>
							<font style="text-decoration:underline;">Tron angle bag<br>(P0000LLK)</font>
						</TD>
						<TD>
							<font style="text-decoration:underline;">Tron angle bag<br>(P0000LLK)</font>
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
							결제완료
						</TD>
						<TD>
							1
						</TD>
						<TD>
							0
						</TD>
						<TD>
							0
						</TD>
						<TD>
							0
						</TD>
						<TD>
							0
						</TD>
						<TD>
							0
						</TD>
						<TD>-</TD>
						<TD></TD>
					</TR>
					
				</TBODY>
			</TABLE>
		</div>
		<div class="table table__wrap tabNum tabNum_02" style="display:none;">
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
                                <label>
                                    <input type="checkbox" name="selectAll1" value="">
                                    <span></span>
                                </label>
                            </div>
                        </TH>
                        <TH style="width:8%;">쇼핑몰</TH>
                        <TH style="width:8%;">주문일 (결제일)</TH>
                        <TH style="width:8%;">품목별 주문번호</TH>
                        <TH style="width:5%;">주문자</TH>
                        <TH style="width:8%;">상품명/옵션</TH>
                        <TH style="width:8%;">상품명/옵션 (기본)</TH>
                        <TH style="width:3%;">수량</TH>
                        <TH>상품 구매 금액</TH>
                        <TH>총 실결제 금액</TH>
                        <TH>결제 수단</TH>
                        <TH>결제 싱테</TH>
                        <TH>주문 상태</TH>
                        <TH>운송장 정보</TH>
                        <TH>메모</TH>
                    </TR>
                </THEAD>
                <TBODY>
                    <TR>
                        <TD>
                            <div class="cb__color">
                                <label>
                                    <input type="checkbox" name="select" value="">
                                    <span></span>
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
                            결제완료
                        </TD>
                        <TD>
                            배송준비중
                        </TD>
                        <TD></TD>
                        <TD></TD>
                    </TR>
                  
                </TBODY>
            </TABLE>
		</div>
	</div>
</div>
