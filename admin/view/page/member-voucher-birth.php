<style>
.white__btn {cursor: pointer;display: flex;font-size: 13px;align-items: center;justify-content: center;width: 120px;height: 30px;border-radius: 2px;padding: 10px;border: 1px solid #000000;background-color: #ffffff;color: #000000;margin-right: 10px;}
.gray__btn {display: flex;font-size: 13px;align-items: center;justify-content: center;width: 120px;height: 30px;border-radius: 2px;padding: 10px;border: 1px solid #000000;background-color: #bcbcbc;color: #000000;margin-right: 10px;}
.birth__date__param{width:60px!important;}
</style>

<div class="content__card">
	<form id="frm-birth-put" action="voucher/birth/put">
		<input type="hidden" name="voucher_type" value="BR">
		<input type="hidden" name="voucher_idx" value="">
		<div class="card__header">
			<h3>생일 바우처 설정</h3>
			<div class="drive--x"></div>
		</div>

		<div class="card__body">
			<div class="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<select id="country" name="country" onChange="changeCountry(this)">
						<option value="KR" selected>한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">생일바우처 사용기간</div>
				<div class="content__row">
					<span>생일날 기준</span>
					<input type="number" name="date_ago_param" class="birth__date__param">
					<span>일 전 부터</span>
					<input type="number" name="date_later_param" class="birth__date__param">
					<span>일 후 까지</span>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onClick="updateBirthVoucher()"><span>수정</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="selected__info">
	<div class="content__card">
		<div class="card__header">
			<h3>월별 생일바우처 회원 목록</h3>
		</div>
		<div class="drive--x"></div>
		<form id="frm-birth-detail-filter" action="voucher/birth/issue/get">
			<input type="hidden" name="voucher_idx" value="">
			
			<input type="hidden" name="country" value="">
			
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			
			<div class="content__wrap ">
				<div class="content__title">검색 월</div>
				
				<div class="content__row">
					<select name="search_month" onChange="">
						<option value="" selected>전체</option>
						<option value="01">1월</option>
						<option value="02">2월</option>
						<option value="03">3월</option>
						<option value="04">4월</option>
						<option value="05">5월</option>
						<option value="06">6월</option>
						<option value="07">7월</option>
						<option value="08">8월</option>
						<option value="09">9월</option>
						<option value="10">10월</option>
						<option value="11">11월</option>
						<option value="12">12월</option>
					</select>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원 아이디</div>
					<div class="content__row">
						<input type="text" name="member_id">
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">회원명</div>
					<div class="content__row">
						<input type="text" name="member_name">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">멤버 등급</div>
				<div class="content__row">
					<label class="rd__square">
						<input type="radio" name="member_level" value="ALL" checked>
						<div>
							<div></div>
						</div>
						<span>전체</span>
					</label>
<?php
						$get_member_level_sql = "
							SELECT
								IDX,
								TITLE
							FROM
								MEMBER_LEVEL
							WHERE
								DEL_FLG = FALSE
						";
						$db->query($get_member_level_sql);

						foreach($db->fetch() as $level_info){
?>
					<label class="rd__square">
						<input type="radio" name="issue_member_level" value="<?=$level_info['IDX']?>">
						<div>
							<div></div>
						</div>
						<span><?=$level_info['TITLE']?></span>
					</label>			    
<?php
						}
?>
				</div>
			</div>

			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">사용여부</div>
					<div class="content__row">
						<label class="rd__square">
							<input type="radio" name="used_flg" value="ALL" checked>
							<div>
								<div></div>
							</div>
							<span>전체</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="used_flg" value="TRUE">
							<div>
								<div></div>
							</div>
							<span>사용</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="used_flg" value="FALSE">
							<div>
								<div></div>
							</div>
							<span>미사용</span>
						</label>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">등록여부</div>
					<div class="content__row">
						<label class="rd__square">
							<input type="radio" name="regist_flg" value="ALL" checked>
							<div>
								<div></div>
							</div>
							<span>전체</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="regist_flg" value="TRUE">
							<div>
								<div></div>
							</div>
							<span>등록</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="regist_flg" value="FALSE">
							<div>
								<div></div>
							</div>
							<span>미등록</span>
						</label>
					</div>
				</div>
			</div>

			<div class="card__footer">
				<div class="footer__btn__wrap" style="grid: none;">
					<div class="btn__wrap--lg">
						<div class="blue__color__btn" onClick="getBirthMemberInfo()"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_fileter('frm-list', 'getBirthMemberInfo')">
							<span>초기화</span>
						</div>
					</div>
				</div>
			</div>
		</form>
		
		<form id="frm-birth-detail-list">
			<div class="card__body">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						금월 생일자 수 <font class="cnt_total info__count">0</font>명 / 검색결과 <font
							class="cnt_result info__count">0</font>개
					</div>
				</div>
				<div class="card__content">
					<div class="table table__wrap">
						<div class="table__filter">
							<div class="filrer__wrap">
								<div style="width: 140px;" class="filter__btn" onclick="excelDownload('all');">엑셀 다운로드</div>
							</div>                                
						</div>	
						<table id="excel_table">
							<colgroup>
								<col width="80px;">
								<col width="150px;">
								<col width="100px;">
								<col width="150px;">
								<col width="150px;">
								<col width="150px;">
								<col width="200px;">
								<col width="150px;">
								<col width="300px;">
								<col width="300px;">
							</colgroup>
							<thead>
								<TH>순번</TH>
								<th>발급 바우처 코드</th>
								<th>사용여부</th>
								<th>회원이름</th>
								<th>회원ID</th>
								<th>회원등급</th>
								<th>회원생일</th>
								<th>휴대전화</th>
								<th>사용가능 일자</th>
								<th>사용일자</th>
							</thead>
							<tbody id="result_birth_voucher_issue_table">
							</tbody>
						</table>
					</div>
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" value="0" list_type="birth_issue"
							onChange="setPaging(this);">
						<input type="hidden" class="result_cnt" value="0" list_type="birth_issue"
							onChange="setPaging(this);">
						<div class="paging"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		getBirthVoucherInfo('KR');
	});

	function init_fileter(frm_id, func_name) {
		var formObj = $('#' + frm_id);
		formObj.find('input:radio[value="all"]').prop('checked', true);
		formObj.find('input:radio[value="ALL"]').prop('checked', true);

		formObj.prop("selectedIndex", 0);

		formObj.find('input[type=text]').val('');
		formObj.find('input[type=date]').val('');

		formObj.find('.date__picker').css('background-color', '#ffffff');
		formObj.find('.date__picker').css('color', '#000000');
		formObj.find('input[name="search_date"]').val('');

		window[func_name]();
	}

	function getBirthVoucherInfo(country) {
		$.ajax({
			type: "post",
			data: {'country': country},
			dataType: "json",
			url: config.api + "voucher/birth/get",
			error: function(d) {
			},
			success: function(d) {
				if(d.code == 200){
					if(d.data != null){
						var data = d.data;
						$('input[name="date_ago_param"]').val(data.date_ago_param);
						$('input[name="date_later_param"]').val(data.date_later_param);
						$('#frm-birth-put input[name="voucher_idx"]').val(data.voucher_idx);
						$('#frm-birth-detail-filter input[name="voucher_idx"]').val(data.voucher_idx);
						$('#frm-birth-detail-filter input[name="country"]').val(country);
						getBirthMemberInfo();
					}
				}
			}
		});
	}

	function changeCountry(obj){
		getBirthVoucherInfo($(obj).val());
	}

	function updateBirthVoucher(){
		confirm('생일바우처 정보를 수정하시겠습니까?', function(){
			var formData = new FormData();
			formData = $("#frm-birth-put").serializeObject();
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "voucher/birth/put",
				error: function(d) {
				},
				success: function(d) {
					if(d.code == 200){
						alert('생일바우처를 수정하였습니다.')
						getBirthVoucherInfo(formData.country);
					}
				}
			});
		});
	}
	function getBirthMemberInfo() {
		let result_table = $("#result_birth_voucher_issue_table");
		result_table.html('');
		
		var strDiv = '';
		strDiv += '<TD class="default_td" colspan="10">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';

		result_table.append(strDiv);

		var filter_detail_obj = $("#frm-birth-detail-filter");
		var list_detail_obj = $('#frm-birth-detail-list');

		var rows = filter_detail_obj.find('.rows').val();
		var page = filter_detail_obj.find('.page').val();
		
		get_contents(filter_detail_obj, {
			pageObj: list_detail_obj.find(".paging"),
			html: function (d) {
				if (d.length > 0) {
					result_table.html('');
				}
				
				d.forEach(function (row) {
					let detail_link = "";
					if (row.country != null && row.member_idx != null) {
						detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
					}
					
					var used_str = '';
					var used_date_str = '';
					if (row.used_flg != null) {
						if (row.used_flg == true) {
							used_str = '사용';
							used_date_str = row.update_date;
						}
						else if (row.used_flg == false) {
							used_str = '미사용';
							used_date_str = '-';
						}
					}
					var strDiv = "";
					strDiv = `
						<tr>
							<td>${row.num}</td>
							<td>${row.voucher_issue_code}</td>
							<td>${row.used_flg}</td>
							<td ${detail_link}>${row.member_id}</td>
							<td ${detail_link}>${row.member_name}</td>
							<td>${row.member_level}</td>
							<td>${row.member_birth}</td>
							<td>${row.tel_mobile}</td>
							<td>사용가능 시작일 : ${row.usable_start_date}<br>사용가능 종료일 : ${row.usable_end_date}</td>
							<td>${row.update_date}</td>
						</tr>
					`;

					result_table.append(strDiv);
				});
			},
		}, rows, page);
	}

	function excelDownload(str) {
	if ($('#result_birth_voucher_issue_table').find('.default_td').length > 0) {
		alert('회원 데이터가 없습니다.');
	} else {
		
		var sheet_name = "";
		var file_name = "";
		var today = new Date();
		var file_date = today.getFullYear() + (('0' + (today.getMonth() + 1)).slice(-2)) + (('0' + today.getDate()).slice(-2));
		
		sheet_name = "회원 목록";
		file_name = "회원리스트_" + file_date;
		insertLog("멤버관리:바우처 ", "생일바우처_멤버리스트_엑셀다운로드 : "+file_name+"xlsx", 1);
		var wb = XLSX.utils.table_to_book(document.getElementById('excel_table'), {sheet:sheet_name,raw:true});
		XLSX.writeFile(wb, (file_name + '.xlsx'));
	}
}
</script>