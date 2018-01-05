<style>
    .order-detail-section img {
        width: auto;
    }

    .message.message-success.alert-success {
        margin-top: 5px;
    }

    .chole-main .inner-wrap.photos-andy {
        display: block;
    }
</style>
<?php
$storeId = $this->Session->read('store_id');
$url = HTTP_ROOT;
$imageurl = HTTP_ROOT . 'storeLogo/' . $store_data_app['Store']['store_logo'];
?>

    <main class="main-body horizontal-theme-one theme-one">
        <div class="title-bar">My Favorites</div>
        <div class="main-container ">
            <div class="ext-menu-title">
                <h4>
                    <?php echo __('Favorite & Order History'); ?>
                </h4>
            </div>
            <div class="photos-andy common-tabs myfavorites titlemargin">
                <?php //echo $this->Session->flash(); ?>

                <!-- Nav tabs -->
                <div class="fav-order-history-edited card ">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active">
                            <?php echo $this->Html->link(__('My Favorites'), array('controller' => 'orders', 'action' => 'myFavorites', $encrypted_storeId, $encrypted_merchantId)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('My Orders'), array('controller' => 'orders', 'action' => 'myOrders', $encrypted_storeId, $encrypted_merchantId)); ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(__('My Saved Orders'), array('controller' => 'orders', 'action' => 'mySavedOrders', $encrypted_storeId, $encrypted_merchantId)); ?>
                        </li>
                    </ul>
                </div>
                <div class="fav-order-history">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">

                            <div class="table hc vc bgcolor_white">
                                <div class="row">
                                    <?php echo $this->Form->create('Orders', array('url' => array('controller' => 'orders', 'action' => 'myFavorites'), 'id' => 'AdminId', 'type' => 'post', 'class' => 'p10 clearfix ')); ?>
                                    <?php echo $this->element('userprofile/filter_store'); ?>
                                    <div class="col-sm-2 col-xs-6 hc vc">
                                        <?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'uc f16 button bgcolor_theme1 w100p')); ?>
                                    </div>
                                    <div class="col-sm-2 col-xs-6 hc vc">
                                        <?php echo $this->Html->link('Clear', array('controller' => 'orders', 'action' => 'myFavorites', 'clear'), array('class' => 'uc f16 button bgcolor_theme1 w100p')); ?>
                                    </div>
                                </div>
                            </div>

                            <?php echo $this->Form->end(); ?>
                            <div class="pagination-section clearfix">
                                <?php echo $this->element('pagination'); ?>
                            </div>

                            <?php
                                if (!empty($myFav)) {
                                    foreach ($myFav as $orders) {
                                        ?>
                                <div class="order-main-container clearfix">
                                    <div class="order-status clearfix">
                                        <div class="order-detail-section">
                                            <div class="order-history-detail-lt-andy">

                                                <p class="margin-add15-andy">
                                                    <?php echo __('Order Id:'); ?>
                                                    <span class=o rder-color-andy>
                                                        <?php echo $orders['Order']['order_number']; ?> </span>
                                                    <span></span>
                                                    <span class="costStatus">
                                                        <?php echo __('Cost:'); ?>
                                                        <b> $
                                                            <?php echo number_format ($orders['Order']['amount'] - $orders['Order']['coupon_discount'], 2) ; ?> </b>
                                                        - (
                                                        <?php echo $orders['Order']['OrderStatus']['name']; ?>)</span>
                                                </p>

                                                <div class="pickup-andy">
                                                    <p>
                                                        <?php
                                                            if ($orders['Order']['seqment_id'] == 1) {
                                                                echo 'Dine-In';
                                                            } elseif ($orders['Order']['seqment_id'] == 2) {
                                                                echo 'PickUp';
                                                            } elseif ($orders['Order']['seqment_id'] == 3) {
                                                                echo $orders['Order']['DeliveryAddress']['name_on_bell'] . ', ' . $orders['Order']['DeliveryAddress']['address'] . ' ,' . $orders['Order']['DeliveryAddress']['city'];
                                                            }
                                                            ?>
                                                    </p>
                                                    <p>Order Placed On:
                                                        <?php echo $this->Common->storeTimeFormateUser($this->Common->storeTimeZoneUser('', $orders['Order']['created']), true); ?>
                                                    </p>
                                                    <p>Order Time:
                                                        <?php
                                                            echo $this->Common->storeTimeFormateUser($orders['Order']['pickup_time'], true);
                                                            ?>
                                                    </p>

                                                    <?php if (!empty($orders['Order']['order_comments'])) { ?>
                                                    <p>Comments:
                                                        <?php echo $orders['Order']['order_comments']; ?>
                                                    </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="table" class="responsive-table-andy">
                                        <table class="table table-class-andy">
                                            <thead>
                                                <tr>
                                                    <th style="width:20%;">
                                                        <?php echo __('Items'); ?>
                                                    </th>
                                                    <th style="width:15%;">
                                                        <?php echo __('Size'); ?>
                                                    </th>
                                                    <th style="width:20%;">
                                                        <?php echo __('Preferences'); ?>
                                                    </th>
                                                    <th style="width:15%;">
                                                        <?php echo __('Add-ons'); ?>
                                                    </th>
                                                    <th style="width:20%;">
                                                        <?php echo __('Store'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orders['Order']['OrderItem'] as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            $Interval = "";
                                                            if (isset($order['interval_id'])) {
                                                                $intervalId = $order['interval_id'];
                                                                $Interval = $this->Common->getIntervalName($intervalId);
                                                            }
                                                            echo $order['quantity'] . 'X' . $order['Item']['name'];
                                                            echo ($Interval) ? "(" . $Interval . ")" : "";
                                                            ?>
                                                            <br>
                                                            <?php
                                                            if (!empty($order['OrderOffer'])) {
                                                                echo "<innerTag class='greyFont'>Offer Items :</innerTag>";
                                                                foreach ($order['OrderOffer'] as $offer) {
                                                                    echo '<br/>' . $offer['quantity'] . 'X' . $offer['Item']['name'];
                                                                }
                                                            }
                                                            ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                            if (!empty($order['Size'])) {
                                                                echo $order['Size']['size'];
                                                            } else {
                                                                echo ' - ';
                                                            }
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if (!empty($order['OrderPreference'])) {
                                                                $preference = "";
                                                                $prefix = '';
                                                                foreach ($order['OrderPreference'] as $key => $opre) {
                                                                    $preference .= $prefix . '' . $opre['SubPreference']['name'] . "";
                                                                    $prefix = ', ';
                                                                }
                                                                echo $preference;
                                                            } else {
                                                                echo ' - ';
                                                            }
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if (!empty($order['OrderTopping'])) {
                                                                $prefix = '';
                                                                foreach ($order['OrderTopping'] as $topping) {
                                                                    if (!empty($topping['Topping']['name'])) {
                                                                        $size = ($topping['addon_size_id'] > 1) ? $topping['addon_size_id'] : '';
                                                                        echo $prefix . '' . $size . ' ' . $topping['Topping']['name'] . '';
                                                                        $prefix = ', ';
                                                                    }
                                                                }
                                                            } else {
                                                                echo ' - ';
                                                            }
                                                            ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                            if (!empty($orders['Store'])) {
                                                                echo $orders['Store']['store_name'];
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="order-history-detail-rt">
                                        <?php
                                            $desc = '';
                                            $offers = '';
                                            $result = '';
                                            foreach ($orders['Order']['OrderItem'] as $order) {
                                                //$desc = $order['quantity'] . ' ' . @$order['Size']['size'] . ' ' . @$order['Type']['name'] . ' ' . $order['Item']['name'];
                                                $desc = $order['quantity'];
                                                if (!empty($order['Size']['size'])) {
                                                    $desc.= ' ' . @$order['Size']['size'];
                                                }
                                                if (!empty($order['Type']['name'])) {
                                                    $desc.= ' ' . @$order['Type']['name'];
                                                }
                                                if (!empty($order['Item']['name'])) {
                                                    $desc.= ' ' . @$order['Item']['name'];
                                                }
                                                if (!empty($order['OrderOffer'])) {
                                                    foreach ($order['OrderOffer'] as $offer) {
                                                        $offers .= $offer['quantity'] . 'X' . $offer['Item']['name'] . '&nbsp;';
                                                    }
                                                }
                                                if (!empty($offers)) {
                                                    $result .= $desc . ' ( Offer : ' . $offers . '), ';
                                                } else {
                                                    $result .= $desc . ', ';
                                                }
                                                $offers = '';
                                                $desc = '';
                                            }
                                            ?>
                                            <span style="display: inline-block; margin: 0px 5px; vertical-align: text-top;">
                                                <?php
                                                    $strDomainUrl = $_SERVER['HTTP_HOST'];
                                                    $strShareLink = "https://www.facebook.com/sharer/sharer.php?u=" . $strDomainUrl;
                                                    ?>
                                                    <a href="#" onclick='window.open("<?php echo $strShareLink; ?>", "", "width=500, height=300");'>
                                                        <?php echo $this->Html->image('1_sns_facebook.png', array('alt' => 'fbshare')); ?>
                                                    </a>
                                                    <span style="display: inline-block; margin: 0px 5px; vertical-align: text-top;">
                                                        <a target="blank" href="http://twitter.com/share?text=I ordered <?php echo $result; ?> from <?php echo $_SESSION['storeName']; ?> 
                                                    &url=<?php echo $url; ?>&via=<?php echo $_SESSION['storeName']; ?>">
                                                            <?php echo $this->Html->image('1_sns_twitter.png', array('alt' => 'twshare')); ?> </a>
                                                    </span>
                                            </span>
                                    </div>
                                    <div class="reOrder-andy">
                                        <?php
                                            if (!empty($storeId)) {
                                                if ($orders['Favorite']['store_id'] == $storeId) {
                                                    echo $this->Form->button('Re-Order', array('class' => 'reorder submitAddAddress hc uc button f18 bgcolor_focus w260', 'name' => $this->Encryption->encode($orders['Order']['id']), 'escape' => false));
                                            ?>
                                    </div>
                                    <div class="remove-andy">
                                        <?php
                                                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-times')) . 'Remove', array('controller' => 'orders', 'action' => 'myFavorite', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($orders['Order']['id']), $this->Encryption->encode($orders['Favorite']['id'])), array('class' => 'removeFrmFav orderColor', 'escape' => false));
                                                }
                                            }
                                            ?>
                                    </div>
                                </div>

                                <?php
                                    }
                                } else {
                                    ?>
                                    <div class="repeat-deatil">
                                        <div class="responsive-table">
                                            <table class="table table-striped order-history-table">
                                                <tr>
                                                    <td>
                                                        <?php echo __("No order has been added into favorite list"); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('.reorder').click(function () {
                var orderId = $(this).attr('name');
                if (orderId) {
                    $.ajax({
                        type: 'post',
                        url: '/products/reorder',
                        data: {
                            'orderId': orderId
                        },
                        async: false,
                        success: function (result) {
                            var parsedJson = $.parseJSON(result);
                            if (parsedJson.count == 0) {
                                $("#errorPop").modal('show');
                                $("#errorPopMsg").html('Items are no longer available.');
                                return false;
                            } else {
                                if (parsedJson.item >= 1) {
                                    $("#errorPop").modal('show');
                                    $("#errorPopMsg").html('Items are no longer available.');
                                    return false;
                                } else {
                                    $.ajax({
                                        type: 'post',
                                        url: '/Products/fetchReorderProduct',
                                        data: {},
                                        async: false,
                                        success: function (result2) {
                                            if (result2 == 1) {
                                                window.location =
                                                    "/Products/items/<?php echo $encrypted_storeId; ?>/<?php echo $encrypted_merchantId; ?>";
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    });
                }
                //window.location = "/Users/customerDashboard/<?php echo $encrypted_storeId; ?>/<?php echo $encrypted_merchantId; ?>/" + orderId;
            });

            $("#MerchantStoreId").change(function () {
                $("#AdminId").submit();
            });
            $("#flashMessage").fadeOut(8000);
        });
    </script>