<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no">
        <title>Dessin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/dessin.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       
                
    </head>

    <body id="dessin">
    
        <div class="body-head">DESSINER</div>


            <?php
            include_once('header.html');
             function print_rn($data,$txt="")
            {
                echo '<fieldset style="border: 1px solid orange; padding: 5px;color: #333; background-color: #fff;">';
                if(!empty($txt))
                    echo '<legend style="border:1px solid orange;padding: 1px;background-color:#eee;color:orange;">'.$txt.'</legend>';	  
                else  
                    echo '<legend style="border:1px solid orange;padding: 1px;background-color:#eee;color:orange;">'.basename($_SERVER['SCRIPT_FILENAME']).'</legend>';
                echo '<pre wrap>'.htmlentities(print_r($data,1)).'</pre>';
                echo '</fieldset><br />';
            }
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
                    header('Location:  merci.php');
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
                    header('Location: merci.php');
                }
                 }
            ?>
              <!-- Modal -->
              <form method="POST" name='form1'><input type="hidden" name ="my_hidden" id="my_hidden"></form>
  <div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input class="form-control-range" id="formControlRange" type="range" min="2" max="50" value="10" aria-label="select pen size">
        <input class="form-control" type="color" aria-label="select pen color"  value="#FFFFFF">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Valider</button>
      </div>
    </div>
  </div>
</div>
                <div id="page-content-wrapper">
                    
                       
                    <div id="canvas-container">
                    <div class="toolbar">
                        <a data-toggle="modal" data-target="#myModal" id="draw"><img src="contents/pen.png" height="30" width="30"></a>
                        <a id="gomme"><img src="contents/gomme.png" height="30" width="30"></a>
                       
                        <a id="clear"><img src="contents/retour.png" height="30" width="30"></a>
                        <a id="jakob"><img src="contents/forme.png" height="30" width="30"></a>
                        <a id="info"><img src="contents/info.png" height="30" width="30"></a>
                    </div>
                    <canvas name="myCanvas" id="myCanvas">
                        
                        </canvas>
         
    
                   
                    </div>
                    
                </div> <!-- /#page-content-wrapper -->
                <div id="btn-save">
                    <a id="save">ENVOYER MON DESSIN</a>
                    </div>
            </div> <!-- /#wrapper -->
 

            <script src="js/dessin.js"></script>

        <?php 
        include_once("footer.html");
        ?>
    </body>


    <footer>


    </footer>


</html>