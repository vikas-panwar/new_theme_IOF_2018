<?php
$url = HTTP_ROOT;
$encrypted_storeId = $this->Encryption->encode($_SESSION['store_id']); // Encrypted Store Id
$encrypted_merchantId = $this->Encryption->encode($_SESSION['merchant_id']);
$finalItem = $this->Common->taxCalculation($finalItem);
$total_sum = 0;
$total_of_items = 0;
$ordertype = "";
$total_of_extra = 0;
$totaltaxPrice = 0;
$ItemOfferArray = $itemDisplayArray = array();
if ($finalItem) {
    foreach ($finalItem as $session_key => $item) {
        $itemDisplayArray['item'][$session_key] = array();
        $storetaxInfo = array();
        $CatName = '';
        $CategoryName = $this->Common->getCategoryName($item['Item']['categoryid']);
        if ($CategoryName) {
            $CatName = $CategoryName['Category']['name'];
        }
        $taxlabel = '';
        if ($item['Item']['taxamount'] > 0) {
            $taxlabel = "T";
            $totaltaxPrice = $totaltaxPrice + $item['taxCalculated'];
        }
        $ordertype = (isset($item['order_type']) ? $item['order_type'] : null);
        $total_sum = $total_sum + $item['Item']['final_price'];
        $total_of_items = $total_of_items + $item['Item']['final_price'];
        $itemDisplayArray['item'][$session_key]['category_name'] = $CatName;
        $itemDisplayArray['item'][$session_key]['tax_label'] = $taxlabel;
        $Interval = "";
        if (isset($item['Item']['interval_id'])) {
            $intervalId = $item['Item']['interval_id'];
            $Interval = $this->Common->getIntervalName($intervalId);
        }
        $itemDisplayArray['item'][$session_key]['interval'] = $Interval;
        $itemDisplayArray['item'][$session_key]['item_quantity'] = $item['Item']['quantity'];
        $itemDisplayArray['item'][$session_key]['item_size'] = @$item['Item']['size'];
        $itemDisplayArray['item'][$session_key]['item_type'] = @$item['Item']['item_type'];
        $itemDisplayArray['item'][$session_key]['item_name'] = @$item['Item']['name'];
        $itemDisplayArray['item'][$session_key]['item_price'] = $this->Common->amount_format($item['Item']['final_price']);
        $itemDisplayArray['item'][$session_key]['item_actual_price'] = $this->Common->amount_format($item['Item']['actual_price']);
        $item_total_price_with_quantity = $item['Item']['actual_price'] * $item['Item']['quantity'];
        $itemDisplayArray['item'][$session_key]['item_total_price_with_quantity'] = $this->Common->amount_format($item_total_price_with_quantity);
        $itemDisplayArray['item'][$session_key]['offer_item_name'] = @$item['Item']['OfferItemName'];
        if (!empty($item['Item']['subPreferenceOld'])) {
            $itemDisplayArray['item'][$session_key]['subpreference_array'] = $item['Item']['subPreferenceOld'];
        }
        if (!empty($item['Item']['default_topping'])) {
            $itemDisplayArray['item'][$session_key]['default_topping_array'] = $item['Item']['default_topping'];
        }
        if (!empty($item['Item']['paid_topping'])) {
            $itemDisplayArray['item'][$session_key]['paid_topping_array'] = $item['Item']['paid_topping'];
        }
        if (!empty($item['Item']['freeQuantity'])) {
            $ItemOfferArray['item'][$session_key]['itemName'] = @$item['Item']['size'] . ' ' . @$item['Item']['type'] . ' ' . $item['Item']['name'];
            $ItemOfferArray['item'][$session_key]['freeQuantity'] = @$item['Item']['freeQuantity'];
            $ItemOfferArray['item'][$session_key]['price'] = $this->Common->amount_format($item['Item']['SizePrice']);
        }
    }
}

