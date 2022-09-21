<style>
     .controls {
    margin: 30px -10px;
  }

  .control {
    position: relative;
    float: left;
    width: 25%;
    padding: 0 10px;
  }

  .grid__wrap {
    display: flex;
    gap: 10px;
  }

  .flex {
    display: flex;
    gap: 20px;
    text-align: center;
  }

  .upload-box {
    padding: 20px;
    width: 200px;
    height: 100%;
    border: 1px solid gray;
    box-shadow: 2px 3px 9px hsl(0deg 0% 47% / 32%);
    margin-right: 20px;
  }

  @media (max-width:900px) {
    .grid__wrap {
      display: block;
    }
  }

  @media (max-width: 600px) {

    .control {
      float: none;
      width: auto;
      margin: 0 0 15px 0;
    }

    .control.layout {
      margin: 0;
    }
  }

  .control-icon {
    position: absolute;
    left: 10px;
    top: 0;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    z-index: 2;
    pointer-events: none;
  }

  .control-field {
    position: relative;
    padding-left: 40px;
    z-index: 1;
  }

  /* Grid */

  .grid {
    position: relative;
    max-width: 600px;
    min-width: 600px;
    left: 13px;
    margin-top: 10px;
    -moz-box-sizing: content-box;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
  }

  .item {
	cursor: grab;
    position: absolute;
    width: 130px;
    height: 130px;
    line-height: 100px;
    z-index: 1;
    will-change: transform;
  }

  .item.muuri-item-positioning {
    z-index: 2;
  }

  .item.muuri-item-dragging,
  .item.muuri-item-releasing {
    z-index: 9999;
  }

  .item.muuri-item-dragging {
    cursor: move;
  }

  .item.muuri-item-hidden {
    z-index: 0;
  }

  .item.h2 {
    height: 110px;
    line-height: 420px;
  }

  .item.w2 {
    width: 260px;
  }

  .item-content {
    position: relative;
    width: 100%;
    height: 100%;
  }

  .card {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    text-align: center;
    font-size: 24px;
    font-weight: 300;
    /*background-color: rgba(255, 255, 255, 0.9);*/
    border: 2px solid;
    color: #333;
    border-radius: 2px;
    -webkit-transition: all 0.2s ease-out;
    -moz-transition: all 0.2s ease-out;
    -ms-transition: all 0.2s ease-out;
    -o-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out;
    margin: 2px;
  }

  .item.red .card {
    color: #f94a7a;
  }

  .item.green .card {
    color: #2ac06d;
  }

  .item.blue .card {
    color: #4A9FF9;
  }
  .item.gray .card {
    color: #707070;
  }

  .card-id {
    position: absolute;
    left: 7px;
    top: 0;
    height: 30px;
    line-height: 30px;
    text-align: left;
    font-size: 16px;
    font-weight: 400;
  }

  .card-remove {
    position: absolute;
    right: 0;
    top: 0;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 20px;
    font-weight: 400;
    cursor: pointer;
    -moz-transform: scale(0);
    -webkit-transform: scale(0);
    -o-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);
    -webkit-transition: all 0.15s ease-out;
    -moz-transition: all 0.15s ease-out;
    -ms-transition: all 0.15s ease-out;
    -o-transition: all 0.15s ease-out;
    transition: all 0.15s ease-out;
  }

  .card:hover >.card-remove {
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
  .card-add {
    position: absolute;
    right: 0px;
    top: 75px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 20px;
    font-weight: 400;
    cursor: pointer;
    -moz-transform: scale(0);
    -webkit-transform: scale(0);
    -o-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);
    -webkit-transition: all 0.15s ease-out;
    -moz-transition: all 0.15s ease-out;
    -ms-transition: all 0.15s ease-out;
    -o-transition: all 0.15s ease-out;
    transition: all 0.15s ease-out;
  }

  .card:hover>.card-add {
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  /* Grid Footer */

  .grid-footer {
    margin: 60px 0;
    text-align: center;
  }

  .grid-footer .btn .material-icons {
    margin-right: 10px;
    font-size: 24px;
  }



  /* Icons in the selector */
  /* fallback */
  @font-face {
    font-family: 'Material Icons';
    font-style: normal;
    font-weight: 400;
    src: url(https://fonts.gstatic.com/s/materialicons/v29/2fcrYFNaTjcS6g4U3t-Y5ZjZjT5FdEJ140U2DJYC3mY.woff2) format('woff2');
  }

  .material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
  }



  /* main.css */
  /* Base */

  * {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }

  html {
    overflow-y: scroll;
    overflow-x: hidden;
    background: #fff;
  }

  html.dragging body {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  a {
    color: #3396FF;
    text-decoration: none;
    -webkit-transition: all 0.2s ease-out;
    -moz-transition: all 0.2s ease-out;
    -ms-transition: all 0.2s ease-out;
    -o-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out;
  }

  a:hover {
    color: #FF4BD8;
  }

  /* Clearfix */

  .cf:before,
  .cf:after {
    content: " ";
    display: table;
  }

  .cf:after {
    clear: both;
  }

  /* Material icons */

  .material-icons {
    display: inline-block;
    vertical-align: top;
    line-height: inherit;
    font-size: inherit;
  }

  /* Buttons */

  .btn {
    display: inline-block;
    position: relative;
    vertical-align: top;
    margin: 0;
    border: 0;
    outline: 0;
    padding: 0px 15px;
    font-size: 16px;
    font-weight: 400;
    line-height: 40px;
    height: 40px;
    text-align: center;
    white-space: nowrap;
    background: #4a9ff9;
    color: #fff;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border-radius: 3px;
  }

  .btn:focus,
  .btn:hover,
  .btn:active {
    outline: 0;
  }

  .btn:hover {
    background: #3989de;
  }

  .btn:active {
    background: #3075bf;
  }

  .btn.active {
    background: #60ca47;
  }

  .btn.active:hover {
    background: #40b325;
  }

  .btn.active:active {
    background: #309818;
  }

  /* Forms */

  .form-control {
    display: block;
    width: 100%;
    height: 40px;
    padding: 5px 15px;
    font-size: 16px;
    line-height: 26px;
    color: inherit;
    background: #fff;
    border: 2px solid #e5e5e5;
    border-radius: 4px;
    -webkit-appearance: none;
    -moz-appearance: none;
    -o-appearance: none;
    appearance: none;
  }

  select.form-control {
    padding-right: 40px;
    cursor: pointer;
  }

  select.form-control::-ms-expand {
    display: none;
  }

  .select-arrow {
    position: absolute;
    right: 10px;
    top: 0;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    z-index: 2;
    pointer-events: none;
  }

  .form-control:focus {
    outline: 0;
    border-color: #4a9ff9;
  }
 

  @media (max-width: 600px) {
    header {
      margin-bottom: 0;
    }

    header h2 {
      font-size: 21px;
    }

    header h2>span {
      margin-top: 20px;
    }

    header h2>span>i {
      display: none;
    }

    header h2>span>span {
      display: block;
    }

    header nav {
      margin-top: 20px;
      border-bottom: 0;
      border-top: 1px solid #e5e5e5;
    }

    header nav a {
      display: block;
      vertical-align: top;
      padding: 10px 20px;
      border-bottom: 1px solid #e5e5e5;
    }

    header nav a i {
      bottom: -1px;
      left: 0;
      right: 0;
    }
  }


  @media (max-width: 600px) {
    section.demo {
      border-top: 0;
    }
  }

  /* Section titles */

  .section-title {
    color: #3e3e3e;
    font-size: 26px;
    font-weight: 700;
    margin: 40px 0;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-align: center;
  }

  .section-title>span {
    position: relative;
    display: inline-block;
    vertical-align: top;
  }

  .section-title>span:after {
    content: "";
    display: block;
    position: absolute;
    left: 10px;
    bottom: 0;
    right: 10px;
    height: 2px;
    background: #3e3e3e;
  }

  /* Feature list */

  .feature-list {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .feature-list-item {
    position: relative;
    padding-left: 80px;
    margin: 30px 0;
    overflow: hidden;
  }

  .feature-list-icon {
    display: block;
    float: left;
    margin-left: -80px;
    width: 80px;
    font-size: 48px;
    line-height: 48px;
    text-align: left;
    color: #3396FF;
  }

  .feature-list-text h4 {
    margin: 0 0 15px 0;
    font-weight: 500;
    font-size: 20px;
  }

  @media (max-width: 600px) {
    .feature-list-item {
      padding-left: 0;
    }

    .feature-list-icon {
      margin: -4px 10px 0 0;
      width: 24px;
      font-size: 24px;
      line-height: inherit;
    }
  }

  /* Author */

  .author {
    margin: 60px 0;
    font-weight: 500;
    font-size: 20px;
    color: #3e3e3e;
    font-style: italic;
    text-align: center;
  }

  .control-field {
    position: relative;
    padding-left: 40px;
    z-index: 1;
  }



  button {
    width: 70px;
    height: 70px;
    border: none;
    border-radius: 8px;
    margin: 12px;
    cursor: move;
    font-size: 30px;
    background: #eaeaea4f;
  }


  .draggable.dragging {
    opacity: 0.5;
  }

  .append-grid {
    background-size: cover;
  }

  .product-cate {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .product-cate > div {
    width: 100px;
    height: 100px;
    border-radius: 4px;
    border: 1px dashed gray;
  }

  .product-grid >div {
    border-radius: 4px;
    border: 1px dashed gray;
  }

  .product-wrap > div {
    display: flex;
    border: 1px black dashed;
    border-radius: 4px;
    height: 40px;
    justify-content: center;
    align-items: center;
  }

  .product-wrap>div:nth-child(odd) {}

  .product-wrap>div:hover {
    background-color: orange;
  }

  .product-wrap>div:nth-child(odd):hover {
    background-color: indianred;
  }

  .product-wrap {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 135px;
    row-gap: 10px;
    height: 400px;
    border-radius: 4px;
    background-size: cover;

  }

  .align-btn > div {
    cursor: pointer;
    background-color: bisque;
    border: 1px black solid;
    border-radius: 4px;
    padding: 5px;
  }

  .mobile-preview-wrap > div {
    border: 1px solid #bfbfbf;
    border-radius: 4px;
    padding: 5px;
  }

  .mobile-preview-wrap.one-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 5px;
    height: 500px;
  }

  .mobile-preview-wrap.two-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5px;
  }

  .mobile-preview-wrap.three-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 5px;
  }

  .mobile-preview-header {
    display: flex;
    justify-content: space-around;
    margin-bottom: 10px;
    gap: 5px;
  }
 

  .mobile-preview {
    padding: 10px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 60px;
    row-gap: 10px;
  }

  .mobile-preview>div {
    border: 1px black dashed;
    border-radius: 4px;
  }

  .category-position {
	  font-size:0.5rem;
  }

  .category-position[data-position="left"] {
    justify-content: flex-start;
  }

  .category-position[data-position="center"] {
    justify-content: center;
  }

  .category-position[data-position="right"] {
    justify-content: flex-end;
  }

  .product-grid img {
    width: 100px;
    height: 100px;

  }

  .card {
    background-size: cover;
    background-repeat: no-repeat;
  }

  .card img {
    width: 100%;
    height: 100%;
  }

  .country__tap {
    display: flex;
    column-gap: 10px;
    margin-top: 10px;
  }

  .country__tap>div {
    background-color: #bfbfbf;
    width: 130px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .country__tap>div>span {
    font-weight: 500;
    color: #fff;
    font-size: 14px;
    padding-left: 22px;
  }

  .country__tap .checked {
    box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.33);
    background-color: #140f82;
    position: relative;
    bottom: 10px;
    transition: all 2s;
  }

  .hidden {
    display: none;
  }
  .apply__btn{
    display: flex;
    background-color: #140f82;
    color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    text-align: center;
    height: 40px;
    line-height: 30px;
    cursor: pointer;
  }
  
  
  /* .library__btn{
    background-color: #6eb0ae;
    color: #fff;
    padding: 5px 10px;
    margin: 10px;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
  } */



/*--------------------------------------------------------*/
  /*라이브러리 시작*/
  .prd__wrap{
    max-width: 1920px;
    display: grid;
    grid-template-columns: 130px 550px 400px 400px;
  }
  .prd__grid {
    border: 1px solid #bfbfbf;
    height: 100%;
  }
  .prd__title{
    border-bottom: 1px solid #bfbfbf;
    background-color: #fafafa;
    height: 30px;
    padding: 0 10px;
    font-size: 12px;
    display: flex;
    align-items: center;
  }
  .library__btn__wrap{
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    margin: 20px 0 10px 0;
  } 
  .library__btn{
	cursor: pointer;
    width: 100px;
    border: 1px solid #707070;
    background-color: #fff;
    border-radius: 2px;
    display: flex;
    align-items: center;
    justify-content: center;

  }
  .library__btn span{
    font-size: 12px;
    color: #000;
    height: 20px;
    line-height: 1.8;
  }
  .library__product{
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100px;
    min-height: 500px;
    max-height: 100%;
    overflow: auto;
    border: 1px solid #bfbfbf;
    margin: 10px;
    background-color: #fff;
    border-radius: 2px;
  }

  /*상품 진열그리드 시작*/
  .prd__display__btn__wrap{
    display: flex;
    justify-content: center;
    gap: 5px;
    margin-top: 20px;
  }
  .display__btn{
	cursor: pointer;
    font-size: 12px;
    width: 125px;
    height: 22px;
    border: 1px solid #707070;
    background-color: #fff;
    border-radius: 2px;
    display: flex;
    color:#000;
    align-items: center;
    justify-content: center;
    font-weight: normal;
  }

  .prd__input{
    width: 70px;
    height: 22px;
    font-size: 12px;
    font-weight: normal;
    text-align: left;
    margin-left: 55px;
    color: #bfbfbf;
    text-align: center;
    border: 1px solid #bfbfbf;
    border-radius: 2px;
  }
  .prd__input:focus{
    outline: none;
  }
  .prd__display{
    display: flex;
    justify-content: center;
    gap: 5px;
    margin-top: 20px;
  }

  /*상세정보 등록/수정 시작*/

  .prd__info__wrap{
    margin: 0 20px;
  }


  .prd__info__btn__wrap{
    display: flex;
    justify-content: flex-end;
    gap: 5px;
    padding: 20px 0 10px 0;
  }



  .draggable.dragging {
    opacity: 0.5;
  }

  .append-grid {
    background-size: cover;
  }

  .product-cate {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .product-cate > div {
    width: 100px;
    height: 100px;
    border-radius: 2px;
    border: 1px solid #bfbfbf;
  }
  .product-wrap {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 20px;
    row-gap: 15px;
    border-radius: 2px;
    background-size: cover;
    border: 1px solid #bfbfbf;
    padding: 10px;
  }

  .product-grid >div {
    border-radius: 2px;
    border: 1px solid #bfbfbf;
  }

  .product-wrap > div {
    display: flex;
    border: 1px solid #bfbfbf;
    border-radius: 2px;
    height: 40px;
    justify-content: center;
    align-items: center;
  }

  .product-wrap>div:nth-child(odd) {}

  .product-wrap>div:hover {
    background-color: orange;
  }

  .product-wrap>div:nth-child(odd):hover {
    background-color: indianred;
  }

  
  .product-info-wrap {
    display: flex;
    margin-top: 20px;
    flex-wrap: wrap;
    gap: 5px;
    justify-content: space-between;
  }

  .product-info-wrap > div {
    cursor: pointer;
    font-size: 12px;
    width: 115px;
    height: 22px;
    border: 1px solid #bfbfbf;
    background-color: #fff;
    border-radius: 2px;
    display: flex;
    color:#000;
    align-items: center;
    justify-content: center;
    font-weight: normal;
  }
  .align__btn__wrap{
    display: flex;
    margin-top: 20px;
    justify-content: space-between;
    width: 100%;
  }
  .align__btn__wrap > div {
    cursor: pointer;
    font-size: 12px;
    height: 22px;
    width: 115px;
    border: 1px solid #707070;
    background-color: #fff;
    border-radius: 2px;
    font-weight: normal;
    display: flex;
    color:#000;
    align-items: center;
    justify-content: center;
    font-weight: normal;
  }
  .prd__preview__wrap{
    padding: 20px 20px 0px 20px ;
  }


  /*버튼 배경색 시작*/
  .bg__blue{
    background-color:#140f82;
    color: #fff;
  }
  .bg__black{
    background-color:#000;
    color: #fff;
  }
  .bg__gray{
    background-color:#bfbfbf;
    color: #fff;
    border: none;
  }
</style>

<div class="content__card">
	<div class="grid__wrap prd__wrap">
		<div class="prd__grid">
			<div class="prd__title">라이브러리</div>
			<div class="library__btn__wrap">
				<div class="library__btn" onclick="libraryLoad_product();">
					<span>상품</span></div>
				<div class="library__btn" onclick="libraryLoad_img();"><span>이미지</span></div>
				<div class="library__btn"><span>비디오</span></div>
				<div class="container product-grid library__product"></div>
			</div>
		</div>
		<div class="prd__grid">
			<div class="prd__title">상품 진열 그리드</div>
			<div class="prd__display__btn__wrap">
				<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$page_idx = getUrlParamter($page_url, 'page_idx');
		?>
				<input id="page_idx" type="hidden" value="<?=$page_idx?>">
				<div class="display__btn bg__blue" tmp_flg="false" onclick="saveDisplayProductPage(this);">페이지 저장</div>
				<div class="display__btn" id="reset" onClick="location.reload();">페이지 초기화</div>
				<div class="display__btn" onClick="getDisplayProductInfo(true);">임시저장 불러오기</div>
				<div class="display__btn bg__black" tmp_flg="true" onclick="saveDisplayProductPage(this);">임시저장</div>
			</div>
			<section class="grid-demo" style="margin-top: 50px;">
				<div class="prd__display__btn__wrap">
					<div id="product" class="add-more-items btn-primary product display__btn">1 x 1
						추가</div>
					<div id="img" class="add-more-items btn-primary img display__btn">2 x 1 추가
					</div>

					<input id="rgb_input_all" class="rgb__input prd__input" type="text" placeholder="ex) #ffffff"
						value="#ffffff">
					<div class="display__btn bg__gray" change="all" onClick="gridBgChangeBtnClick(this);">전체 배경색 변경</div>

				</div>
				<div class="controls cf" style="display: none;">
					<div class="control search">
						<div class="control-icon">
							<i class="material-icons">&#xE8B6;</i>
						</div>
						<input class="control-field search-field form-control " type="text" name="search"
							placeholder="Search..." />
					</div>

					<div class="control filter">
						<div class="control-icon">
							<i class="material-icons">&#xE152;</i>
						</div>
						<div class="select-arrow">
							<i class="material-icons">&#xE313;</i>
						</div>
						<select class="control-field filter-field form-control">
							<option value="" checked>All</option>
							<option value="red">Red</option>
							<option value="blue">Blue</option>
							<option value="green">Green</option>
						</select>
					</div>

					<div class="control sort">
						<div class="control-icon">
							<i class="material-icons">&#xE164;</i>
						</div>
						<div class="select-arrow">
							<i class="material-icons">&#xE313;</i>
						</div>
						<select class="control-field sort-field form-control">
							<option value="order" checked>Drag</option>
							<option value="title">Title (drag disabled)</option>
							<option value="color">Color (drag disabled)</option>
						</select>
					</div>
					<div class="control layout">
						<div class="control-icon">
							<i class="material-icons">&#xE871;</i>
						</div>
						<div class="select-arrow">
							<i class="material-icons">&#xE313;</i>
						</div>
						<select class="control-field layout-field form-control">
							<option value="left-top" checked>Left Top</option>
							<option value="left-top-fillgaps">Left Top (fill gaps)</option>
							<option value="right-top">Right Top</option>
							<option value="right-top-fillgaps">Right Top (fill gaps)</option>
							<option value="left-bottom">Left Bottom</option>
							<option value="left-bottom-fillgaps">Left Bottom (fill gaps)</option>
							<option value="right-bottom">Right Bottom</option>
							<option value="right-bottom-fillgaps">Right Bottom (fill gaps)</option>
						</select>
					</div>
				</div>
				<div class="grid"></div>
				<div class="grid-footer">
				</div>
			</section>
		</div>
		<div class="prd__grid">
			<div class="prd__title">상품별 상세정보 등록/수정</div>
			<div class="prd__info__wrap">
				<form action="product-result.html" name="productInfoForm" method="post">
					<div class="prd__info__btn__wrap">
						<input id="rgb_input_one" class="prd__input" type="text" placeholder="ex) #ffffff"
							value="#ffffff">
						<div class="display__btn bg__gray" change="one" onClick="gridBgChangeBtnClick(this);">개별 배경색 변경</div>
					</div>

					<div class="product-wrap">
						<input id="product_idx" type="hidden" value="0">
						<div id="grid1" class="category-position" data-position="" data-idx="1"></div>
						<div id="grid2" class="category-position" data-position="" data-idx="2"></div>
						<div id="grid3" class="category-position" data-position="" data-idx="3"></div>
						<div id="grid4" class="category-position" data-position="" data-idx="4"></div>
						<div id="grid5" class="category-position" data-position="" data-idx="5"></div>
						<div id="grid6" class="category-position" data-position="" data-idx="6"></div>
						<div id="grid7" class="category-position" data-position="" data-idx="7"></div>
						<div id="grid8" class="category-position" data-position="" data-idx="8"></div>
						<div id="grid9" class="category-position" data-position="" data-idx="9"></div>
						<div id="grid10" class="category-position" data-position="" data-idx="10"></div>
						<div id="grid11" class="category-position" data-position="" data-idx="11"></div>
						<div id="grid12" class="category-position" data-position="" data-idx="12"></div>
						<div id="grid13" class="category-position" data-position="" data-idx="13"></div>
						<div id="grid14" class="category-position" data-position="" data-idx="14"></div>
					</div>

					<div class="align__btn__wrap">
						<div onclick="alignClick(event);" data-position="left" class="product-align-btn">왼쪽
						</div>
						<div onclick="alignClick(event);" data-position="center" class="product-align-btn" style="background-color: #707070;color:#fff;">가운데
						</div>
						<div onclick="alignClick(event);" data-position="right" class="product-align-btn">오른쪽
						</div>
					</div>

					<div class="product-info-wrap">
						<div id="column_price" data-category="price" class="category-btn" draggable="true">가격</div>
						<div id="column_product_name" data-category="productName" class="category-btn"
							draggable="true">상품명</div>
						<div id="column_color" data-category="color" class="category-btn" draggable="true">색상</div>
						<div id="column_like" data-category="like" class="category-btn" draggable="true">좋아요</div>
						<div id="column_sales" data-category="discount" class="category-btn" draggable="true">할인가
						</div>
						<div id="column_basket" data-category="basket" class="category-btn" draggable="true">장바구니
						</div>
					</div>

					<div class="flex" style="gap: 10px;justify-content:center;margin:30px 0;">
						<div class="display__btn bg__blue" onclick="saveProductGridColumn();">상세정보 저장</div>
						<div class="display__btn" id="product_reset">상세정보 초기화</div>
					</div>
				</form>
			</div>
		</div>
		<div class="prd__grid">
			<div class="prd__title">모바일 미리보기</div>
			<div class="prd__preview__wrap">
				<div class="mobile-preview-header">
					<div class="display__btn">아웃핏</div>
					<div class="display__btn">상품</div>
					<div class="display__btn bg__black setGrid">3 x 3</div>
				</div>

				<div class="mobile-preview-wrap two-grid">
					<div>
						<div class="mobile-preview">
						</div>
					</div>
					<div class="one__wrap">
						<div class="mobile-preview">
						</div>
					</div>
					<div class="one__wrap">
						<div class="mobile-preview">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
let grid = null;
//----------------------- 라이브러리 -----------------------//
//shson.Remove Or Update Product Grid
function imgClick(event){
	let imgEl = event.path[1].nextSibling.nextSibling;
	
	if (imgEl != null) {
		let product_code = imgEl.dataset.productcode;
		let url = imgEl.dataset.url;
		
		let grid_info_temp = $('#grid_' + product_code).val();
		
		let bg_color = "";
		let grid_column_data = null;
		if (grid_info_temp != null) {
			let json_data = JSON.parse(grid_info_temp);
			
			bg_color = json_data.bg_color;
			grid_column_data = json_data.data;
		}
		
		$('#product_idx').val(imgEl.dataset.idx);
		
		$('.product-wrap').css('background-image', 'url(' + url + ')');
		$('.product-wrap').attr('grid_type','PRD');
		$('.product-wrap').attr('grid_size',"1");
		$('.product-wrap').attr('bg-color',bg_color);
		
		document.querySelector('.product-wrap').dataset.productcode = product_code;
		document.querySelector('.product-wrap').dataset.src = url;
		document.querySelector('.product-wrap').style.backgroundColor = bg_color;
		
		productDetailCategoryLoad();
		
		//shson.Reset Grid Column
		for (var i=1; i<=14; i++) {
			$('#grid' + i).empty();
		}
		
		if (grid_column_data != null) {
			for (var i=0; i<grid_column_data.length; i++) {
				let grid = $('#grid' + grid_column_data[i].idx);
				grid.attr('position',grid_column_data[i].position);
				
				$('#' + grid_column_data[i].category_id).remove();
				
				let strDiv = "";
				strDiv += '<div id="' + grid_column_data[i].category_id + '" data-category="' + grid_column_data[i].category + '" class="category-btn" draggable="true">' + grid_column_data[i].category + '</div>';
				
				grid.append(strDiv);
			}
		}
		
		event.stopPropagation();
	} else {
		alert('상품을 선택 후 편집버튼을 눌러주세요.');
		return false;
	}
}

function libraryLoad_product() {
	let card = document.querySelectorAll('.card');
	let product_idx = [];
	
	if (card != null) {	
		[...card].forEach((el) =>{
			let children = el.children[3];
			
			if (children != null) {
				let idx = children.dataset.idx;
				product_idx.push(idx);
			}
		});
	}
	
	$.ajax({
		type: "post",
		data: {
			"product_idx":product_idx
		},
		dataType: "json",
		url: config.api + "display/product/grid/lib/get",
		error: function() {
			alert("상품 이미지 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if(data != null){
					var strDiv = "";
					data.forEach(function(row) {
						strDiv += '<img class="library" draggable="true" id="' + row.product_code + '" data-name="ader1" data-url="' + row.img_location + '" data-productcode="' + row.product_code + '" data-idx="' + row.product_idx + '" src="' + row.img_location + '" alt="">';
					});
					
					let productImgWrap = document.querySelector('.product-grid');
					productImgWrap.innerHTML = strDiv;
					
					libraryDragStart();
				}
			}
		}
	});
}

function libraryLoad_img() {
	let card = document.querySelectorAll('.card');
	let img_idx = [];
	
	if (card != null) {	
		[...card].forEach((el) =>{
			let children = el.children[3];
			
			if (children != null) {
				let idx = children.dataset.idx;
				img_idx.push(idx);
			}
		});
	}
	
	let productImgWrap = document.querySelector('.product-grid');
	
	var strDiv = "";
	for (var i=1; i<=6; i++) {
		strDiv += '<img class="library" draggable="true" id="img_0' + i + '" data-name="ader1" data-url="/images/display/sample/sample' + i + '.jpeg" data-productcode="IMG' + i + '" data-idx="0" src="/images/display/sample/sample' + i + '.jpeg" alt="">'
	}
	productImgWrap.innerHTML = strDiv;
	
	libraryDragStart();
}

function libraryDragStart() {
	let library = document.querySelectorAll('.library');
	let productWrap = document.querySelector('.product-wrap');
	
	library.forEach((item) => {
		item.addEventListener('dragstart', (ev) => {
			if (ev.dataTransfer.effectAllowed === 'uninitialized') {
				ev.dataTransfer.setData('product_idx', ev.target.dataset.idx);
				ev.dataTransfer.setData('product_code', ev.target.id);
				ev.dataTransfer.setData('content_url', ev.target.dataset.url);
				
				let imgLibrarySrc = ev.target.src;
				let imgLibraryId = ev.target.id;
				
				ev.dataTransfer.effectAllowed = "copyMove";
			}
		});
	});
}

function libraryAddEvent() {
	let gridCard = document.querySelectorAll('.muuri-item');
	gridCard.forEach((item) => {
		item.addEventListener('dragover', libraryDragover);
		item.addEventListener('drop', libraryDrop);
	});
}

function libraryDragover(ev) {
	ev.preventDefault();
	
	// Set the dropEffect to move
	ev.dataTransfer.dropEffect = "move"
}

function libraryDrop(ev) {
	ev.preventDefault();
	if (ev.target.classList != 'card') {
		return false;
	} else {
		let product_idx = ev.dataTransfer.getData('product_idx');
		let product_code = ev.dataTransfer.getData('product_code');
		let content_url = ev.dataTransfer.getData('content_url');
		
		let width = 0;
		let grid_type = "";
		if (product_idx != "0") {
			width = 1;
			grid_type = "PRD";
		} else {
			width = 2;
			grid_type = "IMG";
		}
		
		let grid_info_temp = $(ev.target).parent().parent().find('.grid_info_temp');
		
		let json_data = JSON.parse(grid_info_temp.val());
		let bg_color = json_data.bg_color;
		
		let default_value = "";
		default_value += '{';
		default_value += '    "grid_type":"' + grid_type + '",';
		default_value += '    "grid_size":"' + width + '",';
		default_value += '    "product_idx":"' + product_idx + '",';
		default_value += '    "product_code":"' + product_code + '",';
		default_value += '    "content_url":"' + content_url + '",';
		default_value += '    "bg_color":"' + bg_color + '",';
		default_value += '    "data":null';
		default_value += '}';
		
		grid_info_temp.attr('id','grid_' + product_code);
		grid_info_temp.attr('product_idx',product_idx);
		grid_info_temp.val(default_value);
		
		let item = document.getElementById(product_code);
		ev.target.appendChild(item);
		
		resetProductWrap();
	}
}

function resetProductWrap() {
	let product_wrap = document.querySelector('.product-wrap');
	
	$('#product_idx').val(0);
	
	product_wrap.dataset.productcode = "";
	product_wrap.dataset.src = "";
	
	$('.product-wrap').css('background-image','');
	$('.product-wrap').css('background-color','#ffffff');
	$('.product-wrap').removeAttr('grid_type','')
	$('.product-wrap').removeAttr('grid_size','')
	$('.product-wrap').removeAttr('bg-color','')
	
	for (var i=1; i<=14; i++) {
		$('#grid' + i).empty();
	}
}

//----------------------- 상품별 상세 수정 -----------------------//
function productDetailDragStart(ev) {
	//console.log(`dragstart: target.id = ${ev.target.dataset.category}`);
	//console.log(`dragstart: target.id = ${ev.target.id}`);
	// Add this element's id to the drag payload so the drop handler will
	// know which element to add to its tree
	ev.dataTransfer.setData("grid_column_id", ev.target.id);
	ev.dataTransfer.effectAllowed = "move";
}

function productDetailDrop(ev) {
	ev.preventDefault();
	ev.stopPropagation()
	// Get the id of the target and add the moved element to the target's DOM
	const data = ev.dataTransfer.getData("grid_column_id");
	ev.target.appendChild(document.getElementById(data));
	ev.target.classList.add('click');
	// Print each item's "kind" and "type"
}

function productDetailDragover(ev) {
	ev.preventDefault();
	// Set the dropEffect to move
	ev.dataTransfer.dropEffect = "move"
}

function alignClick(event) {
	let textAling = event.target.dataset.position;
	let article = document.getElementById(categoryId);
	article.dataset.position = textAling;
}

function saveProductGridColumn() {
	let productWrap = document.querySelector('.product-wrap');
	
	if (productWrap.dataset.productcode != null) {
		let product_idx = $('#product_idx').val();
		let product_code = productWrap.dataset.productcode;
		let content_url = productWrap.dataset.src;
		let grid_type = $(productWrap).attr('grid_type');
		let grid_size = $(productWrap).attr('grid_size');
		let bg_color = $(productWrap).attr('bg-color');
		
		let grid_data = {};
		let temp_data = [];
		
		let category_id = "";
		let category = "";
		
		let getBg = productWrap.dataset.bgcolor;
		
		[...productWrap.children].forEach((el) =>{
			let childCnt  = el.children.length;
			if(childCnt > 0){
				category_id = el.children[0].id;
				category = el.children[0].dataset.category;
				
				temp_data.push(
					{
						"idx" : el.dataset.idx,
						"category_id" : category_id,
						"category" : category,
						"position" : el.dataset.position
					}
				)
			}
		});
		
		grid_data.product_idx = product_idx;
		grid_data.product_code = product_code;
		grid_data.content_url = content_url;
		grid_data.grid_type = grid_type;
		grid_data.grid_size = grid_size;
		grid_data.bg_color = bg_color;
		grid_data.data = temp_data;
		
		if (grid_data != null) {
			var json_str = JSON.stringify(grid_data);
			$('#grid_' + product_code).val(json_str);
			
			alert('상세정보가 저장되었습니다.');
		} else {
			alert('상세정보가 저장에 실패했습니다. 등록하려는 항목의 값을 확인해주세요.');
			return false;
		}
	} else {
		alert('진열 상품이 선택되지 않았습니다.');
		return false;
	}
}

function gridColumnClick(ev) {
	ev.preventDefault();
	let alignBtn = document.querySelectorAll(".product-align-btn");
	let childCnt = this.childElementCount;
	categoryId = this.id;
	if (childCnt > 0) {
		alignBtn.forEach((item) => {
			item.classList.add('animate__animated', 'animate__bounce');
			setTimeout(function () {
				item.classList.remove('animate__animated', 'animate__bounce');
			}, 1000);
		});
	}
}

function productDetailAddEvent() {
	const categoryPosition = document.querySelectorAll(".category-position");
	const categoryBtn = document.querySelectorAll(".category-btn");
	categoryPosition.forEach((item) => {
		item.addEventListener("dragstart", productDetailDragStart)
		item.addEventListener("dragover", productDetailDragover)
		item.addEventListener("drop", productDetailDrop)
		item.addEventListener("click", gridColumnClick)
	});
	
	categoryBtn.forEach((item) => {
		item.addEventListener("dragstart", productDetailDragStart)
	});
}

function gridBgChangeBtnClick(obj){
	let change = $(obj).attr('change');
	
	const product_wrap = document.querySelector('.product-wrap');
	let product_idx = $('#product_idx').val();
	
	let color_code = "";
	if (change == "one") {
		if (parseInt(product_idx) > 0) {
			color_code = $('#rgb_input_one').val();
		} else {
			alert('진열 상품이 선택되지 않았습니다.');
			return false;
		}
	} else if (change == "all") {
		color_code = $('#rgb_input_all').val();
	}
	
	let regex = /^#[0-9a-f]{3,6}$/i;
	if (color_code.length == 0 || color_code == null) {
		alert('색상코드를 입력해주세요.');
		return false;
	}
	
	if (color_code.length < 7) {
		alert('정확한 색상코드를 입력해주세요.');
		return false;
	}
	
	if (!regex.test(color_code)) {
		alert('색상코드가 유효하지 않습니다. 정확한 색상코드를 입력해주세요.');
		return false;
	}
	
	if (change == "all") {
		let card_grid = document.querySelectorAll('.card');
		if (card_grid != null) {	
			[...card_grid].forEach((el) =>{
				el.style.backgroundColor = color_code;
				let children = el.children[0];
				let img = $(el).find('.library').css('background-color',color_code);
				
				if (children != null) {
					let json_parse_temp = JSON.parse(children.value);
					json_parse_temp.bg_color = color_code;
					
					children.value = JSON.stringify(json_parse_temp);
				}
			});
		}
	} else {
		let product_code = product_wrap.dataset.productcode;
		if (product_code != null) {
			$('#' + product_code).css('background-color',color_code);
			let grid_info_temp = $('#grid_' + product_code).val();
			if (grid_info_temp != null) {
				let json_data = JSON.parse(grid_info_temp);
				json_data.bg_color = color_code;
				$('#grid_' + product_code).val(JSON.stringify(json_data));
			}
		}
		
		$('#rgb_input_one').val("#ffffff");
	}
	
	product_wrap.style.backgroundColor = color_code;
	product_wrap.dataset.bgcolor = color_code;
}

function productDetailCategoryLoad(){
	const column = document.querySelector('.product-info-wrap');
	let html='';
	
	let category_id = ['column_price','column_product_name','column_color','column_like','column_sales','column_basket'];
	let category = ['가격','상품명','색상','좋아요','할인가','장바구니'];
	category.forEach((item,index)=>{
		html += '<div id="' + category_id[index] + '" data-category="' + item + '" class="category-btn" draggable="true">' + item + '</div>';
		
		column.innerHTML = html;
	});
	
	productDetailAddEvent();
}

//----------------------- 프리뷰 -----------------------//
function previewSetGridBtn() {
	const gridBtn = document.querySelector('.mobile-preview-wrap');
	const setGrid = document.querySelector('.setGrid');
	
	setGrid.addEventListener('click', () => {
		if (gridBtn.classList.contains('one-grid')) {
			gridBtn.classList.replace('one-grid', 'two-grid');
			setGrid.style.backgroundColor = '#bfbfbf';
			setGrid.innerHTML = '3 x 3';
			$('.one__wrap').show();
		} else if (gridBtn.classList.contains('two-grid')) {
			gridBtn.classList.replace('two-grid', 'three-grid');
			setGrid.style.backgroundColor = 'red';
			setGrid.innerHTML = '1 x 1';
			$('.one__wrap').show();
		} else {
			gridBtn.classList.replace('three-grid', 'one-grid');
			setGrid.style.backgroundColor = 'blue';
			setGrid.innerHTML = '2 x 2';
			$('.one__wrap').hide();
		}
	});
}

//----------------------- 공통 -----------------------//
function productInfoCall(info){
	const product ={
	  id : '1',
	  url: '/image/nav3.jpg',
	  idx: '1'
	}

	return product[info] || '...?';
}

function saveDisplayProductPage(obj){
	let tmp_flg = $(obj).attr('tmp_flg');
	let page_idx = $('#page_idx').val();
	
	let json_data = [];
	let json_param = null;
	
	let length = $('.grid_info_temp').length;
	if (length > 0) {
		for(let i = 0;  i < length; i++){
			let grid_info_temp = $('.grid_info_temp').eq(i);
			
			let data_id = grid_info_temp.parent().attr('data-id');
			let array_num = (parseInt(data_id) - 1);
			
			let temp_val = grid_info_temp.val();
			json_data[array_num] = temp_val;
		}
		
		json_param = JSON.stringify(json_data);
	}
	
	if (json_param != null) {
		$.ajax({
			type: "post",
			data: {
				"tmp_flg":tmp_flg,
				"page_idx":page_idx,
				"json_param":json_param
			},
			dataType: "json",
			url: config.api + "display/product/grid/add",
			error: function() {
				alert("페이지 저장 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("전시관리 > 상품진열", "상품진열 페이지 수정", null);
					alert('상품이 정상적으로 진열되었습니다.',function pageLocation() {
						location.href = '/display/product';
					});
				}
			}
		});
	}
}

function removeAllchild(div) {
	while (div.hasChildNodes()) {
		div.removeChild(div.firstChild);
	}
}

$(document).ready(function () {
	productDetailCategoryLoad();
	
	let docElem = document.documentElement;
	let demo = document.querySelector(".grid-demo");
	let gridElement = demo.querySelector(".grid");
	
	let itemContainers = Array.prototype.slice.call(demo.querySelectorAll('.grid-column-content'));
	let columnGrids = [];
	let boardGrid;
	let filterField = demo.querySelector(".filter-field");
	let searchField = demo.querySelector(".search-field");
	let sortField = demo.querySelector(".sort-field");
	let layoutField = demo.querySelector(".layout-field");
	let itemsElement = demo.querySelector(".add-more-items");
	let imgItemsElement = demo.querySelector("#img");
	let productItemsElement = demo.querySelector("#product");
	let characters = "abcdefghijklmnopqrstuvwxyz";
	let filterOptions = ["red", "blue", "green","gray"];
	let dragOrder = [];
	let uuid = 0;
	let filterFieldValue;
	let sortFieldValue;
	let layoutFieldValue;
	let searchFieldValue;

	function initDemo() {
		initGrid();
		
		// Reset field values.
		searchField.value = "";
		[sortField, filterField, layoutField].forEach(function (field) {
			field.value = field.querySelectorAll("option")[0].value;
		});
		
		// Set inital search query, active filter, active sort value and active layout.
		searchFieldValue = searchField.value.toLowerCase();
		filterFieldValue = filterField.value;
		sortFieldValue = sortField.value;
		layoutFieldValue = layoutField.value;
		
		// Search field binding.
		searchField.addEventListener("keyup", function () {
			let newSearch = searchField.value.toLowerCase();
			if (searchFieldValue !== newSearch) {
				searchFieldValue = newSearch;
				filter();
			}
		});
		
		// Filter, sort and layout bindings.
		filterField.addEventListener("change", filter);
		sortField.addEventListener("change", sort);
		layoutField.addEventListener("change", changeLayout);
		
		// Add/remove items bindings.
		// addItemsElement.addEventListener("click", addItems);
		imgItemsElement.addEventListener("click", addItems);
		productItemsElement.addEventListener("click", addItems);
		
		gridElement.addEventListener('click', function (event) {
			event.preventDefault();
			if (elementMatches(event.target, '.card-remove, .card-remove i')) {
				removeItem(event);
			}
			grid.refreshItems();
		});
	}

	function initGrid() {
		let dragCounter = 0;
		grid = new Muuri(gridElement, {
			items: ".item",
			layoutDuration: 400,
			layoutEasing: "ease",
			dragEnabled: true,
			dragSortInterval: 50,
			dragContainer: document.body,
			dragStartPredicate: function (item, event) {
				let isDraggable = sortFieldValue === "order";
				let isRemoveAction = elementMatches(
					event.target,
					".card-remove, .card-remove i"
				);
				let isAddAction = elementMatches(
					event.target,
					".card-add, .card-add i"
				);
				return isDraggable && !isRemoveAction && !isAddAction ?
					Muuri.ItemDrag.defaultStartPredicate(item, event) :
					false;
			},
			dragReleaseDuration: 400,
			dragReleseEasing: "ease",
		})
		.on("move", updateIndices)
		.on("sort", updateIndices);
		
		columnGrids.push(grid);
	}
	
	function filter() {
		filterFieldValue = filterField.value;
		grid.filter(function (item) {
			let element = item.getElement();
			let isSearchMatch = !searchFieldValue ?
				true :(element.getAttribute("data-title") || "")
					.toLowerCase()
					.indexOf(searchFieldValue) > -1;
			let isFilterMatch = !filterFieldValue ? 
				true :(element.getAttribute("data-color") || "") === filterFieldValue;
			return isSearchMatch && isFilterMatch;
		});
	}
	
	function sort() {
		// Do nothing if sort value did not change.
		let currentSort = sortField.value;
		if (sortFieldValue === currentSort) {
			return;
		}
		
		// If we are changing from "order" sorting to something else
		// let's store the drag order.
		if (sortFieldValue === "order") {
			dragOrder = grid.getItems();
		}

		// Sort the items.
		grid.sort(
			currentSort === "title" ?
				compareItemTitle :
				currentSort === "color" ?
					compareItemColor :
					dragOrder
		);
		
		// Update indices and active sort value.
		updateIndices();
		sortFieldValue = currentSort;
	}
	
	function addItems(e) {
		// 새로운 엘리먼트를 생성하기
		
		let getId = e.target.id;
		if (getId == 'product') {
			// 새 엘리먼트의 디스플레이를 없음으로 표시
			// default.
			let productElems = generateElements(1);
			// 그리드에 요소를 추가하기
			productElems.forEach(function (item) {
				item.style.display = "none";
			});
			let productItems = grid.add(productElems);
		} else if (getId == 'img') {
			let imgElems = imgGenerateElements(1);
			imgElems.forEach(function (item) {
			  item.style.display = "none";
			});
			let imgItems = grid.add(imgElems);
		}
		
		
		// UI 인덱스 업데이트하기
		updateIndices();
		
		//드래그 정렬이 활성화되지 않은 경우에만 항목을 정렬하기
		if (sortFieldValue !== "order") {
			grid.sort(
				sortFieldValue === "title" ? compareItemTitle : compareItemColor
			);
			
			dragOrder = dragOrder.concat(productItems);
		}
		
		// 마지막으로 항목을 필터링한다.
		filter();
		libraryAddEvent();
	}
	
	function removeItem(event) {
		var elem = elementClosest(event.target, '.item');
		
		var index = (parseInt($(elem).find('.card-id').text()) - 1);
		grid.remove(grid.getItems(index), {
			removeElements: true
		});
		
		$('.product-wrap').css('background-image', 'url("")');
		
		updateIndices();
	}

  	function changeLayout() {
		layoutFieldValue = layoutField.value;
		grid._settings.layout = {
			horizontal: false,
			alignRight: layoutFieldValue.indexOf("right") > -1,
			alignBottom: layoutFieldValue.indexOf("bottom") > -1,
			fillGaps: layoutFieldValue.indexOf("fillgaps") > -1
		};
		grid.layout();
	}
	
	function generateElements(amount) {
		let ret = [];
		
		for (let i = 0, len = amount || 1; i < amount; i++) {
			//shson.Product Grid Attribute
			let id = ++uuid;
			let color = "gray";
			
			let bg_color = "";

			let color_code = $('#rgb_input_all').val();
			let regex = /^#[0-9a-f]{3,6}$/i;
			
			if (color_code != null && regex.test(color_code)) {
				bg_color = color_code;
			} else {
				bg_color = "#ffffff";
			}
			
			let width = 1;
			let height = 1;
			
			let itemElem = document.createElement("div");
			
			let strDiv = "";
			strDiv += '<div class="card_grid item h' + height + ' w' + width + ' ' + color + '" style="background-color:' + bg_color + '" draggable="true" data-id="' + id + '" data-color="' + color + '">';
			
			let default_value = "";
			default_value += '{';
			default_value += '    "grid_type":"PRD",';
			default_value += '    "grid_size":"' + width + '",';
			default_value += '    "product_idx":"0",';
			default_value += '    "product_code":null,';
			default_value += '    "content_url":null,';
			default_value += '    "bg_color":"' + color_code + '",';
			default_value += '    "data":null';
			default_value += '}';
			
			strDiv += "    <input data-gridinput='" + id + "' product_idx='0' type='hidden' class='grid_info_temp' name='grid_info_temp' value='" + default_value + "'>";
			strDiv += '    <div class="item-content">';
			strDiv += '        <div class="card">';
			strDiv += '            <div class="card-id">' + id + '</div>';
			strDiv += '            <div class="card-remove">';
			strDiv += '                <i class="material-icons">&#xE5CD;</i>';
			strDiv += '            </div>';
			strDiv += '            <div class="card-add" >';
			strDiv += '                <i class="material-icons" onclick="imgClick(event);">&#xE145;</i>';
			strDiv += '            </div>';
			strDiv += '        </div>';
			strDiv += '    </div>';
			strDiv += '</div>';

			itemElem.innerHTML = strDiv;
			ret.push(itemElem.firstChild);
		}
		
		return ret;
	}

	function imgGenerateElements(amount) {
		let ret = [];
		
		for (let i = 0, len = amount || 1; i < amount; i++) {
			let id = ++uuid;
			let color = "gray";
			let title = "이미지";
			let width = 2;
			
			let height = 1;
			let itemElem = document.createElement("div");
			
			let strDiv = "";
			strDiv += '<div class="item h' + height + ' w' + width + ' ' + color + '" data-id="' + id + '" data-color="' + color + '">';
			
			let default_value = "";
			default_value += '{';
			default_value += '    "grid_type":"PRD",';
			default_value += '    "grid_size":"' + width + '",';
			default_value += '    "product_idx":"0",';
			default_value += '    "product_code":null,';
			default_value += '    "content_url":null,';
			default_value += '    "bg_color":"#ffffff",';
			default_value += '    "data":null';
			default_value += '}';
			
			strDiv += "    <input data-gridinput='" + id + "' product_idx='0' type='hidden' class='grid_info_temp' name='grid_info_temp' value='" + default_value + "'>";
			strDiv += '    <div class="item-content">';
			strDiv += '        <div class="card">';
			strDiv += '            <div class="card-id">' + id + '</div>';
			strDiv += '            <div class="card-remove"><i class="material-icons">&#xE5CD;</i></div>';
			strDiv += '        </div>';
			strDiv += '    </div>';
			strDiv += '</div>';
			
			itemElem.innerHTML = strDiv;
			ret.push(itemElem.firstChild);
		}
		return ret;
	}
	
	function getRandomItem(collection) {
		return collection[Math.floor(Math.random() * collection.length)];
	}

	function generateRandomWord(length) {
		let ret = "";
		for (let i = 0; i < length; i++) {
			ret += getRandomItem(characters);
		}
		return ret;
	}
	
	function compareItemTitle(a, b) {
		let aVal = a.getElement().getAttribute("data-title") || "";
		let bVal = b.getElement().getAttribute("data-title") || "";
		
		return aVal < bVal ? -1 : aVal > bVal ? 1 : 0;
	}

	function compareItemColor(a, b) {
		let aVal = a.getElement().getAttribute("data-color") || "";
		let bVal = b.getElement().getAttribute("data-color") || "";
		
		return aVal < bVal ? -1 : aVal > bVal ? 1 : compareItemTitle(a, b);
	}
	
	//shson.UPDATE GRID data-id from 1
	function updateIndices() {
		grid.getItems().forEach(function (item, i) {
			item.getElement().setAttribute("data-id", i + 1);
			item.getElement().querySelector(".card-id").innerHTML = i + 1;
		});
	}
	
	function elementMatches(element, selector) {
		let p = Element.prototype;
		return (
			p.matches ||
			p.matchesSelector ||
			p.webkitMatchesSelector ||
			p.mozMatchesSelector ||
			p.msMatchesSelector ||
			p.oMatchesSelector
		).call(element, selector);
	}

	function elementClosest(element, selector) {
		if (window.Element && !Element.prototype.closest) {
			let isMatch = elementMatches(element, selector);
			
			while (!isMatch && element && element !== document) {
				element = element.parentNode;
				isMatch = element && element !== document && elementMatches(element, selector);
			}
			
			return element && element !== document ? element : null;
		} else {
			return element.closest(selector);
		}
	}
	
	/*----------------------------------  상품 상세설정 초기화 ---------------------------------*/
	//const reset = document.querySelector("#reset");
	//reset.addEventListener("click", () => document.location.reload());
	
	const product_reset = document.querySelector("#product_reset");
	product_reset.addEventListener("click", () => {
		confirm('초기화된 상세정보는 복구할 수 없습니다. 정말 초기화하시겠습니까?',function() {
			let categoryPosition= document.querySelectorAll('.category-position'); 
			let productWrap= document.querySelector('.product-wrap'); 
			let productCode = productWrap.dataset.productcode;
			
			//document.getElementById(`${productCode}`).parentElement.parentElement.previousSibling.value = '';
			
			let product_idx = $('#product_idx').val();
			let product_code = productWrap.dataset.productcode;
			let content_url = productWrap.dataset.src;
			
			let default_value = "";
			default_value += '{';
			default_value += '    "grid_type":"PRD",';
			default_value += '    "grid_size":"1",';
			default_value += '    "product_idx":"' + product_idx + '",';
			default_value += '    "product_code":"' + product_code + '",';
			default_value += '    "content_url":"' + content_url + '",';
			default_value += '    "bg_color":"#ffffff",';
			default_value += '    "data":null';
			default_value += '}';
			
			$('#grid_' + product_code).val(default_value);
			
			categoryPosition.forEach((i)=>{
				removeAllchild(i);
			});
			
			productDetailCategoryLoad();
		});
	});
	
	/*----------------------------------  함수 호출 ---------------------------------*/
	initDemo();

	libraryDragStart();
	previewSetGridBtn();
	productDetailAddEvent();
	/*----------------------------------  함수 호출 ---------------------------------*/
	
	getDisplayProductInfo(null);
});

function getDisplayProductInfo(param) {
	let page_idx = $('#page_idx').val();
	let tmp_flg = false;
	if (param != null) {
		tmp_flg = true;
	}
	
	$.ajax({
		type: "post",
		data: {
			"tmp_flg":tmp_flg,
			"page_idx":page_idx
		},
		dataType: "json",
		url: config.api + "display/product/grid/get",
		error: function() {
			alert("상품 진열정보 불러오기 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				if(data != null){
					let ret = [];
					
					let itemElem = document.createElement("div");
					data.forEach(function(row) {
						
						let id = row.display_num;
						let bg = row.bg_color;
						let width = "";
						let color = "gray";
						
						let grid_type = row.grid_type;
						if (grid_type == "PRD") {
							width = 1;
						} else if (grid_type == "IMG") {
							width = 2;
						}
						
						let height = 1;

						let strDiv = "";
						strDiv += '<div class="card_grid item h1 w' + width + ' ' + color + '" style="background-color:' + bg + '" draggable="true" data-id="' + id + '" data-color="' + color + '">';

						let default_value = row.json_data;
						
						let product_code = row.product_code;
						
						let grid_id = "";
						if (product_code.length > 0) {
							grid_id = 'id="grid_' + product_code + '"';
						}
						
						strDiv += "    <input " + grid_id + " data-gridinput='" + id + "' product_idx='" + row.product_idx + "' type='hidden' class='grid_info_temp' name='grid_info_temp' value='" + default_value + "'>";
						strDiv += '    <div class="item-content">';
						strDiv += '        <div class="card">';
						strDiv += '            <div class="card-id">' + id + '</div>';
						strDiv += '            <div class="card-remove">';
						strDiv += '                <i class="material-icons">&#xE5CD;</i>';
						strDiv += '            </div>';
						
						if (grid_type == "PRD") {
							strDiv += '        <div class="card-add" >';
							strDiv += '            <i class="material-icons" onclick="imgClick(event);">&#xE145;</i>';
							strDiv += '        </div>';
						}
						
						if (row.content_url.length > 0) {
							strDiv += '        <img id="' + row.product_code + '"class="library" draggable="true" id="' + row.product_code + '" data-name="ader1" data-url="' + row.content_url + '" data-productcode="' + row.product_code + '" data-idx="' + row.product_idx + '" src="' + row.content_url + '" alt="">';	
						}
						
						strDiv += '        </div>';
						strDiv += '    </div>';
						strDiv += '</div>';

						itemElem.innerHTML = strDiv;
						ret.push(itemElem.firstChild);
					});
					grid.add(ret);
					libraryAddEvent();
				} else {
					if (tmp_flg == true) {
						alert("임시저장 데이터가 존재하지않습니다.");
					}
				}
			}
		}
	});
}
</script>