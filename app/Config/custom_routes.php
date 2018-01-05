<?php
Router::connect('/hq/Merchant1.com', array('controller' => 'hq', 'action' => 'merchant'));

Router::connect('/DelhiPizza', array('controller' => 'users', 'action' => 'store'));
Router::connect('/DelhiPizza/admin', array('controller' => 'stores', 'action' => 'store'));

Router::connect('/DunPizza', array('controller' => 'users', 'action' => 'store')); 
Router::connect('/DunPizza/admin', array('controller' => 'stores', 'action' => 'store'));
