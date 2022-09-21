<div class="row margin-top-20">
	<div class="float-left">
		<ul class="tab green" id="faq-language"></ul>
	</div>
</div>

<div class="flex"style="gap:50px;margin:20px 0;">
	<div class="category__tab faq" cate_country="kr" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">한국몰</div>
	<div class="category__tab faq" cate_country="en" style="height:30px;color:#707070;text-align:center;cursor:pointer;">영문몰</div>
	<div class="category__tab faq" cate_country="cn" style="height:30px;color:#707070;text-align:center;cursor:pointer;">중국몰</div>
	<input type="hidden" id="category_country" value="kr">
</div>

<div class="row faq_cate">
	<div class="col-3 kr">
		<ul class="ver-inline-menu" class="faq-category-list" id="faq-category-kr-list">
			<form name="frm_cat" class="frm_cat">
			</form>
		</ul>
	</div>
	<div class="col-3 en">
		<ul class="ver-inline-menu" class="faq-category-list" id="faq-category-en-list">
			<form name="frm_cat" class="frm_cat">
			</form>
		</ul>
	</div>
	<div class="col-3 cn">
		<ul class="ver-inline-menu" class="faq-category-list" id="faq-category-cn-list">
			<form name="frm_cat" class="frm_cat">
				<!--<li class="add">
					<a href="javascript:;"><i class="xi-plus"></i></a>
					<span class="add-input"><input type="text" name="category" ><button class="btn btn-large blue"><i class="xi-check"></i></button></span>
				</li>
				-->
			</form>
		</ul>
	</div>
	<div class="col-3 col-3-2">
		<div class="text-right margin-bottom-10">
			<a href="javascript:;" onclick="openFaqModal()" class="btn blue"><i class="xi-plus"></i> 작성</a>
			<a href="javascript:;" onclick="openFaqCategoryModal()" class="btn blue"><i class="xi-plus"></i> 카테고리 추가</a>
		</div>
		<ul class="tab green" id="category"></ul>
		<div id="list"></div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('.row.faq_cate').find('div.col-3.en,div.col-3.cn').hide();
	$('.row.faq_cate').find('div.col-3.kr','div.col-3.col-3-2').show();
	
	initFaq();
