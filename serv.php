<?php
$i = 1;         //Counter variable
$run = true;
$address = "0.0.0.0";
$port = "467";
$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Can't create socket");

socket_bind($sock, $address, $port) or die("Couldn't bind to socket");
socket_listen($sock) or die("Couldn't listen to socket");


 while ($run) {

     $accept = socket_accept($sock) or die("Couldn't accept socket");
     $read = socket_read($accept,1024, PHP_BINARY_READ) or die("Cannot read from socket");

     str_replace(array("\n\r", "\n", "\r", PHP_EOL), '', $read);            //Replace newline to avoid conflicts
     $read = preg_replace('/[\x00-\x1F\x7F]/u', '', $read);      //Remove unicode chars
     echo $read . PHP_EOL;

     if (strcmp($read, "Mixbot:egoniss432") == 0) {
         socket_write($accept,"egonissi c.g." . PHP_EOL);
     }
     else if (strcmp($read,"hello version 352 user:egoniss432") == 0) {
         socket_write($accept, "1" . PHP_EOL);
     }
     else if (strcmp($read,"keepgoing egoniss432") == 0) {
         socket_write($accept, ++$i . PHP_EOL);
     } else {
         $run = false;
     }
 }

echo "Bad message" . PHP_EOL;
socket_write($accept,"Bad message" . PHP_EOL);
socket_close($sock);
exit(0);
