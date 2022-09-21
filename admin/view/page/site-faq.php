<h1>자주하는 질문</h1>
<div class="navigation">
	<ul>
		<li>Home</li>
		<li>환경설정</li>
		<li>자주하는 질문</li>
	</ul>
</div>


<div class="row margin-top-20">
	<div class="float-left">
		<ul class="tab green" id="faq-language"></ul>
	</div>
</div>

<div class="row">
	<div class="col-3">
		<ul class="ver-inline-menu" id="faq-category-list">
			<form name="frm_cat" id="frm_cat">
				<li class="add">
					<a href="javascript:;"><i class="xi-plus"></i></a>
					<span class="add-input"><input type="text" name="category" ><button class="btn btn-large blue"><i class="xi-check"></i></button></span>
				</li>
			</form>
		</ul>
	</div>
	<div class="col-3 col-3-2">
		<div class="text-right margin-bottom-10">
			<a href="javascript:;" onclick="modal('add');" class="btn blue"><i class="xi-plus"></i> 작성</a>
		</div>
		<ul class="tab green" id="category"></ul>
		<div id="list"></div>
	</div>
</div>

<script>
$(document).ready(function() {
	$.ajax({
		url: config.api + "faq/category/get",   
		success: function(d) {
			if(d.code == 200) {
				if(d.total > 0) {
					d.data.forEach(function(row) {
						$("#faq-category-list > form").before(`
							<li>
								<a data-no="${row.no}"><i class="xi-view-list"><i class="xi-minus"></i></i>${row.title}</a>
							</li>
						`);
					});

					$("#faq-category-list a").click(function() {
						$("#faq-category-list > li.active").removeClass("active");
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
					$("#faq-category-list > li").eq(0).find("a").click();
					$("#faq-category-list a i.xi-minus").click(function() {
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

				}
			}
			else {
				alert(d.msg);
			}
		}
	});



	$("form#frm_cat").submit(function() {
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
				language : $("#faq-language > li.on").data("language").toLowerCase()
			},
			success: function(d) {
				if(d.code == 200) {
					$("form#frm_cat input[name='category']").val("");
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
	$("#faq-language > li").click(function() {
		$(this).siblings().removeClass("on");
		$(this).addClass("on");
		$("#list,#category").empty();
		$.ajax({
			type: "post",
			url: config.api + "site/faq/category",
			data: {
				language : $(this).data("language").toLowerCase()
			},
			dataType: "json",
			error: function() {
				alert("데이터를 불러들이는데 실패하였습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					$("#faq-category-list > li").remove();
					if(d.total > 0) {
						d.data.forEach(function(row) {
							$("#faq-category-list > form").before(`
								<li>
									<a data-no="${row.no}"><i class="xi-view-list"><i class="xi-minus"></i></i>${row.title}</a>
								</li>
							`);
						});
						$("#faq-category-list a").click(function() {
							$("#faq-category-list > li.active").removeClass("active");
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
						$("#faq-category-list > li").eq(0).find("a").click();
						$("#faq-category-list a i.xi-minus").click(function() {
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

</script>