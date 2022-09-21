$.fn.serializeObject=function(){
	"use strict";
	var a={},
		b=function(b,c){
			var d=a[c.name];
			"undefined"!=typeof d&&d!==null?$.isArray(d)?d.push(c.value):a[c.name]=[d,c.value]:a[c.name]=c.value
		};
	return $.each(this.serializeArray(),b),a
};

var anonymous_user = false;
var show_login = true;

function appendzero(n) {
	if(n < 10 && n >= 0) {
		n = "0" + n;
	}
	return n;
}


function _prepare(obj) {
	if(typeof obj != 'object') obj = $("body");


	$(obj).find("input").keyup(function() {
		$(this).removeClass("input-required");
		if($(this).val().trim()=="") $(this).removeClass("edited");
		else $(this).addClass("edited");
	});

	$(obj).find("input[type='text'],input[type='date'],input[type='time'],input[type='number'],input.date").focusout(function() {
		var val = $(this).val();
		if(trim(val) != "") {
			$(this).addClass("has-value");
		}
		else {
			$(this).val("");
			$(this).removeClass("has-value");
		}
	});

	/** DATE PICKER **/
	$(obj).find("input[type=date],input.date").datepicker({
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'1900:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
	});


	/** TIME PICKER **/
	$(obj).find("input[type=time],input.time").timepicker({
		"timeFormat" : "H:i"
	});

	/** 입력 형식 **/
	$(obj).find("input.phone").mask("000-0000-0000");
	$(obj).find("input.zipcode").mask("00000");
	$(obj).find("input.number").mask("000000000000");
	$(obj).find("input.number-2").mask("00");
	$(obj).find("input.number-3").mask("000");

	/** 편집 가능한 텍스트박스 **/
	$(obj).find("form").submit(function() {
		$(this).find(".textarea").each(function() {
			$(this).parent().find("input").val($(this).html());
		});

		tinymce.triggerSave();
		return false;
	});

	/** 편집기 **/
	tinymce.init({
		selector: "textarea.tiny",
		menubar: false,
		statusbar: false,
		language: "ko_KR",
		style_formats: [
			{title: '굵은 글씨', inline: 'b'},
			{title: '빨간 글씨', inline: 'span', styles: {color: '#ff0000'}},
			//{name: '인라인', title: '인라인', inline: 'span', classes: [ 'my-inline' ]}
		],
		plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table wordcount',
			'powerpaste'
		],
		smart_paste: true,  // note: default value for smart_paste is true
		image_file_types: 'jpg,svg,webp,png,gif',
		style_formats_merge: false,
		icons: 'material',
		//toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar1: 'codesample | bold italic | fontsizeselect | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify',
		toolbar2: 'bullist numlist outdent indent | link image | code',
		fontsize_formats: '8px 10px 12px 14px 16px 18px 24px 36px 48px',
		/*
		images_upload_url: config.api + 'board/upload/image',
		images_upload_handler: function (blobInfo, success, failure) {
			setTimeout(function () {
				success(blobInfo.blob());
			}, 2000);
		},
		*/


        /*** image upload ***/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
            URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
            images_upload_url: 'postAcceptor.php',
            here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
            Note: In modern browsers input[type="file"] is functional without
            even adding it to the DOM, but that might not be the case in some older
            or quirky browsers like IE, so you might want to add it to the DOM
            just in case, and visually hide it. And do not forget do remove it
            once you do not need it anymore.
            */
            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    /*
                    Note: Now we need to register the blob in TinyMCEs image blob
                    registry. In the next release this part hopefully won't be
                    necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        },
        /*** image upload ***/
	});
	$(obj).find("textarea.tiny").removeClass("tiny");
}


function qtychg(no,add) {
	var obj = $("#qtyselect_" + no);
	var val = parseInt(obj.val()) + add;
	var max = obj.attr("max");
	var min = obj.attr("min");

	if(max < val || min > val || 0 >= val) {
		return;
	}
	else {
		obj.val(val);
	}
}


function zipcode(obj) {
	$("body").addClass("on-modal").append(`
		<div class='modal'>
			<div class='container'>
				<a onclick="modal_close();" class="btn-close"><i class="xi-close-thin"></i></a>
				<div class="body width-600-min height-800" id="modal-zipcode"></div>
			</div>
		</div>
	`);
	setTimeout('$(".modal").last().addClass("on");',10);

	new daum.Postcode({
		oncomplete: function(data) {
			// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = data.address; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 기본 주소가 도로명 타입일때 조합한다.
			if(data.addressType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			var obj_p = $(obj).parent();
			$(obj_p).find("input.zipcode").val(data.zonecode);
			$(obj_p).parent().find("input[type=text].address1").val(fullAddr);

			modal_close();
		},
		width : '100%',
		height : '100%',
		maxSuggestItems : 5
	}).embed(document.getElementById("modal-zipcode"));
}


/*======================================================================================*/
/*  기본 함수 정의
/*  --------------
/*  작성일     : 2014.6.19
/*  최종수정일 :
/*	사용법     :
/*
/*======================================================================================*/
//공백 제거
String.prototype.trim = function() {
  return this.replace(/(^\s*)|(\s*$)/gi, "");
}

// 문자열 치환
String.prototype.replaceAll = function(str1, str2) {
  var temp_str = this.trim();
  temp_str = temp_str.replace(eval("/" + str1 + "/gi"), str2);
  return temp_str;
}

/*======================================================================================*/
/*  jQuery 함수 정의
/*  --------------
/*  작성일		: 2014.12.17
/*  최종수정일	:
/*	사용법		:
/*
/*======================================================================================*/
// 폼 검사 함수
$.fn.formvaild = function() {
	var result = true;
	$(this).find("input").each(function() {
		if($(this).attr("required")=="required") {	// 필수값 입력 항목일 경우
			var name = $(this).attr("title");
			var max = $(this).attr("maxlength");
			var min = $(this).attr("minlength");
			var confirm = $(this).attr("confirm");
			var val_len	= $(this).val().length;

			if($(this).val().trim() == "") {		// 필수값 입력 검사
				$(this).next(".-describe").html(name + "은(는) 반드시 입력해야 합니다");
				if(result == true) $(this).focus();	// 첫 오류일 경우 포커스 이동
				$(this).addClass("input-required");	// 배경색 변환
				result = false;
			}
			else if(val_len < min || val_len > max) {
				$(this).next(".-describe").html("최소 " + min + "자 이상 " + max + "자 이내로 입력해야 합니다");
				if(result == true) $(this).focus();	// 첫 오류일 경우 포커스 이동
				$(this).addClass("input-required");	// 배경색 변환
			}
			else if(confirm != undefined && $(this).val() != $("input[name='" + confirm + "']").val()) {
				if(result == true) $(this).focus();	// 첫 오류일 경우 포커스 이동
				$(this).addClass("input-required");	// 배경색 변환
				$(this).next(".-describe").html(name + "이(가) 일치해야 합니다");
				result = false;
			}
			else {
				$(this).next(".-describe").empty();
				$(this).removeClass("input-required");	// 배경색 변환
			}
		}
	});
	return result;
}



/*======================================================================================*/
/*  익스플로러 버전 구함
/*  --------------------
/*  작성일     : 2014.6.19
/*  최종수정일 :
/*	사용법     :
/*
/*======================================================================================*/
function is_ie() {
	var rv = -1; // 익스가 아닐 경우 false 반환
	if (navigator.appName == 'Microsoft Internet Explorer') {
		var ua = navigator.userAgent;
		var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null) {
			rv = parseFloat(RegExp.$1);
		}
	}
	return rv; 
} 

