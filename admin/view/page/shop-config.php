<h1>쇼핑몰 환경설정</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>쇼핑몰</li>
		<li>환경설정</li>
	</ul>
</div>

<div class="row">
	<div class="portlet">
		<div class="title">
			<h1><i class="xi-cog"></i>기본정보</h1>
		</div>
		<div class="body">
			<div class="note warning">
				번호 조합 옵션의 경우 총 20자 이내로 설정되어야 하며 자주 옵션을 변경하지 마십시오. 오류의 가능성이 있습니다.
			</div>

			<form name="frm1" id="frm1" action="/api/shop/config/">
			<!-- BEGIN 주문번호 설정 -->
			<div class="form-group">
				<div class="form-row">
					<label><input type="radio" name="ORDERNUMMIX" value="NUM"><span>숫자</span></label>
					<label><input type="radio" name="ORDERNUMMIX" value="CHAR"><span>영문자 혼합</span></label>
					<label><input type="radio" name="ORDERNUMMIX" value="TIME"><span>일자</span></label>
				</div>
				<label class="control-label">주문번호 문자조합</label>
			</div>

			<!-- BEGIN 주문번호 조합 -->
			<div class="form-group">
				<div class="spinner">
					<input type="text" name="ORDERNUM_HEAD" value="" maxlength="5" style="width:60px">
					<button type="button" class="btn spinner-up blue"><i class="xi-plus"></i></button>
					<input type="text" class="spinner-inp" maxlength="2" min="5" max="20" readonly="" name="ORDERNUM_LENGTH" value="">
					<button type="button" class="btn spinner-down red"><i class="xi-minus"></i></button>
					<input type="text" name="ORDERNUM_FOOT" value="" maxlength="5" style="width:60px">
				</div>
				<label class="control-label">주문번호 조합</label>
			</div>
			<!-- BEGIN 주문번호 조합 -->


			<!-- BEGIN 쿠폰번호 조합 -->
			<div class="form-group">
				<div class="form-row">
					<label><input type="radio" name="COUPONMIX" value="NUM"><span>숫자</span></label>
					<label><input type="radio" name="COUPONMIX" value="CHAR"><span>영문자 혼합</span></label>
				</div>
				<label class="control-label">쿠폰번호 문자조합</label>
			</div>
			<div class="form-group">
				<div class="spinner">
					<input type="text" name="COUPON_HEAD" value="" maxlength="5" style="width:60px">
					<button type="button" class="btn spinner-up blue"><i class="xi-plus"></i></button>
					<input type="text" class="spinner-inp" min="5" max="20" maxlength="2" readonly="" name="COUPON_LENGTH" value="">
					<button type="button" class="btn spinner-down red"><i class="xi-minus"></i></button>
					<input type="text" name="COUPON_FOOT" value="" maxlength="5" style="width:60px">
				</div>
				<label class="control-label">쿠폰번호 조합</label>
			</div>
			<!-- BEGIN 쿠폰번호 조합 -->


			<div class="form-group">
				<input type="time" name="EXCEPT_RETURNTIME_S" class="timepicker" value=""> ~ <input type="time" name="EXCEPT_RETURNTIME_E" class="timepicker" value="">
				<label class="control-label">자동환불 제외 시간대</label>
			</div>
			<div class="form-group has-head">
				<input type="text" name="price_en" value="1150" required>
				<span class="head">＄</span>
				<label class="control-label">기본 환율</label>
			</div>
			</form>
		</div>
		<div class="footer">
			<a class="btn btn-large green" onclick="fn_submit($('#frm1'));"><i class="xi-check"></i> 저장</a>
			<a class="btn btn-large" onclick="frm1.reset();"><i class="xi-undo"></i> 이전값 초기화</a>
		</div>
	</div>
</div>


