<div class="filter-tap content__tap__02">
	<div class="wrap__bg--wh">
		<div class="file__wrap">
			<div class="file__drag__wrap" style="cursor:pointer">
				<div class="exel__zone">
					<form action="/target" id="exel-dropzone">
						<i style="font-size: 70px;color: #BDBFC5;" class="xi-cloud-upload-o"></i>
					</form>
					<p style="margin: 20px;color: #a6a6a7;">첨부할 파일 드래그 또는 <u style="color:#3971ff;">선택</u></p>
					<button type="button" class="exel__upload__btn" style="cursor:pointer">
                        엑셀 업로드
                    </button>
				</div>
			</div>
			<div class="file__content__wrap" style="width:800px">
				<div style="margin: 20px 0;color: #8B929F;font-size: 12px;"><span class="content__exel__btn">상품 옵션등록용 엑셀 다운로드</span></div>	
				<p style="margin:10px 0;">상품옵션 신규 등록시 전용 엑셀양식을 다운로드하여 정보 입력후 업로드 합니다.</p>
				<div>
					<div class="file__content__line">대기중</div>
					<div class="file__content__uploading">
						<TABLE>
							<THEAD>
								<TR>
									<TH style="width:5%;"></TH>
									<TH style="width:30%;"></TH>
									<TH style="width:40%;"></TH>
								</TR>
							</THEAD>
							<TBODY id="wait_list_table_02">
							</TBODY>
						</TABLE>
					</div>
					</div>
                    <button type="button"  class="exel__execute__btn" style="width:100px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer">상품옵션 등록</button>
					<button type="button"  onclick="resetExcelList()" style="width:100px;height:30px;border:1px solid;background-color:#ffffff;cursor:pointer">초기화</button>
					<div class="file__content__line">진행완료</div>
					<div class="file__content__uploading">
						<TABLE>
							<THEAD>
								<TR>
									<TH style="width:5%;"></TH>
									<TH style="width:30%;"></TH>
									<TH style="width:40%;"></TH>
								</TR>
							</THEAD>
							<TBODY id="finish_list_table_02">
							</TBODY>
						</TABLE>	
					</div>
					<div class="file__content__line">진행실패</div>
					<div class="file__content__uploading">
						<TABLE>
							<THEAD>
								<TR>
									<TH style="width:5%;"></TH>
									<TH style="width:30%;"></TH>
									<TH style="width:40%;"></TH>
								</TR>
							</THEAD>
							<TBODY id="fail_list_table_02">
							</TBODY>
						</TABLE>	
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="hidden">
        <input class="upload_btn" id="upload_btn_02" name="upload_btn_02" type="file">
    </div>
</div>

<script>
</script>
