<style>
.checked{background-color:#707070!important;color:#ffffff!important;}
.unchecked{background-color:#ffffff!important;color:#000000!important;}
.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
.btn-close{float:right;color:'#000';}
.size_info_text {height:150px;}
.smart_editer_text {height:180px;}
</style>

<input id="json_str" type="hidden"  value='<?=$json_str?>'>
<div class="content__card" style="width:1000px!important">
	<h3>
		부자재 검색창
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h3>
	
	<div class="card__body">
        <form id="frm-filter" action="pcs/ordersheet/td/sub_material/list/get">
            <input type="hidden" class="sort_type" name="sort_type" value="DESC">
            <input type="hidden" class="sort_value" name="sort_value" value="SUB_MATERIAL_CODE">
            <input type="hidden" class="rows" name="rows" value="10">
            <input type="hidden" class="page" name="page" value="1">

            <div class="card__header">
            </div>
            <div class="drive--x"></div>
            <div class="card__body">
                <div claszs="body__info--count" style="display: block;margin:20px 0;">
                    <div class="drive--left"></div>
                    <div class="flex justify-between" style="gap:20px;">
                    </div>
                </div>
                <div class="content__wrap">
					<div class="content__title">부자재 타입</div>
					<div class="content__row">
						<label class="rd__square">
							<input type="radio" name="sub_material_type" value="ALL" checked>
							<div><div></div></div>
							<span>전체</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="sub_material_type" value="T" >
							<div><div></div></div>
							<span>포장부자재</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="sub_material_type" value="D">
							<div><div></div></div>
							<span>배송부자재</span>
						</label>
					</div>
                </div>
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
                        <div class="content__title">부자재명</div>
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
                    <div  class="blue__color__btn" onClick="getSubmaterialInfo()"><span>검색</span></div>
                        <div class="defult__color__btn" onClick="init_fileter('frm-filter','getSubMaterialTabInfo()');"><span>초기화</span></div>
                    </div>
                </div>
            </div> 
        </form>
		<div class="card__header">
            <h3>부자재 검색결과</h3>
            <div class="drive--x"></div>
        </div>
        <div class="card__body">
			<form id="frm-list">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 부자재 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
				<div class="table__wrap table">
					<TABLE>
						<colgroup>
							<col width="3%">
							<col width="5%">
							<col width="5%">
							<col width="25%">
							<col>
						</colgroup>
						<THEAD>
							<TR>
								<TH>선택</TH>
								<TH>부자재 타입</TH>
								<TH>부자재 코드</TH>
								<TH>부자재 명</TH>
								<TH>부자재 메모</TH>
							</TR>
						</THEAD>
						
						<TBODY id="result_table">
							<TD class="default_td" colspan="5">
								부자재를 검색해주세요.
							</TD>
						</TBODY>
					</TABLE>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
					<div class="paging"></div>
				</div>
			</form>
			<div class="drive--x"></div>
			<form id="frm-sub-update">
				<input type="hidden" name="ordersheet_idx">
				<div class="grid__half">
					<div class="half__box__wrap" style="grid-template-columns: 1fr!important;">
						<div class="table table__wrap" style="width:90%!important;height: 100%;">
							<div class="overflow-x-auto" >
								<h3 style="margin-bottom:20px">포장부자재</h3>
								<TABLE>
									<colgroup>
										<col width="10%">
										<col width="30%">
										<col width="50%">
										<col width="10%">
									</colgroup>
									<THEAD>
										<TR>
											<TH>선택</TH>
											<TH>부자재명</TH>
											<TH>메모</TH>
											<TH>삭제</TH>
										</TR>
									</THEAD>
									<TBODY id="package_submaterial" class="td">
									</TBODY>
								</TABLE>
							</div>
						</div>
					</div>
					<div class="half__box__wrap" style="grid-template-columns: 1fr!important;">
						<div class="table table__wrap" style="width:90%!important;height: 100%;">
							<div class="overflow-x-auto" >
								<h3 style="margin-bottom:20px">배송부자재</h3>
								<TABLE id="">
									<colgroup>
										<col width="10%">
										<col width="30%">
										<col width="50%">
										<col width="10%">
									</colgroup>
									<THEAD>
										<TR>
											<TH>선택</TH>
											<TH>부자재명</TH>
											<TH>메모</TH>
											<TH>삭제</TH>
										</TR>
									</THEAD>
									<TBODY id="delivery_submaterial" class="delivery">
									</TBODY>
								</TABLE>
							</div>
						</div>
					</div>
				</div>
			</form>
        </div>
	</div>
	
	<div class="card__footer">
		<a onclick="confirm('부자재 입력항목을 이대로 수정하시겠습니까?','updateSubMaterialForm()');" class="btn blue" style="margin-right:10px;"><i class="xi-check"></i>적용</a>
		<a onclick="confirm('창을 나가시겠습니까?','modal_close()');" class="btn red"><i class="xi-close"></i>취소</a>
	</div>
</div>

<script>
var data = '';
var param_json = {};
$(document).ready(function() {		
	var json_str = $('#json_str').val();
    var json_data = eval("(" + json_str + ")");
	
	param_json = json_data[1];
	setSubmaterialInfo(param_json);
	
	getSubmaterialInfo();
	$("a.btn.red.delete").click(function() {
		let sel_tr = $(this).parent().parent();
		confirm("해당 부자재항목을 삭제할까요?",function() {
			sel_tr.remove();
		});
	});
});

function setSubmaterialInfo(param_json) {
	console.log(param_json);
	if (param_json != null) {
		param_json.forEach(function(json_row) {
			var type = json_row.sub_type;
			var table_id = '';
			var checked_str = '';
			
			let submaterial_table = null;
			if (type == "T") {
				submaterial_table = $('#package_submaterial');
			} else if (type == "D") {
				submaterial_table = $('#delivery_submaterial');
			}
			
			let strDiv = "";
			strDiv += '<tr>';
			strDiv += '    <td>';
			strDiv += '        <div class="cb__color">';
			strDiv += '            <label>';
			strDiv += '                <input type="checkbox" class="select" name="no[]" value="' + json_row.sub_idx + '" checked>';
			strDiv += '                <span></span>';
			strDiv += '            </label>';
			strDiv += '        </div>';
			strDiv += '    </td>';
			strDiv += '    <td>' + json_row.sub_name + '</td>';
			strDiv += '    <td>' + json_row.sub_memo + '</td>';
			strDiv += '    <td><a class="btn red delete"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>';
			strDiv += '</tr>';
			
			submaterial_table.append(strDiv);
		});
	}
}

function getSubmaterialInfo(){
	let frm = $('#frm-filter');
	let result_table = $('#result_table');
	
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	get_contents(frm,{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			data = d;
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr id="submaterial_' + row.sub_material_idx + '">';
				strDiv += '    <td>';
				strDiv += '    	   <input type="hidden" value="' + row.sub_material_idx + '">	';
				strDiv += '        <div type="button" class="btn" onclick="addTmpSubmaterialInfo(' + row.sub_material_idx + ',\'' + row.sub_material_type + '\')">선택</div>';
				strDiv += '    </td>';
				
				var sub_material_type = "";
				if (row.sub_material_type == "T") {
					sub_material_type = "포장부자재";
				} else if (row.sub_material_type == "D") {
					sub_material_type = "배송부자재";
				}
				
				strDiv += '    <td>' + sub_material_type + '</td>';
                strDiv += '    <td>' + row.sub_material_code + '</td>';
				strDiv += '    <td class="submaterial_name">' + row.sub_material_name + '</td>';
                strDiv += '    <td class="submaterial_memo">' + row.sub_material_memo + '</td>';
				strDiv += '</tr>';
				
				result_table.append(strDiv);
			});
		},
	},rows, page);
}

