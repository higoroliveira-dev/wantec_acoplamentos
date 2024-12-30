<?php
class AboutController {
    public function index()
    {
        /*$response = [
            'status' => 'success',
            'message' => 'Bem-vindo à página de contato!',
            'content' => '<h1>Contato</h1><p>Entre em contato conosco.</p>',
        ];
        header('Content-Type: application/json');
        echo json_encode($response);*/
        $context = [
            'title' => 'Sobre',
            'context' => 'Sobre a empresa'
        ];
        include __DIR__ . '/../Views/master.php';
    }
}