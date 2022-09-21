<?php 
//$data = $db->get($_TABLE['SHOP_GOODS_CATEGORY_CONFIG'],'IDX=?',array($category))[0];
?>
<div class="body">
	<h1>분류 추가 설정<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<div class="form-group">
			<div class="value" id="modal-product-add-category-nav"></div>
			<label class="control-label">분류</label>
		</div>

		<form action="modules/shop/goods/?m=category-config-ext">
		<input type="hidden" name="category" value="<?=$category?>">

		<h2>담당자 통보</h2>
		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="RCV_ORDER" value="Y" <?=(($data['RCV_ORDER']=='Y')?'checked':'')?>>
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">주문/주문 취소</label>
		</div>

		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="RCV_REJECT" value="Y" <?=(($data['RCV_REJECT']=='Y')?'checked':'')?>>
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">환불 요청</label>
		</div>

		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="RCV_PAYMENT" value="Y" <?=(($data['RCV_PAYMENT']=='Y')?'checked':'')?>>
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">결제 완료</label>
		</div>

		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="RCV_SOLDOUT" value="Y" <?=(($data['RCV_SOLDOUT']=='Y')?'checked':'')?>>
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">품절시</label>
		</div>

		<div class="form-group">
			<textarea name="EMAIL"><?=$data['EMAIL']?></textarea>
			<label class="control-label">통보 이메일</label>
		</div>

		<div class="form-group">
			<textarea name="EMAIL"><?=$data['MOBILE']?></textarea>
			<label class="control-label">통보 연락처</label>
		</div>

		</form>
	</div>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="modal_submit();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
$(document).ready(function() {
	var f = $("form").last();
	$.post(config.api + 'shop/goods/category/node',{ category : $(f).find("input[name='category']").val() },
		function(d) {
			$("#modal-product-add-category-nav").empty();
			$("#modal-product-add-category-nav").append("<i class='xi-cart'></i>");
			for(var i=d.data.length-1 ; i >=0 ; i--) {
				$("#modal-product-add-category-nav").append("<i class='xi-angle-right-min'></i>");
				$("#modal-product-add-category-nav").append(d.data[i].title);
			}
		}
	,'json');
});
</script>