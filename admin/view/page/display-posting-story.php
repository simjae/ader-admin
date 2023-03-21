<style>
.registStoryBtn{
	width:120px;height:30px;border:1px solid #000000;background-color:#ffffff;color:#000000;margin-right:10px;
	cursor:pointer;
}

.story__left__area{float:left; width: 30%}
.story__right__area{float:left; width: 70%}

.story__contents{margin-top:20px;margin-left:0px}
.new__container{display:grid;grid-template-columns: 33% 33% 33%}
.new__img {width:100px;height:100px;background-repeat:no-repeat;background-size:cover;background-position: center;}
.story__title{margin-top:10px;font-size:10px}
.story__row{margin-top:15px;margin-bottom:10px;font-size:11px;}
.story_list {display:flex;margin-bottom:5px;}
.story_title {
	width:90%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
	cursor:pointer;
}

.display_num_btn{width:30px;height:25px;padding:6px;text-align:center;margin-right:5px;font-size:0.5rem;}
.delete_story_btn {text-align:center;width:50px;margin-right:10px;font-size:0.5rem;}

.new_story_title {width:100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
.new_story_sub_title {width:80%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
.archive__left__area{float:left; width: 33%}
.archive__center__area{float:left; width: 33%}
.archive__right__area{float:left; width: 33%}
.row__font{margin-top:5px;height:18px}
.story_memo {width: 100%;height: 150px;border: solid 1px #bfbfbf;padding: 14px;}
.new__item {
	cursor:pointer;
}
.save_story_btn {
	width:100px;height:30px;background-color:#000000;color:#ffffff;border:1px solid #bfbfbf;float:right;padding:5px;text-align:center;
	cursor:pointer;
}

.country_copy {width:150px;height:30px;border:1px solid #bfbfbf;border-radius:5px;float:right;margin-right:10px;}
.save_font {font-size:12px;font-family:'NanumSquareRound',sans-serif;line-height:2.8;float:right;margin-right:10px;}

</style>

<?php include_once("check.php"); ?>

<div class="filter-wrap" style="width:100%;margin-bottom:20px;display:flex;">
	<div style="width:50%;">
		<button class="story_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="storyTabBtnClick(this);">한국몰</button>
		<button class="story_tab_btn tap__button" country="EN" style="width:150px;" onClick="storyTabBtnClick(this);">영문몰</button>
		<button class="story_tab_btn tap__button" country="CN" style="width:150px;" onClick="storyTabBtnClick(this);">중국몰</button>
	</div>
		
	<div style="width:50%;">
		<div class="btn" style="float:right;" onClick="copyPostingStory();">복사</div>				
		
		<font class="save_font">로 복사</font>
		
		<select id="country_to" class="country_copy">
			<option value="KR">한국몰</option>
			<option value="EN">영문몰</option>
			<option value="CN">중문몰</option>
		</select>
		
		<font class="save_font">데이터를</font>
		
		<select id="country_from" class="country_copy" style="">
			<option value="KR">한국몰</option>
			<option value="EN">영문몰</option>
			<option value="CN">중문몰</option>
		</select>
	</div>
</div>

<input id="country" type="hidden" value="KR">

<div id="story_tab_KR" class="row story_tab" style="margin-top:0px;">
	<?php include_once("display-posting-story-kr.php"); ?>
</div>

<div id="story_tab_EN" class="row story_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-posting-story-en.php"); ?>
</div>

<div id="story_tab_CN" class="row story_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-posting-story-cn.php"); ?>
</div>

<script>
function storyTabBtnClick(obj) {
	let country = $(obj).attr('country');
	$('#country').val(country);
	
	$('.story_tab').hide();
	$('#story_tab_' + country).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.story_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.story_tab_btn').not($(obj)).css('color','#000000');
}

function resetPostingStoryList(country) {
	let str_div_new  = "";
	for (let i=1; i<=3; i++) {
		str_div_new += '<div class="new__item new_item_' + country + '" onClick="showPostingStory(\'' + country + '\',\'NEW\')">';
		str_div_new += '    <img src="/images/default_thumbnail_img.jpg" class="new__img">';
		str_div_new += '    <div class="story__title">';
		str_div_new += '        <p class="new_story_title">새로운 소식 타이틀 ' + i + '</p>';
		str_div_new += '    </div>';
		str_div_new += '    <div class="story__row">';
		str_div_new += '        <p class="new_story_sub_title">새로운 소식 서브 타이틀 ' + i + '</p>';
		str_div_new += '    </div>';
		str_div_new += '</div>';
	}
	$('.story_NEW_container_' + country).html('');
	$('.story_NEW_container_' + country).prepend(str_div_new);

	let str_div_colc = "";
	for (let i=1; i<=4; i++) {
		str_div_colc += '<div class="story_list story_list_COLC_' + country + '" onClick="showPostingStory(\'' + country + '\',\'COLC\')">';
		str_div_colc += '    <div class="btn display_num_btn">';
		str_div_colc += '        <i class="xi-angle-up"></i>';
		str_div_colc += '        <span class="tooltip top">위로</span>';
		str_div_colc += '    </div>';
		str_div_colc += '    <div class="btn display_num_btn">';
		str_div_colc += '        <i class="xi-angle-down"></i>';
		str_div_colc += '        <span class="tooltip top">아래로</span>';
		str_div_colc += '    </div>';
		str_div_colc += '    <p class="row__font story_title">컬렉션 타이틀 ' + i + '</p>';
		str_div_colc += '    ';
		str_div_colc += '    <div class="btn delete_story_btn">삭제</div>';
		str_div_colc += '</div>';
	}
	$('.story_COLC_container_' + country).html('');
	$('.story_COLC_container_' + country).prepend(str_div_colc);

	let str_div_rnwy = "";
	for (let i=1; i<=4; i++) {
		str_div_rnwy += '<div class="story_list story_list_RNWY_' + country + '" onClick="showPostingStory(\'' + country + '\',\'RNWY\');">';
		str_div_rnwy += '    <div class="btn display_num_btn">';
		str_div_rnwy += '        <i class="xi-angle-up"></i>';
		str_div_rnwy += '        <span class="tooltip top">위로</span>';
		str_div_rnwy += '    </div>';
		str_div_rnwy += '    <div class="btn display_num_btn">';
		str_div_rnwy += '        <i class="xi-angle-down"></i>';
		str_div_rnwy += '        <span class="tooltip top">아래로</span>';
		str_div_rnwy += '    </div>';
		str_div_rnwy += '    <p class="row__font story_title">런웨이 타이틀 ' + i + '</p>';
		str_div_rnwy += '    ';
		str_div_rnwy += '    <div class="btn delete_story_btn">삭제</div>';
		str_div_rnwy += '</div>';
	}
	$('.story_RNWY_container_' + country).html('');
	$('.story_RNWY_container_' + country).prepend(str_div_rnwy);

	let str_div_edtl = "";
	for (let i=1; i<=4; i++) {
		str_div_edtl += '<div class="story_list story_list_EDTL_' + country + '" onClick="showPostingStory(\'' + country + '\',\'EDTL\');">';
		str_div_edtl += '    <div class="btn display_num_btn">';
		str_div_edtl += '        <i class="xi-angle-up"></i>';
		str_div_edtl += '        <span class="tooltip top">위로</span>';
		str_div_edtl += '    </div>';
		str_div_edtl += '    <div class="btn display_num_btn">';
		str_div_edtl += '        <i class="xi-angle-down"></i>';
		str_div_edtl += '        <span class="tooltip top">아래로</span>';
		str_div_edtl += '    </div>';
		str_div_edtl += '    <p class="row__font story_title">에디토리얼 타이틀 ' + i + '</p>';
		str_div_edtl += '    ';
		str_div_edtl += '    <div class="btn delete_story_btn">삭제</div>';
		str_div_edtl += '</div>';
	}
	$('.story_EDTL_container_' + country).html('');
	$('.story_EDTL_container_' + country).prepend(str_div_edtl);
}

function resetPostingStory(action,country) {
	let frm = $('#frm-' + action + '_' + country);
	frm.find('.story_type').val('');
	frm.find('.story_title').val('');
	frm.find('.story_sub_title').val('');
	frm.find('.story_memo').val('');
	frm.find('.page_idx').val(0);
	
	let result_table_page = $('#result_table_' + action + '_page_' + country);
	
	let str_div_page = "";
	str_div_page += '<TR>';
	str_div_page += '    <TD colspan="12" style="text-align:left;">';
	str_div_page += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
	str_div_page += '    </TD>';
	str_div_page += '</TR>';
	
	result_table_page.html(str_div_page);
	
	let result_table_project = $('#result_table_' + action + '_project_' + country);
	
	let str_div_project = "";
	str_div_project += '<TR>';
	str_div_project += '    <TD colspan="8" style="text-align:left;">';
	str_div_project += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
	str_div_project += '    </TD>';
	str_div_project += '</TR>';
	
	result_table_project.html(str_div_project);
}

function showPostingStory(country,story_type) {
	$('.content_frm_' + country).hide();
	
	resetPostingStory('add',country);
	
	let frm = $('#frm-add_' + country)
	frm.find('.story_type').val(story_type);
	frm.parent().show();
	
	if (story_type != "COLC") {
		frm.find('.div_table_page_' + country).show();
		frm.find('.div_table_project_' + country).hide();
		
		if (story_type == "NEW") {
			frm.find('.div_story_sub_title').show();
			frm.find('.div_img_location').show();
		} else {
			frm.find('.div_story_sub_title').hide();
			frm.find('.div_img_location').hide();
		}
	} else {
		frm.find('.div_table_page_' + country).hide();
		frm.find('.div_table_project_' + country).show();
	}
}

function hidePostingStory(action,country) {
	resetPostingStory(action,country);
	$('.content_frm_' + country).hide();
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
				let data = d.data[0];
				
				let column_NEW = data.column_NEW;
				let column_COLC = data.column_COLC;
				let column_RNWY = data.column_RNWY;
				let column_EDTL = data.column_EDTL;
				
				if (column_NEW != null) {
					let strDiv = "";
					
					column_NEW.forEach(function(row) {
						$('.new_item_' + country).eq(0).remove();
						
						strDiv += '<div class="new__item new_item_' + country + ' story_list_NEW_' + country + '">';
						
						let background_url = "background-image:url('" + row.img_location + "');";
						
						strDiv += '    <div class="new__img" style="' + background_url + '" onClick="getPostingStory(\'' + country + '\',\'NEW\',' + row.story_idx + ');"></div>';
						strDiv += '    <div class="story__title">';
						strDiv += '        <p class="new_story_title">' + row.story_title + '</p>';
						strDiv += '    </div>';
						strDiv += '    <div class="story__row">';
						strDiv += '        <p class="new_story_sub_title">' + row.story_sub_title + '</p>';
						strDiv += '    </div>';
						
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'NEW\',' + row.story_idx + ',' + row.display_num + ',\'up\')">';
						strDiv += '        <i class="xi-angle-left"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'NEW\',' + row.story_idx + ',' + row.display_num + ',\'down\')">';
						strDiv += '        <i class="xi-angle-right"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn delete_story_btn" onClick="deletePostingStory(\'' + country + '\',\'NEW\',' + row.story_idx + ')">삭제</div>';
						
						strDiv += '</div>';
					});
					
					$('.story_NEW_container_' + country).prepend(strDiv);
				}
				
				if (column_COLC != null) {
					let strDiv = "";
					
					column_COLC.forEach(function(row) {
						$('.story_list_COLC_' + country).eq(0).remove();
						
						strDiv += '<div class="story_list story_list_PRJ_' + country + '">';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'COLC\',' + row.story_idx + ',' + row.display_num + ',\'up\')">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'COLC\',' + row.story_idx + ',' + row.display_num + ',\'down\')">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <p class="row__font story_title" onClick="getPostingStory(\'' + country + '\',\'COLC\',' + row.story_idx + ');">' + row.story_title + '</p>';
						strDiv += '    <div class="btn delete_story_btn" onClick="deletePostingStory(\'' + country + '\',\'COLC\',' + row.story_idx + ')">삭제</div>';
						strDiv += '</div>';
					});
					
					$('.story_COLC_container_' + country).prepend(strDiv);
				}				
				
				if (column_RNWY != null) {
					let strDiv = "";
					
					column_RNWY.forEach(function(row) {
						$('.story_list_RNWY_' + country).eq(0).remove();
						
						strDiv += '<div class="story_list story_list_CLT_' + country + '">';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'RNWY\',' + row.story_idx + ',' + row.display_num + ',\'up\')">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'RNWY\',' + row.story_idx + ',' + row.display_num + ',\'down\')">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <p class="row__font story_title" onClick="getPostingStory(\'' + country + '\',\'RNWY\',' + row.story_idx + ')">' + row.story_title + '</p>';
						strDiv += '    <div class="btn delete_story_btn" onClick="deletePostingStory(\'' + country + '\',\'RNWY\',' + row.story_idx + ')">삭제</div>';
						strDiv += '</div>';
					});
					
					$('.story_RNWY_container_' + country).prepend(strDiv);
				}
				
				if (column_EDTL != null) {
					let strDiv = "";
					
					column_EDTL.forEach(function(row) {
						$('.story_list_EDTL_' + country).eq(0).remove();
						
						strDiv += '<div class="story_list story_list_EDT_' + country + '">';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'EDTL\',' + row.story_idx + ',' + row.display_num + ',\'up\')">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn display_num_btn" onclick="displayNumCheck(\'' + country + '\',\'EDTL\',' + row.story_idx + ',' + row.display_num + ',\'down\')">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '    <p class="row__font story_title" onClick="getPostingStory(\'' + country + '\',\'EDTL\',' + row.story_idx + ');">' + row.story_title + '</p>';
						strDiv += '    <div class="btn delete_story_btn" onClick="deletePostingStory(\'' + country + '\',\'EDTL\',' + row.story_idx + ')">삭제</div>';
						strDiv += '</div>';
					});
					
					$('.story_EDTL_container_' + country).prepend(strDiv);
				}
			}
		}
	});
}