<div class="row">
	<div class="portlet white">
		<div class="title">
			<h1><i class="xi-truck"></i>배송정보</h1>
		</div>
		<div class="body">
			<form name="frm4" id="frm4" action="shop/config/delivery">
			<div class="form-group">
				<label><input type="checkbox" name="DELIVERY[]" value=""><span></span></label>
				<label class="control-label">이용 택배사</label>
			</div>

			<div class="form-group">
				<div class="switch">
					<input type="checkbox" name="USE_ST" value="Y">
					<div class="switch-container">
						<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
					</div>
				</div>
				<label class="control-label">스윗트래커 사용</label>
			</div>

			<div class="form-group">
				<input type="text" name="API_ST" value="">
				<label class="control-label">스윗트래커 API키</label>
			</div>

			<div class="form-group">
				<input type="hidden" name="DELIVERY_COST" value="">
				<table class="list width-100p">
				<thead>
					<tr>
						<th width="45%">배송 개수</th>
						<th>배송비</th>
						<th width="40px"></th>
					</tr>
				</thead>
				<tbody id="delivery-list">
					<tr>
						<td colspan="3" class="nodata"><i class="xi-ban"></i><br>설정된 배송비가 없습니다.</td>
					</tr>
				</tbody>
				</table>
				<label class="control-label">국내 택배비용</label>
			</div>

			<div class="form-group">
				<input type="text" name="" class="number">
				<label class="control-label">도서산간 추가배송비</label>
			</div>

			<div class="form-group">
				<table class="list width-100p">
				<thead>
					<tr>
						<th>박스종류</th>
						<th width="150px">무게 g</th>
						<th width="240px">크기 cm</th>
						<th width="130px"></th>
					</tr>
					<tr>
						<th><input type="text" name="box_name" maxlength="15" required></th>
						<th><input type="number" name="box_weight" min="1" max="999999" required></th>
						<th>
							<input type="number" name="box_size_w" min="1" max="999" placeholder="너비" style="width:60px" required>
							×
							<input type="number" name="box_size_h" min="1" max="999" placeholder="높이" style="width:60px" required>
							×
							<input type="number" name="box_size_d" min="1" max="999" placeholder="깊이" style="width:60px" required>
						</th>
						<th><a class="btn blue" onclick="box_add();"><i class="xi-check"></i><span class="tooltip top">추가</span></a></th>
					</tr>
				</thead>
				<tbody id="delivery-box-list">
					<tr>
						<td colspan="4" class="nodata"><i class="xi-ban"></i><br>설정된 택배박스가 없습니다.</td>
					</tr>
				</tbody>
				</table>
				<label class="control-label">택배박스 정의</label>
			</div>

			<div class="form-group">
				<table class="list width-100p">
				<thead>
					<tr>
						<th width="150px">지역</th>
						<th>국가</th>
						<th width="130px"></th>
					</tr>
					<tr>
						<th><input type="text" name="ems_name" maxlength="15" required></th>
						<th></th>
						<th><a class="btn blue" onclick="ems_add();"><i class="xi-check"></i><span class="tooltip top">추가</span></a></th>
					</tr>
				</thead>
				<tbody id="delivery-ems-list">
					<tr>
						<td colspan="3" class="nodata"><i class="xi-ban"></i><br>설정된 EMS지역이 없습니다.</td>
					</tr>
				</tbody>
				</table>
				<label class="control-label">EMS지역</label>
			</div>
			</form>
		</div>

		<div class="footer">
			<a class="btn btn-large blue" onclick="fn_submit($('#frm4'));"><i class="xi-check"></i> 저장</a>
			<a class="btn btn-large" onclick="frm4.reset();"><i class="xi-undo"></i> 이전값 초기화</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-2">
		<!-- BEGIN SMS호스팅정보 -->
		<div class="portlet white">
			<div class="title">
				<h1>
					<i class="xi-mobile"></i>SMS 문구 설정
					<div class="tools">
						<a class="btn" onclick="modal('site/sms/test');"><i class="xi-mobile"></i><span class="tooltip top">SMS테스트</span></a>
					</div>
				</h1>
			</div>
			<div class="body">
				<div class="note warning">
					쇼핑몰 이용 상황 별 SMS로 발송되는 문구를 설정합니다. 하단 문구를 삽입하면 문자 전송시 해당 내용으로 전송됩니다.<br><br>
					<span class="sticker">{{SITENAME}} 사이트명</span>
					<span class="sticker">{{PRICE}} 결제금액</span>
					<span class="sticker">{{PRODUCT}} 상품명</span>
					<span class="sticker">{{CUSTOMER}} 고객명</span>
					<span class="sticker">{{COUPON}} 쿠폰번호</span>
					<span class="sticker">{{DATE}} 일자</span>
					<span class="sticker">{{RESERV_DATE}} 예약일자</span>
					<span class="sticker">{{ORDERNUM}} 주문번호</span>
					<span class="sticker">{{ORDERNAME}} 주문자명</span>
					<span class="sticker">{{REFUNDPRICE}} 환불금액</span>
					<span class="sticker">{{BANK}} 입금 은행</span>
					<span class="sticker">{{ACCOUNT}} 입금 계좌</span>
					<span class="sticker">{{DEPOSITOR}} 계좌주</span>
				</div>

				<form name="frm2" id="frm2" action="modules/shop/config/?m=sms">
				<input type="hidden" name="CODE[]" value="<?=$data['CODE']?>">
				<div class="form-group">
					<textarea name="MSG[]" title="문자내용" style="height:60px"><?=$data['MSG']?></textarea>
					<label class="control-label"><input type="checkbox" name="STATUS[]" value='<?=$data['CODE']?>' <?php if($data['STATUS']=='Y') echo 'checked';?>><span><?=$data['TITLE']?></span></label>
				</div>
				</form>

			</div>
			<div class="footer">
				<a class="btn btn-large red" onclick="fn_submit($('#frm2'));"><i class="xi-check"></i> 저장</a>
			</div>
		</div>
		<!-- END SMS호스팅정보 -->
	</div>

	<div class="col-2">
		<!-- BEGIN 추가결제 정보 -->
		<div class="portlet">
			<div class="title">
				<h1>
					<i class="xi-bank"></i>무통장 입금 정보
				</h1>
			</div>
			<div class="body">
				<form name="frm3" id="frm3" action="modules/shop/config/?m=bank-add">
				<table class="list width-100p">
				<thead>
					<tr>
						<th style="width:30%">은행</th>
						<th>계좌번호</th>
						<th style="width:20%">예금주</th>
						<th style="width:100px">작업</th>
					</tr>
					<tr>
						<th><input type="text" name="BANK" required></th>
						<th><input type="text" name="NUMBER" required></th>
						<th><input type="text" name="NAME" required></th>
						<th><a onclick="fn_submit($('#frm3'));" class="btn blue"><i class="xi-check"></i><span class="tooltip top">추가</span></a></th>
					</tr>
				</thead>
				<tbody id="bank-list">
					<tr>
						<td colspan="4" class="nodata"><i class="xi-ban"></i><br>등록된 계좌가 없습니다.</td>
					</tr>
				</tbody>
				</table>
				</form>
			</div>
		</div>
		<!-- END PG결제사 정보 -->
	</div>
