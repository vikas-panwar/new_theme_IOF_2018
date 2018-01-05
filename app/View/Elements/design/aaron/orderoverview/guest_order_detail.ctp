<?php
$oDetail = $this->Session->read('ordersummary');
$guestUserDetail = $this->Session->check('GuestUser');
$userId = AuthComponent::User('id');
if (!empty($oDetail['order_type']) && $oDetail['order_type'] == 3 && empty($oDetail['delivery_address_id'])) {
    ?>
    <input type="hidden" id="preSelectTime" value="<?php echo $oDetail['order_type']; ?>"/>
<?php }
?>

<div class="panel-body nested-ac">
    <div class=" pay-wrap select-order clearfix">
        <div class="pay-check">
            <div>
                <?php if (!empty($oDetail['order_type']) && $oDetail['order_type'] == 3) { ?>
                    Order Type : Delivery
                <?php } elseif (!empty($oDetail['order_type']) && $oDetail['order_type'] == 2) { ?>
                    Order Type : Pick-up
                <?php } ?>
            </div>
            <div>
                <?php if (!empty($oDetail['pickup_date'])) { ?>
                    Order Time : <?php
                    $h = $oDetail['pickup_hour'];
                    $m = $oDetail['pickup_minute'];
                    $date = "$h:$m:00";
                    echo $oDetail['pickup_date'] . ' ' . date('h:i a', strtotime($date));
                }
                ?>
            </div>
            <?php
            $gDetail = $this->Session->read('GuestUser');
            ?>
            <div>
                <?php if (!empty($gDetail['name'])) { ?>
                    Name : <?php echo ucfirst($gDetail['name']); ?>
                <?php } ?>
            </div>
            <div>
                <?php if (!empty($gDetail['email'])) { ?>
                    Email : <?php echo $gDetail['email']; ?>
                <?php } ?>
            </div>
            <div>
                <?php if (!empty($gDetail['userPhone'])) { ?>
                    Phone : <?php echo $gDetail['countryCode'] . ' ' . $gDetail['userPhone']; ?>
                <?php } ?>
            </div>

            <?php if (!empty($oDetail['address']) && !empty($oDetail['order_type']) && $oDetail['order_type'] == 3) { ?>
                <div class="store-contact-info-ele">
                    <strong class="mt-10 display-inline-block">Delivery Address :</strong> <?php echo '<br/>' . ucfirst($oDetail['address']) . '<br/>' . ucfirst($oDetail['city']) . ', ' . ucfirst($oDetail['state']) . ' ' . $oDetail['zipcode']; ?>
                </div>
                <?php
            } elseif (!empty($oDetail['order_type']) && $oDetail['order_type'] == 2) {
                if (!empty($userId) || !empty($guestUserDetail)) {
                    echo $this->element('orderoverview/pickup_address');
                }
            }
            ?>
        </div>
        <button class="cont-btn btn btn-info button-color2 button-size2" type="button" id="editOrderDetail">Edit</button>
    </div>
</div>
<script>
    $(document).on('click', '#editOrderDetail', function (e) {
        e.stopImmediatePropagation();
        $.ajax({
            type: 'post',
            url: "<?php echo $this->Html->url(array('controller' => 'orderOverviews', 'action' => 'editGuestOrderDetail')); ?>",
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
                if (result) {
                    $('#collapseTwo').html(result);
                }
            }
        });
    });
    var orderValue = $("#preSelectTime").val();
    if (orderValue == 3) {
        $("#editOrderDetail").trigger('click');
    } else {
        $(".store-contact-info-ele").removeClass('hidden');
    }
</script>