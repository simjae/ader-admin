<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
</style>

<div class="body">
	<h1>
		상품정보 일괄변경
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
	
	<div class="contents">
		<form id="frm-regist" action="product/put">
			<input type="hidden" name="product_idx_arr" value="<?=$product_idx_arr?>">
			
			<div class="row" style="margin-top:10px;">
				<TABLE id="insert_table_sales_info" class="list" style="font-size:0.7rem;">
					<TBODY>
						<TR>
							<TD colspan="6" style="width:100%;overflow:scroll;">
								<div class="row" style="width:1500px;height:300px;">
									<input type="hidden" name="md_category_1" value="">
									<input type="hidden" name="md_category_2" value="">
									<input type="hidden" name="md_category_3" value="">
									<input type="hidden" name="md_category_4" value="">
									<input type="hidden" name="md_category_5" value="">
									<input type="hidden" name="md_category_6" value="">
									
									<input type="hidden" name="category_idx" value="">
									
									<div id="md_category_1" depth="1" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_2" depth="2" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_3" depth="3" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_4" depth="4" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_5" depth="5" style="width:250px;height:100%;">
										
									</div>
									
									<div id="md_category_6" depth="6" style="width:250px;height:100%;">
										
									</div>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">한국몰 판매가격</TD>
							<TD>
								<input id="sales_price_kr" type="number" step="0.01" name="sales_price_kr" value="0">
							</TD>
							
							<TD style="width:10%;">영문몰 판매가격</TD>
							<TD>
								<input id="sales_price_en" type="number" step="0.01" name="sales_price_en" value="0">
							</TD>
							
							<TD style="width:10%;">중문몰 판매가격</TD>
							<TD>
								<input id="sales_price_cn" type="number" step="0.01" name="sales_price_cn" value="0">
							</TD>
						</TR>
						<TR>
							<TD style="width:10%;">구매멤버 제한</TD>
							<TD colspan="5">
								<div class="row form-group">
									<label>
										<input type="checkbox" name="limit_purchase_member[]" value="0">
										<span>전체</span>
									</label>
									
									<label>
										<input type="checkbox" name="limit_purchase_member[]" value="1">
										<span>ADER family</span>
									</label>
									
									<label>
										<input type="checkbox" name="limit_purchase_member[]" value="2">
										<span>일반회원</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">단독구매 제한</TD>
							<TD colspan="5">
								<div class="form-group row">
									<input id="limit_purchase_single" type="hidden" name="limit_purchase_single" value="">
									<label>
										<input class="limit_purchase_single" type="radio" name="limit_purchase_single_input" value="false" checked onClick="limitPurchaseSingleFlgClick(this);">
										<span>단독구매 제한 없음</span>
									</label>
									
									<label>
										<input class="limit_purchase_single" type="radio" name="limit_purchase_single_input" value="true" onClick="limitPurchaseSingleFlgClick(this);">
										<span>단독구매 제한</span>
									</label>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">구매수량 제한</TD>
							<TD colspan="5">
								<div class="row form-group">
									<label>
										<input class="limit_purchase_qty" type="radio" name="limit_purchase_qty" value="false" onClick="limitPurchaseQtyFlgClick(this);" checked>
										<span>구매수량 제한 없음</span>
									</label>
									
									<label>
										<input class="limit_purchase_qty" type="radio" name="limit_purchase_qty" value="true" onClick="limitPurchaseQtyFlgClick(this);">
										<span>구매수량 제한</span>
									</label>
								</div>
								
								<div id="limit_purchase_qty_input" class="row" style="display:none;margin-top:10px;">
									<input type="number" step="0" name="limit_purchase_qty_min_num" style="width:163px;" value="0">
									~
									<input type="number" step="0" name="limit_purchase_qty_max_num" style="width:163px;" value="0">
									<br>
									<font style="margin-top:5px;">*구매제한수량의 최대값이 없을 경우 0을 입력해 주세요.</font>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD colspan="6">
								<TABLE class="list" style="font-size:0.5rem;">
									<THEAD>
										<TR>
											<TH style="width:10%;">상품유형 선택</TH>
											<TH>
												<div class="form-group">
													<input type="hidden" name="refund_idx" value="">
													<select id="product_category" class="fSelect eSearch" name="product_category" style="width:163px;">
													</select>
													
													<button type="button" style="width:120px;height:30px;cursor:pointer;" onClick="getRefundInfo();">환불정보 조회</button>
												</div>
											</TH>
										</TR>
									</THEAD>
									<TBODY id="refund_body">
										
									</TBODY>
								</TABLE>
							</TD>
						</TR>
						
						<TR>
							<TD colspan="6">
								<div class="row">
									<input type="text" name="product_category" style="width:163px;margin-right:10px;" value="">
									<input type="text" name="refund_title" style="width:450px;" value="">
									<button type="button" style="width:50px;height:30px;background-color:#000000;color:#ffffff;float:right;cursor:pointer;" onClick="addDetailRefund();">등록</button>
								</div>
							</TD>
						</TR>

						<TR>
							<TD style="width:10%;">한국몰 추가 상세 정보<br>(교환/환불)</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="detail_refund_kr" name="detail_refund_kr" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>

						<TR>
							<TD style="width:10%;">영문몰 추가 상세 정보<br>(교환/환불)</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="detail_refund_en" name="detail_refund_en" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>

						<TR>
							<TD style="width:10%;">중문몰 추가 상세 정보<br>(교환/환불)</TD>
							<TD colspan="5">
								<textarea class="width-100p" id="detail_refund_cn" name="detail_refund_cn" required style="width:90%; height:150px;"></textarea>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">상품 검색어</TD>
							<TD colspan="2">
								<input type="text" name="product_keyword" value="">
							</TD>
							
							<TD style="width:10%;">상품 태그</TD>
							<TD colspan="2">
								<input type="text" name="product_tag" value="">
							</TD>
						</TR>
						
						<TR>
							<TD>관련상품 검색</TD>
							<TD colspan="5">
								<div class="row">
									<input id="relevant_idx" type="hidden" name="relevant_idx" value="">
									
									<select id="relevant_type" class="fSelect eSearch" name="product_category" style="width:163px;">
										<option value="product_name">상품 이름</option>
										<option value="product_code">상품 코드</option>
										<option value="product_category">상품 카테고리</option>
									</select>
									
									<input id="relevant_keyword" type="text" style="width:350px;" value="">
									
									<button type="button" style="width:120px;height:38px;float:right;cursor:pointer;" onClick="getRelevantProduct();">관련상품 검색</button>
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD>관련상품</TD>
							<TD colspan="5">
								<div id="relevant_list" class="row">
									관련상품 없음
								</div>
							</TD>
						</TR>
						
						<TR>
							<TD style="width:10%;">적립금 비율</TD>
							<TD colspan="5">
								<input type="number" step="0" name="mileage_per" style="width:163px;" value="2">%
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="productUpdateCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
var detail_refund_kr = [];
var detail_refund_en = [];
var detail_refund_cn = [];

