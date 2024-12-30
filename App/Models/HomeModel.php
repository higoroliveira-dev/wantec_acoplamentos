<?php
require_once ROOT . '/Config/config.php';

class HomeModel 
{
    public function slide() 
    {
        $config = new ModelConfig();
        $pdo = $config->getDatabaseConnection();
        $search = $config->selectRecord('page_detail', ['id_page' => 1, 'position' => 1]);

        $context = [];
        return $context;
    }
}