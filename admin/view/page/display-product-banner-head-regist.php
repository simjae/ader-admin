<div class="content__card">
	<form id="frm-add_HED" action="display/product/banner/add">
		<input name="banner_type" type="hidden" value="HED">

		<div class="card__header">
			<div class="flex justify-between">
				<h3>배너 헤드 이미지 등록</h3>
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
					<div class="img_div" style="position:relative;width:100%;border:1px solid #000000;">
						<div class="preview_div" style="position:absolute;top:0px;width:100%;border:3px solid red;display:none;"></div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap img_content" style="display:none;">
				<div class="content__title">PC 배너 영역 지정</div>
				<div class="content__row">
					<input class="height_start" type="number" min="0" max="840" name="location_start" value="0" onChange="checkPreviewLocation();">
					<input class="height_end" type="number" min="600" max="1440" name="location_end" value="600" onChange="checkPreviewLocation();">
					
					<div class="preview_btn btn" onClick="togglePreviewDiv();">미리보기</div>
					
					<div class="btn" action_type="up" onClick="updatePreviewLocation(this);">
						<i class="xi-angle-up"></i>
						<span class="tooltip top">위로</span>
					</div>
					
					<div class="btn" action_type="down" onClick="updatePreviewLocation(this);">
						<i class="xi-angle-down"></i>
						<span class="tooltip top">아래로</span>
					</div>
				</div>				
			</div>
			
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onclick="openPagePostingModal('add','KR');">게시물 검색</div>
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
						<TBODY id="result_table_add_KR">
							<TR>
								<TD class="default_td" colspan="12" style="text-align:left;">
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
					<div class="blue__color__btn" onclick="addBannerInfo();"><span>배너 헤드 등록</span></div>
					<div class="defult__color__btn" onclick="location.href='/display/product/banner'"><span>등록 취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	$(window).resize(function() {
		getDivWidth('img_div');
		getDivWidth('preview_div');
	})
	
	$('.banner_img').on('change', function() {
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
				if (tmp_img.width != 2560 || tmp_img.height != 1440) {
					resetFormElement($(this));
					alert('배너 이미지는 가로 2560px, 세로 1440px 사이즈의 이미지만 업로드 가능합니다.');
					
					$('.img_div').css('background-image', '');
					$('.img_content').hide();
					
					return false;
				} else {
					$('.img_div').css('background-image', 'url(' + blobURL + ')');
					$('.img_content').show();
					getDivWidth('img_div');
				}
			}
			
			$('.height_start').val(0);
			$('.height_end').val(600);
			
			getDivWidth('preview_div');
		}
	});
});

function addBannerInfo() {
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
	
	let height_start = $('.height_start').val();
	if (height_start == "" || height_start == null) {
		alert('배너 표시영역을 설정해주세요');
		return false;
	}
	
	let height_end = $('.height_end').val();
	if (height_end == "" || height_end == null) {
		alert('배너 표시영역을 설정해주세요');
		return false;
	}
	
	let form = $("#frm-add_HED")[0];
	let formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "display/product/banner/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("배너 헤드 이미지 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				confirm(
					'배너 헤드 이미지가 정상적으로 등록되었습니다.',
					function() {
						location.href = '/display/product/banner';
					}
				);
			}
		}
	});
}

function getDivWidth(div_type) {
	let div_width = $('.' + div_type).width();
	
	let div_height = 0;
	if (div_type == "img_div") {
		div_height = div_width * 0.5625;
		
	} else if (div_type == "preview_div") {
		div_height = parseInt($('.img_div').width() * 0.2343);
	}
	
	if (div_height > 0) {
		setDivSize(div_type,div_height);
	}
}

function setDivSize(div_type,div_height) {
	$('.' + div_type).height(div_height);
}

function togglePreviewDiv() {
	$('.preview_div').toggle();
	getDivWidth('preview_div');
}

function updatePreviewLocation(obj) {
	let action_type = $(obj).attr('action_type');
	
	let update_value = 10;
	
	let height_start = $('.height_start').val();
	let height_end = $('.height_end').val();
	
	
	
	if (action_type == "up") {
		height_start = (parseInt(height_start) - update_value);
		if ((parseInt(height_start) - update_value) >= 0 && (parseInt(height_end) - update_value) >= 600) {
			
		}
	} else if (action_type == "down") {
		height_start = (parseInt(height_start) + update_value);
		if ((parseInt(height_start) + update_value) <= 840 && (parseInt(height_end) + update_value) <= 1440) {
			
		}
	}
	
	$('.height_start').val(height_start);
	$('.height_end').val(height_end);
	
	checkPreviewLocation()
}

function checkPreviewLocation(){
	let height_start = $('.height_start').val();
	let height_end = $('.height_end').val();
	
	if (parseInt(height_start) < 0) {
		height_start = 0;
	}
	
	if (height_start > 840 || height_end > 1440) {
		height_start = 840;
		height_end = 1440;
	}
	
	height_end = (parseInt(height_start) + 600);
	
	let calc_height = (parseInt(height_start) * 0.8236);
	
	$('.height_start').val(height_start);
	$('.height_end').val(height_end);
	
	setPreviewLocation(calc_height);
}

function setPreviewLocation(calc_height) {
	$('.preview_div').css('top',calc_height + 'px');
}
</script>