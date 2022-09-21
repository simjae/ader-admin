<div class="body">
	<h1>상품 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="shop/warehouse/put">
		<input type="hidden" name="no" value="<?=$no?>">
		<input type="hidden" name="category_no">

		<ul class="tab green" data-role="goods-info">
			<li><a>기본 정보</a></li>
			<li><a>옵션</a></li>
			<li><a>이미지</a></li>
			<li><a>상세 내용</a></li>
		</ul>

		<div class="tab-content padding-top-10" id="goods-info">
			<!------- // 기본 정보 : BEGIN ------>
			<div>
				<h2>기본 정보</h2>
				<div class="form-group">
					<input type="text" name="feature2" maxlength="50">
					<label class="control-label">브랜드 라인</label>
				</div>

				<div class="form-group">
					<input type="text" name="name" maxlength="100" required>
					<label class="control-label">제품명</label>
				</div>

				<div class="form-group">
					<input type="text" name="barcode" maxlength="100">
					<label class="control-label">자체코드</label>
				</div>

				<div class="form-group">
					<input type="number" name="weight" max="9999999999" min="1" step="1" value="100" required>
					<label class="control-label">제품 무게(g)</label>
				</div>

				<div class="form-group">
					<div class="spinner">
						<button type="button" class="btn spinner-up blue">
							<i class="xi-plus"></i>
						</button>
						<input type="number" class="spinner-input" step="1" max="999999" min="0" name="stock" value="0">
						<button type="button" class="btn spinner-down red">
							<i class="xi-minus"></i>
						</button>
					</div>
					재고가 0이 될 경우 품절 상태가 됩니다
					<label class="control-label">재고설정</label>
				</div>

				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="stock_unlimit_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">재고 무제한</label>
				</div>

				<h2>판매 정보</h2>
				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="sell_date_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<div id="inp-sell-date" class="margin-top-5 hidden">
						<div class="row">
							<div class="col-7 col-7-3">
								<div class="row">
									<div class="col-2">
										<input type="date" name="sell_sdate" placeholder="시작일">
									</div>
									<div class="col-2">
										<input type="time" name="sell_sdatetime" placeholder="시작시간">
									</div>
								</div>
							</div>
							<div class="col-7 text-center">~</div>
							<div class="col-7 col-7-3">
								<div class="row">
									<div class="col-2">
										<input type="date" name="sell_edate" placeholder="종료일">
									</div>
									<div class="col-2">
										<input type="time" name="sell_edatetime" placeholder="종료시간">
									</div>
								</div>
							</div>
						</div>
					</div>
					<label class="control-label">판매기간 설정</label>
				</div>

				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="soldout_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">품절</label>
				</div>

				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="delivery_free_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">무료배송</label>
				</div>

				<h2>메모</h2>
				<div class="form-group">
					<textarea name="remark"></textarea>
					<label class="control-label">메모</label>
				</div>

				<!------- // 기본 정보 : END ------>

				<h2>가격 설정</h2>
				<div id="warehouse-price"></div>

				<h2>진열 정보</h2>
				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="display_date_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<div id="inp-display-date" class="margin-top-5 hidden">
						<div class="row">
							<div class="col-7 col-7-3">
								<div class="row">
									<div class="col-2">
										<input type="date" name="display_sdate" placeholder="시작일">
									</div>
									<div class="col-2">
										<input type="time" name="display_sdatetime" placeholder="시작시간">
									</div>
								</div>
							</div>
							<div class="col-7 text-center">~</div>
							<div class="col-7 col-7-3">
								<div class="row">
									<div class="col-2">
										<input type="date" name="display_edate" placeholder="종료일">
									</div>
									<div class="col-2">
										<input type="time" name="display_edatetime" placeholder="종료시간">
									</div>
								</div>
							</div>
						</div>
					</div>
					<label class="control-label">진열기간 설정</label>
				</div>

				<div class="form-group">
					<div class="switch">
						<input type="checkbox" name="display_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">진열</label>
				</div>

				<div class="form-group">
					<?php for($i=0;$i<sizeof($_CONFIG['LANGUAGE']);$i++) { ?>
					<label>
						<input type="checkbox" name="display_language[]" value="<?=$_CONFIG['LANGUAGE'][$i]?>">
						<span></span>
						<?=$_CONFIG['COUNTRY_KOR'][$_CONFIG['LANGUAGE'][$i]]?>
					</label>
					<?php } ?>
					<label class="control-label">국가별 진열</label>
				</div>
			</div>

			<div>
				<!------- // 옵션 정보 : BEGIN ------>
				<h2>옵션 정보</h2>

				<div class="form-group hidden">
					<div class="switch">
						<input type="checkbox" name="option_yn" value="y">
						<div class="switch-container">
							<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
						</div>
					</div>
					<label class="control-label">옵션 사용</label>
				</div>


				<table class="list width-100p">
				<thead>
					<tr class="disabled">
						<th style="width:30px"></th>
						<th style="width:150px">옵션명</th>
						<th>내용</th>
						<th style="width:60px"></th>
					</tr>
					<tr class="disabled">
						<td colspan="2"><input type="text" name="_option_name"></td>
						<td>
							<div class="form-group">
								<label><input type="radio" name="_option_category" value="text" data-text="구매자입력"><span>구매자입력</span></label>
								<label><input type="radio" name="_option_category" value="select" data-text="선택" checked><span>선택</span></label>
								<label><input type="radio" name="_option_category" value="check" data-text="중복선택"><span>중복선택</span></label>
							</div>
						</td>
						<td><a class="btn blue" onClick="add_option();"><i class="xi-check"></i></a></td>
					</tr>
				</thead>
				<tbody id="option-list" class="dragable-vertical">
					<tr class="nodata">
						<td colspan="4">옵션을 추가해 주세요.</td>
					</tr>
				</tbody>
				</table>
				<!------- // 옵션 정보 : END ------>
			</div>

			<div>
				<!------- // 레이아웃 정의 : BEGIN ------>
				<h2>제품 상세 레이아웃</h2>
				<div class="form-group">
					<div class="image">
						<input type="file" name="img_list" class="input-image">
						<a><i class="xi-image"></i></a>
						<img>
					</div>
					<label class="control-label">목록 이미지</label>
				</div>

				<div class="form-group fileupload drag-area">
					<div class="goods-image-upload" id="goods-image-upload-area">
						<div class="item disabled add-image">
							<input type="file" multiple="multiple">
							<i class="xi-mouse"></i><br>
							<span>파일 열기를 통해<br>이미지를 추가해주세요.</span>
						</div>
					</div>
					<label class="control-label">상세 이미지</label>
				</div>

				<div class="form-group fileupload drag-area">
					<div class="goods-image-upload">
						<div class="item disabled add-image">
							<input type="file" multiple="multiple">
							<i class="xi-mouse"></i><br>
							<span>파일 열기를 통해<br>이미지를 추가해주세요.</span>
						</div>
					</div>
					<label class="control-label">하단 디테일 이미지</label>
				</div>
				<!------- // 레이아웃 정의 : END ------>
			</div>
			<div>
				<h2>상세 내용</h2>

				<div class="form-group">
					<label><input type="checkbox" name="feature1_yn" value="y"><span></span></label>
					<input type="hidden" name="feature1" value="Z-Stitch">
					<label class="control-label">Z-Stitch</label>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-3 col-3-2"><input type="text" name="color"></div>
						<div class="col-3"><input type="text" name="color_code" class="color-picker"></div>
					</div>
					<label class="control-label">Color</label>
				</div>
				<div class="form-group">
					<label><input type="checkbox" name="feature2_yn" value="y"><span></span></label>
					<label class="control-label">Line</label>
				</div>
				<div class="form-group">
					<input type="hidden" name="feature3" value="Non-Refund">
					<label><input type="checkbox" name="refund_yn" value="y"><span></span></label>
					<label class="control-label">Non-Refund</label>
				</div>

				<ul class="tab green" id="inp-category-tab" data-role="detail-info"></ul>
				<div id="detail-info"></div>
			</div>
		</div>
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a id="btn-goods-add-ok" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>
<script>
var imageDetailFileList = [],imageMobilefileList = [];                    // 파일들을 담을 리스트
$(document).ready(function() {
	var f = $("form").last();

	$(f).find("input[name='category_no']").val(frm_list.category_no.value);

	$(f).find("input[name='display_date_yn']").click(function() {
		if($(this).prop("checked")) {
			$("#inp-display-date").removeClass("hidden");
		}
		else {
			$("#inp-display-date").addClass("hidden");
		}
	});

	$(f).find("input[name='sell_date_yn']").click(function() {
		if($(this).prop("checked")) {
			$("#inp-sell-date").removeClass("hidden");
		}
		else {
			$("#inp-sell-date").addClass("hidden");
		}
	});
	
	$(f).find(".drag-area").find("input[type='file']").on('change',function(){
		var file = $(this)[0].files;

		for(var i=0; i<file.length; i++){
			imageDetailFileList.push(file[i]);
			image_preview(file[i]);
		}
	});

	// dragover, dragenter : 파일이 영역 안에 들어올 경우
	// dragleaver : 파일이 영역을 벗어날 경우
	$(".drag-area").on("dragover dragenter dragleave", function(event){
		event.stopPropagation();
		event.preventDefault();
		return false;
	}, false);
	 
	// 파일을 영역에 놓을 경우
	$(".drag-area").on("drop", function(event){
		event.stopPropagation();
		event.preventDefault();
		 
		var file = event.originalEvent.dataTransfer.files[0];
		imageDetailFileList.push(file);
		image_preview(file);
	});

	$("#btn-goods-add-ok").click(function(){
		var formData = new FormData($('form').last().get(0));
		for(var i=0; i < imageDetailFileList.length; i++){
			formData.append("img_detail[]", imageDetailFileList[i]);
		}
		$("#goods-image-upload-area > .item:not(.disabled)").each(function() {
			var no = $(this).data("no");
			if(isNaN(no) == false) {
				formData.append("img_detail_no[]",no);
			}
		});

		$.ajax({
			url: config.api + $(f).attr("action"),
			data: formData,
			type: "post",  
			processData:false,
			contentType:false,
			dataType: "json",
			success: function(d) {
				if(d.code == 200) {
					toast("자료 저장에 성공하였습니다.");
				}
				list();
				modal_close();
			},
			error: function() {
				toast("자료 전송에 실패하였습니다.");
			}
		});
	});

	/*** 상품 정보 불러오기 ***/
	$.ajax({
		type: "post",
		url: config.api + "shop/warehouse/",
		data: {
			no : $(f).find("input[name=no]").val()
		},
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			var option_category = {
					'SELECT':'선택',
					'CHECK':'중복선택',
					'TEXT':'구매자입력'
				},
				html = '',
				price = 0;

			/** 상세 내용 **/
			for(var i=0;i<d.language.length;i++) {
				html = '<div>'
					 + '	<div class="form-group">'
					 + '		<input type="hidden" name="detail_title[0][\'' + d.language[i].key + '\']" value="Material">'
					 + '		<textarea name="detail[0][\'' + d.language[i].key + '\']" style="min-height:150px"></textarea>'
					 + '		<label class="control-label">Material</label>'
					 + '	</div>'
					 + '	<div class="form-group">'
					 + '		<input type="hidden" name="detail_title[1][\'' + d.language[i].key + '\']" value="Care">'
					 + '		<textarea name="detail[1][\'' + d.language[i].key + '\']" style="min-height:150px"></textarea>'
					 + '		<label class="control-label">Care</label>'
					 + '	</div>'
					 + '	<div class="form-group">'
					 + '		<input type="hidden" name="detail_title[2][\'' + d.language[i].key + '\']" value="Detail">'
					 + '		<textarea name="detail[2][\'' + d.language[i].key + '\']" style="min-height:150px"></textarea>'
					 + '		<label class="control-label">Detail</label>'
					 + '	</div>'
					 + '	<div class="form-group">'
					 + '		<input type="hidden" name="detail_title[3][\'' + d.language[i].key + '\']" value="Size Detail">'
					 + '		<textarea name="detail[3][\'' + d.language[i].key + '\']" style="min-height:150px"></textarea>'
					 + '		<label class="control-label">Size</label>'
					 + '	</div>'
					 + '	<div class="form-group">'
					 + '		<input type="hidden" name="detail_title[4][\'' + d.language[i].key + '\']" value="Line">'
					 + '		<textarea name="detail[4][\'' + d.language[i].key + '\']" style="min-height:150px"></textarea>'
					 + '		<label class="control-label">Line</label>'
					 + '	</div>'
					 + '	<div class="form-group">'
					 + '		<input type="hidden" name="detail_title[5][\'' + d.language[i].key + '\']" value="Non-Refund">'
					 + '		<textarea name="detail[5][\'' + d.language[i].key + '\']" style="min-height:150px"></textarea>'
					 + '		<label class="control-label">Non-Refund</label>'
					 + '	</div>'
					 + '</div>';
				$("#detail-info").append(html);
				$("#inp-category-tab").append('<li><a>' + d.language[i].text + '</a></li>');
			}
			ui();
			$("#inp-category-tab > li").eq(0).find("a").click();

			if(d.total == 1) {
				/** 기본 정보 **/
				$(f).find("input[name='category']").val(d.data[0].category);
				$(f).find("input[name='name']").val(recovery_html(d.data[0].name));
				$(f).find("input[name='barcode']").val(d.data[0].barcode);
				for(var i=0;i<d.language.length;i++) {
					price = 0;
					for(var j=0;j<d.data[0].price.length;j++) {
						if(d.data[0].price[j].country == d.language[i].key) price = d.data[0].price[j].price;
					}
					html = '<div class="form-group has-head">'
						 + '	<input type="number" name="price[' + d.language[i].key + ']" value="' + price + '" required>'
						 + '	<span class="head">' + d.language[i].currency_symbol + '</span>'
						 + '	<label class="control-label">판매가격 (' + d.language[i].text + ')</label>'
						 + '</div>';
					$("#warehouse-price").append(html);
				}
				$(f).find("input[name='stock']").val(d.data[0].stock.online);
				$(f).find("textarea[name='remark']").val(d.data[0].remark);
				$(f).find("input[name='display_yn']").prop("checked",d.data[0].display_yn);
				for(var i=0;i<d.data[0].display_language.length;i++) {
					$(f).find("input[name='display_language[]'][value='" + d.data[0].display_language[i] + "']").prop("checked",true);
				}
				if(d.data[0].display_date.use) {
					$(f).find("input[name='display_date_yn']").click();
				}
				if(d.data[0].sell_date.use) {
					$(f).find("input[name='sell_date_yn']").click();
				}

				/** 옵션 **/
				if(d.data[0].option != null) {
					html = '';
					for(var i=0;i<d.data[0].option.length;i++) {
						html +='<tr '
							 + '	data-nm="' + d.data[0].option[i].title + '" '
							 + '	data-cat="' + d.data[0].option[i].category + '" '
							 + '	data-no="' + d.data[0].option[i].no + '" '
							 + '	data-inptype="' + d.data[0].option[i].type + '" '
							 + '	id="option-list-' + d.data[0].option[i].no + '" '
							 + '>' 
							 + '	<td style="text-align:center"><i class="xi-arrows-v cursor-move" data-caption="순서 이동"></i></td>'
							 + '	<td colspan="2">'
							 + '		<div class="label-sticker">' + option_category[d.data[0].option[i].category] + '</div>'
							 + '		' + d.data[0].option[i].title;
						
						switch(d.data[0].option[i].category) {
							case 'SELECT':
								html += '<table class="list width-100p margin-top-10">'
									 +  '	<thead>'
									 +  '		<tr>'
									 +  '			<th style="width:40px"></th>'
									 +  '			<th>선택명</th>'
									 +  '			<th>바코드</th>'
									 +  '			<th>추가 금액</th>'
									 +  '			<th style="width:100px">재고</th>'
									 +  '			<th style="width:60px"></th>'
									 +  '		</tr>'
									 +  '	</thead>'
									 +  '	<tbody id="option-list-' + d.data[0].option[i].no + '-col">'
									 +  '		<tr class="input">'
									 +  '			<td></td>'
									 +  '			<td><input type="text" name="_option_name"></td>'
									 +  '			<td><input type="text" name="_option_barcode"></td>'
									 +  '			<td>';
								for(var k=0;k<d.language.length;k++) {
									html +='<div class="form-group has-head">'
										 + '	<input type="text" name="_option_price[\'' + d.language[k].key + '\']" title="' + d.language[k].text + '" class="text-right">'
										 + '	<span class="head">' + d.language[k].currency_symbol + '</span>'
										 + '</div>';
								}

								html += '			</td>'
									 +  '			<td><input type="text" name="_option_stock"></td>'
									 +  '			<td><a class="btn green"><i class="xi-pen"></i><span class="tooltip top">옵션 추가</span></a></td>'
									 +  '		</tr>';
								for(var j=0;j<d.data[0].option[i].values.length;j++) {
									html += '<tr data-no="' + d.data[0].option[i].values[j].no + '">'
										 +  '	<input type="hidden" name="option_no[' + i + '][' + j + ']" value="' + d.data[0].option[i].values[j].no + '">'
										 +  '	<td style="text-align:center"><i class="xi-arrows-v cursor-move" data-caption="순서 이동"></i></td>'
										 +  '	<td><input type="text" name="option_name[' + i + '][' + j + ']" value="' + d.data[0].option[i].values[j].title + '"></td>'
										 +  '	<td><input type="text" name="option_barcode[' + i + '][' + j + ']" value="' + d.data[0].option[i].values[j].barcode + '"></td>'
										 +  '	<td>';
									for(var k=0;k<d.language.length;k++) {
										price = 0;
										for(var l=0;l<d.data[0].option[i].values[j].price.length;l++) {
											if(d.data[0].option[i].values[j].price[l].country == d.language[k].key) {
												price = d.data[0].option[i].values[j].price[l].price;
												break;
											}
										}
										html +='<div class="form-group has-head">'
											 + '	<input type="number" name="option_price[' + i + '][' + j + '][\'' + d.language[k].key + '\']" value="' + price + '" title="' + d.language[k].text + '"  class="text-right" required>'
											 + '	<span class="head">' + d.language[k].currency_symbol + '</span>'
											 //+ '	<label class="control-label">판매가격 (' + d.language[k].text + ')</label>'
											 + '</div>';
									}
									html += '	</td>'
										 +  '	<td><input type="text" name="option_stock[' + j + ']" value="' + d.data[0].option[i].values[j].stock + '"></td>'
										 +  '	<td>'
										 +  '		<a class="btn red btn-popover margin-top-5" data-tooltip="삭제" data-popover="delete" data-popover-script="option_delete" data-popover-query="' + d.data[0].option[i].values[j].no + '"><i class="xi-trash-o"></i><span class="tooltip top">삭제</span></a>'
										 +  '	</td>'
										 +  '</tr>';
								}
								html += '	</tbody>'
									 +  '</table>';
								break;

							case 'CHECK':
							case 'TEXT':
							default:
								html += '<a class="addbox item-center '
									 +  ((d.data[0].option[i].type == 'TEXT')?'btn-popover':'') + ' id="option-color-' + d.data[0].option[i].no + '"><i class="xi-plus"></i>';
								if(d.data[0].option[i].type == 'IMG') {
									html += '<input type="file" id="option-img-' + d.data[0].option[i].values[j].no + '" class="option_img" name="option_img_' + d.data[0].option[i].values[j].no + '" data-no="' + d.data[0].option[i].values[j].no + '">';
								}
								html += '</a>';
								for(var j=0;j<d.data[0].option[i].values.length;j++) {
									switch(d.data[0].option[i].type) {
										case 'COLOR':
											html += '<a class="addbox item-center btn-popover" data-popover="delete" style="background:<?=$vals[$i]?>"><i class="fa fa-trash"></i></a>';
										break;

										case 'TEXT':
											html += '<a class="addbox item-center btn-popover" data-popover="delete"><span><?=$vals[$i]?></span><i class="xi-trash"></i></a>';
										break;
										
										case 'IMG':
											html += '<a class="addbox item-center btn-popover" data-popover="delete" data-popover-script="option_detail_delete" data-popover-query="" style="background:url(\'\') center center no-repeat #000000;background-size:cover"><i class="fa fa-trash"></i></a>';
										break;
									}
								}

								break;
						}

						html += '	</td>'
							 +  '	<td>'
							 +  '		<a class="btn red btn-popover margin-top-5" data-tooltip="삭제" data-popover="delete" data-popover-script="option_delete" data-popover-query="' + d.data[0].option[i].no + '"><i class="xi-trash-o"></i></a>'
							 +  '	</td>'
							 +  '</tr>';
					}
					$("#option-list").html(html);
				}

				/** 상세 내용 **/
				$(f).find("input[name='color']").val(d.data[0].color.name);
				$(f).find("input[name='color_code']").val(d.data[0].color.hexcode);
				var detail_number = {
					'Material' : 0,
					'Care' : 1,
					'Detail' : 2,
					'Size Detail' : 3,
					'Line' : 4,
					'Non-Refund' : 5
				}
				for(var i=0;i<d.language.length;i++) {
					for(var j=0;j<d.data[0].detail.length;j++) {
						if(d.language[i].key == d.data[0].detail[j].language) {
							$(f).find('textarea[name="detail[' + detail_number[d.data[0].detail[j].title] + '][\'' + d.language[i].key + '\']"]').val(recovery_html(d.data[0].detail[j].contents));
						}
					}
				}

				/** 이미지 **/
				if(d.data[0].images) {
					/** 목록 이미지 **/
					if(d.data[0].images.list.pc) {
						$(f).find("input[name='img_list']").parent().find("img").attr("src",d.data[0].images.list.pc[0].url);
					}

					/** 상세 이미지 **/
					if(d.data[0].images.detail.pc) {
						for(var i=0;i<d.data[0].images.detail.pc.length;i++) {
							html  = '<div class="item" data-no="' + d.data[0].images.detail.pc[i].no + '" style="background-image:url(\'' + d.data[0].images.detail.pc[i].url + '\');">';
							html += '	<div class="tools">';
							html += '		<a onclick="image_delete(this);"><i class="xi-trash"></i></a>';
							html += '		<a onclick="image_view(\'' + d.data[0].images.detail.pc[i].url + '\');"><i class="xi-magnifier-expand"></i></a>';
							html += '	</div>';
							html += '	<a><i class="xi-arrows"></i></a>';
							html += '</div>';
							$('#goods-image-upload-area > .add-image').before(html);
						}
					}
				}
				$("#goods-image-upload-area").sortable({
					connectWith: "#goods-image-upload-area",
					containment: "#goods-image-upload-area",
					items: ".item:not(.disabled)",
					cancel: ".disabled",
					handle: ".xi-arrows",
					placeholder: "item",
					update: function (event, ui) {

					}
				});

				if(d.data[0].images_mobile) {
					for(var i=0;i<d.data[0].images_mobile.length;i++) {
						html  = '<div class="item" data-no="' + d.data[0].images_mobile[i].no + '" style="background-image:url(\'' + d.data[0].images_mobile[i].url + '\');">';
						html += '	<div class="tools">';
						html += '		<a onclick="image_delete(this);"><i class="xi-trash"></i></a>';
						html += '		<a onclick="image_view(\'' + d.data[0].images_mobile[i].url + '\');"><i class="xi-magnifier-expand"></i></a>';
						html += '	</div>';
						html += '	<a><i class="xi-arrows"></i></a>';
						html += '</div>';
						$('#goods-imagemobile-upload-area > .add-image').before(html);
					}
				}
				$("#goods-imagemobile-upload-area").sortable({
					connectWith: "#goods-imagemobile-upload-area",
					containment: "#goods-imagemobile-upload-area",
					items: ".item:not(.disabled)",
					cancel: ".disabled",
					handle: ".xi-arrows",
					placeholder: "item",
					update: function (event, ui) {

					}
				});

			}
			else {
				$(f).find("input[name='display_yn']").prop("checked",true);
				$(f).find("input[name='display_language[]']").prop("checked",true);
			}

		}
	});
});

