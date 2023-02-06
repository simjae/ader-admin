<div class="content__card">
    <div class="card__header">
        <h3>회원 등급 목록</h3>
        <div class="drive--x"></div>
    </div>
    <div class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn"onclick="memberLevelCheck();">삭제</div>
				<div class="filter__btn">추가</div>
			</div>
		</div>
		<div class="overflow-x-auto">
			<TABLE style="width:40%;">
				<THEAD>
					<TR>
						<TH rowspan="2" style="width:3%;">
							<div class="cb__color">
								<label>
									<input type="checkbox" name="selectAll" value="" onclick="selectAllLevel(this);">
									<span></span>
								</label>
							</div>
						</TH>
						<TH>레벨 타이틀</TH>
						<TH>마일리지 적립 비율</TH>  
						<TH style="width:15%;">회원수</TH>
					</TR>
				</THEAD>
				<TBODY id="member_level_table">
					<TR>
						<TD colspan="4">
							조회 결과가 없습니다
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
    </div>
</div>

<div class="content__card">
    <form id="frm-06-03" action="member/info/level/default/get">
        <div class="card__header">
            <h3>회원 가입시 회원등급 기본설정</h3>
            <div class="drive--x"></div>
        </div>
        <div class="card__body">
            <div class="content__wrap" style="grid-template-columns: 170px 2fr;">
                <div class="content__title">회원등급 기본설정</div>
                <div class="content__row">
                    회원가입 시 회원등급을
                    <select id="default_level" name="default_level" style="width:163px;">
					</select>
                    (으)로 설정합니다.
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end card__footer" style="margin-top:0;">
            <div class="black-btn" onclick="setDefaultLevel();">저장</div>
        </div>
    </form>
</div>

<div class="content__card">
    <form id="frm-list_06" action="member/info/get">
        <input type="hidden" class="rows" name="rows" value="10">
        <input type="hidden" class="page" name="page" value="1">
        <div class="card__header">
            <h3>회원등급별 회원 관리</h3>
            <div class="drive--x"></div>
        </div>
        <div class="card__body">
			<div class="content__wrap">
                <div class="content__title">쇼핑몰</div>
                <div class="content__row">
					<select class="fSelect country" name="country" style="width:163px;">
						<option value="KR" selected="selected">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중국몰</option>
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
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">회원레벨</div>
					<div class="content__row">
						<select name="member_level" class="fSelect" style="width:163px;">
							<option value="ALL" selected="selected">전체</option>
						<?php
							$select_level_sql = "
								SELECT
									ML.IDX		AS LEVEL_IDX,
									ML.TITLE	AS LEVEL_TITLE
								FROM
									dev.MEMBER_LEVEL ML
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
				
				<div class="half__box__wrap">
					<div class="content__title">성별</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="member_gender_INF_ALL" class="radio__input" value="ALL" name="member_gender" checked>
							<label for="member_gender_INF_ALL">전체</label>

							<input type="radio" id="member_gender_INF_M" class="radio__input" value="M" name="member_gender"/>
							<label for="member_gender_INF_M">남</label>
							
							<input type="radio" id="member_gender_INF_F" class="radio__input" value="F" name="member_gender"/>
							<label for="member_gender_INF_F">여</label>
						</div>
					</div>
				</div>
			</div>
        </div>
		
        <div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberInfoList('MLV');"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-filter_MLV','getMemberInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
    </form>
</div>