/*
	$("form.frm_cat").submit(function() {
		var country = $('#category_country').val();
		let title = trim($(this).find("input[name='category']").val());

		if(title == '') {
			alert('분류명을 입력해주세요.');
			return false;
		}
		$.ajax({
			type: "post",  
			dataType: "json",
			url: config.api + "site/faq/category-add",   
			data: {
				title : title,
				language : country
			},
			success: function(d) {
				if(d.code == 200) {
					$("form.frm_cat input[name='category']").val("");
					$("#faq-language > li.on").click();
				}
				else {
					alert(d.msg);
				}
			},
			error: function() {
				alert("오류","데이터 저장을 실패했습니다.",1);
			}
		});

		return false;
	});
	*/
	$("#faq-language > li").click(function() {
		var country = $('#category_country').val();
		$(this).siblings().removeClass("on");
		$(this).addClass("on");
		$("#list,#category").empty();
		$.ajax({
			type: "post",
			url: config.api + "site/faq/category",
			data: {
				language : country
			},
			dataType: "json",
			error: function() {
				alert("데이터를 불러들이는데 실패하였습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					$(".faq-category-list > li").remove();
					if(d.total > 0) {
						d.data.forEach(function(row) {
							$(".faq-category-list > form").before(`
								<li>
									<a data-no="${row.no}"><i class="xi-view-list"><i class="xi-minus"></i></i>${row.title}</a>
								</li>
							`);
						});
						$(".faq-category-list a").click(function() {
							$(".faq-category-list > li.active").removeClass("active");
							$(this).parent().addClass("active");
							$("#list,#category").empty();

							$.ajax({
								type: "post",
								url: config.api + "site/faq/category",
								data: {
									category_no : $(this).data("no")
								},
								dataType: "json",
								error: function() {
									alert("데이터를 불러들이는데 실패하였습니다.");
								},
								success: function(d) {
									if(d.code == 200) {
										$("#category").empty();
										if(d.data) {
											d.data.forEach(function(row) {
												$("#category").append(`<li data-no="${row.no}"><a>${row.title}</a></li>`);
											});

										}

										$("#category > li").click(function() {
											$("#list").empty();
											$(this).siblings().removeClass("on");
											$(this).addClass("on");

											$.ajax({
												type: "post",
												url: config.api + "site/faq/",
												data: {
													cate_no : $(this).data("no")
												},
												dataType: "json",
												error: function() {
													alert("데이터를 불러들이는데 실패하였습니다.");
												},
												success: function(d) {
													var html = "";
													var status;

													if(d.total > 0) {
														$("#list").html('<ul class="dragable-vertical" id="faq-list-body"></ul>');
														d.data.forEach(function(row) {
															$("#faq-list-body").append(`
																<li data-index="${row.no}">
																	<dl class="accordion white">
																		<dt>
																			<a>${row.question}</a>
																			<div class="tools">
																				<a onClick="modal('site/faq/add',{no:${row.no}});" data-tooltip="수정"><i class="xi-pencil-point"></i></a>
																				<a class="btn-popover"><i class="xi-trash-o" data-caption="삭제"></i></a>
																				<a><i class="xi-arrows-v cursor-move" data-caption="순서 이동"></i></a>
																			</div>
																		</dt>
																		<dd class="close">${row.answer}</dd>
																	</dl>
																</li>
															`);
														});
														$("dl.accordion dt > a").click(function() {
															$(this).parent().next().slideToggle('fast');
														});
													}
													else {
														$("#list").html(`
															<div class="noitem">
																<i class="xi-file-o"></i><br>작성된 항목이 없습니다
															</div>
														`);
													}
												}
											});
										}).eq(0).click();
									}
								}
							});
						});
						$(".faq-category-list > li").eq(0).find("a").click();
						$(".faq-category-list a i.xi-minus").click(function() {
							confirm($(this).parent().parent().text() + ' 삭제할까요?',function() {
								$.ajax({
									type: "post",  
									dataType: "json",
									url: config.api + "site/faq/category-del",   
									data: {
										no : $(this).parent().parent().data("no")
									},
									success: function(d) {
										if(d.code == 200) {
											alert("분류가 삭제되었습니다.");
											$("#faq-language > li.on").click();
										}
										else {
											alert(d.msg);
										}
									}
								});
							});
						});
					}
				}
				else {
					alert(d.msg);
				}
			}
		});
	}).eq(0).click();
});
function initFaq(){
	$('#faq-category-kr-list > li').remove();
	$('#faq-category-en-list > li').remove();
	$('#faq-category-cn-list > li').remove();
	
	$.ajax({
		url: config.api + "faq/category/get",   
		success: function(d) {
			if(d.code == 200) {
				if(d.total > 0) {
					d.data.forEach(function(row) {
						$("#faq-category-"+row.country.toLowerCase()+"-list > form").before(`
							<li>
								<a data-no="${row.no}"><i class="xi-view-list"><i class="xi-minus"></i></i>${row.title}</a>
							</li>
						`);
					});
					
					$("#faq-category-kr-list a,#faq-category-en-list a,#faq-category-cn-list a").click(function() {
						$(this).parents('ul').find('li.active').removeClass("active");
						$(this).parent().addClass("active");
						$("#list,#category").empty();

						$.ajax({
							url: config.api + "faq/get",
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
									$("#list").html('<ul class="dragable-vertical" id="faq-list-body"></ul>');
									d.data.forEach(function(row) {
										$("#faq-list-body").append(`
											<li data-index="${row.no}">
												<dl class="accordion white">
													<dt>
														<a>${row.question}</a>
														<div class="tools">
															<a onClick="modal('add',{no:${row.no}});" data-tooltip="수정"><i class="xi-pencil-point"></i></a>
															<a class="btn-popover"><i class="xi-trash-o" data-caption="삭제"></i></a>
															<a><i class="xi-arrows-v cursor-move" data-caption="순서 이동"></i></a>
														</div>
													</dt>
													<dd class="close">${row.answer}</dd>
												</dl>
											</li>
										`);
									});
									$("dl.accordion dt > a").click(function() {
										$(this).parent().next().slideToggle('fast');
									});
								}
								else {
									$("#list").html(`
										<div class="noitem">
											<i class="xi-file-o"></i><br>작성된 항목이 없습니다
										</div>
									`);
								}
							}
						});
					});
					$("#faq-category-kr-list > li").eq(0).find("a").click();
					$("#faq-category-kr-list i.xi-minus,#faq-category-en-list i.xi-minus,#faq-category-cn-list i.xi-minus").click(function() {
						confirm($(this).parent().parent().text() + ' 삭제할까요?',function() {
							$.ajax({
								url: config.api + "faq/category/delete",   
								data: {
									no : $(this).parent().parent().data("no")
								},
								success: function(d) {
									if(d.code == 200) {
										alert("분류가 삭제되었습니다.");
										$("#faq-language > li.on").click();
									}
									else {
										alert(d.msg);
									}
								}
							});
						});
					});
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
	var country = $('#category_country').val();
	var sel_a = $('.col-3.'+country).find('.active').find('a');
	var category_info = '';
	category_info += sel_a.attr('data-no');
	category_info += '|'
	category_info += sel_a.text();
	if(category_info != '|'){
		modal('faq/add', 'category_info='+category_info);
	}
}
function openFaqCategoryModal(){
	var country = $('#category_country').val();
	modal('faq/category/add', 'country='+country);
}
</script>