/*======================================================================================*/
/*  공백 제거
/*  ---------
/*  작성일     : 2014.6.19
/*  최종수정일 :
/*	사용법     :
/*
/*======================================================================================*/
/**************************************
	Trim 함수 (왼쪽)
***************************************/
function trimLeft(str) {
	var v_ret = "";

	if(str != null){
		var v_stop = 0;
		var v_length = str.length;
		for(var i = 0; i < v_length; i++){
			var v_char = str.charAt(i);
			if(v_char != " "){
				v_stop = i;
				break;
			}
		}
		v_ret = str.substring(i);
	}
	return v_ret;
}

/**************************************
	Trim 함수 (오른쪽)
***************************************/
function trimRight(str) {
	var v_ret = "";

	if(str != null){
		var v_stop = 0;
		var v_length = str.length;
		for(var i = (v_length -1); i > 0 ; i--){
			var v_char = str.charAt(i);
			if(v_char != " "){
				v_stop = i;
				break;
			}
		}
		v_ret = str.substring(0, i +1);
	}
	return v_ret;
}


/**************************************
	Trim 함수
***************************************/
function trim(str) {
	var v_ret = null;

	v_ret = trimLeft(str);
	v_ret = trimRight(v_ret);

	return v_ret;
}




/*======================================================================================*/
/*  Popup
/*  -----
/*  작성일		: 2014.12.8
/*  최종수정일	: 
/*	사용법		: popup();
/*
/*======================================================================================*/
function popup() {
	$.ajax({
		type: "post",  
		url: "/api/popup.php",
		success: function(d) {
			if(d.code == 200) { // 팝업이 있을 경우
				var html,name;
				var offsetX,offsetY;
				offsetX = 5;
				offsetY = 5;
				for(var i = 0 ; i < d.data.length ; i++) {
					html = "";
					name = "popup_" + d.data[i].no;
					if(getCookie(name) != 'Y' ) {
						// type 에 따라 처리
						if(d.data[i].type == "LAYER") {
							// html 코드 작성
							html  = '<div class="popup" ';
							html += '	style="top: ' + offsetY + 'px ; left : '+ offsetX + 'px; ';
							html += '		width:' + d.data[i].width + 'px;height:' + (parseInt(d.data[i].height) + 20) + 'px">';
							if(d.data[i].url != null) {
								html += '<a href="' + d.data[i].url + '" target="' + d.data[i].target + '">';
								html += '<img src="' + d.data[i].image + '"></a>';
							}
							else {
								html += '<img src="' + d.data[i].image + '"></a>';
							}
							html += '	<div class="foot">';
							html += '		<label><input type="checkbox"> 오늘 하루 이 창을 열지 않음</label>';
							html += '		<a href="javascript:;" onclick="popup_close(this);" data-name="' + name + '"></a>';
							html += '	</div>';
							html += '</div>';
							$('body').prepend(html);	// body 요소 앞에 추가

							// DROP 객체
							$('body').droppable({accept:'div.popup'});

							// DRAG 객체
							$('.popup').draggable({
								containment : "body",
								revert : "invalid"
							});
						}
						else if(d.data[i].type == "WINDOW") {
							var toppos = screen.height / 2 - d.data[i].height/2;
							var leftpos = screen.width / 2 - d.data[i].width/2;
							var popupWidth = d.data[i].width + 20;
							var popupHeight = d.data[i].height + 20;
							window.open("api/popup.php?no=" + d.data[i].no,"","toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=" + leftpos + ",top=" + toppos +", width="+popupWidth +"px, height="+popupHeight+"px");
						}
						offsetX += parseInt(d.data[i].width)+5;
					}
				}
			}
		},
		dataType:'json'
	});
}

function popup_close(obj) {
	if($(obj).parent().find("input:checked").length > 0) {
		setCookie($(obj).data("name"),"Y",1);
	}
	if($(obj).parent().parent().parent().parent().hasClass("popup-table")) {
		window.close();
	}
	else {
		$(obj).parent().parent().remove();
	}
}


/*======================================================================================*/
/*  쿠키 생성
/*  ------
/*  작성일		: 2014.12.08
/*  최종수정일	:
/*	사용법		: setCookie( 쿠키 이름, 쿠키 값, 만료 기간(일) )
/*======================================================================================*/
function setCookie( name, value, expiredays ) {
	var endDate = new Date();
	endDate.setDate(endDate.getDate()+expiredays);
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + endDate.toGMTString() + ";" ;
}

