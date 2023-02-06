<div class="content__card">
	<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$banner_idx = getUrlParamter($page_url, 'banner_idx');
	?>
	<form id="frm-put_HED" action="display/product/banner/put">
		<input id="banner_type" name="banner_type" type="hidden" value="HED">
		<input id="banner_idx" name="banner_idx" type="hidden" value="<?=$banner_idx?>">

		<div class="card__header">
			<div class="flex justify-between">
				<h3>배너 헤드 이미지 수정</h3>
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
			
			<div class="content__wrap">
				<div class="content__title">배너 썸네일</div>
				<div class="content__row">
					<div class="banner_thumb" style="width:100px;height:100px;"></div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">이미지 영역 설정</div>
				<div class="content__row">
					<div class="img_div" style="position:relative;width:100%;border:1px solid #000000;">
						<div class="preview_div" style="position:absolute;top:0px;width:100%;border:3px solid red;display:none;"></div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
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
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onclick="putBannerInfo();"><span>배너 헤드 수정</span></div>
					<div class="defult__color__btn" onclick="location.href='/display/product/banner'"><span>수정 취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {	
	getBannerInfo();
	
	$(window).resize(function() {
		getDivWidth('img_div');
		getDivWidth('preview_div');
	});
});

function getBannerInfo() {
	let banner_type = $('#banner_type').val();
	let banner_idx = $('#banner_idx').val();
	
	$.ajax({
		type: "post",
		data: {
			"banner_type" : banner_type,
			"banner_idx" : banner_idx
		},
		dataType: "json",
		url: config.api + "display/product/banner/get",
		error: function() {
			alert("배너 이미지 조회 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						$('.banner_title').val(row.banner_title);
						$('.banner_memo').val(row.banner_memo);
						$('.banner_thumb').css('background-image','url(\'' + row.banner_thumbnail + '\')');
						$('.img_div').css('background-image','url(\'' + row.banner_location + '\')');
						
						$('.height_start').val(parseInt(row.location_start));
						$('.height_end').val(parseInt(row.location_end));
						
						getDivWidth('img_div');
						getDivWidth('preview_div');
						
						checkPreviewLocation();
					});
				}
			}
		}
	});
}

function putBannerInfo() {
	let banner_title = $('.banner_title').val();
	if (banner_title == "" || banner_title == null) {
		alert('배너 타이틀을 입력해주세요.');
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
	
	let form = $("#frm-put_HED")[0];
	let formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "display/product/banner/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("배너 헤드 이미지 수정 처리에 실패했습니다.");
		},
		success: function(d) {
			if (d.code == 200) {
				confirm(
					'배너 헤드 이미지가 정상적으로 수정되었습니다.',
					function() {
						location.href = '/display/product/banner';
					}
				);
			} else {
				alert(d.msg);
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
	
	checkPreviewLocation();
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