function getPostingStory(country,story_type,story_idx) {
	$('.content_frm_' + country).hide();
	
	let frm = $("#frm-put_" + country);
	frm.parent().show();
	
	resetPostingStory("put",country);
	
	let story_title = frm.find('.story_title');
	let story_sub_title = frm.find('.story_sub_title');
	let story_memo = frm.find('.story_memo');
	let img_location = frm.find('.img_location');
	
	let page_idx = frm.find('.page_idx');
	
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
				let data = d.data[0];
				if (data != null) {
					frm.find('.story_idx').val(story_idx);
					
					let story_type = data.story_type;
					
					frm.find('.story_type').val(data.story_type);
					frm.find('.page_idx').val(data.page_idx);
					
					let dec_story_title = xssDecode(data.story_title);
					let dec_story_sub_title = xssDecode(data.story_sub_title);
					let dec_story_memo = xssDecode(data.story_memo);
					
					story_title.val(dec_story_title);
					story_sub_title.val(dec_story_sub_title);
					story_memo.val(dec_story_memo);
					img_location.val(data.img_location);
					
					let result_table = null;
					
					let strDiv = "";
					
					if (story_type != "COLC") {
						if (story_type == "NEW") {
							frm.find('.div_story_sub_title').show();
							frm.find('.div_img_location').show();
						} else {
							frm.find('.div_story_sub_title').hide();
							frm.find('.div_img_location').hide();
						}
						
						result_table = $('#result_table_put_page_' + country);
						
						frm.find('.div_table_project_' + country).hide();
						frm.find('.div_table_page_' + country).show();
						
						let page_info = data.page_info;
						
						if (page_info != "" && page_info != null) {
							strDiv += '<TR>';
							strDiv += '    <TD>' + page_info.txt_posting_type + '</TD>';
							strDiv += '    <TD>' + page_info.page_title + '</TD>';
							strDiv += '    <TD>' + page_info.page_memo + '</TD>';
							strDiv += '    <TD>' + page_info.page_title + '</TD>';
							strDiv += '    <TD>' + page_info.page_url + '</TD>';
							strDiv += '    <TD>' + page_info.display_status + '</TD>';
							strDiv += '    <TD>' + page_info.display_date + '</TD>';
							strDiv += '    <TD>' + page_info.page_view + '</TD>';
							strDiv += '    <TD>' + page_info.create_date + '</TD>';
							strDiv += '    <TD>' + page_info.creater+ '</TD>';
							strDiv += '    <TD>' + page_info.update_date+ '</TD>';
							strDiv += '    <TD>' + page_info.updater+ '</TD>';
							strDiv += '</TR>';
						} else {
							strDiv += '<TR>';
							strDiv += '    <TD colspan="12" style="text-align:left;">';
							strDiv += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
							strDiv += '    </TD>';
							strDiv += '</TR>';
						}
					} else {
						frm.find('.div_story_sub_title').hide();
						frm.find('.div_img_location').hide();
						
						result_table = $('#result_table_put_project_' + country);
						
						frm.find('.div_table_project_' + country).show();
						frm.find('.div_table_page_' + country).hide();
						
						let collection_info = data.collection_info;
						
						if (collection_info != "" && collection_info != null) {
							strDiv += '<TR>';
							strDiv += '    <TD>' + collection_info.project_name + '</TD>';
							strDiv += '    <TD>' + collection_info.project_desc + '</TD>';
							strDiv += '    <TD>' + collection_info.project_title + '</TD>';
							strDiv += '    <TD>' + collection_info.project_url + '</TD>';
							strDiv += '    <TD>' + collection_info.create_date + '</TD>';
							strDiv += '    <TD>' + collection_info.creater + '</TD>';
							strDiv += '    <TD>' + collection_info.update_date + '</TD>';
							strDiv += '    <TD>' + collection_info.updater + '</TD>';
							strDiv += '</TR>';
						} else {
							strDiv += '<TR>';
							strDiv += '    <TD colspan="8" style="text-align:left;">';
							strDiv += '        선택된 컬렉션이 없습니다. 컬렉션을 선택해주세요.';
							strDiv += '    </TD>';
							strDiv += '</TR>';
						}
					}
					
					result_table.html('');
					result_table.append(strDiv);
				}
			} else {
				alert('스토리 개별 조회처리에 실패했습니다. 조회하려는 스토리를 확인해주세요.');
			}
		}
	});
}

