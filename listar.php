<?php
include('conexao.php');
$con = dbinit();


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
        <a style="color: white;text-decoration:none;" href="cadastro.php">Cadastro</a>
    </header>
    <?php
    //http://localhost/projetofullstacksenac/listar.php?page=1 

    $actual_page_number = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

    $pagina = (!empty($actual_page_number)) ? $actual_page_number : 1;
    
    $limite_result = 5;

    $inicio = ($limite_result * $pagina) - $limite_result;



    $query_users = $con->prepare("SELECT id , matricula ,nome , email , estatus , dtcadastro FROM usuarios ORDER BY dtcadastro ASC LIMIT $inicio , $limite_result ");


    $query_users->execute();
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
        $row = $query_users->rowCount();

        echo $row;
        if ($row != 0) {
            while ($eachUser = $query_users->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                extract($eachUser);
                    echo "<td>" . $id . "</td>";
                    echo "<td>" . $matricula . "</td>";
                    echo "<td>" . $nome . "</td>";
                    echo "<td>" . $email . "</td>";
                    echo "<td>" . $estatus . "</td>";
                    echo "<td>" . date("d/m/Y H:i:s", strtotime($dtcadastro)) . "</td>";
                    echo "<td><a href='editar.php?id=$id' >[Editar]</a> <a href='' >[Excluir]</a> </td>"; 
                echo "</tr>";
            }
        ?>
    </table>
    </div>
    <br>
    <br>
    <br>
    <?php

    $query_qnt = $con->prepare("SELECT COUNT(id) AS num_result FROM usuarios");
    $query_qnt->execute();

    $row_qnt = $query_qnt->fetch(PDO::FETCH_ASSOC);
    
    $qtn_pages = ceil($row_qnt['num_result'] / $limite_result);

    $max_link = 2;

    for($previos_page = $pagina - $max_link; $previos_page <= $pagina - 1; $previos_page++){
        if ($previos_page >= 1 ){
            echo "<a href='listar.php?page=$previos_page'>$previos_page</a>";
        }
    }
    for($pos_page = $pagina + 1; $pos_page <= $pagina + $max_link; $pos_page++){
        if ($pos_page <= $qtn_pages){
            echo "<a href='listar.php?page=$pos_page'>$pos_page</a>";
        }
    }

    } else {
        echo 'sem usuarios ';
    }

    ?>
</body>

</html>