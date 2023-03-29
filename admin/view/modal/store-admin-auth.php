<style>
.table__wrap {margin-top:0px!important;}
.table__toggle__btn {background-color:#fafafa;border:1px solid #000000;color:#000000;width:100%;height:28px;text-align:center;font-size:12px;font-weight:300;line-height:2.4;cursor:pointer;margin-top:15px;}
.modal > .con > .body.modal__wrap{height:90vh!important;display:flex;flex-direction:column;}
.modal__wrap, .modal__wrap .modal__body{height:90vh}
.modal__wrap .modal__body{flex: 1;overflow-y:scroll}
.xi-close{float:right;}
</style>

<div class="body modal__wrap" style="width:1000px;">
	<div class="modal__header">
		<h1>
			운영자 권한 설정
			<a onclick="modal_close();" class="btn-close">
				<i class="xi-close" ></i>
			</a>
		</h1>
	</div>
	
    <div class="contents modal__body" >
		<form id="frm-auth" action="store/admin/put">
			<input class="param_admin_idx" type="hidden" name="admin_idx" value="<?=$admin_idx?>">
			<input class="param_permition_idx" type="hidden" name="permition_idx" value="">
			
			<h3>공통</h3>
			<div sort="COMMON" class="table__toggle__btn toggle_permition">공통</div>
			<input type="hidden" name="permition_idx" value="">
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_COMMON">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			<h3 style="margin-top:15px;">WCC</h3>
			<div sort="DASHBOARD" class="table__toggle__btn toggle_permition">1. 대시보드</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_DASHBOARD">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="STORE" class="table__toggle__btn toggle_permition">2. 상점관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_STORE">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="MEMBER" class="table__toggle__btn toggle_permition">3. 회원</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_MEMBER">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="PRODUCT" class="table__toggle__btn toggle_permition">4. 상품</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_PRODUCT">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="DISPLAY" class="table__toggle__btn toggle_permition">5. 전시</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_DISPLAY">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="PROMOTION" class="table__toggle__btn toggle_permition">6. 프로모션</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_PROMOTION">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="ORDER" class="table__toggle__btn toggle_permition">7. 주문</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_ORDER">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			<h4 style="margin-top:15px;">PCS</h4>
			<div sort="COLUMN" class="table__toggle__btn toggle_permition">항목관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_COLUMN">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="SUBMATERIAL" class="table__toggle__btn toggle_permition">부자재관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_SUBMATERIAL">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="ORDERSHEET" class="table__toggle__btn toggle_permition">상품관리(오더시트)</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_ORDERSHEET">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="WHOLESALE" class="table__toggle__btn toggle_permition">홀세일관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_WHOLESALE">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="SAMPLE" class="table__toggle__btn toggle_permition">샘플관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_SAMPLE">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="FACTORY" class="table__toggle__btn toggle_permition">생산업체관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_FACTORY">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="BLUEMARK" class="table__toggle__btn toggle_permition">블루마크</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_BLUEMARK">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer modal__footer">
		<a class="btn" onclick="modal_cancel();"><i class="xi-close"></i>작성 취소</a>
		<a class="btn red" onClick="putAdminPermition();"><i class="xi-check"></i>적용</a>
	</div>
</div>

<script>
$(document).ready(function() {	
	getAdminPermitionList();
	
	$('.toggle_permition').click(function() {
		let sort = $(this).attr('sort');
		console.log(sort);
		if (sort != null) {
			$('.table_' + sort).parent().toggle();
		}
	});
});

function getAdminPermitionList() {
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "store/admin/permition/get",
		error: function() {
			alert("운영자 삭제 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let permition_sort = d.data.permition_sort;
				let permition_info = d.data.permition_info;
				
				if (permition_sort != null && permition_info != null) {
					for (let i=0; i<permition_sort.length; i++) {
						let sort_value = permition_sort[i];
						
						let permition_table = $('.table_' + sort_value);
						let result_body = permition_table.find('.result_body');
						
						let strDiv = "";
						
						let num = 0;
						permition_info[sort_value].forEach(function(row) {
							num++;
							
							strDiv += '<TR>';
							strDiv += '    <TD>' + row.permition_type + '</TD>';
							strDiv += '    <TD>' + row.permition_name + '</TD>';
							strDiv += '    <TD>' + row.permition_url + '</TD>';
							strDiv += '    <TD>' + row.permition_tab + '</TD>';
							
							strDiv += '    <TD>';
							strDiv += '        <div class="flex" style="gap:10px;">';
							
							strDiv += '            <label class="rd__square">';
							strDiv += '                <input class="permition_idx" type="radio" permition_idx="' + row.permition_idx + '" name="radio_' + sort_value + '_' + num + '" value="true">';
							strDiv += '                <div><div></div></div>';
							strDiv += '                <span>권한허용</span>';
							strDiv += '            </label>';
							
							strDiv += '            <label class="rd__square">';
							strDiv += '                <input class="permition_idx" type="radio" name="radio_' + sort_value + '_' + num + '" value="false" checked>';
							strDiv += '                <div><div></div></div>';
							strDiv += '                <span>권한없음</span>';
							strDiv += '            </label>';
							
							strDiv += '        </div>';
							strDiv += '    </TD>';

							strDiv += '</TR>';
						});
						
						result_body.append(strDiv);
					}
				}
			}
		}
	});
}

function putAdminPermition() {
	let frm = $('#frm-auth');
	let admin_idx = frm.find('.param_admin_idx').val();
	
	let cnt = frm.find('.permition_idx').length;
	
	let tmp_permition_idx = [];
	for (let i=0; i<cnt; i++) {
		let tmp_idx = frm.find('.permition_idx').eq(i);
		if (tmp_idx.prop('checked') == true && tmp_idx.val() == "true") {
			tmp_permition_idx.push(tmp_idx.attr('permition_idx'));
		}
	}
	
	confirm(
		"선택한 권한을 부여하시겠습니까?",
		function() {
			$.ajax({
				type: "post",
				data: {
					'admin_idx' : admin_idx,
					'permition_idx' : tmp_permition_idx
				},
				dataType: "json",
				url: config.api + "store/admin/permition/put",
				error: function() {
					alert("운영자 삭제 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						$('#admin_table').find('.select').prop('checked',false);
						
						alert(
							'선택한 운영자의 권한이 설정되었습니다',
							function() {
								modal_close();
							}
						);
					}
				}
			});
		}
	);
}

</script>