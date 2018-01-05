<?php if(DESIGN==1) { ?>
<div class="store-delivery-info">
    <h3>Delivery Address</h3>
    <p>
        <?php echo ucfirst($resultAddress['DeliveryAddress']['name_on_bell']); ?>
    </p>
    <p>
        <?php echo ucfirst($resultAddress['DeliveryAddress']['address']); ?>
    </p>
    <p>
        <?php echo ucfirst($resultAddress['DeliveryAddress']['city']); ?>,<?php echo ucfirst($resultAddress['DeliveryAddress']['state']); ?>
        <?php echo $resultAddress['DeliveryAddress']['zipcode']; ?>
    </p>
    <p>
        Tel: <?php echo $resultAddress['CountryCode']['code'] . '' . $resultAddress['DeliveryAddress']['phone']; ?>
    </p>
</div>
<?php } else { ?>
<li>
    <label>Name</label>
    <?php echo ucfirst($resultAddress['DeliveryAddress']['name_on_bell']); ?>
</li>
<li>
    <label>Address</label>
    <?php echo ucfirst($resultAddress['DeliveryAddress']['address']); ?>
</li>
<li>
    <label>City</label>
    <?php echo ucfirst($resultAddress['DeliveryAddress']['city']); ?>
</li>
<li>
    <label>State</label>
    <?php echo ucfirst($resultAddress['DeliveryAddress']['state']); ?>
</li>
<li>
    <label>Zip Code</label>
    <?php echo $resultAddress['DeliveryAddress']['zipcode']; ?>
</li>
<li>
    <label>Ph no.</label>
    <?php echo $resultAddress['CountryCode']['code'] . '' . $resultAddress['DeliveryAddress']['phone']; ?>
</li>
<?php }?>