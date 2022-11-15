<style>
	.wrap__bg--wh{
		background-color: #fff;
		padding: 10px;
		margin: 10px 0;
	}
	.product-tree {
		display: grid;
		gap: 20px;
		grid-template-columns: 400px 2fr;
	}
	
	.tree__chart h3 {
		line-height: 2;
	}

	.tree__desciption h3 {
		line-height: 2;
	}
	.tree__desciption textarea{
		width: 100%;
    	border: 1px solid #c2cad8;
		padding: 5px;
	}

	.tree-btn-wrap {
		display: flex;
		gap: 5px;
	}

	.chart__button__wrap {
		display: flex;
		justify-content: space-between;
		padding: 10px 20px;
		
	}

	.chart__button {
		color: black;
		font-size: 15px;
		border: 1px solid black;
		padding: 5px;
		border-radius: 5px;
	}

	.chart__button--move {
		width: 90px;
		height: 22px;
		border-radius: 2px;
		background-color: #140f82;
		font-size: 12px;
		color: #fff;
		padding: 4px 0;
		text-align: center;
		cursor: pointer;
	}

	#tree--search {
		padding: 10px;
		width: 100%;
	}

	.xi-search {
		padding: 10px;
	}

	#js--tree {
		min-height: 500px;
		max-height: 100%;
		margin: 0 12px 0 12px;
		padding-top: 20px;
		border-top: 1px solid #bfbfbf;
	}
	.desciption__table{
		border-left: solid 1px #ddd;
		border-spacing: 0;
		margin: 0;
		table-layout: fixed;
	}
	.access__ip__wrap{
		display: flex;
		margin-bottom: 10px;
		
	}
	.access__ip--add{
		font-size: 15px;
		padding: 5px;
		border: 1px solid black;
		border-radius: 5px;
		margin-left: 10px;
	}
	.access__apply__btn{
		cursor: pointer;
		font-size: 16px;
		height: 36px;
		width: 130px;
		background-color: #140f82;
		border-radius: 2px;
		font-weight: normal;
		display: flex;
		color: #f5f6fa;
		align-items: center;
		justify-content: center;
		font-weight: normal;
	}
	.access__apply__wrap{
		display: flex;
		justify-content: center;
	    margin-top: 10px;
	}
	.classify__btn{
		width: 70px;
		height: 22px;
		border-radius: 2px;
		text-align: center;
		border: solid 1px #707070;
		background-color: #fff;
		padding: 4px 0;
		font-size: 12px;
		cursor: pointer;
	}
	.search__box{
		display: flex;
		box-shadow: inset 1px 1px 5px 0 rgba(0, 0, 0, 0.16);
	}
</style>

