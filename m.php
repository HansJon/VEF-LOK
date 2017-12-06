<?php
$img = $_POST['raw'];
$title = $_POST['title'];

echo $title;
echo $img;

file_put_contents('./pics.txt', $img);
echo json_encode($img);

list($type, $img) = explode(';', $img);
list(, $img)      = explode(',', $img);
$img = base64_decode($img);

file_put_contents('./screen.png', $img);
?>