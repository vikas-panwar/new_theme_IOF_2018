<?php
if($itemList){     
   echo $this->Form->input('ItemOffer.item_id',array('type'=>'select','class'=>'form-control valid','label'=>'','div'=>false,'autocomplete' => 'off','options'=>$itemList)); 
}else{
   echo "No Item Available";   
}
?>
