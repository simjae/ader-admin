<div class="content__card" style="margin: 0;">
	<form id="frm-put" action="product/filter/put">
		<input class="filter_idx" type="hidden" name="filter_idx" value="<?=$filter_idx?>">
		<input class="filter_type" type="hidden" name="filter_type" value="">
		
		<div class="card__header">
			<h3>상품 필터 수정</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">필터타입</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="put_filter_type_CL" type="radio" name="filter_type" value="CL" disabled>
						<label for="put_filter_type_CL">컬러</label>
						
						<input id="put_filter_type_SZ" type="radio" name="filter_type" value="SZ" disabled>
						<label for="put_filter_type_SZ">사이즈</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="content__wrap">
					<div class="content__title">필터 한국몰 이름</div>
					<div class="content__row">
						<input class="filter_name_kr" type="text" name="filter_name_kr" value="" style="width:80%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">RGB 컬러</div>
					<div class="content__row">
						<input class="rgb_color" type="color" name="rgb_color" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="content__wrap">
					<div class="content__title">필터 영문몰 이름</div>
					<div class="content__row">
						<input class="filter_name_en" type="text" name="filter_name_en" value="" style="width:80%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">사이즈 타입</div>
					<div class="content__row">
						<select class="size_type" name="size_type">
							<option value="ALL" selected>전체</option>
							<option value="UP">상의</option>
							<option value="LW">하의</option>
							<option value="HT">모자</option>
							<option value="SH">신발</option>
							<option value="JW">주얼리</option>
							<option value="AC">악세서리</option>
							<option value="TA">테크 악세서리</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="content__wrap">
					<div class="content__title">필터 중문몰 이름</div>
					<div class="content__row">
						<input class="filter_name_cn" type="text" name="filter_name_cn" value="" style="width:80%;">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__wrap">
						<div class="content__title">메모</div>
						<div class="content__row country_price">
							<input class="memo" type="text" name="memo" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="putFilterInfo();"><span>수정</span></div>
					<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getFilterInfo();
});

function getFilterInfo() {
	let frm = $('#frm-put');
	let filter_idx = frm.find('.filter_idx').val();
	
	$.ajax({
		type: "post",
		data: {
			'filter_idx' : filter_idx
		},
		dataType: "json",
		url: config.api + "product/filter/get",
		error: function() {
			alert("필터 개별조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				if (data != null) {
					data.forEach(function(row) {
						frm.find('.filter_type').val(row.filter_type);
						if (row.filter_type == "CL") {
							$('#put_filter_type_CL').prop('checked',true);
							$('#put_filter_type_SZ').prop('checked',false);
							frm.find('.size_type').prepend('<option>컬러필터</option>');
							frm.find('.size_type').attr('disabled',true);
						} else if (row.filter_type == "SZ") {
							$('#put_filter_type_SZ').prop('checked',true);
							$('#put_filter_type_CL').prop('checked',false);
							frm.find('.rgb_color').attr('disabled',true);
						}
						
						frm.find('.filter_name_kr').val(row.filter_name_kr);
						frm.find('.filter_name_en').val(row.filter_name_en);
						frm.find('.filter_name_cn').val(row.filter_name_cn);
						frm.find('.rgb_color').val(row.rgb_color);
						frm.find('.size_type').val(row.size_type);
					});
				}
			}
		}
	});
}

function putFilterInfo() {
	let frm = $('#frm-put');
	
	let filter_type = frm.find('.filter_type').val();
	if (filter_type == "CL") {
		let rgb_color = frm.find('.rgb_color').val();
		if (rgb_color == "" || rgb_color == null) {
			alert('RGB 컬러코드를 선택해주세요.');
			return false;
		}
	} else if (filter_type == "SZ") {
		let size_type = frm.find('.size_type').val();
		if (size_type == "" || size_type == null) {
			alert('사이즈 타입을 선택해주세요.');
			return false;
		}
	}
	
	let filter_name_kr = $('.filter_name_kr').val();
	if (filter_name_kr == "" || filter_name_kr == null) {
		alert('수정할 필터의 한국몰 이름을 입력해주세요.');
		return false;
	}
	let filter_name_en = $('.filter_name_en').val();
	if (filter_name_en == "" || filter_name_en == null) {
		alert('수정할 필터의 한국몰 이름을 입력해주세요.');
		return false;
	}
	
	let filter_name_cn = $('.filter_name_cn').val();
	if (filter_name_cn == "" || filter_name_cn == null) {
		alert('수정할 필터의 한국몰 이름을 입력해주세요.');
		return false;
	}
	
	var formData = new FormData();
	formData = $("#frm-put").serializeObject();
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/filter/put",
		error: function() {
			alert("필터 수정처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				confirm(
					"입력한 필터정보가 수정되었습니다.",
					function() {
						getFilterInfoList();
						modal_close();
					}
				);
			}
		}
	});
}
</script>