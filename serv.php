<?php
$i = 1;
$address = "0.0.0.0";
$port = "467";
$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Can't create socket");

socket_bind($sock, $address, $port) or die("Couldn't bind to socket");
socket_listen($sock) or die("Couldn't listen to socket");
$accept = socket_accept($sock) or die("Couldn't accept socket");
$origRead = socket_read($accept,1024) or die("Cannot read from socket");
socket_write($accept, "egonissi c.g.");

 while (true) {
     $i++;
     $accept = socket_accept($sock) or die("Couldn't accept socket");
     $read = socket_read($accept,1024) or die("Cannot read from socket");
     if ($read == $origRead) {
         socket_write($accept, $i . PHP_EOL);
     } else {
         break;
     }
 }

echo "Bad message" . PHP_EOL;
socket_write($accept,"Bad message" . PHP_EOL);
socket_close($sock);
exit(0);