if (isset($total_of_items)) {
    $itemDisplayArray['sub_total'] = $total_of_items;
}
if ($ItemOfferArray) {
    $itemDisplayArray['free_item_array'] = $ItemOfferArray;
}
if ($totaltaxPrice) {
    if ($totaltaxPrice >= 0) {
        $totaltaxPrice = $totaltaxPrice;
    } else {
        $totaltaxPrice = $totaltaxPrice = 0.00;
    }
    $_SESSION['taxPrice'] = $totaltaxPrice;
} else {
    $_SESSION['taxPrice'] = 0.00;
}
$itemDisplayArray['tax'] = $this->Common->amount_format($_SESSION['taxPrice']);
if (empty($ordertype)) {
    $ordertype = $this->Session->read('ordersummary.order_type');
}
if ($this->Session->check('Zone.fee') && $ordertype == 3) {
    if ($this->Session->check('Zone.fee')) {
        $_SESSION['delivery_fee'] = $this->Session->read('Zone.fee');
        $total_of_extra = $total_of_extra + $this->Session->read('Zone.fee');
        $itemDisplayArray['zone_fee'] = $this->Common->amount_format($this->Session->read('Zone.fee'));
    }
}

if (isset($_SESSION['final_service_fee']) && ($_SESSION['final_service_fee'] > 0)) {
    $serviceFee = $this->Session->read('final_service_fee');
    $total_of_extra = $total_of_extra + $serviceFee;
    $itemDisplayArray['service_fee'] = isset($serviceFee) ? $this->Common->amount_format($serviceFee) : $this->Common->amount_format(0);
}

if (!empty($storeSetting['StoreSetting']['discount_on_extra_fee'])) {
    $total_sum = number_format($total_of_items, 2) + number_format($total_of_extra, 2);
} else {
    $total_sum = number_format($total_of_items, 2);
}
if (isset($_SESSION['Coupon'])) {
    $Couponcode = $_SESSION['Coupon']['Coupon']['coupon_code'];
    $itemDisplayArray['coupon_code'] = ($Couponcode) ? $Couponcode : '';
    $discount_amount = 0;
    if (isset($_SESSION['Coupon'])) {
        if ($_SESSION['Coupon']['Coupon']['discount_type'] == 1) { // Price
            $discount_amount = $_SESSION['Coupon']['Coupon']['discount'];
        } else { // Percentage
            $discount_amount = $total_sum * $_SESSION['Coupon']['Coupon']['discount'] / 100;
        }
    }

    if ($total_sum < $discount_amount) {
        $discount_amount = $total_sum;
    }
    $itemDisplayArray['coupon_discount_amount'] = $this->Common->amount_format($discount_amount);
    $total_sum = $total_sum - $discount_amount;
    $_SESSION['Discount'] = $discount_amount;
}
if (isset($_SESSION['tip']) && ($_SESSION['tip'] > 0)) {
    $default_tip_option = $this->Session->read('Cart.tip_option');
    $default_tip_value = $this->Session->read('Cart.tip_value');
    $default_tip_select = $this->Session->read('Cart.tip_select');
    $default_tip = $this->Session->read('Cart.tip');

    if ($default_tip_option != '' && $default_tip_option != 0 && $default_tip_option == 3) {
        $default_tip = ($default_tip_select / 100) * $total_of_items;
        $_SESSION['Cart']['tip'] = $default_tip;
    }

    $tipValueDisplay = '';
    $tipSelectDisplay = '';
    if ($default_tip_option == 2) {
        $tipValueDisplay = '';
        $tipSelectDisplay = 'hidden';
    } else if ($default_tip_option == 3) {
        $tipValueDisplay = 'hidden';
        $tipSelectDisplay = '';
    } else {
        $tipValueDisplay = 'hidden';
        $tipSelectDisplay = 'hidden';
    }


    $tipTextDisabled = true;
    if ($default_tip_option == 2) {
        $tipTextDisabled = false;
    } else {
        $tipTextDisabled = true;
    }


    if ($default_tip_option == 0 || $default_tip_option == 1) {
        $tipValueDisplay = 'hidden';
    } else {
        $tipValueDisplay = '';
    }


    $tipOptions = array(0 => 'No Tip', 1 => 'Tip With Cash', 2 => 'Tip With Card', 3 => 'Tip %');
    $itemDisplayArray['tip_amount'] = $this->Common->amount_format($default_tip);
}
if (empty($storeSetting['StoreSetting']['discount_on_extra_fee'])) {
    $total_sum = $total_sum + number_format($total_of_extra, 2);
}
if ($totaltaxPrice) {
    $total_sum = $total_sum + $totaltaxPrice;
}
if (!empty($ItemDiscount)) {
    $total_sum = $total_sum - $ItemDiscount;
}
if (isset($_SESSION['tip']) && ($_SESSION['tip'] > 0)) {
    $tipamount = @$_SESSION['Cart']['tip'];
    if ($tipamount > 0) {
        $total_sum = $total_sum + $tipamount;
    }
}
$itemDisplayArray['total'] = $this->Common->amount_format($total_sum, 2);
$_SESSION['Cart']['grand_total_final'] = number_format($total_sum, 2);
$is_end_payment = $this->Session->read('isEndPatment');

