<div class="filter-wrap" style="margin-bottom:20px">
	<button class="banner_tab_btn tap__button" banner_type="HED" style="background-color: #000;color: #fff;font-weight: 500;" onClick="bannerTabBtnClick(this);">배너 헤드</button>
	<button class="banner_tab_btn tap__button" banner_type="IMG" onClick="bannerTabBtnClick(this);">배너 이미지</button>
	<button class="banner_tab_btn tap__button" banner_type="VID" onClick="bannerTabBtnClick(this);">배너 동영상</button>
</div>

<input id="banner_type" type="hidden" value="HED">

<div id="banner_tab_HED" class="row banner_tab" style="margin-top:0px;">
	<?php include_once("display-product-banner-head.php"); ?>
</div>

<div id="banner_tab_IMG" class="row banner_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-product-banner-img.php"); ?>
</div>

<div id="banner_tab_VID" class="row banner_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-product-banner-vid.php"); ?>
</div>


<script>
function bannerTabBtnClick(obj) {
	var tabTitle = $(obj).text();
	$('#tabTitle').text(tabTitle);
	
	var banner_type = $(obj).attr('banner_type');
	$('#banner_type').val(banner_type);
	$('.banner_tab').hide();
	$('#banner_tab_' + banner_type).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.banner_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.banner_tab_btn').not($(obj)).css('color','#000000');
}

function getBannerInfoList(banner_type) {
	let result_table = $('#result_table_' + banner_type);

	let strDiv = "";
	strDiv += '    <TR>';
	strDiv += '        <TD colspan="8" style="text-align:left;">';
	strDiv += '            조회 결과가 없습니다.';
	strDiv += '        </TD>';
	strDiv += '    </TR>';
	
	result_table.append(strDiv);
	
	let rows = $("#frm-filter_" + banner_type).find('.rows').val();
	let page = $("#frm-filter" + banner_type).find('.page').val();
	
	get_contents($("#frm-filter_" + banner_type),{
		pageObj : $(".paging_" + banner_type),
		html : function(d) {
			if (d != null) {
				result_table.html('');
				
				let strDiv = "";
				d.forEach(function(row) {
					let location = "";
					switch (banner_type) {
						case "HED" :
							location = "head";
							break;
						
						case "IMG" :
							location = "img";
							break;
						
						case "VID" :
							location = "vid";
							break;
						
					}
					strDiv += '<TR>';
					strDiv += '    <TD>';
					strDiv += '        <div class="cb__color">';
					strDiv += '            <label>';
					strDiv += '                <input class="banner_checkbox" type="checkbox" value="' + row.banner_idx + '">';
					strDiv += '                <span></span>';
					strDiv += '            </label>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.num + '</TD>';
					strDiv += '    <TD><div class="btn" onClick="location.href=\'/display/product/banner/' + location + '/update?banner_idx=' + row.banner_idx + '\'">배너편집</div></TD>';
					
					var background_url = "background-image:url('" + row.banner_thumbnail + "');";
					strDiv += '    <TD>';
					strDiv += '        <div class="banner_thumbnail" style="width:100px;height:100px;border:1px solid #000000;' + background_url + '"></div>';
					strDiv += '    </TD>';
					
					strDiv += '    <TD>' + row.banner_title + '</TD>';
					strDiv += '    <TD>' + row.banner_memo + '</TD>';
					strDiv += '    <TD>' + row.banner_location + '</TD>';
					strDiv += '    <TD>' + row.create_date + '</TD>';
					strDiv += '    <TD>' + row.creater + '</TD>';
					strDiv += '    <TD>' + row.update_date + '</TD>';
					strDiv += '    <TD>' + row.updater + '</TD>';
					strDiv += '<TR>';
				});
				
				result_table.append(strDiv);
			}
		},
	},rows,page);
}

function deleteBannerInfo(banner_type) {
	let result_table = $('#result_table_' + banner_type);
	
	let banner_idx = [];
	
	let cnt = result_table.find('.banner_checkbox').length;
	for (let i=0; i<cnt; i++) {
		let checkbox = result_table.find('.banner_checkbox').eq(i);
		
		if (checkbox.prop('checked') == true) {
			banner_idx.push(checkbox.val());
		}
	}
	
	if (banner_idx.length > 0) {
		$.ajax({
			type: "post",
			data: {
				'banner_type' : banner_type,
				'banner_idx' : banner_idx
			},
			dataType: "json",
			url: config.api + "display/product/banner/delete",
			error: function() {
				alert("배너 삭제 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					getBannerInfoList(banner_type);
					alert('선택한 배너가 정상적으로 삭제되었습니다.');
				} else {
					alert(d.msg);
				}
			}
		});
	} else {
		alert('삭제하려는 배너를 선택해주세요.');
		return false;
	}
}

function selectAllClick(obj) {
	let banner_type = $(obj).attr('banner_type');
	
	let result_table = $('#result_table_' + banner_type);
	
	if ($(obj).prop('checked') == true) {
		result_table.find('.banner_checkbox').prop('checked',true);
	} else {
		result_table.find('.banner_checkbox').prop('checked',false);
	}
}

function setPaging(obj) {
	let banner_type = $(obj).attr('banner_type');
	
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total_' + banner_type).text(total_cnt.val());
	$('.cnt_result_' + banner_type).text(result_cnt.val());
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
</script>