function setSmartEditor() {
	//detail_refund
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_refund_kr,
		elPlaceHolder: "detail_refund_kr",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_refund_en,
		elPlaceHolder: "detail_refund_en",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: detail_refund_cn,
		elPlaceHolder: "detail_refund_cn",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
	});
}

$(document).ready(function() {
	setSmartEditor();
	getProductCategory(0,0);
	for (var i=0; i<6; i++) {
		var category_idx = $("input[name='md_category_" + (i+1) + "']").val();
		if (parseInt(category_idx) > 0) {
			var depth = $('#md_category_' + (i+1)).attr('depth');
			getProductCategory(parseInt(depth),category_idx);
		}
	}
	setProductCategory();
});

function setProductCategory() {
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "product/refund/get",
		error: function() {
			alert("환불정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					$('#product_category').html('');
					
					var strDiv = "";
					strDiv += '<option value="all" selected>검색분류 선택</option>';
					data.forEach(function(row) {
						strDiv += '<option value="' + row.product_category + '">' + row.product_category + '</option>';
					});
					
					$('#refund_body').html('');
					
					$('#product_category').unbind();
					$('#product_category').append(strDiv);
				}
			}
		}
	});
}


function getProductCategory(depth,no) {
	if (depth == 0) {
		depth = 1;
	} else {
		depth += 1;
	}
	$.ajax({
		type: "post",
		data: {
			'depth':depth,
			'no':no
		},
		dataType: "json",
		url: config.api + "product/common/get",
		error: function() {
			alert('MD 카테고리 정보를 불러오는데 실패했습니다.')
		},
		success: function(d) {
			if(d.code == 200) {
				setMdCategory(depth,d.data);
			}
		}
	});
}