?>
<style>
    .iodr-table { width:100%;!important; font-size : 18px;}
    .iodr-table input[type="text"],
    .iodr-table select { width:120px !important;border:1px solid rgba(155, 155, 155, 0.4);float:left;padding:8px;margin-left:5px; font-size:16px!important;}
    .iodr-table td { padding:1px 4px;font-size:18px; height:45px; }
    .iodr-table tr.small-items td { font-size:16px;}
    .iodr-table .seperator-box td { border-top: solid 1px #d3d3d3;  !important; -webkit-border-top:1px !important; padding:4px;}
    .iodr-table .seperator-box-t td { border-top: solid 1px #676767; }
    .iodr-table .tip-amnt { padding:8px 0;display:inline-block;}
    .editable-form { margin-bottom:15px;}
    .iodr-table .common-bold { font-size:18px;}
    .iodr-table .common-bold-cat { font-weight:bold !important;}
    .iodr-table .singleItemRemove { color:#381f02 !important;}
    .iodr-table .offerItems,
    .iodr-table .offerItems a { display:block;cursor:auto;position:relative;}
    .iodr-table .offerItems a b { font-size:18px;color:rgb(136, 108, 88);cursor:pointer;position:absolute;top:0;right:0;}
    .iodr-table .offerItems br { display:none;}
</style>
<table class="iodr-table">
    <tr>
        <td>
            <table style="width:100%;" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3"><strong>Order Detail</strong></td>
                </tr>
                <tr>
                    <td style="width: 15%"><strong class="common-bold">Qty</strong></td>
                    <td style="width: 60%"><strong class="common-bold">Item</strong></td>
                    <td><strong class="common-bold">Price</strong></td>
                </tr>
                <?php
                if (!empty($itemDisplayArray['item'])) {
                    foreach ($itemDisplayArray['item'] as $keyIndex => $orderDetail) {

                        if($is_end_payment===true){
                            $tagItemRemove = '';
                        } else {
                            $tagItemRemove = '<item class="itemRemove" id=' . $keyIndex . ' style="float:right;"><a href="javascript:void(0)" title="Remove Item"><i class="fa fa-times"></i></a></item>';
                        }

                        echo '<tr class="seperator-box"><td colspan="3"><strong class="common-bold common-bold-cat">' . $orderDetail['category_name'] . '</strong></td></tr>';
                        echo '<tr ><td>' . $orderDetail['item_quantity'] . '</td><td>' . $orderDetail['item_size'] . ' ' . $orderDetail['item_name'] . '</td><td>' . ($orderDetail['item_total_price_with_quantity']) . '<strong>' . $orderDetail['tax_label'] . '</strong>' . $tagItemRemove.'</td></tr>';
                        if (!empty($orderDetail['subpreference_array'])) {//subpreference
                            foreach ($orderDetail['subpreference_array'] as $subPreference) {
                                $unitPrice = $subPreference['price'] / $subPreference['size'];
                                $price = $unitPrice * $subPreference['size'];
                                $price = ($price > 0) ? $this->Common->amount_format($price * $orderDetail['item_quantity']) : '';
                                echo '<tr class="small-items"><td>&nbsp;</td><td>+' . $subPreference['size'] . ' ' . $subPreference['name'] . '</td><td>' . $price . '</td></tr>';
                            }
                        }
                        if (!empty($orderDetail['default_topping_array'])) {//default toppings
                            foreach ($orderDetail['default_topping_array'] as $defaultTopping) {
                                if ($defaultTopping['size'] == 1) {//unit 1 is default
                                    $defaultTopping['price'] = 0.00;
                                } else {
                                    $defaultTopping['price'] = $defaultTopping['price'] * $defaultTopping['size'];
                                }
                                $defaultToppingPrice = ($defaultTopping['price'] > 0) ? $this->Common->amount_format($defaultTopping['price'] * $orderDetail['item_quantity']) : '';
                                echo '<tr class="small-items"><td>&nbsp;</td><td>+' . $defaultTopping['size'] . ' ' . $defaultTopping['name'] . '</td><td>' . $defaultToppingPrice . '</td></tr>';
                            }
                        }
                        if (!empty($orderDetail['paid_topping_array'])) {//paid toppings
                            foreach ($orderDetail['paid_topping_array'] as $paidTopping) {
                                $paidToppingPrice = $paidTopping['price'] * $paidTopping['size'];
                                $paidToppingPrice = ($paidToppingPrice > 0) ? $this->Common->amount_format($paidToppingPrice * $orderDetail['item_quantity']) : '';
                                echo '<tr class="small-items"><td>&nbsp;</td><td>+' . $paidTopping['size'] . ' ' . $paidTopping['name'] . '</td><td>' . $paidToppingPrice . '</td></tr>';
                            }
                        }
                        if (!empty($orderDetail['offer_item_name'])) {
                            echo '<tr><td>&nbsp;</td><td colspan="2"><item id=' . "$keyIndex" . ' style="font-size: 12px;" class="offerItems">Promotional Offer:' . $orderDetail['offer_item_name'] . '</item></td></tr>';
                        }
                        echo '<tr><td colspan="2"></td><td style="font-weight:initial"><strong>' . $orderDetail['item_price'] . '</strong></td></td></tr>';
                    }
                }
                if (!empty($itemDisplayArray['free_item_array']['item'])) {
                    echo '<tr class="seperator-box"><td colspan="3"><strong class="common-bold">Free Item</strong></td></tr>';
                    foreach ($itemDisplayArray['free_item_array']['item'] as $freeItem) {
                        if ($freeItem['freeQuantity'] > 0) {
                            echo '<tr><td>' . $freeItem['freeQuantity'] . '</td><td colspan="2">' . $freeItem['itemName'] . '</td></tr>';
                        }
                    }
                }
                ?>
                <tr class="seperator-box">
                    <td colspan="2"><strong>Sub-Total</strong></td>
                    <td class="sub-total" core-sub-total="<?php echo $itemDisplayArray['sub_total']; ?>"><strong><?php echo $this->Common->amount_format($itemDisplayArray['sub_total']); ?></strong></td>
                </tr>
                <?php
                if (!empty($itemDisplayArray['zone_fee'])) {
                    echo '<tr ><td colspan="2">Delivery Fee</td>';
                    echo '<td>' . $itemDisplayArray['zone_fee'] . '</td></tr>';
                }
                if (isset($_SESSION['service_fee']) && ($_SESSION['service_fee'] > 0)) {
                    echo '<tr ><td colspan="2">Service Fee</td>';
                    echo '<td>' . $itemDisplayArray['service_fee'] . '</td></tr>';
                }
                if (!empty($itemDisplayArray['coupon_code'])) {
                    if($is_end_payment !== true){
                        echo '<tr ><td colspan="2">Coupon Code (' . $itemDisplayArray['coupon_code'] . ')</td><td><div style="min-width:100px;">' . $itemDisplayArray['coupon_discount_amount'] . '<item class="pull-right">' . $this->Html->link('<i class="fa fa-times"></i>', array('controller' => 'products', 'action' => 'removeCoupon'), array('escape' => false, 'confirm' => 'Are you sure to delete coupon?')) . '</item></div></td></tr>';
                    } else {
                        echo '<tr ><td colspan="2">Coupon Code (' . $itemDisplayArray['coupon_code'] . ')</td><td><div style="min-width:100px;">' . $itemDisplayArray['coupon_discount_amount'] . '</div></td></tr>';
                    }
                } else {
                    if($is_end_payment !== true) echo $this->element('orderoverview/coupon');
                }
                if (isset($_SESSION['tip']) && ($_SESSION['tip'] > 0)) {
                    $storeID = $_SESSION['store_id'];
                    $tipData = $this->Common->getStoreTipFront($storeID);
                    if($is_end_payment !== true) {
                    ?>
                    <tr >
                        <td style="min-width:100px;">Add Tip</td>
                        <td colspan="2" style="text-align:right;">
                            <?php
                            echo $this->Form->input('Order.tip', array('type' => 'select', 'class' => 'tip-select inbox ', 'label' => false, 'style' => 'display: inline-block; float: none; margin-left: 0;', 'div' => false, 'options' => $tipOptions, 'default' => ($default_tip_option != '') ? $default_tip_option : ''));
                            echo $this->Form->input('Order.tip_select', array('type' => 'select', 'class' => 'tip inbox ' . $tipSelectDisplay, 'options' => $tipData, 'label' => false, 'div' => false, 'style' => 'display: inline-block; float: none; width: 60px !important; ', 'default' => ($default_tip_select != '') ? $default_tip_select : ''));
                            echo $this->Form->input('Order.tip_value', array('id'=>'OrderTipValue', 'type' => 'text', 'class' => 'tip inbox ' . $tipValueDisplay, 'Placeholder' => '', 'label' => false, 'style' => 'display: inline-block; float: none; ', 'div' => false, 'maxlength' => '10',  'value' => ($itemDisplayArray['tip_amount'] != '') ? $itemDisplayArray['tip_amount'] : ''));
                            ?>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td colspan="2" >
                        <?php
                            switch ($default_tip_option) {
                                case 3 : echo "Tip " . $default_tip_select . '%'; break;
                                default : echo $tipOptions[$default_tip_option];
                            }
                        ?>
                        </td>
                        <td>
                            <?php
                            switch ($default_tip_option) {
                                case 0 : echo '-'; break;
                                case 1 : echo '-'; break;
                                case 2 : echo $itemDisplayArray['tip_amount']; break;
                                case 3 : echo $itemDisplayArray['tip_amount']; break;
                                default : break;
                            }
                            ?>
                        </td>
                    </tr>
                <?php }

                } if (!empty($_SESSION['taxPrice'])) { ?>
                    <tr >
                        <td colspan="2">Tax</td>
                        <td><?php echo $itemDisplayArray['tax']; ?></td>
                    </tr>
                <?php } ?>
                <tr class="seperator-box-t">
                    <td colspan="2"><strong style="font-size:20px;">Total</strong></td>
                    <td><strong style="font-size:18px;"><?php echo $itemDisplayArray['total']; ?></strong></td>
                </tr>
            </table>
        </td>
    </tr>
</table>