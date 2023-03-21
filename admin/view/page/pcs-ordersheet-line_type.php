<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/md/line_type/get">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="TYPE_NAME">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>라인타입 목록</h3>
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
            <div class="content__wrap">
                <div class="content__title">라인타입 명</div>
                <div class="content__row">
                    <input type="text" name="type_name" value="">
                </div>
            </div>
            <div class="content__wrap">
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
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getLineTypeInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getLineTypeInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>라인타입 리스트</h3>
        <div class="drive--x"></div>
    </div>	
    <form id="frm-list-linetype">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 라인타입 수 <font class="cnt_total info__count" >0</font>개
            </div>
            <div class="content__row">
                <div class="btn" onclick="lineTypeTotalUpdate()" style="color:#ffffff;background-color:#ffa500">일괄 수정</div>
                <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                    <option value="TYPE_NAME|ASC" selected>라인타입명 순</option>    
                    <option value="TYPE_NAME|DESC">라인타입명 역순</option>
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
            <TABLE>
                <THEAD>
                    <TR>
                        <TH >No.</TH>
                        <TH >수정</TH>
                        <TH >삭제</TH>
                        <TH >라인 타입명</TH>
                        <TH >사용중인 상품 수</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_linetype_table">
                </TBODY>
            </TABLE>
        </div>
        <div class="padding__wrap">
            <input type="hidden" class="total_cnt" value="0" onChange="setLineTypePaging(this);">
            <input type="hidden" class="result_cnt" value="0" onChange="setLineTypePaging(this);">
            <div class="linetype_paging"></div>
        </div>
    </form>
    <h3>라인타입 추가하기</h3>
    <div class="drive--x"></div>
    <div class="table table__wrap">
        <form id="frm-linetype">
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="30%">
                </colgroup>
                <thead>
                    <tr>
                        <th>생성</th>
                        <th>라인타입 명</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div type="button" class="btn" onclick="lineTypeInsert(this)">생성</div>
                        </td>
                        <td>
                            <input type="text" name="type_name" value="">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

$(document).ready(function() {
	getLineTypeInfo();
    $((document)).on('keypress', function(e){
        if(e.keyCode == '13'){
            $('.modal .red.btn').click();
        }
    });
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

function getLineTypeInfo(){
	$("#result_linetype_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_linetype_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".linetype_paging"),
		html : function(d) {
            if(d != null){
                if (d.length > 0) {
                    $("#result_linetype_table").html('');
                }

                d.forEach(function(row) {
                    strDiv = `
                            <tr> 
                                <td>${row.num}<input type="hidden" name="line_type_idx_list[]" value="${row.line_type_idx}"></td>
                                <td><div type="button" class="btn" sel_idx="${row.line_type_idx}" onclick="lineTypeUpdate(this)">수정</div></td>
                                <td><div type="button" class="btn" onclick="lineTypeDelete(${row.line_type_idx})">삭제</div></td>
                                <td><input class="type_name" type="text" name="type_name_list[]" value="${row.type_name}"></td>
                                <td class="product_cnt" style="cursor:pointer" >${row.use_product_cnt}</td>
                            </tr>
                    `;
                    $("#result_linetype_table").append(strDiv);
                });
            }
		},
	},rows, page)
}
function setLineTypePaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getLineTypeInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getLineTypeInfo();
}

function lineTypeUpdate(obj){
    confirm('선택하신 라인타입 정보를 수정하시겠습니까?', function(){
        let parents_tr = $(obj).parents('tr');
        let type_name = parents_tr.find('.type_name').eq(0).val();
        let idx = $(obj).attr('sel_idx');
        
        if(type_name == ''){
            alert('라인타입명은 반드시 기재해야합니다.');
            return false;
        }
        let param_obj = {
            'type_name' : type_name,
            'sel_idx' : idx
        };
        $.ajax({
            type: "post",
            data: param_obj,
            dataType: "json",
            url: config.api + "pcs/ordersheet/md/line_type/put",
            error: function() {
                alert('라인타입 편집처리에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('라인타입 편집처리에 성공했습니다.');
                    getLineTabInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}
function lineTypeTotalUpdate(){
    confirm('현재 기입된 라인타입 정보를 일괄 수정하시겠습니까?', function(){
        let formData = new FormData();
        formData = $('#frm-list-linetype').serializeObject();
        if(formData['type_name_list[]'] != null && formData['type_name_list[]'].length > 0){
            if(exceptionCheck(formData['type_name_list[]']) == false){
                alert('라인 타입명을 입력해주세요');
                return false;
            }
            $.ajax({
                type: "post",
                data: formData,
                dataType: "json",
                url: config.api + "pcs/ordersheet/md/line_type/put",
                error: function() {
                    alert('라인타입 일괄편집 처리에 실패했습니다.');
                },
                success: function(d) {
                    if(d.code == 200) {
                        alert('라인타입 일괄편집 처리에 성공했습니다.');
                        getLineTypeInfo();
                    }
                    else{
                        alert(d.msg);
                    }
                }
            });
        }
        else{
            alert('수정할 수 있는 라인타입명이 존재하지 않습니다.');
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
function lineTypeDelete(idx){
    confirm('선택하신 라인타입 정보를 삭제하시겠습니까?', function(){
        
        $.ajax({
            type: "post",
            data: {'sel_idx' : idx},
            dataType: "json",
            url: config.api + "pcs/ordersheet/md/line_type/delete",
            error: function() {
                alert('라인타입 삭제처리에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('라인타입 삭제처리에 성공했습니다.');
                    getLineTypeInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}

function lineTypeInsert(obj){
    confirm('라인타입정보를 추가하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-linetype").serializeObject();

        if(formData.type_name.length == 0){
            alert('타입명은 반드시 기재해주십시오.');
            return false;
        }
        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "pcs/ordersheet/md/line_type/add",
            error: function() {
                alert('라인타입정보 등록에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('라인타입정보 등록에 성공했습니다.');
                    getLineTypeInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    });
}

</script>
