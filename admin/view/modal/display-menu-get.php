<div class="content__card" style="margin: 0;">
	<form id="frm-put" action="display/menu/put">
		<div class="card__header">
			<div class="flex justify-between">
				<h3>메뉴 모달</h3>
				<a href="javascript:;" style="cursor:pointer;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="modal__title">카테고리 설정</div>
			<div class="munu__input__wrap">
				<label for="">분류명<input type="text" name="menu_title" placeholder="분류명"></label>
				<label for="">분류URL<input type="text" name="menu_url" placeholder="URL"></label>
			</div>
			<div class="munu__type__wrap">
				<label for=""><input id="menu_type_true" style="width:5%;" type="radio" name="munu_type" value="PRODUCT">상품</label>
				<label for=""><input id="menu_type_false" style="width:5%;" type="radio" name="munu_type" value="POSTING">포스팅</label>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onclick="applyBtn();"><span>저장</span></div>
					<div class="defult__color__btn"  onclick="modal_close();"><span>작성 취소</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<script>
$(document).ready(function() {
	getModalData();
});

function getModalData(){
	let getTitle = $('.checked').attr('data-title');
	let getType = $('.checked').attr('data-type');
	let getUrl = $('.checked').attr('data-url');
	$("input[name='menu_title']").val(getTitle);
	$("input[name='menu_url']").val(getUrl);
	
	let tableType = "<?=$table_type?>";
	if(getType == 'PRODUCT') {
		$('#menu_type_true').prop('checked',true);
	} else if (getType == 'POSTING') {
		$('#menu_type_false').prop('checked',true);
	}
	if(tableType == "SML") {
		$('.munu__type__wrap').hide();
	} else {
		$('.munu__type__wrap').show();
	}

	
	// $.ajax({
	// 	type: "post",
	// 	data: {
	// 		"menu_idx":"<?=$menu_idx?>",
	// 		"tmp_flg":"<?=$tmp_flg?>",
	// 		"table_type":tableType
	// 	},
	// 	dataType: "json",
	// 	url: config.api + "menu/get",
	// 	error: function() {
	// 		alert("메뉴 정보 불러오기 처리에 실패했습니다.");
	// 	},
	// 	success: function(data) {
	// 		if(data.code == 200) {
	// 			$("input[name='menu_idx']").val(data['data'][0].menu_idx);
	// 			$("input[name='menu_title']").val(data['data'][0].menu_title);
	// 			$("input[name='menu_url']").val(data['data'][0].menu_url);

	// 			let menuType =  data['data'][0].menu_type;
	// 			if(menuType == 'PRODUCT') {
	// 				$('#menu_type_true').prop('checked',true);
	// 			} else if (menuType == 'POSTING') {
	// 				$('#menu_type_false').prop('checked',true);
	// 			}
	// 			if(tableType == "SML") {
	// 				$('.munu__type__wrap').hide();
	// 			} else {
	// 				$('.munu__type__wrap').show();
	// 			}
	// 		}
	// 	}
	// });

	
}


function applyBtn(){
	let tableType = "<?=$table_type?>";
	let menu_title = $("input[name='menu_title']").val();
	let menu_url = $("input[name='menu_url']").val();
	if(tableType  == "SML"){
		menu_type = "PRODUCT"
	} else {
		menu_type = $("input[name='munu_type']:checked").val(); 
	}		

	$('.checked').find('.title').text(menu_title);
	$('.checked').attr('data-title',menu_title);
	$('.checked').attr('data-type',menu_type);
	$('.checked').attr('data-url',menu_url);
	modal_close();
	// $.ajax({
	// 	type:"post", 
	// 	data:{
	// 		"menu_idx":"<?=$menu_idx?>",
	// 		"tmp_flg":"<?=$tmp_flg?>",
	// 		"table_type":"<?=$table_type?>",
	// 		"menu_title":menu_title,
	// 		"menu_url":menu_url,
	// 		"menu_type" : menu_type
	// 	},
	// 	dataType: "json",
	// 	url: config.api + "menu/put",
	// 	error: function() {
	// 		alert("메뉴 수정 처리에 실패했습니다.");
	// 	},
	// 	success: function(data) {
	// 		if(data.code == 200) {
	// 			$('.checked').find('.title').text(menu_title);
	// 			modal_close();
	// 		}
	// 	}

	// });
}
</script>


