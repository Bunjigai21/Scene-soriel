<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dessin</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="css/dessin.css">
  </head>
  <body id="dessin">

<div class="body-head">
  DESSINER
</div>

  <?php

  include_once('header.html'); 
    if(isset($_POST['my_hidden'])){
        require_once('bd.php');
        $sql = 'SELECT * FROM session WHERE DateFin>:currentdate ';
        $req = $bd->prepare($sql);
        date_default_timezone_set('Europe/Paris');
        $currentDate=date("Y-m-d H:i:s");
        $req->bindParam(':currentdate', $currentDate );
        $req->execute();    
        $session =$req->fetch();
        if(isset($session["Id"]) && $session["Id"]!=''){
            $date= date("Y_m_d_H_i_s");
           // $nb=rand( 0 , 10000000 );
           $upload_dir = "images/saved/".$session["Id"]."/" ;
           if( !is_dir ( $upload_dir) ){
             mkdir($upload_dir);
           }
        
            $img = $_POST['my_hidden'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            // $file = $upload_dir."image_name".$nb.".png";
            $file = $upload_dir.$date.".png";
            $success = file_put_contents($file, $data);
            header('Location:  dessin.php');
        }else{            
            $sql = 'INSERT INTO session(DateDebut,ThemeId, DateFin) VALUES(:currentdate ,1, :dateend) ';
            $req = $bd->prepare($sql);
            $req->bindParam(':currentdate', $currentDate);
            $dateEnd=date("Y-m-d H:i:s", mktime( date("H")+1));
            $req->bindParam(':dateend',$dateEnd);
            $req->execute(); 
            $sql = 'SELECT * FROM session WHERE DateFin>:currentdate ';
            $req = $bd->prepare($sql);
            $req->bindParam(':currentdate', $currentDate);
            $req->execute();    
            $session =$req->fetch();
            $date= date("Y_m_d_H_i_s");
           // $nb=rand( 0 , 10000000 );
            $upload_dir = "images/saved/".$session["Id"]."/" ;
            if( !is_dir ( $upload_dir) ){
                mkdir($upload_dir);
              }
            $img = $_POST['my_hidden'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            // $file = $upload_dir."image_name".$nb.".png";
            $file = $upload_dir.$date.".png";
            $success = file_put_contents($file, $data);
            header('Location: dessin.php');
        }
         }
        
        
?>


<div id="canvas-container">
  <div class="toolbar">
    <a data-toggle="modal" data-target="#myModal" id="draw"><img src="contents/pen.png" height="30" width="30"></a>
    <a id="gomme"><img src="contents/retour.png" height="30" width="30"></a>
    <a id="save">Save</a>
    <a id="clear"><img src="contents/retour.png" height="30" width="30"></a>
    <a id="jakob"><img src="contents/forme.png" height="30" width="30"></a>
    <a id="info"><img src="contents/info.png" height="30" width="30"></a>
  </div>
<canvas name="myCanvas" id="myCanvas">
      
    </canvas>
    
</div>
    
    <form method="POST" name='form1'><input type="hidden" name ="my_hidden" id="my_hidden"></form>
    
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pinceau</h4>
      </div>
      <div class="modal-body">
        <input class="form-control-range" id="formControlRange" type="range" min="2" max="50" value="20" aria-label="select pen size">
        <input class="form-control" type="color" aria-label="select pen color">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
   <script src="js/dessin.js"></script>
   <?php 
        include_once("footer.html");
        ?>
  </body>
</html>