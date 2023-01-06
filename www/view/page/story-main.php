<style>
:root{

}
.story__container{
    display:grid;
    grid-template-columns: 50% 50%;
    grid-template-rows: 50% 50%;
    height: calc(100vh - 50px);
}
.story__item{
    position:relative;
}
.story__item img{
    object-fit:cover;
    height:100%;
    width:100%;
}
.story__item p{
    font-size: 12px;
    font-family:var(--ft-no-fu);
    position:absolute;
    bottom:20px;
    left:20px;
}
.story__moblie__container{
    display:grid;
    grid-template-columns: 51.39% 48.61%;
    grid-template-rows: auto 54.5px auto 54.5px;
}
.story__moblie__item{ 
    border-right: 1px solid #dcdcdc;
    border-bottom: 1px solid #dcdcdc;
}
.story__moblie__item img{ width:100%; }
.story__moblie__item.left_area{
    padding-top:10px;
    padding-left:10px;
    font-family: var(--ft-fu)!important;
    font-size: 1.2rem;
}
.story__moblie__item.right_area{
    padding-top:10px;
    padding-left:5px;
    font-family: var(--ft-fu)!important;
    font-size: 1.2rem;
}
.blur {
    filter:opacity(0.5);-webkit-filter:opacity(0.5);
}
@media (min-width: 1024px){
    .story__container{display:grid;}
    .story__moblie__container{display:none;}
}
@media (max-width: 1024px){
    .story__container{display:none;}
    .story__moblie__container{display:grid;}
}
</style>
<main>
    <div class="story__container">
        <div class="story__item" seq="1">
            <img src="/images/story/Editorial.jpg" alt="editorial" class="blur">
            <p>Editorial</p>
        </div>
        <div class="story__item" seq="2">
            <img src="/images/story/Runway.jpg" alt="runway" class="blur">
            <p>Runway</p>
        </div>
        <div class="story__item" seq="3">
            <img src="/images/story/Collection.jpg" alt="collection" class="blur">
            <p>Collection</p>
        </div>
        <div class="story__item" seq="4">
            <img src="/images/story/Collaboration.jpg" alt="collaboration" class="blur">
            <p>Collaboration</p>
        </div>
    </div>

    <div class="story__moblie__container">
        <div class="story__moblie__item">
            <img src="/images/story/moblie_editorial_story.png" alt="editorial">
            
        </div>
        <div class="story__moblie__item">
            <img src="/images/story/moblie_runway_story.png" alt="runway">
        </div>
        <div class="story__moblie__item left_area">
            <div>Editorial</div>
        </div>
        <div class="story__moblie__item right_area">
            <div>Runway</div>
        </div>
        <div class="story__moblie__item">
            <img src="/images/story/moblie_collection_story.png" alt="collection">
        </div>
        <div class="story__moblie__item">
            <img src="/images/story/moblie_collaboration_story.png" alt="collaboration">
        </div>
        <div class="story__moblie__item left_area">
            <div>Collection</div>
        </div>
        <div class="story__moblie__item right_area">
            <div>Collaboration</div>
        </div>
    </div>
</main>
<script>
$(document).ready(function() {
    $(".story__item").mouseover(function(){
        $(this).children().eq(0).removeClass('blur');
    })
    $(".story__item").mouseout(function(){
        $(this).children().eq(0).addClass('blur');
    })
});
</script>