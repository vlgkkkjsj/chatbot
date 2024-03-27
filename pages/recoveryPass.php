<?php

if(isset($_POST['submit']))
{
    require_once('../DB/DB.php');
    require_once('../DB/UserDB.php');


    $forget = new UserDB();

    $user = filter_var($_POST['user'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        $forgotPass = $forget->RedefinePassword($user, $password);
        if($forgotPass == true)
        {
            header('location: recoveryPass.php?sucess');
        }
    }



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperacao de Senha - ChatBot</title>
    <link rel="stylesheet" href="../styles_pages/recup-senha.css">
    <link rel="icon" href="">
</head>
<body>

    <?php
      if(isset($_GET['sucess'])) {
        echo '<script>window.onload = function() {
            alert("Senha redefinida com sucesso");
        }</script>';
        }
        
    ?>
   <div class="login-container">
        <div class="login-container-est">
            <div class="login-container-est-int">
                <div class="login-container-est-top">
                    <div class="login-container-est-top-img">
                        <img src="../images/logo-form.png" alt="logo" >
                    </div>
                    <h2 class="login-container-est-h2">Recuperar senha</h2>
                </div>
                <form action="" method="post">
                    <div class="login-container-est-int-input">
                        <input id="user" type="text" name="user" placeholder="user" required>
                        <input id="password" type="password" name="password" placeholder="Nova senha" required>
                        <input id="confirm-pass" type="password" name="confirm-pass" placeholder="Repita a nova senha" required>
                       
                    </div>
                    <div class="login-container-est-int-bnt">
                        <button class="botão" type="submit" name="submit" >Recuperar senha</button>
                    </div>
                    <div class="login-container-est-int-p">
                        <a href="login.php">
                            <p>
                                Voltar para o Login
                            </p>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>