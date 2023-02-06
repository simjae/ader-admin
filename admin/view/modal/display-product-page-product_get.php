<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
.tmp_container_PRD {
	margin-top:10px;display:flex;width:100%;flex-wrap:wrap;flex-direction:row;
}
.tmp_lib_product {
	width: 230px;height: 20px;line-height: 10px;background-color: #140f82;border-radius: 5px;color: #ffffff;font-size: 0.5px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;padding: 5px;margin-right: 5px;margin-top: 5px;float: left;
	cursor: pointer;
}
.add_lib_product_btn {
	width:100px;height:25px;text-align:center;padding:5px;barkground-color:#ffffff;border:1px solid #bfbfbf;
	cursor:pointer;
}
</style>
<div class="content__card" style="max-width:1000px;margin: 0;">
	<form id="frm-list_PRD" action="display/product/grid/lib/product/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="5">
		<input type="hidden" class="page" name="page" value="1">
		
		<input type="hidden" name="product_idx" value="<?=$product_idx?>">
		
		<div class="card__header">
			<div class="flex justify-between">
				<h3>상품 라이브러리 검색</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body" style="width:1000px;">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">상품 코드</div>
					<div class="content__row">
						<input type="text" style="width:90%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">상품 이름</div>
					<div class="content__row">
						<input type="text" style="width:90%;">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">바코드</div>
					<div class="content__row">
						<input type="text" style="width:90%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">옵션 이름</div>
					<div class="content__row">
						<input type="text" style="width:90%;">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="product_type_all" type="radio" name="product_type" value="ALL" checked>
						<label for="product_type_all">전체</label>
						
						<input id="product_type_b" type="radio" name="product_type" value="B" >
						<label for="product_type_b">일반 상품</label>
						
						<input id="product_type_s" type="radio" name="product_type" value="S" >
						<label for="product_type_s">세트 상품</label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div onclick="getLibraryProduct();"  class="blue__color__btn"><span>검색</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>검색 취소</span></div>
					<div onclick="addLibraryProduct();"  class="blue__color__btn"><span>상품 추가</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card" style="max-width:1000px;">
	<input type="hidden" class="action_type" name="action_type">
	<input type="hidden" class="action_name" name="action_name">
	
	<div class="card__header">
		<h3>상품 라이브러리 검색 결과</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="info__wrap " style="justify-content:space-between; align-items: center;">
			<div class="body__info--count">
				<div class="drive--left"></div>
				총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
			</div>
				
			<div class="content__row">
				<select style="width:163px;float:right;margin-right:10px;" lib_type="PRD" onChange="orderChange(this);">
					<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
					<option value="CREATE_DATE|ASC">등록일 순</option>
					<option value="PRODUCT_NAME|DESC">상품 이름 역순</option>
					<option value="PRODUCT_NAME|ASC">상품 이름 순</option>
					<option value="PRODUCT_CODE|DESC">상품 코드 역순</option>
					<option value="PRODUCT_CODE|ASC">상품 코드 순</option>
					<option value="PRODUCT_CODE|DESC">상품 재고 역순</option>
					<option value="PRODUCT_CODE|ASC">상품 재고 순</option>
				</select>
				<select name="rows" style="width:163px;margin-right:10px;float:right;" lib_type="PRD" onChange="rowsChange(this);">
					<option value="5" selected>5개씩보기</option>
					<option value="10">10개씩보기</option>
					<option value="20">20개씩보기</option>
					<option value="30">30개씩보기</option>
					<option value="50">50개씩보기</option>
					<option value="100">100개씩보기</option>
					<option value="200">200개씩보기</option>
					<option value="300">300개씩보기</option>
					<option value="500">500개씩보기</option>
				</select>
			</div>
		</div>
		
		<div class="tmp_container_PRD"></div>
		
		<div class="table table__wrap">
			<div class="overflow-x-auto">
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH>라이브러리 추가</TH>
							<TH style="width:5%;">No.</TH>
							<TH style="width:3%;">상품<br>구분</TH>
							<TH>스타일 코드</TH>
							<TH>컬러 코드</TH>
							<TH>상품 코드</TH>
							<TH>상품명</TH>
							<TH style="width:8%;">판매가<br>(한국몰)</TH>
							<TH style="width:8%;">판매가<br>(영문몰)</TH>
							<TH style="width:8%;">판매가<br>(중국몰)</TH>
						</TR>
					</THEAD>
					<TBODY class="result_table_PRD">
					</TBODY>
				</TABLE>
			</div>
		</div>
		<div class="padding__wrap">
			<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
			<div class="paging_PRD"></div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {	
	getLibraryProduct();
});

