<div class="body">
	<h1>
		상품 검색항목 설정
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<input id="order_status" type="hidden" value="<?=$order_status?>">
		
		<div class="table__wrap" style="margin-top:10px;">
			<TABLE id="select_table">
				<THEAD>
					<TR>
						<TH>검색항목</TH>
						<TH>검색항목 체크</TH>
					</TR>
				</THEAD>
				<TBODY>
					<TR>
						<TD>MD카테고리</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column md_category" type="checkbox" value="md_category">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>판매여부</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column sale_flg" type="checkbox" value="sale_flg">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>품절여부</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column sold_out_flg" type="checkbox" value="sold_out_flg">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>제조사</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column manufacturer" type="checkbox" value="manufacturer">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>공급사</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column supplier" type="checkbox" value="supplier">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>브랜드</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column brand" type="checkbox" value="brand">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>원산지</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column origin_country" type="checkbox" value="origin_country">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>기획가격</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column price" type="checkbox" value="price">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>모델</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column model" type="checkbox" value="model">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>모델사이즈</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column model_wear" type="checkbox" value="model_wear">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>상품키워드</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column product_keyword" type="checkbox" value="product_keyword">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>상품태그</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column product_tag" type="checkbox" value="product_tag">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>

					<TR>
						<TD>메모</TD>
						<TD style="text-align:left;">
							<div class="cb__color form-group">
								<label>
									<input class="select_column memo" type="checkbox" value="memo">
									<span>검색항목 추가</span>
								</label>
							</div>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="setSelectColumn();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
let frm = $('#frm-filter');

$(document).ready(function() {
	let select_table = $('#select_table');
	
	let select_column = frm.find('#select_column').val();
	
	let column_arr = [];
	if (select_column.length > 0 && select_column != null) {
		column_arr = select_column.split(",");
	}
	
	if (column_arr.length > 0) {
		for (let i=0; i<column_arr.length; i++) {
			let tmp_class = column_arr[i];
			select_table.find('.' + tmp_class).prop('checked',true);
		}
	}
	
});

function setSelectColumn() {
	let select_table = $('#select_table');
	
	let checkbox = select_table.find('.select_column');
	let cnt = checkbox.length;
	
	let select_column = [];
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			select_column.push(checkbox.eq(i).val());
		}
	}
	
	frm.find('#select_column').val(select_column);
	getProductInfoList();
	modal_close();
}
</script>