function productCategoryClick(obj) {
	var depth = parseInt($(obj).parent().attr('depth'));
	var no = $(obj).attr('category_idx');
	
	for (var i=depth; i<=6; i++) {
		$('#md_category_' + i).children('.md_category').css('background-color','#ffffff');
		$('#md_category_' + i).children('.md_category').css('color','#000000');
		$('#md_category_' + i).children('.md_category').removeClass('checked');
		$('#md_category_' + i).children('.md_category').addClass('unchecked');
	}
	
	$(obj).removeClass('unchecked');
	$(obj).addClass('checked');
	
	var category_idx = $('#md_category_' + depth).children('.checked').attr('category_idx');
	
	$("input[name='md_category_" + depth + "']").val(category_idx);
	$("input[name='category_idx']").val(category_idx);
	
	for (var i=(depth+1); i<=6; i++) {
		$("input[name='md_category_" + i + "']").val(0);
	}
	
	getProductCategory(depth,no);
}

function setMdCategory(depth,d){
	var eCategory = $('#md_category_' + depth);
	eCategory.empty();
	
	for (var i=(depth+1); i<=6; i++) {
		$('#md_category_' + i).empty();
	}
	
	var category_idx = $("input[name='md_category_" + depth + "']").val();
	
	if (d != null) {
		d.forEach(function(row) {
			var checked = "";
			if (category_idx == row.no) {
				checked = "checked";
			} else {
				checked = "unchecked";
			}
			
			eCategory.append($('<div id="md_category_idx_' + row.no + '" class="md_category ' + checked + '" category_idx="' + row.no + '" style="width:100%;height:50px;border:1px solid #000000;cursor:pointer;" onClick="productCategoryClick(this);">' + row.text + '</div>'));
		});
	}	
}

function getRefundInfo() {
	var product_category = $('#product_category').val();
	$.ajax({
		type: "post",
		data: {
			'product_category':product_category
		},
		dataType: "json",
		url: config.api + "product/refund/get",
		error: function() {
			alert("환불정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					$('#refund_body').html('');
					var strDiv = "";
					data.forEach(function(row) {
						strDiv += '    <TR>';
						strDiv += '        <TD colspan="2">'
						strDiv += '            <div class="row">';
						strDiv += '                <font>' + row.refund_title + '</font>';
						strDiv += '                <button refund_idx="' + row.no + '" type="button" style="width:50px;height:30px;background-color:#E43A45;color:#ffffff;float:right;cursor:pointer;" onClick="removeDetailRefund(this);">삭제</button>';
						strDiv += '                <button refund_idx="' + row.no + '" type="button" style="width:50px;height:30px;background-color:#140f82;color:#ffffff;float:right;margin-right:10px;cursor:pointer;" onClick="setDetailRefund(this);">선택</button>';
						strDiv += '            </div>';
						strDiv += '    </TR>';
					});
					
					$('#refund_body').append(strDiv);
				}
			}
		}
	});
}

