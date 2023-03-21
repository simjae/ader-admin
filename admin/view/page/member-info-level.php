<div class="content__card">
    <div class="card__header">
        <h3>회원 등급 목록</h3>
        <div class="drive--x"></div>
    </div>
    <div class="table table__wrap">
		<div class="table__filter">
			<div class="filrer__wrap">
				<div class="filter__btn" onclick="deleteMemberLevel();">삭제</div>
				<div class="filter__btn" onclick="modal('level/add',null)">추가</div>
			</div>
		</div>
		<div class="overflow-x-auto">
			<TABLE style="width:40%;">
				<THEAD>
					<TR>
						<TH style="width:3%;">
							<div class="cb__color">
								<label>
									<input type="checkbox" name="selectAll" value="" onclick="selectAllLevel(this);">
									<span></span>
								</label>
							</div>
						</TH>
						<TH>수정</TH>
						<TH>레벨 타이틀</TH>
						<TH>마일리지 적립 비율</TH>  
						<TH style="width:15%;">한국몰 회원수</TH>
						<TH style="width:15%;">영문몰 회원수</TH>
						<TH style="width:15%;">중문몰 회원수</TH>
					</TR>
				</THEAD>
				<TBODY id="member_level_table">
					<TR>
						<TD colspan="6" style="text-align:left;">
							조회 결과가 없습니다
						</TD>
					</TR>
				</TBODY>
			</TABLE>
		</div>
    </div>
</div>

<div class="content__card">
	<div class="card__header">
		<h3>회원 가입시 회원등급 기본설정</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="content__wrap" style="grid-template-columns: 170px 2fr;">
			<div class="content__title">한국몰 회원 기본설정</div>
			<div class="content__row">
				회원가입 시 한국몰 회원등급을
				<select id="default_level_KR" name="default_level" style="width:200px;">
					<option value="">등록된 멤버 레벨이 없습니다.</option>
				</select>
				(으)로 설정합니다.
				<div class="black-btn" onclick="setMemberDefaultLevel('KR');">기본설정 저장</div>
			</div>
		</div>
		
		<div class="content__wrap" style="grid-template-columns: 170px 2fr;">
			<div class="content__title">영문몰 회원 기본설정</div>
			<div class="content__row">
				회원가입 시 영문몰 회원등급을
				<select id="default_level_EN" name="default_level" style="width:200px;">
					<option value="">등록된 멤버 레벨이 없습니다.</option>
				</select>
				(으)로 설정합니다.
				<div class="black-btn" onclick="setMemberDefaultLevel('EN');">기본설정 저장</div>
			</div>
		</div>
		
		<div class="content__wrap" style="grid-template-columns: 170px 2fr;">
			<div class="content__title">중문몰 회원 기본설정</div>
			<div class="content__row">
				회원가입 시 중문몰 회원등급을
				<select id="default_level_CN" name="default_level" style="width:200px;">
					<option value="">등록된 멤버 레벨이 없습니다.</option>
				</select>
				(으)로 설정합니다.
				<div class="black-btn" onclick="setMemberDefaultLevel('CN');">기본설정 저장</div>
			</div>
		</div>
	</div>
</div>

