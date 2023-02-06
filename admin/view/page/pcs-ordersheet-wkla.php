<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
    .wkla_name{ width:150px!important }
    .wkla_memo{ width:200px!important }
</style>

<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/dsn/wkla/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="WKLA_NAME">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>W/K/L/A 목록</h3>
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
                        <input type="text" name="wkla_name" value="">
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
					<div  class="blue__color__btn" onClick="getWklaTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getWklaTabInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>WKLA 리스트</h3>
        <div class="drive--x"></div>
    </div>	
    <form id="frm-list-wkla">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 WKLA 수 <font class="cnt_total info__count" >0</font>개
            </div>
            <div class="content__row">
                <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                    <option value="WKLA_NAME|ASC" selected>WKLA명 순</option>    
                    <option value="WKLA_NAME|DESC">WKLA명 역순</option>
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
                        <TH style="width:120px">이름</TH>
                        <TH >비고</TH>
                        <TH >사용중인 상품 수</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_wkla_table">
                </TBODY>
            </TABLE>
        </div>
        <div class="padding__wrap">
            <input type="hidden" class="total_cnt" value="0" onChange="setWklaPaging(this);">
            <input type="hidden" class="result_cnt" value="0" onChange="setWklaPaging(this);">
            <div class="wkla_paging"></div>
        </div>
    </form>
    
    <h3>WKLA 추가하기</h3>
    <div class="drive--x"></div>
    <div class="table table__wrap">
        <form id="frm-wkla">
            <table>
                <colgroup>
                    <col width="5%">
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th>생성</th>
                        <th>WKLA 명</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><button type="button" class="white_btn" onclick="wklaInsert(this)">생성</button></td>
                        <td><input type="text" name="wkla_name" value=""></td>
                        <td><input type="text" name="wkla_memo" value=""></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

var category = null;
$(document).ready(function() {
	getWklaTabInfo();
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

function getWklaTabInfo(){
	$("#result_wkla_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="6">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_wkla_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".wkla_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_wkla_table").html('');
			}

			d.forEach(function(row) {
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
				            <td><button type="button" class="white_btn" action_type="WKLA_PUT" sel_idx="${row.wkla_idx}" onclick="wklaAction(this)">수정</button></td>
                            <td><button type="button" class="white_btn" action_type="WKLA_DELETE" sel_idx="${row.wkla_idx}" onclick="wklaAction(this)">삭제</button></td>
							<td><input class="wkla_name" type="text" value="${row.wkla_name}"></td>
                            <td><input class="wkla_memo" type="text" value="${row.wkla_memo}"></td>
                            <td class="product_cnt">${row.use_product_cnt}</td>
				        </tr>
				`;
				$("#result_wkla_table").append(strDiv);
			});
		},
	},rows, page)
}
function setWklaPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getWklaTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getWklaTabInfo();
}

function wklaAction(obj){
    var sel_tr = $(obj).parent().parent();
    var action_type = $(obj).attr('action_type');
    var sel_idx = $(obj).attr('sel_idx');
	var action_name = '';
    var api_str = '';
    
	switch(action_type){
		case 'WKLA_PUT':
			action_name = 'WKLA 수정';
            api_str = "put";
            var param_obj = {
                'sel_idx' : sel_idx,
                'wkla_name' : sel_tr.find('.wkla_name').eq(0).val(),
                'wkla_memo' : sel_tr.find('.wkla_memo').eq(0).val()
            }
			break;
        case 'WKLA_DELETE':
            var product_cnt = sel_tr.find('.product_cnt').text();
            var param_obj = {
                'sel_idx' : sel_idx
            }
            if(product_cnt > 0){
                alert('이미 해당 WKLA을 사용중인 제품이 있습니다.');
                return false;
            }
            else{
                action_name = "WKLA 삭제";
                api_str = "delete";
            }
            break;
	}

	$.ajax({
		type: "post",
		data: param_obj,
		dataType: "json",
		url: config.api + "pcs/ordersheet/dsn/wkla/"+api_str,
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				getWklaTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}

function wklaInsert(obj){
    var formData = new FormData();
	formData = $("#frm-wkla").serializeObject();

    $.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pcs/ordersheet/dsn/wkla/add",
		error: function() {
			alert('WKLA 등록에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert('WKLA 등록에 성공했습니다.');
				getWklaTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}
</script>
