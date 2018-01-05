<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/registration'); break;
       case 4 : echo $this->element('design/oldlayout/innerpage/registration'); break;
       default : echo $this->element('design/common/registration');
   }
?>