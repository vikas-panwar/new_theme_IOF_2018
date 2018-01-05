<?php
   switch (DESIGN) {
        case 1 : echo $this->element('design/aaron/common/my_coupons'); break;
        case 4 : echo $this->element('design/oldlayout/innerpage/my_coupons'); break;
        default : echo $this->element('design/common/my_coupons');
    }
?>