<h1>
	매출집계<small>Sales</small>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>매출분석</li>
		<li>매출집계</li>
	</ul>
</div>


<div class="row">
	<div class="col-2">
		<div class="dashboard-stat">
			<h1>총 매출</h1>
			<div class="details">
				<i class="xi-money bg-purple"></i>
				<div class="unit">￦</div>
				<div class="number count-number" data-speed="1000" id="count-number-1">0</div>
			</div>
		</div>
	</div>

	<div class="col-2">
		<div class="dashboard-stat">
			<h1>선택 매출</h1>
			<div class="details">
				<i class="xi-calculator bg-blue"></i>
				<div class="unit">￦</div>
				<div class="number count-number" data-speed="1000" id="count-number-2">0</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<div class="row">
				<form id="frm_list" name="frm_list" data-module="sales/sales">

				<table class="list" style="min-width:550px">
				<thead>
					<tr>
						<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
						<th width="70px">번호</th>
						<th width="17%">코드</th>
						<th width="30%">코드명</th>
						<th class="sort">실판매금액</th>
					</tr>
					<tr>
						<th colspan="5" class="text-right">
							<span class="form-group" style="width:auto;padding-right:15px">
								<label>
									<input type="radio" name="brcd" value="A" checked><span></span>
									아더에러
								</label>
							</span>
							<span class="form-group" style="width:auto;padding-right:30px">
								<label>
									<input type="radio" name="brcd" value="D"><span></span>
									데이애프터데이
								</label>
							</span>
							<input type="date" name="fromdt" value="<?=date('Y-m',time())?>-01" style="width:160px;margin-right:8px">
							~
							<input type="date" name="todt" value="<?=date('Y-m-d',time())?>" style="width:160px;margin-left:8px;margin-right:10px">
							<a class="btn green margin-bottom-6" onclick="list_search(true);"><i class="xi-search"></i> 검색</a>
						</th>
					</tr>
				</thead>
				<tbody id="list">
					<tr>
						<td colspan="5" class="nodata"><i class="xi-ban"></i><br>검색된 자료가 없습니다.</td>
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
function list(query) {
	query = list_query(query);

	$.ajax({
		type: "get",
		url: config.api + "sales/sales/",
		data: query,
		dataType: "json",
		error: function() {
		},
		success: function(d) {
			var html,thumb;

			if(d.data.length > 0) {
				html = "";
				var total_money = 0;
				var num = d.paging.totalrecordcount - ((d.paging.pageno-1)*d.paging.pagesize);
				for(var i=0;i<d.data.length;i++) {
					html += '<tr>';
					html += '	<td><input type="checkbox" name="no" value="' + d.data[i].실판매금액 + '"><i></i></td>';
					html += '	<td>' + (num--) + '</td>';
					html += '	<td>' + d.data[i].SHOPCODE + '</td>';
					html += '	<td>' + d.data[i].SHOPCODESNM + '</td>';
					html += '	<td class="text-right">￦ ' + number_format(d.data[i].실판매금액) + '</td>';
					html += '</tr>';

					total_money += d.data[i].실판매금액;
				}

				paging(d.paging.totalrecordcount,d.paging.pageno,d.paging.pagesize,9,$("#paging"));
			}
			else {
				html += '<tr>';
				html += '	<td colspan="5" class="nodata"><i class="xi-slash-circle"></i>검색된 정보가 없습니다.</td>';
				html += '</tr>';
				paging(1,1,20,9,$("#paging"));
			}
			$("#list").html(html);
			$("table input[type='checkbox']").change(function() {
				$("#list tr.select").removeClass("select");
				var total = 0;
				$("#list input[name='no']:checked").each(function() {
					total += parseInt($(this).val());
					$(this).parent().parent().addClass("select");
				});
				$("#count-number-2").html(number_format(total)); // 선택매장매출
			});
			$("#count-number-1").html(number_format(total_money)); // 총매출
		}
	});
}


$(document).ready(function() {
	list_search(true);
});
</script>