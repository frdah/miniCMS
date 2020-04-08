<?php
/****************************************************
 * 
 * Filnamn: read.php
 * 
 * Info: Filen uppdaterar informationen i databasen utifrån formulär
 * 
 *****************************************************/


//
require_once '../db.php';

if(isset($_GET['id'])){
  $id = htmlspecialchars($_GET['id']);
  $sql = "SELECT * FROM postform WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id' , $id );
  $stmt->execute();

  if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $heading  = $row['heading'];
    $post     = $row['post'];
    $embedd   = $row['embedd'];
    $img      = $row['img'];

  } else {

    header('Location:index.php');
    exit;
  }

  } else {
    header('Location:index.php');
    exit;
  }


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    

  $heading  = htmlspecialchars($_POST['heading']);
  $post     = htmlspecialchars($_POST['post']);
  $id       = htmlentities($_POST['id']);
  $embedd   = strip_tags($_POST['embedd'], '<iframe>');
  $img = time() . '_' . $_FILES['img']['name'];
        

  $sql = "UPDATE postform
          SET    heading = :heading, 
                 post = :post,
                 embedd = :embedd, 
                 img = :img
          WHERE  id = :id";

  $stmt = $db->prepare($sql);

  $stmt->bindParam(':heading', $heading);
  $stmt->bindParam(':post' , $post);
  $stmt->bindParam(':id'  , $id);
  $stmt->bindParam(':embedd', $embedd);
  $stmt->bindParam(':img', $img);

  $target = '../images/' . $img;
  move_uploaded_file($_FILES['img']['tmp_name'], $target);

  $stmt->execute();
  header('Location: index.php');
  
  echo "efter header";
  exit;
}

require_once 'header.php';

?>

<h3 class="mt-5 mb-3">Redigera inlägg:</h3>

<form class="shadow-sm p-3 mb-5 bg-white rounded" action="#" method="POST" enctype="multipart/form-data">
<div class="row">

<div class="col-md-6">
    <input 
    name="heading" 
    type="text" 
    placeholder="RUBRIK" 
    class="form-control mt-3"
    value="<?php echo $heading?>"
    >
</div>

<div class="col-md-6">
    <input 
    name="img" 
    type="file" 
    class="form-control mt-3"
    >
</div>

<div class="col-md-12">
    <textarea rows="10" cols="50" 
    name="post" 
    type="message" 
    class="form-control mt-3"
    aria-label="With textarea"
    ><?php echo $post?></textarea>
</div>

<div class="col-md-12">
    <textarea 
    name="embedd" 
    type="text" 
    class="form-control mt-3"
    aria-label="With textarea"
    ><?php echo $embedd?></textarea>
    
</div>

<div class="col-md mb-4">
<input 
      type="submit" 
      value="Uppdatera"
      class="btn btn-outline-success btn-block"
    >
</div>



</div>
<input type="hidden" name="id" value="<?php echo $id; ?>" method="POST">
</form>


<?php
  require_once 'footer.php';
?>


