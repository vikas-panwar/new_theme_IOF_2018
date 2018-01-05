<?php
$guestUser = false;
if (!AuthComponent::User() && $this->Session->check('GuestUser')) {
    $guestUser = true;
}
?>
<div class="title-bar">Order Overview</div>
<div class="main-container">
    <div class="inner-wrap order-type common-white-bg">
        <div class="order-detail">
            <div class="clearfix">
                <section class="form-layout sign-up no-image editable-form">
                    <h3 class="success-title"> <span>Your order has been placed successfully</span> </h3>
                    <hr>
                    <div class="theme-btn-group clearfix">

                        <?php
                        if ($guestUser) {
                            $link = "/users/dologin";
                        } else {
                            $link = "/products/items/" . $encrypted_storeId . "/" . $encrypted_merchantId;
                        }
                        echo $this->Form->button('Continue Shopping', array('type' => 'button', 'id' => 'continue_shopping', 'class' => 'btn button-color1 button-size1'));
                        ?>
                    </div>
                    <?php if ($this->Session->check('orderOverview')) { ?>
                        <hr>
                        <div class="">
                            <h3 class="success-title">Order Overview</h3>
                            <hr>
                            <div class="editable-form">
                                <?php
                                echo $this->element('design/aaron/element/order-element-calculation');
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </section>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Session->write('orderOverview', '');
?>
<script>

    window.onpopstate = function () {
        window.location.assign("/users/login");
        // binding this event can be done anywhere,
        // but shouldn't be inside document ready
    };

    $(document).ready(function () {
        $("#continue_shopping").click(function () {
            window.location.href = '<?= $link ?>';
        });

        history.pushState({}, '', '#');
    });

    $(window).load(function () {
        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'OrderOverviews', 'action' => 'deleteAllCart')); ?>",
            type: "Post",
            complete: function (result) {}
        });
    });
</script>