<div class="content__card">
    <div class="card__header">
        <h3>회원 등급 목록</h3>
        <div class="drive--x"></div>
    </div>
    <form id="frm-06-01" action="member/info/level/get">
    </form>
    <div id="table_div_06" class="table table__wrap">
        <form id="frm-06-02" action="member/info/level/delete">
            <div class="table__filter">
                <div class="filrer__wrap">
                    <div class="filter__btn"onclick="memberLevelCheck();">삭제</div>
                    <div class="filter__btn">추가</div>
                </div> 	
				<div>
					<div class="table__setting__btn">설정</div>
				</div>  
            </div>
            <TABLE>
                <THEAD>
                    <TR>
                        <TH rowspan="2" style="width:3%;">
                            <div class="cb__color">
                                <label>
                                    <input type="checkbox" name="selectAll" value=" "onclick="selectLevel(this);">
                                    <span></span>
                                </label>
                            </div>
                        </TH>
                        <TH rowspan="2">일괄 등급</TH>
                        <TH rowspan="2">혜택 결제조건</TH>  
                        <TH colspan="2">구매 적립</TH>
                        <TH colspan="2">구매 할인</TH>
                        <TH rowspan="2">회원 수</TH>
                    </TR>
                    <TR>
                        <TH>구매금액(이상)</TH>
                        <TH>적립</TH>
                        <TH>구매금액(이상)</TH>
                        <TH>할인</TH>
                    </TR>
                </THEAD>
                <TBODY id="member_level_table">
                    <TR>
                        <TD colspan="12">
                            조회 결과가 없습니다
                        </TD>
                    </TR>
                </TBODY>
            </TABLE>
        </form>
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
            <div class="content__wrap" style="grid-template-columns: 170px 2fr;">
                <div class="content__title">회원등급</div>
                <div class="content__row">
                    <select id="member_level" name="member_level" class="fSelect" style="width:163px;">
                    </select>
                </div>
            </div>
            <div class="content__wrap" style="grid-template-columns: 170px 2fr;">
                <div class="content__title">결과 내 검색</div>
                <div class="content__row">
                    <select name="search_type" class="fSelect" style="width:163px;">
                        <option value="member_id" selected="">아이디</option>
                        <option value="name">이름</option>
                    </select>
                    <input type="text" name="search_keyword" value="">
                </div>
            </div>
        </div>
        <div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMemberTabInfo_06();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_06', 'getMemberTabInfo_06');"><span>초기화</span></div>
				</div>
			</div>
		</div> 
    </form>
</div>

<div class="content__card">
    <form id="frm-06-04" action="member/info/level/list/put">
        <div class="info__wrap " style="justify-content:space-between; align-items: center;">
            <div class="body__info--count">
                <div class="drive--left"></div>
                총 회원수 <font class="cnt_06_total info__count">0</font>명 
				<div class="drive--left"></div>
				검색결과 <font class="cnt_06_result info__count">0</font>명
            </div>
            <div class="content__row">
				<select style="width:163px;float:right;" onChange="orderChange(this);">
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
					
                <select name="rows" style="width:163px;float:right;" onChange="rowsChange(this);">
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
										<input type="checkbox" name="selectAll" value="" onclick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
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
			<input type="hidden" class="total_cnt" value="0" tab_num="06" onChange="setResultCount(this);">
			<input type="hidden" class="result_cnt" value="0" tab_num="06" onChange="setResultCount(this);">
            <div class="paging_06"></div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
	getMemberLevel();
	getMemberTabInfo_06();
});
function initFilter_06(){
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
				strDiv += '                <input type="checkbox" class="select" name="select_lv[]" value="' + row.lv + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.title + '</TD>';
				strDiv += '    <TD>' + row.sale_type + '</TD>';
				strDiv += '    <TD>' + row.r_purchase_price + '</TD>';
				strDiv += '    <TD>' + row.r_purchase_reserve + '</TD>';
				strDiv += '    <TD>' + row.d_purchase_price + '</TD>';
				strDiv += '    <TD>' + row.d_purchase_discount + '</TD>';
				strDiv += '    <TD>' + row.count + '</TD>';
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
				if (row.default_level == row.title) {
					selected = "selected";
				}
				sel_strDiv += '<option value="' + row.title + '" ' + selected + '>' + row.title + '</option>';
				strDiv += '<option value="' + row.title + '" >' + row.title + '</option>';
				
				$('#default_level').append(sel_strDiv);
				$('#member_level').append(strDiv);
			});
		},
	});
}

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
	var select_lv = [];
	var length = $('#member_level_table').find('.select').length;
	for (var i=0; i<length; i++) {
		if ($('#member_level_table').find('.select').eq(i).prop('checked') == true) {
			select_lv.push($('#member_level_table').find('.select').eq(i).val());
		}
	}
	
	if (select_lv.length == 0) {
		alert('삭제 할 멤버의 등급을 선택해주세요.');
	} else {
		var cnt = 0;
		for (var i=0; i<select_lv.length; i++) {
			if (select_lv[i] == 99) {
				cnt++;
			}
		}
		
		if (cnt > 0) {
			alert('"일반회원" 등급은 삭제할 수 없습니다');
		} else {
			confirm('선택 한 멤버의 등급을 삭제하시겠습니까?','memberLevelDelete(' + select_lv.length + ')');
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
				var join_date = [];
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
				strDiv += '    <TD style="text-decoration:underline;">' + row.name + '</TD>';
				strDiv += '    <TD style="text-decoration:underline;">' + row.id + '</TD>';
				strDiv += '    <TD>';
				strDiv +=          row.level;
				strDiv += '        <input type="hidden" id="member_level_' + row.no + '" value="' + row.level + '">';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.gender + '</TD>';
				strDiv += '    <TD>' + row.age + '</TD>';
				strDiv += '    <TD>' + row.region + '</TD>';
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
				
				$("#result_table_06").append(strDiv);
			});
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
</script>
