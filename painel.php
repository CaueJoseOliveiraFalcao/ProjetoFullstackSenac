<?php
session_start();

?>

<div>
    <?php
        if(isset($_SESSION["usuario"])):
    ?>
        <h1>Olá, <?php echo $_SESSION["usuario"];?></h1>

        <a href="scriptlogout.php">Logout</a>
    <?php
        else:
            header("Location:login.php");
        endif;
    ?>
</div>