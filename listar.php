<?php
include('conexao.php');
$con = dbinit();
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
</head>

<style>
    th{
        background-color: #e6e6e6;
        padding: 0.8rem;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    td{
        background-color: #e6e6e6;
        padding: 0.8rem;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>
<body style="padding: 0;margin:0;">
    <header style="display:flex;align-items:center;justify-content:space-between;background-color:black;color:white;padding:0;margin:0;">
        <h1>Lista registros</h1>
        <?php
         if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
         }
         unset($_SESSION['msg'])
        ?> 
        <a style="color: white;text-decoration:none;" href="cadastro.php">Cadastro</a>
    </header>
    <?php
    /* -------------PAGINAÇÃO - PARTE_1 - INÍCIO ------------------*/
       //1 - Criando uma variável para informar a página atual usando GET
       // http://localhost/projetoacademico/listar2.php?page=1 

       //2- Criar uma variável para receber o número da página atual da URL
       $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

       //3- Verificar se a numeração não foi enviada através da URL
       $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

       //4- Setar a quantidade de registros por página
       $limite_result = 2;

       //5- Calcular o início da visualização(precisamos identificar a partir de qual registro irá iniciar a próxima página)
       $inicio = ($limite_result * $pagina) - $limite_result;

    /* -------------PAGINAÇÃO - PARTE_1 - FIM ------------------*/



        //2-Preparando a consulta de registro de usuários
        $query_usuarios = $con->prepare("SELECT id, matricula, nome, email, estatus, dtcadastro FROM usuarios ORDER BY dtcadastro DESC LIMIT $inicio, $limite_result");

        //3-Executando a consulta
        $query_usuarios->execute();
    ?>
    <div style="display: flex;justify-content:center;flex-direction:column">
    <table style="margin: 3rem 0;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Matricula</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
        $row = $query_usuarios->rowCount();

        echo $row;
        if ($row != 0) {
            while ($eachUser = $query_usuarios->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                extract($eachUser);
                    echo "<td>" . $id . "</td>";
                    echo "<td>" . $matricula . "</td>";
                    echo "<td>" . $nome . "</td>";
                    echo "<td>" . $email . "</td>";
                    echo "<td>" . $estatus . "</td>";
                    echo "<td>" . date("d/m/Y H:i:s", strtotime($dtcadastro)) . "</td>";
                    echo "<td><a href='editar.php?id=$id'>[Editar]</a> <a href='exdel.php?id=$id'>[Excluir]</a> </td>";
                echo "</tr>";
            }
        ?>
    </table>
    </div>
    <br>
    <br>
    <br>
    <?php
    /* -------------PAGINAÇÃO - PARTE_2 - INÍCIO ------------------*/
    //6- Contar a quantidade de registros no banco de dados
    $query_qnt_registros = $con->prepare("SELECT COUNT(id) AS num_result FROM usuarios");
    $query_qnt_registros->execute();

    $row_qnt_registros = $query_qnt_registros->fetch(PDO::FETCH_ASSOC);

    //7-Identificar a quantidade de páginas para exibir todos os registros (CEIL)
    $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_result);

    //8- Criar uma variável para informar o máximo de links na página
    $maximo_link = 2;

    //9- Mostrar o link da primeira página
    echo "<a href='listar.php?page=1'>Primeira</a> ";

    //10- Listar os links anteriores da página atual (FOR)
    for($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina-1; $pagina_anterior++){
        
        if($pagina_anterior >= 1){
            echo "<a href='listar.php?page=$pagina_anterior'>$pagina_anterior</a> ";
        }
    }

    //11- Mostrar a página atual
    echo "$pagina ";

    //12- Listar os links posteriores a página atual (FOR)
    for($pagina_posterior = $pagina + 1; $pagina_posterior <= $pagina + $maximo_link; $pagina_posterior++){
        
        if($pagina_posterior <= $qnt_pagina){
            echo "<a href='listar.php?page=$pagina_posterior'>$pagina_posterior</a> ";
        }
    }

    //Link da última página
    echo "<a href='listar.php?page=$qnt_pagina'>Ultima</a> ";



    /* -------------PAGINAÇÃO - PARTE_2 - FIM ------------------*/   


    }else{
        echo "<p style='color:red;'>Erro: Usuário não encontrado</p>";
    }

    ?>
</body>

</html>