<h2 class="page_title" style="margin-bottom:10px ;">오더시트 분류 관리</h2>
<div class="main-wrap">
	<div class="product-tree">
		<div class="content__card" style="padding: 11px 0 20px 0;">
			<div class="card__header">
				<div class="flex justify-between" style="padding:0 20px;">
					<h3 class="page_sub_title" style="line-height: 2;">분류 설정</h3>
					<div class="search__box">
						<i class="xi-search"></i>
						<input type="text" id="tree--search" placeholder="카테고리를 검색하세요.">
					</div>
				</div>
				<div class="drive--x" style="margin: 0;"></div>
			</div>
			<div class="chart__button__wrap">
				<div style="display: flex; gap: 10px;">
					<div onclick="exCreate();" class="classify__btn">분류추가</div>
					<div onclick="exRename();" class="classify__btn">이름변경</div>
					<div onclick="exDelete();" class="classify__btn">삭제</div>
				</div>
				<div class="chart__button--move" onclick="exMove()">분류이동저장</div>
			</div>
			<div id="js--tree"></div>
		</div>
		<div class="tree__desciption">
			<form id="frm-list" action="pm/ordersheet/list/get">
				<input type="hidden" name="md_category_node" value="">
				<input type="hidden" name="md_category_depth" value="">
				<input type="hidden" name="child_search_flg" value="true">
				<input type="hidden" class="sort_type" name="sort_type" value="DESC">
				<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
				<input type="hidden" class="rows" name="rows" value="10">
				<input type="hidden" class="page" name="page" value="1">
			</form>
			
			
			<div class="content__card">
				<div class="card__header">
					<h3>분류정보</h3>
					<div class="drive--x"></div>
				</div>
				<div class="card__body">
					<div class="table table__wrap">
					<input type="hidden" id="cate_id">
						<table class="desciption__table">
							<tbody>
								<tr>
									<th style="background-color: #fff;width: 130px;text-align: center;">현재분류</th>
									<th style="padding:10px 15px;background-color: #fff;"></th>
								</tr>
								<tr>
									<th style="background-color: #fff;width: 130px;text-align: center;">분류명</th>
									<td><input type="text" value=""></td>
								</tr>
								<tr>
									<th style="background-color: #fff;width: 130px;text-align: center;">분류설명</th>
									<td><textarea name="" id="" cols="30" rows="10"></textarea></td>
								</tr>
							</tbody>
						</table>
						<div class="access__apply__wrap">
							<div class="access__apply__btn" onclick="cateUpdate();" >적용</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content__card">
				<form id="frm-filter" action="">
					<div class="card__header">
						<h3 class="page_list_title" id="category_list"></h3>
						<div class="drive--x"></div>
					</div>
					<div class="card__body">
						<div class="info__wrap " style="justify-content:space-between; align-items: center;">
							<div class="body__info--count">
								<div class="drive--left"></div>
								검색결과 <font class="cnt_result info__count" >0</font>개
							</div>
								
							<div class="content__row">
								<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
									<option value="CREATE_DATE|DESC">등록일 역순</option>
									<option value="CREATE_DATE|ASC">등록일 순</option>
									<option value="UPDATE_DATE|DESC">삭제일 역순</option>
									<option value="UPDATE_DATE|ASC">삭제일 순</option>
									<option value="PRODUCT_NAME|DESC">상품명 역순</option>
									<option value="PRODUCT_NAME|ASC">상품명 순</option>
									<option value="SALES_PRICE_KR|DESC">판매가(힌국몰) 역순</option>
									<option value="SALES_PRICE_KR|ASC">판매가(힌국몰) 순</option>
									<option value="SALES_PRICE_EN|DESC">판매가(영문몰) 역순</option>
									<option value="SALES_PRICE_EN|ASC">판매가(영문몰) 순</option>
									<option value="SALES_PRICE_CN|DESC">판매가(중문몰) 역순</option>
									<option value="SALES_PRICE_CN|ASC">판매가(중문몰) 순</option>
								</select>
								<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
									<option value="10" selected>10개씩보기</option>
									<option value="20">20개씩보기</option>
									<option value="30">30개씩보기</option>
									<option value="50">50개씩보기</option>
									<option value="100">100개씩보기</option>
									<option value="200">200개씩보기</option>
									<option value="300">300개씩보기</option>
									<option value="500">500개씩보기</option>
								</select>
							</div>
						</div>
						
						<div class="table table__wrap">
							<TABLE id="list_table">
								<THEAD>
									<TR>
										<TH style="width:3%;">
											<div class="cb__color">
												<label>
													<input type="checkbox" onClick="selectAllClick(this);">
													<span></span>
												</label>
											</div>
										</TH>
										<TH style="width:5%;">No.</TH>
										<TH>스타일 코드</TH>
										<TH>컬러 코드</TH>
										<TH>상품 코드</TH>
										<TH>상품명</TH>
										<TH style="width:8%;">판매가<br>(한국몰)</TH>
										<TH style="width:8%;">판매가<br>(영문몰)</TH>
										<TH style="width:8%;">판매가<br>(중국몰)</TH>
									</TR>
								</THEAD>
								<TBODY id="result_table">
								</TBODY>
							</TABLE>
						</div>
						<div class="padding__wrap">
							<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
							<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
							<div class="paging"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('#js--tree')
	.jstree({
		core : {
			data : {
				url : config.api + 'product/category/get',
				data : {'tab_num' : '01'},
				dataType : "json"
			},
			'strings' : { 'loading' : "데이터 로딩중입니다.", 'New node' : "새 분류" },
			'check_callback' : function(o, n, p, i, m) {
				
				if(m && m.dnd && m.pos !== 'i') { return false; }
				if(o === "move_node") {
					if(this.get_node(n).parent === this.get_node(p).id) { return false; }
				}
				
				return true;
			},
			'themes' : {
				'responsive' : false,
				'variant' : 'small',
				'stripes' : false, 
				'dot' : true,
				'icons' : false
			}
		},
		'sort' : function(a, b) {
			return this.get_type(a) === this.get_type(b) ? (this.get_text(a) > this.get_text(b) ? 1 : -1) : (this.get_type(a) >= this.get_type(b) ? 1 : -1);
		},
		'contextmenu' : {
			'items' : function(node) {
				var tmp = $.jstree.defaults.contextmenu.items();
				tmp.create.label = "새 분류";
				tmp.rename.label = "명칭 변경";
				if(node.parent != "#") tmp.remove.label = "삭제";
				else delete tmp.remove;
				delete tmp.ccp;
				return tmp;
			}
		},
		'unique' : {
			'duplicate' : function (name, counter) {
				return name + ' ' + counter;
			}
		},
		"plugins": ["dnd", "search"],
		"search": {
			"show_only_matches": true,
			"show_only_matches_children": true,
		}
	})
	.on('create_node.jstree', function (e, data) {
		var ref = $('#js--tree').jstree(true);
		var parant_node = ref.get_node(data.parent);
		
		$.post(config.api + 'product/category/add', {
			'tab_num' :  '01', 
			'seq' : 	 parant_node.children.length,
			'depth': 	 data.node.parents.length, 	
			'father_id': parant_node.id,
			'id': 		 data.node.id, 
			'title': 	 data.node.text
		})
		.success(function (d) {
			insertLog("상품관리 > 상품 분류 관리 > 오더시트 카테고리 생성", "생성된 카테고리 : " + data.node.text, null);
			//data.instance.set_id(data.node, d.id);
		})
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('delete_node.jstree', function (e, data) {
		var ref = $('#js--tree').jstree(true);
		var id_list = new Array();
		id_list.push(data.node.id);

		$.each(data.node.children_d, function(index, value){
			children_node_id = data.node.children_d[index];
			var children_node = ref.get_node(children_node_id);
			id_list.push(children_node.id);
		})
		$.post(config.api + 'product/category/put', { 
			'tab_num'		: '01',
			'id_list' 		: id_list,
			'action_type' 	: 'delete'
		})
		.success(function(){
			insertLog("상품관리 > 상품 분류 관리 > 오더시트 카테고리 삭제", "삭제된 카테고리 : " + data.node.text, null);
		})
		.fail(function () {
			data.instance.refresh();
		});
	})
	.on('rename_node.jstree', function (e, data) {
		$.post(config.api + 'product/category/put', {
			'tab_num'		: '01',
			'id' 			: data.node.id, 
			'title' 		: data.text,
			'action_type' 	: 'rename'
		})
		.success(function (d) {
			insertLog("상품관리 > 상품 분류 관리 > 오더시트 카테고리 이름변경", "변경된 카테고리 명: " + data.old + " -> " + data.text, null);
		})
		.fail(function () {
			data.instance.refresh();
		});
		
	})
	.on('move_node.jstree', function (e, data) {
		var ref = $('#js--tree').jstree(true);
		var parant_id = 0;
		
		if(data.parent == '#'){
			parant_id = 0;
		}
		else{
			parant_id = ref.get_node(data.parent).original.no;
		}
	})
	.on('changed.jstree', function (e, data) {
		var ref = $('#js--tree').jstree(true);
		if(data && data.selected && data.selected.length) {
			var current_cate = '';
			var sel_node = '';
			//data.selected.join(':') : 선택된 NODE 값
			if(data.action == "select_node"){
				sel_node = data.node;
				for(var i = data.node.parents.length-2 ; i >= 0 ; i--){
					current_cate += ref.get_node(data.node.parents[i]).text+' > ';
				}
				$("input[name='md_category_node']").val(sel_node.original.no);
				$("input[name='md_category_depth']").val(sel_node.parents.length);

				current_cate += sel_node.text;
				sel_node.text = sel_node.text.replace('amp;','');
			}
			else if(data.action == "ready"){
				sel_node = ref.get_node(data.selected[0]);
				current_cate += sel_node.text;
			}
			if(current_cate.length != 0){
				$('#cate_id').val(sel_node.id);
				$('.desciption__table').find('th').eq(1).text(current_cate);
				$('.desciption__table').find('input').eq(0).val(sel_node.text);
				$('.desciption__table').find('textarea').eq(0).val(sel_node.original.description);
				$('#category_list').text("["+current_cate+"] 오더시트 분류 관리");

				$('#frm-list').find('.page').val(1);
				getProdTabInfo();
			}
		}
	});

	$('#tree--search').on('change', function() {
		let searchVal = $(this).val();
		$('#js-tree').jstree(true).search(searchVal);
	});
});

