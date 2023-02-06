<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>한국몰 스탠바이 검색</h3>
			<div class="black-btn" onclick="moveRegistPage('KR')">한국몰 스탠바이 등록</div>
		</div>
		<div class="drive--x"></div>
	</div>

	<div class="card__body">
		<form id="frm-standby-filter_kr" action="order/standby/list/get">
			<?php
			$sql = " 	SELECT MAX(DISPLAY_NUM) AS MAX 
						FROM dev.PAGE_STANDBY 
						WHERE COUNTRY='KR' ";
			$db->query($sql);
			$display_num_max = 0;
			foreach($db->fetch() as $data){
				$display_num_max = $data['MAX'];
			}
			?>
			<input type="hidden" id="display_num_max" value="<?=$display_num_max?>">
			<input type="hidden" name="country" value="KR">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
			</div>

			<div class="content__wrap">
				<div class="content__title">검색 분류</div>
				<div class="content__row search_type_td" style="display: block;">
					<select class="fSelect eSearch search_type" name="search_type[]" style="width:163px;"
						onChange="searchTypeChange(this);">
						<option value="" selected>검색분류 선택</option>
						<option value="name">상품명</option>
						<option value="code">상품코드</option>
					</select>
					<input type="text" class="search_keyword" name="search_keyword[]" value="" style="width:70%;">
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">스탠바이 시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" name="entry_start_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="entry_start_time" style="width:80px">시
									<option value="" selected>시간</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">스탠바이 종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" name="entry_end_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="entry_end_time" style="width:80px">시
									<option value="" selected>시간</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">구매 시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" name="purchase_start_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="purchase_start_time" style="width:80px">시
									<option value="" selected>시간</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">구매 종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" name="purchase_end_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="purchase_end_time" style="width:80px">시
									<option value="" selected>시간</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">판매 가격</div>
					<div class="content__row">
						<input type="number" name="price_min" value=""
							style="height:28px;border:solid 1px #bfbfbf;width:100px;margin-right:5px;">원
						<span> ~ </span>
						<input type="number" name="price_max" value=""
							style="height:28px;border:solid 1px #bfbfbf;width:100px;margin-right:5px;">원	
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">멤버 레벨</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="member_level_all" type="radio" name="member_level" value="ALL" checked>
							<label for="member_level_all">전체</label>

							<input id="member_level_1" type="radio" name="member_level" value="B">
							<label for="member_level_1">일반</label>

							<input id="member_level_2" type="radio" name="member_level" value="S">
							<label for="member_level_2">Ader Family</label>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="detail_toggle" toggle="hide"></div>
			<div class="btn__wrap--lg">
				<div class="blue__color__btn" onClick="getStandbyListKr();"><span>검색</span></div>
				<div class="defult__color__btn" onClick=""><span>초기화</span></div>
			</div>
		</div>
	</div>
</div>

<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3>한국몰 스탠바이 검색 결과</h3>
			</div>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-standby-list_kr">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_total info__count">0</font>개 / 검색결과 <font class="cnt_result info__count">0
					</font>개
				</div>

				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC" selected>등록일 순</option>
						<option value="UPDATE_DATE|DESC">삭제일 역순</option>
						<option value="UPDATE_DATE|ASC">삭제일 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
						<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
						<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
						<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
						<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
						<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
						<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
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

			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<!--<div style="width: 140px;" class="filter__btn" action_type="prod_copy" onclick="prodActionCheck(this);">복사</div>-->
						<div style="width: 140px;" class="filter__btn" action_type="prod_delete"
							onclick="prodActionCheck(this);">삭제</div>
						<div style="width: 140px;" class="filter__btn" onclick="toggleDisplayFlg(this);">활성/비활성</div>
					</div>
				</div>
				<div class="overflow-x-auto">
					<table>
						<colgroup>
							<col width="3%">
							<col width="4%">
							<col width="auto">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="8%">
							<col width="15%">
							<col width="15%">
							<col width="8%">
							<col width="8%">
						</colgroup>
						<thead>
							<tr>
								<th>
									<div class="cb__color">
										<label>
											<input type="checkbox" class="select" name="draw_idx[]" value="" onclick="selectAllClick(this,'kr')">
											<span></span>
										</label>
									</div>
								</th>
								<th>순서변경</th>
								<th>No.</th>
								<th>스탠바이 상품정보</th>
								<th>사이즈</th>
								<th>스탠바이<br>재고 수량</th>
								<th>스탠바이<br>판매 수량</th>
								<th>스탠바이<br>응모 수량</th>
								<th>스탠바이<br>구매 수량</th>
								<th>개별 응모현황 조회</th>
								<th>전체 응모현황 조회</th>
								<th>스탠바이 판매 가격</th>
								<th>스탠바이 기간</th>
								<th>스탠바이 구매기간</th>
								<th>편집</th>
								<th>활성</th>
							</tr>
						</thead>
						<tbody id="standby_result_table_kr">
						</tbody>
					</table>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
				<div class="paging"></div>
			</div>
		</form>
	</div>
