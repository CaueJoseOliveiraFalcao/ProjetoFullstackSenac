<?php
    include('conexao.php');

    session_start();
    $conn=dbinit();
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);
    if(empty($_POST["email"]) || empty($_POST["senha"])){
        header("Location:login.php");

        exit();
    }

    $query = $conn->prepare("SELECT id FROM usuarios  WHERE email=:e AND senha=:s");
    
    $query->bindValue(":e" , $email);
    $query->bindValue(":s" , $senha);

    $query->execute();

    $row = $query->rowCount();
    /*
    if($row == 1){
        $_SESSION['usuario'] = $email;
        header("Location:painel.php");
        exit();
    }
    else{
        $_SESSION['nao_autenticado'] = true;
        header("Location:login.php");
        exit();
    }
    
    */
    if($row == 1){
        $verificar = $conn->query("SELECT * FROM usuarios");
        while ($linha = $verificar->fetch(PDO::FETCH_ASSOC)) {
            if($linha['email'] == $email){
               $nivel = $linha['painel'];
               switch($nivel){
                    case 'administrador':
                        $_SESSION['usuario'] = $email;
                        header("Location:admin.php");
                        exit();
                    case 'aluno';
                        $_SESSION['usuario'] = $email;
                        header("Location:aluno.php");
                        exit();
                    case 'professor';
                        $_SESSION['usuario'] = $email;
                        header("Location:professor.php");
                        exit();
               }
            }
            
        }
    }
    $_SESSION['nao_autenticado'] = true;
    header("Location: login.php");
    exit();
    
?>