/*======================================================================================*/
/*  쿠키 삭제
/*  ------
/*  작성일		: 2014.12.08
/*  최종수정일	:
/*	사용법		: delCookie( 쿠키 이름 )
/*
/*======================================================================================*/
function delCookie(cKey) {
    // 동일한 키(name)값으로
    // 1. 만료날짜 과거로 쿠키저장
    // 2. 만료날짜 설정 않는다. 
    //    브라우저가 닫힐 때 제명이 된다    

    var date = new Date(); // 오늘 날짜 
    var validity = -1;
    date.setDate(date.getDate() + validity);
    document.cookie =
          cKey + "=;expires=" + date.toGMTString();
}

/*======================================================================================*/
/*  쿠키 가져오기
/*  --------
/*  작성일		: 2014.12.08
/*  최종수정일	:
/*	사용법		: getCookie( 쿠키 이름 )
/*
/*======================================================================================*/
function getCookie(name) {
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length ) {
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 ) break;
	}
	return "";
} 



/*======================================================================================*/
/*  페이징
/*  --------------
/*  작성일     : 2014.6.19
/*  최종수정일 : 2014.6.19
/*	사용법     : fnPaging(전체 갯수,현재 페이지,화면당 목록수,페이징 갯수,삽입 대상)
/*				 템플릿 안에 <_page> 로 페이징 삽입
/*======================================================================================*/
function paging(obj) {
	if(typeof obj != 'object' || 'total' in obj == false || 'el' in obj == false) {
		return;
	}
	if('page' in obj == false) obj.page = 1;
	if('row' in obj == false) obj.row = 20;
	if('show_paging' in obj == false) obj.show_paging = 9;
	
	let total_page = Math.ceil(obj.total/obj.row);

	// 이전 페이징
	let prev = obj.page - obj.show_paging;
	if(prev < 1) prev = 1;

	// 다음 페이징
	let next = obj.page + obj.show_paging;
	if(next > total_page) next = total_page;

	// 페이지 시작 번호
	let start = obj.page - Math.ceil(obj.show_paging / 2 ) + 1;
	if(start < 1) start = 1;

	// 페이지 끝 번호
	let end = start + obj.show_paging - 1;
	if(end > total_page) {
		end = total_page;
		start = end - obj.show_paging + 1;
		if(start < 1) start = 1;
	}
	if(end < 1) {
		total_page = 1;
		end = 1;
		next = 1;
		prev = 1;
		start = 1;
	}

	let paging = [];
	for(var i = start ; i <= end ; i++) {
		paging.push(`<li ${((i==obj.page)?'class="now"':'')} data-page="${i}">${i}</li>`);
	}
	$(obj.el).html(`
			<ul class="--paging">
				<li class="first" data-page="1"></li>
				<li class="prev" data-page="${prev}"></li>
				${paging.join("")}
				<li class="next" data-page="${next}"></li>
				<li class="last" data-page="${total_page}"></li>
			</ul>
		`);
	$(obj.el).find("ul.--paging > li").click(function() {
			if('fn' in obj == false) return;
			obj.fn($(this).data("page"));
		});
}



/*======================================================================================*/
/*  테스트 모드
/*  --------------
/*  작성일     : 2014.6.19
/*  최종수정일 : 2014.6.19
/*	사용법     : fnPaging(전체 갯수,현재 페이지,화면당 목록수,페이징 갯수,삽입 대상)
/*				 템플릿 안에 <_page> 로 페이징 삽입
/*======================================================================================*/
function log(str) {
	if(!is_ie()) {
		console.log(str);
	}
}


function only_num(obj){ 
	if (event.keyCode >= 48 && event.keyCode <= 57) {  
		//숫자일때 스크립트
	} 
	else {
		//숫자가 아닐때 스크립트
		event.returnValue = false; 
	}
}


/*======================================================================================*/
/*  커서 따라다니는 레이어
/*  ----------------------
/*  작성일     : 2011.11.06
/*  최종수정일 :
/*	사용법     :
/*
/*======================================================================================*/
function FollowCursorDiv(target,pop_layer_width) {
	var t = eval("document." + target);

	t.style.display = "block";

	// 마우스 좌표
	var dd = document.documentElement;	//최신버전의 브라우저들
	var db = document.body;				//구 버전의 브라우저들
	var scrollLeft=0;scrollTop=0;
 
	if(dd){
		scrollLeft	+= dd.scrollLeft; 
		scrollTop	+= dd.scrollTop;
	}
	else if(db){
		scrollLeft	+= db.scrollLeft;
		scrollTop	+= db.scrollTop;
	}

	var mouseX = event.clientX;
	var mouseY = event.clientY;

	if(dd){
		mouseX	+= dd.scrollLeft;
		mouseY	+= dd.scrollTop;
	}
	else if(db){
		mouseX	+= db.scrollLeft;
		mouseY	+= db.scrollTop;
	}

	// 위치 조정
	xpos = mouseX + 10;
	ypos = mouseY + 17;

	// 레이어가 화면 밖을 넘어설경우 위치 변경
	if(xpos + t.clientWidth + 40 > document.body.clientWidth) xpos -= t.clientWidth + 15;
	if(ypos + t.clientHeight > document.body.clientHeight) ypos = document.body.clientHeight - t.clientHeight - 10;

	// 레이어 이동
	t.style.left = xpos + 'px';
	t.style.top = ypos + 'px';


}

function pop_kill(target) {
	var t = eval("document." + target);

	t.style.display = "none";
}


/*======================================================================================*/
/*  천 단위 , 삽입
/*  ----------------------
/*  작성일     : 2011.11.06
/*  최종수정일 :
/*	사용법     :
/*
/*======================================================================================*/
function FormatNumber(n) {
	n = new String(n);
	var result = "";
	if (n != "free") {
		for(var i = 1 ; i <= n.length ; i++) {
			if((n.length - i+1)%3  == 0 && i > 1) result += ",";
			result += n.substr(i-1,1);
		}
	} else {
		result = n;
	}
	return result;
}

function number_format(n) {
	n = new String(n);
	var result = "";
	if (n != "free") {
		for(var i = 1 ; i <= n.length ; i++) {
			if((n.length - i+1)%3  == 0 && i > 1) result += ",";
			result += n.substr(i-1,1);
		}
	} else {
		result = n;
	}
	return result;
}


function UnFormatNumber(n) {
	var result = ""
	for(var i = 1 ; i <= n.length ; i++) {
		if (n.substr(i-1,1) != ",") result += n.substr(i-1,1);		
	}
	return result;
}

