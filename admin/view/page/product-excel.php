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
	
	.file__content__wrap{
		padding: 0 20px;
	}
	.exel__zone{
		width: 100%;
		height: 200px;
		border: 1px solid #bfbfbf;
		display: flex;
		flex-direction: column;
		justify-content: center;
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
		background-color: #BFBFC0;
		color: #fff;
		font-size: 12px;
		width: 140px;
		text-align: center;
		line-height: 2;
		height: 22px;
		font-weight: 500;
		box-shadow: 1px 1px 4px #2d222238;
		border-radius: 2px;
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
	.exel__btn__wrap{
		display: flex;
		gap: 10px;
		justify-content: end;
		padding-top: 20px;
		align-items: center;
	}
	.exel__btn{
		cursor: pointer;
		display: flex;
		font-size: 13px;
		align-items: center;
		justify-content: center;
		width: 140px;
		height: 22px;
		border-radius: 2px;
		padding: 10px;
		border: solid 1px #707070;
	}
	.exel__btn.blue{
		background-color: #140f82;
    	color: #fff;
	}
	.bold__font{
		font-family: NanumSquareRound;
		font-size: 14px;font-weight: bold;color: #000;
	}
</style>
	<div class="filter-wrap" style="margin-bottom:20px">
		<button class="excel_tab_btn tap__button" tab_num="01" style="background-color: #000;color: #fff;font-weight: 500;" onClick="excelTabBtnClick(this);">엑셀-상품 등록/수정</button>
		<button class="excel_tab_btn tap__button" tab_num="02" onClick="excelTabBtnClick(this);">엑셀-상품옵션 등록/수정</button>
	</div>
	

	<input id="tab_num" type="hidden" value="01">

	<div id="excel_tab_01" class=" excel_tab">
		<?php include_once("product-excel-insert_product.php"); ?>
	</div>
	
	<div id="excel_tab_02" class=" excel_tab" style="display:none;">
		<?php include_once("product-excel-update_product.php"); ?>
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
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.excel_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.excel_tab_btn').not($(obj)).css('color','#000000');
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
$('.exel__zone').on('click', function(e){
	var tab_num = $('#tab_num').val();
    $("input[name='upload_btn_"+tab_num+"']").click();
})
$('.exel__execute__btn').on('click', function(e){
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
					<TD style="width: 70%;">${element.name}</TD>
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
		<input type="hidden" value='${json_str}'>
			<TD style="width: 70%;">${element.name}</TD>
			<TD>업로드 시간: ${regist_date}</TD>
		</TR>
	`);
}
function printFailSheetList(element){
	var tab_num = $('#tab_num').val();
	$('#fail_list_table_'+tab_num).append(`
		<TR>
			<TD style="width: 70%;">${element.name}</TD>
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