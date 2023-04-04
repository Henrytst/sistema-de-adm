<?php

session_start();

if (!isset($_SESSION["nome"])) {
    header("location: ../../../index.php");
    exit;
}

require_once('../model/funcionarios.php');

if ($_POST) {
    if (
        isset($_POST["name"]) && !empty($_POST["name"])
    ) {
        
        $nome_arquivo = filter_input(INPUT_POST, "nome_arquivo", FILTER_SANITIZE_STRING);
        $arquivo = filter_input(INPUT_POST, "arquivo_gravado", FILTER_SANITIZE_STRING);
        if ($_FILES['arquivo']['size'] != 0) {
            if (
                ($_FILES['arquivo']['size'] != 0) && !empty($_POST["arquivo_gravado"])
            ) {
                unlink($arquivo);
            }
            $caminho_arquivo = "/xampp/htdocs/shakers/pages/arquivos/";
            $arquivo = $_FILES["arquivo"];
            $nome_arquivo = $arquivo['name'];
            $uniqid_arquivo = uniqid();
            $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            $path = $caminho_arquivo . $uniqid_arquivo . "." . $extensao;

            move_uploaded_file($arquivo["tmp_name"], $path);
            $arquivo = $path;
        } else {
            $arquivo = filter_input(INPUT_POST, "arquivo_gravado", FILTER_SANITIZE_STRING);
        }
        date_default_timezone_set('America/Sao_Paulo');
        $nome_arquivo = filter_input(INPUT_POST, "nome_arquivo", FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $rg = filter_input(INPUT_POST, "rg", FILTER_DEFAULT);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_DEFAULT);
        $cb = filter_input(INPUT_POST, "cb", FILTER_DEFAULT);
        $phone = filter_input(INPUT_POST, "phone", FILTER_DEFAULT);
        $manequim = filter_input(INPUT_POST, "manequim", FILTER_DEFAULT);
        $calcado = filter_input(INPUT_POST, "calcado", FILTER_DEFAULT);
        $altura = filter_input(INPUT_POST, "altura", FILTER_DEFAULT);
        $status = filter_input(INPUT_POST, "status", FILTER_DEFAULT);
        $hierarquia = filter_input(INPUT_POST, "hierarquia", FILTER_DEFAULT);
        $idiomas = filter_input(INPUT_POST, "idiomas", FILTER_DEFAULT);
        $created_at = date('d/m/Y   |   H:i:s');
        $update_at = date('d/m/Y  |  H:i:s');

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarCliente = new Funcionarios();
            $resposta = $editarCliente->editarCliente(
                $id,
                $arquivo,
                $nome_arquivo,
                $name,
                $rg,
                $cpf,
                $email,
                $cb,
                $phone,
                $manequim,
                $calcado,
                $altura,
                $status,
                $hierarquia,
                $idiomas,
                $update_at
            );
            if ($resposta = 1) header('location: ../../funcionarios.php?mensagem=sucesso');
            else header('location: ../views/formulario.php?mensagem=erro');
        } else {
            $adicionarCliente = new Funcionarios();
            $resposta = $adicionarCliente->adicionarCliente(
                $arquivo,
                $nome_arquivo,
                $name,
                $rg,
                $cpf,
                $email,
                $cb,
                $phone,
                $manequim,
                $calcado,
                $altura,
                $status,
                $hierarquia,
                $idiomas,
                $created_at
            );
            if ($resposta = 1) header('location: ../../funcionarios.php?mensagem=sucesso');
            else header('location: ../views/formulario.php?mensagem=erro');
        }
    } else {
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);

        if ($acao == "excluir") {
            $buscarCliente = new Funcionarios();
            $resposta = $buscarCliente->excluirCliente($id);
            if ($resposta > 0)
                header('location: ../../funcionarios.php?mensagem=sucesso');
            else {
                header('location: ../../funcionarios.php?mensagem=erro');
            }
        }
    }
}
