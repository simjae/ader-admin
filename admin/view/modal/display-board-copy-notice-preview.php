<style>
#answer{
	margin-top : 50px;
}
</style>
<div class="content__card modal__view" style="width:950px;margin: 0;">
    <input id="param" type="hidden"  value='<?=$param?>'>
    <input id="page_idx" type="hidden" name="page_idx" value="">
    <input id="page_idx" type="hidden" name="country" value="">

    <div class="card__header">
        <div class="flex justify-between">
            <h3 id='preview_title'>공지사항 프리뷰</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div class="content__wrap">
            <div class="content__title">카테고리</div>
            <div class="content__row">
                <span name="category" style="width:200px"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">작성자</div>
            <div class="content__row">
                <span name="creater" style="width:100%"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">제목</div>
            <div class="content__row">
                <span name="title" style="width:100%"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title">작성시간</div>
            <div class="content__row">
                <span name="create_date" style="width:200px"></span>
            </div>
        </div>
        <div class="content__wrap">
            <div class="content__title content">상세내용</div>
            <div class="content__row" style="width:100%;overflow:scroll;">
                <p name="contents" style="min-height:200px;width:100%;border: 1px solid #000;"></p>
            </div>
        </div>
    </div>
    <div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg">
				<div class="defult__color__btn" onclick="modal_cancel();"><span>창 닫기</span></div>
			</div>
		</div>
	</div>
</div>
<script>

$(document).ready(function() {
	var param = $('#param').val();
    var param_arr = param.split(',');

    let page_idx    = param_arr[0];
    let country     = param_arr[1];
	$.ajax({
		type: "post",
		data: {
			'board_idx' : page_idx,
            'country' : country,
            'tab_num' : '03',
		},
		dataType: "json",
		url: config.api + "page/board/get",
		error: function() {
			alert("공지사항 불러오기 처리에 실패했습니다.");
		},
		success: function(data) {
			if(data.code == 200) {
                $("span[name='category']").text('공지사항 > '+data['data'][0].category);
                $("span[name='creater']").text(data['data'][0].creater_name+'('+data['data'][0].creater+')');
                $("span[name='title']").text(data['data'][0].title);
                $("span[name='create_date']").text(data['data'][0].create_date);
				$("p[name='contents']").html(data['data'][0].contents);
			}
		}
	});
});	

</script>