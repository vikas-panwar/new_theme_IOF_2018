<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->
<div class="ext-menu-title">
    <h4>Sign-Up</h4>
</div>

<div class="layout-container pages">
    <div class="layout-content hc vc bgcolor_white">
        <div class="form hc vc">
            <?php
                echo $this->Form->create('Users', array('inputDefaults' => array('autocomplete' => 'off'), 'id' => 'UsersRegistration', 'class' => 'profile-detail'));
                echo $this->Form->input('User.role_id', array('type' => 'hidden', 'value' => 4));
                ?>
            <div class="form-group row"><label class="col-sm-3 col-form-label">First Name<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.fname', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter Your First Name', 'maxlength' => '20', 'label' => false, 'div' => false)); ?></div></div>
            <div class="form-group row"><label class="col-sm-3 col-form-label">Last Name<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.lname', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter Your Last Name', 'maxlength' => '20', 'label' => false, 'div' => false)); ?></div></div>
            <div class="form-group row"><label class="col-sm-3 col-form-label">Email<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.email', array('id' => 'oldemail', 'type' => 'user-detail', 'class' => 'form-control', 'placeholder' => 'Enter Your Email', 'maxlength' => '50', 'label' => false, 'div' => false, 'required' => true, 'autocomplete' => 'off')); ?></div></div>

            <div class="form-group row"><label class="col-sm-3 col-form-label">Password<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Your password', 'maxlength' => '20', 'label' => false, 'div' => false, 'required' => true, 'id' => 'signup_password', 'autocomplete' => 'off')); ?></div></div>
            <div class="form-group row"><label class="col-sm-3 col-form-label">Password Confirmation<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.password_match', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm Password', 'maxlength' => '20', 'label' => false, 'div' => false)); ?></div></div>

            <div class="form-group row"><label class="col-sm-3 col-xs-3 col-form-label">Mobile Phone<em>*</em></label>
                <div class="col-sm-3 col-xs-3"><?php echo$this->Form->input('User.country_code_id', array('type' => 'select', 'options' => $countryCode, 'class' => 'country-code form-control', 'label' => false, 'div' => false)); ?></div>
                <div class="col-sm-6 col-xs-6"><?php echo$this->Form->input('User.phone', array('data-mask' => 'mobileNo', 'type' => 'text', 'class' => 'phone form-control', 'placeholder' => 'Mobile Phone', 'label' => false, 'div' => false, 'required' => true));?></div>
            </div>

            <div class="form-group row"><label class="labeldefault col-sm-3 col-form-label">DOB<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.dateOfBirth', array('type' => 'text', 'class' => 'form-control date_select', 'placeholder' => 'Date of Birth', 'maxlength' => '12', 'label' => false, 'div' => false, 'required' => true, 'readOnly' => true)); ?></div></div>
            <div class="form-group row"><label class="labeldefault col-sm-3 col-form-label">City<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.city_id', array('type' => 'text', 'class' => 'form-control', 'maxlength' => '20', 'label' => false, 'div' => false, 'placeholder' => 'Enter City')); ?></div></div>
            <div class="form-group row"><label class="labeldefault col-sm-3 col-form-label">State<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.state_id', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false, 'placeholder' => 'Select State')); ?></div></div>
            <div class="form-group row"><label class="labeldefault col-sm-3 col-form-label">Zip<em>*</em></label>
                <div class="col-sm-9"><?php echo$this->Form->input('User.zip_id', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false, 'placeholder' => 'Enter Zip')); ?></div></div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <input class="" type="checkbox" id="privacy_policy" name="data[User][is_privacypolicy]" checked />
                    <label class="privacy_policy" for="privacy_policy" class="privacy-txt">Agree to our <a href="javascript:void(0)" class="termAndPolicy" data-name="Term">Terms of Use</a> &amp; <a href="javascript:void(0)" class="termAndPolicy" data-name="Policy">Privacy Policy</a> ?</label>
                    <span id="data[User][is_privacypolicy]-error" class="error" for="data[User][is_privacypolicy]"></span>
                </div>                
            </div>
            
            <div class="hc vc tc">
                <?php echo$this->Form->button('Sign Up', array('type' => 'submit', 'class' => 'hc uc button f18 bgcolor_focus w260')); ?>
                <?php echo$this->Form->button('Cancel', array('type' => 'button', 'onclick' => "window.location.href='/users/login'", 'class' => 'hc uc button f18 bgcolor_default w260')); ?>
            </div>

            <?php echo$this->Form->end(); ?>
        </div>

    </div>
