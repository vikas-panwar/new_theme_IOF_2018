<?php
echo $this->Form->input('ItemOffer.category_id', array('type' => 'select', 'class' => 'form-control valid', 'label' => false, 'div' => false, 'autocomplete' => 'off', 'options' => @$categoryList, 'empty' => 'Select Category','required' => true,));
?>
