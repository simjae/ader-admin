<style>
.tools{margin-top:10px;}
</style>
<div class="row margin-top-20">
	<div class="float-left">
		<ul class="tab green" id="faq-language"></ul>
	</div>
</div>

<div class="flex"style="gap:50px;margin:20px 0;">
	<div class="category__tab faq" cate_country="KR" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">한국몰</div>
	<div class="category__tab faq" cate_country="EN" style="height:30px;color:#707070;text-align:center;cursor:pointer;">영문몰</div>
	<div class="category__tab faq" cate_country="CN" style="height:30px;color:#707070;text-align:center;cursor:pointer;">중국몰</div>
	<input type="hidden" id="category_country" value="KR">

	<input type="hidden" id="category_idx" value="">
</div>

<div class="row faq_cate">
	<div class="col-3 KR">
		<ul class="ver-inline-menu" class="faq-category-list" id="faq-category-KR-list">
			<form name="frm_cat_KR" class="frm_cat">
				<li class="add">
					<a href="javascript:;">
						<i class="xi-plus"></i>
					</a>
					<span class="add-input">
						<input type="text" name="category" >
						<button class="btn btn-large blue">
							<i class="xi-check"></i>
						</button>
					</span>
				</li>
			</form>
		</ul>
	</div>
	<div class="col-3 EN">
		<ul class="ver-inline-menu" class="faq-category-list" id="faq-category-EN-list">
			<form name="frm_cat_EN" class="frm_cat">
				<li class="add">
					<a href="javascript:;">
						<i class="xi-plus"></i>
					</a>
					<span class="add-input">
						<input type="text" name="category" >
						<button class="btn btn-large blue">
							<i class="xi-check"></i>
						</button>
					</span>
				</li>
			</form>
		</ul>
	</div>
	<div class="col-3 CN">
		<ul class="ver-inline-menu" class="faq-category-list" id="faq-category-CN-list">
			<form name="frm_cat_cn" class="frm_cat">
				<li class="add">
					<a href="javascript:;">
						<i class="xi-plus"></i>
					</a>
					<span class="add-input">
						<input type="text" name="category" >
						<button class="btn btn-large blue">
							<i class="xi-check"></i>
						</button>
					</span>
				</li>
			</form>
		</ul>
	</div>
	<div class="col-3 col-3-2">
		<div class="text-right margin-bottom-10">
			<a href="javascript:;" onclick="updateFaqSeq()" class="btn blue"><i class="xi-plus"></i> FAQ 순서변경</a>
			<a href="javascript:;" onclick="openFaqModal()" class="btn blue"><i class="xi-plus"></i> 작성</a>
			<a href="javascript:;" onclick="openFaqCategoryModal()" class="btn blue"><i class="xi-plus"></i> 카테고리 추가</a>
		</div>
		<ul class="tab green" id="category"></ul>
		<form id="frm-faq-list">
			<div id="list"></div>
		</form>
		
	</div>
</div>