</div>

<script>
function box_add() {
	var name = frm4.box_name.value;
	var weight = frm4.box_weight.value;
	var size_w = frm4.box_size_w.value;
	var size_h = frm4.box_size_h.value;
	var size_d = frm4.box_size_d.value;

	if(name == "") {
		toast("박스종류를 입력해주세요.");
		frm4.box_name.focus();
		return false;
	}
	if(weight == "") {
		toast("무게를 입력해주세요.");
		frm4.box_weight.focus();
		return false;
	}

	var html;
	html  = '<tr>';
	html += '	<th><input type="text" name="name[]" maxlength="15" required value="' + name + '"></th>';
	html += '	<th><input type="number" name="weight[]" min="1" max="999999" required value="' + weight + '"></th>';
	html += '	<th>';
	html += '		<input type="number" name="size_w[]" min="1" max="999" placeholder="너비" style="width:60px" required value="' + size_w + '">';
	html += '		×';
	html += '		<input type="number" name="size_h[]" min="1" max="999" placeholder="높이" style="width:60px" required value="' + size_h + '">';
	html += '		×';
	html += '		<input type="number" name="size_d[]" min="1" max="999" placeholder="깊이" style="width:60px" required value="' + size_d + '">';
	html += '	</th>';
	html += '	<th>';
	html += '		<a class="btn red" onclick="box_del_row(this);"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
	html += '	</th>';
	html += '</tr>';
	$("#delivery-box-list td.nodata").parent().remove();
	$("#delivery-box-list").append(html);

	frm4.box_name.value = "";
	frm4.box_weight.value = "";
	frm4.box_size_w.value = "";
	frm4.box_size_h.value = "";
	frm4.box_size_d.value = "";
	frm4.box_name.focus();

}

function box_modify(no) {
	$.ajax({
		type: "post",
		url: "modules/shop/config/?m=box-add",
		data: $("#frm4").serialize() + "&no=" + no,
		dataType: "json",
		error: function() {
			alert("설정 저장에 실패하였습니다.");
		},
		success: function(d) {
			toast("택배박스 정보를 수정하였습니다.");
		}
	});
}

