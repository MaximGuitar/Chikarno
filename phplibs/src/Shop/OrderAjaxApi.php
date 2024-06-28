<?php

namespace Placestart\Shop;

use Placestart\Shop\Cart;
use Placestart\Shop\Order;
use Placestart\Utils\Mailer;

class OrderAjaxApi{
    private Cart $cart;

    function __construct(string $cartID = DEFAULT_CART_ID){
        $this->cart = new Cart($cartID);

        add_action('wp_ajax_create_order', [$this, 'createOrder']);
        add_action('wp_ajax_nopriv_create_order', [$this, 'createOrder']);
    }

    function createOrder(){
        $order = Order::createFromFields($_REQUEST);
        $result = [
            "status" => "success",
            "order" => $order
        ];

        if (!$order->validate()){
            $result['status'] = "not_valid";

            get_template_part("components/order/order-fields", null, $result);
            wp_die();
        }

        $mailer = new Mailer("Новый заказ", return_template_part("components/mail/order", null, [
            "order" => $order
        ]));
        $mail_result = $mailer->send();        
        if ($mail_result["status"] == "error"){
            $result["status"] = "mail_error";
            $result["error"] = $mail_result['error'];
        }


        get_template_part("components/order/order-fields", null, $result);
        wp_die();
    }
}