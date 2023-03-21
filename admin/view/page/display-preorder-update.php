<style>
.time__select{width:80px!important;}	
</style>
<div class="content__card">
	<form id="frm-preorder-put" action="order/preorder/put">
		<input type="hidden" name="product_idx">
		<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$country = getUrlParamter($page_url, 'country');
        $preorder_idx = getUrlParamter($page_url, 'preorder_idx');
		?>
		<input type="hidden" name="country" value="<?=$country?>">
        <input type="hidden" name="preorder_idx" value="<?=$preorder_idx?>">
		<div class="card__header">
			<h3>프리오더 편집</h3>
			<div class="drive--x"></div>
		</div>

		<div class="card__body">
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onclick="searchProductModal();">상품 검색</div>
					</div>
				</div>

				<div class="table table__wrap">
					<table>
						<colsgroup>
							<col style="width:4%;">
							<col style="width:auto">
							<col style="width:20%;">
							<col style="width:10%;">
							<col style="width:8%;">
							<col style="width:8%;">
							<col style="width:8%;">
							<col style="width:8%;">
							<col style="width:10%;">
							<col style="width:10%;">
						</colsgroup>
						<thead>
							<tr>
								<th>상품변경</th>
								<th>프리오더 상품정보</th>
								<th>바코드</th>
								<th>사이즈</th>
								<th>재고수량</th>
								<th>한국몰 판매수량</th>
								<th>영문몰 판매수량</th>
								<th>중국몰 판매수량</th>
								<th>판매수량</th>
								<th>판매제한수량</th>
							</tr>
						</thead>
						<tbody id="preorder_product_table" class="default_td">
							<tr>
								<td colspan="9">상품검색 버튼을 눌러 상품을 선택해주세요</div>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">프리오더 시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="entry_start_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);">
								<select id="entry_start_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);"></select>
								<span>&nbsp;시</span>
								<select id="entry_start_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);"></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">프리오더 종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="entry_end_date"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);">
								<select id="entry_end_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);"></select>
								<span>&nbsp;시</span>
								<select id="entry_end_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);"></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap ">
                <div class="content__title">판매 가격</div>
                <div class="content__row">
                    <input type="number" name="sales_price" value=""
                        style="height:28px;border:solid 1px #bfbfbf;width:100px;margin-right:5px;">원
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">멤버 레벨</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input id="member_level_all" type="radio" name="member_level" value="ALL" checked>
                        <label for="member_level_all">전체</label>
<?php
						$get_member_level_sql = "
							SELECT
								IDX,
								TITLE
							FROM
								dev.MEMBER_LEVEL
							WHERE
								DEL_FLG = FALSE
						";
						$db->query($get_member_level_sql);

						foreach($db->fetch() as $level_info){
?>
                            <input id="member_level_<?=$level_info['IDX']?>" type="radio" name="member_level" value="<?=$level_info['IDX']?>">
                            <label for="member_level_<?=$level_info['IDX']?>"><?=$level_info['TITLE']?></label>				    
<?php
						}
?>
                    </div>
                </div>
            </div>
			<div class="content__wrap ">
				<div class="content__title">열람가능 여부</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="display_flg_false" type="radio" name="display_flg" value="0" checked>
						<label for="display_flg_false">비활성</label>

						<input id="display_flg_true" type="radio" name="display_flg" value="1">
						<label for="display_flg_true">활성</label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onClick="putPreorder();"><span>프리오더 편집</span></div>
					<div class="defult__color__btn" onclick="location.href='/display/preorder'"><span>이전페이지로 돌아가기</span></div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>

