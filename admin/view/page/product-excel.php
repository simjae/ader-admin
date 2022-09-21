<style>
	.flex__wrap{
		display: flex;
		justify-content: space-between;
	}
	.filter-wrap{
		display: flex;
		gap: 10px;
	}
	.filter-btn{
		color: #11aba6;
		background-color: #fff;
		font-size: 20px;
		font-weight: 500;
		padding: 10px;
	}
	.checked{
		background-color: #11aba6;
		color: #fff;
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
	.black__btn{
		color: #fff;
		background-color: black;
	}

	.btn__flex__box{
		display: flex;
		gap: 10px;
	}
	.xi-close-min{
		color: red;
		margin-right: 5px;
	}
	.essential{
		background-color: red;
		color: #fff;
	}
	.detail__btn{
		font-size: 20px;
		margin-bottom: 5px;
		border-bottom: 1px solid black;
		font-weight: 500;
	}
	.size__guide{
		width: 200px;
		height: 200px;
		border: 1px solid #4f4f4f;
	}
	.file__wrap{
		display: grid;
		grid-template-columns: 3fr 7fr;
		padding: 20px;
	}
	.file__drag__wrap{
	
		
	}
	.file__content__wrap{
		padding: 0 20px;
	}
	.exel__zone{
		margin-bottom:20px;
		width: 100%;
		border: 1px dashed #779af6;
		background-color: #F1F6FF;
		display: flex;
		flex-direction: column;
		align-items: center;
	}
	.img__zone{
		width: 100%;
		height: 100px;
		border: 1px dashed #b1b1b1;
		margin-bottom: 20px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.exel__upload__btn{
		padding: 20px 40px;
		background-color: #86A8F4;
		border-radius: 30px;
		color: #fff;
		font-weight: 500;
		box-shadow: 2px 2px 6px #2d222238;
		margin-bottom: 70px;
	}
	#exel-dropzone{
		margin: 60px 0 20px 0;
		height: 150px;
		width: 150px;
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: #fff;
		border-radius: 50%;
		box-shadow: 2px 2px 6px #2d222238;
	}
	.content__exel__btn{
		border: 1px solid #E2E5E9;
		font-size: 12px;
		border-radius: 30px;
		color: #605F60;
		padding: 10px 15px;
		font-weight: 500;
	}
	.file__content__line{
		display: flex;
		flex-basis: 100%;
		align-items: center;
		margin: 10px 0;
	}
	.file__content__line::after {
		content: "";
		flex-grow: 1;
		background: #c2c2c2;
		height: 1px;
		font-size: 0px;
		line-height: 0px;
		margin: 0 10px;
	}
	.file__content__uploading{
		min-height: 100px;
		display: flex;
		flex-direction:column;
		justify-content: center;
		align-items: center;
	}
	.file__content__uploaded{
		min-height: 100px;
		display: flex;
		align-items: center;
		border-bottom: 1px solid #F0F0F0;
		justify-content: space-between;
	}
	.content__result__list{
		display: flex;
		gap: 20px;
		padding: 20px;
	}
</style>

<div class="navigation">
	<ul>
		<li>Home</li>
		<li>상품관리</li>
		<li>엑셀 등록</li>
	</ul>
</div>
<div class="row">
	<div class="row">
		<button class="excel_tab_btn" tab_num="01" style="width:150px; height:30px; border:1px solid #000000;background-color:#3CB3AB;color:#ffffff;font-weight:800;margin-right:10px;cursor:pointer;" onClick="excelTabBtnClick(this);">엑셀-상품 등록/수정</button>
		<button class="excel_tab_btn" tab_num="02" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;" onClick="excelTabBtnClick(this);">엑셀-상품옵션 등록/수정</button>
	</div>
	
	<div class="portlet" style="margin-top:20px;">
		<div class="title">
			<h1 id="tabTitle">엑셀-상품등록/수정</h1>
			<!--<input id="pwtest" type="text" value = "test">-->
		</div>
		
		<div class="body">
			<input id="tab_num" type="hidden" value="01">
			<div id="excel_tab_01" class="row excel_tab" style="margin-top:0px;">
				<?php include_once("product-excel-insert_product.php"); ?>
			</div>
			
			<div id="excel_tab_02" class="row excel_tab" style="display:none;margin-top:0px;">
				<?php include_once("product-excel-update_product.php"); ?>
			</div>
		</div>
	</div>
</div>

<script>
var wait_sheet 	= [];
var finish_sheet = [];
var fail_sheet 	= [];
var error_msg = '';

$(document).ready(function() {
});
function excelTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.excel_tab').hide();
	$('#excel_tab_' + tab_num).show();
	
	$(obj).css('background-color','#3CB3AB');
	$(obj).css('color','#ffffff');
	$(obj).css('font-weight','800');
	
	$('.excel_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.excel_tab_btn').not($(obj)).css('color','#000000');
	$('.excel_tab_btn').not($(obj)).css('font-weight','500');
	resetExcelList();
}

