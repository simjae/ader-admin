<style>
#add_product_btn {
	width:120px;
	height:30px;
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	margin-right:10px;
}

.remove_product_btn {
	width:35px;
	height:25px;
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	font-size:12px;
	padding:5px;
	cursor:pointer;
}

.product__img__wrap {
	display: flex;
	align-items: center;
	width:300px;
}

.product__img {
	width: 100px;
	height: 130px;
	border: 1px solid #000000;
	margin-right: 10px;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}

.product_txt {
	font-size: 12px!important;
	font-family: 'NanumSquareRound',sans-serif;
}
</style>

<div class="content__card" style="margin: 0;">
	<form id="frm-add" action="product/recommend/add">
		<div class="card__header">
			<h3>추천상품 리스트 등록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">리스트 타이틀</div>
				<div class="content__row">
					<input id="page_title" type="text" name="page_title" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">리스트 메모</div>
				<div class="content__row">
					<textarea id="page_memo" type="text" name="page_memo" style="width:100%; height:150px; border:solid 1px #bfbfbf; padding:14px;"></textarea>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">추천상품 활성상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="active_flg_false" type="radio" name="active_flg" value="false" checked>
							<label for="active_flg_false">비활성</label>
							
							<input id="active_flg_true" type="radio" name="active_flg" value="true">
							<label for="active_flg_true">활성</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">추천리스트 옵션</div>
				<div class="content__row">
					<div class="table table__wrap">
						<TABLE style="width:80%;">
							<THEAD>
								<TR>
									<TH style="width:3%;">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</TH>
									<TH>추천옵션 타이틀</TH>
									<TH>추천옵션 변수명</TH>
									<TH>추천옵션 타입</TH>
									<TH>추천옵션 조건</TH>
									<TH>추천옵션 값</TH>
								</TR>
							</THEAD>
							<TBODY id="option_table">
								<?php
									$option_sql = "
										SELECT
											RO.IDX					AS OPTION_IDX,
											RO.OPTION_TITLE			AS OPTION_TITLE,
											RO.OPTION_NAME			AS OPTION_NAME,
											RO.OPTION_TYPE			AS OPTION_TYPE,
											RO.OPTION_CONDITION		AS OPTION_CONDITION,
											RO.OPTION_VALUE			AS OPTION_VALUE
										FROM
											dev.RECOMMEND_OPTION RO
									";
									
									$db->query($option_sql);
									
									foreach($db->fetch() as $data) {
								?>
								<TR>
									<TD>
										<label>
											<input class="option_idx" type="checkbox" name="recommend_idx[]" value="<?=$data['OPTION_IDX']?>">
											<span></span>
										</label>
									</TD>
									<TD><?=$data['OPTION_TITLE']?></TD>
									<TD><?=$data['OPTION_NAME']?></TD>
									<TD><?=$data['OPTION_TYPE']?></TD>
									<TD><?=$data['OPTION_CONDITION']?></TD>
									<TD><?=$data['OPTION_VALUE']?></TD>
								</TR>
								<?php
									}
								?>
							</TBODY>
						</TABLE>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">추천상품 추가</div>
				<div class="content__row" style="display: block;">
					<input id="product_code" type="text" style="width:350px;">
					<button id="add_product_btn" type="button" onClick="addRecommendProduct();">추천상품 추가</button>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">추천상품</div>
				<div id="recommend_body" class="content__row" style="display:flex;flex-wrap:wrap;">
					
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="addPageRecommend();"><span>추천상품 리스트 등록</span></div>
					<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
function addRecommendProduct() {
	let product_code = $('#product_code').val();
	
	let cnt = $('#' + product_code).length;
	if (cnt > 0) {
		alert('중복된 상품을 추천상품으로 등록할 수 없습니다.');
		return false;
	}
	
	if (product_code != null) {
		$.ajax({
			type: "post",
			data: {
				'product_code':product_code
			},
			dataType: "json",
			url: config.api + "product/recommend/get",
			error: function() {
				alert('추천상품 추가 처리중 오류가 발생했습니다.')
			},
			success: function(d) {
				if(d.code == 200) {
					let data = d.data;
					data.forEach(function(row) {
						let strDiv = "";
						strDiv += '        <div id="' + row.product_code + '" class="product__img__wrap">';
						strDiv += '            <input class="product_idx" type="hidden" name="product_idx[]" value="' + row.product_idx + '">';
						
						let background_url = "background-image:url('" + row.img_location + "');";
						
						strDiv += '            <div class="product__img" style="' + background_url + '">';
						strDiv += '            </div>';
						strDiv += '            <div>';
						strDiv += '                <p class="product_txt">' + row.product_code + '</p><br>';
						strDiv += '                <p class="product_txt">' + row.product_name + '</p><br>';
						strDiv += '                <div class="remove_product_btn" product_code="' + row.product_code + '" onClick="removeRecommendProduct(this);">삭제</div>';
						strDiv += '            </div>';
						strDiv += '        </div>';
						
						$('#recommend_body').append(strDiv);
					});
				} else {
					alert(d.msg);
					return false;
				}
			}
		});
	} else {
		alert('추가 할 추천상품의 상품코드를 입력해주세요.');
		return false;
	}
}

function removeRecommendProduct(obj) {
	$(obj).parent().parent().remove();
}

function addPageRecommend() {
	let page_title = $('#page_title').val();
	if (page_title == "" || page_title == null) {
		alert("리스트 타이틀을 입력해주세요.");
		return false;
	}
	
	let option_cnt = $('.option_idx').length;							
	let option_idx = [];
	for (let i=0; i<option_cnt; i++) {
		let checkbox = $('.option_idx').eq(i);
		if (checkbox.prop('checked') == true) {
			option_idx.push(checkbox.val());
		}
	}
	
	if (option_idx.length == 0) {
		alert('하나 이상의 추천리스트 옵션을 선택해주세요.');
		return false;
	}
	
	let product_cnt = $('.product_idx').length;
	if (product_cnt == 0) {
		alert('하나 이상의 추천상품을 선택해주세요.');
		return false;
	}
	
	var formData = new FormData();
	formData = $("#frm-add").serializeObject();
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/recommend/add",
		error: function() {
			alert('추천상품 리스트 등록 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				alert('추천상품 리스트가 정상적으로 등록되었습니다.',function(){
					getPageRecommendList();
					modal_close();
				});
			} else {
				alert(d.msg);
				return false;
			}
		}
	});
}
</script>