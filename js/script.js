var drawing = false;
var mousePos = { x:0, y:0 };
var lastPos = mousePos;
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
var width = canvas.width = window.innerWidth;
var height = canvas.height = window.innerHeight-85;
ctx.fillStyle = 'rgba(255, 255, 255, 0)';
ctx.fillRect(0,0,width,height);
var colorPicker = document.querySelector('input[type="color"]');
var sizePicker = document.querySelector('input[type="range"]');
var output = document.querySelector('.output');
var clearBtn = document.querySelector('#clear');
var saveBtn = document.querySelector('#save');
//ctx.lineWidth = 10;
function degToRad(degrees) {
    return degrees * Math.PI / 180;
  };
sizePicker.oninput = function() {
    output.textContent = sizePicker.value;
  }
canvas.addEventListener("mousedown", function (e) {
        drawing = true;
  lastPos = getMousePos(canvas, e);
}, false);
canvas.addEventListener("mouseup", function (e) {
  drawing = false;
}, false);
canvas.addEventListener("mousemove", function (e) {
  mousePos = getMousePos(canvas, e);
}, false);

// Get the position of the mouse relative to the canvas
function getMousePos(canvasDom, mouseEvent) {
  var rect = canvasDom.getBoundingClientRect();
  return {
    x: mouseEvent.clientX - rect.left,
    y: mouseEvent.clientY - rect.top
  };
}
window.requestAnimFrame = (function (callback) {
    return window.requestAnimationFrame || 
       window.webkitRequestAnimationFrame ||
       window.mozRequestAnimationFrame ||
       window.oRequestAnimationFrame ||
       window.msRequestAnimaitonFrame ||
       function (callback) {
    window.setTimeout(callback, 1000/60);
       };
})();
function renderCanvas() {
    if (drawing) {
        ctx.beginPath();
       // ctx.strokeStyle = colorPicker.value;

       // ctx.lineWidth = sizePicker.value;
      // ctx.moveTo(lastPos.x, lastPos.y);
        //ctx.lineTo(mousePos.x, mousePos.y);
        //ctx.stroke();
        //lastPos = mousePos;
        ctx.fillStyle = colorPicker.value;
        ctx.beginPath();
        ctx.arc(lastPos.x, lastPos.y, sizePicker.value, degToRad(0), degToRad(360), false);
        ctx.fill();
        lastPos = mousePos;
    }
  }
  
  // Allow for animation
  (function drawLoop () {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  canvas.addEventListener("touchstart", function (e) {
    mousePos = getTouchPos(canvas, e);
var touch = e.touches[0];
var mouseEvent = new MouseEvent("mousedown", {
clientX: touch.clientX,
clientY: touch.clientY
});
canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchend", function (e) {
var mouseEvent = new MouseEvent("mouseup", {});
canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchmove", function (e) {
var touch = e.touches[0];
var mouseEvent = new MouseEvent("mousemove", {
clientX: touch.clientX,
clientY: touch.clientY
});
canvas.dispatchEvent(mouseEvent);
}, false);

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
    x: touchEvent.touches[0].clientX - rect.left,
    y: touchEvent.touches[0].clientY - rect.top
    };
}
document.body.addEventListener("touchstart", function (e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function (e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function (e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  var dataUrl = canvas.toDataURL();
  function clearCanvas() {
    canvas.width = canvas.width;
}
saveBtn.onclick =function(){
document.getElementById('my_hidden').value = canvas.toDataURL('image/png');
document.forms["form1"].submit();

}
clearBtn.onclick = function() {
    canvas.width = canvas.width;
   
  }