</div>



<script>
    $(window).load(function () {
        // $('#oldemail').val('');
        // $('#signup_password').val('');
    });
    $(document).ready(function () {
        $(".phone").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $("[data-mask='mobileNo']").mask("(999) 999-9999");


        jQuery.validator.addMethod("passw", function (pass, element) {
            pass = pass.replace(/\s+/g, "");
            return this.optional(element) || pass.length > 7 &&
                    pass.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[A-Za-z\d$@$!%*#?& ]{8,}$/);
        }, "Atleast one digit, one upper and one lower case letter");

        jQuery.validator.addMethod("lettersonly", function (value, element)
        {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        }, "Letters and spaces only please");


        $('.date_select').datepicker({
            dateFormat: 'mm-dd-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2017',
        });
        $("#UsersRegistration").validate({
            debug: false,
            errorClass: "error",
            errorElement: 'span',
            onkeyup: false,
            rules: {
                "data[User][fname]": {
                    required: true,
                    lettersonly: true,
                },
                "data[User][lname]": {
                    required: true,
                    lettersonly: true,
                },
                "data[User][email]": {
                    required: true,
                    email: true,
                    remote: "/users/checkStoreEndUserEmail"
                },
                "data[User][password]": {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    passw: true,
                },
                "data[User][password_match]": {
                    required: true,
                    equalTo: "#signup_password",
                },
                "data[User][phone]": {
                    required: true
                }, "data[User][dateOfBirth]": {
                    required: false,
                }, "data[User][is_privacypolicy]": {
                    required: true,
                },
                "data[User][state_id]": {
                    required: true
                },
                "data[User][city_id]": {
                    required: true
                },
                "data[User][zip_id]": {
                    required: true
                }
            },
            messages: {
                "data[User][fname]": {
                    required: "Please enter your first name",
                    lettersonly: "Only alphabates are allowed",
                },
                "data[User][lname]": {
                    required: "Please enter your last name",
                    lettersonly: "Only alphabates are allowed",
                },
                "data[User][email]": {
                    required: "Please enter your email",
                    email: "Please enter valid email",
                    remote: "Email already exists",
                },
                "data[User][password]": {
                    required: "Please enter your password",
                    minlength: "Password must be at least 8 characters",
                    maxlength: "Please enter no more than 20 characters",
                    passw: "Atleast one digit, one upper and one lower case letter"
                },
                "data[User][password_match]": {
                    required: "Please enter your password again",
                    equalTo: "Password not matched",
                },
                "data[User][phone]": {
                    required: "Contact number required",
                },
                "data[User][is_privacypolicy]": {
                    required: "Please agree to our Terms of use & Privacy policy.",
                }, "data[User][state_id]": {
                    required: "Please select State"
                }, "data[User][city_id]": {
                    required: "Please enter City"
                }, "data[User][zip_id]": {
                    required: "Please enter Zipcode"
                },
            }, highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
        });
        //        jQuery(document).on('change', '#UserStateId', function () {
        //            var state_id = jQuery(this).val();
        //            jQuery.post("/users/city", {'state_id': state_id}, function (data) {
        //                $(".city-sel").html(data);
        //            });
        //        });
        //        jQuery(document).on('change', '#UserCityId', function () {
        //            var state_id = jQuery("#UserStateId").val();
        //            var city_id = jQuery(this).val();
        //            jQuery.post("/users/zip", {'state_id': state_id, 'city_id': city_id}, function (data) {
        //                $(".zip-sel").html(data);
        //            });
        //        });
    });
    $(function () {
        $("#UserFname").focus();
    });
    $(document).ready(function () {
        $("#UserStateId").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'hqusers', 'action' => 'getState')); ?>",
            minLength: 1,
            select: function (event, ui) {
                console.log(ui.item.value);
            }
        });
    });
</script>