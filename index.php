<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<meta charset="UTF-8">
	<script
		src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
		crossorigin="anonymous">
	</script>
	<link rel="stylesheet" type="text/css" href="styles.css">

	<script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-latest.js"></script>
</head>
<body>
	<form id="formPOST">
		<video autoplay="autoplay" id="LIVE"></video>
		<img src="" id="snapshot-img" name="imgtag">

		<canvas style="display:none;" id="SNAPSHOT-CTX" name="canvas"></canvas>

		<br>

		<input type="button" value="GRAB" name="" id="snapshot">	
	</form>

	<div id="results"></div>


<script>
navigator.getUserMedia  = navigator.getUserMedia ||
                          navigator.webkitGetUserMedia ||
                          navigator.mozGetUserMedia ||
                          navigator.msGetUserMedia;

var image = document.querySelector('img');
var video = document.querySelector('video');
var canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');

if (navigator.getUserMedia) {
  navigator.getUserMedia({audio: true, video: true}, successCallback, errorCallback);
} else {
  video.src = 'http://techslides.com/demos/sample-videos/small.webm'; // fallback.
}

function successCallback(stream) {
	video.src = window.URL.createObjectURL(stream);
}

function errorCallback() {
	console.log("ERRORRRRR");
}


function clarifaiDetect() {
		// instantiate a new Clarifai app passing in your api key.
      const app = new Clarifai.App({
       apiKey: 'bdade2fd2353409fadd3ab35377416a6'
      });
      
      // predict the contents of an image by passing in a url
      app.models.predict(Clarifai.GENERAL_MODEL, 'http://tsuts.tskoli.is/2t/2808982529/Webcam/screen.png').then(
        function(response) {
          let probee = response.outputs[0].data.concepts;

          for (var i = 0; i < probee.length; i++) {
          	let name = probee[i].name;
          	let chance = probee[i].value * 100;

          	//if (chance > 95)
          		console.log(name + " = " + chance);
          		$('#results').append(name + " = " + chance + "<br>");
          };

          /*
          var arr = Object.values(probee);
          console.log(arr);
          */
      	},
        function(err) {
          console.error(err);
        }
      );
}

function snapshot() {
	console.log("Snapshot");

	canvas.width = video.offsetWidth;
	canvas.height = video.offsetHeight;

	ctx.drawImage(video, 0, 0);

	image.src = canvas.toDataURL('image/webp');

	$.ajax({
    type: 'POST',
    url: 'm.php',
    data: { 
        'raw': image.src, 
        'title': 'LIVE SNAPSHOT'
    },
    success: function(msg){
        console.log(msg);
        console.log("DETECTING...");

        $('#results').append("DETECTING...");

        clarifaiDetect();
    },
    fail: function() {
    	console.log("nop");
    }
	});

}

$("#snapshot").click(function() {snapshot()});
</script>

</body></html>
