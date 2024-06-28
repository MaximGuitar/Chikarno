<?php 

namespace Placestart\Shop;

use Placestart\Shop\Product;

/**
 * Класс для хранения данных о товаре в корзине
*/
class CartItem{

    private Product $product;

    /**
     * Количество в корзине
     * @var int
    */
    private int $count;

    /**
     * Дополнительные свойства элемента в корзине
     * @var array<string, mixed>
    */
    private $props = [];

    function __construct(int $productID, int $count = 1, array $props = []){
        $this->product = new Product($productID);
        $this->count = $count;
        $this->props = $props;
    }

    public function getProduct(): Product{
        return $this->product;
    }

    public function getProps(): array {
        return $this->props;
    }

    /**
     * Устанавливает количество товара в корзине
    */
    public function setCount(int $count): void{
        $this->count = $count;
    }

    public function getCount(): int{
        return $this->count;
    }
}