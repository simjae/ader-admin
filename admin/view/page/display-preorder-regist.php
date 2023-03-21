<style>
.time__select{width:80px!important;}	
</style>
<div class="content__card">
	<form id="frm-preorder-add" action="order/preorder/add">
		<input type="hidden" name="product_idx">
		<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$country = getUrlParamter($page_url, 'country');
		?>
		<input type="hidden" name="country" value="<?=$country?>">
		<div class="card__header">
			<h3>프리오더 등록</h3>
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
								<select id="entry_start_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
								<select id="entry_start_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
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
								<select id="entry_end_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
								<select id="entry_end_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
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
					<div class="blue__color__btn" onClick="addPreorder();"><span>프리오더 등록</span></div>
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
                parent_obj.find('.time__select.hour').attr('disabled',false);
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select').val('');
            parent_obj.find('.time__select.hour').attr('disabled',false);
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

function addPreorder(){
	confirm('프리오더를 추가하시겠습니까?', function(){
		var formData = new FormData();
		formData = $('#frm-preorder-add').serializeObject();
		
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
			url: config.api + "order/preorder/add",
			type: "post",
			data: formData,
			dataType: "json",
			error: function() {
				alert('프리오더 등록 처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				let code = d.code;
				if (code == 200) {
					alert('프리오더 등록이 완료되었습니다.',function(){
						location.href='/display/preorder';
					});
				} else {
					alert('프리오더 등록에 실패했습니다.');
					return false;
				}
			}
		});
	});
}
</script>