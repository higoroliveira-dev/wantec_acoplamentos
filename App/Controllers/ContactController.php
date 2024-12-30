<?php
class ContactController {
    public function index() {
        $context = [
            'title' => 'Contato',
            'context' => 'Contato'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}