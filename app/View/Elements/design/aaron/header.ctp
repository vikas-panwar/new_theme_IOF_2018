<?php
    if($cartcount > 0 || $this->Session->check('GuestUser')){
        $cartlink = "/products/items/" . $encrypted_storeId . "/" . $encrypted_merchantId;
    } else {
        $cartlink = "javascript:void(0)";
    }

    if (isset($store_data_app['Store']['is_store_open'])) {
        $tagStoreOpenMsg = "Order Now!";
    }

    if(AuthComponent::User()) {
        $member_type = "member";
    } else if (!AuthComponent::User() && $this->Session->check('GuestUser')) {
        $member_type = "guest";
    } else {
        $member_type = "none";
    }
    ?>


<div class="layout-container">
    <div class="layout-header bgcolor_top">
        <div class="w1400 hc vc p15">
            <span class="tl"><a href="<?php echo "/products/items/" . $encrypted_storeId . "/" . $encrypted_merchantId; ?>"><?=$tagStoreOpenMsg?></a></span>
            <span class="tr">
            <?php if ($member_type === "none") { ?>
                <ul class="db">
                    <li><a href="javascript:void();" data-toggle="modal" data-target="#login-modal">Login</a></li>
                    <li class="color_pipe">|</li>
                    <li><?php echo $this->Html->link('Sign Up', array('controller' => 'users', 'action' => 'registration'), array('escape' => false, 'class' => "")); ?></li>
                </ul>
            <?php } else if($member_type === "member") { ?>
                <ul class="db">
                    <li class="dropdown"><a href="<?php echo $cartlink; ?>"><div class="cart"><div class="numberOfCart"><?php echo $cartcount; ?></div></div></a></li>
                    <li style="position:relative;"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, <?php echo ucfirst($_SESSION['Auth']['User']['fname']); ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <li <?php if ($this->params['controller'] == 'users' && $this->params['action'] == 'myDeliveryAddress') { ?> class="active" <?php } ?>><?php echo $this->Html->link('Delivery Addresses', array('controller' => 'users', 'action' => 'myDeliveryAddress', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <li <?php if ($this->params['controller'] == 'users' && $this->params['action'] == 'myBillingInfo') { ?> class="active" <?php } ?>><?php if (is_array($nzsafe_data_app)) echo $this->Html->link('My Billing Information', array('controller' => 'users', 'action' => 'myBillingInfo', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <li <?php if ($this->params['controller'] == 'users' && $this->params['action'] == 'myProfile') { ?> class="active" <?php } ?>><?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'myProfile', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <li <?php if ($this->params['controller'] == 'orders' && $this->params['action'] == 'myOrders') { ?> class="active" <?php } ?>> <?php echo $this->Html->link(__('My Favorites & Orders'), array('controller' => 'orders', 'action' => 'myOrders', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <li <?php if ($this->params['controller'] == 'coupons' && $this->params['action'] == 'myCoupons') { ?> class="active" <?php } ?>><?php echo $this->Html->link(__('My Coupons'), array('controller' => 'coupons', 'action' => 'myCoupons', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <?php if ($store_data_app['Store']['is_booking_open'] == 1) { ?>
                                <li <?php if ($this->params['controller'] == 'pannels' && $this->params['action'] == 'myBookings') { ?> class="active" <?php } ?>><?php echo $this->Html->link(__('My Reservations'), array('controller' => 'pannels', 'action' => 'myBookings', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <?php } ?>
                            <li <?php if ($this->params['controller'] == 'pannels' && $this->params['action'] == 'myReviews') { ?> class="active" <?php } ?>><?php echo $this->Html->link(__('My Reviews'), array('controller' => 'pannels', 'action' => 'myReviews', $encrypted_storeId, $encrypted_merchantId)); ?></li>
                            <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
                        </ul>
                    </li>
                </ul>
            <?php } if($member_type === "guest") { ?>
                <ul class="db">
                    <li><a href="<?php echo $cartlink; ?>"><div class="cart"><div class="numberOfCart"><?php echo $cartcount; ?></div></div></a></li>
                    <li>Welcome : Guest</li>
                    <li class="color_pipe">|</li>
                    <li><a href="javascript:void();" data-toggle="modal" data-target="#login-modal">Login</a></li>
                </ul>
            <?php } ?>

            </span>
        </div>
    </div>
    <div class="layout-menu h120 bgcolor_f08">
        <div class="w1400 hc vc">
            <div class="h120">
                <?php if ($store_data_app['Store']['is_store_logo'] == 1) { ?>
                <h1><a href="/"><?php echo $store_data_app['Store']['store_name']; ?></a></h1>
                <?php } else { ?>
                <a href="/"><?php echo $this->Html->image('/storeLogo/' . $store_data_app['Store']['store_logo'], array('class' => 'h120')); ?></a>
                <?php } ?>
            </div>
            <div class="tr">
                <div class="header-menu">
                <ul class="header-menu-list color_default f18 hf" >
                 <?php
                    if (!empty($store_data_app['StoreContent'])) {
                        foreach (array_reverse($store_data_app['StoreContent']) as $content) {
                            if ($content['page_position'] === 1) continue;
                            if (isset($content['review_page']) && $content['review_page'] === 1) continue;

                            $active = $this->Menu->active($this->params, $content['name']);
                            $linkTag = $this->Menu->link($content['name'], $store_data_app['Store']['is_booking_open']);
                            if(!$linkTag) continue;
                            echo '<li class="'.$active.'">';
                            echo $linkTag;
                            echo "<span class='indicator'></span>";
                            echo '</li>';
                        }
                    }
                ?>
                </ul>
                </div>

                <div class="navbar">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse" aria-expanded="false" aria-controls="navbar">
                        <span class = "sr-only">Toggle navigation</span>
                        <span class = "icon-bar"></span>
                        <span class = "icon-bar"></span>
                        <span class = "icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse custom-colapse" id="example-navbar-collapse">
            <ul class="mobile_menu color_default f18 hf">
            <?php
            if (!empty($store_data_app['StoreContent'])) {
                foreach (($store_data_app['StoreContent']) as $content) {
                    if ($content['page_position'] === 1) continue;
                    if (isset($content['review_page']) && $content['review_page'] === 1) continue;
                    $active = $this->Menu->active($this->params, $content['name']);
                    $linkTag = $this->Menu->link($content['name'],$store_data_app['Store']['is_booking_open']);
                    if(!$linkTag) continue;
                    echo '<li class="'.$active.'">';
                    echo $linkTag;
                    echo '</li>';
                }
            }
            ?>
            </ul>
        </div>

    </div>
</div>



<script>
    $(document).ready(function () {

      $( ".header-menu-list > li" ).mouseover(function() {
         $(this).children().css('border-top-color','var(--point-color)');
      });
      $( ".header-menu-list > li" ).mouseout(function() {
         $(this).children().css('border-top-color','');
      });

      $('.menu-control').on('click', function () {
          $('.vt-header').toggleClass('open');
          $(this).toggleClass('mc-active');
      });

    });
</script>