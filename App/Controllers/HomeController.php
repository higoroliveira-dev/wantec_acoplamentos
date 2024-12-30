<?php
class HomeController {
    public function index() {
        $context = [
            'title' => 'index',
            'context' => 'Index'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}