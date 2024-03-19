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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ong Lar Bastet</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <?php
    if(isset($_GET['success'])) {
        echo  "<script>alert('cadastrado com sucesso')</script>";
        }
    ?> 
<div class="tot">
    <form class="tot-form" action="" method="post">
        <div class="tot-form-est">
            <div class="tot-form-est-top">
                <div class="tot-form-est-top-img">
                    <img  src="../images/logo-form.png" alt="">
                </div>
                <h2 class="tot-form-est-top-h2">Formulário de Cadastro</h2>
            </div>
            <div>
                <label class="label" for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label class="label" for="user">user:</label>
                <input type="text" id="user" name="user" required>

                <label class="label" for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label class="label" for="confirmar_email">Confirmar E-mail:</label>
                <input type="email" id="confirmar_email" name="confirmar_email" required>

                <label class="label" for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>
                
                <label class="label" for="cartao">Número do Cartão:</label>
                <input type="text" id="cartao" name="cartao" required>
            </div>
            <button class="botão" type="submit" name="submit" >Concluir</button>
        </div>
    </form>
</div>

</body>
</html>
