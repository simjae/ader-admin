import {Login} from '/scripts/module/login-module.js';
export function User() {
    this.userLoad = () => {
        $.ajax({
            type: "post",
            data: {
                "country": "KR"
            },
            dataType: "json",
            url: "http://116.124.128.246:80/_api/menu/get ",
            error: function() {
            },
            success: function(d) {
                let code = d.code;
                let memberInfo = d.member_info;
                if (code == "200") {
                    if(memberInfo === undefined ){
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
        let {member_id,member_mileage,member_name,member_voucher,whish_cnt,basket_cnt} = data
        userContent.className = "user-wrap";
        userContent.innerHTML = 
        `<div class="user-header"></div>
        <a href="http://116.124.128.246/mypage">
            <div class="user-body">
                <div class="user-logo">
                    <img src="/images/mypage/mypage_member_icon.svg" style="padding-top:8px;padding-left:6px;">
                </div>
                <div class="user-content">
                    <ul>
                        <li>${member_id}</li>
                        <li>${member_name}</li>
                        <div class="content-row">
                            <div class="content-row-title">
                                <li>적립포인트</li>
                                <li>바우처</li>
                                <li>충전포인트</li>
                            </div>
                            <div class="content-row-value">
                                <li  class="user-mileage">${member_mileage}</li>
                                <li  class="user-voucher">${member_voucher}</li>
                                <li  class="user-point">600,000</li>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </a>`
        sideBox.appendChild(userContent);
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
                <p class="font__large">로그인</p>
                <span class="font__underline font__red result_msg"></span>
            </div>
            <div class="card__body">
                <form id="frm-login" method="post" onSubmit="login();return false;">
                    <input type="hidden" name="country" value="KR">
                    <div class="content__wrap">
                        <div class="content__title">이메일
                        <p class="font__underline font__red member_id_msg"></p>
                        </div>
                        <div class="content__row">
                            <input type="text" id="member_id" name="member_id" value="">
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">비밀번호
                        <p class="font__underline font__red member_pw_msg"></p>
                        </div>
                        <div class="content__row">
                            <input type="password" id="member_pw" name="member_pw" value="">
                        </div>
                    </div>
                    <div class="content__wrap login_btn">
                        <input type="button" class="black_btn" id="login_btn" onclick="login()" value="로그인">
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
                    <p class="font__large text__align__center">회원가입을 하시면 다양한 혜택을 경험하실 수 있습니다.</p>
                </div>
            </div>
            <div class="card__footer">
                <input type="button" class="black_btn" onclick="location.href='/login/join'" value="회원가입">
            </div>
            <div class="customer-title">고객서비스</div>
            <div class="customer-btn-box">
                <div class="customer-btn"><span>공지사항</span></div>
                <div class="customer-btn"><span>자주 묻는 질문</span></div>
                <div class="customer-btn"><span>문의하기</span></div>
            </div>
        </div>
        
        
        `
        sideBox.appendChild(loginContent);
    }
}
