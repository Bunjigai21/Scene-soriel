var canvas = document.querySelector('.myCanvas');
var width = canvas.width = window.innerWidth;
var height = canvas.height = window.innerHeight-85;
var ctx = canvas.getContext('2d');
ctx.fillStyle = 'rgba(255, 255, 255, 0)';
ctx.fillRect(0,0,width,height);
var colorPicker = document.querySelector('input[type="color"]');
var sizePicker = document.querySelector('input[type="range"]');
var output = document.querySelector('.output');
var clearBtn = document.querySelector('#clear');
var saveBtn = document.querySelector('#save');
// covert degrees to radians
function degToRad(degrees) {
  return degrees * Math.PI / 180;
};
// update sizepicker output value
sizePicker.oninput = function() {
  output.textContent = sizePicker.value;
}
// store mouse pointer coordinates, and whether the button is pressed
var curX;
var curY;
var pressed = false;
// update mouse pointer coordinates
document.onmousemove = function(e) {
  curX = (window.Event) ? e.pageX : e.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
  curY = (window.Event) ? e.pageY : e.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
}
canvas.onmousedown = function() {
  pressed = true;
};
canvas.onmouseup = function() {
  pressed = false;
}
clearBtn.onclick = function() {
  //ctx.fillStyle = 'rgba(255, 255, 255, 0)';
  ctx.globalCompositeOperation = "destination-out";
  //ctx.strokeStyle = "rgba(255,255,255,1)";
  ctx.fillRect(0,0,width,height);
  ctx.globalCompositeOperation = "source-over";
 
}
saveBtn.onclick =function(){
    // save canvas image as data url (png format by default)
     
    // var dataURL = canvas.toDataURL();
    // console.log(dataURL);
    // set canvasImg image src to dataU
      // set canvasImg image src to dataURL
      // so it can be saved as an image
  //  document.getElementById('canvasImg').src = dataURL;
  //var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  // here is the most important part because if you dont replace you will get a DOM 18 exception.


//window.location.href=image; // it will save locally
/*var link = document.getElementById('link');
link.setAttribute('download', 'MintyPaper.png');
link.setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
link.click();*/
document.getElementById('my_hidden').value = canvas.toDataURL('image/png');
document.forms["form1"].submit();

}
function draw() {
  if(pressed) {
    ctx.fillStyle = colorPicker.value;
    ctx.beginPath();
    ctx.arc(curX, curY-85, sizePicker.value, degToRad(0), degToRad(360), false);
    ctx.fill();
  }
  requestAnimationFrame(draw);
}
draw();