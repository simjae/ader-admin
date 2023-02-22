<style>
    .membership__wrap {
        margin-top: 80px;
        width: 100%;
    }

    .member__level__container {
        margin: 0 auto;
        text-align: center;
        margin-bottom: 20px;
        width: 830px;
        display: grid;
        gap: 10px;
        place-items: center;
        grid-template-columns: 110px 110px 110px 110px 110px 110px 110px
    }

    .member__level__container p {
        font-family: var(--ft-no-fu);
        font-size: 11px;
        color: #fff;
        text-align: center;
        margin-top: 0px;
        margin-bottom: 0px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
    }

    .level__info__wrap {
        width: 830px;
        margin: 0 auto;
        color: #343434;
    }

    .level__box {
        height: 108px;
        width: 100%;
    }

    .level__title {
        padding-top: 20px;
    }

    .level__info {
        padding-top: 10px;
    }

    .member__level__item {
        width: 100%
    }

    .level__box.one {
        background-color: #c8c8c8;
    }

    .level__box.two {
        background-color: #a1a1a1;
    }

    .level__box.three {
        background-color: #7a7a7a;
    }

    .level__box.four {
        background-color: #585858;
    }

    .level__box.five {
        background-color: #373737;
    }

    .level__box.six {
        background-color: #000;
    }

    .level__box.seven {
        background-color: #000;
    }

    .level__info__wrap {
        margin-top: 20px;
    }

    .level__info__container {
        width: 100%;
        display: grid;
        grid-template-columns: 23% 77%;
        padding-top: 20px;
        border-bottom: 1px solid #dcdcdc;
    }

    .level__info__item .title {
        font-size: 13px;
        font-family: var(--ft-no-fu);
        margin: 0;
    }

    .level__info__item .contents p {
        font-size: 11px;
        font-family: var(--ft-no-fu);
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.65;
        letter-spacing: normal;
        text-align: left;
        color: #343434;
        text-indent: -6px;
        word-break: break-all;
        margin-bottom: 10px;
    }

    .non__border {
        border: none;
    }

    .underline {
        text-decoration: underline;
    }

    .membership__sub__info {
        margin-bottom: 20px;
    }

    @media (max-width: 1024px) {
        .member__level__item br {
            display: none !important;
        }

        .member__level__container {
            text-align: center;
            width: 100%;
            display: grid;
            place-items: center;
            grid-template-columns: 1fr;
            grid-row-gap: 4px;
            margin-bottom: 0px;
        }

        .member__level__item {
            width: 100%;
            height: 31px
        }

        .level__info__wrap {
            width: 100%;
            margin-top: 0;
        }

        .membership__wrap {
            margin-top: 40px;
        }

        .level__box {
            width: 100%;
            height: 31px;
            display: flex;
        }

        .level__title {
            padding-top: 10px;
            margin-right: auto;
            margin-left: 10px;
        }

        .level__info {
            padding-top: 8px;
            margin-left: auto;
            margin-right: 10px;
        }

        .level__info__container {
            width: 100%;
            display: block;
            padding-top: 0px;
            padding-bottom: 10px;
        }

        .level__info__item {
            margin: 20px 0;
        }

        .level__info__item .title {
            height: 19px;
        }
    }

    @media (min-width: 600px) {
        .membership__wrap {
            width: 580px;
            margin: 0 auto;
            margin-top: 40px;
        }
    }

    @media (min-width: 1024px) {
        .membership__wrap {
            margin-top: 80px;
            width: 100%;
        }

        .level__info__container {
            padding-top: 30px;
            padding-bottom: 10px
        }
    }
