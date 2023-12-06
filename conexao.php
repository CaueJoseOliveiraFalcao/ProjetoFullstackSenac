<?php
    
  function dbinit()
  {
    try{
        $con = new PDO("mysql:host=localhost; dbname=stack", "root" , "");
    }
    catch(PDOException $d){
        echo $d->getMessage() . '<br>';
        echo $d->getCode();
    }
    return $con;
  }
  dbinit();

?>