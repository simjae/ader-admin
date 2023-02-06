<div class="filter-wrap" style="margin-bottom:20px">
	<button class="voucher_tab_btn tap__button" tab_num="01"
		style="background-color:#000;color:#fff;font-weight:500;width:180px;"
		onClick="voucherTabBtnClick(this);">발행</button>
	<button class="voucher_tab_btn tap__button" tab_num="02" style="width:180px;"
		onClick="voucherTabBtnClick(this);">발급</button>
	<button class="voucher_tab_btn tap__button" tab_num="03" style="width:180px;" onClick="voucherTabBtnClick(this);">생일
		바우처 발급</button>
</div>
<input id="tab_num" type="hidden" value="01">

<div id="voucher_tab_01" class="voucher_tab">
	<?php include_once("member-voucher-publish.php"); ?>
</div>
<div id="voucher_tab_02" class="voucher_tab" style="display:none;">
	<?php include_once("member-voucher-issue.php"); ?>
</div>
<div id="voucher_tab_03" class="voucher_tab" style="display:none;">
	<?php include_once("member-voucher-birth.php"); ?>
</div>
<script>
	$(document).ready(function () {
	});

	function voucherTabBtnClick(obj) {
		var tabTitle = $(obj).text();
		$('#tabTitle').text(tabTitle);

		var tab_num = $(obj).attr('tab_num');
		$('#tab_num').val(tab_num);
		$('.voucher_tab').hide();
		$('#voucher_tab_' + tab_num).show();

		$(obj).css('background-color', '#000000');
		$(obj).css('color', '#ffffff');

		$('.voucher_tab_btn').not($(obj)).css('background-color', '#ffffff');
		$('.voucher_tab_btn').not($(obj)).css('color', '#000000');
	}
	function setPaging(obj) {
		var list_type = $(obj).attr('list_type');
		var total_cnt = $(obj).parent().find('.total_cnt');
		var result_cnt = $(obj).parent().find('.result_cnt');

		var parent_obj = '';
		if (list_type != null) {
			if (list_type == 'publish') {
				parent_obj = $('#frm-list');
			}
			else if (list_type == 'issue') {
				parent_obj = $('#frm-detail-list');
			}
			else if (list_type == 'birth_publish') {
				parent_obj = $('#frm-birth-list');
			}
			else if (list_type == 'birth_issue') {
				parent_obj = $('#frm-birth-detail-list');
			}
			else if (list_type == 'member') {
				parent_obj = $('#frm-member-list');
			}
		}
		parent_obj.find('.cnt_total').text(total_cnt.val());
		parent_obj.find('.cnt_result').text(result_cnt.val());
	}
</script>