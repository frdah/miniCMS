<?php
/****************************************************
 * 
 * Filnamn: read.php
 * 
 * Info: Filen hämtar en tabell från databasen
 * 
 *****************************************************/


$stmt = $db->prepare("SELECT * FROM postform ORDER BY regtime DESC");
$stmt->execute();


$table = '<h2 class="text-center m-4">Tidigare inlägg</h2>';
$table .= '<table class="table shadow-sm p-3 mb-5 bg-white rounded text-muted text-center">';


  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = htmlspecialchars($row['id']);
    $regtime = htmlspecialchars($row['regtime']);
    $heading = htmlspecialchars($row['heading']);
    $post = htmlspecialchars($row['post']);
    $embedd = strip_tags($row['embedd'], '<iframe>');
    $publish = htmlspecialchars($row['publish']);
            
    $img = '../images/' . $row['img'] . ' onerror=this.style.display="none"';          
    $newtext = '<p>' . implode('</p><p>', array_filter(explode("\n", $post))) . '</p>';
   

    if ($publish == 0) {
      $publish_label = "Publicera";
    } else {
      $publish_label = "Avpublicera";
    }

    $table .= "<tr>
                  <td>
                    <p> $regtime </p>
                    <h2>$heading </h2>
                      <div class='postContent'>
                        <img src=$img class='mb-3' style='max-width: 700px'>
                        $newtext
                        <div style='max-width: 700px video-div'>$embedd </div>
                      </div>
                      <div>
                        <a href='publish.php?id=$id&publish=$publish' class='btn btn-outline-warning mt-3 btn-sm '>
                        $publish_label
                        </a>
                        <a href='update.php?id=$id' class='btn btn-outline-info mt-3 btn-sm'>
                        Redigera
                        </a>
                        <a href='delete.php?id=$id' class='btn btn-outline-danger mt-3 btn-sm'>
                        Radera inlägg
                        </a>
                      </div>
                  </td>
                  
    
    </tr> ";
    
    }
    $table .= '</table>';
    $table .= "<a href='deleteAll.php?' class='btn btn-outline-secondary col-md-12 text-center delete-all'> Radera alla inlägg</a> ";
    
    echo $table;

?>
