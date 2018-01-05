<?php
/**
 * Created by Charles.Lee
 * Date: 10/6/17
 * Time: 11:26 AM
 */
App::uses('AppHelper', 'View/Helper');
App::uses('Helper', 'View');

/**
 * Custom component
 */
class MenuHelper extends AppHelper {

    public $helpers = array('Encryption','Html','Session');

    public function active($data, $menu_name) {

        if (($data['controller'] == 'users' && $data['action'] == "login" && $menu_name == "HOME")) return "active";
        if (($data['controller'] == 'pannels' || $data['controller'] == 'Pannels')) {
            if($data['action'] == 'allReviews' && $menu_name == "REVIEWS") return "active";
            if($data['action'] == 'myBookings' && $menu_name == "RESERVATIONS") return "active";
            if($data['action'] == 'orderImages' && $menu_name == "GALLERY") return "active";
            if($data['action'] == 'staticContent' && $data['pass'][3] === $menu_name ) return "active";
        }
        if (($data['controller'] == 'deals' || $data['controller'] == 'Deals')) {
            if($data['action'] == 'index' && $menu_name == "DEALS" ) return "active";
        }
        if (($data['controller'] == 'users' || $data['controller'] == 'Users') || $this->params['controller'] == 'products') {
            if($data['action'] == 'storeLocation' && $menu_name == "STORE INFO"  ) return "active";
            if($data['action'] == 'items' && $menu_name == "MENU"  ) return "active";
        }
    }

    public function link($menu_name, $is_booking_open) {
        $logined = $this->Session->read('Auth.User.id');
        $encrypted_storeId = $this->Encryption->encode($this->Session->read('store_id'));
        $encrypted_merchantId = $this->Encryption->encode($this->Session->read('merchant_id'));
        switch ($menu_name) {
            case 'HOME' : return '<a href = "/users/login">HOME</a>';
            case 'REVIEWS' :
                return $this->Html->link($menu_name, array('controller' => 'pannels', 'action' => 'allReviews'));
            case 'DEALS' : return $this->Html->link(__('DEALS'), array('controller' => 'deals', 'action' => 'index'));
            case 'RESERVATIONS' :
                if(!$logined) return;
                if(!$is_booking_open) return;
                return $this->Html->link($menu_name, array('controller' => 'pannels', 'action' => 'myBookings', $encrypted_storeId, $encrypted_merchantId));
            case 'STORE INFO' :
                return '<a href="/users/storeLocation/'. $encrypted_storeId.'/'.$encrypted_merchantId.'">STORE INFO</a>';
            case 'MENU' :
                return '<a href="/products/items/'. $encrypted_storeId.'/'.$encrypted_merchantId.'">MENU</a>';
            case 'GALLERY' :
                return $this->Html->link($menu_name, array('controller' => 'pannels', 'action' => 'orderImages', $encrypted_storeId, $encrypted_merchantId));
            case 'PLACE ORDER' or 'PHOTO' : return '';
            default :
                return $this->Html->link($menu_name, array('controller' => 'pannels', 'action' => 'staticContent', $encrypted_storeId, $encrypted_merchantId, $encrypted_merchantId), $menu_name);
        }
    }
}
