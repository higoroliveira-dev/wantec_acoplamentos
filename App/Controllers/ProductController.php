<?php
class ProductController {
    public function index() {
        $context = [
            'title' => 'Produto',
            'context' => 'Produto'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}