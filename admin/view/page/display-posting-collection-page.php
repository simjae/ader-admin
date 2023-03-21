<style>
::-webkit-scrollbar{width:8px;}
::-webkit-scrollbar-track {background-color: transparent;}
::-webkit-scrollbar-thumb {background-color: #dcdcdc;}    

.container_PRJ {display:flex;}
    .project__select__wrap {width:40vh;height:200px;overflow-y:auto;}
        .display_btn {margin-right:10px;font-size:0.5rem;width:30px;height:30px;}
        .project__item{display:grid;grid-template-columns: 40px 1fr 30px 30px;align-items:center;margin-right:10px;}
        .project__item img{max-width:30px}
        .project__item .project__icon{width:40px;height:40px;display:flex;justify-content:center;align-items:center;}
        .project__title{padding-left:15px;line-height:40px;cursor:pointer;}

    .project__data__wrap{margin-left:20px;width:100%;height:200px;padding-left:15px;}
    
    .btn__area {margin-top:20px;padding-right:10px;}
    .btn__area input[type='text']{margin: 0px;width: 270px;border-radius: 2px;border: solid 1px #bfbfbf;border-radius: 2px;height: 28px;font-size: 12px;padding-left: 14px}
.server_img_path {margin-left:15px;width:500px;}	
.collection_img {width:100px;height:148px;border: 1px solid #000000;background-repeat: no-repeat;background-size: cover;background-position: center;}
.filter-wrap-container{display:flex;gap:40px }
</style>

<?php include_once("check.php"); ?>

<div class="filter-wrap-container">
	<div class="filter-wrap" style="margin-bottom:20px">
		<button class="collection_tab_btn tap__button" country="KR" style="background-color:#000;color:#fff;font-weight:500;width:180px;" onClick="collectionTabBtnClick(this);">한국몰</button>
		<button class="collection_tab_btn tap__button" country="EN" style="width:180px;" onClick="collectionTabBtnClick(this);">영문몰</button>
		<button class="collection_tab_btn tap__button" country="CN" style="width:180px;" onClick="collectionTabBtnClick(this);">중문몰</button>
	</div>
	<div class="filter-wrap" style="margin-bottom:20px">
		<button class="collection_tab_btn tap__button" country="KR" style="width:180px;" onClick="movePostingPage('EDTL')">에디토리얼</button>
		<button class="collection_tab_btn tap__button" country="EN" style="width:180px;" onClick="movePostingPage('RNWY')">런웨이</button>
		<button class="collection_tab_btn tap__button" country="CN" style="width:180px;" onClick="movePostingPage('COLA')">콜라보레이션</button>
	</div>
</div>


<input id="country" type="hidden" value="KR">

<div id="collection_tab_KR" class="collection_tab">
	<?php include_once("display-posting-collection-page-kr.php"); ?>
</div>

<div id="collection_tab_EN" class="collection_tab" style="display:none;">
	<?php include_once("display-posting-collection-page-en.php"); ?>
</div>

<div id="collection_tab_CN" class="collection_tab" style="display:none;">
	<?php include_once("display-posting-collection-page-cn.php"); ?>
</div>

<script>
$(document).ready(function() {
	$('.server_img_path').keyup(function(){
        $('.check_thumb_btn').attr('chk-flg', 'false');
    });
	
    $('.ftp_dir').keyup(function(){
        $('.check_img_btn').attr('chk-flg', 'false');
    });
});

function collectionTabBtnClick(obj) {
	let country = $(obj).attr('country');
	$('#country').val(country);
	
	$('.collection_tab').hide();
	$('#collection_tab_' + country).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.collection_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.collection_tab_btn').not($(obj)).css('color','#000000');
}

function resetCollectionProject(country) {
	let div_container = $('.container_PRJ_' + country);
	let result_table = $('.result_table_' + country);
	
	div_container.find('.project_idx').val(0);
	div_container.find('.project_name').val('');
	div_container.find('.project_desc').val('');
	div_container.find('.project_title').val('');
	div_container.find('.thumb_location').val('');
    
	$('.server_img_path').val('');
	$('.ftp_dir').val('');
	$('#collection_img_cnt_' + country).text('');
	
	let strDiv = "";
	strDiv += '<TR>';
	strDiv += '    <td class="default_td" style="text-align:left" colspan="5">';
	strDiv += '        프로젝트를 선택해주세요';
	strDiv += '    </td>';
	strDiv += '</TR>';
	
	result_table.html(strDiv);
}

function toggleCollectionProject(obj){
	let country = $(obj).attr('country');
	let project_idx = $(obj).attr('project_idx');
    
	var status = $(obj).attr('item-status');
	
	$('.project__item').not($(obj)).attr('item-status','off');
	
    if(status == 'off'){
        $(obj).attr('item-status','on');
        getCollectionProject(country,project_idx);
    } else{
        $(obj).attr('item-status','off');
        resetCollectionProject(country);
    }
}

function getCollectionProjectList(country) {
	let div_container = $('.container_PRJ_' + country);
	let div_select = div_container.find('.project__select__wrap');
	
	$.ajax({
		type: "post",
		url: config.api + "display/posting/collection/project/list/get",
		data: {
			'country' : country
		},
		dataType: "json",
		error: function() {
			alert("컬렉션 프로젝트 리스트 조회처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				div_select.html('');				
				
				let strDiv = "";
				
				let data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						strDiv += '<div class="project__item" item-status="off" project_idx="' + row.project_idx + '" country="' + country + '" onclick="toggleCollectionProject(this);">';
						strDiv += '    <div class="project__icon">';
						strDiv += '        <img src="' + row.img_location + '">';
						strDiv += '    </div>';
						strDiv += '    <div class="project__title">' + row.project_name + '</div>';
						strDiv += '    <div class="btn display_btn" onclick="checkDisplayNum(\'' + country + '\',\'PRJ\',\'up\',' + row.project_idx + ',' + row.display_num + ')">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn display_btn" onclick="checkDisplayNum(\'' + country + '\',\'PRJ\',\'down\',' + row.project_idx + ',' + row.display_num + ')">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">아래로</span>';
						strDiv += '    </div>';
						strDiv += '</div>';
					});
				} else {
					strDiv += '    <div class="project__item" item-status="off" onClick="resetCollectionProject();">';
					strDiv += '        <div class="project__icon">';
					strDiv += '            <img src="/images/default_thumbnail_img.jpg">';
					strDiv += '        </div>';
					strDiv += '        <div class="project__title" >등록된 프로젝트가 없습니다</div>';
					strDiv += '        <div class="btn display_btn">';
					strDiv += '            <i class="xi-angle-up"></i>';
					strDiv += '            <span class="tooltip top">위로</span>';
					strDiv += '        </div>';
					strDiv += '        <div class="btn display_btn">';
					strDiv += '            <i class="xi-angle-down"></i>';
					strDiv += '            <span class="tooltip top">아래로</span>';
					strDiv += '        </div>';
					strDiv += '    </div>';
				}
				
				div_select.append(strDiv);
				resetCollectionProject();
			} else {
				alert(d.msg);
			}
		}
	});
}

