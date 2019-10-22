window.setInterval(
    function(){
        // document.getElementById('newId').value="moo";
        // document.getElementById('buttonId').click();
        navigator.geolocation.getCurrentPosition(function(position){
            document.getElementById('latitude').value=position.coords.latitude;
            document.getElementById('longitude').value=position.coords.longitude;
            document.getElementById('buttonId').click();
        }, function(position){

        });
}, 10000);


// // Simulate a logging library
// var $log = $('#log');
// var log = function (str) {
// 	$log.html($log.html() + str  + '<br />');
// };

// // Simulate a location service
// var getUserLocation = function (onSuccess, onError) {
//   // Bust the call stack so Safari doesn't choke.
//   setTimeout(function () {
//     navigator.geolocation.getCurrentPosition(onSuccess, onError);
//     window.location.reload(1);
//   },4000);
// };

// // Simulate an app.
// log('getting your location');
// getUserLocation(function(position){ 
//  log('you are here: ' + position.coords.latitude + ', ' + position.coords.longitude);
// }
//   , function (err) {
//   log('oh noes! ' + err)
// });