<div class="content__card">
    <form id="frm-06-04" action="member/info/level/list/put">
		<input type="hidden" name="level_country" value="KR">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
				총 회원 수 <font class="cnt_MLV_total info__count" >0</font>명 
				<div class="drive--left"></div>
				검색결과 <font class="cnt_MLV_result info__count" >0</font>명
            </div>
            <div class="content__row">
				<select style="width:163px;float:right;" tab_status="MLV" onChange="orderChange(this);">
					<option value="JOIN_DATE|DESC" selected>가입일 역순</option>
					<option value="JOIN_DATE|ASC">가입일 순</option>
					<option value="NAME|DESC">이름 역순</option>
					<option value="NAME|ASC">이름 순</option>
					<option value="ID|DESC">아이디 역순</option>
					<option value="ID|ASC">아이디 순</option>
					<option value="LEVEL|DESC">등급 역순</option>
					<option value="LEVEL|ASC">등급 순</option>
					<option value="STATUS|DESC">상태 역순</option>
					<option value="STATUS|ASC">상태 순</option>
					<option value="TEL|DESC">일반전화 역순</option>
					<option value="TEL|ASC">일반전화 순</option>
					<option value="TEL_MOBILE|DESC">휴대전화 역순</option>
					<option value="TEL_MOBILE|ASC">휴대전화 순</option>
					<option value="GENDER|DESC">성별 역순</option>
					<option value="GENDER|ASC">성별 순</option>
					<option value="AGE|DESC">나이 역순</option>
					<option value="AGE|ASC">나이 순</option>
					<option value="REGION|DESC">지역 역순</option>
					<option value="REGION|ASC">지역 순</option>
				</select>
					
                <select name="rows" tab_status="MLV" onChange="rowsChange(this);" style="width: 163px;">
                    <option value="10" selected>10개씩보기</option>
                    <option value="20">20개씩보기</option>
                    <option value="30">30개씩보기</option>
                    <option value="50">50개씩보기</option>
                    <option value="100">100개씩보기</option>
                    <option value="200">200개씩보기</option>
                    <option value="300">300개씩보기</option>
                    <option value="500">500개씩보기</option>
                </select>
            </div>
        </div>
        <div id="table_div_06" class="table table__wrap">
            <div class="table__filter">
                <div class="filrer__wrap">
                    <div class="filter__btn" style="width:130px;" action_type="member_grage" onclick="memberLevelCheck_list();">일괄 등급 변경</div>
                    <div class="filter__btn" style="width:130px;" action_type="member_mail">적립금 일괄지급</div>
                    <div class="filter__btn" style="width:130px;" action_type="member_sms">전체 SMS 보내기</div>
                    <div class="filter__btn" style="width:130px;" action_type="member_sms" onclick="excelDownload();">엑셀 다운로드</div>
                </div> 	
				<div>
					<div class="table__setting__btn">설정</div>
				</div>  
            </div>
			<div class="overflow-x-auto">
				<TABLE id="excel_table_06">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:3%;">No.</TH>
							<TH style="width:8%;">등록일</TH>
							<TH style="width:10%;">이름</TH>
							<TH style="width:10%;">아이디</TH>
							<TH style="width:8%;">등급</TH>
							<TH style="width:5%;">성별</TH>
							<TH style="width:5%;">나이</TH>
							<TH style="width:5%;">지역</TH>
							<TH>메일/SMS/메모</TH>
							<TH style="width:15%;">관련내역 보기</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table_06">
						<TR>
							<TD class="default_td" colspan="10">
								조회 결과가 없습니다
							</TD>
						</TR>
					</TBODY>
				</TABLE>
        	</div>
        </div>
		
        <div class="padding__wrap">
			<input type="hidden" class="total_cnt" tab_status="MLV" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" tab_status="MLV" value="0" onChange="setPaging(this);">
			<div class="paging_PRC"></div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
	//getMemberLevel();
	//getMemberTabInfo_06();
});

