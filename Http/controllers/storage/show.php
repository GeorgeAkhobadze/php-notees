<?php
$name = base_path("/storage/images/" . $_GET['name']);
$fp = fopen($name, 'rb');

$extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

switch ($extension) {
    case 'jpg':
        header("Content-Type: image/jpeg");
        break;
    case 'svg':
        header("Content-Type: image/svg+xml");
        break;
}

header("Content-Length: " . filesize($name));

fpassthru($fp);
exit;
