<?php
/*
 +=============================================================================
 | 
 | FAQ 내용
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016. 8. 3
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../../../_resource/head.php';

$total = db_count($_TABLE['SITE_FAQ'],'CATEGORY="'.$cat.'"');

if($total > 0) {
?>
<ul class="dragable-vertical" id="faq-list-body">
	<?php
	if(DBMS == 'MYSQL' || DBMS == 'MYSQLi') {
		$query  = 'SELECT * FROM '.$_TABLE['FAQ'];
		$query .= ' WHERE CATEGORY="'.$cat.'"';
		$query .= ' ORDER BY SEQ,IDX';
	}
	$sql = db_query($query);
	while($data = db_array($sql)) {
		$no = $data['IDX'];
		$cat = $data['CATEGORY'];
		$question = $data['QUESTION'];
		$answer = $data['ANSWER'];
		$num++;
	?>
	<li data-index="<?=$no?>">
		<dl class="accordion white">
			<dt>
				<a><?=$question?></a>
				<div class="tools">
					<a onClick="modal('site/faq/add','no=<?=$no?>');" data-tooltip="수정"><i class="icon-note"></i></a>
					<a class="btn-popover" data-popover="delete" data-popover-confirm="customer/del" data-popover-query="no=<?=$no?>" data-target="list" data-url="customer/faq-list" data-query="cat=<?=$cat?>" data-tooltip="삭제"><i class="fa fa-trash" data-caption="삭제"></i></a>
					<a style="margin-left:10px"><i class="fa fa-arrows-v cursor-move" data-caption="순서 이동"></i></a>
				</div>
			</dt>
			<dd class="close"><?=$answer?></dd>
		</dl>
	</li>
	<? } ?>
</ul>

<script>
$( ".dragable-vertical" ).sortable({
	connectWith: ".dragable-vertical",
	items: "li:not(.disabled)",
	cancel: ".disabled",
	handle: ".cursor-move",
	placeholder: "accordion-placeholder",
	update: function (event, ui) {
		var idxs = "";
		$("#list li").each(function() {
			if($(this).attr("data-index") != undefined) {
				if(idxs != "") idxs += ",";
				idxs += $(this).attr("data-index");
			}
		});

		// 정리된 순서를 db에 업데이트
		$.ajax({
			type: "post",  
			dataType: "json",
			url: "modules/site/faq/?m=seq",
			data: "seq=" + idxs + "&cat=<?=$cat?>",
			success: function(d) {
				loading_stop();
				if(d.code == 200) {
					// 토스트 메시지 띄움
					toast("<?=$_CODE[202][LANGUAGE]?>");
				}
				else {
					modal_alert("<?=$_CODE[000][LANGUAGE]?>",d.msg,1);
				}
			},
			error: function() {
				loading_stop();
				modal_alert("<?=$_CODE[000][LANGUAGE]?>","<?=$_CODE[999][LANGUAGE]?>",1);
			}
		});

	}
});
</script>

<?php
}
else {
?>
<div class="noitem">
	<i class="xi-file-o"></i><br>
	작성된 항목이 없습니다
</div>
<?php
}
?>