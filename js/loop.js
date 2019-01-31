function init(){
    loop();
 }
 function loop(){
     // ICI ON SET LE LOOP : 5000 = 5 secondes
    setTimeout('loop();',5000);
    $('#premier').load("affiche_image.php");
   
 }

 init();
 