function addTmpSubmaterialInfo(submaterial_idx,submaterial_type){
	var selected_tr = $('#submaterial_' + submaterial_idx);
	var submaterial_name = selected_tr.find('.submaterial_name').text();
	var submaterial_memo = selected_tr.find('.submaterial_memo').text();
	
	let submaterial_table = null;
	if (submaterial_type == "T") {
		submaterial_table = $('#package_submaterial');
	} else if (submaterial_type == "D") {
		submaterial_table = $('#delivery_submaterial');
	}
	
	var cnt = submaterial_table.find('.cb__color').find('input[value="' + submaterial_idx + '"]').length;

	if(cnt < 1){
		let strDiv = "";
		strDiv += '<tr>';
		strDiv += '    <td>';
		strDiv += '        <div class="cb__color">';
		strDiv += '            <label>';
		strDiv += '                <input type="checkbox" class="select" value="' + submaterial_idx + '" checked>';
		strDiv += '                <span></span>';
		strDiv += '            </label>';
		strDiv += '        </div>';
		strDiv += '    </td>';
		strDiv += '    <td>' + submaterial_name + '</td>';
		strDiv += '    <td>' + submaterial_memo + '</td>';
		strDiv += '    <td><a class="btn red delete"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a></td>';
		strDiv += '</tr>';

		submaterial_table.append(strDiv);
		
		$("a.btn.red.delete").click(function() {
			$(this).parent().parent().remove();
		});
	}
	else{
		alert('이미 선택된 부자재입니다.');
	}	
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__square').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__square').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	window[func_name]();
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function updateSubMaterialForm(){
	var sub_json = {};
    var temp_arr = [];
    var idx = 0;
    
    $('#package_submaterial, #delivery_submaterial').children().each(function () {
        sub_json = {};

        sub_json.sub_idx = $(this).find('.select').val();
        sub_json.sub_checked = $(this).find('.select').prop('checked');
        sub_json.sub_name = $(this).find('td').eq(1).text();
        sub_json.sub_memo = $(this).find('td').eq(2).text();

        if($(this).parent().hasClass('td') == true){
            sub_json.sub_type = 'T';
        }
        else if($(this).parent().hasClass('delivery') == true){
            sub_json.sub_type = 'D';
        }
        temp_arr.push(sub_json);
    })

	$('.form-group.td').html('');
	$('.form-group.delivery').html('');

    temp_arr.forEach(function(sub_data){
		var strChekbox = '';
		var tableClass = '';
		var inputName = '';
		
		if(sub_data.sub_type == 'T'){
			tableClass = '.form-group.td';
			inputName = 'td_sub_material_idx';
		}
		else if(sub_data.sub_type == 'D'){
			tableClass = '.form-group.delivery';
			inputName = 'delivery_sub_material_idx';
		}
		
		let strDiv = "";
		strDiv += '<div class="content__row" style="margin-bottom:5px;">';
		strDiv += '    <label>';
		strDiv += '        <input type="checkbox" class="sub__idx" name="' + inputName + '[]" value="' + sub_data.sub_idx + '" checked>';
		strDiv += '        <span>' + sub_data.sub_name + '</span>';
		strDiv += '        <input type="hidden" class="sub__memo" value="' + sub_data.sub_memo + '">';
		strDiv += '    </label>';
		strDiv += '</div>';
		
		$(tableClass).append(strDiv);
	})
	modal_close();
}
</script>