function getCollectionProject(country,project_idx) {
	let div_container = $('.container_PRJ_' + country);
	let result_table = $('.result_table_' + country);
	
    result_table.html('');
    
	$.ajax({
		type: "post",
		url: config.api + "display/posting/collection/project/get",
		data: {
			'project_idx' : project_idx
		},
		dataType: "json",
		error: function() {
			alert("컬렉션 프로젝트 조회처리중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				let strDiv = "";
				if (data != null) {
					data.forEach(function(row) {
						div_container.find('.project_idx').val(row.project_idx);
						
						div_container.find('.project_name').val(row.project_name);
						div_container.find('.project_desc').val(row.project_desc);
						div_container.find('.project_title').val(row.project_title);
						div_container.find('.thumb_location').val(row.img_location);
						
						let product_info = row.product_info;
						if (product_info.length > 0) {
							product_info.forEach(function(product_row) {
                                let relevant_flg = "";
								let relevant_flg_T = "";
                                let relevant_flg_F = "";
								
                                if (product_row.relevant_flg == true) {
									relevant_flg = "true";
                                    relevant_flg_T = 'checked';
                                } else {
									relevant_flg = "false";
                                    relevant_flg_F = 'checked';
                                }
                                
								var background_url = "background-image:url('" + product_row.img_location_m + "');";
								
								strDiv += '<tr>';
								strDiv += '    <td>';
								strDiv += '        <div class="cb__color">';
								strDiv += '            <label>';
								strDiv += '                <input class="product_checkbox" type="checkbox" value="' + product_row.c_product_idx + '">';
								strDiv += '                <input type="hidden" class="display_num" value="' + product_row.display_num + '">';
								strDiv += '                <span></span>';
								strDiv += '            </label>';
								strDiv += '        </div>';
								strDiv += '    </td>';
								strDiv += '    <td>';
								strDiv += '        <span>' + product_row.display_num + '<span>';
								strDiv += '    </td>';
								strDiv += '    <td>';
								strDiv += '        <div style="display:grid;grid-template-columns: 100px 1fr 100px;align-items:center;">';
								strDiv += '            <div>';
								strDiv += '                <p>이미지 경로</p>';
								strDiv += '            </div>';
								strDiv += '            <div>';
								strDiv += '                <input type="text" value="' + product_row.img_location_l + '" style="width:calc(100% - 100px);margin-bottom:5px" readonly>';
								strDiv += '                <input type="text" value="' + product_row.img_location_m + '" style="width:calc(100% - 100px);margin-bottom:5px" readonly>';
								strDiv += '                <input type="text" value="' + product_row.img_location_s + '" style="width:calc(100% - 100px);margin-bottom:5px" readonly>';
								strDiv += '            </div>';
								strDiv += '    </td>';
								strDiv += '    <td>';
								strDiv += '        <div class="collection_img" style="' + background_url + '"></div>';
								strDiv += '    </td>';
								strDiv += '    <td style="text-align:center;">';
								strDiv += '        <div style="display:flex;">';
								strDiv += '            <input class="relevant_flg" name="relevant_flg" type="hidden" value="' + relevant_flg + '">';
								strDiv += '            <label class="rd__square" style="margin-right:10px;">';
								strDiv += '                <input type="radio" name="relevant_flg_' + country + '_' + product_row.c_product_idx + '" value="false" onClick="clickRelevantFlg(this);" ' + relevant_flg_F + '>';
								strDiv += '                <div><div></div></div>';
								strDiv += '                <span>비표시</span>';
								strDiv += '            </label>';
								strDiv += '            <label class="rd__square">';
								strDiv += '                <input type="radio" name="relevant_flg_' + country + '_' + product_row.c_product_idx + '" value="true" onClick="clickRelevantFlg(this);" ' + relevant_flg_T + '>';
								strDiv += '                <div><div></div></div>';
								strDiv += '                <span>표시</span>';
								strDiv += '            </label>';
								strDiv += '        </div>';
								strDiv += '        <button class="btn" onclick="openRelevantModal(' + product_row.c_product_idx + ')" style="width:140px">관련상품 수정하기</button>';
								strDiv += '    </td>';
								strDiv += '</tr>';
							});
						} else {
							strDiv += '<TR>';
							strDiv += '    <td class="default_td" style="text-align:left" colspan="5">';
							strDiv += '        등록된 이미지가 없습니다.';
							strDiv += '    </td>';
							strDiv += '</TR>';
						}
					});
					
					result_table.append(strDiv);
				}
			} else {
				alert(d.msg);
				return false;
			}
		}
	});
}

