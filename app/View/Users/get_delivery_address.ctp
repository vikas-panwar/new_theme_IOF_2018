<?php if (DESIGN == 1) { ?>
              
                    <div class="row-edit">
                        <label class="col-sm-3 col-form-label label-andy">Name:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['name_on_bell']); ?></p>
                    </div>
                    <div class="row-edit">
                        <label class="col-sm-3 col-form-label label-andy">Address:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['address']),(", "),($resultAddress['DeliveryAddress']['city']),(" "),($resultAddress['DeliveryAddress']['state']),(" "),($resultAddress['DeliveryAddress']['zipcode']); ?></p>
                    </div>
                    <!-- <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">City:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['city']); ?></p>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">State:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['state']); ?></p>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">Zip Code:</label>
                            <p><?php echo ($resultAddress['DeliveryAddress']['zipcode']); ?></p>
                    </div> -->
                    <div class="row-edit">
                        <label class="col-sm-3 col-form-label label-andy">Mobile Phone:</label>
                            <p><?php echo $resultAddress['CountryCode']['code'] . '' . $resultAddress['DeliveryAddress']['phone']; ?></p>
                    </div>
    
                    <div class="theme-btn-group" style="text-align:left; padding-top:30px">
                        <?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'updateAddress', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($resultAddress['DeliveryAddress']['id'])), array('class' => 'btn button-color2 button-size2_edit', 'escape' => false)); ?>
                        <?php echo $this->Html->link('Delete', array('controller' => 'users', 'action' => 'deleteDeliveryAddress', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($resultAddress['DeliveryAddress']['id'])), array('confirm' => __('Are you sure you want to delete this delivery address?'), 'class' => 'btn button-color3 button-size2_edit', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i>Add More Addresses', array('controller' => 'users', 'action' => 'addAddress', $encrypted_storeId, $encrypted_merchantId), array('class' => 'btn button-size2_edit2 btn-add-more-address', 'id' => 'addDeliveryaddress', 'escape' => false)) ?>
                    </a>
    
                    </div>

                    <?php  } else { ?>
    
    <div class="layout-container pages">
        <div class="layout-content2 hc vc bgcolor_white">
            <div class="form2-andy hc vc">
                <div class="form2-andy">
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">Name:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['name_on_bell']); ?></p>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">Address:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['address']),(", "),($resultAddress['DeliveryAddress']['city']),(" "),($resultAddress['DeliveryAddress']['state']),(" "),($resultAddress['DeliveryAddress']['zipcode']); ?></p>
                    </div>
                    <!-- <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">City:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['city']); ?></p>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">State:</label>
                            <p><?php echo ucfirst($resultAddress['DeliveryAddress']['state']); ?></p>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">Zip Code:</label>
                            <p><?php echo ($resultAddress['DeliveryAddress']['zipcode']); ?></p>
                    </div> -->
                    <div class="row">
                        <label class="col-sm-3 col-form-label label-andy">Mobile Phone:</label>
                            <p><?php echo $resultAddress['CountryCode']['code'] . '' . $resultAddress['DeliveryAddress']['phone']; ?></p>
                    </div>
                        <div class="hc vc tc btnBox-andy">
                        <div class="hc vc l uc btn-andy f16 bgcolor_theme1 w80">
                        <?php echo $this->Html->link($this->Html->tag('i', '') . 'Edit', array('controller' => 'users', 'action' => 'updateAddress', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($resultAddress['DeliveryAddress']['id'])), array('class' => '', 'escape' => false)); ?>
                        </div>
                        <div class="hc vc l uc btn-andy f16 bgcolor_theme1 w80">
                        <?php echo $this->Html->link($this->Html->tag('i', '') . 'Delete', array('controller' => 'users', 'action' => 'deleteDeliveryAddress', $encrypted_storeId, $encrypted_merchantId, $this->Encryption->encode($resultAddress['DeliveryAddress']['id'])), array('confirm' => __('Are you sure you want to delete this delivery address?'), 'class' => '', 'escape' => false)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php   } ?>
