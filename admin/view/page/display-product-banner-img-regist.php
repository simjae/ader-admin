<div class="content__card">
	<form id="frm-add_IMG" action="display/product/banner/add">
		<input name="banner_type" type="hidden" value="IMG">

		<div class="card__header">
			<div class="flex justify-between">
				<h3>배너 이미지 등록</h3>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">배너 타이틀</div>
				<div class="content__row">
					<input class="banner_title" type="text" name="banner_title" style="width:100%;" value="">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">배너 메모</div>
				<div class="content__row">
					<input class="banner_memo" type="text" name="banner_memo" style="width:100%;" value="">
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">배너 썸네일 등록</div>
					<div class="content__row">
						<input class="banner_thumb" type="file" name="banner_thumb">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">배너 이미지 등록</div>
					<div class="content__row">
						<input class="banner_img" type="file" name="banner_img">
					</div>
				</div>
			</div>
			
			<div class="content__wrap img_content" style="display:none;">
				<div class="content__title">이미지 영역 설정</div>
				<div class="content__row">
					<div class="img_div" style="position:relative;width:100%;border:1px solid #000000;background-size:cover;">
						<div class="preview_div_P2" style="position:absolute;top:0px;width:100%;border:3px solid blue;display:none;"></div>
						<div class="preview_div_P4" style="position:absolute;top:0px;width:100%;border:3px solid red;display:none;"></div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half img_content" style="display:none;">
				<div class="half__box__wrap">
					<div class="content__title">2그리드 표시영역</div>
					<div class="content__row">
						<input class="height_start" type="number" min="0" max="354" name="height_start" style="width:100px;" value="0" onChange="checkPreviewLocation('height');">
						<input class="height_end" type="number" min="906" max="1260" name="height_end" style="width:100px;" value="906" onChange="checkPreviewLocation('height');">
						
						<div class="preview_btn btn" onClick="togglePreviewDiv('P2');">미리보기</div>
						
						<div class="btn" preview_type="P2" action_type="up" onClick="updatePreviewLocation(this);">
							<i class="xi-angle-up"></i>
							<span class="tooltip top">위로</span>
						</div>
						
						<div class="btn" preview_type="P2" action_type="down" onClick="updatePreviewLocation(this);">
							<i class="xi-angle-down"></i>
							<span class="tooltip top">아래로</span>
						</div>
					</div>	
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">4그리드 표시영역</div>
					<div class="content__row">
						<input class="width_start" type="number" min="0" max="462" name="witdh_start" style="width:100px;" value="0" onChange="checkPreviewLocation('width');">
						<input class="width_end" type="number" min="1778" max="2240" name="witdh_start" style="width:100px;" value="1778" onChange="checkPreviewLocation('width');">
						
						<div class="preview_btn btn" onClick="togglePreviewDiv('P4');">미리보기</div>
						
						<div preview_type="P4" class="btn" action_type="left" onClick="updatePreviewLocation(this);">
							<i class="xi-angle-left"></i>
							<span class="tooltip top">위로</span>
						</div>
						
						<div preview_type="P4" class="btn" action_type="right" onClick="updatePreviewLocation(this);">
							<i class="xi-angle-right"></i>
							<span class="tooltip top">아래로</span>
						</div>
					</div>		
				</div>
			</div>
			
			<div class="table table__wrap">
				<div class="btn_row" style="display:flex;">
					<div class="rd__block">
						<input id="link_type_PO" class="link_type" type="radio" name="link_type" value="PO" onClick="resetLinkType();" checked>
						<label for="link_type_PO">게시물</label>
						
						<input id="link_type_PR" class="link_type" type="radio" name="link_type" value="PR" onClick="resetLinkType();">
						<label for="link_type_PR">상품</label>
					</div>
					
					<div class="table__filter" style="margin-left:15px;margin-top:10px;">
						<div class="filrer__wrap">
							<div class="filter__btn" onclick="checkLinkType();">검색</div>
						</div>                          
					</div>
				</div>
				
				<div class="overflow-x-auto">
					<input class="page_idx" type="hidden" name="page_idx" value="0">
					<TABLE id="excel_table" style="width:150%;">
						<THEAD>
							<TR>
								<TH style="width:100px;">게시물 삭제</TH>
								<TH style="width:250px;">게시물 타입</TH>
								<TH style="width:500px;">게시물 타이틀</TH>
								<TH style="width:500px;">게시물 메모</TH>
								<TH style="width:500px;">게시물 URL</TH>
								<TH style="width:150px;">게시물 진열상태</TH>
								<TH style="width:350px;">게시물 진열기간</TH>
								<TH style="width:200px;">게시물 조회수</TH>
								<TH style="width:350px;">게시물 작성일</TH>
								<TH style="width:250px;">게시물 작성자</TH>
								<TH style="width:350px;">게시물 수정일</TH>
								<TH style="width:250px;">게시물 수정자</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table">
							<TR>
								<TD class="default_td" colspan="11" style="text-align:left;">
									선택된 게시물이 없습니다. 게시물을 선택해주세요.
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onclick="addBanner();"><span>등록</span></div>
					<div class="defult__color__btn" onclick="location.href='/display/product/banner'"><span>등록 취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {		
	$(window).resize(function() {
		getDivWidth('IMG');
		getDivWidth('P2');
		getDivWidth('P4');
		
		checkPreviewLocation('width');
		checkPreviewLocation('height');
	});
	
	$('.banner_img').on('change', function() {
		if ($(this).val() == "" || $(this).val() == null) {
			resetFormElement($(this)); //폼 초기화
			$('.img_div').css('background-image', '');
			$('.img_content').hide();
		} else {
			ext = $(this).val().split('.').pop().toLowerCase(); //확장자
			
			//배열에 추출한 확장자가 존재하는지 체크
			if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
				resetFormElement($(this)); //폼 초기화
				alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
				return false;
			} else {
				file = $(this).prop("files")[0];
				
				blobURL = window.URL.createObjectURL(file);
				
				let tmp_img = new Image();
				tmp_img.src = blobURL;
				
				tmp_img.onload = function() {
					if (tmp_img.width != 2240 || tmp_img.height != 1260) {
						resetFormElement($(this));
						alert('배너 이미지는 가로 2240px, 세로 1260px 사이즈의 이미지만 업로드 가능합니다.');
						
						$('.img_div').css('background-image', '');
						$('.img_content').hide();
						
						return false;
					} else {
						$('.img_div').css('background-image', 'url(' + blobURL + ')');
						$('.img_content').show();
						getDivWidth('IMG');
					}
				}
				
				$('.width_start').val(0);
				$('.width_end').val(1778);
				
				$('.height_start').val(0);
				$('.height_end').val(906);
				
				getDivWidth('P2');
				getDivWidth('P4');
			}
		}
	});
});

