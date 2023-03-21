<!-- START RESPONSE CARD -->
<style>
input::placeholder {color: #707070;text-align: center;}
textarea {padding: 10px;border: 1px solid #000;}
textarea::placeholder {color: #707070;}
textarea:focus {outline: none;}
.edit__wrap {border: 1px dashed #000;padding: 10px;}
.edit__contnet__wrap {display: grid;row-gap: 20px;}
.edit__contnet__wrap > div {text-align: center;}
.edit__img {display: contents;}
.edit__img img {width: 100%;}
.preview__wrap {border: 1px dashed #000;padding: 10px;}
.edit__input__wrap {display: grid;justify-content: center;}
.edit__intpu__btn.preview {width: 200px;}
.edit__title__wrap {margin: 10px;padding: 10px;align-items: center;display: flex;justify-content: space-between;border-bottom: 1px solid #000;}
.edit__input__wrap input {padding: 5px;border: 1px #adadad solid;cursor: pointer;overflow: visible;-ms-user-select: none;-moz-user-select: -moz-none;user-select: none;color: #adadad;}
.edit__input__wrap input:focus {outline: none;}
.edit__textarea__wrap {display: grid;}
.edit__btn {text-align: center;cursor: pointer;width: 100px;height: 30px;background-color: #000;line-height: 2;color: #fff;}
.edit__script {padding-right: 2px;display: grid;}
.edit__product__wrap {margin: 10px 0 20px 0;display: grid;grid-template-columns: 1fr 1fr 1fr 1fr;column-gap: 10px;row-gap: 10px;}
.edit__product__wrap.preview {margin: 20px 0;display: grid;grid-template-columns: 1fr 1fr;}
.description__text {text-align: start;margin-bottom: 5px;font-weight: 600;}
.product__img {position: relative;}
.product__img img {width: 100%;height: 400px;}
.product__box {border: 1px solid #f0f0f0;grid-template-rows: 10fr 1fr 1fr;}
.product__title {padding: 5px;}
.product__content {display: flex;padding: 5px;justify-content: space-between;}
.flex__wrap {display: flex;justify-content: center;gap: 20px;}
.edit__intpu__btn {display: grid;justify-content: center;text-align: center;width: 100%;cursor: pointer;height: 30px;line-height: 2;border-radius: 4px;border: solid 1px #000;color: #000;}

/*--------------- 저장버튼 -------------------------*/
.apply__btn__wrap {display: flex;position: sticky;top: 0;justify-content: center;margin: 20px 0;gap: 20px;}
.temp__apply__btn {cursor: pointer;display: flex;align-items: center;justify-content: center;width: 270px;border-radius: 2px;color: #fff;padding: 10px;background-color: rgb(135, 135, 135);height: 36px;}
.apply__btn {cursor: pointer;display: flex;align-items: center;justify-content: center;width: 270px;border-radius: 2px;color: #fff;padding: 10px;background-color: #140f82;height: 36px;}
.reset__btn {cursor: pointer;display: flex;align-items: center;justify-content: center;width: 270px;border-radius: 2px;padding: 10px;border: solid 1px #707070;height: 36px;}
.edit__input__box {display: grid;justify-content: center;row-gap: 10px;margin: 20px 0;}
.edit__input {display: flex;gap: 20px;}
.temp__btn {text-align: center;cursor: pointer;height: 30px;padding: 0 10px;border: 1px solid #000;border-radius: 5px;line-height: 2;color: #000;}
.preview__call__btn {text-align: center;cursor: pointer;height: 30px;padding: 0 10px;border: 1px solid #000;border-radius: 5px;line-height: 2;color: #000;}
.product__call__btn {text-align: center;cursor: pointer;width: 130px;height: 30px;padding: 0 10px;border: 1px solid #000;border-radius: 5px;line-height: 2;color: #000;}
.remove__btn {position: absolute;text-align: right;top: 15px;right: 15px;cursor: pointer;-moz-transform: scale(0);-webkit-transform: scale(0);-o-transform: scale(0);-ms-transform: scale(0);transform: scale(0);}
.product__img:hover>.remove__btn {-moz-transform: scale(1);-webkit-transform: scale(1);-o-transform: scale(1);-ms-transform: scale(1);transform: scale(1);}
.collaboration__wrap {grid-template-rows: 400px;align-items: center;display: grid;grid-template-columns: 1fr 1fr;text-align: center;}
.collaboration__wrap.preview {grid-template-rows: 200px;align-items: center;display: grid;grid-template-columns: 1fr 1fr;text-align: center;}
.next__colabo__img {width: 100%;}

/* 파일 */
input[type=file]::file-selector-button {width: 100px;height: 30px;background: #fff;border: 1px solid #4d4d4d;border-radius: 10px;cursor: pointer;margin: 0 10px;}
input[type=file]::file-selector-button:hover {background: #4d4d4d;color: #fff;}
.img__row{display: flex;}
.removeImg{color: #fff;border: 1px solid #000;border-radius: 4px;text-align: center;width: 30px;height: 30px;}
.img__wrap{list-style: none;padding-left:0px;}
.img__wrap li{display: flex;padding: 10px 0;}
.page__wrap__old {width: 100%;display: grid;grid-template-columns: 2fr 500px;column-gap: 10px;}
.page__wrap table td{height:180px;padding:10px;vertical-align: top;}
.page__wrap .rd__square{margin-right:40px;}
.page__wrap .btn{margin-left: 20px;}
.page__wrap .temp__btn{margin-left: 50px;}
.page__wrap .action__area{display:flex;justify-content: space-between;}
.page__wrap .action__area .left__area{display:flex;justify-content: center;}
.page__wrap .action__area .right__area{display:flex;justify-content: center;}
.page__wrap .image{display:grid;grid-template-columns: 50% 50%;padding:20px;}
.page__wrap .image__type{display:grid;grid-template-columns:100px 1fr;}
.page__wrap .thumbnail img, .page__wrap .thumbnail video{max-height:150px;}
.page__wrap .contents img, .page__wrap .contents video{max-height:220px;}
.regist__wrap .info{display:flex;padding:20px;margin-top:20px;align-items: center;}
.regist__wrap .info span{margin-right:20px;}
.regist__wrap .info input[type="text"]{width:30%;max-width:400px;border: solid 1px #bfbfbf;height:28px;}
.regist__wrap .info button{margin-left:20px;}
.regist__wrap .table__wrap table{width:350px;margin-top:40px;}

#loading_img {position:absolute;width:75px;height:75px;z-index:9999;filter:alpha(opacity=50);opacity:alpha*0.5;margin:auto;padding:0;}
</style>

<?php include_once("check.php"); ?>

<?php
	function getUrlParamter($url, $sch_tag) {
		$parts = parse_url($url);
		parse_str($parts['query'], $query);
		return $query[$sch_tag];
	}
	
	$page_url = $_SERVER['REQUEST_URI'];
	$page_idx = getUrlParamter($page_url, 'page_idx');
?>

<div class="content__card url__wrap">
	<div class="card__header">  
		<div class="flex justify-between">
			<h3>런웨이 정보</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="content__wrap grid__half">
			<div class="half__box__wrap">
				<div class="content__title"><h4>이름</h4></div>
				<div class="content__row">
					<span id="page_title"></span>
				</div>
			</div>
			<div class="half__box__wrap">
				<div class="content__title"><h4>적용몰</h4></div>
				<div class="content__row">
					<span id="country"></span>
				</div>
			</div>
		</div>
		<div class="content__wrap grid__half">
			<div class="half__box__wrap">
				<div class="content__title"><h4>URL</h4></div>
				<div class="content__row">
					<span id="page_url"></span>
				</div>
			</div>
			<div class="half__box__wrap">
				<div class="content__title"><h4>비고</h4></div>
				<div class="content__row">
					<span id="page_memo"></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="content__card regist__wrap">
	<div class="card__header">  
		<div class="flex justify-between">
			<h3>런웨이 상품 등록</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="content__wrap">
			<div class="content__title">
				런웨이 상품 검색
			</div>
			<div class="content__row">
				<div class="btn" onClick="openRunwayProductModal();">상품검색</div>
			</div>
		</div>
		
		<div id="runway_product_wrap">
			
		</div>
	</div>
</div>

<div class="content__card regist__wrap">
	<div class="card__header">  
		<div class="flex justify-between">
			<h3>런웨이 등록</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="content__wrap">
			<div class="content__title">
				서버경로
			</div>
			<div class="content__row">
				<input id="ftp_dir" type="text" name="ftp_dir" placeholder="/ader_prod_img/posting/runway" style="padding-left:5px;">
				<button class="btn image_check_btn" chk-flg="false" onclick="checkFtpImg()">체크</button>
				<button class="btn" onclick="addRunwayImg()">등록</button>
			</div>
		</div>
		<div class="table__wrap runway__image__cnt" >
			<table>
				<colgroup>
					<col width="30%">
					<col width="30%">
					<col width="40%">
				</colgroup>
				<tr>
					<td rowspan="2">
						<span>썸네일 수량</span>
					</td>
					<td>
						<span >웹</span>
					</td>
					<td>
						<span id="thumb_web_cnt">0개</span>
					</td>
				</tr>
				<tr>
					<td>
						<span>모바일</span>
					</td>
					<td>
						<span id="thumb_mobile_cnt">0개</span>
					</td>
				</tr>
				<tr>
					<td rowspan="2">
						<span>컨텐츠 수량</span>
					</td>
					<td>
						<span>웹</span>
					</td>
					<td>
						<span id="contents_web_cnt">0개</span>
					</td>
				</tr>
				<tr>
					<td>
						<span>모바일</span>
					</td>
					<td>
						<span id="contents_mobile_cnt">0개</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="content__card page__wrap">
	<div class="card__header">  
		<div class="flex justify-between">
			<h3>런웨이 목록</h3>
		</div>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table__wrap">
			<table id="result_table">
				
			</table>
		</div>
	</div>
</div>

<script>
let page_idx = "<?=$page_idx?>";
$(document).ready(function(){
	getRunwayInfoList();
	
	$('input[name="ftp_dir"]').keyup(function(){
		$('.image_check_btn').attr('chk-flg', 'false');
	})
})
	
function getRunwayInfoList(){
	let result_table = $('#result_table');
	result_table.html('');
	
	$.ajax({
		type: "post",
		data: {
				'page_idx' : page_idx,
				'size_type' : 'W'
			},
		dataType: "json",
		url: config.api + "display/posting/runway/list/get",
		error: function(d) {
			alert(d.msg);
		},
		success: function(d) {
			if(d.code == 200){
				let page_info = d.page_info;
				$('#page_title').text(page_info.page_title);
				$('#country').text(page_info.country);
				$('#page_url').text(page_info.page_url);
				$('#page_memo').text(page_info.page_memo);
				
				let data = d.data;
				if (data != null) {
					$('#result_table').html('');
					
					var strDiv = "";
					data.forEach(function (row){
						let thumb_type = row.thumb_type;
						let thumb_tag = "";
						if (thumb_type == 'IMG') {
							thumb_tag = '<img src="' + row.thumb_location + '" alt="">';
						} else if (thumb_type == 'VID') {
							thumb_tag = '<video src="' + row.thumb_location + '" loop="" autoplay="" muted="" playsinline=""></video>';
						}
						
						var contents_type = row.contents_type;
						let contents_tag = "";
						if (contents_type == 'IMG') {
							contents_tag = '<img src="' + row.contents_location + '" alt="">';
						} else if (contents_type == 'VID') {
							contents_tag = '<video src="' + row.contents_location + '" loop="" autoplay="" muted="" playsinline=""></video>';
						}
						
						strDiv += '<tr class="tr_runway">';
						strDiv += '	<td>';
						strDiv += '		<div class="action__area">';
						strDiv += '			<div class="left__area">';
						strDiv += '				<label class="rd__square">';
						strDiv += '					<input type="radio" name="size_type_' + row.display_num + '" display_num="' + row.display_num + '" value="W" checked="checked" onchange="convertSizeType(this)">';
						strDiv += '					<div><div></div></div>';
						strDiv += '					<span>웹 버전</span>';
						strDiv += '				</label>';
						strDiv += '				<label class="rd__square">';
						strDiv += '					<input type="radio" name="size_type_' + row.display_num + '" display_num="' + row.display_num + '" value="M" onchange="convertSizeType(this)">';
						strDiv += '					<div><div></div></div>';
						strDiv += '					<span>모바일 버전</span>';
						strDiv += '				</label>';
						strDiv += '			</div>';
						strDiv += '			<div class="right__area">';
						strDiv += '				<div class="btn" onclick="checkRunwayDisplayNum(this)" display_num="' + row.display_num + '"  action_type="up">';
						strDiv += '					<i class="xi-angle-up"></i>';
						strDiv += '					<span class="tooltip top">위로</span>';
						strDiv += '				</div>';
						strDiv += '				<div class="btn" onclick="checkRunwayDisplayNum(this)" display_num="' + row.display_num + '"  action_type="down">';
						strDiv += '					<i class="xi-angle-down"></i>';
						strDiv += '					<span class="tooltip top">아래로</span>';
						strDiv += '				</div>';
						strDiv += '				<button class="btn" display_num="' + row.display_num + '" thumb_idx="' + row.thumb_idx + '" contents_idx="' + row.contents_idx + '" onclick="deleteRunwayImg(this)">삭제</button>';
						strDiv += '			</div>';
						strDiv += '		</div>';
						strDiv += '		<div class="image">';
						strDiv += '			<div class="image__type thumbnail" >';
						strDiv += '				<div>';
						strDiv += '					썸네일';
						strDiv += '				</div>';
						strDiv += '				<div>' + thumb_tag + '</div>';
						strDiv += '			</div>';
						strDiv += '			<div class="image__type contents">';
						strDiv += '				<div>';
						strDiv += '					컨텐츠';
						strDiv += '				</div>';
						strDiv += '				<div>' + contents_tag + '</div>';
						strDiv += '			</div>';
						strDiv += '		</div>';
						strDiv += '	</td>';
						strDiv += '</tr>';
					});
					
					result_table.append(strDiv);
				}
			} else {
				alert(d.msg);
				return false;
			}
		}
	});
	
	getRunwayProductList(page_idx);
}

function getRunwayProductList(page_idx) {
	let div_wrap = $('#runway_product_wrap');
	
	$.ajax({
		type: "post",
		url: config.api + "display/posting/runway/product/get",
		data: {
			'page_idx' : page_idx
		},
		dataType: "json",
		error: function() {
			alert("런웨이 상품 조회처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				div_wrap.html('');
				
				let data = d.data;
				if (data != null) {
					let strDiv = "";
					data.forEach(function(row) {
						let display_flg = "";
						var display_flg_T = '';
						var display_flg_F = '';
						
						if(row.display_flg == true){
							display_flg = "true";
							display_flg_T = 'checked';
						} else{
							display_flg = "false";
							display_flg_F = 'checked';
						}

						let soldout_flg = "";
						var sold_out_flg_T = '';
						var sold_out_flg_F = '';
						
						if(row.sold_out_flg == true){
							soldout_flg = "true";
							sold_out_flg_T = 'checked';
						} else{
							soldout_flg = "false";
							sold_out_flg_F = 'checked';
						}

						strDiv += '<div class="table table__wrap runway__item" style="width:48%;float:left;border:1px solid #bfbfbf;border-radius:5px;margin-right:15px;padding:15px;">';
						strDiv += '    <input class="e_product_idx" type="hidden" value="' + row.e_product_idx + '">';
						strDiv += '    <div>';
						strDiv += '        <h4>' + row.product_code + '</h4>';
						strDiv += '        <div class="drive--x"></div>';
						strDiv += '    </div>';

						strDiv += '    <div class="btn" onclick="checkProductDisplayNum(\'up\',' + row.e_product_idx + ',' + row.display_num + ')">';
						strDiv += '        <i class="xi-angle-up"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';
						strDiv += '    <div class="btn" onclick="checkProductDisplayNum(\'down\',' + row.e_product_idx + ',' + row.display_num + ')"">';
						strDiv += '        <i class="xi-angle-down"></i>';
						strDiv += '        <span class="tooltip top">위로</span>';
						strDiv += '    </div>';

						strDiv += '    <table style="width:100%;margin-top:10px;">';
						strDiv += '        <tr>';
						
						var background_url = "background-image:url('" + row.img_location + "');";

						strDiv += '        <TD rowspan="4" style="padding:15px;text-align:center;>';
						strDiv += '            <div class="product__img__wrap">';
						strDiv += '                <div class="product__img" style="margin:0px;' + background_url + '">';
						strDiv += '                </div>';
						strDiv += '            </div>';
						strDiv += '        </TD>';
						
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>상품명</td>';
						strDiv += '            <td>' + row.product_name + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>이미지</td>';
						strDiv += '            <td>' + row.img_location + '</td>';
						strDiv += '        </tr>';
						strDiv += '        <tr>';
						strDiv += '            <td>상세페이지</td>';
						strDiv += '            <td>/product/detail?product_idx=' + row.product_idx + '</td>';
						strDiv += '        </tr>';
						strDiv += '    </table>';

						strDiv += '    <div style="display:flex;justify-content: space-between;margin-top:10px;">';
						strDiv += '        <div></div>';
						strDiv += '        <div>';
						strDiv += '            <button class="btn" onclick="deleteRunwayProduct(' + row.product_idx + ')">삭제하기</button>';
						strDiv += '        </div>';
						strDiv += '    </div>';

						strDiv += '</div>';
					});
					div_wrap.append(strDiv);
				}
			}
		}
	});
}

function checkProductDisplayNum(action_type,recent_idx,recent_num) {
    item_cnt = $('.runway__item').length;

	if (recent_idx > 0 && recent_num > 0) {
		if (action_type == "up") {
			if (recent_num == 1) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				putDisplayNum(action_type,recent_idx,recent_num);
			}
		} else if (action_type == "down") {
			if (recent_num == item_cnt) {
				alert('진열순서를 변경할 수 없습니다');
				return false;
			} else {
				putDisplayNum(action_type,recent_idx,recent_num);
			}
		}
	} else {
		alert('진열순서 변경 대상을 선택해주세요.');
		return false;
	}
}


function putDisplayNum(action_type,recent_idx,recent_num) {
	$.ajax({
		type: "post",
		url: config.api + "display/posting/runway/product/put",
		data: {
			'display_num_flg': true,
			'action_type': action_type,
			'page_idx': page_idx,
			'recent_idx': recent_idx,
			'recent_num': recent_num
		},
		dataType: "json",
		error: function() {
			alert('런웨이 상품 진열순서 변경처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				getRunwayProductList(page_idx);
			} else {
				alert('진열순서 변경처리에 실패했습니다. 변경하려는 진열순서를 확인해주세요.');
			}
		}
	});
}

function deleteRunwayProduct(product_idx) {
	confirm(
		'선택하신 상품을 런웨이 상품에서 제외하시겠습니까?',
		function(){
			$.ajax({
				type: "post",
				data: {
					'page_idx' : page_idx,
					'product_idx' : product_idx
				},
				dataType: "json",
				url: config.api + "display/posting/runway/product/delete",
				error: function() {
					alert("런웨이 상품 삭제처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert('선택한 런웨이 상품이 삭제되었습니다.');

						getRunwayProductList(page_idx);
					} else {
						alert("런웨이 상품 삭제처리에 실패했습니다. 삭제하려는 런웨이 상품을 확인해주세요.");
					}
				}
			});
		}
	);
}

function openRunwayProductModal() {
	modal('/put','page_idx=' + page_idx)
}

function checkFtpImg(){
	var ftp_dir = $('#ftp_dir').val();

	if(ftp_dir == null || ftp_dir.length == 0){
		alert('FTP 서버경로를 기입해주세요');
		return false;
	}
	
	$.ajax({
		type: "post",
		data: {'ftp_dir' : ftp_dir},
		dataType: "json",
		url: config.api + "display/posting/runway/check",
		error: function() {
			alert('ftp 런웨이 이미지 체크처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if(d.code == 200){
				var data = d.data;
				
				if(data != null){
					$('#thumb_web_cnt').text(data.thumb_web_cnt + '개');
					$('#thumb_mobile_cnt').text(data.thumb_mobile_cnt + '개');
					$('#contents_web_cnt').text(data.contents_web_cnt + '개');
					$('#contents_mobile_cnt').text(data.contents_mobile_cnt + '개');
					
					$('.image_check_btn').attr('chk-flg', 'true');
				} else {
					$('#thumb_web_cnt').text('0개');
					$('#thumb_mobile_cnt').text('0개');
					$('#contents_web_cnt').text('0개');
					$('#contents_mobile_cnt').text('0개');
					
					$('.image_check_btn').attr('chk-flg', 'true');
				}
			} else {
				alert(d.msg);
				return false;
			}
		}
	});
}
function addRunwayImg(){
	confirm('이전의 사진은 모두 삭제 됩니다. 새로 등록하시겠습니까?', function (){
		var ftp_dir = $('input[name="ftp_dir"]').val();
		var chk_flg = $('.image_check_btn').attr('chk-flg');

		if(chk_flg == 'false'){
			alert('경로체크를 먼저 진행해주세요');
			return false;
		}
		$.ajax({
			type: "post",
			data: {'ftp_dir' : ftp_dir, 'page_idx': page_idx},
			dataType: "json",
			url: config.api + "display/posting/runway/add",
			error: function() {
				alert('FTP 서버 내 런웨이 이미지 체크작업이 실패했습니다.');
			},
			beforeSend: function(){
				loadingWithMask('/images/default/loading_img.gif');
			},
			success: function(d) {
				if(d.code == 200){
					closeLoadingWithMask();
					
					alert('런웨이가 등록됬습니다.', getRunwayInfoList());
				} else {
					closeLoadingWithMask();
					
					alert(d.msg);
				}
			}
		});
	})
}

function checkRunwayDisplayNum(obj) {
	var display_num_max = $('.tr_runway').length;
	var action_type = $(obj).attr('action_type');
	var num = $(obj).attr('display_num');

	if (action_type == "up") {
		if (num == 1) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('up',num,page_idx);
		}
	} else if (action_type == "down") {
		if (num == display_num_max) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('down',num,page_idx);
		}
	}
}

function updateDisplayNum(action, num, idx){
	$.ajax({
		url: config.api + "display/posting/runway/put",
		type: "post",
		data: {
			'recent_idx': idx,
			'recent_num': num,
			'action_type': action
		},
		dataType: "json",
		error: function() {
			alert('런웨이 순서번경 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			getRunwayInfoList();
		}
	})
}
function deleteRunwayImg(obj){
	var display_num = $(obj).attr('display_num');
	var thumb_idx = $(obj).attr('thumb_idx');
	var contents_idx = $(obj).attr('contents_idx');


	$.ajax({
		url: config.api + "display/posting/runway/delete",
		type: "post",
		data: {
			'page_idx': page_idx,
			'display_num': display_num,
			'thumb_idx': thumb_idx,
			'contents_idx': contents_idx
		},
		dataType: "json",
		error: function() {
			alert('런웨이 썸네일/컨텐츠 삭제 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if(d.data.max_display_num > 0){
				$('#display_num_max').val(d.data.max_display_num);
			}
			getRunwayInfoList();
		}
	})
}

function convertSizeType(obj){
	var display_num = $(obj).attr('display_num');
	var size_type = $(obj).val();

	$.ajax({
		url: config.api + "display/posting/runway/get",
		type: "post",
		data: {
			'page_idx': page_idx,
			'display_num': display_num,
			'size_type': size_type
		},
		dataType: "json",
		error: function() {
			alert('런웨이 썸네일/컨텐츠 이미지 불러오기 중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.data != null) {
				var data = d.data[0];
				$(obj).parents('td').find('.image__type.thumbnail img').attr('src',data.thumb_location);
				$(obj).parents('td').find('.image__type.thumbnail video').attr('src',data.thumb_location);
				$(obj).parents('td').find('.image__type.contents img').attr('src',data.contents_location);
				$(obj).parents('td').find('.image__type.contents video').attr('src',data.contents_location);
			} else {
				alert('선택한 사이즈의 사진정보가 없습니다.');
			}
		}
	})
}

function loadingWithMask(gif) {
	var maskHeight = $(document).height();
	var maskWidth  = window.document.body.clientWidth;
	var top = 0;
	var left = 0;

	top = ( $(window).height()) / 2 + $(window).scrollTop();
	left = ( $(window).width()) / 2 + $(window).scrollLeft();

	//화면에 출력할 마스크를 설정해줍니다.
	var mask	   = "<div id='mask_loading' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
	
	let strDiv = "";
	strDiv += '<div id="loading_img">';
	strDiv += '	<img src="' + gif + '" style="width:75px; height:75px;"/>';
	strDiv += '</div>';

	$('body').append(mask);
	$('body').append(strDiv);
	
	$('#loading_img').css('top',top);
	$('#loading_img').css('left',left);

	$('#mask_loading').css({'width' : maskWidth,'height': maskHeight,'opacity' : '0.5'}); 

	$('#mask_loading').show();
	$('#loading_img').show();
}

function closeLoadingWithMask() {
    $('#mask_loading, #loading_img').hide();
    $('#mask_loading, #loading_img').empty();  
}
</script>