function getLibraryProduct() {
	let result_table = $(".result_table_PRD");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10" style="text-align:center;">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = $("#frm-list_PRD").find('.rows').val();
	var page = $("#frm-list_PRD").find('.page').val();
	
	get_contents($("#frm-list_PRD"),{
		pageObj : $(".paging_PRD"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td>';
				strDiv += '        <div class="add_lib_product_btn" onClick="setLibraryProduct(' + row.product_idx + ',\'' + row.product_code + '\',\'' + row.product_name + '\')">라이브러리 추가</div>'
				strDiv += '    </td>';
				strDiv += '    <td>' + row.num + '</td>';
				
				var product_type = "";
				if (row.product_type == "B") {
					product_type = "일반";
				} else if (row.product_type == "S") {
					product_type = "세트";
				}
				
				strDiv += '    <td>' + product_type + '</td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.style_code + '</font></td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.color_code + '</font></td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.product_code + '</font></td>';
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
					strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
				}
				
				strDiv += '    </td>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_en = row.discount_en;
				if (discount_en > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
				} else {
					strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
				}
				
				strDiv += '    </td>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_cn = row.discount_cn;
				if (discount_cn > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
				} else {
					strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
				}
				
				strDiv += '    </td>';
				strDiv += '</tr>';
				
				result_table.append(strDiv);
			});
		},
	},rows, page);
}

function checkLibraryProduct(product_idx) {
	let check_result = false;
	let product_idx_arr = [];
	let tmp_container = $('.tmp_container_PRD');
	
	let cnt = tmp_container.find('.tmp_lib_product').length;
	for (let i=0; i<cnt; i++) {
		let tmp_product_idx = parseInt(tmp_container.find('.tmp_lib_product').eq(i).attr('product_idx'));
		product_idx_arr.push(tmp_product_idx);
	}
	
	if (product_idx_arr.length > 0) {
		let duplicate_check = product_idx_arr.indexOf(product_idx);
		if (duplicate_check < 0) {
			check_result = true;
		}
	} else {
		return true;
	}
	
	return check_result;
}

function setLibraryProduct(product_idx,product_code,product_name) {
	let check_result = checkLibraryProduct(product_idx);
	
	if (check_result == true) {
		let strDiv = '<div class="tmp_lib_product" product_idx=' + product_idx + '>' + product_code + ' | ' + product_name + '</div>';
		$('.tmp_container_PRD').append(strDiv);
	} else {
		alert('중복된 상품은 선택할 수 없습니다.');
		return false;
	}
}

function addLibraryProduct(){
	let tmp_container = $('.tmp_container_PRD');
	
	let cnt = tmp_container.find('.tmp_lib_product').length;
	let product_idx = [];
	for (let i=0; i<cnt; i++) {
		let tmp_product_idx = tmp_container.find('.tmp_lib_product').eq(i).attr('product_idx');
		product_idx.push(tmp_product_idx);
	}
	
	if (product_idx.length > 0) {
		$.ajax({
			type: "post",
			url: config.api + "display/product/grid/lib/product/get",
			data: {
				"product_idx" : product_idx
			},
			dataType: "json",
			error: function() {
				alert("라이브러리 상품 추가 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					let data = d.data;
					if (data != null) {
						$('.product-grid').html('');
						let productImgWrap = document.querySelector('.product-grid');
						
						let strDiv = "";
						data.forEach(function(row) {
							strDiv += '<img id="' + row.product_code + '" class="library" draggable="true" data-lib_type="PRD" data-banner_type="-" data-banner_idx="0" data-product_idx="' + row.product_idx + '" data-product_code="' + row.product_code + '" data-content_location="' + row.img_location + '" src="' + row.img_location + '" alt="">';
						});
						
						productImgWrap.innerHTML = strDiv;
						
						libraryDragStart();
						modal_close();
					}
				}
			}
		});
	} else {
		alert('최소 1개 이상의 상품을 선택해야 합니다');
		return false;
	}
}
</script>