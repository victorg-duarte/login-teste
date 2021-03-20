<?php 
    require_once 'classes/usuario.php';
    $u = new Usuario;
    
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Projeto Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <div id="corpo-form">
        <h1>Login - Atendente</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Digite seu Email" maxlength="40">
            <input type="password" name="senha" placeholder="Digite sua Senha" maxlength="15">
            <input type="submit" name="entra" value="Logar">
            <a href="cadastrar.php">Ainda não possui conta? <strong>Cadastre-se</strong></a>
        </form>
    </div>

    <?php
        // verificar se clicou no botao Logar
        if(isset($_POST['email'])) // verifica a existencia de uma variavel
        { 
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            //verifica se esta preenchido
            if(!empty($email) && !empty($senha)){

                $u->conectar(); // conecta com BD
                if($u->msgErro == ""){

                    if($u->logar($email, $senha)){
                        header("location: areaPrivada.php");
                    }  
                    else{
                        ?> 
                        <div class="msg-erro">Email e/ou senha estão incorretos!</div>
                        <?php 
                    }
                }
                else{
                     ?>
                    <div class="msg-erro"> <?php echo "Erro: ".$u->msgErro; ?> </div> 
                    <?php
                }
            }
            else{
                ?> 
                <div class="msg-erro">Preencha todos os campos!</div>
                <?php 
            }
        }
    ?>
</body>
</html>