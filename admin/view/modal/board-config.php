<?php
/*
 +=============================================================================
 | 
 | 게시판 생성/정보 수정
 | -----------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.20
 | 최종 수정일	: 2018.02.19
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
if($bbscode) {
	$bbscode = strtolower(trim($bbscode));
	$data = $db->get($_TABLE['BOARD_CONFIG'],'BBSCODE = ?',array($bbscode));

	$TITLE			= $data['TITLE'];
	$ONLY_ADMIN		= $data['ONLY_ADMIN'];
	$ONLY_ADMIN_ID	= $data['ONLY_ADMIN_ID'];
	$ONLY_USER		= $data['ONLY_USER'];
	$ONLY_USER_ID	= $data['ONLY_USER_ID'];
	$STATUS			= $data['STATUS'];
	$USE_CATEGORY	= $data['USE_CATEGORY'];
	$USE_REPLY		= $data['USE_REPLY'];
	$USE_COMMENT	= $data['USE_COMMENT'];
	$USE_DATA		= $data['USE_DATA'];
	$USE_LINK		= $data['USE_LINK'];
	$USE_HTML		= $data['USE_HTML'];
	$USE_EDITOR		= $data['USE_EDITOR'];
	$USE_AJAX		= $data['USE_AJAX'];
	$USE_COVER		= $data['USE_COVER'];
	$USE_SUBSCRIBE	= $data['USE_SUBSCRIBE'];
	$COVER_W		= $data['COVER_W'];
	$COVER_H		= $data['COVER_H'];
	$PASSWORD		= $data['PASSWORD'];
	$EDITOR			= $data['EDITOR'];
	$DIV_NUM		= $data['DIV_NUM'];
	$PAGE_NUM		= $data['PAGE_NUM'];
	$DAY_NEW		= $data['DAY_NEW'];
	$LV_READ		= $data['LV_READ'];
	$LV_WRITE		= $data['LV_WRITE'];
	$LV_LIST		= $data['LV_LIST'];
	$LV_COMMENT		= $data['LV_COMMENT'];
	$SKIN			= $data['SKIN'];
	$CATEGORY		= $data['CATEGORY'];
	$REG_DATE		= $data['REG_DATE'];
	$REMARK			= $data['REMARK'];
	$PDS_MAXBYTE	= $data['PDS_MAXBYTE'];
	$PDS_NUM		= $data['PDS_NUM'];
	$PERMIT_WRITE	= $data['PERMIT_WRITE'];
	$PERMIT_LIST	= $data['PERMIT_LIST'];
	$PERMIT_VIEW	= $data['PERMIT_VIEW'];
	$PERMIT_REPLY	= $data['PERMIT_REPLY'];
	$PERMIT_COMMENT	= $data['PERMIT_COMMENT'];
	$SPECIAL_MEMBER	= $data['SPECIAL_MEMBER'];

	$SFIELD1		= $data['SFIELD1'];
	$SFIELD2		= $data['SFIELD2'];
	$SFIELD3		= $data['SFIELD3'];
	$SFIELD4		= $data['SFIELD4'];
	$SFIELD5		= $data['SFIELD5'];
	$SFIELD6		= $data['SFIELD6'];
	$SFIELD7		= $data['SFIELD7'];
	$SFIELD8		= $data['SFIELD8'];
	$SFIELD9		= $data['SFIELD9'];
	$SFIELD10		= $data['SFIELD10'];
	$SFIELDTXT		= $data['SFIELDTXT'];

	$MODE			= 'modify';
} else {
	$TITLE			= '';		// 게시판 타이틀
	$ONLY_ADMIN		= 'N';		// 관리자만 접근 가능
	$ONLY_ADMIN_ID	= '';		// 접근 가능한 관리자 아이디 지정 (구분 : , )
	$ONLY_USER		= 'N';		// 회원만 접근 가능
	$ONLY_USER_ID	= '';		// 접근 가능한 회원 아이디 지정 (구분 : , )
	$STATUS			= 'Y';		// 게시판 상태 Y=사용, N=미사용, B=읽기 전용, S=비밀
	$USE_CATEGORY	= 'N';		// 분류 사용
	$USE_REPLY		= 'N';		// 댓글 달기 가능
	$USE_COMMENT	= 'Y';		// 코멘트 달기 가능
	$USE_DATA		= 'Y';		// 자료실 사용 가능
	$USE_LINK		= 'N';		// 링크 따로 작성 가능
	$USE_HTML		= 'Y';		// HTML 허용 여부
	$USE_EDITOR		= 'Y';		// 편집기 사용 
	$USE_AJAX		= 'Y';		// ajax 사용 여부
	$USE_COVER		= 'N';
	$USE_SUBSCRIBE	= 'N';
	$COVER_W		= '100';
	$COVER_H		= '80';
	$PASSWORD		= '';		// 비밀 게시판으로 사용시 비밀번호 
	$EDITOR			= 'SMART';	// 편집기 종류 (SMART=스마트에디터, CH4=CH4 에디터, CH5=CH5 에디터, CK=CK에디터)
	$DIV_NUM		= '20';		// 한 화면당 글 수
	$PAGE_NUM		= '9';		// 페이징 목록 수
	$DAY_NEW		= '7';		// 새글 여부 표시 기간 (단위 : 일)
	$LV_READ		= '9';		// 읽기 가능 권한 레벨
	$LV_WRITE		= '9';		// 쓰기 가능 권한 레벨
	$LV_LIST		= '9';		// 목록보기 가능 권한 레벨
	$LV_COMMENT		= '9';		// 코멘트달기 가능 권한 레벨
	$SKIN			= 'default';	// 스킨 이름
	$CATEGORY		= '일반||공지||';	// 분류 (구분 : ||)
	$PDS_MAXBYTE	= '3';
	$PDS_NUM		= '1';
	$PERMIT_WRITE	= 'ADMIN';
	$PERMIT_LIST	= 'ADMIN';
	$PERMIT_VIEW	= 'ADMIN';
	$PERMIT_REPLY	= 'ADMIN';
	$PERMIT_COMMENT	= 'ADMIN';

	$MODE			= 'add';
}
?>
<div class="body">
	<h1>게시판 추가<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="board/config/put">
			<h2>기본 정보</h2>
			<div class="form-group">
				<input type="text" name="bbscode" value="<?=$bbscode?>" minlength="3" maxlength="15" required>
				<label class="control-label">게시판코드</label>
			</div>

			<div class="form-group">
				<input type="text" name="title" minlength="2" maxlength="10" required>
				<label class="control-label">게시판명</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="use_category" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">분류 사용</label>
			</div>

			<!-- BEGIN 커버 이미지 -->
			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="use_cover" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">커버이미지 사용</label>
			</div>

			<div class="form-group">
				가로 <input type="number" name="cover_w" value="160" style="width:80px" required> px
				세로 <input type="number" name="cover_h" value="120" style="width:80px" required> px
				<label class="control-label">커버이미지 크기</label>
			</div>
			<!-- END 커버 이미지 -->

			<div class="form-group">
				<div class="spinner">
					<button type="button" class="btn spinner-up blue">
						<i class="xi-plus"></i>
					</button>
					<input type="number" class="spinner-input" step="1" max="999999" min="0" name="day_new" value="7">
					<button type="button" class="btn spinner-down red">
						<i class="xi-minus"></i>
					</button>
					일
				</div>
				<label class="control-label">새글 기준 일수</label>
			</div>

			<div class="form-group">
				<div class="spinner">
					<button type="button" class="btn spinner-up blue">
						<i class="xi-plus"></i>
					</button>
					<input type="number" class="spinner-input" step="1" max="999999" min="0" name="paging_row" value="20">
					<button type="button" class="btn spinner-down red">
						<i class="xi-minus"></i>
					</button>
					일
				</div>
				<label class="control-label">페이지당 글 수</label>
			</div>

			<div class="form-group">
				<div class="spinner">
					<button type="button" class="btn spinner-up blue">
						<i class="xi-plus"></i>
					</button>
					<input type="number" class="spinner-input" step="1" max="999999" min="0" name="paging_num" value="9">
					<button type="button" class="btn spinner-down red">
						<i class="xi-minus"></i>
					</button>
					일
				</div>
				<label class="control-label">페이지목록 갯수</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="status" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">게시판 사용</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="use_reply" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">댓글 허용</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="use_comment" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">코멘트 사용</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="use_link" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">링크 필드 사용</label>
			</div>

			<h2>자료실 설정</h2>
			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="use_upload" value="y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">자료실 사용</label>
			</div>

			<div class="form-group">
				<div class="spinner">
					<button type="button" class="btn spinner-up blue">
						<i class="xi-plus"></i>
					</button>
					<input type="number" class="spinner-input" step="1" max="999999" min="0" name="pds_num" value="10">
					<button type="button" class="btn spinner-down red">
						<i class="xi-minus"></i>
					</button>
				</div>
				<label class="control-label">파일 업로드 갯수</label>
			</div>

			<div class="form-group">
				<input type="text" name="pds_maxbyte" value="10" maxlength="4" style="width:80px" required> MiByte
				<label class="control-label">최대 업로드 용량</label>
			</div>

			
			<!-- BEGIN 권한 설정 -->
			<h2>권한 설정</h2>
			<div class="form-group">
				<label><input type="radio" name="permit_write" value="관리자"><span>관리자</span></label>
				<label><input type="radio" name="permit_write" value="특별회원"><span>특별회원</span></label>
				<label><input type="radio" name="permit_write" value="회원"><span>회원</span></label>
				<label><input type="radio" name="permit_write" value="비회원"><span>비회원</span></label>
				<label class="control-label">글작성</label>
			</div>

			<div class="form-group">
				<label><input type="radio" name="permit_list" value="관리자"><span>관리자</span></label>
				<label><input type="radio" name="permit_list" value="특별회원"><span>특별회원</span></label>
				<label><input type="radio" name="permit_list" value="회원"><span>회원</span></label>
				<label><input type="radio" name="permit_list" value="비회원"><span>비회원</span></label>
				<label class="control-label">목록조회</label>
			</div>

			<div class="form-group">
				<label><input type="radio" name="permit_view" value="관리자"><span>관리자</span></label>
				<label><input type="radio" name="permit_view" value="특별회원"><span>특별회원</span></label>
				<label><input type="radio" name="permit_view" value="회원"><span>회원</span></label>
				<label><input type="radio" name="permit_view" value="비회원"><span>비회원</span></label>
				<label class="control-label">글조회</label>
			</div>

			<div class="form-group">
				<label><input type="radio" name="permit_reply" value="관리자"><span>관리자</span></label>
				<label><input type="radio" name="permit_reply" value="특별회원"><span>특별회원</span></label>
				<label><input type="radio" name="permit_reply" value="회원"><span>회원</span></label>
				<label><input type="radio" name="permit_reply" value="비회원"><span>비회원</span></label>
				<label class="control-label">댓글 작성</label>
			</div>

			<div class="form-group">
				<label><input type="radio" name="permit_comment" value="관리자"><span>관리자</span></label>
				<label><input type="radio" name="permit_comment" value="특별회원"><span>특별회원</span></label>
				<label><input type="radio" name="permit_comment" value="회원"><span>회원</span></label>
				<label><input type="radio" name="permit_comment" value="비회원"><span>비회원</span></label>
				<label class="control-label">코멘트 작성</label>
			</div>

			<div class="form-group">
				<input type="text" name="special_member">
				<label class="control-label">특정 회원 지정</label>
			</div>

			<div class="form-group">
				<textarea name="remark"></textarea>
				<label class="control-label">비고</label>
			</div>
			<!-- END 권한 설정 -->
		</div>
	</form>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>
<script>
$(document).ready(function() {
	let f = $("form").last();
	if($(f).find("input[name='bbscode']").val() != "") {
		$.ajax({
			url: config.api + "board/config/get",
			data: $(f).serialize(),
			success: function(d) {
				if(d.code == 200) {
					$(f).find("input[name='title']").val(d.data[0].title);
					$(f).find("input[name='cover_w']").val(d.data[0].cover[0]);
					$(f).find("input[name='cover_h']").val(d.data[0].cover[1]);
					$(f).find("input[name='day_new']").val(d.data[0].day_new);
					$(f).find("input[name='paging_num']").val(d.data[0].paging.num);
					$(f).find("input[name='paging_row']").val(d.data[0].paging.row);
					$(f).find("input[name='pds_num']").val(d.data[0].pds.num);
					$(f).find("input[name='pds_maxbyte']").val(d.data[0].pds.maxbyte);
					$(f).find(`input[name='permit_write'][value='${d.data[0].permition.write}']`).prop("checked",true);
					$(f).find(`input[name='permit_list'][value='${d.data[0].permition.list}']`).prop("checked",true);
					$(f).find(`input[name='permit_view'][value='${d.data[0].permition.view}']`).prop("checked",true);
					$(f).find(`input[name='permit_reply'][value='${d.data[0].permition.reply}']`).prop("checked",true);
					$(f).find(`input[name='permit_comment'][value='${d.data[0].permition.comment}']`).prop("checked",true);
					$(f).find(`input[name='use_category']`).prop("checked",d.data[0].use_category);
					$(f).find(`input[name='use_reply']`).prop("checked",d.data[0].use_reply);
					$(f).find(`input[name='use_upload']`).prop("checked",d.data[0].use_upload);
					$(f).find(`input[name='use_link']`).prop("checked",d.data[0].use_link);
					$(f).find(`input[name='use_cover']`).prop("checked",d.data[0].use_cover);
					$(f).find(`input[name='status']`).prop("checked",d.data[0].status);

					$(f).find("textarea[name='remark']").val(d.data[0].remark);
				}
			}
		});
	}
});
</script>