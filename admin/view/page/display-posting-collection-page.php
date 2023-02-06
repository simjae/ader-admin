<style>
::-webkit-scrollbar{
    width:8px;
}
::-webkit-scrollbar-track {
    background-color: transparent;
}
::-webkit-scrollbar-thumb {
    background-color: #dcdcdc;
}    
</style>

<div class="filter-wrap" style="margin-bottom:20px">
	<button class="collection_tab_btn tap__button" country="KR" style="background-color:#000;color:#fff;font-weight:500;width:180px;" onClick="collectionTabBtnClick(this);">한국몰</button>
	<button class="collection_tab_btn tap__button" country="EN" style="width:180px;" onClick="collectionTabBtnClick(this);">영문몰</button>
	<button class="collection_tab_btn tap__button" country="CN" style="width:180px;" onClick="collectionTabBtnClick(this);">중문몰</button>
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
$(document).ready(function(){
    $('input[name="server_img_path"]').keyup(function(){
        country = $('#country').val();
        $('#collection_tab_'+country).find('.image_check_btn.thumbnail').attr('chk-flg', 'false');
    })
    $('input[name="ftp_dir"]').keyup(function(){
        country = $('#country').val();
        $('#collection_tab_'+country).find('.image_check_btn.collection_prod').attr('chk-flg', 'false');
    })
})
function resetCollection(country) {
	let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');

    let div_prd_container = $('.container_PRD_' + country);
	let result_table = div_prd_container.find('.result_table_' + country);
	
	div_data.find('.collection_idx').val(0);
	div_data.find('.project_name').val('');
	div_data.find('.project_desc').val('');
	div_data.find('.project_title').val('');
	div_data.find('.thumb_location').val('');

    result_table.html('');
    result_table.html(`
        <TR>
            <td class="default_td" style="text-align:left" colspan="4">
                프로젝트를 선택해주세요
            </td>
        </TR>
    `);

}
function getCollection(country,collection_idx) {
	let div_prj_container = $('.container_PRJ_' + country);
	let div_data = div_prj_container.find('.project__data__wrap');
	
	let div_prd_container = $('.container_PRD_' + country);
	let result_table = div_prd_container.find('.result_table_' + country);
	
    result_table.html('');
    result_table.html(`
        <TR>
            <td class="default_td" style="text-align:left" colspan="4">
                프로젝트를 선택해주세요
            </td>
        </TR>
    `);
    
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'collection_idx' : collection_idx
		},
		dataType: "json",
		url: config.api + "display/posting/collection/project/get",
		error: function() {
			alert("컬렉션 리스트 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						div_data.find('.collection_idx').val(row.collection_idx);
						
						div_data.find('.project_name').val(row.project_name);
						div_data.find('.project_desc').val(row.project_desc);
						div_data.find('.project_title').val(row.project_title);
						div_data.find('.thumb_location').val(row.img_location);
						
						let product_info = row.product_info;
						if (product_info != null) {
							result_table.html('');
							
							let strDiv = "";

							product_info.forEach(function(product_row) {
                                var relevant_flg_T = '';
                                var relevant_flg_F = '';
                                if(product_row.relevant_flg == true){
                                    relevant_flg_T = 'checked';
                                }
                                else{
                                    relevant_flg_F = 'checked';
                                }
                                strDiv += `
                                    <tr>
                                        <td>
                                            <div class="cb__color">        
                                                <label>            
                                                    <input type="checkbox" class="product_checkbox" name="c_product_idx[]" value="${product_row.c_product_idx}"> 
                                                    <input type="hidden" class="recent_num_arr" name="recent_num[]" value="${product_row.display_num}">           
                                                    <span></span>        
                                                </label>    
                                            </div>
                                        </td> 
                                        <td>
                                            <span>${product_row.display_num}<span>
                                        </td> 
                                        <td>
                                            <div style="display:grid;grid-template-columns: 100px 1fr 100px;align-items:center;">
                                                <div>
                                                    <p style="margin-bottom:5px">Large Image</p>
                                                    <p style="margin-bottom:5px">Middle Image</p>
                                                    <p style="margin-bottom:5px">Small Image</p>
                                                </div>
                                                <div>
                                                    <input value="${product_row.img_location}" style="width:calc(100% - 100px);margin-bottom:5px" readonly>
                                                    <input value="${product_row.img_location}" style="width:calc(100% - 100px);margin-bottom:5px" readonly>
                                                    <input value="${product_row.img_location}" style="width:calc(100% - 100px);margin-bottom:5px" readonly>
                                                </div>
                                                <img src="${product_row.img_location}">    
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;">
                                                <label class="rd__square" style="margin-right:10px;">
                                                    <input type="radio" name="relevant_flg_${product_row.c_product_idx}" class="" value="false" ${relevant_flg_F}>
                                                    <div><div></div></div>
                                                    <span>표시안함</span>
                                                </label>
                                                <label class="rd__square">
                                                    <input type="radio" name="relevant_flg_${product_row.c_product_idx}" class="" value="true" ${relevant_flg_T}>
                                                    <div><div></div></div>
                                                    <span>표시함</span>
                                                </label>
                                            </div>
                                            <button class="btn" onclick="openRelevantModal(${product_row.c_product_idx})" style="width:140px">관련상품 수정하기</button>
                                        </td>
                                    </tr>
                                `;
							});
							
							result_table.append(strDiv);
						}
					});
				}
			} else {
				alert(d.msg);
				return false;
			}
		}
	});
}
function addCollection(country) {
	let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');
	
	let collection_idx = div_data.find('.collection_idx').val();
	if (collection_idx > 0) {
		alert('현재 조회중인 프로젝트의 선택을 해제해주세요.');
		return false;
	}
	
	let project_name = div_data.find('.project_name').val();
	if (project_name == "" || project_name == null) {
		alert('프로젝트명을 입력해주세요.');
		return false;
	}
	
	let project_desc = div_data.find('.project_desc').val();
	if (project_desc == "" || project_desc == null) {
		alert('프로젝트 설명을 입력해주세요.');
		return false;
	}
	
	let project_title = div_data.find('.project_title').val();
	if (project_title == "" || project_title == null) {
		alert('프로젝트 제목을 입력해주세요.');
		return false;
	}
	
	let thumb_location = div_data.find('.thumb_location').val();
	if (thumb_location == "" || thumb_location == null) {
		alert('썸네일 경로를 입력해주세요.');
		return false;
	}
	
	confirm(
		'입력한 정보로 신규 프로젝트를 등록하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: {
                    'country' : country,
					'project_name' : project_name,
					'project_desc' : project_desc,
					'project_title' : project_title,
					'thumb_location' : thumb_location
				},
				dataType: "json",
				url: config.api + "display/posting/collection/project/add",
				error: function() {
					alert("컬렉션 리스트 조회처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getCollectionList(country);
						resetCollection(country);
						alert('신규 프로젝트 등록에 성공했습니다.');
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		}
	);
}
function putCollection(country) {
	let div_container = $('.container_PRJ_' + country);
    let div_data = div_container.find('.project__data__wrap');
    
	let collection_idx = div_data.find('.collection_idx').val();
	if (collection_idx == 0 || collection_idx == "" || collection_idx == null) {
		alert('수정하려는 프로젝트를 선택해주세요.');
		return false;
	}
	
	let project_name = div_data.find('.project_name').val();
	if (project_name == "" || project_name == null) {
		alert('프로젝트명을 입력해주세요.');
		return false;
	}
	
	let project_desc = div_data.find('.project_desc').val();
	if (project_desc == "" || project_desc == null) {
		alert('프로젝트 설명을 입력해주세요.');
		return false;
	}
	
	let project_title = div_data.find('.project_title').val();
	if (project_title == "" || project_title == null) {
		alert('프로젝트 제목을 입력해주세요.');
		return false;
	}
	confirm(
		'선택한 프로젝트를 수정하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: {
                    'update_flg' : 'project',
                    'country' : country,
					'collection_idx' : collection_idx,
					'project_name' : project_name,
					'project_desc' : project_desc,
					'project_title' : project_title
				},
				dataType: "json",
				url: config.api + "display/posting/collection/project/put",
				error: function() {
					alert("컬렉션 리스트 조회처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getCollectionList(country);
						resetCollection(country);
						alert('선택한 프로젝트가 성공적으로 수정되었습니다.');
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		}
	)
}
function deleteCollection(country) {
	let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');
	
	let collection_idx = div_data.find('.collection_idx').val();
	if (collection_idx == 0 || collection_idx == "" || collection_idx == null) {
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
					'collection_idx' : collection_idx
				},
				dataType: "json",
				url: config.api + "display/posting/collection/project/delete",
				error: function() {
					alert("컬렉션 리스트 조회처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						getCollectionList(country);
						resetCollection(country);
						alert('선택한 프로젝트가 성공적으로 삭제되었습니다.');
					}
				}
			});
		}
	);
}

