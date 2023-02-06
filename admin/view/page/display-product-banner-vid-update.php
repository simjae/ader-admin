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
	<form id="frm-put_VID" action="display/product/banner/put">
		<input id="banner_type" name="banner_type" type="hidden" value="VID">
		<input id="banner_idx" name="banner_idx" type="hidden" value="<?=$banner_idx?>">

		<div class="card__header">
			<div class="flex justify-between">
				<h3>배너 동영상 수정</h3>
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
				<div class="content__title">동영상 영역 설정</div>
				<div class="content__row">
					<div class="vid_div" style="position:relative;width:100%;border:1px solid #000000;background-size:cover;">
						<video id="video" style="width:100%;height:100%;" autoplay="autoplay" controls loop>
							<source class="vid_source" src="">
						</video>
						<div class="preview_div_P2" style="position:absolute;top:0px;width:100%;border:3px solid blue;display:none;"></div>
						<div class="preview_div_P4" style="position:absolute;top:0px;width:100%;border:3px solid red;display:none;"></div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
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
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onclick="putBannerInfo();"><span>배너 이미지 수정</span></div>
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
		getDivWidth('VID');
		getDivWidth('P2');
		getDivWidth('P4');
		
		checkPreviewLocation('width');
		checkPreviewLocation('height');
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
					data.forEach(function(banner_row) {
						$('.banner_title').val(banner_row.banner_title);
						$('.banner_memo').val(banner_row.banner_memo);
						$('.banner_thumb').css('background-image','url(\'' + banner_row.banner_thumbnail + '\')');
						
						let video = $('#video');
						$('.vid_source').attr('src',banner_row.banner_location);
						video.load();
						video.onloadeddata = function() {
							video.play();
						}
						
						let clip_info = banner_row.clip_info;
						clip_info.forEach(function(clip_row) {
							let clip_type = clip_row.clip_type;
							if (clip_type == "P2") {
								$('.height_start').val(clip_row.location_start);
								$('.height_end').val(clip_row.location_end);
							} else if (clip_type == "P4") {
								$('.width_start').val(clip_row.location_start);
								$('.width_end').val(clip_row.location_end);
							}
						});
						
						getDivWidth('VID');
						getDivWidth('P2');
						getDivWidth('P4');
						
						checkPreviewLocation('width');
						checkPreviewLocation('height');
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
	
	let form = $("#frm-put_VID")[0];
	let formData = new FormData(form);
	formData.append('clip_info',json_clip_info);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "display/product/banner/put",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("배너 이미지 수정 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				confirm(
					'배너 이미지가 정상적으로 수정되었습니다.',
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
		case "VID" :
			div = $('.vid_div');
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
	if (div_type == "VID") {
		div_height = div_width * 0.5625;
	} else if (div_type == "P2"){
		div_height = div_width * 0.4047;
	} else if (div_type == "P4") {
		div_width = parseInt($('.vid_div').width() * 0.7941);
		div_height = $('.vid_div').height();
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
		let img_width = $('.vid_div').width();
		
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
		let img_height = $('.vid_div').height();
		
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