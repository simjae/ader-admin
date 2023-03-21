<style>
.white_btn{font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;}
.gray_btn{font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#a0a0a0;cursor: not-allowed;}
</style>

<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter" action="pcs/ordersheet/td/box/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="ASC">
		<input type="hidden" class="sort_value" name="sort_value" value="BOX_NAME">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>적재박스 목록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__wrap">
						<div class="content__title">이름</div>
						<div class="content__row">
							<input type="text" name="box_name" value="">
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__wrap">
						<div class="content__title">박스타입</div>
						<div class="content__row">
							<select class="fSelect" name="box_type">
								<option value="ALL">전체</option>
								<?php
									$select_box_type_sql = "
										SELECT
											DISTINCT BI.BOX_TYPE	AS BOX_TYPE
										FROM
											dev.BOX_INFO BI
									";
									
									$db->query($select_box_type_sql);
									
									foreach($db->fetch() as $box_data) {
								?>		
								<option value="<?=$box_data['BOX_TYPE']?>"><?=$box_data['BOX_TYPE']?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
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
					<div  class="blue__color__btn" onClick="getBoxInfoList()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getBoxInfoList');"><span>초기화</span></div>
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
    <form id="frm-list-box">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 적재박스 수 <font class="cnt_total info__count" >0</font>개
            </div>
            <div class="content__row">
				<div class="btn" onclick="boxTotalUpdate()" style="color:#ffffff;background-color:#ffa500">일괄 수정</div>
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
						<TH style="width:120px">박스타입</TH>
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
						<th>적재박스 타입</th>
                        <th>적재박스 명</th>
                        <th>너비(cm)</th>
                        <th>길이(cm)</th>
                        <th>높이(cm)</th>
                        <th>부피(cm³)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
							<div type="button" class="btn" onclick="addBoxInfo()">생성</div>
						</td>
                        <td>
							<input type="text" class="box_type" name="box_type" value="">
						</td>
						<td>
							<input type="text" class="box_type" name="box_name" value="">
						</td>
                        <td>
							<input class="box_width" type="number" step="0.01" name="box_width" value="" onKeyUp="calcBoxVolume(this);">
						</td>
                        <td>
							<input class="box_length" type="number" step="0.01" name="box_length" value="" onKeyUp="calcBoxVolume(this);">
						</td>
                        <td>
							<input class="box_height" type="number" step="0.01" name="box_height" value="" onKeyUp="calcBoxVolume(this);">
						</td>
                        <td>
							<input class="box_volume" type="number" step="0.01" readonly name="box_volume" value="">
						</td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script>

var category = null;
$(document).ready(function() {
	getBoxInfoList();
	$((document)).on('keypress', function(e){
        if(e.keyCode == '13'){
            $('.modal .red.btn').click();
        }
    });
});

function getBoxInfoList(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10">';
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
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += `
                	<tr>
					    <td>${row.num}<input type="hidden" name="box_idx_list[]" value="${row.box_idx}"></td>
					    <td style="text-align:center;">
					        <div type="button" class="btn" box_idx="${row.box_idx}" onclick="putBoxInfo(this)">수정</div>
					    </td>
					    <td style="text-align:center;">
					        <div type="button" class="btn" onclick="deleteBoxInfo(${row.box_idx})">삭제</div>
					    </td>
					    <td>
					        <input class="box_type" type="text" name="box_type_list[]" value="${row.box_type}">
					    </td>
					    <td>
					        <input class="box_name" type="text" name="box_name_list[]" value="${row.box_name}">
					    </td>
					    <td>
					        <input class="box_width" type="number" step="0.01" name="box_width_list[]" value="${row.box_width}" onKeyUp="calcBoxVolume(this);">
					    </TD>
					    <td>
					        <input class="box_length" type="number" step="0.01" name="box_length_list[]" value="${row.box_length}" onKeyUp="calcBoxVolume(this);">
					    </TD>
					    <td>
					        <input class="box_height" type="number" step="0.01" name="box_height_list[]" value="${row.box_height}" onKeyUp="calcBoxVolume(this);">
					    </td>
					    <td>
					        <input class="box_volume" type="number" step="0.01" name="box_volume_list[]" readonly value="${(row.box_width * row.box_length * row.box_height)}">
					    </td>
					    <td class="product_cnt" style="cursor:pointer" onclick="openBoxUseProductModal(${row.box_idx})">${row.use_product_cnt}</td>
					</tr>
				`;
			});
			
			$("#result_table").append(strDiv);
		},
	},rows, page)
}

