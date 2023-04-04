/**
 * @author SIMJAE
 * @description 로그인 , 유저 생성자 함수 
 * 
 */
function User() {
    this.userLoad = () => {
        $.ajax({
            type: "post",
            data: {
                "country": getLanguage()
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/menu/get ",
            error: function () {
            },
            success: function (d) {
                let code = d.code;
                let memberInfo = d.member_info;
                if (code == "200") {
                    if (memberInfo === undefined) {
                        writeLoginHtml();
                    } else {
                        writeUserHtml(memberInfo);
                    }
                }
            }
        });
    }
    let writeUserHtml = (data) => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "user";
        const userContent = document.createElement("section");
        let { member_id, member_mileage, member_name, member_voucher, whish_cnt, basket_cnt } = data
        userContent.className = "user-wrap";
        userContent.innerHTML =
            `
        <div class="user-body">
            <div class="user-logo">
                <img src="/images/mypage/mypage_member_icon.svg">
            </div>
            <div class="content-row">
                <div>
                    <p>${member_name}</p>
                </div>
                <div>
                    <p>${member_id}</p>
                </div>
            </div>
            <div class="user-content">
                <div class="content-point left">
                    <div>진행중 주문</div>
                    <a class="content-link" href="http://116.124.128.246/mypage?mypage_type=mileage_first">
                        <div class="user-orderlist-cnt">0</div>
                    </a>
                </div>
                <div class="content-point center">
                    <div data-i18n="m_mileage">적립금</div>
                    <a class="content-link" href="http://116.124.128.246/mypage?mypage_type=mileage_first">
                        <div class="user-mileage">${member_mileage}</div>
                    </a>
                </div>
                <div class="content-point right">
                    <div data-i18n="m_voucher">바우처</div>
                    <a class="content-link" href="http://116.124.128.246/mypage?mypage_type=voucher_first">
                        <div class="user-voucher">${member_voucher}</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="user-mypage-area">
            <div class="icon__item" btn-type="orderlist">
                <a href="http://116.124.128.246/mypage?mypage_type=orderlist">
                    <div class="icon">
                        <img src="/images/mypage/mypage_orderlist_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_order_history">주문내역</p>
                </div>
            </div>
            <div id="mileage_icon" class="icon__item" btn-type="mileage">
                <a href="http://116.124.128.246/mypage?mypage_type=mileage_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_point_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_mileage_charging">적립/예치금</p>
                </div>
            </div>
            <div id="voucher_icon" class="icon__item" btn-type="voucher">
                <a href="http://116.124.128.246/mypage?mypage_type=voucher_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_voucher_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_voucher">바우처</p>
                </div>
            </div>
            <div class="icon__item" btn-type="bluemark">
                <a href="http://116.124.128.246/mypage?mypage_type=bluemark_verify">
                    <div class="icon">
                        <img src="/images/mypage/mypage_bluemark_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_blue_mark">블루마크</p>
                </div>
            </div>
            <div class="icon__item" btn-type="stanby">
                <a href="http://116.124.128.246/mypage?mypage_type=stanby_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_stanby_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_standby">스탠바이</p>
                </div>
            </div>
            <div class="icon__item" btn-type="preorder">
                <a href="http://116.124.128.246/mypage?mypage_type=preorder_first">
                    <div id="preorder_icon" class="icon">
                        <img src="/images/mypage/mypage_preorder_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_preorder">프리오더</p>
                </div>
            </div>
            <div class="icon__item" btn-type="reorder">
                <a href="http://116.124.128.246/mypage?mypage_type=reorder_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_reorder_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_notify_me">재입고알림</p>
                </div>
            </div>
            <div class="icon__item" btn-type="membership">
                <a href="http://116.124.128.246/mypage?mypage_type=membership_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_membership_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_membership">멤버십</p>
                </div>
            </div>
            <div class="icon__item" btn-type="inquiry">
                <a href="http://116.124.128.246/mypage?mypage_type=inquiry_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_inquiry_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_inquiry">문의</p>
                </div>
            </div>
            <div class="icon__item" btn-type="as">
                <a href="http://116.124.128.246/mypage?mypage_type=as_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_as_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p>A/S</p>
                </div>
            </div>
            <div class="icon__item" btn-type="service">
                <a href="http://116.124.128.246/mypage?mypage_type=service_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_service_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_customer_care">고객서비스</p>
                </div>
            </div>
            <div class="icon__item" btn-type="profile">
                <a href="http://116.124.128.246/mypage?mypage_type=profile_first">
                    <div class="icon">
                        <img src="/images/mypage/mypage_profile_icon.svg">
                    </div>
                </a>
                <div class="icon__title">
                    <p data-i18n="m_account">회원정보</p>
                </div>
            </div>
        </div>
        <div class="user-button-area">
            <a href="http://116.124.128.246/mypage">
                <div class="user-button mypageBtn" data-i18n="m_my-page">마이페이지 홈 가기</div>
            </a>
            <div class="user-button logoutBtn" data-i18n="m_logout" onclick="logout()">로그아웃</div>
        </div>
        `
        // <div class="icon__item" btn-type="draw">
        //     <a href="http://116.124.128.246/mypage?mypage_type=draw_first">
        //         <div id="draw_icon" class="icon">
        //             <img src="/images/mypage/mypage_draw_icon.svg">
        //         </div>
        //     </a>
        //     <div class="icon__title">
        //         <p data-i18n="m_draw">드로우</p>
        //     </div>
        // </div>
        sideBox.appendChild(userContent);
        changeLanguageR();
    };
    let writeLoginHtml = () => {
        let login = new Login();
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "login";
        const loginContent = document.createElement("section");
        loginContent.className = "user-wrap";
        loginContent.innerHTML = `
        <div class="login__card">
            <div class="card__header">
                <p class="font__large" data-i18n="m_login">로그인</p>
                <span class="font__underline font__red result_msg"></span>
            </div>
            <div class="card__body">
                <form id="frm-login" method="post" onSubmit="login();return false;">
                    <input type="hidden" name="country" value="">
                    <input type="hidden" name="member_ip" value="0.0.0.0">
                    <div class="content__wrap">
                        <div class="content__wrap__msg">
                            <div class="content__title" data-i18n="p_email">
                                이메일
                            </div>
                            <div class="font__underline font__red member_id_msg"></div>
                        </div>
                        <div class="content__row">
                            <input type="text" id="member_id" name="member_id" value="">
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__wrap__msg">
                            <div class="content__title" data-i18n="p_password">
                                비밀번호
                            </div>
                            <div class="font__underline font__red member_pw_msg"></div>
                        </div>
                        <div class="content__row">
                            <input type="password" id="member_pw" name="member_pw" value="">
                        </div>
                    </div>
                    <div class="content__wrap login_btn">
                        <input type="button" class="black_btn" id="login_btn" onclick="login()" data-i18n="m_login" value="로그인">
                    </div>
                </form>
                <div class="content__wrap">
                    <div class="content__row">
                        <div class="checkbox__label">
                            <input type="checkbox" id="member_id_flg">
                            <label for="member_id_flg"></label>
                            </div>
                        <span class="font__small">이메일 저장</span>
                        <span class="font__underline" style="cursor:pointer;" onclick="location.href='/login/check'">비밀번호 찾기</span>
                    </div>
                </div>
                <div class="content__wrap">
                    <div class="content__title sns__account__login">
                        <div class="font__large text__align__center">SNS 계정으로 로그인하기</div>
                    </div>
                    <div class="content__row sns__account__login">
                        <img class="kakao__btn" src="/images/login/kakao.jpg">
                        <img class="naver__btn" src="/images/login/btnG_icon_square.jpg">
                    </div>
                </div>
                <div class="contour__line"></div>
                <div class="content__wrap">
                    <p class="font__large text__align__center" data-i18n="lm_menu_msg_02">회원가입을 하시면 다양한 혜택을 경험하실 수 있습니다.</p>
                </div>
            </div>
            <div class="card__footer">
                <input type="button" class="black_btn" onclick="location.href='/login/join'" value="회원가입">
            </div>
            <div class="customer-title" data-i18n="lm_customer_care_service">고객서비스</div>
            <div class="customer-btn-box">
                <div class="customer-btn" onclick="location.href='/login/service'"><span data-i18n="lm_notice">공지사항</span></div>
                <div class="customer-btn" onclick="location.href='/login/faq'"><span data-i18n="lm_faq">자주 묻는 질문</span></div>
                <div class="customer-btn" onclick="location.href='http://116.124.128.246/login?r_url=/mypage?mypage_type=inquiry'"><span data-i18n="lm_inquiry">문의하기</span></div>
            </div>
        </div>
        
        
        `
        sideBox.appendChild(loginContent);
        changeLanguageR();

        $(document).ready(function () {

            $('#member_id').val('');
            var usermember_id = getCookie("usermember_id");
            if (usermember_id) {
                $('#member_id').val(usermember_id);
            } else {
                $('#member_id').val('');
            }

            if ($('#member_id').val() != "") {
                $("input:checkbox[id='member_id_flg']").prop("checked", true);
            }

            $("input:checkbox[id='member_id_flg']").change(function () {
                if ($("input:checkbox[id='member_id_flg']").is(":checked")) {
                    setCookie("usermember_id", $('#member_id').val(), 7);
                }
                else {
                    deleteCookie("usermember_id");
                }
            })

            $('#member_id').keyup(function () {
                if ($('input:checked[id="member_id_flg"]').is(":checked")) {
                    setCookie("usermember_id", $('#member_id').val(), 7);
                }
            })
        });
        $('#member_pw, #member_id').on('keypress', function (e) {
            if (e.keyCode == '13') {
                var country = getLanguage();
                $("#frm-login").find('input[name=country]').val(country);

                var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
                var member_id = $('#member_id').val();
                var member_pw = $('#member_pw').val();
                mail_regex.test(member_id);

                $('.font__underline.font__red').text('');
                if (member_id == '') {
                    $('.member_id_msg').text('이메일을 입력해주세요');

                    return false;
                }

                if (!mail_regex.test(member_id)) {
                    $('.member_id_msg').text('이메일을 올바르게 입력해주세요');

                    return false;
                }

                if (member_pw == '') {
                    $('.member_pw_msg').text('비밀번호를 입력해주세요');

                    return false;
                }


                $.ajax({
                    type: 'POST',
                    url: "http://116.124.128.246:80/_api/account/login",
                    data: $("#frm-login").serialize(),
                    dataType: "json",
                    error: function () {
                        alert("로그인 처리중 오류가 발생했습니다.");
                    },
                    success: function (d) {
                        if (d.code == "200") {
                            sessionStorage.login_session = "true";
                            location.href = '/main';
                        } else {
                            $('.result_msg').text("로그인정보 재확인 후 다시 시도해주세요.");
                        }
                    }
                });
            }
        })
    }
}