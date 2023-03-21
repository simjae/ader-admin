<style>
.addr_info {font-size:12px;margin-bottom:15px;}
</style>

<div id="member_detail_MIF">
	<div class="content__card">
		<div class="card__header">
			<h3>회원 상세정보</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="table__wrap">
				<table>
					<colgroup>
						<col width="10%;">
						<col width="40%;">
						<col width="10%;">
						<col width="40%;">
					</colgroup>
					<tbody>
						<tr>
							<TH>아이디</TH>
							<td class="member_id"></td>
							<TH>회원등급</TH>
							<td class="member_level"></td>
						</tr>
						<tr>
							<TH>회원상태</TH>
							<td class="member_status"></td>
							<TH>의심여부</TH>
							<td class="suspicion_flg"></td>
						</tr>
						<tr>
							<TH>휴면일</TH>
							<td class="sleep_off_date"></td>
							<TH>휴면해제일</TH>
							<td class="sleep_off_date"></td>
						</tr>
						<tr>
							<TH>탈퇴유형</TH>
							<td class="drop_type"></td>
							<TH>탈퇴일</TH>
							<td class="drop_date"></td>
						</tr>
						<tr>
							<TH>비밀번호</TH>
							<td>
								<input type="text" name="password" style="width:200px;">
								<div class="btn" style="margin-left:10px;">임시 비밀번호 생성</div>
							</td>
							<TH>비밀번호<br/>변경일</TH>
							<td class="pw_date"></td>
						</tr>
						<tr>
							<TH>이름</TH>
							<td class="member_name"></td>
							<TH>전화번호</TH>
							<td class="tel_mobile"></td>
						</tr>
						<tr>
							<TH>생년월일</TH>
							<td class="member_birth"></td>
							<TH>성별</TH>
							<td class="member_gender"></td>
						</tr>
						<tr>
							<TH>주소</TH>
							<td colspan="3">
								<div class="addr_info zipcode"></div>
								<div class="addr_info lot_addr"></div>
								<div class="addr_info road_addr"></div>
								<div class="addr_info detail_addr"></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="content__card">
		<div class="card__header">
			<h3>사용정보</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="table__wrap">
				<table>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<tbody>
						<tr>
							<TH>총적립금</TH>
							<td class="member_mileage" style="text-decoration:underline;text-align:right;cursor:pointer;" onClick="clickMileagePoint();"></td>
							<TH>총 실결제금액</TH>
							<td class="sum_price_total" style="text-decoration:underline;text-align:right;cursor:pointer;" onClick="clickOrderPrice();"></td>
						</tr>
						<tr>
							<TH>회원가입일</TH>
							<td class="join_date"></td>
							<TH>최근접속일</TH>
							<td class="login_date"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="content__card">
		<div class="card__header">
			<h3>수신동의 및 개인정보 이용 동의</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="table__wrap">
				<table>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="10%">
						<col width="40%">
					</colgroup>
					<tbody>
						<tr>
							<TH>이메일 수신</TH>
							<td class="receive_email_flg"></td>
							<TH>이메일 수신</br>동의/거부 일</TH>
							<td class="receive_email_date"></td>
						</tr>
						<tr>
							<TH>SMS 수신</TH>
							<td class="receive_sms_flg"></td>
							<TH>SMS 수신</br>동의/거부 일</TH>
							<td class="receive_sms_date"></td>
						</tr>
						<tr>
							<TH>전화 수신</TH>
							<td class="receive_tel_flg"></td>
							<TH>전화 수신</br>동의/거부 일</TH>
							<td class="receive_tel_date"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="content__card">
		<div class="card__header">
			<h3>운영 관리 정보</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="table__wrap">
				<table>
					<colgroup>
						<col width="10%;">
						<col width="40%;">
					</colgroup>
					<tbody>
						<tr>
							<TH>관리자 메모</TH>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getModalMemberInfo();
});

function getModalMemberInfo() {
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'member_idx' : member_idx
		},
		dataType: "json",
		url: config.api + "modal/member/get",
		error: function() {
			alert('회원 상세정보 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				let data = d.data;
				if (data != null) {
					let div_container = $('#member_detail_MIF');
					
					div_container.find('.member_id').text(data.member_id);
					div_container.find('.member_level').text(data.member_level);
					div_container.find('.member_status').text(data.member_status);
					div_container.find('.suspicion_flg').text(data.suspicion_flg);
					div_container.find('.sleep_date').text(data.sleep_date);
					div_container.find('.sleep_off_date').text(data.sleep_off_date);
					div_container.find('.drop_type').text(data.drop_type);
					div_container.find('.drop_date').text(data.drop_date);
					div_container.find('.pw_date').text(data.pw_date);
					div_container.find('.member_name').text(data.member_name);
					div_container.find('.tel_mobile').text(data.tel_mobile);
					div_container.find('.member_birth').text(data.member_birth);
					div_container.find('.member_gender').text(data.member_gender);
					div_container.find('.zipcode').text(data.zipcode);
					div_container.find('.lot_addr').text(data.lot_addr);
					div_container.find('.road_addr').text(data.road_addr);
					div_container.find('.detail_addr').text(data.detail_addr);
					
					div_container.find('.member_mileage').text(data.member_mileage);
					div_container.find('.sum_price_total').text(data.sum_price_total);
					div_container.find('.join_date').text(data.join_date);
					div_container.find('.login_date').text(data.login_date);
					
					div_container.find('.receive_email_flg').text(data.receive_email_flg);
					div_container.find('.receive_email_date').text(data.receive_email_date);
					div_container.find('.receive_sms_flg').text(data.receive_sms_flg);
					div_container.find('.receive_sms_date').text(data.receive_sms_date);
					div_container.find('.receive_tel_flg').text(data.receive_tel_flg);
					div_container.find('.receive_tel_date').text(data.receive_tel_date);
				}
				
			} else {
				alert(d.msg);
			}
		}
	});
}

function clickMileagePoint() {
	$('.mem_detail_tab').hide();
	$('#mem_detail_tab_MLG').show();
	
	$('.member__detail__btn').css('background-color','#ffffff');
	$('.member__detail__btn').eq(3).css('background-color','#dcdcdc');
}

function clickOrderPrice() {
	$('.mem_detail_tab').hide();
	$('#mem_detail_tab_ORD').show();
	
	$('.member__detail__btn').css('background-color','#ffffff');
	$('.member__detail__btn').eq(1).css('background-color','#dcdcdc');
}
</script>