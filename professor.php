<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        width:100%;
    
    }
    .card{
        display:flex;
        justify-content:center;
        align-items:center;
        width:100%;
        background-color: #f1f1f1;
        flex-direction:column;
        padding: 1rem;
    }
</style>
<body>
    <div>
    <?php
        if(isset($_SESSION["usuario"])):
    ?>
    <body>
        <header class="nav">
            <a href='scriptlogout.php'>Logout</a>  
        </header>
        <main>
            <section class="container">
                <div style="flex-direction:collum;display:flex;justify-itens:center;align-items;center;">
                    <div class="card">
                        <h1>Olá, <?php echo $_SESSION["usuario"];?></h1>
                        <p>Voce tem a permissao Professor</p>
                    </div>
                </div>
                
            </section>
        
        </main>
    </body>
    <?php
        else:
            header("Location:login.php");
        endif;
    ?>

</div>
</body>
</html>