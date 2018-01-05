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
        <h4>Reviews</h4>
    </div>
</div>
<div class="layout-container pages">
    <div class="layout-content tabpages hc vc" style="background-color:red;">
        <div class="common-title custom-title-wrap clearfix" style="background-color:#F9F9F9;">
                <div class="col-md-3 col-sm-3 col-xs-12 pull-right hc vc">
                    <a href="javascript:void(0);" class="addReviews button bgcolor_focus uc f18 w370"><?php echo __('Add Reviews'); ?></a>
                </div>
        </div>
    </div>
    <div class="layout-content pages hc vc container">
        <?php
            if (!empty($allReviews)) {
                foreach ($allReviews as $review) {
                    $EncryptReviewID = $this->Encryption->encode($review['StoreReview']['id']);
                    ?>
                    <div class="review-sec-1 clearfix">
                        <?php if (!empty($review['StoreReviewImages'][0]['image']) && file_exists(WWW_ROOT . '/storeReviewImage/thumb/' . $review['StoreReviewImages'][0]['image'])) { ?>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 r-img c-cur" data-value="<?php echo $EncryptReviewID; ?>">
                                <?php echo $this->Html->image('/storeReviewImage/thumb/' . $review['StoreReviewImages'][0]['image'], array('alt' => 'Image')); ?>
                                <div class="hover-box">
                                    <div class="table-box"><div class="table-box-cell"><img src="/img/plus-icon.png"></div></div>
                                </div>
                                <?php if (count($review['StoreReviewImages']) > 1) { ?>
                                    <div class="more-pic">
                                    <?php 
                                    for ($x = 0; $x <= count($review['StoreReviewImages']) - 1; $x++) {
                                        echo "<span>&nbsp;</span>";
                                    } 
                                    ?>                       
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="hidden-sm hidden-xs col-lg-3 col-md-3 col-sm-12 col-xs-12 r-img c-cur">
                                <img class="" src="/img/r-img-2.png">
                            </div>
                        <?php } ?>
                        <div class="col-lg-7 col-md-6 col-sm-8 col-xs-12 review-info f16">
                            <span class="f18 color_black">
                                <b><?php
                                $name = ($review['StoreReview']['user_id']) ? ucfirst($review['User']['fname']) . ' ' . ucfirst($review['User']['lname']) : 'Anonymous';
                                echo $name;
                                ?></b>
                            </span>
                            <h4><?php echo @$review['OrderItem']['Item']['name']; ?></h4>
                            <p><?php echo ucfirst($review['StoreReview']['review_comment']); ?></p>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 rating">
                            <span>Date : <?php echo date('m/d/Y', strtotime($this->Common->storeTimeZoneUser('', $review['StoreReview']['created']))); ?></span>
                            <input disabled="disabled" type="number" class="rating" min=0 max=5 data-glyphicon=0 value=<?php echo $review['StoreReview']['review_rating']; ?> >
                        </div>
                    </div>
                    <hr>
                    <?php
                }
                echo $this->element('pagination');
            }
            ?>
        

    </div>
</div>


<div class="modal fade add-info review-modal" id="add-review-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span><img src="/img/4_popup_x.png" alt="#close"></span>
                </button>
                <h4 class="modal-title">Add Review</h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('StoreReview', array('url' => array('controller' => 'orders', 'action' => 'addReviewRating'), 'inputDefaults' => array('label' => false, 'div' => false, 'required' => false, 'error' => false, 'legend' => false, 'autocomplete' => 'off'), 'id' => 'addReviewRating', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group row"><label class="col-sm-3 col-form-label">Rating</label>
                    <div class="col-sm-9">
                    <?php echo $this->Form->input('StoreReview.review_rating', array('data-glyphicon' => 0, 'type' => 'number', 'class' => 'rating user-detail', 'max' => 5, 'min' => 0, 'label' => false, 'div' => false, 'value' => 1)); ?>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Review</label>
                    <div class="col-sm-9">
                    <?php echo $this->Form->input('StoreReview.review_comment', array('type' => 'textarea', 'class' => 'user-detail-large form-control', 'placeholder' => 'Enter Your Review', 'maxlength' => '200', 'label' => false, 'div' => false)); ?>
                    </div>
                </div>


                <div class="form-group row"><label class="col-sm-3 col-form-label">Images</label>
                    <div class="col-sm-9">
                        <i class="fa fa-plus color_focus" id="addMoreImage"></i> <small>(Max Upload size 2MB)</small>
                    </div>
                </div>

                <div class="form-group row" id="appendDiv">
                    <div class="col-sm-12">
                        <div class="preview-image"></div>
                        <span id="StoreReviewImage-error" class="error hidden" for="StoreContentName">Upto 4 images are allowed</span>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="hc vc tc">
                        <?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'uc button f18 bgcolor_focus w180', 'id' => 'saveReservation')); ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
              
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-info review-modal" id="gallery-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;"></div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.r-img', function () {
            var storeReviewId = $(this).attr('data-value');
            if (storeReviewId) {
                $.ajax({
                    type: 'post',
                    url: '/pannels/reviewImageDet',
                    data: {'storeReviewId': storeReviewId},
                    async: false,
                    beforeSend: function () {
                        $.blockUI({css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            }});
                    },
                    complete: function () {
                        $.unblockUI();
                    },
                    success: function (result) {
                        $("#gallery-modal").html(result);
                        $('#gallery-modal a').simpleLightbox({navText:['&lsaquo;','&rsaquo;']}).open();
                    }
                });
            }
        });
        $(document).on('click', '.addReviews', function () {
            $("#add-review-modal").modal('show');
        });
        $('#StoreReviewImage').change(function (e) {
            //get the input and the file list
            var input = document.getElementById('StoreReviewImage');
            if (input.files.length <= 4) {
                $('#StoreReviewImage-error').addClass('hidden');
            } else {
                $('#StoreReviewImage-error').removeClass('hidden');
                e.preventDefault();
            }
        });
        $("#addReviewRating").validate({
            debug: false,
            errorClass: "error",
            errorElement: 'span',
            onkeyup: false,
            rules: {
                'data[StoreReview][review_rating]': {
                    required: true,
                },
                'data[StoreReview][review_comment]': {
                    required: true
                }
            },
            messages: {
            }, highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
    });
    $(document).on('change', '.user-detail1', function () {
        var countFiles = $(this)[0].files.length;
        console.log(countFiles);
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $(this).next();
        image_holder.empty();
        if (extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "class": "thumbimage hidden",
                            "src": e.target.result
                        }).appendTo(image_holder);
                    }
                    image_holder.append('<span>' + $(this)[0].files[i].name + '</span> <span title="Remove" class="removeImage"><b>&times;</b></span>');
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("It doesn't supports");
            }
        } else {
            alert("Select Only images");
        }
    });
    $(document).on('click', '#addMoreImage', function () {
        $('.preview-image').each(function (index, element) {
            if ($(element).children().length == 0) {
                $(element).parents('.col-width').remove();
            }
        });
        var count = $('.removeImage').length;
        if (count >= 4) {
            alert("Can't add more than 4 images.");
            return false;
        } else {
            if ($("#StoreReviewImageImage" + count).length) {
                if (($("#StoreReviewImageImage0").length) == 0) {
                    count = 0;
                }
                if (($("#StoreReviewImageImage1").length) == 0) {
                    count = 1;
                }
                if (($("#StoreReviewImageImage2").length) == 0) {
                    count = 2;
                }
                if (($("#StoreReviewImageImage3").length) == 0) {
                    count = 3;
                }
            }
            $("#StoreReviewImageImage" + count).parents('.col-width').remove();
            var div = '<div class="col-width"><input type="file" id="StoreReviewImageImage' + count + '" accept="image/*" class="user-detail1 hidden" autocomplete="off" name="data[StoreReviewImage][image][' + count + ']"><div class="preview-image"></div></div>';
            $('#appendDiv').append(div);
            $("#StoreReviewImageImage" + count).trigger('click');
        }
    });
    $(document).on('click', '.removeImage', function () {
        $(this).parents('.col-width').remove();
    });
    $(document).on('click', '.editOrderType', function (e) {
        e.stopImmediatePropagation();
        if ($("#addReviewRating").valid()) {
            $.blockUI({css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }});
        }
    });
</script>
