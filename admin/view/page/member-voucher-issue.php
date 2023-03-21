<style>
.receive_true_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;}
.receive_false_btn {font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;}
</style>
<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3>바우처 발급</h3>
			</div>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div class="issue__voucher__category">
			<div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<select class="fSelect eSearch" name="country" style="width:250px;">
						<option value="KR">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">바우처 타입</div>
				<div class="content__row">
					<select class="fSelect eSearch" name="on_off_type" style="width:250px;">
						<option value="ON">온라인</option>
						<option value="OFF">오프라인</option>
					</select>
				</div>
			</div>
		</div>
		<div class="voucher__list__select">
			<div class="content__wrap">
				<div class="content__title">바우처 선택</div>
				<div class="content__row">
					<select class="fSelect eSearch" name="voucher_idx" style="width:250px;">
						<option value="">바우처를 선택해주세요</option>
						<?php
							$sql = "SELECT
										VOUCHER_NAME,
										IDX
									FROM
										dev.VOUCHER_MST
									WHERE
										COUNTRY = 'KR' 
									AND
										ON_OFF_TYPE = 'ON'
									AND
										DEL_FLG = FALSE
									AND
										(ISSUE_START_DATE <= NOW() AND
										 ISSUE_END_DATE >= NOW())
									AND
										VOUCHER_TYPE != 'BR' ";
							
							$db->query($sql);
							foreach($db->fetch() as $data) {
						?>
						<option value="<?=$data['IDX']?>"><?=$data['VOUCHER_NAME']?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="drive--x"></div>
		<div class="online__voucher">
			<div class="flex" style="gap:50px;margin:20px 0;">
				<div class="category__tab" issue_type="member_level" style="color:#140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;" onClick="issueTypeTabClick(this);">일괄 발급</div>
				<div class="category__tab" issue_type="member_idx" style="height:30px;color:#707070;text-align:center;cursor:pointer;" onClick="issueTypeTabClick(this);">개별 발급</div>
			</div>
			<div class="issue__form member_level">
				<div class="content__wrap">
					<div class="content__title">
						<p>중복발급여부<p>
					</div>
					<div class="content__row">
						</label><label class="rd__square">
							<input type="radio" name="duplicate_flg" value="true" checked>
							<div><div></div></div>
							<span>중복방지</span>
						</label>
						<label class="rd__square">
							<input type="radio" name="duplicate_flg" value="false" >
							<div><div></div></div>
							<span>중복발행</span>
						</label>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">
						<p>멤버 지정</p>
					</div>
					<div class="content__row form-group" style="padding-left:0px!important;">
						<?php
							$sql = "SELECT
										TITLE,
										IDX
									FROM
										dev.MEMBER_LEVEL
									WHERE
										DEL_FLG = FALSE";
							
							$db->query($sql);
							foreach($db->fetch() as $data) {
						?>
						<label>
							<input type="checkbox" class="member_level" name="issue_member_level[]" value="<?=$data['IDX']?>">
							<span><?=$data['TITLE']?></span>
						</label>
						<?php
							}
						?>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">
						<p>생년월일<p>
					</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="birth_date" class="margin-bottom-6" style="width:150px;">
							</div>
						</div>
						<div class="btn" onclick="$('#birth_date').val('')">초기화</div>
					</div>
				</div>
				<div class="card__footer">
					<div class="footer__btn__wrap" style="grid: none;">
						<div class="btn__wrap--lg">
							<div class="blue__color__btn" voucher_type="BATCH" onClick="registIssueInfo(this)"><span>바우처 발급</span></div>
							<div class="defult__color__btn" onClick="returnVoucherPage()"><span>뒤로가기</span></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="issue__form member_idx">
				<div class="card__header">
					<h3>회원 검색창</h3>
				</div>
				<form id="frm-member-filter" action="member/info/list/get">
					<input type="hidden" class="rows" name="rows" value="10">
					<input type="hidden" class="page" name="page" value="1">

					<div class="card__body">
						<div class="content__wrap">
							<div class="content__title">국가</div>
							<div class="content__row">
								<select name="country" class="fSelect" style="width:163px;">
									<option value="KR" selected="">한국몰</option>
									<option value="EN">영문몰</option>
									<option value="CN">중문몰</option>
								</select>
							</div>
						</div>
						
						<div class="content__wrap">
							<div class="content__title">회원정보</div>
							<div class="content__row">
								<select name="search_type" class="fSelect" style="width:163px;">
									<option value="member_id" selected="">아이디</option>
									<option value="member_name">이름</option>
									<option value="tel_mobile">휴대폰번호</option>
									<option value="member_addr">주소</option>
								</select>

								<input class="content__input" type="text" name="search_keyword" value="" style="width:70%;">
							</div>
						</div>
						
						<div class="content__wrap">
							<div class="content__title">발행 멤버</div>
							<div class="content__row">
								<label class="rd__square">
									<input type="radio" name="member_level" value="ALL" checked>
									<div><div></div></div>
									<span>전체</span>
								</label>
								<?php
									$sql = "SELECT
												TITLE,
												IDX
											FROM
												dev.MEMBER_LEVEL
											WHERE
												DEL_FLG = FALSE";
									
									$db->query($sql);
									foreach($db->fetch() as $data) {
								?>
									<label class="rd__square">
										<input type="radio" name="member_level" value="<?=$data['IDX']?>" >
										<div><div></div></div>
										<span><?=$data['TITLE']?></span>
									</label>
								<?php
									}
								?>
							</div>
						</div>
						<div class="content__wrap">
							<div class="content__title">성별</div>
							<div class="content__row">
								<div class="rd__block">
									<input type="radio" id="member_gender_SLP_ALL" class="radio__input" value="ALL" name="member_gender" checked>
									<label for="member_gender_SLP_ALL">전체</label>

									<input type="radio" id="member_gender_SLP_M" class="radio__input" value="M" name="member_gender"/>
									<label for="member_gender_SLP_M">남</label>
									
									<input type="radio" id="member_gender_SLP_F" class="radio__input" value="F" name="member_gender"/>
									<label for="member_gender_SLP_F">여</label>
								</div>
							</div>
						</div>
						<div class="content__wrap grid__half">
							<div class="half__box__wrap">
								<div class="content__title">가입일/생일</div>
								<div class="content__row">
									<select class="fSelect" name="day_type" style="width:163px;">
										<option value="JOIN_DATE" checked>가입일</option>
										<option value="MEMBER_BIRTH">생일</option>
									</select>
									
									<div class="content__date__picker" style="margin-left:10px;">
										<input type="date" name="day_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;">
											~
										<input type="date" name="day_to" placeholder="To" readonly style="width:150px;">
									</div>
								</div>
							</div>
							
							<div class="half__box__wrap">
								<div class="content__title">나이</div>
								<div class="content__row">
									<input type="text" name="min_age" value="" style="width:80px;margin-right:5px;">세
										~
									<input type="text" name="max_age" value="" style="width:80px;margin-right:5px;">세
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="card__footer">
					<div class="footer__btn__wrap" style="grid: none;">
						<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getMemberTabInfo()"><span>검색</span></div>
							<div class="defult__color__btn" onClick="init_fileter('frm-member-filter','getMemberTabInfo()');"><span>초기화</span></div>
						</div>
					</div>
				</div> 
				<div class="card__header">
					<h3>회원 검색결과</h3>
					<div class="drive--x"></div>
				</div>
				<form id="frm-member-list">
					<div class="card__body">
						<div class="body__info--count">
							<div class="drive--left"></div>
							총 회원 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
						</div>
						<div class="table__wrap table">
							<TABLE style="min-width:100%;width:auto;">
								<colgroup>
									<col width="150px;">
									<col width="80px">
									<col width="150px">
									<col width="150px">
									<col width="250px">
									<col width="50px">
									<col width="100px">
									<col width="50px">
									<col width="120px">
									<col width="50px">
									<col width="100px">
									<col width="100px">
									<col width="450px">
									<col width="auto;">
								</colgroup>
								<THEAD>
									<TR>
										<TH>회원선택</TH>
										<TH>쇼핑몰</TH>
										<TH>가입일</TH>
										<TH>최근로그인</TH>
										<TH>회원정보</TH>
										<TH>회원상태</TH>
										<TH>휴대전화</TH>
										<TH>회원성별</TH>
										<TH>회원생일</TH>
										<TH>회원나이</TH>
										<TH>거주지역</TH>
										<TH>지역번호</TH>
										<TH>주소</TH>
										<TH>메일/SMS/메모</TH>
									</TR>
								</THEAD>
								<TBODY id="result_member_list_table">
									
								</TBODY>
							</TABLE>
						</div>
						<div class="padding__wrap">
							<input type="hidden" class="total_cnt" value="0" list_type="member" onChange="setPaging(this);">
							<input type="hidden" class="result_cnt" value="0" list_type="member" onChange="setPaging(this);">
							<div class="paging"></div>
						</div>
					</div>
				</form>
				
				<div class="card__header">
					<h3>선택회원 리스트</h3>
					<div class="drive--x"></div>
				</div>
				<div class="card__body">
					<div class="content__wrap">
						<div class="content__title">
							<p>중복발급여부<p>
						</div>
						<div class="content__row">
							</label><label class="rd__square">
								<input type="radio" name="member_duplicate_flg" value="true" checked>
								<div><div></div></div>
								<span>중복방지</span>
							</label>
							<label class="rd__square">
								<input type="radio" name="member_duplicate_flg" value="false" >
								<div><div></div></div>
								<span>중복발행</span>
							</label>
						</div>
					</div>
					<div class="table table__wrap">
						<div class="overflow-x-auto">
							<TABLE style="width:50%">
								<colgroup>
									<col width="10%">
									<col width="30%">
									<col width="30%">
									<col width="30%">
								</colgroup>
								<THEAD>
									<TR>
										<Th>삭제</TH>
										<TH>아이디</TH>
										<TH>이름</TH>
										<TH>멤버</TH>
									</TR>
								</THEAD>
								<TBODY id="selected_member_table">
								</TBODY>
							</TABLE>
						</div>
					</div>
					<input type="hidden" id="member_idx_list">
					<div class="card__footer">
						<div class="footer__btn__wrap" style="grid: none;">
							<div class="btn__wrap--lg">
							<button type="button" class="defult__color__btn" voucher_type="MB" onclick="registIssueInfo(this)">발급</button>
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>
		<div class="offline__voucher">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">오프라인 바우처<br> 발행 갯수</div>
					<div class="content__row" style="width:40%;">
						<input type="number" name="offline_issue_cnt">
					</div>
				</div>
				<div class="half__box__wrap">
					<button type="button" class="white__btn" voucher_type="OFF" onclick="registIssueInfo(this)">발급</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {	
	$('.online__voucher').hide();
	$('.offline__voucher').hide();

	$('.issue__form.member_birth').hide();
	$('.issue__form.member_idx').hide();

	$('.issue__voucher__category').find('select').on('change', function(){
		$('.online__voucher').hide();
		$('.offline__voucher').hide();
		getVoucherList();
	});
	
	$('.voucher__list__select').find('select').on('change', function(){
		var on_off_type = $('.issue__voucher__category').find('select[name="on_off_type"]').val();
		var counrty = $('.issue__voucher__category').find('select[name="country"]').val();

		if(on_off_type == 'ON'){
			$('.online__voucher').show();
			$('.offline__voucher').hide();
		}
		else if(on_off_type == 'OFF'){
			$('.online__voucher').hide();
			$('.offline__voucher').show();
		}
		$('#frm-member-filter').find('input[name="country"]').val(counrty);
	});
	
	getMemberTabInfo();
});

