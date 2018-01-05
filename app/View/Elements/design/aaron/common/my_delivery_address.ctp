
<div class="main-container">
    <div class="ext-menu-title">
        <h4>Delivery Address</h4>
    </div>
    <?php
        $isAddAddress = true;
        if(count($checkaddress) >= 5 ) {
            $isAddAddress = false;
        }
    ?>

    <div class="layout-container pages titlemargin">
        <div class="layout-content hc vc bgcolor_white">
            <div class="form hc vc" >
                <?php if (!empty($checkaddress)) { ?>
                    <div class="address-radio-wrap">
                    <?php
                        $i = 0;
                        $delivery_address_id = $this->Session->read('ordersummary.delivery_address_id');
                        foreach ($checkaddress as $address) {
                            if ($address['DeliveryAddress']['default'] == 1) {
                                $checked = "checked = 'checked'";
                            } else if ($i == 0) {
                                $checked = "checked = 'checked'";
                            }else if ($address['DeliveryAddress']['id'] == $delivery_address_id) {
                                $checked = "checked = 'checked'";
                            } else {
                                $checked = "";
                            }
                            ?>
                            <?php if ($address['DeliveryAddress']['label'] == 1) { ?>
                                <input type="radio" id="home" name="data[DeliveryAddress][id]" <?php echo $checked; ?> value="<?php echo $address['DeliveryAddress']['id']; ?>" class="deladdress"/> <label for="home"><span class="chk-span"></span>Home Address</label>
                            <?php } else if ($address['DeliveryAddress']['label'] == 2) { ?>
                                <input type="radio" id="work" name="data[DeliveryAddress][id]" <?php echo $checked; ?> value="<?php echo $address['DeliveryAddress']['id']; ?>" class="deladdress"/> <label for="work"><span class="chk-span"></span>Work Address</label>
                            <?php } else if ($address['DeliveryAddress']['label'] == 3) { ?>
                                <input type="radio" id="other" name="data[DeliveryAddress][id]" <?php echo $checked; ?> value="<?php echo $address['DeliveryAddress']['id']; ?>" class="deladdress"/> <label for="other"><span class="chk-span"></span>Other Address</label>
                            <?php } else if ($address['DeliveryAddress']['label'] == 4) { ?>
                                <input type="radio" id="other4" name="data[DeliveryAddress][id]" <?php echo $checked; ?> value="<?php echo $address['DeliveryAddress']['id']; ?>" class="deladdress"/> <label for="other4"><span class="chk-span"></span>Address4</label>
                            <?php } else if ($address['DeliveryAddress']['label'] == 5) { ?>
                                <input type="radio" id="other5" name="data[DeliveryAddress][id]" <?php echo $checked; ?> value="<?php echo $address['DeliveryAddress']['id']; ?>" class="deladdress"/> <label for="other5"><span class="chk-span"></span>Address5</label>
                                <?php
                            }
                            $i++;
                        }
                    ?>
                    </div>
                    <div id="delivery_address"></div>
                <?php } else { ?>
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i>Add More Addresses', array('controller' => 'users', 'action' => 'addAddress', $encrypted_storeId, $encrypted_merchantId), array('class' => 'btn button-size2_edit2 btn-add-more-address', 'id' => 'addDeliveryaddress', 'escape' => false)) ?>
                <?php } ?>
            </div>
           </div>
    </div>

</div>

<script>

    $(document).ready(function () {

        $("#home").click();

        $('.date-select').datepicker({
            dateFormat: 'mm-dd-yy',
            minDate: 1,
        });

        $("#Deliveryaddress").validate({
            debug: false,
            errorClass: "error",
            errorElement: 'span',
            onkeyup: false,
            rules: {
                "data[Store][pickup_time]": {
                    required: true,
                },
                "data[Store][pickup_date]": {
                    required: true,
                },
            },
            messages: {
                "data[Store][pickup_time]": {
                    required: "Please select pickup time"
                },
                "data[Store][pickup_date]": {
                    required: "Please enter your pickup date",
                }
            }, highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
        $('#pickupdata').css('display', 'none');
        $('#StorePickupTime').css('display', 'none');
        $('#StorePickupDate').css('display', 'none');
        $("#pre-order").on('click', function () { // To Show
            $('#pickupdata').css('display', 'block');
            $('#StorePickupTime').css('display', 'block');
            $('#StorePickupDate').css('display', 'block');
        });
        $("#now").on('click', function () {// To hide
            $('#pickupdata').css('display', 'none');
            $('#StorePickupTime').css('display', 'none');
            $('#StorePickupDate').css('display', 'none');
        });
    });

    $("input[name='data[DeliveryAddress][id]']:radio").click(function () {
        var deliveryId = $(this).val();
        var storeId = '<?php echo $encrypted_storeId; ?>';
        var merchantId = '<?php echo $encrypted_merchantId; ?>';
        $.ajax({
            type: 'post',
            url: '/Users/getDeliveryAddress',
            data: {'deliveryId': deliveryId, 'storeId': storeId, 'merchantId': merchantId},
            success: function (result) {
                if (result) {
                    $('#delivery_address').html(result);
                }
            }
        }).done(function() {
          if('<?=$isAddAddress?>') {
            $("#addDeliveryaddress").show();
          } else {
            $("#addDeliveryaddress").hide();
          }
        });
    });

    $('#StorePickupDate').on('change', function () {
        var date = $(this).val();
        var type1 = 'Store';
        var type2 = 'pickup_time';
        var type3 = 'StorePickupTime';
        var storeId = '<?php echo $encrypted_storeId; ?>';
        var merchantId = '<?php echo $encrypted_merchantId; ?>';
        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'getStoreTime')); ?>",
            type: "Post",
            dataType: 'html',
            data: {storeId: storeId, merchantId: merchantId, date: date, type1: type1, type2: type2, type3: type3},
            success: function (result) {
                $('#resvTime').html(result);
            }
        });
    });

</script>
