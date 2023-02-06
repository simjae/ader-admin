<style>
.registStoryBtn{
	width:120px;height:30px;border:1px solid #000000;background-color:#ffffff;color:#000000;margin-right:10px;
	cursor:pointer;
}
.story__left__area{
	float:left; width: 30%
}
.story__right__area{
	float:left; width: 70%
}
.story__contents{
	margin-top:20px;margin-left:0px
}
.new__container{
    display:grid;grid-template-columns: 33% 33% 33%
}
.new__img {
	width:100px;height:100px;background-repeat:no-repeat;background-size:cover;background-position: center;
}
.story__title{
	margin-top:10px;font-size:10px
}
.story__row{
	margin-top:15px;;font-size:11px
}
.story_list {
	display:flex;margin-bottom:5px;
}
.story_title {
	width:90%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
	cursor:pointer;
}
.new_story_title {
	width:100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
}
.new_story_sub_title {
	width:80%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
}
.archive__left__area{
	float:left; width: 33%
}
.archive__center__area{
	float:left; width: 33%
}
.archive__right__area{
	float:left; width: 33%
}
.row__font{
	margin-top:5px;height:18px
}
.story_memo {
	width: 100%;height: 150px;border: solid 1px #bfbfbf;padding: 14px;
}
.new__item {
	cursor:pointer;
}
.save_story_btn {
	width:100px;height:30px;background-color:#000000;color:#ffffff;border:1px solid #bfbfbf;float:right;padding:5px;text-align:center;
	cursor:pointer;
}
</style>

<div class="filter-wrap" style="margin-bottom:20px">
	<button class="story_tab_btn tap__button" tab_num="kr" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="storyTabBtnClick(this);">한국몰</button>
	<button class="story_tab_btn tap__button" tab_num="en" style="width:150px;" onClick="storyTabBtnClick(this);">영문몰</button>
	<button class="story_tab_btn tap__button" tab_num="cn" style="width:150px;" onClick="storyTabBtnClick(this);">중국몰</button>
	</div>

<input id="tab_num" type="hidden" value="01">

<div id="story_tab_kr" class="row story_tab" style="margin-top:0px;">
	<?php include_once("display-posting-story-kr.php"); ?>
</div>

<div id="story_tab_en" class="row story_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-posting-story-en.php"); ?>
</div>

<div id="story_tab_cn" class="row story_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-posting-story-cn.php"); ?>
</div>

<script>
function storyTabBtnClick(obj) {
	var tab_num = $(obj).attr('tab_num');
	$('#tab_num').val(tab_num);
	$('.story_tab').hide();
	$('#story_tab_' + tab_num).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.story_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.story_tab_btn').not($(obj)).css('color','#000000');
}

function resetPostingStory(action,country) {
	let frm_id = "frm-" + action + "_" + country;
	$('#' + frm_id).find('.story_column').val(0);
	$('#' + frm_id).find('.story_title').val('');
	$('#' + frm_id).find('.story_memo').val('');
	$('#' + frm_id).find('.active_flg_false').prop('checked',true);
	$('#' + frm_id).find('.active_flg_true').prop('checked',false);
	$('#' + frm_id).find('.page_idx').val(0);
	
	let strDiv = "";
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="12" style="text-align:left;">';
	strDiv += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$('#result_table_' + action + '_' + country).html(strDiv);
}

function showPostingStory(country,story_column) {
	let frm_id = "frm-add_" + country;
	
	resetPostingStory('add',country);
	
	$('.content_frm_' + country).hide();
	$('#' + frm_id).find('.story_column').val(story_column);
	$('#' + frm_id).parent().show();
}

function hidePostingStory(action,country) {
	resetPostingStory(action,country);
	$('.content_frm_' + country).hide();
}

