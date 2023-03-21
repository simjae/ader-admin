<style>
.search_posting_btn {background-color:#000000; border:1px solid #140f82; width:55px; height:30px; color:#ffffff;padding:7px;cursor:pointer;}
.add_recommend_keyword_btn {style="background-color:#140f82; border:1px solid #140f82; width:55px; height:30px; color:#ffffff;"cursor:pointer;}
.put_recommend_keyword_btn {background-color:#140f82; border:1px solid #140f82; width:55px; height:30px;color:#ffffff;cursor:pointer;}

.save_story_btn {width:150px;height:30px;background-color:#000000;color:#ffffff;border:1px solid #bfbfbf;float:right;padding:5px;text-align:center;font-size:0.8rem;cursor:pointer;}

.select_copy {width:150px;height:30px;border:1px solid #bfbfbf;border-radius:5px;float:right;margin-right:10px;}
.save_font {font-size:12px;font-family:'NanumSquareRound',sans-serif;line-height:2.8;float:right;margin-right:10px;}
</style>

<?php include_once("check.php"); ?>

<div class="filter-wrap" style="width:100%;margin-bottom:20px;display:flex;">
	<div style="width:50%;">
		<button class="search_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="searchTabBtnClick(this);">한국몰</button>
		<button class="search_tab_btn tap__button" country="EN" style="width:150px;" onClick="searchTabBtnClick(this);">영문몰</button>
		<button class="search_tab_btn tap__button" country="CN" style="width:150px;" onClick="searchTabBtnClick(this);">중국몰</button>
	</div>
	
	<div style="width:50%;">
		<div class="btn" style="float:right;" onClick="copySearchInfo();">복사</div>				
		
		<font class="save_font">로 복사</font>
		
		<select id="country_to" class="select_copy">
			<option value="KR">한국몰</option>
			<option value="EN">영문몰</option>
			<option value="CN">중문몰</option>
		</select>
		
		<font class="save_font">데이터를</font>
		
		<select id="country_from" class="select_copy" style="">
			<option value="KR">한국몰</option>
			<option value="EN">영문몰</option>
			<option value="CN">중문몰</option>
		</select>
		
		<select id="copy_type" class="select_copy" style="">
			<option value="KEY">추천 검색어</option>
			<option value="PRD">실시간 인기 상품</option>
		</select>
	</div>
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

function getRecommendKeywordList(country) {
	let result_table = $('.result_table_KEY_' + country);
	result_table.html('');
	
	$.ajax({
		url: config.api + "display/search/keyword/list/get",
		type: "post",
		data: {
			'country': country
		},
		dataType: "json",
		error: function() {
			alert('추천 검색어 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != "" && data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						strDiv += '<TR id="tr_keyword_' + row.keyword_idx + '">';
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
						strDiv += '    <TD>';
						strDiv += '        <input id="menu_idx_' + row.keyword_idx + '" type="hidden" value="' + row.menu_idx + '" readonly>';
						strDiv += '        <input id="menu_sort_' + row.keyword_idx + '" type="hidden" value="' + row.menu_sort + '" readonly>';
						strDiv += '        <input id="keyword_txt_' + row.keyword_idx + '" type="text" value="' + row.keyword_txt + '">';
						strDiv += '    </TD>';
						strDiv += '    <TD>';
						strDiv += '        <input id="menu_title_' + row.keyword_idx + '" type="text" value="' + row.menu_title + '" readonly>';
						strDiv += '    </TD>';
						strDiv += '    <TD>';
						strDiv += '        <input id="menu_location_' + row.keyword_idx + '" type="text" value="' + row.menu_location + '" readonly>';
						strDiv += '    </TD>';
						strDiv += '    <TD>';
						strDiv += '        <input id="menu_link_' + row.keyword_idx + '" type="text" value="' + row.menu_link + '" readonly>';
						strDiv += '    </TD>';
						strDiv += '    <TD style="text-align:center;">';
						strDiv += '        <div class="search_posting_btn" onClick="getKeywordModal(\'KR\',\'PUT\',' + row.keyword_idx + ');">검색</div>';
						strDiv += '    </TD>';
						strDiv += '    <TD style="text-align:center;">';
						strDiv += '        <div class="btn put_recommend_keyword_btn" onClick="putRecommendKeyword(\'' + country + '\',' + row.keyword_idx + ')">편집</div>';
						strDiv += '    </TD>';
						strDiv += '</TR>';
					});
					
					result_table.append(strDiv);
				} else {
					var strDiv = '';
					strDiv += '<TD class="default_td" colspan="9" style="text-align:left;">';
					strDiv += '    조회 결과가 없습니다';
					strDiv += '</TD>';
					
					result_table.append(strDiv);
				}
			}
		}
	});
}

function addRecommendKeyword(country) {
	let frm = $('#frm-KEY_' + country);
	
	let menu_idx = frm.find('.menu_idx').val();
	let menu_sort = frm.find('.menu_sort').val();
	let keyword_txt = frm.find('.keyword_txt').val();
	
	if (keyword_txt == "" || keyword_txt == null) {
		alert('검색 키워드를 입력해주세요.');
		return false;
	}
	
	if (menu_idx == 0 || menu_sort == "" || menu_sort == null) {
		alert('검색 키워드와 연결하려는 메뉴를 선택해주세요.');
		return false;
	}
	
	$.ajax({
		url: config.api + "display/search/keyword/add",
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
				getRecommendKeywordList(country);
			}
		}
	});
}

