<div class="content__card">
	<div style="display:flex;">
		<div style="width:50%;">
			<h3>메인랜딩</h3>
		</div>
		<div style="width:50%;">
			<div class="save_main_btn" onclick="saveMainInfo('KR')">메인 저장</div>
		</div>
		
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body" style="display:flex;">
		<div class="landing__left__area" style="">
			<div class="main__banner__selector selector_KR selector_BNR_KR" onClick="toggleContainer('KR','BNR')">
				<div class="banner__selector__img"></div>
			</div>
			
			<div class="main__contents__selector selector_KR selector_CNT_KR" onClick="toggleContainer('KR','CNT')">
				<div class="contents__selector_img"></div>
			</div>
			
			<div class="main__images__selector selector_KR selector_IMG_KR" onClick="toggleContainer('KR','IMG')">
				<div class="images_selector_img"></div>
			</div>
		</div>
		
		<div class="landing__right__area">
			<div class="banner__info__container selected_container container_BNR_KR">
				<input class="recent_num" type="hidden" name="recent_num" value="0">
				<input class="recent_idx" type="hidden" name="recent_idx" value="0">
				
				<div class="banner__select__wrap">
					<div class="banner__select__img__wrap">
						<div class="banner__select__img__slide">
							
						</div>					
					</div>
					
					<div class="banner__select__btn__wrap">
						<div class="btn_left_wrap" style="width:50%;">
							<div class="btn" obj_type="BNR" action_type="up" onClick="displayNumCheck(this);" style="margin-left:15px;margin-right:10px;"><</div>
							<div class="btn" obj_type="BNR" action_type="down" onClick="displayNumCheck(this);">></div>
						</div>
						<div class="btn_right_wrap" style="width:50%;">
							<div class="btn banner_copy_btn" onClick="copyMainBanner('KR');">복사</div>
							<div class="btn banner_delete_btn" onClick="deleteMainBanner('KR');">삭제</div>
							<div class="btn banner_regist_btn" onClick="addMainBannerInfo('KR')">추가</div>
						</div>
					</div>
				</div>
				
				<form id="frm-put_BNR_KR" action="main/banner/put">
					<input type="hidden" name="update_flg" value="true">
					<input class="banner_idx" type="hidden" name="banner_idx" value="0">
					
					<div class="banner__data__wrap">
						<div class="table table__wrap" style="width:30vw;margin-top:0px;margin-right:15px;">
							<table>
								<thead>
									<tr>
										<th colspan="3">컨텐츠</th>
									</tr>
								</thead>
								<tbody style="height: 32vh;">
									<tr>
										<td colspan="3">
											
										</td>
									</tr>
									<tr>
										<td style="width:80px;height:3vh;">배너경로</td>
										<td>
											<input class="img_location" type="text" name="img_location" placeholder="/images/main/banner/" value="">
										</td>
										<td style="width:80px;text-align:center;">
											<div class="btn check_img_location_btn" check_result="false" onClick="checkImgLocation('KR','BNR')">체크</div>
										</td>
									</tr>
									<tr>
										<td colspan="3" style="height:3vh;">
											<div class="contents__btn__wrap" style="display:flex;">
												<div class="rd__block">
													<input id="banner_bg_color_BL_KR" class="background_color bg_color_BL" type="radio" name="background_color" value="BL" checked="checked">
													<label for="banner_bg_color_BL_KR">BLACK</label>

													<input id="banner_bg_color_WH_KR" class="background_color bg_color_WH"  type="radio" name="background_color" value="WH">
													<label for="banner_bg_color_WH_KR">WHITE</label>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="table table__wrap" style="width:40vw;margin-top:0px;">
							<table>
								<thead>
									<tr>
										<th colspan="2">텍스트</th>
									</tr>
								</thead>
								<tbody style="height:32vh;">
									<tr>
										<td style="width:8%;text-align:center;">
											제목
										</td>
										<td>
											<input class="title" type="text" name="title" value="">
										</td>
									</tr>
									<tr>
										<td style="text-align:center;">
											부제목
										</td>
										<td>
											<input class="sub_title" type="text" name="sub_title" value="">
										</td>
									</tr>
									<tr>
										<td rowspan="2" style="text-align:center;">
											버튼1<br>URL
										</td>
										<td>
											<div style="display:flex;">
												<input class="btn1_name" type="text" name="btn1_name" value="" style="width:80%;">
												
												<div class="rd__block" style="margin-left:20px;">
													<input id="BNR_btn1_display_flg_TRUE_KR" type="radio" name="btn1_display_flg" value="TRUE" checked>
													<label for="BNR_btn1_display_flg_TRUE_KR">표시</label>

													<input id="BNR_btn1_display_flg_FALSE_KR" type="radio" name="btn1_display_flg" value="FALSE">
													<label for="BNR_btn1_display_flg_FALSE_KR">비표시</label>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<input class="btn1_url" type="text" name="btn1_url" value="">
										</td>
									</tr>
									<tr>
										<td rowspan="2" style="text-align:center;">
											버튼2<br>URL
										</td>
										<td>
											<div style="display:flex;">
												<input class="btn2_name" type="text" name="btn2_name" value="" style="width:80%;">
												
												<div class="rd__block" style="margin-left:20px;">
													<input id="BNR_btn2_display_flg_TRUE_KR" type="radio" name="btn2_display_flg" value="TRUE" checked>
													<label for="BNR_btn2_display_flg_TRUE_KR">표시</label>

													<input id="BNR_btn2_display_flg_FALSE_KR" type="radio" name="btn2_display_flg" value="FALSE">
													<label for="BNR_btn2_display_flg_FALSE_KR">비표시</label>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<input class="btn2_url" type="text" name="btn2_url" value="">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="banner__data__btn__wrap">
						<div class="btn banner_update_btn" onClick="putMainBannerInfo('KR');">배너 정보 저장</div>
					</div>
				</form>
			</div>
			
			<div class="contents__info__container selected_container container_CNT_KR">
				<form id="frm-put_CNT_KR" action="main/contents/put">				
					<input class="contents_idx" type="hidden" name="contents_idx" value="0">
					
					<div class="contents__data__wrap">
						<div class="table table__wrap" style="width:30vw;margin-top:0px;margin-right:15px;">
							<table>
								<thead>
									<tr>
										<th colspan="3">컨텐츠</th>
									</tr>
								</thead>
								<tbody style="height: 32vh;">
									<tr>
										<td colspan="3">
											
										</td>
									</tr>
									<tr>
										<td style="width:80px;height:3vh;">컨텐츠경로</td>
										<td>
											<input class="img_location" type="text" name="img_location" placeholder="/images/main/contents/" value="">
										</td>
										<td style="width:80px;text-align:center;">
											<div class="btn check_img_location_btn" check_result="false" onClick="checkImgLocation('KR','CNT')">체크</div>
										</td>
									</tr>
									<tr>
										<td colspan="3" style="height:3vh;">
											<div class="contents__btn__wrap" style="display:flex;">
												<div class="rd__block">
													<input id="contents_bg_color_BL_KR" type="radio" name="background_color" value="BL" checked>
													<label for="contents_bg_color_BL_KR">BLACK</label>

													<input id="contents_bg_color_WH_KR" type="radio" name="background_color" value="WH">
													<label for="contents_bg_color_WH_KR">WHITE</label>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="table table__wrap" style="width:40vw;margin-top:0px;">
							<table>
								<thead>
									<tr>
										<th colspan="2">텍스트</th>
									</tr>
								</thead>
								<tbody style="height:32vh;">
									<tr>
										<td style="width:8%;text-align:center;">
											제목
										</td>
										<td>
											<input class="title" type="text" name="title" value="">
										</td>
									</tr>
									<tr>
										<td style="text-align:center;">
											부제목
										</td>
										<td>
											<input class="sub_title" type="text" name="sub_title" value="">
										</td>
									</tr>
									<tr>
										<td rowspan="2" style="text-align:center;">
											버튼1<br>URL
										</td>
										<td>
											<div style="display:flex;">
												<input class="btn1_name" type="text" name="btn1_name" value="" style="width:80%;">
												
												<div class="rd__block" style="margin-left:20px;">
													<input id="CNT_btn1_display_flg_TRUE_KR" type="radio" name="btn1_display_flg" value="TRUE" checked>
													<label for="CNT_btn1_display_flg_TRUE_KR">표시</label>

													<input id="CNT_btn1_display_flg_FALSE_KR" type="radio" name="btn1_display_flg" value="FALSE">
													<label for="CNT_btn1_display_flg_FALSE_KR">비표시</label>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<input class="btn1_url" type="text" name="btn1_url" value="">
										</td>
									</tr>
									<tr>
										<td rowspan="2" style="text-align:center;">
											버튼2<br>URL
										</td>
										<td>
											<div style="display:flex;">
												<input class="btn2_name" type="text" name="btn2_name" value="" style="width:80%;">
												
												<div class="rd__block" style="margin-left:20px;">
													<input id="CNT_btn2_display_flg_TRUE_KR" type="radio" name="btn2_display_flg" value="TRUE" checked>
													<label for="CNT_btn2_display_flg_TRUE_KR">표시</label>

													<input id="CNT_btn2_display_flg_FALSE_KR" type="radio" name="btn2_display_flg" value="FALSE">
													<label for="CNT_btn2_display_flg_FALSE_KR">비표시</label>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<input class="btn2_url" type="text" name="btn2_url" value="">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
				
				<div class="contents__product__wrap">
					<div class="contents__product table__wrap">
					</div>
					
					<div class="table table__wrap" style="width:100%;margin-top:0px;">
						<table>
							<thead>
								<tr>
									<th colspan="2">대표제품</th>
								</tr>
							</thead>
							<tbody style="height:30vh;">
								<tr>
									<td style="width:25%;">
										<div style="height:28vh;overflow-y:auto;">
											<div class="js--tree_KR"></div>
										</div>
									</td>
									<td colspan="3" style="vertical-align:top;">
										<div style="height:28vh;overflow-y:auto;">
											<div class="table table__wrap" style="width:100%;margin-top:5px;">
												<table>
													<colgroup>
														<col width="5%;">
														<col width="20%;">
														<col width="75%;">
													</colgroup>
													<thead>
														<th>선택유무</th>
														<th>상품코드</th>
														<th>상품이름</th>
														<th>판매가(한국몰)</th>
														<th>판매가(영문몰)</th>
														<th>판매가(중문몰)</th>
													</thead>
													<tbody class="result_table_KR">
														<tr>
															<td colspan="6">조회 결과가 없습니다.</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="contents__data__btn__wrap">
					<div class="btn contents_update_btn" onClick="putMainContentsInfo('KR');">컨텐츠 정보 저장</div>
				</div>
			</div>
			
			<div class="images__info__container selected_container container_IMG_KR">
				<input class="recent_num" type="hidden" name="recent_num" value="0">
				<input class="recent_idx" type="hidden" name="recent_idx" value="0">
				
				<div class="images__select__wrap">
					<div class="images__select__img__wrap">
						<div class="images__select__img__slide">
							
						</div>					
					</div>
					
					<div class="images__select__btn__wrap">
						<div class="btn_left_wrap" style="width:50%;">
							<div class="btn" obj_type="IMG" action_type="up" onClick="displayNumCheck(this);" style="margin-left:15px;margin-right:10px;"><</div>
							<div class="btn" obj_type="IMG" action_type="down" onClick="displayNumCheck(this);">></div>
						</div>
						<div class="btn_right_wrap" style="width:50%;">
							<div class="btn images_copy_btn" onClick="copyMainImages('KR')" >복사</div>
							<div class="btn images_delete_btn" onClick="deleteMainImages('KR')" >삭제</div>
							<div class="btn images_regist_btn" onClick="addMainImages('KR')">추가</div>
						</div>
					</div>
				</div>

				<form id="frm-put_IMG_KR" action="main/images/put">
					<input type="hidden" name="update_flg" value="true">
					<input class="img_idx" type="hidden" name="img_idx" value="0">
					
					<div class="images__data__wrap">
						<div class="table table__wrap" style="width:30vw;margin-top:0px;margin-right:15px;">
							<table>
								<thead>
									<tr>
										<th colspan="3">컨텐츠</th>
									</tr>
								</thead>
								<tbody style="height: 20vh;">
									<tr>
										<td colspan="3">
											
										</td>
									</tr>
									<tr>
										<td style="width:80px;height:3vh;">이미지경로</td>
										<td>
											<input class="img_location" type="text" name="img_location" placeholder="/images/main/images/" value="">
										</td>
										<td style="width:80px;text-align:center;">
											<div class="btn check_img_location_btn" check_result="false" onClick="checkImgLocation('KR','IMG')">체크</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="table table__wrap" style="width:40vw;margin-top:0px;">
							<table>
								<thead>
									<tr>
										<th colspan="2">텍스트</th>
									</tr>
								</thead>
								<tbody style="height:20vh;">
									<tr>
										<td style="width:8%;text-align:center;">
											제목
										</td>
										<td>
											<input class="title" type="text" name="title" value="">
										</td>
									</tr>
									<tr>
										<td rowspan="2" style="text-align:center;">
											버튼<br>URL
										</td>
										<td>
											<div style="display:flex;">
												<input class="btn_name" type="text" name="btn_name" value="" style="width:80%;">
												
												<div class="rd__block" style="margin-left:20px;">
													<input id="IMG_btn_display_flg_TRUE_KR" type="radio" name="btn_display_flg" value="TRUE" checked>
													<label for="IMG_btn_display_flg_TRUE_KR">표시</label>

													<input id="IMG_btn_display_flg_FALSE_KR" type="radio" name="btn_display_flg" value="FALSE">
													<label for="IMG_btn_display_flg_FALSE_KR">비표시</label>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<input class="btn_url" type="text" name="btn_url" value="">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="images__data__btn__wrap">
						<div class="btn images_update_btn" onClick="putMainImagesInfo('KR');">이미지 정보 저장</div>
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>

<script>
$(document).ready(function() {
	getMainBannerInfoList('KR');
	getMainImagesInfoList('KR');
});
</script>