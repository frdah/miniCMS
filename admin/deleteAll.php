<?php
/*****************************************
 * 
 * Filnamn: deleteAll.php
 * 
 * Filen tar bort en rad från databasen
 * med hjälp av ett ID
 * 
 ******************************************/

require_once '../db.php';


  $sql = "DELETE FROM postform ";

  $stmt = $db->prepare($sql);

  $stmt->execute();

  header('Location:index.php');

 ?>