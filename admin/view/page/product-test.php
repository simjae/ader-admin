<div class="content__card">
	<form id="frm-filter" action="product/get">
		<textarea type="text" name="img_url" style="width:100%;height:250px;"></textarea>
		<div id="button" style="width:100px;height:30px;border:1px solid #000000;cursor:pointer;">test</div>
	</form>
</div>

<script>
$(document).ready(function() {
	$('#button').click(function() {
		var formData = $('#frm-filter').serializeObject();
		
		$.ajax({
			type: "post",
			data:formData,
			dataType: "json",
			url: config.api + "/put",
			error: function() {
				alert('ERROR!');
			},
			success: function(d) {
				if(d.code == 200) {
					console.log(d);
				}
			}
		});
	});
});
</script>
