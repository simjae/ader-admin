<style>
#seo{
	margin-top : 50px;
}
.sub{
	margin-top : 10px;
}
.content__title.content{
    vertical-align: top;
}
.preview{
	display: grid;
	grid-template-columns: 300px 1fr;
	width: 100%;
	height: 400px;
	border-radius: 20px;
	box-shadow: 2px 1px 8px 0px #7070704a;
}
.preview__img{
	background-size: cover;
	width: 100%;
	background-repeat: no-repeat;
	padding: 20px;
	height: 100%;
}
</style>

<div class="content__card" style="width:950px;margin: 0;">
	<form id="frm-preview" action="">
		<input id="page_idx" type="hidden" name="page_idx" value="<?=$idx?>">
		<div class="card__header">
			<div class="flex justify-between">
				<h3>What's New 페이지 프리뷰</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<span name="country" style="width:80px"></span>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">페이지명</div>
				<div class="content__row">
					<span style="width:80%;" placeholder="" name="page_title"></span>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">서브 페이지명</div>
				<div class="content__row">
					<span style="width:80%;" placeholder="" name="page_sub_title"></span>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">설명</div>
				<div class="content__row">
					<span style="width:80%;" placeholder=""  name="page_memo"></span>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">URL</div>
				<div class="content__row">
					<span style="width:80%;" placeholder=""  name="page_url"></span>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">썸네일</div>
				<div class="content__row">
					<div class="preview">
						<div class='preview__img'></div>
					</div>
				</div>
			</div>
            
			<div class="content__wrap">
				<div class="content__title content">페이지 컨텐츠</div>
				<div class="content__row" style="width:100%;overflow:scroll;">
					<p name="page_content" style="witdh:100%;min-height:200px;"></p>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">진열 여부</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="display_flg_none" class="radio__input" value="false" value="none" name="display_flg" disabled>
						<label for="display_flg_none">진열 안함</label>
						
						<input type="radio" id="display_flg_always" class="radio__input display_flg" value="true" name="display_flg" disabled>
						<label for="display_flg_always">상시 오픈</label>
						
						<input type="radio" id="display_flg_date" class="radio__input display_flg" value="false" name="display_flg" disabled>
						<label for="display_flg_date" style="gap:5px;">지정 시간에만</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title"></div>
				<div class="content__row">
					<div class="content__date__picker">
						<input id="display_from" class="display_date" type="date" name="display_from" placeholder="From" style="width:150px" disabled>
						<select class="display_date" type="select" name="display_from_h" style="width:80px" disabled>
							<option value="" selected>시간</option>
						</select>
						<select class="display_date" type="select" name="display_from_m" style="width:80px" disabled>
							<option value="" selected>분</option>
						</select>
						
						<font class="" >~</font>
						
						<input id="display_to" class="display_date" type="date" name="display_to" placeholder="To" style="width:150px;" disabled>
						<select class="display_date" type="select" name="display_to_h" style="width:80px" disabled>
							<option value="" selected>시간</option>
						</select>
						<select class="display_date" type="select" name="display_to_m" style="width:80px" disabled>
							<option value="" selected>분</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	var page_idx = $('#page_idx').val();
	
	timeSelectInit();

	$.ajax({
		type: "post",
		data: {
			'page_idx' : page_idx
		},
		dataType: "json",
		url: config.api + "display/whats/get",
		error: function() {
			alert("WHAT'S NEW 프리뷰 불러오기 처리에 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {var img_location = data['data'][0].img_location.replace('/var/www/admin/www','');
				$("#frm-preview").find(".preview__img").css("background-image","url('" + img_location + "')");
				
			
				$("span[name='country']").text(data['data'][0].country).prop('selected',true);
				
				$("span[name='page_title']").text(data['data'][0].page_title);
				$("span[name='page_sub_title']").text(data['data'][0].page_sub_title);
				$("span[name='page_memo']").text(data['data'][0].page_memo);
				$("span[name='page_url']").text(data['data'][0].page_url);
				$("span[name='thumbnail_url']").text(data['data'][0].thumbnail_url);
				$("p[name='page_content']").html(data['data'][0].page_content);
				
				var display_start_date = data['data'][0].display_start_date;
				var display_end_date = data['data'][0].display_end_date;
				
				if (display_end_date == '9999-12-31') {
					$('#display_flg_always').prop('checked',true);
					$('.display_date').attr("disabled", true);
				} else {
					$('#display_flg_date').prop('checked',true);
					
					$('#display_from').val(display_start_date);
					$('#display_to').val(display_end_date);
					
					$("select[name='display_from_h']").val(data['data'][0].display_start_h).prop('selected',true);
					$("select[name='display_from_m']").val(data['data'][0].display_start_m).prop('selected',true);

					$("select[name='display_to_h']").val(data['data'][0].display_end_h).prop('selected',true);
					$("select[name='display_to_m']").val(data['data'][0].display_end_m).prop('selected',true);
				}
			}
		}
	});
});

function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$("select[name='display_from_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
		$("select[name='display_to_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
	}
	
	for(var j = 0; j < 60; j++){
		$("select[name='display_from_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
		$("select[name='display_to_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
	}
}
</script>