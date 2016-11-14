<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/4/16
 * Time: 10:25 AM
 */

// change the page to a regular connection
$http = filter_input(INPUT_SERVER, 'HTTP');
if (!$http) {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
    $url = 'http://' . $host . $uri;
    header("Location: " . $url);
    exit();
}
?>