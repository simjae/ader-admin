export function Language() {
    this.writeHtml = () => {
        let sideBox = document.querySelector(`.side__box`);
        let sideWrap = document.querySelector(`#sidebar .side__wrap`);
        sideWrap.dataset.module = "language";
        const languageContent = document.createElement("section");
        languageContent.className = "language-wrap";
        languageContent.innerHTML = 
            `
            <div class="language-title">언어선택</div>
            <p class="language-content">아래 옵션에서 선택해 주세요.<br>
                선택한 언어에 해당되는 홈페이지로 리디렉션됩니다.</p>
            <div class="language-btn-box">
                <div class="language-btn korea"><span>한국어</span></div>
                <div class="language-btn english"><span>English</span></div>
                <div class="language-btn china"><span>中文</span></div>
            </div>
        `
        sideBox.appendChild(languageContent);
    };
    this.addSelectEvent = () => {
        let $$languageBtn = document.querySelectorAll(".language-btn");
        $$languageBtn.forEach(el => {
            el.addEventListener("click", function(){
                $$languageBtn.forEach(el => el.classList.remove("select"));
                this.classList.add("select");
            })
        })
    }
}
