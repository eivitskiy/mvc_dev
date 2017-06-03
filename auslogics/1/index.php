<?php

setcookie ("referrer", $_SERVER['HTTP_REFERER']);

$url = explode('/', $_SERVER['REQUEST_URI']);

if(count($url) != 3) {
    header('HTTP/1.0 400 Bad Request');
}
if($url[1] !== 'files' || empty($url[2])) {
    header('HTTP/1.0 400 Bad Request');
} else {
    $fileName = $url[2];
    if (!file_exists($fileName)) {
        header('HTTP/1.0 404 Not Found');
    } else {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Content-Length: ' . filesize($fileName));

        readfile($fileName);
        exit;
    }
}
?>