<?php
class BlogController {
    public function index() {
        $context = [
            'title' => 'Blog',
            'context' => 'Blog'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}