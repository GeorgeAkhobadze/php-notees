<?php
// open the file in a binary mode
$name = base_path("/storage/images/". $_GET['name']);
$fp = fopen($name, 'rb');

// send the right headers
header("Content-Type: image/jpg");
header("Content-Length: " . filesize($name));

// dump the picture and stop the script
fpassthru($fp);
exit;