function box_del_row(obj) {
	$(obj).parent().parent().remove();
}
function box_del(no) {
	confirm("해당 박스 정보를 삭제할까요?","box_del_confirm(" + no + ")");
}
function box_del_confirm(no) {
	$.ajax({
		type: "post",
		url: config.api + "shop/config/box-del",
		data: "no=" + no,
		dataType: "json",
		error: function() {
			alert("정보 삭제 실패하였습니다.");
		},
		success: function(d) {
			box_list();
		}
	});
}

function box_list() {
	$.ajax({
		type: "post",
		url: config.api + "shop/config/box-list",
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			var html = "";

			if(d.total > 0) {
				for(var i=0;i<d.total;i++) {
					html += '<tr>';
					html += '	<td><input type="text" name="name_' + d.data[i].no + '" maxlength="15" required value="' + d.data[i].name + '"></td>';
					html += '	<td><input type="number" name="weight_' + d.data[i].no + '" min="1" max="999999" required value="' + d.data[i].weight + '"></td>';
					html += '	<td>';
					html += '		<input type="number" name="size_w_' + d.data[i].no + '" min="1" max="999" placeholder="너비" style="width:60px" required value="' + d.data[i].size_w + '">';
					html += '		×';
					html += '		<input type="number" name="size_h_' + d.data[i].no + '" min="1" max="999" placeholder="높이" style="width:60px" required value="' + d.data[i].size_h + '">';
					html += '		×';
					html += '		<input type="number" name="size_d_' + d.data[i].no + '" min="1" max="999" placeholder="깊이" style="width:60px" required value="' + d.data[i].size_d + '">';
					html += '	</td>';
					html += '	<td>';
					html += '		<a class="btn blue" onclick="box_modify(' + d.data[i].no + ');"><i class="xi-check"></i><span class="tooltip top">수정</span></a>';
					html += '		<a class="btn green" onclick="modal(\'shop/config/box\',\'no=' + d.data[i].no + '\');"><i class="xi-wrench"></i><span class="tooltip top">상세 설정</span></a>';
					html += '		<a class="btn red" onclick="box_del(' + d.data[i].no + ');"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
					html += '	</td>';
					html += '</tr>';
				}
			}
			else {
				html += '<tr>';
				html += '	<td colspan="4" class="nodata"><i class="xi-ban"></i>설정된 택배박스가 없습니다.</td>';
				html += '</tr>';
			}
			$("#delivery-box-list").html(html);
		}
	});
}


function ems_add() {
	var name = frm4.ems_name.value;

	if(name == "") {
		toast("지역을 입력해주세요.");
		frm4.ems_name.focus();
		return false;
	}

	var html;
	html  = '<tr>';
	html += '	<th><input type="text" name="name[]" maxlength="15" required value="' + name + '"></th>';
	html += '	<th></th>';
	html += '	<th>';
	html += '		<a class="btn red" onclick="ems_del_row(this);"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
	html += '	</th>';
	html += '</tr>';
	$("#delivery-ems-list td.nodata").parent().remove();
	$("#delivery-ems-list").append(html);

	frm4.ems_name.value = "";
	frm4.ems_name.focus();

}

function ems_modify(no) {
	$.ajax({
		type: "post",
		url: config.api + "shop/config/ems-add",
		data: $("#frm4").serialize() + "&no=" + no,
		dataType: "json",
		error: function() {
			alert("설정 저장에 실패하였습니다.");
		},
		success: function(d) {
			toast("EMS지역 정보를 수정하였습니다.");
		}
	});
}

function ems_del_row(obj) {
	$(obj).parent().parent().remove();
}
function ems_del(no) {
	confirm("해당 EMS지역 정보를 삭제할까요?","ems_del_confirm(" + no + ")");
}
function ems_del_confirm(no) {
	$.ajax({
		type: "post",
		url: config.api + "shop/config/ems-del",
		data: "no=" + no,
		dataType: "json",
		error: function() {
			alert("정보 삭제 실패하였습니다.");
		},
		success: function(d) {
			ems_list();
		}
	});
}

