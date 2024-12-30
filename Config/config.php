<?php
class ModelConfig 
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=seu_banco', 'usuario', 'senha');
    }
}
?>