/*function initFilter_06(){
	$('#frm-06-03').find('select[name="default_level"] option:eq(1)').prop("selected", true);

	$('#frm-list_06').find('select[name="member_level"] option:eq(0)').prop("selected", true);
	$('#frm-list_06').find('select[name="search_type"] option:eq(0)').prop("selected", true);

	$('#frm-list_06').find('input[name="search_keyword"]').val('');
	getMemberTabInfo_06();
}
function getMemberLevel() {
	$("#member_level_table").html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD colspan="12">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#member_level_table").append(strDiv);
	
	get_contents($("#frm-06-01"),{
		html : function(d) {
			if (d.length > 0) {
				$('#member_level_table').html('');
			}
			
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="sel_level_idx[]" value="' + row.idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.title + '</TD>';
				strDiv += '    <TD>' + row.mileage_per + '</TD>';
				strDiv += '    <TD>';
				strDiv += '    		<TABLE>';
				strDiv += '    			<TR>';
				strDiv += '    				<TD>한국몰 회원수</TD>';
				strDiv += '    				<TD>' + row.kr_count + '</TD>';
				strDiv += '    			</TR>';
				strDiv += '    			<TR>';
				strDiv += '    				<TD>영국몰 회원수</TD>';
				strDiv += '    				<TD>' + row.en_count + '</TD>';
				strDiv += '    			</TR>';
				strDiv += '    			<TR>';
				strDiv += '    				<TD>중국몰 회원수</TD>';
				strDiv += '    				<TD>' + row.cn_count + '</TD>';
				strDiv += '    			</TR>';
				strDiv += '    		</TABLE>';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				$("#member_level_table").append(strDiv);
			});
		},
	});
	
	get_contents($("#frm-06-03"),{
		html : function(d) {
			if (d.length > 0) {
				$('#default_level').html('');
				$('#member_level').html('');
				$('#member_level').append('<option value="all" selected >전체</option>');
			}
			
			d.forEach(function(row) {
				var sel_strDiv = "";
				var strDiv = "";
				var selected = "";
				if (row.default_level == row.idx) {
					selected = "selected";
				}
				sel_strDiv += '<option value="' + row.idx + '" ' + selected + '>' + row.title + '</option>';
				strDiv += '<option value="' + row.idx + '" >' + row.title + '</option>';
				
				$('#default_level').append(sel_strDiv);
				$('#member_level').append(strDiv);
			});
		},
	});
}*/

function selectLevel(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#member_level_table").find('.select').prop('checked',true);
	} else {
		$(obj).prop('checked',false);
		$("#member_level_table").find('.select').prop('checked',false);
	}
}

function memberLevelCheck() {
	var sel_level_arr = [];
	var sel_level_obj = $('#member_level_table').find('.select');

	for (var i=0; i<sel_level_obj.length; i++) {
		if (sel_level_obj.eq(i).prop('checked') == true) {
			sel_level_arr.push(sel_level_obj.eq(i).val());
		}
	}
	
	if (sel_level_arr.length == 0) {
		alert('삭제 할 멤버의 등급을 선택해주세요.');
	} else {
		if(sel_level_arr.find(val => val == 1) == undefined){
			confirm('선택 한 멤버의 등급을 삭제하시겠습니까?','memberLevelDelete(' + sel_level_arr.length + ')');
			//일반회원 등급 미선택
		}
		else{
			alert('"일반회원" 등급은 삭제할 수 없습니다');
			//일반회원 등급 선택
		}
	}

}

function memberLevelDelete(len) {
	var formData = new FormData();
	formData = $("#frm-06-02").serializeObject();
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/info/level/delete",
		error: function() {
			alert("등급 삭제 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert("정상적으로 등급이 삭제되었습니다.");
				insertLog("고객관리 > 회원 조회 > 회원등급 관리", "등급 일괄삭제", len);
				getMemberLevel();
			}
		}
	});
}

function setDefaultLevel() {
	var formData = new FormData();
	formData = $("#frm-06-03").serializeObject();
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/info/level/default/put",
		error: function() {
			alert("멤버의 기본등급 설정 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert("정상적으로 멤버의 기본등급이 설정되었습니다.");
				insertLog("고객관리 > 회원 조회 > 회원등급 관리", "멤버 기본등급 설정 변경", null);
				getMemberLevel();
			}
		}
	});
}

function getMemberTabInfo_06() {
	$("#getMemberTabInfo_06").html('');
	
	var strDiv = '';
	strDiv += '<TD colspan="10">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#getMemberTabInfo_06").append(strDiv);
	
	var rows = $('#frm-list_06').find('.rows').val();
	$('#frm-list_06').find('.page').val(1);
	
	get_contents($("#frm-list_06"),{
		pageObj : $(".paging_06"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_06").html("");
				
			}
			d.forEach(function(row) {
				
				
				$("#result_table_06").append(strDiv);
			});
			$('input[name="level_country"]').val($('#frm-list_06').find('select[name="country"]').val());
		},
	},rows,1);
}