function getCollectionList(country) {
	let div_container = $('.container_PRJ_' + country);
	let div_select = div_container.find('.project__select__wrap');
	$.ajax({
		type: "post",
		data: {
			'country' : country
		},
		dataType: "json",
		url: config.api + "display/posting/collection/project/list/get",
		error: function() {
			alert("컬렉션 리스트 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				div_select.html('');
				
				let data = d.data;
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += `
                        
                        <div class="project__item" item-status="off" onclick="toggleProject('KR','${row.collection_idx}', this)">
                            <div class="project__icon">
                                <img src="${row.img_location}">
                            </div>
                            <div class="project__title">
                                <span>${row.project_name}</span>
                            </div>
                            <div class="btn" onclick="displayNumCheck('KR','PSW','up',${row.collection_idx},${row.display_num})">            
                                <i class="xi-angle-up"></i>            
                                <span class="tooltip top">위로</span>       
                            </div>
                            <div class="btn" onclick="displayNumCheck('KR','PSW','down',${row.collection_idx},${row.display_num})">            
                                <i class="xi-angle-down"></i>            
                                <span class="tooltip top">위로</span>       
                            </div>
                        </div>
                        `;
					});
					
					div_select.append(strDiv);
				}
				
				resetCollection(country);
			} else {
				alert(d.msg);
				return false;
			}
		}
	});
}
function toggleProject(country, collection_idx, obj){
    var status = $(obj).attr('item-status');
    if(status == 'off'){
        $(obj).attr('item-status', 'on');
        getCollection(country, collection_idx);
    }
    else{
        $(obj).attr('item-status', 'off');
        resetCollection(country)
    }
}
function checkThumbImage(country){
    let div_prj_container = $('.container_PRJ_' + country);
    let server_img_path = div_prj_container.find('input[name="server_img_path"]').val();

    if(server_img_path.length > 0){
        $.ajax({
            type: "post",
            data: {
                'server_img_path' : server_img_path
            },
            dataType: "json",
            url: config.api + "display/posting/collection/project/check",
            error: function() {
                alert("컬렉션 썸네일 이미지 체크작업이 실패했습니다.");
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('입력하신 이미지 파일이 존재합니다.');
                    div_prj_container.find('.image_check_btn.thumbnail').attr('chk-flg', 'true');
                }
                else{
                    alert(d.msg);
                }
            }
        });
    }
    else{
        alert('경로를 포함한 파일명을 입력해주세요.');
    }
}
function addThumbImage(country){
	confirm('썸네일 이미지를 변경하시겠습니까?', function(){
		let div_container = $('.container_PRJ_' + country);
		let div_data = div_container.find('.project__data__wrap');
		
		let collection_idx = div_data.find('.collection_idx').val();
		let server_img_path = div_container.find('input[name="server_img_path"]').val();
		let chk_flg = div_container.find('.image_check_btn.thumbnail').attr('chk-flg');

		if(chk_flg == 'false'){
			alert('썸네일 파일 체크를 진행해주세요');
			return false;
		}
		$.ajax({
			type: "post",
			data: {
				'update_flg': 'thumbnail',
				'server_img_path' : server_img_path,
				'collection_idx' : collection_idx
			},
			dataType: "json",
			url: config.api + "display/posting/collection/project/put",
			error: function() {
				alert("컬렉션 썸네일 이미지 수정작업이 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					console.log(country);
					getCollectionList(country);
					resetCollection(country);
					alert('썸네일 이미지 수정에 성공하셨습니다.');
					
				}
				else{
					alert(d.msg);
				}
			}
		});
	});
    
}
function displayNumCheck(country,obj_type,action_type,recent_idx,recent_num) {
	let div_container = null;
    let item_cnt = 0;
	if (obj_type == "PSW") {
		div_container = $('.project__select__wrap');
        item_cnt = $('.project__item').length;
	} 
	else{
        div_container = $('.relevant__wrap');
        item_cnt = $('.relevant__wrap .table ').length
    }

	if (recent_idx > 0 && recent_num > 0) {
		
		if (action_type == "up") {
			if (recent_num == 1) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				updateDisplayNum(country,obj_type,action_type,recent_idx,recent_num);
			}
		} else if (action_type == "down") {
			if (recent_num == item_cnt) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				updateDisplayNum(country,obj_type,action_type,recent_idx,recent_num);
			}
		}
	} else {
		alert('진열순서 변경 대상을 선택해주세요.');
		return false;
	}
}
function updateDisplayNum(country,obj_type,action_type,recent_idx,recent_num) {
    let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');

    let collection_idx = div_data.find('.collection_idx').val();
	let dir_api = "";
	let param = {};
    param = {
			'display_num_flg': true,
            'country' : country,
			'action_type': action_type,
			'recent_idx': recent_idx,
			'recent_num': recent_num
	};
    if (obj_type == "PSW") {
		dir_api = "project/";
	}
    else{
		dir_api = "relevant/";
        param.c_product_idx = $('#REP_c_product_idx').val();
        param.collection_idx = collection_idx;
	}
    
	$.ajax({
		url: config.api + "display/posting/collection/" + dir_api + "put",
		type: "post",
		data: param,
		dataType: "json",
		error: function() {
			alert('게시물 스토리 진열순서 변경처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				if (obj_type == "PSW") {
					getCollectionList('KR');
				} else{
					getRelevantInfo('KR',$('#REP_c_product_idx').val());
				}
			} else {
				alert('진열순서 변경 처리에 실패했습니다. 변경하려는 진열순서를 확인해주세요.');
			}
		}
	});
}
function prdDisplayNumCheck(country, action_type){
    let div_prd_container = $('.container_PRD_' + country);
    let result_table = div_prd_container.find('.result_table_'+country);

    let product_checkbox = result_table.find('.product_checkbox');
    let recent_num_arr = result_table.find('.recent_num_arr');
	let cnt = product_checkbox.length;
    
	let c_product_idx = [];
    let recent_num = [];
	for (let i=0; i<cnt; i++) {
		if (product_checkbox.eq(i).prop('checked') == true) {
			c_product_idx.push(product_checkbox.eq(i).val());
            recent_num.push(recent_num_arr.eq(i).val());
		}
	}
    let product_total_cnt = result_table.find('tr').length;

    let min_display_num = Math.min.apply(Math, recent_num);
    let max_display_num = Math.max.apply(Math, recent_num);

    if (action_type == "up") {
        if (min_display_num == 1) {
            alert('진열순서를 변경할 수 없습니다');
            return false;
        } else {
            prdDisplayNumUpdate(country,action_type,c_product_idx,recent_num);
        }
    } else if (action_type == "down") {
        if (max_display_num == product_total_cnt) {
            alert('진열순서를 변경할 수 없습니다');
            return false;
        } else {
            prdDisplayNumUpdate(country,action_type,c_product_idx,recent_num);
        }
    }
}
function prdDisplayNumUpdate(country, action_type, c_product_idx_arr,recent_num_arr){
	let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');
	
	let collection_idx = div_data.find('.collection_idx').val();
    $.ajax({
        type: "post",
        data: {
			'collection_idx' : collection_idx,
            'country' : country,
            'action_type' : action_type,
            'c_product_idx' : c_product_idx_arr,
            'recent_num' : recent_num_arr,
            'display_num_flg' : true
        },
        dataType: "json",
        url: config.api + "display/posting/collection/product/put",
        error: function() {
            alert("컬렉션 썸네일 이미지 체크작업이 실패했습니다.");
        },
        success: function(d) {
            if(d.code == 200) {
                alert('순서를 변경했습니다.');
				getCollection(country,collection_idx);
            }
        }
    });
	
}
function checkCollectionProduct(country){
    let div_container = $('.container_PRD_' + country);
	var ftp_dir = div_container.find('input[name="ftp_dir"]').val();

	if(ftp_dir.length > 0){
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
				if(d.code == 200) {
                    $('#collection_prod_cnt_'+country).text(d.data.img_cnt+'개');
                    div_container.find('.image_check_btn.collection_prod').attr('chk-flg', 'true');
					alert('폴더 내 이미지가 존재합니다.');
				}
			}
		});
	}
    else{
        alert('경로를 입력해주세요.');
    }
}
function addCollectionProduct(country){
    let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');

    let collection_idx = div_data.find('.collection_idx').val();
	if (collection_idx == 0 || collection_idx == "" || collection_idx == null) {
		alert('수정하려는 프로젝트를 선택해주세요.');
		return false;
	}

    confirm('이전의 상품은 모두 삭제 됩니다. 새로 등록하시겠습니까?', function (){
        let div_container = $('.container_PRD_' + country);
	    var ftp_dir = div_container.find('input[name="ftp_dir"]').val();
        var chk_flg = div_container.find('.image_check_btn.collection_prod').attr('chk-flg');

        if(chk_flg == 'false'){
            alert('경로체크를 먼저 진행해주세요');
            return false;
        }
        $.ajax({
            type: "post",
            data: {'collection_idx' : collection_idx, 'ftp_dir': ftp_dir},
            dataType: "json",
            url: config.api + "display/posting/collection/product/add",
            error: function() {
                alert('FTP 서버 내 에디토리얼 이미지 체크작업이 실패했습니다.');
            },
            success: function(d) {
                if(d.code == 200){
                    alert(d.msg);
					getCollection(country,collection_idx);
                }
                else{
                    alert(d.msg);
                }
            }
        });
    })
}
function putCollectionProductFlg(country){
    confirm('선택하신 상품의 진열여부를 수정하시겠습니까?', function(){
        let div_container = $('.container_PRJ_' + country);
        let div_data = div_container.find('.project__data__wrap');
        let collection_idx = div_data.find('.collection_idx').val();

        let div_prd_container = $('.container_PRD_' + country);
        let frm = div_prd_container.find('#frm-product-list-'+country);
        let formData = new FormData();
        formData = frm.serializeObject();

        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "display/posting/collection/product/put",
            error: function() {
                alert("룩북상품 수정처리에 실패했습니다.");
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('룩북상품을 수정하였습니다.');

                    getCollection(country,collection_idx);
                } else {
                    alert("룩북상품 수정처리에 실패했습니다. 수정하려는 상품을 확인해주세요.");
                }
            }
        });
    })
}
function deleteCollectionProduct(country) {
    
	let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');
	
	let collection_idx = div_data.find('.collection_idx').val();
	
    let div_prd_container = $('.container_PRD_' + country);
    let result_table = div_prd_container.find('.result_table_'+country);

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
			'선택한 컬렉션 상품 정보를 삭제하시겠습니까?',
			function() {
				$.ajax({
					type: "post",
					data: {
						'collection_idx' : collection_idx,
						'c_product_idx' : c_product_idx
					},
					dataType: "json",
					url: config.api + "display/posting/collection/product/delete",
					error: function() {
						alert("컬렉션 상품 삭제처리에 실패했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
                            getCollection(country,collection_idx);
							alert('선택한 프로젝트가 성공적으로 삭제되었습니다.');
						}
					}
				});
			}
		);
	} else {
		alert('삭제 할 컬렉션 상품을 선택해주세요.');
		return false;
	}
}
function openRelevantModal(c_product_idx){
    modal('/put', 'c_product_idx=' + c_product_idx);
}
function getRelevantInfo(country,c_product_idx) {
	let div_container = $('.container_REP_' + country);
	let div_wrap = div_container.find('.relevant__wrap');
	
	var collection_idx = $('.container_PRJ_' + country).find('.collection_idx').val();
	console.log('==:'+collection_idx);
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'collection_idx' : collection_idx,
			'c_product_idx' : c_product_idx,
		},
		dataType: "json",
		url: config.api + "display/posting/collection/relevant/get",
		error: function() {
			alert("컬렉션 리스트 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				div_wrap.html('');
				
				let data = d.data;
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
                        var display_flg_T = '';
                        var display_flg_F = '';
                        if(row.display_flg == true){
                            display_flg_T = 'checked';
                        }
                        else{
                            display_flg_F = 'checked';
                        }

                        var sold_out_flg_T = '';
                        var sold_out_flg_F = '';
                        if(row.sold_out_flg == true){
                            sold_out_flg_T = 'checked';
                        }
                        else{
                            sold_out_flg_F = 'checked';
                        }

						strDiv += '<div class="table table__wrap">';
                        strDiv += '    <div>';
                        strDiv += '         <h4>' + row.product_code + '</h4>';
                        strDiv += '         <div class="drive--x"></div>';
                        strDiv += '    </div>';
                        strDiv += `     
                                        <div class="btn" onclick="displayNumCheck('KR','RLW','up',${row.relevant_idx},${row.display_num})">            
                                            <i class="xi-angle-up"></i>            
                                            <span class="tooltip top">위로</span>       
                                        </div>
                                        <div class="btn" onclick="displayNumCheck('KR','RLW','down',${row.relevant_idx},${row.display_num})"">            
                                            <i class="xi-angle-down"></i>            
                                            <span class="tooltip top">위로</span>       
                                        </div>
                                        <input type="hidden" name="relevant_idx[]" value="${row.relevant_idx}">
                        `;
						strDiv += '    <table>';
						strDiv += '        <tr>';
						strDiv += '            <td>상품명</td>';
						strDiv += '            <td>' + row.product_name + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>이미지</td>';
						strDiv += '            <td>' + row.img_location + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>상세페이지</td>';
						strDiv += '            <td>/product/detail?product_idx=' + row.product_idx + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>품절임박</td>';
                        strDiv += `
                                                <td>
                                                    <div style="display:flex;">
                                                        <label class="rd__square" style="margin-right:10px;">
                                                            <input type="radio" name="display_flg_${row.relevant_idx}" value="false" ${display_flg_F}>
                                                            <div><div></div></div>
                                                            <span>표시안함</span>
                                                        </label>
                                                        <label class="rd__square">
                                                            <input type="radio" name="display_flg_${row.relevant_idx}" value="true" ${display_flg_T}>
                                                            <div><div></div></div>
                                                            <span>표시함</span>
                                                        </label>
                                                    </div>
                                                </td>
                        `;
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>진열여부</td>';
						strDiv += `
                                                <td>
                                                    <div style="display:flex;">
                                                        <label class="rd__square" style="margin-right:10px;">
                                                            <input type="radio" name="sold_out_flg_${row.relevant_idx}" value="false" ${sold_out_flg_F}>
                                                            <div><div></div></div>
                                                            <span>표시안함</span>
                                                        </label>
                                                        <label class="rd__square">
                                                            <input type="radio" name="sold_out_flg_${row.relevant_idx}" value="true" ${sold_out_flg_T}>
                                                            <div><div></div></div>
                                                            <span>표시함</span>
                                                        </label>
                                                    </div>
                                                </td>
                        `;
						strDiv += '        </tr>';
						strDiv += '    </table>';
                        strDiv += `
                                        <div style="display:flex;justify-content: space-between;margin-top:10px;">
                                            <div></div>
                                            <div>
                                                <button class="btn" onclick="deleteRelevantProduct('${country}',${row.relevant_idx})">삭제하기</button>
                                            </div>
                                        </div>
                        `;
						strDiv += '</div>';
					});
					div_wrap.append(strDiv);
				}
			}
		}
	});
	
	let tree_length = $('.js--tree_' + country).children().length;
	if (tree_length == 0) {
		$('.js--tree_' + country).jstree({
			core : {
				data : {
					url : config.api + 'product/category/get',
					data : {'tab_num' : '02'},
					dataType : "json"
				},
				'strings' : { 'loading' : "데이터 로딩중입니다.", 'New node' : "새 분류" },
				'check_callback' : function(o, n, p, i, m) {
					
					if(m && m.dnd && m.pos !== 'i') { return false; }
					if(o === "move_node") {
						if(this.get_node(n).parent === this.get_node(p).id) { return false; }
					}
					
					return true;
				},
				'themes' : {
					'responsive' : false,
					'variant' : 'small',
					'stripes' : false, 
					'dot' : true,
					'icons' : false
				}
			},
			'sort' : function(a, b) {
				return this.get_type(a) === this.get_type(b) ? (this.get_text(a) > this.get_text(b) ? 1 : -1) : (this.get_type(a) >= this.get_type(b) ? 1 : -1);
			},
			'contextmenu' : {
				'items' : function(node) {
					var tmp = $.jstree.defaults.contextmenu.items();
					tmp.create.label = "새 분류";
					tmp.rename.label = "명칭 변경";
					if(node.parent != "#") tmp.remove.label = "삭제";
					else delete tmp.remove;
					delete tmp.ccp;
					return tmp;
				}
			},
			'unique' : {
				'duplicate' : function (name, counter) {
					return name + ' ' + counter;
				}
			},
			"plugins": ["dnd", "search"],
			"search": {
				"show_only_matches": true,
				"show_only_matches_children": true,
			}
		}).on("select_node.jstree", function (e, data) {
            console.log('click');
			let md_category_node = 0;
			let md_category_depth = 0;
			
			sel_node = data.node;
			md_category_node = sel_node.original.no;
			md_category_depth = sel_node.parents.length;	
			getRelevantProduct(country,md_category_node,md_category_depth,collection_idx,c_product_idx);
		});
	}
}