function checkThumbLocation(country){
	let div_container = $('.container_PRJ_' + country);
	let server_img_path = div_container.find('.server_img_path').val();
	
	if(server_img_path.length > 0){
		$.ajax({
			type: "post",
			data: {
				'server_img_path' : server_img_path
			},
			dataType: "json",
			url: config.api + "display/posting/collection/project/check",
			error: function() {
				alert("컬렉션 프로젝트 썸네일 체크처리중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					div_container.find('.check_thumb_btn').attr('chk-flg', 'true');
					alert(d.msg);
				} else{
					alert(d.msg);
				}
			}
		});
	} else{
		alert('파일명을 포함한 썸네일 폴더 경로를 입력해주세요.');
	}
}

function putThumbLocation(country){
	let div_container = $('.container_PRJ_' + country);
	
	confirm(
		'썸네일 이미지를 변경하시겠습니까?',
		function(){
			let project_idx = div_container.find('.project_idx').val();
			if (project_idx == 0 || project_idx == "" || project_idx == null) {
				alert('수정하려는 프로젝트를 선택해주세요.');
				return false;
			}
			
			let server_img_path = div_container.find('.server_img_path').val();
			if (server_img_path.length == 0 || server_img_path == null) {
				alert('썸네일 폴더 경로를 입력해주세요.');
				return false;
			}
			
			let chk_flg = div_container.find('.check_thumb_btn').attr('chk-flg');
			if(chk_flg == 'false'){
				alert('썸네일 체크 후 다시 시도해주세요');
				return false;
			}
			
			$.ajax({
				type: "post",
				url: config.api + "display/posting/collection/project/put",
				data: {
					'update_type': 'THUMB',
					'project_idx' : project_idx,
					'server_img_path' : server_img_path
				},
				dataType: "json",
				error: function() {
					alert("컬렉션 프로젝트 썸네일 변경처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if (d.code == 200) {
						getCollectionProjectList(country);
						resetCollectionProject(country);
						alert('선택 한 컬렉션 프로젝트의 썸네일 이미지 변경되었습니다.');
					} else {
						alert(d.msg);
					}
				}
			});
		}
	);
}