function getPostingStory(obj) {
	let country = $(obj).attr('country');
	let frm_id = "frm-put_" + country;
	
	$('.content_frm_' + country).hide();
	$('#' + frm_id).parent().show();
	
	resetPostingStory("put",country);
	
	let story_idx = $(obj).attr('story_idx');
	let story_type = $(obj).attr('story_type');
	
	let story_title = $('#' + frm_id).find('.story_title');
	let story_memo = $('#' + frm_id).find('.story_memo');
	let img_location = $('#' + frm_id).find('.img_location');
	let active_flg_true = $('#' + frm_id).find('#put_active_flg_true');
	let active_flg_false = $('#' + frm_id).find('#put_active_flg_false');
	let page_idx = $('#' + frm_id).find('.page_idx');
	
	$.ajax({
		url: config.api + "display/posting/story/get",
		type: "post",
		data: {
			'story_idx': story_idx
		},
		dataType: "json",
		error: function() {
			alert('스토리 개별 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				if (data != null) {
					let result_table = $('#result_table_put' + country);
					if (story_type == "new") {
						$('#' + frm_id).find('.div_img_location').show();
					} else {
						$('#' + frm_id).find('.div_img_location').hide();
					}
					
					$('#' + frm_id).find('.story_idx').val(story_idx);
					
					let dec_story_title = xssDecode(data[0].story_title);
					let dec_story_memo = xssDecode(data[0].story_memo);
					
					story_title.val(dec_story_title);
					story_memo.val(dec_story_memo);
					img_location.val(data[0].img_location);
					
					if (data[0].active_flg == true) {
						active_flg_true.prop('checked',true);
						active_flg_false.prop('checked',false);
					} else {
						active_flg_true.prop('checked',false);
						active_flg_false.prop('checked',true);
					}
					
					if (data[0].page_idx != 0) {
						let dec_page_title = xssDecode(data[0].page_title);
						let dec_page_memo = xssDecode(data[0].page_memo);
						
						let strDiv = "";
						strDiv += '<TR>';
						strDiv += '    <TD>';
						strDiv += '        <div class="btn" onClick="deletePostingPage(this);">';
						strDiv += '            게시물 변경';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						strDiv += '    <TD>' + data[0].posting_type + '</TD>';
						strDiv += '    <TD>' + dec_page_title + '</TD>';
						strDiv += '    <TD>' + dec_page_memo + '</TD>';
						strDiv += '    <TD>' + data[0].page_url + '</TD>';
						strDiv += '    <TD>' + data[0].display_status + '</TD>';
						strDiv += '    <TD>' + data[0].display_start_date + ' ~ ' + data[0].display_end_date + '</TD>';
						strDiv += '    <TD>' + data[0].page_view + '</TD>';
						strDiv += '    <TD>' + data[0].create_date + '</TD>';
						strDiv += '    <TD>' + data[0].creater + '</TD>';
						strDiv += '    <TD>' + data[0].update_date + '</TD>';
						strDiv += '    <TD>' + data[0].updater + '</TD>';
						strDiv += '</TR>';
						
						result_table.html(strDiv);
					} else {
						let strDiv = "";
						strDiv += '<TR>';
						strDiv += '    <TD class="default_td" colspan="12" style="text-align:left;">';
						strDiv += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
						strDiv += '    </TD>';
						strDiv += '</TR>';
						
						result_table.html(strDiv);
					}
				}
			} else {
				alert('스토리 개별 조회처리에 실패했습니다. 조회하려는 스토리를 확인해주세요.');
			}
		}
	});
}

