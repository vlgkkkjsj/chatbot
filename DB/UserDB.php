<?php

class UserDB 
{
    public $conexao;
    public $id;
    public $nome;
    public $email;
    public $cartao;
    public $cpf;
    public $user;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }
    public function getID()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
       return $this->email;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function getCartão()
    {
        return $this->cartao;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setEmail($email)
    {
        $this->email  =$email;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    public function setUser($user)
    {
        $this-> user = $user;
    }

    public function sUser($user,$email,$cpf) //S user é do mesmo de SINGLE USER, ou seja um usuario unico
    {
        $single = "SELECT FROM  cadastro_clientes  WHERE user=? AND email=? AND cpf = ? ";

        $stmt = mysqli_prepare($this->conexao->getConn(),$single);
        mysqli_stmt_bind_param($stmt,"sss",$user,$email,$cpf);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_assoc($res);
    }
    public function submitUser($nome,$user,$email,$cpf,$cartao)
    {
        $nome = filter_var($nome, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user = filter_var($user, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $cpf = filter_var($cpf, FILTER_SANITIZE_NUMBER_INT);
        $cartao = filter_var($cartao, FILTER_SANITIZE_NUMBER_INT);
        
       
        
        if(empty($nome)||empty($cpf)||empty($cartao)||empty($email)||empty($user))
        {
            print "<script> alert('Certifique-se de que informou todas as informações')</script>";
            print "<script> location.href='cadastro.php'</script>";
        }
        else if(strlen($cpf)< 11 || strlen($cpf)>11)
        {
            print "<script>alert('Certifique-se que cpf se encontra correto')</script>";
            print "<script> location.href='cadastro.php'</script>";
        }
        else if (strlen($cartao)<13 || strlen($cartao)>19)
        {
            print "<script>alert('Certifique-se que cartao se encontra correto')</script>";
            print "<script> location.href='cadastro.php'</script>";
        }
        else
        {
            $sql = "INSERT INTO cadastro_clientes (nome,user,email,cpf,cartao) VALUES ('{$nome}','{$user}','{$email}','{$cpf}', '{$cartao}')";

            $res =  mysqli_query($this->conexao->getConn(),$sql);
             
            if (mysqli_affected_rows($this->conexao->getConn())> 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }
}