/**************************************
	숫자만 입력받기
***************************************/
function checkKeySint(obj) {
	if(event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 189 || event.keyCode == 46) return;	// backspace(8), tab(9), -(189), del(46)
	if((event.keyCode < 48 || event.keyCode > 57)) {
		event.returnValue = false;
	}
}


/*======================================================================================
 *  Ajax 로 div에 페이지 불러옴 (GET방식)
 *  --------------
 *  작성일     : 2012.07.13
 *  최종수정일 :
 *	사용법     :
 *
 *======================================================================================*/
function get(url,data,fn) {
	$.ajax({
		type: "get",
		url: url + ".php",
		data: param,
		success: fn
	});
}

/*======================================================================================*/
/*  한글여부 판단
/*  ----------------------
/*  작성일		: 2011.11.06
/*  최종수정일	:
/*	사용법		: onkeyup="is_korean(this.event)"
/*
/*======================================================================================*/
function is_korean(objStr) {
	for (i = 0; i < objStr.length; i++) {
		if (((objStr.charCodeAt(i) > 0x3130 && objStr.charCodeAt(i) < 0x318F) || (objStr.charCodeAt(i) >= 0xAC00 && objStr.charCodeAt(i) <= 0xD7A3))) {
			return false;      // 한글 포함이면 false 반환
		}
	}
	return true;       // 한글 미포함이면 true 반환
}﻿ 


/*======================================================================================*/
/*  이메일 형식 검사
/*  -------------
/*  작성일    : 2011.11.06
/*  최종수정일 :
/*	사용법    :
/*
/*======================================================================================*/
function is_email(email) {
	email = trim(email);
	var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   
	return regex.test(email);
}



function sendSns(sns, url, txt)
{
    var o;
    var _url = encodeURIComponent(url);
    var _txt = encodeURIComponent(txt);
    var _br  = encodeURIComponent('\r\n');
 
    switch(sns)
    {
        case 'facebook':
            o = {
                method:'popup',
                url:'http://www.facebook.com/sharer/sharer.php?u=' + _url
            };
            break;
 
        case 'twitter':
            o = {
                method:'popup',
                url:'http://twitter.com/intent/tweet?text=' + _txt + '&url=' + _url
            };
            break;
 
        case 'me2day':
            o = {
                method:'popup',
                url:'http://me2day.net/posts/new?new_post[body]=' + _txt + _br + _url + '&new_post[tags]=epiloum'
            };
            break;
 
        case 'kakaotalk':
            o = {
                method:'web2app',
                param:'sendurl?msg=' + _txt + '&url=' + _url + '&type=link&apiver=2.0.1&appver=2.0&appid=com.helix.popeveryday&appname=' + encodeURIComponent('POP Everyday'),
                a_store:'itms-apps://itunes.apple.com/app/id362057947?mt=8',
                g_store:'market://details?id=com.kakao.talk',
                a_proto:'kakaolink://',
                g_proto:'scheme=kakaolink;package=com.kakao.talk'
            };

            break;
 
        case 'kakaostory':
			/*
            o = {
                method:'web2app',
                param:'posting?post=' + _txt + _br + _url + '&apiver=1.0&appver=2.0&appid=dev.epiloum.net&appname=' + encodeURIComponent('Epiloum 개발노트'),
                a_store:'itms-apps://itunes.apple.com/app/id486244601?mt=8',
                g_store:'market://details?id=com.kakao.story',
                a_proto:'storylink://',
                g_proto:'scheme=kakaolink;package=com.kakao.story'
            };
			*/
			o = {
				method:'popup',
				url:'https://story.kakao.com/share?url=' + _url +"&text="+_txt
			};
            break;
 
        case 'band':
            o = {
                method:'web2app',
                param:'create/post?text=' + _txt + _br + _url,
                a_store:'itms-apps://itunes.apple.com/app/id542613198?mt=8',
                g_store:'market://details?id=com.nhn.android.band',
                a_proto:'bandapp://',
                g_proto:'scheme=bandapp;package=com.nhn.android.band'
            };
            break;
 
        default:
            alert('지원하지 않는 SNS입니다.');
            return false;
    }
 
    switch(o.method)
    {
        case 'popup':
            window.open(o.url);
            break;
 
        case 'web2app':
            if(navigator.userAgent.match(/android/i))
            {
                // Android
                setTimeout(function(){ location.href = 'intent://' + o.param + '#Intent;' + o.g_proto + ';end'}, 100);
            }
            else if(navigator.userAgent.match(/(iphone)|(ipod)|(ipad)/i))
            {
                // Apple
                setTimeout(function(){ location.href = o.a_store; }, 200);          
                setTimeout(function(){ location.href = o.a_proto + o.param }, 100);
            }
            else
            {
                alert('이 기능은 모바일에서만 사용할 수 있습니다.');
            }
            break;
    }
}

//글자 길이 체크
function getByte_length(str){
	var resultSize = 0;
	if(str == null){
		return 0;
	}
	for(var i=0; i<str.length; i++){
		var c = escape(str.charAt(i));
		if(c.length == 1){
			resultSize ++;
		}else if(c.indexOf("%u") != -1){
			resultSize += 2;
		}else if(c.indexOf("%") != -1){
			resultSize += c.length/3;
		}
	}
	return resultSize;
}
 
 //글자 길이 초과시 지정된 길이만큼만 리턴
String.prototype.cutByte = function(len) {
	var str = this;
	var count = 0;

	for(var i = 0; i < str.length; i++) {
		if(escape(str.charAt(i)).length >= 4){
		count += 2;
	}
	else {
		if(escape(str.charAt(i)) != "%0D")
			count++;
		}
		if(count >  len) {
			if(escape(str.charAt(i)) == "%0A") i--;
			break;
		}
	}
	return str.substring(0, i);
}

function bookmark(obj) {
	var url = $(obj).attr("href");
	var title = $(obj).attr("title");
	 
	if (window.sidebar) { // Mozilla Firefox Bookmark
		window.sidebar.addPanel(title, url,"");
	} else if(document.all ) { // IE Favorite
		window.external.AddFavorite( url, title);
	} else if(window.opera) { // Opera 7+
		return false; // do nothing - the rel="sidebar" should do the trick
	} else { // for Safari, Konq etc - browsers who do not support bookmarking scripts (that i could find anyway)
		alert("Ctrl+D키를 누르시면 즐겨찾기에 추가하실 수 있습니다.");
	} 
};

