<?php
/*
 +=============================================================================
 | 
 | 회원 정보 작성/수정
 | ---------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.06.28
 | 최종 수정일	: 
 | 버전		: 0.1
 | 설명		: 
 | 
 +=============================================================================
*/
$no = $_GET['no'];
?>
<div class="body">
	<h1>참여자 정보<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="modules/event/list/?m=add">

		<div class="form-group">
			<input type="text" name="name" readonly>
			<label class="control-label">참여자</label>
		</div>

		<div class="form-group">
			<input type="text" name="email" readonly>
			<label class="control-label">이메일</label>
		</div>

		<div class="form-group">
			<input type="text" name="tel" readonly>
			<label class="control-label">연락처</label>
		</div>

		<div class="form-group">
			<input type="text" name="instagram_id" readonly>
			<label class="control-label">인스타그램 ID</label>
		</div>

		<div class="form-group">
			<input type="number" name="zipcode" class="zipcode" style="width:100px" readonly>
			<a class="btn blue" onclick="zipcode(this);">우편번호 검색</a><br>
			<input type="text" name="address1" class="margin-top-5">
			<input type="text" name="address2" class="margin-top-5" placeholder="상세 주소">
			<label class="control-label">주소</label>
		</div>


		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit();" class="btn red"><i class="xi-check"></i>적용</a>
	</div>
</div>

<script>
$(document).ready(function() {
	var f = $("form").last();
	$.ajax({
		type: "post",
		url: config.api + "event/list/list",
		data: {
			no : <?=$no?>
		},
		dataType: "json",
		error: function() {
			toast("회원정보데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			$(f).find("input[name=name]").val(d.data[0].name);
			$(f).find("input[name=email]").val(d.data[0].email);
			$(f).find("input[name=tel]").val(d.data[0].tel);
			$(f).find("input[name=zipcode]").val(d.data[0].zipcode);
			$(f).find("input[name=address1]").val(d.data[0].address1);
			$(f).find("input[name=address2]").val(d.data[0].address2);
			$(f).find("input[name=instagram_id]").val(d.data[0].instagram_id);
		}
	});
});
</script>