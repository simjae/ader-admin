<style>
.time__select{width:80px!important;}	
textarea {
    width: 100%;
    height: 40vh;
    border: 1px solid #dcdcdc;
    resize: none;
}
</style>
<div class="content__card" style="width:50vw;margin: 0;">
	<form id="frm-update" action="event/submit/put">
		<input type="hidden" id="event_idx" name="event_idx" value="<?=$idx?>">
		<div class="card__header">
			<div class="flex justify-between">
				<h3>응모자 로우데이터</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
            <div class="content__wrap" style="align-items: start;">
                <div class="content__title">로우데이터(JSON형식)</div>
                <div class="content__row">
<?php
        $get_raw_data_sql = "
            SELECT
                RAW_DATA
            FROM
                EVENT
            WHERE
                IDX = ".$idx."
        ";

        $db->query($get_raw_data_sql);
        $raw_data_str = '';
        foreach($db->fetch() as $data){
            $raw_data_str = $data['RAW_DATA'];
        }
?>
                    <textarea id="event_raw_data" name="raw_data" title="내용" style="padding:10px;" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" required><?=trim($raw_data_str)?></textarea>
                </div>
            </div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  onclick="eventUpdateAction();"  class="blue__color__btn"><span>저장</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<script>
$(document).ready(function() {
});

function eventUpdateAction(){
	var formData = new FormData();
	formData = $("#frm-update").serializeObject();
	confirm("로우 데이터를 수정하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "event/submit/put",
			error: function() {
				alert("로우 데이터를 수정에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("전시관리 > 이벤트 관리 ", "로우 데이터를 수정", null);
					alert("로우 데이터를 수정에 성공했습니다.",function(){
						getEventList();
                        modal_close();
                    });
				}
			}
		});
	});
}

</script>