function getVoucherList(){
	var country = $('.issue__voucher__category').find('select[name="country"]').val();
	var on_off_type = $('.issue__voucher__category').find('select[name="on_off_type"]').val();

	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'on_off_type' : on_off_type,
			'voucher_type' : 'ALL',
			'voucher_status' : 'IVP',
			'rows' : 1000,
			'page' : 1
		},
		dataType: "json",
		url: config.api + "voucher/publish/list/get",
		error: function() {
			alert('발행 바우처 불러오기에 실패했습니다.');
		},
		success: function(d) {
			if(d.code == 200) {
				$('.voucher__list__select').find('select').html('');
				var strOption = '';
				if(d.data != undefined && d.data.length > 0){
					
					strOption = `<option value = ''>바우처를 선택해주세요</option>`;
					d.data.forEach(function(rows){
						strOption += `<option value = '${rows.no}'>${rows.voucher_name}</option>`;
					})
				}
				else{
					strOption = `<option value = ''>바우처가 존재하지 않습니다.</option>`;
				}
				$('.voucher__list__select').find('select').append(strOption);
			}
		}
	});
}

function getMemberTabInfo(){
	let result_table = $("#result_member_list_table");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="4">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var filter_obj = $("#frm-member-filter");
	var list_obj = $('#frm-member-list');

	var rows = filter_obj.find('.rows').val();
	var page = filter_obj.find('.page').val();

	get_contents(filter_obj,{
		pageObj : list_obj.find(".paging"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					result_table.html('');
				}
				
				let strDiv = "";
				d.forEach(function(row) {
					let detail_link = "";
					if (row.country != null && row.member_idx != null) {
						detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
					}
					
					strDiv += '<TR>';
					strDiv += '    <TD>';
					strDiv += '        <div class="btn" style="text-align:center;width:150px;" member_idx="' + row.member_idx + '" country="' + row.country + '" onclick="addMember(this)">추가</div>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.txt_country + '</TD>';
					strDiv += '    <TD>' + row.join_date + '</TD>';
					strDiv += '    <TD>' + row.login_date + '</TD>';
					strDiv += '    <TD ' + detail_link + '>';
					strDiv += '        ' + row.member_name + '<br/>';
					strDiv += '        ' + row.member_id + '<br/>';
					strDiv += '        ' + row.member_level + '<br/>';
					strDiv += '    </TD>';
					strDiv += '    <TD>' + row.member_status + '</TD>';
					strDiv += '    <TD>' + row.tel_mobile + '</TD>';
					strDiv += '    <TD>' + row.member_gender + '</TD>';
					strDiv += '    <TD>' + row.member_birth + '</TD>';
					strDiv += '    <TD>' + row.age + '</TD>';
					strDiv += '    <TD>' + row.region + '</TD>';
					strDiv += '    <TD>' + row.zipcode + '</TD>';
					strDiv += '    <TD>';
					strDiv += '        '+ row.road_addr + '<br/>';
					strDiv += '        '+ row.lot_addr + '<br/>';
					strDiv += '        '+ row.detail_addr + '<br/>';
					strDiv += '    </TD>';
					strDiv += '    <TD>';
					strDiv += '        <div class="row">';

					if (row.receive_sms_flg == true) {
						strDiv += '        <button class="receive_true_btn" style="">SMS</button>';
					} else {
						strDiv += '        <button class="receive_false_btn">SMS</button>';
					}

					if (row.receive_push_flg == true) {
						strDiv += '        <button class="receive_true_btn">알림</button>';
					} else {
						strDiv += '        <button class="receive_false_btn">알림</button>';
					}

					if (row.receive_email_flg == true) {
						strDiv += '        <button class="receive_true_btn">메일</button>';
					} else {
						strDiv += '        <button class="receive_false_btn">메일</button>';
					}
						
					strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;border-radius:5px;">메모</button>';
					strDiv += '        </div>';
					strDiv += '    </TD>';
					strDiv += '</TR>';
				});
				
				result_table.append(strDiv);
			}
		},
	},rows, page);
}

