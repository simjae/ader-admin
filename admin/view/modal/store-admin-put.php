<style>
.table__toggle__btn {
	cursor:pointer;
	background-color:#000;
	color:#fff;
	width:110px;
	height:28px;
	text-align:center;
	font-size:12px;
	font-weight:300;
	border-radius:2px;
	line-height:2.4;
}
</style>

<div class="body">
	<h1>
		관리자 정보 관리
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
    <div class="contents">
		<form id="frm-list" action="store/admin/modal/put">
			<input type="hidden" name="member_idx" value="">
			<h2>기본 정보</h2>
			<div class="form-group">
				<input type="text" name="id" minlength="3" maxlength="15" value="" required="">
				<label class="control-label">아이디</label>
			</div>

			<div class="form-group">
				<input type="text" name="name" minlength="2" maxlength="10" value="" class="width-150" required="">
				<label class="control-label">이름</label>
			</div>

			<div class="form-group">
				<input type="password" name="current_pw" minlength="4" maxlength="20">
				<label class="control-label">현재 비밀번호</label>
			</div>

			<div class="form-group">
				<input type="password" name="pwchg" minlength="4" maxlength="20">
				<label class="control-label">비밀번호 변경</label>
			</div>

			<div class="form-group">
				<input type="password" name="pwchg_confirm" minlength="4" maxlength="20">
				<label class="control-label">비밀번호 변경 확인</label>
			</div>
			
			<h2>추가 정보</h2>
			<div class="form-group">
				<span class="btn btn-large blue">
					<i class="xi-image"></i> 선택
					<input class="input-image profile_img" type="file" name="profile_img">
				</span><br>
				<img id="profile_img" class="preview" src="/images/ico-avatar.png">
				<label class="control-label">프로필사진</label>
			</div>
			<div class="form-group">
				<input type="text" name="NICK" value="" minlength="2" maxlength="10" class="width-150">
				<label class="control-label">닉네임</label>
			</div>
			<div class="form-group">
				<input type="text" name="EMAIL" value="">
				<label class="control-label">이메일</label>
			</div>
			<div class="form-group">
				<label class="control-label">연락처</label>
				<div class="form-row">
					<input type="text" name="TEL" value="" maxlength="13" class="width-150 phone">
					<span class="-describe"></span>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="FAX" value="" maxlength="13" class="width-150 phone">
				<label class="control-label">팩스</label>
			</div>
			<div class="form-group">
				<input type="text" name="MOBILE" value="" maxlength="13" class="width-150 phone">
				<label class="control-label">휴대폰</label>
			</div>
			
			<h2>권한</h2>
			<div class="form-group" style="padding-left:0px;">
				<div id="table_toggle_store" class="table__toggle__btn" style="margin-top:15px;">+상점관리</div>
				<TABLE class="list table_toggle_store" style="margin-top:10px;font-size:0.5rem;display:none;">
					<TBODY>
						<TR>
							<TD rowspan="10" style="width:100px;">상점관리</TD>
						</TR>
						
						<TR>
							<TD rowspan="4" style="width:100px;">기본정보관리</TD>
						</TR>
						
						<TR>
							<TD>한국몰</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_info_kr_false" type="radio" name="store_info_kr" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_info_kr_true" type="radio" name="store_info_kr" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						
						<TR>
							<TD>영문몰</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_info_en_false" type="radio" name="store_info_en" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_info_en_true" type="radio" name="store_info_en" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						
						<TR>
							<TD>중문몰</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_info_cn_false" type="radio" name="store_info_cn" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_info_cn_true" type="radio" name="store_info_cn" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>운영자 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_admin_false" type="radio" name="store_admin" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_admin_true" type="radio" name="store_admin" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>홈패이제 내 알림메시지 설정</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_notice_false" type="radio" name="store_notice" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_notice_true" type="radio" name="store_notice" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>부가서비스 이용내역 조회</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_add_on_false" type="radio" name="store_add_on" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>							
								<div class="row form-group">
									<label>
										<input id="store_add_on_true" type="radio" name="store_add_on" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>검색엔진 최적화 설정</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_seo_false" type="radio" name="store_seo" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_seo_true" type="radio" name="store_seo" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>채널관리(마케팅)</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_channel_false" type="radio" name="store_channel" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="store_channel_true" type="radio" name="store_channel" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
				
				<div id="table_toggle_member" class="table__toggle__btn" style="margin-top:15px;">+고객관리</div>
				<TABLE class="list table_toggle_member" style="margin-top:15px;font-size:0.5rem;display:none;">
					<TBODY>
						<TR>
							<TD rowspan="17" style="width:100px;">고객관리</TD>
						</TR>
						
						<TR>
							<TD rowspan="7" style="width:100px;">회원조회</TD>
						</TR>
						
						<TR>
							<TD>회원조회</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_list_false" type="radio" name="member_info_member_list" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_list_true" type="radio" name="member_info_member_list" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>휴면회원</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_sleep_false" type="radio" name="member_info_member_sleep" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_sleep_true" type="radio" name="member_info_member_sleep" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>탈퇴회원</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_drop_false" type="radio" name="member_info_member_drop" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_drop_true" type="radio" name="member_info_member_drop" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>주문회원</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_order_false" type="radio" name="member_info_member_order" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_order_true" type="radio" name="member_info_member_order" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>구매액순 조회</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_price_false" type="radio" name="member_info_member_price" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_price_true" type="radio" name="member_info_member_price" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>회원등급 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_level_false" type="radio" name="member_info_member_level" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_info_member_level_true" type="radio" name="member_info_member_level" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD rowspan="4">회원 방문관리</TD>
						</TR>
						
						<TR>
							<TD>회원 로그인 관리</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_visit_member_login_false" type="radio" name="member_visit_member_login" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>							
								<div class="row form-group">
									<label>
										<input id="member_visit_member_login_true" type="radio" name="member_visit_member_login" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>부정의심 로그인 관리</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_visit_member_suspicious_false" type="radio" name="member_visit_member_suspicious" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>							
								<div class="row form-group">
									<label>
										<input id="member_visit_member_suspicious_true" type="radio" name="member_visit_member_suspicious" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>OFF 방문기록</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_visit_member_offline_false" type="radio" name="member_visit_member_offline" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>							
								<div class="row form-group">
									<label>
										<input id="member_visit_member_offline_true" type="radio" name="member_visit_member_offline" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>적립금 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_reserve_false" type="radio" name="member_reserve" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_reserve_true" type="radio" name="member_reserve" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>쿠폰관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_coupon_false" type="radio" name="member_coupon" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_coupon_true" type="radio" name="member_coupon" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>재입고 SMS<br>발송 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_sms_false" type="radio" name="member_sms" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_sms_true" type="radio" name="member_sms" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>자동 메일<br>발송 설정</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_mail_false" type="radio" name="member_mail" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_mail_true" type="radio" name="member_mail" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>SMS(카카오톡)<br>사용 설정</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_kakao_false" type="radio" name="member_kakao" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="member_kakao_true" type="radio" name="member_kakao" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
				
				<div id="table_toggle_product" class="table__toggle__btn" style="margin-top:15px;">+상품관리</div>
				<TABLE class="list table_toggle_product" style="margin-top:15px;font-size:0.5rem;display:none;">
					<TBODY>
						<TR>
							<TD rowspan="18" style="width:100px;">상품관리</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>상품 분류 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_classify_false" type="radio" name="product_classify" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_classify_true" type="radio" name="product_classify" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>개별 상품 등록</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_register_false" type="radio" name="product_register" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_register_true" type="radio" name="product_register" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>세트 상품 등록</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_set_false" type="radio" name="product_set" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_set_true" type="radio" name="product_set" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD rowspan="3">엑셀 등록</TD>
						</TR>
						
						<TR>
							<TD>엑셀 상품 등록</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_excel_regist_false" type="radio" name="product_excel_regist" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_excel_regist_true" type="radio" name="product_excel_regist" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>엑셀 상품 수정</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_excel_update_false" type="radio" name="product_excel_update" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_excel_update_true" type="radio" name="product_excel_update" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>상품 목록</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_list_false" type="radio" name="product_list" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_list_true" type="radio" name="product_list" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>상품 정보 일괄변경</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_update_false" type="radio" name="product_update" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_update_true" type="radio" name="product_update" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD rowspan="3">삭제 상품 목록</TD>
						</TR>
						
						<TR>
							<TD>삭제 상품 목록</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_delete_delete_product_false" type="radio" name="product_delete_delete_product" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_delete_delete_product_true" type="radio" name="product_delete_delete_product" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>개인 결제 목록</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_delete_personal_order_false" type="radio" name="product_delete_personal_order" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_delete_personal_order_true" type="radio" name="product_delete_personal_order" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD rowspan="4">상품 재고 관리</TD>
						</TR>
						
						<TR>
							<TD>상품재고 등록</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_stock_register_false" type="radio" name="product_stock_register" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="product_stock_register_true" type="radio" name="product_stock_register" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>상품 재고 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_stock_list_false" type="radio" name="product_stock_list" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="product_stock_list_true" type="radio" name="product_stock_list" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>품절 재고 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_stock_sold_out_false" type="radio" name="product_stock_sold_out" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="product_stock_sold_out_true" type="radio" name="product_stock_sold_out" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>블루마크</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_bluemark_false" type="radio" name="product_bluemark" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="product_bluemark_true" type="radio" name="product_bluemark" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>추천 상품</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="product_recommend_false" type="radio" name="product_recommend" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="product_recommend_true" type="radio" name="product_recommend" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
				
				<div id="table_toggle_display" class="table__toggle__btn" style="margin-top:15px;">+전시관리</div>
				<TABLE class="list table_toggle_display" style="margin-top:15px;font-size:0.5rem;display:none;">
					<TBODY>
						<TR>
							<TD rowspan="20" style="width:100px;">전시관리</TD>
						<TR>
						
						<TR>
							<TD>-</TD>
							<TD>상품 진열</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_product_false" type="radio" name="display_product" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_product_true" type="radio" name="display_product" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD rowspan="5">게시판 관리</TD>
						</TR>
						
						<TR>
							<TD>1:1문의</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_inquiry_false" type="radio" name="display_board_inquiry" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_inquiry_true" type="radio" name="display_board_inquiry" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>후기 게시판</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_review_false" type="radio" name="display_board_review" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_review_true" type="radio" name="display_board_review" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>공지사항</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_notice_false" type="radio" name="display_board_notice" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_notice_true" type="radio" name="display_board_notice" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>FAQ</TD>
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_faq_false" type="radio" name="display_board_faq" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_board_faq_true" type="radio" name="display_board_faq" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD rowspan="5">게시물 관리</TD>
						</TR>
						
						<TR>
							<TD>컬렉션</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_collection_false" type="radio" name="display_posting_collection" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_collection_true" type="radio" name="display_posting_collection" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>에디토리얼</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_editorial_false" type="radio" name="display_posting_editorial" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_editorial_true" type="radio" name="display_posting_editorial" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>콜라보레이션</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_collaboration_false" type="radio" name="display_posting_collaboration" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_collaboration_true" type="radio" name="display_posting_collaboration" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>기획전</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_exhibition_false" type="radio" name="display_posting_exhibition" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_posting_exhibition_true" type="radio" name="display_posting_exhibition" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>What's New 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_whats_false" type="radio" name="display_whats" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_whats_true" type="radio" name="display_whats" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>팝업관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_popup_false" type="radio" name="display_popup" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_popup_true" type="radio" name="display_popup" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>이벤트 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_event_false" type="radio" name="display_event" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_event_true" type="radio" name="display_event" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>-</TD>
							<TD>드로우 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_draw_false" type="radio" name="display_draw" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_draw_true" type="radio" name="display_draw" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>메뉴 편집</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_menu_false" type="radio" name="display_menu" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="display_menu_true" type="radio" name="display_menu" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>매장보기 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_store_false" type="radio" name="display_store" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_store_true" type="radio" name="display_store" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>-</TD>
							<TD>랜딩페이지 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="display_landing_false" type="radio" name="display_landing" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="display_landing_true" type="radio" name="display_landing" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
				
				<div id="table_toggle_order" class="table__toggle__btn" style="margin-top:15px;">+주문관리</div>
				<TABLE class="list table_toggle_order" style="margin-top:15px;font-size:0.5rem;display:none;">
					<TBODY>
						<TR>
							<TD rowspan="7" style="width:100px;">주문관리</TD>
						</TR>
						
						<TR>
							<TD>전체 주문 조회</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_list_false" type="radio" name="order_list" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">	
									<label>
										<input id="order_list_true" type="radio" name="order_list" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>취소/교환/반품/환불 관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_management_false" type="radio" name="order_management" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_management_true" type="radio" name="order_management" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>자동입금 내역확인</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_deposit_false" type="radio" name="order_deposit" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_deposit_true" type="radio" name="order_deposit" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>배송 설정</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_deliver_false" type="radio" name="order_deliver" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_deliver_true" type="radio" name="order_deliver" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>현금영수증<br>관리</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_receipt_false" type="radio" name="order_receipt" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_receipt_true" type="radio" name="order_receipt" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>

						<TR>
							<TD>관리자 메모 조회</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_admin_false" type="radio" name="order_admin" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="order_admin_true" type="radio" name="order_admin" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
				
				<div id="table_toggle_analysis" class="table__toggle__btn" style="margin-top:15px;">+분석/대시보드</div>
				<TABLE class="list table_toggle_analysis" style="margin-top:15px;font-size:0.5rem;display:none;">
					<TBODY>
						<TR>
							<TD rowspan="3" style="width:100px;">분석/대시보드</TD>
						</TR>
						
						<TR>
							<TD>통합엑셀 다운로드</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="analysis_excel_false" type="radio" name="analysis_excel" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="analysis_excel_true" type="radio" name="analysis_excel" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>대시보드</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="analysis_dashboard_false" type="radio" name="analysis_dashboard" value="false" checked>
										<span>불가</span>
									</label>
								</div>
							</TD>
							
							<TD>
								<div class="row form-group">
									<label>
										<input id="analysis_dashboard_true" type="radio" name="analysis_dashboard" value="true">
										<span>허가</span>
									</label>
								</div>
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="updateBtnAction();" class="btn red"><i class="xi-check"></i>적용</a>
	</div>