$('.exel__zone').on('dragenter', function(e){
    e.preventDefault();
    e.stopPropagation();
})
.on("dragover", function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).css("background-color","#FFD8D8");
})
.on("dragleave",function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).css("background-color","#F1F6FF");
})
.on("drop", function(e){
    e.preventDefault();
    $('.exel__zone').css("background-color","#F1F6FF");
    var files = e.originalEvent.dataTransfer.files;
	setSheetList(files);
})
$('.upload_btn').on('change', function(e){
    var files = e.target.files;
	setSheetList(files);
	event.target.value = '';
})
$('.filter-tap').on('click', '.exel__zone', function(e){
	var tab_num = $('#tab_num').val();
    $("input[name='upload_btn_"+tab_num+"']").click();
})
$('.file__content__wrap').on('click', '.exel__execute__btn', function(e){
	confirm("상품등록작업을 시작하시겠습니까?", `excelActionBtn()`);
})
function setSheetList(obj){
	var overlap_flg = false;
	for(var i = 0; i < obj.length; i++){
		var file = obj[i];
		var overlap_cnt = 0;
		var overlap_idx = 0;
		wait_sheet.forEach(function(element, idx){
			if(element.name == file.name){
				overlap_cnt++;
				overlap_idx = idx;
			}
		})
		if(overlap_cnt > 0){
			wait_sheet[overlap_idx] = file;
			overlap_flg = true;
		}
		else{
			wait_sheet.push(file);
		}
	}
	if(overlap_flg == true){
		alert('이미 등록된 파일입니다. 최신파일로 덮어씌워집니다.');
	}
	printWaitSheetList();
}
function excelActionBtn(){
	var tab_num = $('#tab_num').val();
	var target_cnt = 0;

	$('#wait_list_table_'+tab_num).html('');

	if(wait_sheet.length > 0){
		wait_sheet.forEach(function(element, index, list){
			readExcel(element, index, tab_num);
		});
		wait_sheet = [];
	}
	else{
		alert("업로드한 파일이 없습니다.");
	}
	//printSheetList();
}
function readExcel(element, index, tab_num){
	var tab_num = $('#tab_num').val();

	var file_name = element.name;
	var msg = '';
    var reader = new FileReader();
	var total_row = {};
	
    reader.onload = function () {
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary'});
        workBook.SheetNames.forEach(function (sheetName) {
            if(sheetName == '오더시트'){
                var order_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 10, header:1});
                total_row.order_sheet = order_sheet;
				
            }
			else if(sheetName == '판매용 추가정보'){
                var optional_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 10, header:1});
				total_row.optional_sheet = optional_sheet;
            }
			else if(sheetName == '상품 이미지정보'){
                var img_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 0, header:1});
				total_row.img_sheet = img_sheet;
            }
        })
		switch (tab_num){
			case '01':
				if(!total_row.hasOwnProperty('order_sheet')){
					msg = 'order_sheet가 존재하지않습니다.';
				}
				else{
					total_row.order_sheet.forEach(function(element, index, array){
						total_row.order_sheet[index][49] = Math.round( element[49] * 100 + Number.EPSILON ) / 100;
						total_row.order_sheet[index][50] = Math.round( element[50] * 100 + Number.EPSILON ) / 100;
					})
				}
				break;
			case '02':
				if(!total_row.hasOwnProperty('optional_sheet')){
					msg = 'optional_sheet가 존재하지 않습니다.';
				}
				break;
		}
		
		if(msg.length > 0){
			element.error_msg = msg;
			printFailSheetList(element);
		}
		else{
			json_str = JSON.stringify(total_row);
			var result = putExcel(element,json_str,file_name);
			if(typeof result == 'String'){
				element.error_msg = result;
				printFailSheetList(element);
			}
		}
    };
	reader.readAsBinaryString(element);
}

