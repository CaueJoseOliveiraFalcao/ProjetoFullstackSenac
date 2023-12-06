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
    $query_users = $con->prepare("SELECT id , matricula ,nome , email , estatus , dtcadastro FROM usuarios");


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
                echo "</tr>";
            }
        ?>
    </table>
    </div>
    <?php
    } else {
        echo 'sem usuarios ';
    }

    ?>
</body>

</html>