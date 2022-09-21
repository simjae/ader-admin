const config = {
	api : "/_api/",
	script : "/script/module/"
};

var _m,_module;
var paging_next	= "";	// 다음 페이지 템플릿
var paging_prev	= "";	// 이전 페이지 템플릿
var paging_head	= '<a onclick="list(1);" class="first"><i class="xi-angle-left"></i></a>';	// 처음으로 템플릿
var paging_foot	= '<a onclick="list(<_page>);" class="last"><i class="xi-angle-right"></i></a>';	// 끝으로 템플릿
var paging_num	= '<a onclick="list(<_page>);"><_page></a>';	// 페이지 
var paging_now	= '<a onclick="list(<_page>);" class="now"><_page></a>';	// 현재 페이지

$.ajaxSetup({ 
	type : "post",
	dataType: "json",
	error : function() {
		alert("서버요청 실패");
	},
	complete : function() {
		$(".tab.pre > *").click(function() {
			$(this).siblings().removeClass("on");
			$(this).addClass("on");
		});
		$(".tab.pre").removeClass("pre");
	}
});

$(document).ready(function() {
	$("#btn-menu-shortly").click(function() {
		$("body").toggleClass("short");
	});

	$("#container > .navigation > .action").click(function() {
		$(this).toggleClass("on");
	});

	$("#gnb > ul > li").each(function() {
		if($(this).children("a").data("gnb") == _m) $(this).children("a").addClass("on");
	});

	ui();

	$("html").keydown(function(e) {
		if (e.keyCode === $.ui.keyCode.ESCAPE) {
			if($(".modal").last().find(".footer .xi-close").length > 0) {
				modal_cancel();
			}
			else {
				modal_close();
			}
		}
	});

	$("#gnb a").each(function() {
		if(typeof $(this).data("gnb") != "undefined" && $(this).data("gnb") == location.pathname.split("/")[1]) {
			$(this).addClass("on");
		}
	});

	$(".logout").click(function() {
		confirm('로그아웃하시겠습니까?',function() {
			$.ajax({
				url:config.api + 'account/logout',
				error:function(data){
					alert("로그아웃 실패하였습니다");
				},
				success:function(){
					location.href = "/";
				}
			});
		});
	});

	$("table > thead a.btn.reset").click(function() {
		function form_reset(obj) {
			if(obj[0].nodeName == 'FORM') {
				obj.get(0).reset();
				obj.submit();
			}
			else {
				if(obj[0].nodeName == 'BODY') {
					return;
				}
				else {
					form_reset($(obj).parent());
				}
			}
		}
		form_reset($(this));
	});

	/** 게시판 목록 **/
	$.ajax({
		url: config.api + 'board/config/get',
		success: function(d) {
			if(d.code == 200) {
				if(d.data && d.total > 0) {
					d.data.forEach(function(row) {
						$("#gnb-board-list").append(`<a href="/board/${row.bbscode}">${row.title}</a>`);
					});
				}
			}
		}
	});

	/*
	var gnb_height = $("#gnb > ul").height()+$("#footer").height()+10;
	setInterval(function() {
		if(gnb_height > $("#container").height()) {
			$("#container").height(gnb_height);
		}
	},100);

	$(window).scroll(function() {
		view_footer_position();
	}).scroll();
	$(window).resize(function() {
		view_footer_position();
	}).resize();
	*/

	_prepare();
});