/* 옵션 관리 */
function add_option() {
	var html;
	var no = $("#option-list > tr:not(.nodata)").length+1;
	var nm = $("input[name=option_name]");
	var cat = $("input[name=option_category]:checked");
	if(nm.val() != "") {
		if(cat.length == 0) {
			toast("옵션 종류를 선택해 주세요.",2);
		}
		else {
			html  = '<tr data-nm="' + nm.val() + '" data-cat="' + cat.val() + '" data-no="' + no + '" id="option-list-' + no + '" class="option-list-rows">';
			html += '	<td style="text-align:center"><i class="xi-arrows-v cursor-move" data-caption="순서 이동"></i></td>';
			if(cat.val() == "text") {
				html += '	<td colspan="2"><div class="label-sticker">' + cat.data("text") + '</div>' + nm.val();
			}
			else {
				html += '	<td><div class="label-sticker">' + cat.data("text") + '</div>' + nm.val() + '</td>';
				html += '	<td id="option-list-' + no + '-col">';
				html += '		<a class="btn blue" href="javascript:;" onclick="add_option_type(' + no + ',\'text\');">텍스트 옵션</a>';
				html += '		<a class="btn green" href="javascript:;" onclick="add_option_type(' + no + ',\'color\');">색상 옵션</a>';
				html += '		<a class="btn purple" href="javascript:;" onclick="add_option_type(' + no + ',\'img\');">이미지 옵션</a>';
			}
			html += '	</td>';
			html += '	<td>';
			html += '		<a class="btn red btn-popover" data-tooltip="삭제" data-popover="delete" data-popover-script="option_delete" data-popover-query="' + no + '"><i class="xi-trash"></i></a>	 ';
			html += '	</td>';
			html += '</tr>';

			$("#option-list > tr.nodata").remove();
			$("#option-list").append(html);
			nm.val("");

			if(cat.val() == "text") {
				$("#option-list-" + no).data("vals","");
				$("#option-list-" + no).data("inptype","text");
			}

			ui();
		}		
	}
	else {
		toast("옵션명을 입력해 주세요.",2);
		nm.focus();
	}
}

