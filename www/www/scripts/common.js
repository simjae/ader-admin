function layoutOutSideClick(elem) {
    elem.addEventListener("click" ,(e) =>{
        console.log(e.target)
        console.log(e.currentTarget)
        if(e.target !== elem){
            elem.classList.remove("open")
        }
    } )
}

//basket add 


function addBasketApi(productIdx, optionIdx) {
    const main = document.querySelector("main");
    let country = main.dataset.country;
    let product_idx = productIdx;
    let option_idx = optionIdx;

    $.ajax({
        type: "post",
        data: {
            "add_type":'product',
            "product_idx": product_idx,
            "option_idx": option_idx,
            "country": country,
        },
        dataType: "json",
        url: "http://116.124.128.246:80/_api/order/basket/add",
        error: function () {
            alert("쇼핑백 담기에 실패하였습니다.");
        },
        success: function (d) {
            if(d.code == 200){
                location.href='http://116.124.128.246/order/basket/list';
            }
        }
    });
}