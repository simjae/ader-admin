<style>
	.preview{
		display: grid;
		grid-template-columns: 300px 1fr;
		width: 100%;
		height: 400px;
		border-radius: 20px;
		box-shadow: 2px 1px 8px 0px #7070704a;
	}
	.preview__wrap{
		padding: 40px;
		display: flex;
		flex-direction: column;
	}
	.preview__wrap--img{
		width: 100%;
		padding: 20px;
	}
	.preview__img{
		background-size: cover;
		width: 100%;
		background-repeat: no-repeat;
		padding: 20px;
		height: 100%;
	}
	.preview__box{
		padding: 20px 0;
	}
	.preview__title{
		font-size: 20px;
		font-weight: 300;
		
	}
	.preview__subTitle{
		font-size: 15px;
		font-weight: 300;
		color: #707070;
	}
	.preview__content.roop .preview__title{
		font-weight: 500;
		color: black;
	}
	.preview__content.roop .preview__subTitle{
		font-weight: 500;
		color: black;
	}
	
</style>
<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>WHAT'S NEW 프리뷰</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="preview"></div>
	</div>
</div>

<div class="content__card">
	<form id="frm-list" action="display/whats/get">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<input type="hidden" class="action_type" name="action_type">
	
		<div class="card__header">
			<div class="flex justify-between">
				<h3>WHAT'S NEW 목록</h3>
				<div class="black-btn" onClick="location.href='/display/whats/regist'">추가하기</div>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
					총 <font class="cnt_total info__count" >0</font>개
				</div>
				<div class="content__row">
					<select name="searchSorting" class="fSelect" style="width:130px;float:right;margin-right:10px;" onchange="orderChange(this)">
						<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">수정일 역순</option>
						<option value="UPDATE_DATE|ASC">수정일 순</option>
					</select>
					
					<select style="width: 130px;" onchange="rowsChange(this)">
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
			
			<div class="table__wrap table">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" style="width: 130px;" action_type="page_copy" onclick="whatsNewActionClick(this)">페이지 복사</div>
						<div class="filter__btn" style="width: 130px;" action_type="page_delete" onclick="whatsNewActionClick(this)">페이지 삭제</div>
						<div class="filter__btn" style="width: 130px;" action_type="display_true" onclick="whatsNewActionClick(this)">진열</div>
						<div class="filter__btn" style="width: 130px;" action_type="display_false" onclick="whatsNewActionClick(this)">진열취소</div>
					</div>                                
				</div>
				<div class="overflow-x-auto">
					<TABLE>
						<THEAD>
							<TR>
								<TH style="width:1%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" onclick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:2%;">No.</TH>
								<TH style="width:4%;">프리뷰 조회</TH>
								<TH style="width:3%;">진열상태</TH>
								<TH style="width:5%;">진열기간</TH>
								<TH style="width:250px;">타이틀</TH>
								<TH style="width:250px;">서브타이틀</TH>
								<TH style="width:250px;">URL</TH>
								<TH style="width:250px;">썸네일 URL</TH>
								<TH style="width:250px;">설명</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table">
					</TABLE>
				</div>
			</div>
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
				<div class="paging"></div>
			</div>
		</div>
	</form>
</div>

<script>
let idx = 0; //초기화
let num = 1;
$(document).ready(function() {
	getPreviewInfo();
	getWhatsInfo();
});

function getPreviewInfo() {
	var strDiv = "";
	strDiv += '<div class="preview__wrap--img" data-previewNum="" >';
	strDiv += "    <div class='preview__img'></div>";
	strDiv += '</div>';
	
	$(".preview").html('');
	$(".preview").append(strDiv);
	
	$.ajax({
		type: "post",
		data: {
			img_flg : true
		},
		dataType: "json",
		url: config.api + "display/whats/get",
		error: function() {
			alert("프리뷰 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if(data != null){
					var strDiv = "";
					strDiv += '<div class="preview__wrap">';
					
					var first_img = data[0].img_location;
					first_img = first_img.replace('/var/www/admin/www','');
					$(".preview__img").css("background-image","url('" + first_img + "')");

					data.forEach(function(row) {
						strDiv += '<div class="preview__box" >';
						strDiv += '    <div class="preview__content">';
						strDiv += '        <div class="preview__title">' + row.page_title + '</div>';
						strDiv += '        <div class="preview__subTitle">' + row.page_sub_title + '</div>';
						strDiv += '        <input class="whats_new_img" type="hidden" value="' + row.img_location + '">';
						strDiv += '    </div>';
						strDiv += '</div>';
					});
					strDiv += '</div>';
					
					$(".preview").append(strDiv);
					previewSet();
				}
			}
		}
	});
}
function previewSet(){	
	$(".preview__box").mouseover(function(){
		var preview_idx = $(".preview__box").index(this);
		var img_location = $(this).find(".whats_new_img").val();
		img_location = img_location.replace('/var/www/admin/www','');


		let box = $('.preview__content'); 		// 바뀌어야 할 선택자
		box.removeClass('roop'); 				// 초기값 선택자(on) 삭제
		box.eq(preview_idx).addClass('roop'); 	// 해당순번 선택자 추가

		$(".preview__img").css("background-image","url('" + img_location + "')");
	});
}