function favorite(href,title) {
	if (window.sidebar) { // Mozilla Firefox Bookmark
		window.sidebar.addPanel(title, url,"");
	} else if(document.all ) { // IE Favorite
		window.external.AddFavorite( url, title);
	} else if(window.opera) { // Opera 7+
		return false; // do nothing - the rel="sidebar" should do the trick
	} else { // for Safari, Konq etc - browsers who do not support bookmarking scripts (that i could find anyway)
		alert("Ctrl+D키를 누르시면 즐겨찾기에 추가하실 수 있습니다.");
	}
}

/** 
* 폼요소 초기화 
* Reset form element
* 
* @param e jQuery object
*/
function resetFormElement(e) {
	e.wrap('<form>').closest('form').get(0).reset(); 
	e.unwrap();
}


/*======================================================================================*/
/*  Modal Popup
/*  --------------
/*  작성일		: 2014.5.5
/*  최종수정일	: 2018.1.2
/*	사용법		: modal(페이지, 전달 값)
/*
/*======================================================================================*/
function modal(url,data) {
	$.ajax({
		type: "post",
		url: `/_modal${location.pathname}/${url}`,
		dataType: "html",
		data: data,
		error: function(msg) {
			alert("레이아웃을 불러들이는데 실패하였습니다.");
		},
		success: function(d) {
			$("body").addClass("on-modal").append(`
				<div class='modal anim-ease-02'>
					<div class='con anim-ease-02'>${d}</div>
				</div>
			`);
			ui();
			setTimeout(function() {
				$(".modal").last().addClass("on");
				_prepare($(".modal").last());
			},10);
		}
	});
}

function modal_close(close_yn) {
	var obj = $(".modal").last();

	$(obj).addClass("off");

	setTimeout(function() {
		$(obj).removeClass("on")
		$("body").removeClass("on-modal");
		if(typeof(close_yn)=="undefined" || close_yn == false) {
			$(obj).remove();
		}
	},500);
}


/* 토스트 메시지 */
function toast(msg,duration) {
	var timestamp = new Date().getTime();

	if(typeof(duration) == "undefined") duration = 3;
	if($("body > .toast").length > 0) {
		$("body > .toast").data("timestamp",timestamp).html(msg);
	}
	else {
		$("body").append('<div class="toast" data-timestamp="' + timestamp + '">' + msg + '</div>');
		setTimeout(function() {
			$("body > .toast").addClass("on");
		},300);
	}
	$("body > .toast").css({"margin-left":-($("body > .toast").width()/2) + "px"});

	setTimeout(function() {
		if(timestamp == $("body > .toast").last().data("timestamp")) {
			$("body > .toast").removeClass("on");
			setTimeout(function() {
				if(timestamp == $("body > .toast").last().data("timestamp")) {
					$("body > .toast").remove();
				}
			},300);
		}
	},(duration*1000)+300);
}







function image_delete(obj) {
	$(obj).parent().find("input").wrap('<form>').closest('form').get(0).reset(); 
	$(obj).parent().find("input").unwrap();
	$(obj).remove();
}

function image_view() {
	
}




function image_preview(obj,file) {
	var ext,html,is_sort = false,area = $(obj).parent().parent();
	var is_image = false;

	if($(obj).parent().parent().data("sort")==true) is_sort = true;

	ext = file.name.split('.').pop().toLowerCase(); //확장자

		//배열에 추출한 확장자가 존재하는지 체크
	if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
		if($(obj).parent().parent().parent().hasClass("image") == true) {
			$(this).wrap('<form>').closest('form').get(0).reset(); 
			$(this).unwrap();
			alert('이미지 파일이 아닙니다. gif, png, jpg, jpeg만 업로드 가능합니다.');
			return false;
		}
	} else {
		is_image = true;
		blobURL = window.URL.createObjectURL(file);
	}

	if(is_image) {
		html  = '<div class="item no-icon" style="background-image:url(\'' + blobURL + '\')">';
		html += '	<div class="tools">';
		html += '		<a onclick="image_delete($(this).parent().parent());"><i class="xi-trash"></i></a>';
		html += '		<a onclick="image_view();"><i class="xi-magnifier-expand"></i></a>';
		html += '	</div>';
		if(is_sort) html += '	<a><i class="xi-arrows"></i></a>';
		html += '</div>';
	}
	else {
		html  = '<div class="item">';
		html += '	<div class="tools">';
		html += '		<a onclick="image_delete($(this).parent().parent());"><i class="xi-trash"></i></a>';
		html += '	</div>';
		html += '	<div class="filename '+ ext + '">' + file.name + '</div>';
		if(is_sort) html += '	<a><i class="xi-arrows"></i></a>';
		html += '</div>';
	}
	$(obj).parent().before(html);

	if(is_sort == true) {
		$(area).sortable({
			connectWith: $(area),
			containment: $(area),
			items: ".item:not(.disabled)",
			cancel: ".disabled",
			handle: ".xi-arrows",
			placeholder: "item",
			update: function (event, ui) {

			}
		});
	}
}





function login_naver() {
}

function login_kakao(is_member,no_member) {
	Kakao.Auth.login({
		success: function(authObj) {
			var access_token = authObj.access_token;
			var token_type = authObj.token_type;
			var refresh_token = authObj.refresh_token;
			var refresh_token_expires_in = authObj.refresh_token_expires_in;
			var scope = authObj.scope;

			Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
					var values = new Object();
					values.sns = "kakao";
					values.email = res.kaccount_email;
					values.id = res.id;
					values.profile_image = res.properties.profile_image;
					values.nickname = res.properties.nickname;
					values.thumbnail_image = res.properties.thumbnail_image;

					
				},
				fail: function(error) {
					alert(JSON.stringify(error));
				}
			});
		},
		fail: function(err) {
			alert(JSON.stringify(err));
		}
	});
}

function login_facebook() {

}





function join_naver() {
}

