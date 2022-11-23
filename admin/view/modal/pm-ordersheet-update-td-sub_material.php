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
        <form id="frm-filter" action="pm/ordersheet/td/sub_material/list/get">
            <input type="hidden" class="sort_type" name="sort_type" value="DESC">
            <input type="hidden" class="sort_value" name="sort_value" value="SUB_MATERIAL_TYPE">
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
                <div class="content__wrap grid__half">
                    <div class="half__box__wrap">
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
                    <div class="half__box__wrap">
                        <div class="content__title">부자재명</div>
                        <div class="content__row">
                            <input type="text" name="sub_material_name" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card__footer">
                <div class="footer__btn__wrap" style="grid: none;">
                    <div class="btn__wrap--lg">
                    <div  class="blue__color__btn" onClick="getSubMaterialTabInfo()"><span>검색</span></div>
                        <div class="defult__color__btn" onClick="init_fileter('frm-filter','getSubMaterialTabInfo()');"><span>초기화</span></div>
                    </div>
                </div>
            </div> 
        </form>
		<div class="card__header">
            <h3>선택샘플 총 갯수</h3>
            <div class="drive--x"></div>
        </div>
        <div class="card__body">
			<form id="frm-list">
				<div class="table__wrap table">
					<div class="table__filter">
						<div class="filrer__wrap">
							<div style="width: 120px;" class="filter__btn" onclick="selectSubMaterial();">부자재 선택</div>
						</div>                                
					</div>
					<TABLE>
						<colgroup>
							<col width="3%">
							<col width="3%">
							<col width="10%">
							<col width="25%">
							<col>
						</colgroup>
						<THEAD>
							<TR>
								<TH>
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>No.</th>
								<TH>부자재 타입</TH>
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
        </div>
	</div>
	
	<div class="card__footer">
		<a onclick="modal_close();" class="btn"><i class="xi-close"></i>나가기</a>
	</div>
</div>

<script>
var data = '';
$(document).ready(function() {	
	var json_str = $('#json_str').val();
    var json_data = eval("(" + json_str + ")");

    console.log(json_data);
});
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
function getSubMaterialTabInfo(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="5">';
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
			data = d;
			d.forEach(function(row) {
                console.log(row);
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="no[]" value="' + row.sub_material_idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </td>';
				strDiv += '    <td>' + row.num + '</td>';
				
				var sub_material_type = "";
				if (row.sub_material_type == "T") {
					sub_material_type = "포장부자재";
				} else if (row.sub_material_type == "D") {
					sub_material_type = "배송부자재";
				}
				
				strDiv += '    <td>' + sub_material_type + '</td>';
                strDiv += '    <td>' + row.sub_material_name + '</td>';
                strDiv += '    <td>' + row.sub_material_memo + '</td>';
				strDiv += '</tr>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table").find('.select').prop('checked',false);
	}
}
function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getProdTabInfo();
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getProdTabInfo();
}
function selectSubMaterial(){
	var formData = new FormData();
	formData = $("#frm-list").serializeObject();

	console.log(formData);
}
</script>