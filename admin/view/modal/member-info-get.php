<div class="content__card" style="margin:0;width:500px;">
	<input id="param" type="hidden" value="<?=$param?>">	
	<div class="card__header">
		<h3>멤버레벨 일괄변경
			<a onclick="modal_close();" class="btn-close" style="float:right">
				<i class="xi-close"></i>
			</a>
		</h3>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div class="content__wrap">
			<div class="content__title">변경 할 멤버 레벨</div>
			<div class="content__row">
				<select class="fSelect modal_member_level" name="member_level" style="width:163px;">
				<?php
					$select_level_sql = "
						SELECT
							ML.IDX		AS LEVEL_IDX,
							ML.TITLE	AS LEVEL_TITLE
						FROM
							MEMBER_LEVEL ML
						WHERE
							DEL_FLG = FALSE
					";
					
					$db->query($select_level_sql);
					
					foreach($db->fetch() as $level_data) {
				?>
					<option value="<?=$level_data['LEVEL_IDX']?>"><?=$level_data['LEVEL_TITLE']?></option>
				<?php
					}
				?>
				</select>
			</div>
		</div>
	</div>
	
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div toggle="hide"></div>
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" style="width:200px;" onClick="putMemberLevel();"><span>저장</span></div>
				<div class="defult__color__btn" style="width:200px;" onClick="modal_close();"><span>취소</span></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	
});

function putMemberLevel() {
	let param = $('#param').val();
	
	let tmp_arr = [];
	if (param != null) {
		tmp_arr = param.split('_');
	}
	
	let country = tmp_arr[0];
	let member_idx = tmp_arr[1].split(',');
	let member_level = $('.modal_member_level').val();
	
	console.log(member_idx);
	
	$.ajax({
		type: "post",
		data: {
			'level_flg' : true,
			'country' : country,
			'member_idx' : member_idx,
			'member_level' : member_level
			
		},
		dataType: "json",
		url: config.api + "member/info/put",
		error: function() {
			alert("선택한 멤버의 레벨 일괄 변경 처리 중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				confirm(
					"멤버 레벨이 변경되었습니다.",
					function() {
						modal_close();
						getMemberInfoList('MLV');
					}
				);
				
			}
		}
	});
}

</script>