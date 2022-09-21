<h1>
	결제집계<small>Payout</small>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>매출분석</li>
		<li>결제집계</li>
	</ul>
</div>


<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm_list" name="frm_list" data-module="contents/collaboration">
				<table class="list">
				<thead>
					<tr>
						<th width="70px">번호</th>
						<th width="120px">스타일코드</th>
						<th width="70px">컬러코드</th>
						<th width="90px">사이즈코드</th>
						<th width="90px">현지<br>스타일코드</th>
						<th width="80px">작지수량</th>
						<th width="80px">입고수량</th>
						<th width="80px">매장<br>출고수량</th>
						<th width="80px">타게정<br>출고수량</th>
						<th width="80px">판매수량</th>
						<th width="80px">창고<br>재고수량</th>
						<th width="80px">매장<br>재고수량</th>
						<th width="80px">본사<br>재고수량</th>
						<th width="80px">입고대비<br>판매율</th>
						<th width="80px">출고대비<br>판매율</th>
						<th width="110px">최초출고일</th>
						<th width="100px">원가</th>
						<th width="120px">최초가</th>
						<th width="120px">판매가</th>
						<th width="80px">판매유형</th>
						<th width="90px"></th>
					</tr>
					<tr>
						<th></th>
						<th><select name="stylecode"></select></th>
						<th><select name="colorcode"></select></th>
						<th><select name="sizecode"></select></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><input type="date" name="s_fromdt" class="margin-bottom-6" placeholder="From"><input type="date" name="s_todt" placeholder="To"></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
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
			<div class="row padding-bottom-0">
				<div class="float-right paging" id="paging"></div>
			</div>
		</div>
	</div>
</div>


<script>
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
	get_stylecode($("select[name='stylecode']"));
	list('page=1');
});
</script>