function exCreate() {
	var ref = $('#js--tree').jstree(true);
	
	var sel = ref.get_selected();
	var depth = ref.get_node(sel).parents.length;

	if (!sel.length || depth >= 6) {
		alert('카테고리를 생성할 수 없습니다.')
		return false;
	}
	sel = sel[0];
	sel = ref.create_node(sel, {
		"type": "file"
	});

	ref.edit(sel);
};

function exRename() {
	var ref = $('#js--tree').jstree(true)
	var sel = ref.get_selected();
	if (!sel.length) {
		return false;
	}
	sel = sel[0];

	ref.edit(sel);
};

function exDelete() {
    var ref = $('#js--tree').jstree(true)
	var sel = ref.get_selected();
	if (!sel.length) {
		return false;
	}

	ref.delete_node(sel);
};

function exMove() {
	var ref = $('#js--tree').jstree(true)
	var child_list = ref.get_node('#').children;
	getChildren(child_list);
	insertLog("상품관리 > 오더시트 분류 관리 > 오더시트 분류 설정", "분류 이동 저장", null);
	alert("현재 위치로 카테고리가 저장됩니다.");
};

function cateUpdate(){
	var ref = $('#js--tree').jstree(true)
	var id = $('#cate_id').val();
	var cate_title = $('.desciption__table').find('th').eq(1).text();
	var title = $('.desciption__table').find('input').eq(0).val();
	var desc = $('.desciption__table').find('textarea').eq(0).val();

	$.post(config.api + 'product/category/put', { 
			'tab_num'		: '01',
			'id' 			: id,
			'title' 		: title,
			'desc' 			: desc,
			'action_type' 	: 'info_update'
		})
		.success(function (d) {
			insertLog("상품관리 > 상품 분류 관리 > 분류정보 갱신", "갱신 카테고리 : " + cate_title, null);
		})
		.fail(function () {
			data.instance.refresh();
		}
	);
	ref.refresh();
}