function putExcel(element,json_str,file_name){
	var api_addr = '';
	var action_str = '';
	var tab_num = $('#tab_num').val();
	var msg = '';
	if(json_str == null){
		return '데이터가 존재하지 않습니다.';
	}
	else{
		switch(tab_num){
		case '01':
			api_addr = 'put';
			action_str = '상품 등록/수정';
			break;
		case '02':
			api_addr = 'update';
			action_str = '상품 옵션 등록/수정';
			break;
		}
		if(api_addr != ''){
			var result_json = {};
			$.ajax({
				type: "post",
				data: {
					'sheet_data':json_str
				},
				dataType: "json",
				url: config.api + "product/excel/"+api_addr,
				error: function() {
					msg = 'api 접근에러';
				},
				success: function(d) {
					insertLog('상품관리 > 엑셀 등록', action_str + ": " + file_name, 1);
					if(d.code == 200) {
						var result_cnt = 0;
						result_json.product = d.result.product;
						result_json.img 	= d.result.img;
						result_json.option 	= d.result.option;

						var json_str = JSON.stringify(result_json);
						if(tab_num == '01'){
							if(d.result.product.true.length == 0){
								msg = '갱신/등록된 상품이 없습니다.';
							}
							else{
								alert('등록이 완료되었습니다.');
								printFinishSheetList(element, json_str);
							}
						}
						else if(tab_num == '02'){
							if(d.result.option.true.length == 0){
								msg = '갱신된 상품-옵션이 없습니다.';
							}
							else{
								alert('등록이 완료되었습니다.');
								printFinishSheetList(element, json_str);
							}
						}
					}
					else{
						msg = '잘못된 값이 존재합니다.';
					}
				}
			});
		}
	}
	if(msg.length != ''){
		return msg;
	}
}
function printWaitSheetList(){
	var tab_num = $('#tab_num').val();

	$('#wait_list_table_'+tab_num).html('');
	
	if(wait_sheet.length > 0){
		wait_sheet.forEach(function(element){
			var date = new Date(element.lastModifiedDate);
			var last_modify_date = date.toISOString().substring(0,19);
			last_modify_date = last_modify_date.replace('T', ' ');
			$('#wait_list_table_'+tab_num).append(`
				<TR>
					<TD>
						<i style="font-size: 30px;" class="xi-file-text-o"></i>
					</TD>
					<TD>${element.name}</TD>
					<TD>최종수정시간:${last_modify_date}</TD>
				</TR>
			`);
		});
	}
	else{
		$('#list_table_'+tab_num).append(`<p>업로드 된 파일이 없습니다.</p>`);
	}
}
function printFinishSheetList(element, json_str){
	var tab_num = $('#tab_num').val();
	var date = new Date();
	var regist_date = date.toISOString().substring(0,19);
	
	regist_date = regist_date.replace('T', ' ');

	$('#finish_list_table_'+tab_num).append(`
		<TR onclick="openExcelResultModal(this)" style="cursor:pointer;">
			<TD>
				<i style="font-size: 30px;" class="xi-file-text-o"></i>
				<input type="hidden" value='${json_str}'>
			</TD>
			<TD>${element.name}</TD>
			<TD>업로드 시간: ${regist_date}</TD>
		</TR>
	`);
}
function printFailSheetList(element){
	var tab_num = $('#tab_num').val();
	$('#fail_list_table_'+tab_num).append(`
		<TR>
			<TD>
				<i style="font-size: 30px;" class="xi-file-text-o"></i>
			</TD>
			<TD>${element.name}</TD>
			<TD>실패원인: ${element.error_msg}</TD>
		</TR>
	`);
}
function openExcelResultModal(obj){
	var tab_num = $('#tab_num').val();
	var json_str = $(obj).find('input:eq(0)').val();

	modal('product/result', `json_str=${json_str}`);
}
function resetExcelList(){
	var tab_num = $('#tab_num').val();
	wait_sheet 	= [];
	error_msg 	= '';
	$('#wait_list_table_'+tab_num).html('');
	$('#finish_list_table_'+tab_num).html('');
	$('#fail_list_table_'+tab_num).html('');
}
</script>