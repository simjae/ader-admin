<style>
.content__wrap{
	grid-template-columns: 170px 2fr !important;
}
</style>
<form id="frm-msg-update-CN" action="order/delivery/message/put">
	<input type="hidden" name="country" value="CN">
	<div class="content__card">
		<div class="card__header">
			<h3>주문 메세지 설정</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
<?php
		$get_php = '
			SELECT
				DELIVERY_MSG
			FROM
				dev.DELIVERY_MSG
			WHERE
				COUNTRY = "CN"
			AND
				MSG_TYPE = "DEF"
		';
		$def_msg = '';
		$db->query($get_php);
		foreach($db->fetch() as $def_data){
			$def_msg = $def_data['DELIVERY_MSG'];
		}
?>
			<div class="content__wrap" style="align-items: start;">
				<input type="hidden" name="msg_type[]" value="DEF">
				<div class="content__title">배송 추가설명</div>
				<div class="content__row" style="display: block;">
					<textarea name="delivery_msg[]" style="padding:10px;width:100%;border:1px solid #000000;resize: none"><?=$def_msg?></textarea>
				</div>
			</div>
<?php
		$get_php = '
			SELECT
				DELIVERY_MSG
			FROM
				dev.DELIVERY_MSG
			WHERE
				COUNTRY = "CN"
			AND
				MSG_TYPE = "CER"
		';
		$cer_msg = '';
		$db->query($get_php);
		foreach($db->fetch() as $cer_data){
			$cer_msg = $cer_data['DELIVERY_MSG'];
		}
?>
			<div class="content__wrap" style="align-items: start;">
				<input type="hidden" name="msg_type[]" value="CER">
				<div class="content__title">취소/교환/반품 신청시<br>배송비 안내</div>
				<div class="content__row" style="display: block;">
					<textarea name="delivery_msg[]" style="padding:10px;width:100%;border:1px solid #000000;resize: none"><?=$cer_msg?></textarea>
				</div>
			</div>
			<div class="justify-center btn__wrap--lg">
				<div  class="blue__color__btn" onClick="updateDeliveryMsg('CN')"><span>모든 항목 저장</span></div>
			</div>
		</div>
	</div>
</form>
<div class="content__card">
	<form id="frm-company-filter-CN" action="order/delivery/company/list/get">
		<input type="hidden" name="country" value="CN">
		
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="COMPANY_NAME">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<div class="card__header">
				<h3>전체 배송업체 검색</h3>
				<div class="drive--x"></div>
			</div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">배송 가능 국가</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="delivery_country_CN_ALL" class="radio__input" value="ALL" name="delivery_country" checked>
						<label for="delivery_country_CN_ALL">전체</label>
						
						<input type="radio" id="delivery_country_CN_CN" class="radio__input" value="CN" name="delivery_country">
						<label for="delivery_country_CN_CN">국내 배송</label>
						
						<input type="radio" id="delivery_country_CN_KF" class="radio__input" value="KF" name="delivery_country">
						<label for="delivery_country_CN_KF">해외 배송</label>
					</div>
				</div>
			</div>
			<div class="content__wrap ">
				<div class="content__title">기본 배송지 유무</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="default_flg_CN_ALL" class="radio__input" value="ALL" name="default_flg" checked>
						<label for="default_flg_CN_ALL">전체</label>
						
						<input type="radio" id="default_flg_CN_TRUE" class="radio__input" value="TRUE" name="default_flg">
						<label for="default_flg_CN_TRUE">기본 배송사</label>
						
						<input type="radio" id="default_flg_CN_FALSE" class="radio__input" value="FALSE" name="default_flg">
						<label for="default_flg_CN_FALSE">일반 배송사</label>
					</div>
				</div>
			</div>
			<div class="content__wrap ">
				<div class="content__title">검색어</div>
				<div class="content__row search_keyword_td" style="display:block;">
					<div class="row">
						<select class="fSelect search_keyword" name="search_keyword" style="width:163px;" onchange="searchKeywordChange(this)">
							<option value="ALL" selected>검색 키워드 선택</option>
							<option value="company_name">운송 업체명</option>
							<option value="company_tel">연락처</option>
							<option value="company_email">이메일</option>
							<option value="homepage">홈페이지</option>
						</select>
						<input type="text" name="keyword_param" value="" style="width:60%;">
					</div>
				</div>
			</div>
			<div class="justify-center btn__wrap--lg" style="margin-top:20px; margin-bottom:30px;">
				<div  class="blue__color__btn" onClick="getDeliveryCompanyList('CN');"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_fileter('frm-company-filter-CN','getDeliveryCompanyList','CN')"><span>초기화</span></div>
			</div>
		</div>
		<div class="card__header">
			<h3>배송업체 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_total info__count">0</font>건/검색결과 <font class="cnt_result info__count">0</font>건
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this, 'company');">
						<option value="COMPANY_NAME|DESC">배송업체명 역순</option>
						<option value="COMPANY_NAME|ASC">배송업체명 순</option>
					</select>
					
					<select style="width:163px;float:right;" onChange="rowsChange(this, 'company');">
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
			<div class="table table__wrap" style="width: 100%;">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onClick="addCompany('CN')">등록</div>
						<div class="filter__btn" onClick="deleteCompany('CN')">삭제</div>
					</div>
				</div>
				<TABLE id="excel_company_table_CN">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox"onclick="selectAll(this,'company')" value="">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="text-align:center">수정</TH>
							<TH>배송업체 국가</TH>
							<TH>배송 업체명</TH>
							<TH>배송 가능 국가</TH>
							<TH>대표 연락처</TH>
							<TH>보조 연락처</TH>
							<TH>이메일</TH>
							<TH>기본 배송비</TH>
							<TH>홈페이지</TH>
							<TH>기본설정</TH>
						</TR>
					</THEAD>
					<TBODY id="result_company_table_CN">
					</TBODY>
				</TABLE>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
				<div class="paging"></div>
			</div>
		</div>
	</form>
