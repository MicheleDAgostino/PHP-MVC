<?php
namespace App\Core;

class Component {

    private array $items = [];
    private string $componentName;

    public function __construct($componentName)
    {
        $this->componentName = $componentName;
    }

    public function setItem($item){
        array_push($this->items, $item);
    }

    public function setItems($items){
        $this->items = $items;
    }

    public function getItems(){
        return $this->items;
    }

    public function getComponentName(){
        return $this->componentName;
    }

}