import {Basket} from '/scripts/module/basket.js';


const randomNum = Math.floor(Math.random() * 100000000);
const sideId = `side-${randomNum}`;
export function Sidebar() {
    this.appendSidebar = (() => {
        const sidebar = document.createElement("div");
        sidebar.id = "sidebar";
        document.body.appendChild(sidebar);
    })();

    this.makeSidebar = (() => {
        const docflag = document.createDocumentFragment();
        const $sidebar = document.getElementById("sidebar");
        const sideWrap = document.createElement('div');
        let sideContent = "";
        sideWrap.className = "side__background";
        sideContent =`<div class="side__wrap"><div class="side__box"></div></div>`;
        sideWrap.innerHTML = sideContent;
        docflag.appendChild(sideWrap);
        $sidebar.appendChild(docflag);
    })();
    this.openSidebar =()=>{
        let basketBtn = document.querySelector(".basket__btn");
        let sideContainner = document.querySelector(`#sidebar`);
        let sideBg = document.querySelector(`.side__background`);
        let sideWrap = document.querySelector(`#sidebar`);
        if(basketBtn.classList.contains("open")){
            document.body.style["overflow"] ="hidden"
            document.querySelector("header").classList.add("hover")
            sideContainner.classList.add("open");
            sideBg.classList.add("open");
            sideWrap.classList.add("open");
        }else {
            document.body.style["overflow"] ="inherit"
            document.querySelector("header").classList.remove("hover")
            sideContainner.classList.remove("open");
            sideBg.classList.remove("open");
            sideWrap.classList.remove("open");
        }
    };
    return randomNum;
}
// export function 
// const sidebar = new Sidebar(); 사이드메뉴 생성
