<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
</style>

<div class="content__card">
    <h3>배송부자재 추가하기</h3>
    <div class="drive--x"></div>
    <div class="table table__wrap">
        <form id="frm-delivery_sub">
            <input type="hidden" name="sub_material_type" value="D">  
            <table>
                <colgroup>
                    <col width="5%">
                    <col width="30%">
                    <col width="15%">
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th>생성</th>
                        <th>배송부자재 명</th>
                        <th>배송부자재 코드</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><button type="button" class="white_btn" onclick="deliverySubInsert(this)">생성</button></td>
                        <td><input type="text" name="sub_material_name" value=""></td>
                        <td><input type="text" name="sub_material_code" value=""></td>
                        <td><input type="text" name="sub_material_memo" value=""></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/td/sub_material/list/get">
        <input type="hidden" name="sub_material_type" value="D">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="SUB_MATERIAL_NAME">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>배송부자재 목록</h3>
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
                    <div class="content__title">이름</div>
                    <div class="content__row">
                        <input type="text" name="sub_material_name" value="">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">부자재코드</div>
                    <div class="content__row">
                        <input type="text" name="sub_material_code" value="">
                    </div>
                </div>
            </div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getDeliverySubTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getDeliverySubTabInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>배송부자재 리스트</h3>
        <div class="drive--x"></div>
    </div>	
    <form id="frm-list-delivery_sub" action="pcs/ordersheet/td/sub_material/list/get">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 배송부자재 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
            </div>
            <div class="content__row">
                <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                    <option value="SUB_MATERIAL_NAME|ASC" selected>부자재명 순</option>    
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
            <TABLE>
                <colgroup>
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="20%">
                    <col width="10%">
                    <col>
                </colgroup>
                <THEAD>
                    <TR>
                        <TH >No.</TH>
                        <TH>수정</TH>
                        <TH>삭제</TH>
                        <TH>이름</TH>
                        <TH>코드</TH>
                        <TH>비고</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_delivery_sub_table">
                </TBODY>
            </TABLE>
        </div>
        <div class="padding__wrap">
            <input type="hidden" class="total_cnt" value="0" onChange="setDeliverySubPaging(this);">
            <input type="hidden" class="result_cnt" value="0" onChange="setDeliverySubPaging(this);">
            <div class="delivery_sub_paging"></div>
        </div>
    </form>
</div>

<script>

var category = null;
$(document).ready(function() {
	getDeliverySubTabInfo();
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

function getDeliverySubTabInfo(){
	$("#result_delivery_sub_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="6">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_delivery_sub_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".delivery_sub_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_delivery_sub_table").html('');
			}

			d.forEach(function(row) {
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
				            <td><button type="button" class="white_btn" action_type="DELIVERY_SUB_PUT" sel_idx="${row.sub_material_idx}" onclick="deliverySubAction(this)">수정</button></td>
                            <td><button type="button" class="white_btn" action_type="DELIVERY_SUB_DELETE" sel_idx="${row.sub_material_idx}" onclick="deliverySubAction(this)">삭제</button></td>
							<td><input type="text" class="sub_material_name" value="${row.sub_material_name}"></td>
                            <td><input type="text" class="sub_material_code" value="${row.sub_material_code}"></td>
                            <td><input type="text" class="sub_material_memo" value="${row.sub_material_memo}"></td>
				        </tr>
				`;
				$("#result_delivery_sub_table").append(strDiv);
			});
		},
	},rows, page)
}
function setDeliverySubPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getDeliverySubTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	console.log(order_value[0]);
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getDeliverySubTabInfo();
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}
function deliverySubAction(obj){
    var sel_tr = $(obj).parent().parent();
    var action_type = $(obj).attr('action_type');
    var sel_idx = $(obj).attr('sel_idx');
	var action_name = '';
    var api_str = '';
    
	switch(action_type){
		case 'DELIVERY_SUB_PUT':
			action_name = '배송부자재 수정';
            api_str = "put";
            var param_obj = {
                'sel_idx' : sel_idx,
                'sub_material_name' : sel_tr.find('.sub_material_name').eq(0).val(),
                'sub_material_code' : sel_tr.find('.sub_material_code').eq(0).val(),
                'sub_material_memo' : sel_tr.find('.sub_material_memo').eq(0).val()
            }
			break;
        case 'DELIVERY_SUB_DELETE':
            var product_cnt = sel_tr.find('.product_cnt').text();
            var param_obj = {
                'sel_idx' : sel_idx
            }
            if(product_cnt > 0){
                alert('이미 해당 배송부자재를 사용중인 제품이 있습니다.');
                return false;
            }
            else{
                action_name = "배송부자재 삭제";
                api_str = "delete";
            }
            break;
	}

	$.ajax({
		type: "post",
		data: param_obj,
		dataType: "json",
		url: config.api + "pcs/ordersheet/td/sub_material/"+api_str,
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				getDeliverySubTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}

function deliverySubInsert(obj){
    var formData = new FormData();
	formData = $("#frm-delivery_sub").serializeObject();

    $.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/ordersheet/td/sub_material/add",
		error: function() {
			alert('배송부자재 등록에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert('배송부자재 등록에 성공했습니다.');
				getDeliverySubTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}
</script>