function addMember(obj){
	var member_idx = $(obj).attr('member_idx');
	var country = $(obj).attr('country');
	var cnt = $("#selected_member_table").find('input[name="member_idx[]"][value="' + member_idx + '"]').length;

	if(cnt == 0){
		confirm('선택하신 멤버를 발급회원 리스트에 포함시키겠습니까?', function(){
			$.ajax({
				type: "post",
				data: {
					'country' : country,
					'member_idx' : member_idx
				},
				dataType: "json",
				url: config.api + "voucher/issue/member/get",
				error: function() {
					alert('회원정보 불러오기에 실패했습니다.');
				},
				success: function(d) {
					if(d.code == 200) {
						var row = d.data[0];
						var strDiv = '';
						strDiv = `
							<tr>	
								<td onclick="clickMemberDelete(this)"><a class="btn red"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>
									<input type="hidden" name="member_idx[]" value="${row.no}">
								</td>
								<td>${row.member_id}</td>
								<td>${row.member_name}</td>
								<td>${row.level}</td>
							<tr>
						`;
						$('#selected_member_table').append(strDiv);
						alert('발급회원 리스트에 추가되었습니다.');
					}
				}
			});
		})
	}
	else{
		alert('이미 선택한 회원입니다.');
	}
}

function clickMemberDelete(obj){
	confirm('선택하신 회원을 발급대상에서 제외하시겠습니까?', function (){
		$(obj).parent().remove();
		alert('제외하였습니다.');
	})
}

