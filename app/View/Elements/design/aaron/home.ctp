<?php
$cartlink = "/products/items/" . $encrypted_storeId . "/" . $encrypted_merchantId;
$EncryptStoreID = $this->Encryption->encode($store_data_app['Store']['id']);
$EncryptMerchantID = $this->Encryption->encode($store_data_app['Store']['merchant_id']);
?>
<div class="layout-visual">
    <div id="carousel" class="carousel slide carousel-fade vc hc">
        <ol class="carousel-indicators">
            <?php
            if (!empty($store_data_app['StoreGallery'])) {
                $i = 0;
                foreach ($store_data_app['StoreGallery'] as $gallery) {
                    if (!empty($gallery['image']) && file_exists(WWW_ROOT . '/sliderImages/' . $gallery['image'])) {
                        if ($i == 0) {
                            ?>
                            <li data-target="#carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
                            <?php
                        } else {
                            ?>
                            <li data-target="#carousel" data-slide-to="<?php echo $i; ?>"></li>
                            <?php
                        }
                    }
                    $i++;
                }
            } else {
                ?>
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <?php
            }
            ?>
        </ol>

        <div class="carousel-inner">
            <?php
            if (!empty($store_data_app['StoreGallery'])) {
                $i = 0;
                foreach ($store_data_app['StoreGallery'] as $gallery) {
                    if (!empty($gallery['image']) && file_exists(WWW_ROOT . '/sliderImages/' . $gallery['image'])) {
                        ?>
                        <div data-slide-no="<?php echo $i; ?>" class="item carousel-item <?php echo $i == 0 ? "active" : ""; ?>" style="background-image:url('/sliderImages/<?php echo $gallery['image']; ?>');">
                            <div class="w1400 hc slider-text">
                                <p><?php echo $gallery['description']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    $i++;
                }
            } else {
                ?>
                <div data-slide-no="0" class="item carousel-item active" style="background-image:url('http://via.placeholder.com/2000x745');"></div>
                <?php
            }
            ?>
        </div>
        <div class="online-order button w260 uc bgcolor_focus vc hc">
            <a href="<?php echo "/products/items/" . $encrypted_storeId . "/" . $encrypted_merchantId; ?>" class="hc">ORDER ONLINE</a>
        </div>
    </div>
    <?php
    if (!empty($store_data_app['StoreGallery'] && sizeOf($store_data_app['StoreGallery']) > 1)) {
        ?>
        <a class="carousel-control left" href="#carousel" data-slide="prev"></a>
        <a class="carousel-control right" href="#carousel" data-slide="next"></a>
    <?php } ?>
</div>
</div>

<?php
if (!empty($deals)) {
    if (!empty($storeDealData['StoreDeals']['background_image']) && file_exists(WWW_ROOT . '/StoreDeals-BgImage/' . $storeDealData['StoreDeals']['background_image'])) {
        $image = "/StoreDeals-BgImage/" . $storeDealData['StoreDeals']['background_image'];
        $bgImage = "style=background-image:url('" . $image . "')";
    } else {
        $bgImage = "";
    }
    ?>

    <div class="layout-container" <?php echo $bgImage; ?>>
        <div class="layout-content hc vc">
            <h2>
                <?php echo trim((@$storeDealData['StoreDeals']['title']) ? $storeDealData['StoreDeals']['title'] : 'Deals'); ?>
            </h2>
            <ul class="offer">
                <?php
                $dealsstr = '';
                $j = 0;
                if (!empty($couponsData)) {
                    foreach ($couponsData as $coupons) {
                        $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID), true);
                        $dealsstr.= "<li class=\"col-xs-12 col-sm-6 col-md-4\"><div>";
                        if (!empty($coupons['Coupon']['image']) && file_exists(WWW_ROOT . '/Coupon-Image/' . $coupons['Coupon']['image'])) {
                            $dealsstr.=$this->Html->link("<img src='/Coupon-Image/" . $coupons['Coupon']['image'] . "'>", 'javascript:void(0)', array('escape' => false, 'class' => 'add-cart addCouponToCart', 'data-id' => $this->Encryption->encode($coupons['Coupon']['id']), 'style' => 'display:block;'));
                        } else {
                            $dealsstr.="<a><img src='/img/no_images.jpg' alt='item'></a>";
                        }
                        $dealsstr.="<h3>" . $this->Html->link(ucfirst($coupons['Coupon']['name']) . ' (' . $coupons['Coupon']['coupon_code'] . ')', 'javascript:void(0)', array('escape' => false, 'class' => 'add-cart addCouponToCart', 'data-id' => $this->Encryption->encode($coupons['Coupon']['id']))) . "</h3><small>";
                        if ($coupons['Coupon']['discount_type'] == 2) {//for percentage
                            $dealsstr.=$coupons['Coupon']['discount'] . '% off on total order amount.';
                        } else {
                            $dealsstr.='$' . $coupons['Coupon']['discount'] . ' off on total order amount.';
                        }
                        $dealsstr.="</small>";
                        $dealsstr.="</div></li>";
                        $j++;
                    }
                }

                if (!empty($itemOfferData)) {
                    foreach ($itemOfferData as $itemOffer) {
                        $EncryptItemId = $this->Encryption->encode($itemOffer['ItemOffer']['item_id']);
                        $EncryptCatId = $this->Encryption->encode($itemOffer['ItemOffer']['category_id']);
                        $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID, $EncryptItemId, $EncryptItemId, $EncryptCatId), true);
                        $dealsstr.= "<li class=\"col-xs-12 col-sm-6 col-md-4\"><div>";
                        if (!empty($itemOffer['Item']['image']) && file_exists(WWW_ROOT . '/MenuItem-Image/' . $itemOffer['Item']['image'])) {
                            $dealsstr.="<a href='" . $url . "' style='display:block;'><img src='/MenuItem-Image/" . $itemOffer['Item']['image'] . "'></a>";
                        } else {
                            $dealsstr.="<a href='" . $url . "' style='display:block;'><img src='/img/no_images.jpg'></a>";
                        }

                        $dealsstr.="<h3>" . $this->Html->link(ucfirst($itemOffer['Item']['name']), $url) . "</h3>";

                        $numSurfix = $this->Common->addOrdinalNumberSuffix($itemOffer['ItemOffer']['unit_counter']);
                        if (!empty($numSurfix)) {
                            $dealsstr.= "<small>" . $this->Html->link("Buy " . ($itemOffer['ItemOffer']['unit_counter'] - 1) . " unit and get the " . $numSurfix . " Item free on " . $itemOffer['Item']['name'] . '.', $url) . "</small>";
                        } else {
                            $dealsstr.= "<small>" . $this->Html->link("Buy " . ($itemOffer['ItemOffer']['unit_counter'] - 1) . " get 1 free.", $url) . "</small>";
                        }

                        $dealsstr.="</div></li>";
                        $j++;
                    }
                }

                if (!empty($promotionalOfferData)) {
                    foreach ($promotionalOfferData as $promotional) {
                        if (!empty($promotional['Item']['Category'])) {
                            $EncryptItemId = $this->Encryption->encode($promotional['Offer']['item_id']);
                            $EncryptCatId = $this->Encryption->encode($this->common->getCategoryID($promotional['Offer']['item_id']));
                            $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID, $EncryptItemId, $EncryptItemId, $EncryptCatId), true);
                            $dealsstr.= "<li class=\"col-xs-12 col-sm-6 col-md-4\"><div>";
                            if (!empty($promotional['offerImage']['image']) && file_exists(WWW_ROOT . '/Offer-Image/' . $promotional['offerImage']['image'])) {
                                $dealsstr.="<a href='" . $url . "' style='display:block;'><img src='/Offer-Image/" . $promotional['Offer']['offerImage'] . "'></a>";
                            } elseif (!empty($promotional['Item']['image']) && file_exists(WWW_ROOT . '/MenuItem-Image/deals-images/' . $promotional['Item']['image'])) {

                                $dealsstr.="<a href='" . $url . "' style='display:block;'><img src='/MenuItem-Image/deals-images/" . $promotional['Item']['image'] . "'></a>";
                            } else {
                                $dealsstr.="<a href='" . $url . "' style='display:block;'><img src = '/img/no_images.jpg' alt = 'deals-img'></a>";
                            }

                            $dealsstr.="<h3>" . $this->Html->link(ucfirst($promotional['Item']['name']), $url) . "</h3>";
                            $dealsstr.="<small> - " . $this->Html->link($promotional['Offer']['description'], $url) . "</small>";
                            $dealsstr.="</div></li>";
                        }
                    }
                }
                echo $dealsstr;
                ?>
            </ul>
        </div>
    </div>
