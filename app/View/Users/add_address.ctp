<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/add_address'); break;
       case 4 : echo $this->element('design/oldlayout/innerpage/add_address'); break;
       default : echo $this->element('design/common/add_address');
   }
?>