function putRecommendKeyword(country,keyword_idx) {
	let keyword_txt = $('#keyword_txt_' + keyword_idx).val();
	let menu_idx = $('#menu_idx_' + keyword_idx).val();
	let menu_sort = $('#menu_sort_' + keyword_idx).val();
	
	if (keyword_txt == "" || keyword_txt == null) {
		alert('편집하려는 추천 검색어의 검색 키워드를 입력해주세요.');
		return false;
	}
	
	if (menu_idx == 0 || (menu_sort == "" || menu_sort == null)) {
		alert('편집하려는 추천 검색어의 메뉴를 선택해주세요.');
		return false;
	}
	
	$.ajax({
		url: config.api + "display/search/keyword/put",
		type: "post",
		data:{
			'update_flg' : true,
			'keyword_idx' : keyword_idx,
			'keyword_txt' : keyword_txt,
			'menu_idx' : menu_idx,
			'menu_sort' : menu_sort
		},
		dataType: "json",
		error: function() {
			alert('실시간 인기 상품 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				getRecommendKeywordList(country);
				alert('선택한 추천 검색어 정보가 수정되었습니다.');
			} else {
				alert(d.msg);
			}
		}
	});
}

function getPopularProductList(country) {
	let result_table = $('.result_table_PRD_' + country);
	
	$.ajax({
		url: config.api + "display/search/product/list/get",
		type: "post",
		data:{
			'country': country
		},
		dataType: "json",
		error: function() {
			alert('실시간 인기 상품 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let data = d.data;
			if (data != null) {
				result_table.html('');
				
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
		api_url = config.api + "display/search/keyword/put";
	} else if (display_type == "PRD") {
		api_url = config.api + "display/search/product/put";
	}
	
	$.ajax({
		url: api_url,
		type: "post",
		data: {
			'display_num_flg' : true,
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
					getRecommendKeywordList(country);
				} else if (display_type == "PRD") {
					getPopularProductList(country);
				}
			} else {
				alert('추천 검색어 삭제 처리에 실패했습니다. 삭제하려는 추천검색어를 확인해주세요.');
			}
		}
	});
}

function deleteRecommendKeyword(country) {
	let result_table = $('.result_table_KEY_' + country);
	let checkbox = result_table.find('.keyword_checkbox');
	let cnt = checkbox.length;
	
	let keyword_idx = [];
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			keyword_idx.push(checkbox.eq(i).val());
		}
	}
	
	if (keyword_idx.length > 0) {
		confirm(
			'선택한 추천 검색어를 삭제하시겠습니까?',
			function() {
				$.ajax({
					type: "post",
					url: config.api + "display/search/keyword/delete",
					data: {
						'keyword_idx': keyword_idx,
						'country' : country
					},
					dataType: "json",
					error: function() {
						alert('추천 검색어 삭제처리중 오류가 발생했습니다.');
					},
					success: function(d) {
						let code = d.code;
						if (code == 200) {
							getRecommendKeywordList(country);
							alert('선택한 추천 검색어가 삭제되었습니다.');
						} else {
							alert('추천 검색어 삭제 처리에 실패했습니다. 삭제하려는 추천검색어를 확인해주세요.');
						}
					}
				});
			}
		);
	} else {
		alert('한 개 이상의 추천 검색어를 선택해주세요.');
		return false;
	}
}