function add_option_type(no,val) {
	var html;

	html  = '<a class="addbox item-center ';
	if(val == 'text') html += 'btn-popover';
	html += '" id="option-color-' + no + '">';
	html += '<i class="xi-plus"></i>';
	if(val == "img") {
		html += '<input type="file" id="option-img-' + no + '" name="option_img_' + no + '">';
	}
	html += '</a>';
	$("#option-list-" + no).data("vals","");
	$("#option-list-" + no).data("inptype",val);
	$("#option-list-" + no + "-col").html(html);
	ui();

	if(val == "img") {
		$('#option-img-' + no).on('change', function() {
			var num = $("#option-list-" + no + "-col > a").length;
			ext = $(this).val().split('.').pop().toLowerCase(); //확장자
			if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) { //배열에 추출한 확장자가 존재하는지 체크
				resetFormElement($(this)); //폼 초기화
				toast('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
			} else {
				file = $(this).prop("files")[0];
				blobURL = window.URL.createObjectURL(file);
				html  = '<a href="javascript:;" onclick="modal(\'ecommerce/product-option\',\'num=' + no + '\',400);" class="btn green btn-popover" data-tooltip="상세 설정"><i class="fa fa-pencil"></i></a>';		
				html += '<a class="addbox item-center btn-popover" data-popover="delete" data-popover-script="option_detail_delete" data-popover-query="" style="background:url(\'' + blobURL + '\') center center no-repeat #000000;background-size:cover"><i class="xi-trash"></i></a>';
				$("#option-list-" + no + "-col").append(html);

				// 서버에 업로드
				if($("#_iframe_hidden_process").length < 1) {
					$("body").append("<iframe id='_iframe_hidden_process' name='_iframe_hidden_process' style='border:none;width:0px;height:0px' width=0 height=0 border=0></iframe>");
				}
				if($("#frm_option_img_" + no).length < 1) {
					$(this).wrap('<form name="frm_option_img_' + no + '" id="frm_option_img_' + no + '" method="post" enctype="multipart/form-data">').closest('form').get(0);
				}
				eval("frm_option_img_" + no).action = "modules/ecommerce/product-option-img.proc.php?no=" + no;
				eval("frm_option_img_" + no).target = "_iframe_hidden_process";
				eval("frm_option_img_" + no + ".submit()");

				ui();
			}
		});
	}
	else if(val == "color") {
		$('#option-color-' + no).ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onSubmit: function(hsb, hex, rgb, el) {
				var html  = '<a href="javascript:;" onclick="modal(\'ecommerce/product-option\',\'num=' + no + '\',400);" class="btn green btn-popover" data-tooltip="상세 설정"><i class="xi-pencil"></i></a>';		
				html += '<a class="addbox item-center btn-popover" data-popover="delete" data-popover-script="option_detail_delete" data-popover-query="' + num + ',\'' + val + '\'" style="background:#' + hex + '"><i class="xi-trash"></i></a>';
				var data = $("#option-list-" + no).data("vals");
				$("#option-list-" + no).data("vals",data+":#"+hex);
				$("#option-list-" + no + "-col").append(html);
				$(el).ColorPickerHide();
				ui();
			}
		});
	}
	else if(val == "text") {
		$('#option-color-' + no).data("popover","input");
		$('#option-color-' + no).data("popover-msg","옵션값 입력");
		$('#option-color-' + no).data("popover-script","add_option_text");
		$('#option-color-' + no).data("popover-query",no);
	}
}
function add_option_text(no,val) {
	var data = $("#option-list-" + no).data("vals");
	var num = $("#option-list-" + no + "-col > a").length;
	var html;
	html  = '<a class="addbox item-center btn-popover" data-popover="delete" data-popover-script="option_detail_delete" data-popover-query="' + num + ',\'' + val + '\'">';
	html += '	<span>' + val + '</span>';
	html += '	<i class="xi-trash"></i>';
	html += '</a>';
	$("#option-list-" + no).data("vals",data+":"+val);
	$("#option-list-" + no + "-col").append(html);

	ui();
}

