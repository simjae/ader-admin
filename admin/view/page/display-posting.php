<style>
.edit_page_btn {font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;}

.select_copy {width:150px;height:30px;border:1px solid #bfbfbf;border-radius:5px;float:right;margin-right:10px;}
.save_font {font-size:12px;font-family:'NanumSquareRound',sans-serif;line-height:2.8;float:right;margin-right:10px;}
</style>

<?php include_once("check.php"); ?>

<?php
function getUrlParamter($url, $sch_tag)
{
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query[$sch_tag];
}
$page_url = $_SERVER['REQUEST_URI'];
$posting_type = getUrlParamter($page_url, 'posting_type');
?>
<input type="hidden" id="posting_type" value=<?=$posting_type?>>
<div class="filter-wrap" style="margin-bottom:20px;">
	<button class="post_tab_btn tap__button" tab_status="EDTL" style="background-color:#000;color:#fff;font-weight:500;width:180px;" onClick="postTabBtnClick(this);">에디토리얼</button>
	<button class="post_tab_btn tap__button" tab_status="RNWY" style="width:180px;" onClick="postTabBtnClick(this);">런웨이</button>
	<button class="post_tab_btn tap__button" tab_status="COLC" style="width:180px;" onClick="location.href='/display/posting/collection/page';">컬렉션</button>
	<button class="post_tab_btn tap__button" tab_status="COLA" style="width:180px;" onClick="postTabBtnClick(this);">콜라보레이션</button>
</div>

<input id="tab_status" type="hidden" value="EDTL">

<div id="posting_tab_EDTL" class="posting_tab">
	<?php include_once("display-posting-editorial.php"); ?>
</div>

<div id="posting_tab_RNWY" class="posting_tab" style="display:none;">
	<?php include_once("display-posting-runway.php"); ?>
</div>

<div id="posting_tab_COLC" class="posting_tab" style="display:none;">
	<?php //include_once("display-posting-collection.php"); ?>
</div>

<div id="posting_tab_COLA" class="posting_tab" style="display:none;">
	<?php include_once("display-posting-collaboration.php"); ?>
</div>

<script>
$(document).ready(function() {
	let posting_type = $('#posting_type').val();
	if(posting_type != null && posting_type != ''){
		$('.post_tab_btn.tap__button[tab_status=' + posting_type + ']').click();
	}
});

function postTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	
	$('.posting_tab').hide();
	$('#posting_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.post_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.post_tab_btn').not($(obj)).css('color','#000000');
}

function getCheckedPageIdx() {
	let page_idx = [];
	
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let result_table = $('#result_table_' + tab_status + '_' + country);
	
	let checkbox = result_table.find('.select');
	let cnt = checkbox.length;
	
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			page_idx.push(checkbox.eq(i).val());
		}
	}
	
	console.log(page_idx);
	
	return page_idx;
}

function selectAllClick(obj) {
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let result_table = $('#result_table_' + tab_status + '_' + country);
	
	console.log('#result_table_' + tab_status + '_' + country);
	
	if ($(obj).prop('checked') == true) {
		result_table.find('.select').prop('checked',true);
	} else if (result_table.find('.select').prop('checked',false)) {
		result_table.find('.select').prop('checked',false);
	}
}

function orderChange(obj) {
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let frm = $('#frm-list_' + tab_status + '_' + country);
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getPagePostingList(tab_status,country);
}

function rowsChange(obj) {
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let frm = $('#frm-list_' + tab_status + '_' + country);
	
	frm.find('.rows').val($(obj).val());
	
	getPagePostingList(tab_status,country);
}

function setPaging(obj) {
	var tab_status = $(obj).attr('tab_status');
	let country = $(obj).attr('country');
	
	var total_cnt = $(obj).val();
	
	$('#cnt_' + tab_status + '_' + country + '_total').text(total_cnt);
}

function deletePagePosting() {
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let page_idx = getCheckedPageIdx();
	
	console.log(page_idx);
	
	if (page_idx.length > 0) {
		confirm(
			'선택한 게시물 페이지를 삭제하시겠습니까?',
			function() {
				$.ajax({
					type: "post",
					url: config.api + "display/posting/delete",
					data: {
						'posting_type' : tab_status,
						'page_idx' : page_idx
					},
					dataType: "json",
					
					error: function() {
						alert('페이지 삭제 처리에 실패했습니다.');
					},
					success: function(d) {
						if(d.code == 200) {
							getPagePostingList(tab_status,country);
							alert('선택한 게시물 페이지가 삭제되었습니다.');
						} else {
							alert(d.msg);
						}
					}
				});
			}
		)
	} else {
		alert('삭제하려는 게시물 페이지를 선택해주세요.');
		return false;
	}
}