<?php } ?>

<?php
if (!empty($feturedData)) {
    foreach ($feturedData as $key => $fData) {
        $bgImage = "";
        if (empty($fData['FeaturedItem'])) {
            unset($feturedData[$key]);
        }
    }
    ?>

    <?php
    $fi = 1;

    $totalsections = count($feturedData);
    foreach ($feturedData as $key => $fData) {
        $bgImage = "";
        if (!empty($fData['FeaturedItem'])) {
            if (!empty($fData['StoreFeaturedSection']['background_image']) && file_exists(WWW_ROOT . '/FeatureSection-BgImage/' . $fData['StoreFeaturedSection']['background_image'])) {
                $image = "/FeatureSection-BgImage/" . $fData['StoreFeaturedSection']['background_image'];
                $bgImage = "style=background-image:url('" . $image . "')";
            } else {
                $bgImage = "";
            }
            ?>

            <div class="layout-container" <?php echo $bgImage; ?>>
                <div class="layout-content hc vc">
                    <h2><?php echo trim(ucfirst($fData['StoreFeaturedSection']['featured_name'])); ?></h2>
                    <ul class="recommended">
                        <?php
                        $i = 0;
                        foreach ($fData['FeaturedItem'] as $fItem) {
                            if (!empty($fItem['Item']['name'])) {
                                if ($fItem['Item']['is_seasonal_item'] == 1) {
                                    if (strtotime($fItem['Item']['end_date']) < strtotime($currentDate)) {
                                        continue;
                                    }
                                }
                                $EncryptItemId = $this->Encryption->encode($fItem['item_id']);
                                $EncryptCatId = $this->Encryption->encode($this->common->getCategoryID($fItem['item_id']));
                                $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID, $EncryptItemId, $EncryptItemId, $EncryptCatId), true);
                                ?>
                                <li class="col-xs-12 col-sm-6 col-md-3">
                                    <div>
                                        <?php if (!empty($fItem['Item']['image']) && file_exists(WWW_ROOT . '/MenuItem-Image/' . $fItem['Item']['image'])) { ?>
                                            <a href="<?php echo $url; ?>"><img src="/MenuItem-Image/<?php echo $fItem['Item']['image']; ?>" alt="item"></a>
                                        <?php } else { ?>
                                            <a href="<?php echo $url; ?>"><img src="/img/no_images.jpg" alt="item"></a>
                                        <?php } ?>
                                        <h3><?php echo $this->Html->link(ucfirst(@$fItem['Item']['name']), $url) ?></h3>
                                        <h5><?php echo (!empty($fItem['Item']['description'])) ? trim(substr($fItem['Item']['description'], 0, 40)) : ''; ?></h5>
                                        <h4>$<?php echo (!empty($fItem['Item']['price'])) ? $fItem['Item']['price'] : ''; ?></h4>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <?php if ($totalsections == $fi) { ?>
                        <div class="bottom_online_order clearfix">
                            <div class="rd5 vc hc uc f24 bgcolor_focus h60 w370">
                                <a href="<?php echo $cartlink; ?>" class="hc">ORDER ONLINE</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            </div>
            <?php
        }
        $fi++;
    }
    ?>
<?php } ?>

<script type="text/javascript">
    $(document).on('click', '.addCouponToCart', function () {
        var couponId = $(this).data('id');
        if (couponId) {
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'products', 'action' => 'addCouponToCart')); ?>",
                type: "Post",
                dataType: 'html',
                async: false,
                data: {couponId: couponId},
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
                success: function (result) {
                    if (result) {
                        response = $.parseJSON(result);
                        if (response.status == "Error") {
                            $("#errorPop").modal('show');
                            $("#errorPopMsg").html(response.msg);
                            return false;
                        } else if (response.status == "Success" && response.url) {
                            window.location.href = response.url;
                        }
                    }
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        }
    });
</script>