<div class="content__card">
    <form id="frm-filter_MLV" action="member/info/list/get">
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
							<input type="radio" id="member_gender_MLI_ALL" class="radio__input" value="ALL" name="member_gender" checked>
							<label for="member_gender_MLI_ALL">전체</label>

							<input type="radio" id="member_gender_MLI_M" class="radio__input" value="M" name="member_gender"/>
							<label for="member_gender_MLI_M">남</label>
							
							<input type="radio" id="member_gender_MLI_F" class="radio__input" value="F" name="member_gender"/>
							<label for="member_gender_MLI_F">여</label>
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
					<option value="LOGIN_DATE|DESC">최근로그인 역순</option>
					<option value="LOGIN_DATE|ASC">최근로그인 순</option>
					<option value="MEMBER_NAME|DESC">회원이름 역순</option>
					<option value="MEMBER_NAME|ASC">회원이름 순</option>
					<option value="MEMBER_ID|DESC">회원ID 역순</option>
					<option value="MEMBER_ID|ASC">회원ID 순</option>
					<option value="MEMBER_STATUS|DESC">회원상태 역순</option>
					<option value="MEMBER_STATUS|ASC">회원상태 순</option>
					<option value="TEL_MOBILE|DESC">휴대전화 역순</option>
					<option value="TEL_MOBILE|ASC">휴대전화 순</option>
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
                    <div class="filter__btn" style="width:130px;" onclick="openLevelModal();">레벨 일괄 변경</div>
                    <div class="filter__btn" style="width:130px;">적립금 일괄지급</div>
                    <div class="filter__btn" style="width:130px;">SMS 보내기</div>
					<div class="filter__btn" style="width:130px;">MAIL 보내기</div>
                    <div class="filter__btn" style="width:130px;" onclick="excelDownload();">엑셀 다운로드</div>
                </div> 
            </div>
			<div class="overflow-x-auto">
				<TABLE id="excel_table_MLV">
					<colgroup>
						<col width="50px;">
						<col width="80px">
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
							<TH>
								<div class="cb__color">
									<label>
										<input type="checkbox" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH>No.</TH>
							<TH>쇼핑몰</TH>
							<TH>휴면일</TH>
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
					<TBODY id="result_table_MLV">
						
					</TBODY>
				</TABLE>
        	</div>
        </div>
		
        <div class="padding__wrap">
			<input type="hidden" class="total_cnt" tab_status="MLV" value="0" onChange="setPaging(this);">
			<input type="hidden" class="result_cnt" tab_status="MLV" value="0" onChange="setPaging(this);">
			<div class="paging_MLV"></div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
	getMemberLevelList();
	getMemberInfoList('MLV');
});

function getMemberLevelList() {
	let member_level_table = $("#member_level_table");
	
	let default_level_KR = $('#default_level_KR');
	let default_level_EN = $('#default_level_EN');
	let default_level_CN = $('#default_level_CN');
	
	$.ajax({
		type: "post",
		url: config.api + "member/info/level/list/get",
		dataType: "json",
		error: function() {
			alert("멤버 레벨 조회 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data;
				
				let table_div = "";
				let select_div = "";
				
				member_level_table.html('');
				
				if (data != null) {
					default_level_KR.html('');
					default_level_EN.html('');
					default_level_CN.html('');
					
					data.forEach(function(row) {
						table_div += '<TR>';
						table_div += '    <TD style="width:3%;">';
						table_div += '        <div class="cb__color">';
						table_div += '            <label>';
						table_div += '                <input class="select" type="checkbox" name="level_idx[]" value="' + row.level_idx + '">';
						table_div += '                <span></span>';
						table_div += '            </label>';
						table_div += '        </div>';
						table_div += '    </TD>';
						table_div += '    <TD><div class="btn" onclick="modal(\'level/put\',\'level_idx=' + row.level_idx + '\')")>수정</div></TD>';
						table_div += '    <TD>' + row.level_title + '</TD>';
						table_div += '    <TD style="text-align:right;">' + row.mileage_per + '%</TD>  ';
						table_div += '    <TD>' + row.member_kr_cnt + '</TD>';
						table_div += '    <TD>' + row.member_en_cnt + '</TD>';
						table_div += '    <TD>' + row.member_cn_cnt + '</TD>';
						table_div += '</TR>';
						
						select_div += '<option value="' + row.level_idx + '">' + row.level_title + '</option>';
					});					
				} else {
					table_div += '<TR>';
					table_div += '    <TD colspan="6" style="text-align:left;">';
					table_div += '        조회 결과가 없습니다';
					table_div += '    </TD>';
					table_div += '</TR>';
				}
				
				member_level_table.append(table_div);
				default_level_KR.append(select_div);
				default_level_EN.append(select_div);
				default_level_CN.append(select_div);
				
				getMemberDefaultLevel();
			} else {
				alert(d.msg);
			}
		}
	});
}