</div>
<div class="content__card">
	<form id="frm-location-filter-CN" action="order/delivery/location/list/get">
		<input type="hidden" name="country" value="CN">
		
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="AREA_NAME">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<div class="card__header">
				<h3>지역별 배송정보 검색</h3>
				<div class="drive--x"></div>
			</div>
		</div>
		<div class="card__body">
			<div class="content__wrap ">
				<div class="content__title">배송지역 명</div>
				<div class="content__row" style="display:block;">
					<input type="text" name="area_name" value="" style="width:30%;">
				</div>
			</div>
			<div class="content__wrap ">
				<div class="content__title">우편번호</div>
				<div class="content__row" style="display:block;">
					<input type="text" name="zipcode" value="" style="width:30%;">
				</div>
			</div>
			<div class="justify-center btn__wrap--lg" style="margin-top:20px; margin-bottom:30px;">
				<div  class="blue__color__btn" onClick="getDeliveryLocationList('CN');"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_fileter('frm-location-filter-CN','getDeliveryLocationList','CN')"><span>초기화</span></div>
			</div>
		</div>
		<div class="card__header">
			<h3>지역별 배송비 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_total info__count">0</font>건/검색결과 <font class="cnt_result info__count">0</font>건
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this, 'location');">
						<option value="AREA_NAME|DESC">지역타입명 역순</option>
						<option value="AREA_NAME|ASC">지역타입명 순</option>
					</select>
					
					<select style="width:163px;float:right;" onChange="rowsChange(this, 'location');">
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
			<div class="table table__wrap" style="width: 100%;">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onClick="addLocation('CN')">등록</div>
						<div class="filter__btn" onClick="deleteLocation('CN')">삭제</div>
					</div>
				</div>
				<TABLE id="excel_location_table_CN">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" onclick="selectAll(this,'location')" value="">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="text-align:center;width:60px;">수정</TH>
							<TH>국가</TH>
							<TH>지역타입</TH>
							<TH>지역명</TH>
							<TH>우편번호 구간</TH>
							<TH>배송비</TH>
						</TR>
					</THEAD>
					<TBODY id="result_location_table_CN">
					</TBODY>
				</TABLE>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
				<div class="paging"></div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function(){
	getDeliveryCompanyList('CN');
	getDeliveryLocationList('CN');
})
</script>