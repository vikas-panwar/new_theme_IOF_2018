<?php
   switch (DESIGN) {
       case 1 :
           echo '<div class="ext-menu"><div class="ext-menu-title"><h4>Reservation</h4></div></div>';
           echo $this->element('design/aaron/common/my_bookings'); break;
       case 2 :
           if($store_data_app['Store']['store_theme_id']==14) echo '<div class="ext-menu theme-bg-2">';
           else echo '<div class="ext-menu">';
       case 4 : $this->element('design/oldlayout/innerpage/my_bookings');
           echo '<div class="main-container"><div class="ext-menu-title"><h4>RESERVATIONS</h4></div></div></div>';
       default : echo $this->element('design/common/my_bookings');
   }
?>