function addCollectionProject(country) {
	let div_container = $('.container_PRJ_' + country);
	
	let project_idx = div_container.find('.project_idx').val();
	if (project_idx > 0) {
		alert('현재 조회중인 프로젝트의 선택을 해제해주세요.');
		return false;
	}
	
	let project_name = div_container.find('.project_name').val();
	if (project_name == "" || project_name == null) {
		alert('프로젝트명을 입력해주세요.');
		return false;
	}
	
	let project_desc = div_container.find('.project_desc').val();
	if (project_desc == "" || project_desc == null) {
		alert('프로젝트 설명을 입력해주세요.');
		return false;
	}
	
	let project_title = div_container.find('.project_title').val();
	if (project_title == "" || project_title == null) {
		alert('프로젝트 제목을 입력해주세요.');
		return false;
	}
	
	let thumb_location = div_container.find('.thumb_location').val();
	if (thumb_location == "" || thumb_location == null) {
		alert('썸네일 경로를 입력해주세요.');
		return false;
	}
	
	confirm(
		'입력한 정보로 신규 프로젝트를 등록하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "display/posting/collection/project/add",
				data: {
					'country' : country,
					'project_name' : project_name,
					'project_desc' : project_desc,
					'project_title' : project_title,
					'thumb_location' : thumb_location
				},
				dataType: "json",
				error: function() {
					alert("컬렉션 프로젝트 등록처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getCollectionProjectList(country);
						resetCollectionProject(country);
						alert('신규 컬렉션 프로젝트가 등록되었습니다.');
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		}
	);
}

function putCollectionProject(country) {
	let div_container = $('.container_PRJ_' + country);
	
	let project_idx = div_container.find('.project_idx').val();
	if (project_idx == 0 || project_idx == "" || project_idx == null) {
		alert('수정하려는 프로젝트를 선택해주세요.');
		return false;
	}
	
	let project_name = div_container.find('.project_name').val();
	if (project_name == "" || project_name == null) {
		alert('프로젝트명을 입력해주세요.');
		return false;
	}
	
	let project_desc = div_container.find('.project_desc').val();
	if (project_desc == "" || project_desc == null) {
		alert('프로젝트 설명을 입력해주세요.');
		return false;
	}
	
	let project_title = div_container.find('.project_title').val();
	if (project_title == "" || project_title == null) {
		alert('프로젝트 제목을 입력해주세요.');
		return false;
	}
	confirm(
		'선택한 프로젝트를 수정하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "display/posting/collection/project/put",
				data: {
                    'update_type' : 'INFO',
					'project_idx' : project_idx,
					'project_name' : project_name,
					'project_desc' : project_desc,
					'project_title' : project_title
				},
				dataType: "json",
				error: function() {
					alert("컬렉션 프로젝트 수정처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getCollectionProjectList(country);
						resetCollectionProject(country);
						alert('선택한 컬렉션 프로젝트가 수정되었습니다.');
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		}
	)
}

function deleteCollectionProject(country) {
	let div_container = $('.container_PRJ_' + country);
	
	let project_idx = div_container.find('.project_idx').val();
	if (project_idx == 0 || project_idx == "" || project_idx == null) {
		alert('삭제하려는 프로젝트를 선택해주세요.');
		return false;
	}
	
	confirm(
		'삭제한 프로젝트의 정보와 이미지는 복구할 수 없습니다. 정말 삭제하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: {
					'country' : country,
					'project_idx' : project_idx
				},
				dataType: "json",
				url: config.api + "display/posting/collection/project/delete",
				error: function() {
					alert("컬렉션 리스트 조회처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getCollectionProjectList(country);
						resetCollectionProject(country);
						
						alert('선택한 컬렉션 프로젝트가 삭제되었습니다.');
					}
				}
			});
		}
	);
}

