<?php
namespace Placestart\Shop;

/**
 * Товар
 */
class Product{
    private $data = [];
    private int $id;

    function __construct(int $id){
        $this->id = $id;    
    }

    private function getData($key){
        return $this->data[$key];
    }

    private function getProperty(string $name){
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        switch ($name) {
            case 'id':
                return $this->id;
                break;

            case 'title':
                $this->data["title"] = get_the_title($this->id);
                break;

            case 'permalink':
                $this->data["permalink"] = get_permalink($this->id);
                break;

            case 'preview_picture':
                $this->data["preview_picture"] = get_post_thumb($this->id, 'medium_large');
                break;

            case 'content':
                $this->data["content"] = get_the_content($this->id);
                break;
            
            default:
                $this->data[$name] = get_field($name, $this->id);
                break;
        }

        return $this->data[$name];
    }

    public function getID(): int{
        return $this->id;
    }

    public function getPrice(): int{
        return (int) $this->getProperty("dish_price");
    }

    public function getTitle(): string{
        return $this->getProperty("title");
    }

    public function getWeight(): int{
        return (int) $this->getProperty("dish_weight");
    }

    public function getDescription(){
        return $this->getProperty("description");
    }

    public function getPreviewPicture() {
        return $this->getProperty("preview_picture");
    }

    public function getPermalink(): string{
        return $this->getProperty("permalink");
    }
}