</div>
<script>
$(document).ready(function() {
	$.ajax({
		type: "post",
		data: { 'idx' : <?=$idx?> },
		dataType: "json",
		url: config.api + "store/admin/modal/get",
		error: function() {
			alert("운영자 정보 불러오기가 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
				$("input[name='member_idx']").val(data['data'][0].idx);
				$("input[name='EMAIL']").val(data['data'][0].email);
				$("input[name='FAX']").val(data['data'][0].fax);
				$("input[name='id']").val(data['data'][0].id);
				$("input[name='MOBILE']").val(data['data'][0].mobile);
				$("input[name='name']").val(data['data'][0].name);
				$("input[name='NICK']").val(data['data'][0].nick);
				$("input[name='TEL']").val(data['data'][0].tel);
				$("input[name='pw']").val(data['data'][0].pw);
				$("select[name=permit]").val(data['data'][0].permit).prop("selected", true);
				
				var profile_img = data['data'][0].img_location;
				if (profile_img != null) {
					profile_img = profile_img.replace('/var/www/admin/www','');
					$('#profile_img').attr('src',profile_img);
				} else {
					$('#profile_img').attr('src','/images/ico-avatar.png');
				}
				
				permitionRadioCheck('store_info_kr',data['data'][0].store_info_kr);
				permitionRadioCheck('store_info_en',data['data'][0].store_info_en);
				permitionRadioCheck('store_info_cn',data['data'][0].store_info_cn);
				permitionRadioCheck('store_admin',data['data'][0].store_admin);
				permitionRadioCheck('store_notice',data['data'][0].store_notice);
				permitionRadioCheck('store_add_on',data['data'][0].store_add_on);
				permitionRadioCheck('store_seo',data['data'][0].store_seo);
				permitionRadioCheck('store_channel',data['data'][0].store_channel);
				
				permitionRadioCheck('member_info_member_list',data['data'][0].member_info_member_list);
				permitionRadioCheck('member_info_member_sleep',data['data'][0].member_info_member_sleep);
				permitionRadioCheck('member_info_member_drop',data['data'][0].member_info_member_drop);
				permitionRadioCheck('member_info_member_order',data['data'][0].member_info_member_order);
				permitionRadioCheck('member_info_member_price',data['data'][0].member_info_member_price);
				permitionRadioCheck('member_info_member_level',data['data'][0].member_info_member_level);
				permitionRadioCheck('member_visit_member_login',data['data'][0].member_visit_member_login);
				permitionRadioCheck('member_visit_member_suspicious',data['data'][0].member_visit_member_suspicious);
				permitionRadioCheck('member_visit_member_offline',data['data'][0].member_visit_member_offline);
				permitionRadioCheck('member_reserve',data['data'][0].member_reserve);
				permitionRadioCheck('member_coupon',data['data'][0].member_coupon);
				permitionRadioCheck('member_sms',data['data'][0].member_sms);
				permitionRadioCheck('member_mail',data['data'][0].member_mail);
				permitionRadioCheck('member_kakao',data['data'][0].member_kakao);
				
				permitionRadioCheck('product_classify',data['data'][0].product_classify);
				permitionRadioCheck('product_register',data['data'][0].product_register);
				permitionRadioCheck('product_set',data['data'][0].product_set);
				permitionRadioCheck('product_excel_regist',data['data'][0].product_excel_regist);
				permitionRadioCheck('product_excel_update',data['data'][0].product_excel_update);
				permitionRadioCheck('product_list',data['data'][0].product_list);
				permitionRadioCheck('product_update',data['data'][0].product_update);
				permitionRadioCheck('product_delete_delete_product',data['data'][0].product_delete_delete_product);
				permitionRadioCheck('product_delete_personal_order',data['data'][0].product_delete_personal_order);
				permitionRadioCheck('product_stock_register',data['data'][0].product_stock_register);
				permitionRadioCheck('product_stock_list',data['data'][0].product_stock_list);
				permitionRadioCheck('product_stock_sold_out',data['data'][0].product_stock_sold_out);
				permitionRadioCheck('product_bluemark',data['data'][0].product_bluemark);
				permitionRadioCheck('product_recommend',data['data'][0].product_recommend);
				
				permitionRadioCheck('display_product',data['data'][0].display_product);
				permitionRadioCheck('display_board_inquiry',data['data'][0].display_board_inquiry);
				permitionRadioCheck('display_board_review',data['data'][0].display_board_review);
				permitionRadioCheck('display_board_notice',data['data'][0].display_board_notice);
				permitionRadioCheck('display_board_faq',data['data'][0].display_board_faq);
				permitionRadioCheck('display_posting_collection',data['data'][0].display_posting_collection);
				permitionRadioCheck('display_posting_editorial',data['data'][0].display_posting_editorial);
				permitionRadioCheck('display_posting_collaboration',data['data'][0].display_posting_collaboration);
				permitionRadioCheck('display_posting_exhibition',data['data'][0].display_posting_exhibition);
				permitionRadioCheck('display_whats',data['data'][0].display_whats);
				permitionRadioCheck('display_popup',data['data'][0].display_popup);
				permitionRadioCheck('display_event',data['data'][0].display_event);
				permitionRadioCheck('display_draw',data['data'][0].display_draw);
				permitionRadioCheck('display_menu',data['data'][0].display_menu);
				permitionRadioCheck('display_store',data['data'][0].display_store);
				permitionRadioCheck('display_landing',data['data'][0].display_landing);

				permitionRadioCheck('order_list',data['data'][0].order_list);
				permitionRadioCheck('order_management',data['data'][0].order_management);
				permitionRadioCheck('order_deposit',data['data'][0].order_deposit);
				permitionRadioCheck('order_deliver',data['data'][0].order_deliver);
				permitionRadioCheck('order_receipt',data['data'][0].order_receipt);
				permitionRadioCheck('order_admin',data['data'][0].order_admin);

				permitionRadioCheck('analysis_excel',data['data'][0].analysis_excel);
				permitionRadioCheck('analysis_dashboard',data['data'][0].analysis_dashboard);
			}
		}
	});
	
	$('.profile_img').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
		} else {
			file = $(this).prop("files")[0];
			
			blobURL = window.URL.createObjectURL(file);
			
			$('#profile_img').attr('src', blobURL);
			$('#profile_img').slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
	
	$('.table__toggle__btn').click(function() {
		var table_id = $(this).attr('id');
		var btn_text = $(this).text();
		
		var display = $('.' + table_id).css('display');
		
		if (display == "none") {
			btn_text = btn_text.replace('+','-');
		} else {
			btn_text = btn_text.replace('-','+');
		}
		
		$(this).text(btn_text);
		$('.' + table_id).toggle();
	});
});

