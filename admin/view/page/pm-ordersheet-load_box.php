<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
</style>

<div class="content__card">
	<form id="frm-filter" action="pm/ordersheet/td/box/list/get">
        <input type="hidden" name="box_type" value="LOAD">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="BOX_NAME">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>적재박스 목록</h3>
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
                <div class="content__title">이름</div>
                <div class="content__row">
                    <input type="text" name="box_name" value="">
                </div>
            </div>
		</div>
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title">너비 (cm)</div>
                <div class="content__row">
                    <input type="number" name="min_width" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm
                    ~
                    <input type="number" name="max_width" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title">길이 (cm)</div>
                <div class="content__row">
                    <input type="number" name="min_length" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm
                    ~
                    <input type="number" name="max_length" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm
                </div>
            </div>
        </div>
        <div class="content__wrap grid__half">
            <div class="half__box__wrap">
                <div class="content__title">높이 (cm)</div>
                <div class="content__row">
                    <input type="number" name="min_height" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm
                    ~
                    <input type="number" name="max_height" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm
                </div>
            </div>
            <div class="half__box__wrap">
                <div class="content__title">부피 (cm³)</div>
                <div class="content__row">
                    <input type="number" name="min_volume" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm³
                    ~
                    <input type="number" name="max_volume" value="" style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">cm³
                </div>
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
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getBoxTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getBoxTabInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>적재박스 리스트</h3>
        <div class="drive--x"></div>
    </div>	
    <form id="frm-list">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 적재박스 수 <font class="cnt_total info__count" >0</font>개
            </div>
            <div class="content__row">
                <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                    <option value="BOX_NAME|ASC" selected>박스명 순</option>    
                    <option value="BOX_NAME|DESC">박스명 역순</option>
                    <option value="BOX_WIDTH|ASC">너비 순</option>    
                    <option value="BOX_WIDTH|DESC">너비 역순</option>
                    <option value="BOX_LENGTH|ASC">길이 순</option>    
                    <option value="BOX_LENGTH|DESC">길이 역순</option>
                    <option value="BOX_HEIGHT|ASC">높이 순</option>    
                    <option value="BOX_HEIGHT|DESC">높이 역순</option>
                    <option value="BOX_VOLUME|ASC">부피 순</option>    
                    <option value="BOX_VOLUME|DESC">부피 역순</option>
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
                        <TH >너비(cm)</TH>
                        <TH >길이(cm)</TH>
                        <TH >높이(cm)</TH>
                        <TH >부피(cm³)</TH>
                        <TH >사용중인 상품 수</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_table">
                </TBODY>
            </TABLE>
        </div>
        <div class="padding__wrap">
            <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
            <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            <div class="paging"></div>
        </div>
    </form>
    <h3>적재박스 추가하기</h3>
    <div class="drive--x"></div>
    <div class="table table__wrap">
        <form id="frm-box">
            <table>
                <colgroup>
                    <col width="5%">
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th>생성</th>
                        <th>적재박스 명</th>
                        <th>너비(cm)</th>
                        <th>길이(cm)</th>
                        <th>높이(cm)</th>
                        <th>부피(cm³)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="hidden" name="box_type" value="LOAD"><button type="button" class="white_btn" onclick="boxInsert(this)">생성</button></td>
                        <td><input type="text" class="size_input" name="box_name" value=""></td>
                        <td><input class="box_info" type="number" step="0.01" name="box_width" value=""></td>
                        <td><input class="box_info" type="number" step="0.01" name="box_length" value=""></td>
                        <td><input class="box_info" type="number" step="0.01" name="box_height" value=""></td>
                        <td><input class="box_volume" type="number" step="0.01" readonly name="box_volume" value=""></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

var category = null;
$(document).ready(function() {
	getBoxTabInfo();
});

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('input:radio[value="all"]').prop('checked', true);
	formObj.find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');
    formObj.find('input[type=number]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	window[func_name]();
}

function getBoxTabInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="13">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}

			d.forEach(function(row) {
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
				            <td><button type="button" class="white_btn" box_type="LOAD" action_type="BOX_PUT" sel_idx="${row.box_idx}" onclick="boxAction(this)">수정</button></td>
                            <td><button type="button" class="white_btn" box_type="LOAD" action_type="BOX_DELETE" sel_idx="${row.box_idx}" onclick="boxAction(this)">삭제</button></td>
							<td><input class="box_name" type="text" value="${row.box_name}"></td>
				            <td><input class="box_info" type="number" step="0.01" value="${row.box_width}"></TD>
                            <td><input class="box_info" type="number" step="0.01" value="${row.box_length}"></TD>
							<td><input class="box_info" type="number" step="0.01" value="${row.box_height}"></td>
                            <td><input class="box_volume" type="number" step="0.01" readonly value="${row.box_width * row.box_length * row.box_height}"></td>
                            <td class="product_cnt">${row.use_product_cnt}</td>
				        </tr>
				`;
				$("#result_table").append(strDiv);

                $('.box_info').keyup(function(){
                    var sel_tr = $(this).parent().parent();
                    var width = sel_tr.find('.box_info').eq(0).val();
                    var length = sel_tr.find('.box_info').eq(1).val();
                    var height = sel_tr.find('.box_info').eq(2).val();

                    if(width == 0 || length == 0 || height == 0){
                        sel_tr.find('.box_volume').val(0);
                    }
                    else{
                        sel_tr.find('.box_volume').val(width * length * height);
                    }
                    
                });
			});
		},
	},rows, page)
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

	getBoxTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getBoxTabInfo();
}

function boxAction(obj){
    var sel_tr = $(obj).parent().parent();
    var box_type = $(obj).attr('box_type');
    var action_type = $(obj).attr('action_type');
    var sel_idx = $(obj).attr('sel_idx');
	var action_name = '';
    var api_str = '';
    
	switch(action_type){
		case 'BOX_PUT':
			action_name = '적재박스 수정';
            api_str = "put";
            var param_obj = {
                'box_type' : box_type,
                'sel_idx' : sel_idx,
                'box_name' : sel_tr.find('.box_name').eq(0).val(),
                'box_width' : sel_tr.find('.box_info').eq(0).val(),
                'box_length' : sel_tr.find('.box_info').eq(1).val(),
                'box_height' : sel_tr.find('.box_info').eq(2).val(),
                'box_volume' : sel_tr.find('.box_volume').eq(0).val()
            }
			break;
        case 'BOX_DELETE':
            var product_cnt = sel_tr.find('.product_cnt').text();
            var param_obj = {
                'box_type' : box_type,
                'sel_idx' : sel_idx
            }
            if(product_cnt > 0){
                alert('이미 해당 적재박스를 사용중인 제품이 있습니다.');
                return false;
            }
            else{
                action_name = "적재박스 삭제";
                api_str = "delete";
            }
            break;
	}

	$.ajax({
		type: "post",
		data: param_obj,
		dataType: "json",
		url: config.api + "pm/ordersheet/td/box/"+api_str,
		error: function() {
			alert(action_name + ' 처리에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert(action_name + ' 처리에 성공했습니다.');
				getBoxTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}

function boxInsert(obj){
    var formData = new FormData();
	formData = $("#frm-box").serializeObject();

    $.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "pm/ordersheet/td/box/add",
		error: function() {
			alert('적재박스 등록에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert('적재박스 등록에 성공했습니다.');
				getBoxTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}
</script>
