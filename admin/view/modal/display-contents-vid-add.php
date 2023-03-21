<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
</style>
<div class="content__card modal__view" style="margin: 0;">
	<form id="frm-add" action="display/contents/add">
		<input type="hidden" name="contents_type" value="VID">
	
		<div class="card__header">
			<div class="flex justify-between">
				<h3>동영상 등록</h3>
				<a href="javascript:;" style="cursor:pointer;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">동영상 타이틀</div>
				<div class="content__row">
					<input id="duplicate_check" type="hidden" value="false">
					<input id="img_title" type="text" style="width:80%;" placeholder="" name="img_title">
					<div id="duplicate_btn" class="defult-btn" style="width:95px;background-color:#e43a45;color:#ffffff;font-size:0.5rem;text-align:center;" onclick="duplicateCheck()">중복체크</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">동영상 타입</div>
				<div class="content__row">
					<input id="img_type" type="text" value="" placeholder="" name="img_type">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">동영상 메모</div>
				<div class="content__row">
					<input type="text" value="" style="width:80%;" placeholder=""  name="page_memo">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">동영상 등록</div>
				<div class="content__row">
					<div class="form-group" style="padding:0px;">
						<div id="contents_vid_area" style="border:1px solid #000000;width:100%;height:470px;padding-top:50px;">
							동영상을 선택해주세요.
						</div>
						
						<video class="preview contents_vid" loop="" autoplay="" muted="" playsinline="" style="width:100%;display:none;" src=""></video>
						
						<span class="btn btn-large blue" style="margin-top:10px;">
							동영상 선택
							<input id="contents_vid" type="file" name="contents_vid" class="input-image">
						</span><br>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  onclick="productDisplayRegistCheck();"  class="blue__color__btn" onClick=""><span>저장</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<script>
$(document).ready(function() {
	$('#img_title').change(function() {
		$('#duplicate_check').val(false);
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('중복체크');
	});
	
	$('#contents_vid').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['mp4', 'wmv']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('동영상 파일만 등록 가능합니다. (mp4, wmv)');
		} else {
			var file = $(this).prop("files")[0];
			
			var video_id = $(this).attr('id');
			
			blobURL = window.URL.createObjectURL(file);
			$('#' + video_id + '_area').hide();
			$('.' + video_id).show();
			$('.' + video_id).attr('src', blobURL);
			$('.' + video_id).slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
});

function duplicateCheck(){
	var img_title = $('#img_title').val();
	
	if(img_title.length == 0 || img_title == null){
		alert('동영상 타이틀을 입력해주세요.');
		return false;
	} else{
		$.ajax({
			type: "post",
			data: {
				"contents_type":"IMG",
				"contents_title":img_title
			},
			dataType: "json",
			url: config.api + "display/contents/check",
			error: function() {
				alert('동영상 타이틀 중복체크에 실패했습니다.');
			},
			success: function(d) {
				var data = d.data;
				if(data != null) {
					var contents_cnt = data[0].contents_cnt;
					if(contents_cnt > 0){
						$('#duplicate_btn').css('background-color','#E43A45');
						$('#duplicate_btn').text('중복체크');
		
						alert("동영상 타이틀이 중복됩니다. 다른 타이틀을 입력해주세요.");
					} else{
						$('#duplicate_check').val(true);
						$('#duplicate_btn').css('background-color','#114400');
						$('#duplicate_btn').text('체크완료');
					}
				}
			}
		});
	}
}

function contentsImgCheck(){
	var duplicate_check = $('#duplicate_check').val();
	var vid_title = $('#vid_title').val();
	var vid_type = $('#vid_type').val();
	
	if (duplicate_check == "false") {
		alert('동영상 등록을 위해 타이틀 죽복검사를 확인해주세요.');
		return false;
	}
	
	if (vid_title == null) {
		alert('동영상 타이틀을 입력해주세요.');
		return false;
	}
	
	if (vid_type == null) {
		alert('동영상 타입을 입력해주세요.');
		return false;
	}
		
	modal_submit($('#frm-list'),'getContentsVid');
}
</script>