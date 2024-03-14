<?php

if(isset($_POST['submit']))
{
    include('./DB/DB.php');
    include('./DB/UserDB.php');

    $cad = new UserDB();

    $nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_SPECIAL_CHARS);
    $user = filter_var(trim($_POST['user']), FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $cpf = filter_var(trim($_POST['cpf']), FILTER_SANITIZE_NUMBER_INT);
    $cartao = filter_var(trim($_POST['cartao']), FILTER_SANITIZE_NUMBER_INT);

    $insert = $cad -> submitUser($nome,$user,$email,$cpf,$cartao);
    
    if($insert == true)
    {
        header('location: cadastro.php?sucess');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET['success'])) {
        echo  "<script>alert('cadastrado com sucesso')</script>";
        }
    ?>
<form action="" method="post">
    <h2>Formulário de Cadastro</h2>
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="cpf">user:</label>
    <input type="text" id="user" name="user" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>

    <label for="confirmar_email">Confirmar E-mail:</label>
    <input type="email" id="confirmar_email" name="confirmar_email" required>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required>
    
    <label for="cartao">Número do Cartão:</label>
    <input type="text" id="cartao" name="cartao" required>

    <button class="botao" type="submit" name="submit" >Concluir</button>
</form>

</body>
</html>