function setDetailRefund(obj) {
	var refund_idx = $(obj).attr('refund_idx');
	
	if (refund_idx != null) {
		$.ajax({
			type: "post",
			data: {
				'refund_idx':refund_idx
			},
			dataType: "json",
			url: config.api + "product/refund/get",
			error: function() {
				alert("환불정보 내용 불러오기 처리에 실패했습니다.");
			},
			success: function(data) {
				if(data.code == 200) {
					$("input[name='product_category']").val(data['data'][0].product_category);
					$("input[name='refund_title']").val(data['data'][0].refund_title);
					
					detail_refund_kr.getById["detail_refund_kr"].exec("SET_IR", [""]);
					detail_refund_kr.getById["detail_refund_kr"].exec("PASTE_HTML", [data['data'][0].refund_content_kr]);
					
					detail_refund_en.getById["detail_refund_en"].exec("SET_IR", [""]);
					detail_refund_en.getById["detail_refund_en"].exec("PASTE_HTML", [data['data'][0].refund_content_en]);
					
					detail_refund_cn.getById["detail_refund_cn"].exec("SET_IR", [""]);
					detail_refund_cn.getById["detail_refund_cn"].exec("PASTE_HTML", [data['data'][0].refund_content_cn]);
				}
			}
		});
	}
}

