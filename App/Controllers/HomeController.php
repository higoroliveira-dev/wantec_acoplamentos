<?php
require_once ROOT . '/Config/config.php';
require_once ROOT . '/App/Model/HomeModel.php';

class HomeController 
{
    public function index() 
    {
        $context = 
        [
            'title' => 'index',
            'context' => 'Index'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}