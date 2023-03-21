<style>
.white_btn{font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;}
.gray_btn{font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;}
.sub__material__photo img{width:130px;height:130px;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<div class="card__header">
		<h3>포장부자재 추가하기</h3>
		<div class="drive--x"></div>
	</div>	
	<div class="table table__wrap">
		<form id="frm-add" enctype="multipart/form-data" method="post" action="pcs/ordersheet/td/sub_material/add">
			<input type="hidden" name="sub_material_type" value="T">  
			<div class="overflow-x-auto">
				<table>
					<thead>
						<tr>
							<th>생성</th>
							<th>배송부자재 타입</th>
							<th>배송부자재 이름</th>
							<th>배송부자재 코드</th>
							<th>업체 명</th>
							<th>업체 담당자</th>
							<th>업체 연락처</th>
							<th>업체 주소</th>
							<th>비고</th>
							<th>상품이미지</th>
							<th>작업지시서 업로드</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div type="button" class="btn" onclick="addSubMaterialPackage()">생성</div>
							</td>
							<td>
								<input class="sub_material_sort" type="text" name="sub_material_sort" style="width:80px" value="">
							</td>
							<td>
								<input class="sub_material_name" type="text" name="sub_material_name" style="width:250px" value="">
							</td>
							<td>
								<input class="sub_material_code" type="text" name="sub_material_code" style="width:110px" value="">
							</td>
							<td>
								<input class="company_name" type="text" name="company_name" style="width:120px" value="">
							</td>
							<td>
								<input class="company_charge" type="text" name="company_charge" style="width:100px" value="">
							</td>
							<td>
								<input class="company_tel" type="text" name="company_tel" style="width:120px" value="">
							</td>
							<td>
								<input class="company_addr" type="text" name="company_addr" style="width:250px" value="">
							</td>
							<td>
								<input class="sub_material_memo" type="text" name="sub_material_memo" style="width:150px" value="">
							</td>
							<td>
								<div class="hidden">
									<input type="file" class="sub_material_image regist" name="sub_material_image" onchange="previewImg(this)">
								</div>
								<div class="sub__material__photo" onclick="selectSmImage()">
									<img src="/images/default/add_photo_btn.svg">
								</div>
							</td>
							<td>
								<div class="hidden">
									<input type="file" class="work_order_image regist" name="work_order_image" onchange="previewImg(this)">
								</div>
								<div class="sub__material__photo" onclick="selectWolFile()">
									<img src="/images/default/add_photo_btn.svg">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>
		
	</div>
</div>
<div class="hidden update__form">
	<form id="frm-SMT-image-put" enctype="multipart/form-data" method="post" action="pcs/ordersheet/td/sub_material/put">
		<input type="hidden" name="sub_material_idx">
		<input type="hidden" name="image_type" value="SMT">
		<input type="file" name="sub_material_image" onchange="updateImage(this, 'frm-SMT-image-put')">
	</form>
	<form id="frm-WOD-image-put" enctype="multipart/form-data" method="post" action="pcs/ordersheet/td/sub_material/put">
		<input type="hidden" name="sub_material_idx">	
		<input type="hidden" name="image_type" value="WOD">
		<input type="file" name="work_order_image" onchange="updateImage(this, 'frm-WOD-image-put')">
	</form>
</div>
<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/td/sub_material/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="IDX">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<input type="hidden" name="sub_material_type" value="T">

		<div class="card__header">
			<h3>포장부자재 목록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">포장부자재 타입</div>
					<div class="content__row">
						<select class="fSelect" name="sub_material_sort">
							<option value="ALL" selected>전체</option>
							<?php
								$select_sub_material_sort_sql = "
									SELECT
										DISTINCT SUB_MATERIAL_SORT		AS SUB_MATERIAL_SORT
									FROM
										dev.SUB_MATERIAL_INFO
									WHERE
										SUB_MATERIAL_TYPE = 'T'
								";
								
								$db->query($select_sub_material_sort_sql);
								
								foreach($db->fetch() as $sort_data) {
							?>
							<option value="<?=$sort_data['SUB_MATERIAL_SORT']?>"><?=$sort_data['SUB_MATERIAL_SORT']?></option>	
							<?php
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">포장부자재 이름</div>
					<div class="content__row">
						<input type="text" name="sub_material_name" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">포장부자재 코드</div>
					<div class="content__row">
						<input type="text" name="sub_material_code" value="">
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getSubMaterialPackageList()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getSubMaterialPackageList');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card" style="height: 90vh;">
	<div class="card__header">
		<h3>포장부자재 리스트</h3>
		<div class="drive--x"></div>
	</div>	
	<form id="frm-list-package">
		<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				총 포장부자재 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
			</div>
			<div class="content__row">
				<div class="btn" onclick="packageSMTotalUpdate()" style="color:#ffffff;background-color:#ffa500">일괄 수정</div>
				<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
					<option value="IDX|DESC" selected>부자재 등록 역순</option>
					<option value="IDX|ASC">부자재 등록 순</option>
					<option value="SUB_MATERIAL_NAME|ASC">부자재명 순</option>	
					<option value="SUB_MATERIAL_NAME|DESC">부자재명 역순</option>
				</select>
				<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
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
		
		<div class="table table__wrap">
			<div style="height: calc(90vh - 170px);overflow:auto;">
				<TABLE>
					<thead>
						<tr>
							<TH >No.</TH>
							<th>기능</th>
							<th>부자재</th>
							<th>작업지시서</th>
							<th>상품이미지</th>
							<th>포장부자재 타입</th>
							<th>포장부자재 이름</th>
							<th>포장부자재 코드</th>
							<th>업체 명</th>
							<th>업체 담당자</th>
							<th>업체 연락처</th>
							<th>업체 주소</th>
							<th>비고</th>
							<th>사용중인 상품수</th>
						</tr>
					</thead>
					<TBODY id="result_table">
					</TBODY>
				</TABLE>
			</div>
		</div>
		<div class="padding__wrap" style="margin-top:15px;">
			<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
			<div class="paging"></div>
		</div>
	</form>
</div>

<script>

var category = null;
$(document).ready(function() {
	getSubMaterialPackageList();
	$('.update__form input[type=file]').on('change',function(e){
		e.target.value = '';
	})
});
function selectSmImage(){
	$('#frm-add input[name=sub_material_image]').click();
}
function selectWolFile(){
	$('#frm-add input[name=work_order_image]').click();
}
function previewImg(obj){
	let file_name = $(obj).val();

	if(file_name != null){
		file_name_arr = file_name.split('.');
		if(file_name_arr.length > 1){
			let fileExt = file_name_arr[file_name_arr.length - 1];
			if(fileExt != 'jpg' && fileExt != 'png' && fileExt != 'jpeg' && fileExt != 'jpe'){
				alert('확장자가 올바르지 않습니다.');
			}
			else{
				if((obj.files && obj.files[0])){
					let reader = new FileReader();
					reader.onload = function(e){
						$(obj).parent().parent().find('img').eq(0).attr('src', e.target.result);
						e.target.result = '';
					};
					reader.readAsDataURL(obj.files[0]);
				}
			}
		}
		else{
			alert('파일의 확장자가 없습니다. 파일을 다시 선택해주세요.');
			return false;
		}
	}
}

function getSubMaterialPackageList(){
	let frm = $('#frm-filter');
	
	let result_table = $('#result_table');
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="8" style="text-align:left;">';
	strDiv += '	조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	get_contents(frm,{
		pageObj : $(".paging"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					result_table.html('');
				}
				let strDiv = "";
				d.forEach(function(row) {
					let sm_img_location_str = '/images/default_product_img.jpg';
					
					let wo_img_btn = `<div class="btn" style="text-align:center">미등록</div>`;
					if(row.image_info.length != []){
						if(row.image_info[0].sm_img_location != null){
							sm_img_location_str = row.image_info[0].sm_img_location;
						}
						if(row.image_info[0].wo_img_location != null){
							wo_img_btn = `<div class="btn" style="text-align:center" onclick="openWorkOrder(${row.sub_material_idx})">팝업으로 보기</div>`;
						}
					}
					strDiv += `
							<tr>
								<td>${row.num}<input type="hidden" name="sub_material_idx_list[]" value="${row.sub_material_idx}"></td>
								<td>
									<div style="display:flex;flex-direction:column;">
										<div type="button" class="btn" sub_material_idx="${row.sub_material_idx}" onclick="putSubMaterialDelivery(this)">수정</div>
										<div type="button" class="btn" onclick="deleteSubMaterialDelivery(${row.sub_material_idx})">삭제</div>
									</div>
								</td>
								<td>
									<div class="btn" onclick="clickUpdateSubMaterialImage(${row.sub_material_idx})">이미지 수정</div>
								</td>
								<td>
									<div style="display:flex;flex-direction:column;">
										${wo_img_btn}
										<div class="btn" style="text-align:center" onclick="clickUpdateWorkOrderImage(${row.sub_material_idx})">이미지 수정</div>
									</div>
								</td>
								<td>
									<div class="sub__material__photo" onclick="">
										<img src="${sm_img_location_str}">
									</div>
								</td>
								<td>
									<input type="text" class="sub_material_sort" name="sub_material_sort_list[]" style="width:110px" value="${row.sub_material_sort}">
								</td>
								<td>
									<input type="text" class="sub_material_name" name="sub_material_name_list[]" style="width:275px" value="${row.sub_material_name}">
								</td>
								<td>
									<input type="text" class="sub_material_code" name="sub_material_code_list[]" style="width:130px" value="${row.sub_material_code}">
								</td>
								<td>
									<input type="text" class="company_name" name="company_name_list[]" style="width:150px" value="${row.company_name}">
								</td>
								<td>
									<input type="text" class="company_charge" name="company_charge_list[]" style="width:110px" value="${row.company_charge}">
								</td>
								<td>
									<input type="text" class="company_tel" name="company_tel_list[]" style="width:140px" value="${row.company_tel}">
								</td>
								<td>
									<input type="text" class="company_addr" name="company_addr_list[]" style="width:275px" value="${row.company_addr}">
								</td>
								<td>
									<input type="text" class="sub_material_memo" name="sub_material_memo_list[]" style="width:275px" value="${row.sub_material_memo}">
								</td>
								
								<td class="sub__cnt__flg" style="cursor:pointer" onclick="openDeliverySubMaterialUseProductModal(${row.sub_material_idx})">
									${row.ordersheet_sub_cnt}
								</td>
								
							</tr>
					`;
				});
				result_table.append(strDiv);
			}
		},
	},rows, page)
}

