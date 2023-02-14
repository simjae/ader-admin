<link rel="stylesheet" href="/css/story/lookbook.css">
<style>
    .skeleton {
        padding: 0.5rem;
        list-style: none;
    }
    
    .card__image {
        display: block;
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
    .skeleton__content__box{
        height: 100%;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        padding: 10px 0;
        height: 40px;
        justify-content: center;
        text-align: center;
        background: #fff;
        font-size: 0.9rem;
        align-content: center;
    }
    .skeleton__content{
        width: 30%;
        height: 10px;
        animation: skeleton-gradient 3s linear infinite;
    }
    .skeleton__text {
        height: 40px;
        text-align: center;
        line-height: 40px;
        background: #fff;
        font-size: 0.9rem;
    }

    .skeleton__image {
        width: 100%;
        height: 20em;
        animation: skeleton-gradient 3s linear infinite;
    }

    @keyframes skeleton-gradient {
        0% {
            background: rgb(212, 212, 212);
        }

        50% {
            background: rgb(128, 128, 128);
        }

        100% {
            background: rgb(212, 212, 212);
        }
    }
</style>
<main>
    <section class="lookbook-wrap open">
        <div class="look-header-wrap scroll-motion">
            <div class="arrow-wrap">
                <div class="lookCategory-swiper swiper">
                    <div class="swiper-wrapper"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <div class="image-type-btn" data-type="L">
                <img src="/images/svg/grid-cols-4.svg" alt="">
                <span>작게보기</span>
            </div>
        </div>
        <div class="look-body">
            <div class="lookbook-result">
                <div class="lookbook-title-box">
                    <div class="lookbook-main__title">Project 1</div>
                    <div class="lookbook-sub__title">
                        2022 Fall Winter Collection<br>
                        Phenomenon Communication
                    </div>
                </div>
            </div>
        </div>
        <div class="look-footer">
            <div class="add-btn"></div>
        </div>
        <div class="lookbook-top-btn">
            <img src="/images/svg/top-btn.svg" alt="">
        </div>
    </section>
    <section class="lookbook-detail-wrap">
        <div class="back-btn web"><span>list</span></div>
        <div class="back-btn mobile">
            <img src="/images/svg/arrow-back.svg" alt="">
            <span class="lookbook-title">
                project 1
            </span>
        </div>
        <div class="lookbook-title-box">
            <div class="lookbook-main__title">Project 1</div>
            <div class="lookbook-sub__title">
                2022 Fall Winter Collection<br>
                Phenomenon Communication
            </div>
        </div>
        <div class="lock-wrap">
            <div class="lookbook-detail-swiper swiper">
                <div class="swiper-wrapper"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div id="related-wrap">
            <div class="related-product-swiper swiper">
                <div class="wrap-title">Related products</div>
                <div class="swiper-wrapper"></div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
</main>
<script src="/scripts/story/lookbook.js"></script>