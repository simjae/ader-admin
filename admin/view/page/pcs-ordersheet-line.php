<style>
	.white_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;
	}
	.gray_btn{
		font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;
	}
    .line_name{ width:230px!important }
    .line_memo{ width:100px!important }
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/md/line/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="LINE_NAME">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>라인 목록</h3>
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
                        <input type="text" name="line_name" value="">
                    </div>
                </div>
                <div class="half__box__wrap">
                    <div class="content__title">타입</div>
                    <div class="content__row">
                        <select name="line_type_idx" class="fSelect" style="width:163px;float:right;margin-right:10px;">
                            <option value="">타입을 선택해주세요</option>
<?php 
                        $db->query('SELECT IDX, TYPE_NAME FROM dev.LINE_TYPE');
                                
                        foreach($db->fetch() as $line_type_data){
?>
                            <option value="<?=$line_type_data['IDX']?>"><?=$line_type_data['TYPE_NAME']?></option>
<?php
                        }
?>
                        </select>
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
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getLineTabInfo()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getLineTabInfo');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
    <div class="card__header">
        <h3>라인 리스트</h3>
        <div class="drive--x"></div>
    </div>	
    <form id="frm-list-line">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 라인 수 <font class="cnt_total info__count" >0</font>개
            </div>
            <div class="content__row">
                <div class="btn" onclick="lineTotalUpdate()" style="color:#ffffff;background-color:#ffa500">일괄 수정</div>
                <select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
                    <option value="LINE_NAME|ASC" selected>라인명 순</option>    
                    <option value="LINE_NAME|DESC">라인명 역순</option>
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
        <font class="info__count">* 사용중인 상품 수를 클릭하시면 상품목록을 보실 수 있습니다.</font>
        <div class="table table__wrap">
            <TABLE>
                <THEAD>
                    <TR>
                        <TH >No.</TH>
                        <TH >수정</TH>
                        <TH >삭제</TH>
                        <TH >이름</TH>
                        <TH >타입</TH>
                        <TH >비고</TH>
                        <TH >사용중인 상품 수</TH>
                    </TR>
                </THEAD>
                <TBODY id="result_line_table">
                </TBODY>
            </TABLE>
        </div>
        <div class="padding__wrap">
            <input type="hidden" class="total_cnt" value="0" onChange="setLinePaging(this);">
            <input type="hidden" class="result_cnt" value="0" onChange="setLinePaging(this);">
            <div class="line_paging"></div>
        </div>
    </form>
    <h3>라인 추가하기</h3>
    <div class="drive--x"></div>
    <div class="table table__wrap">
        <form id="frm-line">
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
                        <th>라인 명</th>
                        <th>타입</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <div type="button" class="btn" onclick="lineInsert(this)">생성</div></td>
                        <td><input type="text" name="line_name" value=""></td>
                        <td>
                            <div class="content__wrap">
                                <div class="content__row">
                                    <select name="line_type_idx" class="fSelect" style="width:163px;float:right;margin-right:10px;">
                                        <option value="">타입을 선택해주세요</option>
<?php 
                                $db->query('SELECT IDX, TYPE_NAME FROM dev.LINE_TYPE');
                                        
                                foreach($db->fetch() as $line_type_data){
?>
                                        <option value="<?=$line_type_data['IDX']?>"><?=$line_type_data['TYPE_NAME']?></option>
<?php
                                }
?>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td><input type="text" name="line_memo" value=""></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

var category = null;
$(document).ready(function() {
	getLineTabInfo();

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

function getLineTabInfo(){
	$("#result_line_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="7">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_line_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".line_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_line_table").html('');
			}

			d.forEach(function(row) {
                strDiv = `
                        <tr> 
				            <td>${row.num}<input type="hidden" name="line_idx_list[]" value="${row.line_idx}"></td>
				            <td><div type="button" class="btn" action_type="LINE_PUT" sel_idx="${row.line_idx}" onclick="lineAction(this)">수정</div></td>
                            <td><div type="button" class="btn" action_type="LINE_DELETE" sel_idx="${row.line_idx}" onclick="lineAction(this)">삭제</div></td>
							<td><input class="line_name" type="text" name="line_name_list[]" value="${row.line_name}"></td>
				            <td>${row.type_name}</td>
                            <td><input class="line_memo" type="text" name="line_memo_list[]" value="${row.line_memo}"></td>
                            <td class="product_cnt" style="cursor:pointer" onclick="openLineUseProductModal(${row.line_idx})">${row.use_product_cnt}</td>
				        </tr>
				`;
				$("#result_line_table").append(strDiv);
			});
		},
	},rows, page)
}
function setLinePaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getLineTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getLineTabInfo();
}

function lineAction(obj){
    var action_type = $(obj).attr('action_type');
    var action_str = '';
    if(action_type == "LINE_PUT"){
        action_str = '수정';
    }
    else if(action_type == "LINE_DELETE"){
        action_str = '삭제';
    }
    confirm('선택하신 라인 정보를 ' + action_str + '하시겠습니까?', function(){
        var sel_tr = $(obj).parent().parent();
        var sel_idx = $(obj).attr('sel_idx');
        var action_name = '';
        var api_str = '';
        
        switch(action_type){
            case 'LINE_PUT':
                action_name = '라인 수정';
                api_str = "put";
                var param_obj = {
                    'sel_idx' : sel_idx,
                    'line_name' : sel_tr.find('.line_name').eq(0).val(),
                    'line_memo' : sel_tr.find('.line_memo').eq(0).val()
                }
                break;
            case 'LINE_DELETE':
                var product_cnt = sel_tr.find('.product_cnt').text();
                var param_obj = {
                    'sel_idx' : sel_idx
                }
                if(product_cnt > 0){
                    alert('이미 해당 라인을 사용중인 제품이 있습니다.');
                    return false;
                }
                else{
                    action_name = "라인 삭제";
                    api_str = "delete";
                }
                break;
        }

        $.ajax({
            type: "post",
            data: param_obj,
            dataType: "json",
            url: config.api + "pcs/ordersheet/md/line/"+api_str,
            error: function() {
                alert(action_name + ' 처리에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert(action_name + ' 처리에 성공했습니다.');
                    getLineTabInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}
function lineTotalUpdate(){
    confirm('현재 기입된 라인정보를 일괄 수정하시겠습니까?', function(){
        var formData = new FormData();
        formData = $('#frm-list-line').serializeObject();

        if(formData['line_name_list[]'] != null && formData['line_name_list[]'].length > 0){
            if(exceptionCheck(formData['line_name_list[]']) == false){
                alert('라인명을 입력해주세요');
                return false;
            }
            $.ajax({
                type: "post",
                data: formData,
                dataType: "json",
                url: config.api + "pcs/ordersheet/md/line/put",
                error: function() {
                    alert('라인 일괄수정작업이 실패했습니다.');
                },
                success: function(d) {
                    if(d.code == 200) {
                        alert('라인 일괄수정작업을 성공했습니다.');
                        getLineTabInfo();
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
function lineInsert(obj){
    confirm('라인을 추가하시겠습니까?', function(){
        var formData = new FormData();
        formData = $("#frm-line").serializeObject();

        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "pcs/ordersheet/md/line/add",
            error: function() {
                alert('라인 등록에 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('라인 등록에 성공했습니다.');
                    getLineTabInfo();
                }
                else{
                    alert(d.msg);
                }
            }
        });
    });
}

function openLineUseProductModal(idx) {
    modal('/use_product', `line_idx=${idx}`);
}
</script>
