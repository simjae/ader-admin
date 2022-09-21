<style>
    .popup{
        background-color: #fff;
    }
    .preview{
        background-image: url('/images/popup/popup__bg.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<input id="popup_idx" type="hidden" name="popup_idx" value="<?=$idx?>">
<div class="content__card" style="width:1350px;margin: 0;">	
    <div class="content__card">
        <div class="card__header">
            <div class="flex justify-between">
                <h3>팝업 미리보기</h3>
                <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
            </div>
            <div class="drive--x"></div>
        </div>
        <div class="card__body">
			<div class="preview">
				<div class="preview_web" style="overflow-y:scroll;overflow-x:scroll;width: 100%;height: 600px; border-radius: 2px;">
				</div>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function() {
    var popup_idx = $('#popup_idx').val();
    if(popup_idx != null){
        $.ajax({
            type: "post",
            data: {
                'popup_idx' : popup_idx
            },
            dataType: "json",
            url: config.api + "display/popup/get",
            error: function() {
                alert("팝업 불러오기 처리에 실패했습니다.");
            },
            success: function(data) {
                if(data.code == 200) {
                    var row = data.data[0];

                    var close_str = '';
                    $('.preview_web').html('');

                    if(row.close_flg=='TODAY'){
                        close_str 		= '오늘 하루 열지 않기';
                    }
                    else if(row.close_flg=='NONE'){
                        close_str 		= '다시 열지 않기';
                    }
                    popupDiv = `
                        <div class="popup" style="width:${row.size_width}px; margin-top: ${row.location_height}px; margin-left:${row.location_width}px;">
                            <div class="pop__header">
                                <div></div>
                                <div class="h__title">${row.title}</div>
                                <div class="h__close"><i class="xi-close"></i></div>
                            </div>
                            <div class="pop__body" style="height:${row.size_height}px; text-align:${row.align.toLowerCase()}">
                                <div class="b__content">
                                    ${row.contents}
                                </div>
                            </div>
                            <div class="pop__footer">
                                <div class="f__box">
                                    <div class="f__cookie">${close_str}</div>
                                    <div class="f__close">닫기</div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('.preview_web').prepend(popupDiv);
                }
            }
        });
    }
});
</script>
