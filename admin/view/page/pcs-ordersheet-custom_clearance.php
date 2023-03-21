<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/custom_clearance/get">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="IDX">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>해외통관 목록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div claszs="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
					</div>
				</div>
			</div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">카테고리 코드</div>
                    <div class="content__row">
                        <input type="text" name="category_code" value="">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">카테고리 명</div>
                    <div class="content__row">
                        <input type="text" name="category_name" value="">
                    </div>
                </div>
            </div>
            <div class="content__wrap grid__half">
                <div class="half__box__wrap">
                    <div class="content__title">hs 코드</div>
                    <div class="content__row">
                        <input type="text" name="hs_code" value="">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">사용중인 상품 수</div>
                    <div class="content__row">
                        <label class="rd__square">
                            <input type="radio" name="use_product_flg" value="ALL" checked>
                            <div><div></div></div>
                            <span>전체</span>
                        </label>
                        <label class="rd__square">
                            <input type="radio" name="use_product_flg" value="FALSE">
                            <div><div></div></div>
                            <span>없음</span>
                        </label>
                        <label class="rd__square">
                            <input type="radio" name="use_product_flg" value="TRUE">
                            <div><div></div></div>
                            <span>1개 이상</span>
                        </label>
                    </div>
                </div>
            </div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getClearanceInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getClearanceInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>해외통관 리스트</h3>
        <div class="drive--x"></div>
    </div>	
    <form id="frm-list-clearance">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 해외통관 수 <font class="cnt_total info__count" >0</font>개
            </div>
            <div class="content__row">
                <div class="btn" onclick="clearanceTotalUpdate()" style="color:#ffffff;background-color:#ffa500">일괄 수정</div>
                <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                    <option value="CATEGORY_NAME|ASC" selected>카테고리명 순</option>    
                    <option value="CATEGORY_NAME|DESC">카테고리명명 역순</option>
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
            <div class="table__filter">
                <div class="filrer__wrap">
                    <div style="width: 140px;" class="filter__btn" onclick="clearanceUpload();">엑셀 업로드</div>
                    <div class="filter__btn" ><a style="color:black;" href="http://116.124.128.246:81/excel_form/해외통관_업로드양식.xlsx" download="">엑셀양식 다운로드</a></div>
                </div>
                <div class="hidden">
					<input type="file" id="clearance_upload">
				</div>                        
            </div>	
            <TABLE>
                <colgroup>
                    <col width="40px">
                    <col width="60px">
                    <col width="60px">
                    <col width="200px">
                    <col width="auto">
                    <col width="250px">
                    <col width="200px">
                    <col width="100px">
                </colgroup>
                <THEAD>
                    <TR>
                        <TH >No.</TH>
                        <TH >수정</TH>
                        <TH >삭제</TH>
                        <TH >카테고리 코드</TH>
                        <TH >해외통관 분류명</TH>
                        <TH >HS 코드</TH>
                        <TH >사용중인 상품 수</TH>
						<TH >상품 카테고리 지정</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_clearance_table">
                </TBODY>
            </TABLE>
        </div>
        <div class="padding__wrap">
            <input type="hidden" class="total_cnt" value="0" onChange="setClearancePaging(this);">
            <input type="hidden" class="result_cnt" value="0" onChange="setClearancePaging(this);">
            <div class="clearance_paging"></div>
        </div>
    </form>
    <h3>해외통관 추가하기</h3>
    <div class="drive--x"></div>
    <div class="table table__wrap">
        <form id="frm-clearance">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="auto">
                </colgroup>
                <thead>
                    <tr>
                        <th>생성</th>
                        <th>카테고리 코드</th>
                        <th>HS 코드</th>
                        <th>해외통관 분류명</th>
                    </tr>
                </thead>
                <tbody id="result_clearance_table">
                    <tr>
                    <td>
                        <div type="button" class="btn" onclick="clearanceInsert(this)">생성</div></td>
                        <td><input type="text" name="category_code" value=""></td>
                        <td><input type="text" name="hs_code" value=""></td>
                        <td><input type="text" name="category_name" value=""></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

var category = null;
$(document).ready(function() {
	getClearanceInfo();
    $('#clearance_upload').on('change', function(e){
		confirm('선택하신 시트로 해외통관를 추가하시겠습니까?', function(){
			var files = e.target.files;
		
			if(files != null){
				uploadSheet(files);
			};
			e.target.value = '';
		});
	})
    
});

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
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

function getClearanceInfo(){
	$("#result_clearance_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="7">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_clearance_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".clearance_paging"),
		html : function(d) {
            if(d != null){
                if (d.length > 0) {
                    $("#result_clearance_table").html('');
                }

                d.forEach(function(row) {
                    strDiv = `
                            <tr> 
                                <td>${row.num}<input type="hidden" name="clearance_idx_list[]" value="${row.clearance_idx}"></td>
                                <td>
									<div type="button" class="btn" sel_idx="${row.clearance_idx}" onclick="clearanceUpdate(this)">수정</div>
								</td>
                                <td>
									<div type="button" class="btn" onclick="clearanceDelete(${row.clearance_idx})">삭제</div>
								</td>
                                <td>
									<input class="category_code" type="text" name="category_code_list[]" value="${row.category_code}">
								</td>
                                <td>
									<input class="category_name" type="text" name="category_name_list[]" value="${row.category_name}">
								</td>
                                <td>
									<input class="hs_code" type="text" name="hs_code_list[]" value="${row.hs_code}">
								</td>
                                <td class="product_cnt">${row.use_product_cnt}</td>
								<td style="cursor:pointer" onclick="openCategoryModal(${row.clearance_idx})">
									${row.product_category_list!=null&&row.product_category_list!=''?row.product_category_list:'지정된 상품 카테고리가 없습니다.'}
								</td>
                            </tr>
                    `;
					
                    $("#result_clearance_table").append(strDiv);
                });
            }
		},
	},rows, page)
}
function setClearancePaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getClearanceInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getClearanceInfo();
}