function resetLinkType() {
	let result_table = $('#result_table');
	
	result_table.html('');
	
	let strDiv = "";
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="11" style="text-align:left;">';
	strDiv += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	result_table.append(strDiv);
}

function checkLinkType() {
	let link_type = $("input[name='link_type']:checked").val();
	if (link_type == "PR") {
		modal('/product_get');
	} else if (link_type == "PO") {
		modal('/posting_get');
	}
}

function addBanner() {
	let banner_title = $('.banner_title').val();
	if (banner_title == "" || banner_title == null) {
		alert('배너 타이틀을 입력해주세요.');
		return false;
	}
	
	let banner_thumb = $('.banner_thumb').val();
	if (!banner_thumb) {
		alert('배너 썸네일을 선택해주세요.');
		return false;
	}
	
	let banner_img = $('.banner_img').val();
	if (!banner_img) {
		alert('등록하려는 배너를 선택해주세요.');
		return false;
	}	
	
	let clip_info = [];
	
	//PC 2 그리드 배너 표시영역
	let height_start = $('.height_start').val();
	let height_end = $('.height_end').val();
	
	let clip_p2 = [];
	if (height_start != null && height_end != null) {
		clip_p2 = ['P2',height_start,height_end];
	}
	
	if (clip_p2.length > 0) {
		clip_info.push(clip_p2);
	}
	
	//PC 4 그리드 배너 표시영역
	let width_start = $('.width_start').val();
	let width_end = $('.width_end').val();
	
	let clip_p4 = [];
	if (width_start != null && width_end != null) {
		clip_p4 = ['P4',width_start,width_end];	
	}
	
	if (clip_p4.length > 0) {
		clip_info.push(clip_p4);
	}
	
	let json_clip_info = null;
	if (clip_info.length > 0) {
		json_clip_info = JSON.stringify(clip_info)
	} else {
		alert('각 그리드별 배너 표시영역을 설정해주세요');
		return false;
	}
	
	let form = $("#frm-add_IMG")[0];
	let formData = new FormData(form);
	formData.append('clip_info',json_clip_info);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "display/product/banner/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("배너 이미지 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				confirm(
					'배너 이미지가 정상적으로 등록되었습니다.',
					function() {
						location.href = '/display/product/banner';
					}
				);
			}
		}
	});
}

