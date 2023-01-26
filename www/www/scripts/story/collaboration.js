document.addEventListener("DOMContentLoaded", function() {
    fetch("http://116.124.128.246:80/_api/common/recommend/get", {
			method: "POST",
			headers: {
			"Content-Type": "application/json",
			}
		})
		.then(function(response) {
			return response.json();
		})
		.then(function(myJson) {
		});
    loadCollaborationData();
});


function getApiCollaboration() {
    
    const url = "/scripts/story/json/collaboration.json";
    console.log("🏂 ~ file: collaboration.js:8 ~ getApiCollaboration ~ url", url)
    return fetch(url)
        .then((response) => response.json())
        .then((json) => json.collaboration);
}


function loadCollaborationData() {
    getApiCollaboration()
    .then((collaboration) => {
        collaboration.forEach((el, idx) => {
            let { background_img,logo } = el;
            console.log(background_img)
            console.log(logo)
            appendArticle(background_img,logo)
        });
    })
}

function appendArticle(background_img, logo, idx) {
    let wrap = document.querySelector(".collaboration-wrap");
    let article = document.createElement("article");
    article.className = "banner";
    let bgImgUrl = "http://116.124.128.246/images/story/collaboration/thumnail/"
    let logoImgUrl = "http://116.124.128.246/images/story/collaboration/logo/"
    article.innerHTML = `
        <div class="banner-box">
                <img src="${bgImgUrl}${background_img}" alt="">
        </div>
        <div class="banner-logo">
            <img src="${logoImgUrl}${logo}" alt="">
        </div>  
    `;
    wrap.appendChild(article);
}
