<?php $storeId = $this->Session->read('store_id'); ?>

<div class="main-container">
<div class="title-bar">My Reviews</div>

<div class="layout-container pages">
    <div class="ext-menu-title">
        <h4><?php echo __('My Reviews'); ?></h4>
    </div>



    
        <?php //echo $this->Session->flash(); ?>  
        
        <div class="form-section form-padding">

            <div class="p10 pull-right">
                <a href="javascript:void(0);" class="addReviews hc uc button f18 bgcolor_focus w260"><?php echo __('Add Reviews'); ?></a>
            </div>
              
            <div class=" table hc vc bgcolor_white">
                <div class="form-group row">
                    <?php echo $this->Form->create('Pannel', array('url' => array('controller' => 'pannels', 'action' => 'myReviews'), 'id' => 'AdminId', 'type' => 'post', 'class' => 'p10 clearfix')); ?>
                    <?php echo $this->element('userprofile/filter_store'); ?>
                    <div class="col-sm-2 col-xs-6 hc vc"><?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'uc f16 button bgcolor_theme1 w100p')); ?></div>
                    <div class="col-sm-2 col-xs-6 hc vc"><?php echo $this->Html->link('Clear', array('controller' => 'pannels', 'action' => 'myReviews', 'clear'), array('class' => 'uc f16 button bgcolor_theme1 w100p')); ?></div>
                </div>
            </div>
                    
                <?php echo $this->Form->end(); ?>
                <div class="inner-div clearfix">
                    <?php echo $this->element('pagination'); ?>
                    <div class="table-class responsive-table">
                        <table id="table" class="table ">
                            <thead>   
                                <tr>
                                    <th><?php echo __('Review on Item'); ?></th>
                                    <th class=""><?php echo __('Review Date'); ?></th>
                                    <th class=""><?php echo __('Status'); ?></th>
                                    <th><?php echo __('Review'); ?></th>
                                    <th class=""><?php echo __('Rating'); ?></th>
                                    <th class=""><?php echo __('Store'); ?></th>
                                    <th class=""><?php echo __('Action'); ?></th>
                                </tr>
                            </thead>
                                <?php
                                if (!empty($myReviews)) {
                                    foreach ($myReviews as $review) {
                                        ?>
                                        <tr>
                                            <td><?php
                                                if (!empty($review['OrderItem']['item_id'])) {
                                                    echo $review['OrderItem']['Item']['name'];
                                                } else {
                                                    echo $review['OrderItem']['Item']['name'] = "";
                                                }
                                                ?></td>
                                            <td><?php echo ucfirst($review['StoreReview']['review_comment']); ?></td>
                                            <td class=""><input disabled="disabled" type="number" class="rating" min=0 max=5 data-glyphicon=0 value=<?php echo $review['StoreReview']['review_rating']; ?> ></td>
                                            <td class=""><?php echo $this->Common->storeTimeFormateUser($this->Common->storeTimeZoneUser('', $review['StoreReview']['created']), true); ?></td>
                                            <td class=""><?php
                                        if ($review['StoreReview']['is_approved'] == 0) {
                                            echo "Pending";
                                        } else if ($review['StoreReview']['is_approved'] == 1) {
                                            echo "Approved";
                                        } else if ($review['StoreReview']['is_approved'] == 2) {
                                            echo "Dis-Approved";
                                        }
                                                ?> </td>
                                            <td>
                                                <?php
                                                if (!empty($review['Store'])) {
                                                    echo $review['Store']['store_name'];
                                                }
                                                ?> </td>
                                            <td class=""> <?php
                                        if (!empty($storeId)) {
                                            if ($review['StoreReview']['store_id'] == $storeId) {
                                                echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')) . 'Delete', array('controller' => 'pannels', 'action' => 'deleteReview', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($review['StoreReview']['id'])), array('confirm' => __('Are you sure you want to delete this review?'), 'class' => '', 'escape' => false));
                                            } else {
                                                echo "-";
                                            }
                                        }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td class="" colspan="6">' . __('No review found') . '</td></tr>';
                                }
                            ?>
                        </table>
                    </div>
                    <?php echo $this->element('pagination'); ?>
            
                </div>
        </div>
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
                <?php echo $this->Form->create('StoreReview', array('url' => array('controller' => 'orders', 'action' => 'addReviewRating'), 'inputDefaults' => array('label' => false, 'div' => false, 'required' => false, 'error' => false, 'legend' => false, 'autocomplete' => 'off'), 'id' => 'addReviewRating', 'enctype' => 'multipart/form-data'));?>
                
                <div class="form-group row"><label class="col-sm-3 col-form-label">Rating</label>
                    <div class="col-sm-9">
                    <?php echo $this->Form->input('StoreReview.review_rating', array('data-glyphicon' => 0, 'type' => 'number', 'class' => 'rating user-detail', 'max' => 5, 'min' => 0, 'label' => false, 'div' => false, 'value' => 1)); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Review</label>
                    <div class="col-sm-9">
                    <?php echo $this->Form->input('StoreReview.review_comment', array('type' => 'textarea', 'class' => 'user-detail', 'placeholder' => 'Enter Your Review', 'maxlength' => '200', 'label' => false, 'div' => false));?>
                    </div>
                </div>
                
                <div class="form-group row"><label class="col-sm-3 col-form-label">Images </label>
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
                    <?php echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'uc button f18 bgcolor_focus w180'));?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#MerchantStoreId").change(function () {
            $("#AdminId").submit();
        });
        $(document).on('click', '.addReviews', function () {
            $("#add-review-modal").modal('show');
        });
    });
</script>