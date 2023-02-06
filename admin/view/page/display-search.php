<style>
.search_posting_btn {
	 background-color:#000000; border:1px solid #140f82; width:55px; height:30px; color:#ffffff;padding:7px;
	 cursor:pointer;
}

.add_recommend_keyword_btn {
	style="background-color:#140f82; border:1px solid #140f82; width:55px; height:30px; color:#ffffff;"
	cursor:pointer;
}
</style>

<div class="filter-wrap" style="margin-bottom:20px">
	<button class="search_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="searchTabBtnClick(this);">한국몰</button>
	<button class="search_tab_btn tap__button" country="EN" style="width:150px;" onClick="searchTabBtnClick(this);">영문몰</button>
	<button class="search_tab_btn tap__button" country="CN" style="width:150px;" onClick="searchTabBtnClick(this);">중국몰</button>
</div>

<input id="country" type="hidden" value="KR">

<div id="menu_tab_KR" class="row search_tab" style="margin-top:0px;">
	<?php include_once("display-search-kr.php"); ?>
</div>

<div id="menu_tab_EN" class="row search_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-search-en.php"); ?>
</div>

<div id="menu_tab_CN" class="row search_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-search-cn.php"); ?>
</div>

<script>
function searchTabBtnClick(obj) {
	var country = $(obj).attr('country');
	$('#country').val(country);
	$('.search_tab').hide();
	$('#menu_tab_' + country).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.search_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.search_tab_btn').not($(obj)).css('color','#000000');
}

