<h1>
	상품매출<small>Sales</small>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>매출분석</li>
		<li>상품매출</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="title">
			<h1><i class="xi-search"></i>조회 조건</h1>
		</div>
		<div class="body">
			<form id="frm_list_search" name="frm_list_search">
			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<label>
							<input type="radio" name="brcd" value="A" checked><span></span>
							아더에러
						</label>
						<label>
							<input type="radio" name="brcd" value="D"><span></span>
							데이에프터데이
						</label>
						<label class="control-label">브랜드코드</label>
					</div>
					<div class="form-group">
						<label>
							<input type="radio" name="searchgu" value="1" checked><span></span>
							전체
						</label>
						<label>
							<input type="radio" name="searchgu" value="2"><span></span>
							매장별
						</label>
						<label>
							<input type="radio" name="searchgu" value="3"><span></span>
							일자별
						</label>
						<label>
							<input type="radio" name="searchgu" value="4"><span></span>
							스타일별
						</label>
						<label>
							<input type="radio" name="searchgu" value="5"><span></span>
							스타일+컬러+사이즈별
						</label>
						<label class="control-label">조회구분</label>
					</div>
					<div class="form-group">
						<input type="date" name="fromdt" value="<?=date('Y-m').'-01'?>" style="width:160px">
						~
						<input type="date" name="todt" value="<?=date('Y-m-d')?>" style="width:160px">
						<label class="control-label">기간</label>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<label><input type="checkbox" name="shopcode[]" value="" checked><span></span></label>
						<label class="control-label">매장</label>
					</div>
					<div class="form-group">
						<label><input type="checkbox" name="returnyn[]" value="1" checked><span>판매</span></label>
						<label><input type="checkbox" name="returnyn[]" value="2" checked><span>반품</span></label>
						<label class="control-label">반품여부</label>
					</div>
				</div>
			</div>
			</form>
			<div class="footer">
				<a class="btn green btn-large" onclick="list_search(true);"><i class="xi-search"></i> 검색</a>
				<a class="btn btn-large" onclick="frm_list_search.reset();"><i class="xi-undo"></i> 조건초기화</a>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm-list" action="shop/goods/get">
				<table class="list">
				<thead>
					<tr data-tbodyid="list">
						<th width="70px">번호</th>
						<th width="120px">스타일코드</th>
						<th width="70px">컬러코드</th>
						<th width="90px">사이즈코드</th>
						<th class="toggle" width="90px">현지<br>스타일코드</th>
						<th class="toggle" width="80px">작지수량</th>
						<th class="toggle" width="80px">입고수량</th>
						<th class="toggle" width="80px">매장<br>출고수량</th>
						<th class="toggle" width="80px">타게정<br>출고수량</th>
						<th class="toggle" width="80px">판매수량</th>
						<th class="toggle" width="80px">창고<br>재고수량</th>
						<th class="toggle" width="80px">매장<br>재고수량</th>
						<th class="toggle" width="80px">본사<br>재고수량</th>
						<th class="toggle" width="80px">입고대비<br>판매율</th>
						<th class="toggle" width="80px">출고대비<br>판매율</th>
						<th class="toggle" width="110px">최초출고일</th>
						<th width="100px">원가</th>
						<th width="120px">최초가</th>
						<th width="120px">판매가</th>
						<th width="80px">판매유형</th>
						<th width="90px"></th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="21" class="nodata"><i class="xi-ban"></i><br>검색된 자료가 없습니다.</td>
					</tr>
				</tbody>
				</table>
				</form>
			</div>
			<div class="padding-bottom-0">
				<div class="text-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>


<script>
$("table th.toggle").click(function() {
	var idx = $(this).index() + 1;
	var tbodyid = $(this).parent().data("tbodyid");
	
	$(this).toggleClass("on");

	$("#" + tbodyid + " > tr > td:nth-child(" + idx + ")").each(function() {
		$(this).toggleClass("toggle-on");
	});
});


function get_stylecode(obj) {
	$.ajax({
		type: "get",
		url: config.api + "sales/goods/stylecode",
		dataType: "json",
		error: function() {
		},
		success: function(d) {
			var html,thumb;

			if(d.data.length > 0) {
				html = "";
				for(var i=0;i<d.data.length;i++) {
					html += '<option value="' + d.data[i].STYCD + '">' + d.data[i].STYCD + '</option>';
				}

			}
			$(obj).html(html);
		}
	});
}


function list(query) {
	query = list_query(query);

	$.ajax({
		type: "get",
		url: config.api + "sales/goods/",
		data: query,
		dataType: "json",
		error: function() {
		},
		success: function(d) {
			var html,thumb;

			if(d.data.length > 0) {
				html = "";
				var num = d.paging.totalrecordcount - ((d.paging.pageno-1)*d.paging.pagesize);
				for(var i=0;i<d.data.length;i++) {
					thumb = "";
					if(d.data[i].thumb != "") {
						thumb = '<img src="' + d.data[i].thumb + '" class="preview">';
					}

					html += '<tr data-no="' + d.data[i].num + '">';
					html += '	<td>' + (num--) + '</td>';
					html += '	<td>' + d.data[i].stylecode + '</td>';
					html += '	<td>' + d.data[i].colorcode + '</td>';
					html += '	<td>' + d.data[i].sizecode + '</td>';
					html += '	<td>' + d.data[i].importstylecode + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].planqty) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].inqty) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].outqty_shop) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].outqty_etc) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].saleqty) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].stockqty) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].shop_stockqty) + '</td>';
					html += '	<td class="text-right">' + number_format(d.data[i].company_stockqty) + '</td>';
					html += '	<td class="text-right">' + d.data[i].inqty_saleqty_rt + '%</td>';
					html += '	<td class="text-right">' + d.data[i].outqty_saleqty_rt + '%</td>';
					html += '	<td>' + d.data[i].foutdt + '</td>';
					html += '	<td class="text-right">' + d.data[i].acost + '</td>';
					html += '	<td class="text-right">￦ ' + number_format(d.data[i].firstpri) + '</td>';
					html += '	<td class="text-right">￦ ' + number_format(d.data[i].salepri) + '</td>';
					html += '	<td>' + d.data[i].saletype + '</td>';
					html += '	<td>';
					//html += '		<a href="javascript:;" onclick="modal(\'contents/api/add\',\'no=' + d.data[i].no + '\');" class="btn blue"><i class="xi-eye-o"></i><span class="tooltip top">수정</span></a>';
					//html += '		<a href="javascript:;" onclick="confirm(\'해당 컨텐츠를 삭제할까요?\',\'contents_delete(' + d.data[i].no + ')\');" class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
					html += '	</td>';
					html += '</tr>';
				}

				paging(d.paging.totalrecordcount,d.paging.pageno,d.paging.pagesize,9,$("#paging"));
			}
			else {
				html += '<tr>';
				html += '	<td colspan="21" class="nodata"><i class="xi-slash-circle"></i>검색된 정보가 없습니다.</td>';
				html += '</tr>';
				paging(1,1,20,9,$("#paging"));
			}
			$("#list").html(html);
		}
	});
}


$(document).ready(function() {
	list_search(true);
});
</script>