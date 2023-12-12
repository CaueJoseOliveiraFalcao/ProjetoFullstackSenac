<?php
include('conexao.php');
$con = dbinit();

$id = filter_input(INPUT_GET , "id" , FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
    $_SESSION['msg'] = '<p>Error : usuario nao encontrado</p>';
    header("Location:listar.php");
}
$query_id = "SELECT id , matricula , nome , email , estatus , dtcadastro FROM usuarios  WHERE id=$id LIMIT 1";

$result_user = $con->prepare($query_id);

$result_user->execute();

if(($result_user)and ($result_user->rowCount() != 0){
    $rowUsuario = $result_user->fetch(PDO::FETCH_ASSOC);
}
else {
    $_SESSION['msg'] = '<p>Error : usuario nao encontrado</p>';
    header("Location:listar.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<style>
    body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .container{
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .container form{
        background-color: rgb(219, 219, 218);
        padding: 1rem;
        font-family:'Courier New', Courier, monospace;
        display: flex;
        justify-content: start;
        flex-direction: column;
        width: 600px;
    }
    header{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        background-color: black;
        color: white;
        margin-bottom: 2rem;
    }
    form label{
        margin: 1rem 0;
    }
    form input{
        width: 100%;
        height: 2rem;
    }
</style>
<body>
    <header>
        <h1 style="text-align: center;">Alteração de Registros</h1>
    </header>
    <div class="container">
        <form action="" method="POST">
            <label for="">Matricula</label>
            <input type="int" name="matricula" id="matricula" value="" placeholder="Digite uma Matricula"><br><br>

            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="" placeholder="Digite um Nome"><br><br>

            <label for="">Email</label>
            <input type="email" name="email" id="email" value="" placeholder="Digite um Email"><br><br>

            <label for="">Status</label>
            <input type="text" name="status" id="status" value="" placeholder="Digite um Status"><br><br>
            
            <div style="margin-top: 1rem;">
                <input type="submit" value="Atualizar" name="EditUsuario">
            </div>
        </form>
    </div>
</body>
</html>