function clearanceUpdate(obj){
    confirm('선택하신 해외통관 정보를 수정하시겠습니까?', function(){
        let parents_tr = $(obj).parents('tr');
        let category_code = parents_tr.find('.category_code').eq(0).val();
        let category_name = parents_tr.find('.category_name').eq(0).val();
        let hs_code = parents_tr.find('.hs_code').eq(0).val();
        let idx = $(obj).attr('sel_idx');

        let param_obj = {
            'category_code' : category_code,
            'category_name' : category_name,
            'hs_code' : hs_code,
            'sel_idx' : idx
        };
        $.ajax({
            type: "post",
            data: param_obj,
            dataType: "json",
            url: config.api + "pcs/ordersheet/custom_clearance/put",
            error: function() {
                alert('해외통관 편집처리에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('해외통관 편집처리에 성공했습니다.');
                    getClearanceInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}
function clearanceTotalUpdate(){
    confirm('현재 기입된 해외통관 정보를 일괄 수정하시겠습니까?', function(){
        let formData = new FormData();
        formData = $('#frm-list-clearance').serializeObject();
        if(formData['hs_code_list[]'] != null && formData['hs_code_list[]'].length > 0){
            if(exceptionCheck(formData['category_name_list[]']) == false){
                alert('해외통관 분류명을 입력해주세요');
                return false;
            }
            if(exceptionCheck(formData['hs_code_list[]']) == false){
                alert('HS 코드를 입력해주세요');
                return false;
            }
            $.ajax({
                type: "post",
                data: formData,
                dataType: "json",
                url: config.api + "pcs/ordersheet/custom_clearance/put",
                error: function() {
                    alert('해외통관 일괄편집 처리에 실패했습니다.');
                },
                success: function(d) {
                    if(d.code == 200) {
                        alert('해외통관 일괄편집 처리에 성공했습니다.');
                        getLineTabInfo();
                    }
                    else{
                        alert(d.msg);
                    }
                }
            });
        }
        else{
            alert('수정할 수 있는 해외통관이 존재하지 않습니다.');
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
function clearanceDelete(idx){
    confirm('선택하신 해외통관 정보를 삭제하시겠습니까?', function(){
        $.ajax({
            type: "post",
            data: {'sel_idx' : idx},
            dataType: "json",
            url: config.api + "pcs/ordersheet/custom_clearance/delete",
            error: function() {
                alert('해외통관 삭제처리에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('해외통관 삭제처리에 성공했습니다.');
                    getClearanceInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}

function clearanceInsert(obj){
    confirm('해외통관정보를 추가하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-clearance").serializeObject();

        if(formData.category_code == null || formData.category_code.length == 0){
            alert('카테고리 코드를 입력해주세요');
            return false;
        }
        if(formData.hs_code == null || formData.hs_code.length == 0){
            alert('HS 코드를 입력해주세요');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "pcs/ordersheet/custom_clearance/add",
            error: function() {
                alert('해외통관정보 등록에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('해외통관정보 등록에 성공했습니다.');
                    getClearanceInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    });
}
function clearanceUpload(){
	$("#clearance_upload").click();
}

function uploadSheet(obj){
    var files = obj;
    var reader = new FileReader();
	reader.readAsBinaryString(files[0]);
    reader.onload = function () {
        let exist_cnt = 0;
        let data = reader.result;
        let workBook = XLSX.read(data, { type: 'binary'});
        workBook.SheetNames.forEach(function (sheetName) {
            if(sheetName == '해외통관정보'){
                clearance_sheet = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName], {range : 1, header:1});
				json_str = JSON.stringify(clearance_sheet);
				putClearanceExcel(json_str, files.name);
                exist_cnt++;
            }
        });

        if(exist_cnt == 0){
            alert('해외통관정보 이름의 시트가 존재하지 않습니다. 파일을 다시 확인해주세요');
        }
    };
}

function putClearanceExcel(str, name){
	if(str != null && str.length > 0){
		$.ajax({
			type: "post",
			data: {
				'clearance_sheet':str
			},
			dataType: "json",
			url: config.api + "pcs/ordersheet/custom_clearance/excel/add",
			error: function() {
				alert('해외통관 등록처리에 실패했습니다.');
			},
			success: function(d) {
				if(d.code == 200){
					alert(d.data.success_cnt + "건의 해외통관이 추가되었습니다.");
				} else{
					alert(d.msg);
				}
				getClearanceInfo();
			}
		});
	}
}

function openCategoryModal(idx){
    modal('category',`sel_idx=${idx}`)
}
</script>