function checkDisplayNum(country,obj_type,action_type,recent_idx,recent_num) {
	let div_container = null;
	
    let item_cnt = 0;
	if (obj_type == "PRJ") {
		div_container = $('.container_PRJ_' + country);
        item_cnt = div_container.find('.project__item').length;
	} else if (obj_type == "CRP"){
		div_container = $('.container_REP');
        item_cnt = div_container.find('.relevant__item').length
    }

	if (recent_idx > 0 && recent_num > 0) {
		if (action_type == "up") {
			if (recent_num == 1) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				putDisplayNum(country,obj_type,action_type,recent_idx,recent_num);
			}
		} else if (action_type == "down") {
			if (recent_num == item_cnt) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				putDisplayNum(country,obj_type,action_type,recent_idx,recent_num);
			}
		}
	} else {
		alert('진열순서 변경 대상을 선택해주세요.');
		return false;
	}
}


function putDisplayNum(country,obj_type,action_type,recent_idx,recent_num) {
	let div_container = $('.container_PRJ_' + country);
	
    let project_idx = 0;
	let c_product_idx = 0;
	let dir_api = "";
	let action_name = "";
	
    if (obj_type == "PRJ") {
		dir_api = "project/";
		action_name = "프로젝트";
	} else if (obj_type == "CRP"){
		dir_api = "relevant/";
		action_name = "관련상품";
		
		project_idx = div_container.find('.project_idx').val();
		c_product_idx = $('#c_product_idx').val()
	}
    
	$.ajax({
		url: config.api + "display/posting/collection/" + dir_api + "put",
		type: "post",
		data: {
			'display_num_flg': true,
			'country' : country,
			'action_type': action_type,
			'recent_idx': recent_idx,
			'recent_num': recent_num,
			'project_idx' : project_idx,
			'c_product_idx' : c_product_idx
		},
		dataType: "json",
		error: function() {
			alert('컬렉션 ' + action_name + ' 진열순서 변경처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				if (obj_type == "PRJ") {
					getCollectionProjectList(country);
				} else if (obj_type == "CRP") {
					getRelevantInfo(c_product_idx);
				}
			} else {
				alert('진열순서 진열순서 변경처리에 실패했습니다. 변경하려는 진열순서를 확인해주세요.');
			}
		}
	});
}

