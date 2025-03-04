<?php
class ProductController 
{
    public function index() 
    {
        $context = 
        [
            'title' => 'Produto - WANTEC',
            'context' => 'Produto',
            'active_product' => 'active',
        ];
        include __DIR__ . '/../Views/master.php';
    }
}