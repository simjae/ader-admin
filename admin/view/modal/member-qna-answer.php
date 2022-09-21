<?php
/*
 +=============================================================================
 | 
 | 1:1문의 상세
 | ----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.12.8
 | 최종 수정일	: 2015.12.8 21:24
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../static/init.php';

$data = db_get_field($Table['Qna'],'*','IDX='.$no); // 자료 불러옴

$title = $data['TITLE'];
$contents = $data['CONTENTS'];
$answer = $data['ANSWER'];
?>
<div class="head green">
	<div class="title">
		<i class="fa fa-user"></i> 1:1 문의
	</div>
	<div class="tools">
		<? if($no) { ?>
		<a title="삭제" data-tooltip="삭제"><i class="fa fa-trash-o"></i></a>
		<? } ?>
		<a title="전체화면" data-tooltip="전체화면" class="fullscreen"></a>
		<a title="닫기" data-tooltip="닫기" class="remove" onClick="modal_close(<?=$_modal_count?>);"></a>
	</div>
</div>
<div class='body'>
	<form method="POST" name="frm_modal" id="frm_modal">
	<input type="hidden" name="no" value="<?=$no?>">
	<div class="row">
		<div class="form-group">
			<label class="control-label">문의 내용</label>
			<div class="form-row"><strong><?=$title?></strong></div>
		</div>
		
		<div class="form-group">
			<label class="control-label">내용</label>
			<div class="form-row"><?=nl2br($contents)?></div>
		</div>

		<div class="form-group">
			<label class="control-label">답변</label>
			<div class="form-row">
				<textarea name="ANSWER" class="form-control" title="답변" style="height:300px"><?=$answer?></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label">답변 통보</label>
			<div class="form-row">
				<div class="padding-top-5">
				<?php
				if($data['RECEIVE_SMS'] == 'N' && $data['RECEIVE_EMAIL'] == 'N') {
					echo '답변을 등록하여도 작성자에게 통보되지 않는 문의입니다.';
				}
				else {
					if($data['RECEIVE_SMS'] == 'Y') {
						echo '<div><i class="fa fa-check"></i> 작성자에게 문자로 답변 등록을 통보합니다.</div>';
					}
					if($data['RECEIVE_EMAIL'] == 'Y') {
						echo '<div><i class="fa fa-check"></i> 작성자에게 이메일로 답변 등록을 통보합니다.</div>';
					}
				}
				?>
				</div>
			</div>
		</div>

	</div>
	</form>
</div>
<div class='foot'>
	<a class='btn btn-large red' onClick="fnSubmit();"><i class='fa fa-check'></i> 확인</a>
	<a class='btn btn-large blue' onClick="modal_close(<?=$_modal_count?>);"><i class='fa fa-close'></i> 닫기</a>
</div>

<script>
function fnSubmit() {
	if($("#frm_modal").formvaild()) {
		loading_start();
		$.ajax(
			{
				url:"modules/members/qna-add.proc.php",
				data:$("#frm_modal").serialize(),
				type:'post',
				error:function(d){
					loading_stop();
					modal_alert("1:1 문의 답변 실패","답변 작성 실패했습니다.",1);
				},
				success:function(d){
					loading_stop();
					if(d.code == 200) {
						toast("문의에 대한 답변을 작성했습니다",1);
						pages_refresh();
						modal_close(<?=$modal_count?>);
					}
					else {
						modal_alert("오류",d.msg,1);
					}
				},
				dataType:'json'
			}
		);
	}
}
</script>