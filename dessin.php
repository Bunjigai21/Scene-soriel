<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Canvas</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="css/dessin.css">
  </head>
  <body>

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
<input class="form-control-range" id="formControlRange" type="range" min="2" max="50" value="20" aria-label="select pen size">

      <input class="form-control" type="color" aria-label="select pen color">
     
      <button id="gomme">Gomme</button>
      <button id="save">Save</button>
      <button id="clear">Clear</button>
      <button id="jakob">Jakob</button>
    </div>
<canvas name="myCanvas" id="myCanvas">
      <p>Add suitable fallback here.</p>
    </canvas>
    
</div>
    
    <form method="POST" name='form1'><input type="hidden" name ="my_hidden" id="my_hidden"></form>
    
    
   <script src="js/dessin.js"></script>
   <?php 
        include_once("footer.html");
        ?>
  </body>
</html>