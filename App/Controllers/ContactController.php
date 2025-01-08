<?php
class ContactController 
{
    public function index() 
    {
        $context = 
        [
            'title' => 'Contato',
            'context' => 'Contato',
            'active_contact' => 'active',
        ];
        include __DIR__ . '/../Views/master.php';
    }
}