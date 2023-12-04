<?php
include("conexao.php");
session_start();
$con = dbinit();

$matricula = $_POST['matricula'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$estatus = $_POST['estatus'];
$painel = $_POST['painel'];

$query = $con->prepare("INSERT INTO usuarios(matricula, nome, email, senha, estatus, painel)
VALUES(:matricula, :nome, :email, :senha, :estatus, :painel)");

$query->bindValue(":matricula", $matricula);
$query->bindValue(":nome", $nome);
$query->bindValue(":email", $email);
$query->bindValue(":senha", $senha);
$query->bindValue(":estatus", $estatus);
$query->bindValue(":painel", $painel);

$check = $con->prepare("SELECT * FROM usuarios WHERE email=?");
$check->execute(array($email));

if ($check->rowCount() == 0) {
    $query->execute();
    echo 'cadastro executado';
} else {
    echo 'email existente';
}

$result = $check->rowCount();

if ($result == 0){
    $_SESSION['cadastrado'] = true;
    header("Location:cadastro.php");
    exit();
}
else {
    $_SESSION['naocadastrado'] = true;
    header("Location:cadastro.php");
    exit();
}

?>
