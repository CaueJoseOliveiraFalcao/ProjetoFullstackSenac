<?php
include('conexao.php');
$con = dbinit();
session_start();
ob_start();
$id = filter_input(INPUT_GET , "id" , FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
    $_SESSION['msg'] = '<p>Error : usuario nao encontrado</p>';
    header("Location:listar.php");
}
$query_id = "SELECT id , matricula , nome , email , estatus , dtcadastro FROM usuarios  WHERE id=$id LIMIT 1";

$result_user = $con->prepare($query_id);

$result_user->execute();

if(($result_user) and ($result_user->rowCount() != 0)){
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
    <?php
    $dados = filter_input(INPUT_POST , FILTER_DEFAULT);
    if (!empty($dados['EditUsuario'])){
        $empty_input = false;

        array_map('trim' , $dados);

        if(in_array('', $dados)){
            $empty_input = true;
            echo '<p>Precncha todos os campos</p>';
        }elseif (!filter_var($dados['email'] , FILTER_VALIDATE_EMAIL)) {
            $empty_input = true;
            echo '<p>Precncha email valido</p>';
        }if(!$empty_input){
            $query_user = "UPDATE usuarios SET matricula=:matricula , nome=:nome , email=:email , estatus=:estatus WHERE id=:id";
            $edit_user =  $con->prepare($query_user);

            $edit_user->bindParam(':matricula' , $dados['matricula'] , PDO::PARAM_INT);
            $edit_user->bindParam(':nome' , $dados['nome'] , PDO::PARAM_STR);
            $edit_user->bindParam(':email' , $dados['email'] , PDO::PARAM_STR);
            $edit_user->bindParam(':estatus' , $dados['estatus'] , PDO::PARAM_STR);
            $edit_user->bindParam(':id' , $id , PDO::PARAM_INT);

            if($edit_user->execute()){
                echo '<p>usuairo atualizado</p>';
                header('Location:listar.php');
            }else{
                echo '<p>usuairo nao atualizado</p>';
            }
        }
    }
    ?>
    <header>
        <h1 style="text-align: center;">Alteração de Registros</h1>
    </header>
    <div class="container">
        <form class="form" action="" method="POST">
            <label for="">Matricula</label>
            <input type="int" name="matricula" id="matricula" value="<?php 
            if(isset($dados['matricula'])){
                echo $dados['matricula'];
            }elseif (isset($rowUsuario['matricula'])) {
                echo $rowUsuario['matricula'];
            }
            ?>" placeholder="Digite uma Matricula"><br><br>

            <label for="">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php 
            if(isset($dados['nome'])){
                echo $dados['nome'];
            }elseif (isset($rowUsuario['nome'])) {
                echo $rowUsuario['nome'];
            }
            ?>" placeholder="Digite um Nome"><br><br>

            <label for="">Email</label>
            <input type="email" name="email" id="email" value="<?php 
            if(isset($dados['email'])){
                echo $dados['email'];
            }elseif (isset($rowUsuario['email'])) {
                echo $rowUsuario['email'];
            }
            ?>" placeholder="Digite um Email"><br><br>
            <label for="">Status</label>
            <input type="text" name="status" id="stats" value="<?php 
            if(isset($dados['estatus'])){
                echo $dados['estatus'];
            }elseif (isset($rowUsuario['estatus'])) {
                echo $rowUsuario['estatus'];
            }
            ?>" placeholder="Digite um Estatus"><br><br>
            <div style="margin-top: 1rem;">
                <input type="submit" value="Atualizar" name="EditUsuario">
            </div>
        </form>
    </div>
</body>
</html>