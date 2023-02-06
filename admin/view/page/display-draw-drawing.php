<style>
.action__btn{
    cursor: pointer;
	display: flex;
	font-size: 13px;
	align-items: center;
	justify-content: center;
	width: 80px;
	height: 25px;
	border-radius: 2px;
	padding: 10px;
	border: solid 1px #707070;
	cursor:pointer;
}
.white__btn{
	width:120px;
	height:30px;
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	margin-right:10px;
	cursor:pointer;
}
.red__btn{
    cursor: pointer;
	display: flex;
	font-size: 13px;
	align-items: center;
	justify-content: center;
	background-color: #e7505a;
	color: #ffffff;
	width: 80px;
	height: 22px;
	border-radius: 2px;
	padding: 10px;
	border: solid 1px #707070;
	cursor:pointer;
}
.blue__btn{
    cursor: pointer;
	display: flex;
	font-size: 13px;
	align-items: center;
	justify-content: center;
	background-color: #3598dc;
	color: #ffffff;
	width: 80px;
	height: 22px;
	border-radius: 2px;
	padding: 10px;
	border: solid 1px #707070;
	cursor:pointer;
}
</style>
<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3>드로우 당첨 관리</h3>
			</div>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div class="card__header">
			<h3>드로우 정보</h3>
				<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="table table__wrap">
				<div class="overflow-x-auto">
					<TABLE>
						<colgroup>
							<col width="auto">
							<col width="20%">
							<col width="20%">
							<col width="20%">
							<col width="10%">
						</colgroup>
						<thead>
							<tr>
								<th>드로우 상품정보</th>
								<th>응모 기간</th>
								<th>당첨 발표일</th>
								<th>드로우 구매 기간</th>
								<th>활성화</th>
							</tr>
						</thead>
						<tbody id="sel_draw_table">
							<tr>
								<td>
									<p style="margin-bottom:5px;"></p>        
									<div class="product__img__wrap">            
										<div class="product__img" style="background-image:url('/images/product/img_BLAFWCT06BL_06_P_S_202210210000.jpg');">            
									</div>            
									<div>                
										<p>Sample BLAFWCT06BL</p><br>
										<p>150,000 ₩</p><br>
										<p>Color : red</p><br>       	   
										<p>A1</p><br>            
									</div> 
								</td>
								<td>2022.12.23 10:00<br>- 2022.12.23.11:00</td>
								<td>2022.12.23 12:00</td>
								<td>2022.12.24 10:00<br>- 2022.12.24.12:00</td>
								<td>
									<div class="red__btn" onclick="">비활성화</div>
								</td>
							</tr>
						</tbody>
					</TABLE>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between" style="gap:20px;">
			<div class="flex items-center" style="gap: 20px;">
				<h3>드로우 참가인원</h3>
			</div>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<div class="table table__wrap">
			<TABLE>
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="auto">
					<col width="12%">
					<col width="12%">
				</colgroup>
				<thead>
					<tr>
						<th>No.</th>
						<th>Level</th>
						<th>ID</th>
						<th>회원명</th>
						<th>E-mail</th>
						<th>생일</th>
						<th>휴대전화</th>
						<th>당첨</th>
					</tr>
				</thead>
				<tbody id="draw_participant_table">
					<tr>
						<td>20</td>
						<td>ADER family</td>
						<td>NiLevelcolao</td>
						<td>Nicolao</td>
						<td>chaerin0503@gmail.com</td>
						<td>2002-09-01</td>
						<td>000-0020-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>19</td>
						<td>일반회원</td>
						<td>seoeunlim</td>
						<td>Sean</td>
						<td>seoeunlim@gmail.com</td>
						<td>2003-01-01</td>
						<td>000-0030-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>18</td>
						<td>일반회원</td>
						<td>kimyj0612</td>
						<td>Selim Jasmin	</td>
						<td>kimyj0612@gmail.com</td>
						<td>2003-03-01</td>
						<td>000-0040-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>17</td>
						<td>일반회원</td>
						<td>darlin267</td>
						<td>Tove Evans</td>
						<td>darlin267@gmail.com</td>
						<td>2003-05-01</td>
						<td>000-0050-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>16</td>
						<td>일반회원</td>
						<td>qwes12358</td>
						<td>Wang ke</td>
						<td>qwes12358@gmail.com</td>
						<td>2003-07-01</td>
						<td>000-0060-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>15</td>
						<td>ADER family</td>
						<td>sksdl526</td>
						<td>Yang sheng</td>
						<td>sksdl526@gmail.com</td>
						<td>2003-09-01</td>
						<td>000-0070-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>14</td>
						<td>일반회원</td>
						<td>kane7</td>
						<td>ZHUYUNLEI</td>
						<td>kane7@gmail.com</td>
						<td>2004-01-01</td>
						<td>000-0080-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>13</td>
						<td>일반회원</td>
						<td>hiinhye</td>
						<td>강울림</td>
						<td>hiinhye@gmail.com</td>
						<td>2004-03-01</td>
						<td>000-0090-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>12</td>
						<td>일반회원</td>
						<td>monkey2468</td>
						<td>강진혁</td>
						<td>monkey2468@gmail.com</td>
						<td>2004-05-01</td>
						<td>000-0001-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>11</td>
						<td>일반회원</td>
						<td>k46916964</td>
						<td>고미선</td>
						<td>k46916964@gmail.com</td>
						<td>2004-07-01</td>
						<td>000-0002-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>10</td>
						<td>ADER family</td>
						<td>jyw1526</td>
						<td>고성원</td>
						<td>jyw1526@gmail.com</td>
						<td>2004-09-01</td>
						<td>000-0003-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>9</td>
						<td>일반회원</td>
						<td>narieoy</td>
						<td>고준용</td>
						<td>narieoy@gmail.com</td>
						<td>2005-01-01</td>
						<td>000-0004-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>8</td>
						<td>일반회원</td>
						<td>mike310</td>
						<td>김경훈</td>
						<td>mike310@gmail.com</td>
						<td>2005-03-01</td>
						<td>000-0005-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>7</td>
						<td>chlwhdgur5599</td>
						<td>ID</td>
						<td>김관헌</td>
						<td>chlwhdgur5599@gmail.com</td>
						<td>2005-05-01</td>
						<td>000-0006-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>6</td>
						<td>일반회원</td>
						<td>foodball1423</td>
						<td>김광섭</td>
						<td>foodball1423@gmail.com</td>
						<td>2005-07-01</td>
						<td>000-0007-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>5</td>
						<td>ADER family</td>
						<td>zlions2127</td>
						<td>김규성</td>
						<td>zlions2127@gmail.com</td>
						<td>2005-09-01</td>
						<td>000-0008-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>4</td>
						<td>일반회원</td>
						<td>lggww152</td>
						<td>김기영</td>
						<td>lggww152@gmail.com</td>
						<td>2006-01-01</td>
						<td>000-0009-00</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>일반회원</td>
						<td>owhoe</td>
						<td>김대영</td>
						<td>owhoe@gmail.com</td>
						<td>2006-03-01</td>
						<td>000-0000-10</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>일반회원</td>
						<td>unwnsgk1282</td>
						<td>김대현</td>
						<td>unwnsgk1282@gmail.com</td>
						<td>2006-05-01</td>
						<td>000-0000-20</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
					<tr>
						<td>1</td>
						<td>일반회원</td>
						<td>idahoi</td>
						<td>김미선</td>
						<td>idahoi@gmail.com</td>
						<td>2006-07-01</td>
						<td>000-0000-30</td>
						<td>
							<button class="white__btn">추첨 미진행</button>
						</td>
					</tr>
				</tbody>
			</TABLE>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
			<div  class="blue__color__btn" onClick="DrawingForm()"><span>추첨 시작</span></div>
				<div class="defult__color__btn" onClick="returnDrawPage()"><span>드로우 목록창으로 이동</span></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {	
});

function DrawingForm(){
    confirm('추첨을 시작하시겠습니까?', function(){
		var participant_cnt = $('#draw_participant_table').children().length;
		var winner_arr = [];
		var winner_cnt = 0;

		while(winner_cnt < 4){
			var ran_num = Math.floor(Math.random() * (participant_cnt - 0) + 0);
			if(winner_arr.find(val => val == ran_num) == undefined){
				winner_arr.push(ran_num);
				winner_cnt++;
			}
		}

		for(var i = 0; i < participant_cnt; i++){
			var btn_obj = $('#draw_participant_table').children().eq(i).find('button');
			btn_obj.removeClass('white__btn');
			btn_obj.removeClass('red__btn');
			btn_obj.removeClass('blue__btn');
			if(winner_arr.find(val => val == i) == undefined){
				btn_obj.addClass('red__btn');
				btn_obj.text('미당첨');
				//미당첨
			}
			else{
				btn_obj.addClass('blue__btn');
				btn_obj.text('당첨');
				//당첨
			}
		}
        alert('드로우 추첨을 완료했습니다.');
    })
}

function returnDrawPage(){
    confirm('드로우목록 창으로 돌아가시겠습니까?', function(){
        location.href="/display/draw";
    })
}
</script>