function memberLevelCheck_list() {
	var select_idx = [];
	var length = $('#frm-06-04').find('.select').length;
	
	for (var i=0; i<length; i++) {
		if ($('#frm-06-04').find('.select').eq(i).prop('checked') == true) {
			select_idx.push($('#frm-06-04').find('.select').eq(i).val());
		}
	}
	
	if (select_idx.length == 0) {
		alert('등급 해제 처리 할 멤버를 선택해주세요.');
	} else {
		var cnt = 0;
		for (var i=0; i<select_idx.length; i++) {
			var member_level = $('#member_level_' + select_idx[i]).val();
			
			if (member_level == "일반회원") {
				cnt++;
			}
		}
		
		if (cnt == 0) {
			if (confirm('선택한 멤버를 등급 해제 처리하시겠습니까.','memberLevelUpdate_list(' + select_idx.length + ')')) {
				memberLevelUpdate_list();
			}
		} else {
			alert('일반회원 상태 이외의 멤버만 등급해제 처리 할 수 있습니다.');
		}
	}
}

function memberLevelUpdate_list(len) {
	var formData = new FormData();
	formData = $("#frm-06-04").serializeObject();

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "member/info/level/list/put",
		error: function() {
			alert("멤버의 등급 해제처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert("정상적으로 등급 해제 처리되었습니다.");
				insertLog("고객관리 > 회원 조회 > 회원등급 관리", "멤버 등급해제 처리", len);
				getMemberTabInfo_06();
			}
		}
	});
}

function setMemberInfoList_MLV(member_data) {
	let result_table = $('#result_table_INF');
	
	let strDiv = "";
	if (member_data != null) {
		let strDiv = "";
		member_data.forEach(function(row) {
			let join_date = [];
			if (row.join_date != null) {
				join_date = row.join_date.split(' ');
			}

			var strDiv = "";
			strDiv += '<TR>';
			strDiv += '    <TD>';
			strDiv += '        <div class="cb__color">';
			strDiv += '            <label>';
			strDiv += '                <input type="checkbox" class="select" name="select_idx[]" value="' + row.no + '">';
			strDiv += '                <span></span>';
			strDiv += '            </label>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + join_date[0] + '<br>' + join_date[1] + '</TD>';
			strDiv += '    <TD style="text-decoration:underline;">' + row.member_name + '</TD>';
			strDiv += '    <TD style="text-decoration:underline;">' + row.member_id + '</TD>';
			strDiv += '    <TD>';
			strDiv +=          row.level;
			strDiv += '        <input type="hidden" id="member_level_' + row.no + '" value="' + row.level + '">';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + gender_str + '</TD>';
			strDiv += '    <TD>' + row.age + '</TD>';
			strDiv += '    <TD>' + region_str + '</TD>';
			strDiv += '    <TD>';
			strDiv += '        <div class="row">';
			if (row.receive.email == true) {
				strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">MAIL</button>';
			} else {
				strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff">MAIL</button>';
			}
			if (row.receive.sms == true) {
				strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">SMS</button>';
			} else {
				strDiv += '        <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff">SMS</button>';
			}
			strDiv += '            <button style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#000000;color:#ffffff">MEMO</button>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '    <TD>';
			strDiv += '        <div class="row" style="margin-top:15px;margin-bottom:15px;">';
			strDiv += '            <button style="font-size:0.5rem;width:50px;height:30px;border:1px solid;background-color:#ffffff;">주문</button>';
			strDiv += '            <button style="font-size:0.5rem;width:50px;height:30px;border:1px solid;background-color:#ffffff;">적립금</button>';
			strDiv += '            <button style="font-size:0.5rem;width:50px;height:30px;border:1px solid;background-color:#ffffff;">쿠폰</button>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '</TR>';
		});
		
		result_table.append(strDiv);
	} else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="12">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}
</script>