function getChildren(array_param){
	var ref = $('#js--tree').jstree(true)
	array_param.forEach(function(item, index){
		var node = ref.get_node(item);
		var father_id = '';
		var seq = 0;
		var depth = node.parents.length;
		
		father_id = ref.get_node(node.parent).id;
		seq = index;
		$.post(config.api + 'product/category/put', { 
				'tab_num'		: '01',
				'father_id' 	: father_id, 
				'seq' 			: seq,
				'id' 			: item,
				'depth' 		: depth,
				'action_type' 	: 'move_save'
			})
			.success(function (d) {
			//data.instance.set_id(data.node, d.id);
			})
			.fail(function () {
				data.instance.refresh();
				return false;
			}
		);
		
		var child_list = ref.get_node(item).children;
		if(child_list.length != 0){
			getChildren(child_list);
		}
	});
	return true;
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_result').text(result_cnt.val());
	//$('.cnt_result').text(result_cnt.val());
}
function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list').find('.sort_value').val(order_value[0]);
	$('#frm-list').find('.sort_type').val(order_value[1]);

	getProdTabInfo();
}
function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-list').find('.rows').val(rows);
	$('#frm-list').find('.page').val(1);

	getProdTabInfo();
}

function getProdTabInfo(){
	var colspan_cnt = 0; 

	$('#result_table').html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="9">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$('#result_table').append(strDiv);
	
	var rows = $("#frm-list").find('.rows').val();
	var page = $("#frm-list").find('.page').val();
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$('#result_table').html('');
			}
			d.forEach(function(row) {
				var strDiv = "";
                strDiv += '<tr>';
                strDiv += '    <td>';
                strDiv += '        <div class="cb__color">';
                strDiv += '            <label>';
                strDiv += '                <input type="checkbox" class="select" name="no[]" value="' + row.no + '">';
                strDiv += '                <span></span>';
                strDiv += '            </label>';
                strDiv += '        </div>';
                strDiv += '    </td>';
                strDiv += '    <td>' + row.num + '</td>';
                strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.style_code + '</font></td>';
                strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.color_code + '</font></td>';
                strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.product_code + '</font></td>';
                strDiv += '    <TD>';
                strDiv += '        <div class="product__img__wrap">';
                
                var background_url = "background-image:url('" + row.ordersheet_img + "');";
                
                strDiv += '            <div class="product__img" style="' + background_url + '">';
                strDiv += '            </div>';
                strDiv += '            <div>';
                strDiv += '                <p>' + row.product_name + '</p><br>';
                strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
                strDiv += '            </div>';
                strDiv += '        </div>';
                strDiv += '    </TD>';
                
                strDiv += '    <td style="text-align: right;">';
                strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
                strDiv += '    </td>';
                
                strDiv += '    <td style="text-align: right;">';
                strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
                strDiv += '    </td>';
                
                strDiv += '    <td style="text-align: right;">';
                strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
                
                strDiv += '    </td>';
                strDiv += '</tr>';
				$('#result_table').append(strDiv);
			});
		},
	},rows, page);
}
</script>