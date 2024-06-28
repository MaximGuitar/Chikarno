<?php
namespace Placestart\Shop;

use Placestart\Shop\Cart;
use Valitron\Validator;

/**
 * Класс для создания ajax api к корзине
*/
class CartAjaxApi{
    private Cart $cart;

    public static string $refreshEvent = "refresh-cart-items";

    /**
     * @var string $cartID ID корзины, для которого создается апи
     */
    public function __construct(string $cartID = DEFAULT_CART_ID){
        $this->cart = new Cart($cartID);

        add_action('wp_ajax_refresh_cart', [$this, 'refreshCart']);
        add_action('wp_ajax_nopriv_refresh_cart', [$this, 'refreshCart']);

        add_action('wp_ajax_add_to_cart', [$this, 'addToCart']);
        add_action('wp_ajax_nopriv_add_to_cart', [$this, 'addToCart']);

        add_action('wp_ajax_set_count', [$this, 'setCount']);
        add_action('wp_ajax_nopriv_set_count', [$this, 'setCount']);

        add_action('wp_ajax_remove_product', [$this, 'removeFromCart']);
        add_action('wp_ajax_nopriv_remove_product', [$this, 'removeFromCart']);

        add_action('wp_ajax_update_count_or_add', [$this, 'updateCountOrAdd']);
        add_action('wp_ajax_nopriv_update_count_or_add', [$this, 'updateCountOrAdd']);
    }

    /**
     * Обновляет список товаров в корзине
    */
    public function refreshCart(){
        $cart_items = $this->cart->getCartItems();
        
        foreach ($cart_items as $cart_item_id => $item){
            get_template_part("components/cart/cart-item", null, [
                "cart_item_id" => $cart_item_id,
                "cart_item" => $item
            ]);
        }
        wp_die();
    }

    /**
     * Добавляет новую позицию в корзину
     */
    function addToCart(){
        $v = new Validator(["product_id" => $_REQUEST["product_id"]]);
        $v->rule("required", "product_id");
        $v->rule("integer", "product_id");
        if (!$v->validate()){
            wp_die();
        }
    
        $this->cart->addItem($_REQUEST["product_id"]);
        $items = $this->cart->getCartItems();
        $total_price = $this->cart->getTotalPrice();
    
        get_template_part("components/cart/total-cart-price", null, [
            "price" => $total_price
        ]);
    
        get_template_part("components/cart/total-cart-count", null, [
            "count" => count($items)
        ]);
        
        $this->cart->save();
        header("HX-Trigger: " . self::$refreshEvent);
        wp_die();
    }

    /**
     * Если товар с переданным id существует в корзине, то изменяет его количество, если нет - добавляет его
    */
    function updateCountOrAdd(){
        $v = new Validator($_REQUEST);
        $v->rule("required", ["product_id"]);
        $v->rule("integer", ["product_id"]);
        if (!$v->validate()){
            wp_die();
        }

        $product_id = (int) $_REQUEST["product_id"];

        $cart_item = $this->cart->getByProductId($product_id);
        if ($cart_item){
            $cart_item->setCount($cart_item->getCount() + 1);
        } else {
            $this->cart->addItem($product_id);
        }

        $items = $this->cart->getCartItems();
        $total_price = $this->cart->getTotalPrice();

        get_template_part("components/cart/total-cart-price", null, [
            "price" => $total_price
        ]);
    
        get_template_part("components/cart/total-cart-count", null, [
            "count" => count($items)
        ]);

        $this->cart->save();
        header("HX-Trigger: " . self::$refreshEvent);
        wp_die();
    }

    /**
     * Удаляет позицию из корзины
     */
    public function removeFromCart(){
        $v = new Validator(["product_id" => $_REQUEST["product_id"]]);
        $v->rule("required", "product_id");
        $v->rule("integer", "product_id");
        if (!$v->validate()){
            wp_die();
        }

        $this->cart->removeItem($_REQUEST["product_id"]);
        $items = $this->cart->getCartItems();
        $total_price = $this->cart->getTotalPrice();

        get_template_part("components/cart/total-cart-price", null, [
            "price" => $total_price
        ]);

        get_template_part("components/cart/total-cart-count", null, [
            "count" => count($items)
        ]);

        $this->cart->save();
        header("HX-Trigger: " . self::$refreshEvent);
        wp_die();
    }

    /**
     * Изменяет количество товара в корзине по id позиции
    */
    function setCount(){
        $v = new Validator($_REQUEST);
        $v->rule("required", ["cart_item_id", "count"]);
        $v->rule("integer", ["cart_item_id", "count"]);
        if (!$v->validate()){
            wp_die();
        }
    
        $cart_item_id = (int) $_REQUEST["cart_item_id"];
        $count = (int) $_REQUEST["count"];
    
        $cart_item = $this->cart->getByItemId($cart_item_id);
        if (!$cart_item){
            wp_die();
        }
        
        $cart_item->setCount($count);
        $items = $this->cart->getCartItems();
        $total_price = $this->cart->getTotalPrice();
    
        get_template_part("components/cart/total-cart-price", null, [
            "price" => $total_price
        ]);
    
        get_template_part("components/cart/total-cart-count", null, [
            "count" => count($items)
        ]);
    
        $this->cart->save();
        wp_die();
    }
}