function set_option_img_name(name,no) {
	var data = $("#option-list-" + no).data("vals");
	$("#option-list-" + no).data("vals",data+":"+name);
}

function option_delete(no) {
	$("#option-list-" + no).remove();
	$("div.popover").remove();
}

function option__detail_delete(no,str) {
	var data = $("#option-img-" + no).data("vals");
	$("#option-img-" + no).data("vals",data.replace(":"+str,""));
	$("#option-list-" + no + "-col > a").eq(no).remove();
	$("div.popover").remove();
}

$('input.option_img').on('change', function() {
	var no = $(this).data("no");
	var num = $("#option-list-" + no + "-col > a").length;
	ext = $(this).val().split('.').pop().toLowerCase(); //확장자
	if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) { //배열에 추출한 확장자가 존재하는지 체크
		resetFormElement($(this)); //폼 초기화
		toast('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
	} else {
		file = $(this).prop("files")[0];
		blobURL = window.URL.createObjectURL(file);
		html = '<a class="addbox item-center btn-popover" data-popover="delete" data-popover-script="option_detail_delete" data-popover-query="" style="background:url(\'' + blobURL + '\') center center no-repeat #000000;background-size:cover"><i class="xi-trash"></i></a>';
		$("#option-list-" + no + "-col").append(html);

		// 서버에 업로드
		if($("#_iframe_hidden_process").length < 1) {
			$("body").append("<iframe id='_iframe_hidden_process' name='_iframe_hidden_process' style='border:none;width:0px;height:0px' width=0 height=0 border=0></iframe>");
		}
		if($("#frm_option_img_" + no).length < 1) {
			$(this).wrap('<form name="frm_option_img_' + no + '" id="frm_option_img_' + no + '" method="post" enctype="multipart/form-data">').closest('form').get(0);
		}
		eval("frm_option_img_" + no).action = "modules/ecommerce/product-option-img.proc.php?no=" + no;
		eval("frm_option_img_" + no).target = "_iframe_hidden_process";
		eval("frm_option_img_" + no + ".submit()");
	}
});

