var clearButton = document.querySelector('#clear');
var canvascontainer = document.getElementById('canvas-container');
var canvas = document.getElementById("myCanvas");
var context = canvas.getContext('2d');
var sizePicker = document.querySelector('input[type="range"]');
//var output = document.querySelector('.output');
var saveBtn = document.querySelector('#btn-save');
var gommeBtn = document.querySelector('#gomme');
var jakobBtn = document.querySelector('#jakob');
var drawBtn = document.querySelector('#draw');
var gomme = false;
var radius = (document.getElementById('canvas-container').clientWidth + document.getElementById('canvas-container').clientHeight) / sizePicker.value;
var dragging = false;
context.fillStyle = 'rgba(255, 255, 255, 0)';
context.strokeStyle = 'rgba(255, 255, 255, 0)';


var colorPicker = document.querySelector('input[type="color"]');
drawBtn.onclick = function(){
    gomme=false;
}

//sizePicker.oninput = function() {
  //  output.textContent = sizePicker.value;
 // }



context.mozImageSmoothingEnabled = false;
context.imageSmoothingEnabled = false;

canvas.width = (window.innerWidth);
canvas.height = (window.innerHeight);
canvas.style.width = '100%';
canvas.style.height = '100%';

/* CLEAR CANVAS */
function clearCanvas() {
    context.clearRect(0, 0, canvas.width, canvas.height);
    
}

clearButton.addEventListener('click', clearCanvas);


var putPoint = function (e) {
    e.preventDefault();
    e.stopPropagation();
    if (dragging) {
        var radius = (document.getElementById('canvas-container').clientWidth + document.getElementById('canvas-container').clientHeight) / (150/sizePicker.value*10);

        context.lineTo(getMousePosition(e).x, getMousePosition(e).y);
        context.lineWidth = radius * 2;
        if(gomme){
            context.globalCompositeOperation = "destination-out";
            context.strokeStyle = 'rgba(0, 0, 0, 1)';
        }else{
            context.globalCompositeOperation ="source-over";
            context.strokeStyle = colorPicker.value;
        } 
        context.stroke();
        context.beginPath();
        if(gomme){
            context.globalCompositeOperation = "destination-out";
            context.fillStyle = 'rgba(0, 0, 0, 1)';
        }else{
            context.globalCompositeOperation ="source-over";
            context.fillStyle = colorPicker.value;
        } 

        context.arc(getMousePosition(e).x, getMousePosition(e).y, radius, 0, Math.PI * 2);
        context.fill();
        context.beginPath();
        context.moveTo(getMousePosition(e).x, getMousePosition(e).y);
    }
};

var engage = function (e) {
    dragging = true;
    putPoint(e);
};
var disengage = function () {
    dragging = false;
    context.beginPath();
};

canvas.addEventListener('mousedown', engage);
canvas.addEventListener('mousemove', putPoint);
canvas.addEventListener('mouseup', disengage);
document.addEventListener('mouseup', disengage);
canvas.addEventListener('contextmenu', disengage);
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





// canvas.addEventListener("touchstart", handleStart, false);
// canvas.addEventListener("touchend", handleEnd, false);
// canvas.addEventListener("touchcancel", handleCancel, false);
// canvas.addEventListener("touchleave", handleLeave, false);
// canvas.addEventListener("touchmove", handleMove, false);

// function handleStart(evt) {
//     evt.preventDefault();
//     var el = document.getElementsByTagName("canvas")[0];
//     var ctx = el.getContext("2d");
//     var touches = evt.changedTouches;
          
//     for (var i=0; i<touches.length; i++) {
//       ongoingTouches.push(touches[i]);
//       var color = colorForTouch(touches[i]);
//       ctx.fillStyle = color;
//       ctx.fillRect(touches[i].pageX-2, touches[i].pageY-2, 4, 4);
//     }
//   }
//   function handleMove(evt) {
//     evt.preventDefault();
//     var el = document.getElementsByTagName("canvas")[0];
//     var ctx = el.getContext("2d");
//     var touches = evt.changedTouches;
    
//     ctx.lineWidth = 4;
          
//     for (var i=0; i<touches.length; i++) {
//       var color = colorForTouch(touches[i]);
//       var idx = ongoingTouchIndexById(touches[i].identifier);
  
//       ctx.fillStyle = color;
//       ctx.beginPath();
//       ctx.moveTo(ongoingTouches[idx].pageX, ongoingTouches[idx].pageY);
//       ctx.lineTo(touches[i].pageX, touches[i].pageY);
//       ctx.closePath();
//       ctx.stroke();
//       ongoingTouches.splice(idx, 1, touches[i]);  // mettre à jour la liste des touchers
//     }
//   }
//   function handleEnd(evt) {
//     evt.preventDefault();
//     var el = document.getElementsByTagName("canvas")[0];
//     var ctx = el.getContext("2d");
//     var touches = evt.changedTouches;
    
//     ctx.lineWidth = 4;
          
//     for (var i=0; i<touches.length; i++) {
//       var color = colorForTouch(touches[i]);
//       var idx = ongoingTouchIndexById(touches[i].identifier);
      
//       ctx.fillStyle = color;
//       ctx.beginPath();
//       ctx.moveTo(ongoingTouches[i].pageX, ongoingTouches[i].pageY);
//       ctx.lineTo(touches[i].pageX, touches[i].pageY);
//       ongoingTouches.splice(i, 1);  // On enlève le point
//     }
//   }
//   function handleCancel(evt) {
//     evt.preventDefault();
//     var touches = evt.changedTouches;
    
//     for (var i=0; i<touches.length; i++) {
//       ongoingTouches.splice(i, 1);  // on retire le point
//     }
//   }



function getMousePosition(e) {
    var mouseX = e.offsetX * canvas.width / canvas.clientWidth | 0;
    var mouseY = e.offsetY * canvas.height / canvas.clientHeight | 0;
    return {x: mouseX, y: mouseY};
}

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
    };
}

saveBtn.onclick =function(){
    document.getElementById('my_hidden').value = canvas.toDataURL('image/png');
    document.forms["form1"].submit();
    
}

gommeBtn.onclick=function(){
    gomme=true;
}
jakobBtn.onclick=function(){
    gomme=false;
    context.globalCompositeOperation ="source-over";
    var img = new Image();   
    img.addEventListener('load', function() {
        context.drawImage(img,5,5); 
    }, false);
    img.src = 'images/jakob.png';
}

