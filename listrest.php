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
<body>
    <h1 style="text-align: center;">Lista registros</h1>
    <hr>
    <?php
    $query_users = $con->prepare("SELECT id , matricula ,nome , email , estatus , dtcadastro FROM usuarios");


    $query_users->execute();
    $row = $query_users->rowCount();

    echo $row;
    if($row != 0){
        while($eachUser = $query_users->fetch(PDO::FETCH_ASSOC)){
            extract($eachUser);

            echo "ID: $id <br>";
            echo "Matricula: $matricula <br>";
            echo "Nome: $nome <br>";
            echo "Email: $email <br>";
            echo "status: $estatus <br>";
            echo "data:" . date("d/m/Y H:i:s" , strtotime($dtcadastro)) . "<br><br>";
        }
    }
    else{
        echo 'sem usuarios ';
    }


    ?>
</body>
</html>