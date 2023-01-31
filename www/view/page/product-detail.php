<link rel=stylesheet href='/css/product/detail.css' type='text/css'>
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
					<div class="top" id="detail-top"></div>
					<div class="middle">
						<div class="detail__btn__wrap">
							<div class="detail__btn__row">
								<div class="img-box">
									<img src="/images/svg/sizeguide.svg" alt="">
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
					<div class="sidebar__body"></div>
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
					<div class="swiper-pagination2"></div>
				</div>
			</div>
		</div>
		<div class="swiper-pagination"></div>
		<div class="info__wrap product"></div>
		<div class="basket__wrap--btn nav">
			<div class="basket__box--btn">
				<div class="basket-btn">
					<!-- <img src="/images/svg/basket.svg" alt=""> -->
					<span class="basket-title">쇼핑백에 담기</span>
				</div>
				<div class="whish-btn" onclick="setWhishListBtn(this)">
					<img class="whish_img" src="/images/svg/wishlist-bk.svg" alt="" style="">
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
	