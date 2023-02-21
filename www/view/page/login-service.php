<style>
    .common__service__wrap {
        display: grid;
        grid-template-columns: repeat(16, 1fr);
        margin-top: 40px;
        width: 100%;
    }

    .common__service__tab__wrap {
        grid-column: 1/17;
        width: 470px;
        margin: 0 auto;
    }

    .common__service__tab__wrap .request {
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

    .common__service__tab__wrap .request p {
        margin-bottom: 10px;
    }

    .common__service__tab__wrap .toggle__item {
        margin-bottom: 10px !important;
    }


    @media (max-width: 1024px) {
        .common__service__tab__wrap {
            grid-column: 1/17;
            width: 100%;
            margin-top: 40px;
        }

        .common__service__wrap {
            margin-top: 20px;
        }

        .toggle__list {
            width: 100%
        }
    }

    @media (min-width: 600px) {
        .common__service__tab__wrap {
            width: 580px;
            margin: 0 auto;
            margin-top: 37px;
        }
    }

    @media (min-width: 1024px) {
        .common__service__tab__wrap {
            grid-column: 1/17;
            width: 710px;
            margin: 0 auto;
            margin-top: 50px;
        }
    }
</style>
<main>
<div class="common__service__wrap" style="margin-top: 200px;">
    <div class="common__service__tab__wrap">
        <div class="toggle__list">
        </div>
    </div>
</div>

</main>


<script>
    $(document).ready(function () {
        getNotice('KR');
    })
function getNotice(country){
    $.ajax({
        type: "post",
        data: {
            "COUNTRY": country
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
                $('.common__service__tab__wrap .request p').css('text-align', 'left');
                $('.common__service__tab__wrap .request img').css('width', '670px');
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
            $('.common__service__tab__wrap .question').on('click', function () {
                $('.common__service__tab__wrap .request').not($(this).next()).hide();
                $('.common__service__tab__wrap .question').find('img.down__up__icon').attr('src', '/images/mypage/mypage_down_tab_btn.svg');

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