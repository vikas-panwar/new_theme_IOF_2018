<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/rating'); break;
       case 4 : echo $this->element('design/oldlayout/innerpage/rating'); break;
       default : echo $this->element('design/common/rating');
   }
?>