function getWhatsInfo() {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="9">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $('#frm-list').find('.rows').val();
	var page = $('#frm-list').find('.page').val();
	
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			
			d.forEach(function(row) {
				if (row.page_sub_title == null) {
					row.page_sub_title = '';
				}
				
				if (row.page_url == null) {
					row.page_url = '';
				}
				
				if (row.thumbnail_url == null) {
					row.thumbnail_url = '';
				}
				
				if (row.page_memo == null) {
					row.page_memo = '';
				}
				
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label style="display: block;">';
				strDiv += '                <input type="checkbox" name="select_idx[]" class="select" value="' + row.idx + '" >';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <button type="button" page_idx="' + row.idx + '" onClick="openWhatsPreviewModal(' + row.idx + ');" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer;">프리뷰</button>';
				strDiv += '    </TD>';
				
				var display_flg = "";
				var display_str = "";
				var display_date = "";
				
				var today = new Date();
				var start_date = new Date(row.display_start_date);
				var end_date = new Date(row.display_end_date);					
				
				if (row.display_end_date == '9999-12-31 23:59') {
					display_date = "상시진열";
				}
				
				if (row.display_flg == true) {
					display_flg = true;
					
					if ((today <= start_date)) {
						display_str = "진열예약";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
						}
						
					} else if ((today >= start_date) && (today <= end_date)) {
						display_str = "진열중";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
						}
						
					} else if ((today >= start_date) && (today > end_date)) {
						display_str = "진열종료";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
						}
					}
				} else {
					display_flg = false;
					
					display_str = "진열안함";
					if (display_date.length == 0) {
						display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
					}
				}
				
				strDiv += '    <TD>';
				strDiv += '        <input id="display_flg_' + row.idx + '" type="hidden" value="' + display_flg + '">';
				strDiv += '        ' + display_str;
				strDiv += '    </TD>';
				strDiv += '    <TD>' + display_date + '</TD>';
				strDiv += '    <TD><font style="cursor:pointer;" onClick="openWhatsNewUpdateModal(' + row.idx + ');">' + row.page_title + '</font></TD>';
				strDiv += '    <TD>' + row.page_sub_title + '</TD>';
				strDiv += '    <TD>' + row.page_url + '</TD>';
				strDiv += '    <TD>' + row.thumbnail_url + '</TD>';
				strDiv += '    <TD>' + row.page_memo + '</TD>';
				strDiv += '</TR>';
				
				$("#result_table").append(strDiv);
				
				$('input:checkbox').on('click', function(){
					if($('.select:checked').length == $('.select').length){
						$('input[name="selectAll"]').prop('checked', true);
					}
					else{
						$('input[name="selectAll"]').prop('checked', false);
					}
				});
			});
			getPreviewInfo();
		},
	},rows,page);
}
function openWhatsNewUpdateModal(idx) {
	param_str = 'idx='+idx;
	modal('/put', param_str);
}
function openWhatsPreviewModal(idx) {
	param_str = 'idx='+idx;
	modal('/preview', param_str);
}
function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$("#result_table").find('.select').prop('checked',false);
	}
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list').find('.sort_value').val(order_value[0]);
	$('#frm-list').find('.sort_type').val(order_value[1]);
	
	getWhatsInfo();
}
function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-list').find('.rows').val(rows);
	$('#frm-list').find('.page').val(1);
	
	getWhatsInfo();
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}
function whatsNewActionClick(obj) {
	var action_type = $(obj).attr('action_type');
	$('.action_type').val(action_type);
	
	var action_name = "";
	
	switch (action_type) {
		case "page_copy" :
			action_name = "페이지복사";
			break;
		
		case "page_delete" :
			action_name = "페이지삭제";
			break;
		
		case "display_true" :
			action_name = "진열";
			break;
		
		case "display_false" :
			action_name = "진열취소";
			break;
	}
	
	var formData = new FormData();
	formData = $("#frm-list").serializeObject();

	var select_idx = [];
	var length = $("#frm-list").find('.select').length;
	var true_cnt = 0;
	var false_cnt = 0;
	for (var i=0; i<length; i++) {
		var select = $("#frm-list").find('.select').eq(i);
		if (select.prop('checked') == true) {
			if ($('#display_flg_' + select.val()).val() == "true") {
				true_cnt++;
			} else if ($('#display_flg_' + select.val()).val() == "false") {
				false_cnt++;
			}
			
			select_idx.push(select.val());
		}		
	}
	
	if (action_type == "display_true" && true_cnt > 0) {
		alert('현재 미진열중인 페이지만 진열상태로 변경할 수 있습니다. 선택한 페이지의 진열상태를 확인해주세요.');
		return false;
	} else if (action_type == "display_false" && false_cnt > 0) {
		alert('현재 진열중인 페이지만 미진열상태로 변경할 수 있습니다. 선택한 페이지의 진열상태를 확인해주세요.');
		return false;
	}
	
	if (select_idx.length > 0) {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/whats/put",
			error: function() {
				alert(action_name + " 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert(action_name + ' 처리에 성공했습니다.');
					insertLog("전시관리 > What's New 관리", action_name, select_idx.length);
					$('input[name="selectAll"]').prop('checked', false);
					getWhatsInfo();
				}
			}
		});
	} else {
		alert(action_name + ' 처리 할 상품을 선택해주세요.');
	}
}
</script>