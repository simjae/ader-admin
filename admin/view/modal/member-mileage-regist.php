<style>
.table__wrap label{display: inline-flex!important;}
</style>

<div class="content__card" style="width:950px">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>적립금 일괄적용</h3>
			<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-regist" action="member/mileage/excel/add">
			<input type="hidden" id='country' value=<?=$country?>>
			<div class="hidden">
				<input type="file" id="mileage_upload">
			</div> 
			<div class="content__card">
				<div class="card__header"><h4>양식 다운로드</h4></div>
				<div class="card__body">
					<div class="content__wrap">
						<div class="content__title">엑셀 양식 다운로드</div>
						<div class="content__row">
							<div class="btn" ><a style="color:black;" href="http://116.124.128.246:81/excel_form/적립금 일괄 적용 업로드 양식.xlsx" download="">양식 다운로드</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="content__card">
				<div class="card__header"><h4>엑셀 업로드</h4></div>
				<div class="card__body">
					<div class="content__wrap">
						<div class="content__title">엑셀 파일 등록</div>
						<div class="content__row">
							<button class="btn" onclick='mileageUpload()'>파일 선택</button>
							<p id="file_name">선택된 파일 없음</p>
						</div>
					</div>
					<div class="content__wrap">
						<div class="content__title">적립금 설정</div>
						<div class="content__row">
							<div class="table__wrap">
								<table style="width:300px">
									<colgroup>
										<col width="150px">
										<col width="150px">
									</colgroup>
									<thead>
										<th>증감여부</th>
										<th>적립금 금액</th>
									</thead>
									<tbody>
										<td>
											<select id="mileage_action" style="width:130px">
												<option value="ADD">(+)적립금 증액</option>
												<option value="SUBTRACT">(-)적립금 감액</option>
											</select>
										</td>
										<td>
											<input type="number" id="mileage_value" style="width:130px">
										</td>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:flex">
				<div onclick="putExcel();"  class="blue__color__btn"><span>적립금 일괄 적용</span></div>
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>

<script>
var upload_excel = null;
var json_str = null;
$(document).ready(function() {
	$('#mileage_upload').on('change', function(e){
		var files = e.target.files;
		setSheetList(nomalizeNFC(files));
		event.target.value = '';
	})
});
function nomalizeNFC(files){
	for(var i= 0; i < files.length; i++){
		files[i].name = files[i].name.normalize('NFC');
	}
	return files;
}
function setSheetList(obj){
	for(let i = 0; i < obj.length; i++){
		let file = obj[i];

		upload_excel = file;
		if(upload_excel != null){
			$('#file_name').text(upload_excel.name);
			excelActionBtn();
		}
	}
}
function excelActionBtn(){
	if(upload_excel != null){
		readExcel(upload_excel);
	}
	else{
		alert("업로드한 파일이 없습니다.");
	}
}
function readExcel(element){
    var reader = new FileReader();
	var total_row = {};
	
    reader.onload = function () {
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary'});
        workBook.SheetNames.forEach(function (sheetName) {
            if(sheetName == '적립금 적용회원정보'){
                var mileage_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 1, header:1});
                total_row.mileage_sheet = mileage_sheet;
            }
        })
		if(!total_row.hasOwnProperty('mileage_sheet')){
			alert('"적립금 적용회원정보"시트를 찾지 못했습니다. 파일을 다시확인해주세요');
			return false;
		}
		else{
			json_str = JSON.stringify(total_row);
		}
    };
	reader.readAsBinaryString(element);
}
function putExcel(){
	confirm('적립금을 일괄 적용하시겠습니까?',function(){
		let mileage_action = $('#mileage_action').val();
		let mileage_value = $('#mileage_value').val();
		let country = $('#country').val();

		let file_name = null;
		if(upload_excel != null){
			file_name = upload_excel.name
		}
		else{
			alert('필수 시트파일이 존재하지 않습니다. 파일을 등록해주세요');
			return false;
		}

		if(json_str == null){
			alert('"적립금 적용회원정보"시트를 찾지 못했습니다. 파일을 다시확인해주세요')
			return false;
		}

		if(mileage_action == ''){
			alert('적립금 증감을 선택해주세요');
			return false;
		}
		if(mileage_value  == ''){
			alert('적립금 변동액수를 입력해주세요');
			return false;
		}
		if(country  == ''){
			alert('잘못된 접근입니다.');
			return false;
		}
		

		$.ajax({
			type: "post",
			data: {
				'sheet_data':json_str,
				'mileage_action':mileage_action,
				'mileage_value':mileage_value,
				'country':country
			},
			dataType: "json",
			url: config.api + "member/mileage/excel/add",
			error: function() {
				msg = '적립금 등록작업에 실패했습니다.';
			},
			success: function(d) {
				insertLog('회원관리 > 적립금 > 엑셀 등록', " 적립금 일괄적용 : " + file_name , 1);
				if(d != null){
					if(d.code == 200) {
						var result_cnt = 0;
						if(d.data != null){
							result_cnt = d.data.success;
						}
						alert(`[${result_cnt}]건 등록이 완료되었습니다.`,function(){
							getMileageTabInfo();
							modal_close();
						});
					}
					else{
						alert('적립금 일괄 적용작업이 실패했습니다.');
						return false;
					}
				}
				else{
					alert('적립금 일괄 적용작업이 실패했습니다.');
					return false;
				}
			}
		})
	})
	
}
function mileageUpload(){
	$("#mileage_upload").click();
}
</script>