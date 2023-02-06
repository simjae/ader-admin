<div class="body">
	<h1>
		FAQ 카테고리 추가
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
    <input type="hidden" id="faq_country" value="<?=$country?>">
	<div class="content__card" style="width:100%;margin: 0;">
		<form id="frm-add" action="page/board/faq/category/add">
            <div class="card__body">
                <!--
                <div class="content__wrap">
                    <div class="content__title">국가</div>
                    <div class="content__row">
                        <select name="country" id="country" style="width:163px;">
                            <option value="">국가 선택</option>
                            <option value="KR">한국몰</option>
                            <option value="EN">영문몰</option>
                            <option value="CN">중국몰</option>
                        </select>
                    </div>
                </div>
                -->
                <div class="content__wrap">
                    <div class="content__title">카테고리 입력</div>
                    <div class="content__row">
                        <div class="rd__block">
                            <input type="radio" id="category_add" class="radio__input category_flg" value="true" name="category_flg" checked>
                            <label for="category_add">신규 카테고리 생성</label>
                            
                            <input type="radio" id="category_use" class="radio__input category_flg" value="false" name="category_flg">
                            <label for="category_use" style="gap:5px;">기존 카테고리 사용</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title"></div>
                    <div class="content__row">
                        <input type='text' id="title" name="title" value="">
                        <select name="category_idx" id="category_idx" style="width:163px;display:none;">
                            <option value="">카테고리 선택</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card__body subcategory hidden">
                <div class="content__wrap">
                    <div class="content__title">상세 분류 입력</div>
                    <div class="content__row">
                        <input type='text' name="subcategory" value="">
                    </div>
                </div>
            </div>
		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="faqCategoryAddCheck();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	if($(this).prop("checked")) {
		$("#goods-ticket-cnt,#goods-ticket-add-text").removeClass("hidden");
	}
    $('.category_flg').change(function(){
        var val = $(this).val();
        if (val == "true") {
            $('input[name="title"]').show();
            $('#category_idx option:eq(0)').prop("selected", true);
            $('#category_idx').hide();
            $('input[name="subcategory"]').val('');
            $('.subcategory').addClass('hidden');
        } else {
            $('#category_idx').show();
            $('input[name="title"]').val('');
            $('input[name="title"]').hide();
            $('.subcategory').removeClass('hidden');
        }
    });
    $.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "page/board/faq/category/get",
        data: {
            category_idx : 0
        },
		error: function() {
			alert("상세 카테고리 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
                var country = $('#faq_country').val().toUpperCase();
                d.data.forEach(function(row) {
                    if(row.lang == country){
                        $('#category_idx').append(`<option value="${row.idx}">${row.title}</option>`);
                    }  
                })
			}
		}
	});
});

function faqCategoryAddCheck() {
    var category_flg        = $('input[name="category_flg"]:checked').val();
    var title 	            = $('#title');
    var category_idx 		= $('#category_idx');
	var subcategory 		= $('input[name="subcategory"]');

    if(category_flg == 'true'){
        if(title.val().length == 0){
            alert("카테고리를 입력해주세요");
            return false;
        }
    }
    else{
        if(category_idx.val().length == 0){
            alert("카테고리를 선택해주세요");
            return false;
        }
        if(subcategory.val().length == 0){
            alert("상세분류를 입력해주세요");
            return false;
        }
    }
    insertLog("전시관리 > 게시판 관리 ", "FAQ 카테고리 추가 :  [" + title.val() + "]", null);
    modal_submit(null, 'initFaq');
}
</script>
