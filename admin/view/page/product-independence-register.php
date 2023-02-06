<style>
	.checked{background-color:#707070!important;color:#ffffff!important;}
	.unchecked{background-color:#ffffff!important;color:#000000!important;}
	.btn__gray{
		height: 20px;
		color: #fff;
		padding: 3.5px 20px;
		border-radius: 2px;
		background-color: #bfbfbf;
		cursor:pointer;
	}
	.size_textarea{width:90%; height:150px;resize: none;border: solid 1px #bfbfbf;}
</style>
<div class="content__card">
    <div class="card__header">
        <h3>독립몰 상품등록[개인결제]</h3>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <div id="regist_md_tab" class="row regist_tab" style="margin-top:0px;">
            <form id="frm-regist" action="" enctype="multipart/form-data">
				<input type="hidden" name="indp_flg" value="1">
				<div class="content__wrap">
					<div class="content__title">상품명</div>
					<div class="content__row">
						<input type="text" name="product_name">
					</div>
				</div>
            </form>
        </div>
		<div class="flex justify-center">
			<button type="button"
				style="width:130px;height:36px;background-color:#140f82;color:#ffffff;cursor:pointer;margin-top:50px"
				onClick="confirm('상품을 등록하시겠습니까?.','independenceRegist()');">개인결제용 상품등록</button>
		</div>
    </div>
</div>
<script>

$(document).ready(function() {

});
function independenceRegist(){
	var form = $("#frm-regist")[0];
	var formData = new FormData(form);

	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "product/add_new",
		error: function() {
			alert("개인결제용 상품등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('개인결제용 상품등록이 정상적으로 작성되었습니다.',function pageLocation() {
					location.href = '/product/list';
				});
			}
		}
	});
}
</script>