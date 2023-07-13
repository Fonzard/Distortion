<?php
abstract class AbstractController {
    
    protected string $template;
    protected array $data;
    
    public function render(string $view, array $values) : void
    {
        $this->template = $view;
        $this->data = $values;
        
        require "/home/homes/francisrouxel/sites/php/res04_php_distorsion/views/layout.phtml";
    }
}
?>