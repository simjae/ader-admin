<div class="filter-wrap" style="margin-bottom:20px">
	<button class="post_tab_btn tap__button" tab_num="01" style="background-color:#000;color:#fff;font-weight:500;width:180px;" onClick="postTabBtnClick(this);">컬렉션</button>
	<button class="post_tab_btn tap__button" tab_num="02" style="width:180px;" onClick="postTabBtnClick(this);">에디토리얼</button>
	<button class="post_tab_btn tap__button" tab_num="03" style="width:180px;" onClick="postTabBtnClick(this);">콜라보레이션</button>
	<button class="post_tab_btn tap__button" tab_num="04" style="width:180px;" onClick="postTabBtnClick(this);">기획전</button>
</div>

	<input id="tab_num" type="hidden" value="01">
	
	<div id="post_tab_01" class="post_tab">
		<?php include_once("display-posting-collection.php"); ?>
	</div>
	<div id="post_tab_02" class="post_tab" style="display:none;">
		<?php include_once("display-posting-editorial.php"); ?>
	</div>
	<div id="post_tab_03" class="post_tab" style="display:none;">
		<?php include_once("display-posting-collaboration.php"); ?>
	</div>
	<div id="post_tab_04" class="post_tab" style="display:none;">
		<?php include_once("display-posting-exhibition.php"); ?>
	</div>

<script>
$(document).ready(function() {
	
});

function postTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.post_tab').hide();
	$('#post_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.post_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.post_tab_btn').not($(obj)).css('color','#000000');
}

function selectAllClick(obj) {
	var tab_num = $('#tab_num').val();
	
	var country = "";
	if (tab_num == "03") {
		country = $('#collaboration_country').val() + "_";
	} else if (tab_num == "04") {
		country = $('#exhibition_country').val() + "_";
	}
	
	if ($(obj).prop('checked') == true) {
		$("#result_" + tab_num + "_" + country + "table").find('.select').prop('checked',true);
	} else {
		$("#result_" + tab_num + "_" + country + "table").find('.select').prop('checked',false);
	}
}

function orderChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var country = "";
	if (tab_num == "03") {
		country = $('#collaboration_country').val() + "-";
	} else if (tab_num == "04") {
		country = $('#exhibition_country').val() + "-";
	}

	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-' + tab_num + '-' + country + 'list').find('.sort_value').val(order_value[0]);
	$('#frm-' + tab_num + '-' + country + 'list').find('.sort_type').val(order_value[1]);
	
	switch (tab_num) {
		case "01" :
			getPostingCollectionInfo();
			break;
		
		case "02" :
			getPostingEditorialInfo();
			break;
		
		case "03" :
			getPostingCollaborationInfo();
			break;
		
		case "04" :
			getPostingExhibitionInfo();
			break;
	}
}
function rowsChange(obj) {
	var tab_num = $('#tab_num').val();
	
	var country = "";
	if (tab_num == "03") {
		country = $('#collaboration_country').val() + "-";
	} else if (tab_num == "04") {
		country = $('#exhibition_country').val() + "-";
	}
	
	var rows = $(obj).val();
	
	$('#frm-' + tab_num + '-' + country + 'list').find('.rows').val(rows);
	$('#frm-' + tab_num + '-' + country + 'list').find('.page').val(1);
	
	switch (tab_num) {
		case "01" :
			getPostingCollectionInfo();
			break;
		
		case "02" :
			getPostingEditorialInfo();
			break;
		
		case "03" :
			getPostingCollaborationInfo();
			break;
		
		case "04" :
			getPostingExhibitionInfo();
			break;
	}
}

function setPaging(obj) {
	var tab_num = $(obj).attr('tab_num');
	var total_cnt = $(obj).val();
	
	var country = "";
	if (tab_num == "03") {
		country = $('#collaboration_country').val() + "_";
	} else if (tab_num == "04") {
		country = $('#exhibition_country').val() + "_";
	}
	
	$('#cnt_' + tab_num + '_' + country + 'total').text(total_cnt);
}

function postingActionClick(obj) {
	var tab_num = $('#tab_num').val();
	
	var action_type = $(obj).attr('action_type');
	var action_name = "";

	switch(action_type){
		case 'page_copy':
			action_name = "페이지 복사";
			break;
		case 'page_delete':
			action_name = "페이지 삭제";
			break;
		case 'display_true':
			action_name = "전시";
			break;
		case 'display_false':
			action_name = "전시취소";
			break;
	}
	
	var country = "";
	if (tab_num == "03") {
		country = $('#collaboration_country').val() + "-";
	} else if (tab_num == "04") {
		country = $('#exhibition_country').val() + "-";
	}
	
	var form = $('#frm-' + tab_num + '-' + country + 'list');
	form.find('.action_type').val(action_type);
	
	var formData = new FormData();
	formData = form.serializeObject();
	
	var select_idx = [];
	var length = form.find('.select').length;
	var true_cnt = 0;
	var false_cnt = 0;
	for (var i=0; i<length; i++) {
		var select = form.find('.select').eq(i);
		if (select.prop('checked') == true) {
			if (form.find('#display_flg_' + select.val()).val() == "true") {
				true_cnt++;
			} else if (form.find('#display_flg_' + select.val()).val() == "false") {
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
			url: config.api + "display/posting/put",
			error: function() {
				alert(action_name + " 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var tab_title = $('#post_tab_'+tab_num).find('h3').eq(0).text();
					insertLog("전시관리 > 게시물 관리 > " + tab_title, action_name, select_idx.length);
					alert(action_name + ' 처리에 성공했습니다.');
					form.find('input[name="selectAll"]').prop('checked', false);
					
					switch (tab_num) {
						case "01" :
							getPostingCollectionInfo();
							break;
						
						case "02" :
							getPostingEditorialInfo();
							break;
						
						case "03" :
							getPostingCollaborationInfo();
							break;
						
						case "04" :
							getPostingExhibitionInfo();
							break;
					}
				}
			}
		});
	} else {
		alert(action_name + ' 처리 할 상품을 선택해주세요.');
		return false;
	}
}

function openPostingUpdateModal(idx) {
	var tab_num = $('#tab_num').val();
	
	switch (tab_num) {
		case "01" :
			modal('/collection/put', 'idx='+idx);
			break;
		
		case "02" :
			modal('/editorial/put', 'idx='+idx);
			break;
		
		case "03" :
			modal('/collaboration/put', 'idx='+idx);
			break;
		
		case "04" :
			modal('/exhibition/put', 'idx='+idx);
			break;
	}
}
</script>