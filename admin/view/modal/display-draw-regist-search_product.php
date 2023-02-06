<style>
#seo {
	margin-top : 50px;
}
.sub {
	margin-top : 10px;
}
.tmp_set_product {
	width:230px;
	height:20px;
	line-height:10px;
	background-color:#140f82;
	border-radius:5px;
	color:#ffffff;
	font-size:0.5px;
	overflow:hidden;
	text-overflow:ellipsis;
	white-space:nowrap;
	padding:5px;
	margin-right:5px;
	margin-top:5px;
	float:left;
	cursor:pointer;
}
.btn-close{float:right;color:'#000';}
</style>
<div class="content__card" style="margin: 0;">
	<form id="frm-product_add" action="order/modal/list/get">
        <input type="hidden" name="regist_type" value="PREORDER">	
        <input class="page" type="hidden" name="page" value="1">
		<input class="rows" type="hidden" name="rows" value="5">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="IDX">
		
		<div class="card__header">
			<h3>
			상품 목록
				<a onclick="modal_close();" class="btn-close">
					<i class="xi-close"></i>
				</a>
			</h3>
		</a>
		</div>
		
		<div class="card__body">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">상품 코드</div>
					<div class="content__row">
						<input type="text" name="product_code">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">상품명</div>
					<div class="content__row">
                        <input type="text" name="product_name">
					</div>
				</div>
			</div>
			<div class="card__footer">
				<div class="footer__btn__wrap">
					<div class="tmp" toggle="tmp"></div>
					<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getModalProductList();"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_fileter('frm-product_add','getModalProductList()');"><span>초기화</span></div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<form id="frm-list">
		<div class="card__header">
			<h3>상품 목록 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="changeOrderProduct(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
						<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
						<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
						<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
						<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
						<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
						<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="changeRowsProduct(this);">
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
			
			<div class="table table__wrap">
				<div class="overflow-x-auto">
					<TABLE>
                        <colsgroup>
                            <col width="3%">
                            <col width="10%">
                            <col width="5%">
                            <col width="10%">
                            <col width="auto">
                            <col width="7%">
                            <col width="7%">
                            <col width="7%">
                        </colsgroup>
						<THEAD>
							<TR>
								<TH style="width:3%;">
								</TH>
								<TH>스타일 코드</TH>
								<TH>컬러 코드</TH>
								<TH>상품 코드</TH>
								<TH>상품명</TH>
								<TH style="width:8%;">판매가<br>(한국몰)</TH>
								<TH style="width:8%;">판매가<br>(영문몰)</TH>
								<TH style="width:8%;">판매가<br>(중국몰)</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table">
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="modal_product_paging"></div>
        	</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
                <div class="tmp" toggle="tmp"></div>
				<div class="btn__wrap--lg" style="display:block">
					<div class="defult__color__btn" style="margin:0 auto" onClick="closeModal();"><span>돌아가기</span></div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function() {
	getModalProductList();
});

function changeOrderProduct(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-product_add').find('.sort_value').val(order_value[0]);
	$('#frm-produc_add').find('.sort_type').val(order_value[1]);

	getModalProductList();
}