function getPostingStoryList(country) {
	$.ajax({
		url: config.api + "display/posting/story/list/get",
		type: "post",
		data: {
			'country': country
		},
		dataType: "json",
		error: function() {
			alert('게시물 스토리 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				
				let column_01_new = data[0].column_01_new;
				let column_02_prj = data[0].column_02_prj;
				let column_03_lkb = data[0].column_03_lkb;
				let column_04_edt = data[0].column_04_edt;
				
				if (column_01_new != null) {
					let strDiv = "";
					
					column_01_new.forEach(function(row) {
						$('.new_item_' + country).eq(0).remove();
						
						strDiv += '<div class="new__item new_item_' + country + ' story_list_new_' + country + '">';
						
						let background_url = "background-image:url('" + row.img_location + "');";
						
						strDiv += '    <div class="new__img" style="' + background_url + '" story_idx="' + row.story_idx + '" story_type="new" country="' + country + '" onClick="getPostingStory(this);"></div>';
						strDiv += '    <div class="story__title">';
						strDiv += '        <p class="new_story_title">' + row.story_title + '</p>';
						strDiv += '    </div>';
						strDiv += '    <div class="story__row">';
						strDiv += '        <p class="new_story_sub_title">' + row.story_sub_title + '</p>';
						strDiv += '    </div>';
						
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="new" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="up">';
						strDiv += '        <i class="xi-angle-left"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="new" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="down">';
						strDiv += '        <i class="xi-angle-right"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn remove_story_btn" style="text-align:center;width:60px;" onClick="deletePostingStory(\'' + country + '\',' + row.story_column + ',' + row.story_idx + ')">삭제</div>';
						
						strDiv += '</div>';
					});
					
					$('.new_container_' + country).prepend(strDiv);
				}
				
				if (column_02_prj != null) {
					let strDiv = "";
					
					column_02_prj.forEach(function(row) {
						$('.story_list_prj_' + country).eq(0).remove();
						
						strDiv += '<div class="story_list story_list_prj_' + country + '">';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="prj" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="up">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="prj" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="down">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <p class="row__font story_title" country="' + country + '" story_idx="' + row.story_idx + '" onClick="getPostingStory(this);">' + row.story_title + '</p>';
						strDiv += '    <div class="btn remove_story_btn" style="text-align:center;width:60px;" onClick="deletePostingStory(\'' + country + '\',' + row.story_column + ',' + row.story_idx + ')">삭제</div>';
						strDiv += '</div>';
					});
					
					$('.story_prj_container_' + country).prepend(strDiv);
				}				
				
				if (column_03_lkb != null) {
					let strDiv = "";
					
					column_03_lkb.forEach(function(row) {
						$('.story_list_lkb_' + country).eq(0).remove();
						
						strDiv += '<div class="story_list story_list_lkb_' + country + '">';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="lkb" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="up">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="lkb" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="down">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <p class="row__font story_title" country="' + country + '" story_idx="' + row.story_idx + '" onClick="getPostingStory(this)">' + row.story_title + '</p>';
						strDiv += '    <div class="btn remove_story_btn" style="text-align:center;width:60px;" onClick="deletePostingStory(\'' + country + '\',' + row.story_column + ',' + row.story_idx + ')">삭제</div>';
						strDiv += '</div>';
					});
					
					$('.story_lkb_container_' + country).prepend(strDiv);
				}
				
				if (column_04_edt != null) {
					let strDiv = "";
					
					column_04_edt.forEach(function(row) {
						$('.story_list_edt_' + country).eq(0).remove();
						
						strDiv += '<div class="story_list story_list_edt_' + country + '">';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="edt" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="up">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn" onclick="displayNumCheck(this)" style="margin-right:5px;" story_type="edt" country="' + country + '" story_column="' + row.story_column + '" recent_idx="' + row.story_idx + '" recent_num="' + row.display_num + '" action_type="down">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <p class="row__font story_title" country="' + country + '" story_idx="' + row.story_idx + '" onClick="getPostingStory(this);">' + row.story_title + '</p>';
						strDiv += '    <div class="btn remove_story_btn" style="text-align:center;width:60px;" onClick="deletePostingStory(\'' + country + '\',' + row.story_column + ',' + row.story_idx + ')">삭제</div>';
						strDiv += '</div>';
					});
					
					$('.story_edt_container_' + country).prepend(strDiv);
				}
			}
		}
	});
}

function displayNumCheck(obj) {
	let story_type = $(obj).attr('story_type');
	let country = $(obj).attr('country');
	let story_column = $(obj).attr('story_column');
	let action_type = $(obj).attr('action_type');
	let recent_idx = $(obj).attr('recent_idx');
	let recent_num = $(obj).attr('recent_num');
	
	let check_obj = $('.story_list_' + story_type + '_' + country);
	let cnt = check_obj.length;
	
	if (action_type == "up") {
		if (recent_num == 1) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(country,story_column,action_type,recent_idx,recent_num);
		}
	} else if (action_type == "down") {
		if (recent_num == cnt) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(country,story_column,action_type,recent_idx,recent_num);
		}
	}
}

