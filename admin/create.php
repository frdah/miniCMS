<?php
/****************************************************
 * 
 * Filnamn: create.php
 * 
 * Info: Hanterar data som skickas via ett formulär
 * 
 *****************************************************/


if($_SERVER['REQUEST_METHOD'] === 'POST') :
  
$sql =  "INSERT INTO postform (heading, post, regtime, embedd, img, publish)
           VALUES ( :heading , :post, :regtime, :embedd, :img, 1) ";
 

 $stmt = $db->prepare($sql);

 $heading = htmlspecialchars($_POST['heading']);
 $post = htmlspecialchars($_POST['post']);
 $embedd = strip_tags($_POST['embedd'], '<iframe>');


 if ($_FILES['img']['name'] != '') {
    $img = time() . '_' . $_FILES['img']['name'];
    
 } 
 else {
     $img = '';
 }



 $stmt->bindParam(':heading', $heading);
 $stmt->bindParam(':post', $post); 
 $stmt->bindParam(':regtime', $_POST['regtime']);
 $stmt->bindParam(':embedd', $embedd);
 $stmt->bindParam(':img', $img);


$target = '../images/' . $img;
move_uploaded_file($_FILES['img']['tmp_name'], $target); 


 if (empty($heading . $post)) {
  echo "Empty heading and post";
}

 $stmt->execute();

 endif;

?>

<h3 class="mt-5 mb-3">Skapa nytt inlägg:</h3>

<form class="shadow-sm p-3 mb-5 bg-white rounded text-dark" action="index.php" method="POST" enctype="multipart/form-data">
<div class="row">

<div class="col-md-6">
    <input 
    name="heading" 
    type="text" 
    placeholder="RUBRIK" 
    class="form-control mt-3">
</div>

<div class="col-md-6">
    <input 
    name="img" 
    type="file" 
    class="form-control mt-3">
</div>

<div class="col-md-12">
    <textarea rows="10" cols="50"
    name="post" 
    type="message" 
    placeholder="Skriv ditt inlägg..." 
    class="form-control mt-3"
    aria-label="With textarea"
    ></textarea>
</div>


<div class="col-md-12">
    <input 
    name="embedd" 
    type="text" 
    placeholder="Bädda in youtube här" 
    class="form-control mt-3"
    aria-label="With textarea"
    >
</div>


<div class="col-md mb-4">
    <input 
    type="submit" 
    value="Publicera"
    class="btn btn-outline-secondary btn-block mt-3"
    >
</div>


</div>
</form>