<?php
include ROOT . '/Config/config.php';
include ROOT . '/App/Model/HomeModel.php';

class HomeController 
{
    public function index() 
    {
        $context = 
        [
            'title' => "WANTEC Acoplamentos",
            'context' => "",
            'active_home' => 'active',
        ];
        include ROOT . '/App/Views/master.php';
    }
}