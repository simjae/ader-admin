<div class="content__card">
	<div class="card__header">
		<h3>이벤트 목록 검색</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-filter-event-info-EN" action="event/list/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<input type="hidden" id="country" name="country" value="EN">
			<div class="content__wrap">
				<div class="content__title">이벤트 찾기</div>
				<div class="content__row">
					<select id="search_select" class="fSelect" name="search_type" id="search_type" style="width:163px;" >
						<option value="event_title">이벤트명</option>
					</select>
					<input id="search_keyword" type="text" name="search_keyword" value="" style="width:250px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="eventStatus1" class="radio__input" value="all" name="eventStatus" checked/>
						<label for="eventStatus1">전체</label>
						<input type="radio" id="eventStatus2" class="radio__input" value="true" name="eventStatus"/>
						<label for="eventStatus2">진행중</label>
						<input type="radio" id="eventStatus3" class="radio__input" value="false" name="eventStatus" />
						<label for="eventStatus3">종료</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이벤트 기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_event_create_EN" type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_event_create date__picker" date_type="event_create" date="all" type="button" onclick="searchDateClick(this);">전체</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_event_create date__picker" date_type="event_create" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input class="date_param" type="date" name="event_create_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="event_create" onChange="dateParamChange(this);">
							<font>~</font>
							<input class="date_param" type="date" name="event_create_to" placeholder="To" readonly style="width:150px;" date_type="event_create" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getEventInfoList('EN');"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter-event-info-EN','getEventInfoList','EN');"><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>
<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>이벤트 목록 결과</h3>
			<div class="register__btn" style="cursor:pointer;" onClick="openEventRegistModal();"><span>이벤트 등록</span></div>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-list-event-info-EN">
			<input type="hidden" name="action_type">
			<div class="content__row" style="justify-content: flex-end;">
				<select style="width:163px;float:right;margin-right:10px;" list-type="event-info" onChange="orderChange(this);">
					<option value="FINPUT_DATE|DESC">등록일 역순</option>
					<option value="FINPUT_DATE|ASC">등록일 순</option>
					<option value="EVENT_TITLE|DESC">이벤트명 역순</option>
					<option value="EVENT_TITLE|ASC">이벤트명 순</option>
					<option value="CNT|DESC">참여자 수 역순</option>
					<option value="CNT|ASC">참여자 수 순</option>
				</select>
				<select name="rows" style="width:163px;float:right;" list-type="event-info" onChange="rowsChange(this);">
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
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" list-type="event_info" onClick="excelDownload(this);">엑셀 다운로드</div>
						<div class="filter__btn" action_type="event_info_delete" onClick="eventInfoActionClick(this)">삭제</div>
					</div>                           
				</div>
				
				<div class="overflow-x-auto">
					<table id="excel_table_event_info_EN">
						<thead>
							<tr>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" data-type="event_info" onclick="selectAllClick(this)">
											<span></span>
										</label>
									</div>
								</TH>
								<th width="60px">번호</th>
								<th>이벤트명</th>
								<th width="100px">참여자수</th>
								<th width="300px">이벤트 기간</th>
								<th width="160px">생성일</th>
								<th width="80px">상태</th>
								<th width="80px">수정하기</th>
								<th width="95px"></th>
							</tr>
						</thead>
						<tbody id="result_event_info_table_EN">
							<tr>
								<td colspan="6" class="nodata"><i class="xi-slash-circle"></i>검색된 이벤트가 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" >
					<input type="hidden" class="result_cnt" value="0">
					<div class="paging event_info"></div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="content__card">
	<div class="card__header">
		<h3 id="event_filter_title_EN">이벤트 참여자(당첨자) 목록 검색</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-filter-event-EN" action="event/submit/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			<input type="hidden" class="rows" name="rows" value="20">
			<input type="hidden" class="page" name="page" value="1">
			<input type="hidden" name="event_no">
			<input type="hidden" name="excel_print_flg">
			<div class="content__wrap">
				<div class="content__title">참가자 찾기</div>
				<div class="content__row">
					<select id="search_select" class="fSelect" name="search_type" id="search_type" style="width:163px;" >
						<option value="id">참여자 ID</option>	
						<option value="name">참여자 명</option>
						<option value="tel">연락처</option>
						<option value="email">이메일</option>
						<option value="instagram_id">인스타그램ID</option>
					</select>
					<input id="search_keyword" type="text" name="search_keyword" value="" style="width:250px;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="eventStatus2_1" class="radio__input" value="all" name="eventStatus" checked/>
						<label for="eventStatus2_1">전체</label>
						<input type="radio" id="eventStatus2_1" class="radio__input" value="false" name="eventStatus" />
						<label for="eventStatus2_1">참여</label>
						<input type="radio" id="eventStatus2_2" class="radio__input" value="true" name="eventStatus" />
						<label for="eventStatus2_2">당첨</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">참여 일자</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_event_apply_EN" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_event_apply date__picker" date_type="event_apply" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_event_apply date__picker" date_type="event_apply" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="event_apply_from" class="date_param" type="date" name="event_apply_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="event_apply" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="event_apply_to" class="date_param" type="date" name="event_apply_to" placeholder="To" readonly style="width:150px;" date_type="event_apply" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getEventList('EN')"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter-event-EN','getEventList','EN')"><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>
<div class="content__card">
	<div class="card__header">
		<h3 id="event_result_title_EN">이벤트 참여자(당첨자) 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap " style="justify-content:end; align-items: center;">
			<div class="content__row">
				<select style="width:163px;float:right;margin-right:10px;" list-type="event" onChange="orderChange(this);">
					<option value="FINPUT_DATE|DESC">등록일 역순</option>
					<option value="FINPUT_DATE|ASC">등록일 순</option>
					<option value="NAME|DESC">신청자명 역순</option>
					<option value="NAME|ASC">신청자명 순</option>
					<option value="ID|DESC">신청자 ID 역순</option>
					<option value="ID|ASC">신청자 ID 순</option>
					<option value="EMAIL|DESC">EMAIL 역순</option>
					<option value="EMAIL|ASC">EMAIL 순</option>
				</select>
				<select name="rows" style="width:163px;float:right;" list-type="event" onChange="rowsChange(this);">
					<option value="10">10개씩보기</option>
					<option value="20" selected>20개씩보기</option>
					<option value="30">30개씩보기</option>
					<option value="50">50개씩보기</option>
					<option value="100">100개씩보기</option>
					<option value="200">200개씩보기</option>
					<option value="300">300개씩보기</option>
					<option value="500">500개씩보기</option>
				</select>
			</div>
		</div>
		<div class="table table__wrap" >
			<div class="table__filter">
				<div class="filrer__wrap">
					<div class="filter__btn" list-type="event" onClick="excelDownload(this);">엑셀 다운로드</div>
				</div>                        
			</div>
			<div class="overflow-x-auto">
				<table id="excel_table_event_EN">
					<thead>
						<tr>
							<th style="width:70px;">번호</th>
							<th style="width:15%;">이벤트</th>
							<th style="width:90px;">참여자 명</th>
							<th style="width:80px;">참여자 ID</th>
							<th colspan="2">로우데이터</th>
							<th style="width:130px;">연락처</th>
							<th style="width:150px;">이메일</th>
							<th style="width:150px;">인스타그램ID</th>
							<th style="width:150px;">참여일자</th>
							<th style="width:80px;">상태</th>
							<th style="width:40px;"></th>
						</tr>
					</thead>
					<tbody id="result_event_table_EN">
						<tr>
							<td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" >
			<input type="hidden" class="result_cnt" value="0">
			<div class="paging event"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getEventInfoList('EN');
});
</script>