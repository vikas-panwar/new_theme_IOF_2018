<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

        //$store_name=basename($_SERVER['REQUEST_URI']);
        //
        //$requestParam=explode('/',$_SERVER['REQUEST_URI']);        
        //if(count($requestParam)==2){
        //    echo "1";die;
        //    Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
        //    Router::connect('/'.$requestParam[1], array('controller' => 'users', 'action' => 'store'));
        //}elseif(count($requestParam)==3){
        //  echo "2";die;
        //    Router::connect('/'.$requestParam[1]."/admin", array('controller' => 'stores', 'action' => 'store'));
        //}
        //
        //Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));        
        //##DelhiPizza##start
        //Router::connect('/DelhiPizza', array('controller' => 'users', 'action' => 'store'));
        //Router::connect('/DelhiPizza/admin', array('controller' => 'stores', 'action' => 'store'));
        //##DelhiPizza##end
        //
        //##DunPizza##start
        //Router::connect('/DunPizza', array('controller' => 'users', 'action' => 'store')); 
        //Router::connect('/DunPizza/admin', array('controller' => 'stores', 'action' => 'store'));
        //##DunPizza##end
        //
        //require_once('storeredirect/store_url_redirect.php');
        //require $_SERVER['DOCUMENT_ROOT'].DS.'app/webroot'.DS.'storeredirect'.DS.'store_url_redirect.php';

        Router::connect('/gstationla.com', array('controller' => 'users', 'action' => 'store')); 
        Router::connect('/gstationla.com/admin', array('controller' => 'stores', 'action' => 'store')); 
        require $_SERVER['DOCUMENT_ROOT'].DS.APP_DIR.DS.'Config'.DS.'custom_routes.php';

        
        
        
        
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';