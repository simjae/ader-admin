<style>
.landing__left__area {width:17vw;height:79vh;padding:10px;}
	.main__banner__selector {width:100%;height:17vh;cursor:pointer;padding:5px;border:3px solid #000000;}
		.banner__selector__img {width:100%;height:100%;background-image:url('/images/main/main_banner_sample.jpg');background-repeat: no-repeat;background-size: cover;background-position: center;}
	.main__contents__selector {width:100%;height:30vh;margin-top:15px;cursor:pointer;padding:5px;}
		.contents__selector_img {width:100%;height:100%;background-image:url('/images/main/main_contents_sample.png');background-repeat: no-repeat;background-size: cover;background-position: center;}
	.main__images__selector {width:100%;height:17vh;margin-top:15px;cursor:pointer;padding:5px;}
		.images_selector_img {width:100%;height:100%;background-image:url('/images/main/main_images_sample.png');background-repeat: no-repeat;background-size: cover;background-position: center;}

.landing__right__area {width:71vw;height:79vh;}
	.banner__info__container {width:71vw;}
		.banner__select__wrap {width:71vw;height:35vh;display:block;}
			.banner__select__img__wrap {overflow-x:auto;width:100%;height:27vh;padding:15px;}
				.banner__select__img__slide {width:270%;display:flex;}
					.banner__select__img__area {width:18vw;height:21vh;border:1px solid #bfbfbf;margin-right:15px;padding:15px;cursor:pointer;}
						.banner__img {background-color:gray;width:100%;height:100%;}
			.banner__select__btn__wrap {height:5vh;display:flex;margin-top:15px;padding-top:8px;}
				.banner_regist_btn {width:120px;margin-right:15px;text-align:center;float:right;}
				.banner_delete_btn {width:120px;margin-right:15px;text-align:center;float:right;}
		
		.banner__data__wrap {width:71vw;height:39vh;display:flex;padding:15px;}
		.banner__data__btn__wrap {height:5vh;margin-top:15px;}
			.banner_update_btn {width:120px;height:30px;text-align:center;color:#ffffff;background-color:#000000;margin-right:15px;float:right;}
	
	.contents__info__container {width:71vw;display:none;}
		.contents__data__wrap {width:71vw;height:38vh;display:flex;padding:15px;}
		
		.contents__product__wrap {width:71vw;height:36vh;display:flex;padding:15px;}
			.wrap__bg--wh{background-color: #fff;padding: 10px;margin: 10px 0;}
			.product-tree {display: grid;gap: 20px;grid-template-columns: 400px 2fr;}
			.tree__chart h3 {line-height: 2;}
			.tree__desciption h3 {line-height: 2;}
			.tree__desciption textarea{width: 100%;border: 1px solid #c2cad8;padding: 5px;}
			.tree-btn-wrap {display: flex;gap: 5px;}
			.chart__button__wrap {display: flex;justify-content: space-between;padding: 10px 20px;}
			.chart__button {color: black;font-size: 15px;padding: 5px;border-radius: 5px;}
			.chart__button--move {width: 90px;height: 22px;border-radius: 2px;background-color: #140f82;font-size: 12px;color: #fff;padding: 4px 0;text-align: center;cursor: pointer;}
			#tree--search {padding: 10px;width: 100%;}
			.xi-search {padding: 10px;}
			.js--tree {padding-top:0px;}
			.desciption__table{border-left: solid 1px #ddd;border-spacing: 0;margin: 0;table-layout: fixed;}
			.access__ip__wrap{display: flex;margin-bottom: 10px;}
			.access__ip--add{font-size: 15px;padding: 5px;border-radius: 5px;margin-left: 10px;}
			.access__apply__btn{cursor: pointer;font-size: 16px;height: 36px;width: 130px;background-color: #140f82;border-radius: 2px;font-weight: normal;display: flex;color: #f5f6fa;align-items: center;justify-content: center;font-weight: normal;}
			.access__apply__wrap{display: flex;justify-content: center;margin-top: 10px;}
			.classify__btn{width: 70px;height: 22px;border-radius: 2px;text-align: center;border: solid 1px #707070;background-color: #fff;padding: 4px 0;font-size: 12px;cursor: pointer;}
			.search__box{display: flex;box-shadow: inset 1px 1px 5px 0 rgba(0,0,0,0.16);}
			
		.contents__data__btn__wrap {height:5vh;margin-top:15px;}
			.contents_update_btn {width:120px;height:30px;text-align:center;color:#ffffff;background-color:#000000;margin-right:15px;float:right;}
	
	.images__info__container {width:71vw;display:none;}
		.images__select__wrap {width:71vw;height:35vh;display:block;}
			.images__select__img__wrap {overflow-x:auto;width:100%;height:27vh;padding:15px;}
				.images__select__img__slide {width:200%;display:flex;}
					.images__select__img__area {width:9vw;height:18vh;border:1px solid #bfbfbf;margin-right:15px;padding:15px;cursor:pointer;}
						.images__img {background-color:gray;width:100%;height:100%;}
			.images__select__btn__wrap {height:5vh;display:flex;margin-top:15px;padding-top:8px;}
				.images_regist_btn {width:120px;margin-right:15px;text-align:center;float:right;}
				.images_delete_btn {width:120px;margin-right:15px;text-align:center;float:right;}
		
		.images__data__wrap {width:71vw;height:39vh;display:flex;padding:15px;}
		.images__data__btn__wrap {height:5vh;margin-top:15px;}
			.images_update_btn {width:120px;height:30px;text-align:center;color:#ffffff;background-color:#000000;margin-right:15px;float:right;}
</style>

<?php
	/*$admin_idx = 0;
	if (isset($_SESSION['ADMIN_IDX'])) {
		$admin_idx = $_SESSION['ADMIN_IDX'];
	}
	
	if ($admin_idx == 0) {
		echo "
			<script>
				location.href = '/login';
			</script>
		";
	}*/
?>

<div class="filter-wrap" style="margin-bottom:20px">
	<button class="landing_tab_btn tap__button" country="KR" style="background-color:#000;color:#fff;font-weight:500;width:180px;" onClick="landingTabBtnClick(this);">한국몰</button>
	<button class="landing_tab_btn tap__button" country="EN" style="width:180px;" onClick="landingTabBtnClick(this);">영문몰</button>
	<button class="landing_tab_btn tap__button" country="CN" style="width:180px;" onClick="landingTabBtnClick(this);">중문몰</button>
</div>

<input id="country" type="hidden" value="KR">

<div id="landing_tab_KR" class="landing_tab">
	<?php include_once("display-landing-kr.php"); ?>
</div>

<div id="landing_tab_EN" class="landing_tab" style="display:none;">
	<?php include_once("display-landing-en.php"); ?>
</div>

<div id="landing_tab_CN" class="landing_tab" style="display:none;">
	<?php include_once("display-landing-cn.php"); ?>
</div>

<script>
$(document).ready(function() {
	
});

function landingTabBtnClick(obj) {
	let country = $(obj).attr('country');
	$('#country').val(country);
	
	$('.landing_tab').hide();
	$('#landing_tab_' + country).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.landing_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.landing_tab_btn').not($(obj)).css('color','#000000');
}

function toggleContainer(country,selector_type) {
	$('.selector_' + country).css('border','none');
	$('.selector_' + selector_type + '_' + country).css('border','3px solid #000000');
	
	let div_tab = $('#landing_tab_' + country);
	div_tab.find('.selected_container').hide();
	
	let div = $('.container_' + selector_type + '_' + country);
	div.show();
	
	if (selector_type == "CNT") {
		getMainContentsInfo(country);
	}
}

function clickMainBanner(obj) {
	let country = $('#country').val();
	
	let banner_idx = $(obj).attr('banner_idx');
	let select = $(obj).attr('select');
	
	let div_container = $('.container_BNR_' + country);
	let div_img = div_container.find('.banner__select__img__area');
	div_img.css('border','1px solid #bfbfbf');
	div_img.attr('select','false');
	
	if (select != "true") {
		$(obj).attr('select','true')
		$(obj).css('border','3px solid #000000');
		
		getMainBannerInfo(country,banner_idx);
	} else {
		$(obj).attr('select','false')
		$(obj).css('border','1px solid #bfbfbf');
		
		resetMainBannerInfo(country);
	}
}

function resetMainBannerInfo(country) {
	let frm = $('#frm-put_BNR_' + country);
	let div_container = $('.container_BNR_' + country);
	let div_data = div_container.find('.banner__data__wrap');
	
	div_container.find('.recent_idx').val(0);
	div_container.find('.recent_num').val(0);
	
	frm.find('.banner_idx').val(0);
	
	div_data.find('.bg_color_BL').prop('checked',true);
	div_data.find('.bg_color_WH').prop('checked',false);
	
	div_data.find('.title').val('');
	div_data.find('.sub_title').val('');
	div_data.find('.btn1_name').val('');
	div_data.find('.btn1_url').val('');
	div_data.find('.btn2_name').val('');
	div_data.find('.btn2_url').val('');
}

function getMainBannerInfo(country,banner_idx) {
	let frm = $('#frm-put_BNR_' + country);
	let div_container = $('.container_BNR_' + country);
	let div_data = div_container.find('.banner__data__wrap');
	
	frm.find('.banner_idx').val(banner_idx);
	div_data.find('.background_color').prop('checked',false);
	
	$.ajax({
		type: "post",
		data: {
			'banner_idx' : banner_idx
		},
		dataType: "json",
		url: config.api + "display/landing/banner/get",
		error: function() {
			alert("메인 배너 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					data.forEach(function(row) {
						div_container.find('.recent_idx').val(row.banner_idx);
						div_container.find('.recent_num').val(row.display_num);
						
						let bg_color = row.background_color;
						div_data.find('.bg_color_' + bg_color).prop('checked',true);
						div_data.find('.title').val(row.title);
						div_data.find('.sub_title').val(row.sub_title);
						
						let btn1_display_flg = row.btn1_display_flg;
						if (btn1_display_flg == true) {
							$('#BNR_btn1_display_flg_TRUE_' + country).prop('checked',true);
							$('#BNR_btn1_display_flg_FALSE_' + country).prop('checked',false);
						} else {
							$('#BNR_btn1_display_flg_TRUE_' + country).prop('checked',false);
							$('#BNR_btn1_display_flg_FALSE_' + country).prop('checked',true);
						}
						
						let btn2_display_flg = row.btn2_display_flg;
						if (btn2_display_flg == true) {
							$('#BNR_btn2_display_flg_TRUE_' + country).prop('checked',true);
							$('#BNR_btn2_display_flg_FALSE_' + country).prop('checked',false);
						} else {
							$('#BNR_btn2_display_flg_TRUE_' + country).prop('checked',false);
							$('#BNR_btn2_display_flg_FALSE_' + country).prop('checked',true);
						}
						
						div_data.find('.btn1_name').val(row.btn1_name);
						div_data.find('.btn1_url').val(row.btn1_url);
						div_data.find('.btn2_name').val(row.btn2_name);
						div_data.find('.btn2_url').val(row.btn2_url);
					});
				}
				
			}
		}
	});
}

function getMainBannerInfoList(country) {
	let div_container = $('.container_BNR_' + country);
	let div_slide = div_container.find('.banner__select__img__slide');
	div_slide.html('');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country
		},
		dataType: "json",
		url: config.api + "display/landing/banner/list/get",
		error: function() {
			alert("메인 배너 리스트 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						let background_url = "background-image:url('" + row.img_location + "');background-repeat: no-repeat;background-size:cover;background-position:center;";
						
						strDiv += '<div class="banner__select__img__area display_img" country="' + country + '" banner_idx="' + row.banner_idx + '" select="false" onClick="clickMainBanner(this)">';
						strDiv += '    <div class="banner__img" style="' + background_url + '"></div>';
						strDiv += '</div>';
					});
					
					div_slide.append(strDiv);
				}
			}
			/*else {
				if (d.code == 400) {
					confirm(
						d.msg,
						function() {
							location.href="/login";
						}
					);
					
				}
			}*/
		}
	});
}

function addMainBannerInfo(country) {
	let div_container = $('.container_BNR_' + country);
	let div_slide = div_container.find('.banner__select__img__slide');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country
		},
		dataType: "json",
		url: config.api + "display/landing/banner/add",
		error: function() {
			alert("메인 배너 추가처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let banner_idx = d.banner_idx;
				
				let strDiv = "";
				strDiv += '<div class="banner__select__img__area display_img" banner_idx="' + banner_idx + '" select="false" onClick="clickMainBanner(this)">';
				strDiv += '    <div class="banner__img"></div>';
				strDiv += '</div>';
				
				div_slide.prepend(strDiv);
			} else {
				alert("메인 배너 추가처리에 실패했습니다.");
			}
		}
	});
}

