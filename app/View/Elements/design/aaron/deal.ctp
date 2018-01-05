<div class="layout-container pages">
<div class="layout-content pages hc vc">
    <ul class="offer">
    <?php
        $dealsstr = '';
        $EncryptStoreID = $this->Encryption->encode($store_data_app['Store']['id']);
        $EncryptMerchantID = $this->Encryption->encode($store_data_app['Store']['merchant_id']);

        if (!empty($couponsData)) {
            foreach ($couponsData as $coupons) {
                $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID), true);
                $dealsstr.= "<li class=\"col-xs-12 col-sm-6 col-md-4\"><div><div class='hc vc'>";
                if (!empty($coupons['Coupon']['image']) && file_exists(WWW_ROOT . '/Coupon-Image/' . $coupons['Coupon']['image'])) {
                    $dealsstr.=$this->Html->link("<img class='center' src='/Coupon-Image/" . $coupons['Coupon']['image'] . "'>", 'javascript:void(0)', array('escape' => false, 'class' => 'addCouponToCart', 'data-id' => $this->Encryption->encode($coupons['Coupon']['id'])));
                } else {
                    $dealsstr.="<a><img class='center' src='/img/no_images.jpg' alt='item'></a>";
                }
                $dealsstr.="</div><h3>" . $this->Html->link(ucfirst($coupons['Coupon']['name']) . ' (' . $coupons['Coupon']['coupon_code'] . ')', 'javascript:void(0)', array('escape' => false, 'class' => 'addCouponToCart', 'data-id' => $this->Encryption->encode($coupons['Coupon']['id']))) . "</h3><small>";
                if ($coupons['Coupon']['discount_type'] == 2) {//for percentage
                    $dealsstr.=$coupons['Coupon']['discount'] . '% off on total order amount.';
                } else {
                    $dealsstr.='$' . $coupons['Coupon']['discount'] . ' off on total order amount.';
                }
                $dealsstr.="</small>";
                $dealsstr.="</div></li>";
            }
        }

        if (!empty($itemOfferData)) {
            foreach ($itemOfferData as $itemOffer) {
                $EncryptItemId = $this->Encryption->encode($itemOffer['ItemOffer']['item_id']);
                $EncryptCatId = $this->Encryption->encode($itemOffer['ItemOffer']['category_id']);
                $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID, $EncryptItemId, $EncryptItemId, $EncryptCatId), true);
                $dealsstr.= "<li class=\"col-xs-12 col-sm-6 col-md-4\"><div><div class='hc vc'>";
                if (!empty($itemOffer['Item']['image']) && file_exists(WWW_ROOT . '/MenuItem-Image/' . $itemOffer['Item']['image'])) {
                    $dealsstr.="<a href='" . $url . "' style='display:block;'><img class='center' src='/MenuItem-Image/" . $itemOffer['Item']['image'] . "'></a>";
                } else {
                    $dealsstr.="<a href='" . $url . "' style='display:block;'><img class='center' src='/img/no_images.jpg'></a>";
                }

                $dealsstr.="</div><h3>" . $this->Html->link(ucfirst($itemOffer['Item']['name']), $url) . "</h3>";

                $numSurfix = $this->Common->addOrdinalNumberSuffix($itemOffer['ItemOffer']['unit_counter']);
                if (!empty($numSurfix)) {
                    $dealsstr.= "<small>" . $this->Html->link("Buy " . ($itemOffer['ItemOffer']['unit_counter'] - 1) . " unit and get the " . $numSurfix . " Item free on " . $itemOffer['Item']['name'] . '.', $url) . "</small>";
                } else {
                    $dealsstr.= "<small>" . $this->Html->link("Buy " . ($itemOffer['ItemOffer']['unit_counter'] - 1) . " get 1 free.", $url) . "</small>";
                }

                $dealsstr.="</div></li>";
            }
        }

        if (!empty($promotionalOfferData)) {
            foreach ($promotionalOfferData as $promotional) {
                    if (!empty($promotional['Item']['Category'])) {
                    $EncryptItemId = $this->Encryption->encode($promotional['Offer']['item_id']);
                    $EncryptCatId = $this->Encryption->encode($this->common->getCategoryID($promotional['Offer']['item_id']));
                    $url = $this->Html->url(array('controller' => 'products', 'action' => 'items', $EncryptStoreID, $EncryptMerchantID, $EncryptItemId, $EncryptItemId, $EncryptCatId), true);
                    $dealsstr.= "<li class=\"col-xs-12 col-sm-6 col-md-4\"><div><div class='hc vc'>";
                    if (!empty($promotional['offerImage']['image']) && file_exists(WWW_ROOT . '/Offer-Image/' . $promotional['offerImage']['image'])) {
                        $dealsstr.="<a href='" . $url . "' style='display:block;'><img src='/Offer-Image/" . $promotional['Offer']['offerImage'] . "'></a>";
                    } elseif (!empty($promotional['Item']['image']) && file_exists(WWW_ROOT . '/MenuItem-Image/deals-images/' . $promotional['Item']['image'])) {

                        $dealsstr.="<a href='" . $url . "' style='display:block;'><img class='center' src='/MenuItem-Image/deals-images/" . $promotional['Item']['image'] . "'></a>";
                    } else {
                        $dealsstr.="<a href='" . $url . "' style='display:block;'><img class='center' src='/img/no_images.jpg' alt = 'deals-img'></a>";
                    }

                    $dealsstr.="</div><h3>" . $this->Html->link(ucfirst($promotional['Item']['name']), $url) . "</h3>";
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