function selectAllClick(obj) {
	let country = $(obj).attr('country');
	
	let result_table = $('.result_table_' + country);
	if ($(obj).prop('checked') == true) {
		result_table.find('.product_checkbox').prop('checked',true);
	} else {
		result_table.find('.product_checkbox').prop('checked',false);
	}
}

function checkCollectionProductDisplayNum(country,action_type){
    let result_table = $('.result_table_' + country);

    let product_checkbox = result_table.find('.product_checkbox');
	let display_num = result_table.find('.display_num');
	
	let cnt = product_checkbox.length;
    
	let c_product_idx = [];
    let recent_num = [];
	
	for (let i=0; i<cnt; i++) {
		if (product_checkbox.eq(i).prop('checked') == true) {
			c_product_idx.push(product_checkbox.eq(i).val());
            recent_num.push(display_num.eq(i).val());
		}
	}
	
    let product_total_cnt = result_table.find('tr').length;

    let min_display_num = Math.min.apply(Math,recent_num);
    let max_display_num = Math.max.apply(Math,recent_num);

    if (action_type == "up") {
        if (min_display_num == 1) {
            alert('진열순서를 변경할 수 없습니다');
            return false;
        } else {
            putCollectionProductDisplayNum(country,action_type,c_product_idx,recent_num);
        }
    } else if (action_type == "down") {
        if (max_display_num == product_total_cnt) {
            alert('진열순서를 변경할 수 없습니다');
            return false;
        } else {
            putCollectionProductDisplayNum(country,action_type,c_product_idx,recent_num);
        }
    }
}

function putCollectionProductDisplayNum(country,action_type,c_product_idx,recent_num){
	let div_container = $('.container_PRJ_' + country);
	let project_idx = div_container.find('.project_idx').val();
	
	let div_data = $('.project__data__wrap');
	
    $.ajax({
        type: "post",
		url: config.api + "display/posting/collection/product/put",
        data: {
			'display_num_flg' : true,
			'action_type' : action_type,
			'project_idx' : project_idx,
            'c_product_idx' : c_product_idx,
            'recent_num' : recent_num
        },
        dataType: "json",
        error: function() {
            alert("컬렉션 이미지 진열순서 변경처리중 오류가 발생했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
				getCollectionProject(country,project_idx);
            }
        }
    });
}

function checkImgLocation(country){
	var ftp_dir = $('#ftp_dir_' + country).val();

	if (ftp_dir.length > 0) {
		$.ajax({
			type: "post",
			data: {
				'ftp_dir' : ftp_dir
			},
			dataType: "json",
			url: config.api + "display/posting/collection/product/check",
			error: function() {
				alert("컬렉션 썸네일 이미지 체크작업이 실패했습니다.");
			},
			success: function(d) {
				if (d.code == 200) {
                    $('#check_img_btn_' + country).attr('chk-flg', 'true');
					$('#collection_img_cnt_' + country).text(d.data.img_cnt+'개');
					
					alert(d.msg);
				} else {
					alert(d.msg);
				}
			}
		});
	} else {
        alert('등록하려는 컬렉션 이미지 경로를 입력해주세요.');
    }
}

function addCollectionProduct(country){
	let div_container = $('.container_PRJ_' + country);
    
	let project_idx = div_container.find('.project_idx').val();
	if (project_idx == 0 || project_idx == "" || project_idx == null) {
		alert('이미지를 등록하려는 컬렉션 프로젝트를 선택해주세요.');
		return false;
	}
	
	let ftp_dir = $('#ftp_dir_' + country).val();
	if (ftp_dir == "" || ftp_dir == null ) {
		alert('등록하려는 FTP 서버의 이미지 경로를 입력해주세요.');
		return false;
	}
	
	if (ftp_dir.slice(-1) == "/") {
		let tmp_dir = ftp_dir.slice(0,ftp_dir.length - 1)
		$('.ftp_dir').val(tmp_dir);
	}
	
	let chk_flg = $('.check_img_btn').attr('chk-flg');

	if (chk_flg == 'false') {
		alert('등록하려는 이미지의 경로를 체크해주세요');
		return false;
	}
	
    confirm(
		'컬렉션 이미지 등록 시, 기존에 등록되어있는 컬렉션 이미지는 모두 삭제 됩니다. 등록하시겠습니까?',
		function () {
			$.ajax({
				type: "post",
				url: config.api + "display/posting/collection/product/add",
				data: {
					'country' : country,
					'project_idx' : project_idx,
					'ftp_dir': ftp_dir,
				},
				dataType: "json",
				error: function() {
					alert('컬렉션 이미지 등록처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if(d.code == 200){
						getCollectionProject(country,project_idx);
						alert(d.msg);
					} else {
						alert(d.msg);
					}
				}
			});
		}
	);
}