function issueTypeTabClick(obj) {
	var issue_type = $(obj).attr('issue_type');
	if (issue_type != null) {
		$('.issue__form').hide();
		$('.issue__form.'+issue_type).show();

		$('.category__tab').not($(obj)).css('color','#707070');
		$('.category__tab').not($(obj)).css('border-bottom','none');
		$(obj).css('color','#140f82');
		$(obj).css('border-bottom','3px solid #140f82');
	}
}

function registIssueInfo(obj){
	var country	= $('.issue__voucher__category').find('select[name="country"]').val();
	var on_off_type = $('.issue__voucher__category').find('select[name="on_off_type"]').val();
	var voucher_idx = $('.voucher__list__select').find('select[name="voucher_idx"]').val();
	var voucher_type = $(obj).attr('voucher_type');

	var api_param = {
		'country': country,
		'on_off_type'  : on_off_type,
		'voucher_idx'  : voucher_idx,
		'voucher_type' : voucher_type
	};

	var issue_level_arr = [];
	var member_arr = [];
	confirm('기입하신 조건으로 바우처를 발급하시겠습니까?', function(){
		let duplicate_flg = $('input[name="duplicate_flg"]:checked').val();
		let member_duplicate_flg = $('input[name="member_duplicate_flg"]:checked').val();

		switch(voucher_type){
			case 'BATCH':
				let birth_date = $('#birth_date').val();
				api_param.member_birth = birth_date;

				var issue_level_cnt = $('input[name="issue_member_level[]"]:checked').length;
				if(issue_level_cnt > 0){
					for(var i = 0;i < issue_level_cnt; i++){
						issue_level_arr.push($('input[name="issue_member_level[]"]:checked').eq(i).val());
					}
					api_param.member_level = issue_level_arr;
					
				}
				api_param.duplicate_flg = duplicate_flg;
				break;
			case 'MB':
				var member_cnt = $('#selected_member_table').find('input').length;
				if(member_cnt > 0){
					for(var i = 0;i < member_cnt; i++){
						member_arr.push($('#selected_member_table').find('input').eq(i).val());
					}
					api_param.member_idx = member_arr;
					api_param.duplicate_flg = member_duplicate_flg;
				}
				break;
			case 'OFF':
				var offline_issue_cnt = $('input[name="offline_issue_cnt"]').val();
				api_param.offline_issue_cnt = offline_issue_cnt;
				break;
		}
		$.ajax({
			type: "post",
			data: api_param,
			dataType: "json",
			url: config.api + "voucher/issue/add",
			error: function() {
				alert('바우처 발급에 실패했습니다.');
			},
			success: function(d) {
				if(d.code == 200) {
					alert('바우처를 발급하였습니다. 바우처 목록창으로 돌아갑니다.', function(){
						location.href = 'http://116.124.128.246:81/member/voucher';
					});
				}
				else{
					alert(d.msg);
				}
			}
		});
	})
}
</script>