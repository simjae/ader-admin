<?php include '/var/www/_static/head.php'; ?>
<div class="body">
	<h1>판매 상품 관리<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="/modules/goods/list/?m=add">
		<input type="hidden" name="no" value="<?=$no?>">
		<input type="hidden" name="store_no">

		<!------- // 기본 정보 : BEGIN ------>
		<h2>기본 정보</h2>

		<div class="form-group">
			<div class="image">
				<input type="file" name="file" class="input-image">
				<a><i class="xi-image"></i></a>
				<img>
			</div>
			<label class="control-label">대표 이미지</label>
		</div>

		<div class="form-group">
			<input type="hidden" name="name">
			<div class="textarea" contentEditable="true"></div>
			<label class="control-label">상품명</label>
		</div>

		<div class="form-group">
			<input type="text" name="price" class="number" value="0" required>
			<span class="tail">원</span>
			<label class="control-label">가격</label>
		</div>

		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="selltime_yn" value="y">
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<div class="hidden" id="inp-selltime">
				<div class="row">
					<div class="col-7 col-7-3">
						<select name="selltime_s">
							<?php for($i=0;$i<=24;$i++) { ?>
							<option value="<?=$i?>"><?=$i?>시</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-7" style="height:54px">
						<span class="center">~</span>
					</div>
					<div class="col-7 col-7-3">
						<select name="selltime_e">
							<?php for($i=0;$i<=24;$i++) { ?>
							<option value="<?=$i?>"><?=$i?>시</option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<label class="control-label">판매시간대 지정</label>
		</div>

		<div class="form-group">
			<input type="number" name="seq" value="1" required>
			<label class="control-label">진열 순서</label>
		</div>
		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="soldout" value="y">
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">품절</label>
		</div>
		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="status" value="y">
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">판매 여부</label>
		</div>

		<!------- // 기본 정보 : END ------>

		<h2>추가 설정</h2>
		<?php
		switch($store_data['CATEGORY']) {
			case '스터디까페':
				include 'add.studycafe.layout.php';
				break;
			case '메일빈':
				include 'add.mailbean.layout.php';
				break;
			case '헬스/사우나':
				include 'add.sauna.layout.php';
				break;
			case '음식점':
				include 'add.restaurant.layout.php';
				break;
			case '독서실':
				include 'add.readingroom.layout.php';
				break;
		}
		?>
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit_pre();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
var modal_submit_pre;
$(document).ready(function() {
	var f = $("form").last();


	$(f).find("input[name='is_ticket']").click(function() {
	if($(this).prop("checked")) {
		$("#goods-ticket-cnt,#goods-ticket-add-text").removeClass("hidden");

	}
	else {
		$("#goods-ticket-cnt,#goods-ticket-add-text").addClass("hidden");
	}
	});

	$(f).find("input[name='allday_yn']").click(function() {
	if($(this).prop("checked")) {
		$("#inp-useful_timeterm_s").removeClass("hidden");

	}
	else {
		$("#inp-useful_timeterm_s").addClass("hidden");
	}
	});

	$(f).find("input[name='selltime_yn']").click(function() {
	if($(this).prop("checked")) {
		$("#inp-selltime").removeClass("hidden");

	}
	else {
		$("#inp-selltime").addClass("hidden");
	}
	});

	modal_submit_pre = function() {
		$(f).find(".textarea").each(function() {
			$(this).prev().val($(this).html());
		});
		if($(f).find("input[name='name']").val() == "") {
			alert("상품명을 입력해주세요");
			$(f).find(".textarea").focus();
			return false;
		}
		$(f).find("input[name='store_no']").val($("#frm-client-list select[name='store_no']").val());
		modal_submit();
	};

	if($(f).find("input[name=no]").val() != "") {
		$.ajax({
			type: "post",
			url: "/modules/goods/list/",
			data: {
				no : $(f).find("input[name=no]").val()
			},
			dataType: "json",
			error: function() {
				alert("데이터를 불러들이는데 실패하였습니다.");
			},
			success: function(d) {
				if(d.total > 0) {
					$(f).find("input[name='name']").next().html(d.data[0].name);
					$(f).find("input[name='price']").val(d.data[0].price);
					$(f).find("input[name='seq']").val(d.data[0].seq);
					$(f).find("input[name='soldout']").prop("checked",d.data[0].soldout);
					$(f).find("input[name='status']").prop("checked",d.data[0].status);
					$(f).find("input[name='selltime_yn']").prop("checked",d.data[0].selltime.yn);
					$(f).find("select[name='selltime_s']").val(d.data[0].selltime.s);
					$(f).find("select[name='selltime_e']").val(d.data[0].selltime.e);
					$(f).find("input[name='file']").parent().find("img").attr("src",d.data[0].image);
					$(f).find("input[name='img_detail']").parent().find("img").attr("src",d.data[0].image_detail);

					if(d.data[0].setting) {
						for(var i=0;i<d.data[0].setting.length;i++) {
							var val = d.data[0].setting[i].val;
							if(typeof val == 'boolean') {
								$(f).find("input[name='" + d.data[0].setting[i].code + "']").attr("checked",val);
							}
							else {
								if(d.data[0].setting[i].code_number >= 42 || d.data[0].setting[i].code == 'out_ice' || d.data[0].setting[i].code == 'out_water') {
									val = d.data[0].setting[i].val/10;
								}
								$(f).find("input[name='" + d.data[0].setting[i].code + "']").val(val);
							}
						}
					}
				}

			}
		});
	}



});


</script>