function putMainBannerInfo(country) {
	let frm = $('#frm-put_BNR_' + country);
	let div_container = $('.container_BNR_' + country);
	let div_data = div_container.find('.banner__data__wrap');
	
	let banner_idx = frm.find('.banner_idx').val();
	
	if (banner_idx > 0) {
		var formData = new FormData();
		formData = frm.serializeObject();
		
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/landing/banner/put",
			error: function() {
				alert("메인 배너 수정처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					getMainBannerInfo(country,banner_idx);
					alert('선택한 메인 배너가 수정되었습니다.');
				} else {
					alert("메인 배너 수정처리에 실패했습니다. 수정하려는 메인 배너를 확인해주세요.");
				}
			}
		});
	} else {
		alert('수정하려는 메인 배너를 선택해주세요.');
		return false;
	}
}

function deleteMainBanner(country) {
	confirm(
		'삭제한 메인 배너는 복구할 수 없습니다. 정말 삭제하시겠습니까?',
		function() {
			let frm = $('#frm-put_BNR_' + country);
			let banner_idx = frm.find('.banner_idx').val();
			
			if (banner_idx > 0) {
				$.ajax({
					type: "post",
					data: {
						'banner_idx' : banner_idx,
						'country' : country
					},
					dataType: "json",
					url: config.api + "display/landing/banner/delete",
					error: function() {
						alert("메인 배너 삭제처리에 실패했습니다.");
					},
					success: function(d) {
						if(d.code == 200) {
							getMainBannerInfoList(country);
							alert("선택한 메인 배너가 삭제되었습니다.");
						} else {
							alert("메인 배너 삭제처리에 실패했습니다. 삭제하려는 메인 배너를 확인해주세요.");
						}
					}
				});
			} else {
				alert('삭제하려는 메인 배너를 선택해주세요.');
			}
		}
	)
}