function addDetailRefund() {
	var product_category = $("input[name='product_category']").val();
	var refund_title = $("input[name='refund_title']").val();
	
	detail_refund_kr.getById["detail_refund_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_en.getById["detail_refund_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_cn.getById["detail_refund_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
	var refund_content_kr = $('#detail_refund_kr').val();
	var refund_content_en = $('#detail_refund_en').val();
	var refund_content_cn = $('#detail_refund_cn').val();
	
	if (product_category.length == 0 || product_category == null) {
		alert('환불정보 내용을 등록할 상품의 카테고리를 입력해주세요.');
		return false;
	}
	if (refund_title.length == 0 || refund_title == null) {
		alert('환불정보 내용의 제목을 입력해주세요.');
		return false;
	}
	
	if (
		(refund_content_kr.length == 0 || refund_content_kr == null) ||
		(refund_content_en.length == 0 || refund_content_en == null) ||
		(refund_content_cn.length == 0 || refund_content_cn == null)
	) {
		alert('환불정보 내용의 제목을 입력해주세요.');
		return false;
	}
	
	$.ajax({
		type: "post",
		data: {
			'product_category':product_category,
			'refund_title':refund_title,
			'refund_content_kr':refund_content_kr,
			'refund_content_en':refund_content_en,
			'refund_content_cn':refund_content_cn,
		},
		dataType: "json",
		url: config.api + "product/refund/add",
		error: function() {
			alert("환불정보 내용 등록 처리에 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
				setProductCategory();
			}
		}
	});
}

function removeDetailRefund(obj) {
	var refund_idx = $(obj).attr('refund_idx');
	
	if (refund_idx != null) {
		$.ajax({
			type: "post",
			data: {
				'refund_idx':refund_idx
			},
			dataType: "json",
			url: config.api + "product/refund/put",
			error: function() {
				alert("환불정보 내용 삭제 처리에 실패했습니다.");
			},
			success: function(data) {
				if(data.code == 200) {
					getRefundInfo();
				}
			}
		});
	}
}

function getRelevantList() {
	var relevant_idx = $('#relevant_idx').val();
	
	if (relevant_idx.length > 0) {
		$.ajax({
			type: "post",
			data: {
				'relevant_idx':relevant_idx,
			},
			dataType: "json",
			url: config.api + "product/relevant/get",
			error: function() {
				alert("관련상품정보 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;
					
					if (data != null) {
						$('#relevant_list').html('');
						var strDiv = "";
						
						var relevant_idx_arr = [];
						data.forEach(function(row) {
							relevant_idx_arr.push(row.no);
							strDiv += '<div style="width:45%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;">';
							strDiv += '    <font class="relevant_idx" relevant_idx="' + row.no + '">' + row.product_code + ' - ' + row.product_name + '</font>';
							strDiv += '    <font style="float:right;cursor:pointer;" onClick="setRelevantProduct(this);">x</font>';
							strDiv += '</div>';
						});
						
						if (relevant_idx_arr.length == 0) {
							$('#relevant_idx').val('0');
						} else {
							$('#relevant_idx').val(relevant_idx_arr);
						}
						
						$('#relevant_list').unbind();
						$('#relevant_list').append(strDiv);
					} else {
						alert('검색 결과가 없습니다. 관련상품 정보를 다시 입력해주세요.');
					}
				}
			}
		});
	}
}

function getRelevantProduct() {
	var relevant_type = $('#relevant_type').val();
	var relevant_keyword = $('#relevant_keyword').val();
	
	if (relevant_type != null && relevant_keyword != null) {
		$.ajax({
			type: "post",
			data: {
				'relevant_type':relevant_type,
				'relevant_keyword':relevant_keyword
			},
			dataType: "json",
			url: config.api + "product/relevant/get",
			error: function() {
				alert("관련상품정보 불러오기 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					var data = d.data;
					
					if (data != null) {
						$('#relevant_list').html('');
						var strDiv = "";
						
						var relevant_idx_arr = [];
						data.forEach(function(row) {
							relevant_idx_arr.push(row.no);
							strDiv += '<div style="width:45%;height:30px;background-color:#bdbdbd;color:#000000;border:1px solid #000000;border-radius:5px;padding:5px;margin-right:10px;margin-bottom:10px;">';
							strDiv += '    <font class="relevant_idx" relevant_idx="' + row.no + '">' + row.product_code + ' - ' + row.product_name + '</font>';
							strDiv += '    <font style="float:right;cursor:pointer;" onClick="setRelevantProduct(this);">x</font>';
							strDiv += '</div>';
						});
						
						if (relevant_idx_arr.length == 0) {
							$('#relevant_idx').val('0');
						} else {
							$('#relevant_idx').val(relevant_idx_arr);
						}
						
						$('#relevant_list').unbind();
						$('#relevant_list').append(strDiv);
					} else {
						alert('검색 결과가 없습니다. 관련상품 정보를 다시 입력해주세요.');
					}
				}
			}
		});
	} else {
		alert('검색 할 관련상품 정보를 정확히 입력해주세요.');
		return false;
	}
}

function setRelevantProduct(obj) {
	$(obj).parent().remove();
	
	var length = $('.relevant_idx').length;
	var relevant_idx_arr = [];
	for (var i=0; i<length; i++) {
		var relevant_idx = $('.relevant_idx').eq(i).attr('relevant_idx');
		relevant_idx_arr.push(relevant_idx);
	}
	
	if (relevant_idx_arr.length == 0) {
		$('#relevant_idx').val('0');
	} else {
		$('#relevant_idx').val(relevant_idx_arr);
	}
}

function limitPurchaseSingleFlgClick(obj) {
	var flg_val = $(obj).val();
	$('#limit_purchase_single').val(flg_val);
}

function limitPurchaseQtyFlgClick(obj) {
	var flg_val = $(obj).val();
	
	if (flg_val == 'true') {
		$('#limit_purchase_qty_input').show();
	} else {
		$('#limit_purchase_qty_input').hide();
		$("input[name='limit_purchase_qty_min_num']").val(0);
		$("input[name='limit_purchase_qty_max_num']").val(0);
	}
}

function setMdCategory(depth,d){
	var eCategory = $('#md_category_' + depth);
	eCategory.empty();
	
	for (var i=(depth+1); i<=6; i++) {
		$('#md_category_' + i).empty();
	}
	
	var category_idx = $("input[name='md_category_" + depth + "']").val();
	
	if (d != null) {
		d.forEach(function(row) {
			var checked = "";
			if (category_idx == row.no) {
				checked = "checked";
			} else {
				checked = "unchecked";
			}
			
			eCategory.append($('<div id="md_category_idx_' + row.no + '" class="md_category ' + checked + '" category_idx="' + row.no + '" style="width:100%;height:50px;border:1px solid #000000;cursor:pointer;" onClick="productCategoryClick(this);">' + row.text + '</div>'));
		});
	}	
}

function productUpdateCheck() {	
	detail_refund_kr.getById["detail_refund_kr"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_en.getById["detail_refund_en"].exec("UPDATE_CONTENTS_FIELD", []);
	detail_refund_cn.getById["detail_refund_cn"].exec("UPDATE_CONTENTS_FIELD", []);
	
	insertLog("상품관리 > 상품 정보 일괄 변경", "판매정보 일괄변경", null);
	modal_submit($('#frm-update'),'getUpdateProductInfo');
}
</script>