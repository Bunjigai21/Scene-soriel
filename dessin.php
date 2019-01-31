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
        $upload_dir = "images/saved/" ; //implement this function yourself
        $img = $_POST['my_hidden'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir."image_name.png";
        $success = file_put_contents($file, $data);
        header('Location: ');
    }
?>
    
<div id="canvas-container">
<div class="toolbar">
      <input type="color" aria-label="select pen color">
      <input type="range" min="2" max="50" value="30" aria-label="select pen size"><span class="output">30</span>
      <button id="gomme">Gomme</button>
      <button id="save">Save</button>
      <button id="clear">Clear</button>
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