<div class="row">
	<div class="row">
		<button class="refundTab" tabNum="01" style="width:150px; height:30px; border:1px solid #000000;background-color:#3CB3AB;color:#ffffff;font-weight:800;margin-right:10px;cursor:pointer;">입금 전 취소</button>
		<button class="refundTab" tabNum="02" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;">취소</button>
		<button class="refundTab" tabNum="03" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;">교환</button>
		<button class="refundTab" tabNum="04" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;">반품</button>
		<button class="refundTab" tabNum="05" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;">환불</button>
		<button class="refundTab" tabNum="06" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;">카드 취소 조회</button>
		<button class="refundTab" tabNum="07" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;cursor:pointer;">관리자 환불 관리</button>
	</div>
	
	<div class="portlet" style="margin-top:20px;">
		<div class="title">
			<h1 id="tabTitle">입금 전 취소 관리</h1>
		</div>
		
		<div class="body">
			<TABLE class="list">
				<colgroup>
					<col width="12%">
					<col width="38%">
					<col width="12%">
					<col width="38%">
				</colgroup>
				
				<TBODY>
					<TR>
						<TD>쇼핑몰</TD>
						<TD colspan="3">
							<select name="shop_no_order" id="shop_no_order" class="fSelect" style="width:163px">
								<option value="1" selected="selected">[기본]한국어 쇼핑몰(한국어)</option>
								<option value="2">영문몰(영어)</option>
								<option value="4">중어몰(중국어(간체))</option>
							</select>
						</TD>
					</TR>
					
					<TR>
						<TD>검색어</TD>
						<TD colspan="3">
							<div class="row">
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
						</TD>
					</TR>
					
					<TR>
						<TD>기간</TD>
						<TD colspan="3">
							<div class="row">
								<select name="date_type" style="width:115px;" class="fSelect disabled">
									<option value="order_date" selected="selected">주문일</option>
									<option value="memo_date">메모작성일</option>
									<option value="pay_date">결제일</option>
									<option value="shipready_date">송장번호입력일</option>
									<option value="shipbegin_date">배송시작일</option>
									<option value="shipend_date">배송완료일</option>
								</select>
								
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">오늘</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">어제</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">3일</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">7일</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">15일</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">1개월</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">3개월</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">6개월</button>
								<button style="width:50px;height:30px;border:1px solid;background-color:#ffffff;">1년</button>
								
								<input type="date" name="orderdate_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
								~
								<input type="date" name="orderdate_to" placeholder="To" readonly style="width:150px;">
								
								<button style="width:70px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">기간 설정</button>
							</div>
						</TD>
					</TR>
					
					<TR id="tr_product">
						<TD>상품</TD>
						<TD colspan="3">
							<div>
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
						</TD>
					</TR>
					
					<TR id="tr_deliverCompany">
						<TD>희망 배송업체/방식</TD>
						<TD colspan="3">
							<select name="HopeShipCompanyId" class="fSelect" style="width:163px;">
								<option value="all">- 희망배송업체 -</option>
								<option value="3">CJ대한통운</option>
								<option value="5">KGB택배</option>
								<option value="15">롯데택배</option>
								<option value="21">택배연동 EMS</option>
								<option value="22">우체국택배</option>
								<option value="24">CJ대한통운(연동)</option>
							</select>
						</TD>
					</TR>
					
					<TR id="tr_orderStatus">
						<TD>주문 상태</TD>
						<TD colspan="3">
							<div class="row form-group">
								<label>
									<input type="checkbox" name="orderStatus" value="" checked>
									<span>전체</span>
								</label>
								
								<div class="row orderStatusCheckbox refundTab_01" style="margin-top:0px;">
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>입금 전 취소 - 구매자</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>입금 전 취소 - 시스템</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>입금 전 취소 - 판매자</span>
									</label>
								</div>
								
								<div class="row orderStatusCheckbox refundTab_02" style="display:none;margin-top:0px;">
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>취소 신청</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>취소 처리중</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>취소 완료</span>
									</label>
								</div>
								
								<div class="row orderStatusCheckbox refundTab_03" style="display:none;margin-top:0px;">
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>교환 신청</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>교환 처리중</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>교환 완료</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>교환 준비</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>교환 보류</span>
									</label>
								</div>
								
								<div class="row orderStatusCheckbox refundTab_04" style="display:none;margin-top:0px;">
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>반품 신청</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>반품 처리중 (수거 전)</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>반품 처리중 (환불 전)</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>반품 처리중 (환불 보류)</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>반품 완료</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>반품 보류</span>
									</label>
								</div>
								
								<div class="row orderStatusCheckbox refundTab_05" style="display:none;margin-top:0px;">
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>환불 전</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>환불 완료</span>
									</label>
									
									<label>
										<input type="checkbox" name="orderStatus" value="" checked>
										<span>환불 보류</span>
									</label>
								</div>
								
								<div class="row orderStatusCheckbox refundTab_06" style="display:none;margin-top:0px;">
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
						</TD>
					</TR>
					
					<TR id="tr_deliverCompanyStatus" style="display:none;">
						<TD>배송업체/수거신청 상태</TD>
						<TD colspan="3">
							<div class="row form-group">
								<select name="ShipCompanyId" class="fSelect" style="width:163px;">
									<option value="all">- 배송업체 -</option>
									<option value="1">자체배송</option>
									<option value="3">CJ대한통운</option>
									<option value="5">KGB택배</option>
									<option value="15">롯데택배</option>
									<option value="21">택배연동 EMS</option>
									<option value="22">우체국택배</option>
									<option value="24">CJ대한통운(연동)</option>
								</select>

								<select name="PostExpressReturn" class="fSelect" style="width:163px;">
									<option value="all">- 수거신청상태 -</option>
									<option value="non_req">수거 미신청</option>
									<option value="before_req">수거 미접수</option>
									<option value="post_wait">수거접수대기(송장발급전)</option>
									<option value="post_fail">수거접수실패</option>
									<option value="post_req">수거접수완료(송장발급완료)</option>
									<option value="pickup_fail">미집하</option>
								</select>
							</div>
						</TD>
					</TR>
					
					<TR id="tr_refundWay" style="display:none;">
						<TD>환불 수단</TD>
						<TD>
							<select class="fSelect" name="RefundType" id="manage_type" style="width:163px;">
								<option value="all">전체</option>
								<option value="B">현금</option>
								<option value="C">신용카드</option>
								<option value="E">계좌이체</option>
								<option value="F">휴대폰</option>
								<option value="Z">후불</option>
								<option value="V">편의점</option>
								<option value="O">선불금</option>
								<option value="D">적립금</option>
								<option value="H">예치금</option>
								<option value="I">기타</option>
							</select>
						</TD>
						
						<TD>PG 취소 상태</TD>
						<TD>
							<select class="fSelect" name="RefundSubType" id="refund_sub_type" style="width:163px;">
								<option value="all" selected="selected">전체</option>
								<option value="F">취소전</option>
								<option value="M">부분취소완료</option>
								<option value="T">전체취소완료</option>
							</select>
						</TD>
					</TR>
					
					<TR id="tr_processStatus" style="display:none;">
						<TD>처리상태</TD>
						<TD colspan="3">
							<div class="row form-group">
								<label>
									<input type="checkbox" name="processStatus" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="checkbox" name="processStatus" value="" checked>
									<span>환불 전</span>
								</label>
								
								<label>
									<input type="checkbox" name="processStatus" value="" checked>
									<span>환불 완료</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR class="detail_hidden">
						<TD>회원 구분</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="memberType" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="radio" name="memberType" value="">
									<span>회원</span>
								</label>
								<select class="fSelect" name="group_no" id="groupNo" style="width:163px;">
									<option value="all">전체등급</option>
									<option value="1">일반회원</option>
									<option value="5">ADER family</option>
								</select>
								
								<label>
									<input type="radio" name="memberType" value="">
									<span>비회원</span>
								</label>
							</div>
						</TD>
						
						<TD>회원 정보</TD>
						<TD>
							<div class="row form-group">
								<label class="width-150">
									<input type="checkbox" name="memberInfo" value="">
									<span>특별 관리 회원</span>
								</label>
								
								<label class="width-150">
									<input type="checkbox" name="memberInfo" value="">
									<span>불량 회원</span>
								</label>
								
								<label class="width-150">
									<input type="checkbox" name="memberInfo" value="">
									<span>첫 주문</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR class="detail_hidden">
						<TD>배송 구분</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="deliverType" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="radio" name="deliverType" value="">
									<span>국내 배송</span>
								</label>
								
								<label>
									<input type="radio" name="deliverType" value="">
									<span>해외 배송</span>
								</label>
							</div>
						</TD>
						
						<TD>배송 정보</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="deliverInfo" value="" checked>
									<span>묶음 배송</span>
								</label>
								
								<label>
									<input type="radio" name="deliverInfo" value="">
									<span>재 배송</span>
								</label>
								
								<label>
									<input type="radio" name="deliverInfo" value="">
									<span>배송 메시지 입력</span>
								</label>
								
								<label>
									<input type="radio" name="deliverInfo" value="">
									<span>부분 배송</span>
								</label>
								
								<label>
									<input type="radio" name="deliverInfo" value="">
									<span>예약 주문</span>
								</label>
								
								<label>
									<input type="radio" name="deliverInfo" value="">
									<span>정기 배송(결제)</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR class="detail_hidden">
						<TD>금액 조건</TD>
						<TD>
							<div class="row form-group">
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
						</TD>
						
						<TD>주문 품목 수</TD>
						<TD>
							<div class="row">
								<input type="text" value="" style="width:100px;">
								~
								<input type="text" value="" style="width:100px;">
							</div>
						</TD>
					</TR>
					
					<TR class="detail_hidden">
						<TD>결제 수단</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="paymentType" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="radio" name="paymentType" value="">
									<span>수단 선택</span>
								</label>
								
								<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
							</div>
						</TD>
						
						<TD>할인 수단</TD>
						<TD>
							<div class="row form-group">
								<label class="width-150">
									<input type="checkbox" name="discountType" value="">
									<span>적립금</span>
								</label>
								
								<label class="width-150">
									<input type="checkbox" name="discountType" value="">
									<span>예치금</span>
								</label>
								
								<label class="width-150">
									<input type="checkbox" name="discountType" value="">
									<span>쿠폰</span>
								</label>
								
								<label class="width-150">
									<input type="checkbox" name="discountType" value="">
									<span>마켓 할인</span>
								</label>
								
								<label class="width-150">
									<input type="checkbox" name="discountType" value="">
									<span>할인 코드</span>
								</label>
							</div>
						</TD>
					</TR>
					
					<TR class="detail_hidden">
						<TD>결제 업체</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="paymentCompany" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="radio" name="paymentCompany" value="">
									<span>업체 선택</span>
								</label>
								
								<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
							</div>
						</TD>
						
						<TD>결제 정보</TD>
						<TD>
							<label class="width-150">
								<input type="checkbox" name="paymentInfo" value="">
								<span>에스크로</span>
							</label>
							
							<label class="width-150">
								<input type="checkbox" name="paymentInfo" value="">
								<span>전자 보증 보험</span>
							</label>
							
							<label class="width-150">
								<input type="checkbox" name="paymentInfo" value="">
								<span>추가 결제</span>
							</label>
						</TD>
					</TR>
					
					<TR class="detail_hidden">
						<TD>주문 경로</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="orderRoute" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="radio" name="orderRoute" value="">
									<span>경로 선택</span>
								</label>
								
								<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
							</div>
						</TD>
						
						<TD>유입 경로</TD>
						<TD>
							<div class="row form-group">
								<label>
									<input type="radio" name="inflowRoute" value="" checked>
									<span>전체</span>
								</label>
								
								<label>
									<input type="radio" name="inflowRoute" value="">
									<span>경로 선택</span>
								</label>
								
								<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;margin-left:15px;">설정</button>
							</div>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
			
			<div id="detail_toggle" toggle="hide" style="float:right;margin-top:10px;font-weight:800;cursor:pointer;">상세검색 열기</div>
			
			<div class="row" style="margin-top:20px;">
				<button style="width:80px;height:30px;border:1px solid;background-color:#ffffff;float:right;border-radius:5px;">초기화</button>
				<button style="width:80px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;float:right;border-radius:5px;margin-right:10px;">검색</button>
			</div>
		</div>
	</div>

	<div class="portlet">
		<div class="title">
			<h1>검색 결과</h1>
		</div>
		
		<div class="body">			
			<div class="tools">
				<a onclick="" class="btn has-tooltip">EXCEL<span class="tooltip left">엑셀 다운로드</span></a>
			</div>
			
			<div id="orderListByOrderItem" class="row">
				[ 검색결과 <font style="color:#3971FF;font-weight:800;">27,339</font>건]
				
				<div class="row form-group">
					<button style="width:50px;height:35px;border:1px solid;background-color:#ffffff;margin-left:15px;float:right;">설정</button>
					
					<select name="rows" class="fSelect" init_rows="100" style="width:163px;float:right;margin-right:10px;">
						<option value="10">10개씩보기</option>
						<option value="20" }="">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100" selected="">100개씩보기</option>
						<option value="200">200개씩보기</option>
						<option value="300">300개씩보기</option>
						<option value="500">500개씩보기</option>
					</select>
					
					<select name="searchSorting" class="fSelect" style="width:163px;float:right;margin-right:10px;">
						<option value="order_asc">주문일순</option>
						<option value="order_desc" selected="">주문일역순</option>
						<option value="settle_price_asc">총 실결제금액순</option>
						<option value="settle_price_desc">총 실결제금액역순</option>
					</select>
					
					<label class="width-150" style="float:right;">
						<input type="checkbox" name="receiverInfo" value="">
						<span>수령자 정보 표시</span>
					</label>
				</div>
				
				<div style="overflow:scroll;width::100%;">
					<TABLE class="list" style="margin-top:10px;width:150%;font-size:0.5rem;">
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="row form-group">
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
									<div class="row form-group">
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
	</div>
