<?php
    include('conexao.php');

    $conn=dbinit();
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    if(empty($_POST["email"]) || empty($_POST["senha"])){
        header("Location:login.html");

        exit();
    }

    $query = $conn->prepare("SELECT id FROM usuarios  WHERE email=:e AND senha=:s");
    
    $query->bindValue(":e" , $email);
    $query->bindValue(":s" , $senha);

    $query->execute();

    $row = $query->rowCount();

    echo $row;
?>