function updateDisplayNum(country,story_column,action_type,recent_idx,recent_num) {
	$.ajax({
		url: config.api + "display/posting/story/put",
		type: "post",
		data: {
			'display_flg': true,
			'country': country,
			'story_column': story_column,
			'action_type': action_type,
			'recent_idx': recent_idx,
			'recent_num': recent_num
		},
		dataType: "json",
		error: function() {
			alert('게시물 스토리 진열순서 변경처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				getPostingStoryList(country);
			} else {
				alert('진열순서 변경 처리에 실패했습니다. 변경하려는 게시물 스토리의 진열순서를 확인해주세요.');
			}
		}
	});
}

function checkPostingStory(action,country) {
	let frm_id = "frm-" + action + "_" + country;
	
	let story_title = $('#' + frm_id).find('.story_title').val();
	
	if (story_title == "" || story_title == null) {
		alert('스토리 타이틀을 입력해주세요.');
		return false;
	}
	
	let story_idx = 0;
	let active_flg = null;
	if (action == "put") {
		putPostingStory(country);
	} else if (action == "add") {
		addPostingStory(country);
	}
}

function addPostingStory(country) {
	let frm_id = "frm-add_" + country;
	var form = $("#" + frm_id)[0];
	var formData = new FormData(form);

	confirm("게시물 스토리를 등록하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/posting/story/add",
			cache: false,
			contentType: false,
			processData: false,
			error: function() {
				alert("게시물 스토리 등록 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("게시물 스토리 등록 처리에 성공했습니다.");
					getPostingStoryList(country);
					
					hidePostingStory('add',country);
				}
			}
		});
	});
}

function putPostingStory(country) {
	let frm_id = "frm-put_" + country;
	console.log(frm_id);
	var form = $("#" + frm_id)[0];
	var formData = new FormData(form);
	
	confirm("게시물 스토리를 수정하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/posting/story/put",
			cache: false,
			contentType: false,
			processData: false,
			error: function() {
				alert("게시물 스토리 수정 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("게시물 스토리 수정 처리에 성공했습니다.");
					getPostingStoryList(country);
					
					hidePostingStory('put',country);
				}
			}
		});
	});
}

function deletePostingStory(country,story_column,story_idx) {
	confirm("게시물 스토리를 삭제하시겠습니까?",function() {
		$.ajax({
			url: config.api + "display/posting/story/delete",
			type: "post",
			data: {
				'country': country,
				'story_column': story_column,
				'story_idx': story_idx
			},
			dataType: "json",
			error: function() {
				alert('게시물 스토리 조회처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				let code = d.code;
				if (code == 200) {
					alert("게시물 스토리 삭제 처리에 성공했습니다.");
					getPostingStoryList(country);
					
					hidePostingStory('put',country);
				}
			}
		});
	});
}

function openPagePostingModal(action,country) {
	modal('/get','param=' + action + '_' + country);
}

function savePostingStory(country) {
	confirm("게시물 스토리를 삭제하시겠습니까?",function() {
		$.ajax({
			url: config.api + "display/posting/story/save/add",
			type: "post",
			data: {
				'country': country
			},
			dataType: "json",
			error: function() {
				alert('게시물 스토리 저장처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				let code = d.code;
				if (code == 200) {
					alert("게시물 스토리 저장 처리에 성공했습니다.");
					getPostingStoryList(country);
					
					hidePostingStory('put',country);
				}
			}
		});
	});
}

function xssDecode(data){
	var decode_str = null;
	if(data != null){
		decode_str = data.replace(/&amp;/g, '&');
		decode_str = decode_str.replace(/&quot;/g, '\"');
		decode_str = decode_str.replace(/&apos;/g, "'");
		decode_str = decode_str.replace(/&lt;/g, '<');
		decode_str = decode_str.replace(/&gt;/g, '>');
		decode_str = decode_str.replace(/<br>/g, '\r');
		decode_str = decode_str.replace(/<p>/g, '\n');
	}
	
	return decode_str;
}
</script>