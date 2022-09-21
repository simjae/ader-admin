<h1>
	쿠폰<small>쿠폰 발급, 관리</small>
	<div class="tools">
		<a onclick="modal('put');"><i class="xi-plus"></i><span class="tooltip left">쿠폰 추가</span></a>
	</div>
</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>쇼핑몰</li>
		<li>쿠폰</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="body">
			<form id="frm_list" name="frm_list">
			<table class="list">
			<thead>
				<tr>
					<th width="30px"><input type="checkbox" class="checkbox-all-toggle"><i></i></th>
					<th style="width:10%">쿠폰번호</th>
					<th style="width:10%">주문자</th>
					<th style="width:13%">휴대폰번호</th>
					<th style="width:80px">상태</th>
					<th>주문상품</th>
					<th style="width:150px">생성일</th>
					<th style="width:150px">사용일</th>
					<th width="100px">작업</th>
				</tr>
				<tr>
					<th></th>
					<th><input type="text" name="ordernum"></th>
					<th><input type="text" name="goods"></th>
					<th><input type="text" name="name"></th>
					<th></th>
					<th><input type="text" name="name"></th>
					<th><input type="text" name="orderdate_from" class="margin-bottom-6" placeholder="From" readonly><input type="text" name="orderdate_to" placeholder="To" readonly></th>
					<th><input type="text" name="orderdate_from" class="margin-bottom-6" placeholder="From" readonly><input type="text" name="orderdate_to" placeholder="To" readonly></th>
					<th>
						<a href="javascript:;" class="btn green margin-bottom-6"><i class="xi-search"></i> 검색</a><br>
						<a href="javascript:;" class="btn"><i class="xi-close"></i> 취소</a>
					</th>
				</tr>
			</thead>
			<tbody id="list">
				<tr>
					<td colspan="9" class="nodata"><i class="xi-ban"></i>검색된 쿠폰이 없습니다.</td>
				</tr>
			</tbody>
			</table>
			</form>
		</div>
	</div>
</div>

<script>
</script>