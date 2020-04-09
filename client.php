<?php
$address="192.168.1.120";
$port="467";
$msg="Hello";

$sock=socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create a socket");
socket_connect($sock,$address,$port) or die("Could not connect to the socket");
socket_write($sock,$msg);

$read=socket_read($sock,1024);
echo $read;
socket_close($sock);