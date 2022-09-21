<!-- START RESPONSE CARD -->
<style>
    input::placeholder {
        color: #707070;
        text-align: center;
    }

    textarea {
        padding: 10px;
        border: 1px solid #000;
    }

    textarea::placeholder {
        color: #707070;
    }

    textarea:focus {
        outline: none;
    }

    .page__wrap {
        width: 100%;
        display: grid;
        grid-template-columns: 2fr 1fr;
        column-gap: 10px;
    }

    .edit__wrap {
        border: 1px dashed #000;
        padding: 10px;
    }

    .edit__contnet__wrap {
        display: grid;
        row-gap: 20px;
    }

    .edit__contnet__wrap>div {
        /*border: 1px solid red;*/
        text-align: center;
    }

    .edit__img {
        display: contents;
    }

    .edit__img img {
        width: 100%;
    }

    .preview__wrap {
        border: 1px dashed #000;
        padding: 10px;
    }

    .edit__input__wrap {
        display: grid;
        justify-content: center;
    }

    .edit__input__btn.preview {
        width: 200px;
    }

    .edit__title__wrap {
        margin: 10px;
        padding: 10px;
        align-items: center;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #000;

    }

    .edit__input__wrap input {
        padding: 5px;
        border: 1px #adadad solid;
        cursor: pointer;
        overflow: visible;
        -ms-user-select: none;
        -moz-user-select: -moz-none;
        user-select: none;
        color: #adadad;
    }

    .edit__input__wrap input:focus {
        outline: none;
    }

    .edit__textarea__wrap {
        display: grid;
    }

    .edit__btn {
        text-align: center;
        cursor: pointer;
        width: 100px;
        height: 30px;
        background-color: #000;
        line-height: 2;
        color: #fff;
    }

    .edit__script {
        padding-right: 2px;
        display: grid;
    }

    .edit__product__wrap {
        margin: 10px 0 20px 0;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        column-gap: 10px;
        row-gap: 10px;
    }

    .edit__product__wrap.preview {
        margin: 20px 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .description__text {
        text-align: start;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .product__img {
        position: relative;
    }

    .product__img img {
        width: 100%;
        height: 400px;
    }

    .product__box {
        border: 1px solid #f0f0f0;
        grid-template-rows: 10fr 1fr 1fr;
    }

    .product__title {
        padding: 5px;
    }

    .product__content {
        display: flex;
        padding: 5px;
        justify-content: space-between;
    }

    .flex__wrap {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .edit__input__btn {
        display: grid;
        justify-content: center;
        text-align: center;
        width: 100%;
        cursor: pointer;
        height: 30px;
        line-height: 2;
        border-radius: 4px;
        border: solid 1px #000;
        color: #000;
    }

    /*--------------- 저장버튼 -------------------------*/
    .apply__btn__wrap {
        display: flex;
        position: sticky;
        top: 0;
        justify-content: center;
        margin: 20px 0;
        gap: 20px;
    }

    .temp__apply__btn {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 270px;
        border-radius: 2px;
        color: #fff;
        padding: 10px;
        background-color: rgb(135, 135, 135);
        height: 36px;
    }

    .apply__btn {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 270px;
        border-radius: 2px;
        color: #fff;
        padding: 10px;
        background-color: #140f82;
        height: 36px;
    }

    .reset__btn {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 270px;
        border-radius: 2px;
        padding: 10px;
        border: solid 1px #707070;
        height: 36px;
    }

    .edit__input__box {
        display: grid;
        justify-content: center;
        row-gap: 10px;
        margin: 20px 0;
    }

    .edit__input {
        display: flex;
        gap: 20px;

    }

    .temp__btn {
        text-align: center;
        cursor: pointer;
        height: 30px;
        padding: 0 10px;
        border: 1px solid #000;
        border-radius: 5px;
        line-height: 2;
        color: #000;
    }

    .preview__call__btn {
        text-align: center;
        cursor: pointer;
        height: 30px;
        padding: 0 10px;
        border: 1px solid #000;
        border-radius: 5px;
        line-height: 2;
        color: #000;
    }

    .product__call__btn {
        text-align: center;
        cursor: pointer;
        width: 130px;
        height: 30px;
        padding: 0 10px;
        border: 1px solid #000;
        border-radius: 5px;
        line-height: 2;
        color: #000;
    }

    .remove__btn {
        position: absolute;
        text-align: right;
        top: 15px;
        right: 15px;
        cursor: pointer;
        -moz-transform: scale(0);
        -webkit-transform: scale(0);
        -o-transform: scale(0);
        -ms-transform: scale(0);
        transform: scale(0);
    }

    .product__img:hover>.remove__btn {
        -moz-transform: scale(1);
        -webkit-transform: scale(1);
        -o-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .collaboration__wrap {
        grid-template-rows: 250px;
        align-items: center;
        display: grid;
        grid-template-columns: 1fr 1fr;
        text-align: center;
    }

    .collaboration__wrap.preview {
        grid-template-rows: 200px;
        align-items: center;
        display: grid;
        grid-template-columns: 1fr 1fr;
        text-align: center;
    }

    .next__colabo__img {
        width: 100%;
    }
    .url__wrap{
        display: grid;
        border: 1px dashed #000;
        grid-template-columns: 1fr 1fr;
        row-gap: 10px;
        margin: 20px 0px;
        padding: 10px;
    }
</style>

<style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/github.min.css");
@import url('https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding:wght@400;700&family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap');

/* code highlight css */
#editor-container { position: relative; min-height:50px; max-height:500px; overflow:auto; }
#editor-container #s_script, #highlighting-code { position: absolute; top: 0; left: 0; margin: 0; }
#editor-container #s_script, #highlighting-code { padding: 5px; font-family: 'Nanum Gothic Coding', monospace; font-size: 12px; line-height: 15px; }
#editor-container #s_script { color: transparent; background-color: transparent; z-index: 1; caret-color: red; min-height:50px; border: 1px solid #ddd; border-radius: 3px; width:100%; }
#highlighting-code { z-index: 0; background:unset; border:0; }
#highlighting-code code { font-family: 'Nanum Gothic Coding', monospace; }
</style>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>

<div class="content__card">
	<form id="frm-regist" action="display/posting/collaboration/add" enctype="multipart/form-data">
		<?php
			function getUrlParamter($url, $sch_tag) {
				$parts = parse_url($url);
				parse_str($parts['query'], $query);
				return $query[$sch_tag];
			}
			
			$page_url = $_SERVER['REQUEST_URI'];
			$page_idx = getUrlParamter($page_url, 'page_idx');
		?>
		<input id="page_idx" type="hidden" name="page_idx" value="<?=$page_idx?>">
		<input id="prvs_idx" type="hidden" name="prvs_idx" value="">
		<input id="tmp_flg" type="hidden" name="tmp_flg" value="false">
		
		<div class="url__wrap">
			<div>이름		:
				<span id="page_title"></span>
			</div>
			<div>적용몰	:
				<span id="country"></span>
			</div>
			<div>URL	:
				<span id="page_url"></span>
			</div>
			<div>비고		:
				<span id="page_memo"></span>
			</div>
		</div>
		
		<div class="page__wrap">
			<div class="edit__wrap">
				<div class="edit__title__wrap">
					<div>
						<h3 class="edit__title">Collaboration Page</h3>
					</div>
					<div style="display: flex;gap: 10px;">
						<div class="temp__btn" onClick="getCollaborationInfo(false);">임시저장 불러오기</div>
						<div class="preview__call__btn" onClick="collaborationPreview();">프리뷰</div>
					</div>
				</div>
				<div class="edit__contnet__wrap">
					<div class="edit__input__wrap">
						<input id="collaboration_date" type="text" name="collaboration_date" style="text-align:center;">
					</div>
					<div class="edit__input__wrap">
						<input id="collaboration_title" type="text" placeholder="콜라보레이션 타이틀" name="collaboration_title" value="" style="width:300px;text-align:center;">
					</div>
					
					<div class="rd__block" style="justify-content:center;margin-bottom:10px;">
						<input type="radio" id="_display_flg_true" class="radio__input" value="true" name="btn_product_top_display_flg" btn_type="btn_product_top" onClick="btnDisplayFlgClick(this);" checked>
						<label for="btn_product_top_btn_product_topdisplay_flg_true">표시</label>
						<input type="radio" id="btn_product_top_display_flg_false" class="radio__input" value="false" name="btn_product_top_display_flg" btn_type="btn_product_top" onClick="btnDisplayFlgClick(this);">
						<label for="btn_product_top_display_flg_false">비표시</label>
					</div>
					<div id="btn_product_top_wrap" class="edit__input__wrap">
						<div class="edit__input__btn btn_product_top">더많은 제품 보러가기</div>
						<div class="edit__input__box">
							<div class="edit__input">
								<input id="btn_product_top_text" type="text" placeholder="버튼 표시내용" name="btn_product_top_text" value="">
								<div class="edit__btn" btn_type="btn_product_top" onClick="setBtnText(this);">
									<span>수정</span>
								</div>
							</div>
							<input id="btn_product_top_url" type="text" placeholder="버튼 URL" name="btn_product_top_url" value="">
						</div>
					</div>
					
					<div class="edit__img">
						<div class="description__text">collaboration main img</div>
						<div class="form-group" style="padding:0px;">
							<div id="img_main_area" style="border:1px solid #000000;width:100%;height:330px;padding-top:50px;">
								콜라보레이션<br>메인 이미지를 선택해주세요.
							</div>
							
							<img class="preview img_main" src="" style="display:none;">
							<input id="prvs_img_main_org" type="hidden" name="prvs_img_main[]" value="">
							<input id="prvs_img_main_mdl" type="hidden" name="prvs_img_main[]" value="">
							<input id="prvs_img_main_sml" type="hidden" name="prvs_img_main[]" value="">
							
							<span class="btn btn-large blue" style="margin-top:10px;">
								<i class="xi-image"></i>콜라보레이션 메인 이미지 선택
								<input class="collaboration_img" id="img_main" type="file" name="img_main" class="input-image">
							</span><br>
						</div>
					</div>
					
					<div class="edit__sub__img">
						<div class="description__text">collaboration brand</div>
						<div class="form-group" style="padding:0px;justify-content:center;display:grid;justify-content:center;">
							<div id="img_brand_area" style="border:1px solid #000000;width:300px;height:140px;padding-top:50px;">
								콜라보레이션<br>브랜드 이미지를 선택해주세요.
							</div>
							
							<img class="preview img_brand" src="" style="display:none;">
							<input id="prvs_img_brand_org" type="hidden" name="prvs_img_brand[]" value="">
							<input id="prvs_img_brand_mdl" type="hidden" name="prvs_img_brand[]" value="">
							<input id="prvs_img_brand_sml" type="hidden" name="prvs_img_brand[]" value="">
							
							<span class="btn btn-large blue" style="margin-top:10px;">
								<i class="xi-image"></i>콜라보레이션 브랜드 이미지 선택
								<input class="collaboration_img" id="img_brand" type="file" name="img_brand" class="input-image">
							</span>
						</div>
					</div>
					
					<div class="edit__input__wrap" style="justify-content: normal;">
						<div class="description__text">description</div>
						<textarea class="width-100p" id="collaboration_description" name="collaboration_description" style="width:90%; height:150px;"></textarea>
					</div>
					
					<div class="edit__script">
						<div class="description__text">script</div>
						<textarea class="width-100p" id="collaboration_script" name="collaboration_script" style="width:90%; height:150px;"></textarea>
						
						<!--<div id="editor-container">
							<textarea id="s_script" name="s_script" placeholder="설치 스크립트 입력해주시기 바랍니다." spellcheck="false" oninput="update_code(); resize();" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"></textarea>
							<pre id="highlighting-code" class="hljs"><code></code></pre>
						</div>-->
					</div>

					<div class="edit__script">
						<div class="description__text">video</div>
						<div class="form-group" style="padding:0px;">
							<div id="collaboration_video_area" style="border:1px solid #000000;width:100%;height:470px;padding-top:50px;">
								콜라보레이션<br>동영상을 선택해주세요.
							</div>
							
							<video class="preview collaboration_video" loop="" autoplay="" muted="" playsinline="" style="width:100%;display:none;" src=""></video>
							<input id="prvs_video" type="hidden" name="prvs_video" value="">
							
							<span class="btn btn-large blue" style="margin-top:10px;">
								<i class="xi-image"></i>콜라보레이션 동영상 선택
								<input class="collaboration_video" id="collaboration_video" type="file" name="collaboration_video" class="input-image">
							</span><br>
						</div>
					</div>
					
					<div class="rd__block" style="justify-content:center;margin-bottom:10px;">
						<input type="radio" id="btn_video_display_flg_true" class="radio__input" value="true" name="btn_video_display_flg" btn_type="btn_video" onClick="btnDisplayFlgClick(this);" checked>
						<label for="btn_video_display_flg_true">표시</label>
						<input type="radio" id="btn_video_display_flg_false" class="radio__input" value="false" name="btn_video_display_flg" btn_type="btn_video" onClick="btnDisplayFlgClick(this);">
						<label for="btn_video_display_flg_false">비표시</label>
					</div>
					<div id="btn_video_wrap" class="edit__input__wrap">
						<div class="edit__input__btn btn_video">캠페인 영상 보기</div>
						<div class="edit__input__box">
							<div class="edit__input">
								<input id="btn_video_text" type="text" placeholder="버튼 표시내용" name="btn_video_text" value="">
								<div class="edit__btn" btn_type="btn_video" onClick="setBtnText(this);">
									<span>수정</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="rd__block" style="justify-content:center;margin-bottom:10px;">
						<input type="radio" id="btn_img_display_flg_true" class="radio__input" value="true" name="btn_img_display_flg" btn_type="btn_img" onClick="btnDisplayFlgClick(this);" checked>
						<label for="btn_img_display_flg_true">표시</label>
						<input type="radio" id="btn_img_display_flg_false" class="radio__input" value="false" name="btn_img_display_flg" btn_type="btn_img" onClick="btnDisplayFlgClick(this);">
						<label for="btn_img_display_flg_false">비표시</label>
					</div>
					<div id="btn_img_wrap" class="edit__input__wrap">
						<div class="edit__input__btn btn_img">캠페인 이미지 전체 보기</div>
						<div class="edit__input__box">
							<div class="edit__input">
								<input id="btn_img_text" type="text" placeholder="버튼 표시내용" name="btn_img_text" value="">
								<div class="edit__btn" btn_type="btn_img" onClick="setBtnText(this);">
									<span>수정</span>
								</div>
							</div>
							<input id="btn_img_url" type="text" placeholder="버튼 URL" name="btn_img_url" value="">
						</div>
					</div>
				</div>
				
				<div class="product__call__btn" style="width:250px;" onClick="openCollaborationProductModal();">상품정보 불러오기</div>
				
				<div id="product_info_div" class="edit__product__wrap">
					<div class="product__box">
						<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<div class="remove__btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
										<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
					<div class="product__box">
					<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<div class="remove__btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
										<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
									</svg>
								</div>
							</div>
							
						</div>
					</div>
					<div class="product__box">
						<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<div class="remove__btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
										<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
					<div class="product__box">
					<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<div class="remove__btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
										<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
									</svg>
								</div>
							</div>
							<!-- <div class="product__title"></div>
							<div class="product__content">
								<div></div>
								<div></div>
							</div> -->
						</div>
					</div>
				</div>
				
				<div class="rd__block" style="justify-content:center;margin-bottom:10px;">
					<input type="radio" id="btn_product_bot_display_flg_true" class="radio__input" value="true" name="btn_product_bot_display_flg" btn_type="btn_product_bot" onClick="btnDisplayFlgClick(this);" checked>
					<label for="btn_product_bot_display_flg_true">표시</label>
					<input type="radio" id="btn_product_bot_display_flg_false" class="radio__input" value="false" name="btn_product_bot_display_flg" btn_type="btn_product_bot" onClick="btnDisplayFlgClick(this);">
					<label for="btn_product_bot_display_flg_false">비표시</label>
				</div>
				<div id="btn_product_bot_wrap" class="edit__input__wrap">
					<div class="edit__input__btn btn_product_bot">더많은 제품 보러가기</div>
					<div class="edit__input__box">
						<div class="edit__input">
							<input id="btn_product_bot_text" type="text" placeholder="버튼 표시내용" name="btn_product_bot_text" value="">
							<div class="edit__btn" btn_type="btn_product_bot" onClick="setBtnText(this);">
								<span>수정</span>
							</div>
						</div>
						<input id="btn_product_bot_url" type="text" placeholder="버튼 URL" name="btn_product_bot_url" value="">
					</div>
				</div>
				
				<div class="collaboration__wrap">
					<div class="collaboration__box">
						<div class="form-group" style="padding:0px;">
							<div id="img_logo_area" style="border:1px solid #000000;padding-top:20px;width:98%;height:140px;">
								콜라보레이션<br>브랜드 로고를 선택해주세요.
							</div>
							
							<img class="preview img_logo" src="" style="width:100%;height:140px;display:none;">
							<input id="prvs_img_logo_org" type="hidden" name="prvs_img_logo[]" value="">
							<input id="prvs_img_logo_mdl" type="hidden" name="prvs_img_logo[]" value="">
							<input id="prvs_img_logo_sml" type="hidden" name="prvs_img_logo[]" value="">
							
							<span class="btn btn-large blue" style="margin-top:10px;">
								<i class="xi-image"></i>콜라보레이션 브랜드 로고 이미지 선택
								<input class="collaboration_img" id="img_logo" type="file" name="img_logo" class="input-image">
							</span><br>
						</div>
					</div>
					
					<div class="collaboration__box">
						<div class="form-group" style="padding:0px;">
							<div id="img_mouseover_area" style="border:1px solid #000000;padding-top:20px;width:98%;height:140px;">
								콜라보레이션<br>마우스오버 이미지를 선택해주세요.
							</div>
							
							<img class="preview img_mouseover" src="" style="width:100%;height:140px;display:none;">
							<input id="prvs_img_mouseover_org" type="hidden" name="prvs_img_mouseover[]" value="">
							<input id="prvs_img_mouseover_mdl" type="hidden" name="prvs_img_mouseover[]" value="">
							<input id="prvs_img_mouseover_sml" type="hidden" name="prvs_img_mouseover[]" value="">
							
							<span class="btn btn-large blue" style="margin-top:10px;">
								<i class="xi-image"></i>콜라보레이션 마우스오버 이미지 선택
								<input class="collaboration_img" id="img_mouseover" type="file" name="img_mouseover" class="input-image">
							</span><br>
						</div>
					</div>
				</div>
				
				<div class="apply__btn__wrap">
					<div class="temp__apply__btn" tmp_flg="true" onClick="saveCollaborationPage(this);">임시저장</div>
					<div class="apply__btn" tmp_flg="false" onClick="saveCollaborationPage(this);">저장</div>
					<div class="reset__btn">초기화</div>
				</div>
			</div>
			
			<!-- COLLABORATION PREVIEW WRAP START -->
			<div class="preview__wrap">
				<div class="edit__title__wrap">
					<h3 class="edit__title">Preview Page</h3>
				</div>
				<div class="edit__contnet__wrap">
					<div class="preview_collaboration_date">콜라보레이션 표시년도</div>
					<div class="edit__input__wrap">
						<div class="preview_collaboration_title">콜라보레이션 타이틀</div>
					</div>
					<div class="edit__input__wrap">
						<div class="edit__input__btn preview preview_btn_product_top">더많은 제품 보러가기</div>
					</div>
					
					<div class="edit__img">
						<div class="preview_img_main_area" style="border:1px solid #000000;width:100%;height:130px;padding-top:20px;">
							콜라보레이션<br>메인 이미지
						</div>
						
						<img class="preview_img_main" src="" style="display:none;">
					</div>
					<div class="edit__sub__img">
						<div class="preview_img_brand_area" style="border:1px solid #000000;width:100%;height:140px;padding-top:20px;">
							콜라보레이션<br>브랜드 이미지
						</div>
						
						<img class="preview_img_brand" src="" style="display:none;">
					</div>
					
					<div class="textarea__result preview_collaboration_description">
						콜라보레이션<br>설명
					</div>

					<div class="edit__script">
						<div class="script__result">스크립트</div>
					</div>
					<div class="edit__script">
						<div class="preview_collaboration_video_area" style="border:1px solid #000000;width:100%;height:160px;padding-top:20px;">
							콜라보레이션<br>동영상
						</div>
						
						<video class="preview_collaboration_video" loop="" autoplay="" muted="" playsinline="" style="width:100%;display:none;" src=""></video>
					</div>
					<div class="edit__input__wrap">
						<div class="edit__input__btn preview preview_btn_video">캠페인 영상 보기</div>
					</div>
					<div class="edit__input__wrap">
						<div class="edit__input__btn preview preview_btn_img">캠페인 이미지 전체 보기</div>
					</div>
				</div>
				
				<div id="preview_product_info_div" class="edit__product__wrap preview ">
					<div class="product__box">
					<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<img class="preview_product_img" style="display: none;" src="">
							</div>
						</div>
					</div>
					<div class="product__box">
					<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<img class="preview_product_img" style="display: none;" src="">
							</div>
						</div>
					</div>
					<div class="product__box">
					<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<img class="preview_product_img" style="display: none;" src="">
							</div>
						</div>
					</div>
					<div class="product__box">
					<div class="product__img_area" style="border:1px solid #000000;width:100%;padding-top:50px;text-align: center;height: 400px;">상품 이미지를 선택해주세요.</div>
						<div style="width: 100%;">
							<div class="product__img">
								<img class="preview_product_img" style="display: none;" src="">
							</div>
						</div>
					</div>
				</div>
				
				<div class="edit__input__wrap">
					<div class="edit__input__btn preview preview_btn_product_bot">더많은 제품 보러가기</div>
				</div>
				
				<div class="collaboration__wrap preview">
					<div class="collaboration__box colla__hover" style="width:98%;">
						<div class="edit__input__wrap" style="row-gap: 20px;">
							<div class="next__colabo__img">
								<div class="preview_img_logo_area" style="border:1px solid #000000;width:150px;height:100px;padding-top:20px;">
									콜라보레이션<br>브랜드 로고
								</div>
								
								<div class="preview_img_logo" style="width:150px;height:100px;display:none;"></div>
							</div>
						</div>
					</div>
					
					<div class="collaboration__box colla__hover" style="width:98%;">
						<div class="edit__input__wrap" style="row-gap: 20px;">
							<div class="next__colabo__img">
								<div class="preview_img_mouseover_area" style="border:1px solid #000000;width:150px;height:100px;padding-top:20px;">
									콜라보레이션<br>마우스오버 이미지
								</div>
								
								<div class="preview_img_mouseover" style="width:150px;height:100px;display:none;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- COLLABORATION PREVIEW WRAP END -->
		</div>
	</form>
</div>

<script type="text/javascript">
var collaboration_description = [];
var collaboration_script = [];
$(document).ready(function() {
	$('.preview_product_img')
	var today = new Date();
	$('#collaboration_date').val(today.getFullYear());
	
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: collaboration_description,
		elPlaceHolder: "collaboration_description",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: collaboration_script,
		elPlaceHolder: "collaboration_script",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: {
			fOnBeforeUnload : function(){},
			bUseToolBar:false,
			bUseModeChanger:false,
			SE_EditingAreaManager:{
				sDefaultEditingMode:"HTMLSrc"
			}
		}
	});
	
	$('.collaboration_img').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('이미지 파일만 등록 가능합니다. (gif, png, jpg, jpeg 만 업로드 가능)');
		} else {
			var file = $(this).prop("files")[0];
			
			var img_id = $(this).attr('id');
			
			blobURL = window.URL.createObjectURL(file);
			$('#' + img_id + '_area').hide();
			$('.' + img_id).show();
			$('.' + img_id).attr('src', blobURL);
			$('.' + img_id).slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
	
	$('.collaboration_video').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['mp4', 'wmv']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('동영상 파일만 등록 가능합니다. (mp4, wmv)');
		} else {
			var file = $(this).prop("files")[0];
			
			var video_id = $(this).attr('id');
			
			blobURL = window.URL.createObjectURL(file);
			$('#' + video_id + '_area').hide();
			$('.' + video_id).show();
			$('.' + video_id).attr('src', blobURL);
			$('.' + video_id).slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
	
	getPostingPageInfo();
	
	getCollaborationInfo();
});

function getPostingPageInfo() {
	var page_idx = $('#page_idx').val();
	
	$.ajax({
		type: "post",
		data:{
			'page_idx':page_idx
		},
		dataType: "json",
		url: config.api + "display/posting/get",
		error: function() {
			alert("콜라보레이션 페이지 정보 조회 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						$('#page_title').text(row.page_title);
						var country = "";
						
						switch (row.country) {
							case "KR" :
								country = "한국몰";
								break;
							
							case "EN" :
								country = "영문몰";
								break;
							
							case "CN" :
								country = "중문몰";
								break;
						}
						
						$('#country').text(country);
						
						$('#page_url').text(row.page_url);
						$('#page_memo').text(row.page_memo);
					});
				}	
			}
		}
	});
}

