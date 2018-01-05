<?php
echo $this->Html->css('theme_css/aaron/simplelightbox.min');
echo $this->Html->script('aaron/simple-lightbox.min');
?>
<style>
.sl-wrapper .sl-navigation button.sl-next, .sl-wrapper .sl-navigation button.sl-prev{
    color:white;
}
.sl-wrapper .sl-navigation button.sl-next:focus, .sl-wrapper .sl-navigation button.sl-prev:focus{
    outline: none;
}
.sl-wrapper .sl-close
{
    color:white;
}
.sl-overlay
{
    background-color : rgba(0, 0, 0, 1);
    opacity : .9;
}
</style>
<div class="ext-menu">
    <div class="ext-menu-title">
        <h4>Gallery</h4>
    </div>
</div>
<div class="layout-container pages">
    <div class="layout-content pages hc vc">
        <ul class="offer"> 
        <?php
        if (!empty($allReviewImages)) {
            foreach ($allReviewImages as $image) {
                if (!empty($image['StoreReviewImage']['image']) && file_exists(WWW_ROOT . '/storeReviewImage/thumb/' . $image['StoreReviewImage']['image'])) {
                    ?>
                    <li class="col-xs-12 col-sm-6 col-md-4"><div class="hc vc" ><a href="/storeReviewImage/<?php echo $image['StoreReviewImage']['image']; ?>"><img src="/storeReviewImage/<?php echo $image['StoreReviewImage']['image']; ?>"></a><div></li>
                    <?php
                }
            }
        }
        ?>            
        </ul>
    </div>
</div>


<script>
    $(function(){
        $('.offer a').simpleLightbox({navText:['&lsaquo;','&rsaquo;']});
    });
</script>