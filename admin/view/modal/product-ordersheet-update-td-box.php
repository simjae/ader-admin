<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
</style>
<div class="body">
	<h1>
        적재박스 리스트
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
    <div class="contents">
        <form id="frm-list" action="pm/ordersheet/td/box/list/get">
            <input type="hidden" class="sort_type" name="sort_type" value="DESC">
            <input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
            <input type="hidden" class="rows" name="rows" value="10">
            <input type="hidden" class="page" name="page" value="1">
            <div class="info__wrap " style="justify-content:space-between; align-items: center;">
                <div class="body__info--count">
                    <div class="drive--left"></div>
                    총 박스 수 <font class="cnt_total info__count" >0</font>개
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
        <h3>박스 추가하기</h3>
        <div class="drive--x"></div>
        <div class="table table__wrap">
            <form id="frm-box">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>박스 명</th>
                            <th>너비(cm)</th>
                            <th>길이(cm)</th>
                            <th>높이(cm)</th>
                            <th>부피(cm³)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><button type="button" class="white_btn" onclick="boxInsert(this)">생성</button></td>
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
</div>
<script>

var category = null;
$(document).ready(function() {
	getBoxTabInfo();
});

function getBoxTabInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="13">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-list").find('.rows').val();
	var page = $("#frm-list").find('.page').val();
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}

			d.forEach(function(row) {
                strDiv = `
                        <tr> 
				            <td>${row.num}</td>
				            <td><button type="button" class="white_btn" action_type="box_put" sel_idx="${row.box_idx}" onclick="boxAction(this)">수정</button></td>
                            <td><button type="button" class="white_btn" action_type="box_delete" sel_idx="${row.box_idx}" onclick="boxAction(this)">삭제</button></td>
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
	
	$('#frm-list').find('.rows').val(rows);
	$('#frm-list').find('.page').val(1);

	getBoxTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list').find('.sort_value').val(order_value[0]);
	$('#frm-list').find('.sort_type').val(order_value[1]);

	getBoxTabInfo();
}

function boxAction(obj){
    var sel_tr = $(obj).parent().parent();
    var action_type = $(obj).attr('action_type');
    var sel_idx = $(obj).attr('sel_idx');
	var action_name = '';
    var api_str = '';

	switch(action_type){
		case 'box_put':
			action_name = '박스 수정';
            api_str = "put";
            var param_obj = {
                'sel_idx' : sel_idx,
                'box_name' : sel_tr.find('.box_name').eq(0).val(),
                'box_width' : sel_tr.find('.box_info').eq(0).val(),
                'box_length' : sel_tr.find('.box_info').eq(1).val(),
                'box_height' : sel_tr.find('.box_info').eq(2).val(),
                'box_volume' : sel_tr.find('.box_volume').eq(0).val()
            }
			break;
        case 'box_delete':
            var product_cnt = sel_tr.find('.product_cnt').text();
            var param_obj = {
                'sel_idx' : sel_idx
            }
            if(product_cnt > 0){
                alert('이미 해당박스를 사용중인 제품이 있습니다.');
                return false;
            }
            else{
                action_name = "박스 삭제";
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
			alert('박스 등록에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert('박스 등록에 성공했습니다.');
				getBoxTabInfo();
			}
            else{
                alert(d.msg);
            }
		}
	});
}
</script>
