<style>
	.white__btn {
		cursor: pointer;
		display: flex;
		font-size: 13px;
		align-items: center;
		justify-content: center;
		width: 140px;
		height: 22px;
		border-radius: 2px;
		padding: 10px;
		border: solid 1px #707070;
	}

	.white__btn {
		width: 120px;
		height: 30px;
		border: 1px solid #000000;
		background-color: #ffffff;
		color: #000000;
		margin-right: 10px;
	}
</style>
<div class="content__card">
	<form id="frm-filter" action="voucher/publish/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>발행 바우처 목록</h3>
			<div class="drive--x"></div>
		</div>

		<div class="card__body">
			<div class="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
					</div>
					<div>
						<button type="button" class="white__btn"
							onclick="location.href='/member/voucher/regist'">발행</button>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<select id="country" name="country" onChange="">
						<option value="KR" selected>한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">바우처 타입</div>
					<div class="content__row">
						<select id="voucher_type" name="voucher_type" onChange="">
							<option value="ALL">바우처 타입 선택</option>
							<option value="LV">레벨별 발급</option>
							<option value="MB">멤버별 발급</option>
							<option value="OFF">오프라인</option>
						</select>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">바우처 명</div>
					<div class="content__row">
						<input type="text" name="voucher_name" value="">
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">바우처 상태</div>
				<div class="content__row">
					<select id="voucher_status" name="voucher_status" onChange="">
						<option value="ALL">전체</option>
						<option value="PTI">발급예정</option>
						<option value="IVP">발급가능</option>
						<option value="EIV">발급종료</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">발행 멤버</div>
				<div class="content__row">
					<label class="rd__square">
						<input type="radio" name="member_level" value="ALL" checked>
						<div>
							<div></div>
						</div>
						<span>전체</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="member_level" value="1">
						<div>
							<div></div>
						</div>
						<span>일반 멤버</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="member_level" value="2">
						<div>
							<div></div>
						</div>
						<span>Ader family</span>
					</label>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">발급 가능 기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__picker">
							<input id="voucher_from" class="date_param" type="date" name="voucher_from"
								class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
								date_type="reserve" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="voucher_to" class="date_param" type="date" name="voucher_to" placeholder="To"
								readonly style="width:150px;" date_type="reserve" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onClick="getPublishVoucherInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list', 'getPublishVoucherInfo')">
						<span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>

	<div class="card__header">
		<h3>바우처 검색 결과</h3>
	</div>
	<div class="drive--x"></div>
	<div class="card__body">
		<form id="frm-list">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 발행 바우처 수 <font class="cnt_total info__count">0</font>개 / 검색결과 <font
						class="cnt_result info__count">0</font>개
				</div>

				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="changeOrderVoucher(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="VOUCHER_NAME|DESC">바우처명 역순</option>
						<option value="VOUCHER_NAME|ASC">바우처명 순</option>
						<option value="VOUCHER_TYPE|DESC">바우처 타입 역순</option>
						<option value="VOUCHER_TYPE|ASC">바우처 타입 순</option>
						<option value="ISSUE_START_DATE|DESC">발급시작일 역순</option>
						<option value="ISSUE_START_DATE|ASC">발급시작일 순</option>
						<option value="ISSUE_END_DATE|DESC">발급종료일 역순</option>
						<option value="ISSUE_END_DATE|ASC">발급종료일 순</option>
						<option value="TOT_ISSUE_NUM|DESC">발급 수량 역순</option>
						<option value="TOT_ISSUE_NUM|ASC">발급 수량 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;"
						onChange="changeRowsVoucher(this);">
						<option value="5" selected>5개씩보기</option>
						<option value="10">10개씩보기</option>
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
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" action_type="voucher_delete"
							onclick="publishVoucherAction()">삭제</div>
					</div>
				</div>
				<div class="overflow-x-auto">
					<table style="width:100%">
						<colgroup>
							<col width="5%">
							<col width="10%">
							<col width="10%">
							<col width="auto">
							<col width="20%">
							<col width="10%">
							<col width="auto">
							<col width="5%">
							<col width="15%">
							<col width="15%">
						</colgroup>
						<thead>
							<tr>
								<TH>
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<th>국가</th>
								<th>타입</th>
								<th>이름</th>
								<th>발급 멤버 레벨</th>
								<th>상태</th>
								<th>발급 기간</th>
								<th>수량</th>
								<th>편집</th>
								<th>조회</th>
							</tr>
						</thead>
						<tbody id="result_publish_voucher_table">
						</tbody>
					</table>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" list_type="publish" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" list_type="publish" onChange="setPaging(this);">
				<div class="paging"></div>
			</div>
		</form>
	</div>