function copyPagePosting() {
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let page_idx = getCheckedPageIdx();
	
	if (page_idx.length > 0) {
		confirm(
			'선택한 게시물 페이지를 복사하시겠습니까?',
			function() {
				$.ajax({
					type: "post",
					url: config.api + "display/posting/put",
					data: {
						'copy_flg' : true,
						'page_idx' : page_idx
					},
					dataType: "json",
					
					error: function() {
						alert('페이지 복사 처리에 실패했습니다.');
					},
					success: function(d) {
						if(d.code == 200) {
							getPagePostingList(tab_status,country);
							alert('선택한 게시물 페이지가 복사되었습니다.');
						} else {
							alert(d.msg);
						}
					}
				});
			}
		)
	}
}

function displayPagePosting(display_flg) {
	let tab_status = $('#tab_status').val();
	let country = $('#country_' + tab_status).val();
	
	let page_idx = getCheckedPageIdx();
	
	if (page_idx.length > 0) {
		confirm(
			'선택한 게시물 페이지의 전시상태를 변경하시겠습니까?',
			function() {
				$.ajax({
					type: "post",
					url: config.api + "display/posting/put",
					data: {
						'display_toggle_flg' : display_flg,
						'page_idx' : page_idx
					},
					dataType: "json",
					
					error: function() {
						alert('페이지 전시/취소 처리에 실패했습니다.');
					},
					success: function(d) {
						if(d.code == 200) {
							getPagePostingList(tab_status,country);
							
							let action_name = "";
							if (display_flg == "TRUE") {
								action_name = "전시";
							} else if (display_flg == "FALSE") {
								action_name = "전시취소";
							}
							alert('선택한 게시물 페이지가 ' + action_name + '되었습니다.');
						} else {
							alert(d.msg);
						}
					}
				});
			}
		)
	}
}

function openPostingUpdateModal(idx) {
	var tab_status = $('#tab_status').val();
	
	switch (tab_status) {
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
		case "05" :
			modal('/lookbook/put', 'idx='+idx);
			break;
	}
}

function getPagePostingList(tab_status,country) {
	let frm = $('#frm-list_' + tab_status + '_' + country);
	
	let result_table = $('#result_table_' + tab_status + '_' + country);
	
	let url = "";
	switch (tab_status) {
		case "EDTL" :
			url = "editorial";
			break;
		
		case "RNWY" :
			url = "runway";
			break;
		
		case "COLC" :
			url = "collection";
			break;
	}
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : frm.find(".paging_" + tab_status + '_' + country),
		html : function(d) {
			result_table.html('');
			
			let strDiv = "";
			if (d != null) {
				d.forEach(function(row) {
					location_url = "";
					if (row.posting_type == "COLA") {
						location_url = "location.href=\'/display/posting/collaboration/page?country=" + row.country + "\';";
					} else {
						location_url = "location.href=\'/display/posting/" + url + "/page?page_idx=" + row.page_idx + "\';";
					}
					
					let country = "";
					switch (row.country) {
						case "KR" :
							country = "한국몰";
							break;
						
						case "EN" :
							country = "영문몰";
							break;
						
						case "CN" :
							country = "중문몰";
							break;
					}
					
					let display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
					
					strDiv += '<TR>';
					strDiv += '    <TD>';
					strDiv += '        <div class="cb__color">';
					strDiv += '            <label style="display: block;">';
					strDiv += '                <input class="select" type="checkbox" name="page_idx[]" value="' + row.page_idx + '" >';
					strDiv += '                <span></span>';
					strDiv += '            </label>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.num + '</TD>';
					strDiv += '    <TD style="text-align:center;">';
					strDiv += '        <button class="edit_page_btn" type="button" onClick="openPostingUpdateModal(' + row.page_idx + ')">페이지편집</button>';
					strDiv += '    </TD>';
					strDiv += '    <TD style="text-align:center;">';
					strDiv += '        <button class="edit_page_btn" type="button" onClick="' + location_url + '">게시물진열</button>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.display_status + '</TD>';
					strDiv += '    <TD>' + display_date + '</TD>';
					strDiv += '    <TD><font style="cursor:pointer;">' + row.page_title + '</font></TD>';
					strDiv += '    <TD>' + country + '</TD>';
					strDiv += '    <TD>' + row.page_url + '</TD>';
					strDiv += '    <TD>' + row.page_memo + '</TD>';
					strDiv += '    <TD>' + row.page_view + '</TD>';
					strDiv += '    <TD>' + row.create_date + '</TD>';
					strDiv += '    <TD>' + row.update_date + '</TD>';
					strDiv += '</TR>';
				});
			} else {
				strDiv += '<TD class="default_td" colspan="12" style="text-align:left;">';
				strDiv += '    조회 결과가 없습니다';
				strDiv += '</TD>';
			}
			
			result_table.append(strDiv);
		}
	},rows,page);
}

function openPostingUpdateModal(page_idx) {
	modal('/put','page_idx=' + page_idx);
}

</script>