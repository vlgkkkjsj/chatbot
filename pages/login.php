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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .login-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php

if(isset($_GET['erro']))
{
    print "<script>alert('usuario e/ou senha incorretos')</script>";
}
?>

<div class="login-container">
    <h2>Login</h2>
    <form>
        <input type="text" name="user" placeholder="user" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button class="botão" type="submit" name="submit" >Entrar</button>
    </form>
</div>

</body>
</html>
