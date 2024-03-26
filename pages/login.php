<?php

if(isset($_POST["submit"]))
{
    include('../DB/UserDB.php');
    include('../DB/DB.php');

    $user = new UserDB();

    $user= filter_input(INPUT_POST,'user',FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_SPECIAL_CHARS);

    $user= $user -> login($user,$senha);

    if($user == true)
    {
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['senha'] = $senha;
        header('location:../page/');//terminar depois
    }
    else
    {
        header('location: login.php?erro=senha');

    }
}
?> 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles_pages/log.css">
</head>
<body>
<?php

if(isset($_GET['erro']))
{
    print "<script>alert('usuario e/ou senha incorretos')</script>";
}
?> -

<div class="login-container">
    <div class="login-container-est">
        <div class="login-container-est-int">
            <div class="login-container-est-top">
                <div class="login-container-est-top-img">
                    <img src="../images/logo-form.png" alt="logo" >
                </div>
                <h2 class="login-container-est-h2">Login</h2>
            </div>
            <form>
                <div class="login-container-est-int-input">
                    <input id="user" type="text" name="user" placeholder="user" required>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="login-container-est-int-bnt">
                    <button class="botão" type="submit" name="submit" >Entrar</button>
                </div>
                <div class="login-container-est-int-p">
                    <a href="recup-senha.html">
                        <p>
                            Esqueceu a senha?
                        </p>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