function getRecommendKeyword(country) {
	let result_table = $('.result_table_KEY_' + country);
	result_table.html('');
	
	$.ajax({
		url: config.api + "display/search/list/keyword/get",
		type: "post",
		data: {
			'country': country
		},
		dataType: "json",
		error: function() {
			alert('추천 검색어 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let data = d.data;
			if (data != null) {
				let strDiv = "";
				data.forEach(function(row) {
					strDiv += '<TR>';
					strDiv += '    <TD>';
					strDiv += '        <div class="cb__color">';
					strDiv += '    	       <label>';
					strDiv += '                <input class="keyword_checkbox" type="checkbox" name="keyword_idx[]" value="' + row.keyword_idx + '">';
					strDiv += '                <span></span>';
					strDiv += '            </label>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					strDiv += '    <TD>';
					strDiv += '        <div class="btn" onclick="displayNumCheck(\'' + country + '\',' + row.keyword_idx + ',' + row.display_num + ',\'KEY\',\'up\')">';
					strDiv += '            <i class="xi-angle-up"></i>';
					strDiv += '            <span class="tooltip top">위로</span>';
					strDiv += '        </div>';
					strDiv += '        <div class="btn" onclick="displayNumCheck(\'' + country + '\',' + row.keyword_idx + ',' + row.display_num + ',\'KEY\',\'down\')">';
					strDiv += '            <i class="xi-angle-down"></i>';
					strDiv += '            <span class="tooltip top">아래로</span>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.keyword_txt + '</TD>';
					
					let menu_type = "";
					switch (row.menu_type) {
						case "PR" :
							menu_type = "상품";
							break;
						
						case "PO" :
							menu_type = "게시물";
							break;
					}
					strDiv += '    <TD style="text-align:center;">' + menu_type + '</TD>';
					strDiv += '    <TD>' + row.menu_title + '</TD>';
					strDiv += '    <TD>' + row.menu_link + '</TD>';
					strDiv += '    <TD style="text-align:center;">';
					strDiv += '        <div class="btn" style="background-color:#140f82; border:1px solid #140f82; width:55px; height:30px; color:#ffffff;">편집</div>';
					strDiv += '    </TD>';
					strDiv += '</TR>';
				});
				
				result_table.append(strDiv);
			} else {
				var strDiv = '';
				strDiv += '<TD class="default_td" colspan="7">';
				strDiv += '    조회 결과가 없습니다';
				strDiv += '</TD>';
				
				result_table.append(strDiv);
			}
		}
	});
}

function addRecommendKeyword(country) {
	let frm = $('#frm-KEY_' + country);
	
	let menu_idx = frm.find('.menu_idx').val();
	let keyword_txt = frm.find('.keyword_txt').val();
	let menu_sort = frm.find('.menu_sort').val();
	
	if (keyword_txt == "" || keyword_txt == null) {
		alert('검색 키워드를 입력해주세요.');
		return false;
	}
	
	if (menu_idx == 0 || menu_sort == "" || menu_sort == null) {
		alert('검색 키워드와 연결하려는 메뉴를 선택해주세요.');
		return false;
	}
	
	$.ajax({
		url: config.api + "display/search/list/keyword/add",
		type: "post",
		data:{
			'country': country,
			'keyword_txt': keyword_txt,
			'menu_sort': menu_sort,
			'menu_idx': menu_idx
		},
		dataType: "json",
		error: function() {
			alert('추천 검색어 등록처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				getRecommendKeyword(country);
			}
		}
	});
}

function getPopularProduct(country) {
	let result_table = $('.result_table_PRD_' + country);
	result_table.html('');
	
	$.ajax({
		url: config.api + "display/search/list/product/get",
		type: "post",
		data:{
			'country': country
		},
		dataType: "json",
		error: function() {
			alert('실시간 인기제품 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let data = d.data;
			if (data != null) {
				let strDiv = "";
				data.forEach(function(row) {
					strDiv += '<tr>';
					strDiv += '    <td>';
					strDiv += '        <div class="cb__color">';
					strDiv += '            <label>';
					strDiv += '                <input class="product_checkbox" type="checkbox" class="select" name="popular_idx[]" value="' + row.popular_idx + '">';
					strDiv += '                <span></span>';
					strDiv += '            </label>';
					strDiv += '        </div>';
					strDiv += '    </td>';
					strDiv += '    <TD>';
					strDiv += '        <div class="btn" onclick="displayNumCheck(\'' + country + '\',' + row.popular_idx + ',' + row.display_num + ',\'PRD\',\'up\')">';
					strDiv += '            <i class="xi-angle-up"></i>';
					strDiv += '            <span class="tooltip top">위로</span>';
					strDiv += '        </div>';
					strDiv += '        <div class="btn" onclick="displayNumCheck(\'' + country + '\',' + row.popular_idx + ',' + row.display_num + ',\'PRD\',\'down\')">';
					strDiv += '            <i class="xi-angle-down"></i>';
					strDiv += '            <span class="tooltip top">아래로</span>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					
					var product_type = "";
					if (row.product_type == "B") {
						product_type = "일반";
					} else if (row.product_type == "S") {
						product_type = "세트";
					}
					strDiv += '    <td>' + product_type + '</td>';
					
					strDiv += '    <td>' + row.style_code + '</td>';
					strDiv += '    <td>' + row.color_code + '</td>';
					strDiv += '    <td>' + row.product_code + '</td>';

					let background_url = "background-image:url('" + row.img_location + "');";
					strDiv += '    <TD>';
					strDiv += '        <div class="product__img__wrap">';
					strDiv += '            <div class="product__img" style="' + background_url + '">';
					strDiv += '            </div>';
					strDiv += '            <div>';
					strDiv += '                <p>' + row.product_name + '</p><br>';
					strDiv += '                <p style="color:#EF5012">' + row.update_date + '</p>';
					strDiv += '            </div>';
					strDiv += '        </div>';
					strDiv += '    </TD>';

					let discount_kr = row.discount_kr;
					strDiv += '    <td style="text-align: right;">';
					if (discount_kr > 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
						strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
					} else {
						if(row.price_kr != null){
							strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
						}
					}
					strDiv += '    </td>';

					let discount_en = row.discount_en;
					strDiv += '    <td style="text-align: right;">';
					if (discount_en > 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
						strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
					} else {
						if(row.price_en != null){
							strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
						}
					}
					strDiv += '    </td>';

					let discount_cn = row.discount_cn;
					strDiv += '    <td style="text-align: right;">';
					if (discount_cn > 0) {
						strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
						strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
						strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
					} else {
						if(row.price_cn != null){
							strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
						}
					}
					strDiv += '    </td>';

					let stock_qty = row.stock_qty;
					let order_qty = row.order_qty;
					let safe_qty = row.safe_qty;

					let product_qty = stock_qty - order_qty;

					strDiv += '    <TD style="width:50px;">' + product_qty + '</TD>';
					strDiv += '    <TD style="width:50px;">' + stock_qty + '</TD>';
					strDiv += '    <TD style="width:50px;">' + order_qty + '</TD>';
					strDiv += '    <TD style="width:50px;">' + safe_qty + '</TD>';
					strDiv += '    <TD style="width:15%;">';
					strDiv += '        <a href="http://116.124.128.246/product/detail?product_idx=' + row.product_idx + '" onClick="window.open(this.href); return false;">상품 상세 페이지 이동</a>';
					strDiv += '    </TD>';
					strDiv += '</TR>';
				});
				
				result_table.append(strDiv);
			} else {
				var strDiv = '';
				strDiv += '<TD class="default_td" colspan="15" style="text-align:left;">';
				strDiv += '    조회 결과가 없습니다';
				strDiv += '</TD>';
				
				result_table.append(strDiv);
			}
		}
	});
}

function clickSelectAll(obj) {
	let country = $('#country').val();
	let checkbox = null;
	
	let checkbox_type = $(obj).attr('checkbox_type');
	let result_table = $('.result_table_' + checkbox_type + '_' + country);
	switch (checkbox_type) {
		case "KEY" :
			checkbox = result_table.find('.keyword_checkbox');
			break;
		
		case "PRD" :
			checkbox = result_table.find('.product_checkbox');
			break;
		
		case "M_PRD" :
			result_table = $('.result_table_' + checkbox_type);
			checkbox = result_table.find('.modal_product_checkbox');
			break;
	}
	
	if ($(obj).prop('checked') == true) {
		checkbox.prop('checked',true);
		
		if (checkbox_type == "M_PRD") {
			let cnt = checkbox.length;
			for (let i=0; i<cnt; i++) {
				let product_idx = checkbox.eq(i).val();
				
				let result = checkPopularProduct(product_idx);
				if (result == false) {
					break;
				}
			}
		}
	} else {
		checkbox.prop('checked',false);
		
		if (checkbox_type == "M_PRD") {
			let cnt = checkbox.length;
			for (let i=0; i<cnt; i++) {
				let product_idx = checkbox.eq(i).val();
				
				removePopularProduct(product_idx);
			}
		}
	}
}

function displayNumCheck(country,recent_idx,recent_num,display_type,action_type) {
	let result_table = $('.result_table_' + display_type + '_' + country);
	let cnt = 0;
	if (display_type == "KEY") {
		cnt = result_table.find('.keyword_checkbox').length;
	} else if (display_type == "PRD") {
		cnt = result_table.find('.product_checkbox').length;
	}
	
	if (action_type == "up") {
		if (recent_num == 1) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(country,action_type,display_type,recent_idx,recent_num);
		}
	} else if (action_type == "down") {
		if (recent_num == cnt) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(country,action_type,display_type,recent_idx,recent_num);
		}
	}
}