</div>

<script>
$(document).ready(function () {
	getStandbyListKr();
});

function getStandbyListKr(){
	$("#standby_result_table_kr").html('');
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="15">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#standby_result_table_kr").append(strDiv);
	
	var rows = $('#frm-standby-filter_kr').find('.rows').val();
	var page = $('#frm-standby-filter_kr').find('.page').val();
	
	get_contents($("#frm-standby-filter_kr"),{
		pageObj : $("#frm-standby-list_kr").find(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#standby_result_table_kr").html('');
			}
			
			d.forEach(function(row) {
				var rowspan_num = 0;
				var qty_info = row.qty_info;

				if(qty_info != null && qty_info.length > 0){
					rowspan_num = qty_info.length;
				}
				var strDiv = '';

				strDiv = `
					<tr>
						<td rowspan="${rowspan_num}">
							<div class="cb__color">
								<label>
									<input type="checkbox" class="select" name="standby_idx[]" value="${row.standby_idx}" ">
									<span></span>
								</label>
							</div>
						</td>
						<td rowspan="${rowspan_num}">        
							<div class="btn" action_type="up" display_num="${row.display_num}" idx=${row.standby_idx} onclick="displayNumCheck(this)">            
								<i class="xi-angle-up"></i>            
								<span class="tooltip top">위로</span>        
							</div>        
							<div class="btn" action_type="down" display_num="${row.display_num}" idx=${row.standby_idx} onclick="displayNumCheck(this)">          
								<i class="xi-angle-down"></i>            
								<span class="tooltip top">아래로</span>        
							</div>   
						</td>
						<td rowspan="${rowspan_num}">${row.display_num}</td>
						<td rowspan="${rowspan_num}">
							<p style="margin-bottom:5px;"></p>
							<div class="product__img__wrap">
								<div class="product__img"
									style="background-image:url('${row.img_location}');">
								</div>
								<span>
									<p>${row.product_code}</p><br>
									<p>${row.product_name}</p><br>
									<p>${parseInt(row.sales_price).toLocaleString('ko-KR')} ₩</p><br>
									<p>Color : ${row.color}</p><br>
								</span>
						</td>
				`;

				var optionDiv = '';
				var optionDivTotal = '';
				row.qty_info.forEach(function(qty_row, index){
					optionDiv = `
						<td>${qty_row.option_name}</td>
						<td>${qty_row.product_qty}</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>
							<div class="btn" onclick="viewStandbyEntry(${row.standby_idx}, ${qty_row.option_idx},'KR')">조회</div>
						</td>
					`;
					if(index != 0){
						optionDiv = '<tr>'+optionDiv;
						optionDiv = optionDiv+'</tr>';
						optionDivTotal += optionDiv;
					}
					else if(index == 0){
						strDiv += optionDiv; 
					}
				})
				display_str = '';
				if(row.display_flg == 1){
					display_str = '비활성화';
				}
				else{
					display_str = '활성화';
				}
				strDiv += `
						<td rowspan="${rowspan_num}">
							<div class="btn" onclick="viewStandbyEntry(${row.standby_idx}, 'null', 'KR')">전체조회</div>
						</td>
						<td rowspan="${rowspan_num}">${row.sales_price}원</td>
						<td rowspan="${rowspan_num}">${row.entry_start_date}<br>- ${row.entry_end_date}</td>
						<td rowspan="${rowspan_num}">${row.purchase_start_date}<br>- ${row.purchase_end_date}</td>
						<td rowspan="${rowspan_num}">
							<div class="btn" onclick="moveUpdatePage('KR', ${row.standby_idx})">편집</div>
						</td>
						<td rowspan="${rowspan_num}">
							<div class="btn" sel_idx="${row.standby_idx}" onclick="toggleDisplayFlg(this)">${display_str}</div>
						</td>
					</tr>
				`;

				strDiv += optionDivTotal;

				$('#standby_result_table_kr').append(strDiv);
			});
		},
	},rows,page);
}


</script>