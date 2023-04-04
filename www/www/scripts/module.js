
/**
 * @author SIMJAE
 * @param {String} el 필수값(.vplayer) 비디오태그를 감싸고 있는 부모 wrapper
 * @description 비디오 커스텀 컨트롤러
 */
function Vctrbox(el) {
    let videoArr = new Array();
    let elem = document.querySelectorAll(el);
    if (elem === 1) {
        elem = document.querySelector(el);
    } else {
        elem = document.querySelectorAll(el);
    }
    console.log(elem)
    this.el = el;
    this.makeController = (function () {
        elem.forEach((video, idx) => {
            let controllbox = document.createElement("div");
            controllbox.dataset.index = idx;
            controllbox.classList = `vcontroll`;
            controllbox.innerHTML =
                `   
                <ul>
                    <li class="play">Play  ></li>
                    <li class="pause">Pause ||</li>
                </ul>
                <ul>
                    <li class="mute">Mute</li>
                    <li class="full">Full screen</li>
                </ul>
            `
            video.appendChild(controllbox);
            console.log("커스텀 비디오박스 append")
            video.addEventListener("click", function (e) {
                let clickTarget = e.target.classList.value;
                let videoTarget = e.currentTarget.querySelector("video")
                if (clickTarget === "play") {
                    videoTarget.currentTime = 0;
                    videoTarget.play();
                } else if (clickTarget === "pause") {
                    togglePlay(videoTarget);
                } else if (clickTarget === "mute") {
                    updateVolume(videoTarget);
                } else if (clickTarget === "full") {
                    toggleFullScreen(videoTarget)
                }
            });
            function togglePlay(target) {
                if (target.paused || target.ended) {
                    target.play();
                } else {
                    target.pause();
                }
            }

            function updateVolume(target) {
                if (target.muted) {
                    target.muted = false;
                } else {
                    target.muted = true;
                }
            }

            function toggleFullScreen(target) {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                } else if (document.webkitFullscreenElement) {
                    // Need this to support Safari
                    document.webkitExitFullscreen();
                } else if (target.webkitRequestFullscreen) {
                    // Need this to support Safari
                    target.webkitRequestFullscreen();
                } else {
                    target.requestFullscreen();
                }

            }
            videoArr.push(video);
            return videoArr;
        });
    })();
}

function getLanguage() {
    let local_lng = localStorage.getItem('lang');
    if (!local_lng) {
        let country = navigator.language || navigator.userLanguage;
        switch (country) {
            case "ko-KR":
                local_lng = "KR";
                break;

            case "zh-CN":
                local_lng = "CN";
                break;

            default:
                local_lng = "EU";
                break
        }
    }

    return local_lng;
}