function join_kakao(is_member,no_member) {
	Kakao.Auth.login({
		success: function(authObj) {
			var access_token = authObj.access_token;
			var token_type = authObj.token_type;
			var refresh_token = authObj.refresh_token;
			var refresh_token_expires_in = authObj.refresh_token_expires_in;
			var scope = authObj.scope;

			Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
					var values = new Object();
					values.sns = "kakao";
					values.email = res.kaccount_email;
					values.id = res.id;
					values.profile_image = res.properties.profile_image;
					values.nickname = res.properties.nickname;
					values.thumbnail_image = res.properties.thumbnail_image;

					
				},
				fail: function(error) {
					alert(JSON.stringify(error));
				}
			});
		},
		fail: function(err) {
			alert(JSON.stringify(err));
		}
	});
}

function join_facebook() {
}

function nl2br(str) {
	return str.replaceAll("\\n","<br>");
}

function list_query(query) {
	if(query == undefined) query = "";
	query += "&" + $("#frm_list").serialize();
	if($("#frm_list_search").length > 0) query += "&" + $("#frm_list_search").serialize();
	$("th.sort").each(function() {
		query += "&sort_" + $(this).data("query") + "=";
		if($(this).hasClass("asc")) query += "asc";
		else if($(this).hasClass("desc")) query += "desc";
	});
	//query += "&m=list"

	return query;
}

(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};

		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);

			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
			increment = (settings.to - settings.from) / loops;

			// references & variables that will change with each update
			var self = this,
			$self = $(this),
			loopCount = 0,
			value = settings.from,
			data = $self.data('countTo') || {};

			$self.data('countTo', data);

			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);

			// initialize the element with the starting value
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;

				render(value);

				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}

				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;

					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};

	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));


/*======================================================================================*/
/*  기본 함수 정의
/*  --------------
/*  작성일     : 2014.6.19
/*  최종수정일 :
/*	사용법     :
/*
/*======================================================================================*/
//공백 제거
String.prototype.trim = function() {
  return this.replace(/(^\s*)|(\s*$)/gi, "");
}

// 문자열 치환
String.prototype.replaceAll = function(str1, str2) {
  var temp_str = this.trim();
  temp_str = temp_str.replace(eval("/" + str1 + "/gi"), str2);
  return temp_str;
}


// 폼 검사 함수
$.fn.formvaild = function() {
	var result = true;
	$(this).find("input").each(function() {
		if($(this).attr("required")=="required") {	// 필수값 입력 항목일 경우
			var name = $(this).next("label").html();
			var max = $(this).attr("maxlength");
			var min = $(this).attr("minlength");
			var confirm = $(this).attr("confirm");
			var val_len	= $(this).val().length;

			if($(this).val().trim() == "") {		// 필수값 입력 검사
				toast(name + "은(는) 반드시 입력해야 합니다");
				if(result == true) $(this).focus();	// 첫 오류일 경우 포커스 이동
				$(this).addClass("input-required");	// 배경색 변환
				result = false;
			}
			else if(val_len < min || val_len > max) {
				toast("최소 " + min + "자 이상 " + max + "자 이내로 입력해야 합니다");
				if(result == true) $(this).focus();	// 첫 오류일 경우 포커스 이동
				$(this).addClass("input-required");	// 배경색 변환
			}
			else if(confirm != undefined && $(this).val() != $("input[name='" + confirm + "']").val()) {
				if(result == true) $(this).focus();	// 첫 오류일 경우 포커스 이동
				$(this).addClass("input-required");	// 배경색 변환
				toast(name + "이(가) 일치해야 합니다");
				result = false;
			}
			else {
				$(this).removeClass("input-required");	// 배경색 변환
			}
		}
	});
	return result;
}


