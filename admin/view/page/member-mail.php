<?php include_once("check.php"); ?>

<div class="content__card">
	<div class="card__header">
		<h3>자동메일발송 설정</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table table__wrap">
			<table>
				<THEAD>
					<TR>
						<TH>메일항목</TH>
						<TH>고객</TH>
						<TH>운영자</TH>
						<TH>수정</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>신규가입</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig01">
									<input id="mailConfig01" type="checkbox" name=" memberRoute01"  value="mailConfig01">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig02">
									<input id="mailConfig02" type="checkbox" name=" memberRoute01"  value="mailConfig01">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>가입해지</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig02_1">
									<input id="mailConfig02_1" type="checkbox" name=" mailConfig02"  value="mailConfig02">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
							
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig02_2">
									<input id="mailConfig02_2" type="checkbox" name=" mailConfig02"  value="mailConfig02">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>아이디/비밀번호 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig03_1">
									<input id="mailConfig03_1" type="checkbox" name=" mailConfig03"  value="mailConfig03">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>신규회원 인증요청</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig04_1">
									<input id="mailConfig04_1" type="checkbox" name=" mailConfig04"  value="mailConfig04">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig04_2">
									<input id="mailConfig04_2" type="checkbox" name=" mailConfig04"  value="mailConfig04">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>회원 인증확인</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig05_1">
									<input id="mailConfig05_1" type="checkbox" name=" mailConfig05"  value="mailConfig05">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig05_2">
									<input id="mailConfig05_2" type="checkbox" name=" mailConfig05_2"  value="mailConfig05">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>신규주문 내역확인</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig06_1">
									<input id="mailConfig06_1" type="checkbox" name=" mailConfig06"  value="mailConfig06">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig06_2">
									<input id="mailConfig06_2" type="checkbox" name=" mailConfig06"  value="mailConfig06">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>발송조치(완전배송시)</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig07_1">
									<input id="mailConfig07_1" type="checkbox" name=" mailConfig07"  value="mailConfig07">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig07_2">
									<input id="mailConfig07_2" type="checkbox" name=" mailConfig07"  value="mailConfig07">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>발송조치(부분배송시)</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig08_1">
									<input id="mailConfig08_1" type="checkbox" name=" mailConfig08"  value="mailConfig08">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig08_2">
									<input id="mailConfig08_2" type="checkbox" name=" mailConfig08"  value="mailConfig08">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송완료</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig09_1">
									<input id="mailConfig09_1" type="checkbox" name=" mailConfig09"  value="mailConfig09">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig09_2">
									<input id="mailConfig09_2" type="checkbox" name=" mailConfig09"  value="mailConfig09">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>취소/교환/반품 신청</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig10_1">
									<input id="mailConfig10_1" type="checkbox" name=" mailConfig10"  value="mailConfig10">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig10_2">
									<input id="mailConfig10_2" type="checkbox" name=" mailConfig10"  value="mailConfig10">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>취소/교환/반품 접수처리</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig11_1">
									<input id="mailConfig11_1" type="checkbox" name=" mailConfig11"  value="mailConfig11">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig11_2">
									<input id="mailConfig11_2" type="checkbox" name=" mailConfig11"  value="mailConfig11">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>취소/교환/반품 접수거부</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig12_1">
									<input id="mailConfig12_1" type="checkbox" name=" mailConfig12"  value="mailConfig12">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig12_2">
									<input id="mailConfig12_2" type="checkbox" name=" mailConfig12"  value="mailConfig12">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>환불완료</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig13_1">
									<input id="mailConfig13_1" type="checkbox" name=" mailConfig13"  value="mailConfig13">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig13_2">
									<input id="mailConfig13_2" type="checkbox" name=" mailConfig13"  value="mailConfig13">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>온라인 견적 내역</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig14_1">
									<input id="mailConfig14_1" type="checkbox" name=" mailConfig14"  value="mailConfig14">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>재고부족 안내</TD>
						<TD></TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig15_1">
									<input id="mailConfig15_1" type="checkbox" name=" mailConfig15"  value="mailConfig15">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>공급사 발주</TD>
						<TD></TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>답글 작성시 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig17_1">
									<input id="mailConfig17_1" type="checkbox" name=" mailConfig17"  value="mailConfig17">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig17_2">
									<input id="mailConfig17_2" type="checkbox" name=" mailConfig17"  value="mailConfig17">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>새 게시글 작성시 안내</TD>
						<TD></TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig18_1">
									<input id="mailConfig18_1" type="checkbox" name=" mailConfig18"  value="mailConfig18">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>추천메일</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig19">
									<input id="mailConfig19" type="checkbox" name=" mailConfig19"  value="mailConfig19">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>상품 조르기</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig20">
									<input id="mailConfig20" type="checkbox" name=" mailConfig20"  value="mailConfig20">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>대량구매 문의/답변</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig21_1">
									<input id="mailConfig21_1" type="checkbox" name=" mailConfig21"  value="mailConfig21">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig21_2">
									<input id="mailConfig21_2" type="checkbox" name=" mailConfig21"  value="mailConfig21">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					<TR>
						<TD>적립금 소멸안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig22">
									<input id="mailConfig22" type="checkbox" name=" mailConfig23"  value="mailConfig23">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					<TR>
						<TD>1:1 맞춤상담 답변시 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig23">
									<input id="mailConfig23" type="checkbox" name=" mailConfig23"  value="mailConfig23">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>긴급문의 답변시 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig24">
									<input id="mailConfig24" type="checkbox" name=" mailConfig24"  value="mailConfig24">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>비회원 결제 비밀번호 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig25">
									<input id="mailConfig25" type="checkbox" name=" mailConfig25"  value="mailConfig25">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>개별메일발송</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig26">
									<input id="mailConfig26" type="checkbox" name=" mailConfig26"  value="mailConfig26">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>휴면회원안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig27">
									<input id="mailConfig27" type="checkbox" name=" mailConfig27"  value="mailConfig27">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
											
					<TR>
						<TD>회원가입정보 인증</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig28">
									<input id="mailConfig28" type="checkbox" name=" mailConfig28"  value="mailConfig28">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>배송 지연 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig29">
									<input id="mailConfig29" type="checkbox" name=" mailConfig29"  value="mailConfig29">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>상품 품절 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig30">
									<input id="mailConfig30" type="checkbox" name=" mailConfig30"  value="mailConfig30">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>본인확인 인증번호 발송</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig31">
									<input id="mailConfig31" type="checkbox" name=" mailConfig31"  value="mailConfig31">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>기념일(생일) 쿠폰 발급 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig32">
									<input id="mailConfig32" type="checkbox" name=" mailConfig32"  value="mailConfig32">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>기념일(결혼) 쿠폰 발급 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig33">
									<input id="mailConfig33" type="checkbox" name=" mailConfig33"  value="mailConfig33">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
					
					<TR>
						<TD>쿠폰 발급 안내</TD>
						<TD>
							<div class="justify-center cb__color">
								<label for="mailConfig34">
									<input id="mailConfig34" type="checkbox" name=" mailConfig34"  value="mailConfig34">
									<span class="checkbox__text">사용함</span> 
								</label>
							</div>
						</TD>
						<TD></TD>
						<TD>
							<div class="btn__wrap--sm" style="justify-content: start;">
								<div class="defult__color__btn"><span>수정</span></div>
								<div class="defult__color__btn"><span>미리보기</span></div>
							</div>
						</TD>
					</TR>
				</TBODY>
			</table>
			<div class="flex justify-end" style="margin-top:20px;">  
				<!-- <div class="btn__wrap--sm">
					<div class="defult__color__btn"><span>항목추가</span></div>
					<div class="defult__color__btn"><span>항목삭제</span></div>
				</div> -->
				<div style="width: 110px;height: 28px; text-align: center;" class="black-btn"><span>저장</span></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	
});
</script>