function addSubMaterialPackage(){
	confirm('부자재를 등록하시겠습니까?',function(){
		let frm = $('#frm-add');
	
		let sub_material_sort = frm.find('.sub_material_sort').val();
		if (sub_material_sort == "" || sub_material_sort == null) {
			alert('포장부자재 타입을 입력해주세요,');
			return false;
		}
		let sub_material_name = frm.find('.sub_material_name').val();
		if (sub_material_name == "" || sub_material_name == null) {
			alert('포장부자재 이름을 입력해주세요,');
			return false;
		}
		let sub_material_code = frm.find('.sub_material_code').val();
		if (sub_material_code == "" || sub_material_code == null) {
			alert('포장부자재 코드를 입력해주세요,');
			return false;
		}

		let form = $("#frm-add")[0];
		let formData = new FormData(form);

		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "pcs/ordersheet/td/sub_material/add",
			cache: false,
			contentType: false,
			processData: false,
			error: function() {
				alert('포장부자재 등록처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				if (d.code == 200) {
					getSubMaterialPackageList();
					alert('선택한 포장부자재 정보가 등록되었습니다.');
				} else {
					alert(d.msg);
				}
			}
		});
	});
}

function putSubMaterialPackage(obj) {
	var selected_tr = $(obj).parent().parent().parent();
	var sub_material_idx = $(obj).attr('sub_material_idx');
	
	let sub_material_sort = selected_tr.find('.sub_material_sort').val();
	if (sub_material_sort == "" || sub_material_sort == null) {
		alert('포장부자재 타입을 입력해주세요,');
		return false;
	}
	
	let sub_material_name = selected_tr.find('.sub_material_name').val();
	if (sub_material_name == "" || sub_material_name == null) {
		alert('포장부자재 이름을 입력해주세요,');
		return false;
	}
	
	let sub_material_code = selected_tr.find('.sub_material_code').val();
	if (sub_material_code == "" || sub_material_code == null) {
		alert('포장부자재 코드를 입력해주세요,');
		return false;
	}
	
	let sub_material_memo = selected_tr.find('.sub_material_memo').val();
	let company_name = selected_tr.find('.company_name').val();
	let company_charge = selected_tr.find('.company_charge').val();
	let company_tel = selected_tr.find('.company_tel').val();
	let company_addr = selected_tr.find('.company_addr').val();
	confirm(
		'선택한 포장부자재 정보를 수정하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: {
					'sub_material_idx'  : sub_material_idx,
					'sub_material_sort' : sub_material_sort,
					'sub_material_name' : sub_material_name,
					'sub_material_code' : sub_material_code,
					'company_name'		: company_name,
					'company_charge'	: company_charge,
					'company_tel'		: company_tel,
					'company_addr'		: company_addr,
					'sub_material_memo' : sub_material_memo
				},
				dataType: "json",
				url: config.api + "pcs/ordersheet/td/sub_material/put",
				error: function() {
					alert('포장부자재 정보 수정처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						getSubMaterialPackageList();
						alert('선택한 포장부자재 정보가 수정되었습니다.');
					} else {
						alert(d.msg);
					}
				}
			});
		}
	);
}
function packageSMTotalUpdate(){
	confirm('현재 기입된 포장부자재 정보를 일괄 수정하시겠습니까?', function(){
        let formData = new FormData();
        formData = $('#frm-list-package').serializeObject();
		
        if(formData['sub_material_code_list[]'] != null && formData['sub_material_code_list[]'].length > 0){
			if(exceptionCheck(formData['sub_material_name_list[]']) == false){
                alert('배송 부자재명을 입력해주세요');
                return false;
            }
			if(exceptionCheck(formData['sub_material_code_list[]']) == false){
                alert('배송 부자재 코드를 입력해주세요');
                return false;
            }
            $.ajax({
                type: "post",
                data: formData,
                dataType: "json",
                url: config.api + "pcs/ordersheet/td/sub_material/put",
                error: function() {
                    alert('포장부자재 일괄편집 처리에 실패했습니다.');
                },
                success: function(d) {
                    if(d.code == 200) {
                        alert('포장부자재 일괄편집 처리에 성공했습니다.');
                        getSubMaterialPackageList();
                    }
                    else{
                        alert(d.msg);
                    }
                }
            });
        }
        else{
            alert('수정할 수 있는 포장부자재가 존재하지 않습니다.');
            return false;
        } 
		
    });
}
function exceptionCheck(data){
    existFlg = true;
	
	if(Array.isArray(data)){
		data.forEach(function(row){
			let trim_row = row.trim();
			if(trim_row == null || trim_row.length == 0){
				existFlg = false;
			}
		})
	}
	else{
		let trim_row = data.trim();
		if(trim_row == null || trim_row.length == 0){
			existFlg = false;
		}
	}
    return existFlg;
}
function clickUpdateSubMaterialImage(idx){
	$('#frm-SMT-image-put').find('input[name=sub_material_idx]').val(idx);
	$('#frm-SMT-image-put').find('input[name=sub_material_image]').click();
}
function clickUpdateWorkOrderImage(idx){
	$('#frm-WOD-image-put').find('input[name=sub_material_idx]').val(idx);
	$('#frm-WOD-image-put').find('input[name=work_order_image]').click();
}
function updateImage(obj, form_id){
	if(checkImageType(obj)){
		let form = $("#"+form_id)[0];
		let formData = new FormData(form);

		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "pcs/ordersheet/td/sub_material/put",
			cache: false,
			contentType: false,
			processData: false,
			error: function() {
				alert('포장부자재 이미지수정 처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				if (d.code == 200) {
					getSubMaterialPackageList();
					alert('선택한 포장부자재 이미지가 수정되었습니다.');
				} else {
					alert(d.msg);
				}
			}
		});
	};
}

