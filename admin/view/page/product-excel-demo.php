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
		<button class="excel_tab_btn" tab_num="01" style="width:150px; height:30px; border:1px solid #000000;background-color:#3CB3AB;color:#ffffff;font-weight:800;margin-right:10px;cursor:pointer;" onClick="excelTabBtnClick(this);">엑셀-상품등록</button>
		<button class="excel_tab_btn" tab_num="02" style="width:150px; height:30px; border:1px solid #000000;background-color:#ffffff;color:#000000;font-weight:500;margin-right:10px;cursor:pointer;" onClick="excelTabBtnClick(this);">엑셀-상품수정</button>
	</div>
	
	<div class="portlet" style="margin-top:20px;">
		<div class="title">
			<h1 id="tabTitle">엑셀-상품등록/수정</h1>
			<input id="pwtest" type="text" value = "test">
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
var insert_wait_sheet = [];
var update_wait_sheet = [];
var insert_finish_sheet = [];
var update_finish_sheet = [];
var insert_fail_sheet = [];
var update_fail_sheet = [];
var insert_finish_cnt = 0;
var update_finish_cnt = 0;
$(document).ready(function() {
	insert_wait_sheet = [];
	update_wait_sheet = [];
	insert_finish_sheet = [];
	update_finish_sheet = [];
	insert_fail_sheet = [];
	update_fail_sheet = [];
	var insert_finish_cnt = 0;
	var update_finish_cnt = 0;
});
function excelTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	console.log(tab_num);
	$('#tab_num').val(tab_num);
	$('.excel_tab').hide();
	$('#excel_tab_' + tab_num).show();
	
	$(obj).css('background-color','#3CB3AB');
	$(obj).css('color','#ffffff');
	$(obj).css('font-weight','800');
	
	$('.excel_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.excel_tab_btn').not($(obj)).css('color','#000000');
	$('.excel_tab_btn').not($(obj)).css('font-weight','500');
}

$('.exel__zone').on('dragenter', function(e){
    e.preventDefault();
    e.stopPropagation();
}).on("dragover", function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).css("background-color","#FFD8D8");
}).on("dragleave",function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).css("background-color","#F1F6FF");
}).on("drop", function(e){
    e.preventDefault();
    $('.exel__zone').css("background-color","#F1F6FF");
    var files = e.originalEvent.dataTransfer.files;
	if(overlapCheck(files) == 0){
		uploadSheet(files)
	};
    e.originalEvent.dataTransfer.value = '';
})
$('.upload_btn').on('change', function(e){
    var files = e.target.files;
    if(files != null){
			uploadSheet(files);
		};
    e.target.value = '';
})
$('.filter-tap').on('click', '.exel__zone', function(e){
	var tab_num = $('#tab_num').val();
	console.log("click");
    $("input[name='upload_btn_"+tab_num+"']").click();
})
$('.file__content__wrap').on('click', '.exel__execute__btn', function(e){
	confirm("상품등록작업을 시작하시겠습니까?", `excelActionBtn()`);

})
function overlapCheck(obj){
	var tab_num = $('#tab_num').val();
	var overlap_cnt = 0;
	var check_array = [];
	switch(tab_num){
		case '01':
			check_array = insert_wait_sheet;
			break;
		case '02':
			check_array = update_wait_sheet;
			break;
	}	
	if(check_array.length > 0){
		check_array.forEach(function(element){
			if(element[0].name==obj[0].name) {
				overlap_cnt++;
			}
		});
	}
	
	return overlap_cnt;
}
function excelActionBtn(){
	var tab_num = $('#tab_num').val();
	var wait_sheet = [];
	var success_sheet = [];
	var target_cnt = 0;
	switch(tab_num){
		case '01':
			wait_sheet = insert_wait_sheet;
			success_sheet = update_finish_sheet;
			break;
		case '02':
			wait_sheet = update_wait_sheet;
			success_sheet = update_finish_sheet;
			break;
	}
	if(wait_sheet.length > 0){
		wait_sheet.forEach(function(element, index, array){
			readExcel(element, index, tab_num);
		});
		switch(tab_num){
			case '01':
				target_cnt = insert_finish_sheet.length - success_sheet.length;
				break;
			case '02':
				wait_sheet = update_finish_sheet.length - success_sheet.length;
				break;
		}
		//insertLog('상품관리 > 엑셀 등록', 'Order sheet 엑셀파일 등록 : ', target_cnt);
	}
	else{
		alert("업로드한 파일이 없습니다.");
	}
}
function readExcel(e, i, n){
    var files = e;
    var reader = new FileReader();
	var total_row = {};

    reader.onload = function () {
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary'});
        workBook.SheetNames.forEach(function (sheetName) {
            if(sheetName == '오더시트'){
                commen_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 10, header:1});
                total_row.commen_sheet = commen_sheet;
				
            }
			else if(sheetName == '판매용 추가정보'){
                optional_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 10, header:1});
                total_row.optional_sheet = optional_sheet;
            }
        })
		switch (n){
			case '01':
				if(total_row.hasOwnProperty('commen_sheet')){
					total_row.commen_sheet.forEach(function(element, index, array){
						total_row.commen_sheet[index][49] = Math.round( element[49] * 100 + Number.EPSILON ) / 100;
						total_row.commen_sheet[index][50] = Math.round( element[50] * 100 + Number.EPSILON ) / 100;
					})
					json_str = JSON.stringify(total_row);
					putProdExcel(json_str);
				}
				else{
					putProdExcel(null);
				}
				break;
			case '02':
				if(total_row.hasOwnProperty('optional_sheet')){
					json_str = JSON.stringify(total_row);
					putProdExcel(json_str);
				}
				else{
					putProdExcel(null);
				}
				break;
		}
    };
    reader.readAsBinaryString(files[0]);
}

