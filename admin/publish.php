<?php
/*****************************************
 * 
 * Filnamn: publish.php
 * 
 * Filen för toggle mellan publish/unpublish
 * 
 ******************************************/



if(isset($_GET['id'])){

  $id = htmlentities($_GET['id']);
  $publish = htmlentities($_GET['publish']);

  $publish = 1 - $publish;
  
  require_once '../db.php';

  $sql = "UPDATE postform 
          SET publish = :publish
          WHERE id = :id";

  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':publish', $publish);

  $stmt->execute();
}

header('Location:index.php');

 ?>