<script>
$(document).ready(function() {
	$('.row.faq_cate').find('.col-3').hide();
	$('.row.faq_cate').find('.col-3.KR, .col-3.col-3-2').show();
	
	initFaq();
});
function initFaq(){
	$('#faq-category-KR-list > li').remove();
	$('#faq-category-EN-list > li').remove();
	$('#faq-category-CN-list > li').remove();
	
	$.ajax({
		url: config.api + "page/board/faq/category/list/get",   
		success: function(d) {
			if(d.code == 200) {
				if(d.total > 0) {
					d.data.forEach(function(row) {
						$(`#faq-category-${row.country}-list > form`).before(`
							<li>
								<a class="faq_large_category" data-no="${row.no}">
									<i class="xi-view-list">
										<i class="xi-minus" category_no="${row.no}">
										</i>
									</i>${row.title}
								</a>
							</li>
						`);
					});
					
					$(".faq_large_category").click(function() {
						$(this).parents('ul').find('li.active').removeClass("active");
						$(this).parent().addClass("active");
						$("#list,#category").empty();
						$('#category_idx').val($(this).data("no"));
						$.ajax({
							url: config.api + "page/board/faq/category/get",
							data: {
								category_no : $(this).data("no")
							},
							error: function() {
								alert("데이터를 불러들이는데 실패하였습니다.");
							},
							success: function(d) {
								var html = "";
								var status;
								if(d.total > 0) {
									$("#list").html('<ul class="faq_list dragable-vertical" id="faq-list-body"></ul>');
									d.data.forEach(function(row) {
										$("#faq-list-body").append(`
											<li class="faq_item" data-index="${row.no}">
												<input type="hidden" name="faq_idx_list[]" value="${row.no}">
												<dl class="accordion white">
													<dt>
														<a>${row.question}</a>
														<div class="tools">
															<a onclick="modal('faq/put', 'faq_idx=${row.no}');" data-tooltip="수정"><div class="btn">수정</div></a>
															<a onclick="deleteFaq(${row.no})" data-tooltip="삭제"><div class="btn">삭제</div></a>
														</div>
													</dt>
													<dd class="close">${row.answer}</dd>
												</dl>
											</li>
										`);
									});
									//질문 클릭시 답변 
									$("dl.accordion dt > a").click(function() {
										$(this).parent().next().slideToggle('fast');
									});
								} else {
									$("#list").html(`
										<div class="noitem">
											<i class="xi-file-o"></i><br>작성된 항목이 없습니다
										</div>
									`);
								}
								
								$('.faq_list').sortable({
									items : $('.faq_item')
								});
							}
						});
					});
					$(`#faq-category-${$('#category_country').val()}-list > li`).eq(0).find("a").click();
					$("i.xi-minus").click(function() {
						let category_no = $(this).attr('category_no');
						confirm($(this).parents('.faq_large_category').text() + '카테고리를 삭제할까요?',function() {
							$.ajax({
								type: "post",
								data: {
									'no' : category_no
								},
								dataType: "json",
								url: config.api + "page/board/faq/category/delete",
								error: function() {
									alert("FAQ 카테고리 삭제작업이 실패했습니다.");
								},
								success: function(d) {
									if(d.code == 200) {
										insertLog("게시판 > FAQ관리", "카테고리 삭제", null);
										alert("FAQ 카테고리 삭제처리에 성공했습니다.",function(){
											initFaq();
										});
									}
								}
							});
						});
					});
					$("i.xi-check").click(function(){
						let obj = $(this);
						let category_name = $(this).parent().prev().val();
						let country = $('#category_country').val();
						confirm('[' + category_name + ']' + '카테고리를 추가할까요?',function() {
							$.ajax({
								type: "post",
								data: {
									'category_type' : 'lrg',
									'category_name' : category_name,
									'country' : country
								},
								dataType: "json",
								url: config.api + "page/board/faq/category/add",
								error: function() {
									alert("FAQ 카테고리 삭제작업이 실패했습니다.");
								},
								success: function(d) {
									if(d.code == 200) {
										insertLog("게시판 > FAQ관리", "카테고리 등록", null);
										obj.parent().prev().val('');
										initFaq();
										alert("FAQ 카테고리 등록처리에 성공했습니다.",function(){
											$('.modal.anim-ease-02').remove();
										});
									}
								}
							});
						});
					})
					$('.category__tab.faq').click(function() {	
						var country_str = $(this).attr('cate_country');
						$('#category_country').val(country_str);

						$('.row.faq_cate').find('div.col-3').hide();
						$('.row.faq_cate').find('div.col-3.'+country_str+',div.col-3.col-3-2').show();

						$('div.category__tab.faq').not($(this)).css('color','#707070');
						$('div.category__tab.faq').not($(this)).css('border-bottom','none');
						
						$(this).css('color','#140f82');
						$(this).css('border-bottom','3px solid #140f82');
						$("#faq-category-"+country_str+"-list > li").eq(0).find("a").click();
					});
				}
			}
			else {
				alert(d.msg);
			}
		}
	});
}
function openFaqModal(){
	let category_idx = $('#category_idx').val();
	modal('faq/add', 'category_idx='+category_idx);
}
function openFaqUpdateModal(faq_idx){
	let category_idx = $('#category_idx').val();
	modal('faq/add', 'faq_idx='+faq_idx);
}
function openFaqCategoryModal(){
	let category_idx = $('#category_idx').val();
	modal('faq/category/add', 'category_idx='+category_idx);
}
function deleteFaq(idx){
	confirm("선택한 FAQ를 삭제하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: { 'faq_idx': idx },
			dataType: "json",
			url: config.api + "page/board/faq/delete",
			error: function() {
				alert("FAQ 삭제작업이 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("게시판 > FAQ관리", "삭제", null);
					alert("FAQ 삭제 처리에 성공했습니다.",function(){
                        initFaq();
                    });
				}
			}
		});
	});
}
function updateFaqSeq(){
	var formData = new FormData();
	formData = $("#frm-faq-list").serializeObject();
	
	formData.faq_seq_flg = true;

	confirm("현재 순서대로 FAQ를 수정하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "page/board/faq/put",
			error: function() {
				alert("FAQ 순서변경에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("게시판 > FAQ관리", "순서 수정", null);
					alert("FAQ 순서변경 처리에 성공했습니다.",function(){
                        initFaq();
                    });
				}
			}
		});
	});
}
</script>