function getMainContentsInfo (country) {
	let frm = $('#frm-put_CNT_' + country);
	let div_container = $('.container_CNT_' + country);
	let div_data = div_container.find('.contents__data__wrap');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country
		},
		dataType: "json",
		url: config.api + "display/landing/contents/get",
		error: function() {
			alert("메인 컨텐츠 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					data.forEach(function(row) {
						frm.find('.contents_idx').val(row.contents_idx);
						div_data.find('.title').val(row.title);
						div_data.find('.sub_title').val(row.sub_title);
						
						let btn1_display_flg = row.btn1_display_flg;
						if (btn1_display_flg == true) {
							$('#CNT_btn1_display_flg_TRUE_' + country).prop('checked',true);
							$('#CNT_btn1_display_flg_FALSE_' + country).prop('checked',false);
						} else {
							$('#CNT_btn1_display_flg_TRUE_' + country).prop('checked',false);
							$('#CNT_btn1_display_flg_FALSE_' + country).prop('checked',true);
						}
						
						let btn2_display_flg = row.btn2_display_flg;
						if (btn2_display_flg == true) {
							$('#CNT_btn2_display_flg_TRUE_' + country).prop('checked',true);
							$('#CNT_btn2_display_flg_FALSE_' + country).prop('checked',false);
						} else {
							$('#CNT_btn2_display_flg_TRUE_' + country).prop('checked',false);
							$('#CNT_btn2_display_flg_FALSE_' + country).prop('checked',true);
						}
						
						div_data.find('.btn1_name').val(row.btn1_name);
						div_data.find('.btn1_url').val(row.btn1_url);
						div_data.find('.btn2_name').val(row.btn2_name);
						div_data.find('.btn2_url').val(row.btn2_url);
					});
				}
			}
		}
	});
	
	let tree_length = $('.js--tree_KR').children().length;
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
			let md_category_node = 0;
			let md_category_depth = 0;
			
			sel_node = data.node;
			md_category_node = sel_node.original.no;
			md_category_depth = sel_node.parents.length;
			
			getMainContentsProduct(country,md_category_node,md_category_depth);
		});
	}
}