function displayNumCheck(country,story_type,recent_idx,recent_num,action_type) {
	let check_obj = $('.story_list_' + story_type + '_' + country);
	let cnt = check_obj.length;
	
	if (action_type == "up") {
		if (recent_num == 1) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(country,story_type,action_type,recent_idx,recent_num);
		}
	} else if (action_type == "down") {
		if (recent_num == 4) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(country,story_type,action_type,recent_idx,recent_num);
		}
	}
}

function updateDisplayNum(country,story_type,action_type,recent_idx,recent_num) {
	$.ajax({
		url: config.api + "display/posting/story/put",
		type: "post",
		data: {
			'display_num_flg': true,
			'country': country,
			'story_type': story_type,
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
				resetPostingStoryList(country);
				getPostingStoryList(country);
			} else {
				alert('진열순서 변경 처리에 실패했습니다. 변경하려는 게시물 스토리의 진열순서를 확인해주세요.');
			}
		}
	});
}

function checkPostingStory(action,country) {
	let frm = $("#frm-" + action + "_" + country);
	let story_type = frm.find('.story_type').val();
	
	let story_title = frm.find('.story_title').val();
	if (story_title == "" || story_title == null) {
		alert('스토리 타이틀을 입력해주세요.');
		return false;
	}
	
	if (story_type == "NEW") {
		let story_sub_title = frm.find('.story_sub_title').val();
		if (story_sub_title == "" || story_sub_title == null) {
			alert('스토리 서브 타이틀을 입력해주세요.');
			return false;
		}
		
		let img_location = frm.find('.img_location').val();
		if (img_location == "" || img_location == null) {
			alert('스토리 썸네일을 입력해주세요.');
			return false;
		}
	}
	
	if (action == "put") {
		putPostingStory(country);
	} else if (action == "add") {
		addPostingStory(country);
	}
}