function image_delete(obj) {
	$(obj).parent().parent().remove();
}

function image_view(src) {
	var html;
	html  = '<div class="modal anim-ease-02">';
	html += '	<div class="con anim-ease-02">';
	html += '		<div class="body" style="max-width:fit-content !important">';
	html += '			<div class="contents" style="padding:0">';
	html += '				<img src="' + src + '" style="max-width : 100% ; display:block ; cursor:no-drop" onclick="modal_close();">';
	html += '			</div>';
	html += '		</div>';
	html += '	</div>';
	html += '</div>';
	$("body").addClass("on-modal").append(html);
	setTimeout(function() {
		$(".modal").last().addClass("on");
	},100);
}

function image_preview(file,id) {
	if(typeof id == 'undefined') id = 'goods-image-upload-area';

	ext = file.name.split('.').pop().toLowerCase(); //확장자
	//배열에 추출한 확장자가 존재하는지 체크
	if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
		$(this).wrap('<form>').closest('form').get(0).reset(); 
		$(this).unwrap();
		alert('이미지 파일이 아닙니다. gif, png, jpg, jpeg만 업로드 가능합니다.');
		return false;
	} else {
		blobURL = window.URL.createObjectURL(file);

		var html = "";
		html  = '<div class="item" data-no="0" style="background-image:url(\'' + blobURL + '\')">';
		html += '	<div class="tools">';
		html += '		<a onclick="image_delete(this);"><i class="xi-trash"></i></a>';
		html += '		<a onclick="image_view(\'' + blobURL + '\');"><i class="xi-magnifier-expand"></i></a>';
		html += '	</div>';
		html += '	<a><i class="xi-arrows"></i></a>';
		html += '</div>';
		$('#' + id + ' > .add-image').before(html);

		$("#" + id).sortable({
			connectWith: "#" + id,
			containment: "#" + id,
			items: ".item:not(.disabled)",
			cancel: ".disabled",
			handle: ".xi-arrows",
			placeholder: "item",
			update: function (event, ui) {

			}
		});
	}
}

</script>