function permitionRadioCheck(permition_name,permition_val) {
	if (permition_val == true) {
		$('#' + permition_name + '_true').prop('checked',true);
		$('#' + permition_name + '_false').prop('checked',false);
	} else {
		$('#' + permition_name + '_true').prop('checked',false);
		$('#' + permition_name + '_false').prop('checked',true);
	}
}

function updateBtnAction(){
	var id 			= $('input[name=id]');
	var name 		= $('input[name=name]');
	var pwcurrent 	= $('input[name=current_pw]');
	var pwchg 		= $('input[name=pwchg]');
	var pwchg2 		= $('input[name=pwchg_confirm]');
	var email 		= $('input[name=EMAIL]');
	var reg_email 	= /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
	var spl_id		= id.val().search(/\s/g);

	if(id.val().length == 0){
		alert("아이디를 입력해주세요", id.focus());
		return false;
	} else{
		if(id.val().search(/[a-z]/ig) < 0){
			alert("아이디에 영문과 숫자가 조합되어야 합니다.",id.focus());
			return false;
		}
		if(spl_id >= 0){
			alert("아이디에 공백이 포함될 수 없습니다.",id.focus());
			return false;
		}
	}
	
	if(name.val().length == 0){
		alert("이름를 입력해주세요",name.focus());
		return false;
	}
	
	if(email.val().length == 0){
		alert("이메일을 입력해주세요", email.focus());
		return false;
	} else {
		if(reg_email.test(email.val()) == false){
			alert("이메일을 정확히 입력해주세요", email.focus());
			return false;
		}
	}
	
	if(pwcurrent.val().length > 0) {
		if (pwchg.val().length > 0 || pwchg2.val().length > 0) {
			if(pwcurrent.val().length == 0){
				alert("현재 비밀번호를 입력해주세요", pwcurrent.focus());
				return false;
			} else {
				if(pwValidationCheck(pwcurrent) == false){
					return false;
				};
			}
			
			if(pwchg.val().length == 0){
				alert("변경 비밀번호를 입력해주세요",pwchg.focus());
				return false;
			} else {
				if(pwValidationCheck(pwchg) == false){
					return false;
				};
			}

			if(pwchg2.val().length == 0){
				alert("변경확인 비밀번호를 입력해주세요",pwchg2.focus());
				return false;
			} else {
				if(pwValidationCheck(pwchg2) == false){
					return false;
				};
			}

			if(pwchg.val().length > 0 && (pwchg.val() != pwchg2.val())){
				alert("변경/변경확인 비밀번호를 동일하게 입력해주세요", pwchg.focus());
				return false;
			}
		}
	} else {
		alert("관리자 정보 변경을 위해 현재 비밀번호를 입력해주세요.",pwcurrent.focus());
		return false;
	}
	insertLog("상점관리 > 운영자 관리 > 운영자 목록", "운영자 개별 정보수정: ", 1);
	modal_submit($('#frm-list'),'getAdminInfo');
}

function pwValidationCheck(pw) {
	var num_cnt 		= pw.val().search(/[0-9]/g);
	var eng 			= pw.val().search(/[a-z]/ig);
	var large_eng_cnt 	= pw.val().search(/[A-Z]/g);
	var sck 			= pw.val().search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
	var spl_pw			= pw.val().search(/\s/g);

	if(pw.val().length < 8){
		alert("비밀번호의 길이는 8 이상입니다.", pw.focus());
		return false;
	}
	
	if(num_cnt < 0){
		alert("하나 이상의 숫자가 필요합니다.", pw.focus());
		return false;
	}
	
	if(eng < 0){
		alert("하나 이상의 알파벳이 필요합니다.", pw.focus());
		return false;
	}
	
	if(large_eng_cnt < 0){
		alert("하나 이상의 대문자 알파벳이 필요합니다.", pw.focus());
		return false;
	}
	
	if(sck < 0){
		alert("하나 이상의 특수문자가 필요합니다.", pw.focus());
		return false;
	}
	
	if(spl_pw >= 0){
		alert("비밀번호에 공백이 포함될 수 없습니다.",pw.focus());
		return false;
	}
	
	return true;
}
</script>