</style>
<div class="membership__wrap">
    <div class="member__level__container">
        <div class="member__level__item">
            <div class="level__box one">
                <div class="level__title">
                    <p>
                        ADER<br>
                        WHITE MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        3개월 이내<br>
                        신규 회원
                    </p>
                </div>
            </div>
        </div>
        <div class="member__level__item">
            <div class="level__box two">
                <div class="level__title">
                    <p>
                        ADER<br>
                        BLUE MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        구매금액<br>
                        20만원 이상
                    </p>
                </div>
            </div>
        </div>
        <div class="member__level__item">
            <div class="level__box three">
                <div class="level__title">
                    <p>
                        ADER<br>
                        BLUE MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        구매금액<br>
                        50만원 이상
                    </p>
                </div>
            </div>
        </div>
        <div class="member__level__item">
            <div class="level__box four">
                <div class="level__title">
                    <p>
                        ADER<br>
                        BLUE MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        구매금액<br>
                        100만원 이상
                    </p>
                </div>
            </div>
        </div>
        <div class="member__level__item">
            <div class="level__box five">
                <div class="level__title">
                    <p>
                        ADER<br>
                        BLUE MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        구매금액<br>
                        200만원 이상
                    </p>
                </div>
            </div>
        </div>
        <div class="member__level__item">
            <div class="level__box six">
                <div class="level__title">
                    <p>
                        ADER<br>
                        VIP MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        구매금액<br>
                        800만원 이상
                    </p>
                </div>
            </div>
        </div>
        <div class="member__level__item">
            <div class="level__box seven">
                <div class="level__title">
                    <p>
                        ADER<br>
                        VVIP MEMBER
                    </p>
                </div>
                <div class="level__info">
                    <p>
                        구매금액<br>
                        1,200만원 이상
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="level__info__wrap">
        <div class="level__info__container">
            <div class="level__info__item">
                <div class="title">
                    <p>회원등급 선정 기준</p>
                </div>
            </div>
            <div class="level__info__item">
                <div class="contents">
                    <div class="pc__view">
                        <div class="membership__sub__info">
                            <p style="text-indent:0px;">매월 1일, 직전 12개월간의 실 결제금액 기준으로 변경됩니다.</p>
                            <p style="text-indent:0px;">VIP 와 VVIP는 예외로 1년간 유지됩니다.</p>
                            <p style="text-indent:0px;">기간내 반품, 교환(단순변심) 비율이 25%이상일 경우 등급이 1단계 하향 조정됩니다.</p>
                        </div>
                    </div>
                    <div class="mobile__view">
                        <div class="membership__sub__info">
                            <p style="text-indent:0px;">매월 1일, 직전 12개월간의 실 결제금액 기준으로 변경됩니다.</p>
                            <p style="text-indent:0px;">VIP 와 VVIP는 예외로 1년간 유지됩니다.</p>
                            <p style="text-indent:0px;">기간내 반품, 교환(단순변심) 비율이 25%이상일 경우<br>등급이 1단계 하향 조정됩니다.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="level__info__container">
            <div class="level__info__item">
                <div class="title">
                    <p>적립금 기준</p>
                </div>
            </div>
            <div class="level__info__item" style="padding-left:6px;">
                <div class="contents">
                    <div class="pc__view">
                        <div class="membership__sub__info">
                            <p class="underline">적립금 적립 기준</p>
                            <p>·&nbsp;1,000원 이상 구매 시 적립됩니다.</p>
                            <p>·&nbsp;주문으로 발생한 적립금은 배송완료 후 7일 부터 실제 사용 가능한 적립금으로 전환됩니다.</p>
                            <p>·&nbsp;적립금은 등급별로 차등 적립됩니다.</p>
                            <p>·&nbsp;적립금 사용 구매 시 해당 구매 건에 대한 적립금은 적립 불가합니다.</p>
                            <p>·&nbsp;회원 탈퇴 시 적립금은 자동 소멸됩니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">적립금 사용 기준</p>
                            <p>·&nbsp;적립금 1,000원 이상부터 사용 가능합니다.</p>
                            <p>·&nbsp;적립금, 바우처 그리고 쿠폰은 중복 사용이 불가능합니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">적립금 유효 기간</p>
                            <p>·&nbsp;발행시점으로 부터 1년 유효하며, 이후 자동 소멸됩니다.</p>
                        </div>
                    </div>
                    <div class="mobile__view">
                        <div class="membership__sub__info">
                            <p class="underline">적립금 적립 기준</p>
                            <p>·&nbsp;적립금 적립 기준</p>
                            <p>·&nbsp;주문으로 발생한 적립금은 배송완료 후 7일 부터 실제 사용 가능한<br>적립금으로 전환됩니다.</p>
                            <p>·&nbsp;적립금은 등급별로 차등 적립됩니다.</p>
                            <p>·&nbsp;적립금 사용 구매 시 해당 구매 건에 대한 적립금은 적립 불가합니다.</p>
                            <p>·&nbsp;회원 탈퇴 시 적립금은 자동 소멸됩니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">적립금 사용 기준</p>
                            <p>·&nbsp;적립금 1,000원 이상부터 사용 가능합니다.</p>
                            <p>·&nbsp;적립금, 바우처 그리고 쿠폰은 중복 사용이 불가능합니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">적립금 유효 기간</p>
                            <p>·&nbsp;발행시점으로 부터 1년 유효하며, 이후 자동 소멸됩니다.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="level__info__container">
            <div class="level__info__item">
                <div class="title">
                    <p>쿠폰 기준</p>
                </div>
            </div>
            <div class="level__info__item" style="padding-left:6px;">
                <div class="contents">
                    <div class="pc__view">
                        <div class="membership__sub__info">
                            <p class="underline">쿠폰 사용 기준</p>
                            <p>·&nbsp;적립금과 쿠폰은 중복 사용이 불가능합니다.</p>
                            <p>·&nbsp;쿠폰간 중복 사용이 불가하며, 쿠폰 사용 금액 기준은 쿠폰별로 상이합니다.</p>
                            <p>·&nbsp;쿠폰은 기간내 미사용 시 자동 소멸됩니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">생일 쿠폰 사용 기준</p>
                            <p>·&nbsp;생일 쿠폰은 회원 가입 시 등록한 생일 15일전에 발급되며, 생일 이후 15일까지 사용 가능합니다.</p>
                        </div>
                    </div>
                    <div class="mobile__view">
                        <div class="membership__sub__info">
                            <p class="underline">쿠폰 사용 기준</p>
                            <p>·&nbsp;적립금과 쿠폰은 중복 사용이 불가능합니다.</p>
                            <p>·&nbsp;쿠폰간 중복 사용이 불가하며, 쿠폰 사용 금액 기준은 쿠폰별로 상이합니다.</p>
                            <p>·&nbsp;쿠폰은 기간내 미사용 시 자동 소멸됩니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">생일 쿠폰 사용 기준</p>
                            <p>·&nbsp;생일 쿠폰은 회원 가입 시 등록한 생일 15일전에 발급되며, 생일 이후 15일까지 사용 가능합니다.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="level__info__container non__border">
            <div class="level__info__item">
                <div class="title">
                    <p>사은품 기준</p>
                </div>
            </div>
            <div class="level__info__item" style="padding-left:6px;">
                <div class="contents">
                    <div class="pc__view">
                        <div class="membership__sub__info">
                            <p class="underline">ADER 코인</p>
                            <p>·&nbsp;코인지급은 등급 후 구매 시 구매상품과 지급됩니다.</p>
                            <p>·&nbsp;적립금, 쿠폰 사용과 무관합니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">생일 기프트 박스 (바우처)</p>
                            <p>·&nbsp;구매 시 바우처 사용 가능합니다.</p>
                            <p>·&nbsp;생일쿠폰과 동시에 사용 가능합니다.</p>
                            <p>·&nbsp;사용기한은 바우처 지급일로 확인 가능합니다.</p>
                        </div>
                    </div>
                    <div class="mobile__view">
                        <div class="membership__sub__info">
                            <p class="underline">ADER 코인</p>
                            <p>·&nbsp;코인지급은 등급 후 구매 시 구매상품과 지급됩니다.</p>
                            <p>·&nbsp;적립금, 쿠폰 사용과 무관합니다.</p>
                        </div>
                        <div class="membership__sub__info">
                            <p class="underline">생일 기프트 박스 (바우처)</p>
                            <p>·&nbsp;구매 시 바우처 사용 가능합니다.</p>
                            <p>·&nbsp;생일쿠폰과 동시에 사용 가능합니다.</p>
                            <p>·&nbsp;사용기한은 바우처 지급일로 확인 가능합니다.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>