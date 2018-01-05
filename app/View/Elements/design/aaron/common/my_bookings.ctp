<?php
$storeId = $this->Session->read('store_id');
$url = HTTP_ROOT;
$imageurl = HTTP_ROOT . 'storeLogo/' . $store_data_app['Store']['store_logo'];
?>
<?php if (DESIGN == 3) { ?>
    <div class = "title-bar"> <?php echo __('Make Reservation'); ?> </div>
<?php }
?>
<div class="layout-container pages">
    <div class="layout-content hc vc bgcolor_white">
        <div class="form hc vc">
    <?php //echo $this->Session->flash(); ?>

            <?php echo $this->Form->create('', array('id' => 'BookingForm', 'url' => array('controller' => 'pannels', 'action' => 'myBookings', $encrypted_storeId, $encrypted_merchantId))); ?>
            <?php if (!empty($authUrl)) { ?>

                    <div class="r">

                        <a href='javascript:poptastic("<?php echo $authUrl; ?>");'>Allow Calendar Sync <i class="fa fa-info-circle" data-toggle="tooltip" title="Allow calendar sync to google."></i></a>

                    </div>

                    <br/>
                    <br/>

            <?php } ?>

            <div class="form-group row"><label class="col-sm-3 col-form-label">Person <em>*</em></label>
                <div class="col-sm-9"><?php echo $this->Form->input('Booking.number_person', array('type' => 'select', 'class' => 'form-control', 'options' => $number_person, 'label' => false, 'div' => false)); ?></div></div>

            <div class="form-group row"><label class="col-sm-3 col-form-label">Reservation Date <em>*</em></label>
                <div class="col-sm-9"><?php echo $this->Form->input('Booking.start_date', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Reservation Date', 'label' => false, 'div' => false, 'readOnly' => true)); ?></div></div>

            <div class="form-group row"><label class="col-sm-3 col-xs-12 col-form-label">Reservation Time</label>
                <div id="resv">
                    <div class="col-sm-4 col-xs-6">Hour <em>*</em>
                    <?php echo $this->Form->input('Store.pickup_hour', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'div' => false, 'empty' => 'Select Hour')); ?></div>

                    <div class="col-sm-5 col-xs-6">Minute <em>*</em>
                    <?php echo $this->Form->input('Store.pickup_minute', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'div' => false, 'empty' => 'Select Minute')); ?> </div>
                </div>
            </div>



            <div class="form-group row"><label class="col-sm-3 col-form-label">Special Request <em>*</em></label>
            <div class="col-sm-9"><?php echo $this->Form->input('Booking.special_request', array('type' => 'textarea', 'class' => 'user-detail-large form-control', 'placeholder' => 'Enter Special Request', 'maxlength' => '50', 'label' => false, 'div' => false)); ?></div>
            </div>

            <div class="clearfix">
                    <div class="hc vc tc">
                        <?php echo $this->Form->button('Reserve', array('type' => 'submit', 'class' => 'uc button f18 bgcolor_focus w260', 'id' => 'saveReservation')); ?>
                        <?php echo $this->Form->button('Cancel', array('type' => 'button', 'onclick' => "window.location.href='/users/login'", 'class' => 'uc button f18 bgcolor_default w260')); ?>
                    </div>
            </div>
            <?php echo $this->Form->end(); ?>


        </div>
    </div>
    <div class="layout-content table hc vc bgcolor_white">
        <?php echo $this->Form->create('MyBooking', array('url' => array('controller' => 'pannels', 'action' => 'myBookings'), 'id' => '', 'class' => '', 'type' => 'get')); ?>
        <div class="form-group row">
            <?php echo $this->element('userprofile/filter_reservation'); ?>
            <div class="col-sm-2 col-xs-6 hc vc"><?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'uc f16 button bgcolor_theme1 w100p')); ?></div>
            <div class="col-sm-2 col-xs-6 hc vc"><?php echo $this->Html->link('Clear', array('controller' => 'pannels', 'action' => 'myBookings', 'clear'), array('class' => 'uc f16 button2 bgcolor_theme1 w100p')); ?></div>
        </div>
    </div>
    <div class="layout-content table hc bgcolor_white">
        <div class="pagination-section clearfix">
            <?php echo $this->element('pagination') ?>
        </div>
        <div class="table-class responsive-table">
            <table id="table" class="table ">
                <thead>
                <tr>
                    <th class="text-center"><?php echo __('No. of person'); ?></th>
                    <th class="text-center"><?php echo __('Reservation Date/Time'); ?></th>
                    <th class="text-center"><?php echo __('Store'); ?></th>
                    <th class="text-center"><?php echo __('Status'); ?></th>
                    <th class="text-center"><?php echo __('Action'); ?></th>
                    <th class="text-center">Share</th>
                </tr>
                </thead>



                <?php
                if (!empty($myBookings)) {
                    foreach ($myBookings as $book) {
                        $today = date('Y-m-d');
                        $booking = date('Y-m-d', strtotime($book['Booking']['reservation_date']));
                            echo '<tr>';
                        ?>
                        <td class="text-center"><?php echo $book['Booking']['number_person']; ?></td>
                        <td class="text-center">
                            <?php
//                                    echo $book_date = $this->Common->storeTimeFormateUser($book['Booking']['reservation_date'], true);
//                                    $book_date2 = date('M d Y -  H:i a', strtotime($this->Common->storeTimeZoneUser('', $book['Booking']['reservation_date'])));
//
                            ?>
                            <?php echo $book_date2 = $this->Common->storeTimeFormateUser($this->Common->storeTimeZoneUser('', $book['Booking']['reservation_date']), true); ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if (!empty($book['Store'])) {
                                echo $book['Store']['store_name'];
                            }
                            ?> </td>
                        <td class="text-center"><?php echo $book['BookingStatus']['name']; ?> </td>
                        <?php
                        if (!empty($storeId)) {
                            if ($book['Booking']['store_id'] == $storeId) {
                                if ($today < $booking) { // future
                                    echo '<td class="text-center">' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-times')) . '', array('controller' => 'pannels', 'action' => 'cancelBooking', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($book['Booking']['id'])), array('confirm' => __('Are you sure you want to cancel this booking?'), 'class' => 'delete', 'escape' => false)) . " " .
                                    $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-pencil')) . '', array('controller' => 'pannels', 'action' => 'updateBooking', $this->Encryption->encode($book['Booking']['id']), $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($book['Booking']['id'])), array('escape' => false)) . '</td>';
                                } else if ($today == $booking) { //present
                                    echo '<td class="text-center">' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-times')) . '', array('controller' => 'pannels', 'action' => 'cancelBooking', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($book['Booking']['id'])), array('confirm' => __('Are you sure you want to cancel this booking?'), 'class' => 'delete', 'escape' => false)) . " " .
                                    $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-pencil')) . '', array('controller' => 'pannels', 'action' => 'updateBooking', $this->Encryption->encode($book['Booking']['id']), $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($book['Booking']['id'])), array('escape' => false)) . '</td>';
                                } else {
                                    echo '<td class="text-center">' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-trash-o')) . '', array('controller' => 'pannels', 'action' => 'deleteBooking', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($book['Booking']['id'])), array('confirm' => __('Are you sure you want to delete this booking?'), 'class' => 'delete', 'escape' => false)) . ' </td>';
                                }
                            } else {
                                ?>
                                <td class="text-center"><?php echo "-" ?>-</td>
                                <?php
                            }
                        }
                        ?>
                        <td  class="text-center">
                            <?php
                            $strDomainUrl = $_SERVER['HTTP_HOST'];
                            $strShareLink = "https://www.facebook.com/sharer/sharer.php?u=" . $strDomainUrl;
                            ?>
                            <a href="#" onclick='window.open("<?php echo $strShareLink; ?>", "", "width=500, height=300");'>
                                <?php echo $this->Html->image('1_sns_facebook.png', array('alt' => 'fbshare')); ?>
                            </a>
                            <a target="blank" href= "http://twitter.com/share?text=I reserved table for <?php echo $book['Booking']['number_person']; ?> at <?php echo $_SESSION['storeName']; ?> on <?php echo $book_date2; ?>&url=<?php echo $url; ?>&via=<?php echo $_SESSION['storeName']; ?>">
                                <?php echo $this->Html->image('1_sns_twitter.png', array('alt' => 'twshare')); ?>
                            </a>
                        </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td class="text-center" colspan="6">' . __('No reservation request found') . '</td></tr>';
                }
                ?>
            </table>
        </div>
        <div class="pagination-section clearfix">
            <?php echo $this->element('pagination') ?>
        </div>
        <?php echo $this->Form->end(); ?>
        <div class="bgcolor-white h70"></div>
    </div>


</div>
<?php
echo $this->Html->css('pagination');
?>
<script>
    function poptastic(url) {
        var newWindow = window.open(url, 'name', 'height=600,width=450');
        if (window.focus) {
            newWindow.focus();
        }
    }
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $("#MerchantLock").change(function () {
            $("#AdminId").submit();
        });
        function getTime(date, orderType, preOrder, returnspan, ortype) {
            var orderType = 1; // 3= Dine-in/Booking
            var preOrder = 0;
            var type1 = 'Booking';
            var type2 = 'start_time';
            var type3 = 'BookingStartTime';
            var storeId = '<?php echo $encrypted_storeId; ?>';
            var merchantId = '<?php echo $encrypted_merchantId; ?>';
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'getStoreTime')); ?>",
                type: "post",
                data: {storeId: storeId, merchantId: merchantId, date: date, type1: type1, type2: type2, type3: type3, orderType: orderType, preOrder: preOrder},
                success: function (result) {
                    $('#' + returnspan).html(result);
                }
            });
        }
        $(function () {
            $("#MyBookingFromDate, #MyBookingToDate").datepicker({dateFormat: 'yy-mm-dd'});
        });
        $('#BookingStartDate').datepicker({
            dateFormat: 'mm-dd-yy',
            minDate: '<?php echo $currentDateVar; ?>',
            maxDate: <?php echo!empty($store_data['Store']['calendar_limit']) ? "'+" . ($store_data['Store']['calendar_limit']) . "D'" : '+6D' ?>,
            beforeShowDay: function (date) {
                var day = date.getDay();
                var array = '<?php echo json_encode($closedDay); ?>';
                return [array.indexOf(day) == -1];
            }
        });
        //$(".date-select").datepicker("setDate", '<?php echo $currentDateVar; ?>');
        //var date = '<?php echo $currentDateVar; ?>';
        //getTime(date, 1, 0, 'resvTime');
        $('#BookingStartDate').on('change', function () {
            var date = $(this).val();
            var orderType = 1; // 3= Dine-in/Booking
            var preOrder = 0;
            var type1 = 'Booking';
            var type2 = 'start_time';
            var type3 = 'BookingStartTime';
            var storeId = '<?php echo $encrypted_storeId; ?>';
            var merchantId = '<?php echo $encrypted_merchantId; ?>';
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'getStoreTime')); ?>",
                type: "Post",
                dataType: 'html',
                async: false,
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
                data: {storeId: storeId, merchantId: merchantId, date: date, type1: type1, type2: type2, type3: type3, orderType: orderType, preOrder: preOrder},
                complete: function () {
                    $.unblockUI();
                },
                success: function (result) {
                    $('#resv').html(result);
                }
            });
        });
        $("#BookingForm").validate({
            debug: false,
            errorClass: "error",
            errorElement: 'span',
            onkeyup: false,
            rules: {
                "data[Booking][start_date]": {
                    required: true,
                }, "data[Booking][start_time]": {
                    required: true,
                }, "data[Store][pickup_hour]": {
                    required: true,
                }, "data[Store][pickup_minute]": {
                    required: true,
                }
            },
            messages: {
                "data[Booking][start_date]": {
                    required: "Please select booking date",
                }, "data[Booking][start_time]": {
                    required: "Please select booking time",
                }, "data[Store][pickup_hour]": {
                    required: "Please select reservation hour.",
                }, "data[Store][pickup_minute]": {
                    required: "Please select reservation minute.",
                }
            }, highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
        $('#MyBookingFromDate').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate) {
                $("#MyBookingToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#MyBookingToDate').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate) {
                $("#MyBookingFromDate").datepicker("option", "maxDate", selectedDate);
            }
        });
        $(document).on('click', '#saveReservation', function (e) {
            e.stopImmediatePropagation();
            if ($("#BookingForm").valid()) {
                $.blockUI({css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }});
            }
        });
    });
    if (window.opener && !window.opener.closed) {
        window.opener.popUpClosed();
    }
</script>
