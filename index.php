
<?php
/******************************************
 * 
 * Filnamn: index.php
 *
 * Visar upp info från databasen på starsidan
 * 
 ******************************************/
  require_once 'header.php';
  require_once 'db.php';

  $stmt = $db->prepare("SELECT * FROM postform WHERE publish = 1 ORDER BY regtime DESC");
  $stmt->execute();

  

  $table = '<div class="jumbotron text-center">';
   $table .= '<h5>Inlägg</h5>';
    $table .= '<hr class=mb-5>';

  

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id      = htmlspecialchars($row['id']);
    $regtime = htmlspecialchars($row['regtime']);
    $heading = htmlspecialchars($row['heading']);
    $post    = htmlspecialchars($row['post']);
    $embedd  = strip_tags($row['embedd'], '<iframe>');
    $img = 'images/' . $row['img'] . ' onerror=this.style.display="none"';

    $newtext = '<p>' . implode('</p><p>', array_filter(explode("\n", $post))) . '</p>';
    
    $table  .=  "
      <h2>$heading</h2>
      <p class='lead mt-4'>$newtext </p>
      <img src=$img class='mb-3' style='max-width: 700px'>
      <p> $embedd</p>
      <p class='text-right mt-5 date-text'> Publicerades: $regtime </p>
      <hr class='my-3'>";
  }

  $table .= '</div>';
                 

  echo $table;

  require_once 'footer.php';

?>



