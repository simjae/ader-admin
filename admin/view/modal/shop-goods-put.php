<div class="body">
	<h1>상품 추가<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="shop/goods/put">
			<input type="hidden" name="category_no" value="<?=$category_no?>">
			<input type="hidden" name="ware_category_no">

			<div class="form-group">
				<div class="value" id="modal-product-add-category-nav"></div>
				<label class="control-label">분류</label>
			</div>

			<div class="relation-goods">
				<div id="category-tree-modal"></div>
				<table class="list width-100p">
				<thead>
					<tr>
						<th><label class="checkbox-all-toggle"><input type="checkbox"><i></i></label></th>
						<th style="width:80px">이미지</th>
						<th>상품</th>
					</tr>
				</thead>
				<tbody id="modal-goods-list">
					<tr>
						<td colspan="3" class="nodata"><i class="xi-ban"></i><br>등록된 제품이 없습니다.</td>
					</tr>
				</tbody>
				</table>
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
	$(f).submit(function() {
		modal_submit();
		return false;
	});
	$(f).find(".checkbox-all-toggle").click(function() {
		var val = $(this).find("input").prop("checked");
		$("#modal-goods-list").find("input[name='ware_no[]']").prop("checked",val);
	});

	$.post(config.api + 'shop/goods/category/node','category=' + $("form").last().find("input[name='category_no']").val(),
		function(d) {
			$("#modal-product-add-category-nav").empty();
			$("#modal-product-add-category-nav").append("<i class='xi-cart'></i>");
			for(var i=d.data.length-1 ; i >=0 ; i--) {
				$("#modal-product-add-category-nav").append("<i class='xi-angle-right-min'></i>");
				$("#modal-product-add-category-nav").append(d.data[i].title);
			}
		}
	,'json');

	$('#category-tree-modal').jstree({
		'core' : {
			'data' : {
				'url' : config.api + 'shop/warehouse/category/get',
				'dataType' : "json"
			},
			'strings' : { 'loading' : "데이터 로딩중입니다.", 'New node' : "새 분류" },
			'check_callback' : function(o, n, p, i, m) {
				return true;
			},
			'themes' : {
				'responsive' : false,
				'variant' : 'small',
				'stripes' : true
			}
		},
		'sort' : function(a, b) {
			return this.get_type(a) === this.get_type(b) ? (this.get_text(a) > this.get_text(b) ? 1 : -1) : (this.get_type(a) >= this.get_type(b) ? 1 : -1);
		},
		'types' : {
			'default' : { 'icon' : 'folder' },
			'file' : { 'valid_children' : [], 'icon' : 'file' }
		},
		'plugins' : ['state','types']
	})
	.on('changed.jstree', function (e, data) {
		if(data && data.selected && data.selected.length) {
			$(f).find("input[name='ware_category_no']").val(data.node.original.no);

			$.ajax({
				url: config.api + "shop/warehouse/get",
				data: {
					category_no : data.node.original.no
				},
				error: function() {
					alert("데이터를 불러들이는데 실패하였습니다.");
				},
				success: function(d) {
					var html = "";
					var display;

					if(d.total > 0) {
						for(var i=0;i<d.data.length;i++) {
							var checked = false;
							if(d.data[i].goods_category.no != null) {
								for(var j=0;j<d.data[i].goods_category.no.length;j++) {
									if(d.data[i].goods_category.no[j] === parseInt($(f).find("input[name='category_no']").val())) {
										checked = true;
										break;
									}
								}
							}
							html += '<tr>'
							     +  '	<td><label><input type="checkbox" name="ware_no[]" value="' + d.data[i].no + '" '
								 +  '		' + ((checked)?'checked':'') + '><i></i></label></td>'
							     +  '	<td><img src="' + d.data[i].images.list.pc[0].url + '"></td>'
							     +  '	<td>'
								 +  '		' + d.data[i].name
								 +  '		<br><small class="label-sticker bg-blue">' + d.data[i].barcode + '</small>'
								 +  '		<small class="label-sticker">' + d.data[i].color.name + '</small>'
							     +  '	</td>'
							     +  '</tr>';
						}
					}
					else {
						html += '<tr>';
						html += '	<td colspan="3" class="nodata"><i class="xi-ban"></i>검색된 상품이 없습니다.</td>';
						html += '</tr>';
					}
					$("#modal-goods-list").html(html);
				}
			});
		}
	});
});

</script>