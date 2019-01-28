var clearButton = document.querySelector('#clear');
var canvascontainer = document.getElementById('canvas-container');
var canvas = document.getElementById("myCanvas");
var context = canvas.getContext('2d');
var sizePicker = document.querySelector('input[type="range"]');
var output = document.querySelector('.output');
var saveBtn = document.querySelector('#save');
var radius = (document.getElementById('canvas-container').clientWidth + document.getElementById('canvas-container').clientHeight) / sizePicker.value;
var dragging = false;
context.fillStyle = 'rgba(255, 255, 255, 0)';
context.strokeStyle = 'rgba(255, 255, 255, 0)';
var colorPicker = document.querySelector('input[type="color"]');
sizePicker.oninput = function() {
    output.textContent = sizePicker.value;
  }
function getMousePosition(e) {
    var mouseX = e.offsetX * canvas.width / canvas.clientWidth | 0;
    var mouseY = e.offsetY * canvas.height / canvas.clientHeight | 0;
    return {x: mouseX, y: mouseY};
}

context.mozImageSmoothingEnabled = false;
context.imageSmoothingEnabled = false;

canvas.width = 1280;
canvas.height = 720;
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
        context.strokeStyle = colorPicker.value;
        context.stroke();
        context.beginPath();
        context.fillStyle = colorPicker.value;
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

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
var rect = canvasDom.getBoundingClientRect();
return {
x: touchEvent.touches[0].clientX - rect.left,
y: touchEvent.touches[0].clientY - rect.top
};
}
// canvas.addEventListener('touchstart', engage, false);
//     // canvas.addEventListener('touchmove', function (e) {
//     //   var touch = e.touches[0];
//     //   var mouseEvent = new MouseEvent("mousemove", {
//     //     clientX: touch.clientX,
//     //     clientY: touch.clientY
//     //   });
//     //   canvas.dispatchEvent(mouseEvent);
//     // }, false);
// canvas.addEventListener('touchmove', putPoint, false);
// canvas.addEventListener('touchend', disengage, false);
saveBtn.onclick =function(){
    document.getElementById('my_hidden').value = canvas.toDataURL('image/png');
    document.forms["form1"].submit();
    
    }