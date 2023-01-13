<style>
.mypage__home__wrap .foryou-wrap .swiper-grid {
    grid-column: 1/17;
}    
.foryou__wrapper .title{
    margin-bottom:20px;
}
</style>
<div style="margin-bottom:50px;"></div>
<div class="mypage__home__wrap">
    <aside class="foryou__wrapper">
        <div class="title"><p>For you   ></p></div>
        <div class="recommend-wrap"></div>
    </aside>
</div>

<script type="module">
    import ForyouRender  from '/scripts/module/foryou.js';
    const foryou = new ForyouRender();

    $('.left__title').hide();
</script>