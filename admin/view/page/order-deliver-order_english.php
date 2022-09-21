<style>
.content__wrap{
	grid-template-columns: 170px 2fr !important;
}

</style>
<form id="" action="">
	<div class="content__card">
		<div class="card__header">
			<h3>주문관리/배송설정</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">택배사 수거신청 자동접수</div>
				<div class="content__row" style="display: block;">
					<div class="rd__block" style="margin-bottom: 10px;">
						<input type="radio" id="autoAppl2_1" class="radio__input" value="" name="autoAppl" checked="checked"/>
						<label for="autoAppl2_1">사용함</label>
						<input type="radio" id="autoAppl2_2" class="radio__input" value="" name="autoAppl"/>
						<label for="autoAppl2_2">사용안함</label>
					</div>
					<div class="cb__color">
						<label>
							<input type="checkbox" name="cancelAppl" value="" checked="checked">
							<span>구매자가 교환/반품 신청시 수거신청 자동접수</span>
						</label>
					</div>
				</div>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">배송완료 자동체크</div>
				<div class="content__row" style="display: block;">
					<div class="rd__block" style="margin-bottom:10px;">
						<input type="radio" id="autoCheck2_1" class="radio__input" value="" name="autoCheck" checked="checked"/>
						<label for="autoCheck2_1">사용함</label>
						<input type="radio" id="autoCheck2_2" class="radio__input" value="" name="autoCheck"/>
						<label for="autoCheck2_2">사용안함</label>
					</div>
					<div>
						<span>배송시작</span><input type="text" value="2" style="margin:0 5px; width:100px;"><span>일 후 배송완료 자동체크</span> 
					</div>
				</div>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">배송 추가설명</div>
				<div class="content__row" style="display: block;">
				<textarea style="padding:10px;width:100%;border:1px solid #000000;">-산간벽지나 도서지방은 별도의 추가금액을 지불하셔야 하는 경우가 있습니다.<br>고객님께서 주문하신 제품은 입금 확인 후 배송해드립니다. 다만, 제품종류에 따라서 제품의 배송이 다소 지연될 수 있습니다.<br></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="content__card">
		<div class="card__header">
			<h3>구매자 취소/교환/반품 신청 설정</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">취소/교환/반품 신청<br>사용설정</div>
				<div class="content__row" style="display: block;">
					<div class="rd__block" style="margin-bottom: 10px;">
						<input type="radio" id="refundFlg2_1" class="radio__input" value="" name="refundFlg"/>
						<label for="refundFlg2_1">사용함</label>
						<input type="radio" id="refundFlg2_2" class="radio__input" value="" name="refundFlg"/>
						<label for="refundFlg2_2">사용 안함</label>
					</div>
				</div>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">취소/교환/반품 신청버튼<br>노출 범위 설정</div>
				<div class="content__row">
					<div class="table table__wrap" style="width: 100%;">
						<TABLE>
							<THEAD>
								<TR>
									<TH>구분</TH>
									<TH>취소신청</TH>
									<TH>교환신청</TH>
									<TH>반품신청</TH>
								</TR>
							</THEAD>
							<TBODY>
								<TR>
									<TD>배송 전</TD>
									<TD>
										<div class="cb__color" style="display: block;">
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="cancelAppl" value="" checked>
												<span>상품 준비중</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="cancelAppl" value="" checked>
												<span>배송 준비중</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="cancelAppl" value="" checked>
												<span>배송 보류</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="cancelAppl" value="" checked>
												<span>배송 대기</span>
											</label>
										</div>
									</TD>
									<TD>
										<div class="cb__color" style="display: block;">
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="" checked>
												<span>입금 전</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="">
												<span>상품 준비중</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="" checked>
												<span>배송 준비중</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="" checked>
												<span>배송 보류</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="" checked>
												<span>배송 대기</span>
											</label>
										</div>
									</TD>
									<TD>-</TD>
								</TR>
								
								<TR>
									<TD>배송 후</TD>
									<TD>-</TD>
									<TD>
										<div class="cb__color" style="display: block;">
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="" checked>
												<span>배송 중</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="exchangeAppl" value="" checked>
												<span>배송 완료</span>
											</label>
										</div>
									</TD>
									<TD>
										<div class="cb__color" style="display: block;">
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="refundAppl" value="" checked>
												<span>배송 중</span>
											</label>
											
											<label style="justify-content: flex-start;">
												<input type="checkbox" name="refundAppl" value="" checked>
												<span>배송 완료</span>
											</label>
										</div>
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상품준비중 주문상태 사용</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="productReady2_1" class="radio__input" value="" name="productReady"/>
						<label for="productReady2_1">사용함</label>
						<input type="radio" id="productReady2_2" class="radio__input" value="" name="productReady"/>
						<label for="productReady2_2">사용안함</label>
					</div>
				</div>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">취소/교환/반품 신청버튼<br>노출기간 설정</div>
				<div class="content__row">
						* 기준일 :
						<select class="fSelect" name="cs_request_button_show_period_day_column" style="width:163px;margin-right:15px;">
							<option name="order_date" value="order_date">주문 완료일 기준</option>
							<option name="shipend_date" selected="selected" value="shipend_date">배송완료일 기준</option>
						</select>
						
						* 기준일 : 
						<input type="text" value="5" style="width:100px;">
						일 까지 노출
				</div>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">취소/교환/반품 신청시<br>배송비 안내</div>
				<div class="content__row" style="display: block;">
					<textarea style="padding:10px;width:100%;border:1px solid #000000;">취소/교환/반품하시는 제품 및 신청사유에 따라 배송비 환불 또는 추가 배송비가 발생할 수 있습니다.<br>배송비는 쇼핑몰 정책에 따라 책정됩니다.</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="content__card">
		<div class="card__header">
			<h3>구매자 부담 배송비 설정</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">교환 배송비(왕복) 설정</div>
				<div class="content__row">
					<input type="text" value="5000" style="width:200px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">반품 배송비(편도) 설정</div>
				<div class="content__row">
					<input type="text" value="2500" style="width:200px;">
				</div>
			</div>
		</div>
	</div>
	<div class="content__card">
		<div class="card__header">
			<h3>입금/환불/반품처리 설정</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap" style="align-items: self-start;">
				<div class="content__title">미입금 주문 자동 취소</div>
				<div class="content__row" style="display: block;">
					<div class="rd__block"style="display: block;">
						<input type="radio" id="autoCancel2_1" class="radio__input" value="" name="autoCancel"/>
						<label for="autoCancel2_1">사용함</label>
						<div style="margin: 10px 15px;display: grid;row-gap: 10px;">
							<div class="autoCancel__wrap2">
								<span>* 무통장입금 :</span>
								<select class="fSelect"  style="width:163px;margin-right:15px;">
									<option name="" value="">시간 단위</option>
								</select>
								<span>기준으로 주문</span>
								<select class="fSelect" style="width:163px;margin-right:15px;">
									<option name="" value="">1</option>
								</select>
								<span>시간 후 자동취소</span>
							</div>
							<div>
								<span>* 가상계좌 :</span>
								<span>주문</span>
								<select class="fSelect"  style="width:163px;margin-right:15px;">
									<option name="" value="">1</option>
								</select>
								<span>일 후 자동취소</span>
							</div>
							<div>
								<span>* 편의점결제 :</span>
								<span>주문</span>
								<select class="fSelect"  style="width:163px;margin-right:15px;">
									<option name="" value="">1</option>
								</select>
								<span>일 후 자동취소</span>
							</div>
						</div>
					</div>
					<div class="rd__block">
						<input type="radio" id="autoCancel2_2" class="radio__input" value="" name="autoCancel"/>
						<label for="autoCancel2_2">사용안함</label>
					</div>
				</div>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">주문관리 내 관리자 메모<br>연동 설정</div>
				<div class="content__row">
					<div class="rd__block" style="flex-direction: column;">
						<input type="radio" id="adminMemo2_1" class="radio__input" value="" name="adminMemo"/>
						<label for="adminMemo2_1">취소/반품/교환/환불 사유 입력시 관리자 메모에 연동함</label>
						<input type="radio" id="adminMemo2_2" class="radio__input" value="" name="adminMemo"/>
						<label for="adminMemo2_2">취소/반품/교환/환불 사유 입력시 관리자 메모에 연동안함</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content__card">
		<div class="card__header">
			<h3>배송비 설정</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="body__info--count">
				<h4>기본 설정</h4>
			</div>
			<div class="content__wrap">
				<div class="content__title">교환 배송비(왕복) 설정</div>
				<div class="content__row">
					<input type="text" value="5000" style="width:200px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">반품 배송비(편도) 설정</div>
				<div class="content__row">
					<input type="text" value="2500" style="width:200px;">
				</div>
			</div>
			<div class="body__info--count">
				<h4>개별 배송비 설정</h4>
			</div>
			<div class="content__wrap">
				<div class="content__title">상품별 개별 배송료 설정</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="deliverCostPerEachFlg2_1" type="radio" name="deliverCostPerEachFlg" value="" checked>
						<label for="deliverCostPerEachFlg2_1">사용함</label>
						
						<input id="deliverCostPerEachFlg2_2" type="radio" name="deliverCostPerEachFlg" value="">
						<label for="deliverCostPerEachFlg2_2">사용안함</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">개별 배송비 계산 기준 설정</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="deliverCostCalcFlg2_1" type="radio" name="deliverCostCalcFlg" value="" checked>
						<label for="deliverCostCalcFlg2_1">상품별로 배송비 계산</label>
						
						<input id="deliverCostCalcFlg2_2" type="radio" name="deliverCostCalcFlg" value="">
						<label for="deliverCostCalcFlg2_2">품목별로 배송비 계산</label>
					</div>
				</div>
			</div>
			<div class="body__info--count">
				<h4>무료 배송비 우선 설정</h4>
			</div>
			<div class="content__wrap">
				<div class="content__title">무료 배송비 우선 설정<br>적용 범위</div>
				<div class="content__row">
					<div class="cb__color">
						<label>
							<input type="checkbox" name="freeDeliverCostSettingRange" value="">
							<span>개별 배송비 포함</span>
						</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">무료 배송비 우선 설정<br>제외 범위</div>
				<div class="content__row">
					<div class="cb__color">
						<label>
							<input type="checkbox" name="freeDeliverCostExcluded" value="">
							<span>구매자가 교환/반품 신청시 수거신청 자동접수</span>
						</label>
					</div>
				</div>
			</div>


	
			<div class="body__info--count">
				<h4>배송 규격</h4>
			</div>
			<div class="content__wrap">
				<div class="content__title">무료 배송비 우선 설정<br>적용 범위<br>*단위 : cm</div>
				<div class="content__row">
					<div class="table table__wrap" style="width: 100%;">
					<TABLE>
						<THEAD>
							<TH>가로</TH>
							<TH>세로</TH>
							<TH>높이</TH>
						</THEAD>
						<TBODY>
							<TR>
								<TD>
									<input style="width: 30%;" type="text" value="">
								</TD>
								<TD>
									<input style="width: 30%;" type="text" value="">
								</TD>
								<TD>
									<input style="width: 30%;" type="text" value="">
								</TD>
							</TR>
						</TBODY>
					</TABLE>
					</div>
				</div>
			</div>
		
			<div class="body__info--count">
				<h4>배송 업체 목록</h4>
			</div>
			<div class="content__wrap" style="align-items: start;">
				<div class="content__title">교환 배송비(왕복) 설정</div>
				<div class="content__row">
					<div class="table table__wrap" style="width: 100%;">
					<TABLE >
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" value="">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>국내/해외</TH>
								<TH>배송업체명</TH>
								<TH>대표 연락처</TH>
								<TH>보조 연락처</TH>
								<TH>이메일</TH>
								<TH>기본 배송비</TH>
								<TH>홈페이지</TH>
								<TH>적용 후불 결제수단</TH>
								<TH>기본설정</TH>
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
								<TD>국내/해외</TD>
								<TD style="text-decoration:underline;">
									자체배송
								</TD>
								<TD>-</TD>
								<TD>-</TD>
								<TD></TD>
								<TD>0</TD>
								<TD></TD>
								<TD></TD>
								<TD>-</TD>
							</TR>
							
							<TR>
								<TD>
									<div class="cb__color">
										<label>
											<input type="checkbox" name="select" value="">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>국내/해외</TD>
								<TD style="text-decoration:underline;">
									CJ 대한통운
								</TD>
								<TD>1588-1255</TD>
								<TD>01000000000</TD>
								<TD>chbill@cjbill.net</TD>
								<TD>2,500</TD>
								<TD>https://www.doortodoor.co.kr/</TD>
								<TD></TD>
								<TD>기본</TD>
							</TR>
							
							<TR>
								<TD>
									<div class="cb__color">
										<label>
											<input type="checkbox" name="select" value="">
											<span></span>
										</label>
									</div>
								</TD>
								<TD>국내/해외</TD>
								<TD style="text-decoration:underline;">
									KGB 택배
								</TD>
								<TD>02-3272-7722</TD>
								<TD>-</TD>
								<TD></TD>
								<TD>2,500</TD>
								<TD></TD>
								<TD></TD>
								<TD>-</TD>
							</TR>
						</TBODY>
					</TABLE>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="content__card" style="padding: 20px;">
		<div class="justify-center btn__wrap--lg">
			<div  class="blue__color__btn" onClick=""><span>모든 항목 저장</span></div>
			<div class="defult__color__btn" onClick=""><span>초기화</span></div>
		</div>
	</div>
	<div class="content__card">
		<div class="card__header">
			<h3>스토어 픽업 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="body__info--count">
				<div class="drive--left"></div>
				총 등록 <font class="cnt_03_result info__count" >24,949</font>개
			</div>
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<input type="hidden" class="action_type" name="action_type">
						<input type="hidden" class="action_name" name="action_name">

						<div class="filter__btn" onClick="">삭제</div>
						<div class="filter__btn" onClick="">수령자등록</div>
					</div>
				</div>
				<TABLE>
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH style="width:20%;">수령자(지점 명)</TH>
							<TH>담당자 명</TH>
							<TH>대표 연락처</TH>
							<TH>보조 연락처</TH>
							<TH>영업시간</TH>
						</TR>
					</THEAD>
					<TBODY>
						<TR>
							<TD>
								<div class="cb__color">
									<label>
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TD>
							<TD>155</TD>
							<TD>???</TD>
							<TD>ADER</TD>
							<TD>-</TD>
							<TD>-</TD>
							<TD>-</TD>
						</TR>
						
						<TR>
							<TD>
								<div class="cb__color">
									<label>
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TD>
							<TD>154</TD>
							<TD>???</TD>
							<TD>ADER</TD>
							<TD>-</TD>
							<TD>-</TD>
							<TD>-</TD>
						</TR>
						
						<TR>
							<TD>
								<div class="cb__color">
									<label>
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TD>
							<TD>154</TD>
							<TD>???</TD>
							<TD>ADER</TD>
							<TD>-</TD>
							<TD>-</TD>
							<TD>-</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</div>
	</div>
	<div class="content__card">
		<div class="card__header">
			<h3>지역별 배송비 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="body__info--count">
				<div class="drive--left"></div>
				총 등록 <font class="cnt_03_result info__count" >24,949</font>개
			</div>
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<input type="hidden" class="action_type" name="action_type">
						<input type="hidden" class="action_name" name="action_name">

						<div class="filter__btn" onClick="">삭제</div>
						<div class="filter__btn" onClick="">등록</div>
						<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
					</div>
				</div>
				<TABLE>
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label class="width-150">
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TH>
							<TH>특수지역명(도서, 산간 등)</TH>
							<TH>우편번호 범위</TH>
							<TH style="width:40%;">배송비</TH>
						</TR>
					</THEAD>
					<TBODY>
						<TR>
							<TD>
								<div class="cb__color">
									<label class="width-150">
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TD>
							<TD>제주도</TD>
							<TD>[690003] 부터 [699949] 까지</TD>
							<TD> 3,000</TD>
						</TR>
						
						<TR>
							<TD>
								<div class="cb__color">
									<label class="width-150">
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TD>
							<TD>제주도_5자리</TD>
							<TD>[63078] 부터 [63615] 까지</TD>
							<TD> 3,000</TD>
						</TR>
						
						<TR>
							<TD>
								<div class="cb__color">
									<label class="width-150">
										<input type="checkbox" name="selectAll" value="">
										<span></span>
									</label>
								</div>
							</TD>
							<TD>제주도_5자리</TD>
							<TD>[63000] 부터 [63644] 까지</TD>
							<TD> 3,000</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</div>
	</div>
</form>
