<?php
namespace App\Core;
use \App\Core\Mvc;

class View {

    public string $layout = 'default';

    public function __construct(public Mvc $mvc)
    {
        
    }

    public function render($page, $values = []){
        $layoutValue = [
            'page' => $page,
            'menu' => $this->mvc->config['menu']
        ];
        $layoutContent = $this->getViewContent('layouts', $this->layout, $layoutValue);
        $pageContent = $this->getViewContent('pages', $page);
        $pageContent = $this->renderContent($pageContent, $values);
        return $this->renderContent($layoutContent, ['page' => $pageContent]);
    }

    private function renderContent($content, $values){
        $keys = array_keys($values);
        $keys = array_map(fn($key) => "{{" . $key . "}}" , $keys);
        foreach($values as $key => $value){
            if ($value instanceof Component) {
                $values[$key] = $this->renderComponent($value);
            }
        }
        $value = array_values($values);
        return str_replace($keys, $value, $content);
    }

    public function renderComponent($component){
        $nameComponent = $component->getName();
        $componentContent = $this->getViewContent('components', $nameComponent);
        $content = '';
        foreach ($component->getItems() as $item) {
            $content .= $this->renderContent($componentContent, $item);
        }
        return $content;
    }

    private function getViewContent($folder, $page, $values = []){
        extract($values);
        $views = $this->mvc->config['folder']['views'];
        ob_start();
        include "$views/$folder/$page.html";
        return ob_get_clean();
    }

}