</div>

<div class="selected__info" style="display:none;">
	<div class="content__card">
		<div class="card__header">
			<h3 id="selected_voucher_title"></h3>
		</div>
		<div class="card__content">
			<div class="table table__wrap" style="width:40%">
				<table>
					<colgroup>
						<col width="30%">
						<col width="70%">
					</colgroup>
					<tbody id="result_selected_voucher_table">
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div class="content__card">
		<div class="card__header">
			<h3 id="selected_voucher_issue_title"></h3>
		</div>
		<div class="drive--x"></div>
		<form id="frm-detail-filter" action="voucher/issue/list/get">
			<input type="hidden" name="voucher_idx">
			<input type="hidden" name="country">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원 아이디</div>
					<div class="content__row">
						<input type="text" name="member_id">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">회원명</div>
					<div class="content__row">
						<input type="text" name="member_name">
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">발행 멤버</div>
				<div class="content__row">
					<label class="rd__square">
						<input type="radio" name="issue_member_level" value="ALL" checked>
						<div>
							<div></div>
						</div>
						<span>전체</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="issue_member_level" value="1">
						<div>
							<div></div>
						</div>
						<span>일반 멤버</span>
					</label>
					<label class="rd__square">
						<input type="radio" name="issue_member_level" value="2">
						<div>
							<div></div>
						</div>
						<span>Ader family</span>
					</label>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">사용여부</div>
					<div class="content__row">
						<label class="rd__square">
							<input type="radio" name="used_flg" value="ALL" checked>
							<div>
								<div></div>
							</div>
							<span>전체</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="used_flg" value="TRUE">
							<div>
								<div></div>
							</div>
							<span>사용</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="used_flg" value="FALSE">
							<div>
								<div></div>
							</div>
							<span>미사용</span>
						</label>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">등록여부</div>
					<div class="content__row">
						<label class="rd__square">
							<input type="radio" name="regist_flg" value="ALL" checked>
							<div>
								<div></div>
							</div>
							<span>전체</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="regist_flg" value="TRUE">
							<div>
								<div></div>
							</div>
							<span>등록</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="regist_flg" value="FALSE">
							<div>
								<div></div>
							</div>
							<span>미등록</span>
						</label>
					</div>
				</div>
			</div>

			<div class="card__footer">
				<div class="footer__btn__wrap" style="grid: none;">
					<div class="btn__wrap--lg">
						<div class="blue__color__btn" onClick="getIssueVoucherListInfo()"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_fileter('frm-list', 'getIssueVoucherListInfo')">
							<span>초기화</span></div>
					</div>
				</div>
			</div>
		</form>
		<form id="frm-detail-list">
			<div class="card__body">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 바우처 발급 수 <font class="cnt_total info__count">0</font>개 / 검색결과 <font
							class="cnt_result info__count">0</font>개
					</div>
				</div>
				<div class="card__content">
					<div class="table table__wrap" style="width:90%">
						<div class="table__filter">
							<div class="filrer__wrap">
								<div style="width: 140px;" class="filter__btn" action_type="voucher_delete"
									onclick="issueVoucherAction()">삭제</div>
							</div>
						</div>
						<table>
							<colgroup>
								<col width="3%">
								<col width="10%">
								<col width="auto">
								<col width="10%">
								<col width="10%">
								<col width="15%">
								<col width="20%">
								<col width="15%">
								<col width="7%">
							</colgroup>
							<thead>
								<TH>
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<th>발급 바우처 코드</th>
								<th>아이디</th>
								<th>회원명</th>
								<th>회원레벨</th>
								<th>바우처 등록일자</th>
								<th>사용가능 일자</th>
								<th>사용일자</th>
								<th>사용여부</th>
							</thead>
							<tbody id="result_voucher_issue_table">
							</tbody>
						</table>
					</div>
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" value="0" list_type="issue" onChange="setPaging(this);">
						<input type="hidden" class="result_cnt" value="0" list_type="issue" onChange="setPaging(this);">
						<div class="paging"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		getPublishVoucherInfo();
	});

	function init_fileter(frm_id, func_name) {
		var formObj = $('#' + frm_id);
		formObj.find('input:radio[value="all"]').prop('checked', true);
		formObj.find('input:radio[value="ALL"]').prop('checked', true);

		formObj.prop("selectedIndex", 0);

		formObj.find('input[type=text]').val('');
		formObj.find('input[type=date]').val('');

		formObj.find('.date__picker').css('background-color', '#ffffff');
		formObj.find('.date__picker').css('color', '#000000');
		formObj.find('input[name="search_date"]').val('');

		window[func_name]();
	}

	function getPublishVoucherInfo() {
		$("#result_publish_voucher_table").html('');

		var strDiv = '';
		strDiv += '<TD class="default_td" colspan="10">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';

		$("#result_publish_voucher_table").append(strDiv);

		var filter_obj = $("#frm-filter");
		var list_obj = $('#frm-list');

		var rows = filter_obj.find('.rows').val();
		var page = filter_obj.find('.page').val();
		get_contents(filter_obj, {
			pageObj: list_obj.find(".paging"),
			html: function (d) {
				if (d.length > 0) {
					$("#result_publish_voucher_table").html('');
				}
				d.forEach(function (row) {
					var on_off_type_str = '';
					if (row.on_off_type != null) {
						if (row.on_off_type == 'ON') {
							on_off_type_str = '온라인';
						}
						else if (row.on_off_type == 'OFF') {
							on_off_type_str = '오프라인';
						}
					}
					var country_str = '';
					if (row.country != null) {
						if (row.country == 'KR') {
							country_str = '한국몰';
						}
						else if (row.country == 'EN') {
							country_str = '영문몰';
						}
						else if (row.country == 'CN') {
							country_str = '중국몰';
						}
					}
					//'ALL'이면 '전체',
					//아닐 경우, idx에 해당하는 MEMBER_LEVEL 타이틀을 열거한 문자열 지정
					var member_level_str = '';
					if (row.member_level != null) {
						if (row.member_level == 'ALL') {
							member_level_str = '전체';
						}
						else {
							var member_level_arr = [];
							row.member_level.split(',').forEach(function (idx) {
								if (idx == '1') {
									level_str = '일반회원';
								}
								else if (idx == '2') {
									level_str = 'Ader Family';
								}
								member_level_arr.push(level_str);
							})
							member_level_str = member_level_arr.join(', ');
						}
					}
					var strDiv = "";
					strDiv = `
							<tr>
								<td>
									<div class="cb__color">
										<label>
											<input type="checkbox" class="select" name="sel_idx[]" value="${row.no}">
											<span></span>
										</label>
									</div>
								</td>
								<td>${country_str}</td>
								<td>${on_off_type_str}</td>
								<td>${row.voucher_name}</td>
								<td>${member_level_str}</td>
								<td>${row.voucher_status}</td>
								<td>발급 시작:${row.issue_start_date}<br>발급 종료:${row.issue_end_date}</td>
								<td>${row.tot_issue_num}</td>
								<td>
									<div class="white__btn" modal_type="put" voucher_idx="${row.no}" onclick="openVoucherMoveModal(this)">편집</div>
								</td>
								<td>
									<div class="white__btn" voucher_idx="${row.no}" country="${row.country}" onclick="viewVoucherInfo(this)">조회</div>
								</td>
							</tr>
				`;

					$("#result_publish_voucher_table").append(strDiv);
				});
			},
		}, rows, page);
	}

	function getSelectVoucherInfo() {
		var voucher_idx = $('#frm-detail-filter').find('input[name="voucher_idx"]').val();
		$.ajax({
			type: "post",
			data: { 'voucher_idx': voucher_idx },
			dataType: "json",
			url: config.api + "voucher/publish/get",
			error: function () {
				alert('발행 바우처 정보 불러오기에 실패했습니다.');
			},
			success: function (result) {
				if (result.code == 200) {
					var row = result.data[0];
					var strDiv = '';
					$('.selected__info').css('display', 'block');
					$('#result_selected_voucher_table').html('');

					var country_str = '';
					if (row.country != null) {
						if (row.country == 'KR') {
							country_str = '한국몰';
						}
						else if (row.country == 'EN') {
							country_str = '영문몰';
						}
						else if (row.country == 'CN') {
							country_str = '중국몰';
						}
					}

					if (row.voucher_type != null) {
						if (row.voucher_type == 'ON') {
							voucher_type_str = '온라인';
						}
						else if (row.voucher_type == 'OFF') {
							voucher_type_str = '오프라인';
						}
					}

					var sale_type_str = '';
					var sale_price_str = '';
					if (row.sale_type != null) {
						if (row.sale_type == 'PER') {
							sale_type_str = '전체 가격의 일정 비율';
							sale_price_str = `전체 가격의 ${row.sale_price}% 할인`;
						}
						else if (row.sale_type == 'PRC') {
							sale_type_str = '고정 금액';
							sale_price_str = `${row.sale_price}원 할인`;
						}
					}

					var mileage_str = '';
					if (row.mileage_flg != null) {
						if (row.mileage_flg == true) {
							mileage_str = '마일리지 사용';
						}
						else {
							mileage_str = '마일리지 사용불가';
						}
					}

					//'ALL'이면 '전체',
					//아닐 경우, idx에 해당하는 MEMBER_LEVEL 타이틀을 열거한 문자열 지정
					var member_level_str = '';
					if (row.member_level != null) {
						if (row.member_level == 'ALL') {
							member_level_str = '전체';
						}
						else {
							var member_level_arr = [];
							row.member_level.split(',').forEach(function (idx) {
								if (idx == '1') {
									level_str = '일반회원';
								}
								else if (idx == '2') {
									level_str = 'Ader Family';
								}
								member_level_arr.push(level_str);
							})
							member_level_str = member_level_arr.join(', ');
						}
					}

					var voucher_date_type_str = '';
					if (row.voucher_date_type != null) {
						if (row.voucher_date_type == 'PRD') {
							voucher_date_type_str = `바우처 등록 후, ${row.voucher_date_param}일간 사용 가능(바우처 사용 종료일 이내에)`;
						}
						else if (row.voucher_date_type == 'FXD') {
							voucher_date_type_str = '바우처 사용 시작일부터 종료일까지';
						}
					}
					strDiv = `
						<tr>
							<td>국가</td>
							<td>${country_str}</td>
						</tr>
						<tr>
							<td>바우처 명</td>
							<td>${row.voucher_name}</td>
						</tr>
						<tr>
							<td>바우처 코드</td>
							<td>${row.voucher_code}</td>
						</tr>
						<tr>
							<td>발급 가능 멤버레벨</td>
							<td>${member_level_str}</td>
						</tr>
						<tr>
							<td>바우처 발행 시작일</td>
							<td>${row.issue_start_date}</td>
						</tr>
						<tr>
							<td>바우처 발행 종료일</td>
							<td>${row.issue_end_date}</td>
						</tr>
						<tr>
							<td>바우처 사용기간 유형</td>
							<td>${voucher_date_type_str}</td>
						</tr>
						<tr>
							<td>바우처 사용가능 시작일</td>
							<td>${row.voucher_start_date}</td>
						</tr>
						<tr>
							<td>바우처 사용가능 종료일</td>
							<td>${row.voucher_end_date}</td>
						</tr>
						<tr>
							<td>최소 사용 금액</td>
							<td>${row.min_price}</td>
						</tr>
						<tr>
							<td>할인 유형</td>
							<td>${sale_type_str}</td>
						</tr>
						<tr>
							<td>할인 금액</td>
							<td>${sale_price_str}</td>
						</tr>
						<tr>
							<td>상세 설명</td>
							<td>${row.description}</td>
						</tr>
						<tr>
							<td>마일리지 사용 유무</td>
							<td>${mileage_str}</td>
						</tr>
						<tr>
							<td>총 발행 수량</td>
							<td>${row.tot_issue_num}</td>
						</tr>
				`;
					$('#selected_voucher_title').text(`[${row.voucher_name}] 바우처 상세정보 조회`);
					$('#selected_voucher_issue_title').text(`[${row.voucher_name}] 바우처 발급회원/사용 목록`);
					$('#result_selected_voucher_table').append(strDiv);
				}
			}
		}).then(function () {
			$("#result_voucher_issue_table").html('');
			var strDiv = '';
			strDiv += '<TD class="default_td" colspan="9">';
			strDiv += '    조회 결과가 없습니다';
			strDiv += '</TD>';

			$("#result_voucher_issue_table").append(strDiv);

			var filter_detail_obj = $("#frm-detail-filter");
			var list_detail_obj = $('#frm-detail-list');

			var rows = filter_detail_obj.find('.rows').val();
			var page = filter_detail_obj.find('.page').val();
			get_contents(filter_detail_obj, {
				pageObj: list_detail_obj.find(".paging"),
				html: function (d) {
					if (d.length > 0) {
						$("#result_voucher_issue_table").html('');
					}
					d.forEach(function (row) {
						var used_str = '';
						var used_date_str = '';
						if (row.used_flg != null) {
							if (row.used_flg == true) {
								used_str = '사용';
								used_date_str = row.update_date;
							}
							else if (row.used_flg == false) {
								used_str = '미사용';
								used_date_str = '-';
							}
						}
						var strDiv = "";
						strDiv = `
							<tr>
								<td>
									<div class="cb__color">
										<label>
											<input type="checkbox" class="select" name="sel_idx[]" value="${row.no}">
											<input type="hidden" class="used_flg" value="${row.used_flg}">
											<span></span>
										</label>
									</div>
								</td>
								<td>${row.voucher_issue_code}</td>
								<td>${row.member_id}</td>
								<td>${row.member_name}</td>
								<td>${row.member_level}</td>
								<td>${row.voucher_add_date}</td>
								<td>사용가능 시작일 : ${row.usable_start_date}<br>사용가능 종료일 : ${row.usable_end_date}</td>
								<td>${used_date_str}</td>
								<td>${used_str}</td>
							</tr>
					`;

						$("#result_voucher_issue_table").append(strDiv);
					});
				},
			}, rows, page);
		})
	}

	function getIssueVoucherListInfo() {
		$("#result_voucher_issue_table").html('');
		var strDiv = '';
		strDiv += '<TD class="default_td" colspan="9">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';

		$("#result_voucher_issue_table").append(strDiv);

		var filter_detail_obj = $("#frm-detail-filter");
		var list_detail_obj = $('#frm-detail-list');

		var rows = filter_detail_obj.find('.rows').val();
		var page = filter_detail_obj.find('.page').val();
		get_contents(filter_detail_obj, {
			pageObj: list_detail_obj.find(".paging"),
			html: function (d) {
				if (d.length > 0) {
					$("#result_voucher_issue_table").html('');
				}
				d.forEach(function (row) {
					var used_str = '';
					var used_date_str = '';
					if (row.used_flg != null) {
						if (row.used_flg == true) {
							used_str = '사용';
							used_date_str = row.update_date;
						}
						else if (row.used_flg == false) {
							used_str = '미사용';
							used_date_str = '-';
						}
					}
					var strDiv = "";
					strDiv = `
						<tr>
							<td>
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="sel_idx[]" value="${row.no}">
										<input type="hidden" class="used_flg" value="${row.used_flg}">
										<span></span>
									</label>
								</div>
							</td>
							<td>${row.voucher_issue_code}</td>
							<td>${row.member_id}</td>
							<td>${row.member_name}</td>
							<td>${row.member_level}</td>
							<td>${row.voucher_add_date}</td>
							<td>사용가능 시작일 : ${row.usable_start_date}<br>사용가능 종료일 : ${row.usable_end_date}</td>
							<td>${used_date_str}</td>
							<td>${used_str}</td>
						</tr>
				`;

					$("#result_voucher_issue_table").append(strDiv);
				});
			},
		}, rows, page);
	}

	function dateParamChange(obj) {
		var sel_std_date = new Date($('input[name="voucher_from"]').val()).getTime();
		var sel_end_date = new Date($('input[name="voucher_to"]').val()).getTime();

		if (sel_std_date != NaN && sel_end_date != NaN) {
			if (sel_std_date > sel_end_date) {
				alert('정확한 검색기간를 선택해주세요');
				$('#voucher_from').val('');
				$('#voucher_to').val('');
			}
		}

		$('.search_date_voucher').css('background-color', '#ffffff');
		$('.search_date_voucher').css('color', '#000000');
		$('#search_date_voucher').val('');
	}

	function publishVoucherAction() {
		confirm('선택하신 바우처 삭제를 진행하시겠습니까?', function () {
			var formData = new FormData();
			formData = $("#frm-list").serializeObject();


			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "voucher/publish/list/delete",
				error: function () {
					alert('발행 바우처 삭제 처리에 실패했습니다.');
				},
				success: function (d) {
					if (d.code == 200) {
						alert('발행 바우처 삭제 처리에 성공했습니다.');
						insertLog("바우처 관리 > 바우처 삭제 ", "발행 바우처 삭제", null);
						getPublishVoucherInfo();
					}
				}
			});
		})
	}

	function issueVoucherAction() {
		confirm('선택하신 발급 바우처 삭제를 진행하시겠습니까?', function () {
			//체크된 발급 바우쳐중 사용중을 뜻하는 
			//used_flg 값이 true인 조건을 만나면 
			//경고 메세지 출력 후 리턴
			var checked_issue = $('#result_voucher_issue_table').find('input[name="sel_idx[]"]:checked');
			for (var i = 0; i < checked_issue.length; i++) {
				var checked_used_flg = checked_issue.eq(i).siblings('.used_flg').val();
				if (checked_used_flg == '1') {
					alert('이미 사용한 발급 바우처는 삭제할 수 없습니다.');
					return false;
				}
			}

			var formData = new FormData();
			formData = $("#frm-detail-list").serializeObject();

			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "voucher/issue/delete",
				error: function () {
					alert('발급 바우처 삭제 처리에 실패했습니다.');
				},
				success: function (d) {
					if (d.code == 200) {
						alert('발급 바우처 삭제 처리에 성공했습니다.');
						insertLog("바우처 관리 > 발급 바우처 삭제 ", "발급 바우처 삭제", null);
						getSelectVoucherInfo();
					}
				}
			});

		})
	}

	function viewVoucherInfo(obj) {
		var sel_idx = $(obj).attr('voucher_idx');
		var country = $(obj).attr('country');

		$('#frm-detail-filter').find('input[name="voucher_idx"]').val(sel_idx);
		$('#frm-detail-filter').find('input[name="country"]').val(country);

		getSelectVoucherInfo();
	}

	function openVoucherMoveModal(obj) {
		var modal_type = $(obj).attr('modal_type');
		var voucher_idx = $(obj).attr('voucher_idx');

		modal(modal_type, `voucher_idx=${voucher_idx}`);
	}
</script>