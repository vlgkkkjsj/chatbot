<?php

if(isset($_POST['submit']))
{
    include_once('../DB/DB.php');
    include_once('../DB/UserDB.php');

    $cad = new UserDB();

    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user = filter_var(trim($_POST['user']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $cpf = filter_var(trim($_POST['cpf']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $card = filter_var(trim($_POST['card']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $single = $cad -> sUser($email,$cpf);

    if (!empty($single['email']) || !empty($single['cpf'])) 
    {
        header('location: cadastro.php?exist');
    }
    else
    {
        $insert = $cad -> submitUser($name,$user,$email,$cpf,$card,$password);
    
        if($insert == true)
        {
            header('location: cadastro.php?sucess');
        }
    
    }   
}
   
?>   
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Conversa</title>
    <link rel="stylesheet" href="../styles_pages/form.css">
</head>
<body>
    
<?php

if(isset($_GET['exist'])) 
{
    print  "<script>  alert('cpf e/ou email ja existentes')</script>";

}
 if (isset($_GET['sucess']))
{
    print "<script> alert('Formulario enviado com sucesso')</script>";
    header('location: cad-concluido.php');
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
                <label class="label" for="name">name:</label>
                <input type="text" id="name" name="name" required>

                <label class="label" for="user">user:</label>
                <input type="text" id="user" name="user" required>

                <label class="label" for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label class="label" for="confirmar_email">Confirmar E-mail:</label>
                <input type="email" id="confirmar_email" name="confirmar_email" required>

                <label class="label" for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>
                
                <label class="label" for="password">password:</label>
                <input type="text" id="password" name="password" required>
                
                <label class="label" for="card">Número do Cartão:</label>
                <input type="text" id="card" name="card" required>
            </div>
            <button class="botão" type="submit" name="submit" >Concluir</button>
        </div>
    </form>
</div>

</body>
</html>
