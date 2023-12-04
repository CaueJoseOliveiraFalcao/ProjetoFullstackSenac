<?php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styleCad.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/img/bootstrap.png" type="image/x-icon">
    <title>Sistema Acadêmico</title>
</head>
<body>
    <header class="headercad">
        <div class="header">
            
            <div id="titulo1">
                <h2 id="titcad">Formulário de Cadastro</h2>
            </div>
        </div>
    </header>
    <section>
        <?php
            if(isset($_SESSION['cadastrado'])):
        ?>
        <div style="text-align:center;background-color:green; color: white;padding: 0.5rem;border-radius:10px">
            <p>Usuatio Cadastrado</p>
        </div>
        <?php
            endif;
            unset($_SESSION['cadastrado']);
        ?>
        <?php
            if(isset($_SESSION['naocadastrado'])):
        ?>
        <div style="text-align:center;background-color:red; color: white;padding: 0.5rem;border-radius:10px">
            <p>Usuatio Nao cadastrado</p>
        </div>
        <?php
            endif;
            unset($_SESSION['naocadastrado']);
        ?>
    </section>
    <main class="conteudo">
        <section class="bloco">
            
            <!--Início do formulário-->
            <form action="scriptcadastro.php" method="POST" id="form-cad">
                <div>
                    Matrícula: <label>*</label>
                    <input type="int" name="matricula" placeholder="Digite um número de matrícula" >
                </div>
                <div>
                    Nome completo: <label>*</label>
                    <input type="text" name="nome" placeholder="Digite o seu nome completo" >
                </div>
                <div>
                    E-mail: <label>*</label>
                    <input type="email" name="email" placeholder="Digite o seu melhor e-mail" >
                </div>
                <div>
                    Senha: <label>*</label>
                    <input type="password" name="senha" placeholder="Cadastre uma senha forte" >
                </div>

                <p>Status: <label>*</label></p>
                <div>
                    <select name="estatus" id="">
                        <option value="">Selecione uma opção</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <p>Usuário: <label>*</label></p>
                <div>
                    <select name="painel" id="">
                        <option value="">Selecione uma opção</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Professor">Professor</option>
                        <option value="Aluno">Aluno</option>
                    </select>
                </div>

                <!--Criando os botões do form-->
                <div class="botao">
                    <button type="submit">Enviar</button>
                    <button type="reset">Limpar</button>
                </div>

            </form>
        </section>

    </main>

    <footer class="container-fluid">
       
                <img src="assets/img/bootstrap.png" class="img-fluid logo1">              
                <p>&copy; 2023 Bootstrap - O melhor framework web. Todos os direitos reservados. Atualmente v5.3 </p>
   
                <p style="margin-top: 10px;"><a href="index.html">Voltar a home</a></p>

    </footer>
    
</body>
</html>