function getRelevantProduct(country,md_category_node,md_category_depth,collection_idx,c_product_idx) {
	let div_container = $('.container_REP_' + country);
	let result_table = div_container.find('.result_table_' + country);
	
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'md_category_node' : md_category_node,
			'md_category_depth' : md_category_depth,
			'collection_idx' : collection_idx,
			'c_product_idx' : c_product_idx
		},
		dataType: "json",
		url: config.api + "display/posting/collection/relevant/list/get",
		error: function() {
			alert("메인 컨텐츠 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				result_table.html('');
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += '<tr>';
						strDiv += '    <td>';
						
						let action_type = row.action_type;
						if (action_type == "ADD") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + row.product_idx + '" onClick="putRelevantProduct(this);">선택</div>';	
						} else if (action_type == "DEL") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + row.product_idx + '" onClick="putRelevantProduct(this);">선택완료</div>';	
						}
						var background_url = "background-image:url('" + row.img_location + "');";
                        strDiv += `
                                        </td>
                                        <td>${row.product_code}</td>
                                        <td>
                                            <div class="product__img__wrap">
                                                <div class="product__img" style="${background_url}" >
                                                </div>
                                                <div>
                                                    <p>${row.product_name}</p>
                                                    <p style="color:#EF5012">${row.update_date}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                        `;  

						
						strDiv += '    </td>';
						strDiv += '</tr>';
					});
					
					result_table.append(strDiv);
				} else {
					let strDiv = "";
					strDiv += '<tr>';
					strDiv += '	<td colspan="6" style="text-align:left;">조회 결과가 없습니다.</td>';
					strDiv += '</tr>';
					
					result_table.append(strDiv);
				}
			}
		}
	});
}
function putRelevantProduct(obj) {	
    let country = $('#country').val();
	let c_product_idx = $('#REP_c_product_idx').val();
	let div_container = $('.container_PRJ_' + country);
	let div_data = div_container.find('.project__data__wrap');
	let collection_idx = div_data.find('.collection_idx').val();
	
	//c_product_idx -> 모달 표시할 때 파람으로 넘어오는 값
	
	let action_type = $(obj).attr('action_type');
	let product_idx = $(obj).attr('product_idx');
	
	$.ajax({
		type: "post",
		data: {
			'action_type' : action_type,
			'country' : country,
			'collection_idx' : collection_idx,
			'c_product_idx' : c_product_idx,
			'product_idx' : product_idx
		},
		dataType: "json",
		url: config.api + "display/posting/collection/relevant/put",
		error: function() {
			alert("메인 컨텐츠 수정처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let strDiv = "";
				if (action_type == "ADD") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + product_idx + '" onClick="putRelevantProduct(this);">선택완료</div>';	
				} else if (action_type == "DEL") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + product_idx + '" onClick="putRelevantProduct(this);">선택</div>';	
				}
				
				let div_parent = $(obj).parent();
				div_parent.html(strDiv);

                getRelevantInfo($('#country').val(),$('#REP_c_product_idx').val());
			} else {
				alert("메인 컨텐츠 상품 선택처리에 실패했습니다. 선택하려는 메인 컨텐츠의 상품을 확인해주세요.");
			}
		}
	});
}
function deleteRelevantProduct(country, relevant_idx) {
    confirm('선택하신 상품을 관련상품에서 제외하시겠습니까?', function(){
        let div_container = $('.container_PRJ_' + country);
        let div_data = div_container.find('.project__data__wrap');
        
        let collection_idx = div_data.find('.collection_idx').val();
        let c_product_idx = $('#REP_c_product_idx').val();
        
        $.ajax({
            type: "post",
            data: {
                'collection_idx' : collection_idx,
                'c_product_idx' : c_product_idx,
                'country' : country,
                'relevant_idx' : relevant_idx
            },
            dataType: "json",
            url: config.api + "display/posting/collection/relevant/delete",
            error: function() {
                alert("관련상품 삭제처리에 실패했습니다.");
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('관련상품을 삭제하였습니다.');

                    getRelevantInfo($('#country').val(),$('#REP_c_product_idx').val());
                } else {
                    alert("관련상품 삭제처리에 실패했습니다. 삭제하려는 상품을 확인해주세요.");
                }
            }
        });
    });
}
function putRelevantProductInfo(country){
    confirm('관련상품 정보를 이대로 수정하시겠습니까?', function (){
        let div_container = $('.container_REP_' + country);
        let frm = div_container.find('#frm-relevant-list-'+country);

        let formData = new FormData();
        formData = frm.serializeObject();

        $.ajax({
            type: "post",
            data: formData,
            dataType: "json",
            url: config.api + "display/posting/collection/relevant/put",
            error: function() {
                alert("관련상품 수정처리에 실패했습니다.");
            },
            success: function(d) {
                if(d.code == 200) {
                    alert('관련상품을 수정하였습니다.');

                    getRelevantInfo($('#country').val(),$('#REP_c_product_idx').val());
                } else {
                    alert("관련상품 수정처리에 실패했습니다. 수정하려는 상품을 확인해주세요.");
                }
            }
        });
    })
    
}
</script>