function clickRelevantFlg(obj) {
	let relevant_flg = $(obj).parent().parent().find('.relevant_flg');
	relevant_flg.val($(obj).val());
}

function putCollectionProduct(country){
	let div_container = $('.container_PRJ_' + country);
	let project_idx = div_container.find('.project_idx').val();
	
	let result_table = $('.result_table_' + country);
	let product_checkbox = result_table.find('.product_checkbox');
	
	let cnt = product_checkbox.length;
	
	let c_product_idx = [];
	let relevant_flg = [];
	
	for (let i=0; i<cnt; i++) {
		if (product_checkbox.eq(i).prop('checked') == true) {
			c_product_idx.push(product_checkbox.eq(i).val());
			let tmp_val = $('.relevant_flg').eq(i).val();
			relevant_flg.push(tmp_val);
		}
	}
	
	if (c_product_idx.length > 0 && relevant_flg.length > 0) {
		confirm(
			'선택한 컬렉션 이미지의 진열여부를 수정하시겠습니까?',
			function(){
				
				$.ajax({
					type: "post",
					url: config.api + "display/posting/collection/product/put",
					data: {
						'update_flg' : true,
						'c_product_idx' : c_product_idx,
						'relevant_flg' : relevant_flg
					},
					dataType: "json",
					error: function() {
						alert("컬렉션 이미지 진열여부 수정처리중 오류가 발생했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
							getCollectionProject(project_idx);
							alert("컬렉션 이미지 진열여부가 변경되었습니다.");
						} else {
							alert("컬렉션 이미지 진열여부 변경처리에 실패했습니다. 진열여부 변경하려는 상품을 확인해주세요.");
						}
					}
				});
			}
		);
	} else {
		alert('진열상태를 변경하려는 컬렉션 이미지를 선택해주세요.');
		return false;
	}
}

function deleteCollectionProduct(country) {
	let div_container = $('.container_PRJ_' + country);
	let project_idx = div_container.find('.project_idx').val();
	
    let result_table = $('.result_table_' + country);

	let product_checkbox = result_table.find('.product_checkbox');
	let cnt = product_checkbox.length;

	let c_product_idx = [];
	
	for (let i=0; i<cnt; i++) {
		if (product_checkbox.eq(i).prop('checked') == true) {
			c_product_idx.push(product_checkbox.eq(i).val());
		}
	}
	
	if (c_product_idx.length > 0) {
		confirm(
			'선택한 컬렉션 이미지를 삭제하시겠습니까?',
			function() {
				$.ajax({
					type: "post",
					data: {
						'project_idx' : project_idx,
						'c_product_idx' : c_product_idx
					},
					dataType: "json",
					url: config.api + "display/posting/collection/product/delete",
					error: function() {
						alert("컬렉션 이미지 삭제처리중 오류가 발생했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
                            getCollectionProject(project_idx);
							alert('선택한 컬렉션 이미지가 삭제되었습니다.');
						}
					}
				});
			}
		);
	} else {
		alert('삭제 할 컬렉션 이미지를 선택해주세요.');
		return false;
	}
}

function openRelevantModal(c_product_idx){
	modal('/put', 'c_product_idx=' + c_product_idx);
}

function movePostingPage(type){
	location.href=`/display/posting?posting_type=${type}`;
}
</script>