function setBtnText(obj) {
	var btn_type = $(obj).attr('btn_type');
	
	var btn_text = $('#' + btn_type + '_text').val();
	if (btn_text != null) {
		$('.' + btn_type).text(btn_text);
	} else {
		alert('버튼 표시내용을 입력해주세요.');
		return false;
	}
}

function btnDisplayFlgClick(obj) {
	var btn_type = $(obj).attr('btn_type');
	var flg_value = $(obj).val();
	
	if (flg_value == "true") {
		$('#' + btn_type + '_wrap').show();
	} else {
		$('#' + btn_type + '_wrap').hide();
	}
}

function openCollaborationProductModal() {
	modal('get');
}

function collaborationPreview() {
	var collaboration_date = $('#collaboration_date').val();
	if (collaboration_date.length > 0 && collaboration_date != null) {
		$('.preview_collaboration_date').text(collaboration_date);
	} else {
		$('.preview_collaboration_date').text('콜라보레이션 표시년도');
	}
	
	var collaboration_title = $('#collaboration_title').val();
	if (collaboration_title.length > 0 && collaboration_title != null) {
		$('.preview_collaboration_title').text(collaboration_title);
	} else {
		$('.preview_collaboration_title').text('콜라보레이션 타이틀');
	}
	
	var btn_product_top_display_flg = $('#btn_product_top_display_flg_true').prop('checked');
	var btn_product_top = $('#btn_product_top_text').val();
	if (btn_product_top_display_flg == true) {
		if (btn_product_top.length > 0 && btn_product_top != null) {
			$('.preview_btn_product_top').text(btn_product_top);
			$('.preview_btn_product_top').show();
		} else {
			$('.preview_btn_product_top').text('더많은 제품 보러가기');
			$('.preview_btn_product_top').show();
		}
	} else {
		$('.preview_btn_product_top').text('더많은 제품 보러가기');
		$('.preview_btn_product_top').hide();
	}
	
	var img_main = $('.img_main').attr('src');
	if (img_main.length > 0 && img_main != null) {
		$('.preview_img_main').attr('src',img_main);
		$('.preview_img_main_area').hide();
		$('.preview_img_main').show();
	} else {
		$('.preview_img_main').attr('src','');
		$('.preview_img_main_area').show();
		$('.preview_img_main').hide();
	}
	
	var img_brand = $('.img_brand').attr('src');
	if (img_brand.length > 0 && img_brand != null) {
		$('.preview_img_brand').attr('src',img_brand);
		$('.preview_img_brand_area').hide();
		$('.preview_img_brand').show();
	} else {
		$('.preview_img_brand').attr('src','');
		$('.preview_img_brand_area').show();
		$('.preview_img_brand').hide();
	}
	
	collaboration_description.getById["collaboration_description"].exec("UPDATE_CONTENTS_FIELD", []);
	var collaboration_description_html = $('#collaboration_description').val();
	if (collaboration_description != null) {
		$('.preview_collaboration_description').empty();
		$('.preview_collaboration_description').append(collaboration_description_html);
	} else {
		$('.preview_collaboration_description').empty();
		$('.preview_collaboration_description').append('콜라보레이션<br>설명');
	}
	
	var collaboration_video = $('.collaboration_video').attr('src');
	if (collaboration_video.length > 0 && collaboration_video != null) {
		$('.preview_collaboration_video').attr('src',collaboration_video);
		$('.preview_collaboration_video_area').hide();
		$('.preview_collaboration_video').show();
	} else {
		$('.preview_collaboration_video').attr('src','');
		$('.preview_collaboration_video_area').show();
		$('.preview_collaboration_video').hide();
	}
	
	var btn_video_display_flg = $('#btn_video_display_flg_true').prop('checked');
	var btn_video = $('#btn_video_text').val();
	if (btn_video_display_flg == true) {
		if (btn_video.length > 0 && btn_video != null) {
			$('.preview_btn_video').text(btn_video);
			$('.preview_btn_video').show();
		} else {
			$('.preview_btn_video').text('캠페인 영상 보기');
			$('.preview_btn_video').show();
		}
	} else {
		$('.preview_btn_product_top').text('캠페인 영상 보기');
		$('.preview_btn_product_top').hide();
	}
	
	var btn_img_display_flg = $('#btn_img_display_flg_true').prop('checked');
	var btn_img = $('#btn_img_text').val();
	if (btn_img_display_flg == true) {
		if (btn_img.length > 0 && btn_img != null) {
			$('.preview_btn_img').text(btn_img);
			$('.preview_btn_img').show();
		} else {
			$('.preview_btn_img').text('캠페인 이미지 전체 보기');
			$('.preview_btn_img').show();
		}
	} else {
		$('.preview_btn_img').text('캠페인 이미지 전체 보기');
		$('.preview_btn_img').hide();
	}
	
	var btn_product_bot_display_flg = $('#btn_product_bot_display_flg_true').prop('checked');
	var btn_product_bot = $('#btn_product_bot_text').val();
	if (btn_product_bot_display_flg == true) {
		if (btn_product_bot.length > 0 && btn_product_bot != null) {
			$('.preview_btn_product_bot').text(btn_product_bot);
			$('.preview_btn_product_bot').show();
		} else {
			$('.preview_btn_product_bot').text('더많은 제품 보러 가기');
			$('.preview_btn_product_bot').show();
		}
	} else {
		$('.preview_btn_product_bot').text('더많은 제품 보러 가기');
		$('.preview_btn_product_bot').hide();
	}
	
	var product_box = $('#product_info_div').find('.product__box')
	var length = product_box.length;
	if (length > 0) {
		for (var i=0; i<length; i++) {
			var product_img = product_box.eq(i).find('.product_img').attr('src');
			$('.product__img_area').eq(i).hide();
			$('.preview_product_img').eq(i).attr('src',product_img);
			$('.preview_product_img').eq(i).show();
		}
	}
	
	var img_logo = $('.img_logo').attr('src');
	if (img_logo.length > 0 && img_logo != null) {
		$('.preview_img_logo').css('background-image',"url('" + img_logo + "')");
		$('.preview_img_logo').css('background-repeat','no-repeat');
		
		$('.preview_img_logo_area').hide();
		$('.preview_img_logo').show();
	} else {
		$('.preview_img_logo').css('background-image','');
		$('.preview_img_logo_area').show();
		$('.preview_img_logo').hide();
	}
	
	var img_mouseover = $('.img_mouseover').attr('src');
	if (img_mouseover.length > 0 && img_mouseover != null) {
		$('.preview_img_mouseover').css('background-image',"url('" + img_mouseover + "')");
		$('.preview_img_mouseover').css('background-repeat','no-repeat');
		$('.preview_img_mouseover').css('background-size','contain');
		
		$('.preview_img_mouseover').show();
		$('.preview_img_mouseover_area').hide();
	} else {
		$('.preview_img_mouseover').css('background-image','');
		$('.preview_img_mouseover').hide();
		$('.preview_img_mouseover_area').show();
	}
}

