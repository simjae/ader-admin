function layoutOutSideClick(elem) {
    elem.addEventListener("click" ,(e) =>{
        console.log(e.target)
        console.log(e.currentTarget)
        if(e.target !== elem){
            elem.classList.remove("open")
        }
    } )
}