function ems_list() {
	$.ajax({
		type: "post",
		url: config.api + "shop/config/ems-list",
		dataType: "json",
		error: function() {
			alert("데이터를 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			var code,html = "";

			if(d.total > 0) {
				for(var i=0;i<d.total;i++) {
					code = "";
					for(var j=0;j<d.data[i].code_hangul.length;j++) {
						if(j>0) code += ", ";
						code += d.data[i].code_hangul[j];
					}

					html += '<tr>';
					html += '	<td><input type="text" name="name_' + d.data[i].no + '" maxlength="15" required value="' + d.data[i].name + '"></td>';
					html += '	<td>' + code + '</td>';
					html += '	<td>';
					html += '		<a class="btn blue" onclick="ems_modify(' + d.data[i].no + ');"><i class="xi-check"></i><span class="tooltip top">수정</span></a>';
					html += '		<a class="btn green" onclick="modal(\'shop/config/ems\',\'no=' + d.data[i].no + '\');"><i class="xi-wrench"></i><span class="tooltip top">상세 설정</span></a>';
					html += '		<a class="btn red" onclick="ems_del(' + d.data[i].no + ');"><i class="xi-trash"></i><span class="tooltip top">삭제</span></a>';
					html += '	</td>';
					html += '</tr>';
				}
			}
			else {
				html += '<tr>';
				html += '	<td colspan="3" class="nodata"><i class="xi-ban"></i>설정된 EMS지역이 없습니다.</td>';
				html += '</tr>';
			}
			$("#delivery-ems-list").html(html);
		}
	});
}

//box_list();
//ems_list();


var last_delivery_ea = 0;
var last_delivery_cost = 0;

function delivery_calc() {
	$("#delivery-list").empty();
	var html = "";
	var string = frm4.DELIVERY_COST.value;
	var prev = 0;
	var _arr = string.split("||");
	for(var i =0;i<_arr.length;i++) {
		var _tmp = _arr[i].split("|");
		if(_tmp[1] != undefined) {
			html  = "<tr>";
			html += "	<td>" + (prev+1);
			if(_tmp[1] != "0") {
				html +=  " ~ " + _tmp[0] + "</td><td>" + FormatNumber(_tmp[1]) + "</td>";
				prev = parseInt(_tmp[0]);
			}
			else {
				html += "개 이상</td><td>무료배송</td>";
			}
			html += '<td><a class="btn red" href="javascript:;" onclick="delivery_del(' + (i+1)+');"  data-tooltip="삭제"><i class="fa fa-trash-o"></a></td>';
			html += "</tr>";
			$("#delivery-list").append(html);

			last_delivery_ea = parseInt(_tmp[0]);
			last_delivery_cost = parseInt(_tmp[1]);
		}
	}
	html  = "<tr>";
	html += "	<td>" + (prev+1) + " ~ <input type='text' id='delivery_ea' name='delivery_ea' style='min-width:60px;width:50%'></td>";
	html += "	<td><input type='text' name='delivery_cost' id='delivery_cost'></td>";
	html += "	<td><a class='btn blue' href='javascript:;' onclick='delivery_add();'><i class='fa fa-check'></a></td>";
	html += "</tr>";

	$("#delivery-list").append(html);
}

function delivery_add() {
	var delivery_ea = $("#delivery_ea").val();
	var delivery_cost = $("#delivery_cost").val();
	
	if(last_delivery_cost < 1) {
		toast("무료 배송 조건이 있어 더 이상 입력이 불가능합니다. 무료 배송 조건 삭제후 입력해 주십시오",1);
		return false;
	}
	
	if(trim(delivery_ea) == "") {
		toast("배송 개수를 입력해 주십시오",1);
		return false;
	}
	if(trim(delivery_cost) == "") {
		toast("배송비를 입력해 주십시오",1);
		return false;
	}
	if(parseInt(delivery_ea) < last_delivery_ea+1) {
		toast("배송 개수를 " + (last_delivery_ea+1) + "개 이상 입력해 주십시오",1);
		return false;
	}
	if(parseInt(delivery_cost) >= last_delivery_cost) {
		toast("배송비는 " + FormatNumber(last_delivery_cost) + "원보다 적게 입력해 주십시오",1);
		return false;
	}

	var string = $("#delivery_ea").val() + "|" + $("#delivery_cost").val() + "||"
	frm4.DELIVERY_COST.value += string;

	delivery_calc();
}

function delivery_del(n) {
	var string = frm4.DELIVERY_COST.value;
	var _arr = string.split("||");
	string = "";
	for(var i=0;i<_arr.length;i++) {
		if(i!=(n-1)) {
			string += _arr[i] + "||";
		}
	}
	frm4.DELIVERY_COST.value = string;

	delivery_calc();
}


</script>