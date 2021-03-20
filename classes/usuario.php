<?php

define( 'MYSQL_HOST', 'localhost' );
define( 'MYSQL_USER', 'id14884177_root' );
define( 'MYSQL_PASSWORD', '-j5Wd>\$Z=9$15r7' );
define( 'MYSQL_DB_NAME', 'id14884177_teste' );

class Usuario{

    private $pdo;
    public $msgErro = "";

    public function conectar(){ // CONECTA COM BANCO
        global $pdo;

        try {
            $pdo = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB_NAME,MYSQL_USER,MYSQL_PASSWORD);
        } catch (PDOException $e) {
            global $msgErro;
            $msgErro = $e->getMessage(); // atribui o erro para a variavel msgErro
        }
        
    }

    public function cadastrar($nome, $sobrenome, $email, $senha){ // CADASTRA NOVO USER
        global $pdo;

        //verificar se ja existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_atendente FROM atendente WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false;
        }
        //caso nao, Cadastrar
        else{
            $sql = $pdo->prepare("INSERT INTO atendente (nome, sobrenome, email, senha) VALUES (:n, :m, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":m",$sobrenome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }   
    }

    public function logar($email, $senha){
        global $pdo;
        // verificar se o email e senha estao cadastrado, se sim
        $sql = $pdo->prepare("SELECT id_atendente FROM atendente WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0){
            // entrar no sistema (sessao)
            $dado = $sql->fetch();
            session_start(); // CRIA UMA SESSAO
            $_SESSION['id_atendente'] = $dado['id_atendente']; // consegue acessar a pagina privada. (EX filaAtual.html)
            return true; //logado com sucesso
        }
        else{
            return false; //nao foi posssivel logar
        }
        
    }
}


?>