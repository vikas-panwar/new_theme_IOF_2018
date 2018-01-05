<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/update_address'); break;
       case 4 : echo $this->element('design/oldlayout/innerpage/update_address'); break;
       default : echo $this->element('design/common/update_address');
   }
?>