function calcBoxVolume(obj) {
	var selected_tr = $(obj).parent().parent();
	var width = selected_tr.find('.box_width').val();
	var length = selected_tr.find('.box_length').val();
	var height = selected_tr.find('.box_height').val();

	if(width == 0 || length == 0 || height == 0){
		selected_tr.find('.box_volume').val(0);
	} else{
		selected_tr.find('.box_volume').val(width * length * height);
	}
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

	getBoxInfoList();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getBoxInfoList();
}

function addBoxInfo(){
    var formData = new FormData();
	formData = $("#frm-box").serializeObject();

    $.ajax({
		type: "post",
		url: config.api + "pcs/ordersheet/td/box/add",
		data: formData,
		dataType: "json",
		error: function() {
			alert('적재박스 등록처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				getBoxInfoList();
				alert('적재박스 등록되었습니다.');
			} else{
                alert(d.msg);
            }
		}
	});
}

function putBoxInfo(obj) {
	var selected_tr = $(obj).parent().parent();
    
	var box_idx = $(obj).attr('box_idx');
	let box_type = selected_tr.find('.box_type').val();
	let box_name = selected_tr.find('.box_name').val();
	let box_width = selected_tr.find('.box_width').val();
	let box_length = selected_tr.find('.box_length').val();
	let box_height = selected_tr.find('.box_height').val();
	let box_volume = selected_tr.find('.box_volume').val();
	
	confirm(
		'선택한 박스를 수정하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "pcs/ordersheet/td/box/put",
				data: {
					'box_idx' : box_idx,
					'box_type' : box_type,
					'box_name' : box_name,
					'box_width' : box_width,
					'box_length' : box_length,
					'box_height' : box_height,
					'box_volume' : box_volume
				},
				dataType: "json",
				error: function() {
					alert('적재박스 수정처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if(d.code == 200) {
						getBoxInfoList();
						alert('선택한 적재박스 정보가 수정되었습니다.');
					}
					else{
						alert(d.msg);
					}
				}
			});
		}
	);
}

function boxTotalUpdate(){
	confirm('현재 기입된 박스 정보를 일괄 수정하시겠습니까?', function(){
        let formData = new FormData();
        formData = $('#frm-list-box').serializeObject();
        if(formData['box_name_list[]'] != null && formData['box_name_list[]'].length > 0){
			if(exceptionCheck(formData['box_type_list[]']) == false){
                alert('박스타입명를 입력해주세요');
                return false;
            }
			if(exceptionCheck(formData['box_name_list[]']) == false){
                alert('박스 이름를 입력해주세요');
                return false;
            }
            $.ajax({
                type: "post",
                data: formData,
                dataType: "json",
                url: config.api + "pcs/ordersheet/td/box/put",
                error: function() {
                    alert('박스 일괄편집 처리에 실패했습니다.');
                },
                success: function(d) {
                    if(d.code == 200) {
                        alert('박스 일괄편집 처리에 성공했습니다.');
                        getBoxInfoList();
                    }
                    else{
                        alert(d.msg);
                    }
                }
            });
        }
        else{
            alert('수정할 수 있는 박스가 존재하지 않습니다.');
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
function deleteBoxInfo(box_idx) {
	confirm(
		'선택한 박스를 삭제;하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "pcs/ordersheet/td/box/delete",
				data: {
					'box_idx' : box_idx
				},
				dataType: "json",
				error: function() {
					alert('적재박스 삭제처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if(d.code == 200) {
						getBoxInfoList();
						alert('선택한 적재박스 정보가 삭제되었습니다.');
					} else{
						alert(d.msg);
					}
				}
			});
		}
	);
}

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
function openBoxUseProductModal(idx) {
    modal('/use_product', `box_idx=${idx}`);
}
</script>