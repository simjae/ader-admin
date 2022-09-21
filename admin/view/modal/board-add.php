<?php
/*
 +=============================================================================
 | 
 | 게시글 삭제 API
 | -------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.8.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include '../../../../_resource/head.php'; 
include '_inc.php'; 

$img = '<img>';
if($image) $img='<img src="'.$image.'" style="height:100%">';
if($reg_date == '') $reg_date = date('Y-m-d');

if($mode == 'reply') {
	$title = 'Re: '.$title;
	$contents_h  = '<br><br><br><br>';
	$contents_h .= '-----------------------------------------------------';
	$contents_h .= '-----------------------------------------------------<br><br>';
	$contents = $contents_h.$contents;
	$depth++;
	$father = $no;
	$father_status = $status;
}
else {
	$father = '0';
	if($no) $mode = 'modify';
	else {
		$status = 'Y';
	}
}
?>

<div class="body">
	<h1>게시판 글<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a></h1>
	<div class="contents">
		<form action="/modules/board/board/?m=add">
		<input type="hidden" name="depth" value="<?=$depth?>">
		<input type="hidden" name="father" value="<?=$father?>">
		<input type="hidden" name="status" value="<?=$status?>">
		<input type="hidden" name="bbscode" value="<?=$bbscode?>">
		<input type="hidden" name="no" value="<?=$no?>">
		<input type="hidden" name="mode" value="<?=$mode?>_ok">

		<div class="form-group">
			<input type="text" name="title" value="<?=$title?>" maxlength="50" required>
			<label class="control-label">제목</label>
		</div>

		<div class="form-group">
			<input type="text" name="name" value="<?=$name?>" maxlength="10" required>
			<label class="control-label">작성자</label>
		</div>

		<div class="form-group">
			<input type="date" name="regdate" value="<?=$reg_date?>" required>
			<label class="control-label">작성일자</label>
		</div>

		<?php if($_BOARD['USE_CATEGORY']) { ?>
		<div class="form-group">
			<select name="CATEGORY">
				<?php for($i=0;$i<sizeof($_BOARD['CATEGORY'])-1;$i++) { ?>
				<option <?if($category==$_BOARD['CATEGORY'][$i]) echo 'selected'; ?>><?=$_BOARD['CATEGORY'][$i]?></option>
				<?php } ?>
			</select>
			<label class="control-label">분류</label>
		</div>
		<?php } ?>

		<div class="form-group">
			<div class="switch">
				<input type="checkbox" name="notice" value="Y" <?php if($notice == 'Y') echo 'checked';?>>
				<div class="switch-container">
					<span class="label on">ON</span><span class="button"></span><span class="label off">OFF</span>
				</div>
			</div>
			<label class="control-label">공지사항(상단노출)</label>
		</div>

		<?php if($_BOARD['USE_COVER']) { ?>
		<div class="form-group">
			<div class="form-row">
				<div class="fileinput fileinput-exists" data-provides="fileinput">
					<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;" id="image_preview"><?=$img?></div>
				</div>

				<span class="btn btn-large blue" style="position:relative">
					<i class="fa fa-photo"></i> 선택
					<input type="hidden" value="" name=""><input type="file" name="IMG" id="image" style="width:100%;height:100%;opacity:0;top:0;left:0;position:absolute;">
				</span>
			</div>
			<label class="control-label">커버이미지</label>
		</div>
		<?php } ?>

		<?php if($_BOARD['USE_DATA']) { ?>
		<div class="form-group">
			<div class="form-row">
				<span class="btn btn-success fileinput-button">
					<i class="xi-plus"></i>
					<span>파일 선택</span>
					<!-- The file input field used as target for the file upload widget -->
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<!-- The global progress bar -->
				<div id="progress" class="progress"><div class="progress-bar progress-bar-success"></div></div>
				<!-- The container for the uploaded files -->
				<div id="files" class="files">
					<?php 
					if(is_array($file)) {
						for($i=0;$i<sizeof($file)-1;$i++) {
					?>
					<a class="btn-popover" data-popover="delete" data-popover-confirm="board/board-del.proc" data-popover-query="bbscode=<?=$bbscode?>&no=<?=$no?>" data-target="board-list" data-url="board/board-list" data-query="<?=$query_list?>"><i class='fa fa-trash-o'></i> <?=$file[$i]?></a>
					<?
						}
					}
					?>
				</div>
				<input type="hidden" id="filelist" name="filelist" value="<?=$filelist?>">
			</div>
			<label class="control-label">파일첨부</label>
		</div>
		<?php } ?>

		<?php if($_BOARD['USE_SUBSCRIBE']) { ?>
		<div class="form-group">
			<input type="text" class="number-4" name="subscribe_num" value="<?=$subscribe_num?>" required> 명 
			<label class="control-label">최대 모집 인원</label>
		</div>
		<?php } ?>

		<div class="form-group padding-left-0">
			<textarea id="ARTICLES_CONTENTS" name="contents" style="width:99%;height:400px" required><?=$contents?></textarea>
		</div>
	</div>
	</form>
	<div class="footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="fn_submit();" class="btn red"><i class="xi-check"></i>완료</a>
	</div>
</div>

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
	/*
    var url = '../upload/_board/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //$('<span/>').html("<i class='fa fa-trash-o'></i> " + file.name).appendTo('#files');
				$('#files').append("<a onClick='popover(\"파일 삭제\",\"삭제하시겠습니까?\",\"delfiles()\")'><i class='fa fa-trash-o'></i> " + file.name + "</a>");

				$("#filelist").val($("#filelist").val() + file.name + "||");
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	*/
});

var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ARTICLES_CONTENTS",
	sSkinURI: "/js/smarteditor2/SmartEditor2Skin.html",
	fCreator: "createSeditor2"
});

function insertIMG(irid,fileame) {
	var sHTML = "<img src='" + fileame + "' border='0'>";
	oEditors.getById[irid].exec("PASTE_HTML", [sHTML]);
}

function pasteHTMLDemo(){
	sHTML = "<span style='color:#FF0000'>이미지 등도 이렇게 삽입하면 됩니다.</span>";
	oEditors.getById["ARTICLES_CONTENTS"].exec("PASTE_HTML", [sHTML]);
}

function fn_submit(){
	var f = $("form").last();
	oEditors.getById["ARTICLES_CONTENTS"].exec("UPDATE_CONTENTS_FIELD", []);
	modal_submit();
}

$('#image').on('change', function() {
	ext = $(this).val().split('.').pop().toLowerCase(); //확장자
	//배열에 추출한 확장자가 존재하는지 체크
	if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
		resetFormElement($(this)); //폼 초기화
		alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
	} else {
		file = $('#image').prop("files")[0];
		blobURL = window.URL.createObjectURL(file);
		$('#image_preview img').attr('src', blobURL);
		$('#image_preview').slideDown(); //업로드한 이미지 미리보기 
	}
});

$('#image_preview a').bind('click', function() {
	resetFormElement($('#image')); //전달한 양식 초기화
	$('#image').slideDown(); //파일 양식 보여줌
	$(this).parent().slideUp(); //미리 보기 영역 감춤
	return false; //기본 이벤트 막음
});
</script>