<div class="content__card">
	<div class="card__header">
		<h3>메뉴 - 한국몰</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="save_menu_btn" onClick="saveMenu('KR')">스토리 저장</div>
		
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
				<input class="page_idx" type="hidden" name="page_idx" value="0">
				
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">메뉴 타이틀</div>
						<div class="content__row">
							<input class="menu_title" type="text" name="menu_title" style="width:90%;">
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">메뉴 타입</div>
						<div class="content__row">
							<div class="rd__block">							
								<input id="menu_type_KR_PR" class="menu_type" type="radio" name="menu_type_KR" value="PR" country="KR" obj_type="MN" onClick="resetType(this);">
								<label for="menu_type_KR_PR">상품</label>
								
								<input id="menu_type_KR_PO" class="menu_type" type="radio" name="menu_type_KR" value="PO" country="KR" obj_type="MN" onClick="resetType(this);">
								<label for="menu_type_KR_PO">게시물</label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="table table__wrap">
					<div class="table__filter">
						<div class="filrer__wrap">
							<div class="filter__btn" onclick="checkPageModal('KR','MN');">게시물 검색</div>
						</div>                          
					</div>
					
					<div class="overflow-x-auto">
						<TABLE id="excel_table" style="width:150%;">
							<THEAD>
								<TR>
									<TH style="width:250px;">게시물 타입</TH>
									<TH style="width:500px;">게시물 타이틀</TH>
									<TH style="width:500px;">게시물 메모</TH>
									<TH style="width:500px;">게시물 URL</TH>
									<TH style="width:150px;">게시물 진열상태</TH>
									<TH style="width:350px;">게시물 진열기간</TH>
									<TH style="width:200px;">게시물 조회수</TH>
									<TH style="width:350px;">게시물 작성일</TH>
									<TH style="width:250px;">게시물 작성자</TH>
									<TH style="width:350px;">게시물 수정일</TH>
									<TH style="width:250px;">게시물 수정자</TH>
								</TR>
							</THEAD>
							<TBODY class="result_table">
								<TR>
									<TD class="default_td" colspan="12" style="text-align:left;">
										선택된 게시물이 없습니다. 게시물을 선택해주세요.
									</TD>
								</TR>
							</TBODY>
						</TABLE>
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
					<input class="page_idx" type="hidden" name="page_idx" value="0">
					
					<div class="table table__wrap">
						<div class="table__filter">
							<div class="filrer__wrap">
								<div class="filter__btn" onclick="checkPageModal('KR','SL');">게시물 검색</div>
							</div>                          
						</div>
						
						<div class="overflow-x-auto">
							<TABLE id="excel_table" style="width:150%;">
								<THEAD>
									<TR>
										<TH style="width:250px;">게시물 타입</TH>
										<TH style="width:500px;">게시물 타이틀</TH>
										<TH style="width:500px;">게시물 메모</TH>
										<TH style="width:500px;">게시물 URL</TH>
										<TH style="width:150px;">게시물 진열상태</TH>
										<TH style="width:350px;">게시물 진열기간</TH>
										<TH style="width:200px;">게시물 조회수</TH>
										<TH style="width:350px;">게시물 작성일</TH>
										<TH style="width:250px;">게시물 작성자</TH>
										<TH style="width:350px;">게시물 수정일</TH>
										<TH style="width:250px;">게시물 수정자</TH>
									</TR>
								</THEAD>
								<TBODY class="result_table">
									<TR>
										<TD class="default_td" colspan="12" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__title" style="margin-top:5px;margin-right:40px;">슬라이드 타이틀</div>
						<div class="content__row">
							<input class="obj_title" type="text" name="obj_title" value="">
						</div>
					
						<div class="content__title" style="margin-left:60px;margin-top:5px;margin-right:60px;">슬라이드 타입</div>
						<div class="content__row">
							<div class="rd__block">							
								<input id="link_type_SL_KR_PR" class="link_type" type="radio" name="link_type_SL_KR" value="PR" country="KR" obj_type="SL" onClick="resetType(this);">
								<label for="link_type_SL_KR_PR">상품</label>
								
								<input id="link_type_SL_KR_PO" class="link_type" type="radio" name="link_type_SL_KR" value="PO" country="KR" obj_type="SL" onClick="resetType(this);">
								<label for="link_type_SL_KR_PO">게시물</label>
							</div>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__title" style="margin-top:5px;margin-right:68px;">이미지 경로</div>
						<div class="content__row">
							<input class="img_location" type="text" name="img_location" value="">
						</div>
						
						<div class="add_menu_obj" onclick="checkMenuObjAction('KR','SL');">저장</div>
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
					<input class="page_idx" name="page_idx" type="hidden" value="0">
					
					<div class="table table__wrap">
						<div class="table__filter">
							<div class="filrer__wrap">
								<div class="filter__btn" onclick="checkPageModal('KR','UP');">게시물 검색</div>
							</div>                          
						</div>
						
						<div class="overflow-x-auto">
							<TABLE id="excel_table" style="width:150%;">
								<THEAD>
									<TR>
										<TH style="width:250px;">게시물 타입</TH>
										<TH style="width:500px;">게시물 타이틀</TH>
										<TH style="width:500px;">게시물 메모</TH>
										<TH style="width:500px;">게시물 URL</TH>
										<TH style="width:150px;">게시물 진열상태</TH>
										<TH style="width:350px;">게시물 진열기간</TH>
										<TH style="width:200px;">게시물 조회수</TH>
										<TH style="width:350px;">게시물 작성일</TH>
										<TH style="width:250px;">게시물 작성자</TH>
										<TH style="width:350px;">게시물 수정일</TH>
										<TH style="width:250px;">게시물 수정자</TH>
									</TR>
								</THEAD>
								<TBODY class="result_table">
									<TR>
										<TD class="default_td" colspan="12" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__title" style="margin-top:5px;margin-right:40px;">상단 필터 타이틀</div>
						<div class="content__row">
							<input class="obj_title" type="text" name="obj_title" value="">
						</div>
					
						<div class="content__title" style="margin-left:60px;margin-top:5px;margin-right:60px;">상단 필터 타입</div>
						<div class="content__row">
							<div class="rd__block">							
								<input id="link_type_UP_KR_PR" class="link_type" type="radio" name="link_type_UP_KR" value="PR" onClick="resetType('UP','KR')">
								<label for="link_type_UP_KR_PR">상품</label>
								
								<input id="link_type_UP_KR_PO" class="link_type" type="radio" name="link_type_UP_KR" value="PO" onClick="resetType('UP','KR')">
								<label for="link_type_UP_KR_PO">게시물</label>
							</div>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__title" style="margin-top:5px;margin-right:68px;">이미지 경로</div>
						<div class="content__row">
							<input class="img_location" type="text" name="img_location" value="">
						</div>
						
						<div class="add_menu_obj" onclick="checkMenuObjAction('KR','UP');">저장</div>
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
					<input class="page_idx" name="page_idx" type="hidden" value="0">
					
					<div class="table table__wrap">
						<div class="table__filter">
							<div class="filrer__wrap">
								<div class="filter__btn" onclick="checkPageModal('KR','LW');">게시물 검색</div>
							</div>                          
						</div>
						
						<div class="overflow-x-auto">
							<TABLE id="excel_table" style="width:150%;">
								<THEAD>
									<TR>
										<TH style="width:100px;"></TH>
										<TH style="width:250px;">게시물 타입</TH>
										<TH style="width:500px;">게시물 타이틀</TH>
										<TH style="width:500px;">게시물 메모</TH>
										<TH style="width:500px;">게시물 URL</TH>
										<TH style="width:150px;">게시물 진열상태</TH>
										<TH style="width:350px;">게시물 진열기간</TH>
										<TH style="width:200px;">게시물 조회수</TH>
										<TH style="width:350px;">게시물 작성일</TH>
										<TH style="width:250px;">게시물 작성자</TH>
										<TH style="width:350px;">게시물 수정일</TH>
										<TH style="width:250px;">게시물 수정자</TH>
									</TR>
								</THEAD>
								<TBODY class="result_table">
									<TR>
										<TD class="default_td" colspan="12" style="text-align:left;">
											선택된 게시물이 없습니다. 게시물을 선택해주세요.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="filter_param" style="display:flex;margin-top:15px;">
						<div class="content__title" style="margin-top:5px;margin-right:40px;">하단 필터 타이틀</div>
						<div class="content__row">
							<input class="obj_title" type="text" name="obj_title" value="">
							
							<div class="add_menu_obj" onclick="checkMenuObjAction('KR','LW');">저장</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="putMenu('KR');"><span>메뉴 수정</span></div>
					<div class="defult__color__btn" onClick="resetMenu('KR');"><span>취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getMenuList('KR');
});
</script>