function getMainContentsProduct(country,md_category_node,md_category_depth) {
	let result_table = $('.result_table_KR');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'md_category_node' : md_category_node,
			'md_category_depth' : md_category_depth
		},
		dataType: "json",
		url: config.api + "display/landing/contents/product/get",
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
							strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + row.product_idx + '" onClick="putMainContentsProduct(this);">선택</div>';	
						} else if (action_type == "DEL") {
							strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + row.product_idx + '" onClick="putMainContentsProduct(this);">선택완료</div>';	
						}
						
						strDiv += '    </td>';
						strDiv += '    <td>' + row.product_code + '</td>';
						strDiv += '    <TD>';
						strDiv += '        <div class="product__img__wrap">';
						
						var background_url = "background-image:url('" + row.img_location + "');";
						
						strDiv += '            <div class="product__img" style="' + background_url + '">';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p>' + row.product_name + '</p><br>';
						strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						
						strDiv += '    <td style="text-align: right;">';
						var discount_kr = row.discount_kr;
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
						
						strDiv += '    <td style="text-align: right;">';
						var discount_en = row.discount_en;
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
						
						strDiv += '    <td style="text-align: right;">';
						var discount_cn = row.discount_cn;
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
						strDiv += '</tr>';
					});
					
					result_table.append(strDiv);
				} else {
					let strDiv = "";
					strDiv += '<tr>';
					strDiv += '	<td colspan="6">조회 결과가 없습니다.</td>';
					strDiv += '</tr>';
					
					result_table.append(strDiv);
				}
			}
		}
	});
}

