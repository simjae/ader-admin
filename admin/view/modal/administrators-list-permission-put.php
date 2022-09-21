<?php
/*
 +=============================================================================
 | 
 | 관리자 권한 작성/수정
 | -----------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.09.07
 | 최종 수정일	: 2017.07.15
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
?>
<div class="body">
	<h1>관리자 권한 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="modules/admin/main/?m=add">
		<input type="hidden" name="no" value="<?=$no?>">

		<div class="form-group">
			<input type="text" name="title" value="<?=$title?>" maxlength="20" required>
			<label class="control-label">권한 그룹명</label>
		</div>

		<table class="list width-100p">
		<!-- BEGIN 환경설정 -->
		<tr>
			<th rowspan="6"><i class="icon-settings"></i> 환경설정</th>
			<td><i class="icon-equalizer"></i> 기본 설정</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|common||read" class="icheck" <?if($_permitdata['siteconfig|common||read']==true) echo 'checked';?> data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|common||modify" class="icheck" <?if($_permitdata['siteconfig|common||modify']==true) echo 'checked';?> data-checkbox="icheckbox_minimal-grey"> 설정 변경 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-umbrella"></i> 약관</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|terms||read"  class="icheck" <?if($_permitdata['siteconfig|terms||read']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|terms||modify"  class="icheck" <?if($_permitdata['siteconfig|terms||modify']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 설정 변경 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-picture"></i> 메인비쥬얼</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|visual||read"  class="icheck" <?if($_permitdata['siteconfig|visual||read']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|visual||modify"  class="icheck" <?if($_permitdata['siteconfig|visual||modify']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 이미지 추가/삭제/수정 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-grid"></i> 팝업</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|popup||read"  class="icheck" <?if($_permitdata['siteconfig|popup||read']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|popup||modify"  class="icheck" <?if($_permitdata['siteconfig|popup||modify']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 팝업 추가/삭제/수정 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-envelope"></i> 메일 디자인</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|mailform||read"  class="icheck" <?if($_permitdata['siteconfig|mailform||read']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|mailform||modify"  class="icheck" <?if($_permitdata['siteconfig|mailform||modify']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 설정 변경 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-fire"></i> 보안</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|security||read"  class="icheck" <?if($_permitdata['siteconfig|security||read']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="siteconfig|security||modify"  class="icheck" <?if($_permitdata['siteconfig|security||modify']==true) echo 'checked';?>  data-checkbox="icheckbox_minimal-grey"> 설정 변경 </label>
			</td>
		</tr>
		<!-- END 환경설정 -->

		<?php if($_CONFIG['MODULE']['member']) { ?>
		<!-- BEGIN 회원 -->
		<tr>
			<th rowspan="3"><i class="icon-user"></i> 회원</th>
			<td><i class="icon-users"></i> 회원 목록</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|list||read" <?if($_permitdata['member|list||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|member||add" <?if($_permitdata['member|member||add']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 회원 추가 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|member||delete" <?if($_permitdata['member|member||delete']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 회원 삭제 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-user-unfollow"></i> 탈퇴 회원</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|exit||read" <?if($_permitdata['member|exit||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|exit||modify" <?if($_permitdata['member|exit||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 설정 변경 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-bubbles"></i> 1:1문의</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|qna||read" <?if($_permitdata['member|qna||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="member|qna||modify" <?if($_permitdata['member|qna||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 설정 변경 </label>
			</td>
		</tr>
		<!-- END 회원 -->
		<?php } ?>

		<?php if($_CONFIG['MODULE']['gallery']) { ?>
		<!-- BEGIN 갤러리 -->
		<tr>
			<th><i class="icon-picture"></i> 갤러리</th>
			<td></td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="gallery|list||read" <?if($_permitdata['gallery|list||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="gallery|category||modify" <?if($_permitdata['gallery|category||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 분류 추가/삭제/수정 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="gallery|gallery||modify" <?if($_permitdata['gallery|gallery||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 이미지 추가/삭제/수정 </label>
			</td>
		</tr>
		<!-- END 갤러리 -->
		<?php } ?>


		<?php if($_CONFIG['MODULE']['board']) { ?>
		<!-- BEGIN 게시판 -->
		<?php
		$total = db_count($Table['Board_Config']);
		if(DBMS == 'MYSQL') {
			$query  = 'SELECT * FROM '.$Table['Board_Config'].' ORDER BY TITLE';
		}
		$sql = db_query($query);
		?>
		<tr>
			<th rowspan="<?=($total+2)?>"><i class="icon-list"></i> 게시판</th>
			<td><i class="icon-settings"></i> 게시판 관리</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|config||read" <?if($_permitdata['board|config||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 접근</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|config||add" <?if($_permitdata['board|config||add']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 게시판 추가</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|config||delete" <?if($_permitdata['board|config||delete']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 게시판 삭제 </label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-question"></i> FAQ</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|faq||read" <?if($_permitdata['board|faq||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 접근</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|faq||modify" <?if($_permitdata['board|faq||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 게시판 추가</label>
			</td>
		</tr>
		<?php while($data = db_array($sql)) { ?>
		<tr>
			<td><?=$data['TITLE']?></td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|list|<?=$data['BBSCODE']?>|read"  <?if($_permitdata['board|list|'.$data['BBSCODE'].'|read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회 </label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|list|<?=$data['BBSCODE']?>|add"  <?if($_permitdata['board|list|'.$data['BBSCODE'].'|add']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 게시글 작성</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="board|list|<?=$data['BBSCODE']?>|delete"  <?if($_permitdata['board|list|'.$data['BBSCODE'].'|delete']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 게시글 삭제</label>
			</td>
		</tr>
		<?php } ?>
		<!-- END 게시판 -->
		<?php } ?>


		<?php if($_CONFIG['MODULE']['ecommerce']) { ?>
		<!-- BEGIN e-커머스 -->
		<tr>
			<th rowspan="4"><i class="icon-basket"></i> e-커머스</th>
			<td><i class="icon-settings"></i> 쇼핑몰 설정</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|config||read" <?if($_permitdata['ecommerce|config||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|config||modify" <?if($_permitdata['ecommerce|config||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 수정</label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-basket"></i> 주문</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|order||read" <?if($_permitdata['ecommerce|order||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|order||modify" <?if($_permitdata['ecommerce|order||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 수정</label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-bag"></i> 상품 관리</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|product||read" <?if($_permitdata['ecommerce|product||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|category||modify" <?if($_permitdata['ecommerce|category||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 분류 추가/삭제/수정</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|product||modify" <?if($_permitdata['ecommerce|product||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 상품 추가/삭제/수정</label>
			</td>
		</tr>
		<tr>
			<td><i class="icon-tag"></i> 쿠폰상품 관리</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|coupon||read" <?if($_permitdata['ecommerce|coupon||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="ecommerce|coupon||modify" <?if($_permitdata['ecommerce|category||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 삭제/수정</label>
			</td>
		</tr>
		<!-- END e-커머스 -->
		<?php } ?>


		<!-- BEGIN 관리자 -->
		<tr>
			<th rowspan="1"><i class="icon-ghost"></i> 관리자</th>
			<td></td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="admin|list||read" <?if($_permitdata['admin|list||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 접근</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="admin|admins||read" <?if($_permitdata['admin|admins||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 조회</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="admin|admins||modify" <?if($_permitdata['admin|admins||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 정보수정</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="admin|admins||add" <?if($_permitdata['admin|admins||add']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 추가/삭제</label>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="admin|permit||modify" <?if($_permitdata['admin|permit||modify']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 권한 설정</label>
			</td>
		</tr>
		<!-- END 관리자 -->

		<!-- BEGIN 통계 -->
		<tr>
			<th rowspan="1"><i class="icon-graph"></i> 통계</th>
			<td><i class="icon-calendar"></i> 일일 통계</td>
			<td>
				<label class="margin-right-15"><input type="checkbox" name="permitioncheck[]" value="log|daily||read" <?if($_permitdata['log|daily||read']==true) echo 'checked';?> class="icheck" data-checkbox="icheckbox_minimal-grey"> 접근</label>
			</td>
		</tr>
		<!-- END 통계 -->

		</table>
	
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit();" class="btn red"><i class="xi-check"></i>적용</a>
	</div>
</div>

<script>
function fnSubmit(f) {
	if($(f).formvaild()) {
		loading_start();
		$.ajax({
			type: "post",  
			dataType: "json",
			url: "modules/admins/permit-add.proc.php",   
			data: $(f).serialize(),
			success: function(d) {
				loading_stop();
				if(d.code == 200) {
					pages($('#permition-list'),'admins/permit-list','');
					toast("권한 설정 템플릿을 생성했습니다",1);
					modal_close();
				}
				else {
					modal_alert("오류","작업 실패하였습니다",1);
				}
			},
			error: function() {
				loading_stop();
				modal_alert("오류","권한 설정 모듈 작동 실패했습니다.",1);
			}
		});
	}
}
</script>