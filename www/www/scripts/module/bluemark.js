
export function Bluemark() {
    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "bluemark";
        const bluemarkContent = document.createElement("section");
        bluemarkContent.className = "bluemark-wrap";
        bluemarkContent.innerHTML = 
            `<div class="bluemark-logo"><img class="bluemark-svg" src="/images/svg/bluemark-bk.svg" alt=""></div>
            <p class="bluemark-content">BLUE MARK는 본 브랜드의 모조품으로부터 소비자의 혼란을 최소화하기 위해<br> 제공되는 정품 인증 서비스입니다.<br>
                ADER는 모조품 판매를 인지하고 소비자와 브랜드의 이미지를 보호하기<br> 위하여 적극적으로 대응중입니다.</p>
            <div class="bluemark-btn-box">
                <div class="certification-btn"><span>블루마크 인증</span></div>
                <div class="certification-detail-btn"><span>블루마크 인증 내역</span></div>
            </div>`
        sideBox.appendChild(bluemarkContent)
    };
}