function putMainContentsInfo(country) {
	let frm = $('#frm-put_CNT_' + country);
	let div_container = $('.container_CNT_' + country);
	let div_data = div_container.find('.contents__data__wrap');
	
	let contents_idx = frm.find('.contents_idx').val();
	
	if (contents_idx > 0) {
		var formData = new FormData();
		formData = frm.serializeObject();
		
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/landing/contents/put",
			error: function() {
				alert("메인 컨텐츠 수정처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert('선택한 메인 컨텐츠가 수정되었습니다.');
					getMainContentsInfo(country,contents_idx);
				} else {
					alert("메인 컨텐츠 수정처리에 실패했습니다. 수정하려는 메인 컨텐츠를 확인해주세요.");
				}
			}
		});
	} else {
		alert('수정하려는 메인 컨텐츠를 선택해주세요.');
		return false;
	}
}

function putMainContentsProduct(obj) {
	let country = $('#country').val();
	let action_type = $(obj).attr('action_type');
	let product_idx = $(obj).attr('product_idx');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'action_type' : action_type,
			'product_idx' : product_idx
		},
		dataType: "json",
		url: config.api + "display/landing/contents/product/put",
		error: function() {
			alert("메인 컨텐츠 수정처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let strDiv = "";
				if (action_type == "ADD") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;background-color:#000000;color:white;" action_type="DEL" product_idx="' + product_idx + '" onClick="putMainContentsProduct(this);">선택완료</div>';	
				} else if (action_type == "DEL") {
					strDiv += '    <div class="btn" style="width:80px;text-align:center;" action_type="ADD" product_idx="' + product_idx + '" onClick="putMainContentsProduct(this);">선택</div>';	
				}
				
				let div_parent = $(obj).parent();
				div_parent.html(strDiv);
			} else {
				alert("메인 컨텐츠 상품 선택처리에 실패했습니다. 선택하려는 메인 컨텐츠의 상품을 확인해주세요.");
			}
		}
	});
}

