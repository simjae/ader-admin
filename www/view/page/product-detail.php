<link rel=stylesheet href='/css/old/product/detail.css' type='text/css'>
<style>
	.size__box .size.select {
        border-bottom: 2px solid #343434;
    }
	.basket-btn {
        cursor: pointer;
        border-top: 1px solid #dcdcdc;
        display: flex;
        justify-content: center;
        height: 30px;
        align-items: center;
    }

    .basket-btn[data-status='0'] {
        background-color: #dcdcdc;
		opacity: 0.6;
        pointer-events: none;
    }

    .basket-btn[data-status='1'] {
        background-color: #ffffff;
    }

    .basket-btn[data-status='1'].select {
        background-color: #000000;
        color: #fff;
    }

    
    .basket-btn[data-status='1'] span::before {
        content: url('/images/svg/reflesh-wh.svg');
        filter: invert(1);
        position: relative;
        bottom: -3px;
        padding-right:5px;
    }
    .basket-btn.option span::before {
        background-color: #dcdcdc;
        content: none;
    }
    .basket-btn[data-status='1'].select span::before {
        filter: none;
    }
    .basket-btn[data-status='1'].reorder {
        background-color: #000000;
        color: #ffffff;
    }
    .basket-btn[data-status='1'].reorder span::before {
        content: url('/images/svg/reflesh-wh.svg');
        filter: none;
    }
	.basket-btn[data-status='2'] span::before {
		content: url('/images/svg/basket-bk.svg');
        position: relative;
        bottom: -3px;
        padding-right:5px;
	}

    .basket-btn.select {
        background-color: #000000;
        color: #ffffff;
    }
	.size__box li[data-soldout="STCL"]:hover::before {
        content: "Only a few left";
        position: absolute;
        width: 200px;
        bottom: -15px;
        left: -90px;
        color: red;
    }
	.size__box li[data-soldout="STSC"]:hover::after {
        content: url(/images/svg/sold-line.svg);
        position: absolute;
        right: 1px;
        top: -2px;
    }
	.size__box li[data-soldout="STSC"]:hover::before {
        content: "Re-order";
        position: absolute;
        width: 50px;
        bottom: -15px;
        left: -15px;
    }
</style>
<?php
function getUrlParamter($url, $sch_tag)
{
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$product_idx = getUrlParamter($page_url, 'product_idx');
?>
<main data-productidx="<?= $product_idx ?>" data-country="KR">
	<div class="detail__sidebar__wrap">
		<div class="sidebar__background" data-modal="detail">
			<div class="sidebar__wrap" data-modal="detail">
				<div class="detail--box--btn">
					<div class="top"></div>
					<div class="middle">
						<div class="detail__btn__wrap">
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/sizeguide.svg" alt="">
								</div>
								<div class="detail__content__box">
									<div class="content-header"><span>사이즈 가이드</span></div>
									<div class="content-body">
										<div class="sizeguide-box">
											<div class="sizeguide-btn ">A1</div>
											<div class="sizeguide-btn">A2</div>
											<div class="sizeguide-btn select">A3</div>
											<div class="sizeguide-btn">A4</div>
											<div class="sizeguide-btn">A5</div>
										</div>
										<div class="sizeguide-noti">모델신장 179cm,착용사이즈는 A3입니다.</div>
										<div class="sizeguide-img" style="background-image: url('/images/svg/guide-top.svg');"></div>
										<div class="sizeguide-dct">
											<div class="dct-row">
												<span>A.총장</span>
												<span>옆목점에서 끝단까지의 수직길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>B. 목너비</span>
												<span>옆목점 양끝의 수평길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>C. 어깨너비</span>
												<span>옆어깨점 양끝의 수평길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>D. 가슴단면</span>
												<span>암홀점에서 1cm아래 양끝의 수평길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>E. 소매통</span>
												<span>암홀점에서 반대 소매면까지의 수직길이옆목점에서 끝단까지의 수직길이</span>
												<span class="dct-value">103.5</span>
											</div>
											<div class="dct-row">
												<span>F. 소매장</span>
												<span>어깨점부터 소매끝단까지의 길이</span>
												<span class="dct-value">103.5</span>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box select">
									<img src="/images/svg/material.svg" alt="">
								</div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/information.svg" alt="">
								</div>
							</div>
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/precaution.svg" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="bottom"></div>
				</div>
				<div class="sidebar__box" data-modal="detail">
					<div class="sidebar__header">
						<img class="sidebar__close__btn" src="/images/svg/close.svg" alt="">
					</div>
					<div class="sidebar__body">
						<div class="content__btn__wrap">
							<div class="tap__btn material__btn"><span>소재</span></div>
							<div class="tap__btn product__info__btn"><span>제품 상세정보</span></div>
							<div class="tap__btn precaution__btn"><span>제품 취급 유의사항</span></div>
						</div>
						<div class="content__box">
							<div class="material"></div>
							<div class=""></div>
							<div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="detail__wrapper">
		<div class="detail__box">
			<div class="navigation__wrap"></div>
			<div class="detail__img__wrap">
				<div class="main__swiper swiper">
					<div class="swiper-wrapper main_img_wrapper"></div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
		<div class="info__wrap product"></div>
		<div class="basket__wrap--btn nav">
			<div class="basket__box--btn">
				<div class="basket-btn" >
					<!-- <img src="/images/svg/basket.svg" alt=""> -->
					<span class="basket-title">쇼핑백에 담기</span>
				</div>
				<div class="whish-btn">
					<img src="/images/svg/wishlist-bk.svg" alt="" style="">
				</div>
			</div>
		</div>
	</section>
	<aside class="style__wrapper">
		<div class="left__title"><span>Styling with ></span></div>
		<div class="style-wrap">
			<div class="style-swiper swiper">

			</div>
		</div>
	</aside>
	<section class="recommend-wrap"></section>
</main>
<script src="/scripts/product/detail.js"></script>
<script type="module">import ForyouRender from '/scripts/module/foryou.js';const foryou = new ForyouRender();</script> 
	