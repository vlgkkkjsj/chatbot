<?php

class UserDB 
{
    private $conexao;
    private $id;
    private $name;
    private $email;
    private $card;
    private $cpf;
    private $user;
    private $password;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }
    public function getID()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
       return $this->email;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getCard()
    {
        return $this->card;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
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
    public function setPassword($password)
    {
        $this-> password = $password;
    }
    public function setCard($card)
    {
        $this -> card = $card;
    }


    public function sUser($email,$cpf) //S user é do mesmo de SINGLE USER, ou seja um usuario unico
    {
        $single = "SELECT FROM  base_client  WHERE email=? AND cpf = ? ";

        $stmt = mysqli_prepare($this->conexao->getConn(),$single);
        mysqli_stmt_bind_param($stmt,"ss",$email,$cpf);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_assoc($res);
    }
    public function submitUser($name,$user,$email,$cpf,$card,$password)
    {
        $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user = filter_var($user, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $cpf = filter_var($cpf, FILTER_SANITIZE_NUMBER_INT);
        $card = filter_var($card, FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        
       
        
        if(empty($name)||empty($cpf)||empty($card)||empty($email)||empty($user)||empty($password))
        {
            print "<script> alert('Certifique-se de que informou todas as informações')</script>";
            print "<script> location.href='cadastro.php'</script>";
        }
        else if(strlen($cpf)< 11 || strlen($cpf)>11)
        {
            print "<script>alert('Certifique-se que cpf se encontra correto')</script>";
            print "<script> location.href='cadastro.php'</script>";
        }
        else if (strlen($card)<13 || strlen($card)>19)
        {
            print "<script>alert('Certifique-se que card se encontra correto')</script>";
            print "<script> location.href='../pages/cadastro.php'</script>";
        }
        else
        {
            $sql = "INSERT INTO base_client (name,user,email,cpf,card,password) VALUES ('{$name}','{$user}','{$email}','{$cpf}', '{$card}','{$password}')";

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
    public function Login($user, $password)
    {
        $result = "SELECT * FROM base_client WHERE user= ? AND password = ?";
        $stmt = mysqli_prepare($this-> conexao ->getConn(), $result);
        mysqli_stmt_bind_param($stmt, "ss", $user , $password); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
}
        public function RedefinePassword($user, $password)
        {
            $user = filter_var($user, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(empty($password)||empty($user))
            {
                print "<script>alert('password ou usuario vazios')</script>";
                print "<script>location.href='recup-password.php'</script>";
            }
            else if(strlen($password)<6) 
            {
                echo '<script>window.onload = function() {
                    alert("password menor que 6");
                }</script>';
            }
            else
            {
                $sql = "UPDATE base_client SET password = '{$password}' WHERE user ='{$user}'";
                $res = mysqli_query($this->conexao->getConn(),$sql);

                if(mysqli_affected_rows($this->conexao->getConn())>0)
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