function clickMainImages(obj) {
	let country = $('#country').val();
	
	let img_idx = $(obj).attr('img_idx');
	let select = $(obj).attr('select');
	
	let div_container = $('.container_IMG_' + country);
	let div_img = div_container.find('.images__select__img__area');
	div_img.css('border','1px solid #bfbfbf');
	div_img.attr('select','false');
	
	if (select != "true") {
		$(obj).attr('select','true')
		$(obj).css('border','3px solid #000000');
		
		getMainImagesInfo(country,img_idx);
	} else {
		$(obj).attr('select','false')
		$(obj).css('border','1px solid #bfbfbf');
		
		resetMainImagesInfo();
	}
}

function resetMainImagesInfo(country) {
	let frm = $('#frm-put_IMG_' + country);
	let div_container = $('.container_IMG_' + country);
	let div_data = div_container.find('.images__data__wrap');
	
	div_container.find('.recent_idx').val(0);
	div_container.find('.recent_num').val(0);
	
	frm.find('.img_idx').val(0);
	
	div_data.find('.bg_color_BL').prop('checked',true);
	div_data.find('.bg_color_WH').prop('checked',false);
	
	div_data.find('.title').val('');
	div_data.find('.sub_title').val('');
	div_data.find('.btn1_name').val('');
	div_data.find('.btn1_url').val('');
}

function getMainImagesInfo(country,img_idx) {
	let frm = $('#frm-put_IMG_' + country);
	let div_container = $('.container_IMG_' + country);
	let div_data = div_container.find('.images__data__wrap');
	
	frm.find('.img_idx').val(img_idx);
	div_data.find('.background_color').prop('checked',false);
	
	$.ajax({
		type: "post",
		data: {
			'img_idx' : img_idx
		},
		dataType: "json",
		url: config.api + "display/landing/images/get",
		error: function() {
			alert("메인 이미지 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					data.forEach(function(row) {
						div_container.find('.recent_idx').val(row.img_idx);
						div_container.find('.recent_num').val(row.display_num);
						
						let bg_color = row.background_color;
						div_data.find('.bg_color_' + bg_color).prop('checked',true);
						div_data.find('.title').val(row.title);
						
						let btn_display_flg = row.btn_display_flg;
						if (btn_display_flg == true) {
							$('#IMG_btn_display_flg_TRUE_' + country).prop('checked',true);
							$('#IMG_btn_display_flg_FALSE_' + country).prop('checked',false);
						} else {
							$('#IMG_btn_display_flg_TRUE_' + country).prop('checked',false);
							$('#IMG_btn_display_flg_FALSE_' + country).prop('checked',true);
						}
						
						div_data.find('.btn_name').val(row.btn_name);
						div_data.find('.btn_url').val(row.btn_url);
					});
				}
				
			}
		}
	});
}

function getMainImagesInfoList(country) {
	let div_container = $('.container_IMG_' + country);
	let div_slide = div_container.find('.images__select__img__slide');
	div_slide.html('');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country
		},
		dataType: "json",
		url: config.api + "display/landing/images/list/get",
		error: function() {
			alert("메인 이미지 리스트 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						let background_url = "background-image:url('" + row.img_location + "');background-repeat: no-repeat;background-size:cover;background-position:center;";
						
						strDiv += '<div class="images__select__img__area display_img" img_idx="' + row.img_idx + '" select="false" onClick="clickMainImages(this)">';
						strDiv += '    <div class="images__img" style="' + background_url + '"></div>';
						strDiv += '</div>';
					});
					
					div_slide.append(strDiv);
				}
				
			}
		}
	});
}