function putProdExcel(json_str){
	var action_type = '';
	var tab_num = $('#tab_num').val();
	if(json_str == null){
		switch(tab_num){
			case '01':
				insert_fail_sheet.push(insert_wait_sheet[0]);
				insert_wait_sheet.shift();
				uploadSheet(null);
				finishSheet(insert_finish_sheet, insert_fail_sheet);
				break;
			case '02':
				update_fail_sheet.push(update_wait_sheet[0]);
				update_wait_sheet.shift();
				uploadSheet(null);
				finishSheet(update_finish_sheet,update_fail_sheet);
				break;
		}
	}
	else{
		switch(tab_num){
		case '01':
			action_type = "put";
			break;
		case '02':
			action_type = "update"
			break;
		}
		if(action_type != ''){
			$.ajax({
				type: "post",
				data: {
					'sheet_data':json_str
				},
				dataType: "json",
				url: config.api + "product/excel/"+action_type,
				error: function() {
					alert('error');
				},
				success: function(d) {
					if(d.code == 200) {
						switch(tab_num){
							case '01':
								insert_finish_cnt++;
								insert_finish_sheet.push(insert_wait_sheet[0]);
								insert_wait_sheet.shift();
								uploadSheet(null);
								finishSheet(insert_finish_sheet,insert_fail_sheet);
								break;
							case '02':
								update_finish_cnt++;
								update_finish_sheet.push(update_wait_sheet[0]);
								update_wait_sheet.shift();
								uploadSheet(null);
								finishSheet(update_finish_sheet,update_fail_sheet);
								break;
						}
					}
					else{
						alert(d.msg);
						switch(tab_num){
							case '01':
								insert_fail_sheet.push(insert_wait_sheet[0]);
								insert_wait_sheet.shift();
								uploadSheet(null);
								finishSheet(insert_finish_sheet,insert_fail_sheet);
								break;
							case '02':
								update_fail_sheet.push(update_wait_sheet[0]);
								update_wait_sheet.shift();
								uploadSheet(null);
								finishSheet(update_finish_sheet,update_fail_sheet);
								break;
						}
					}
				}
			});
		}
		else{
			alert('error');
		}
	}
}
function uploadSheet(obj){
	var tab_num = $('#tab_num').val();
	var wait_sheet = [];
	var upload_list = $(".content__tap__"+tab_num).find(".file__content__uploading").eq(0);
	var now = new Date();
	var date_string = 	 now.getFullYear()+'-'+now.getMonth()+'-'+now.getDate()
					+' '+now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
	switch(tab_num){
		case '01':
			if(obj != null){
				insert_wait_sheet.push(obj);
			}
			wait_sheet = insert_wait_sheet;
			break;
		case '02':
			if(obj != null){
				update_wait_sheet.push(obj);
			}
			wait_sheet = update_wait_sheet;
			break;
	}
	upload_list.html('');
	if(wait_sheet.length > 0){
		wait_sheet.forEach(function(element){
			upload_list.append(`
			<div>
				<i style="font-size: 30px;" class="xi-file-text-o"></i>
			</div>
			<div>
				<p align="left" style="width:100%;">${element[0].name}</p>
				<p align="left" style="width:100%;">${date_string}</p>
			</div>`);
		});
	}
	else{
		upload_list.append(`<p>업로드 된 파일이 없습니다.</p>`)
	}
}
function finishSheet(f, p){
	var tab_num = $('#tab_num').val();
	var finish_list = $(".content__tap__"+tab_num).find(".file__content__uploading").eq(1);

	var now = new Date();
	var date_string = 	 now.getFullYear()+'-'+now.getMonth()+'-'+now.getDate()
					+' '+now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
	finish_list.html('');
	
	if(f.length > 0){
		finish_list.append(`<h4>완료 파일 리스트</h4>`);
		f.forEach(function(element){
			finish_list.append(`
			<div>
				<p align="left" style="width:100%;">${element[0].name}</p>
				<p align="left" style="width:100%;">${date_string}</p>
			</div>`);
		});
	}
	if(p != null && p.length > 0){
		finish_list.append(`<h4>실패 파일 리스트</h4>`);
		p.forEach(function(element){
			finish_list.append(`
			<div>
				<p align="left" style="width:100%;">${element[0].name}</p>
				<p align="left" style="width:100%;">${date_string}</p>
			</div>`);
		});
	}
}
function resetExcelList(){
	var tab_num = $('#tab_num').val();
	switch(tab_num){
		case '01':
			insert_wait_sheet = [];
			uploadSheet(null)
			break;
		case '02':
			update_wait_sheet = [];
			uploadSheet(null)
			break;
	}
}
</script>