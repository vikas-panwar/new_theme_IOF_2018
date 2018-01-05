<div class="main-container ">
    <div class="ext-menu-title">
        <h4>Menu</h4>
    </div>
    <div class="inner-wrap menu-section clearfix">
        <div class="left-menu">
            <?php //echo $this->element('design/aaron/storeMenu/order_type'); ?>
            <?php echo $this->element('design/aaron/storeMenu/list'); ?>
        </div>
        <div class="right-menu">
            <?php
            $guestUserDetail = $this->Session->check('GuestUser');
            $guestUserOrderType = $this->Session->read('ordersummary.order_type');
            $userId = AuthComponent::User('id');
            if (empty($userId) && empty($guestUserDetail)) { ?>
                <div class="common-title"><h3>My Order</h3></div>
                <div class="login-container">
                    <div class="theme-btn-group">
                        <div class="left col-6 ">
                            <a data-target="#guest-sign-up-modal" data-toggle="modal" href="javascript:void();" class="d-access-guest btn btn-lg button-color2">AS A GUEST</a>
                        </div>
                        <div class="right col-6 ">
                            <a data-target="#login-modal" data-toggle="modal" href="javascript:void();" class="d-access-guest btn btn-lg button-color2">SIGN IN</a>
                        </div>
                    </div>
                </div>
            <?php
                 echo $this->element('userlogin/guest_sign_up');
            } else {
                ?>
                <div class="panel-group">
                    <?php if (!empty($userId) && !empty($guestUserOrderType)) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">ORDER SUMMARY</h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <?php echo $this->element('orderoverview/login_user_order_detail'); ?>
                            </div>
                        </div>
                        <?php
                    } elseif (empty($userId) && !empty($guestUserDetail) && !empty($guestUserOrderType)) {
                        //$checkAddressInZone = $this->Session->read('Zone.id');
                        //if ($guestUserOrderType == '3' && empty($checkAddressInZone)) {
                        //} else {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">SELECT ORDER TYPE</h3>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <?php echo $this->element('design/aaron/orderoverview/guest_order_detail'); ?>
                                </div>
                            </div>
                            <?php
                        //}
                    } else {
                        echo $this->element('design/aaron/orderoverview/order_type');
                    }
                    ?>
                </div>
            <?php } ?>
            <?php echo $this->Form->create('CartInfo', array('url' => array('controller' => 'Products', 'action' => 'orderDetails'))); ?>
            <div id="ordercart">
                <?php echo $this->element('design/aaron/storeMenu/cart'); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<div class="modal fade add-info" id="address-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>