function changeRowsProduct(obj) {
	var rows = $(obj).val();
	
	$('#frm-product_add').find('.rows').val(rows);
	$('#frm-product_add').find('.page').val(1);

	getModalProductList();
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
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

function getModalProductList() {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="8">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	let rows = $("#frm-product_add").find('.rows').val();
	let page = $("#frm-product_add").find('.page').val();

	get_contents($("#frm-product_add"),{
		pageObj : $(".modal_product_paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			d.forEach(function(row) {
				let strDiv = "";
				
				strDiv += '<TR>';
				strDiv += '    <td>';
				strDiv += '        <button class="table__setting__btn" product_idx="' + row.product_idx + '" onclick="addDrawProduct(this)">선택</button>';
				strDiv += '    </td>';
				
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

				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function addDrawProduct(obj) {
	confirm('드로우 상품으로 지정하시겠습니까?',function(){
        let product_idx = $(obj).attr('product_idx');
        var strDiv = '';
        strDiv += '<TD class="default_td" colspan="9">';
        strDiv += '    조회 결과가 없습니다';
        strDiv += '</TD>';
        $('#draw_product_table').html('');
        $('#draw_product_table').append(strDiv);

        $.ajax({
            url: config.api + "order/modal/get",
            type: "post",
            data: {
                'product_idx': product_idx,
                'regist_type' : 'DRAW'
            },
            dataType: "json",
            error: function() {
                alert('상품 읽기 처리중 오류가 발생했습니다.');
            },
            success: function(d) {
                let code = d.code;
                if (code == 200) {
					$('#draw_product_table').html('');
                    var rowspan_num = 0;
                    var data = d.data[0];
                    var option_info = data.option_info;

                    if(option_info != null && option_info.length > 0){
                        rowspan_num = option_info.length;
                    }
                    var strDiv = `
                        <tr>
                            <td rowspan="${rowspan_num}">
                                <div class="btn" onclick="searchProductModal();">상품변경</div>
                            </td>
                            <td rowspan="${rowspan_num}">
                                <p style="margin-bottom:5px;"></p>
                                <div class="product__img__wrap">
                                    <div class="product__img"
                                        style="background-image:url('${data.img_location}');">
                                    </div>
                                    <span>
                                        <p>${data.product_code}</p><br>
                                        <p>${data.product_name}</p><br>
                                        <p>${data.sales_price_kr.toLocaleString('ko-KR')} ₩</p><br>
                                        <p>Color : ${data.color}</p><br>
                                    </span>
                                </div>
                            </td>
                    `;

					var optionDiv = '';
					option_info.forEach(function(row, index){
						if(index == 0){
							optionDiv += '';
						}
						else{
							optionDiv += `
							<tr>
							`;
						}

						var kr_sail_qty = 0;
						var en_sail_qty = 0;
						var cn_sail_qty = 0;
						if(row.qty_info != null){
							row.qty_info.forEach(function(qty_row){
								switch(qty_row.country){
									case 'KR':
										kr_sail_qty = (qty_row.product_qty == null) ? 0 : qty_row.product_qty;
										break;
									case 'EN':
										en_sail_qty = (qty_row.product_qty == null) ? 0 : qty_row.product_qty;
										break;
									case 'CN':
										cn_sail_qty = (qty_row.product_qty == null) ? 0 : qty_row.product_qty;
										break;
								}
							})
						}
						var posible_cnt_param = row.product_qty - kr_sail_qty - en_sail_qty - cn_sail_qty;
						if(posible_cnt_param < 0 ){
							posible_cnt_param = 0;
						}
						optionDiv += `
								<td>
									<input type="hidden" class="barcode_param" value="${row.barcode}">
									${row.barcode}
								</td>
								<td>
									<input type="hidden" class="option_name_param" value="${row.option_name}">
									${row.option_name}
								</td>
								<td>${row.product_qty}</td>
								<td>${kr_sail_qty}</td>
								<td>${en_sail_qty}</td>
								<td>${cn_sail_qty}</td>
								<td>
									<input type="hidden" class="posible_cnt_param" value="${posible_cnt_param}">
									<input type="hidden" class="option_idx_param" value="${row.option_idx}">
									<input type="number" class="product_qty_param" value=""
										style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
								</td>
							</tr>
						`;
					})
					strDiv += optionDiv;

					$('#draw_product_table').append(strDiv);
					$('input[name="product_idx"]').val(product_idx);

					$('.product_qty_param').keyup(function () {
						var posible_cnt_obj = $(this).parent().find('.posible_cnt_param').eq(0)
						var write_qty = parseInt($(this).val());
						var temp_qty = '';

						if (isNaN(write_qty)) {
							temp_qty = '0';
						}
						else {
							if(parseInt(posible_cnt_obj.val()) < write_qty){
								temp_qty = parseInt(posible_cnt_obj.val());
							}
							else{
								temp_qty = write_qty;
							}
						}
						$(this).val(temp_qty);
					})
					
					alert('상품이 선택되었습니다. 드로우 등록을 진행해주세요', function (){
						modal_close();
					})
                } else {
                    alert('상품 읽기에 실패했습니다.');
                    return false;
                }
            }
        });
    });
}

function addSetProduct() {
    confirm('드로우 상품으로 결정하시겠습니까?',function(){
        //let set_product_list = $('#set_product_list').val();
        var list_cnt = $('.tmp_set_product_wrap').children().length;
        $('#set_product_list_area').css('visibility','visible');
        $('#set_product_table').html('');
        for(var i = 0; i < list_cnt; i++){
            var sel_prod = $('.tmp_set_product_wrap').children().eq(i);
            var sel_idx = sel_prod.attr('product_idx')
            
        }
    })
}
function closeModal(){
    confirm('상품 선택창을 닫으시겠습니까?', function (){
        modal_close();
    })
}
</script>