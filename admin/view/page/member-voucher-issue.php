<style>
.white__btn{
	width:120px;
	height:30px;
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	margin-right:10px;
	cursor:pointer;
}
.gray__btn{
	width:80px;
	height:30px;
	border:1px solid #000000;
	background-color:#dcdcdc;
	color:#000000;
	margin-right:10px;
	cursor:pointer;
}
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
				<div class="category__tab" issue_type="member_level" style="color:#140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;" onClick="issueTypeTabClick(this);">멤버 레벨 지정</div>
				<div class="category__tab" issue_type="member_idx" style="height:30px;color:#707070;text-align:center;cursor:pointer;" onClick="issueTypeTabClick(this);">개별 발급</div>
			</div>
			<div class="issue__form member_level">
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">멤버 레벨 지정</div>
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
					<div class="half__box__wrap">
						<button type="button" class="white__btn" voucher_type="LV" onclick="registIssueInfo(this)">발급</button>
					</div>
				</div>
			</div>
			
			<div class="issue__form member_birth">
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">생일 지정</div>
						<div class="content__row" style="width:40%;">
							<div class="content__date__picker">
								<input class="display_date" type="date" id="member_birthday"  placeholder="From" readonly="" style="width:150px" onChange="">
							</div>
						</div>
					</div>
					<div class="half__box__wrap">
						<button type="button" class="white__btn" voucher_type="BR" onclick="registIssueInfo(this)">발급</button>
					</div>
				</div>
			</div>
			
			<div class="issue__form member_idx">
				<div class="card__header">
					<h3>회원 검색창</h3>
				</div>
				<form id="frm-member-filter" action="voucher/issue/member/list/get">
					<input type="hidden" name="country" value="KR">
					<input type="hidden" class="rows" name="rows" value="10">
					<input type="hidden" class="page" name="page" value="1">

					<div class="card__body">
						<div claszs="body__info--count" style="display: block;margin:20px 0;">
							<div class="drive--left"></div>
							<div class="flex justify-between" style="gap:20px;">
							</div>
						</div>
						<div class="content__wrap">
							<div class="content__title">발행 멤버 레벨</div>
							<div class="content__row">
								<label class="rd__square">
									<input type="radio" name="member_level" value="ALL" checked>
									<div><div></div></div>
									<span>전체</span>
								</label>
								<label class="rd__square">
									<input type="radio" name="member_level" value="1" >
									<div><div></div></div>
									<span>일반 멤버</span>
								</label>
								<label class="rd__square">
									<input type="radio" name="member_level" value="2">
									<div><div></div></div>
									<span>Ader family</span>
								</label>
							</div>
						</div>
						<div class="content__wrap grid__half">
							<div class="half__box__wrap">
								<div class="content__title">회원명</div>
								<div class="content__row">
									<input type="text" name="member_name" value="">
								</div>
							</div>
							<div class="half__box__wrap">
								<div class="content__title">회원 아이디</div>
								<div class="content__row">
									<input type="text" name="member_id" value="">
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="card__footer">
					<div class="footer__btn__wrap" style="grid: none;">
						<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getMemberTabInfo()"><span>검색</span></div>
							<div class="defult__color__btn" onClick="init_fileter('frm-filter','getMemberTabInfo()');"><span>초기화</span></div>
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
							<TABLE style="width:50%">
								<colgroup>
									<col width="15%">
									<col width="28%">
									<col width="28%">
									<col width="28%">
								</colgroup>
								<THEAD>
									<TR>
										<TH>선택</TH>
										<TH>아이디</TH>
										<TH>이름</TH>
										<TH>멤버레벨</TH>
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
										<TH>멤버레벨</TH>
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
	})
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
	$("#result_member_list_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="4">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_member_list_table").append(strDiv);
	
	var filter_obj = $("#frm-member-filter");
	var list_obj = $('#frm-member-list');

	var rows = filter_obj.find('.rows').val();
	var page = filter_obj.find('.page').val();

	get_contents(filter_obj,{
		pageObj : list_obj.find(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_member_list_table").html('');
			}
			d.forEach(function(row) {
				var strDiv = "";
				strDiv = `
						<TR>	
							<TD>
								<button type="button" class="gray__btn" member_idx="${row.no}" country="${row.country}" onclick="addMember(this)">추가</button>
							</TD>
							<TD>${row.member_id}</TD>
							<TD>${row.member_name}</TD>
							<TD>${row.level}</TD>
						</TR>
				`;
				$("#result_member_list_table").append(strDiv);
				//$("#result_member_list_table").append(strDiv);
			});
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
		switch(voucher_type){
			case 'LV':
				var issue_level_cnt = $('input[name="issue_member_level[]"]:checked').length;
				if(issue_level_cnt > 0){
					for(var i = 0;i < issue_level_cnt; i++){
						issue_level_arr.push($('input[name="issue_member_level[]"]:checked').eq(i).val());
					}
					api_param.member_level = issue_level_arr;
				}
				break;
			case 'MB':
				var member_cnt = $('#selected_member_table').find('input').length;
				if(member_cnt > 0){
					for(var i = 0;i < member_cnt; i++){
						member_arr.push($('#selected_member_table').find('input').eq(i).val());
					}
					api_param.member_idx = member_arr;
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
					alert('바우처를 발급하였습니다.');
				}
				else{
					alert(d.msg);
				}
			}
		});
	})
}
</script>