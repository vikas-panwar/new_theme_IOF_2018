<?php
   switch (DESIGN) {
       case 1 : echo $this->element('design/aaron/common/fetch_product_size'); break;
       case 4 : echo $this->element('design/oldlayout/product/fetch_product_size'); break;
       default : echo $this->element('design/common/fetch_product_size');
   }
?>