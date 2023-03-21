<style>
.wrap__bg--wh{background-color: #fff;padding: 10px;margin: 10px 0;}
.product-tree {display: grid;gap: 20px;grid-template-columns: 400px 2fr;}
.tree__chart h3 {line-height: 2;}
.tree__desciption h3 {line-height: 2;}
.tree__desciption textarea{width: 100%;border: 1px solid #c2cad8;padding: 5px;}
.tree-btn-wrap {display: flex;gap: 5px;}
.chart__button__wrap {display: flex;justify-content: space-between;padding: 10px 20px;}
.chart__button {color: black;font-size: 15px;border: 1px solid black;padding: 5px;border-radius: 5px;}
.chart__button--move {width: 90px;height: 22px;border-radius: 2px;background-color: #140f82;font-size: 12px;color: #fff;padding: 4px 0;text-align: center;cursor: pointer;}
#tree--search {padding: 10px;width: 100%;}
.xi-search {padding: 10px;}
#js--tree {min-height: 500px;max-height: 100%;margin: 0 12px 0 12px;padding-top: 20px;border-top: 1px solid #bfbfbf;}
.desciption__table{border-left: solid 1px #ddd;border-spacing: 0;margin: 0;table-layout: fixed;}
.access__ip__wrap{display: flex;margin-bottom: 10px;}
.access__ip--add{font-size: 15px;padding: 5px;border: 1px solid black;border-radius: 5px;margin-left: 10px;}
.access__apply__btn{cursor: pointer;font-size: 16px;height: 36px;width: 130px;background-color: #140f82;border-radius: 2px;font-weight: normal;display: flex;color: #f5f6fa;align-items: center;justify-content: center;font-weight: normal;}
.access__apply__wrap{display: flex;justify-content: center;margin-top: 10px;}
.classify__btn{width: 70px;height: 22px;border-radius: 2px;text-align: center;border: solid 1px #707070;background-color: #fff;padding: 4px 0;font-size: 12px;cursor: pointer;}
.search__box{display: flex;box-shadow: inset 1px 1px 5px 0 rgba(0, 0, 0, 0.16);}
.jstree-anchor.jstree-clicked{background-color:#dcdcdc;}
</style>
<div class="content__card modal__view" style="width:50vw">
    <input type="hidden" id="sel_idx" value="<?=$sel_idx?>">
    <input type="hidden" id="sel_category_id">
    <div class="card__header">
		<h3>해외통관 - 상품 카테고리 선택
			<a onclick="modal_close();" class="btn-close" style="float:right">
				<i class="xi-close"></i>
			</a>
		</h3>
		<div class="drive--x"></div>
	</div>
    <div class="card__body">
        <div class="content__card" style="padding: 11px 0 20px 0;">
            <div class="card__header">
                <div class="flex justify-between" style="padding:0 20px;">
                    <h3 class="page_sub_title" style="line-height: 2;">분류 검색</h3>
                    <div class="search__box">
                        <i class="xi-search"></i>
                        <input type="text" id="tree--search" placeholder="카테고리를 검색하세요.">
                    </div>
                </div>
            </div>
            <div id="js--tree"></div>
        </div>
        <div class="content__wrap">
            <div class="content__title">선택 분류</div>
			<div class="content__row">
                <p id="sel_category_str">분류를 선택해주세요</p>
            </div>
        </div>
    </div>
    <div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  onclick="selProductCategory();" class="blue__color__btn"><span>선택</span></div>
				<div onclick="modal_close()" class="defult__color__btn"><span>창 닫기</span></div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    var js_tree = $('#js--tree').jstree({
		core : {
			data : {
				url : config.api + 'product/category/get',
				data : {'tab_num' : '02'},
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
    js_tree.bind("select_node.jstree", function(event, data) { 
        var ref = $('#js--tree').jstree(true);
        
        var current_cate = '';
        var current_cate_str = '';
        var sel_node = '';

        sel_node = data.node;
        for(var i = data.node.parents.length-2 ; i >= 0 ; i--){
            current_cate_str += ref.get_node(data.node.parents[i]).text+' > ';
        }

        current_cate = sel_node.id;
        current_cate_str += sel_node.text;
        sel_node.text = sel_node.text.replace('amp;','');
        $('#sel_category_id').val(current_cate);
        $('#sel_category_str').text(current_cate_str);
    }); 
})

function selProductCategory(){
    confirm('해당 카테고리로 선택하시겠습니까?',function(){
        let set_category_id = $('#sel_category_id').val();
        let sel_idx = $('#sel_idx').val();
        $.ajax({
            type: "post",
            data: {
                'sel_idx' : sel_idx,
                'category_id' : set_category_id
            },
            dataType: "json",
            url: config.api + "pcs/ordersheet/custom_clearance/put",
            error: function() {
                alert("해외통관 카테고리 업데이트작업이 실패했습니다.");
            },
            success: function(d) {
                if(d != null){
                    if(d.code == 200) {
                        alert('해외통관 카테고리가 지정되었습니다.',function(){
                            getClearanceInfo();
                            modal_close();
                        })
                    }
                }
            }
        });
    });
}
</script>