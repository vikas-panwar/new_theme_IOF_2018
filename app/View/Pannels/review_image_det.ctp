<?php if (DESIGN == 1) {?>
    <?php foreach ($imgArr as $arrImg) { ?>
        <?php if (file_exists(WWW_ROOT . '/storeReviewImage/' . $arrImg)) { ?>
            <a href='<?php echo '/storeReviewImage/' . $arrImg; ?>'></a>
        <?php } ?>
    <?php }?>    
    <?php } else { ?>
    <?php echo $this->Html->script('owl.carousel.min');?>
    <?php echo $this->Html->css('owl.carousel.css');?>
    <div class="modal-dialog modal-sm owl-modal">
        <div class="modal-body" id="slide">
            <div class="modal-close-button"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div id="owl-demo" class="owl-carousel owl-theme review-popup-gallery">
                <?php foreach ($imgArr as $arrImg) { ?>
                    <?php if (file_exists(WWW_ROOT . '/storeReviewImage/' . $arrImg)) {
                        ?>
                        <div class="item"><?php echo $this->Html->image('/storeReviewImage/' . $arrImg, array("class" => "")); ?></div>
                    <?php }
                    ?>
                <?php }
                ?>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function () {
            var owl = $("#owl-demo");
            owl.owlCarousel({
              itemsCustom : [
                [0, 1],
                [450, 1],
                [600, 1],
                [700, 1],
                [1000, 1]
              ],
              navigation : true
            });
        });
    </script>
    <?php } ?>