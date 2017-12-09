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


function snapshot() {
	console.log("Snapshot");



	canvas.width = video.offsetWidth;
	canvas.height = video.offsetHeight;

	ctx.drawImage(video, 0, 0);

	image.src = canvas.toDataURL('image/webp');

	data = image.src;
	var url = 'upload.php';

	var formData = {
		'img' : 'lkdsjf'
	};

	$.ajax({
		type: "POST",
		url: url,
		dataType: 'json',
		data: formData
	}).done(function() {
		console.log(data);
	}).fail(function() {
		console.log("FAIL");
	});
}

$("#snapshot").submit(function(e) {
	snapshot(e);
});