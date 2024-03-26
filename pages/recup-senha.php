<?php

if(isset($_POST['submit']))
{
    require_once('../DB/DB.php');
    require_once('../DB/UserDB.php');


    $forget = new UserDB();

    $password = filter_var($_POST['$password'],FILTER_SANITIZE_NUMBER_INT);
    $user = filter_var($_POST['user'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(strlen($password)<6)
    {
        header('location: recup_senha.php?menor=senha');
    }
    else
    {
        $forgotPass = $forget->RedefinePassword($password,$user);
        if($forgotPass == true)
        {
            header('location: recup_senha.php?sucess=cadastrado');
        }
    }

}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles_pages/recup-senha.css">
</head>
<body>

    <?php
      if(isset($_GET['success'])) {
        echo"<script>alert('redefinido  com sucesso')</script>";
        }
        if(isset($_GET['menor']))
        {
          echo "<script>alert('a senha possui menos de 6 caracteres')</script>";
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
                <form>
                    <div class="login-container-est-int-input">
                        <input id="user" type="text" name="user" placeholder="Nova senha" required>
                        <input id="password" type="password" name="password" placeholder="Repita a nova senha" required>
                    </div>
                    <div class="login-container-est-int-bnt">
                        <button class="botão" type="submit" name="submit" >Recuperar senha</button>
                    </div>
                    <div class="login-container-est-int-p">
<<<<<<< HEAD:pages/recup-senha.html
                        <a href="login.php">
                            <p>
                                Voltar para o Login
                            </p>
                        </a>
=======
                        <a href="login.php">Voltar ao login</a>
>>>>>>> b39c87d59f6c808f2c3a564dde1472a71c2682ce:pages/recup-senha.php
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>