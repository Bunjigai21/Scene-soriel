function init(){
    loop();
 }
 function loop(){
     // ICI ON SET LE LOOP : 5000 = 5 secondes
    setTimeout('loop();',1000);
    $('#premier').load("affiche_image.php");
   
 }

 init();
 function random_position()
{
// titre_left= Math.floor(Math.random() * 225)+55;
// var test=document.getElementsByClassName("test");//.style.left = +titre_left+"px";
// titre_top= Math.floor(Math.random() * 300)+30;
// //document.getElementsByClassName("test").style.top = +titre_top+"px";
// for (var i = 0; i < test.length; i++)
//     test[i].style.left = +titre_left+"px";
//     test[i].style.top = +titre_top+"px";
// // nav_left= Math.floor(Math.random() * 225)+50;
// // document.getElementById("menuvideos").style.left = +nav_left+"px";
// // nav_top= Math.floor(Math.random() * 300)+30;
// // document.getElementById("menuvideos").style.top = +nav_top+"px";

}