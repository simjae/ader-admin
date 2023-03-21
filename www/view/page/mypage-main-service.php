<style>
    .service__wrap {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        margin: 40px 0 100px;
        width: 100%;
    }

    .service__wrap .title p {
        font-size: 13px;
    }

    .service__tab__btn__container {
        grid-column: 1/17;
        margin: 0 auto;
        display: flex;
        gap: 10px;
        font-size: 11px;
    }

    .service__tab__wrap {
        grid-column: 1/17;
        width: 470px;
        margin: 0 auto;
    }

    .service__tab__wrap .title {
        font-size: 13px;
        margin-bottom: 30px;
    }

    .info__scroll__wrap .info__contents h2 {
        font-size: 13px;
        margin-top: 30px;
        margin-bottom: 10px;
        color: #343434;
    }

    .info__scroll__wrap .info__contents p {
        font-size: 11px;
        letter-spacing: normal;
        text-align: left;
    }
    
    .service__wrap .info__scroll__wrap {
        width: 710px;
        height: 470px;
        overflow: scroll;
    }
    .service__tab__wrap .info__contents {
        margin-bottom: 30px;
        font-size: 11px;
        text-align: left;
    }

    .service__wrap .info__scroll__wrap::-webkit-scrollbar {
        width: 5px;
    }

    .service__wrap .info__scroll__wrap::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .service__wrap .info__scroll__wrap::-webkit-scrollbar-thumb {
        background-color: #dcdcdc;
    }

    .service__wrap .description h2 {
        font-family: var(--ft-no-fu);
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.15;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .service__wrap .description ul {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        margin-top: 10px;
        line-height: 2;
    }

    .service__wrap .description p {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        line-height: 2;
    }

    .service__tab__wrap .request {
        padding-left: 20px;
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        line-height: 2;
    }
    
    .service__tab__wrap .request p {
        margin-bottom: 10px;
    }

    .service__tab__wrap .toggle__item {
        margin-bottom: 10px !important;
    }
    .service__tab__btn__container .tab__btn__item {
        padding: 0 10px;
    }

    @media (max-width: 1024px) {
        .service__wrap .info__scroll__wrap {
            width: 100%;
            height: 470px;
            overflow: scroll;
        }
        .mypage__tab__container {
            margin-bottom: 60px;
        }

        .service__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .service__wrap {
            margin: 20px 0 60px;
        }

        .service__wrap .info__contents {
            width: 100%
        }

        .toggle__list {
            width: 100%
        }
    }

    @media (min-width: 600px) {
        .service__tab__wrap {
            width: 580px;
            margin: 0 auto;
            margin-top: 37px;
        }
    }

    @media (min-width: 1024px) {
        .service__tab__wrap {
            grid-column: 1/17;
            width: 710px;
            margin: 0 auto;
            margin-top: 50px;
        }
    }

    @media (max-width: 445px) {
        .service__tab__btn__container {
            display:none;
        }
    }
    @media (min-width: 445px) {
        .service__wrap .swiper.tab__btn {
            display:none;
        }
    }
</style>
<div class="service__wrap">
    <div class="service__tab__btn__container">
        <div class="tab__btn__item" form-id="service__notice__wrap">
            <span data-i18n="lm_notice">공지사항</span>
        </div>
        <div class="tab__btn__item" form-id="service__guide__wrap">
            <span data-i18n="lm_online_store_guide">온라인스토어 이용가이드</span>
        </div>
        <div class="tab__btn__item" form-id="service__terms__wrap">
            <span data-i18n="lm_terms_and_conditions">이용약관</span>
        </div>
        <div class="tab__btn__item" form-id="service__policy__wrap">
            <span data-i18n="lm_privacy_policy_02">개인정보처리방침</span>
        </div>
    </div>
    <div class="swiper tab__btn">
        <div class="swiper-wrapper">
            <div class="swiper-slide tab__btn__item" form-id="service__notice__wrap">
                <span data-i18n="lm_notice">공지사항</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="service__guide__wrap">
                <span data-i18n="lm_online_store_guide">온라인스토어 이용가이드</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="service__terms__wrap">
                <span data-i18n="lm_terms_and_conditions">이용약관</span>
            </div>
            <div class="swiper-slide tab__btn__item" form-id="service__policy__wrap">
                <span data-i18n="lm_privacy_policy_02">개인정보처리방침</span>
            </div>
        </div>
    </div>
    <div class="service__tab__wrap">
        <div class="service__tab service__notice__wrap">
            <div class="toggle__list float__none">
                <div class="toggle__list__tab 01">
                </div>
            </div>
        </div>
        <div class="service__tab service__guide__wrap">
            
        </div>
        <div class="service__tab service__terms__wrap">
            
        </div>
        <div class="service__tab service__policy__wrap">
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.service__tab').hide();
        $('.service__notice__wrap').show();
        let country = localStorage.getItem('lang') || getLanguage();
        $.ajax({
            type: "post",
            data: {
                "country": country
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/mypage/notice/get",
            error: function (d) {
                exceptionHandling("공지사항", '공지사항을 불러오지 못했습니다.');
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('.toggle__list__tab.01').html('');
                        d.data.forEach(function (row) {
                            var fix_btn = '';
                            strDiv = '';

                            if (row.fix_flg == 1) {
                                fix_btn = `<img src="/images/mypage/mypage_fixed_icon.svg" style="float:left;margin-right:5px;">`;
                            }
                            else {
                                fix_btn = '';
                            }
                            strDiv = `
                            <div class="toggle__item">
                                <div class="question">
                                    ${fix_btn}
                                    <span>${row.title}</span>
                                    <img src="/images/mypage/mypage_down_tab_btn.svg" class="down__up__icon" style="float:right;margin-top:10px;">
                                </div>
                                <div class="request" style="display:none">
                                    ${row.contents}
                                </div>
                            </div>
                        `;
                            $('.toggle__list__tab.01').append(strDiv);
                        })
                    }
                    $('.service__tab__wrap .request p').css('text-align', 'left');
                    $('.service__tab__wrap .request img').css('width', '670px');
                }
                else {
                    let err_str = '공지사항을 불러오지 못했습니다.';
                    if (d.msg != null) {
                        err_str = d.msg;
                    }
                    exceptionHandling("공지사항", err_str);
                    if (d.code = 401) {
                        $('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
                    }
                }
                $('.question').on('click', function () {
                    $('.request').not($(this).next()).hide();
                    $('.question').find('img.down__up__icon').attr('src', '/images/mypage/mypage_down_tab_btn.svg');

                    if ($(this).next().css('display') == 'none') {
                        $(this).find('img.down__up__icon').attr('src', '/images/mypage/mypage_up_tab_btn.svg');
                    }
                    else {
                        $(this).find('img.down__up__icon').attr('src', '/images/mypage/mypage_down_tab_btn.svg');
                    }
                    $(this).next().toggle();
                })

            }
        });

        $.ajax({
            type:"post",
            data: {
                "country": country,
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/policy/page/get",
            error: function() {
                alert("법적 고지사항 조회에 실패했습니다.");
            },
            success: function(d) {
                let data = d.data;
                if(data != null) {
                    data.forEach(el => {
                        if(el.policy_type == "GUD") {
                            let gudText = document.querySelector(".service__tab__wrap .service__guide__wrap");
                            gudText.innerHTML = el.policy_txt;
                        }
                        else if(el.policy_type == "PNL") {
                            let pnlText = document.querySelector(".service__tab__wrap .service__policy__wrap");
                            pnlText.innerHTML = el.policy_txt;
                        }
                        else if(el.policy_type == "TRM") {
                            let trmText = document.querySelector(".service__tab__wrap .service__terms__wrap");
                            trmText.innerHTML = el.policy_txt;
                        }
                    })
                } else {
                    alert("법적 고지사항 정보가 존재하지 않습니다.");
                }
            }
        })
    })

</script>