function addPostingStory(country) {
	let frm = $("#frm-add_" + country);
	var form = frm[0];
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
					resetPostingStoryList(country)
					getPostingStoryList(country);
					
					hidePostingStory('add',country);
					
					alert("게시물 스토리 등록되었습니다.");
				}
			}
		});
	});
}

function putPostingStory(country) {
	let frm = $("#frm-put_" + country);
	var form = frm[0];
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
					resetPostingStoryList(country)
					getPostingStoryList(country);
					
					hidePostingStory('put',country);
					
					alert("선택한 게시물 스토리가 수정되었습니다.");
				}
			}
		});
	});
}

function deletePostingStory(country,story_type,story_idx) {
	console.log(story_type+' '+story_idx);
	confirm(
		"게시물 스토리를 삭제하시겠습니까?",
		function() {
			$.ajax({
				url: config.api + "display/posting/story/delete",
				type: "post",
				data: {
					'country': country,
					'story_type': story_type,
					'story_idx': story_idx
				},
				dataType: "json",
				error: function() {
					alert('게시물 스토리 조회처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					let code = d.code;
					if (code == 200) {
						resetPostingStoryList(country);
						getPostingStoryList(country);
						
						hidePostingStory('put',country);
						
						alert("선택한 게시물 스토리가 삭제되었습니다.");
					}
				}
			});
		}
	);
}

function openRelativePageModal(action,country) {
	let frm = $('#frm-' + action + '_' + country);
	let story_type = frm.find('.story_type').val();
	
	if (story_type != "COLC") {
		modal('/page_get','param=' + action + '_' + country + '_' + story_type);
	} else {
		modal('/project_get','param=' + action + '_' + country + '_' + story_type);
	}
}

function savePostingStory(country) {
	confirm("게시물 스토리를 저장하시겠습니까? 저장하는 정보는 프론트 페이지에 반영됩니다.",function() {
		$.ajax({
			type: "post",
			url: config.api + "display/posting/story/save/add",
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
					resetPostingStoryList(country);
					getPostingStoryList(country);
					
					hidePostingStory('put',country);
					hidePostingStory('add',country);
					
					alert("게시물 스토리 저장 처리에 성공했습니다.");
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

function setPaging(obj) {
	let paging_type = $(obj).attr('paging_type');
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_' + paging_type + '_total').text(total_cnt.val());
	$('.cnt_' + paging_type + '_result').text(result_cnt.val());
}

function copyPostingStory() {
	let country_from = $('#country_from').val();
	let country_to = $('#country_to').val();
	
	if (country_from == country_to) {
		alert('동일한 국가로 복사할 수 없습니다.');
		return false;
	}
	
	confirm(
		'게시물 스토리를 복사하시겠습니까? 기존에 작성된 스토리 정보는 전부 삭제됩니다.',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "display/posting/story/save/copy",
				data: {
					'country_from': country_from,
					'country_to': country_to
				},
				dataType: "json",
				error: function() {
					alert('게시물 스토리 복사처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						getPostingStoryList(country_to);
						closeLoadingWithMask();
						
						alert("게시물 스토리가 복사되었습니다.");
					}
				}
			});
		}
	)
}


function loadingWithMask(gif) {
	var maskHeight = $(document).height();
	var maskWidth  = window.document.body.clientWidth;
	var top = 0;
	var left = 0;

	top = ( $(window).height()) / 2 + $(window).scrollTop();
	left = ( $(window).width()) / 2 + $(window).scrollLeft();

	//화면에 출력할 마스크를 설정해줍니다.
	var mask	   = "<div id='mask_loading' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
	
	let strDiv = "";
	strDiv += '<div id="loading_img">';
	strDiv += '	<img src="' + gif + '" style="width:75px; height:75px;"/>';
	strDiv += '</div>';

	$('body').append(mask);
	$('body').append(strDiv);
	
	$('#loading_img').css('top',top);
	$('#loading_img').css('left',left);

	$('#mask_loading').css({'width' : maskWidth,'height': maskHeight,'opacity' : '0.5'}); 

	$('#mask_loading').show();
	$('#loading_img').show();
}

function closeLoadingWithMask() {
    $('#mask_loading, #loading_img').hide();
    $('#mask_loading, #loading_img').empty();  
}
</script>