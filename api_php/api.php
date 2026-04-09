<?php

    header("Content-Type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    // ECHO "Método da requisição: ". $metodo;

    switch ($metodo) {
        case 'GET':
            echo "ações do get";
            break;

        case 'POST':
            echo "ações do post";
            break;
        
        default:
            echo "método não encontrado";
            break;
    }

    // $usuarios = [
    //     ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
    //     ["id" => 2, "nome" => "Joao Silva", "email" => "joao@email.com"]
    // ];

    // echo json_encode($usuarios);

?>