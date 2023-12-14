<?php
session_start();
$id = filter_input(INPUT_GET , "id" , FILTER_SANITIZE_NUMBER_INT);

echo "<br>";

echo "<p>Confirma?</p>";

echo "<a href='excluir.php?id=$id'>s</a>";
echo '<br>';
echo "<a href='listar.php' >n</a>";

?>