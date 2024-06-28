<?php
namespace Placestart\Shop;

use Placestart\Shop\CartItem;

/**
 * Корзина
*/
class Cart{
    private string $cartID = "";

    /**
     * Массив товаров в коризне
     * @var array<CartItem>
    */
    private array $cartItems = [];

    /** 
     * Счетчик ID элементов корзины
     * @var int
     */
    private int $cartIdCounter = 0;

    /**
     * @var string $cartID ID корзины, корзина будет сохраняться в куки с этим названием
    */
    function __construct(string $cartID = DEFAULT_CART_ID){
        $this->cartID = $cartID;

        $cookie = $this->getCartCookie();

        if ( isset($cookie["cartItems"]) && is_array($cookie["cartItems"]) ){
            $this->cartItems = $cookie["cartItems"];
        }

        if ( isset($cookie["cartIdCounter"]) ){
            $this->cartIdCounter = (int) $cookie["cartIdCounter"];
        }
    }

    /** 
     * Возвращает десериализованное значение из куки
    */
    private function getCartCookie(): array {
        $cart = $_COOKIE[$this->cartID] ?? [];

        if ( !empty( $cart ) ) {
            try {
                $cart = stripslashes($cart);
                $cart = unserialize( $cart );
                
                if ( is_array( $cart ) ) {
                    return $cart;
                }
            } catch (\Throwable $th) {
            }
        }

        return $cart;
    }

    /**
     * Добавляет новый товар в корзину
     * 
     * @var int $productID ID товара
     * @var int $count Изначально количество в корзине
     * @var array<string, mixed> $props Дополнительные свойства товара
    */
    public function addItem(int $productID, int $count = 1, array $props = []){
        $cartItem = new CartItem($productID, $count, $props);
        $this->cartIdCounter++;
        $this->cartItems[$this->cartIdCounter] = $cartItem;
        return $cartItem;
    }

    /**
     * @var int $itemID ID позиции в корзине
     */
    public function removeItem(int $itemId){
        if (isset($this->cartItems[$itemId])){
            unset($this->cartItems[$itemId]);
        }
    }

    /**
     * Возвращает массив товаров в корзине
     * @return array<int, CartItem>
    */
    public function getCartItems(): array{
        return $this->cartItems;
    }

    /**
     * Возвращает позицию в корзине по ее ID, если она есть
     * 
     * @return CartItem|null 
    */
    public function getByItemId(int $itemId){
        return $this->cartItems[$itemId] ?? null;
    }

    /**
     * Возвращает позицию в корзине по ID товара, если такой товар есть в корзине
     * 
     * @return CartItem|null 
    */
    public function getByProductId(int $productId){
        foreach($this->cartItems as $cart_item){
            if ($cart_item->getProduct()->getId() == $productId){
                return $cart_item;
            }
        }

        return null;
    }

    /**
     * Возвращает полную стоимость товаров в корзине
     * @return int
     */
    public function getTotalPrice(): int{
        $total_price = 0;
        foreach($this->cartItems as $cart_item){
            $price = $cart_item->getProduct()->getPrice() * $cart_item->getCount();
            $total_price += $price;
        }

        return $total_price;
    }

    /**
     * Сохранияет изменения, отправляет куки
    */
    public function save(){
        $result = [
            "cartItems" => $this->cartItems,
            "cartIdCounter" => $this->cartIdCounter
        ];

        setcookie($this->cartID, serialize($result), strtotime("+100 days"), "/");
    }
}