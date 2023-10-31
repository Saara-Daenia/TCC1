<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Digite seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Digite sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: teste.php");

        } else {
            echo "Erro ao logar! E-mail ou senha incorretos";
        }

    }

}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #3e8e41;
}
</style>
<body>
    <h1>Conecte-se</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
           <a href="teste.php"><button type="submit">Entrar</button></a> 
        </p>
    </form>
</body>

</html>
