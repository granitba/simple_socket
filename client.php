<?php
$address="127.0.0.1";
$port="467";

if ($argv[1] !== '') {
    $msg = $argv[1];
} else {
    $msg="Hello";
}


$sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create a socket");
socket_connect($sock,$address,$port) or die("Could not connect to the socket");
socket_write($sock,$msg);

$read=socket_read($sock,1024);
echo $read;
socket_close($sock);