function ui() {
	// 체크박스 토글
	$("input[type=checkbox].checkbox-all-toggle").click(function() {
		var val = $(this).prop("checked");
		$("#" + $(this)[0].form.id).find("input[name=no]").prop("checked",val);
	});

	// 테이블 : 정렬
	$("th.sort").click(function() {
		if($(this).hasClass("asc")) {
			$(this).removeClass("asc");
			$(this).addClass("desc");
		}
		else if($(this).hasClass("desc")) {
			$(this).removeClass("desc");
		}
		else {
			$(this).addClass("asc");
		}
		list("page=1");
	});


	// 탭 관련
	$("ul.tab li a,ul.tab-left li a").click(function() {
		var no = $(this).parent().index();
		$(this).parent().siblings().find("a").removeClass("active"); // 기 선택되어 있는 탭 해제
		$(this).addClass("active"); // 해당 탭 클래스 변경
		$("#" + $(this).data("role")+" > div").removeClass("hidden").hide(); // 기존 탭내용 숨김
		$("#" + $(this).data("role")+" > div").eq(no).show(); // 해당 탭 표시
	});
	$("ul.tab-left > li,ul.tab > li").eq(0).children("a").click();

	/** 아코디언 **/
	$("dl.accordion dt > a").click(function() {
		console.log(this);
		$(this).parent().next().slideToggle('fast');
	});

	// 탭메뉴 클릭
	$("ul.ver-inline-menu li a").click(function() {
		if($(this).parent("li").hasClass("add")) {	// 추가 아이콘 클릭
			console.log($(this));
		}
		else {
			if($(this).find("i.fa-minus-square").css("display") == "block") {	// 탭 삭제 아이콘 클릭시
				modal_confirm($(this).find("i.fa-minus-square").data("confirm-title"),"삭제 시 추후 복구가 불가능합니다.<br><br><strong>정말 삭제하시겠습니까?</strong>",$(this).find("i.fa-minus-square").data("confirm-script"));
				console.log($(this));
			}
			else {	// 탭 선택
				$(this).parent().siblings().removeClass("active"); // 기 선택되어 있는 탭 해제
				$(this).parent().addClass("active");
			}
		}
	});


	/** Spinner 동작 **/
	$("div.spinner > button.spinner-up,div.spinner > button.spinner-down").click(function() {
		var t = $(this).siblings(".spinner-inp");
		var val = $(t).val();
		var min = parseInt($(t).attr("min"));
		var max = parseInt($(t).attr("max"));
		if($(this).hasClass("spinner-up")) {
			if(val < max) val++;
		}
		else if($(this).hasClass("spinner-down")) {
			if(val > min) val--;
		}
		$(t).val(val);
	});


	/** DATE PICKER **/
	$("input[type=date]").datepicker({
		dateFormat: 'yy-mm-dd',
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		changeMonth: true, //월변경가능
		changeYear: true, //년변경가능
		yearRange:'1900:+10', // 연도 셀렉트 박스 범위(현재와 같으면 1988~현재년)
		showMonthAfterYear: true, //년 뒤에 월 표시
		autoSize: false, //오토리사이즈(body등 상위태그의 설정에 따른다)
		//buttonImageOnly: true, //이미지표시  
		//buttonText: '날짜를 선택하세요', 
		//buttonImage: '/wtm/images/egovframework/wtm2/sub/bull_calendar.gif', //이미지주소 /wtm/images/egovframework/wtm2/sub/bull_calendar.gif
		//showOn: "both" //엘리먼트와 이미지 동시 사용
	});


	/** TIME PICKER **/
	$("input[type=time]").timepicker({
		"timeFormat" : "H:i"
	});

	/** COLOR PICKER **/
	$('input.color-picker').ColorPicker({
		color: '#0000ff',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('input.color-picker').last().css('backgroundColor', '#' + hex);
			$('input.color-picker').last().val('#' + hex);
		}
	});


	/** 입력 형식 **/
	$("input.phone").mask("000-0000-0000");
	$("input.zipcode").mask("000-000");


	/** 이미지 미리보기 **/
	$('input[type=file].input-image').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			$(this).wrap('<form>').closest('form').get(0).reset(); 
			$(this).unwrap();
			alert('이미지 파일이 아닙니다. (gif, png, jpg, jpeg 만 업로드 가능)');
		} else {
			file = $(this).prop("files")[0];
			blobURL = window.URL.createObjectURL(file);
			if($(this).parent().find("img").length > 0) {
				$(this).parent().find("img").attr('src', blobURL);
			}
			else {
				$(this).parent().parent().find("img.preview").attr('src', blobURL);
			}
		}
	});

	/** 순서 드래그 **/
	$( ".dragable-vertical" ).sortable({
		connectWith: ".dragable-vertical",
		items: "tr:not(.disabled)",
		cancel: ".disabled",
		handle: ".cursor-move",
		placeholder: "dragable-placeholder",
		containment: ".dragable-vertical",
		scroll: false,
		update: function (event, ui) {
			var idxs = "";
			$(this).find("tr").each(function() {
				if($(this).attr("data-no") != undefined) {
					if(idxs != "") idxs += ",";
					idxs += $(this).attr("data-no");
				}
			});

			// 정리된 순서를 db에 업데이트
			$.ajax({
				type: "post",  
				dataType: "json",
				url: $(this).data("sorturl"),
				data: "seq=" + idxs,
				success: function(d) {
					if(d.code == 200) {
						toast("성공적으로 순서를 저장했습니다");
					}
					else {
						alert(d.msg);
					}
				},
				error: function() {
					alert("저장을 실패했습니다.");
				}
			});
		}
	});

}



function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
};

function apply_counter() {
	$('.count-number').data('countToOptions', {
		formatter: function (value, options) {
			return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
		}
	});
	$('.count-number').each(count);

}


function alert(str,fn) {
	$("body").append(`
		<div class="modal anim-ease-02">
			<div class="con alert anim-ease-02">
				${str}
				<div class="footer"><a href="javascript:;" class="btn red">확인</a></div>
			</div>
		</div>
	`);
	var obj = $("body > div.modal").last();
	setTimeout(function(_obj) {
		$(_obj).addClass("on");
	},10,obj);
	$(obj).find("a.btn.red").click(function() {
		modal_close();
		if(typeof fn == 'function') setTimeout(fn,20);
	});
}

function confirm(str,fn) {
	var html = '';
	html  = '<div class="modal anim-ease-02">';
	html += '	<div class="con alert anim-ease-02">';
	html +=		str;
	html += '	<div class="footer">';
	html += '		<a href="javascript:;" onclick="modal_close();" class="btn">취소</a>';
	if(typeof fn == 'function') {
		html += '		<a href="javascript:;" class="btn red">확인</a>';
	}
	else {
		html += '		<a href="javascript:;" onclick="modal_close();setTimeout(\'' + fn + '\',250);" class="btn red">확인</a>';
	}
	html += '	</div>';
	html += '</div>';

	$("body").append(html);
	setTimeout(function() {
		$("body > div.modal:last-child").addClass("on");
	},10);
	
	if(typeof fn == 'function') {
		$("body > div.modal:last-child a.btn.red").click(function() {
			modal_close();
			setTimeout(fn,250);
		});
	}
}

function view_footer_position() {
	var window_scrolltop = $(window).scrollTop();
	var window_height = $(window).height();
	var body_height = $("body").height();
	var gnb_height = $("#gnb > ul").height()+$("#footer").height()+10;
	var top_pos = (window_height+window_scrolltop)-30;
	$("#footer").css("top",top_pos + "px");

	/*
	if(body_height-window_scrolltop<gnb_height) {
		$("#gnb").css("top",(body_height-window_scrolltop-gnb_height)+"px");
	} else {
		$("#gnb").css("top","0px");
	}
	*/
}

function view_paging() {
}



function modal_close() {
	$(".modal").last().removeClass("on");
	setTimeout(function() {
		$(".modal").last().remove();
		if($(".modal").length == 0) {
			$("body").removeClass("on-modal");
		}
	},210);
}

function modal_cancel(str) {
	if(str == undefined || str == "") str = "작성을 취소할까요?";
	confirm(str,'modal_close()');
}

function modal_submit(obj,function_name) {
	let fn,str = "이대로 작성을 진행할까요?";
	switch(typeof(obj)) {
		case 'string':
			str = obj;
		break;
		case 'object':
		break;
	}
	
	confirm(str,'modal_submit_confirm(' + function_name + ')');
}