function getDivWidth(div_type) {
	let div = null;
	switch (div_type) {
		case "IMG" :
			div = $('.img_div');
			break;
		
		case "P2" :
			div = $('.preview_div_P2');
			break;
		
		case "P4" :
			div = $('.preview_div_P4');
			break;
	}
	
	let div_width = div.width();
	
	let div_height = 0;
	if (div_type == "IMG") {
		div_height = div_width * 0.5625;
	} else if (div_type == "P2"){
		div_height = div_width * 0.4047;
	} else if (div_type == "P4") {
		div_width = parseInt($('.img_div').width() * 0.7941);
		div_height = $('.img_div').height();
	}
	
	if (div != null && div_width > 0 && div_height > 0) {
		setDivSize(div,div_type,div_width,div_height);
	}
}

function setDivSize(div,div_type,div_width,div_height) {
	div.height(div_height);
	if (div_type == "P4") {
		div.width(div_width);
	}
}

function togglePreviewDiv(preview_type) {
	$('.preview_div_' + preview_type).toggle();
	getDivWidth(preview_type);
}

function updatePreviewLocation(obj) {
	let preview_type = $(obj).attr('preview_type');
	let action_type = $(obj).attr('action_type');
	
	let update_value = 10;
	
	if (preview_type == "P2") {
		let height_start = $('.height_start').val();
		
		if (action_type == "up") {
			height_start = (parseInt(height_start) - update_value);
		} else if (action_type == "down") {
			height_start = (parseInt(height_start) + update_value);
		}
		
		$('.height_start').val(height_start);
		
		checkPreviewLocation('height');
	} else if (preview_type == "P4") {
		let width_start = $('.width_start').val();
		
		if (action_type == "left") {
			width_start = (parseInt(width_start) - update_value);
		} else if (action_type == "right") {
			width_start = (parseInt(width_start) + update_value);
		}
		
		$('.width_start').val(width_start);
		
		checkPreviewLocation('width');
	}
}

function checkPreviewLocation(location_type){
	if (location_type == "width") {
		let img_width = $('.img_div').width();
		
		let width_start = $('.width_start').val();
		let width_end = $('.width_end').val();
		
		if (parseInt(width_start) < 0) {
			width_start = 0;
		}
		
		width_end = (parseInt(width_start) + 1778);
		
		if (width_start > 462 || width_end > 2240) {
			width_start = 462;
			width_end = 2240;
		}
		
		let calc_width = ((img_width * width_start) / 2240);
		
		$('.width_start').val(width_start);
		$('.width_end').val(width_end);
		
		setPreviewLocation('P4',calc_width);
	} else if (location_type == "height") {
		let img_height = $('.img_div').height();
		
		let height_start = $('.height_start').val();
		let height_end = $('.height_end').val();
		
		if (parseInt(height_start) < 0) {
			height_start = 0;
		}
		
		height_end = (parseInt(height_start) + 906);
		
		if (height_start > 354 || height_end > 1260) {
			height_start = 354;
			height_end = 1260;
		}	
		
		let calc_height = ((img_height * height_start) / 1260);
		
		$('.height_start').val(height_start);
		$('.height_end').val(height_end);
		
		setPreviewLocation('P2',calc_height);
	}
}

function setPreviewLocation(preview_type,calc_value) {
	if (preview_type == "P2") {
		$('.preview_div_' + preview_type).css('top',calc_value + 'px');
	} else if (preview_type == "P4") {
		$('.preview_div_' + preview_type).css('left',calc_value + 'px');
	}
	
}
</script>