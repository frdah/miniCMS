<?php
/*****************************************
 * 
 * Filnamn: delete.php
 * 
 * Filen tar bort en rad från databasen
 * med hjälp av ett ID
 * 
 ******************************************/



if(isset($_GET['id'])){

  $id = htmlentities($_GET['id']);
  
  require_once '../db.php';

  $sql = "DELETE FROM postform WHERE id = :id";

  $stmt = $db->prepare($sql);

  $stmt->bindParam(':id', $id);

  $stmt->execute();
}

header('Location:index.php');

 ?>