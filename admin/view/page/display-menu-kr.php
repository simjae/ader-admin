<div class="content__card">
	<div class="card__header">
		<div style="display:flex;">
			<div style="width:50%;">
				<h3>메뉴 - 한국몰</h3>
			</div>
			
			<div style="width:50%;">
				<div class="save_menu_btn" onClick="saveMenu('KR')">스토리 저장</div>
			</div>
		</div>
		
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div class="overflow-auto" style="margin-top:20px;">
			<div id="menu_container_KR" style="display:flex;">
				
			</div>
		</div>
	</div>
</div>

<div class="content__card" style="display:none;">
	<form id="frm-put_KR" action="posting/story/put">
		<input class="menu_sort" type="hidden" name="menu_sort" value="">
		<input class="menu_idx" type="hidden" name="menu_idx" value="">
		
		<div class="card__header">
			<h3>메뉴 등록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="param_MN_KR">
				<input class="link_type" type="hidden" name="link_type" value="">
				<input class="link_idx" type="hidden" name="link_idx" value="0">
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">메뉴 타이틀</div>
						<div class="content__row">
							<input class="menu_title" type="text" name="menu_title" style="width:90%;">
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">메뉴 URL</div>
						<div class="content__row">
							<input class="link_url" type="text" name="link_url" style="width:90%;" onChange="resetMenuLinkUrl('KR')">
						</div>
					</div>
				</div>
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">게시물 검색</div>
						<div class="content__row">
							<div class="rd__block">							
								<input id="link_type_KR_PR" type="radio" name="link_type_MN_KR" value="PR" country="KR" obj_type="MN" onClick="resetType(this);" checked>
								<label for="link_type_KR_PR">상품</label>
								
								<input id="link_type_KR_PO" type="radio" name="link_type_MN_KR" value="PO" country="KR" obj_type="MN" onClick="resetType(this);">
								<label for="link_type_KR_PO">게시물</label>
								
								<input id="link_type_KR_MN" type="radio" name="link_type_MN_KR" value="MN" country="KR" obj_type="MN" onClick="resetType(this);">
								<label for="link_type_KR_MN">메뉴</label>
							</div>
							
							<div class="btn" style="margin-left:10px;" onclick="checkPageModal('KR','MN');">게시물 검색</div>
						</div>
					</div>
				</div>
				
				<div class="table table__wrap">
					<div class="overflow-x-auto">
						<TABLE class="page_table" style="auto;">
							<colgroup>
								<col width="250px;">
								<col width="auto;">
								<col width="auto;">
								<col width="auto;">
								<col width="100px;">
								<col width="200px;">
								<col width="100px;">
							</colgroup>
							<THEAD>
								<TR>
									<TH>게시물 타입</TH>
									<TH>게시물 타이틀</TH>
									<TH>게시물 메모</TH>
									<TH>게시물 URL</TH>
									<TH>게시물 진열상태</TH>
									<TH>게시물 진열기간</TH>
									<TH>게시물 조회수</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
								<TR>
									<TD class="default_td" colspan="7" style="text-align:left;">
										선택된 게시물이 없습니다. 게시물을 선택해주세요.
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<TABLE class="collection_table" style="min-width:100%;width:auto;display:none;">
							<THEAD>
								<colgroup>
									<col width="250px;">
									<col width="auto;">
									<col width="auto;">
									<col width="auto;">
									<col width="auto;">
								</colgroup>
								<TR>
									<TH>게시물 타입</TH>
									<TH>컬렉션 이름</TH>
									<TH>컬렉션 설명</TH>
									<TH>컬렉션 제목</TH>
									<TH>컬렉션 URL</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
								<TR>
									<TD class="default_td" colspan="4" style="text-align:left;">
										선택된 게시물이 없습니다. 게시물을 선택해주세요.
									</TD>
								</TR>
							</TBODY>
						</TABLE>
						
						<TABLE class="menu_table" style="min-width:100%;width:auto;display:none;">
							<THEAD>
								<colgroup>
									<col width="20%;">
									<col width="auto;">
									<col width="auto;">
								</colgroup>
								<TR>
									<TH>메뉴 타이틀</TH>
									<TH>메뉴 경로</TH>
									<TH>메뉴 URL</TH>
								</TR>
							</THEAD>
							<TBODY class="result_body">
								<TR>
									<TD class="default_td" colspan="3" style="text-align:left;">
										선택된 게시물이 없습니다. 게시물을 선택해주세요.
									</TD>
								</TR>
							</TBODY>
						</TABLE>
					</div>
				</div>
				
				<div class="card__footer">
					<div class="footer__btn__wrap">
						<div toggle="hide"></div>
						<div class="btn__wrap--lg">
							<div  class="blue__color__btn" onClick="putMenuInfo('KR');"><span>메뉴 수정</span></div>
							<div class="defult__color__btn" onClick="resetMenu('KR');"><span>취소</span></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap content_menu_slide_KR" style="display:block;border:1px solid #bfbfbf;margin-top:15px;">
				<div class="content__title">메뉴 슬라이드</div>
				
				<div class="SL_container">
					<div class="menu_img_obj" onClick="resetMenuObj('KR','SL');">
						<div class="obj_btn_wrap" style="display:flex;">
							<div class="delete_menu_obj">삭제</div>
							<div class="display_num"><</div>
							<div class="display_num">></div>
						</div>
						<div class="menu_obj_img" style="background-image:url('/images/default_thumbnail_img.jpg');"></div>
						<p class="menu_obj_title">슬라이드 추가</p>
					</div>
				</div>
				
				<div class="param_SL_KR" style="display:none;">
					<input class="obj_idx" type="hidden" name="obj_idx" value="0">
					<input class="link_type" type="hidden" name="link_type" value="">
					<input class="link_idx" type="hidden" name="link_idx" value="0">
					
					<div class="table table__wrap">
						<div class="overflow-x-auto">
							<TABLE class="page_table" style="auto;">
								<colgroup>
									<col width="250px;">
									<col width="auto;">
									<col width="auto;">
									<col width="auto;">
									<col width="100px;">
									<col width="200px;">
									<col width="100px;">
								</colgroup>
								<THEAD>
									<TR>
										<TH>게시물 타입</TH>
										<TH>게시물 타이틀</TH>
										<TH>게시물 메모</TH>
										<TH>게시물 URL</TH>
										<TH>게시물 진열상태</TH>
										<TH>게시물 진열기간</TH>
										<TH>게시물 조회수</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="7" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
							
							<TABLE class="collection_table" style="min-width:100%;width:auto;display:none;">
								<THEAD>
									<colgroup>
										<col width="250px;">
										<col width="auto;">
										<col width="auto;">
										<col width="auto;">
										<col width="auto;">
									</colgroup>
									<TR>
										<TH>게시물 타입</TH>
										<TH>컬렉션 이름</TH>
										<TH>컬렉션 설명</TH>
										<TH>컬렉션 제목</TH>
										<TH>컬렉션 URL</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="4" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
							
							<TABLE class="menu_table" style="min-width:100%;width:auto;display:none;">
								<THEAD>
									<colgroup>
										<col width="20%;">
										<col width="auto;">
										<col width="auto;">
									</colgroup>
									<TR>
										<TH>메뉴 타이틀</TH>
										<TH>메뉴 경로</TH>
										<TH>메뉴 URL</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="3" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__wrap grid__half" style="width:100%;">
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">슬라이드 타이틀</div>
								<div class="content__row">
									<input class="obj_title" type="text" name="obj_title" style="width:90%;" value="">
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">슬라이드 URL</div>
								<div class="content__row">
									<input class="link_url" type="text" name="link_url" style="width:90%;" value="" onChange="resetMenuObjLinkUrl('KR','SL')">
								</div>
							</div>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__wrap grid__half" style="width:100%;">
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">슬라이드 타입</div>
								<div class="content__row">
									<div class="rd__block">							
										<input id="link_type_SL_KR_PR" type="radio" name="link_type_SL_KR" value="PR" onClick="resetType('SL','KR')" checked>
										<label for="link_type_SL_KR_PR">상품</label>
										
										<input id="link_type_SL_KR_PO" type="radio" name="link_type_SL_KR" value="PO" onClick="resetType('SL','KR')">
										<label for="link_type_SL_KR_PO">게시물</label>
										
										<input id="link_type_SL_KR_MN" type="radio" name="link_type_SL_KR" value="MN" onClick="resetType('SL','KR')">
										<label for="link_type_SL_KR_MN">메뉴</label>
										
										<div class="btn" style="margin-left:10px;" onclick="checkPageModal('KR','SL');">게시물 검색</div>
									</div>
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">이미지 경로</div>
								<div class="content__row">
									<input class="img_location" type="text" name="img_location" style="width:90%;" placeholder="/images/filter" value="">
								</div>
							</div>
						</div>
					</div>
					
					<div class="card__footer" style="margin-top:0px;">
						<div class="footer__btn__wrap" style="grid-template-columns:none;">
							<div toggle="hide"></div>
							<div class="btn__wrap--lg">
								<div class="defult__color__btn" onclick="checkMenuObjAction('KR','SL');">저장</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap" style="display:block;border:1px solid #bfbfbf;margin-top:15px;">
				<div class="content__title">메뉴 상단 필터</div>
				
				<div class="UP_container">
					<div class="menu_img_obj" onClick="resetMenuObj('KR','UP');">
						<div class="obj_btn_wrap" style="display:flex;">
							<div class="delete_menu_obj">삭제</div>
							<div class="display_num"><</div>
							<div class="display_num">></div>
						</div>
						<div class="menu_obj_img" style="background-image:url('/images/default_thumbnail_img.jpg');" country="KR" type="slide"></div>
						<p class="menu_obj_title">필터 추가</p>
					</div>
				</div>
				
				<div class="param_UP_KR" style="display:none;">
					<input class="obj_idx" name="obj_idx" type="hidden" value="0">
					<input class="link_type" name="link_type" type="hidden" value="">
					<input class="link_idx" name="link_idx" type="hidden" value="0">
					
					<div class="table table__wrap">
						<div class="overflow-x-auto">
							<TABLE class="page_table" style="auto;">
								<colgroup>
									<col width="250px;">
									<col width="auto;">
									<col width="auto;">
									<col width="auto;">
									<col width="100px;">
									<col width="200px;">
									<col width="100px;">
								</colgroup>
								<THEAD>
									<TR>
										<TH>게시물 타입</TH>
										<TH>게시물 타이틀</TH>
										<TH>게시물 메모</TH>
										<TH>게시물 URL</TH>
										<TH>게시물 진열상태</TH>
										<TH>게시물 진열기간</TH>
										<TH>게시물 조회수</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="7" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
							
							<TABLE class="collection_table" style="min-width:100%;width:auto;display:none;">
								<THEAD>
									<colgroup>
										<col width="250px;">
										<col width="auto;">
										<col width="auto;">
										<col width="auto;">
										<col width="auto;">
									</colgroup>
									<TR>
										<TH>게시물 타입</TH>
										<TH>컬렉션 이름</TH>
										<TH>컬렉션 설명</TH>
										<TH>컬렉션 제목</TH>
										<TH>컬렉션 URL</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="4" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
							
							<TABLE class="menu_table" style="min-width:100%;width:auto;display:none;">
								<THEAD>
									<colgroup>
										<col width="20%;">
										<col width="auto;">
										<col width="auto;">
									</colgroup>
									<TR>
										<TH>메뉴 타이틀</TH>
										<TH>메뉴 경로</TH>
										<TH>메뉴 URL</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="3" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__wrap grid__half" style="width:100%;">
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">상단 필터 타이틀</div>
								<div class="content__row">
									<input class="obj_title" type="text" name="obj_title" style="width:90%;" value="">
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">상단 필터 URL</div>
								<div class="content__row">
									<input class="link_url" type="text" name="link_url" style="width:90%;" value="" onChange="resetMenuObjLinkUrl('KR','UP')">
								</div>
							</div>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__wrap grid__half" style="width:100%;">
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">필터 타입</div>
								<div class="content__row">
									<div class="rd__block">							
										<input id="link_type_UP_KR_PR" type="radio" name="link_type_UP_KR" value="PR" onClick="resetType('UP','KR')" checked>
										<label for="link_type_UP_KR_PR">상품</label>
										
										<input id="link_type_UP_KR_PO" type="radio" name="link_type_UP_KR" value="PO" onClick="resetType('UP','KR')">
										<label for="link_type_UP_KR_PO">게시물</label>
										
										<input id="link_type_UP_KR_MN" type="radio" name="link_type_UP_KR" value="MN" onClick="resetType('UP','KR')">
										<label for="link_type_UP_KR_MN">메뉴</label>
										
										<div class="btn" style="margin-left:10px;" onclick="checkPageModal('KR','UP');">게시물 검색</div>
									</div>
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">이미지 경로</div>
								<div class="content__row">
									<input class="img_location" type="text" name="img_location" style="width:90%;" placeholder="/images/filter" value="">
								</div>
							</div>
						</div>
					</div>
					
					<div class="card__footer" style="margin-top:0px;">
						<div class="footer__btn__wrap" style="grid-template-columns:none;">
							<div toggle="hide"></div>
							<div class="btn__wrap--lg">
								<div class="defult__color__btn" onclick="checkMenuObjAction('KR','UP');">저장</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap" style="display:block;border:1px solid #bfbfbf;margin-top:15px;">
				<div class="content__title">메뉴 하단 필터</div>
				
				<div class="LW_container">
					<div class="menu_txt_obj" onClick="resetMenuObj('KR','LW');">
						<div class="obj_btn_wrap" style="display:flex;">
							<div class="delete_menu_obj">삭제</div>
							<div class="display_num"><</div>
							<div class="display_num">></div>
						</div>
						<p class="menu_obj_title" style="width:50%;margin-top:5px;cursor:pointer;">필터 추가</p>
					</div>
				</div>
				
				<div class="param_LW_KR" style="display:none;">
					<input class="obj_idx" name="obj_idx" type="hidden" value="0">
					<input class="link_type" name="page_idx" type="hidden" value="">
					<input class="link_idx" name="page_idx" type="hidden" value="0">
					
					<div class="table table__wrap">
						<div class="overflow-x-auto">
							<TABLE class="page_table" style="min-width:100%;width:auto;">
								<colgroup>
									<col width="250px;">
									<col width="auto;">
									<col width="auto;">
									<col width="auto;">
									<col width="100px;">
									<col width="200px;">
									<col width="100px;">
								</colgroup>
								<THEAD>
									<TR>
										<TH>게시물 타입</TH>
										<TH>게시물 타이틀</TH>
										<TH>게시물 메모</TH>
										<TH>게시물 URL</TH>
										<TH>게시물 진열상태</TH>
										<TH>게시물 진열기간</TH>
										<TH>게시물 조회수</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="11" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
							
							<TABLE class="collection_table" style="min-width:100%;width:auto;display:none;">
								<THEAD>
									<colgroup>
										<col width="250px;">
										<col width="auto;">
										<col width="auto;">
										<col width="auto;">
										<col width="auto;">
									</colgroup>
									<TR>
										<TH>게시물 타입</TH>
										<TH>컬렉션 이름</TH>
										<TH>컬렉션 설명</TH>
										<TH>컬렉션 제목</TH>
										<TH>컬렉션 URL</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="4" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
							
							<TABLE class="menu_table" style="min-width:100%;width:auto;display:none;">
								<THEAD>
									<colgroup>
										<col width="20%;">
										<col width="auto;">
										<col width="auto;">
									</colgroup>
									<TR>
										<TH>메뉴 타이틀</TH>
										<TH>메뉴 경로</TH>
										<TH>메뉴 URL</TH>
									</TR>
								</THEAD>
								<TBODY class="result_body">
									<TR>
										<TD class="default_td" colspan="3" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__wrap grid__half" style="width:100%;">
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">하단 필터 타이틀</div>
								<div class="content__row">
									<input class="obj_title" type="text" name="obj_title" style="width:90%;" value="">
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">하단 필터 URL</div>
								<div class="content__row">
									<input class="link_url" type="text" name="link_url" style="width:90%;" value="" onChange="resetMenuObjLinkUrl('KR','LW')">
								</div>
							</div>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__wrap grid__half" style="width:100%;">
							<div class="half__box__wrap">
								<div class="content__title" style="margin-top:5px;">필터 타입</div>
								<div class="content__row">
									<div class="rd__block">							
										<input id="link_type_LW_KR_PR" class="link_type" type="radio" name="link_type_LW_KR" value="PR" onClick="resetType('LW','KR')" checked>
										<label for="link_type_LW_KR_PR">상품</label>
										
										<input id="link_type_LW_KR_PO" class="link_type" type="radio" name="link_type_LW_KR" value="PO" onClick="resetType('LW','KR')">
										<label for="link_type_LW_KR_PO">게시물</label>
										
										<input id="link_type_LW_KR_MN" class="link_type" type="radio" name="link_type_LW_KR" value="MN" onClick="resetType('LW','KR')">
										<label for="link_type_LW_KR_MN">메뉴</label>
										
										<div class="btn" style="margin-left:10px;" onclick="checkPageModal('KR','LW');">게시물 검색</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card__footer" style="margin-top:0px;">
						<div class="footer__btn__wrap" style="grid-template-columns:none;">
							<div toggle="hide"></div>
							<div class="btn__wrap--lg">
								<div class="defult__color__btn" onclick="checkMenuObjAction('KR','LW');">저장</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getMenuInfoList('KR');
});
</script>