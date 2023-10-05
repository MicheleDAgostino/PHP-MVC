<?php
namespace App\Core;
use \App\Core\Mvc;

class View {

    public string $layout = 'default';

    public function __construct(public Mvc $mvc) {}

    public function render($page, $values = []) {
        $layoutValue = [
            'page' => $page,
            'menu' => $this->mvc->config['menu']
        ];
        $layoutContent = $this->getViewContent("layouts", $this->layout, $layoutValue);
        $pageContent = $this->getViewContent("pages",$page);
        $pageContent = $this->renderContent($pageContent, $values);
        return $this->renderContent($layoutContent, [
            'page' => $pageContent,
        ]);
    }

    private function renderContent($content, $values) {
        $chiavi = array_keys($values);
        $chiavi = array_map(fn($chiave) => "{{".$chiave."}}", $chiavi);        
        foreach($values as $key => $value) {            
            if($value instanceof Component) {
                $values[$key] = $this->renderComponent($value);
            }
        }
        $valori = array_values($values);
        return str_replace($chiavi, $valori, $content);
    }

    public function renderComponent($componente) {
        $nomeComponente = $componente->getComponentName();
        $componentContent = $this->getViewContent("components", $nomeComponente);
        $content = '';
        foreach($componente->getItems() as $item) {
            $content .= $this->renderContent($componentContent, $item);
        }
        return $content;
    }

    private function getViewContent($folder, $item, $values = []) {
        extract($values);
        $views = $this->mvc->config['folder']['views'];
        ob_start();
        include "$views/$folder/$item.html";
        return ob_get_clean();
    }

}