function checkImageType(obj){
	let file_name = $(obj).val();

	if(file_name != null){
		file_name_arr = file_name.split('.');
		if(file_name_arr.length > 1){
			let fileExt = file_name_arr[file_name_arr.length - 1];
			if(fileExt != 'jpg' && fileExt != 'png' && fileExt != 'jpeg' && fileExt != 'jpe'){
				alert('확장자가 올바르지 않습니다.');
				return false;
			}
			else{
				if((obj.files && obj.files[0])){
					let reader = new FileReader();
					reader.onload = function(e){
						
					};
					reader.readAsDataURL(obj.files[0]);
					return true;
				}
				else{
					alert('파일정보가 손실됬습니다. 다시 등록해주세요');
					return false;
				}
			}
		}
		else{
			alert('파일의 확장자가 없습니다. 파일을 다시 선택해주세요.');
			return false;
		}
	}
	else{
		alert('파일명이 존재하지 않습니다.. 파일을 다시 선택해주세요.');
		return false;
	}
}
function deleteSubMaterialPackage(sub_material_idx) {
	confirm(
		'선택한 포장부자재 정보를 삭제하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "pcs/ordersheet/td/sub_material/delete",
				data: {
					'sub_material_idx' : sub_material_idx
				},
				dataType: "json",
				error: function() {
					alert('포장부자재 정보 삭제처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						alert('선택한 포장부자재 정보가 삭제되었습니다.');
						getSubMaterialPackageList();
					} else{
						alert(d.msg);
					}
				}
			});
		}
	);
}
function openWorkOrder(idx){
	javascript:void(window.open(`http://116.124.128.246:81/pcs/sub_material/work_order/detail?sub_material_idx=${idx}`, '작업지시서','width=#, height=#'));
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getSubMaterialPackageList();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getSubMaterialPackageList();
}

function init_fileter(frm_id, func_name){
	var formObj = $('#' + frm_id);
	formObj.find('input:radio[value="all"]').prop('checked', true);
	formObj.find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	window[func_name]();
}
function openPackageSubMaterialUseProductModal(idx) {
    modal('/use_product', `sub_material_idx=${idx}`);
}
</script>
