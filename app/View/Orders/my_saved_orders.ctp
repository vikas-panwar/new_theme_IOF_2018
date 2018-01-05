<?php
   switch (DESIGN) {
        case 1 : echo $this->element('design/aaron/common/my_saved_orders'); break;
        case 4 : echo $this->element('design/oldlayout/innerpage/my_saved_orders'); break;
        default : echo $this->element('design/common/my_saved_orders');
    }
?>