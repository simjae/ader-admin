function get_contents(obj,data,rowsParam,pageParam) {
	$(obj).unbind();
	$(obj).submit(function() {
		let page = 1;
		if (pageParam != null) {
			page = pageParam;
		}
		if($(this).find("input[name='page']").length > 0 && isNaN($(this).find("input[name='page']").val()) == false) {
			page = $(this).find("input[name='page']").val();
		}
		else {
			$(this).prepend(`<input type="hidden" name="page" value="${page}">`);
		}
		if(typeof data != 'object') {
			if(isNaN(data) == false) page = data;
			data = {
				param : $(this).serializeObject()
			};
			data.param.page = page;
		}
		$(this).find("input[name='page']").val(page);
		if('param' in data == false) data.param = { page : page };
		if('page' in data == false) data.param.page = page;
		if('html' in data == false) return false;
		if('pageObj' in data == false) data.pageObj = $("#paging");
		let param = $(this).serializeObject();
		for(key in param) {
			data.param[key] = param[key];
		}

		$.ajax({
			url: config.api + $(this).attr("action"),
			type: "post",
			data: data.param,
			success: function(d) {
				if(d.code == 200) {
					let rowNum = 20;
					if (rowsParam != null) {
						rowNum = rowsParam;
					}
					
					if(d.data && d.total > 0) {
						num = d.total - ((d.page-1)*rowNum);
						d.data.forEach(function(row) {
							row.num = num--;
						});
						data.html(d.data);
					}
					else if('nodata' in data && typeof data.nodata == 'function') {
						data.nodata();
					}
					if('complete' in data && typeof data.complete == 'function') {
						data.complete(d);
					}
					
					var total = d.total;
					var total_cnt = d.total_cnt;

					var pagingObj = data.pageObj;

					var page_total_cnt = pagingObj.parent().find('.total_cnt');
					var page_result_cnt = pagingObj.parent().find('.result_cnt');
					
					page_total_cnt.val(total_cnt);
					page_result_cnt.val(total);
					
					page_total_cnt.change();
					page_result_cnt.change();
					
					//var showing_page = Math.ceil(d.total/rowNum);
					var showing_page = 5;
					
					if('page' in d) {
						paging({
							total : total,
							el : data.pageObj,
							page : d.page,
							row : rowNum,
							show_paging : showing_page,
							fn : function(page) {
								$(obj).find("input[name='page']").val(page);
								$(obj).submit();
							}
						});
					}
				}
				else {
					alert(d.msg);
				}
			}
		});

		return false;
	}).submit();
};
function insertLog(type, contents,cnt){
	$.ajax({
		type: "post",
		data: {
			'log_type':type,
			'log_contents':contents,
			'target_cnt':cnt
		},
		dataType: "json",
		url: config.api + "store/log/add",
		error: function() {
			alert('error');
		},
		success: function(d) {
			if(d.code == 200) {
				console.log('log success');
			}
		}
	});
};