function getMemberDefaultLevel() {
	$.ajax({
		type: "post",
		url: config.api + "member/info/level/default/get",
		dataType: "json",
		error: function() {
			alert("멤버 기본레벨 조회 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data[0];
				
				if (data != null) {
					$('#default_level_KR').val(data.default_level_kr);
					$('#default_level_EN').val(data.default_level_en);
					$('#default_level_CN').val(data.default_level_cn);
				}
			} else {
				alert(d.msg);
			}
		}
	});
}


function selectAllLevel(obj) {
	if ($(obj).prop('checked') == true) {
		$("#member_level_table").find('.select').prop('checked',true);
	} else {
		$("#member_level_table").find('.select').prop('checked',false);
	}
}

function getCheckedLevelIdx() {
	let level_idx = [];
	
	let member_level_table = $('#member_level_table');
	let checkbox = member_level_table.find('.select');
	let cnt = checkbox.length;
	
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			level_idx.push(checkbox.eq(i).val());
		}
	}
	
	return level_idx;
}

function deleteMemberLevel(len) {
	confirm('선택한 회원등급을 정말 삭제하시겠습니까?', function(){
		let level_idx = getCheckedLevelIdx();
	
		if (level_idx.length > 0) {
			$.ajax({
				type: "post",
				url: config.api + "member/info/level/delete",
				data: {
					'level_idx' : level_idx
				},
				dataType: "json",
				
				error: function() {
					alert("등급 삭제 처리에 실패했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert("선택한 멤버레벨이 삭제되었습니다..");
						getMemberLevelList();
					} else {
						alert(d.msg);
						return false;
					}
				}
			});
		} else {
			alert('삭제하려는 멤버레벨을 선택해주세요.');
			return false;
		}
	})
	
}

function setMemberDefaultLevel(country) {
	let defatul_level_idx = $('#default_level_' + country).val();
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'default_level_idx' : defatul_level_idx
		},
		dataType: "json",
		url: config.api + "member/info/level/default/put",
		error: function() {
			alert("멤버의 기본레벨 설정 처리에 실패했습니다.");
		},
		success: function(d) {
			if (d.code == 200) {
				alert("기본레벨이 설정되었습니다.");
				getMemberLevelList();
			}
		}
	});
}

function setMemberInfoList_MLV(member_data) {
	let result_table = $('#result_table_MLV');
	
	result_table.html('');
	let strDiv = "";
	if (member_data != null) {
		member_data.forEach(function(row) {
			let detail_link = "";
			if (row.country != null && row.member_idx != null) {
				detail_link = ' style="text-decoration:underline;cursor:pointer;" onclick="javascript:void(window.open(\'http://116.124.128.246:81/member/detail?country=' + row.country + '&member_idx=' + row.member_idx + '\', \'회원상세 페이지\',\'width=#, height=#\'))" ';
			}
			
			let join_date = [];
			if (row.join_date != null) {
				join_date = row.join_date.split(' ');
			}
			
			strDiv += '<TR>';
			strDiv += '    <TD>';
			strDiv += '        <div class="cb__color">';
			strDiv += '            <label>';
			strDiv += '                <input class="select" type="checkbox" name="member_idx[]" value="' + row.member_idx + '">';
			strDiv += '                    <span></span>';
			strDiv += '            </label>';
			strDiv += '        </div>';
			strDiv += '    </TD>';
			strDiv += '    <TD>' + row.num + '</TD>';
			strDiv += '    <TD>' + row.txt_country + '</TD>';
			strDiv += '    <TD>' + row.sleep_date + '</TD>';
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
	} else {
		let strDiv = "";
		strDiv += '<TD class="default_td" colspan="15" style="text-align:left;">';
		strDiv += '    조회 결과가 없습니다';
		strDiv += '</TD>';
		
		result_table.append(strDiv);
	}
}

function openLevelModal() {
	let frm = $('#frm-filter_MLV');
	let country = frm.find('.country').val();
	
	let member_idx = getCheckedMemberIdx('MLV');
	
	if (member_idx.length > 0) {
		modal('/get','param=' + country + '_' + member_idx);
	} else {
		alert('등급을 변경 할 멤버를 선택해주세요.');
		return false;
	}
	
}
</script>