</div>

<script>
$(document).ready(function() {
	$('.refundTab').click(function() {
		var tabNum = $(this).attr('tabNum');
		var tabTitle = $(this).text();
		$('#tabTitle').text(tabTitle);
		
		$(this).css('background-color','#3CB3AB');
		$(this).css('color','#ffffff');
		$(this).css('font-weight','800');
		
		$('.refundTab').not($(this)).css('background-color','#ffffff');
		$('.refundTab').not($(this)).css('color','#000000');
		$('.refundTab').not($(this)).css('font-weight','500');
		
		switch (tabNum) {
			case "01":
				$('#tr_product').show();
				$('#tr_deliverCompany').show();
				$('#tr_orderStatus').show();
				$('#tr_deliverCompanyStatus').hide();
				$('#tr_refundWay').hide();
				$('#tr_processStatus').hide();
				break;
			case "02":
				$('#tr_product').show();
				$('#tr_deliverCompany').show();
				$('#tr_orderStatus').show();
				$('#tr_deliverCompanyStatus').hide();
				$('#tr_refundWay').hide();
				$('#tr_processStatus').hide();
				break;
			case "03":
				$('#tr_product').show();
				$('#tr_deliverCompany').show();
				$('#tr_orderStatus').show();
				$('#tr_deliverCompanyStatus').show();
				$('#tr_refundWay').hide();
				$('#tr_processStatus').hide();
				break;
			case "04":
				$('#tr_product').show();
				$('#tr_deliverCompany').show();
				$('#tr_orderStatus').show();
				$('#tr_deliverCompanyStatus').show();
				$('#tr_refundWay').hide();
				$('#tr_processStatus').hide();
				break;
			case "05":
				$('#tr_product').show();
				$('#tr_deliverCompany').show();
				$('#tr_orderStatus').show();
				$('#tr_deliverCompanyStatus').hide();
				$('#tr_refundWay').show();
				$('#tr_processStatus').hide();
				break;
			case "06":
				$('#tr_product').show();
				$('#tr_deliverCompany').show();
				$('#tr_orderStatus').show();
				$('#tr_deliverCompanyStatus').hide();
				$('#tr_refundWay').hide();
				$('#tr_processStatus').hide();
				break;
			case "07":
				$('#tr_product').hide();
				$('#tr_orderStatus').hide();
				$('#tr_deliverCompanyStatus').hide();
				$('#tr_refundWay').hide();
				$('#tr_processStatus').show();
				break;
		}
		
		$('.orderStatusCheckbox ').hide();
		$('.refundTab_' + tabNum).show();
	});
	
	$('.detail_hidden').hide();
	
	$('#detail_toggle').click(function() {
		if ($(this).attr('toggle') == 'hide') {
			$(this).attr('toggle','show');
			$('#detail_toggle').text('상세검색 닫기');
		} else {
			$(this).attr('toggle','hide');
			$('#detail_toggle').text('상세검색 열기');
		}
		$('.detail_hidden').toggle();
	});
});
</script>
