<?php

    header("Content-Type: application/json; charset=UTF-8");

    $metodo = $_SERVER['REQUEST_METHOD'];

    // echo "Método da requisição: ". $metodo;

    $arquivo = 'usuarios.json';

    if(!file_exists($arquivo)){
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $usuarios = json_decode(file_get_contents($arquivo), true);


    // $usuarios = [
    //     ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
    //     ["id" => 2, "nome" => "Joao Silva", "email" => "joao@email.com"]
    // ];

    switch ($metodo) {
        case 'GET':
            // echo "ações do get";
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            break;

        case 'POST':
            // echo "ações do post";
            $dados = json_decode(file_get_contents('php://input'), true);
            // print_r($dados);

            if (!isset($dados["id"]) || !isset($dados ["nome"] ) || !isset($dados ["email"] )){
                http_response_code(400);
                echo json_encode(["erro" => "Dados Incompletos."], JSON_UNESCAPED_UNICODE);
                exit;
            }

            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "email" => $dados["email"]
            ];

            $usuarios[] = $novoUsuario;
            file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo json_encode(["mensagem" => "Usuario inserido com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);

            // array_push($usuarios, $novoUsuario);
            // echo json_encode('Usúario inserido com sucesso!');
            // print_r($usuarios);
            break;
        
        default:
            http_response_code(405); 
            echo json_encode(["erro" => "Método não permitido!"], JSON_UNESCAPED_UNICODE);
            break;
    }

?>