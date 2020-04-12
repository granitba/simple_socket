<?php
$i = 1;         // Counter variable
$run = true;
$address = "0.0.0.0";
$port = "3333";
$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Can't create socket");

// Bind to the socket that we created and listen to it for connections
socket_bind($sock, $address, $port) or die("Couldn't bind to socket");
socket_listen($sock) or die("Couldn't listen to socket");


 while ($run) {

     // Accept any incoming connection
     $accept = socket_accept($sock) or die("Couldn't accept socket");

     // We use php_binary_read because normal read behaves very strange with newlines
     // and it's also blocking regardless of socket_non_block
     $read = socket_read($accept,1024, PHP_BINARY_READ) or die("Cannot read from socket");

     // Replace all newline characters with empty space, usually only looking for PHP_EOL would suffice,
     // but not when sending data from windows to unix or vice versa
     str_replace(array("\n\r", "\n", "\r", PHP_EOL), '', $read);

     // Replace obscure UTF characters with empty space (without this my string wouldn't compare correctly)
     $read = preg_replace('/[\x00-\x1F\x7F]/u', '', $read);
     echo $read . PHP_EOL;

     // Strcmp will return 0 if the strings match
     if (strcmp($read, "Target") == 0) {
         $i = 1;
         socket_write($accept,"Reply" . PHP_EOL);
     }
     else if (strcmp($read,"Hello target") == 0) {
         socket_write($accept, "1" . PHP_EOL);
     }
     else if (strcmp($read,"keepgoing") == 0) {
         socket_write($accept, ++$i . PHP_EOL);
     } else {
         $run = false;
     }
 }

echo "Bad message" . PHP_EOL;
socket_write($accept,"Bad message" . PHP_EOL);
socket_close($sock);
exit(0);
