<div id="fb-root"></div>
<div class="main-container">
    <div class="ext-menu-title">
        <h4>My Billing Information</h4>
    </div>

    <div class="layout-container pages titlemargin">
        <div class="layout-content hc vc bgcolor_white">
                <div class="form hc vc">

                    <?php echo $this->Session->flash(); ?>

                    <!-- FORM VIEW -->
                    <?php echo $this->Form->create('', array('id'=>'BookingForm','url'=>array('controller'=>'pannels','action'=>'myBillingInfo',$encrypted_storeId,$encrypted_merchantId))); ?>
                    <br>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">Card Number</label>
                        <div class="col-md-9"><?=$nzsafe_info['cc_number']?></div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-3 col-form-label fw700">Expiration Date </label>
                            <div class="col-md-9"><?=$nzsafe_info['cc_exp']?></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">Address</label>
                            <div class="col-md-9"><?=$nzsafe_info['address_1']?></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">City</label>
                            <div class="col-md-9"><?=$nzsafe_info['city']?></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">First Name</label>
                            <div class="col-md-9"><?=$nzsafe_info['first_name']?></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">Last Name</label>
                            <div class="col-md-9"><?=$nzsafe_info['last_name']?></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">State</label>
                            <div class="col-md-9"><?=$nzsafe_info['state']?></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label fw700">Zip-Code</label>
                            <div class="col-md-9"><?=$nzsafe_info['postal_code']?></div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label><div class="col-md-9"><img src="../../../img/checkmark_25x25.png" class="checkmark-image">You stored this billing information during the last check out process.</div>          
                    </div>    
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label><div class="col-md-9"><img src="../../../img/checkmark_25x25.png" class="checkmark-image">Your credit card information is securely encrypted and stored in NZ Safe.</div>          
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label><div class="col-md-9"><img src="../../../img/checkmark_25x25.png" class="checkmark-image">NZ Safe is a safe and secure feature of NZ Gateway which fully supports the latest PCI security standard–PCI DSS.</div>          
                    </div>
                    

                    <div id=delete-button>
                    <?php
                            if($nzsafe_info['customer_vault_id']) {
                                $link_tag = $this->Html->link($this->Html->tag('i','',
                    array('class'=>'fa fa-trash-o')).' Remove this from NZ Safe',
                    array('controller'=>'users','action'=>'deleteBillingInfo',$encrypted_storeId,$encrypted_merchantId,$nzsafe_info['customer_vault_id']),
                    array('confirm' => __('Are you sure you want to delete this Billing Information?'),'class'=>'delete','escape'=>false));
                    echo '<div class="">'.$link_tag.'</div>';
                    }
                    ?>

                </div>

                    </section>
                    <?php echo $this->Form->end(); ?>
                </div>
           </div>
        </div>
    </div>
    <div class='clr'></div>

</div>
</div>
<style>

    .checkmark{ display: inline-block !important;float: left;width: 12px !important;margin-right: 10px;margin-left: 10px;margin-top:3px;vertical-align: middle;margin-bottom: 5px;}
    .chk-span{display: inline-block !important;float: left;width: 90% !important;}
    .chk-wrap{margin-bottom: 15px !important;}

    .title{font-size:13px;}
    .title-var { font-size:14px;font-weight:lighter !important;}
    .subtitle {
        padding:2px;
        font-size:15px;
    }

    .form-layout ul li{
        min-height: 40px;
        margin-bottom: 0;
    }
</style>