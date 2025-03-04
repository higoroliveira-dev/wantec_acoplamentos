<?php
class BlogController {
    public function index() 
    {
        $context = 
        [
            'title' => 'Blog - WANTEC',
            'context' => 'Blog'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}