<script>
$(document).ready(function () {
	timeSelectSet();


	$.ajax({
		url: config.api + "order/preorder/get",
		type: "post",
		data: {
			preorder_idx: $('input[name="preorder_idx"]').val(),
			country: $('input[name="country"]').val()
		},
		dataType: "json",
		error: function() {
			alert('프리오더 편집 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				var rows = d.data[0];
				$(`input:radio[name="display_flg"][value="${rows.display_flg}"]`).prop('checked',true);
				$(`input:radio[name="member_level"][value="${rows.member_level}"]`).prop('checked', true);
				$('input[name="sales_price"]').val(rows.sales_price);

				var entry_start_date_arr =  rows.entry_start_date.split(' ');
				$('#entry_start_date').val(entry_start_date_arr[0]);
				$('#entry_start_hour').val(entry_start_date_arr[1].split(':')[0]).prop("selected",true);
				$('#entry_start_minite').val(entry_start_date_arr[1].split(':')[1])
				
				var entry_end_date_arr =  rows.entry_end_date.split(' ');	
				$('#entry_end_date').val(entry_end_date_arr[0]);
				$('#entry_end_hour').val(entry_end_date_arr[1].split(':')[0]).prop("selected",true);
				$('#entry_end_minite').val(entry_end_date_arr[1].split(':')[1])
				
				$.ajax({
					url: config.api + "order/modal/get",
					type: "post",
					data: {
						'product_idx': rows.product_idx,
						'regist_type' : 'PREORDER'
					},
					dataType: "json",
					error: function() {
						alert('상품 읽기 처리중 오류가 발생했습니다.');
					},
					success: function(d) {
						if(d != null){
							let code = d.code;
							if (code == 200) {
								$('#preorder_product_table').html('');
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

									var kr_sale_qty = 0;
									var en_sale_qty = 0;
									var cn_sale_qty = 0;
									var product_qty_arr = [];
									if(row.qty_info != null){
										row.qty_info.forEach(function(qty_row){
											switch(qty_row.country){
												case 'KR':
													kr_sale_qty = (qty_row.product_qty == null) ? 0 : qty_row.product_qty;
													break;
												case 'EN':
													en_sale_qty = (qty_row.product_qty == null) ? 0 : qty_row.product_qty;
													break;
												case 'CN':
													cn_sale_qty = (qty_row.product_qty == null) ? 0 : qty_row.product_qty;
													break;
											}
											product_qty_arr.push(qty_row.product_qty);
										})
									}
									var posible_cnt_param = row.product_qty - kr_sale_qty - en_sale_qty - cn_sale_qty;
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
											<td>${kr_sale_qty}</td>
											<td>${en_sale_qty}</td>
											<td>${cn_sale_qty}</td>
											<td>
												<input type="hidden" class="posible_cnt_param" value="${posible_cnt_param}">
												<input type="hidden" class="option_idx_param" value="${row.option_idx}">
												<input type="number" class="product_qty_param" value="${product_qty_arr[index]}"
													style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
											</td>
											<td>
												<input type="number" class="product_qty_limit_param" value=""
													style="height:28px;border:solid 1px #bfbfbf;width:50px;margin-right:5px;">개
											</td>
										</tr>
									`;
								})
								strDiv += optionDiv;

								$('#preorder_product_table').append(strDiv);
								$('input[name="product_idx"]').val(rows.product_idx);

								rows.qty_info.forEach(function(qty_row){
									$(`input[class="option_idx_param"]:input[value="${qty_row.option_idx}"]`).parent().find('.product_qty_param').val(qty_row.product_qty);
									$(`input[class="option_idx_param"]:input[value="${qty_row.option_idx}"]`).parent().parent().find('.product_qty_limit_param').val(qty_row.product_qty_limit);
									console.log(qty_row);
								});

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
							} else {
								alert('상품 읽기에 실패했습니다.');
								return false;
							}
						}
						
					}
				});
				
			} else {
				alert('프리오더 편집에 실패했습니다.');
				return false;
			}
		}
	});
});

function searchProductModal(){
	modal('/search_product',null);
}

function timeSelectSet(){
	var hourOption = '<option value="">선택</option>';
    var miniteOption = '<option value="">선택</option>';
	
	for(var i = 0; i <= 24; i++){
		var hour_val = i.toString().padStart(2,'0');
		hourOption += `
			<option value='${hour_val}'>${hour_val}</option>
		`;
	}
	$('.hour').append(hourOption);

    for(var j = 0; j < 60; j++){
		var minite_val = j.toString().padStart(2,'0');
		miniteOption += `
			<option value='${minite_val}'>${minite_val}</option>
		`;
	}
	$('.minite').append(miniteOption);
}

function dateParamChange(obj) {
	//content__date__picker
    let date_type = $(obj).attr('date_type');
    let parent_obj = $(obj).parent();

    let now_date = new Date();
    let now_gettime = now_date.getTime();
    let now_year = now_date.getFullYear();
    let now_month = (now_date.getMonth() + 1).toString().padStart(2,'0');
    let now_day = (now_date.getDate()).toString().padStart(2,'0');
    let now_hour = (now_date.getHours()).toString().padStart(2,'0');
    let now_minite = (now_date.getMinutes()).toString().padStart(2,'0');
    let now_date_str = `${now_year}-${now_month}-${now_day}`;
  
    switch(date_type){
        case 'day':
            if($(obj).val() < now_date_str){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val(now_date_str);
				parent_obj.find('.time__select').val('');
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select').val('');
            parent_obj.find('.time__select.minite').attr('disabled',true);
            break;
        case 'hour':
            if(parent_obj.find('.date_param').val() + ' ' + $(obj).val() < now_date_str + ' ' + now_hour){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val('');
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select.minite').val('');
            parent_obj.find('.time__select.minite').attr('disabled',false);
            break;
        case 'minite':
            if(parent_obj.find('.date_param').val() + ' ' + parent_obj.find('.time__select.hour').val() + ':' + $(obj).val() < now_date_str + ' ' + now_hour + ':' + now_minite){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val('');
                return false;
            }
            break;
    }
}

function putPreorder(){
	confirm('프리오더를 추가하시겠습니까?', function(){
		var formData = new FormData();
		formData = $('#frm-preorder-put').serializeObject();
		formData.update_flg = true;

		var qty_info = [];
		var tmp_qty_info = [];
		var option_len = $('.option_idx_param').length;
		
		for(var i = 0; i < option_len; i++){
			tmp_qty_info = [];
			tmp_qty_info.push($('.option_idx_param').eq(i).val());
			tmp_qty_info.push($('.option_name_param').eq(i).val());
			tmp_qty_info.push($('.barcode_param').eq(i).val());
			tmp_qty_info.push($('.product_qty_param').eq(i).val());
			tmp_qty_info.push($('.product_qty_limit_param').eq(i).val())

			qty_info.push(tmp_qty_info);
		}
		formData.qty_info = qty_info;

		var entry_start_date = '';
		if($('#entry_start_minite').val() == ''){
			alert('프리오더 시작일을 입력해주세요');
			return false;
		}
		entry_start_date += $('#entry_start_date').val() + ' ';
		entry_start_date += $('#entry_start_hour').val() + ':';
		entry_start_date += $('#entry_start_minite').val()==''?'00':$('#entry_start_minite').val();

		var entry_end_date = '';
		if($('#entry_end_minite').val() == ''){
			alert('프리오더 종료일을 입력해주세요');
			return false;
		}
		entry_end_date += $('#entry_end_date').val() + ' ';
		entry_end_date += $('#entry_end_hour').val() + ':';
		entry_end_date += $('#entry_end_minite').val()==''?'00':$('#entry_end_minite').val();

		if(entry_start_date > entry_end_date){
			alert('시작일/종료일 입력이 잘못되었습니다.');
			return false;
		}

		formData.entry_start_date = entry_start_date;
		formData.entry_end_date = entry_end_date;
		//select_val

		if($('input[name="sales_price"]').val() == ''){
			alert('판매가격을 입력해주세요');
			return false;
		}
		$.ajax({
			url: config.api + "order/preorder/put",
			type: "post",
			data: formData,
			dataType: "json",
			error: function() {
				alert('프리오더 편집 처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				let code = d.code;
				if (code == 200) {
					alert('프리오더 편집이 완료되었습니다.',function(){
						location.href='/display/preorder';
					});
				} else {
					alert('프리오더 편집에 실패했습니다.');
					return false;
				}
			}
		});
	});
}
</script>