function updateDisplayNum(country,action_type,display_type,recent_idx,recent_num) {
	let api_url = "";
	if (display_type == "KEY") {
		api_url = config.api + "display/search/list/keyword/put";
	} else if (display_type == "PRD") {
		api_url = config.api + "display/search/list/product/put";
	}
	
	$.ajax({
		url: api_url,
		type: "post",
		data: {
			'country': country,
			'action_type': action_type,
			'recent_idx': recent_idx,
			'recent_num': recent_num
		},
		dataType: "json",
		error: function() {
			alert('추천 검색어 삭제처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				if (display_type == "KEY") {
					$('.result_table_KEY_' + country).html('');
					getRecommendKeyword(country);
				} else if (display_type == "PRD") {
					$('.result_table_PRD_' + country).html('');
					getPopularProduct(country);
				}
			} else {
				alert('추천 검색어 삭제 처리에 실패했습니다. 삭제하려는 추천검색어를 확인해주세요.');
			}
		}
	});
}

function deleteKeyword(country) {
	let result_table = $('.result_table_KEY_' + country);
	let cnt = result_table.find('.keyword_checkbox').length;
	
	let keyword_idx = new Array();
	for (let i=0; i<cnt; i++) {
		let keyword = result_table.find('.keyword_checkbox').eq(i);
		if (keyword.is(':checked') == true) {
			let tmp_idx = keyword.val();
			keyword_idx.push(tmp_idx);
		}
	}
	
	if (keyword_idx.length > 0) {
		$.ajax({
			url: config.api + "display/search/list/keyword/delete",
			type: "post",
			data: {
				'keyword_idx': keyword_idx
			},
			dataType: "json",
			error: function() {
				alert('추천 검색어 삭제처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				let code = d.code;
				if (code == 200) {
					result_table.html('');
					getRecommendKeyword(country);
					alert('선택한 추천 검색어가 삭제되었습니다.');
				} else {
					alert('추천 검색어 삭제 처리에 실패했습니다. 삭제하려는 추천검색어를 확인해주세요.');
				}
			}
		});
	} else {
		alert('한 개 이상의 추천 검색어를 선택해주세요.');
		return false;
	}
}

function deleteProductConfirm(country) {
	confirm(
		'선택한 실시간 인기 제품을 삭제하시겠습니까?',
		function() {
			console.log(country);
			let result_table = $('.result_table_PRD_' + country);
			let cnt = result_table.find('.product_checkbox').length;
			
			let popular_idx = new Array();
			for (let i=0; i<cnt; i++) {
				let popular = result_table.find('.product_checkbox').eq(i);
				if (popular.is(':checked') == true) {
					let tmp_idx = popular.val();
					popular_idx.push(tmp_idx);
				}
			}
			
			if (popular_idx.length > 0) {
				$.ajax({
					url: config.api + "display/search/list/product/delete",
					type: "post",
					data: {
						'popular_idx': popular_idx
					},
					dataType: "json",
					error: function() {
						alert('실시간 인기 제품 삭제처리중 오류가 발생했습니다.');
					},
					success: function(d) {
						let code = d.code;
						if (code == 200) {
							result_table.html('');
							getPopularProduct(country);
							alert('선택한 실시간 인기 제품이 삭제되었습니다.');
						} else {
							alert('실시간 인기 제품 삭제 처리에 실패했습니다. 삭제하려는 추천검색어를 확인해주세요.');
						}
					}
				});
			} else {
				alert('한 개 이상의 실시간 인기 제품을 선택해주세요.');
				return false;
			}
		}
	);
}

function getKeywordModal(country) {
	let frm = $('#frm-KEY_' + country);
	frm.find('.menu_idx').val(0);
	frm.find('.menu_sort').val('');
	modal('/keyword_get','country=' + country);
}

function getProductModal(country) {
	modal('/product_get','country=' + country);
}

function setModalPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}
</script>