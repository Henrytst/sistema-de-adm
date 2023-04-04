<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/shakers/pages/CSS/style.css">

    <title>Tela de Login</title>
</head>

<body class="index">

    <?php

    /*$login = "Shakers";
    $senha = "1997";

    //echo $login . "<br>";
    //echo $senha . "<br>";

    session_start();
    if (isset($_POST["login"], $_POST["senha"])) {
        if ($_POST["login"] == $login and $_POST["senha"] == $senha) {
            $_SESSION["login"] = $login;
            $_SESSION["senha"] = $senha;
            header("location: pages/funcionarios.php");
            die();
        } else {
            echo "Login ou senha inválido";
        }
    }*/

    include('./pages/migrations/conexao.php');

    if (isset($_POST['email']) || isset($_POST['senha'])) {

        if (strlen($_POST['email']) == 0) {
            echo "Preencha seu e-mail";
        } else if (strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha";
        } else {

            $email = $mysqli->real_escape_string($_POST['email']);
            $senha = $mysqli->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if ($quantidade == 1) {

                $usuario = $sql_query->fetch_assoc();

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: pages/funcionarios.php");
            } else {
                echo "Falha ao logar! E-mail ou senha incorretos";
            }
        }
    }

    ?>

    <!--<form method="post">
    login: <input type="text" name="login"><br>
    senha: <input type="password" name="senha">
    <input type="submit">
    </form>-->
    <div class="col-sm-12">
        <form method="post">
            <div class="d-flex justify-content-center">
                <div class="card telaLogin">
                    <div class="card-body">
                        <div class="col-md-15">
                            <label for="exampleInputEmail1">Usuário</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Digite seu Usuário" aria-describedby="emailHelp">
                            <div class="col-md-15">
                                <br>
                                <label for="exampleInputPassword1">Senha</label>
                                <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Digite sua Senha">
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-dark btn-block">Acessar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Adicionando Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</body>


</html>