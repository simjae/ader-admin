const targetDate = new Date(2023, 2, 25, 0, 0, 0);

function updateCountdown() {
    const currentDate = new Date();

    const diff = targetDate - currentDate;
    const days = Math.floor(diff / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
    const seconds = Math.floor((diff % (1000 * 60)) / 1000).toString().padStart(2, '0');

    const countdown = document.getElementById("countdown");
    countdown.innerHTML = `${days}:${hours}:${minutes}:${seconds}`;
}

setInterval(updateCountdown, 1000);

window.addEventListener('resize', function() {
    debounce(resizeProductWrapClone, 1000);
})

function resizeProductWrapClone(){
        let standbyBreakpoint = window.matchMedia('screen and (min-width:1025px)');//미디어 쿼리 
        if (standbyBreakpoint.matches === true) {
            $('#standby_mobile_product').clone().html('#standby_web_product')
        } else if (standbyBreakpoint.matches === false) {
            $('#standby_web_product').clone().html('#standby_mobile_product');
        }
};