function addMainImages(country) {
	let div_container = $('.container_IMG_' + country);
	let div_slide = div_container.find('.images__select__img__slide');
	
	$.ajax({
		type: "post",
		data: {
			'country' : country
		},
		dataType: "json",
		url: config.api + "display/landing/images/add",
		error: function() {
			alert("메인 이미지 추가처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				console.log(d);
				let img_idx = d.img_idx;
				
				let strDiv = "";
				strDiv += '<div class="images__select__img__area display_img" img_idx="' + img_idx + '" select="false" onClick="clickMainImages(this)">';
				strDiv += '    <div class="images__img"></div>';
				strDiv += '</div>';
				
				div_slide.prepend(strDiv);
			} else {
				alert("메인 이미지 추가처리에 실패했습니다.");
			}
		}
	});
}

function putMainImagesInfo(country) {
	let frm = $('#frm-put_IMG_' + country);
	let div_container = $('.container_IMG_' + country);
	let div_data = div_container.find('.images__data__wrap');
	
	let img_idx = frm.find('.img_idx').val();
	
	if (img_idx > 0) {
		var formData = new FormData();
		formData = frm.serializeObject();
		
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/landing/images/put",
			error: function() {
				alert("메인 이미지 수정처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert('선택한 메인 이미지가 수정되었습니다.');
					getMainBannerInfo(country,img_idx);
				} else {
					alert("메인 이미지 수정처리에 실패했습니다. 수정하려는 메인 이미지를 확인해주세요.");
				}
			}
		});
	} else {
		alert('수정하려는 메인 이미지를 선택해주세요.');
		return false;
	}
}

function deleteMainImages(country) {
	let frm = $('#frm-put_IMG_' + country);
	let img_idx = frm.find('.img_idx').val();
	
	if (img_idx > 0) {
		$.ajax({
			type: "post",
			data: {
				'img_idx' : img_idx,
				'country' : country
			},
			dataType: "json",
			url: config.api + "display/landing/images/delete",
			error: function() {
				alert("메인 이미지 삭제처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					getMainImagesInfoList(country);
					alert("선택한 메인 이미지가 삭제되었습니다.");
				} else {
					alert("메인 이미지 삭제처리에 실패했습니다. 삭제하려는 메인 이미지를 확인해주세요.");
				}
			}
		});
	} else {
		alert('삭제하려는 메인 이미지를 선택해주세요.');
		return false;
	}
}

function displayNumCheck(obj) {
	let country = $('#country').val();
	let obj_type = $(obj).attr('obj_type');
	let action_type = $(obj).attr('action_type');
	
	let div_container = $('.container_' + obj_type + '_' + country);
	let recent_idx = div_container.find('.recent_idx').val();
	let recent_num = div_container.find('.recent_num').val();
	
	if (recent_idx > 0 && recent_num > 0) {
		let div_slide = div_container.find('.banner__select__img__slide');
		let cnt = div_slide.find('.display_img').length;
		
		if (action_type == "up") {
			if (recent_num == 1) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				updateDisplayNum(country,obj_type,action_type,recent_idx,recent_num);
			}
		} else if (action_type == "down") {
			if (recent_num == cnt) {
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
	let dir_api = "";
	if (obj_type == "BNR") {
		dir_api = "banner";
	} else if (obj_type = "IMG") {
		dir_api = "images";
	}
	
	$.ajax({
		url: config.api + "display/landing/" + dir_api + "/put",
		type: "post",
		data: {
			'display_num_flg': true,
			'country': country,
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
				let data = d.data;
				if (obj_type == "BNR") {
					getMainBannerInfoList(country);
				} else if (obj_type == "IMG") {
					getMainImagesInfoList(country);
				}
			} else {
				alert('진열순서 변경 처리에 실패했습니다. 변경하려는 진열순서를 확인해주세요.');
			}
		}
	});
}
</script>