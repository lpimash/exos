<?php
$url = "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];

$url=parse_url($url);
echo 'Scheme : '.$url['scheme']."<br>";
echo 'Host : '.$url['host']."<br>";
echo 'Path : '.$url['path']."<br>";
?>