function deletePopularProduct(country) {
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
		confirm(
			'선택한 실시간 인기 상품을 삭제하시겠습니까?',
			function() {
				$.ajax({
					url: config.api + "display/search/product/delete",
					type: "post",
					data: {
						'popular_idx': popular_idx,
						'country' : country
					},
					dataType: "json",
					error: function() {
						alert('실시간 인기 상품 삭제처리중 오류가 발생했습니다.');
					},
					success: function(d) {
						let code = d.code;
						if (code == 200) {
							getPopularProductList(country);
							alert('선택한 실시간 인기 상품이 삭제되었습니다.');
						} else {
							alert('실시간 인기 상품 삭제 처리에 실패했습니다. 삭제하려는 추천검색어를 확인해주세요.');
						}
					}
				});
			}
		);
	} else {
		alert('한 개 이상의 실시간 인기 상품을 선택해주세요.');
		return false;
	}
}

function getKeywordModal(country,action_type,keyword_idx) {
	if (action_type == "ADD") {
		let frm = $('#frm-KEY_' + country);
		frm.find('.menu_idx').val(0);
		frm.find('.menu_sort').val('');
	}
	
	modal('/keyword_get','param=' + action_type + '|' + keyword_idx);
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

function saveSearchInfo(country,save_type) {
	let save_name = "";
	if (save_type == "KEY") {
		save_name = "추천 검색어";
	} else if (save_type == "PRD") {
		save_name = "실시간 인기 상품";
	}
	
	$.ajax({
		url: config.api + "display/search/save/add",
		type: "post",
		data: {
			'country': country,
			'save_type' : save_type
		},
		dataType: "json",
		beforeSend: function(){
			loadingWithMask('/images/default/loading_img.gif');
		},
		error: function() {
			alert('메뉴 리스트 저장처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				getRecommendKeywordList(country);
				closeLoadingWithMask();
				
				alert('선택한 국가의 추천 검색어가 저장되었습니다.');
			}
		}
	});
}

function copySearchInfo() {
	let copy_type = $('#copy_type').val();
	
	let copy_name = "";
	if (copy_type == "KEY") {
		copy_name = "추천 검색어";
	} else if (copy_type == "PRD") {
		copy_name = "실시간 인기 상품";
	}
	
	let country_from = $('#country_from').val();
	let country_to = $('#country_to').val();
	
	if (country_from == country_to) {
		alert('동일한 국가로 복사할 수 없습니다.');
		return false;
	}
	
	confirm(
		'메뉴를 복사하시겠습니까? 기존에 작성된 메뉴 정보는 전부 삭제됩니다.',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "display/search/save/copy",
				data: {
					'copy_type' : copy_type,
					'country_from': country_from,
					'country_to': country_to
				},
				dataType: "json",
				beforeSend: function(){
					loadingWithMask('/images/default/loading_img.gif')
				},
				error: function() {
					alert('메뉴 복사처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						if (copy_type == "KEY") {
							getRecommendKeywordList(country_to);
						} else if (copy_type == "PRD") {
							getPopularProductList(country_to);
						}
						
						closeLoadingWithMask();
						
						alert(copy_name + "이(가) 복사되었습니다.");
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