function modal_submit_confirm(function_name) {
	var f = $("form").last();
	if($(f).formvaild()) {
		if(tinymce) tinymce.triggerSave();
		$.ajax({
			url: config.api + $(f).attr("action"),
			data: new FormData($(f)[0]),
			type: "post",  
			processData:false,
			contentType:false,
			dataType: "json",
			success: function(d) {
				if(d.code == 200) {
					toast("자료 저장에 성공하였습니다.");
					if(typeof list == 'function') list();
					modal_close();
					if (function_name != null) {
						function_name.call();
					}
				}
				else {
					alert(d.msg);
				}
			},
			error: function() {
				toast("자료 전송에 실패하였습니다.");
			}
		});
	}
}

function fn_submit(f) {
	var f = $(f);
	
	if($(f).formvaild()) {
		$.ajax({
			url: $(f).attr("action"),
			data: new FormData($(f)[0]),
			type: "post",  
			processData:false,
			contentType:false,
			dataType: "json",
			success: function(d) {
				if(d.code == 200) {
					toast("환경 저장에 성공하였습니다.");

					$(f).find("input[type=password]").val("");
				}
				else {
					toast(d.msg);
				}
				modal_close();
			},
			error: function() {
				toast("환경 저장에 실패하였습니다.");
			}
		});
	}
}


function list_search(b) {
	if(b==true) {
		
	}
	else {
		frm_list.reset();
		list('page=1');
	}
}

function list_query(query) {
	if(query == undefined) query = "";
	query += "&" + $("#frm_list").serialize();
	if($("#frm_list_search").length > 0) query += "&" + $("#frm_list_search").serialize();
	$("th.sort").each(function() {
		query += "&sort_" + $(this).data("query") + "=";
		if($(this).hasClass("asc")) query += "asc";
		else if($(this).hasClass("desc")) query += "desc";
	});
	query += "&m=list"

	return query;
}

function fnsubmit(obj) {
	$.ajax({
		url: $(obj).attr("action"),
		data: new FormData($(obj)[0]),
		type: "post",  
		processData:false,
		contentType:false,
		dataType: "json",
		success: function(d) {
			if(d.code == 200) {
				toast("자료 저장에 성공하였습니다.");
			}
		},
		error: function() {
			toast("자료 전송에 실패하였습니다.");
		}
	});
}


function loading(s) {
}



var _modal_confirm_vars;
function select_delete(f) {
	_modal_confirm_vars = f;
	if(!select_idx(f)) return false;
	confirm("삭제 후 복구가 불가능합니다. 신중히 삭제해주세요.<br>삭제할까요?",'select_delete_ok()');
}

function select_idx(f) {
	var idxs = "0";

	$(f).find("input[type=checkbox][name=no]:checked").each(function() {
		idxs += "," + $(this).val();
	});

	if(idxs == "0") {
		idxs = false;
		toast("선택된 항목이 없습니다");
	}

	return idxs;
}

var select_delete_ok = function() {
	var f = _modal_confirm_vars;
	var idxs = select_idx(f);
	if(idxs != false) {
		$.ajax({
			url: $(f).attr("action") + "/?m=del",
			data: "no=" + idxs,
			type:'POST',
			error:function(){
				alert("삭제 실패하였습니다");
			},
			success:function(d){
				list();
				_modal_confirm_vars = null;
			},
			dataType:'json'
		});
	}
}


function zipcode(obj) {
	html  = "<div class='modal anim-ease-02'>\n";
	html += "	<div class='con anim-ease-02'>";
	html += '		<div class="body">';
	html += '			<h1>우편번호 검색<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close-thin"></i></a></h1>';
	html += '			<div class="contents width-600-min height-800" id="modal-zipcode">';
	html += '			</div>	\n';
	html += '		</div>';
	html += '	</div>';
	html += '</div>';
	$("body").addClass("on-modal").append(html);
	setTimeout('$(".modal").addClass("on");',10);

	new daum.Postcode({
		oncomplete: function(data) {
			// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			
			var fullAddr = data.address; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 기본 주소가 도로명 타입일때 조합한다.
			if(data.addressType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			var obj_p = $(obj).parent();
			$(obj_p).find("input.zipcode").val(data.zonecode);
			$(obj_p).find("input[type=text]").eq(0).val(fullAddr);

			modal_close();
		},
		width : '100%',
		height : '100%',
		maxSuggestItems : 5
	}).embed(document.getElementById("modal-zipcode"));
}


/* 토스트 메시지 */
var _toast_count = 0;
function toast(msg,duration) {
	if(duration == undefined) duration = 2;

	_toast_count++;
	html = "<div class='toast' id='toast-" + _toast_count + "'>" + msg + "</div>";
	$("body").append(html);
	var _left = $("#toast-" + _toast_count).width()/2;
	$("#toast-" + _toast_count).css({"margin-left":-(_left) + "px"});
	setTimeout("toast_close(" + _toast_count + ")",(duration*1000)+300);
	$('#toast-' + _toast_count).animate({"opacity":"1"},{duration:300});
}

function toast_close(n) {
	$('#toast-' + n).animate({"opacity":"0"},{duration:300,complete:function() {
		$('#toast-' + n).remove();
	}});
}


function number_format(n) {
	n = new String(n);
	var result = "";
	if (n != "free") {
		for(var i = 1 ; i <= n.length ; i++) {
			if((n.length - i+1)%3  == 0 && i > 1) result += ",";
			result += n.substr(i-1,1);
		}
	} else {
		result = n;
	}
	return result;
}

function generateUUID(format) {
	var d = new Date().getTime();
	if( window.performance && typeof window.performance.now === "function" ) {
		d += performance.now();
	}

	if(typeof format != "string") format = 'xxxx1xxxyxxxxxx3xxxx';

	var uuid = format.replace(/[xy]/g, function(c) {
		var r = (d + Math.random()*16)%16 | 0;
		d = Math.floor(d/16);
		return (c=='x' ? r : (r&0x3|0x8)).toString(16);
	});

	return uuid;
}

function tel_format(tel) {
	if(typeof tel != "string") return tel;

	if((tel).length < 10) return tel;
	var result = tel.substr(0,3) + '-';
	tel = (tel).toString();
	switch(tel.length) {
		case 10:
			result += tel.substr(3,3);
			break;
		case 11:
			result += tel.substr(3,4);
			break;
	}
	return ((tel != '')?result + '-' + tel.substr(-4):'');
}
