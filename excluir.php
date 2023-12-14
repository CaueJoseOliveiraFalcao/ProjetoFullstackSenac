<?php
include('conexao.php');
$con = dbinit();
ob_start();
session_start();
$id = filter_input(INPUT_GET , "id" , FILTER_SANITIZE_NUMBER_INT);
if (empty($id)){
    $_SESSION['msg'] = '<p>usuario nao encontrado</p>';
    header('Location:listar.php');



}

$query_user = "SELECT id FROM usuarios WHERE id=$id LIMIT 1";
$result_user = $con->prepare($query_user);
$result_user->execute();

if($result_user->rowCount() != 0){
    $query_del = "DELETE FROM usuarios WHERE id=$id";
    $result_query_del = $con->prepare($query_del);
    if($result_query_del->execute()){
        $_SESSION['msg'] = '<p>usuario deletado</p>';
        header('Location:listar.php');
    }else{
        $_SESSION['msg'] = '<p>usuario nao deletado</p>';
        header('Location:listar.php');
    }
}
else{
    $_SESSION['msg'] = '<p>usuario nao encontrado</p>';
    header('Location:listar.php');
}

?>