<link rel=stylesheet href='/css/module/quickview.css' type='text/css'>
<div id="quickview" class="hidden">
    <div class="quickview__box">
        <input id="quickview_observer" type="hidden" />
        <div class="quickview__btn__wrap open">
            <div class="btn__box recent__btn" data-quick="recent">
                <div class="btn_icon_wrap recent_view">
                    <img src="/images/svg/wish-recent.svg" alt="">
                    <p>Recently<br>viewed</p>
                </div>
            </div>
            <div class="btn__box real__btn" data-quick="real">
                <div class="btn_icon_wrap">
                    <img src="/images/svg/wish-real.svg" alt="">
                    <p>Top</p>
                </div>
            </div>
            <div class="btn__box list__btn" data-quick="list">
                <div class="btn_icon_wrap">
                    <img src="/images/svg/wish-list.svg" alt="">
                    <p>Wishlist</p>
                </div>
            </div>
            <div class="btn__box faq__btn" data-quick="faq">
                <div class="btn_icon_wrap">
                    <img src="/images/svg/wish-faq.svg" alt="">
                    <p>Livechat</p>
                </div>
            </div>
        </div>
        <div class="quickview__content__wrap">
            <input type="hidden" id="sel_category_no" value="">
            <input type="hidden" id="sel_category_title" value="">
            <div class="content-header">
                <div class="title__box">
                    <img src="" alt="">
                    <span></span>
                </div>
                <div class="title__box--btn">
                    <div class="all-btn mobile" onclick="location.href='http://116.124.128.246:80/order/whish'">+ 전체 보기
                    </div>
                    <div id="quickview-close-btn" onclick="quickviewContentClose();" class="remove-btn">
                        <img src="/images/svg/sold-line.svg">
                        <img src="/images/svg/sold-line.svg">
                    </div>
                </div>
            </div>
            <div class="common-contents-container hidden">
            </div>
            <div class="contents-footer hidden">
                <input type="hidden" id="inquiry_type" name="inquiry_type">
                <input type="hidden" id="inquiry_title" name="inquiry_title">
                <div class="file-upload-btn">
                    <img src="/images/svg/file_clip_btn.svg" style="width:22px;height:22px;margin:5px auto;margin-left:11px">
                </div>
                <input type="text" id="inquiryTextBox" name="inquiryTextBox">

                <button class="submit_btn" onclick="registQuickViewInquiry()">확인</button>
            </div>
            <div class="swiper-quick-container">
                <div class="quickview-whish-swiper"></div>
            </div>
            <div class="all-btn web" onclick="location.href='http://116.124.128.246:80/order/whish'">+ 전체 보기</div>
        </div>
    </div>
</div>
<script src="/scripts/module/quickview.js"></script>