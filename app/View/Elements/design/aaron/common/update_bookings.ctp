<div class="main-container">
    <div class="ext-menu-title">
        <h4><?php echo __('Make Reservation'); ?></h4>
    </div>

    <div class="layout-container pages">
    <div class="layout-content hc vc bgcolor_white">
        <div class="form hc vc">
    
        <?php //echo $this->Session->flash(); ?>
        
            <?php echo $this->Form->create('', array('url' => array('controller' => 'pannels', 'action' => 'updateBooking', $encrypted_bookId, $encrypted_storeId, $encrypted_merchantId))); ?>

            <?php echo $this->Form->input('Booking.id', array('type' => 'hidden', 'value' => $book['Booking']['id'])); ?>
            

            <div class="form-group row"><label class="col-sm-3 col-form-label">Store</label>
                <div class="col-sm-9"> 
                <?php
                if ($store) {
                    echo "<span class='store_name'>" . $store['Store']['store_name'] . "</span>";
                } else {
                    echo 'Dine-In Reservation';
                }
                ?></div></div>
            
            <div class="form-group row"><label class="col-sm-3 col-form-label">Person <em>*</em></label>
                <div class="col-sm-9"><?php echo $this->Form->input('Booking.number_person', array('type' => 'select', 'class' => 'form-control', 'options' => $number_person, 'label' => false, 'div' => false, 'value' => $book['Booking']['number_person'])); ?></div></div>
                    
            <div class="form-group row"><label class="col-sm-3 col-form-label">Reservation Date <em>*</em></label>
                <div class="col-sm-9"><?php
                        $book_date = date('m-d-Y', strtotime($book['Booking']['reservation_date']));
                        $pickupHour = date('H', strtotime($book['Booking']['reservation_date']));
                        $pickupMinute = date('i', strtotime($book['Booking']['reservation_date']));
                        echo $this->Form->input('Booking.start_date', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Reservation Date', 'label' => false, 'div' => false, 'readOnly' => true, 'value' => $book_date));
                        ?>
                        <input type="hidden" id="osPickupHour" value="<?php echo $pickupHour; ?>"/>
                        <input type="hidden" id="osPickupMinute" value="<?php echo $pickupMinute; ?>"/>
                    </div>
            </div>

            <div class="form-group row"><label class="col-sm-3 col-xs-12 col-form-label">Reservation Time <em>*</em></label>
                <div id="resv">
                    <select id="BookingStartTime" class="inbox form-control" name="data[Booking][start_time]"></select>
                        <div class="col-sm-4 col-xs-6">Hour <em>*</em>
                            <input type="hidden" id="osPickupHour" value="<?php echo $pickupHour; ?>"/></div>
                            
                        <div class="col-sm-5 col-xs-6">Minute <em>*</em>
                            <input type="hidden" id="osPickupMinute" value="<?php echo $pickupMinute; ?>"/></div>               
                </div>
            </div>
                   
            <div class="form-group row"><label class="col-sm-3 col-form-label">Special Request <em>*</em></label>
                <div class="col-sm-9"><?php echo $this->Form->input('Booking.special_request', array('type' => 'textarea', 'class' => 'user-detail-large form-control', 'placeholder' => 'Enter Special Request', 'maxlength' => '50', 'label' => false, 'div' => false, 'value' => $book['Booking']['special_request']));?>
                </div>
            </div>
                
            <div class="clearfix">
                <div class="hc vc tc">
                    <?php
                    echo $this->Form->button('Request', array('type' => 'submit', 'class' => 'uc button f18 bgcolor_focus w260','id'=>'saveReservation'));
                    echo $this->Form->button('Cancel', array('type' => 'button', 'onclick' => "window.location.href='/pannels/myBookings/$encrypted_storeId/$encrypted_merchantId'", 'class' => 'uc button f18 bgcolor_default w260'));
                    ?>
                </div>
            </div>   
            <?php echo $this->Form->end(); ?>

        </div>
    </div>
</div></div></div></div>

<script>
    $(document).ready(function () {
        function getTime(date, orderType, preOrder, returnspan, ortype) {
            var type1 = 'Store';
            var type2 = 'pickup_time';
            var type3 = ortype;
            var storeId = '<?php echo $encrypted_storeId; ?>';
            var merchantId = '<?php echo $encrypted_merchantId; ?>';
            $.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'getStoreTime')); ?>",
                type: "post",
                data: {storeId: storeId, merchantId: merchantId, date: date, type1: type1, type2: type2, type3: type3, orderType: orderType, preOrder: preOrder},
                success: function (result) {
                    $('#' + returnspan).html(result);
                    selectedTime();
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
                var array ='<?php echo json_encode($closedDay); ?>';
                return [array.indexOf(day) == -1];
            }
        });

        $(".date-select").datepicker("setDate", '<?php echo $currentDateVar; ?>');

        var date = '<?php echo $book_date; ?>';
        getTime(date, 1, 0, 'resv');

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
                data: {storeId: storeId, merchantId: merchantId, date: date, type1: type1, type2: type2, type3: type3, orderType: orderType, preOrder: preOrder},
                success: function (result) {
                    $('#resv').html(result);
                }
            });
        });

        $("#OrderItemUpdateBookingForm").validate({
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
        $(document).on('click', '#saveReservation', function (e) {
            e.stopImmediatePropagation();
            if ($("#OrderItemUpdateBookingForm").valid()) {
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
    function selectedTime() {
        var StorePickuphour = $("#osPickupHour").val();
        var StorePickupmin = $("#osPickupMinute").val();
        setTimeout(function () {
            $("#StorePickuphour").val(StorePickuphour);
            $('#StorePickuphour').trigger('change');
            $("#StorePickupmin").val(StorePickupmin);
            if ($("#StorePickupmin").val() === "") {
                $("#StorePickupmin").val($("#StorePickupmin option:first").val());
            }
        }, 500);
    }
</script>