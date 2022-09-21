<div class="body">
	<h1>시리얼코드 추가<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="bluemark/put">
		<div class="form-group">
			<input type="text" name="count" class="number" value="100" required>
			<label class="control-label">생성 갯수</label>
		</div>
		<div class="form-group">
			<input type="text" name="barcode">
			<label class="control-label">바코드</label>
		</div>
		<h2>정품코드</h2>
		<div class="form-group">
			<input type="text" name="season_code" maxlength="4">
			<label class="control-label">시즌 코드</label>
		</div>
		<div class="form-group">
			<input type="text" name="strlength" class="number" value="10" maxlength="2" required>
			<label class="control-label">자릿수</label>
		</div>
		<!--
		<h2>관리코드</h2>
		<div class="form-group">
			<input type="text" name="rnum_start" class="number" value="<?=time()?>" required>
			<label class="control-label">시작 번호</label>
		</div>
		<div class="form-group">
			<input type="text" name="rnum_term" class="number" value="3" maxlength="2" required>
			<label class="control-label">번호 증가</label>
		</div>
		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="is_random" value="y">
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">시즌 코드 위치 랜덤</label>
		</div>
		-->
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>
