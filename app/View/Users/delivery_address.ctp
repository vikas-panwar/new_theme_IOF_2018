<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/my_delivery_address'); break;
       case 4 : echo $this->element('design/oldlayout/innerpage/delivery_address'); break;
       default : echo $this->element('design/common/delivery_address');
   }
?>