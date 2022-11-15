<style>
	.flex__wrap{
		display: flex;
		justify-content: space-between;
	}
	.wrap__bg--wh {
		background-color: #fff;
		padding: 10px;
		margin: 10px 0;
	}
	.defult__btn{
		color: black;
		background-color: #fff;
		border-radius: 5px;
		text-align: center;
		padding:  5px;
		border: 1px solid #484848;
	}
	.search__btn{
		color: black;
		background-color: #11aba6;
		border-radius: 5px;
		text-align: center;
		padding:  5px;
		border: 1px solid #11aba6;
	}
	.delete__btn{
		background: red;
		margin: 10px 0;
		width: 80px;
		color: #fff;
		border-radius: 5px;
		padding: 5px;
	}
</style>

<div class="content__card">
	<div class="card__header">
		<h3>블루마크 목록 검색</h3>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-filter" action="product/bluemark/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
				
			<div class="content__wrap">
				<div class="content__title">블루마크 찾기</div>
				<div class="content__row">
					<select id="search_select" class="fSelect" name="search_type" id="search_type" style="width:163px;" onChange="searchSelectChange(this);">
						<option value="" selected>검색분류 선택</option>
						<option value="product_code">상품코드</option>
						<option value="product_name">상품이름</option>
						<option value="option_code">옵션코드</option>
						<option value="option_name">옵션이름</option>
						<option value="serial_code">인증코드</option>
						<option value="member_id">인증멤버 ID</option>
						<option value="member_name">인증멤버 이름</option>
						<option value="tel_mobile">인증멤버 연락처</option>
						<option value="email">인증멤버 이메일</option>
					</select>
					<input id="search_keyword" type="text" name="search_keyword" value="" style="width:250px;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="status_all" class="radio__input" value="all" name="status" checked>
						<label for="status_all">전체</label>
						
						<input type="radio" id="status_true" class="radio__input" value="true" name="status">
						<label for="status_true">인증</label>
						
						<input type="radio" id="status_false" class="radio__input" value="false" name="status">
						<label for="status_false">미인증</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">블루마크 등록기간</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">							
							<input id="search_date_bluemark" type="hidden" name="search_date" value="" style="width:150px;">

							<div class="search_date_bluemark date__picker" date_type="bluemark" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_bluemark date__picker" date_type="bluemark" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
							<div class="search_date_bluemark date__picker" date_type="bluemark" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
							<div class="search_date_bluemark date__picker" date_type="bluemark" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
							<div class="search_date_bluemark date__picker" date_type="bluemark" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
							<div class="search_date_bluemark date__picker" date_type="bluemark" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_bluemark date__picker" date_type="bluemark" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						</div>
						
						<div class="content__date__picker">
							<input id="bluemark_from" class="date_param" type="date" name="bluemark_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="bluemark" onChange="dateParamChange(this);">
							<font>~</font>
							<input id="bluemark_to" class="date_param" type="date" name="bluemark_to" placeholder="To" readonly style="width:150px;" date_type="bluemark" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getBluemarkInfo();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="resultTableReset(9);"><span>초기화</span></div>
				</div>
			</div>
		</div>
		</form>
</div>

<div class="content__card">
	<div class="card__header">
		<h3>블루마크 검색결과</h3>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div class="info__wrap " style="justify-content:flex-end; align-items: center;">
			<div class="content__row">
				<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
					<option value="CREATE_DATE|DESC">등록일 역순</option>
					<option value="CREATE_DATE|ASC">등록일 순</option>
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
				
				<select name="rows" style="width:163px;float:right;" onChange="rowsChange(this);">
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
		
		<div class="table table__wrap" >
			<form id="frm-list">
				<input type="hidden" class="action_type" name="action_type">
				<div class="hidden">
					<input type="file" id="bluemark_upload">
				</div>
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onClick="bluemarkUpload();">블루마크 등록</div>
						<div class="filter__btn" action_type="delete" onClick="bluemarkActionClick(this);">삭제</div>
						<div class="filter__btn" onClick="excelDownload();">엑셀 다운로드</div>
					</div>                          
					<div>
						<div class="table__setting__btn">설정</div>
					</div>      
				</div>
				<div class="overflow-x-auto">
					<table id="excel_table" style="width:150%;">
						<thead>
							<tr>
								<th style="width:1%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" onclick="selectAllClick(this)">
											<span></span>
										</label>
									</div>
								</th>
								<th style="width:40px;">번호</th>
								<th style="width:100px;">상품코드</th>
								<th style="width:150px;">상품이름</th>
								<th style="width:110px;">옵션코드</th>
								<th style="width:110px;">옵션이름</th>
								<th style="width:100px;">정품코드</th>
								<th style="width:100px;">시즌</th>
								<th style="width:150px;">생성일</th>
								<th style="width:150px;">상태</th>
								<th style="width:120px;">회원</th>
								<th style="width:120px;">이름</th>
								<th style="width:100px;">연락처</th>
								<th style="width:150px;">이메일</th>
								<th style="width:150px;">인증일</th>
								<th style="width:150px;">작업</th>
							</tr>
						</thead>
						
						<tbody id="result_table">
							<tr>
								<td colspan="14" class="nodata"><i class="xi-slash-circle"></i>검색된 블루마크가 없습니다.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
		
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" >
			<input type="hidden" class="result_cnt" value="0">
			<div class="paging" id="paging"></div>
		</div>
		
	</div>
</div>

<script>
$(document).ready(function() {
	getBluemarkInfo();
	$('#bluemark_upload').on('change', function(e){
		var files = e.target.files;
		
		if(files != null){
			uploadSheet(files);
		};
		e.target.value = '';
	})
});

function getBluemarkInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<tr id="result_table">';
	strDiv += '    <td colspan="16" class="nodata"><i class="xi-slash-circle"></i>검색된 참여자가 없습니다.</td>';
	strDiv += '</tr>';
	
	$("#result_table").append(strDiv);
	
	var form = $("#frm-filter");
	var rows = form.find('.rows').val();
	var page = form.find('.page').val();
	
	get_contents(form,{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label for="">';
				strDiv += '                <input type="checkbox" class="select" name="select_idx" value="' + row.idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>' + row.product_code + '</TD>';
				strDiv += '    <TD>' + row.product_name + '</TD>';
				strDiv += '    <TD>' + row.barcode + '</TD>';
				strDiv += '    <TD>' + row.option_name + '</TD>';
				strDiv += '	   <TD><font style="cursor:pointer;" onClick="openBluemarkLogModal(' + row.idx + ');">' + row.serial_code + '</font></TD>';
				strDiv += '    <TD>' + row.season + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>';
				
				var status_str = "";
				var btn_color = "";
				if (row.status == true) {
					status_str = "인증";
					btn_color = "#90d5eb";
				} else {
					status_str = "미인증";
					btn_color = "#eecccc";
				}
				strDiv += '        <div class="defult__btn" style="background-color:' + btn_color + ';">' + status_str + '</div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.member_id + '</TD>';
				strDiv += '    <TD>' + row.member_name + '</TD>';
				strDiv += '    <TD>' + row.tel_mobile + '</TD>';
				strDiv += '    <TD>' + row.email + '</TD>';
				strDiv += '    <TD>' + row.reg_date + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <div class="defult__btn" onclick="bluemarkDelAction(this)" style="width: 70px;background: red; color: #fff;cursor:pointer"><i  class="xi-trash"></i>삭제</div>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');
	
	var date_type = $(obj).attr('date_type');

	if (date_type == "bluemark") {
		$('.search_date_bluemark').not($(obj)).css('background-color','#ffffff');
		$('#search_date_bluemark').val(date);
		$('#bluemark_from').val('');
		$('#bluemark_to').val('');
	} 
}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	if (date_type == "bluemark") {
		$('.search_date_bluemark').css('background-color','#ffffff');
		$('.search_date_bluemark').css('color','#000000');
		
		$('#search_date_bluemark').val('');
	}
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);
	
	getBluemarkInfo();
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);
	
	getBluemarkInfo();
}

function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$("#frm-list").find('.select').prop('checked',true);
	} else {
		$("#frm-list").find('.select').prop('checked',false);
	}
}
function bluemarkUpload(){
	$("#bluemark_upload").click();
}
function uploadSheet(obj){
    var files = obj;
    var reader = new FileReader();
	reader.readAsBinaryString(files[0]);
    reader.onload = function () {
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary'});
        workBook.SheetNames.forEach(function (sheetName) {
            if(sheetName == '블루마크업로드'){
                stock_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 1, header:1});
				json_str = JSON.stringify(stock_sheet);
				putBluemarkExcel(json_str, files.name);
            }
        })
    };
}
function putBluemarkExcel(str, name){
	if(str != null && str.length > 0){
		$.ajax({
			type: "post",
			data: {
				'bluemark_sheet':str
			},
			dataType: "json",
			url: config.api + "product/bluemark/add",
			error: function() {
				alert('블루마크 등록처리에 실패했습니다.');
			},
			success: function(d) {
				if(d.code == 200){
					alert(d.success_cnt + "건의 블루마크가 추가되었습니다.");
					insertLog("상품관리 > 블루마크 ", " 파일명 : " + name + "xlsx, 등록된 건수 ", d.success_cnt);
				} else{
					alert('다음행의 블루마크 데이터를 확인해주세요.<br>' + d.bluemark_fail);
					alert(d.msg);
				}
				getBluemarkInfo();
			}
		});
	}
}
function openBluemarkLogModal(idx){
	if(idx != null){
		modal('log', 'idx=' + idx);
	}
}
function bluemarkActionClick(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var action_type = $(obj).attr('action_type');
		var action_name = "";
		var select_idx	= "";
		$("#frm-list").find('input[name="action_type"]').val(action_type);

		var formData = new FormData();
		formData = $("#frm-list").serializeObject();

		switch(action_type){
			case 'delete':
				action_name = "삭제";
				break;
		}
		if (formData.select_idx.length == 0) {
			alert(action_name + ' 처리 할 블루마크를 선택해주세요.');
		} else {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "product/bluemark/put",
				error: function() {
					alert(action_name + " 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert(action_name + ' 처리에 성공했습니다.');
						insertLog("상품관리 > 블루마크 ", " 블루마크 일괄삭제 ", formData.select_idx.length);
						$("#frm-list").find('input[name="selectAll"]').prop('checked', false);
						getBluemarkInfo();
					}
				}
			});
		}
	});
}
function bluemarkDelAction(obj) {
	confirm("작업을 계속 진행하시겠습니까?",function() {
		var sel_idx = $(obj).parents('tr').find('.select').val();
		
		if (select_idx.length > 0) {
			$.ajax({
				type: "post",
				data: { 'select_idx'  : sel_idx,
						'action_type' : 'delete'},
				dataType: "json",
				url: config.api + "product/bluemark/put",
				error: function() {
					alert("삭제 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						insertLog("상품관리 > 블루마크 ", " 블루마크 단일삭제 ", 1);
						alert('삭제  처리에 성공했습니다.');
						getBluemarkInfo();
					}
				}
			});
		} 
	})
}
function excelDownload() {
	if ($("#frm-list").find('.default_td').length > 0) {
		alert('다운로드 할 블루마크를 검색해주세요.');
	} else {
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "블루마크";
		file_name = "블루마크_" + file_date;
		
		insertLog("상품관리 > 블루마크 ", "엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}
</script>