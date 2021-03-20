<?php
    // Instancia a classe usuario
    require_once 'classes/usuario.php'; 
    $u = new Usuario;
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Projeto Cadastro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <div id="corpo-form-cad">
        <h1>Cadastro - Atendente</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" maxlength="30">
            <input type="text" name="sobrenome" placeholder="Sobrenome" maxlength="30">
            <input type="email" name="email" placeholder="Digite seu Email" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" maxlength="15">
            <input type="password" name="confSenha" placeholder="Confimar Senha" maxlength="15">
            <input type="submit" name="entra" value="Cadastrar">
        </form>
    </div>
    <?php
        // verificar se clicou no botao Cadastrar
        if(isset($_POST['nome'])) // verifica a existencia de uma variavel
        { 
            $nome = addslashes($_POST['nome']);
            $sobrenome = addslashes($_POST['sobrenome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confimarSenha = addslashes($_POST['confSenha']);

            //verifica se esta preenchido
            if(!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($senha) && !empty($confimarSenha)){
                $u->conectar("login_teste","localhost","root","");

                if($u->msgErro == ""){

                    if($senha == $confimarSenha){
                        if($u->cadastrar($nome,$sobrenome,$email,$senha)){
                            ?> 
                            <div id="msg-sucesso">Cadastrado com Sucesso!! 
                                <a id="acessa-login" href="index.php"><strong>Clique aqui para entrar.</strong></a>
                            </div> 
                            <?php
                        }
                        else{
                            ?>
                            <div class="msg-erro">Email ja cadastrado</div> 
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="msg-erro">Senha e confimar senha não correspondem!</div> 
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
                <div class="msg-erro">Preenha todos os campos!</div> 
                <?php
            }
        } 
    ?>
</body>
</html>