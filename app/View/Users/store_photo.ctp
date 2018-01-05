<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/store_photo'); break;
       case 4 : echo $this->element('design/oldlayout/innerpage/store_photo'); break;
       default : echo $this->element('design/common/store_photo');
   }
?>