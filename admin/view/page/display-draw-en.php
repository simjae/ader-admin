<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>영문몰 드로우 검색</h3>
			<div class="black-btn" onclick="">영문몰 드로우 등록</div>
		</div>
		<div class="drive--x"></div>
	</div>

	<div class="card__body">
		<form id="frm-KEY_KR">
			<div claszs="body__info--count" style="display: block;margin:20px 0;">
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
					<div class="content__title">드로우 시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input id="prod_date_from" class="date_param" type="date" name="prod_date_from"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="display_from_h" style="width:80px">시
									<option value="" selected>시간</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">드로우 종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input id="prod_date_to" class="date_param" type="date" name="prod_date_from"
									class="margin-bottom-6" placeholder="To" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="display_to_h" style="width:80px">시
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
								<input id="prod_date_from" class="date_param" type="date" name="prod_date_from"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="display_from_h" style="width:80px">시
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
								<input id="prod_date_to" class="date_param" type="date" name="prod_date_to"
									class="margin-bottom-6" placeholder="To" readonly style="width:150px;"
									date_type="prod_date" onChange="dateParamChange(this);">
							</div>
						</div>
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<select class="display_date" type="select" name="display_to_h" style="width:80px">시
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
						<input type="number" name="stock_max" value=""
							style="height:28px;border:solid 1px #bfbfbf;width:150px;margin-right:5px;">원
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">멤버 레벨</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="product_type_all" type="radio" name="product_type" value="ALL" checked>
							<label for="product_type_all">전체</label>

							<input id="product_type_b" type="radio" name="product_type" value="B">
							<label for="product_type_b">일반</label>

							<input id="product_type_s" type="radio" name="product_type" value="S">
							<label for="product_type_s">Ader Family</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">당첨일</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__picker">
							<input id="prod_date_from" class="date_param" type="date" name="prod_date_from"
								class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
								date_type="prod_date" onChange="dateParamChange(this);">
						</div>
					</div>
					<div class="content__date__wrap">
						<div class="content__date__picker">
							<select class="display_date" type="select" name="display_from_h" style="width:80px">시
								<option value="" selected>시간</option>
							</select>
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
				<div class="blue__color__btn" onClick="putMenu('KR');"><span>검색</span></div>
				<div class="defult__color__btn" onClick="resetMenu('KR');"><span>초기화</span></div>
			</div>
		</div>
	</div>
</div>

<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3>영문몰 드로우 검색 결과</h3>
			</div>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
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
					<div style="width: 140px;" class="filter__btn" onclick="excelDownload();">활성/비활성</div>
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
						<col width="15%">
						<col width="15%">
						<col width="8%">
						<col width="8%">
					</colgroup>
					<thead>
						<tr>
							<th style="width:30px;">
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="draw_idx[]" value="">
										<span></span>
									</label>
								</div>
							</th>
							<th>No.</th>
							<th>드로우 상품정보</th>
							<th>옵션명</th>
							<th>판매 수량</th>
							<th>응모 수량</th>
							<th>구매 수량</th>
							<th>개별 응모</th>
							<th>전체 응모</th>
							<th>판매 가격</th>
							<th>기간</th>
							<th>구매기간</th>
							<th>당첨</th>
							<th>편집</th>
							<th>활성</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="5">
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="draw_idx[]" value="">
										<span></span>
									</label>
								</div>
							</td>
							<td rowspan="5">1</td>
							<td rowspan="5">
								<p style="margin-bottom:5px;"></p>
								<div class="product__img__wrap">
									<div class="product__img"
										style="background-image:url('/images/product/img_BLAFWCT06BL_06_P_S_202210210000.jpg');">
									</div>
									<span>
										<p>BLAFWCT06BL</p><br>
										<p>Sample BLAFWCT06BL</p><br>
										<p>150,000 ₩</p><br>
										<p>Color : red</p><br>
									</span>
							</td>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
							<td rowspan="5">
								<div class="btn">전체조회</div>
							</td>
							<td rowspan="5">300,000원</td>
							<td rowspan="5">2022.12.23 10:00<br>- 2022.12.23.11:00</td>
							<td rowspan="5">2022.12.24 10:00<br>- 2022.12.24.12:00</td>
							<td rowspan="5">
								<div class="btn">당첨</div>
							</td>
							<td rowspan="5">
								<div class="btn">편집</div>
							</td>
							<td rowspan="5">
								<div class="btn">비활성화</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>

						<tr>
							<td rowspan="5">
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="draw_idx[]" value="">
										<span></span>
									</label>
								</div>
							</td>
							<td rowspan="5">1</td>
							<td rowspan="5">
								<p style="margin-bottom:5px;"></p>
								<div class="product__img__wrap">
									<div class="product__img"
										style="background-image:url('/images/product/img_BLAFWCT06BL_06_P_S_202210210000.jpg');">
									</div>
									<span>
										<p>BLAFWCT06BL</p><br>
										<p>Sample BLAFWCT06BL</p><br>
										<p>150,000 ₩</p><br>
										<p>Color : red</p><br>
									</span>
							</td>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
							<td rowspan="5">
								<div class="btn">전체조회</div>
							</td>
							<td rowspan="5">300,000원</td>
							<td rowspan="5">2022.12.23 10:00<br>- 2022.12.23.11:00</td>
							<td rowspan="5">2022.12.24 10:00<br>- 2022.12.24.12:00</td>
							<td rowspan="5">
								<div class="btn">당첨</div>
							</td>
							<td rowspan="5">
								<div class="btn">편집</div>
							</td>
							<td rowspan="5">
								<div class="btn">비활성화</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
						<tr>
							<td>A1</td>
							<td>10</td>
							<td>7</td>
							<td>3</td>
							<td>
								<div class="btn">조회</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

	});
</script>