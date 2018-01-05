<main class="main-body">
    <div class="ext-menu">
        <div class="ext-menu-title">
            <h4>Store Info</h4>
        </div>
        <div class="layout-container pages">
            <div class="layout-content hc vc bgcolor_white">
                <div class="form-info hc vc">
                    <div class="row form-storeinfo">
                        <div class="ext-menu-img">
                            <div class="emi-tbl">
                                <div class="emi-tbl-cell">
                                    <h3><?php echo $store_data['Store']['store_name']; ?></h3>
                                </div>
                                <div class="emi-tbl-cell">
                                    <?php echo $store_data['Store']['store_info_description']; ?>
                                </div>
                            </div>

                            <div class="emi-overlay"></div>
                            <?php
                            if (!empty($store_data['Store']['store_info_bg_image'])) {
                                $image = "/storeBackground-Image/" . $store_data['Store']['store_info_bg_image'];
                            } else {
                                $image = "/img/store-mid-banner.png";
                            }
                            ?>
                            <img src="<?php echo $image; ?>">
                        </div>
                    </div>
                    <div class="mapsize-storeinfo" id="map">
                        <img src="/img/store-mid-banner.png">
                    </div>
                    <div class="scott-contact-info pleft0 col-md-6 col-xs-12">
                        <div class="f24 m-storeinfo">Contact Info</div>
                        <p class="m0"><?php echo $store_data['Store']['address']; ?></p>
                        <p class="m0"><?php echo $store_data['Store']['city'] . ', ' . $store_data['Store']['state'] . ' ' . $store_data['Store']['zipcode']; ?></p>
                        <p class="m0"><?php echo $store_data['Store']['phone']; ?></p>
                        <p class="m0"><?php
                            if (!empty($store_data['Store']['display_fax'])) {
                                echo "Fax: " . $store_data['Store']['display_fax'];
                            }
                            ?></p>
                        <p class="m0"><?php
                            if (!empty($store_data['Store']['display_email'])) {
                                echo $store_data['Store']['display_email'];
                            }
                            ?></p>

                        <div class="f24 m-storeinfo">Opening Hours</div>
                        <ul class="time-list">
                            <?php
                            $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                            foreach ($days as $key => $value) {
                                ?>
                                <li class="clearfix">
                                    <span class="days">
                                        <?php echo $value; ?>
                                    </span>
                                    <span class="rgt-txt">
                                        <?php
                                        if ($availabilityInfo[$key]['StoreAvailability']['is_closed'] == 1) {
                                            echo "Closed";
                                        } else {
                                            echo $this->Common->storeTimeFormateUser($availabilityInfo[$key]['StoreAvailability']['start_time']) . " - ";
                                            if ($store_data['Store']['is_break_time'] == 1) {
                                                if ($store_data['Store']['is_break1'] == 1) {
                                                    if ($availabilityInfo[$key]['StoreBreak']['break1_start_time'] != $availabilityInfo[$key]['StoreBreak']['break1_end_time']) {
                                                        echo $this->Common->storeTimeFormateUser($availabilityInfo[$key]['StoreBreak']['break1_start_time']) . ",   ";
                                                        echo $this->Common->storeTimeFormateUser($availabilityInfo[$key]['StoreBreak']['break1_end_time']) . " - ";
                                                    }
                                                }
                                                if ($store_data['Store']['is_break2'] == 1) {
                                                    if ($availabilityInfo[$key]['StoreBreak']['break2_start_time'] != $availabilityInfo[$key]['StoreBreak']['break2_end_time']) {
                                                        echo $this->Common->storeTimeFormateUser($availabilityInfo[$key]['StoreBreak']['break2_start_time']) . ",   ";
                                                        echo $this->Common->storeTimeFormateUser($availabilityInfo[$key]['StoreBreak']['break2_end_time']) . " - ";
                                                    }
                                                }
                                            }
                                            echo $this->Common->storeTimeFormateUser($availabilityInfo[$key]['StoreAvailability']['end_time']);
                                        }
                                        ?>

                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <?php if (!empty($displayContactUsForm['StoreSetting']['display_contact_us_form'])) { ?>
                                <div class="message-form clearfix">
                                    <?php echo $this->Form->create('StoreInquiries', array('url' => array('controller' => 'customers', 'action' => 'contact_us'), 'inputDefaults' => array('label' => false, 'div' => false, 'required' => false, 'error' => false, 'legend' => false, 'autocomplete' => 'off'), 'id' => 'contactUs', 'enctype' => 'multipart/form-data')); ?>

                                    <div class="form-group row"><label class="col-sm-3 col-form-label">Name<em>*</em></label>
                                        <div class="col-sm-9">
                                            <?php echo $this->Form->input('StoreInquiries.name', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter your name', 'label' => false, 'div' => false)); ?>
                                        </div></div>


                                    <div class="form-group row"><label class="col-sm-3 col-form-label">Mobile Phone<em>*</em></label>
                                        <div class="col-sm-9">
                                            <?php echo $this->Form->input('StoreInquiries.phone', array('data-mask' => 'mobileNo', 'type' => 'text', 'class' => 'form-control pad-left-30 phone_number', 'placeholder' => 'Enter your phone', 'label' => false, 'div' => false)); ?>
                                        </div></div>


                                    <div class="form-group row"><label class="col-sm-3 col-form-label">Email<em>*</em></label>
                                        <div class="col-sm-9">
                                            <?php echo $this->Form->input('StoreInquiries.email', array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter your email', 'label' => false, 'div' => false)); ?>
                                        </div></div>

                                    <div class="form-group row"><label class="col-sm-3 col-form-label">Message<em>*</em></label>
                                        <div class="col-sm-9">
                                            <div class="input-group h90 col-md-12 col-xs-12">
                                                <?php echo $this->Form->input('StoreInquiries.message', array('type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Enter your message (Max Word 1200)', 'label' => false, 'div' => false, 'maxlength' => '1200')); ?>
                                            </div>
                                        </div>


                                        <div class="hc vc tc">
                                            <div class="info-button mtop20 col-md-4 col-xs-12 no-gutters">
                                                <?php echo $this->Form->button('Send Message', array('type' => 'submit', 'class' => 'm20 hc uc button f18 bgcolor_focus w260')); ?>
                                            </div>
                                        </div>

                                        <?php echo $this->Form->end(); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready(function () {
        $(".phone_number").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $("[data-mask='mobileNo']").mask("(999) 999-9999");
        $("#contactUs").validate({
            rules: {
                "data[StoreInquiries][name]": {
                    required: true,
                    lettersonly: true,
                },
                "data[StoreInquiries][email]": {
                    required: true,
                    email: true,
                },
                "data[StoreInquiries][message]": {
                    required: true,
                    maxlength: 1200
                },
                "data[StoreInquiries][phone]": {
                    required: true,
                }
            },
            messages: {
                "data[StoreInquiries][name]": {
                    required: "Please enter name.",
                },
                "data[StoreInquiries][email]": {
                    required: " Please enter email."
                },
                "data[StoreInquiries][message]": {
                    required: "Please enter message."
                },
                "data[StoreInquiries][phone]": {
                    required: " Please enter phone number."
                }
            }
        });
    });
</script>