function saveCollaborationPage(obj) {
	var tmp_flg = $(obj).attr('tmp_flg');
	$('#tmp_flg').val(tmp_flg);
	
	collaboration_description.getById["collaboration_description"].exec("UPDATE_CONTENTS_FIELD", []);
	
	var form = $("#frm-regist")[0];
	var formData = new FormData(form);
	
	$.ajax({
		type: "post",
		data: formData,
		dataType: "json",
		url: config.api + "display/posting/collaboration/add",
		cache: false,
		contentType: false,
		processData: false,
		error: function() {
			alert("콜라보레이션 페이지 정보 등록 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				alert('콜라보레이션 페이지 정보가 등록되었습니다.',function pageLocation() {
					location.href = '/display/posting';
				});
			}
		}
	});
}

function getCollaborationInfo(param) {
	var page_idx = $('#page_idx').val();
	if (param != null) {
		$('#tmp_flg').val(param);
	}
	var tmp_flg = $('#tmp_flg').val();
	
	$.ajax({
		type: "post",
		data: {
			"tmp_flg" : tmp_flg,
			"page_idx" : page_idx 
		},
		dataType: "json",
		url: config.api + "display/posting/collaboration/get",
		error: function() {
			alert("콜라보레이션 페이지 정보 조회 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						$('#prvs_idx').val(row.idx);
						$('#collaboration_date').val(row.collaboration_date);
						
						$('#collaboration_title').val(row.collaboration_title);
						
						var btn_product_top_display_flg = row.btn_product_top_display_flg;
						if (btn_product_top_display_flg == true) {
							$('#btn_product_top_display_flg_true').prop('checked',true);
							
							$('.btn_product_top').text(row.btn_product_top_text);
							$('#btn_product_top_text').val(row.btn_product_top_text);
							$('#btn_product_top_url').val(row.btn_product_top_url);
						} else {
							$('#btn_product_top_display_flg_false').prop('checked',true);
							
							$('#btn_product_top_wrap').hide();
						}
						
						$("textarea[name='collaboration_description']").val(row.collaboration_description);
						
						var collaboration_video = row.collaboration_video_url;
						if (collaboration_video != null) {
							$('#prvs_video').val(collaboration_video);
							
							collaboration_video = collaboration_video.replace('/var/www/admin/www','');
							$('#collaboration_video_area').hide();
							$('.collaboration_video').attr('src',collaboration_video);
							$('.collaboration_video').show();
						}
						
						var btn_video_display_flg = row.btn_video_display_flg;
						if (btn_video_display_flg == true) {
							$('#btn_video_display_flg_true').prop('checked',true);
							
							$('.btn_video').text(row.btn_video_text);
							$('#btn_video_text').val(row.btn_video_text);
						} else {
							$('#btn_video_wrap').prop('checked',true);
						}
						
						var btn_img_display_flg = row.btn_img_display_flg;
						if (btn_img_display_flg == true) {
							$('#btn_img_display_flg_true').prop('checked',true);
							
							$('.btn_img').text(row.btn_img_text);
							$('#btn_img_text').val(row.btn_img_text);
							$('#btn_img_url').val(row.btn_img_url);
						} else {
							$('#btn_img_display_flg_false').prop('checked',true);
							
							$('#btn_img_wrap').hide();
						}
						
						var btn_product_bot_display_flg = row.btn_product_bot_display_flg;
						if (btn_product_bot_display_flg == true) {
							$('#btn_product_bot_display_flg_true').prop('checked',true);
							
							$('.btn_product_bot').text(row.btn_product_bot_text);
							$('#btn_product_bot_text').val(row.btn_product_bot_text);
							$('#btn_product_boturl').val(row.btn_product_bot_url);
						} else {
							$('#btn_product_bot_display_flg_false').prop('checked',true);
							
							$('#btn_product_bot_wrap').hide();
						}
						
						var img_result = row.img_result;
						if (img_result.data != null) {
							img_result.data.forEach(function(img_row) {
								var img_type = img_row.img_type;
								var img_size = img_row.img_size;
								
								if (img_size == "org") {
									var img_area = $('#img_' + img_type + '_area')
									var preview_img = $('.img_' + img_type);
									
									var img_location = img_row.img_location;
									img_location = img_location.replace('/var/www/admin/www','');
								
									img_area.hide();
									preview_img.attr('src',img_location);
									preview_img.show();
								}
								
								$('#prvs_img_' + img_type + '_' + img_size).val(JSON.stringify(img_row));
							});
						}
						
						var product_result = row.product_result;
						if (product_result.data != null) {
							$('#product_info_div').empty();
							product_result.data.forEach(function(product_row) {
								var product_idx = product_row.product_idx;
								var product_img = product_row.product_img_location;
								if (product_idx != null && product_img != null) {
									var strDiv = "";
									strDiv += '<div class="product__box">';
									strDiv += '    <input type="hidden" name="collaboration_product[]" value="' + product_idx + '">';
									strDiv += '    <div style="width: 100%;">';
									strDiv += '        <div class="product__img">';
									strDiv += '            <div class="remove__btn">';
									strDiv += '                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
									strDiv += '                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />';
									strDiv += '                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />';
									strDiv += '                </svg>';
									strDiv += '            </div>';
									strDiv += '            <img class="product_img" src="' + product_img + '">';
									strDiv += '        </div>';
									
									strDiv += '    </div>';
									strDiv += '</div>';
									$('#product_info_div').append(strDiv);
								}
							});
						}
					});
				}	
			}
		}
	});
}
</script>

<script>
/*function update_code() {
	const result_elem = document.querySelector("#highlighting-code code");
	const text = document.querySelector("#s_script").value;
	let html = hljs.highlightAuto(text).value;
	result_elem.innerHTML =  html.replace(new RegExp("  ", "g"), "&nbsp; ");;
}

function resize() {
	const editor = document.querySelector('#s_script');
	editor.style.height = "20px";
	editor.style.height = (editor.scrollHeight + 5)+"px";

	const editor_div = document.querySelector('#editor-container');
	editor_div.style.height = (editor.scrollHeight + 5)+"px";
}

document.addEventListener("DOMContentLoaded", () => {
	update_code();
	resize();
});*/
</script>