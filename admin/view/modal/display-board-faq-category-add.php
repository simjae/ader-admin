<div class="body">
	<h1>
		FAQ 카테고리 추가
		<a onclick="modal_close();" class="btn-close">
			<i class="xi-close"></i>
		</a>
	</h1>
    
	<div class="content__card" style="width:100%;margin: 0;">
		<form id="frm-add" action="page/board/faq/category/add">
            <input type="hidden" name="category_idx" value="<?=$category_idx?>">
            <div class="card__body">
                <div class="content__wrap">
                    <div class="content__title">분류</div>
                    <div class="content__row">
<?php 
                        $get_category_sql = "
                            SELECT
                                IDX,
                                TITLE
                            FROM
                                dev.FAQ_CATEGORY
                            WHERE
                                IDX = ".$category_idx."
                        ";

                        $db->query($get_category_sql);
                        
                        $parent_idx = 0;
                        foreach($db->fetch() as $data){
                            $parent_idx = $data['IDX'];
                        
?>
                        <input type='text' value="<?=$data['TITLE']?>" disabled>
                        <input type='hidden' name="parent_idx" value="<?=$data['IDX']?>" disabled>
<?php 
                        }
?>
                    </div>
                </div>
            </div>
            <div class="card__body subcategory">
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
});

function faqCategoryAddCheck() {
    confirm('상세분류를 추가하시겠습니까?',function(){
        var category_idx 		= $('#frm-add').find('input[name="category_idx"]').val();
        var subcategory 		= $('#frm-add').find('input[name="subcategory"]').val();

        if(subcategory.length == 0){
            alert("상세분류명을 입력해주세요");
            return false;
        }
        $.ajax({
			type: "post",
			data: { 'category_idx': category_idx,
                    'subcategory' : subcategory },
			dataType: "json",
			url: config.api + "page/board/faq/category/add",
			error: function() {
				alert("FAQ 삭제작업이 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("전시관리 > 게시판 관리 ", "FAQ 카테고리 추가 :  [" + subcategory + "]", null);
					alert("FAQ 상세분류 추가작업에 성공했습니다.",function(){
                        initFaq();
                        modal_close();
                    });
				}
			}
		});
    });
	
}
</script>
