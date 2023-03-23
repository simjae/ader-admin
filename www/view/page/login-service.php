<style>
    .service__wrap {
        width: 710px;
        margin: 150px auto;
    }

    .service__wrap .title {
        font-size: 13px;
        text-align: center;
        margin: 100px auto
    }

    .login_service_wrap {
        grid-column: 1/17;
        margin: 0 auto;
    }

    .login_service_wrap .request {
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

    .login_service_wrap .toggle__item {
        margin-bottom: 10px !important;
    }

    .title_service {
        grid-column: 1/17;
        width: 710px;
        margin: 0 auto;
        margin-top: 50px;
    }

    .toggle__list {
        width: 710px;

    }

    .toggle__list span {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.36;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
    }

    .toggle__list .category__title {
        margin-bottom: 10px;
    }

    .toggle__list .question {
        margin-bottom: 20px;
    }

    .toggle__list .request {
        margin-bottom: 20px;
    }

    .toggle__item {
        border-bottom: 1px solid #dcdcdc;
        margin-bottom: 20px;
    }


    @media (max-width: 1024px) {
        .service__wrap {
            margin: 143px auto 0;
        }

        .login_service_wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .service__wrap .title {
            margin: 30px auto
        }

        .toggle__list {
            width: 100%
        }
    }

    @media (min-width: 600px) {
        .login_service_wrap {
            width: 580px;
            margin: 0 auto;
            margin-top: 37px;
        }
    }

    @media (min-width: 1024px) {
        .login_service_wrap {
            grid-column: 1/17;
            width: 710px;
            margin: 0 auto;
        }
    }
</style>
<div class="service__wrap">
    <div class="title">
        <p>공지사항</p>
    </div>
    <div class="login_service_wrap">
        <div class="toggle__list"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        getNotice();
    })
    function getNotice() {
        $.ajax({
            type: "post",
            data: {
                country: getLanguage(),
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/common/notice/get",
            error: function (d) {
                exceptionHandling("공지사항", '공지사항을 불러오지 못했습니다.');
            },
            success: function (d) {
                if (d.code == 200) {
                    if (d.data != null && d.data.length > 0) {
                        $('.toggle__list').html('');
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
                            $('.toggle__list').append(strDiv);
                        })
                    }
                    $('.login_service_wrap .request p').css('text-align', 'left');
                    $('.login_service_wrap .request img').css('width', '670px');
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
                $('.login_service_wrap .question').on('click', function () {
                    $('.login_service_wrap .request').not($(this).next()).hide();
                    $('.login_service_wrap .question').find('img.down__up__icon').attr('src', '/images/mypage/mypage_down_tab_btn.svg');

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
    }
</script>